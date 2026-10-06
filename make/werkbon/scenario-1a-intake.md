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

Ca. 11 per mail met één foto (+2 per extra bijlage). Samen met 1b: ca. 52 per werkbon.

## Bekende grenzen

- HEIC wordt wel opgeslagen, maar Claude leest alleen JPG/PNG/GIF/WEBP/PDF → 1b meldt "niets leesbaar". iOS Mail zet foto's bij versturen normaal om naar JPG.
- Duplicaatcontrole kijkt alleen naar de eerste bijlage van de nieuwe mail (die wordt vergeleken met alle hashes van eerdere werkbonnen).
- Webhook-URL's staan bewust niet in deze repo (publiek); ze staan in de module Klantinstellingen.
