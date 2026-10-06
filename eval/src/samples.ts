import { readdir, readFile } from "node:fs/promises";
import path from "node:path";
import { detectFileKind, type ExtractionInput } from "@veryo/core";
import { GoldLabelSchema, type GoldLabel } from "./gold.js";

export interface Sample {
  name: string;
  filePath: string;
  goldPath: string;
}

const IGNORED = [/\.expected\.json$/, /\.json$/, /^README\.md$/i, /^\./];

export async function findSamples(dir: string, only?: string): Promise<Sample[]> {
  const entries = await readdir(dir, { withFileTypes: true });
  return entries
    .filter((e) => e.isFile() && !IGNORED.some((re) => re.test(e.name)))
    .filter((e) => detectFileKind({ filename: e.name }) !== "unsupported")
    .filter((e) => !only || e.name.includes(only))
    .map((e) => ({
      name: e.name,
      filePath: path.join(dir, e.name),
      goldPath: path.join(dir, `${e.name}.expected.json`),
    }))
    .sort((a, b) => a.name.localeCompare(b.name));
}

/** A sample file is treated as an upload; `receivedAt` is taken from the gold label or omitted. */
export async function loadInput(sample: Sample, receivedAt?: string): Promise<ExtractionInput> {
  const data = new Uint8Array(await readFile(sample.filePath));
  return { receivedAt, files: [{ filename: sample.name, data }] };
}

export async function loadGold(sample: Sample): Promise<GoldLabel | null> {
  let raw: string;
  try {
    raw = await readFile(sample.goldPath, "utf8");
  } catch {
    return null;
  }
  return GoldLabelSchema.parse(JSON.parse(raw));
}
