/**
 * Notion database layout: the single source for creating (`notion:setup`) and checking
 * (`notion:verify`) the CRM. Property names are Dutch because Csaba works in these tables.
 */

export type PropertySpec =
  | { type: "title" | "rich_text" | "url" | "email" | "number" | "date" }
  | { type: "select"; options: readonly string[] };

export type DatabaseSpec = { title: string; properties: Record<string, PropertySpec> };

export const LEAD_STATUSES = [
  "Gevonden",
  "Verrijkt",
  "Geselecteerd",
  "In sequence",
  "Reactie",
  "Gesprek gepland",
  "Voorstel",
  "Klant",
  "Nee",
  "Nurture",
  "Ongeldig",
  "Geblokkeerd (check)",
  "Afgemeld",
] as const;
export type LeadStatus = (typeof LEAD_STATUSES)[number];

export const TRIGGER_TYPES = [
  "Adverteert",
  "Leadplatform",
  "Vacature",
  "Reviews traagheid",
  "Aanbesteding",
  "Groei / nieuws",
] as const;

export const REPLY_CLASSES = [
  "Interesse",
  "Meer info",
  "Later",
  "Afmelden",
  "Out-of-office",
  "Bounce",
  "Overig (Csaba)",
] as const;

const text = { type: "rich_text" } as const;
const date = { type: "date" } as const;

export const LEADS_DB: DatabaseSpec = {
  title: "Veryo Leads",
  properties: {
    Bedrijf: { type: "title" },
    Website: { type: "url" },
    Domein: text,
    Doelgroep: { type: "select", options: ["Vak", "Beveiliging"] },
    Subbranche: { type: "select", options: ["Dakkapellen", "Kozijnen", "Vloeren", "Beveiliging"] },
    Plaats: text,
    Rechtsvorm: { type: "select", options: ["BV", "NV", "Eenmanszaak", "VOF", "Overig"] },
    FTE: { type: "number" },
    "KvK-nummer": text,
    Contactpersoon: text,
    Functie: text,
    "E-mail": { type: "email" },
    "Bron van het mailadres": text,
    "Trigger-type": { type: "select", options: TRIGGER_TYPES },
    "Trigger-omschrijving": text,
    "Trigger-URL": { type: "url" },
    Score: { type: "number" },
    Status: { type: "select", options: LEAD_STATUSES },
    "Reden status": text,
    "Huidige stap": { type: "number" },
    "Volgende verzenddatum": date,
    "Trigger-zin": text,
    "Mail-log": text,
    "Laatste reactie": text,
    Classificatie: { type: "select", options: REPLY_CLASSES },
    "Datum eerste contact": date,
    "Datum laatste contact": date,
    "Opnieuw benaderen vanaf": date,
  },
};

export const SUPPRESSION_DB: DatabaseSpec = {
  title: "Afmeldlijst",
  properties: {
    Waarde: { type: "title" },
    Type: { type: "select", options: ["E-mail", "Domein"] },
    Reden: text,
    Bron: { type: "select", options: ["Reactie", "Handmatig", "Systeem"] },
    Datum: date,
  },
};

/** Property configuration for `databases.create({ initial_data_source: { properties } })`. */
export function toNotionProperties(spec: DatabaseSpec) {
  return Object.fromEntries(
    Object.entries(spec.properties).map(([name, p]) => {
      switch (p.type) {
        case "select":
          return [
            name,
            { type: "select", select: { options: p.options.map((o) => ({ name: o })) } },
          ];
        case "number":
          return [name, { type: "number", number: { format: "number" } }];
        default:
          return [name, { type: p.type, [p.type]: {} }];
      }
    }),
  );
}

/** Actual property as returned by `dataSources.retrieve`. */
export interface ActualProperty {
  type: string;
  select?: { options: { name: string }[] };
}

/** Lists the differences between a data source and the spec; empty means it matches. */
export function verifySchema(spec: DatabaseSpec, actual: Record<string, ActualProperty>): string[] {
  const problems: string[] = [];
  for (const [name, expected] of Object.entries(spec.properties)) {
    const prop = actual[name];
    if (!prop) {
      problems.push(`${spec.title}: kolom "${name}" ontbreekt`);
      continue;
    }
    if (prop.type !== expected.type) {
      problems.push(`${spec.title}: kolom "${name}" is ${prop.type}, verwacht ${expected.type}`);
      continue;
    }
    if (expected.type === "select") {
      const have = new Set(prop.select?.options.map((o) => o.name));
      const missing = expected.options.filter((o) => !have.has(o));
      if (missing.length) {
        problems.push(`${spec.title}: kolom "${name}" mist opties ${missing.join(", ")}`);
      }
    }
  }
  return problems;
}
