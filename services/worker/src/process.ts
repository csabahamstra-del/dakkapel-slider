import type { ExtractionInput, ExtractionResult, InputFile, ReviewReason } from "@veryo/core";

export interface Job {
  id: string;
  organization_id: string;
  inbound_message_id: string;
  attempts: number;
  max_attempts: number;
}

export interface InboundMessage {
  id: string;
  organization_id: string;
  subject: string | null;
  received_at: string;
  body_text_storage_path: string | null;
  attachments: Array<{ filename: string; content_type: string; storage_path: string }>;
}

export interface WorkerDeps {
  workerId: string;
  getMessage(id: string): Promise<InboundMessage>;
  download(path: string): Promise<Uint8Array>;
  extract(input: ExtractionInput): Promise<ExtractionResult>;
  complete(jobId: string, payload: CompletionPayload): Promise<void>;
  fail(jobId: string, error: string, retryable: boolean): Promise<string>;
  log(event: string, details: Record<string, unknown>): void;
}

/** Shape expected by public.complete_processing_job (see the 2c migration). */
export interface CompletionPayload {
  status: "ok" | "needs_review";
  reasons: ReviewReason[];
  model: string;
  prompt_version: string;
  attempts: number;
  errors: string[];
  skipped_files: ExtractionResult["skippedFiles"];
  usage: ExtractionResult["usage"];
  reports: Array<Record<string, unknown>>;
}

/** Supabase/PostgREST errors are plain objects, not Error instances. */
export function errorMessage(error: unknown): string {
  if (error instanceof Error) return error.message;
  if (error && typeof error === "object") {
    const e = error as { message?: unknown; code?: unknown; details?: unknown };
    if (e.message !== undefined) {
      return [
        e.code ? `[${String(e.code)}]` : null,
        String(e.message),
        e.details ? `(${String(e.details)})` : null,
      ]
        .filter(Boolean)
        .join(" ")
        .slice(0, 1000);
    }
    return JSON.stringify(error);
  }
  return String(error);
}

const SITE_NOT_MATCHED: ReviewReason = {
  code: "site_not_matched",
  message: "Object nog niet gekoppeld aan een bekend object van deze klant.",
};

/** Rebuilds the extraction input from the stored originals. */
export async function loadInput(
  message: InboundMessage,
  download: WorkerDeps["download"],
): Promise<ExtractionInput> {
  const files: InputFile[] = [];
  for (const a of message.attachments) {
    files.push({
      filename: a.filename,
      mimeType: a.content_type,
      data: await download(a.storage_path),
    });
  }
  const bodyText = message.body_text_storage_path
    ? new TextDecoder().decode(await download(message.body_text_storage_path))
    : undefined;
  return {
    subject: message.subject ?? undefined,
    bodyText,
    receivedAt: message.received_at,
    files,
  };
}

/**
 * Converts an extraction result into the database payload. Site matching (phase 2d) is not there
 * yet, so every report stays in review until a person links it to a site.
 */
export function toCompletionPayload(result: ExtractionResult): CompletionPayload {
  const reports = result.validation.reports.map(({ report, reasons }) => ({
    site_id: null,
    site_name_raw: report.site_name,
    site_address_raw: report.site_address,
    client_name_raw: report.client_name,
    shift_start_local: report.shift_start,
    shift_end_local: report.shift_end,
    shift_type: report.shift_type,
    guard_refs: report.guard_refs,
    summary: report.summary,
    remarks: report.remarks,
    confidence: report.confidence,
    uncertainties: report.uncertainties,
    status: "needs_review",
    review_reasons: [...reasons, SITE_NOT_MATCHED],
    incidents: report.incidents.map((i) => ({
      category_code: i.category,
      reported_at_local: i.reported_at,
      arrived_at_local: i.arrived_at,
      severity: i.severity,
      summary: i.summary,
      involved_roles: i.involved_roles,
    })),
  }));

  return {
    status: reports.length > 0 ? "needs_review" : result.validation.status,
    reasons: result.validation.reasons,
    model: result.model,
    prompt_version: result.promptVersion,
    attempts: result.attempts,
    errors: result.errors,
    skipped_files: result.skippedFiles,
    usage: result.usage,
    reports,
  };
}

/**
 * Processes one claimed job. Model and validation problems are not errors: they end in
 * needs_review via the payload. Thrown errors (storage, API, database) are retried by the queue.
 */
export async function processJob(
  job: Job,
  deps: WorkerDeps,
): Promise<"completed" | "retry" | "failed"> {
  const started = Date.now();
  try {
    const message = await deps.getMessage(job.inbound_message_id);
    const input = await loadInput(message, deps.download);
    const result = await deps.extract(input);
    const payload = toCompletionPayload(result);
    await deps.complete(job.id, payload);
    deps.log("job.completed", {
      jobId: job.id,
      organizationId: job.organization_id,
      status: payload.status,
      reports: payload.reports.length,
      inputTokens: payload.usage.inputTokens,
      outputTokens: payload.usage.outputTokens,
      ms: Date.now() - started,
    });
    return "completed";
  } catch (error) {
    const message = errorMessage(error);
    const status = await deps.fail(job.id, message, true);
    deps.log("job.failed", {
      jobId: job.id,
      organizationId: job.organization_id,
      attempt: job.attempts,
      next: status,
      error: message,
    });
    return status === "queued" ? "retry" : "failed";
  }
}
