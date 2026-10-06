# Werkbon MASTER – 1b. Uitlezen

Make-scenario `9928221` in map "Veryo Werkbon – MASTER". Trigger: webhook **Werkbon MASTER – Werkbon uitlezen** met JSON `{"record_id": "rec…"}`. Wordt aangeroepen door 1a (na opslaan van de bijlage) en kan handmatig opnieuw worden aangeroepen om een werkbon **opnieuw uit te lezen** (oude uren- en materiaalregels worden dan eerst verwijderd).

## Stappen

1. **Klantinstellingen** — base-ID, Configuratie-record, fout-webhook.
2. **Werkbon ophalen** + **Configuratie ophalen** (prompt, schema, model, tarieven, maxima).
3. **Bijlagen doorlopen → Bijlage downloaden → Bijlagen klaarzetten voor Claude** — alleen JPG/PNG/GIF/WEBP/PDF; als base64 (Claude mag Airtable-links niet zelf ophalen).
4. Router:
   - niets leesbaar → melding naar Scenario 3 (record op Fout);
   - oude urenregels / materiaalregels verwijderen (alleen bij opnieuw uitlezen);
   - hoofdroute:
5. **Artikellijst / Monteurs / Tarieven ophalen** (alleen actieve, max. 100 per lijst) → als JSON in de prompt.
6. **Prompt opbouwen → Aanvraag opbouwen → Werkbon uitlezen** (Claude, structured output; bij fout na 30 s één nieuwe poging).
7. **Antwoord lezen** (JSON).
8. **Klant zoeken / kiezen** — op klantnummer, postcode of naam; "zeker" bij precies 1 treffer met gelijk klantnummer of postcode.
9. Router:
   - **Urenregels**: uren berekenen (eind − start − pauze, over middernacht +24 u), tarief kiezen (soort op bon → standaardtarief monteur → standaard uurtarief), bedrag; in één keer opslaan.
   - **Materiaalregels**: artikel-ID controleren, prijs en btw uit Artikelen, bedrag; in één keer opslaan.
   - **Afronden**: reistijdbedrag, totalen, flags → werkbon op **In review**.

Elke API-stap heeft een error-handler naar Scenario 3.

## Operaties

Testbon (1 foto, 2 urenregels, 5 materialen): **41 operaties**. Grofweg 30 + 2 per urenregel + 0 per materiaalregel.

## Configuratie per klant

Alleen **Klantinstellingen** aanpassen; prompt, schema, model en tarieven staan in Airtable.

## Testresultaat (06-10-2026, `testdata/testwerkbon-1.jpg`)

Alle velden juist; totaal € 1.149,35 (12,5 u × € 60 + 1 u reistijd × € 45 + € 354,35 materiaal); flag "materiaal onzeker" voor "lood 30cm" (niet in artikellijst). Opnieuw uitlezen vervangt de regels correct.
