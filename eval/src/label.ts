/**
 * Generates draft gold labels (`<sample>.expected.json`) with a stronger model.
 * A human must correct each draft and set "reviewed": true.
 *
 *   pnpm eval:label                    # only samples without a label
 *   pnpm eval:label --only nacht --force
 */
import { writeFile } from "node:fs/promises";
import path from "node:path";
import { parseArgs } from "node:util";
import Anthropic from "@anthropic-ai/sdk";
import { zodOutputFormat } from "@anthropic-ai/sdk/helpers/zod";
import { buildContentBlocks, extractReport, loadConfig } from "@veryo/core";
import { z } from "zod";
import { loadDotEnv, resolveFromRoot } from "./env.js";
import type { GoldLabel } from "./gold.js";
import { findSamples, loadGold, loadInput } from "./samples.js";

loadDotEnv();

const { values: args } = parseArgs({
  args: process.argv.slice(2).filter((a) => a !== "--"),
  options: {
    dir: { type: "string", default: "samples" },
    only: { type: "string" },
    force: { type: "boolean", default: false },
  },
});

const labelModel = process.env.EVAL_LABEL_MODEL || "claude-opus-5-5";
const config = loadConfig();
const client = new Anthropic();
const dir = resolveFromRoot(args.dir!);

const PiiSchema = z.object({
  terms: z
    .array(z.string())
    .describe(
      "Elke persoonsnaam (voor- en achternaam los én samen), kenteken, telefoonnummer en persoonlijk e-mailadres",
    ),
});

/** Lists personal data in the source so the eval can check it never leaks into the output. */
async function listPiiTerms(sampleBlocks: Anthropic.ContentBlockParam[]): Promise<string[]> {
  const response = await client.messages.parse({
    model: labelModel,
    max_tokens: 4000,
    output_config: { format: zodOutputFormat(PiiSchema), effort: "high" },
    messages: [
      {
        role: "user",
        content: [
          ...sampleBlocks,
          {
            type: "text",
            text: "Som alle persoonsgegevens in dit document op: namen van personen (voornaam, achternaam en de volledige naam als aparte items), kentekens, telefoonnummers en persoonlijke e-mailadressen. Geen bedrijfs- of objectnamen.",
          },
        ],
      },
    ],
  });
  return [...new Set(response.parsed_output?.terms ?? [])];
}

const samples = await findSamples(dir, args.only);
for (const sample of samples) {
  if (!args.force && (await loadGold(sample))) {
    console.log(`- ${sample.name}: label bestaat al, overgeslagen (--force om te overschrijven)`);
    continue;
  }
  const input = await loadInput(sample);
  const result = await extractReport(input, { client, config, model: labelModel, effort: "high" });
  if (!result.output) {
    console.error(`- ${sample.name}: labelen mislukt: ${result.errors.join(" | ")}`);
    continue;
  }
  const { blocks } = await buildContentBlocks(input);
  const label: GoldLabel = {
    source: sample.name,
    reviewed: false,
    expected_status: result.validation.status,
    output: result.output,
    pii_terms: await listPiiTerms(blocks),
    notes: `Concept door ${labelModel}. Controleer alle velden, vul received_at in als het jaar ontbreekt, en zet reviewed op true.`,
  };
  await writeFile(sample.goldPath, `${JSON.stringify(label, null, 2)}\n`);
  console.log(`- ${sample.name}: concept geschreven naar ${path.basename(sample.goldPath)}`);
}
