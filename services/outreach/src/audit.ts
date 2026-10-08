/** Audit log: every action the pipeline takes, with its outcome and the reason. */
import type { Db } from "./db.js";
import type { Logger } from "./log.js";
import { redact } from "./log.js";

export interface AuditEntry {
  action: string;
  subject?: string;
  outcome: "ok" | "blocked" | "skipped" | "error";
  reason?: string;
  details?: Record<string, unknown>;
}

export type Audit = (entry: AuditEntry) => void;

export function createAudit(db: Db, log: Logger, now: () => Date = () => new Date()): Audit {
  const insert = db.prepare(
    "insert into audit_log (at, action, subject, outcome, reason, details) values (?, ?, ?, ?, ?, ?)",
  );
  return (entry) => {
    const details = entry.details ? JSON.stringify(redact(entry.details)) : null;
    insert.run(
      now().toISOString(),
      entry.action,
      entry.subject ?? null,
      entry.outcome,
      entry.reason ?? null,
      details,
    );
    log(`audit.${entry.action}`, {
      subject: entry.subject,
      outcome: entry.outcome,
      reason: entry.reason,
    });
  };
}
