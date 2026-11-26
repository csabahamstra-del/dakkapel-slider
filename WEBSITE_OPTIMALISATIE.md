# Website-optimalisatie (thema 2.6.0)

Branch `website-optimalisatie`, gebouwd bovenop de SEO-sprint (2.5.0).

Uitgangspunten, zoals afgestemd op 26 november:
- **Positionering:** breed mkb (2–100 medewerkers).
- **Huisstijl:** de bestaande huisstijl, verfijnd (petrol, amber, zand, Newsreader en Plus Jakarta Sans).
- **Geen losse trainingen:** "Na de oplevering leren we jullie team ermee werken".
- **Geen bedragen op de site:** gratis offerte met vooraf een vaste prijs.
- **URL's blijven:** de branchepagina's staan op `/branches/...` en de kennisbank op `/kennis/`. Ik heb geen dubbele pagina's op nieuwe URL's gemaakt.

## Audit (fase 1): belangrijkste bevindingen

| Gebied | Bevinding | Aanpak |
|---|---|---|
| Homepage | Meer dan 20 blokken (ruim 2.300 woorden) zonder duidelijke volgorde; de hero-foto was een stockfoto en de tekst liep over de draaiende kaartjes. | Nieuwe opbouw in de 12 stappen uit de brief; hero met workflow-visual in plaats van foto. |
| Positionering | Overal "technische bedrijven 15–50". | Homepage, diensten, Over Veryo, llms.txt en Leeuwarden naar breed mkb. |
| Navigatie | 7 items, waarvan 2 overlappende dropdowns ("Diensten" en "Automatisering"); de CTA was "Plan een demo" van Collega. | Nieuw menu en de CTA "Gratis AI-scan". |
| Cases | Een blok met [VUL IN] dat met een instelling verborgen werd. | Echte casestructuur in wp-admin; er verschijnt niets zonder goedgekeurde case. |
| Kennisbank | Geen categorieën en geen zoekfunctie. | 5 categorieën, zoeken en een filter. `/kennisbank` doet een 301 naar `/kennis/`. |
| SEO-techniek | Al op orde (canonical, OG, schema, sitemap, robots); de categoriepagina's misten meta. | Meta, canonical en breadcrumbs voor de kenniscategorieën. |
| Ongebruikte code | Na de herbouw bleven 7 functies en een JS-blok over. | Verwijderd (zie hieronder). |

## 1. Gewijzigde pagina's

- **Homepage**, volledig opnieuw opgebouwd:
  1. hero "Minder handwerk. Meer tijd voor je bedrijf." met de twee CTA's en een workflow-visual;
  2. probleemherkenning;
  3. 10 AI-toepassingen, elk met een link naar een bestaande pagina;
  4. 6 branchekaarten;
  5. het proces in 4 stappen;
  6. interactieve demo's;
  7. drie routes: Veryo Start, Automation en Partner;
  8. cases (alleen echte);
  9. "Geen AI-hype";
  10. AI-scan;
  11. regio's, 10 FAQ's en het blok Veelgevraagd;
  12. de afsluitende CTA.
- **/diensten/** in vijf categorieën (zonder training en zonder bedragen):
  - AI-strategie: kansensessie en Veryo Start;
  - AI-werkplek;
  - AI-automatisering: quick win, project, maatwerk, de kringloop en agents;
  - AI-veiligheid;
  - AI-partner.
- **/over-veryo/:** waarom Veryo bestaat, waarom implementatie belangrijker is dan hype, en hoe we met ondernemers samenwerken.
- **/leeuwarden/:** intro voor breed mkb.
- **Kennisbank:** het archief met zoeken en categorieën, plus nieuwe pagina's `/kennis/categorie/…/`.
- **Header en menu:** zie "Navigatie".

## 2. Belangrijkste componenten

| Component | Waar | Werking |
|---|---|---|
| Workflow-visual in de hero | `inc/photos.php` (`veryo_render_home_hero`), `assets/js/home.js` | Vijf stappen van aanvraag tot antwoord; de stappen lichten om de beurt op als de visual in beeld is. Met reduced motion staat alles stil. Gelabeld als "Illustratie, geen klantcase". |
| Demo's `[veryo_demos]` | `inc/demos.php`, `home.js` | Vijf demo's: offerteassistent, telefonist, documentverwerker, leadopvolging en kennisbank. Tabs zijn toegankelijk (ARIA, pijltjestoetsen). Zonder JavaScript staan alle demo's onder elkaar. Duidelijk vermeld: voorbeelddata, geen koppeling met een echt systeem. |
| Cases `[veryo_cases]` | `inc/cases.php` | Nieuw menu "Cases" in wp-admin, met velden voor branche, probleem, aanpak, implementatie, resultaat, tijdwinst, quote en foto. Een case verschijnt alleen als hij gepubliceerd is én het vinkje "toestemming van de klant" aan staat. |
| Routekaarten, branchekaarten, toepassingen-grid | `pages-main.php`, `main.css` | Bestaande blokstijlen, aangevuld met kaarten met hover- en focusstatus. |
| Kennisbank: zoeken en categorieën | `inc/kennis.php`, `archive-kennis.php` | Taxonomie `kennis_categorie`, zoeken binnen de kennisbank, filterlinks met `aria-current`. |
| CTA's | `veryo_sec_cta_scan()` (nu met eigen knoptekst), afsluitende CTA | De scan als primaire conversie, de kennismaking als secundaire. |

Verwijderd omdat ze niet meer gebruikt worden:
- `veryo_sec_price_table`, `veryo_sec_contrast`, `veryo_sec_conviction`, `veryo_sec_pillars`, `veryo_sec_steps_home`, `veryo_sec_cases` en `veryo_hero_services`;
- het JavaScript voor de draaiende hero-kaartjes.

De bijbehorende CSS blijft staan, omdat pagina's die je in WordPress zelf hebt aangepast die blokken nog kunnen bevatten.

## 3. SEO-verbeteringen

- **Homepage:**
  - title "AI voor het mkb in Friesland: minder handwerk | Veryo";
  - een description met Friesland en Noord-Nederland;
  - H1 "Minder handwerk. Meer tijd voor je bedrijf.";
  - 10 FAQ's met FAQPage-schema, automatisch uit de blokken.
- **Diensten en Over Veryo:** nieuwe title, description en H1.
- **Kenniscategorieën:** title, description, canonical en breadcrumbs.
- **Redirect:** `/kennisbank` doet een 301 naar `/kennis/`.
- **Interne links:**
  - de homepage linkt naar 10 toepassingspagina's, 6 branches, de 3 routes, de regio's en de SEO-pagina's uit de sprint;
  - de contextlink op de homepage staat nu na "Waarom Veryo".
- **Lokaal:** het regioblok staat op de homepage, het werkgebied in de footer (sinds 2.5.0) en de positionering in llms.txt.
- **Niet gemaakt:**
  - geen nieuwe lokale pagina's: Friesland en Leeuwarden bestaan al, en een losse pagina "Noord-Nederland" zou grotendeels dubbel zijn met de drie provinciepagina's;
  - geen nieuwe automatiseringspagina's: de 10 toepassingen hebben al een pagina, zie "Nog niet afgerond".
- **Performance (lokaal gemeten):**

  | Scherm | CLS | LCP | Gewicht |
  |---|---|---|---|
  | mobiel | 0 | 0,14 s | 517 KB |
  | desktop | 0 | 0,18 s | 517 KB |

  De grote hero-foto is niet meer nodig. Lokaal is het niet representatief voor de echte hosting; meet na livegang met PageSpeed Insights.

## 4. Formulieren en integraties die werken

- **AI-scan (`/waar-begin-ik-met-ai/`):** ongewijzigd en getest (31 tests groen). Antwoorden, het rapport (AI via de server, zonder persoonsgegevens), de mail, het opslaan van de lead, de rate limit en de privacy-export werken. Alle CTA's "Ontdek waar AI tijd bespaart", "Vraag je gratis AI-scan aan" en "Gratis AI-scan" in de header gaan hierheen.
- **Contactformulier:** ongewijzigd.
- **Kennismaking:** "Plan een vrijblijvende kennismaking" gebruikt de afspraaklink uit Instellingen → Veryo (Calendly), en anders /contact/.
- **Formulier uit de brief:** dat met 8 velden heb ik niet gebouwd. De bestaande scan vraagt al naar team, branche en tijdvreters, maakt een rapport en werkt. Een tweede scanformulier zou dubbel zijn.

## 5. Nog nodig: externe configuratie

- Calendly-link controleren in Instellingen → Veryo, anders gaat de kennismaking naar /contact/.
- Echte cases toevoegen via wp-admin → Cases, met schriftelijke toestemming van de klant.
- De vier kennisartikelen publiceren (één per week) en in wp-admin hun categorie controleren.
- In Rank Math controleren dat de kenniscategorieën in de sitemap staan.
- Na de update: de homepage, /diensten/ en /over-veryo/ krijgen de nieuwe inhoud, ook als je ze zelf had aangepast. De vorige versie staat als revisie bij de pagina (Pagina bewerken → Revisies). Andere zelf aangepaste pagina's werk je bij via Extra → Veryo-inhoud.

## 6. Nog niet afgerond (bewust of wacht op jou)

- **AI-training:** geen pagina en niet in het menu (besluit 19 november).
- **Bedragen:** niet op de site (besluit 26 november).
- **Nieuwe automatiseringspagina's:**
  - Er zijn geen nieuwe pagina's voor AI-telefonist en AI-documentverwerking. Die linken nu naar /ai-op-maat/ en naar facturen automatiseren.
  - Veryo Receptie is alleen voor zorgpraktijken, dus een algemene telefonistpagina vraagt eerst een keuze van jou: bieden we die breed aan?
  - De andere 8 toepassingen hebben al een eigen pagina.
- **Branchepagina's:** geen nieuwe op `/ai-voor-…`. Ze bestaan al op `/branches/…`; nieuwe URL's zouden dubbele content geven.
- **Lokale pagina "Noord-Nederland":** niet gemaakt; zie SEO.
- **Kennisbankcategorie "AI-training":** niet aangemaakt, in lijn met het besluit van 19 november.
- **Open vragen uit de SEO-sprint:** staan nog in `SEO_SPRINT_DIFF.md` (recruitment, Claude–Exact, inrichtingsduur, MKB Cyber Campus, Drenthe).

## 7. Testresultaten

| Test | Resultaat |
|---|---|
| PHPCS (WordPress-standaard) | 0 fouten |
| test-content | 392 goed, 4 fout (bestaande, zelf ingevulde descriptions van 133–139 tekens) |
| test-scan | 31 goed, 0 fout |
| Crawl: links, robots, llms.txt, schema | 0 problemen, 0 dode links; FAQ-schema = pagina (241 vragen) |
| Headcheck (title, description, canonical, OG) | Geen problemen op themapagina's. De 2 meldingen komen van mijn eigen testberichten. |
| html-validate | Geen nieuwe fouten (alleen de bestaande `<style>`-meldingen van WordPress) |
| Editor-blokken (home, diensten, over) | Alle geldig, geen JS-fouten |
| Upgrade 2.5.0 → 2.6.0 | Nieuw menu; een eigen menu-item ("Eigen link") blijft staan; categorieën toegewezen |
| Console (home, diensten, kennis, over, scan, Collega) | Geen fouten |
| Toetsenbord | Demo-tabs werken met de pijltjestoetsen, met de focus op het juiste tabblad |
| Zonder JavaScript | Alle 5 demo's leesbaar; afspeelknop verborgen |
| prefers-reduced-motion | Geen animatie in de hero of de demo's |
| Responsive 390 / 820 / 1440 | Geen horizontale scroll; mobiel menu getest |

## 8. Belangrijkste vervolgstappen

1. De PR's in volgorde nakijken en samenvoegen: 2.4.0 → 2.5.0 → 2.6.0. Daarna de zip uploaden (back-up eerst).
2. Na de update de homepage bekijken. De vorige versie staat als revisie, voor het geval je iets wilt terughalen.
3. Eerste echte case toevoegen zodra er een klant is die toestemming geeft.
4. Kennisartikelen gespreid publiceren en daarna nieuwe schrijven per categorie.
5. Beslissen over een brede AI-telefonistpagina (zie punt 6).
6. Na 2 en 4 weken in Search Console de posities en de conversie op de AI-scan vergelijken.
