# /supabase

- `migrations/` — alle databasewijzigingen, alleen via nieuwe migratiebestanden.
- `seed.sql` — fictieve ontwikkeldata (twee beveiligingsbedrijven).
- `tests/` — tests voor schema, RLS en triggers tegen een echte Postgres.

## Tests draaien

De tests maken per run een tijdelijke database aan, met een kleine nabootsing van Supabase
(`tests/supabase_shim.sql`: rollen `anon`/`authenticated`/`service_role`, `auth.users`,
`auth.uid()`), voeren alle migraties en de seed uit, en ruimen de database daarna op.

    # Postgres 15+ nodig; standaard postgres://postgres:postgres@localhost:5432/postgres
    TEST_DATABASE_URL=postgres://... pnpm test:db

De shim is géén migratie en mag nooit op een echt Supabase-project worden uitgevoerd.

## Wat de database afdwingt

| Regel                           | Hoe                                                                                                                                                                                                                                    |
| ------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Multi-tenant (3)                | `organization_id` + RLS op elke tabel; samengestelde foreign keys zodat gekoppelde rijen bij dezelfde organisatie horen; `organization_id` kan niet wijzigen. Een test faalt als er een tabel zonder RLS of `organization_id` bijkomt. |
| Ruwe data nooit weg (5)         | `inbound_messages` kan niet verwijderd worden en alleen `status` mag wijzigen — ook niet door `service_role`.                                                                                                                          |
| Niets automatisch versturen (9) | `monthly_reports`: alleen `draft → approved → sent` (of terug naar `draft`). Goedkeuren kan alleen een ingelogde gebruiker; die wordt vastgelegd. Een verzonden rapport is definitief.                                                 |
| Audit                           | Statuswijzigingen van maand- en dienstrapporten komen automatisch in `audit_log`; die tabel is append-only.                                                                                                                            |
| Rollen                          | `owner` beheert leden, organisatie-instellingen en categorieën; `planner` beheert klanten/objecten en reviewt. Er blijft altijd minstens één owner.                                                                                    |
