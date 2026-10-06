import { diffMinutes, type ExtractionOutput, type Incident, type ShiftReport } from "@veryo/core";

export const SHIFT_TIME_TOLERANCE_MIN = 15;
export const INCIDENT_TIME_TOLERANCE_MIN = 5;
/** Incidents are paired when the category matches or the report time is this close. */
export const INCIDENT_PAIR_WINDOW_MIN = 30;

export interface FieldScore {
  correct: number;
  total: number;
}

export interface Mismatch {
  field: string;
  expected: unknown;
  actual: unknown;
}

export interface SampleScore {
  fields: Record<string, FieldScore>;
  mismatches: Mismatch[];
  piiLeaks: string[];
}

export function normalizeText(value: string): string {
  return value
    .toLowerCase()
    .normalize("NFD")
    .replace(/[̀-ͯ]/g, "")
    .replace(/[^a-z0-9]+/g, " ")
    .trim();
}

/** Lenient text match: equal after normalisation, or one contains the other. */
export function textMatches(expected: string | null, actual: string | null): boolean {
  if (expected === null || actual === null) return expected === actual;
  const e = normalizeText(expected);
  const a = normalizeText(actual);
  if (e === "" || a === "") return e === a;
  return e === a || e.includes(a) || a.includes(e);
}

export function timeMatches(
  expected: string | null,
  actual: string | null,
  toleranceMin: number,
): boolean {
  if (expected === null || actual === null) return expected === actual;
  const diff = diffMinutes(expected, actual);
  return diff !== null && Math.abs(diff) <= toleranceMin;
}

/** Returns the PII terms that occur in the output (case-insensitive, whole words). */
export function findPiiLeaks(output: unknown, piiTerms: string[]): string[] {
  const haystack = normalizeText(JSON.stringify(output ?? ""));
  return piiTerms.filter((term) => {
    const needle = normalizeText(term);
    return needle.length >= 3 && ` ${haystack} `.includes(` ${needle} `);
  });
}

/** Orders reports by start time, then site, so expected and actual line up deterministically. */
const byStart = (a: ShiftReport, b: ShiftReport) =>
  (a.shift_start ?? "9999").localeCompare(b.shift_start ?? "9999") ||
  normalizeText(a.site_name ?? a.site_address ?? "").localeCompare(
    normalizeText(b.site_name ?? b.site_address ?? ""),
  );

/**
 * Greedy pairing of expected and actual incidents. Pairs need the same category or report times
 * within INCIDENT_PAIR_WINDOW_MIN; unpaired incidents count as missed or spurious.
 */
export function pairIncidents(
  expected: Incident[],
  actual: Incident[],
): Array<[Incident, Incident]> {
  const pairs: Array<[Incident, Incident]> = [];
  const free = new Set(actual.map((_, i) => i));
  for (const exp of expected) {
    let best: { index: number; cost: number } | null = null;
    for (const i of free) {
      const act = actual[i]!;
      const diff = diffMinutes(exp.reported_at, act.reported_at);
      const timeClose = diff !== null && Math.abs(diff) <= INCIDENT_PAIR_WINDOW_MIN;
      const sameCategory = exp.category === act.category;
      if (!sameCategory && !timeClose) continue;
      const cost = (sameCategory ? 0 : 1000) + (diff === null ? 500 : Math.abs(diff));
      if (!best || cost < best.cost) best = { index: i, cost };
    }
    if (best) {
      free.delete(best.index);
      pairs.push([exp, actual[best.index]!]);
    }
  }
  return pairs;
}

export interface ScoreInput {
  expected: ExtractionOutput;
  expectedStatus: "ok" | "needs_review";
  actual: ExtractionOutput | null;
  actualStatus: "ok" | "needs_review";
  piiTerms: string[];
}

export function scoreSample({
  expected,
  expectedStatus,
  actual,
  actualStatus,
  piiTerms,
}: ScoreInput): SampleScore {
  const fields: Record<string, FieldScore> = {};
  const mismatches: Mismatch[] = [];
  const check = (field: string, ok: boolean, exp: unknown, act: unknown) => {
    const f = (fields[field] ??= { correct: 0, total: 0 });
    f.total++;
    if (ok) f.correct++;
    else mismatches.push({ field, expected: exp, actual: act });
  };

  check("status", expectedStatus === actualStatus, expectedStatus, actualStatus);

  if (actual === null) {
    check("extraction_succeeded", false, true, false);
    return { fields, mismatches, piiLeaks: [] };
  }
  check("extraction_succeeded", true, true, true);
  check(
    "is_shift_report",
    expected.is_shift_report === actual.is_shift_report,
    expected.is_shift_report,
    actual.is_shift_report,
  );
  check(
    "report_count",
    expected.reports.length === actual.reports.length,
    expected.reports.length,
    actual.reports.length,
  );

  const exp = [...expected.reports].sort(byStart);
  const act = [...actual.reports].sort(byStart);
  exp.forEach((e, i) => {
    const a = act[i];
    const p = `report[${i}]`;
    if (!a) {
      check("report_found", false, e.shift_start, null);
      return;
    }
    check("report_found", true, null, null);
    check("site_name", textMatches(e.site_name, a.site_name), e.site_name, a.site_name);
    check(
      "site_address",
      textMatches(e.site_address, a.site_address),
      e.site_address,
      a.site_address,
    );
    check(
      "shift_start",
      timeMatches(e.shift_start, a.shift_start, SHIFT_TIME_TOLERANCE_MIN),
      e.shift_start,
      a.shift_start,
    );
    check(
      "shift_end",
      timeMatches(e.shift_end, a.shift_end, SHIFT_TIME_TOLERANCE_MIN),
      e.shift_end,
      a.shift_end,
    );
    check("shift_type", e.shift_type === a.shift_type, e.shift_type, a.shift_type);
    check(
      "guard_count",
      e.guard_refs.length === a.guard_refs.length,
      e.guard_refs.length,
      a.guard_refs.length,
    );
    check(
      "incident_count",
      e.incidents.length === a.incidents.length,
      e.incidents.length,
      a.incidents.length,
    );

    const pairs = pairIncidents(e.incidents, a.incidents);
    // Recall: expected incidents that were found. Precision: found incidents that were expected.
    for (let k = 0; k < e.incidents.length; k++)
      check(
        "incident_recall",
        k < pairs.length,
        `${p} incident`,
        k < pairs.length ? "gevonden" : "gemist",
      );
    for (let k = 0; k < a.incidents.length; k++)
      check(
        "incident_precision",
        k < pairs.length,
        `${p} incident`,
        k < pairs.length ? "verwacht" : "onterecht",
      );
    for (const [ei, ai] of pairs) {
      check("incident_category", ei.category === ai.category, ei.category, ai.category);
      check("incident_severity", ei.severity === ai.severity, ei.severity, ai.severity);
      check(
        "incident_reported_at",
        timeMatches(ei.reported_at, ai.reported_at, INCIDENT_TIME_TOLERANCE_MIN),
        ei.reported_at,
        ai.reported_at,
      );
      check(
        "incident_arrived_at",
        timeMatches(ei.arrived_at, ai.arrived_at, INCIDENT_TIME_TOLERANCE_MIN),
        ei.arrived_at,
        ai.arrived_at,
      );
    }
  });

  const piiLeaks = findPiiLeaks(actual, piiTerms);
  check("no_pii_leak", piiLeaks.length === 0, [], piiLeaks);

  return { fields, mismatches, piiLeaks };
}

export function mergeScores(scores: Array<Record<string, FieldScore>>): Record<string, FieldScore> {
  const total: Record<string, FieldScore> = {};
  for (const s of scores) {
    for (const [field, { correct, total: n }] of Object.entries(s)) {
      const f = (total[field] ??= { correct: 0, total: 0 });
      f.correct += correct;
      f.total += n;
    }
  }
  return total;
}
