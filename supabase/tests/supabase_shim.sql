-- Minimal stand-in for what a Supabase project provides, so migrations and RLS can be tested
-- against plain Postgres. NOT a migration: never run this against a real Supabase project.

create role anon nologin noinherit;
create role authenticated nologin noinherit;
create role service_role nologin noinherit bypassrls;

create schema auth;
create schema extensions;
grant usage on schema auth to anon, authenticated, service_role;

create table auth.users (
  id uuid primary key default gen_random_uuid(),
  email text unique,
  aud text default 'authenticated',
  role text default 'authenticated',
  created_at timestamptz default now()
);

-- Same contract as Supabase: the JWT subject from the request claims.
create function auth.uid() returns uuid language sql stable as $$
  select nullif(
    coalesce(
      current_setting('request.jwt.claim.sub', true),
      (nullif(current_setting('request.jwt.claims', true), '')::jsonb ->> 'sub')
    ),
    ''
  )::uuid
$$;
grant execute on function auth.uid() to anon, authenticated, service_role;

-- Supabase grants table privileges to the API roles by default and relies on RLS.
grant usage on schema public to anon, authenticated, service_role;
alter default privileges in schema public grant all on tables to anon, authenticated, service_role;
alter default privileges in schema public grant all on sequences to anon, authenticated, service_role;
alter default privileges in schema public grant all on functions to anon, authenticated, service_role;
