/**
 * Mailgun inbound webhook handling, independent of Supabase so it runs (and is tested) in both
 * Deno and Node. Uses only Web APIs: Request/Response, FormData, Web Crypto.
 *
 * Mailgun route action: forward("https://<project>.supabase.co/functions/v1/inbound-email")
 * Response codes follow Mailgun's route semantics: 200 = accepted, 406 = reject without retry,
 * anything else = Mailgun retries later.
 */

export interface StoredAttachment {
  filename: string;
  content_type: string;
  size: number;
  storage_path: string;
}

export interface IngestParams {
  organizationId: string;
  externalId: string;
  sender: string | null;
  recipient: string;
  subject: string | null;
  receivedAt: string | null;
  rawStoragePath: string;
  bodyTextStoragePath: string | null;
  attachments: StoredAttachment[];
}

export interface InboundDeps {
  signingKey: string;
  /** Domain of the inbound addresses, e.g. "in.veryo.nl". */
  inboundDomain: string;
  findOrganizationByAlias(alias: string): Promise<string | null>;
  /** Must not overwrite: resolves "exists" when the object is already there. */
  uploadObject(path: string, data: Uint8Array, contentType: string): Promise<"created" | "exists">;
  ingest(params: IngestParams): Promise<{ inboundMessageId: string; duplicate: boolean }>;
  log?(event: string, details: Record<string, unknown>): void;
}

const encoder = new TextEncoder();

function toHex(buffer: ArrayBuffer): string {
  return [...new Uint8Array(buffer)].map((b) => b.toString(16).padStart(2, "0")).join("");
}

function timingSafeEqual(a: string, b: string): boolean {
  if (a.length !== b.length) return false;
  let diff = 0;
  for (let i = 0; i < a.length; i++) diff |= a.charCodeAt(i) ^ b.charCodeAt(i);
  return diff === 0;
}

/** Mailgun signs timestamp + token with HMAC-SHA256 using the webhook signing key. */
export async function verifyMailgunSignature(
  signingKey: string,
  timestamp: string,
  token: string,
  signature: string,
): Promise<boolean> {
  if (!signingKey || !timestamp || !token || !signature) return false;
  const key = await crypto.subtle.importKey(
    "raw",
    encoder.encode(signingKey),
    { name: "HMAC", hash: "SHA-256" },
    false,
    ["sign"],
  );
  const expected = toHex(await crypto.subtle.sign("HMAC", key, encoder.encode(timestamp + token)));
  return timingSafeEqual(expected, signature.toLowerCase());
}

export async function sha256Hex(value: string): Promise<string> {
  return toHex(await crypto.subtle.digest("SHA-256", encoder.encode(value)));
}

/**
 * Finds the organization alias among the recipients: "<alias>@<domain>" or "<alias>+tag@<domain>".
 * Returns null when no recipient is on the inbound domain.
 */
export function parseInboundAlias(recipients: string, inboundDomain: string): string | null {
  const domain = inboundDomain.toLowerCase();
  for (const raw of recipients.split(",")) {
    const address = (raw.match(/<([^>]+)>/)?.[1] ?? raw).trim().toLowerCase();
    const at = address.lastIndexOf("@");
    if (at < 1 || address.slice(at + 1) !== domain) continue;
    const alias = address.slice(0, at).split("+")[0]!;
    if (/^[a-z0-9][a-z0-9-]{2,62}$/.test(alias)) return alias;
  }
  return null;
}

/** Keeps file names readable but safe as storage keys. */
export function safeFilename(name: string): string {
  const cleaned = name
    .normalize("NFKD")
    .replace(/[̀-ͯ]/g, "")
    .replace(/[^A-Za-z0-9._-]+/g, "_")
    .replace(/^[._]+/, "")
    .slice(-120);
  return cleaned || "bijlage";
}

const text = (form: FormData, key: string): string | null => {
  const value = form.get(key);
  return typeof value === "string" && value !== "" ? value : null;
};

const json = (status: number, body: Record<string, unknown>) =>
  new Response(JSON.stringify(body), { status, headers: { "content-type": "application/json" } });

export async function handleMailgunInbound(req: Request, deps: InboundDeps): Promise<Response> {
  const log = deps.log ?? (() => undefined);
  if (req.method !== "POST") return json(405, { error: "method_not_allowed" });

  let form: FormData;
  try {
    form = await req.formData();
  } catch {
    return json(400, { error: "invalid_body" });
  }

  const valid = await verifyMailgunSignature(
    deps.signingKey,
    text(form, "timestamp") ?? "",
    text(form, "token") ?? "",
    text(form, "signature") ?? "",
  );
  if (!valid) {
    log("inbound.invalid_signature", {});
    return json(401, { error: "invalid_signature" });
  }

  const recipient = text(form, "recipient") ?? "";
  const alias = parseInboundAlias(recipient, deps.inboundDomain);
  const organizationId = alias ? await deps.findOrganizationByAlias(alias) : null;
  if (!organizationId) {
    // 406: Mailgun will not retry an address we do not know.
    log("inbound.unknown_recipient", { recipient });
    return json(406, { error: "unknown_recipient" });
  }

  // Without a Message-Id we cannot de-duplicate; fall back to the signed token (unique per delivery).
  const messageId = text(form, "Message-Id") ?? text(form, "message-id");
  const externalId = messageId ?? `mailgun-token:${text(form, "token")}`;
  const key = (await sha256Hex(externalId)).slice(0, 32);
  const base = `${organizationId}/${key}`;

  // Everything Mailgun posted except files and the signature fields, unchanged.
  const fields: Record<string, string> = {};
  const files: Array<[string, File]> = [];
  for (const [name, value] of form.entries()) {
    if (typeof value === "string") {
      if (!["signature", "token", "timestamp"].includes(name)) fields[name] = value;
    } else {
      files.push([name, value]);
    }
  }

  const rawStoragePath = `${base}/message.json`;
  await deps.uploadObject(
    rawStoragePath,
    encoder.encode(JSON.stringify(fields, null, 2)),
    "application/json",
  );

  const bodyPlain = text(form, "body-plain");
  const bodyTextStoragePath = bodyPlain ? `${base}/body.txt` : null;
  if (bodyPlain && bodyTextStoragePath) {
    await deps.uploadObject(
      bodyTextStoragePath,
      encoder.encode(bodyPlain),
      "text/plain; charset=utf-8",
    );
  }

  const attachments: StoredAttachment[] = [];
  // Mailgun names file fields attachment-1..N; keep that order.
  files.sort(([a], [b]) => a.localeCompare(b, undefined, { numeric: true }));
  for (const [index, [, file]] of files.entries()) {
    const filename = file.name || `bijlage-${index + 1}`;
    const storagePath = `${base}/attachments/${index + 1}-${safeFilename(filename)}`;
    const contentType = file.type || "application/octet-stream";
    await deps.uploadObject(storagePath, new Uint8Array(await file.arrayBuffer()), contentType);
    attachments.push({
      filename,
      content_type: contentType,
      size: file.size,
      storage_path: storagePath,
    });
  }

  const timestamp = Number(text(form, "timestamp"));
  const result = await deps.ingest({
    organizationId,
    externalId,
    sender: text(form, "sender") ?? text(form, "from"),
    recipient,
    subject: text(form, "subject"),
    receivedAt:
      Number.isFinite(timestamp) && timestamp > 0 ? new Date(timestamp * 1000).toISOString() : null,
    rawStoragePath,
    bodyTextStoragePath,
    attachments,
  });

  log(result.duplicate ? "inbound.duplicate" : "inbound.accepted", {
    organizationId,
    inboundMessageId: result.inboundMessageId,
    attachments: attachments.length,
  });
  return json(200, { inbound_message_id: result.inboundMessageId, duplicate: result.duplicate });
}
