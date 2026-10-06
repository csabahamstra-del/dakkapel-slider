import type { ExtractionOutput, Incident } from "@veryo/core";
import { describe, expect, it } from "vitest";
import {
  findPiiLeaks,
  mergeScores,
  pairIncidents,
  scoreSample,
  textMatches,
  timeMatches,
} from "../src/score.js";

const incident = (o: Partial<Incident>): Incident => ({
  category: "other",
  reported_at: null,
  arrived_at: null,
  severity: "low",
  summary: "",
  involved_roles: [],
  ...o,
});

const output = (incidents: Incident[], o: Record<string, unknown> = {}): ExtractionOutput => ({
  is_shift_report: true,
  reports: [
    {
      site_name: "Distributiecentrum Noord",
      site_address: "Industrieweg 12, Zwolle",
      client_name: null,
      shift_start: "2026-03-12T22:00",
      shift_end: "2026-03-13T06:00",
      shift_type: "static_guarding",
      guard_refs: ["4471"],
      summary: "",
      remarks: [],
      incidents,
      confidence: 0.9,
      uncertainties: [],
      ...o,
    },
  ],
});

describe("textMatches", () => {
  it("ignores case, punctuation and accents", () => {
    expect(textMatches("Sportpark Het Veld", "sportpark het veld.")).toBe(true);
    expect(textMatches("Café De Hoek", "Cafe de Hoek")).toBe(true);
  });
  it("accepts containment", () => {
    expect(textMatches("Industrieweg 12, 8025 AB Zwolle", "Industrieweg 12")).toBe(true);
  });
  it("handles nulls", () => {
    expect(textMatches(null, null)).toBe(true);
    expect(textMatches("x", null)).toBe(false);
  });
});

describe("timeMatches", () => {
  it("uses the tolerance", () => {
    expect(timeMatches("2026-03-12T22:00", "2026-03-12T22:15", 15)).toBe(true);
    expect(timeMatches("2026-03-12T22:00", "2026-03-12T22:16", 15)).toBe(false);
    expect(timeMatches(null, "2026-03-12T22:00", 15)).toBe(false);
  });
});

describe("findPiiLeaks", () => {
  it("finds whole-word names case-insensitively", () => {
    const leaks = findPiiLeaks({ summary: "Beveiliger JAN de vries deed de ronde" }, [
      "Jan de Vries",
      "Bakker",
    ]);
    expect(leaks).toEqual(["Jan de Vries"]);
  });
  it("does not match inside other words or very short terms", () => {
    expect(findPiiLeaks({ s: "Januari, bakkerij" }, ["Jan", "Bakker", "M."])).toEqual([]);
  });
});

describe("pairIncidents", () => {
  it("pairs by category and closest time", () => {
    const exp = [
      incident({ category: "fire", reported_at: "2026-03-12T23:00" }),
      incident({ category: "nuisance", reported_at: "2026-03-13T01:00" }),
    ];
    const act = [
      incident({ category: "nuisance", reported_at: "2026-03-13T01:02" }),
      incident({ category: "fire", reported_at: "2026-03-12T23:01" }),
    ];
    expect(pairIncidents(exp, act)).toEqual([
      [exp[0], act[1]],
      [exp[1], act[0]],
    ]);
  });
  it("pairs different categories when the time is close (category error)", () => {
    const exp = [incident({ category: "fire", reported_at: "2026-03-12T23:00" })];
    const act = [incident({ category: "alarm_response", reported_at: "2026-03-12T23:10" })];
    expect(pairIncidents(exp, act)).toHaveLength(1);
  });
  it("does not pair unrelated incidents", () => {
    const exp = [incident({ category: "fire", reported_at: "2026-03-12T23:00" })];
    const act = [incident({ category: "medical", reported_at: "2026-03-13T03:00" })];
    expect(pairIncidents(exp, act)).toEqual([]);
  });
});

describe("scoreSample", () => {
  const alarm = incident({
    category: "alarm_response",
    reported_at: "2026-03-13T01:42",
    arrived_at: "2026-03-13T01:51",
  });

  it("scores a perfect extraction as all correct", () => {
    const s = scoreSample({
      expected: output([alarm]),
      expectedStatus: "ok",
      actual: output([alarm]),
      actualStatus: "ok",
      piiTerms: ["Jan"],
    });
    expect(s.mismatches).toEqual([]);
    expect(Object.values(s.fields).every((f) => f.correct === f.total)).toBe(true);
  });

  it("reports missed and spurious incidents", () => {
    const extra = incident({ category: "medical", reported_at: "2026-03-13T04:00" });
    const s = scoreSample({
      expected: output([alarm]),
      expectedStatus: "ok",
      actual: output([extra]),
      actualStatus: "ok",
      piiTerms: [],
    });
    expect(s.fields.incident_recall).toEqual({ correct: 0, total: 1 });
    expect(s.fields.incident_precision).toEqual({ correct: 0, total: 1 });
  });

  it("flags wrong times and PII leaks", () => {
    const actual = output([{ ...alarm, arrived_at: "2026-03-13T02:30" }], {
      summary: "Jan liep de ronde",
    });
    const s = scoreSample({
      expected: output([alarm]),
      expectedStatus: "ok",
      actual,
      actualStatus: "ok",
      piiTerms: ["Jan"],
    });
    expect(s.mismatches.map((m) => m.field)).toEqual(["incident_arrived_at", "no_pii_leak"]);
    expect(s.piiLeaks).toEqual(["Jan"]);
  });

  it("counts a failed extraction", () => {
    const s = scoreSample({
      expected: output([]),
      expectedStatus: "ok",
      actual: null,
      actualStatus: "needs_review",
      piiTerms: [],
    });
    expect(s.fields.extraction_succeeded).toEqual({ correct: 0, total: 1 });
    expect(s.fields.status).toEqual({ correct: 0, total: 1 });
  });
});

describe("mergeScores", () => {
  it("sums per field", () => {
    expect(
      mergeScores([
        { a: { correct: 1, total: 2 } },
        { a: { correct: 1, total: 1 }, b: { correct: 0, total: 1 } },
      ]),
    ).toEqual({
      a: { correct: 2, total: 3 },
      b: { correct: 0, total: 1 },
    });
  });
});
