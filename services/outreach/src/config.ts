/** Runtime configuration. All values come from the environment; secrets never live in code. */
import { z } from "zod";

// Absolute ceilings: even a typo in .env cannot raise the limits beyond these.
export const MAX_EMAILS_PER_DAY_CEILING = 50;
export const MAX_NEW_LEADS_PER_WEEK_CEILING = 20;

const clock = z.string().regex(/^([01]\d|2[0-3]):[0-5]\d$/, "verwacht HH:mm");
const optional = z
  .string()
  .optional()
  .transform((v) => (v ? v : undefined));

const EnvSchema = z.object({
  OUTREACH_MODE: z.enum(["shadow", "live"]).default("shadow"),
  OUTREACH_PAUSED: z.stringbool().default(false),
  OUTREACH_MAX_EMAILS_PER_DAY: z.coerce
    .number()
    .int()
    .min(0)
    .max(MAX_EMAILS_PER_DAY_CEILING)
    .default(25),
  OUTREACH_MAX_NEW_LEADS_PER_WEEK: z.coerce
    .number()
    .int()
    .min(0)
    .max(MAX_NEW_LEADS_PER_WEEK_CEILING)
    .default(10),
  OUTREACH_TIMEZONE: z.string().default("Europe/Amsterdam"),
  OUTREACH_SEND_WINDOW_START: clock.default("07:30"),
  OUTREACH_SEND_WINDOW_END: clock.default("10:00"),
  // Sending is refused when the local copy of the Notion unsubscribe list is older than this.
  OUTREACH_SUPPRESSION_MAX_AGE_MINUTES: z.coerce.number().int().min(1).default(120),
  OUTREACH_SENDER_EMAIL: z.email().default("info@veryo.nl"),
  OUTREACH_SENDER_NAME: z.string().min(1).default("Csaba"),
  OUTREACH_ESCALATION_EMAIL: z.email(),
  OUTREACH_SCAN_LINK: z.url(),
  OUTREACH_CALENDLY_LINK: z.url(),
  OUTREACH_DB_PATH: z.string().min(1).default("./data/outreach.sqlite"),
  NOTION_TOKEN: optional,
  NOTION_PARENT_PAGE_ID: optional,
  NOTION_LEADS_DATA_SOURCE_ID: optional,
  NOTION_SUPPRESSION_DATA_SOURCE_ID: optional,
});

export interface OutreachConfig {
  mode: "shadow" | "live";
  paused: boolean;
  maxEmailsPerDay: number;
  maxNewLeadsPerWeek: number;
  timeZone: string;
  sendWindow: { start: string; end: string };
  suppressionMaxAgeMinutes: number;
  sender: { email: string; name: string };
  escalationEmail: string;
  links: { scan: string; calendly: string };
  dbPath: string;
  notion: {
    token?: string;
    parentPageId?: string;
    leadsDataSourceId?: string;
    suppressionDataSourceId?: string;
  };
}

type Env = Record<string, string | undefined>;

export function loadConfig(env: Env = process.env): OutreachConfig {
  const parsed = EnvSchema.safeParse(env);
  if (!parsed.success) {
    const problems = parsed.error.issues.map((i) => `${i.path.join(".")}: ${i.message}`);
    throw new Error(`Ongeldige configuratie:\n  ${problems.join("\n  ")}`);
  }
  const e = parsed.data;
  try {
    new Intl.DateTimeFormat("en", { timeZone: e.OUTREACH_TIMEZONE });
  } catch {
    throw new Error(
      `Ongeldige configuratie:\n  OUTREACH_TIMEZONE: onbekend: ${e.OUTREACH_TIMEZONE}`,
    );
  }
  if (e.OUTREACH_SEND_WINDOW_START >= e.OUTREACH_SEND_WINDOW_END) {
    throw new Error("Ongeldige configuratie:\n  OUTREACH_SEND_WINDOW_START moet vóór _END liggen");
  }
  return {
    mode: e.OUTREACH_MODE,
    paused: e.OUTREACH_PAUSED,
    maxEmailsPerDay: e.OUTREACH_MAX_EMAILS_PER_DAY,
    maxNewLeadsPerWeek: e.OUTREACH_MAX_NEW_LEADS_PER_WEEK,
    timeZone: e.OUTREACH_TIMEZONE,
    sendWindow: { start: e.OUTREACH_SEND_WINDOW_START, end: e.OUTREACH_SEND_WINDOW_END },
    suppressionMaxAgeMinutes: e.OUTREACH_SUPPRESSION_MAX_AGE_MINUTES,
    sender: { email: e.OUTREACH_SENDER_EMAIL, name: e.OUTREACH_SENDER_NAME },
    escalationEmail: e.OUTREACH_ESCALATION_EMAIL,
    links: { scan: e.OUTREACH_SCAN_LINK, calendly: e.OUTREACH_CALENDLY_LINK },
    dbPath: e.OUTREACH_DB_PATH,
    notion: {
      token: e.NOTION_TOKEN,
      parentPageId: e.NOTION_PARENT_PAGE_ID,
      leadsDataSourceId: e.NOTION_LEADS_DATA_SOURCE_ID,
      suppressionDataSourceId: e.NOTION_SUPPRESSION_DATA_SOURCE_ID,
    },
  };
}

/** Summary safe to print or log: no tokens. */
export function describeConfig(config: OutreachConfig): Record<string, unknown> {
  const { notion, ...rest } = config;
  return {
    ...rest,
    notion: {
      token: notion.token ? "(gezet)" : "(ontbreekt)",
      parentPageId: notion.parentPageId ?? "(ontbreekt)",
      leadsDataSourceId: notion.leadsDataSourceId ?? "(ontbreekt)",
      suppressionDataSourceId: notion.suppressionDataSourceId ?? "(ontbreekt)",
    },
  };
}
