/** Notion access for the outreach CRM: creating/checking the databases and the unsubscribe list. */
import { collectPaginatedAPI, isFullPage, type Client } from "@notionhq/client";
import type { Candidate } from "../candidates.js";
import {
  LEADS_DB,
  SUPPRESSION_DB,
  toNotionProperties,
  verifySchema,
  type ActualProperty,
  type DatabaseSpec,
} from "./schema.js";

export type NotionApi = Pick<Client, "databases" | "dataSources" | "pages">;

export interface RemoteSuppression {
  pageId: string;
  value: string;
  reason: string | null;
}

const KIND_LABEL = { email: "E-mail", domain: "Domein" } as const;
const SOURCE_LABEL = {
  reply: "Reactie",
  manual: "Handmatig",
  system: "Systeem",
  notion: "Handmatig",
} as const;

export class NotionWorkspace {
  constructor(private readonly api: NotionApi) {}

  /** Creates both databases under the parent page; returns their data source ids. */
  async setup(parentPageId: string): Promise<{ leads: string; suppression: string }> {
    const leads = await this.createDatabase(parentPageId, LEADS_DB);
    const suppression = await this.createDatabase(parentPageId, SUPPRESSION_DB);
    return { leads, suppression };
  }

  private async createDatabase(parentPageId: string, spec: DatabaseSpec): Promise<string> {
    const db = await this.api.databases.create({
      parent: { type: "page_id", page_id: parentPageId },
      title: [{ type: "text", text: { content: spec.title } }],
      initial_data_source: { properties: toNotionProperties(spec) as never },
    });
    const dataSourceId = "data_sources" in db ? db.data_sources[0]?.id : undefined;
    if (!dataSourceId) throw new Error(`Notion gaf geen data source terug voor ${spec.title}`);
    return dataSourceId;
  }

  async verify(spec: DatabaseSpec, dataSourceId: string): Promise<string[]> {
    const ds = await this.api.dataSources.retrieve({ data_source_id: dataSourceId });
    if (!("properties" in ds)) return [`${spec.title}: geen toegang tot de kolommen`];
    return verifySchema(spec, ds.properties as unknown as Record<string, ActualProperty>);
  }

  verifyAll(ids: { leads: string; suppression: string }): Promise<string[][]> {
    return Promise.all([
      this.verify(LEADS_DB, ids.leads),
      this.verify(SUPPRESSION_DB, ids.suppression),
    ]);
  }

  async listSuppressions(dataSourceId: string): Promise<RemoteSuppression[]> {
    const pages = await collectPaginatedAPI(this.api.dataSources.query, {
      data_source_id: dataSourceId,
    });
    const result: RemoteSuppression[] = [];
    for (const page of pages) {
      if (page.object !== "page" || !isFullPage(page) || page.in_trash) continue;
      const title = page.properties.Waarde;
      const reason = page.properties.Reden;
      const value =
        title?.type === "title"
          ? title.title
              .map((t) => t.plain_text)
              .join("")
              .trim()
          : "";
      if (!value) continue;
      result.push({
        pageId: page.id,
        value,
        reason:
          reason?.type === "rich_text"
            ? reason.rich_text.map((t) => t.plain_text).join("") || null
            : null,
      });
    }
    return result;
  }

  async addSuppression(
    dataSourceId: string,
    entry: {
      value: string;
      kind: "email" | "domain";
      reason: string | null;
      source: keyof typeof SOURCE_LABEL;
      createdAt: string;
    },
  ): Promise<string> {
    const page = await this.api.pages.create({
      parent: { type: "data_source_id", data_source_id: dataSourceId },
      properties: {
        Waarde: { title: [{ text: { content: entry.value } }] },
        Type: { select: { name: KIND_LABEL[entry.kind] } },
        Reden: {
          rich_text: entry.reason ? [{ text: { content: entry.reason.slice(0, 2000) } }] : [],
        },
        Bron: { select: { name: SOURCE_LABEL[entry.source] } },
        Datum: { date: { start: entry.createdAt } },
      },
    });
    return page.id;
  }

  /** Creates a lead with status "Gevonden". Legal form stays empty until KvK has verified it. */
  async createLead(dataSourceId: string, candidate: Candidate): Promise<string> {
    const rich = (value?: string) => ({
      rich_text: value ? [{ text: { content: value.slice(0, 2000) } }] : [],
    });
    const isVak = candidate.segment === "vak";
    const page = await this.api.pages.create({
      parent: { type: "data_source_id", data_source_id: dataSourceId },
      properties: {
        Bedrijf: { title: [{ text: { content: candidate.companyName.slice(0, 2000) } }] },
        Domein: rich(candidate.domainHint),
        Doelgroep: { select: { name: isVak ? "Vak" : "Beveiliging" } },
        ...(isVak ? {} : { Subbranche: { select: { name: "Beveiliging" } } }),
        Plaats: rich(candidate.city),
        "KvK-nummer": rich(candidate.kvkNumber),
        "Trigger-type": { select: { name: candidate.triggerType } },
        "Trigger-omschrijving": rich(candidate.triggerDescription),
        "Trigger-URL": { url: candidate.triggerUrl },
        Status: { select: { name: "Gevonden" } },
      },
    });
    return page.id;
  }
}
