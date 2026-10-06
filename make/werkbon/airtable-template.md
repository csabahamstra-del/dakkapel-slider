# Airtable template-base — "Veryo Werkbonnen"

Eén base per klant, gekopieerd van de template-base. Tabel- en veldnamen zijn exact zoals de Make-scenario's ze verwachten; niet hernoemen zonder de scenario's aan te passen.

## Werkbonnen

| Veld                     | Type                                                                            | Gevuld door    |
| ------------------------ | ------------------------------------------------------------------------------- | -------------- |
| Werkbon                  | Formule (primair): `IF({Werkbonnummer}, {Werkbonnummer}, "Bon " & RECORD_ID())` | Airtable       |
| Status                   | Single select: Ontvangen, In review, Goedgekeurd, Afgekeurd, Geëxporteerd, Fout | Make / kantoor |
| Ontvangen op             | Datum + tijd (Europe/Amsterdam)                                                 | Make           |
| Afzender                 | E-mail                                                                          | Make           |
| Onderwerp mail           | Tekst                                                                           | Make           |
| Bijlage                  | Attachment                                                                      | Make           |
| Bestands-hash            | Tekst (sha256 van de eerste bijlage)                                            | Make           |
| Alle hashes              | Lange tekst                                                                     | Make           |
| Werkbonnummer            | Tekst                                                                           | AI / kantoor   |
| Datum                    | Datum                                                                           | AI / kantoor   |
| Klantnaam (op bon)       | Tekst                                                                           | AI             |
| Adres (op bon)           | Tekst                                                                           | AI             |
| Gematchte klant          | Link → Klanten (één)                                                            | AI / kantoor   |
| Klantmatch zeker         | Checkbox                                                                        | Make           |
| Moneybird contact-ID     | Lookup (Gematchte klant → Moneybird contact-ID)                                 | Airtable       |
| Werkzaamheden            | Lange tekst                                                                     | AI             |
| Samenvatting             | Lange tekst                                                                     | AI             |
| Opmerkingen              | Lange tekst                                                                     | AI             |
| Urenregels               | Link → Urenregels                                                               | Make           |
| Materiaalregels          | Link → Materiaalregels                                                          | Make           |
| Reistijd (op bon)        | Tekst                                                                           | AI             |
| Reistijd uren            | Getal (2 dec.)                                                                  | AI / kantoor   |
| Reistijdtarief           | Link → Tarieven (één)                                                           | AI / kantoor   |
| Reistijdtarief bedrag    | Lookup (Reistijdtarief → Bedrag per uur)                                        | Airtable       |
| Reistijd bedrag          | Formule: `ROUND({Reistijd uren} * SUM({Reistijdtarief bedrag}), 2)`             | Airtable       |
| Totaal uren              | Rollup (Urenregels → Uren) SUM                                                  | Airtable       |
| Totaal arbeid            | Rollup (Urenregels → Bedrag) SUM                                                | Airtable       |
| Totaal materiaal         | Rollup (Materiaalregels → Bedrag) SUM                                           | Airtable       |
| Totaal excl. btw         | Formule: `{Totaal arbeid} + {Totaal materiaal} + {Reistijd bedrag}`             | Airtable       |
| Handtekening aanwezig    | Checkbox                                                                        | AI / kantoor   |
| Vervolgactie nodig       | Checkbox                                                                        | AI / kantoor   |
| Toelichting vervolgactie | Lange tekst                                                                     | AI / kantoor   |
| Confidence               | Single select: laag, midden, hoog                                               | AI             |
| Flags                    | Multiple select (zie onder)                                                     | Make           |
| Twijfelpunten            | Lange tekst                                                                     | AI             |
| Ruwe AI-output           | Lange tekst                                                                     | Make           |
| Reden afkeuring          | Lange tekst                                                                     | Kantoor        |
| Moneybird factuur-ID     | Tekst                                                                           | Make           |
| Exportlink               | URL                                                                             | Make           |
| Foutmelding              | Lange tekst                                                                     | Make           |
| Aangemaakt               | Created time                                                                    | Airtable       |
| Laatst gewijzigd         | Last modified time                                                              | Airtable       |

**Flags (opties):** geen handtekening · uren ontbreken · uren boven maximum · materiaal onzeker · klant niet gevonden · klant onzeker · confidence laag · meerdere werkbonnen · geen werkbon · bestand te groot · onbekend bestandstype

## Urenregels

| Veld                      | Type                                                                                                                                                                           |
| ------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Regel                     | Formule (primair): `{Monteur (op bon)} & " " & DATETIME_FORMAT({Datum}, "D-M")`                                                                                                |
| Werkbon                   | Link → Werkbonnen (één)                                                                                                                                                        |
| Monteur                   | Link → Monteurs (één)                                                                                                                                                          |
| Monteur (op bon)          | Tekst                                                                                                                                                                          |
| Datum                     | Datum                                                                                                                                                                          |
| Starttijd, Eindtijd       | Tekst (HH:mm)                                                                                                                                                                  |
| Pauze (min)               | Getal                                                                                                                                                                          |
| Uren (op bon)             | Getal (2 dec.)                                                                                                                                                                 |
| Uren                      | Formule: als `Uren (op bon)` leeg is, (eind − start − pauze) in uren; anders `Uren (op bon)` — zie formule onder                                                               |
| Soort (op bon)            | Tekst                                                                                                                                                                          |
| Tarief                    | Link → Tarieven (één) — leeg = standaardtarief monteur, anders standaardtarief Configuratie                                                                                    |
| Tarief bedrag (gekozen)   | Lookup (Tarief → Bedrag per uur)                                                                                                                                               |
| Tarief bedrag (monteur)   | Lookup (Monteur → Standaardtarief bedrag)                                                                                                                                      |
| Tarief bedrag (standaard) | Getal — door Make gevuld uit Configuratie bij aanmaak                                                                                                                          |
| Tarief toegepast          | Formule: `IF(SUM({Tarief bedrag (gekozen)}), SUM({Tarief bedrag (gekozen)}), IF(SUM({Tarief bedrag (monteur)}), SUM({Tarief bedrag (monteur)}), {Tarief bedrag (standaard)}))` |
| Bedrag                    | Formule: `ROUND({Uren} * {Tarief toegepast}, 2)`                                                                                                                               |

Formule **Uren**:

```
IF(
  {Uren (op bon)} != BLANK(),
  {Uren (op bon)},
  IF(
    AND({Starttijd}, {Eindtijd}),
    ROUND(
      (
        (VALUE(LEFT({Eindtijd}, 2)) * 60 + VALUE(RIGHT({Eindtijd}, 2)))
        - (VALUE(LEFT({Starttijd}, 2)) * 60 + VALUE(RIGHT({Starttijd}, 2)))
        - IF({Pauze (min)}, {Pauze (min)}, 0)
      ) / 60,
      2
    )
  )
)
```

## Materiaalregels

| Veld                   | Type                                                                       |
| ---------------------- | -------------------------------------------------------------------------- |
| Omschrijving (op bon)  | Tekst (primair)                                                            |
| Werkbon                | Link → Werkbonnen (één)                                                    |
| Artikelnummer (op bon) | Tekst                                                                      |
| Aantal                 | Getal (2 dec.)                                                             |
| Eenheid                | Tekst                                                                      |
| Gematcht artikel       | Link → Artikelen (één)                                                     |
| Match zeker            | Checkbox                                                                   |
| Prijs                  | Lookup (Gematcht artikel → Verkoopprijs)                                   |
| Prijs override         | Valuta                                                                     |
| Prijs toegepast        | Formule: `IF({Prijs override} != BLANK(), {Prijs override}, SUM({Prijs}))` |
| Btw %                  | Lookup (Gematcht artikel → Btw %)                                          |
| Bedrag                 | Formule: `ROUND({Aantal} * {Prijs toegepast}, 2)`                          |

## Klanten

Naam (primair) · Adres · Postcode · Plaats · Klantnummer · Moneybird contact-ID · Actief (checkbox) · Promptregel (formule: `RECORD_ID() & "|" & {Naam} & "|" & {Adres} & " " & {Postcode} & " " & {Plaats} & "|" & {Klantnummer}`)

## Artikelen

Artikelnummer (primair) · Omschrijving · Zoektermen · Eenheid · Verkoopprijs (valuta) · Btw % (getal) · Moneybird product-ID · Actief (checkbox) · Promptregel (formule: `RECORD_ID() & "|" & {Artikelnummer} & "|" & {Omschrijving} & "|" & {Eenheid} & "|" & {Zoektermen}`)

## Monteurs

Naam (primair) · Bijnamen (zoals op bonnen, bijv. "Henk, HdV") · E-mail · Standaardtarief (link → Tarieven) · Standaardtarief bedrag (lookup) · Actief · Promptregel (formule: `RECORD_ID() & "|" & {Naam} & "|" & {Bijnamen}`)

## Tarieven

Code (primair, bijv. NORMAAL, OVERWERK, ZATERDAG, ZONDAG, SPOED, LEERLING, REIS) · Omschrijving (factuurtekst) · Type (single select: arbeid, reistijd) · Bedrag per uur (valuta) · Btw % · Zoektermen · Actief · Promptregel (formule: `RECORD_ID() & "|" & {Code} & "|" & {Omschrijving} & "|" & {Zoektermen}`)

## Configuratie (precies één record)

| Veld                          | Type                          | Voorbeeld                     |
| ----------------------------- | ----------------------------- | ----------------------------- |
| Naam                          | Tekst (primair)               | Configuratie                  |
| Bedrijfsnaam                  | Tekst                         | Dakkapel Noord B.V.           |
| Standaard uurtarief           | Valuta                        | 62,50                         |
| Standaard reistijdtarief      | Link → Tarieven               | REIS                          |
| Max. uren per bon             | Getal                         | 24                            |
| Max. uren per monteur per dag | Getal                         | 12                            |
| E-mail kantoor                | E-mail                        |                               |
| E-mail beheerder              | E-mail                        | csaba@…                       |
| Exportmethode                 | Single select: Moneybird, CSV | Moneybird                     |
| Moneybird administratie-ID    | Tekst                         |                               |
| Moneybird tax_rate_id 21%     | Tekst                         |                               |
| Moneybird tax_rate_id 9%      | Tekst                         |                               |
| Moneybird tax_rate_id 0%      | Tekst                         |                               |
| Google Drive map-ID (CSV)     | Tekst                         |                               |
| AI-model                      | Tekst                         | claude-sonnet-5-5             |
| Extra promptinstructies       | Lange tekst                   | "Bonnummers beginnen met DK-" |

## Interface "Werkbon review"

- Pagina **Te reviewen**: lijst met filter Status = In review, gesorteerd op Ontvangen op. Recordweergave: links Bijlage (groot), rechts de velden; daaronder Urenregels en Materiaalregels als bewerkbare lijsten. Flags bovenaan.
- Knop **Goedkeuren**: "Update record" → Status = Goedgekeurd.
- Knop **Afkeuren**: "Update record" → Status = Afgekeurd (Reden afkeuring moet gevuld zijn; zet het veld als verplicht in de recordweergave).
- Pagina **Fouten**: Status = Fout, met Foutmelding.

## Automations

1. **Goedgekeurd → Make**: trigger "When record matches conditions" (Status = Goedgekeurd) → "Run script":

   ```js
   const { recordId } = input.config();
   const res = await fetch("WEBHOOK_URL_SCENARIO_2", {
     method: "POST",
     headers: { "Content-Type": "application/json" },
     body: JSON.stringify({ record_id: recordId }),
   });
   if (!res.ok) throw new Error("Make-webhook gaf " + res.status);
   ```

   Input-variabele `recordId` = Airtable record ID van de trigger.
