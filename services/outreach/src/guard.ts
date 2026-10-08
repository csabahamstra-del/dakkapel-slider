/**
 * Send guard: the last check before any mail is sent or drafted. It fails closed — when in
 * doubt, nothing goes out. Lead status, thread replies and the send window are checked by the
 * sequence step (phase 4); this guard covers the rules that hold for every mail.
 */
import type { OutreachConfig } from "./config.js";
import { getState, type Db } from "./db.js";
import { isFreemail, normalizeEmail } from "./email.js";
import { findSuppression } from "./suppression.js";
import { startOfLocalDay } from "./time.js";

export const SUPPRESSION_SYNCED_AT = "suppression_synced_at";

export interface SendRequest {
  to: string;
  /** First mail to this lead: counts towards the weekly new-lead limit. */
  isFirstContact: boolean;
  now?: Date;
}

export type GuardResult = { allowed: true } | { allowed: false; reasons: string[] };

type GuardConfig = Pick<
  OutreachConfig,
  "paused" | "maxEmailsPerDay" | "maxNewLeadsPerWeek" | "timeZone" | "suppressionMaxAgeMinutes"
>;

export function countOutboundSince(db: Db, since: Date, firstContactOnly = false): number {
  const row = db
    .prepare(
      `select count(*) as n from outbound_messages
       where created_at >= ? ${firstContactOnly ? "and is_first_contact = 1" : ""}`,
    )
    .get(since.toISOString()) as { n: number };
  return row.n;
}

export function checkSend(db: Db, config: GuardConfig, request: SendRequest): GuardResult {
  const now = request.now ?? new Date();
  const reasons: string[] = [];

  if (config.paused) reasons.push("pipeline staat op pauze (OUTREACH_PAUSED)");

  const email = normalizeEmail(request.to);
  if (!email) {
    reasons.push(`ongeldig e-mailadres: ${request.to}`);
  } else {
    if (isFreemail(email)) reasons.push("geen zakelijk adres (publieke maildienst)");
    const hit = findSuppression(db, email);
    if (hit)
      reasons.push(`op afmeldlijst (${hit.kind === "email" ? "adres" : "domein"} ${hit.value})`);
  }

  const syncedAt = getState(db, SUPPRESSION_SYNCED_AT);
  const ageMinutes = syncedAt ? (now.getTime() - Date.parse(syncedAt)) / 60_000 : Infinity;
  if (!(ageMinutes <= config.suppressionMaxAgeMinutes)) {
    reasons.push(
      syncedAt
        ? `afmeldlijst niet recent gesynchroniseerd met Notion (laatst ${syncedAt})`
        : "afmeldlijst nog nooit gesynchroniseerd met Notion",
    );
  }

  const sentToday = countOutboundSince(db, startOfLocalDay(now, config.timeZone));
  if (sentToday >= config.maxEmailsPerDay) {
    reasons.push(`daglimiet bereikt (${sentToday}/${config.maxEmailsPerDay})`);
  }

  if (request.isFirstContact) {
    const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
    const newLeads = countOutboundSince(db, weekAgo, true);
    if (newLeads >= config.maxNewLeadsPerWeek) {
      reasons.push(
        `limiet nieuwe leads per 7 dagen bereikt (${newLeads}/${config.maxNewLeadsPerWeek})`,
      );
    }
  }

  return reasons.length === 0 ? { allowed: true } : { allowed: false, reasons };
}
