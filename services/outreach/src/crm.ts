/** Pushes new candidates from the local pool to the Notion CRM (status "Gevonden"). */
import type { Audit } from "./audit.js";
import { listCandidates, setCandidateNotionPage } from "./candidates.js";
import type { Db } from "./db.js";
import type { NotionWorkspace } from "./notion/workspace.js";

export async function pushCandidatesToNotion(
  db: Db,
  notion: Pick<NotionWorkspace, "createLead">,
  leadsDataSourceId: string,
  audit: Audit,
): Promise<number> {
  let pushed = 0;
  // Excluded candidates (VOF/CV) stay local: they are never contacted.
  for (const candidate of listCandidates(db, { status: "found", withoutNotion: true })) {
    try {
      const pageId = await notion.createLead(leadsDataSourceId, candidate);
      setCandidateNotionPage(db, candidate.id, pageId);
      pushed++;
    } catch (error) {
      audit({
        action: "crm.push",
        subject: candidate.companyName,
        outcome: "error",
        reason: error instanceof Error ? error.message : String(error),
      });
    }
  }
  audit({ action: "crm.push", outcome: "ok", details: { pushed } });
  return pushed;
}
