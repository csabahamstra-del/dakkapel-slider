import type Anthropic from "@anthropic-ai/sdk";
import mammoth from "mammoth";

export interface InputFile {
  filename: string;
  /** MIME type as delivered (Mailgun/upload). Falls back to the file extension when missing. */
  mimeType?: string;
  data: Uint8Array;
}

/** One inbound message: a forwarded e-mail or a manual upload. */
export interface ExtractionInput {
  subject?: string;
  bodyText?: string;
  /** ISO timestamp of receipt; used to infer the year when the report omits it. */
  receivedAt?: string;
  files: InputFile[];
}

export interface SkippedFile {
  filename: string;
  reason: string;
}

export type FileKind = "pdf" | "docx" | "doc" | "text" | "unsupported";

const DOCX_MIME = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";

export function detectFileKind(file: Pick<InputFile, "filename" | "mimeType">): FileKind {
  const ext = file.filename.toLowerCase().split(".").pop() ?? "";
  const mime = (file.mimeType ?? "").toLowerCase();
  if (mime === "application/pdf" || ext === "pdf") return "pdf";
  if (mime === DOCX_MIME || ext === "docx") return "docx";
  if (mime === "application/msword" || ext === "doc") return "doc";
  if (mime.startsWith("text/") || ["txt", "md", "csv", "eml"].includes(ext)) return "text";
  return "unsupported";
}

/**
 * Converts an inbound message into Claude content blocks. PDFs go in as document blocks so the
 * model sees the layout; Word files are converted to plain text locally. Files we cannot read are
 * returned in `skipped` so the caller can route the message to review instead of ignoring them.
 */
export async function buildContentBlocks(
  input: ExtractionInput,
): Promise<{ blocks: Anthropic.ContentBlockParam[]; skipped: SkippedFile[] }> {
  const blocks: Anthropic.ContentBlockParam[] = [];
  const skipped: SkippedFile[] = [];

  for (const file of input.files) {
    const kind = detectFileKind(file);
    switch (kind) {
      case "pdf":
        blocks.push({
          type: "document",
          title: file.filename,
          source: {
            type: "base64",
            media_type: "application/pdf",
            data: Buffer.from(file.data).toString("base64"),
          },
        });
        break;
      case "docx": {
        try {
          const { value } = await mammoth.extractRawText({ buffer: Buffer.from(file.data) });
          blocks.push({
            type: "text",
            text: `<bijlage naam="${file.filename}">\n${value.trim()}\n</bijlage>`,
          });
        } catch (error) {
          skipped.push({
            filename: file.filename,
            reason: `Word-bestand onleesbaar: ${String(error)}`,
          });
        }
        break;
      }
      case "text":
        blocks.push({
          type: "text",
          text: `<bijlage naam="${file.filename}">\n${new TextDecoder().decode(file.data).trim()}\n</bijlage>`,
        });
        break;
      case "doc":
        skipped.push({
          filename: file.filename,
          reason: "Oud Word-formaat (.doc) wordt niet ondersteund.",
        });
        break;
      case "unsupported":
        skipped.push({
          filename: file.filename,
          reason: `Bestandstype niet ondersteund (${file.mimeType ?? "onbekend"}).`,
        });
        break;
    }
  }

  const header = [
    input.receivedAt ? `Ontvangen op: ${input.receivedAt}` : null,
    input.subject ? `Onderwerp: ${input.subject}` : null,
  ].filter(Boolean);
  const body = input.bodyText?.trim();
  if (header.length > 0 || body) {
    blocks.push({
      type: "text",
      text: [...header, body ? `<mailtekst>\n${body}\n</mailtekst>` : null]
        .filter(Boolean)
        .join("\n"),
    });
  }

  return { blocks, skipped };
}
