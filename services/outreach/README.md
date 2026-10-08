# Veryo Outreach

Autonome cold-outreach-pipeline voor Veryo zelf: leads vinden, kwalificeren, mailen (4 mails in
14 dagen), reacties classificeren en gesprekken koppelen. Staat los van Veryo Rapportage; deelt
alleen de tooling van de monorepo.

## Architectuur

- Eén Node-proces (Docker, EU-VPS) met een interne planner.
- **Notion** is het CRM voor Csaba: _Veryo Leads_ en _Afmeldlijst_ onder
  Veryo › Outreach (automatisch). Kolomnamen niet wijzigen; `cli notion:verify` controleert dat.
- **SQLite** (`OUTREACH_DB_PATH`) is de harde administratie: verzendlog (limieten,
  idempotentie), auditlog van elke actie met reden, kopie van de afmeldlijst.
- **Mail**: veryo.nl draait op mijn.host (DirectAdmin) → SMTP om te versturen, IMAP voor
  concepten (shadow mode) en voor het lezen van reacties. Afzender `info@veryo.nl`.

## Veiligheidsregels in code

- `OUTREACH_MODE=shadow` is de standaard: mails worden concepten in de inbox.
- De verzendcontrole (`src/guard.ts`) weigert bij twijfel. Hij blokkeert bij:
  - pauze (`OUTREACH_PAUSED`);
  - een ongeldig adres of een publieke maildienst;
  - een adres of domein (inclusief subdomeinen) op de afmeldlijst;
  - een afmeldlijst die niet recent met Notion is gesynchroniseerd;
  - de daglimiet (per kalenderdag, Amsterdamse tijd);
  - de limiet nieuwe leads (per 7 dagen).
- Limieten tellen alles wat in het verzendlog staat, ook mislukte pogingen. De configuratie
  weigert waarden boven 50 mails per dag en 20 nieuwe leads per week.
- Afmeldingen worden nooit verwijderd. Een afmelding blokkeert het adres en het bedrijfsdomein.
  Een regel in Notion verwijderen heft een afmelding niet op.
- Logs en auditlog maskeren alles wat op een secret lijkt; mailinhoud wordt niet gelogd.

## Commando's

    pnpm --filter @veryo/outreach cli doctor              # alles in één overzicht
    pnpm --filter @veryo/outreach cli dns-check           # SPF/DKIM/DMARC van veryo.nl
    pnpm --filter @veryo/outreach cli notion:verify       # kolommen van beide databases
    pnpm --filter @veryo/outreach cli suppress <adres|domein> [reden]
    pnpm --filter @veryo/outreach cli suppression:sync
    pnpm --filter @veryo/outreach cli check-send <adres> [--first]   # proef van de verzendcontrole
    pnpm --filter @veryo/outreach cli notion:setup        # alleen voor een nieuwe workspace
    pnpm --filter @veryo/outreach cli tenderned:probe     # live vorm van de TenderNed-lijst tonen
    pnpm --filter @veryo/outreach cli discover:tenderned [--days 60] [--max 300] [--no-notion]
    pnpm --filter @veryo/outreach cli candidates          # kandidatenpool tonen

## Bouwfases

1. Fundament: config, logging, SQLite, afmeldlijst, Notion-databases, DNS-check ← gebouwd
2. Leads vinden + verrijken + scoren ← bezig
   - TenderNed (beveiliging, trigger "Aanbesteding") ← gebouwd
   - Meta Ad Library (vak), KvK-verificatie, Hunter, scoring + selectie ← volgt
3. Personalisatie (`trigger_zin`) + kwaliteitscheck
4. Versturen + sequence-planning (shadow)
5. Inbox-monitoring + reply-classificatie + Calendly-koppeling (geen automatische antwoorden:
   Csaba antwoordt zelf, de pipeline stopt de sequence, zet de status en stuurt een melding)
6. Wekelijkse samenvatting per mail
7. Draaien op schema (Docker op EU-VPS)

## Besluiten

- Bronnen alleen via officiële API's of open data. Werkspot, Trustoo en Homedeal vallen af
  (alleen via scraping). De NVB-ledenlijst wordt eenmalig handmatig geïmporteerd.
- Mailverificatie: Hunter (EU, vinden + verifiëren). KvK-API geeft geen bestuurders; de naam
  van de beslisser komt van de eigen site van het bedrijf of van Hunter.
- Geen automatische antwoorden op reacties.

## TenderNed

- De lijst met publicaties (`/papi/tenderned-rs-tns/v2/publicaties`, open data, CC0) is
  openbaar. We vragen gunningen op (`publicatieType=AGO`) en bladeren terug tot
  `TENDERNED_AWARD_MAX_AGE_DAYS` (standaard 60).
- De winnaars staan in de eForms-XML (`/publicaties/{id}/public-xml`). Daarvoor is een gratis
  inlog nodig, aan te vragen via functioneelbeheer@tenderned.nl.
- Relevant = CPV-code 7971xxxx (beveiligingsdiensten, bewaking, surveillance, alarmopvolging).
- Elke winnaar wordt een kandidaat met:
  - KvK-nummer (uit de XML) en plaats;
  - domein (van de website, of van het zakelijke mailadres in de XML);
  - de link naar de publicatie als trigger-URL;
  - een momentopname van de bron (`trigger_excerpt`).
- VOF en CV in de naam worden lokaal uitgesloten. De echte rechtsvorm controleert KvK later.
  Gezien-markering voorkomt dubbel ophalen; een mislukte download wordt de volgende run
  opnieuw geprobeerd.
- De veldnamen van de lijst zijn niet officieel gedocumenteerd. `cli tenderned:probe` toont de
  live vorm; `readListItem` is daar tolerant voor.
