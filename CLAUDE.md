# Veryo Rapportage — projectcontext

## Wat we bouwen

Een SaaS voor beveiligingsbedrijven (later ook schoonmaak en vastgoedbeheer). Dienst- en
incidentrapportages komen binnen via e-mail (doorstuurregel naar een uniek adres per bedrijf) of
via handmatige upload van een export. Elk rapport wordt direct bij binnenkomst door AI omgezet naar
gestructureerde data. Op de 1e van elke maand genereert het systeem per eindklant een professioneel
white-label PDF-rapport (aantal diensten, incidenten, types, responstijden, bijzonderheden, trends,
verbeterpunten, aanbevelingen). Een planner reviewt het concept in een dashboard en verstuurt het.

Het beveiligingsbedrijf is onze klant ("organization"). Hun klanten noemen we "clients", hun
locaties "sites".

## Stack

- TypeScript overal. pnpm-workspace, Vitest voor tests.
- Supabase, regio EU (Frankfurt): Postgres, Storage, Auth, Edge Functions (Deno), pg_cron.
- Inbound e-mail: Mailgun, EU-regio, via webhook naar een Edge Function.
- Claude API. Modelnamen ALTIJD uit env-variabelen, nooit hardcoded:
  - `EXTRACTION_MODEL` (standaard: claude-haiku-4-5-20251001)
  - `NARRATIVE_MODEL` (standaard: claude-sonnet-5-5)
- Dashboard: Next.js (App Router) + Tailwind.
- PDF: HTML-templates gerenderd door Gotenberg (Docker, draait op een EU-server).
- Betalingen: Stripe (pas in fase 5).

## Mappenstructuur

```
/packages/core     gedeelde code: Zod-schema's, extractieprompt, metrics, types
/supabase          migrations/, functions/, seed.sql
/apps/dashboard    Next.js-dashboard
/services/pdf      docker-compose voor Gotenberg + HTML-templates
/eval              testharnas voor extractiekwaliteit
/samples           ECHTE testdata — staat in .gitignore, NOOIT committen
```

## Harde regels (nooit van afwijken)

1. AI berekent nooit cijfers. Aantallen, percentages, gemiddelden en trends worden in SQL of
   TypeScript berekend. Het taalmodel krijgt alleen de berekende cijfers en schrijft daar duiding bij.
2. Trends alleen boven een drempel. Een verandering wordt pas als trend benoemd als beide periodes
   minimaal `TREND_MIN_COUNT` (standaard 10) gebeurtenissen hebben. Deze check gebeurt in code, vóór
   de AI-stap.
3. Multi-tenant vanaf dag één. Elke tabel met klantdata heeft `organization_id` en Row Level
   Security. Geen uitzonderingen, ook niet "tijdelijk".
4. Alle data in de EU. Geen diensten toevoegen die buiten de EU hosten zonder dat eerst te melden.
5. Ruwe data wordt nooit verwijderd. Elke binnenkomende mail en bijlage wordt ongewijzigd
   opgeslagen, zodat we opnieuw kunnen verwerken als de extractie verbetert.
6. Persoonsnamen worden bij extractie vervangen door rollen (melder, verdachte, beveiliger,
   medewerker klant). Namen van beveiligers alleen als ID, niet als naam. Is er geen ID bekend, dan
   wordt de naam gemaskeerd (`beveiliger_1`, `beveiliger_2`, …).
7. AI-output is altijd gestructureerd (JSON gevalideerd met Zod). Faalt validatie, dan opnieuw
   proberen of naar de controlebak — nooit stil doorgaan.
8. Twijfel gaat naar de mens. Onzekere extractie, onbekend object of onlogische tijden (aankomst
   vóór melding, dienst > 16 uur) → status `needs_review`.
9. Niets wordt automatisch naar eindklanten verstuurd. Maandrapporten zijn altijd eerst `draft` en
   worden pas na goedkeuring door een mens verzonden.
10. Geen secrets in code. Alles via `.env` / Supabase secrets; houd `.env.example` bij.

## Datamodel (startpunt, mag verfijnd worden)

- `organizations` — beveiligingsbedrijf; inbound-mailadres, huisstijl (logo, kleuren), instellingen
- `members` — gebruikers per organization met rol (owner, planner)
- `clients` — eindklanten; contactpersoon en e-mail voor het rapport
- `sites` — objecten per client; adres + `aliases text[]` voor matching
- `inbound_messages` — ruwe mail/upload, afzender, ontvangsttijd, storage-paden, verwerkingsstatus
- `processing_jobs` — wachtrij met status, pogingen, foutmelding
- `shift_reports` — één per dienstrapport: site, start/eind, type dienst, samenvatting, confidence,
  status
- `incidents` — 0..n per shift_report: categorie, tijdstip melding, tijdstip aankomst, ernst,
  samenvatting
- `incident_categories` — per organization instelbaar, met standaardset
- `monthly_reports` — per client per maand: status (draft/approved/sent), metrics JSON, narrative
  JSON, pdf-pad
- `audit_log` — wie heeft wat goedgekeurd, aangepast of verzonden

## Werkwijze

- Begin elke taak met een plan en wacht op akkoord voordat je grote wijzigingen doet.
- Eén feature per sessie. Kleine, werkende stappen.
- Databasewijzigingen alleen via migraties in `/supabase/migrations`.
- Schrijf tests voor metrics-berekeningen en objectmatching.
- Code en identifiers in het Engels; teksten in rapport en dashboard in het Nederlands.
- Vraag het als iets onduidelijk is in plaats van te gokken.
- Controleer vóór elke commit: `pnpm lint && pnpm typecheck && pnpm test && pnpm test:db`.

## Fases

- Fase 1 — Extractie + evaluatie (gebouwd; wacht op echte samples en een live eval-run)
- Fase 2 — Database, RLS, Mailgun-webhook, verwerkingswachtrij, objectmatching ← HUIDIGE FASE
  - 2a datamodel + RLS (gebouwd) · 2b Mailgun-webhook + opslag · 2c wachtrij · 2d objectmatching
- Fase 3 — Maandrapport: SQL-metrics, narrative-stap, HTML-template, Gotenberg
- Fase 4 — Dashboard: login, beheer clients/sites, controlebak, review en versturen

## Besluiten fase 1

- Invoerformaten: PDF (gaat als document-blok naar Claude) en Word `.docx` (tekst via `mammoth`),
  plus platte tekst (mailbody). Oud Word `.doc` wordt niet ondersteund → `needs_review`.
- Tijden worden geëxtraheerd als lokale tijd (Europe/Amsterdam) in het formaat `YYYY-MM-DDTHH:mm`.
- Incidentcategorieën: vaste standaardset in `packages/core/src/categories.ts`; per-organization
  instelbaar komt in fase 2.
- Gold labels in `/samples/*.expected.json` worden als concept gegenereerd (`pnpm eval:label`) en
  daarna door een mens gecorrigeerd.

## Besluiten fase 2

- Rollen: `owner` en `planner`. Eén gebruiker mag lid zijn van meerdere organizations.
- Inbound-adres: `organizations.inbound_alias` is het lokale deel; het domein volgt in 2b.
- Organisaties worden server-side aangemaakt (onboarding), niet door gebruikers via de API.
- Shift reports en monthly reports worden door de verwerking (`service_role`) aangemaakt; leden
  reviewen en corrigeren ze.
- Open punt: AVG-bewaartermijn versus "ruwe data nooit verwijderen" — een gecontroleerde
  verwijderprocedure (bijv. bij opzegging) moet nog ontworpen worden.
