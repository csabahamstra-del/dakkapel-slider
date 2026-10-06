# Veryo Werkbon-verwerking (Make.com + Airtable)

Losstaand product, los van de Veryo Rapportage-code in deze repo. Hier staan de bron-documenten van de Make-template: prompt, JSON-schema, Airtable-structuur en de klant-onboarding.

Monteurs mailen een foto of PDF van de werkbon naar een vast adres. Make leest de bon uit met Claude, zet hem in Airtable ter review, en zet na goedkeuring door kantoor een exportpakket klaar voor het ERP-systeem van de klant (CSV, of via een adapter-scenario per ERP).

## Bestanden

| Bestand                                            | Inhoud                                                                   |
| -------------------------------------------------- | ------------------------------------------------------------------------ |
| [`airtable-template.md`](./airtable-template.md)   | Tabellen, velden, formules, Interface en automation van de template-base |
| [`extractie-prompt.md`](./extractie-prompt.md)     | Prompt voor de Claude-aanroep in Scenario 1                              |
| [`extractie-schema.json`](./extractie-schema.json) | JSON-schema voor `output_config.format` (structured output)              |

## Make-opzet

- Zone `eu2.make.com`, team "My Team".
- Map **Veryo Werkbon – MASTER** met de template-scenario's; per klant een map **Werkbon – {Klantnaam}** met kopieën.
- Elk scenario begint met de module **Klantinstellingen** (Set multiple variables): `airtable_base_id`, `config_record_id`, `fout_webhook_url`, `klant`. Bij klonen alleen deze module en de koppelingen aanpassen. (Na de upgrade naar Teams kan dit naar teamvariabelen.)

| Scenario                          | Trigger                       | Doet                                                                                  |
| --------------------------------- | ----------------------------- | ------------------------------------------------------------------------------------- |
| Werkbon 1 · Intake en extractie   | Mailhook                      | Bijlagen opslaan, Claude uitlezen, valideren, record "In review", melding aan kantoor |
| Werkbon 2 · Goedkeuring en export | Webhook (Airtable-automation) | Exportpakket (JSON + CSV) → CSV-mail of ERP-adapter, status "Geëxporteerd"            |
| Werkbon 3 · Foutafhandeling       | Webhook (error-handlers)      | Status "Fout" + mail aan beheerder                                                    |

Mail gaat via de algemene Email-module (SMTP). In de master is die koppeling leeg; per klant kies je de verzendende mailbox.

### Export naar het ERP

Scenario 2 is ERP-onafhankelijk. Het bouwt altijd hetzelfde exportpakket (klant met ERP klant-ID, werkbonnummer, datum, regels voor uren/reistijd/materiaal met aantal, prijs, btw en ERP artikel-ID) en kiest dan op `Exportmethode`:

- **CSV**: CSV-bestand mailen naar kantoor (en optioneel in Google Drive). Werkt met elk ERP dat kan importeren.
- **Adapter**: het pakket gaat als JSON naar `Adapter webhook-URL`, een klein scenario per ERP ("Werkbon 2x · Export naar {ERP}"), dat de conceptfactuur of werkorder maakt en `export_id` teruggeeft. Adapters worden gebouwd zodra een klant ze nodig heeft (Moneybird, Exact Online, SnelStart, e-Boekhouden, Gripp, …).

## Klant aansluiten (checklist)

1. Airtable: dupliceer de template-base naar de workspace van de klant (of die van Veryo). Vul Configuratie, Tarieven, Monteurs, Klanten, Artikelen (CSV-import kan).
2. Airtable: noteer de base-ID (`app…`) en het record-ID van Configuratie (`rec…`).
3. Make: maak map "Werkbon – {Klant}", kloon de drie scenario's erin.
4. Make: maak nieuwe Mailhook en webhooks voor de klonen (gekloonde scenario's delen anders de hooks van de master).
5. Make: vul in elk scenario de module **Klantinstellingen**; koppel de Airtable-verbinding en de mailbox (SMTP) van de klant.
6. ERP: kies `Exportmethode`; bij Adapter het adapter-scenario klonen/bouwen en de webhook-URL in Configuratie zetten.
7. Airtable: zet in de automation "Goedgekeurd → Make" de webhook-URL van Scenario 2. (Run script vereist een betaald Airtable-plan.)
8. Klant: doorstuurregel van `werkbon@klant.nl` naar het Mailhook-adres. Monteurs: foto's mailen met formaat "Groot".
9. Test met 3 voorbeeldbonnen (netjes, rommelig handschrift, PDF uit app). Daarna scenario's op "Data is confidential" zetten.

## Bekende grenzen

- Afbeeldingen > ±5 MB worden door Claude en Airtable geweigerd → flag "bestand te groot", status Fout met uitleg. Oplossing: in iOS Mail "Groot" kiezen, of later een verkleinstap (bijv. CloudConvert, Duitsland).
- Airtable host in de VS; de Anthropic API verwerkt niet uitsluitend in de EU. Door Csaba geaccepteerd; opnemen in de verwerkersovereenkomst met de klant.
