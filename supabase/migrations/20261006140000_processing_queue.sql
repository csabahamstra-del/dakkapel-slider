-- Phase 2c: processing queue. Workers claim jobs, store extraction results atomically, and
-- failed jobs are retried with backoff until they end up with a human (hard rule 8).

-- Summary of the last run: status, reasons, model, token usage. Kept for audit and cost tracking.
alter table public.processing_jobs add column result jsonb;

-- A job that has been 'running' this long is assumed to belong to a crashed worker.
create function private.job_lock_timeout() returns interval
language sql immutable as $$ select interval '15 minutes' $$;

-- Claims up to p_limit due jobs. SKIP LOCKED makes concurrent workers safe.
create function public.claim_processing_jobs(p_worker text, p_limit integer default 5)
returns setof public.processing_jobs
language plpgsql security definer set search_path = '' as $$
begin
  -- Abandoned jobs that already used all attempts go to a human instead of looping forever.
  with dead as (
    update public.processing_jobs j
    set status = 'failed', locked_at = null, locked_by = null,
        last_error = coalesce(j.last_error, 'Worker stopped while processing (lock timeout)')
    where j.status = 'running' and j.locked_at < now() - private.job_lock_timeout()
      and j.attempts >= j.max_attempts
    returning j.inbound_message_id
  )
  update public.inbound_messages m set status = 'failed' from dead where m.id = dead.inbound_message_id;

  return query
  with due as (
    select j.id from public.processing_jobs j
    where (j.status = 'queued' and j.run_after <= now())
       or (j.status = 'running' and j.locked_at < now() - private.job_lock_timeout())
    order by j.run_after
    limit greatest(p_limit, 0)
    for update skip locked
  ), claimed as (
    update public.processing_jobs j
    set status = 'running', locked_at = now(), locked_by = p_worker, attempts = j.attempts + 1
    from due where j.id = due.id
    returning j.*
  ), mark as (
    update public.inbound_messages m set status = 'processing'
    from claimed c where m.id = c.inbound_message_id
  )
  select * from claimed;
end;
$$;

-- Stores the extraction result for a claimed job in one transaction.
-- p_result: { status, reasons, model, prompt_version, ..., reports: [ { site_id, *_raw,
--   shift_start_local, shift_end_local, shift_type, guard_refs, summary, remarks, confidence,
--   uncertainties, status, review_reasons, incidents: [ { category_code, reported_at_local,
--   arrived_at_local, severity, summary, involved_roles } ] } ] }
-- Local times ("YYYY-MM-DDTHH:mm") are converted with Europe/Amsterdam rules, DST included.
create function public.complete_processing_job(p_job_id uuid, p_worker text, p_result jsonb)
returns void
language plpgsql security definer set search_path = '' as $$
declare
  v_job public.processing_jobs;
  v_report jsonb;
  v_incident jsonb;
  v_report_id uuid;
  v_all_ok boolean := true;
begin
  select * into v_job from public.processing_jobs where id = p_job_id for update;
  if v_job.id is null then
    raise exception 'Job % not found', p_job_id;
  end if;
  if v_job.status <> 'running' or v_job.locked_by is distinct from p_worker then
    raise exception 'Job % is not running for worker %', p_job_id, p_worker using errcode = '55000';
  end if;

  -- Reprocessing replaces earlier machine results, never human-reviewed ones.
  if exists (select 1 from public.shift_reports r
             where r.inbound_message_id = v_job.inbound_message_id and r.reviewed_by is not null) then
    raise exception 'Message % has reviewed reports; refusing to overwrite', v_job.inbound_message_id
      using errcode = '55000';
  end if;
  delete from public.shift_reports where inbound_message_id = v_job.inbound_message_id;

  for v_report in select * from jsonb_array_elements(coalesce(p_result -> 'reports', '[]'::jsonb)) loop
    insert into public.shift_reports (
      organization_id, inbound_message_id, site_id, site_name_raw, site_address_raw, client_name_raw,
      shift_start, shift_end, shift_type, guard_refs, summary, remarks, confidence, uncertainties,
      status, review_reasons, extraction_model, prompt_version
    ) values (
      v_job.organization_id,
      v_job.inbound_message_id,
      nullif(v_report ->> 'site_id', '')::uuid,
      v_report ->> 'site_name_raw',
      v_report ->> 'site_address_raw',
      v_report ->> 'client_name_raw',
      (v_report ->> 'shift_start_local')::timestamp at time zone 'Europe/Amsterdam',
      (v_report ->> 'shift_end_local')::timestamp at time zone 'Europe/Amsterdam',
      v_report ->> 'shift_type',
      array(select jsonb_array_elements_text(coalesce(v_report -> 'guard_refs', '[]'))),
      coalesce(v_report ->> 'summary', ''),
      array(select jsonb_array_elements_text(coalesce(v_report -> 'remarks', '[]'))),
      (v_report ->> 'confidence')::numeric,
      array(select jsonb_array_elements_text(coalesce(v_report -> 'uncertainties', '[]'))),
      (v_report ->> 'status')::public.review_status,
      coalesce(v_report -> 'review_reasons', '[]'),
      p_result ->> 'model',
      p_result ->> 'prompt_version'
    ) returning id into v_report_id;

    if (v_report ->> 'status') <> 'ok' then
      v_all_ok := false;
    end if;

    for v_incident in select * from jsonb_array_elements(coalesce(v_report -> 'incidents', '[]'::jsonb)) loop
      insert into public.incidents (
        organization_id, shift_report_id, category_code, reported_at, arrived_at, severity, summary, involved_roles
      ) values (
        v_job.organization_id,
        v_report_id,
        v_incident ->> 'category_code',
        (v_incident ->> 'reported_at_local')::timestamp at time zone 'Europe/Amsterdam',
        (v_incident ->> 'arrived_at_local')::timestamp at time zone 'Europe/Amsterdam',
        (v_incident ->> 'severity')::public.severity,
        coalesce(v_incident ->> 'summary', ''),
        array(select jsonb_array_elements_text(coalesce(v_incident -> 'involved_roles', '[]')))
      );
    end loop;
  end loop;

  update public.inbound_messages
  set status = case
    when (p_result ->> 'status') = 'ok' and v_all_ok and jsonb_array_length(coalesce(p_result -> 'reports', '[]')) > 0
      then 'processed'::public.inbound_status
    else 'needs_review'::public.inbound_status
  end
  where id = v_job.inbound_message_id;

  update public.processing_jobs
  set status = 'done', locked_at = null, locked_by = null, last_error = null, result = p_result - 'reports'
  where id = p_job_id;
end;
$$;

-- Records a failed attempt. Retryable errors go back to the queue with exponential backoff
-- (1, 2, 4, ... minutes, max 60); after max_attempts the message goes to a human.
create function public.fail_processing_job(p_job_id uuid, p_worker text, p_error text, p_retryable boolean default true)
returns public.job_status
language plpgsql security definer set search_path = '' as $$
declare
  v_job public.processing_jobs;
  v_status public.job_status;
begin
  select * into v_job from public.processing_jobs where id = p_job_id for update;
  if v_job.id is null or v_job.status <> 'running' or v_job.locked_by is distinct from p_worker then
    raise exception 'Job % is not running for worker %', p_job_id, p_worker using errcode = '55000';
  end if;

  v_status := case when p_retryable and v_job.attempts < v_job.max_attempts then 'queued' else 'failed' end;

  update public.processing_jobs
  set status = v_status,
      run_after = case when v_status = 'queued'
                       then now() + least(power(2, v_job.attempts - 1), 60) * interval '1 minute'
                       else run_after end,
      locked_at = null,
      locked_by = null,
      last_error = left(p_error, 2000)
  where id = p_job_id;

  update public.inbound_messages
  set status = case when v_status = 'failed' then 'failed'::public.inbound_status else 'received'::public.inbound_status end
  where id = v_job.inbound_message_id;

  return v_status;
end;
$$;

-- Queues a message for processing again (e.g. after a prompt improvement). Members may do this
-- for their own organization. Refused when a human already reviewed its reports.
create function public.requeue_inbound_message(p_inbound_message_id uuid)
returns uuid
language plpgsql security definer set search_path = '' as $$
declare
  v_org uuid;
  v_job_id uuid;
begin
  select organization_id into v_org from public.inbound_messages where id = p_inbound_message_id;
  if v_org is null or (auth.uid() is not null and not private.is_member(v_org)) then
    raise exception 'Message not found' using errcode = '42501';
  end if;
  if exists (select 1 from public.shift_reports r
             where r.inbound_message_id = p_inbound_message_id and r.reviewed_by is not null) then
    raise exception 'Message has reviewed reports and cannot be reprocessed' using errcode = '55000';
  end if;

  select id into v_job_id from public.processing_jobs
  where inbound_message_id = p_inbound_message_id and status in ('queued', 'running');
  if v_job_id is not null then
    return v_job_id;
  end if;

  insert into public.processing_jobs (organization_id, inbound_message_id, kind)
  values (v_org, p_inbound_message_id, 'extract')
  returning id into v_job_id;

  update public.inbound_messages set status = 'received' where id = p_inbound_message_id;
  return v_job_id;
end;
$$;

-- At most one open job per message.
create unique index processing_jobs_one_open_per_message
  on public.processing_jobs (inbound_message_id) where status in ('queued', 'running');

revoke all on function public.claim_processing_jobs(text, integer) from public, anon, authenticated;
revoke all on function public.complete_processing_job(uuid, text, jsonb) from public, anon, authenticated;
revoke all on function public.fail_processing_job(uuid, text, text, boolean) from public, anon, authenticated;
revoke all on function public.requeue_inbound_message(uuid) from public, anon;
grant execute on function public.claim_processing_jobs(text, integer) to service_role;
grant execute on function public.complete_processing_job(uuid, text, jsonb) to service_role;
grant execute on function public.fail_processing_job(uuid, text, text, boolean) to service_role;
grant execute on function public.requeue_inbound_message(uuid) to authenticated, service_role;
