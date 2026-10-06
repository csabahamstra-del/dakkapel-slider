import { describe, expect, it } from "vitest";
import { diffMinutes, localToMinutes } from "../src/index.js";

describe("time helpers", () => {
  it("computes differences across midnight", () => {
    expect(diffMinutes("2026-03-12T22:00", "2026-03-13T06:30")).toBe(510);
  });
  it("returns null for missing or malformed values", () => {
    expect(diffMinutes(null, "2026-03-13T06:30")).toBeNull();
    expect(localToMinutes("13-03-2026 06:30")).toBeNull();
    expect(localToMinutes("2026-02-30T10:00")).toBeNull();
    expect(localToMinutes("2026-03-12T24:00")).toBeNull();
  });
});
