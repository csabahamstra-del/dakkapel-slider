/**
 * Structured JSON logging to stdout. Values under secret-looking keys are masked, so a token
 * passed along by accident never reaches the logs. Mail bodies are never logged; the audit log
 * (SQLite) is the durable record of what happened and why.
 */
export type Logger = (event: string, details?: Record<string, unknown>) => void;

const SECRET_KEY = /token|secret|password|passwd|api[-_]?key|authorization|cookie/i;

export function redact(value: unknown, depth = 0): unknown {
  if (depth > 6 || value === null || typeof value !== "object") return value;
  if (Array.isArray(value)) return value.map((v) => redact(v, depth + 1));
  return Object.fromEntries(
    Object.entries(value).map(([k, v]) => [
      k,
      SECRET_KEY.test(k) ? "[redacted]" : redact(v, depth + 1),
    ]),
  );
}

export function createLogger(write: (line: string) => void = (l) => console.log(l)): Logger {
  return (event, details = {}) =>
    write(
      JSON.stringify({ time: new Date().toISOString(), event, ...(redact(details) as object) }),
    );
}
