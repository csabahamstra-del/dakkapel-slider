import { readFileSync } from "node:fs";
import { describe, expect, it } from "vitest";
import { createAudit } from "../src/audit.js";
import { addCandidate, legalFormFromName, listCandidates, nameKey } from "../src/candidates.js";
import { pushCandidatesToNotion } from "../src/crm.js";
import { openDb } from "../src/db.js";
import { describeAward, discoverTenderNed } from "../src/discover/tenderned.js";
import { parseAwardNotice } from "../src/sources/eforms.js";
import { readListPage, TenderNedClient, type ListItem } from "../src/sources/tenderned.js";

const xml = readFileSync(new URL("./fixtures/award-notice.xml", import.meta.url), "utf8");
const NOW = new Date("2026-10-08T07:00:00Z");
const silent = () => undefined;

describe("eForms award notice", () => {
  const notice = parseAwardNotice(xml)!;

  it("reads title (Dutch), buyer, date and all CPV codes", () => {
    expect(notice.title).toBe("Beveiligingsdiensten gemeentelijke gebouwen");
    expect(notice.buyer).toBe("Gemeente Voorbeeldstad");
    expect(notice.issueDate).toBe("2026-09-20");
    expect(notice.cpvCodes.sort()).toEqual(["79710000", "79713000", "79714000"]);
  });

  it("returns only winners with a contract, with KvK number, city and lots", () => {
    expect(notice.winners).toEqual([
      {
        name: "Wachtpost Beveiliging B.V.",
        companyId: "01928374",
        city: "Zwolle",
        email: "tender@wachtpost-beveiliging.example",
        website: "https://www.wachtpost-beveiliging.example/",
        lots: ["Perceel 1: Stadhuis"],
      },
      {
        name: "Nachtwacht V.O.F.",
        companyId: undefined,
        city: "Deventer",
        email: "nachtwacht@gmail.com",
        website: undefined,
        lots: ["Perceel 2: Mobiele surveillance"],
      },
    ]);
  });

  it("is undefined for other notice types", () => {
    expect(parseAwardNotice("<ContractNotice><cbc:ID>1</cbc:ID></ContractNotice>")).toBeUndefined();
  });
});

describe("TenderNed list", () => {
  it("reads a Spring-style page tolerantly", () => {
    const page = readListPage({
      content: [
        {
          publicatieId: 412846,
          publicatieDatum: "2026-10-01T09:00:00",
          typePublicatie: { code: "AGO" },
          cpvCodes: [{ code: "79710000-4" }],
        },
        { publicatieId: "412845", publicatieDatum: "2026-09-30", publicatieType: "AAO" },
        { geenId: true },
      ],
      last: false,
    });
    expect(page.items).toEqual([
      { id: "412846", date: "2026-10-01", type: "AGO", cpvCodes: ["79710000-4"] },
      { id: "412845", date: "2026-09-30", type: "AAO", cpvCodes: [] },
    ]);
    expect(page.last).toBe(false);
  });

  function fakeFetch(pages: unknown[], calls: { url: string; auth?: string }[]) {
    return async (url: string, init?: RequestInit) => {
      const headers = (init?.headers ?? {}) as Record<string, string>;
      calls.push({ url, auth: headers.Authorization });
      if (url.includes("/public-xml")) return new Response(xml);
      const page = Number(new URL(url).searchParams.get("page"));
      return Response.json(pages[page] ?? { content: [], last: true });
    };
  }

  it("pages back until the start date, keeps only award notices, sends no login for the list", async () => {
    const calls: { url: string; auth?: string }[] = [];
    const client = new TenderNedClient({
      delayMs: 0,
      username: "u",
      password: "p",
      fetch: fakeFetch(
        [
          {
            content: [
              { publicatieId: 3, publicatieDatum: "2026-10-05", typePublicatie: "AGO" },
              { publicatieId: 2, publicatieDatum: "2026-09-01", typePublicatie: "AAO" },
            ],
          },
          { content: [{ publicatieId: 1, publicatieDatum: "2026-08-01", typePublicatie: "AGO" }] },
          { content: [{ publicatieId: 0, publicatieDatum: "2026-07-01", typePublicatie: "AGO" }] },
        ],
        calls,
      ),
    });
    const items = await client.listAwardNotices("2026-08-09");
    expect(items.map((i) => i.id)).toEqual(["3"]);
    expect(calls).toHaveLength(2); // stopped after the page that passed the start date
    expect(calls[0]!.url).toContain("publicatieType=AGO");
    expect(calls[0]!.auth).toBeUndefined();

    await client.awardNotice("3");
    expect(calls[2]!.url).toMatch(/\/publicaties\/3\/public-xml$/);
    expect(calls[2]!.auth).toBe(`Basic ${Buffer.from("u:p").toString("base64")}`);
  });

  it("refuses to fetch a notice without login", async () => {
    await expect(
      new TenderNedClient({ delayMs: 0, fetch: fakeFetch([], []) }).awardNotice("1"),
    ).rejects.toThrow(/inlog ontbreekt/);
  });
});

describe("candidates", () => {
  it("normalises names and recognises legal forms", () => {
    expect(nameKey("Wachtpost Beveiliging B.V.")).toBe(nameKey("wachtpost  beveiliging bv"));
    expect(nameKey("Ébène Security Holding B.V.")).toBe("ebene security");
    expect(legalFormFromName("Wachtpost Beveiliging B.V.")).toBe("BV");
    expect(legalFormFromName("Nachtwacht V.O.F.")).toBe("VOF");
    expect(legalFormFromName("Stichting Buurtwacht")).toBe("Overig");
    expect(legalFormFromName("Securitas")).toBeUndefined();
  });
});

describe("TenderNed discovery", () => {
  function fakeClient(items: ListItem[], notices: Record<string, string | Error>) {
    const fetched: string[] = [];
    return {
      fetched,
      listAwardNotices: async () => items,
      awardNotice: async (id: string) => {
        fetched.push(id);
        const n = notices[id];
        if (n instanceof Error) throw n;
        return n ? parseAwardNotice(n) : undefined;
      },
    };
  }

  it("turns winners into candidates with trigger, excludes partnerships, skips other CPVs", async () => {
    const db = openDb(":memory:");
    const otherCpv = xml.replaceAll(/>797\d+</g, ">45000000<");
    const client = fakeClient(
      [
        { id: "100", date: "2026-09-20", type: "AGO", cpvCodes: [] },
        { id: "101", date: "2026-09-21", type: "AGO", cpvCodes: ["45000000"] },
        { id: "102", date: "2026-09-22", type: "AGO", cpvCodes: [] },
      ],
      { "100": xml, "102": otherCpv },
    );
    const stats = await discoverTenderNed(db, client, createAudit(db, silent), { now: NOW });

    expect(client.fetched).toEqual(["100", "102"]); // 101 skipped on the list's CPV codes
    expect(stats).toMatchObject({
      listed: 3,
      fetched: 2,
      relevant: 1,
      added: 1,
      excluded: 1,
      skippedCpv: 2,
      errors: 0,
    });

    const [wachtpost, nachtwacht] = listCandidates(db);
    expect(wachtpost).toMatchObject({
      segment: "beveiliging",
      companyName: "Wachtpost Beveiliging B.V.",
      kvkNumber: "01928374",
      city: "Zwolle",
      domainHint: "wachtpost-beveiliging.example",
      legalFormHint: "BV",
      status: "found",
      triggerType: "Aanbesteding",
      triggerUrl: "https://www.tenderned.nl/aankondigingen/overzicht/100",
      triggerDate: "2026-09-20",
      triggerDescription:
        'Gegund: "Beveiligingsdiensten gemeentelijke gebouwen" door Gemeente Voorbeeldstad (gepubliceerd 2026-09-20); 2 winnaars',
    });
    expect(wachtpost!.triggerExcerpt).toMatchObject({
      lots: ["Perceel 1: Stadhuis"],
      buyer: "Gemeente Voorbeeldstad",
    });
    expect(nachtwacht).toMatchObject({
      status: "excluded",
      domainHint: undefined,
      legalFormHint: "VOF",
    });

    // Second run: everything already seen, nothing fetched again.
    const again = await discoverTenderNed(db, client, createAudit(db, silent), { now: NOW });
    expect(again).toMatchObject({ skippedSeen: 3, skippedCpv: 0, fetched: 0 });
  });

  it("retries failed downloads next run and never adds a company twice", async () => {
    const db = openDb(":memory:");
    const client = fakeClient(
      [
        { id: "200", date: "2026-09-20", cpvCodes: [] },
        { id: "201", date: "2026-09-21", cpvCodes: [] },
      ],
      { "200": new Error("TenderNed 503"), "201": xml },
    );
    const stats = await discoverTenderNed(db, client, createAudit(db, silent), { now: NOW });
    expect(stats).toMatchObject({ errors: 1, added: 1 });

    client.fetched.length = 0;
    const retry = fakeClient([{ id: "200", date: "2026-09-20", cpvCodes: [] }], { "200": xml });
    const second = await discoverTenderNed(db, retry, createAudit(db, silent), { now: NOW });
    expect(retry.fetched).toEqual(["200"]);
    expect(second).toMatchObject({ added: 0, duplicates: 2 });
    expect(listCandidates(db)).toHaveLength(2);
  });

  it("respects the maximum number of downloads per run", async () => {
    const db = openDb(":memory:");
    const items = Array.from({ length: 5 }, (_, i) => ({ id: String(300 + i), cpvCodes: [] }));
    const client = fakeClient(items, {});
    const stats = await discoverTenderNed(db, client, createAudit(db, silent), {
      now: NOW,
      maxNotices: 2,
    });
    expect(stats.fetched).toBe(2);
  });

  it("describes a single-winner award without a winner count", () => {
    expect(
      describeAward(
        {
          title: "Bewaking",
          buyer: "Provincie X",
          issueDate: "2026-09-01",
          cpvCodes: [],
          winners: [],
        },
        1,
      ),
    ).toBe('Gegund: "Bewaking" door Provincie X (gepubliceerd 2026-09-01)');
  });
});

describe("push to Notion", () => {
  it("pushes found candidates once and keeps excluded ones local", async () => {
    const db = openDb(":memory:");
    const base = {
      segment: "beveiliging" as const,
      triggerType: "Aanbesteding",
      triggerDescription: "d",
      triggerUrl: "https://x",
      triggerExcerpt: {},
      source: "t",
      sourceRef: "1",
    };
    addCandidate(db, { ...base, companyName: "Alpha Beveiliging B.V." });
    addCandidate(db, { ...base, companyName: "Beta V.O.F." });
    const created: string[] = [];
    const notion = {
      createLead: async (_ds: string, c: { companyName: string }) => (
        created.push(c.companyName),
        `page-${created.length}`
      ),
    };
    const audit = createAudit(db, silent);

    expect(await pushCandidatesToNotion(db, notion, "ds", audit)).toBe(1);
    expect(created).toEqual(["Alpha Beveiliging B.V."]);
    expect(await pushCandidatesToNotion(db, notion, "ds", audit)).toBe(0);
  });
});
