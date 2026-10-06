import { describe, expect, it } from "vitest";
import { loadConfig } from "../src/index.js";

describe("loadConfig", () => {
  it("uses defaults", () => {
    expect(loadConfig({})).toEqual({
      extractionModel: "claude-haiku-4-5-20251001",
      minConfidence: 0.7,
      maxShiftHours: 16,
      trendMinCount: 10,
    });
  });
  it("reads values from env", () => {
    const cfg = loadConfig({ EXTRACTION_MODEL: "x", MAX_SHIFT_HOURS: "12", TREND_MIN_COUNT: "5" });
    expect(cfg).toMatchObject({ extractionModel: "x", maxShiftHours: 12, trendMinCount: 5 });
  });
  it("rejects non-numeric thresholds", () => {
    expect(() => loadConfig({ MAX_SHIFT_HOURS: "veel" })).toThrow(/MAX_SHIFT_HOURS/);
  });
});
