import Anthropic from "@anthropic-ai/sdk";
import { describe, expect, it, vi } from "vitest";
import { extractReport, type ExtractionOutput } from "../src/index.js";
import { makeReport, thresholds } from "./helpers.js";

const config = { extractionModel: "test-model", ...thresholds };
const input = { files: [{ filename: "r.txt", data: new TextEncoder().encode("Dienstrapport") }] };

function response(parsed: unknown, stop_reason = "end_turn") {
  return {
    parsed_output: parsed,
    stop_reason,
    stop_details: null,
    usage: { input_tokens: 100, output_tokens: 50 },
  };
}

function fakeClient(...results: Array<unknown | Error>) {
  const parse = vi.fn();
  for (const r of results) {
    if (r instanceof Error) parse.mockRejectedValueOnce(r);
    else parse.mockResolvedValueOnce(r);
  }
  return { client: { messages: { parse } } as unknown as Anthropic, parse };
}

const good: ExtractionOutput = { is_shift_report: true, reports: [makeReport()] };

describe("extractReport", () => {
  it("returns validated output and uses the configured model", async () => {
    const { client, parse } = fakeClient(response(good));
    const result = await extractReport(input, { client, config });
    expect(result.validation.status).toBe("ok");
    expect(result.attempts).toBe(1);
    expect(result.output).toEqual(good);
    expect(parse.mock.calls[0]![0]).toMatchObject({ model: "test-model" });
  });

  it("retries once after a parse failure and includes the error", async () => {
    const { client, parse } = fakeClient(
      new Anthropic.AnthropicError("Failed to parse structured output"),
      response(good),
    );
    const result = await extractReport(input, { client, config });
    expect(result.attempts).toBe(2);
    expect(result.validation.status).toBe("ok");
    const retryContent = parse.mock.calls[1]![0].messages[0].content;
    expect(retryContent.at(-1).text).toContain("Failed to parse structured output");
    expect(result.usage).toEqual({ inputTokens: 100, outputTokens: 50 });
  });

  it("sends to review after repeated invalid output instead of continuing silently", async () => {
    const invalid = { is_shift_report: true, reports: [{ ...makeReport(), confidence: 3 }] };
    const { client } = fakeClient(response(invalid), response(invalid));
    const result = await extractReport(input, { client, config });
    expect(result.output).toBeNull();
    expect(result.validation.status).toBe("needs_review");
    expect(result.validation.reasons.map((r) => r.code)).toEqual(["extraction_failed"]);
    expect(result.errors).toHaveLength(2);
  });

  it("treats refusals and truncation as failed attempts", async () => {
    const { client } = fakeClient(response(null, "refusal"), response(good, "max_tokens"));
    const result = await extractReport(input, { client, config });
    expect(result.validation.status).toBe("needs_review");
    expect(result.errors[0]).toMatch(/weigerde/);
    expect(result.errors[1]).toMatch(/afgekapt/);
  });

  it("rethrows API errors so the job can be retried later", async () => {
    const apiError = new Anthropic.APIError(401, { type: "error" }, "unauthorized", new Headers());
    const { client } = fakeClient(apiError);
    await expect(extractReport(input, { client, config })).rejects.toBe(apiError);
  });

  it("marks reports with skipped attachments for review", async () => {
    const { client } = fakeClient(response(good));
    const result = await extractReport(
      { files: [...input.files, { filename: "oud.doc", data: new Uint8Array([1]) }] },
      { client, config },
    );
    expect(result.validation.status).toBe("needs_review");
    expect(result.validation.reasons[0]).toMatchObject({ code: "unsupported_input" });
  });

  it("does not call the model when nothing is readable", async () => {
    const { client, parse } = fakeClient();
    const result = await extractReport(
      { files: [{ filename: "x.jpg", mimeType: "image/jpeg", data: new Uint8Array() }] },
      { client, config },
    );
    expect(parse).not.toHaveBeenCalled();
    expect(result.validation.status).toBe("needs_review");
  });
});
