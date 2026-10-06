// Supabase Edge Function (Deno): receives Mailgun inbound routes and stores the mail untouched.
// Deploy with JWT verification off (see supabase/config.toml); requests are authenticated by
// the Mailgun signature instead.
import { createClient } from "npm:@supabase/supabase-js@2";
import { handleMailgunInbound } from "../_shared/mailgun-inbound.ts";

function requireEnv(name: string): string {
  const value = Deno.env.get(name);
  if (!value) throw new Error(`Missing environment variable ${name}`);
  return value;
}

const supabase = createClient(requireEnv("SUPABASE_URL"), requireEnv("SUPABASE_SERVICE_ROLE_KEY"), {
  auth: { persistSession: false },
});
const signingKey = requireEnv("MAILGUN_WEBHOOK_SIGNING_KEY");
const inboundDomain = requireEnv("INBOUND_DOMAIN");

Deno.serve((req) =>
  handleMailgunInbound(req, {
    signingKey,
    inboundDomain,
    async findOrganizationByAlias(alias) {
      const { data, error } = await supabase
        .from("organizations")
        .select("id")
        .eq("inbound_alias", alias)
        .maybeSingle();
      if (error) throw error;
      return data?.id ?? null;
    },
    async uploadObject(path, data, contentType) {
      // upsert: false — an existing original is never overwritten (hard rule 5).
      const { error } = await supabase.storage
        .from("inbound")
        .upload(path, data, { contentType, upsert: false });
      if (!error) return "created";
      if ("statusCode" in error && String(error.statusCode) === "409") return "exists";
      if (/already exists|duplicate/i.test(error.message)) return "exists";
      throw error;
    },
    async ingest(p) {
      const { data, error } = await supabase
        .rpc("ingest_inbound_message", {
          p_organization_id: p.organizationId,
          p_source: "email",
          p_external_id: p.externalId,
          p_sender: p.sender,
          p_recipient: p.recipient,
          p_subject: p.subject,
          p_received_at: p.receivedAt,
          p_raw_storage_path: p.rawStoragePath,
          p_body_text_storage_path: p.bodyTextStoragePath,
          p_attachments: p.attachments,
        })
        .single<{ inbound_message_id: string; duplicate: boolean }>();
      if (error) throw error;
      return { inboundMessageId: data.inbound_message_id, duplicate: data.duplicate };
    },
    log(event, details) {
      // Only ids and counts — never mail content or addresses of persons in logs.
      const safe = { ...details };
      delete safe.recipient;
      console.log(JSON.stringify({ event, ...safe }));
    },
  }).catch((error) => {
    console.error(
      JSON.stringify({ event: "inbound.error", message: String(error?.message ?? error) }),
    );
    // 500: Mailgun retries later; nothing is lost.
    return new Response(JSON.stringify({ error: "internal_error" }), { status: 500 });
  }),
);
