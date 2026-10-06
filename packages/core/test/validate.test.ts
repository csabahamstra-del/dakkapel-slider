import { describe, expect, it } from "vitest";
import { validateExtraction, validateShiftReport } from "../src/index.js";
import { makeIncident, makeReport, thresholds } from "./helpers.js";

const codes = (r: ReturnType<typeof validateShiftReport>) => r.reasons.map((x) => x.code);

describe("validateShiftReport", () => {
  it("accepts a plausible night shift crossing midnight", () => {
    const result = validateShiftReport(makeReport(), thresholds);
    expect(result.status).toBe("ok");
    expect(result.reasons).toEqual([]);
  });

  it("flags low confidence", () => {
    expect(codes(validateShiftReport(makeReport({ confidence: 0.5 }), thresholds))).toEqual([
      "low_confidence",
    ]);
  });

  it("accepts confidence exactly at the threshold", () => {
    expect(validateShiftReport(makeReport({ confidence: 0.7 }), thresholds).status).toBe("ok");
  });

  it("flags model uncertainties", () => {
    const r = validateShiftReport(
      makeReport({ uncertainties: ["Eindtijd onleesbaar"] }),
      thresholds,
    );
    expect(codes(r)).toEqual(["model_uncertain"]);
  });

  it("flags an unknown site", () => {
    const r = validateShiftReport(makeReport({ site_name: null, site_address: "  " }), thresholds);
    expect(codes(r)).toEqual(["unknown_site"]);
  });

  it("accepts a site known only by address", () => {
    expect(validateShiftReport(makeReport({ site_name: null }), thresholds).status).toBe("ok");
  });

  it("flags missing shift times", () => {
    expect(codes(validateShiftReport(makeReport({ shift_end: null }), thresholds))).toEqual([
      "missing_shift_time",
    ]);
  });

  it("flags end before start", () => {
    const r = validateShiftReport(makeReport({ shift_end: "2026-03-12T06:00" }), thresholds);
    expect(codes(r)).toEqual(["shift_end_before_start"]);
  });

  it("flags zero-length shifts", () => {
    const r = validateShiftReport(makeReport({ shift_end: "2026-03-12T22:00" }), thresholds);
    expect(codes(r)).toEqual(["shift_end_before_start"]);
  });

  it("allows exactly 16 hours but flags longer shifts", () => {
    expect(
      validateShiftReport(makeReport({ shift_end: "2026-03-13T14:00" }), thresholds).status,
    ).toBe("ok");
    const r = validateShiftReport(makeReport({ shift_end: "2026-03-13T14:01" }), thresholds);
    expect(codes(r)).toEqual(["shift_too_long"]);
  });

  it("flags arrival before report with the incident index", () => {
    const r = validateShiftReport(
      makeReport({
        incidents: [
          makeIncident(),
          makeIncident({ reported_at: "2026-03-13T02:00", arrived_at: "2026-03-13T01:50" }),
        ],
      }),
      thresholds,
    );
    expect(r.reasons).toHaveLength(1);
    expect(r.reasons[0]).toMatchObject({ code: "arrival_before_report", incidentIndex: 1 });
  });

  it("does not flag incidents with missing times", () => {
    const r = validateShiftReport(
      makeReport({ incidents: [makeIncident({ arrived_at: null })] }),
      thresholds,
    );
    expect(r.status).toBe("ok");
  });

  it("collects multiple reasons", () => {
    const r = validateShiftReport(
      makeReport({ confidence: 0.1, site_name: null, site_address: null, shift_start: null }),
      thresholds,
    );
    expect(codes(r)).toEqual(["low_confidence", "unknown_site", "missing_shift_time"]);
  });
});

describe("validateExtraction", () => {
  it("is ok when all reports are ok", () => {
    const r = validateExtraction(
      { is_shift_report: true, reports: [makeReport(), makeReport()] },
      thresholds,
    );
    expect(r.status).toBe("ok");
  });

  it("needs review when any report needs review", () => {
    const r = validateExtraction(
      { is_shift_report: true, reports: [makeReport(), makeReport({ confidence: 0 })] },
      thresholds,
    );
    expect(r.status).toBe("needs_review");
    expect(r.reports.map((x) => x.status)).toEqual(["ok", "needs_review"]);
  });

  it("needs review for documents that are not shift reports", () => {
    const r = validateExtraction({ is_shift_report: false, reports: [] }, thresholds);
    expect(r.reasons.map((x) => x.code)).toEqual(["not_a_shift_report"]);
  });

  it("needs review when no reports were found", () => {
    const r = validateExtraction({ is_shift_report: true, reports: [] }, thresholds);
    expect(r.reasons.map((x) => x.code)).toEqual(["no_reports_found"]);
  });
});
