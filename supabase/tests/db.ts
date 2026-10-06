import { readdir, readFile } from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";
import pg from "pg";

const SUPABASE_DIR = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");

export const ADMIN_URL =
  process.env.TEST_DATABASE_URL ?? "postgres://postgres:postgres@localhost:5432/postgres";

export const USERS = {
  noordOwner: "00000000-0000-4000-8000-00000000a001",
  noordPlanner: "00000000-0000-4000-8000-00000000a002",
  zuidOwner: "00000000-0000-4000-8000-00000000b001",
} as const;

export const ORGS = {
  noord: "10000000-0000-4000-8000-00000000000a",
  zuid: "10000000-0000-4000-8000-00000000000b",
} as const;

export const CLIENTS = {
  noord: "20000000-0000-4000-8000-00000000000a",
  zuid: "20000000-0000-4000-8000-00000000000b",
} as const;

export interface TestDb {
  client: pg.Client;
  /** Runs `fn` in a transaction as the given role and user; always rolled back. */
  as<T>(who: Who, fn: (q: Query) => Promise<T>): Promise<T>;
  drop(): Promise<void>;
}

export type Who =
  { role: "anon" } | { role: "service_role" } | { role: "authenticated"; userId: string };
export type Query = <R extends pg.QueryResultRow = pg.QueryResultRow>(
  sql: string,
  params?: unknown[],
) => Promise<pg.QueryResult<R>>;

/** Creates a fresh database with the Supabase shim, all migrations and the seed. */
export async function createTestDb(): Promise<TestDb> {
  const name = `veryo_test_${process.pid}_${Date.now()}`;
  const admin = new pg.Client({ connectionString: ADMIN_URL });
  await admin.connect();
  // Roles are cluster-wide; create them once.
  const roles = await admin.query("select 1 from pg_roles where rolname = 'service_role'");
  await admin.query(`create database ${name}`);
  await admin.end();

  const url = new URL(ADMIN_URL);
  url.pathname = `/${name}`;
  const client = new pg.Client({ connectionString: url.toString() });
  await client.connect();

  let shim = await readFile(path.join(SUPABASE_DIR, "tests", "supabase_shim.sql"), "utf8");
  if (roles.rowCount) shim = shim.replace(/^create role .*$/gm, "");
  await client.query(shim);

  const migrationsDir = path.join(SUPABASE_DIR, "migrations");
  for (const file of (await readdir(migrationsDir)).filter((f) => f.endsWith(".sql")).sort()) {
    await client.query(await readFile(path.join(migrationsDir, file), "utf8"));
  }
  await client.query(await readFile(path.join(SUPABASE_DIR, "seed.sql"), "utf8"));

  return {
    client,
    async as(who, fn) {
      await client.query("begin");
      try {
        await client.query(`set local role ${who.role}`);
        const claims =
          who.role === "authenticated"
            ? { sub: who.userId, role: "authenticated" }
            : { role: who.role };
        await client.query("select set_config('request.jwt.claims', $1, true)", [
          JSON.stringify(claims),
        ]);
        return await fn((sql, params) => client.query(sql, params));
      } finally {
        await client.query("rollback");
      }
    },
    async drop() {
      await client.end();
      const a = new pg.Client({ connectionString: ADMIN_URL });
      await a.connect();
      await a.query(`drop database if exists ${name} with (force)`);
      await a.end();
    },
  };
}

/** Runs a statement that may fail without aborting the surrounding transaction. */
export async function attempt(
  q: Query,
  sql: string,
  params?: unknown[],
): Promise<pg.DatabaseError | null> {
  await q("savepoint attempt");
  try {
    await q(sql, params);
    await q("release savepoint attempt");
    return null;
  } catch (error) {
    await q("rollback to savepoint attempt");
    return error as pg.DatabaseError;
  }
}
