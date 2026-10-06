-- Veryo core schema: tenants, members, clients/sites, inbound data, extraction results,
-- monthly reports and audit log. Every table with customer data carries organization_id and
-- has Row Level Security enabled (hard rule 3).

create extension if not exists pgcrypto with schema extensions;

-- Helper functions live in a schema that is not exposed through the Supabase API.
create schema if not exists private;
revoke all on schema private from public;
grant usage on schema private to authenticated, service_role;

-------------------------------------------------------------------------------
-- Types
-------------------------------------------------------------------------------
create type public.member_role as enum ('owner', 'planner');
create type public.inbound_source as enum ('email', 'upload');
create type public.inbound_status as enum ('received', 'processing', 'processed', 'needs_review', 'failed');
create type public.job_status as enum ('queued', 'running', 'done', 'failed');
create type public.review_status as enum ('ok', 'needs_review', 'corrected', 'rejected');
create type public.severity as enum ('low', 'medium', 'high');
create type public.monthly_report_status as enum ('draft', 'approved', 'sent');

-------------------------------------------------------------------------------
-- Generic triggers
-------------------------------------------------------------------------------
create function private.set_updated_at() returns trigger
language plpgsql set search_path = '' as $$
begin
  new.updated_at := now();
  return new;
end;
$$;

-- Rows never move between tenants.
create function private.prevent_organization_change() returns trigger
language plpgsql set search_path = '' as $$
begin
  if new.organization_id is distinct from old.organization_id then
    raise exception 'organization_id cannot be changed' using errcode = '42501';
  end if;
  return new;
end;
$$;

-------------------------------------------------------------------------------
-- Organizations and members
-------------------------------------------------------------------------------
create table public.organizations (
  id uuid primary key default gen_random_uuid(),
  name text not null check (length(trim(name)) > 0),
  -- Local part of the inbound address, e.g. "<inbound_alias>@in.<domain>".
  inbound_alias text not null unique check (inbound_alias ~ '^[a-z0-9][a-z0-9-]{2,62}$'),
  -- White-label styling: logo path, colours, footer text.
  branding jsonb not null default '{}'::jsonb,
  settings jsonb not null default '{}'::jsonb,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

create table public.members (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null references public.organizations (id) on delete cascade,
  user_id uuid not null references auth.users (id) on delete cascade,
  role public.member_role not null default 'planner',
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (organization_id, user_id)
);
create index members_user_id_idx on public.members (user_id);

-- Membership checks used by RLS. SECURITY DEFINER avoids recursive RLS on members.
create function private.is_member(org uuid) returns boolean
language sql stable security definer set search_path = '' as $$
  select exists (
    select 1 from public.members m
    where m.organization_id = org and m.user_id = (select auth.uid())
  );
$$;

create function private.is_owner(org uuid) returns boolean
language sql stable security definer set search_path = '' as $$
  select exists (
    select 1 from public.members m
    where m.organization_id = org and m.user_id = (select auth.uid()) and m.role = 'owner'
  );
$$;

revoke all on function private.is_member(uuid), private.is_owner(uuid) from public;
grant execute on function private.is_member(uuid), private.is_owner(uuid) to authenticated, service_role;

-- An organization always keeps at least one owner.
create function private.keep_last_owner() returns trigger
language plpgsql set search_path = '' as $$
begin
  if old.role = 'owner'
     and (tg_op = 'DELETE' or new.role <> 'owner')
     and exists (select 1 from public.organizations o where o.id = old.organization_id)
     and not exists (
       select 1 from public.members m
       where m.organization_id = old.organization_id and m.role = 'owner' and m.id <> old.id
     ) then
    raise exception 'An organization must keep at least one owner' using errcode = '23514';
  end if;
  return coalesce(new, old);
end;
$$;

create trigger members_keep_last_owner before update or delete on public.members
  for each row execute function private.keep_last_owner();

-------------------------------------------------------------------------------
-- Clients and sites
-------------------------------------------------------------------------------
create table public.clients (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null references public.organizations (id) on delete cascade,
  name text not null check (length(trim(name)) > 0),
  contact_name text,
  contact_email text check (contact_email is null or contact_email ~* '^[^@\s]+@[^@\s]+\.[^@\s]+$'),
  active boolean not null default true,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (id, organization_id),
  unique (organization_id, name)
);

create table public.sites (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null,
  client_id uuid not null,
  name text not null check (length(trim(name)) > 0),
  street text,
  house_number text,
  postal_code text,
  city text,
  -- Alternative spellings seen in reports; used by site matching (phase 2d).
  aliases text[] not null default '{}',
  active boolean not null default true,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (id, organization_id),
  foreign key (client_id, organization_id) references public.clients (id, organization_id)
);
create index sites_client_idx on public.sites (organization_id, client_id);

-------------------------------------------------------------------------------
-- Inbound data (raw, never deleted — hard rule 5)
-------------------------------------------------------------------------------
create table public.inbound_messages (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null references public.organizations (id),
  source public.inbound_source not null,
  -- Provider message id (Mailgun Message-Id) for de-duplication of webhook retries.
  external_id text,
  sender text,
  recipient text,
  subject text,
  received_at timestamptz not null default now(),
  -- Storage paths of the untouched originals.
  raw_storage_path text,
  body_text_storage_path text,
  attachments jsonb not null default '[]'::jsonb check (jsonb_typeof(attachments) = 'array'),
  uploaded_by uuid references auth.users (id),
  status public.inbound_status not null default 'received',
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (id, organization_id),
  unique (organization_id, external_id)
);
create index inbound_messages_org_received_idx on public.inbound_messages (organization_id, received_at desc);

-- Only the processing status may change; the raw record is immutable and cannot be deleted.
create function private.protect_inbound_message() returns trigger
language plpgsql set search_path = '' as $$
begin
  if tg_op = 'DELETE' then
    raise exception 'inbound_messages are never deleted (raw data is kept for reprocessing)'
      using errcode = '42501';
  end if;
  if (to_jsonb(new) - 'status' - 'updated_at') is distinct from (to_jsonb(old) - 'status' - 'updated_at') then
    raise exception 'inbound_messages are immutable except for status' using errcode = '42501';
  end if;
  return new;
end;
$$;

create trigger inbound_messages_protect before update or delete on public.inbound_messages
  for each row execute function private.protect_inbound_message();

create table public.processing_jobs (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null,
  inbound_message_id uuid not null,
  kind text not null default 'extract',
  status public.job_status not null default 'queued',
  attempts integer not null default 0 check (attempts >= 0),
  max_attempts integer not null default 5 check (max_attempts > 0),
  run_after timestamptz not null default now(),
  locked_at timestamptz,
  locked_by text,
  last_error text,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  foreign key (inbound_message_id, organization_id) references public.inbound_messages (id, organization_id)
);
create index processing_jobs_queue_idx on public.processing_jobs (run_after) where status = 'queued';

-------------------------------------------------------------------------------
-- Extraction results
-------------------------------------------------------------------------------
create table public.incident_categories (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null references public.organizations (id) on delete cascade,
  code text not null check (code ~ '^[a-z][a-z0-9_]{1,62}$'),
  label text not null,
  active boolean not null default true,
  sort_order integer not null default 0,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (organization_id, code)
);

-- Keep in sync with DEFAULT_INCIDENT_CATEGORIES in packages/core/src/categories.ts.
create function private.seed_incident_categories() returns trigger
language plpgsql security definer set search_path = '' as $$
begin
  insert into public.incident_categories (organization_id, code, label, sort_order)
  values
    (new.id, 'burglary', 'Inbraak / insluiping', 1),
    (new.id, 'alarm_response', 'Alarmopvolging', 2),
    (new.id, 'fire', 'Brand / brandalarm', 3),
    (new.id, 'vandalism', 'Vandalisme', 4),
    (new.id, 'nuisance', 'Overlast', 5),
    (new.id, 'suspicious_situation', 'Verdachte situatie', 6),
    (new.id, 'medical', 'Medisch', 7),
    (new.id, 'technical_failure', 'Technische storing', 8),
    (new.id, 'open_door_window', 'Open deur / raam', 9),
    (new.id, 'other', 'Overig', 10);
  return new;
end;
$$;

create trigger organizations_seed_categories after insert on public.organizations
  for each row execute function private.seed_incident_categories();

create table public.shift_reports (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null,
  inbound_message_id uuid not null,
  -- Set by site matching (phase 2d); null until matched.
  site_id uuid,
  -- Values as extracted, kept for matching and review.
  site_name_raw text,
  site_address_raw text,
  client_name_raw text,
  shift_start timestamptz,
  shift_end timestamptz,
  shift_type text not null check (shift_type in ('static_guarding', 'mobile_patrol', 'alarm_response', 'event', 'reception', 'other')),
  guard_refs text[] not null default '{}',
  summary text not null default '',
  remarks text[] not null default '{}',
  confidence numeric(3, 2) not null check (confidence between 0 and 1),
  uncertainties text[] not null default '{}',
  status public.review_status not null,
  review_reasons jsonb not null default '[]'::jsonb check (jsonb_typeof(review_reasons) = 'array'),
  extraction_model text not null,
  prompt_version text not null,
  reviewed_by uuid references auth.users (id),
  reviewed_at timestamptz,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (id, organization_id),
  foreign key (inbound_message_id, organization_id) references public.inbound_messages (id, organization_id),
  foreign key (site_id, organization_id) references public.sites (id, organization_id),
  -- A report only counts (ok/corrected) once it is linked to a known site.
  check (status not in ('ok', 'corrected') or site_id is not null)
);
create index shift_reports_site_period_idx on public.shift_reports (organization_id, site_id, shift_start);
create index shift_reports_review_idx on public.shift_reports (organization_id, created_at) where status = 'needs_review';

create table public.incidents (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null,
  shift_report_id uuid not null,
  category_code text not null,
  reported_at timestamptz,
  arrived_at timestamptz,
  severity public.severity not null,
  summary text not null default '',
  involved_roles text[] not null default '{}',
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  foreign key (shift_report_id, organization_id) references public.shift_reports (id, organization_id) on delete cascade,
  foreign key (organization_id, category_code) references public.incident_categories (organization_id, code)
);
create index incidents_report_idx on public.incidents (shift_report_id);
create index incidents_org_reported_idx on public.incidents (organization_id, reported_at);

-------------------------------------------------------------------------------
-- Monthly reports (never sent without human approval — hard rule 9)
-------------------------------------------------------------------------------
create table public.monthly_reports (
  id uuid primary key default gen_random_uuid(),
  organization_id uuid not null,
  client_id uuid not null,
  period date not null check (extract(day from period) = 1),
  status public.monthly_report_status not null default 'draft',
  metrics jsonb not null default '{}'::jsonb,
  narrative jsonb not null default '{}'::jsonb,
  pdf_storage_path text,
  approved_by uuid references auth.users (id),
  approved_at timestamptz,
  sent_at timestamptz,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  unique (organization_id, client_id, period),
  foreign key (client_id, organization_id) references public.clients (id, organization_id),
  check (status = 'draft' or (approved_by is not null and approved_at is not null)),
  check (status <> 'sent' or sent_at is not null)
);

-- Allowed transitions: draft -> approved -> sent, approved -> draft (reopen). Sent is final.
-- Approval is always attributed to the acting user.
create function private.guard_monthly_report() returns trigger
language plpgsql set search_path = '' as $$
begin
  if old.status = 'sent' then
    raise exception 'A sent monthly report cannot be changed' using errcode = '42501';
  end if;

  if new.status is distinct from old.status then
    if not (
      (old.status = 'draft' and new.status = 'approved') or
      (old.status = 'approved' and new.status in ('draft', 'sent'))
    ) then
      raise exception 'Invalid status transition % -> %', old.status, new.status using errcode = '23514';
    end if;

    if new.status = 'approved' then
      if auth.uid() is null then
        raise exception 'Approval requires a signed-in user' using errcode = '42501';
      end if;
      new.approved_by := auth.uid();
      new.approved_at := now();
    elsif new.status = 'draft' then
      new.approved_by := null;
      new.approved_at := null;
    elsif new.status = 'sent' then
      new.sent_at := now();
    end if;
  elsif old.status = 'approved' and (
    new.metrics is distinct from old.metrics or
    new.narrative is distinct from old.narrative or
    new.pdf_storage_path is distinct from old.pdf_storage_path
  ) then
    raise exception 'Reopen the report (status draft) before changing approved content' using errcode = '42501';
  end if;

  return new;
end;
$$;

create trigger monthly_reports_guard before update on public.monthly_reports
  for each row execute function private.guard_monthly_report();

-------------------------------------------------------------------------------
-- Audit log (append-only)
-------------------------------------------------------------------------------
create table public.audit_log (
  id bigint generated always as identity primary key,
  organization_id uuid not null references public.organizations (id),
  actor_user_id uuid references auth.users (id),
  action text not null,
  entity_type text not null,
  entity_id uuid,
  details jsonb not null default '{}'::jsonb,
  created_at timestamptz not null default now()
);
create index audit_log_org_created_idx on public.audit_log (organization_id, created_at desc);

create function private.audit_log_append_only() returns trigger
language plpgsql set search_path = '' as $$
begin
  raise exception 'audit_log is append-only' using errcode = '42501';
end;
$$;

create trigger audit_log_append_only before update or delete on public.audit_log
  for each row execute function private.audit_log_append_only();

-- Status changes of monthly reports and reviews of shift reports are logged automatically.
create function private.audit_status_change() returns trigger
language plpgsql security definer set search_path = '' as $$
begin
  if new.status is distinct from old.status then
    insert into public.audit_log (organization_id, actor_user_id, action, entity_type, entity_id, details)
    values (
      new.organization_id,
      auth.uid(),
      'status_changed',
      tg_table_name,
      new.id,
      jsonb_build_object('from', old.status, 'to', new.status)
    );
  end if;
  return new;
end;
$$;

-- A human review is always attributed to the acting user.
create function private.stamp_shift_report_review() returns trigger
language plpgsql set search_path = '' as $$
begin
  if new.status is distinct from old.status and auth.uid() is not null then
    new.reviewed_by := auth.uid();
    new.reviewed_at := now();
  end if;
  return new;
end;
$$;

create trigger shift_reports_stamp_review before update on public.shift_reports
  for each row execute function private.stamp_shift_report_review();

create trigger monthly_reports_audit after update on public.monthly_reports
  for each row execute function private.audit_status_change();
create trigger shift_reports_audit after update on public.shift_reports
  for each row execute function private.audit_status_change();

-------------------------------------------------------------------------------
-- updated_at and tenant-immutability triggers
-------------------------------------------------------------------------------
do $$
declare
  t text;
begin
  foreach t in array array[
    'organizations', 'members', 'clients', 'sites', 'inbound_messages', 'processing_jobs',
    'incident_categories', 'shift_reports', 'incidents', 'monthly_reports'
  ] loop
    execute format(
      'create trigger %1$s_set_updated_at before update on public.%1$I for each row execute function private.set_updated_at()', t);
  end loop;

  foreach t in array array[
    'members', 'clients', 'sites', 'inbound_messages', 'processing_jobs',
    'incident_categories', 'shift_reports', 'incidents', 'monthly_reports'
  ] loop
    execute format(
      'create trigger %1$s_prevent_org_change before update on public.%1$I for each row execute function private.prevent_organization_change()', t);
  end loop;
end;
$$;

-------------------------------------------------------------------------------
-- Row Level Security
-------------------------------------------------------------------------------
alter table public.organizations enable row level security;
alter table public.members enable row level security;
alter table public.clients enable row level security;
alter table public.sites enable row level security;
alter table public.inbound_messages enable row level security;
alter table public.processing_jobs enable row level security;
alter table public.incident_categories enable row level security;
alter table public.shift_reports enable row level security;
alter table public.incidents enable row level security;
alter table public.monthly_reports enable row level security;
alter table public.audit_log enable row level security;

-- The anonymous role never touches tenant data.
revoke all on all tables in schema public from anon;

-- organizations: members read, owners update. Creation happens server-side during onboarding.
create policy organizations_select on public.organizations for select to authenticated
  using ((select private.is_member(id)));
create policy organizations_update on public.organizations for update to authenticated
  using ((select private.is_owner(id))) with check ((select private.is_owner(id)));

-- members: members see colleagues, owners manage membership.
create policy members_select on public.members for select to authenticated
  using ((select private.is_member(organization_id)));
create policy members_insert on public.members for insert to authenticated
  with check ((select private.is_owner(organization_id)));
create policy members_update on public.members for update to authenticated
  using ((select private.is_owner(organization_id))) with check ((select private.is_owner(organization_id)));
create policy members_delete on public.members for delete to authenticated
  using ((select private.is_owner(organization_id)));

-- clients and sites: members manage, owners delete.
create policy clients_select on public.clients for select to authenticated
  using ((select private.is_member(organization_id)));
create policy clients_insert on public.clients for insert to authenticated
  with check ((select private.is_member(organization_id)));
create policy clients_update on public.clients for update to authenticated
  using ((select private.is_member(organization_id))) with check ((select private.is_member(organization_id)));
create policy clients_delete on public.clients for delete to authenticated
  using ((select private.is_owner(organization_id)));

create policy sites_select on public.sites for select to authenticated
  using ((select private.is_member(organization_id)));
create policy sites_insert on public.sites for insert to authenticated
  with check ((select private.is_member(organization_id)));
create policy sites_update on public.sites for update to authenticated
  using ((select private.is_member(organization_id))) with check ((select private.is_member(organization_id)));
create policy sites_delete on public.sites for delete to authenticated
  using ((select private.is_owner(organization_id)));

-- inbound_messages: members read and upload; processing updates run as service_role.
create policy inbound_messages_select on public.inbound_messages for select to authenticated
  using ((select private.is_member(organization_id)));
create policy inbound_messages_insert on public.inbound_messages for insert to authenticated
  with check (
    (select private.is_member(organization_id))
    and source = 'upload'
    and uploaded_by = (select auth.uid())
    and status = 'received'
  );

-- processing_jobs: read-only for members.
create policy processing_jobs_select on public.processing_jobs for select to authenticated
  using ((select private.is_member(organization_id)));

-- incident_categories: members read, owners manage (deactivate instead of delete).
create policy incident_categories_select on public.incident_categories for select to authenticated
  using ((select private.is_member(organization_id)));
create policy incident_categories_insert on public.incident_categories for insert to authenticated
  with check ((select private.is_owner(organization_id)));
create policy incident_categories_update on public.incident_categories for update to authenticated
  using ((select private.is_owner(organization_id))) with check ((select private.is_owner(organization_id)));

-- shift_reports: created by processing (service_role); members review and correct.
create policy shift_reports_select on public.shift_reports for select to authenticated
  using ((select private.is_member(organization_id)));
create policy shift_reports_update on public.shift_reports for update to authenticated
  using ((select private.is_member(organization_id))) with check ((select private.is_member(organization_id)));

-- incidents: members may correct, add or remove incidents during review.
create policy incidents_select on public.incidents for select to authenticated
  using ((select private.is_member(organization_id)));
create policy incidents_insert on public.incidents for insert to authenticated
  with check ((select private.is_member(organization_id)));
create policy incidents_update on public.incidents for update to authenticated
  using ((select private.is_member(organization_id))) with check ((select private.is_member(organization_id)));
create policy incidents_delete on public.incidents for delete to authenticated
  using ((select private.is_member(organization_id)));

-- monthly_reports: generated server-side; members review, approve and send (trigger guards transitions).
create policy monthly_reports_select on public.monthly_reports for select to authenticated
  using ((select private.is_member(organization_id)));
create policy monthly_reports_update on public.monthly_reports for update to authenticated
  using ((select private.is_member(organization_id))) with check ((select private.is_member(organization_id)));

-- audit_log: members read; explicit entries only as themselves.
create policy audit_log_select on public.audit_log for select to authenticated
  using ((select private.is_member(organization_id)));
create policy audit_log_insert on public.audit_log for insert to authenticated
  with check ((select private.is_member(organization_id)) and actor_user_id = (select auth.uid()));
