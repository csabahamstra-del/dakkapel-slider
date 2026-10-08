/**
 * Two-way merge of the unsubscribe list between Notion (where Csaba can add entries by hand)
 * and SQLite (what the send guard reads). Entries are only ever added, never removed: deleting a
 * row in Notion does not lift an opt-out. The sync time is recorded only after a full success;
 * the send guard refuses to send when it gets too old.
 */
import type { Audit } from "./audit.js";
import { setState, type Db } from "./db.js";
import { SUPPRESSION_SYNCED_AT } from "./guard.js";
import type { NotionWorkspace } from "./notion/workspace.js";
import {
  addSuppression,
  listSuppressions,
  parseSuppressionValue,
  setSuppressionNotionPage,
} from "./suppression.js";

export interface SyncResult {
  pulled: number;
  pushed: number;
  invalid: string[];
}

export async function syncSuppressions(
  db: Db,
  notion: Pick<NotionWorkspace, "listSuppressions" | "addSuppression">,
  dataSourceId: string,
  audit: Audit,
  now: () => Date = () => new Date(),
): Promise<SyncResult> {
  const result: SyncResult = { pulled: 0, pushed: 0, invalid: [] };
  try {
    const remote = await notion.listSuppressions(dataSourceId);
    const remoteValues = new Set<string>();
    for (const entry of remote) {
      let value: string;
      try {
        value = parseSuppressionValue(entry.value).value;
      } catch {
        result.invalid.push(entry.value);
        continue;
      }
      remoteValues.add(value);
      if (
        addSuppression(db, {
          value,
          reason: entry.reason ?? undefined,
          source: "notion",
          notionPageId: entry.pageId,
          now: now(),
        })
      ) {
        result.pulled++;
      } else {
        setSuppressionNotionPage(db, value, entry.pageId);
      }
    }

    for (const local of listSuppressions(db)) {
      if (local.notionPageId || remoteValues.has(local.value)) continue;
      const pageId = await notion.addSuppression(dataSourceId, local);
      setSuppressionNotionPage(db, local.value, pageId);
      result.pushed++;
    }

    setState(db, SUPPRESSION_SYNCED_AT, now().toISOString(), now());
    audit({
      action: "suppression.sync",
      outcome: "ok",
      details: { pulled: result.pulled, pushed: result.pushed, invalid: result.invalid.length },
    });
    if (result.invalid.length) {
      audit({
        action: "suppression.sync",
        outcome: "skipped",
        reason: `ongeldige regels in Notion overgeslagen: ${result.invalid.join(", ")}`,
      });
    }
    return result;
  } catch (error) {
    audit({
      action: "suppression.sync",
      outcome: "error",
      reason: error instanceof Error ? error.message : String(error),
    });
    throw error;
  }
}
