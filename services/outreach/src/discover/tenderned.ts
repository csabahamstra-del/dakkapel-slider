/**
 * Discovery: security companies that recently won a public contract on TenderNed. Each winner
 * becomes a candidate with trigger type "Aanbesteding" and the notice as source URL.
 */
import type { Audit } from "../audit.js";
import { addCandidate, markSeen, wasSeen } from "../candidates.js";
import type { Db } from "../db.js";
import { domainOf, isFreemail, normalizeEmail, normalizeDomain } from "../email.js";
import type { AwardNotice } from "../sources/eforms.js";
import {
  publicationUrl,
  SECURITY_CPV_PREFIX,
  type ListItem,
  type TenderNedClient,
} from "../sources/tenderned.js";

const SOURCE = "tenderned";

export interface DiscoveryStats {
  listed: number;
  skippedSeen: number;
  skippedCpv: number;
  fetched: number;
  relevant: number;
  added: number;
  duplicates: number;
  excluded: number;
  errors: number;
}

export interface TenderNedDiscoveryOptions {
  /** How far back an award still counts as a fresh trigger. */
  days?: number;
  /** Upper bound on notice downloads per run. */
  maxNotices?: number;
  now?: Date;
}

const isSecurity = (codes: string[]) => codes.some((c) => c.startsWith(SECURITY_CPV_PREFIX));

export function describeAward(notice: AwardNotice, winnerCount: number): string {
  const parts = [`Gegund: "${notice.title ?? "onbekende opdracht"}"`];
  if (notice.buyer) parts.push(`door ${notice.buyer}`);
  if (notice.issueDate) parts.push(`(gepubliceerd ${notice.issueDate})`);
  let text = parts.join(" ");
  if (winnerCount > 1) text += `; ${winnerCount} winnaars`;
  return text;
}

function domainFrom(winner: AwardNotice["winners"][number]): string | undefined {
  if (winner.website) return normalizeDomain(winner.website);
  const email = winner.email ? normalizeEmail(winner.email) : undefined;
  return email && !isFreemail(email) ? domainOf(email) : undefined;
}

export async function discoverTenderNed(
  db: Db,
  client: Pick<TenderNedClient, "listAwardNotices" | "awardNotice">,
  audit: Audit,
  options: TenderNedDiscoveryOptions = {},
): Promise<DiscoveryStats> {
  const now = options.now ?? new Date();
  const days = options.days ?? 60;
  const maxNotices = options.maxNotices ?? 300;
  const since = new Date(now.getTime() - days * 86_400_000).toISOString().slice(0, 10);
  const stats: DiscoveryStats = {
    listed: 0,
    skippedSeen: 0,
    skippedCpv: 0,
    fetched: 0,
    relevant: 0,
    added: 0,
    duplicates: 0,
    excluded: 0,
    errors: 0,
  };

  const items: ListItem[] = await client.listAwardNotices(since);
  stats.listed = items.length;

  for (const item of items) {
    if (wasSeen(db, SOURCE, item.id)) {
      stats.skippedSeen++;
      continue;
    }
    // When the list already carries CPV codes, skip unrelated notices without downloading them.
    if (item.cpvCodes.length && !isSecurity(item.cpvCodes)) {
      markSeen(db, SOURCE, item.id, "not_security", now);
      stats.skippedCpv++;
      continue;
    }
    if (stats.fetched >= maxNotices) {
      audit({
        action: "discover.tenderned",
        outcome: "skipped",
        reason: `maximum van ${maxNotices} publicaties per run bereikt`,
      });
      break;
    }

    let notice: AwardNotice | undefined;
    try {
      stats.fetched++;
      notice = await client.awardNotice(item.id);
    } catch (error) {
      // Not marked as seen: the next run tries again.
      stats.errors++;
      audit({
        action: "discover.tenderned",
        subject: item.id,
        outcome: "error",
        reason: error instanceof Error ? error.message : String(error),
      });
      continue;
    }

    if (!notice || !isSecurity(notice.cpvCodes)) {
      markSeen(db, SOURCE, item.id, notice ? "not_security" : "not_award_notice", now);
      stats.skippedCpv++;
      continue;
    }
    if (notice.winners.length === 0) {
      markSeen(db, SOURCE, item.id, "no_winner", now);
      continue;
    }
    stats.relevant++;

    const url = publicationUrl(item.id);
    const description = describeAward(notice, notice.winners.length);
    for (const winner of notice.winners) {
      const result = addCandidate(
        db,
        {
          segment: "beveiliging",
          companyName: winner.name,
          kvkNumber:
            winner.companyId && /^\d{8}$/.test(winner.companyId) ? winner.companyId : undefined,
          city: winner.city,
          domainHint: domainFrom(winner),
          triggerType: "Aanbesteding",
          triggerDescription: description,
          triggerUrl: url,
          triggerDate: notice.issueDate ?? item.date,
          triggerExcerpt: {
            publicationId: item.id,
            title: notice.title,
            buyer: notice.buyer,
            issueDate: notice.issueDate,
            cpvCodes: notice.cpvCodes,
            lots: winner.lots,
            winners: notice.winners.map((w) => w.name),
          },
          source: SOURCE,
          sourceRef: item.id,
        },
        now,
      );
      if (!result.added) {
        stats.duplicates++;
        continue;
      }
      const row = db
        .prepare("select status, status_reason from candidates where id = ?")
        .get(result.id) as {
        status: string;
        status_reason: string | null;
      };
      if (row.status === "excluded") stats.excluded++;
      else stats.added++;
      audit({
        action: "candidate.add",
        subject: winner.name,
        outcome: row.status === "excluded" ? "skipped" : "ok",
        reason: row.status_reason ?? `aanbesteding ${item.id}`,
      });
    }
    markSeen(db, SOURCE, item.id, "processed", now);
  }

  audit({ action: "discover.tenderned", outcome: "ok", details: { ...stats, since } });
  return stats;
}
