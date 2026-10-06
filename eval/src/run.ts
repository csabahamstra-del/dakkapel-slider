/**
 * Runs the extraction on every sample with a gold label and reports field-level accuracy.
 *
 *   pnpm eval                          # /samples
 *   pnpm eval --dir eval/fixtures      # synthetic fixtures (safe to share)
 *   pnpm eval --only nacht --model claude-sonnet-5-5
 */
import { mkdir, writeFile } from "node:fs/promises";
import path from "node:path";
import { parseArgs } from "node:util";
import Anthropic from "@anthropic-ai/sdk";
import { EXTRACTION_PROMPT_VERSION, extractReport, loadConfig } from "@veryo/core";
import { REPO_ROOT, loadDotEnv, resolveFromRoot } from "./env.js";
import { findSamples, loadGold, loadInput } from "./samples.js";
import { mergeScores, scoreSample, type SampleScore } from "./score.js";

loadDotEnv();

const { values: args } = parseArgs({
  args: process.argv.slice(2).filter((a) => a !== "--"),
  options: {
    dir: { type: "string", default: "samples" },
    only: { type: "string" },
    model: { type: "string" },
    verbose: { type: "boolean", short: "v", default: false },
  },
});

const config = loadConfig();
const model = args.model ?? config.extractionModel;
const dir = resolveFromRoot(args.dir!);
const client = new Anthropic();

const samples = await findSamples(dir, args.only);
if (samples.length === 0) {
  console.error(`Geen samples gevonden in ${dir}`);
  process.exit(1);
}

interface Row {
  sample: string;
  reviewed: boolean;
  status: string;
  expectedStatus: string;
  attempts: number;
  durationMs: number;
  inputTokens: number;
  outputTokens: number;
  score: SampleScore;
  errors: string[];
  reasons: string[];
}

const rows: Row[] = [];
let skippedNoGold = 0;

for (const sample of samples) {
  const gold = await loadGold(sample);
  if (!gold) {
    skippedNoGold++;
    console.warn(
      `- ${sample.name}: geen ${path.basename(sample.goldPath)}, overgeslagen (draai pnpm eval:label)`,
    );
    continue;
  }
  const started = Date.now();
  const result = await extractReport(await loadInput(sample, gold.received_at), {
    client,
    config,
    model,
  });
  const score = scoreSample({
    expected: gold.output,
    expectedStatus: gold.expected_status,
    actual: result.output,
    actualStatus: result.validation.status,
    piiTerms: gold.pii_terms,
  });
  const reasons = [
    ...result.validation.reasons,
    ...result.validation.reports.flatMap((r) => r.reasons),
  ].map((r) => r.code);
  rows.push({
    sample: sample.name,
    reviewed: gold.reviewed,
    status: result.validation.status,
    expectedStatus: gold.expected_status,
    attempts: result.attempts,
    durationMs: Date.now() - started,
    inputTokens: result.usage.inputTokens,
    outputTokens: result.usage.outputTokens,
    score,
    errors: result.errors,
    reasons,
  });

  const fieldsOk = Object.values(score.fields).reduce((n, f) => n + f.correct, 0);
  const fieldsTotal = Object.values(score.fields).reduce((n, f) => n + f.total, 0);
  const flag = score.piiLeaks.length > 0 ? "  ⚠ PII-LEK" : "";
  console.log(
    `- ${sample.name}: ${fieldsOk}/${fieldsTotal} velden goed, status ${result.validation.status}${gold.reviewed ? "" : " (label niet gereviewd)"}${flag}`,
  );
  if (args.verbose) {
    for (const m of score.mismatches)
      console.log(
        `    ✗ ${m.field}: verwacht ${JSON.stringify(m.expected)}, kreeg ${JSON.stringify(m.actual)}`,
      );
    if (reasons.length) console.log(`    controlebak-redenen: ${reasons.join(", ")}`);
  }
}

const totals = mergeScores(rows.map((r) => r.score.fields));
console.log(
  `\nModel: ${model} · prompt ${EXTRACTION_PROMPT_VERSION} · ${rows.length} samples${skippedNoGold ? ` (${skippedNoGold} zonder label)` : ""}`,
);
console.table(
  Object.fromEntries(
    Object.entries(totals).map(([field, f]) => [
      field,
      { goed: f.correct, totaal: f.total, score: `${((100 * f.correct) / f.total).toFixed(0)}%` },
    ]),
  ),
);
const leaks = rows.filter((r) => r.score.piiLeaks.length > 0);
if (leaks.length > 0) {
  console.log(
    `⚠ PII-lekken in ${leaks.length} sample(s): ${leaks.map((r) => `${r.sample} [${r.score.piiLeaks.join(", ")}]`).join("; ")}`,
  );
}
const unreviewed = rows.filter((r) => !r.reviewed).length;
if (unreviewed > 0)
  console.log(`Let op: ${unreviewed} label(s) nog niet gereviewd — scores zijn voorlopig.`);
console.log(
  `Tokens: ${rows.reduce((n, r) => n + r.inputTokens, 0)} in / ${rows.reduce((n, r) => n + r.outputTokens, 0)} uit`,
);

// Results may quote real data, so they live in the git-ignored eval/results directory.
const outDir = path.join(REPO_ROOT, "eval", "results");
await mkdir(outDir, { recursive: true });
const outFile = path.join(outDir, `${new Date().toISOString().replace(/[:.]/g, "-")}.json`);
await writeFile(
  outFile,
  JSON.stringify(
    { model, promptVersion: EXTRACTION_PROMPT_VERSION, dir: args.dir, totals, rows },
    null,
    2,
  ),
);
console.log(`Resultaten: ${path.relative(REPO_ROOT, outFile)}`);
