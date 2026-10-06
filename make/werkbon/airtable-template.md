# Airtable template-base — "Veryo Werkbonnen – TEMPLATE"

Eén base per klant, gedupliceerd van de template-base. Tabel- en veldnamen zijn exact zoals de Make-scenario's ze verwachten; niet hernoemen zonder de scenario's aan te passen.

- Template-base: `appcPcWnVzejmyDcr` (workspace `wspnZBjvrrUYqKb3q`)
- Configuratie-record in de template: `recXKTc6lu8J7LvX2`

Alle velden zijn via de API aangemaakt; er zijn geen handmatige stappen nodig. Bedragen zijn gewone getal-/valutavelden die **Make** berekent (geen Airtable-formules: die kan de API niet aanmaken).

## Berekeningen (in Make, nooit door de AI)

| Waar            | Veld                                                           | Berekening                                                                                                               |
| --------------- | -------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------ |
| Urenregels      | Uren                                                           | `Uren (op bon)` als ingevuld, anders (eindtijd − starttijd, +24 u als over middernacht) − pauze, afgerond op 2 decimalen |
| Urenregels      | Tarief toegepast                                               | Tarief uit de link `Tarief`; anders standaardtarief van de `Monteur`; anders `Standaard uurtarief` uit Configuratie      |
| Urenregels      | Bedrag                                                         | Uren × Tarief toegepast, afgerond op centen                                                                              |
| Materiaalregels | Prijs, Btw %                                                   | Uit het gematchte artikel (op moment van intake); `Prijs override` gaat voor                                             |
| Materiaalregels | Bedrag                                                         | Aantal × (Prijs override of Prijs), afgerond op centen                                                                   |
| Werkbonnen      | Reistijd bedrag                                                | Reistijd uren × tarief van `Reistijdtarief` (anders `Standaard reistijdtarief` uit Configuratie)                         |
| Werkbonnen      | Totaal uren, Totaal arbeid, Totaal materiaal, Totaal excl. btw | Sommen over de regels                                                                                                    |

Scenario 1 vult deze velden bij intake. Scenario 2 rekent ze bij goedkeuring **opnieuw** uit op basis van de (eventueel door kantoor aangepaste) regels en schrijft de nieuwe waarden terug vóór de export. Het reviewscherm kan dus achterlopen als kantoor iets wijzigt; de export klopt altijd.

## Tabellen (via API aangemaakt)

**Werkbonnen** — Werkbon (primair, door Make gevuld) · Status · Ontvangen op · Afzender · Onderwerp mail · Bijlage · Bestands-hash · Alle hashes · Werkbonnummer · Datum · Klantnaam (op bon) · Adres (op bon) · Gematchte klant → Klanten · Klantmatch zeker · Werkzaamheden · Samenvatting · Opmerkingen · Reistijd (op bon) · Reistijd uren · Reistijdtarief → Tarieven · Handtekening aanwezig · Vervolgactie nodig · Toelichting vervolgactie · Confidence · Flags · Twijfelpunten · Ruwe AI-output · Reden afkeuring · Export-ID · Exportlink · Foutmelding · Urenregels · Materiaalregels · Totaal uren · Reistijd bedrag · Totaal arbeid · Totaal materiaal · Totaal excl. btw

**Flags:** geen handtekening · uren ontbreken · uren boven maximum · materiaal onzeker · klant niet gevonden · klant onzeker · confidence laag · meerdere werkbonnen · geen werkbon · bestand te groot · onbekend bestandstype

**Urenregels** — Regel (primair, door Make) · Werkbon · Monteur (op bon) · Monteur → Monteurs · Datum · Starttijd · Eindtijd · Pauze (min) · Uren (op bon) · Soort (op bon) · Tarief → Tarieven · Tarief bedrag (standaard) · Uren · Tarief toegepast · Bedrag

**Materiaalregels** — Omschrijving (op bon) · Werkbon · Artikelnummer (op bon) · Aantal · Eenheid · Gematcht artikel → Artikelen · Match zeker · Prijs override · Prijs · Btw % · Bedrag

**Klanten** — Naam · Adres · Postcode · Plaats · Klantnummer · ERP klant-ID · E-mail · Actief

**Artikelen** — Artikelnummer · Omschrijving · Zoektermen · Eenheid · Verkoopprijs · Btw % · ERP artikel-ID · Actief

**Monteurs** — Naam · Bijnamen · E-mail · Standaardtarief → Tarieven · Actief

**Tarieven** — Code · Omschrijving (factuurtekst) · Type (arbeid/reistijd) · Bedrag per uur · Btw % · Zoektermen · ERP artikel-ID · Actief. In de template staan voorbeeldtarieven NORMAAL, OVERWERK, ZATERDAG en REIS.

**Configuratie** (precies één record) — Naam · Bedrijfsnaam · Standaard uurtarief · Btw % standaard · Max. uren per bon · Max. uren per monteur per dag · E-mail kantoor · E-mail beheerder · Exportmethode (CSV / Adapter) · Adapter webhook-URL · Google Drive map-ID · AI-model · Extra promptinstructies · Standaard reistijdtarief → Tarieven

## Interface "Werkbon review"

- Pagina **Te reviewen**: lijst met filter Status = In review, gesorteerd op Ontvangen op. Recordweergave: links Bijlage (groot), rechts de velden; daaronder Urenregels en Materiaalregels als bewerkbare lijsten. Flags bovenaan.
- Knop **Goedkeuren**: "Update record" → Status = Goedgekeurd.
- Knop **Afkeuren**: "Update record" → Status = Afgekeurd (Reden afkeuring verplicht in de recordweergave).
- Pagina **Fouten**: Status = Fout, met Foutmelding.

## Automation "Goedgekeurd → Make"

Trigger "When record matches conditions" (Werkbonnen, Status = Goedgekeurd) → "Run script" (betaald Airtable-plan):

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
