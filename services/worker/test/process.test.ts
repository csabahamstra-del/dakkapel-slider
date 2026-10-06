import type { ExtractionResult } from "@veryo/core";
import { describe, expect, it, vi } from "vitest";
import {
  loadInput,
  processJob,
  toCompletionPayload,
  type InboundMessage,
  type Job,
  type WorkerDeps,
} from "../src/process.js";

const job: Job = {
  id: "job-1",
  organization_id: "org-1",
  inbound_message_id: "msg-1",
  attempts: 1,
  max_attempts: 5,
};

const message: InboundMessage = {
  id: "msg-1",
  organization_id: "org-1",
  subject: "Dienstrapport",
  received_at: "2026-03-13T07:00:00Z",
  body_text_storage_path: "org-1/k/body.txt",
  attachments: [
    {
      filename: "r.pdf",
      content_type: "application/pdf",
      storage_path: "org-1/k/attachments/1-r.pdf",
    },
  ],
};

const report = {
  site_name: "Distributiecentrum Noord",
  site_address: null,
  client_name: null,
  shift_start: "2026-03-12T22:00",
  shift_end: "2026-03-13T06:00",
  shift_type: "static_guarding" as const,
  guard_refs: ["4471"],
  summary: "Nachtdienst",
  remarks: [],
  incidents: [
    {
      category: "alarm_response" as const,
      reported_at: "2026-03-13T01:42",
      arrived_at: "2026-03-13T01:51",
      severity: "low" as const,
      summary: "Alarm",
      involved_roles: ["guard" as const],
    },
  ],
  confidence: 0.9,
  uncertainties: [],
};

const okResult: ExtractionResult = {
  model: "haiku",
  promptVersion: "v1",
  attempts: 1,
  output: { is_shift_report: true, reports: [report] },
  validation: { status: "ok", reasons: [], reports: [{ report, status: "ok", reasons: [] }] },
  errors: [],
  skippedFiles: [],
  usage: { inputTokens: 1000, outputTokens: 200 },
};

function deps(overrides: Partial<WorkerDeps> = {}): WorkerDeps {
  return {
    workerId: "w1",
    getMessage: vi.fn(async () => message),
    download: vi.fn(async (path: string) =>
      new TextEncoder().encode(path.endsWith(".txt") ? "Zie bijlage" : "%PDF"),
    ),
    extract: vi.fn(async () => okResult),
    complete: vi.fn(async () => undefined),
    fail: vi.fn(async () => "queued"),
    log: vi.fn(),
    ...overrides,
  };
}

describe("loadInput", () => {
  it("rebuilds the extraction input from stored originals", async () => {
    const input = await loadInput(message, deps().download);
    expect(input).toMatchObject({
      subject: "Dienstrapport",
      bodyText: "Zie bijlage",
      receivedAt: "2026-03-13T07:00:00Z",
    });
    expect(input.files).toHaveLength(1);
    expect(input.files[0]).toMatchObject({ filename: "r.pdf", mimeType: "application/pdf" });
  });
});

describe("toCompletionPayload", () => {
  it("maps reports and keeps them in review until site matching exists", () => {
    const payload = toCompletionPayload(okResult);
    expect(payload.status).toBe("needs_review");
    expect(payload.reports[0]).toMatchObject({
      site_id: null,
      site_name_raw: "Distributiecentrum Noord",
      shift_start_local: "2026-03-12T22:00",
      status: "needs_review",
      review_reasons: [{ code: "site_not_matched" }],
    });
    expect(payload.reports[0]!.incidents).toEqual([
      {
        category_code: "alarm_response",
        reported_at_local: "2026-03-13T01:42",
        arrived_at_local: "2026-03-13T01:51",
        severity: "low",
        summary: "Alarm",
        involved_roles: ["guard"],
      },
    ]);
    expect(payload.usage).toEqual({ inputTokens: 1000, outputTokens: 200 });
  });

  it("passes failed extractions through as needs_review without reports", () => {
    const failed: ExtractionResult = {
      ...okResult,
      output: null,
      validation: {
        status: "needs_review",
        reasons: [{ code: "extraction_failed", message: "x" }],
        reports: [],
      },
    };
    const payload = toCompletionPayload(failed);
    expect(payload).toMatchObject({
      status: "needs_review",
      reports: [],
      reasons: [{ code: "extraction_failed" }],
    });
  });
});

describe("processJob", () => {
  it("completes a job", async () => {
    const d = deps();
    expect(await processJob(job, d)).toBe("completed");
    expect(d.complete).toHaveBeenCalledWith("job-1", expect.objectContaining({ model: "haiku" }));
    expect(d.fail).not.toHaveBeenCalled();
  });

  it("records thrown errors as retryable failures", async () => {
    const d = deps({
      download: vi.fn(async () => Promise.reject(new Error("storage unavailable"))),
    });
    expect(await processJob(job, d)).toBe("retry");
    expect(d.fail).toHaveBeenCalledWith("job-1", "storage unavailable", true);
    expect(d.complete).not.toHaveBeenCalled();
  });

  it("reports when the queue gives up", async () => {
    const d = deps({
      extract: vi.fn(async () => Promise.reject(new Error("401"))),
      fail: vi.fn(async () => "failed"),
    });
    expect(await processJob(job, d)).toBe("failed");
  });

  it("never logs report content", async () => {
    const d = deps();
    await processJob(job, d);
    const logged = JSON.stringify(vi.mocked(d.log).mock.calls);
    expect(logged).not.toContain("Distributiecentrum");
    expect(logged).not.toContain("Alarm");
  });
});

describe("errorMessage", () => {
  it("formats Errors, Supabase error objects and other values", async () => {
    const { errorMessage } = await import("../src/process.js");
    expect(errorMessage(new Error("boom"))).toBe("boom");
    expect(errorMessage({ message: "permission denied", code: "42501", details: null })).toBe(
      "[42501] permission denied",
    );
    expect(errorMessage({ foo: 1 })).toBe('{"foo":1}');
    expect(errorMessage("x")).toBe("x");
  });
});
