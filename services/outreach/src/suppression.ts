/**
 * Unsubscribe list. An opt-out is processed immediately and permanently: entries are never
 * removed. An email entry blocks that address; a domain entry blocks the domain and its
 * subdomains (the whole company).
 */
import type { Db } from "./db.js";
import {
  domainAndParents,
  domainOf,
  FREEMAIL_DOMAINS,
  normalizeDomain,
  normalizeEmail,
} from "./email.js";

export type SuppressionKind = "email" | "domain";
export type SuppressionSource = "reply" | "manual" | "system" | "notion";

export interface Suppression {
  value: string;
  kind: SuppressionKind;
  reason: string | null;
  source: SuppressionSource;
  createdAt: string;
  notionPageId: string | null;
}

/** Parses an email address or a domain/URL into a suppression value. */
export function parseSuppressionValue(input: string): { value: string; kind: SuppressionKind } {
  if (input.includes("@")) {
    const email = normalizeEmail(input);
    if (!email) throw new Error(`Ongeldig e-mailadres: ${input}`);
    return { value: email, kind: "email" };
  }
  const domain = normalizeDomain(input);
  if (!domain) throw new Error(`Ongeldig domein: ${input}`);
  if (FREEMAIL_DOMAINS.has(domain)) {
    throw new Error(`${domain} is een publieke maildienst; blokkeer het e-mailadres zelf`);
  }
  return { value: domain, kind: "domain" };
}

export interface AddSuppressionInput {
  value: string;
  reason?: string;
  source: SuppressionSource;
  notionPageId?: string;
  now?: Date;
}

/** Adds one entry. Returns false when it was already on the list. */
export function addSuppression(db: Db, input: AddSuppressionInput): boolean {
  const { value, kind } = parseSuppressionValue(input.value);
  const result = db
    .prepare(
      `insert into suppressions (value, kind, reason, source, created_at, notion_page_id)
       values (?, ?, ?, ?, ?, ?) on conflict (value) do nothing`,
    )
    .run(
      value,
      kind,
      input.reason ?? null,
      input.source,
      (input.now ?? new Date()).toISOString(),
      input.notionPageId ?? null,
    );
  return result.changes > 0;
}

/**
 * Processes an opt-out from an address: blocks the address and, for business domains, the
 * whole domain, so nobody else at that company is mailed either.
 */
export function suppressOptOut(db: Db, email: string, reason: string, now?: Date): void {
  const normalized = normalizeEmail(email);
  if (!normalized) throw new Error(`Ongeldig e-mailadres: ${email}`);
  addSuppression(db, { value: normalized, reason, source: "reply", now });
  const domain = domainOf(normalized);
  if (!FREEMAIL_DOMAINS.has(domain))
    addSuppression(db, { value: domain, reason, source: "reply", now });
}

/** Returns the matching entry, or undefined when the address may be mailed. */
export function findSuppression(db: Db, email: string): Suppression | undefined {
  const normalized = normalizeEmail(email);
  // An address we cannot parse is treated as blocked by the caller (send guard); here we only
  // answer whether it is on the list.
  const candidates = normalized
    ? [normalized, ...domainAndParents(domainOf(normalized))]
    : [email.trim().toLowerCase()];
  const placeholders = candidates.map(() => "?").join(", ");
  const row = db
    .prepare(
      `select value, kind, reason, source, created_at as createdAt, notion_page_id as notionPageId
       from suppressions where value in (${placeholders}) order by kind = 'email' desc limit 1`,
    )
    .get(...candidates) as Suppression | undefined;
  return row;
}

export function listSuppressions(db: Db): Suppression[] {
  return db
    .prepare(
      `select value, kind, reason, source, created_at as createdAt, notion_page_id as notionPageId
       from suppressions order by created_at`,
    )
    .all() as unknown as Suppression[];
}

export function setSuppressionNotionPage(db: Db, value: string, pageId: string): void {
  db.prepare(
    "update suppressions set notion_page_id = ? where value = ? and notion_page_id is null",
  ).run(pageId, value);
}
