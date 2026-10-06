import { createHmac } from "node:crypto";
import { describe, expect, it, vi } from "vitest";
import {
  handleMailgunInbound,
  parseInboundAlias,
  safeFilename,
  verifyMailgunSignature,
  type InboundDeps,
  type IngestParams,
} from "../../functions/_shared/mailgun-inbound.ts";

const SIGNING_KEY = "key-test-signing";
const ORG = "10000000-0000-4000-8000-00000000000a";

function sign(timestamp: string, token: string, key = SIGNING_KEY) {
  return createHmac("sha256", key)
    .update(timestamp + token)
    .digest("hex");
}

function mailgunRequest(
  fields: Record<string, string> = {},
  files: Array<[string, File]> = [],
  key = SIGNING_KEY,
) {
  const form = new FormData();
  const timestamp = "1773302400";
  const token = "tok-123";
  const all: Record<string, string> = {
    recipient: "noordwacht@in.veryo.test",
    sender: "meldkamer@noordwacht.test",
    from: "Meldkamer <meldkamer@noordwacht.test>",
    subject: "Dienstrapport 12-03",
    "body-plain": "Zie bijlage.",
    "Message-Id": "<abc@mail.noordwacht.test>",
    timestamp,
    token,
    signature: sign(timestamp, token, key),
    ...fields,
  };
  for (const [k, v] of Object.entries(all)) form.append(k, v);
  for (const [k, f] of files) form.append(k, f);
  return new Request("https://example.test/functions/v1/inbound-email", {
    method: "POST",
    body: form,
  });
}

function fakeDeps(overrides: Partial<InboundDeps> = {}) {
  const uploads = new Map<string, { data: Uint8Array; contentType: string }>();
  const ingested: IngestParams[] = [];
  const deps: InboundDeps = {
    signingKey: SIGNING_KEY,
    inboundDomain: "in.veryo.test",
    findOrganizationByAlias: vi.fn(async (alias: string) => (alias === "noordwacht" ? ORG : null)),
    uploadObject: vi.fn(async (path: string, data: Uint8Array, contentType: string) => {
      if (uploads.has(path)) return "exists" as const;
      uploads.set(path, { data, contentType });
      return "created" as const;
    }),
    ingest: vi.fn(async (p: IngestParams) => {
      ingested.push(p);
      return { inboundMessageId: "msg-1", duplicate: ingested.length > 1 };
    }),
    ...overrides,
  };
  return { deps, uploads, ingested };
}

describe("verifyMailgunSignature", () => {
  it("accepts a valid signature and rejects tampering", async () => {
    const sig = sign("1", "t");
    expect(await verifyMailgunSignature(SIGNING_KEY, "1", "t", sig)).toBe(true);
    expect(await verifyMailgunSignature(SIGNING_KEY, "2", "t", sig)).toBe(false);
    expect(await verifyMailgunSignature("other-key", "1", "t", sig)).toBe(false);
    expect(await verifyMailgunSignature("", "1", "t", sig)).toBe(false);
  });
});

describe("parseInboundAlias", () => {
  it.each([
    ["noordwacht@in.veryo.test", "noordwacht"],
    ["Noordwacht+maart@IN.veryo.test", "noordwacht"],
    ["Planning <noordwacht@in.veryo.test>", "noordwacht"],
    ["iemand@gmail.com, noordwacht@in.veryo.test", "noordwacht"],
    ["noordwacht@veryo.test", null],
    ["a@in.veryo.test", null],
  ])("%s → %s", (input, expected) => {
    expect(parseInboundAlias(input, "in.veryo.test")).toBe(expected);
  });
});

describe("safeFilename", () => {
  it("keeps names readable and storage-safe", () => {
    expect(safeFilename("Dienstrapport week 11 (définitief).pdf")).toBe(
      "Dienstrapport_week_11_definitief_.pdf",
    );
    expect(safeFilename("../../etc/passwd")).toBe("etc_passwd");
    expect(safeFilename("???")).toBe("bijlage");
  });
});

describe("handleMailgunInbound", () => {
  it("stores the message and attachments untouched and queues it", async () => {
    const pdf = new File([new Uint8Array([37, 80, 68, 70])], "rapport 12-03.pdf", {
      type: "application/pdf",
    });
    const docx = new File(["docx-bytes"], "week.docx", {
      type: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    });
    const { deps, uploads, ingested } = fakeDeps();

    const res = await handleMailgunInbound(
      mailgunRequest({}, [
        ["attachment-2", docx],
        ["attachment-1", pdf],
      ]),
      deps,
    );

    expect(res.status).toBe(200);
    expect(await res.json()).toEqual({ inbound_message_id: "msg-1", duplicate: false });
    const p = ingested[0]!;
    expect(p.organizationId).toBe(ORG);
    expect(p.externalId).toBe("<abc@mail.noordwacht.test>");
    expect(p.sender).toBe("meldkamer@noordwacht.test");
    expect(p.receivedAt).toBe("2026-03-12T08:00:00.000Z");
    expect(p.rawStoragePath).toMatch(new RegExp(`^${ORG}/[0-9a-f]{32}/message\\.json$`));
    expect(p.attachments.map((a) => [a.filename, a.size])).toEqual([
      ["rapport 12-03.pdf", 4],
      ["week.docx", 10],
    ]);
    expect(p.attachments[0]!.storage_path).toMatch(/\/attachments\/1-rapport_12-03\.pdf$/);

    // Attachment bytes are stored unchanged.
    expect([...uploads.get(p.attachments[0]!.storage_path)!.data]).toEqual([37, 80, 68, 70]);
    // The raw fields are kept, the signature material is not.
    const raw = JSON.parse(new TextDecoder().decode(uploads.get(p.rawStoragePath)!.data));
    expect(raw).toMatchObject({ subject: "Dienstrapport 12-03", "body-plain": "Zie bijlage." });
    expect(raw).not.toHaveProperty("signature");
    expect(new TextDecoder().decode(uploads.get(p.bodyTextStoragePath!)!.data)).toBe(
      "Zie bijlage.",
    );
  });

  it("is idempotent for webhook retries: same paths, nothing overwritten", async () => {
    const { deps, ingested } = fakeDeps();
    await handleMailgunInbound(mailgunRequest(), deps);
    const res = await handleMailgunInbound(mailgunRequest(), deps);
    expect(await res.json()).toMatchObject({ duplicate: true });
    expect(ingested[0]!.rawStoragePath).toBe(ingested[1]!.rawStoragePath);
  });

  it("rejects an invalid signature without storing anything", async () => {
    const { deps } = fakeDeps();
    const res = await handleMailgunInbound(mailgunRequest({}, [], "wrong-key"), deps);
    expect(res.status).toBe(401);
    expect(deps.uploadObject).not.toHaveBeenCalled();
    expect(deps.ingest).not.toHaveBeenCalled();
  });

  it("answers 406 for unknown recipients so Mailgun does not retry", async () => {
    const { deps } = fakeDeps();
    const res = await handleMailgunInbound(
      mailgunRequest({ recipient: "onbekend@in.veryo.test" }),
      deps,
    );
    expect(res.status).toBe(406);
    expect(deps.uploadObject).not.toHaveBeenCalled();
  });

  it("propagates storage errors so the request fails and Mailgun retries", async () => {
    const { deps } = fakeDeps({
      uploadObject: vi.fn(async () => Promise.reject(new Error("storage down"))),
    });
    await expect(handleMailgunInbound(mailgunRequest(), deps)).rejects.toThrow("storage down");
    expect(deps.ingest).not.toHaveBeenCalled();
  });

  it("falls back to the delivery token when there is no Message-Id", async () => {
    const { deps, ingested } = fakeDeps();
    await handleMailgunInbound(mailgunRequest({ "Message-Id": "" }), deps);
    expect(ingested[0]!.externalId).toBe("mailgun-token:tok-123");
  });

  it("only accepts POST", async () => {
    const { deps } = fakeDeps();
    expect(
      (await handleMailgunInbound(new Request("https://x.test", { method: "GET" }), deps)).status,
    ).toBe(405);
  });
});
