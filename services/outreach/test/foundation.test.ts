import { describe, expect, it } from "vitest";
import { createAudit } from "../src/audit.js";
import { loadConfig, MAX_EMAILS_PER_DAY_CEILING } from "../src/config.js";
import { openDb, setState, type Db } from "../src/db.js";
import { checkMailDns, type Resolver } from "../src/dns-check.js";
import { checkSend, SUPPRESSION_SYNCED_AT } from "../src/guard.js";
import { createLogger, redact } from "../src/log.js";
import {
  LEADS_DB,
  SUPPRESSION_DB,
  toNotionProperties,
  verifySchema,
} from "../src/notion/schema.js";
import {
  addSuppression,
  findSuppression,
  listSuppressions,
  suppressOptOut,
} from "../src/suppression.js";
import { syncSuppressions } from "../src/suppression-sync.js";
import { startOfLocalDay } from "../src/time.js";

const baseEnv = {
  OUTREACH_ESCALATION_EMAIL: "csaba@example.com",
  OUTREACH_SCAN_LINK: "https://veryo.nl/waar-begin-ik-met-ai/#ai-scan",
  OUTREACH_CALENDLY_LINK: "https://calendly.com/csabahamstra/30min",
};
const config = loadConfig(baseEnv);
const NOW = new Date("2026-10-08T07:45:00Z"); // 09:45 in Amsterdam (CEST)

function freshDb(): Db {
  const db = openDb(":memory:");
  setState(db, SUPPRESSION_SYNCED_AT, NOW.toISOString());
  return db;
}

let seq = 0;
function recordOutbound(db: Db, at: Date, firstContact = false) {
  const t = at.toISOString();
  db.prepare(
    `insert into outbound_messages (idempotency_key, lead_id, to_email, step, is_first_contact, mode, status, created_at, updated_at)
     values (?, 'lead', 'x@bedrijf.nl', 1, ?, 'shadow', 'drafted', ?, ?)`,
  ).run(`k${seq++}`, firstContact ? 1 : 0, t, t);
}

describe("config", () => {
  it("defaults to shadow mode with the brief's limits", () => {
    expect(config.mode).toBe("shadow");
    expect(config.paused).toBe(false);
    expect(config.maxEmailsPerDay).toBe(25);
    expect(config.maxNewLeadsPerWeek).toBe(10);
    expect(config.sender.email).toBe("info@veryo.nl");
    expect(config.sendWindow).toEqual({ start: "07:30", end: "10:00" });
  });

  it("refuses limits above the hard ceiling and unknown modes", () => {
    expect(() =>
      loadConfig({
        ...baseEnv,
        OUTREACH_MAX_EMAILS_PER_DAY: String(MAX_EMAILS_PER_DAY_CEILING + 1),
      }),
    ).toThrow(/OUTREACH_MAX_EMAILS_PER_DAY/);
    expect(() => loadConfig({ ...baseEnv, OUTREACH_MODE: "yolo" })).toThrow(/OUTREACH_MODE/);
    expect(() => loadConfig({ ...baseEnv, OUTREACH_SEND_WINDOW_START: "11:00" })).toThrow(/vóór/);
  });

  it("requires the escalation address and links", () => {
    expect(() => loadConfig({})).toThrow(/OUTREACH_ESCALATION_EMAIL/);
  });

  it("parses booleans strictly", () => {
    expect(loadConfig({ ...baseEnv, OUTREACH_PAUSED: "true" }).paused).toBe(true);
    expect(() => loadConfig({ ...baseEnv, OUTREACH_PAUSED: "misschien" })).toThrow(
      /OUTREACH_PAUSED/,
    );
  });
});

describe("logging", () => {
  it("masks secret-looking keys at any depth", () => {
    expect(redact({ NOTION_TOKEN: "s", nested: { apiKey: "k", ok: 1 } })).toEqual({
      NOTION_TOKEN: "[redacted]",
      nested: { apiKey: "[redacted]", ok: 1 },
    });
    const lines: string[] = [];
    createLogger((l) => lines.push(l))("x", { authorization: "Bearer abc" });
    expect(lines[0]).not.toContain("abc");
  });

  it("writes every audit entry to the database", () => {
    const db = freshDb();
    const audit = createAudit(db, () => undefined);
    audit({
      action: "test",
      subject: "a@b.nl",
      outcome: "blocked",
      reason: "r",
      details: { token: "t" },
    });
    const row = db.prepare("select * from audit_log").get() as Record<string, string>;
    expect(row).toMatchObject({
      action: "test",
      subject: "a@b.nl",
      outcome: "blocked",
      reason: "r",
    });
    expect(row.details).toBe('{"token":"[redacted]"}');
  });
});

describe("suppression list", () => {
  it("blocks addresses, domains and subdomains, case-insensitive", () => {
    const db = freshDb();
    addSuppression(db, { value: "Jan@Voorbeeld.NL", source: "manual" });
    addSuppression(db, { value: "https://www.dakbedrijf.nl/contact", source: "manual" });
    expect(findSuppression(db, "jan@voorbeeld.nl")?.kind).toBe("email");
    expect(findSuppression(db, "piet@voorbeeld.nl")).toBeUndefined();
    expect(findSuppression(db, "info@dakbedrijf.nl")?.value).toBe("dakbedrijf.nl");
    expect(findSuppression(db, "info@offerte.dakbedrijf.nl")?.value).toBe("dakbedrijf.nl");
    expect(findSuppression(db, "info@anderdakbedrijf.nl")).toBeUndefined();
  });

  it("is permanent and idempotent", () => {
    const db = freshDb();
    expect(addSuppression(db, { value: "a@b.nl", source: "manual" })).toBe(true);
    expect(addSuppression(db, { value: "A@B.nl", source: "reply" })).toBe(false);
    expect(listSuppressions(db)).toHaveLength(1);
  });

  it("an opt-out blocks the whole business domain, but never a public mail service", () => {
    const db = freshDb();
    suppressOptOut(db, "eigenaar@kozijnen-bv.nl", "afmelding per mail");
    suppressOptOut(db, "iemand@gmail.com", "afmelding per mail");
    expect(
      listSuppressions(db)
        .map((s) => s.value)
        .sort(),
    ).toEqual(["eigenaar@kozijnen-bv.nl", "iemand@gmail.com", "kozijnen-bv.nl"]);
    expect(() => addSuppression(db, { value: "gmail.com", source: "manual" })).toThrow(
      /publieke maildienst/,
    );
  });

  it("rejects garbage", () => {
    const db = freshDb();
    expect(() => addSuppression(db, { value: "geen adres", source: "manual" })).toThrow();
  });
});

describe("send guard", () => {
  const to = "directeur@dakkapel-bv.nl";

  it("allows a normal business address", () => {
    expect(checkSend(freshDb(), config, { to, isFirstContact: true, now: NOW })).toEqual({
      allowed: true,
    });
  });

  it("blocks when paused, suppressed, freemail or invalid", () => {
    const db = freshDb();
    addSuppression(db, { value: "dakkapel-bv.nl", source: "manual" });
    const result = checkSend(
      db,
      { ...config, paused: true },
      { to, isFirstContact: false, now: NOW },
    );
    expect(result.allowed).toBe(false);
    if (!result.allowed) {
      expect(result.reasons.join("|")).toMatch(/pauze/);
      expect(result.reasons.join("|")).toMatch(/afmeldlijst \(domein dakkapel-bv.nl\)/);
    }
    expect(
      checkSend(db, config, { to: "jan@gmail.com", isFirstContact: false, now: NOW }).allowed,
    ).toBe(false);
    expect(checkSend(db, config, { to: "kapot", isFirstContact: false, now: NOW }).allowed).toBe(
      false,
    );
  });

  it("fails closed when the unsubscribe list is stale or never synced", () => {
    const db = openDb(":memory:");
    expect(checkSend(db, config, { to, isFirstContact: false, now: NOW })).toMatchObject({
      allowed: false,
      reasons: [expect.stringMatching(/nooit gesynchroniseerd/)],
    });
    setState(db, SUPPRESSION_SYNCED_AT, new Date(NOW.getTime() - 3 * 3600_000).toISOString());
    expect(checkSend(db, config, { to, isFirstContact: false, now: NOW }).allowed).toBe(false);
  });

  it("enforces the daily limit per local calendar day", () => {
    const db = freshDb();
    const cfg = { ...config, maxEmailsPerDay: 2 };
    recordOutbound(db, new Date("2026-10-07T21:59:00Z")); // 23:59 yesterday, local
    recordOutbound(db, new Date("2026-10-08T05:31:00Z")); // 07:31 today
    expect(checkSend(db, cfg, { to, isFirstContact: false, now: NOW }).allowed).toBe(true);
    recordOutbound(db, new Date("2026-10-08T06:00:00Z"));
    expect(checkSend(db, cfg, { to, isFirstContact: false, now: NOW })).toMatchObject({
      allowed: false,
      reasons: ["daglimiet bereikt (2/2)"],
    });
  });

  it("enforces the new-lead limit over 7 days, only for first contacts", () => {
    const db = freshDb();
    const cfg = { ...config, maxNewLeadsPerWeek: 2 };
    recordOutbound(db, new Date("2026-10-01T06:00:00Z"), true); // 7 days + ago: not counted
    recordOutbound(db, new Date("2026-10-02T06:00:00Z"), true);
    recordOutbound(db, new Date("2026-10-05T06:00:00Z"), true);
    expect(checkSend(db, cfg, { to, isFirstContact: true, now: NOW }).allowed).toBe(false);
    expect(checkSend(db, cfg, { to, isFirstContact: false, now: NOW }).allowed).toBe(true);
  });
});

describe("startOfLocalDay", () => {
  it("handles summer time, winter time and the DST switch", () => {
    const tz = "Europe/Amsterdam";
    expect(startOfLocalDay(new Date("2026-10-08T07:45:00Z"), tz).toISOString()).toBe(
      "2026-10-07T22:00:00.000Z",
    );
    expect(startOfLocalDay(new Date("2026-01-15T23:30:00Z"), tz).toISOString()).toBe(
      "2026-01-15T23:00:00.000Z",
    );
    expect(startOfLocalDay(new Date("2026-03-29T12:00:00Z"), tz).toISOString()).toBe(
      "2026-03-28T23:00:00.000Z",
    );
    expect(startOfLocalDay(new Date("2026-10-25T12:00:00Z"), tz).toISOString()).toBe(
      "2026-10-24T22:00:00.000Z",
    );
  });
});

describe("mail DNS check", () => {
  function resolver(records: Record<string, string[]>): Resolver {
    return {
      resolveTxt: async (name) => {
        if (!records[name]) throw Object.assign(new Error("nx"), { code: "ENOTFOUND" });
        return records[name].map((r) => [r]);
      },
      resolveMx: async () => [{ exchange: "mx1.mijn.host", priority: 10 }],
    };
  }

  it("reports the current veryo.nl situation: DMARC missing", async () => {
    const findings = await checkMailDns(
      "veryo.nl",
      resolver({
        "veryo.nl": ["v=spf1 a mx include:spf.mijn.host ~all"],
        "x._domainkey.veryo.nl": ["v=DKIM1; k=rsa; p=MIIB"],
      }),
    );
    expect(Object.fromEntries(findings.map((f) => [f.check, f.level]))).toEqual({
      MX: "ok",
      SPF: "ok",
      DKIM: "ok",
      DMARC: "fail",
    });
  });

  it("accepts a DMARC record and flags a permissive SPF", async () => {
    const findings = await checkMailDns(
      "x.nl",
      resolver({ "x.nl": ["v=spf1 +all"], "_dmarc.x.nl": ["v=DMARC1; p=quarantine"] }),
    );
    expect(findings.find((f) => f.check === "SPF")?.level).toBe("warn");
    expect(findings.find((f) => f.check === "DMARC")?.level).toBe("ok");
    expect(findings.find((f) => f.check === "DKIM")?.level).toBe("warn");
  });
});

describe("Notion schema", () => {
  it("contains every field from the brief and every status", () => {
    for (const name of [
      "Bedrijf",
      "Website",
      "Doelgroep",
      "Subbranche",
      "Plaats",
      "Rechtsvorm",
      "FTE",
      "KvK-nummer",
      "Contactpersoon",
      "Functie",
      "E-mail",
      "Bron van het mailadres",
      "Trigger-type",
      "Trigger-omschrijving",
      "Trigger-URL",
      "Score",
      "Status",
      "Huidige stap",
      "Volgende verzenddatum",
      "Trigger-zin",
      "Mail-log",
      "Laatste reactie",
      "Classificatie",
      "Datum eerste contact",
      "Datum laatste contact",
    ]) {
      expect(LEADS_DB.properties[name], name).toBeDefined();
    }
    const status = LEADS_DB.properties.Status;
    expect(status?.type === "select" && status.options).toHaveLength(13);
  });

  it("round-trips: created properties verify cleanly, drift is reported", () => {
    const created = toNotionProperties(SUPPRESSION_DB) as Record<
      string,
      { type: string; select?: { options: { name: string }[] } }
    >;
    expect(verifySchema(SUPPRESSION_DB, created)).toEqual([]);
    const drifted = {
      ...created,
      Reden: { type: "number" },
      Type: { type: "select", select: { options: [{ name: "E-mail" }] } },
    };
    delete (drifted as Record<string, unknown>).Datum;
    expect(verifySchema(SUPPRESSION_DB, drifted)).toEqual([
      'Afmeldlijst: kolom "Type" mist opties Domein',
      'Afmeldlijst: kolom "Reden" is number, verwacht rich_text',
      'Afmeldlijst: kolom "Datum" ontbreekt',
    ]);
  });
});

describe("suppression sync with Notion", () => {
  function fakeNotion(remote: { pageId: string; value: string; reason: string | null }[]) {
    const created: string[] = [];
    return {
      created,
      listSuppressions: async () => remote,
      addSuppression: async (_ds: string, e: { value: string }) => {
        created.push(e.value);
        return `page-${e.value}`;
      },
    };
  }

  it("pulls manual Notion entries, pushes local ones, and records the sync time", async () => {
    const db = openDb(":memory:");
    addSuppression(db, { value: "lokaal@bedrijf.nl", source: "reply" });
    const notion = fakeNotion([
      { pageId: "p1", value: "Handmatig@Klant.nl", reason: "gebeld" },
      { pageId: "p2", value: "onzin", reason: null },
    ]);
    const result = await syncSuppressions(
      db,
      notion,
      "ds",
      createAudit(db, () => undefined),
      () => NOW,
    );
    expect(result).toEqual({ pulled: 1, pushed: 1, invalid: ["onzin"] });
    expect(notion.created).toEqual(["lokaal@bedrijf.nl"]);
    expect(findSuppression(db, "handmatig@klant.nl")?.source).toBe("notion");
    expect(
      checkSend(db, config, { to: "x@ander.nl", isFirstContact: false, now: NOW }).allowed,
    ).toBe(true);

    // Second run: nothing new in either direction.
    expect(
      await syncSuppressions(
        db,
        notion,
        "ds",
        createAudit(db, () => undefined),
        () => NOW,
      ),
    ).toEqual({ pulled: 0, pushed: 0, invalid: ["onzin"] });
  });

  it("does not mark the list as synced when Notion fails", async () => {
    const db = openDb(":memory:");
    const broken = {
      listSuppressions: async () => {
        throw new Error("Notion 503");
      },
      addSuppression: async () => "x",
    };
    await expect(
      syncSuppressions(
        db,
        broken,
        "ds",
        createAudit(db, () => undefined),
      ),
    ).rejects.toThrow("503");
    expect(
      checkSend(db, config, { to: "x@ander.nl", isFirstContact: false, now: NOW }).allowed,
    ).toBe(false);
    const row = db.prepare("select outcome, reason from audit_log").get();
    expect(row).toEqual({ outcome: "error", reason: "Notion 503" });
  });
});
