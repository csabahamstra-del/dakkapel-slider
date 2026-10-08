# Veryo cold outreach met Lemlist — stappenplan

Eenmalig ±1 uur instellen. Daarna ±10 minuten per week.

## Wat Lemlist voor je doet

- **Bedrijven en beslissers vinden** in de eigen database, op branche, regio en grootte.
- **Mailadressen vinden en controleren.** Ongeldige adressen worden niet gemaild.
- **Per lead één persoonlijke openingszin schrijven** met AI, op basis van de website.
- **De 4 mails versturen** op werkdagen tussen 07:30 en 10:00.
- **Automatisch stoppen** bij een reactie, bounce of afmelding.
- **Reacties komen gewoon in je inbox** (info@veryo.nl). Daar antwoord jij zelf.

**Wat jij doet:** één keer per week de nieuwe leads bekijken (±10 min, zie stap 7) en zelf
antwoorden op reacties.

---

## 1. Account

1. Maak een account op lemlist.com.
2. Kies het **Email**-plan: ±€69 per maand, of ±€55 per maand bij jaarbetaling.
   - Het Multichannel-plan (±€109) is alleen nodig voor LinkedIn-stappen. Die raad ik af, zie
     stap 8.
   - Controleer de actuele prijzen bij het afsluiten.
3. Mailadressen vinden kost credits, ±€0,05 per adres. Bij ±8 leads per week is dat een paar
   euro per maand.

## 2. Mailbox koppelen

1. Ga naar **Settings → Email accounts → Add**.
2. Kies **Other provider (SMTP/IMAP)** en vul de gegevens van info@veryo.nl in. Die vind je in
   het mijn.host-paneel. Meestal is het:
   - SMTP-server `mail.veryo.nl` (of de host die mijn.host opgeeft), poort 465 (SSL);
   - IMAP-server dezelfde host, poort 993 (SSL);
   - gebruikersnaam `info@veryo.nl`, met het wachtwoord van die mailbox.
3. Zet **Warm-up (lemwarm)** aan en wacht **2 weken** voordat je echt begint. Een mailbox die
   ineens cold mail stuurt, belandt anders sneller in spam.
4. DNS (SPF, DKIM, DMARC) staat al goed voor veryo.nl. Lemlist controleert dit ook zelf.

**Handtekening** (Settings → Signature):

```
Groet,
Csaba
Oprichter Veryo | 085-0605752
```

## 3. Algemene instellingen per campagne

Doe dit bij elke campagne onder **Settings**:

| Instelling                         | Waarde                                                        |
| ---------------------------------- | ------------------------------------------------------------- |
| Verzenddagen                       | maandag t/m vrijdag                                           |
| Verzendvenster                     | 07:30 – 10:00, tijdzone **Europe/Amsterdam**                  |
| Max. nieuwe leads per dag          | 2                                                             |
| Max. mails per dag (mailbox)       | 25                                                            |
| Stop bij reactie                   | aan                                                           |
| Stop voor hele bedrijf bij reactie | aan (anders mailt hij een collega van hetzelfde bedrijf door) |
| Afmeldlink                         | uit (de zin "Liever geen mail meer?" staat al in de mail)     |
| Tracking (opens/clicks)            | **uit** (beter voor bezorging en AVG)                         |

Twee leads per dag op 4 werkdagen geeft ±8 nieuwe leads per week. Dat is je doel, en ruim
binnen de afgesproken grens van 10 per week.

## 4. Drie campagnes

Maak drie campagnes:

1. **Vak — dakkapel/kozijn/vloer**
2. **Beveiliging — klein (<50 fte)**
3. **Beveiliging — groot (50+ fte)**

Beveiliging is gesplitst omdat mail 1 per grootte een andere zin heeft.

### Leads zoeken (Lemlist → Lead finder / People database)

| Filter      | Vak                                                                 | Beveiliging klein               | Beveiliging groot                                             |
| ----------- | ------------------------------------------------------------------- | ------------------------------- | ------------------------------------------------------------- |
| Land        | Nederland                                                           | Nederland                       | Nederland                                                     |
| Branche     | Construction / Building materials                                   | Security & Investigations       | Security & Investigations                                     |
| Trefwoorden | dakkapel, kozijnen, vloeren, PVC kozijnen, gietvloer, traprenovatie | beveiliging, bewaking, security | beveiliging, bewaking, security                               |
| Grootte     | 5–50 medewerkers                                                    | 2–49 medewerkers                | 50+ medewerkers                                               |
| Functie     | eigenaar, directeur, owner, CEO, DGA, oprichter                     | eigenaar, directeur, owner, CEO | operationeel manager, operations manager, COO, hoofd operatie |

Voeg per keer ±10 leads toe. Kies **alleen leads met een geverifieerd mailadres** ("verified"),
op het domein van het bedrijf zelf, dus geen gmail/hotmail.

### AI-variabele 1: `bv_check` (wettelijke check)

Je mag zonder toestemming alleen een **BV of NV** mailen, geen eenmanszaak of VOF. Voeg een
AI-kolom toe (**Add column → AI variable**) met deze prompt:

```
Bekijk de website {{companyDomain}} (homepage, footer, contactpagina, algemene voorwaarden).
Staat de bedrijfsnaam daar met "B.V.", "BV", "N.V." of "NV"?
Antwoord met precies één woord: JA, NEE of ONBEKEND.
```

Alleen leads met **JA** gaan de campagne in. NEE en ONBEKEND verwijder je.

### AI-variabele 2: `icebreaker` (de persoonlijke eerste zin)

Voeg een tweede AI-kolom toe:

```
Je schrijft één openingszin in het Nederlands voor een zakelijke e-mail aan {{firstName}}
van {{companyName}} ({{companyDomain}}).

Baseer de zin uitsluitend op iets concreets dat je op hun eigen website vindt, bijvoorbeeld:
een vacature (calculator, werkvoorbereider, planner, beveiliger), een regio waar ze actief
zijn, een nieuwe vestiging, een project of een nieuwe opdrachtgever.

Regels:
- Precies één zin, maximaal 25 woorden.
- Geen complimenten, geen overdreven toon, geen uitroeptekens.
- Verzin niets: geen cijfers, klanten, projecten of feiten die niet letterlijk op de site staan.
- Doe niet alsof de afzender iets persoonlijk heeft meegemaakt of gezien buiten de website.
- Schrijf in de ik-vorm, informeel ("jullie").

Voorbeelden van de juiste toon:
"Zag op jullie site dat jullie een calculator zoeken."
"Zag dat jullie dakkapellen plaatsen in de regio Zwolle en Deventer."

Als je niets concreets vindt, antwoord dan precies:
"Ik kwam {{companyName}} tegen toen ik bedrijven in jullie branche bekeek."
```

## 5. De mails

Plak deze teksten in de sequence. `{{icebreaker}}` vult Lemlist per lead in.

### Campagne Vak

**Stap 1, dag 1 — Onderwerp:** `aanvragen bij {{companyName}}`

```
Hoi {{firstName}},

{{icebreaker}}

Bij dakkapel- en kozijnbedrijven zie ik vaak dat een aanvraag een dag of langer blijft liggen, simpelweg omdat iedereen op de bouw staat. Wie het eerst belt, krijgt meestal de inmeting.

Wij zetten daar een automatische opvolging op: elke aanvraag krijgt binnen een paar minuten reactie en de inmeting staat direct in jullie agenda. Op jullie bestaande systemen, niks nieuws leren.

Is dit iets waar jullie tegenaan lopen?

Groet,
Csaba
Oprichter Veryo | 085-0605752

Liever geen mail meer? Laat het weten, dan stop ik.
```

**Stap 2, dag 4 — als antwoord in dezelfde thread** (onderwerp leeg laten):

```
Hoi {{firstName}},

Even een andere vraag: weten jullie hoeveel aanvragen er per maand binnenkomen en hoeveel daarvan een inmeting worden?

Daar zit vaak het meeste geld. Als je nu adverteert of via een platform leads koopt, levert snellere opvolging meer inmetingen op uit hetzelfde budget.

Zal ik in 12 minuten laten zien hoe dat bij jullie zou werken?

Csaba
```

**Stap 3, dag 8 — Onderwerp:** `gratis scan voor {{companyName}}`

```
Hoi {{firstName}},

Als een gesprek nu te veel is: we hebben een korte AI-scan (±5 min). Je krijgt daarna per mail een rapport met waar jullie tijd en aanvragen laten liggen.

https://veryo.nl/waar-begin-ik-met-ai/#ai-scan

Csaba
```

**Stap 4, dag 13 — Onderwerp:** `zal ik stoppen?`

```
Hoi {{firstName}},

Ik heb je een paar keer gemaild over de opvolging van aanvragen bij {{companyName}}. Geen reactie zegt ook iets, dus ik laat het hierbij.

Speelt het later wel? Dan ben ik bereikbaar op 085-0605752.

Succes!
Csaba
```

### Campagnes Beveiliging (klein en groot)

Beide campagnes zijn gelijk, behalve de derde alinea van mail 1.

**Stap 1, dag 1 — Onderwerp:** `maandrapportages bij {{companyName}}`

```
Hoi {{firstName}},

{{icebreaker}}

[KLEIN:] Bij kleinere beveiligers zit de directeur vaak zelf 's avonds rapporten samen te voegen voor opdrachtgevers.
[GROOT:] Bij groeiende beveiligers gaan er veel planner-uren in rapportages zitten, en elke opdrachtgever krijgt een net iets ander rapport.

Wij zetten dienst- en incidentrapporten automatisch om in een professioneel maandrapport per opdrachtgever. Het werkt op jullie huidige systeem of mail, dus geen nieuwe software.

Herkenbaar?

Groet,
Csaba
Oprichter Veryo | 085-0605752

Liever geen mail meer? Laat het weten, dan stop ik.
```

Gebruik per campagne alleen de bijbehorende zin, zonder `[KLEIN:]` of `[GROOT:]`.

**Stap 2, dag 4 — als antwoord in dezelfde thread:**

```
Hoi {{firstName}},

Concreet voorstel: stuur me de rapporten van één opdrachtgever van vorige maand, en je krijgt het maandrapport gratis terug. Dan zie je meteen of het voor jullie werkt.

Interesse?

Csaba
```

**Stap 3, dag 8 — Onderwerp:** `rapportage als verkoopargument`

```
Hoi {{firstName}},

Andere invalshoek: een strak maandrapport laat opdrachtgevers zien wat jullie allemaal doen. Dat helpt bij verlengingen en bij aanbestedingen.

Het aanbod van een gratis proefrapport staat nog. Zal ik even bellen om het toe te lichten? https://calendly.com/csabahamstra/30min

Csaba
```

**Stap 4, dag 13 — Onderwerp:** `zal ik stoppen?`

```
Hoi {{firstName}},

Ik heb je een paar keer gemaild over de maandrapportages bij {{companyName}}. Geen reactie zegt ook iets, dus ik laat het hierbij.

Speelt het later wel? Dan ben ik bereikbaar op 085-0605752.

Succes!
Csaba
```

## 6. Afmeldingen en uitsluitingen

- **Afmelden:** zegt iemand "stop" of "geen interesse", markeer de lead in Lemlist als
  **Unsubscribed**. Het adres gaat dan op de blocklist en wordt nooit meer gemaild.
- **Blocklist bijhouden:** zet onder **Settings → Blocklist** de domeinen van:
  - je bestaande klanten;
  - lopende gesprekken;
  - je eigen domein (veryo.nl).
- **Max. 1 persoon per bedrijf:** voeg per bedrijf maar één beslisser toe.

## 7. Wekelijkse routine (±10 minuten, bijvoorbeeld maandagochtend)

1. Voeg ±10 nieuwe leads toe via de zoekfilters van stap 4.
2. Laat de AI-kolommen draaien. Verwijder alles zonder `bv_check` = JA.
3. **Controleer de BV-status snel op kvk.nl** (zoeken op bedrijfsnaam, ±15 seconden per lead).
   De AI-check is een voorfilter, KvK is het bewijs.
4. Lees de `icebreaker`-zinnen even door. Een vreemde zin pas je aan of vervang je door de
   standaardzin.
5. Start de leads.

## 8. LinkedIn

Laat LinkedIn **niet** automatisch versturen. LinkedIn verbiedt automatisering en kan je
persoonlijke account beperken. Wil je LinkedIn erbij, voeg dan in de sequence een **handmatige
taak** toe ("Connect op LinkedIn") op dag 2. Lemlist herinnert je eraan en jij klikt zelf.

## 9. Eerste test vóór je live gaat

1. Maak een testlead met je eigen hotmail-adres en een fictief bedrijf.
2. Start de campagne alleen voor die lead.
3. Controleer:
   - komen de mails aan, en niet in spam;
   - staan voornaam, bedrijfsnaam en icebreaker goed;
   - komt mail 2 in dezelfde thread;
   - stopt de reeks als je antwoordt?
