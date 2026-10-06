import { afterAll, beforeAll, beforeEach, describe, expect, it } from "vitest";
import { ORGS, USERS, attempt, createTestDb, type Query, type TestDb } from "./db.js";

let db: TestDb;
beforeAll(async () => {
  db = await createTestDb();
});
afterAll(async () => {
  await db?.drop();
});

const service = { role: "service_role" } as const;
let counter = 0;

async function ingest(q: Query, org: string = ORGS.noord): Promise<string> {
  const { rows } = await q(
    `select inbound_message_id from public.ingest_inbound_message($1, 'email', $2, null, 'x@in.test', null, now(), 'p', null, '[]')`,
    [org, `<queue-${++counter}@test>`],
  );
  return rows[0]!.inbound_message_id;
}

async function claim(q: Query, worker = "w1", limit = 5) {
  return (await q("select * from public.claim_processing_jobs($1, $2)", [worker, limit])).rows;
}

const report = (o: Record<string, unknown> = {}) => ({
  site_id: null,
  site_name_raw: "Distributiecentrum Noord",
  site_address_raw: "Industrieweg 12, Zwolle",
  client_name_raw: null,
  shift_start_local: "2026-03-28T22:00",
  shift_end_local: "2026-03-29T06:00", // DST starts in the night of 28-29 March 2026
  shift_type: "static_guarding",
  guard_refs: ["4471"],
  summary: "Nachtdienst",
  remarks: [],
  confidence: 0.9,
  uncertainties: [],
  status: "needs_review",
  review_reasons: [{ code: "site_not_matched", message: "Object niet gekoppeld." }],
  incidents: [
    {
      category_code: "alarm_response",
      reported_at_local: "2026-03-29T01:42",
      arrived_at_local: "2026-03-29T01:51",
      severity: "low",
      summary: "Alarm",
      involved_roles: ["guard"],
    },
  ],
  ...o,
});

beforeEach(async () => {
  // Each test starts with an empty queue (tests run in rolled-back transactions; this clears leftovers).
  await db.client.query(
    "update public.processing_jobs set status = 'done' where status in ('queued', 'running')",
  );
});

describe("claim_processing_jobs", () => {
  it("claims due jobs, increments attempts and marks the message as processing", async () => {
    const result = await db.as(service, async (q) => {
      const id = await ingest(q);
      const jobs = await claim(q);
      const msg = (await q("select status from public.inbound_messages where id = $1", [id]))
        .rows[0]!;
      return { jobs, msg };
    });
    expect(result.jobs).toHaveLength(1);
    expect(result.jobs[0]).toMatchObject({ status: "running", attempts: 1, locked_by: "w1" });
    expect(result.msg.status).toBe("processing");
  });

  it("does not hand the same job to two workers and respects the limit and run_after", async () => {
    const result = await db.as(service, async (q) => {
      await ingest(q);
      await ingest(q);
      const later = await ingest(q);
      await q(
        "update public.processing_jobs set run_after = now() + interval '1 hour' where inbound_message_id = $1",
        [later],
      );
      return {
        first: await claim(q, "w1", 1),
        second: await claim(q, "w2", 5),
        third: await claim(q, "w3", 5),
      };
    });
    expect(result.first).toHaveLength(1);
    expect(result.second).toHaveLength(1);
    expect(result.second[0]!.id).not.toBe(result.first[0]!.id);
    expect(result.third).toHaveLength(0);
  });

  it("reclaims jobs of a crashed worker after the lock timeout", async () => {
    const jobs = await db.as(service, async (q) => {
      await ingest(q);
      await claim(q, "crashed");
      await q(
        "update public.processing_jobs set locked_at = now() - interval '1 hour' where locked_by = 'crashed'",
      );
      return claim(q, "w2");
    });
    expect(jobs[0]).toMatchObject({ locked_by: "w2", attempts: 2 });
  });

  it("is only callable by the server", async () => {
    const err = await db.as({ role: "authenticated", userId: USERS.noordOwner }, (q) =>
      attempt(q, "select * from public.claim_processing_jobs('x')"),
    );
    expect(err?.code).toBe("42501");
  });
});

describe("complete_processing_job", () => {
  it("stores reports and incidents with Amsterdam time (DST-aware) and closes the job", async () => {
    const result = await db.as(service, async (q) => {
      const id = await ingest(q);
      const [job] = await claim(q);
      await q("select public.complete_processing_job($1, 'w1', $2)", [
        job!.id,
        JSON.stringify({
          status: "needs_review",
          model: "m",
          prompt_version: "v",
          reports: [report()],
        }),
      ]);
      return {
        report: (
          await q(
            "select shift_start, shift_end, status, extraction_model, guard_refs from public.shift_reports where inbound_message_id = $1",
            [id],
          )
        ).rows[0]!,
        incidents: (
          await q(
            "select i.category_code, i.reported_at from public.incidents i join public.shift_reports r on r.id = i.shift_report_id where r.inbound_message_id = $1",
            [id],
          )
        ).rows,
        job: (
          await q("select status, result, locked_by from public.processing_jobs where id = $1", [
            job!.id,
          ])
        ).rows[0]!,
        msg: (await q("select status from public.inbound_messages where id = $1", [id])).rows[0]!,
      };
    });
    // 22:00 CET = 21:00 UTC; 06:00 CEST = 04:00 UTC → 7 hours, not 8. 01:42 is still CET.
    expect(result.report.shift_start.toISOString()).toBe("2026-03-28T21:00:00.000Z");
    expect(result.report.shift_end.toISOString()).toBe("2026-03-29T04:00:00.000Z");
    expect(result.report).toMatchObject({
      status: "needs_review",
      extraction_model: "m",
      guard_refs: ["4471"],
    });
    expect(result.incidents).toEqual([
      { category_code: "alarm_response", reported_at: new Date("2026-03-29T00:42:00Z") },
    ]);
    expect(result.job).toEqual({
      status: "done",
      result: { status: "needs_review", model: "m", prompt_version: "v" },
      locked_by: null,
    });
    expect(result.msg.status).toBe("needs_review");
  });

  it("marks the message processed only when every report is ok", async () => {
    const site = (
      await db.client.query("select id from public.sites where organization_id = $1 limit 1", [
        ORGS.noord,
      ])
    ).rows[0]!.id;
    const status = await db.as(service, async (q) => {
      const id = await ingest(q);
      const [job] = await claim(q);
      await q("select public.complete_processing_job($1, 'w1', $2)", [
        job!.id,
        JSON.stringify({
          status: "ok",
          model: "m",
          prompt_version: "v",
          reports: [report({ site_id: site, status: "ok", review_reasons: [] })],
        }),
      ]);
      return (await q("select status from public.inbound_messages where id = $1", [id])).rows[0]!
        .status;
    });
    expect(status).toBe("processed");
  });

  it("rejects completion by a worker that does not hold the job", async () => {
    const err = await db.as(service, async (q) => {
      await ingest(q);
      const [job] = await claim(q, "w1");
      return attempt(q, "select public.complete_processing_job($1, 'other', '{}')", [job!.id]);
    });
    expect(err?.code).toBe("55000");
  });

  it("rejects an incident category the organization does not have", async () => {
    const err = await db.as(service, async (q) => {
      await ingest(q);
      const [job] = await claim(q);
      const bad = report({ incidents: [{ category_code: "ufo", severity: "low" }] });
      return attempt(q, "select public.complete_processing_job($1, 'w1', $2)", [
        job!.id,
        JSON.stringify({ status: "x", model: "m", prompt_version: "v", reports: [bad] }),
      ]);
    });
    expect(err?.code).toBe("23503");
  });
});

describe("fail_processing_job", () => {
  it("retries with backoff, then gives up and hands the message to a human", async () => {
    const result = await db.as(service, async (q) => {
      const id = await ingest(q);
      await q("update public.processing_jobs set max_attempts = 2 where inbound_message_id = $1", [
        id,
      ]);
      const [job] = await claim(q);
      const first = (
        await q("select public.fail_processing_job($1, 'w1', 'rate limited') as s", [job!.id])
      ).rows[0]!.s;
      const afterFirst = (
        await q(
          "select run_after > now() + interval '50 seconds' as delayed, last_error from public.processing_jobs where id = $1",
          [job!.id],
        )
      ).rows[0]!;
      await q("update public.processing_jobs set run_after = now() where id = $1", [job!.id]);
      await claim(q);
      const second = (
        await q("select public.fail_processing_job($1, 'w1', 'rate limited again') as s", [job!.id])
      ).rows[0]!.s;
      const msg = (await q("select status from public.inbound_messages where id = $1", [id]))
        .rows[0]!.status;
      return { first, afterFirst, second, msg };
    });
    expect(result.first).toBe("queued");
    expect(result.afterFirst).toEqual({ delayed: true, last_error: "rate limited" });
    expect(result.second).toBe("failed");
    expect(result.msg).toBe("failed");
  });

  it("does not retry non-retryable errors", async () => {
    const status = await db.as(service, async (q) => {
      await ingest(q);
      const [job] = await claim(q);
      return (
        await q("select public.fail_processing_job($1, 'w1', 'bad file', false) as s", [job!.id])
      ).rows[0]!.s;
    });
    expect(status).toBe("failed");
  });
});

describe("requeue_inbound_message", () => {
  it("lets a member reprocess their own message, but not another organization's", async () => {
    const msg = await db.client.query(
      "select inbound_message_id as id from public.ingest_inbound_message($1, 'email', '<requeue@test>', null, 'x', null, now(), 'p', null, '[]')",
      [ORGS.noord],
    );
    const id = msg.rows[0]!.id;
    await db.client.query(
      "update public.processing_jobs set status = 'done' where inbound_message_id = $1",
      [id],
    );

    const own = await db.as({ role: "authenticated", userId: USERS.noordPlanner }, (q) =>
      attempt(q, "select public.requeue_inbound_message($1)", [id]),
    );
    const other = await db.as({ role: "authenticated", userId: USERS.zuidOwner }, (q) =>
      attempt(q, "select public.requeue_inbound_message($1)", [id]),
    );
    expect(own).toBeNull();
    expect(other?.code).toBe("42501");
  });

  it("never overwrites reports a human has reviewed", async () => {
    const msg = await db.client.query(
      "select inbound_message_id as id from public.ingest_inbound_message($1, 'email', '<reviewed@test>', null, 'x', null, now(), 'p', null, '[]')",
      [ORGS.noord],
    );
    const id = msg.rows[0]!.id;
    await db.client.query(
      `insert into public.shift_reports (organization_id, inbound_message_id, shift_type, confidence, status, extraction_model, prompt_version, reviewed_by)
       values ($1, $2, 'other', 0.5, 'rejected', 'm', 'v', $3)`,
      [ORGS.noord, id, USERS.noordPlanner],
    );
    const results = await db.as(service, async (q) => {
      const requeue = await attempt(q, "select public.requeue_inbound_message($1)", [id]);
      const [job] = await claim(q);
      const complete = await attempt(q, "select public.complete_processing_job($1, 'w1', $2)", [
        job!.id,
        JSON.stringify({ status: "ok", reports: [] }),
      ]);
      return { requeue, complete };
    });
    expect(results.requeue?.message).toMatch(/reviewed reports/);
    expect(results.complete?.message).toMatch(/reviewed reports/);
  });
});

describe("worker ↔ database contract", () => {
  it("stores the worker payload for a real fixture (two sites, four incidents)", async () => {
    const { readFile } = await import("node:fs/promises");
    const { validateExtraction, loadConfig, EXTRACTION_PROMPT_VERSION } =
      await import("../../packages/core/src/index.js");
    const { toCompletionPayload } = await import("../../services/worker/src/process.js");
    const gold = JSON.parse(
      await readFile(
        new URL(
          "../../eval/fixtures/02-surveillance-meerdere-incidenten.txt.expected.json",
          import.meta.url,
        ),
        "utf8",
      ),
    );
    const validation = validateExtraction(gold.output, loadConfig({}));
    const payload = toCompletionPayload({
      model: "test",
      promptVersion: EXTRACTION_PROMPT_VERSION,
      attempts: 1,
      output: gold.output,
      validation,
      errors: [],
      skippedFiles: [],
      usage: { inputTokens: 1, outputTokens: 1 },
    });

    const result = await db.as(service, async (q) => {
      const id = await ingest(q);
      const [job] = await claim(q);
      await q("select public.complete_processing_job($1, 'w1', $2)", [
        job!.id,
        JSON.stringify(payload),
      ]);
      return (
        await q(
          `select r.site_name_raw, count(i.id)::int as incidents, r.status
           from public.shift_reports r left join public.incidents i on i.shift_report_id = r.id
           where r.inbound_message_id = $1 group by r.id order by r.site_name_raw`,
          [id],
        )
      ).rows;
    });
    expect(result).toEqual([
      { site_name_raw: "Bedrijventerrein De Hooge Akker", incidents: 2, status: "needs_review" },
      { site_name_raw: "Sportpark Het Veld", incidents: 2, status: "needs_review" },
    ]);
  });
});
