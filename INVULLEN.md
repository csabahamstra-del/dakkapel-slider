# In te vullen

Op de site staat niets verzonnen en er staan geen `[INVULLEN]`-plekken meer in de teksten. Wat hieronder staat, zijn lege instellingen of zaken buiten de site.

**Optioneel voor /over-veryo/:** opleiding, eerdere functies, behaalde AI-certificaten of spreekbeurten van Csaba. Dat versterkt E-E-A-T. Geef ze door, dan zet ik ze erin.

## Teksten op de site

| Waar | Wat | Waarom |
|---|---|---|
| Blogconcepten | `[CONCEPT …]`-notitie bovenaan elk concept en `[CHECK]`-markeringen in de drie gidsen (24 stuks) | Feiten over AI Act, AVG en voorwaarden van ChatGPT controleren bij de genoemde bron vóór publicatie |

## Instellingen > Veryo

| Veld | Status | Waarom |
|---|---|---|
| LinkedIn-URL (bedrijf of Csaba) | Leeg | Komt in `sameAs` van het schema, in het auteursblok onder blogartikelen en in llms.txt |
| Adres (straat, postcode) | Controleren | NAP moet overal gelijk zijn: site, Google Bedrijfsprofiel, KvK, vermeldingen |
| KvK- en btw-nummer | Controleren | Footer en schema |
| Foto van Csaba | Controleren of hij staat | Auteursblok, over-pagina, Person-schema |

## Niet op de site, wel nodig

| Wat | Waar | Toelichting |
|---|---|---|
| Openingstijden | Instellingen > Veryo of melden, dan zet ik ze in het LocalBusiness-schema | Nu staan er geen openingstijden in het schema, want ze zijn niet bekend |
| GA4-meet-ID (`G-…`) of GTM-container (`GTM-…`) | Via Site Kit of een GTM-plugin, of melden | Het thema stuurt de events (`generate_lead`, `click_phone`, `click_email`) al naar `gtag` of `dataLayer`, maar laadt zelf geen Google-script |
| Google Ads-conversielabel | Google Ads | Voor de conversie "lead" op basis van het event `generate_lead` |
| Reviews | Google Bedrijfsprofiel | Er staan bewust geen reviews of sterren op de site of in het schema. Echte Google-reviews kun je later tonen |
| Cases en klantlogo's | Melden als er toestemming is | Pas toevoegen met toestemming van de klant |
| Eigen OG-afbeeldingen per pagina | Optioneel | Nu een standaardafbeelding van 1200×630 |
