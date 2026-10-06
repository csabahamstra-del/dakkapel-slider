# Airtable template-base — "Veryo Werkbonnen – TEMPLATE"

Eén base per klant, gedupliceerd van de template-base. Tabel- en veldnamen zijn exact zoals de Make-scenario's ze verwachten; niet hernoemen zonder de scenario's aan te passen.

- Template-base: `appcPcWnVzejmyDcr` (workspace `wspnZBjvrrUYqKb3q`)
- Configuratie-record in de template: `recXKTc6lu8J7LvX2`

Alle gewone velden en koppelvelden zijn via de API aangemaakt. Formule-, lookup- en rollupvelden kan de Airtable-API niet aanmaken: die staan hieronder als **handmatig** en moeten één keer in de template worden toegevoegd. Daarna gaan ze bij dupliceren vanzelf mee.

## Handmatige stappen (eenmalig in de template)

### 1. Koppelvelden op "één record" zetten

Open het veld → _Edit field_ → zet **Allow linking to multiple records** uit:

- Werkbonnen: `Gematchte klant`, `Reistijdtarief`
- Urenregels: `Werkbon`, `Monteur`, `Tarief`
- Materiaalregels: `Werkbon`, `Gematcht artikel`
- Monteurs: `Standaardtarief`
- Configuratie: `Standaard reistijdtarief`

### 2. Lookup-, rollup- en formulevelden

Voeg ze in deze volgorde toe (latere velden gebruiken eerdere).

**Monteurs**

| Veld                   | Type   | Instelling                       |
| ---------------------- | ------ | -------------------------------- |
| Standaardtarief bedrag | Lookup | Standaardtarief → Bedrag per uur |

**Urenregels**

| Veld                    | Type    | Instelling                                                                                                                                                                               |
| ----------------------- | ------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Tarief bedrag (gekozen) | Lookup  | Tarief → Bedrag per uur                                                                                                                                                                  |
| Tarief bedrag (monteur) | Lookup  | Monteur → Standaardtarief bedrag                                                                                                                                                         |
| Uren                    | Formule | zie onder                                                                                                                                                                                |
| Tarief toegepast        | Formule | `IF(SUM({Tarief bedrag (gekozen)}), SUM({Tarief bedrag (gekozen)}), IF(SUM({Tarief bedrag (monteur)}), SUM({Tarief bedrag (monteur)}), {Tarief bedrag (standaard)}))` — opmaak: valuta € |
| Bedrag                  | Formule | `ROUND({Uren} * {Tarief toegepast}, 2)` — opmaak: valuta €                                                                                                                               |

Formule **Uren** (gebruikt `Uren (op bon)` als die is ingevuld, anders eind − start − pauze; over middernacht telt +24 uur):

```
IF(
  {Uren (op bon)} != BLANK(),
  {Uren (op bon)},
  IF(
    AND({Starttijd}, {Eindtijd}),
    ROUND(
      MOD(
        (VALUE(REGEX_EXTRACT({Eindtijd}, "^\\d+")) * 60 + VALUE(REGEX_EXTRACT({Eindtijd}, "\\d+$")))
        - (VALUE(REGEX_EXTRACT({Starttijd}, "^\\d+")) * 60 + VALUE(REGEX_EXTRACT({Starttijd}, "\\d+$")))
        + 1440,
        1440
      ) / 60
      - IF({Pauze (min)}, {Pauze (min)}, 0) / 60,
      2
    )
  )
)
```

**Materiaalregels**

| Veld            | Type    | Instelling                                                                   |
| --------------- | ------- | ---------------------------------------------------------------------------- |
| Prijs           | Lookup  | Gematcht artikel → Verkoopprijs                                              |
| Btw %           | Lookup  | Gematcht artikel → Btw %                                                     |
| Prijs toegepast | Formule | `IF({Prijs override} != BLANK(), {Prijs override}, SUM({Prijs}))` — valuta € |
| Bedrag          | Formule | `ROUND({Aantal} * {Prijs toegepast}, 2)` — valuta €                          |

**Werkbonnen**

| Veld                  | Type         | Instelling                                                            |
| --------------------- | ------------ | --------------------------------------------------------------------- |
| Klant ERP-ID          | Lookup       | Gematchte klant → ERP klant-ID                                        |
| Reistijdtarief bedrag | Lookup       | Reistijdtarief → Bedrag per uur                                       |
| Reistijd bedrag       | Formule      | `ROUND({Reistijd uren} * SUM({Reistijdtarief bedrag}), 2)` — valuta € |
| Totaal uren           | Rollup       | Urenregels → Uren, `SUM(values)`                                      |
| Totaal arbeid         | Rollup       | Urenregels → Bedrag, `SUM(values)` — valuta €                         |
| Totaal materiaal      | Rollup       | Materiaalregels → Bedrag, `SUM(values)` — valuta €                    |
| Totaal excl. btw      | Formule      | `{Totaal arbeid} + {Totaal materiaal} + {Reistijd bedrag}` — valuta € |
| Aangemaakt            | Created time | —                                                                     |

### 3. Kleuren (optioneel)

Status: Ontvangen grijs · In review geel · Goedgekeurd groen · Afgekeurd rood · Geëxporteerd blauw · Fout rood.

## Tabellen (via API aangemaakt)

**Werkbonnen** — Werkbon (primair, door Make gevuld) · Status · Ontvangen op · Afzender · Onderwerp mail · Bijlage · Bestands-hash · Alle hashes · Werkbonnummer · Datum · Klantnaam (op bon) · Adres (op bon) · Gematchte klant → Klanten · Klantmatch zeker · Werkzaamheden · Samenvatting · Opmerkingen · Reistijd (op bon) · Reistijd uren · Reistijdtarief → Tarieven · Handtekening aanwezig · Vervolgactie nodig · Toelichting vervolgactie · Confidence · Flags · Twijfelpunten · Ruwe AI-output · Reden afkeuring · Export-ID · Exportlink · Foutmelding · Urenregels · Materiaalregels

**Flags:** geen handtekening · uren ontbreken · uren boven maximum · materiaal onzeker · klant niet gevonden · klant onzeker · confidence laag · meerdere werkbonnen · geen werkbon · bestand te groot · onbekend bestandstype

**Urenregels** — Regel (primair, door Make) · Werkbon · Monteur (op bon) · Monteur → Monteurs · Datum · Starttijd · Eindtijd · Pauze (min) · Uren (op bon) · Soort (op bon) · Tarief → Tarieven · Tarief bedrag (standaard) (door Make uit Configuratie)

**Materiaalregels** — Omschrijving (op bon) · Werkbon · Artikelnummer (op bon) · Aantal · Eenheid · Gematcht artikel → Artikelen · Match zeker · Prijs override

**Klanten** — Naam · Adres · Postcode · Plaats · Klantnummer · ERP klant-ID · E-mail · Actief

**Artikelen** — Artikelnummer · Omschrijving · Zoektermen · Eenheid · Verkoopprijs · Btw % · ERP artikel-ID · Actief

**Monteurs** — Naam · Bijnamen · E-mail · Standaardtarief → Tarieven · Actief

**Tarieven** — Code · Omschrijving (factuurtekst) · Type (arbeid/reistijd) · Bedrag per uur · Btw % · Zoektermen · ERP artikel-ID · Actief. In de template staan voorbeeldtarieven NORMAAL, OVERWERK, ZATERDAG en REIS.

**Configuratie** (precies één record) — Naam · Bedrijfsnaam · Standaard uurtarief · Btw % standaard · Max. uren per bon · Max. uren per monteur per dag · E-mail kantoor · E-mail beheerder · Exportmethode (CSV / Adapter) · Adapter webhook-URL · Google Drive map-ID · AI-model · Extra promptinstructies · Standaard reistijdtarief → Tarieven

### Tariefkeuze per urenregel

1. `Tarief` ingevuld (door AI uit de soort op de bon, of door kantoor) → dat tarief.
2. Anders het standaardtarief van de gekoppelde monteur.
3. Anders `Standaard uurtarief` uit Configuratie (door Make bij aanmaak in `Tarief bedrag (standaard)` gezet).

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
