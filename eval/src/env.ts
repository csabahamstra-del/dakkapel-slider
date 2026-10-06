import { existsSync } from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

export const REPO_ROOT = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "../..");

/** Loads the repo-root .env (if present) without overriding variables that are already set. */
export function loadDotEnv(): void {
  const file = path.join(REPO_ROOT, ".env");
  if (existsSync(file)) process.loadEnvFile(file);
}

export function resolveFromRoot(p: string): string {
  return path.isAbsolute(p) ? p : path.resolve(REPO_ROOT, p);
}
