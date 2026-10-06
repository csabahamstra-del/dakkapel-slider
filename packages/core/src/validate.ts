import type { CoreConfig } from "./config.js";
import type { ExtractionOutput, ShiftReport } from "./schema.js";
import { diffMinutes } from "./time.js";

export type ReportStatus = "ok" | "needs_review";

export type ReviewReasonCode =
  | "low_confidence"
  | "model_uncertain"
  | "unknown_site"
  | "missing_shift_time"
  | "shift_end_before_start"
  | "shift_too_long"
  | "arrival_before_report"
  | "not_a_shift_report"
  | "no_reports_found"
  | "unsupported_input"
  | "extraction_failed";

export interface ReviewReason {
  code: ReviewReasonCode;
  /** Dutch explanation for the planner in the review queue. */
  message: string;
  /** Index of the incident the reason applies to, if any. */
  incidentIndex?: number;
}

export interface ValidatedReport {
  report: ShiftReport;
  status: ReportStatus;
  reasons: ReviewReason[];
}

type Thresholds = Pick<CoreConfig, "minConfidence" | "maxShiftHours">;

/**
 * Plausibility checks done in code, never by the model (hard rules 1 and 8).
 * Any reason means the report goes to the review queue.
 */
export function validateShiftReport(report: ShiftReport, cfg: Thresholds): ValidatedReport {
  const reasons: ReviewReason[] = [];

  if (report.confidence < cfg.minConfidence) {
    reasons.push({
      code: "low_confidence",
      message: `Extractie-zekerheid ${report.confidence.toFixed(2)} is lager dan ${cfg.minConfidence}.`,
    });
  }

  if (report.uncertainties.length > 0) {
    reasons.push({
      code: "model_uncertain",
      message: `Onduidelijkheden in de bron: ${report.uncertainties.join("; ")}`,
    });
  }

  if (!report.site_name?.trim() && !report.site_address?.trim()) {
    reasons.push({ code: "unknown_site", message: "Object (naam of adres) ontbreekt." });
  }

  if (report.shift_start === null || report.shift_end === null) {
    reasons.push({
      code: "missing_shift_time",
      message: "Begin- of eindtijd van de dienst ontbreekt.",
    });
  } else {
    const duration = diffMinutes(report.shift_start, report.shift_end);
    if (duration === null || duration <= 0) {
      reasons.push({
        code: "shift_end_before_start",
        message: `Eindtijd (${report.shift_end}) ligt niet na begintijd (${report.shift_start}).`,
      });
    } else if (duration > cfg.maxShiftHours * 60) {
      reasons.push({
        code: "shift_too_long",
        message: `Dienst duurt ${(duration / 60).toFixed(1)} uur, langer dan ${cfg.maxShiftHours} uur.`,
      });
    }
  }

  report.incidents.forEach((incident, index) => {
    const response = diffMinutes(incident.reported_at, incident.arrived_at);
    if (response !== null && response < 0) {
      reasons.push({
        code: "arrival_before_report",
        message: `Incident ${index + 1}: aankomst (${incident.arrived_at}) ligt vóór melding (${incident.reported_at}).`,
        incidentIndex: index,
      });
    }
  });

  return { report, status: reasons.length > 0 ? "needs_review" : "ok", reasons };
}

export interface ValidatedExtraction {
  /** Overall status: needs_review if the document or any report needs review. */
  status: ReportStatus;
  /** Document-level reasons (e.g. not a shift report). */
  reasons: ReviewReason[];
  reports: ValidatedReport[];
}

export function validateExtraction(output: ExtractionOutput, cfg: Thresholds): ValidatedExtraction {
  const reasons: ReviewReason[] = [];
  if (!output.is_shift_report) {
    reasons.push({
      code: "not_a_shift_report",
      message: "Document lijkt geen dienstrapport te zijn.",
    });
  } else if (output.reports.length === 0) {
    reasons.push({
      code: "no_reports_found",
      message: "Geen dienstrapport gevonden in het document.",
    });
  }
  const reports = output.reports.map((r) => validateShiftReport(r, cfg));
  const status =
    reasons.length > 0 || reports.some((r) => r.status === "needs_review") ? "needs_review" : "ok";
  return { status, reasons, reports };
}
