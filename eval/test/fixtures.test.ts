import path from "node:path";
import { loadConfig, validateExtraction } from "@veryo/core";
import { describe, expect, it } from "vitest";
import { REPO_ROOT } from "../src/env.js";
import { findSamples, loadGold } from "../src/samples.js";

const dir = path.join(REPO_ROOT, "eval", "fixtures");

describe("fixtures", async () => {
  const samples = await findSamples(dir);

  it("has a gold label for every fixture", async () => {
    expect(samples.length).toBeGreaterThan(0);
    for (const s of samples) expect(await loadGold(s), s.name).not.toBeNull();
  });

  it.each(samples.map((s) => [s.name, s] as const))(
    "%s: expected_status matches the validation rules",
    async (_, sample) => {
      const gold = (await loadGold(sample))!;
      expect(validateExtraction(gold.output, loadConfig({})).status).toBe(gold.expected_status);
    },
  );
});
