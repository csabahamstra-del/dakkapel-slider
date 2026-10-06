# Werkbon MASTER – 3. Foutafhandeling

Make-scenario `9928120` in map "Veryo Werkbon – MASTER". Trigger: webhook **Werkbon MASTER – Fout gemeld** (`https://hook.eu2.make.com/ffl3vy601dmpdcy84ftdwbbfinsey1fj`). Planning: direct (instant).

## Wat het doet

Elke API-module in Scenario 1 en 2 krijgt een error-handler die naar deze webhook post. Dit scenario:

1. **Fout gemeld** — ontvangt de melding.
2. **Klantinstellingen** — base-ID, Configuratie-record, beheerder-e-mail, klantnaam.
3. **Foutmelding opbouwen** — `DD-MM-JJJJ UU:MM – scenario / module: foutmelding`.
4. **Tekst veilig maken voor JSON** — escapet aanhalingstekens en regeleinden.
5. Router:
   - **Werkbon op Fout zetten** (alleen als `record_id` een geldig `rec…`-ID is) — PATCH op Werkbonnen: Status = Fout, Foutmelding. Faalt dit, dan gaat de mail toch.
   - **Mail aan beheerder** — via "Send an Email to a Team Member": geen mailbox-koppeling nodig, de mail komt van Make zelf.

Kosten: 6 operaties per fout.

## Verwachte invoer (JSON naar de webhook)

| Veld           | Verplicht | Voorbeeld                         |
| -------------- | --------- | --------------------------------- |
| `scenario`     | ja        | `Werkbon 1 · Intake en extractie` |
| `module`       | ja        | `Werkbon uitlezen`                |
| `foutmelding`  | ja        | tekst van de fout                 |
| `record_id`    | nee       | `recXXXXXXXXXXXXXX`               |
| `afzender`     | nee       | e-mailadres van de monteur        |
| `ontvangen_op` | nee       | ISO-datum                         |
| `klant`        | nee       | (informatief)                     |

## Configuratie per klant

Alleen de module **Klantinstellingen**: `klant`, `airtable_base_id`, `config_record_id`, `beheerder_email` (moet lid zijn van het Make-team). Na klonen: nieuwe webhook aanmaken en de URL in de Klantinstellingen van Scenario 1 en 2 zetten.

## Testen

Stuur met het hulpscenario "Werkbon – Hulp: testbericht naar webhook" een JSON zoals hierboven, met het ID van een testrecord. Verwacht: record op Fout met de melding, en een mail "[Werkbon TEMPLATE] Fout in …".
