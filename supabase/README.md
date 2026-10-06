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

## Inbound e-mail (fase 2b)

Mail die een beveiligingsbedrijf doorstuurt naar `<inbound_alias>@<INBOUND_DOMAIN>` komt via een
Mailgun-route binnen in de Edge Function `inbound-email`:

1. De Mailgun-handtekening wordt gecontroleerd (401 bij een ongeldige handtekening).
2. De organisatie wordt bepaald via `inbound_alias` (406 bij een onbekend adres: Mailgun probeert
   dan niet opnieuw).
3. Alles wordt ongewijzigd opgeslagen in de private bucket `inbound`:
   `<organization_id>/<sleutel>/message.json` (alle velden die Mailgun stuurt), `body.txt` en
   `attachments/<n>-<naam>`. De sleutel is een hash van de `Message-Id`, dus een retry van Mailgun
   schrijft naar dezelfde paden en overschrijft niets.
4. `ingest_inbound_message` legt het bericht vast en zet een `extract`-taak in de wachtrij, in één
   transactie. Een tweede aanroep met dezelfde `Message-Id` geeft het bestaande bericht terug.

Bij een fout in opslag of database antwoordt de functie met 500, zodat Mailgun het later opnieuw
probeert.

### Live zetten

1. Supabase-project in regio Frankfurt; migraties uitvoeren met `supabase db push`.
2. Secrets zetten:

       supabase secrets set MAILGUN_WEBHOOK_SIGNING_KEY=... INBOUND_DOMAIN=in.veryo.nl

3. Functie deployen (JWT-controle staat uit in `config.toml`; de Mailgun-handtekening vervangt die):

       supabase functions deploy inbound-email

4. In Mailgun (EU-regio): het inbound-domein toevoegen met de MX-records, en een route
   `match_recipient(".*@in.veryo.nl")` met de actie
   `forward("https://<project-ref>.supabase.co/functions/v1/inbound-email")`.
5. Testen: stuur een mail naar `<inbound_alias>@in.veryo.nl` en controleer `inbound_messages`.
