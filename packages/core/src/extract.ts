import Anthropic from "@anthropic-ai/sdk";
import { zodOutputFormat } from "@anthropic-ai/sdk/helpers/zod";
import type { CoreConfig } from "./config.js";
import { buildContentBlocks, type ExtractionInput, type SkippedFile } from "./input.js";
import { EXTRACTION_PROMPT_VERSION, EXTRACTION_SYSTEM_PROMPT } from "./prompt.js";
import { ExtractionOutputSchema, type ExtractionOutput } from "./schema.js";
import { validateExtraction, type ReviewReason, type ValidatedExtraction } from "./validate.js";

export const MAX_EXTRACTION_ATTEMPTS = 2;

export interface ExtractionResult {
  model: string;
  promptVersion: string;
  attempts: number;
  /** null when every attempt failed. */
  output: ExtractionOutput | null;
  validation: ValidatedExtraction;
  /** Per-attempt error messages, for the processing_jobs log. */
  errors: string[];
  skippedFiles: SkippedFile[];
  usage: { inputTokens: number; outputTokens: number };
}

export interface ExtractOptions {
  client: Anthropic;
  config: Pick<CoreConfig, "extractionModel" | "minConfidence" | "maxShiftHours">;
  /** Overrides config.extractionModel (used by the eval labeler). */
  model?: string;
  /** Only for models that support effort (not Haiku 4.5). */
  effort?: "low" | "medium" | "high" | "xhigh" | "max";
}

class AttemptError extends Error {}

/**
 * The SDK reports invalid structured output as a plain AnthropicError without its own class,
 * so we recognise it by message. Everything else (auth, config, network) must not be mistaken
 * for a bad model answer.
 */
function isOutputParseError(error: unknown): boolean {
  return (
    error instanceof Anthropic.AnthropicError &&
    !(error instanceof Anthropic.APIError) &&
    error.message.startsWith("Failed to parse structured output")
  );
}

/**
 * Turns one inbound message into validated structured data.
 * Never throws for model/validation problems: those end up as `needs_review` (hard rules 7 and 8).
 * API errors that are not transient (auth, bad request) are rethrown so the job can be retried later.
 */
export async function extractReport(
  input: ExtractionInput,
  { client, config, model = config.extractionModel, effort }: ExtractOptions,
): Promise<ExtractionResult> {
  const { blocks, skipped } = await buildContentBlocks(input);
  const errors: string[] = [];
  const usage = { inputTokens: 0, outputTokens: 0 };
  const thresholds = { minConfidence: config.minConfidence, maxShiftHours: config.maxShiftHours };

  const base = {
    model,
    promptVersion: EXTRACTION_PROMPT_VERSION,
    skippedFiles: skipped,
    usage,
    errors,
  };

  const extraReasons: ReviewReason[] = skipped.map((s) => ({
    code: "unsupported_input",
    message: `${s.filename}: ${s.reason}`,
  }));

  if (blocks.length === 0) {
    return {
      ...base,
      attempts: 0,
      output: null,
      validation: {
        status: "needs_review",
        reasons: [...extraReasons, { code: "no_reports_found", message: "Geen leesbare inhoud." }],
        reports: [],
      },
    };
  }

  let attempts = 0;
  while (attempts < MAX_EXTRACTION_ATTEMPTS) {
    attempts++;
    const content: Anthropic.ContentBlockParam[] = [...blocks];
    if (errors.length > 0) {
      content.push({
        type: "text",
        text: `Een eerdere poging leverde ongeldige output op: ${errors.at(-1)}\nLever de volledige output opnieuw en houd je exact aan het schema.`,
      });
    }

    try {
      const response = await client.messages.parse({
        model,
        max_tokens: 16000,
        system: EXTRACTION_SYSTEM_PROMPT,
        messages: [{ role: "user", content }],
        output_config: {
          format: zodOutputFormat(ExtractionOutputSchema),
          ...(effort ? { effort } : {}),
        },
      });
      usage.inputTokens += response.usage.input_tokens;
      usage.outputTokens += response.usage.output_tokens;

      if (response.stop_reason === "refusal") {
        throw new AttemptError(
          `Model weigerde (${response.stop_details?.category ?? "onbekend"}).`,
        );
      }
      if (response.stop_reason === "max_tokens") {
        throw new AttemptError("Output afgekapt (max_tokens bereikt).");
      }
      // Re-validate explicitly: the SDK helper validates too, but we never trust output unchecked.
      const parsed = ExtractionOutputSchema.safeParse(response.parsed_output);
      if (!parsed.success) {
        throw new AttemptError(`Schemavalidatie mislukt: ${parsed.error.message}`);
      }

      const validation = validateExtraction(parsed.data, thresholds);
      if (extraReasons.length > 0) {
        validation.reasons.unshift(...extraReasons);
        validation.status = "needs_review";
      }
      return { ...base, attempts, output: parsed.data, validation };
    } catch (error) {
      // Only bad model output is retried here. API, auth and config errors are rethrown: the SDK
      // already retried transient ones, and the job queue decides whether to try again later.
      if (!(error instanceof AttemptError) && !isOutputParseError(error)) throw error;
      errors.push((error as Error).message);
    }
  }

  return {
    ...base,
    attempts,
    output: null,
    validation: {
      status: "needs_review",
      reasons: [
        ...extraReasons,
        {
          code: "extraction_failed",
          message: `Extractie mislukt na ${attempts} pogingen: ${errors.at(-1) ?? "onbekende fout"}`,
        },
      ],
      reports: [],
    },
  };
}
