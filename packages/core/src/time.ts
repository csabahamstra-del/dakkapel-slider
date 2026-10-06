import { LOCAL_DATETIME_REGEX } from "./schema.js";

/**
 * Parses a local "YYYY-MM-DDTHH:mm" string into minutes since epoch, treating it as a naive
 * wall-clock time. Good enough for ordering and durations; a DST switch inside a shift can make
 * a duration off by one hour.
 */
export function localToMinutes(value: string): number | null {
  if (!LOCAL_DATETIME_REGEX.test(value)) return null;
  const ms = Date.parse(`${value}:00Z`);
  // Reject impossible dates such as 2026-02-30 that some engines silently roll over.
  if (Number.isNaN(ms) || new Date(ms).toISOString().slice(0, 16) !== value) return null;
  return ms / 60_000;
}

/** Difference b - a in minutes, or null when either value is missing or invalid. */
export function diffMinutes(a: string | null, b: string | null): number | null {
  if (a === null || b === null) return null;
  const ma = localToMinutes(a);
  const mb = localToMinutes(b);
  return ma === null || mb === null ? null : mb - ma;
}
