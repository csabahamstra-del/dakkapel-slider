/**
 * TenderNed (official open data, CC0): recently awarded security contracts.
 *
 * - The publication list (`/publicaties`) is public. We ask for award notices (type AGO) and page
 *   back until we pass the start date.
 * - The notice itself (`/publicaties/{id}/public-xml`, eForms) needs a free account from
 *   functioneelbeheer@tenderned.nl (basic auth). It names the winners.
 *
 * The list's field names are not formally documented; `readListItem` is tolerant and
 * `cli tenderned:probe` shows the live shape on the server.
 */
import { parseAwardNotice, type AwardNotice } from "./eforms.js";

export const TENDERNED_BASE_URL = "https://www.tenderned.nl/papi/tenderned-rs-tns/v2";
export const AWARD_NOTICE_TYPE = "AGO";
// 79710000 Beveiligingsdiensten and its children (alarmbewaking, bewaking, surveillance, patrouille).
export const SECURITY_CPV_PREFIX = "7971";

export function publicationUrl(publicationId: string): string {
  return `https://www.tenderned.nl/aankondigingen/overzicht/${publicationId}`;
}

export interface ListItem {
  id: string;
  date?: string;
  type?: string;
  cpvCodes: string[];
}

type Obj = Record<string, unknown>;
const str = (v: unknown) =>
  typeof v === "string" || typeof v === "number" ? String(v) : undefined;

export function readListItem(raw: Obj): ListItem | undefined {
  const id = str(raw.publicatieId ?? raw.id);
  if (!id) return undefined;
  const typeField = raw.typePublicatie ?? raw.publicatieType ?? raw.type;
  const type = str(typeField) ?? str((typeField as Obj | undefined)?.code);
  const cpv = Array.isArray(raw.cpvCodes) ? raw.cpvCodes : [];
  return {
    id,
    date: str(raw.publicatieDatum ?? raw.publicatiedatum ?? raw.datumPublicatie)?.slice(0, 10),
    type,
    cpvCodes: cpv.map((c) => str(c) ?? str((c as Obj).code)).filter((c): c is string => !!c),
  };
}

export function readListPage(body: unknown): { items: ListItem[]; last: boolean } {
  const obj = (body ?? {}) as Obj;
  const rawItems = Array.isArray(body) ? body : Array.isArray(obj.content) ? obj.content : [];
  const items = (rawItems as Obj[]).map(readListItem).filter((i): i is ListItem => !!i);
  const last = obj.last === true || items.length === 0;
  return { items, last };
}

export type Fetch = (url: string, init?: RequestInit) => Promise<Response>;

export interface TenderNedOptions {
  baseUrl?: string;
  username?: string;
  password?: string;
  fetch?: Fetch;
  pageSize?: number;
  /** Pause between requests, to be a polite user of a public service. */
  delayMs?: number;
}

export class TenderNedClient {
  private readonly baseUrl: string;
  private readonly fetch: Fetch;
  private readonly pageSize: number;
  private readonly delayMs: number;

  constructor(private readonly options: TenderNedOptions = {}) {
    this.baseUrl = options.baseUrl ?? TENDERNED_BASE_URL;
    this.fetch = options.fetch ?? globalThis.fetch;
    this.pageSize = options.pageSize ?? 100;
    this.delayMs = options.delayMs ?? 500;
  }

  get hasCredentials(): boolean {
    return !!(this.options.username && this.options.password);
  }

  private async get(url: string, auth: boolean): Promise<Response> {
    const headers: Record<string, string> = { "User-Agent": "VeryoOutreach/0.1 (info@veryo.nl)" };
    if (auth) {
      if (!this.hasCredentials)
        throw new Error("TenderNed-inlog ontbreekt (TENDERNED_API_USERNAME/PASSWORD)");
      const token = Buffer.from(`${this.options.username}:${this.options.password}`).toString(
        "base64",
      );
      headers.Authorization = `Basic ${token}`;
    }
    const response = await this.fetch(url, { headers });
    if (!response.ok)
      throw new Error(`TenderNed ${response.status} voor ${url.replace(/\?.*/, "")}`);
    if (this.delayMs) await new Promise((r) => setTimeout(r, this.delayMs));
    return response;
  }

  async listPage(page: number): Promise<{ items: ListItem[]; last: boolean; raw: unknown }> {
    const url = `${this.baseUrl}/publicaties?page=${page}&size=${this.pageSize}&publicatieType=${AWARD_NOTICE_TYPE}`;
    const raw = await (await this.get(url, false)).json();
    return { ...readListPage(raw), raw };
  }

  /** Award notices published on or after `since` (YYYY-MM-DD), newest first. */
  async listAwardNotices(since: string, maxPages = 20): Promise<ListItem[]> {
    const result: ListItem[] = [];
    for (let page = 0; page < maxPages; page++) {
      const { items, last } = await this.listPage(page);
      // The type filter is a request parameter; if the service ignores it, filter here as well.
      result.push(
        ...items.filter(
          (i) => (!i.type || i.type === AWARD_NOTICE_TYPE) && (!i.date || i.date >= since),
        ),
      );
      const oldest = items.at(-1)?.date;
      if (last || (oldest && oldest < since)) break;
    }
    return result;
  }

  async noticeXml(publicationId: string): Promise<string> {
    return (
      await this.get(
        `${this.baseUrl}/publicaties/${encodeURIComponent(publicationId)}/public-xml`,
        true,
      )
    ).text();
  }

  async awardNotice(publicationId: string): Promise<AwardNotice | undefined> {
    return parseAwardNotice(await this.noticeXml(publicationId));
  }
}
