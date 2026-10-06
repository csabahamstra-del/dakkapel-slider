-- Phase 2b: storage for raw inbound mail and an atomic, idempotent ingest function.

-- Private bucket for untouched originals. Layout: <organization_id>/<message key>/...
insert into storage.buckets (id, name, public)
values ('inbound', 'inbound', false)
on conflict (id) do nothing;

-- Members can read the originals of their own organization. There are no insert/update/delete
-- policies: only the server (service_role) writes, and it never overwrites (hard rule 5).
create policy inbound_objects_select on storage.objects for select to authenticated
  using (
    bucket_id = 'inbound'
    and (storage.foldername(name))[1] ~ '^[0-9a-f-]{36}$'
    and (select private.is_member(((storage.foldername(name))[1])::uuid))
  );

-- Records a message and queues its extraction job in one transaction.
-- Idempotent on (organization_id, external_id): a webhook retry returns the existing message.
create function public.ingest_inbound_message(
  p_organization_id uuid,
  p_source public.inbound_source,
  p_external_id text,
  p_sender text,
  p_recipient text,
  p_subject text,
  p_received_at timestamptz,
  p_raw_storage_path text,
  p_body_text_storage_path text,
  p_attachments jsonb
) returns table (inbound_message_id uuid, duplicate boolean)
language plpgsql security definer set search_path = '' as $$
declare
  v_id uuid;
begin
  insert into public.inbound_messages (
    organization_id, source, external_id, sender, recipient, subject, received_at,
    raw_storage_path, body_text_storage_path, attachments
  ) values (
    p_organization_id, p_source, p_external_id, p_sender, p_recipient, p_subject,
    coalesce(p_received_at, now()), p_raw_storage_path, p_body_text_storage_path,
    coalesce(p_attachments, '[]'::jsonb)
  )
  on conflict (organization_id, external_id) do nothing
  returning id into v_id;

  if v_id is null then
    select m.id into v_id from public.inbound_messages m
    where m.organization_id = p_organization_id and m.external_id = p_external_id;
    return query select v_id, true;
    return;
  end if;

  insert into public.processing_jobs (organization_id, inbound_message_id, kind)
  values (p_organization_id, v_id, 'extract');

  return query select v_id, false;
end;
$$;

revoke all on function public.ingest_inbound_message(uuid, public.inbound_source, text, text, text, text, timestamptz, text, text, jsonb)
  from public, anon, authenticated;
grant execute on function public.ingest_inbound_message(uuid, public.inbound_source, text, text, text, text, timestamptz, text, text, jsonb)
  to service_role;
