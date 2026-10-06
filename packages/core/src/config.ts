/** Runtime configuration. All values come from the environment (hard rule 10). */
export interface CoreConfig {
  extractionModel: string;
  minConfidence: number;
  maxShiftHours: number;
  trendMinCount: number;
}

type Env = Record<string, string | undefined>;

function num(env: Env, key: string, fallback: number): number {
  const raw = env[key];
  if (raw === undefined || raw === "") return fallback;
  const value = Number(raw);
  if (!Number.isFinite(value)) throw new Error(`Env ${key} is geen getal: ${raw}`);
  return value;
}

export function loadConfig(env: Env = process.env): CoreConfig {
  return {
    extractionModel: env.EXTRACTION_MODEL || "claude-haiku-4-5-20251001",
    minConfidence: num(env, "EXTRACTION_MIN_CONFIDENCE", 0.7),
    maxShiftHours: num(env, "MAX_SHIFT_HOURS", 16),
    trendMinCount: num(env, "TREND_MIN_COUNT", 10),
  };
}
