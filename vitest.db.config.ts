import { defineConfig } from "vitest/config";

// Database tests need a Postgres server (TEST_DATABASE_URL); kept apart from the fast unit tests.
export default defineConfig({
  test: {
    include: ["supabase/tests/*.test.ts"],
    testTimeout: 20_000,
    hookTimeout: 60_000,
  },
});
