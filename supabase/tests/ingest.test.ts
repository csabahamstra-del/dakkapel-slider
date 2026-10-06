import { afterAll, beforeAll, describe, expect, it } from "vitest";
import { ORGS, USERS, attempt, createTestDb, type TestDb } from "./db.js";

let db: TestDb;
beforeAll(async () => {
  db = await createTestDb();
});
afterAll(async () => {
  await db?.drop();
});

const service = { role: "service_role" } as const;
const ingest = `select * from public.ingest_inbound_message($1, 'email', $2, 'meldkamer@noordwacht.test',
  'noordwacht@in.veryo.test', 'Dienstrapport', now(), $3, null, $4::jsonb)`;
const attachments = JSON.stringify([
  { filename: "r.pdf", content_type: "application/pdf", size: 4, storage_path: "x/r.pdf" },
]);

describe("ingest_inbound_message", () => {
  it("records the message and queues one extraction job", async () => {
    const result = await db.as(service, async (q) => {
      const { rows } = await q(ingest, [
        ORGS.noord,
        "<m1@test>",
        `${ORGS.noord}/k1/message.json`,
        attachments,
      ]);
      const jobs = await q(
        "select kind, status from public.processing_jobs where inbound_message_id = $1",
        [rows[0]!.inbound_message_id],
      );
      const msg = await q("select attachments, status from public.inbound_messages where id = $1", [
        rows[0]!.inbound_message_id,
      ]);
      return { duplicate: rows[0]!.duplicate, jobs: jobs.rows, msg: msg.rows[0]! };
    });
    expect(result.duplicate).toBe(false);
    expect(result.jobs).toEqual([{ kind: "extract", status: "queued" }]);
    expect(result.msg.status).toBe("received");
    expect(result.msg.attachments[0].filename).toBe("r.pdf");
  });

  it("is idempotent per organization: a retry returns the same message and no second job", async () => {
    const result = await db.as(service, async (q) => {
      const first = (await q(ingest, [ORGS.noord, "<m2@test>", "p", "[]"])).rows[0]!;
      const second = (await q(ingest, [ORGS.noord, "<m2@test>", "p", "[]"])).rows[0]!;
      const otherOrg = (await q(ingest, [ORGS.zuid, "<m2@test>", "p", "[]"])).rows[0]!;
      const jobs = (
        await q(
          "select count(*)::int as n from public.processing_jobs pj join public.inbound_messages m on m.id = pj.inbound_message_id where m.external_id = '<m2@test>'",
        )
      ).rows[0]!.n;
      return { first, second, otherOrg, jobs };
    });
    expect(result.second).toEqual({
      inbound_message_id: result.first.inbound_message_id,
      duplicate: true,
    });
    expect(result.otherOrg.duplicate).toBe(false);
    expect(result.jobs).toBe(2);
  });

  it("cannot be called by signed-in users or anonymous visitors", async () => {
    const asUser = await db.as({ role: "authenticated", userId: USERS.noordOwner }, (q) =>
      attempt(q, ingest, [ORGS.noord, "<m3@test>", "p", "[]"]),
    );
    const asAnon = await db.as({ role: "anon" }, (q) =>
      attempt(q, ingest, [ORGS.noord, "<m3@test>", "p", "[]"]),
    );
    expect(asUser?.code).toBe("42501");
    expect(asAnon?.code).toBe("42501");
  });
});

describe("inbound storage bucket", () => {
  it("exists and is private", async () => {
    const { rows } = await db.client.query(
      "select public from storage.buckets where id = 'inbound'",
    );
    expect(rows).toEqual([{ public: false }]);
  });

  it("members only see originals of their own organization and cannot write", async () => {
    await db.client.query(
      "insert into storage.objects (bucket_id, name) values ('inbound', $1), ('inbound', $2), ('inbound', 'not-a-uuid/x.txt')",
      [`${ORGS.noord}/k/message.json`, `${ORGS.zuid}/k/message.json`],
    );
    const result = await db.as(
      { role: "authenticated", userId: USERS.noordPlanner },
      async (q) => ({
        visible: (await q("select name from storage.objects where bucket_id = 'inbound'")).rows.map(
          (r) => r.name,
        ),
        write: await attempt(
          q,
          "insert into storage.objects (bucket_id, name) values ('inbound', $1)",
          [`${ORGS.noord}/k/evil.pdf`],
        ),
        remove: (await q("delete from storage.objects where bucket_id = 'inbound'")).rowCount,
      }),
    );
    expect(result.visible).toEqual([`${ORGS.noord}/k/message.json`]);
    expect(result.write?.code).toBe("42501");
    expect(result.remove).toBe(0);
  });
});
