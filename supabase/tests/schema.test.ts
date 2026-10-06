import { DEFAULT_INCIDENT_CATEGORIES } from "../../packages/core/src/categories.js";
import { afterAll, beforeAll, describe, expect, it } from "vitest";
import { CLIENTS, ORGS, USERS, attempt, createTestDb, type TestDb } from "./db.js";

let db: TestDb;
beforeAll(async () => {
  db = await createTestDb();
});
afterAll(async () => {
  await db?.drop();
});

const noordPlanner = { role: "authenticated", userId: USERS.noordPlanner } as const;
const noordOwner = { role: "authenticated", userId: USERS.noordOwner } as const;
const zuidOwner = { role: "authenticated", userId: USERS.zuidOwner } as const;
const service = { role: "service_role" } as const;

describe("tenant guarantees (hard rule 3)", () => {
  it("every public table has RLS enabled", async () => {
    const { rows } = await db.client.query<{ relname: string }>(
      `select c.relname from pg_class c join pg_namespace n on n.oid = c.relnamespace
       where n.nspname = 'public' and c.relkind = 'r' and not c.relrowsecurity`,
    );
    expect(rows.map((r) => r.relname)).toEqual([]);
  });

  it("every public table except organizations has organization_id", async () => {
    const { rows } = await db.client.query<{ table_name: string }>(
      `select t.table_name from information_schema.tables t
       where t.table_schema = 'public' and t.table_type = 'BASE TABLE' and t.table_name <> 'organizations'
         and not exists (select 1 from information_schema.columns c
                         where c.table_schema = 'public' and c.table_name = t.table_name and c.column_name = 'organization_id')`,
    );
    expect(rows.map((r) => r.table_name)).toEqual([]);
  });

  it("anon cannot read tenant data", async () => {
    const err = await db.as({ role: "anon" }, (q) => attempt(q, "select * from public.clients"));
    expect(err?.code).toBe("42501");
  });

  it.each(["organizations", "members", "clients", "sites", "incident_categories"])(
    "a member only sees their own organization in %s",
    async (table) => {
      const column = table === "organizations" ? "id" : "organization_id";
      const { rows } = await db.as(noordPlanner, (q) =>
        q(`select distinct ${column} as org from public.${table}`),
      );
      expect(rows.map((r) => r.org)).toEqual([ORGS.noord]);
    },
  );

  it("cannot insert data into another organization", async () => {
    const err = await db.as(noordOwner, (q) =>
      attempt(q, "insert into public.clients (organization_id, name) values ($1, 'Inbraak BV')", [
        ORGS.zuid,
      ]),
    );
    expect(err?.code).toBe("42501");
  });

  it("cannot update or delete another organization's rows", async () => {
    const result = await db.as(noordOwner, async (q) => ({
      updated: (
        await q("update public.clients set name = 'gekaapt' where organization_id = $1", [
          ORGS.zuid,
        ])
      ).rowCount,
      deleted: (await q("delete from public.sites where organization_id = $1", [ORGS.zuid]))
        .rowCount,
    }));
    expect(result).toEqual({ updated: 0, deleted: 0 });
  });

  it("rows cannot be moved to another organization", async () => {
    const err = await db.as(service, (q) =>
      attempt(q, "update public.clients set organization_id = $1 where id = $2", [
        ORGS.zuid,
        CLIENTS.noord,
      ]),
    );
    expect(err?.message).toMatch(/organization_id cannot be changed/);
  });

  it("a site cannot belong to a client of another organization", async () => {
    const err = await db.as(service, (q) =>
      attempt(
        q,
        "insert into public.sites (organization_id, client_id, name) values ($1, $2, 'X')",
        [ORGS.noord, CLIENTS.zuid],
      ),
    );
    expect(err?.code).toBe("23503");
  });

  it("a user in two organizations sees both", async () => {
    await db.client.query("insert into public.members (organization_id, user_id) values ($1, $2)", [
      ORGS.zuid,
      USERS.noordPlanner,
    ]);
    const { rows } = await db.as(noordPlanner, (q) =>
      q("select id from public.organizations order by name"),
    );
    await db.client.query(
      "delete from public.members where organization_id = $1 and user_id = $2",
      [ORGS.zuid, USERS.noordPlanner],
    );
    expect(rows.map((r) => r.id)).toEqual([ORGS.noord, ORGS.zuid]);
  });
});

describe("members and roles", () => {
  it("planners cannot add members, owners can", async () => {
    const sql = "insert into public.members (organization_id, user_id) values ($1, $2)";
    const asPlanner = await db.as(noordPlanner, (q) =>
      attempt(q, sql, [ORGS.noord, USERS.zuidOwner]),
    );
    const asOwner = await db.as(noordOwner, (q) => attempt(q, sql, [ORGS.noord, USERS.zuidOwner]));
    expect(asPlanner?.code).toBe("42501");
    expect(asOwner).toBeNull();
  });

  it("planners cannot change organization settings", async () => {
    const updated = await db.as(
      noordPlanner,
      async (q) =>
        (await q("update public.organizations set name = 'x' where id = $1", [ORGS.noord]))
          .rowCount,
    );
    expect(updated).toBe(0);
  });

  it("the last owner cannot be removed or demoted", async () => {
    const del = await db.as(zuidOwner, (q) =>
      attempt(q, "delete from public.members where user_id = $1", [USERS.zuidOwner]),
    );
    const demote = await db.as(zuidOwner, (q) =>
      attempt(q, "update public.members set role = 'planner' where user_id = $1", [
        USERS.zuidOwner,
      ]),
    );
    expect(del?.message).toMatch(/at least one owner/);
    expect(demote?.message).toMatch(/at least one owner/);
  });
});

describe("incident categories", () => {
  it("new organizations get the default set from packages/core", async () => {
    const { rows } = await db.client.query<{ code: string; label: string }>(
      "select code, label from public.incident_categories where organization_id = $1 order by sort_order",
      [ORGS.noord],
    );
    expect(rows).toEqual(DEFAULT_INCIDENT_CATEGORIES.map(({ code, label }) => ({ code, label })));
  });
});

async function insertMessage(
  q: Parameters<Parameters<TestDb["as"]>[1]>[0],
  org: string = ORGS.noord,
): Promise<string> {
  const { rows } = await q(
    `insert into public.inbound_messages (organization_id, source, external_id, sender, subject)
     values ($1, 'email', gen_random_uuid()::text, 'meldkamer@noordwacht.test', 'Dienstrapport') returning id`,
    [org],
  );
  return rows[0].id;
}

describe("raw inbound data (hard rule 5)", () => {
  it("members may upload as themselves but cannot fake e-mail or other uploaders", async () => {
    const sql =
      "insert into public.inbound_messages (organization_id, source, uploaded_by) values ($1, $2, $3)";
    const results = await db.as(noordPlanner, async (q) => [
      await attempt(q, sql, [ORGS.noord, "upload", USERS.noordPlanner]),
      await attempt(q, sql, [ORGS.noord, "email", USERS.noordPlanner]),
      await attempt(q, sql, [ORGS.noord, "upload", USERS.noordOwner]),
    ]);
    expect(results.map((e) => e?.code ?? "ok")).toEqual(["ok", "42501", "42501"]);
  });

  it("duplicate provider message ids are rejected per organization", async () => {
    const err = await db.as(service, async (q) => {
      const sql =
        "insert into public.inbound_messages (organization_id, source, external_id) values ($1, 'email', 'msg-1')";
      await q(sql, [ORGS.noord]);
      return attempt(q, sql, [ORGS.noord]);
    });
    expect(err?.code).toBe("23505");
  });

  it("only the status can change, and nothing can be deleted — not even by service_role", async () => {
    const results = await db.as(service, async (q) => {
      const id = await insertMessage(q);
      return {
        status: await attempt(
          q,
          "update public.inbound_messages set status = 'processed' where id = $1",
          [id],
        ),
        subject: await attempt(
          q,
          "update public.inbound_messages set subject = 'x' where id = $1",
          [id],
        ),
        remove: await attempt(q, "delete from public.inbound_messages where id = $1", [id]),
      };
    });
    expect(results.status).toBeNull();
    expect(results.subject?.message).toMatch(/immutable/);
    expect(results.remove?.message).toMatch(/never deleted/);
  });
});

describe("shift reports and incidents", () => {
  const insertReport = `
    insert into public.shift_reports (organization_id, inbound_message_id, site_id, shift_type, confidence, status, extraction_model, prompt_version)
    values ($1, $2, $3, 'static_guarding', 0.9, $4, 'test-model', 'test') returning id`;

  it("a report only counts as ok once it is linked to a site", async () => {
    const err = await db.as(service, async (q) =>
      attempt(q, insertReport, [ORGS.noord, await insertMessage(q), null, "ok"]),
    );
    expect(err?.code).toBe("23514");
  });

  it("members cannot insert reports; processing does that", async () => {
    const msg = await db.client.query(
      "insert into public.inbound_messages (organization_id, source, external_id) values ($1, 'email', 'member-insert-test') returning id",
      [ORGS.noord],
    );
    const err = await db.as(noordPlanner, (q) =>
      attempt(q, insertReport, [ORGS.noord, msg.rows[0].id, null, "needs_review"]),
    );
    expect(err?.code).toBe("42501");
  });

  it("incidents must use a category of the same organization", async () => {
    const results = await db.as(service, async (q) => {
      const report = (
        await q(insertReport, [ORGS.noord, await insertMessage(q), null, "needs_review"])
      ).rows[0].id;
      const sql =
        "insert into public.incidents (organization_id, shift_report_id, category_code, severity) values ($1, $2, $3, 'low')";
      return [
        await attempt(q, sql, [ORGS.noord, report, "fire"]),
        await attempt(q, sql, [ORGS.noord, report, "ufo"]),
      ];
    });
    expect(results[0]).toBeNull();
    expect(results[1]?.code).toBe("23503");
  });

  it("a review is stamped with the reviewer and written to the audit log", async () => {
    // Commit a report so the planner's transaction can see it.
    const msg = await db.client.query(
      "insert into public.inbound_messages (organization_id, source, external_id) values ($1, 'email', 'review-test') returning id",
      [ORGS.noord],
    );
    const report = await db.client.query(insertReport, [
      ORGS.noord,
      msg.rows[0].id,
      null,
      "needs_review",
    ]);
    const reportId = report.rows[0].id;

    const after = await db.as(noordPlanner, async (q) => {
      await q("update public.shift_reports set status = 'rejected' where id = $1", [reportId]);
      const r = await q("select reviewed_by from public.shift_reports where id = $1", [reportId]);
      const a = await q(
        "select actor_user_id, details from public.audit_log where entity_id = $1",
        [reportId],
      );
      return { reviewer: r.rows[0].reviewed_by, audit: a.rows };
    });
    expect(after.reviewer).toBe(USERS.noordPlanner);
    expect(after.audit).toEqual([
      { actor_user_id: USERS.noordPlanner, details: { from: "needs_review", to: "rejected" } },
    ]);
  });
});

describe("monthly reports (hard rule 9)", () => {
  let reportId: string;
  beforeAll(async () => {
    const { rows } = await db.client.query(
      "insert into public.monthly_reports (organization_id, client_id, period) values ($1, $2, '2026-03-01') returning id",
      [ORGS.noord, CLIENTS.noord],
    );
    reportId = rows[0].id;
  });

  const setStatus = "update public.monthly_reports set status = $2 where id = $1";

  it("only accepts the first day of a month as period", async () => {
    const err = await db.as(service, (q) =>
      attempt(
        q,
        "insert into public.monthly_reports (organization_id, client_id, period) values ($1, $2, '2026-03-15')",
        [ORGS.noord, CLIENTS.noord],
      ),
    );
    expect(err?.code).toBe("23514");
  });

  it("a draft cannot be sent without approval", async () => {
    const err = await db.as(noordPlanner, (q) => attempt(q, setStatus, [reportId, "sent"]));
    expect(err?.message).toMatch(/Invalid status transition draft -> sent/);
  });

  it("the system itself cannot approve", async () => {
    const err = await db.as(service, (q) => attempt(q, setStatus, [reportId, "approved"]));
    expect(err?.message).toMatch(/signed-in user/);
  });

  it("a member approves, approval is attributed and audited, then it can be sent", async () => {
    const result = await db.as(noordPlanner, async (q) => {
      await q(setStatus, [reportId, "approved"]);
      const editApproved = await attempt(
        q,
        "update public.monthly_reports set narrative = '{\"x\":1}' where id = $1",
        [reportId],
      );
      await q(setStatus, [reportId, "sent"]);
      const changeSent = await attempt(q, setStatus, [reportId, "draft"]);
      const row = (
        await q("select approved_by, sent_at from public.monthly_reports where id = $1", [reportId])
      ).rows[0];
      const audit = (
        await q("select details from public.audit_log where entity_id = $1 order by id", [reportId])
      ).rows;
      return { editApproved, changeSent, row, audit };
    });
    expect(result.editApproved?.message).toMatch(/Reopen the report/);
    expect(result.changeSent?.message).toMatch(/cannot be changed/);
    expect(result.row.approved_by).toBe(USERS.noordPlanner);
    expect(result.row.sent_at).not.toBeNull();
    expect(result.audit.map((a) => a.details)).toEqual([
      { from: "draft", to: "approved" },
      { from: "approved", to: "sent" },
    ]);
  });

  it("other organizations cannot see or approve it", async () => {
    const result = await db.as(zuidOwner, async (q) => ({
      visible: (await q("select 1 from public.monthly_reports where id = $1", [reportId])).rowCount,
      updated: (await q(setStatus, [reportId, "approved"])).rowCount,
    }));
    expect(result).toEqual({ visible: 0, updated: 0 });
  });
});

describe("audit log", () => {
  it("is append-only and users can only log as themselves", async () => {
    const results = await db.as(noordOwner, async (q) => {
      const sql =
        "insert into public.audit_log (organization_id, actor_user_id, action, entity_type) values ($1, $2, 'test', 'test')";
      return {
        self: await attempt(q, sql, [ORGS.noord, USERS.noordOwner]),
        other: await attempt(q, sql, [ORGS.noord, USERS.noordPlanner]),
      };
    });
    expect(results.self).toBeNull();
    expect(results.other?.code).toBe("42501");

    const tamper = await db.as(service, async (q) => {
      await q(
        "insert into public.audit_log (organization_id, action, entity_type) values ($1, 'test', 'test')",
        [ORGS.noord],
      );
      return [
        await attempt(q, "update public.audit_log set action = 'x'"),
        await attempt(q, "delete from public.audit_log"),
      ];
    });
    expect(tamper.map((e) => e?.message)).toEqual([
      "audit_log is append-only",
      "audit_log is append-only",
    ]);
  });
});
