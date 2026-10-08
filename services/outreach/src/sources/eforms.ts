/**
 * Parser for EU eForms contract award notices (UBL ContractAwardNotice, the format TenderNed and
 * TED have used since October 2023). Extracts what the pipeline needs: title, buyer, CPV codes and
 * the winning organisations (name, KvK number, city, contact address).
 *
 * Winner chain in eForms: LotResult (TenderResultCode "selec-w") → LotTender (with a SettledContract,
 * when contracts are listed) → TenderingParty → Tenderer → Organization.
 */
import { XMLParser } from "fast-xml-parser";

export interface AwardWinner {
  name: string;
  /** cbc:CompanyID; for Dutch companies normally the KvK number. */
  companyId?: string;
  city?: string;
  email?: string;
  website?: string;
  lots: string[];
}

export interface AwardNotice {
  title?: string;
  buyer?: string;
  issueDate?: string;
  cpvCodes: string[];
  winners: AwardWinner[];
}

type Node = Record<string, unknown>;

const parser = new XMLParser({
  removeNSPrefix: true,
  ignoreAttributes: false,
  attributeNamePrefix: "@_",
  textNodeName: "#text",
  // Keep values as strings: KvK numbers and CPV codes can start with 0.
  parseTagValue: false,
  parseAttributeValue: false,
});

function arr(value: unknown): Node[] {
  if (value === undefined || value === null) return [];
  return (Array.isArray(value) ? value : [value]) as Node[];
}

function child(node: unknown, ...path: string[]): unknown {
  let current: unknown = node;
  for (const key of path) {
    if (current === null || typeof current !== "object") return undefined;
    const next = (current as Node)[key];
    current = Array.isArray(next) ? next[0] : next;
  }
  return current;
}

function text(value: unknown): string | undefined {
  if (typeof value === "string") return value.trim() || undefined;
  if (Array.isArray(value)) return text(value[0]);
  if (value && typeof value === "object" && "#text" in value) return text((value as Node)["#text"]);
  return undefined;
}

/** Prefers the Dutch variant of a multilingual name. */
function name(values: unknown): string | undefined {
  const list = arr(values as Node);
  const nl = list.find((v) => typeof v === "object" && v?.["@_languageID"] === "NLD");
  return text(nl ?? list[0]);
}

function idOf(node: unknown): string | undefined {
  return text(child(node, "ID"));
}

export function parseAwardNotice(xml: string): AwardNotice | undefined {
  const doc = parser.parse(xml) as Node;
  const root = doc.ContractAwardNotice as Node | undefined;
  if (!root) return undefined;

  const extension = child(
    root,
    "UBLExtensions",
    "UBLExtension",
    "ExtensionContent",
    "EformsExtension",
  ) as Node | undefined;
  const organizations = new Map<string, Node>();
  for (const org of arr((child(extension, "Organizations") as Node | undefined)?.Organization)) {
    const company = child(org, "Company") as Node | undefined;
    const id = text(child(company, "PartyIdentification", "ID"));
    if (id && company) organizations.set(id, company);
  }

  const lotTitles = new Map<string, string>();
  for (const lot of arr(root.ProcurementProjectLot)) {
    const id = idOf(lot);
    const title = name((child(lot, "ProcurementProject") as Node | undefined)?.Name);
    if (id && title) lotTitles.set(id, title);
  }

  const cpvCodes = new Set<string>();
  const projects = [
    child(root, "ProcurementProject"),
    ...arr(root.ProcurementProjectLot).map((l) => child(l, "ProcurementProject")),
  ];
  for (const project of projects) {
    const p = project as Node | undefined;
    for (const c of [
      ...arr(p?.MainCommodityClassification),
      ...arr(p?.AdditionalCommodityClassification),
    ]) {
      const code = text(c.ItemClassificationCode);
      if (code) cpvCodes.add(code);
    }
  }

  const result = child(extension, "NoticeResult") as Node | undefined;
  const lotTenders = new Map(arr(result?.LotTender).map((t) => [idOf(t), t]));
  const parties = new Map(arr(result?.TenderingParty).map((p) => [idOf(p), p]));

  // Tenders with a concluded contract are the winners. Notices may also list losing tenders under
  // a lot result; when contracts are present, only those tenders count.
  const contracted = new Set(
    arr(result?.SettledContract).flatMap((c) => arr(c.LotTender).map((t) => idOf(t))),
  );

  const winners = new Map<string, AwardWinner>();
  for (const lotResult of arr(result?.LotResult)) {
    if (text(lotResult.TenderResultCode) !== "selec-w") continue;
    const lotId = text(child(lotResult, "TenderLot", "ID"));
    for (const ref of arr(lotResult.LotTender)) {
      if (contracted.size && !contracted.has(idOf(ref))) continue;
      const tender = lotTenders.get(idOf(ref));
      const party = parties.get(text(child(tender, "TenderingParty", "ID")));
      for (const tenderer of arr(party?.Tenderer)) {
        const orgId = idOf(tenderer);
        const company = orgId ? organizations.get(orgId) : undefined;
        if (!orgId || !company) continue;
        const winnerName = name((child(company, "PartyName") as Node | undefined)?.Name);
        if (!winnerName) continue;
        const existing = winners.get(orgId) ?? {
          name: winnerName,
          companyId: text(child(company, "PartyLegalEntity", "CompanyID")),
          city: text(child(company, "PostalAddress", "CityName")),
          email: text(child(company, "Contact", "ElectronicMail")),
          website: text(company.WebsiteURI),
          lots: [],
        };
        const lotTitle = lotId ? lotTitles.get(lotId) : undefined;
        if (lotTitle && !existing.lots.includes(lotTitle)) existing.lots.push(lotTitle);
        winners.set(orgId, existing);
      }
    }
  }

  const buyerId = text(child(root, "ContractingParty", "Party", "PartyIdentification", "ID"));
  const buyer = buyerId ? organizations.get(buyerId) : undefined;

  return {
    title: name((child(root, "ProcurementProject") as Node | undefined)?.Name),
    buyer: buyer ? name((child(buyer, "PartyName") as Node | undefined)?.Name) : undefined,
    issueDate: text(root.IssueDate)?.slice(0, 10),
    cpvCodes: [...cpvCodes],
    winners: [...winners.values()],
  };
}
