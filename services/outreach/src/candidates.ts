/** Candidate pool in SQLite: companies with a verifiable trigger, before enrichment and scoring. */
import type { Db } from "./db.js";

export type Segment = "vak" | "beveiliging";

export interface NewCandidate {
  segment: Segment;
  companyName: string;
  kvkNumber?: string;
  city?: string;
  domainHint?: string;
  triggerType: string;
  triggerDescription: string;
  triggerUrl: string;
  triggerDate?: string;
  triggerExcerpt: Record<string, unknown>;
  source: string;
  sourceRef: string;
}

export interface Candidate extends NewCandidate {
  id: number;
  legalFormHint?: string;
  status: "found" | "excluded";
  statusReason?: string;
  notionPageId?: string;
}

const LEGAL_FORMS: [RegExp, string][] = [
  [/\bb\.?\s?v\.?$/i, "BV"],
  [/\bn\.?\s?v\.?$/i, "NV"],
  [/\bv\.?\s?o\.?\s?f\.?$/i, "VOF"],
  [/\b(c\.?\s?v\.?|commanditaire vennootschap)$/i, "CV"],
  [/\b(stichting|vereniging)\b/i, "Overig"],
];

/** Legal form as it appears in the name. Only a hint: the KvK check decides. */
export function legalFormFromName(companyName: string): string | undefined {
  const trimmed = companyName.trim().replace(/[,\s]+$/, "");
  return LEGAL_FORMS.find(([re]) => re.test(trimmed))?.[1];
}

/** Comparable company name: lower case, without legal form, punctuation and extra spaces. */
export function nameKey(companyName: string): string {
  return companyName
    .toLowerCase()
    .normalize("NFKD")
    .replace(/[̀-ͯ]/g, "")
    .replace(/\b(b\.?\s?v\.?|n\.?\s?v\.?|v\.?\s?o\.?\s?f\.?|holding)(?=\s|$|[.,])/g, " ")
    .replace(/[^a-z0-9]+/g, " ")
    .trim();
}

export type AddResult = { added: true; id: number } | { added: false; reason: "duplicate" };

/**
 * Adds a candidate unless the company is already in the pool (same KvK number, or same name in
 * the same segment). Partnerships (VOF/CV) are stored as excluded, so they are never mailed and
 * not re-added.
 */
export function addCandidate(db: Db, candidate: NewCandidate, now = new Date()): AddResult {
  const key = nameKey(candidate.companyName);
  const existing = db
    .prepare(
      `select id from candidates
       where (segment = ? and name_key = ?) or (? is not null and kvk_number = ?) limit 1`,
    )
    .get(candidate.segment, key, candidate.kvkNumber ?? null, candidate.kvkNumber ?? null);
  if (existing) return { added: false, reason: "duplicate" };

  const legalForm = legalFormFromName(candidate.companyName);
  const excluded = legalForm === "VOF" || legalForm === "CV";
  const t = now.toISOString();
  const result = db
    .prepare(
      `insert into candidates (segment, company_name, name_key, kvk_number, city, domain_hint,
         legal_form_hint, trigger_type, trigger_description, trigger_url, trigger_date,
         trigger_excerpt, source, source_ref, status, status_reason, created_at, updated_at)
       values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
    )
    .run(
      candidate.segment,
      candidate.companyName.trim(),
      key,
      candidate.kvkNumber ?? null,
      candidate.city ?? null,
      candidate.domainHint ?? null,
      legalForm ?? null,
      candidate.triggerType,
      candidate.triggerDescription,
      candidate.triggerUrl,
      candidate.triggerDate ?? null,
      JSON.stringify(candidate.triggerExcerpt),
      candidate.source,
      candidate.sourceRef,
      excluded ? "excluded" : "found",
      excluded ? `rechtsvorm ${legalForm} (personenvennootschap: niet mailen)` : null,
      t,
      t,
    );
  return { added: true, id: Number(result.lastInsertRowid) };
}

interface Row {
  id: number;
  segment: Segment;
  company_name: string;
  kvk_number: string | null;
  city: string | null;
  domain_hint: string | null;
  legal_form_hint: string | null;
  trigger_type: string;
  trigger_description: string;
  trigger_url: string;
  trigger_date: string | null;
  trigger_excerpt: string;
  source: string;
  source_ref: string;
  status: "found" | "excluded";
  status_reason: string | null;
  notion_page_id: string | null;
}

function toCandidate(r: Row): Candidate {
  return {
    id: r.id,
    segment: r.segment,
    companyName: r.company_name,
    kvkNumber: r.kvk_number ?? undefined,
    city: r.city ?? undefined,
    domainHint: r.domain_hint ?? undefined,
    legalFormHint: r.legal_form_hint ?? undefined,
    triggerType: r.trigger_type,
    triggerDescription: r.trigger_description,
    triggerUrl: r.trigger_url,
    triggerDate: r.trigger_date ?? undefined,
    triggerExcerpt: JSON.parse(r.trigger_excerpt) as Record<string, unknown>,
    source: r.source,
    sourceRef: r.source_ref,
    status: r.status,
    statusReason: r.status_reason ?? undefined,
    notionPageId: r.notion_page_id ?? undefined,
  };
}

export function listCandidates(
  db: Db,
  filter: { status?: "found" | "excluded"; withoutNotion?: boolean } = {},
): Candidate[] {
  const where: string[] = [];
  if (filter.status) where.push(`status = '${filter.status === "found" ? "found" : "excluded"}'`);
  if (filter.withoutNotion) where.push("notion_page_id is null");
  const rows = db
    .prepare(
      `select * from candidates ${where.length ? `where ${where.join(" and ")}` : ""} order by id`,
    )
    .all() as unknown as Row[];
  return rows.map(toCandidate);
}

export function setCandidateNotionPage(db: Db, id: number, pageId: string, now = new Date()): void {
  db.prepare("update candidates set notion_page_id = ?, updated_at = ? where id = ?").run(
    pageId,
    now.toISOString(),
    id,
  );
}

export function wasSeen(db: Db, source: string, ref: string): boolean {
  return !!db.prepare("select 1 from source_seen where source = ? and ref = ?").get(source, ref);
}

export function markSeen(
  db: Db,
  source: string,
  ref: string,
  outcome: string,
  now = new Date(),
): void {
  db.prepare(
    `insert into source_seen (source, ref, outcome, seen_at) values (?, ?, ?, ?)
     on conflict (source, ref) do update set outcome = excluded.outcome, seen_at = excluded.seen_at`,
  ).run(source, ref, outcome, now.toISOString());
}
