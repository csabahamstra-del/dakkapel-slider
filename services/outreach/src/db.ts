/**
 * Local SQLite ledger next to Notion. Notion is the CRM for humans; this database is the
 * durable record the safety checks rely on: what was sent (send limits, idempotency), the audit
 * log and a copy of the unsubscribe list.
 */
import { mkdirSync } from "node:fs";
import { dirname } from "node:path";
import { DatabaseSync } from "node:sqlite";

export type Db = DatabaseSync;

const MIGRATIONS: string[] = [
  `
  create table audit_log (
    id integer primary key,
    at text not null,
    action text not null,
    subject text,
    outcome text not null,
    reason text,
    details text
  );
  create index audit_log_at on audit_log (at);

  -- Unsubscribe list (email addresses and domains). Rows are never deleted.
  create table suppressions (
    value text primary key,
    kind text not null check (kind in ('email', 'domain')),
    reason text,
    source text not null,
    created_at text not null,
    notion_page_id text
  );

  -- Every outgoing mail (sent or, in shadow mode, drafted). Rows are reserved before the
  -- send and never deleted, so the limits count everything that may have gone out.
  create table outbound_messages (
    id integer primary key,
    idempotency_key text not null unique,
    lead_id text not null,
    to_email text not null,
    step integer not null,
    is_first_contact integer not null check (is_first_contact in (0, 1)),
    mode text not null check (mode in ('shadow', 'live')),
    status text not null check (status in ('reserved', 'sent', 'drafted', 'failed')),
    message_id text,
    error text,
    created_at text not null,
    updated_at text not null
  );
  create index outbound_messages_created_at on outbound_messages (created_at);

  create table state (
    key text primary key,
    value text not null,
    updated_at text not null
  );
  `,
];

export function openDb(path: string): Db {
  if (path !== ":memory:") mkdirSync(dirname(path), { recursive: true });
  const db = new DatabaseSync(path);
  db.exec("pragma journal_mode = wal; pragma foreign_keys = on; pragma busy_timeout = 5000;");
  migrate(db);
  return db;
}

function migrate(db: Db): void {
  const row = db.prepare("pragma user_version").get() as { user_version: number };
  for (let version = row.user_version; version < MIGRATIONS.length; version++) {
    db.exec("begin");
    try {
      db.exec(MIGRATIONS[version]!);
      db.exec(`pragma user_version = ${version + 1}`);
      db.exec("commit");
    } catch (error) {
      db.exec("rollback");
      throw error;
    }
  }
}

export function getState(db: Db, key: string): string | undefined {
  const row = db.prepare("select value from state where key = ?").get(key) as
    { value: string } | undefined;
  return row?.value;
}

export function setState(db: Db, key: string, value: string, now = new Date()): void {
  db.prepare(
    `insert into state (key, value, updated_at) values (?, ?, ?)
     on conflict (key) do update set value = excluded.value, updated_at = excluded.updated_at`,
  ).run(key, value, now.toISOString());
}
