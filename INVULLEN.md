# In te vullen

Op de site staat niets verzonnen. Waar informatie ontbreekt, staat een `[INVULLEN: …]` in de tekst of is een veld leeg gelaten. Hieronder alles op een rij.

## Teksten op de site

| Waar | Wat | Waarom |
|---|---|---|
| `/over-veryo/`, sectie "Ervaring en achtergrond" | `[INVULLEN: achtergrond en werkervaring van Csaba]`: opleiding, eerdere functies, sectoren | E-E-A-T: Google en AI-zoekmachines willen zien wie er achter de kennis zit |
| `/over-veryo/`, idem | `[INVULLEN: certificeringen of cursussen op het gebied van AI]`, alleen als ze echt behaald zijn | Idem. Geen certificaat? Haal de zin weg |
| `/over-veryo/`, idem | `[INVULLEN: spreekbeurten, publicaties of samenwerkingen]`, alleen als ze er zijn | Idem. Niets? Haal de zin weg |
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
