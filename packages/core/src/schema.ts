import { z } from "zod";
import {
  INCIDENT_CATEGORY_CODES,
  PERSON_ROLE_CODES,
  SEVERITIES,
  SHIFT_TYPE_CODES,
} from "./categories.js";

/** Local wall-clock time (Europe/Amsterdam) without offset, e.g. "2026-03-12T22:00". */
export const LOCAL_DATETIME_REGEX = /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/;

const localDateTime = z
  .string()
  .regex(LOCAL_DATETIME_REGEX, "Verwacht formaat YYYY-MM-DDTHH:mm")
  .describe("Lokale tijd (Europe/Amsterdam) in het formaat YYYY-MM-DDTHH:mm");

export const IncidentSchema = z.object({
  category: z.enum(INCIDENT_CATEGORY_CODES),
  reported_at: localDateTime
    .nullable()
    .describe("Tijdstip waarop de melding binnenkwam of het incident werd opgemerkt"),
  arrived_at: localDateTime
    .nullable()
    .describe("Tijdstip waarop de beveiliger ter plaatse was (alleen bij een melding/alarm)"),
  severity: z.enum(SEVERITIES),
  summary: z
    .string()
    .describe("Korte Nederlandse samenvatting zonder persoonsnamen; gebruik rollen"),
  involved_roles: z.array(z.enum(PERSON_ROLE_CODES)),
});

export const ShiftReportSchema = z.object({
  site_name: z
    .string()
    .nullable()
    .describe("Naam van het object zoals in het rapport staat; null als onbekend"),
  site_address: z.string().nullable().describe("Adres van het object zoals in het rapport staat"),
  client_name: z.string().nullable().describe("Naam van de eindklant (bedrijf), indien vermeld"),
  shift_start: localDateTime.nullable(),
  shift_end: localDateTime.nullable(),
  shift_type: z.enum(SHIFT_TYPE_CODES),
  guard_refs: z
    .array(z.string())
    .describe(
      "Beveiligers: personeelsnummer/pasnummer als dat in de bron staat, anders gemaskeerd als beveiliger_1, beveiliger_2, ... Nooit een naam.",
    ),
  summary: z.string().describe("Nederlandse samenvatting van de dienst zonder persoonsnamen"),
  remarks: z
    .array(z.string())
    .describe("Bijzonderheden die geen incident zijn (bijv. defecte verlichting), zonder namen"),
  incidents: z.array(IncidentSchema),
  confidence: z
    .number()
    .min(0)
    .max(1)
    .describe("Hoe zeker de extractie is, 0..1. Lager als gegevens ontbreken of onduidelijk zijn."),
  uncertainties: z
    .array(z.string())
    .describe(
      "Wat onduidelijk of tegenstrijdig is in de bron (Nederlands); leeg als alles duidelijk is",
    ),
});

/** What the extraction model must return for one inbound document/message. */
export const ExtractionOutputSchema = z.object({
  is_shift_report: z
    .boolean()
    .describe(
      "false als het document geen dienst- of incidentrapport is (bijv. factuur, nieuwsbrief)",
    ),
  reports: z.array(ShiftReportSchema).describe("Eén item per dienstrapport in de bron"),
});

export type Incident = z.infer<typeof IncidentSchema>;
export type ShiftReport = z.infer<typeof ShiftReportSchema>;
export type ExtractionOutput = z.infer<typeof ExtractionOutputSchema>;
