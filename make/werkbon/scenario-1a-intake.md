# Werkbon MASTER – 1a. Intake

Make-scenario `9928438` in map "Veryo Werkbon – MASTER". Trigger: **Mailhook** (1 mail = 1 werkbon). Slaat de mail en bijlagen ongewijzigd op in Airtable en start daarna 1b (Uitlezen). Er wordt hier nog niets uitgelezen.

## Stappen

1. **Werkbon ontvangen** (Mailhook).
2. **Klantinstellingen** — `klant`, `airtable_base_id`, `fout_webhook_url` (Scenario 3), `uitlezen_webhook_url` (Scenario 1b).
3. **Bijlagen doorlopen → Bijlagen verzamelen** — alleen JPG/PNG/GIF/WEBP/PDF/HEIC; per bijlage naam, type, grootte, data en een SHA-256-hash.
4. Router:
   - **Geen foto of PDF** → record met flag "onbekend bestandstype" → melding naar Scenario 3 (record op Fout).
   - **Foto of PDF aanwezig** → **Duplicaat zoeken** (`FIND(hash, {Alle hashes})`):
     - al eerder ontvangen → melding naar Scenario 3, géén nieuw record;
     - nieuw → **Werkbon aanmaken** (status Ontvangen, afzender, onderwerp, hashes) → per bijlage **Bijlage opslaan in Airtable** (content-API `uploadAttachment`, base64, max. 5 MB) → tellen:
       - minstens één opgeslagen → **Uitlezen starten (1b)** met `record_id`;
       - niets opgeslagen → melding naar Scenario 3.

Elke API-stap heeft een error-handler naar Scenario 3.

## Koppelingen

- Airtable: token-koppeling (type `airtable2`) voor de gewone API.
- Upload: HTTP-module met sleutel (API key, header `Authorization: Bearer pat…`), omdat de Airtable-module alleen `api.airtable.com` kan aanroepen en de upload via `content.airtable.com` gaat. Het token heeft scope `data.records:write` nodig op de base.

## Operaties

Ca. 12 per mail met één foto en een handtekeninglogo (+1 per extra bijlage). Samen met 1b: ca. 55 per werkbon.

## Testresultaat (06-10-2026)

Echte mail met `testwerkbon-1.jpg` + handtekeninglogo: 1a 12 operaties, 1b 42 operaties. Record "DK-2026-0412 – Fam. de Vries", In review, € 1.149,35, 2 urenregels, 5 materiaalregels, flag "materiaal onzeker".

## Bekende grenzen

- HEIC wordt wel opgeslagen, maar Claude leest alleen JPG/PNG/GIF/WEBP/PDF → 1b meldt "niets leesbaar". iOS Mail zet foto's bij versturen normaal om naar JPG.
- Duplicaatcontrole kijkt naar de **grootste** bijlage van de nieuwe mail (vergeleken met alle hashes van eerdere werkbonnen). Zo telt een logo uit de mailhandtekening, dat in elke mail zit, niet mee.
- Logo's en andere plaatjes uit de mailhandtekening worden wel als bijlage opgeslagen; Claude negeert ze bij het uitlezen.
- De bijlage krijgt in Airtable de naam `werkbon-<hash>.<ext>`; de originele bestandsnaam staat alleen in foutmeldingen. (Een `replace()` met een aanhalingsteken als zoekterm laat de scenario-validatie van Make falen, dus de naam wordt niet opgeschoond maar vervangen.)
- Webhook-URL's staan bewust niet in deze repo (publiek); ze staan in de module Klantinstellingen.
