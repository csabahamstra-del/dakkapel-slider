import { createClient, type SupabaseClient } from "@supabase/supabase-js";
import type { CompletionPayload, InboundMessage, Job } from "./process.js";

/** Queue and storage access with the service role. The service role key never leaves the worker. */
export class SupabaseQueue {
  private readonly db: SupabaseClient;

  constructor(
    url: string,
    serviceRoleKey: string,
    private readonly workerId: string,
  ) {
    this.db = createClient(url, serviceRoleKey, { auth: { persistSession: false } });
  }

  async claim(limit: number): Promise<Job[]> {
    const { data, error } = await this.db.rpc("claim_processing_jobs", {
      p_worker: this.workerId,
      p_limit: limit,
    });
    if (error) throw error;
    return data as Job[];
  }

  async getMessage(id: string): Promise<InboundMessage> {
    const { data, error } = await this.db
      .from("inbound_messages")
      .select("id, organization_id, subject, received_at, body_text_storage_path, attachments")
      .eq("id", id)
      .single();
    if (error) throw error;
    return data as InboundMessage;
  }

  async download(path: string): Promise<Uint8Array> {
    const { data, error } = await this.db.storage.from("inbound").download(path);
    if (error) throw error;
    return new Uint8Array(await data.arrayBuffer());
  }

  async complete(jobId: string, payload: CompletionPayload): Promise<void> {
    const { error } = await this.db.rpc("complete_processing_job", {
      p_job_id: jobId,
      p_worker: this.workerId,
      p_result: payload,
    });
    if (error) throw error;
  }

  async fail(jobId: string, message: string, retryable: boolean): Promise<string> {
    const { data, error } = await this.db.rpc("fail_processing_job", {
      p_job_id: jobId,
      p_worker: this.workerId,
      p_error: message,
      p_retryable: retryable,
    });
    if (error) throw error;
    return data as string;
  }
}
