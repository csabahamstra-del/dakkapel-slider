/**
 * Processing worker: claims queued jobs, runs the extraction and stores the results.
 * Runs as a long-lived Node process (Docker, EU server). Several instances may run side by side.
 */
import { hostname } from "node:os";
import { setTimeout as sleep } from "node:timers/promises";
import Anthropic from "@anthropic-ai/sdk";
import { extractReport, loadConfig } from "@veryo/core";
import { errorMessage, processJob, type WorkerDeps } from "./process.js";
import { SupabaseQueue } from "./supabase.js";

function requireEnv(name: string): string {
  const value = process.env[name];
  if (!value) throw new Error(`Missing environment variable ${name}`);
  return value;
}

const workerId = `${hostname()}-${process.pid}`;
const pollMs = Number(process.env.WORKER_POLL_INTERVAL_MS ?? 15_000);
const batchSize = Number(process.env.WORKER_BATCH_SIZE ?? 5);
const config = loadConfig();
const anthropic = new Anthropic();
const queue = new SupabaseQueue(
  requireEnv("SUPABASE_URL"),
  requireEnv("SUPABASE_SERVICE_ROLE_KEY"),
  workerId,
);

// Logs carry ids, counts and error messages only — never report content (it contains personal data).
const log: WorkerDeps["log"] = (event, details) =>
  console.log(JSON.stringify({ time: new Date().toISOString(), event, ...details }));

const deps: WorkerDeps = {
  workerId,
  getMessage: (id) => queue.getMessage(id),
  download: (path) => queue.download(path),
  extract: (input) => extractReport(input, { client: anthropic, config }),
  complete: (jobId, payload) => queue.complete(jobId, payload),
  fail: (jobId, error, retryable) => queue.fail(jobId, error, retryable),
  log,
};

let stopping = false;
const wake = new AbortController();
for (const signal of ["SIGINT", "SIGTERM"] as const) {
  process.on(signal, () => {
    log("worker.stopping", { signal });
    stopping = true;
    wake.abort();
  });
}

log("worker.started", { workerId, model: config.extractionModel, pollMs, batchSize });
while (!stopping) {
  let jobs: Awaited<ReturnType<SupabaseQueue["claim"]>> = [];
  try {
    jobs = await queue.claim(batchSize);
  } catch (error) {
    log("worker.claim_failed", { error: errorMessage(error) });
  }
  // Finish claimed jobs even when stopping, so they are not left locked until the timeout.
  for (const job of jobs) {
    try {
      await processJob(job, deps);
    } catch (error) {
      // Even recording the failure failed (e.g. database down); the lock timeout re-queues the job.
      log("worker.job_unrecorded", {
        jobId: job.id,
        error: errorMessage(error),
      });
    }
  }
  if (jobs.length === 0 && !stopping)
    await sleep(pollMs, undefined, { signal: wake.signal }).catch(() => undefined);
}
log("worker.stopped", { workerId });
