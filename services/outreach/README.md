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

## Bouwfases

1. Fundament: config, logging, SQLite, afmeldlijst, Notion-databases, DNS-check ← gebouwd
2. Leads vinden + verrijken + scoren (TED/TenderNed, Meta Ad Library, Places, KvK, Hunter)
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
