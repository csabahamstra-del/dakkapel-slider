# SEO-audit veryo.nl (thema 1.9.0)

Datum: 9 november 2026. Gemeten op een lokale kopie van het thema met alle pagina's zoals het thema ze aanmaakt. Op de live site kunnen pagina's afwijken als ze in WordPress zijn aangepast. Search Console-cijfers komen uit de opdracht (nov 2026).

## 1. Structuur

**Type thema.** Klassiek PHP-thema (geen blokthema), zonder ACF en zonder verplichte plugins.

| Onderdeel | Waar |
|---|---|
| Templates | `front-page.php`, `page.php`, `single.php`, `index.php`, `archive.php`, `search.php`, `404.php` |
| Kop en voet | `header.php`, `footer.php`, plus `header-landing.php` en `footer-landing.php` voor landingspagina's |
| Paginasjabloon | `templates/landing.php` (zonder menu), gebruikt door /founding-partner/, /lead-opvolging/ en /klantrapportage-beveiliging/ |
| Template-parts | `breadcrumbs`, `card`, `collega-blok`, `company-details`, `page-header` |
| Custom post type | `veryo_lead` (leads uit formulieren, alleen admin, niet publiek) |

**Hoe de inhoud is opgebouwd.**
- Alle pagina-inhoud zijn **Gutenberg-blokken**, gegenereerd in PHP (`inc/content/pages-*.php`, `products.php`, `collega.php`) en bij activatie of "Pagina's bijwerken" in de database gezet.
- Wie een pagina in WordPress aanpast, houdt zijn tekst: het thema overschrijft alleen pagina's die niemand heeft aangepast.
- Dynamische delen (Collega-prijzen, formulieren, teller) zijn shortcodes en worden bij het tonen gerenderd.

**SEO-plugin.**
- Het thema heeft een eigen lichte SEO-laag (`inc/seo.php`): title, description, canonical, robots, OG/Twitter, JSON-LD `@graph`, breadcrumbs, sitemap-filters, robots.txt en /llms.txt.
- Per pagina is dat instelbaar in de box **Veryo SEO**.
- Is **Yoast of Rank Math actief**, dan zet het thema zijn eigen head-uitvoer uit (geen dubbele tags) en schrijft het noindex en canonical in de velden van die plugin.
- Of er op de live site een SEO-plugin draait, weet ik niet: (later bevestigd: Rank Math draait live). Dat bepaalt welke sitemap Google ziet.

**Overig.**
- Analytics: het thema laadt zelf niets. De Google-tag komt via Site Kit; het thema stuurt alleen een Ads-conversie bij de AI-scan en het contact- en demoformulier.
- Cookiemelding: geen. Het thema zet geen cookies.

## 2. Paginalijst

63 gepubliceerde pagina's, waarvan 56 indexeerbaar en in de sitemap. Blogberichten zijn nog allemaal concept, dus er is geen berichten-sitemap.

"Links in / uit" telt alleen links in de inhoud (`<main>`), zonder menu en footer. Elke pagina heeft één canonical, gelijk aan de eigen URL, behalve de twee landingspagina's (canonical naar /oplossingen/).

| URL | Title (tekens) | Description | H1 | H2 | Woorden | Links in / uit | Index | Sitemap |
|---|---|---|---|---|---|---|---|---|
| `/` | AI-bureau voor het MKB in Noord-Nederland &#124; Veryo (49) | 149 | AI die echt werkt voor het MKB in Noord-Nederland. | 17 | 2220 | 59 / 33 | index | ja |
| `/academy/` | Online AI-cursus voor beginners &#124; Veryo Academy (47) | 153 | Veryo Academy: online AI-cursus | 5 | 450 | 3 / 5 | index | ja |
| `/ai-adviseur-drenthe/` | AI-adviseur in Drenthe voor het MKB &#124; Veryo (43) | 145 | AI-adviseur in Drenthe voor het MKB | 13 | 1079 | 9 / 8 | index | ja |
| `/ai-adviseur-friesland/` | AI-adviseur in Friesland voor het MKB &#124; Veryo (45) | 147 | AI-adviseur in Friesland voor het MKB | 12 | 1105 | 9 / 9 | index | ja |
| `/ai-adviseur-groningen/` | AI-adviseur in Groningen voor het MKB &#124; Veryo (45) | 146 | AI-adviseur in Groningen voor het MKB | 12 | 1080 | 10 / 9 | index | ja |
| `/ai-agents/` | AI-agents voor bedrijven: digitale collega’s &#124; Veryo (52) | 152 | Digitale collega’s: AI-agents voor je bedrijf | 12 | 1129 | 4 / 9 | index | ja |
| `/ai-automatisering/` | AI-automatisering voor het MKB &#124; Veryo (38) | 143 | AI-automatisering voor het MKB | 14 | 1333 | 16 / 23 | index | ja |
| `/ai-automatisering/administratie/` | Administratie en facturen automatiseren &#124; Veryo (47) | 152 | Administratie en facturen automatiseren | 12 | 1114 | 3 / 9 | index | ja |
| `/ai-automatisering/hr-en-werving/` | Werving en HR automatiseren met AI &#124; Veryo (42) | 150 | Werving en HR automatiseren met AI | 13 | 1119 | 2 / 9 | index | ja |
| `/ai-automatisering/kennis-en-documenten/` | Interne AI-assistent en documenten &#124; Veryo (42) | 149 | Interne AI-assistent en documenten | 13 | 1099 | 3 / 9 | index | ja |
| `/ai-automatisering/klantcontact/` | Klantcontact automatiseren met AI &#124; Veryo (41) | 151 | Klantcontact automatiseren met AI | 12 | 1149 | 4 / 10 | index | ja |
| `/ai-automatisering/marketing/` | AI-marketing voor het MKB: SEO, content en social &#124; Veryo (57) | 151 | AI-marketing voor het MKB | 12 | 1214 | 3 / 9 | index | ja |
| `/ai-automatisering/offertes-en-calculaties/` | Offertes en calculaties automatiseren met AI &#124; Veryo (52) | 154 | Offertes en calculaties automatiseren met AI | 12 | 1237 | 4 / 10 | index | ja |
| `/ai-automatisering/rapportages/` | Rapportages en dashboards automatiseren &#124; Veryo (47) | 151 | Rapportages en dashboards automatiseren | 13 | 1096 | 2 / 9 | index | ja |
| `/ai-automatisering/werkprocessen/` | Planning, werkbonnen en inkoop automatiseren &#124; Veryo (52) | 152 | Planning, werkbonnen en inkoop automatiseren | 12 | 1119 | 4 / 10 | index | ja |
| `/ai-implementatie-mkb/` | AI-implementatie voor het MKB: van plan tot live &#124; Veryo (56) | 149 | AI-implementatie voor het MKB | 12 | 1214 | 3 / 17 | index | ja |
| `/ai-op-maat/` | AI op maat: chatbots, agents en assistenten &#124; Veryo (51) | 151 | AI op maat | 11 | 1017 | 6 / 12 | index | ja |
| `/ai-op-maat/ai-receptionist-horeca/` | AI-receptionist voor restaurants en horeca &#124; Veryo (50) | 154 | AI-receptionist voor restaurants en horeca | 12 | 1004 | 2 / 9 | index | ja |
| `/ai-op-maat/chatbot/` | AI-chatbot laten maken voor je bedrijf &#124; Veryo (46) | 142 | AI-chatbot laten maken voor je bedrijf | 11 | 977 | 4 / 9 | index | ja |
| `/ai-op-maat/interne-assistent/` | AI-assistent op je eigen documenten &#124; Veryo (43) | 155 | AI-assistent op je eigen documenten | 12 | 976 | 4 / 9 | index | ja |
| `/ai-op-maat/whatsapp-assistent/` | WhatsApp-assistent voor je bedrijf &#124; Veryo (42) | 154 | WhatsApp-assistent voor je bedrijf | 12 | 1018 | 7 / 9 | index | ja |
| `/ai-partner/` | AI-partner voor het MKB: maandelijks abonnement &#124; Veryo (55) | 152 | AI-partner: vaste vraagbaak voor AI | 11 | 1046 | 6 / 8 | index | ja |
| `/ai-startpakket/` | AI-Startpakket: advies, training en beleid &#124; Veryo (50) | 143 | Het Veryo AI-Startpakket | 11 | 1200 | 11 / 10 | index | ja |
| `/ai-training/` | AI-training en workshops voor bedrijven &#124; Veryo (47) | 155 | AI-training voor bedrijven | 11 | 1048 | 15 / 11 | index | ja |
| `/ai-training/ai-geletterdheid/` | AI-geletterdheid training (AI Act) &#124; Veryo (42) | 149 | AI-geletterdheid: training voor je team | 11 | 1009 | 4 / 9 | index | ja |
| `/ai-training/ai-strategie/` | AI-strategie training voor directie en MT &#124; Veryo (49) | 148 | AI-strategie: training voor directie en MT | 11 | 1025 | 1 / 8 | index | ja |
| `/ai-training/zzp/` | AI-training voor zzp’ers: praktisch en betaalbaar &#124; Veryo (57) | 148 | AI-training voor zzp’ers | 13 | 985 | 1 / 8 | index | ja |
| `/ai-werkplek/` | Microsoft Copilot en Gemini inrichten voor het MKB &#124; Veryo (58) | 149 | De AI-werkplek: Copilot en Gemini goed ingericht | 11 | 1103 | 4 / 10 | index | ja |
| `/algemene-voorwaarden/` | Algemene voorwaarden &#124; Veryo (28) | 149 | Algemene voorwaarden | 10 | 506 | 0 / 1 | noindex | nee |
| `/bedankt/` | Bedankt &#124; Veryo (15) | 151 | Bedankt | 1 | 60 | 0 / 4 | noindex | nee |
| `/blog/` | Blog over AI in het MKB &#124; Veryo (31) | 145 | Blog | 1 | 44 | 0 / 2 | index | ja |
| `/branches/` | AI per branche: toepassingen voor jouw sector &#124; Veryo (53) | 150 | AI per branche | 5 | 477 | 10 / 13 | index | ja |
| `/branches/agri/` | AI voor agrarische bedrijven en mechanisatie &#124; Veryo (52) | 151 | AI voor agrarische bedrijven en mechanisatie | 12 | 1112 | 7 / 13 | index | ja |
| `/branches/beveiliging/` | AI voor beveiligingsbedrijven: uren en rapportages &#124; Veryo (58) | 152 | AI voor beveiligingsbedrijven | 11 | 1157 | 7 / 11 | index | ja |
| `/branches/bouw/` | AI in de bouw: voor aannemers en bouwbedrijven &#124; Veryo (54) | 155 | AI in de bouw: voor aannemers en bouwbedrijven | 12 | 1207 | 8 / 14 | index | ja |
| `/branches/horeca-retail/` | AI voor horeca en retail &#124; Veryo (32) | 153 | AI voor horeca en retail | 13 | 1110 | 7 / 11 | index | ja |
| `/branches/installatie/` | AI voor installateurs en installatiebedrijven &#124; Veryo (53) | 152 | AI voor installateurs en installatiebedrijven | 12 | 1263 | 13 / 14 | index | ja |
| `/branches/makelaardij/` | AI voor makelaars: inbox, bezichtigingen, teksten &#124; Veryo (57) | 146 | AI voor makelaars | 13 | 1117 | 6 / 11 | index | ja |
| `/branches/recruitment/` | Werving via WhatsApp en AI &#124; Veryo (34) | 145 | Werving via WhatsApp en AI | 13 | 1082 | 6 / 11 | index | ja |
| `/branches/schoonmaak/` | AI en automatisering voor schoonmaakbedrijven &#124; Veryo (53) | 154 | AI en automatisering voor schoonmaakbedrijven | 10 | 872 | 3 / 10 | index | ja |
| `/branches/transport/` | AI voor transport en logistiek &#124; Veryo (38) | 147 | AI voor transport en logistiek | 13 | 1111 | 8 / 12 | index | ja |
| `/branches/zakelijke-dienstverlening/` | AI voor accountants en adviesbureaus &#124; Veryo (44) | 153 | AI voor accountants en adviesbureaus | 12 | 1062 | 8 / 12 | index | ja |
| `/contact/` | Contact &#124; Veryo (15) | 153 | Contact | 2 | 107 | 4 / 3 | index | ja |
| `/cookieverklaring/` | Cookieverklaring &#124; Veryo (24) | 146 | Cookieverklaring | 4 | 163 | 0 / 1 | noindex | nee |
| `/founding-partner/` | Founding partner AI 2026: bouw mee met Veryo &#124; Veryo (52) | 147 | Veryo zoekt 6 bedrijven om mee te bouwen. | 6 | 480 | 1 / 1 | noindex | nee |
| `/klantrapportage-beveiliging/` | Klantrapportage voor beveiligingsbedrijven &#124; Veryo (50) | 143 | Je maandrapportage maakt zichzelf. | 6 | 374 | 0 / 1 | noindex | nee |
| `/lead-opvolging/` | Elke aanvraag binnen 2 minuten opgevolgd &#124; Veryo (48) | 147 | Elke aanvraag binnen 2 minuten opgevolgd. Ook om 22:00. | 7 | 353 | 0 / 0 | noindex | nee |
| `/leeuwarden/` | AI-training en automatisering in Leeuwarden &#124; Veryo (51) | 154 | AI-training en automatisering in Leeuwarden | 12 | 1068 | 7 / 9 | index | ja |
| `/oplossingen/` | AI-oplossingen voor het MKB: vaste prijs per maand &#124; Veryo (58) | 145 | AI-oplossingen voor het MKB | 5 | 679 | 19 / 12 | index | ja |
| `/oplossingen/ai-calculatie-offerte-factuur/` | Offertes automatiseren: calculatie en factuur met AI &#124; Veryo (60) | 152 | AI voor calculatie, offerte en factuur | 10 | 702 | 12 / 14 | index | ja |
| `/oplossingen/ai-klantrapportage/` | Rapportage beveiliging automatiseren met AI &#124; Veryo (51) | 155 | AI Klantrapportage | 10 | 720 | 11 / 13 | index | ja |
| `/oplossingen/ai-lead-opvolging/` | AI lead-opvolging: elke lead binnen 2 minuten gebeld &#124; Veryo (60) | 144 | AI lead-opvolging | 10 | 890 | 13 / 15 | index | ja |
| `/oplossingen/ai-recruitment-assistent/` | AI recruitment-assistent: cv’s screenen en plannen &#124; Veryo (58) | 154 | AI recruitment-assistent | 10 | 711 | 13 / 14 | index | ja |
| `/oplossingen/inkoopfacturen-automatiseren/` | Inkoopfacturen automatiseren met AI &#124; Veryo (43) | 148 | Inkoopfacturen automatiseren | 10 | 659 | 16 / 17 | index | ja |
| `/oplossingen/urencontrole-beveiliging/` | Urencontrole beveiliging: zzp-facturen controleren &#124; Veryo (58) | 151 | Urencontrole voor beveiligingsbedrijven | 9 | 654 | 12 / 15 | index | ja |
| `/oplossingen/werkbonnen-verwerken/` | Werkbonnen automatisch verwerken met AI &#124; Veryo (47) | 143 | Werkbonnen verwerken | 10 | 661 | 14 / 16 | index | ja |
| `/over-veryo/` | Over Veryo, AI-partner uit Leeuwarden (37) | 151 | Over Veryo | 10 | 814 | 2 / 15 | index | ja |
| `/prijzen/` | Wat kost AI-automatisering? Prijzen en offerte &#124; Veryo (54) | 154 | Prijzen en offerte | 8 | 1027 | 48 / 8 | index | ja |
| `/privacyverklaring/` | Privacyverklaring &#124; Veryo (25) | 153 | Privacyverklaring | 10 | 800 | 56 / 1 | index | ja |
| `/rapport/` | Je AI-scan-rapport &#124; Veryo (26) | 143 | Rapport niet gevonden | 0 | 33 | 0 / 2 | noindex | nee |
| `/veilig-ai-gebruik/` | Veilig AI gebruiken in je bedrijf: beleid en check &#124; Veryo (58) | 148 | Veilig AI gebruiken in je bedrijf | 12 | 1035 | 6 / 10 | index | ja |
| `/veryo-collega/` | Veryo Collega: lokale AI voor bedrijven op kantoor &#124; Veryo (58) | 144 | Een AI-collega die alles weet van jouw bedrijf. | 14 | 2280 | 45 / 8 | index | ja |
| `/waar-begin-ik-met-ai/` | Waar begin je met AI? Doe de gratis AI-scan &#124; Veryo (51) | 154 | Wil je iets met AI, maar weet je niet wat? | 4 | 848 | 53 / 6 | index | ja |

## 3. Head-uitvoer (voorbeeld homepage)

**Aanwezig en goed.**
- `charset`, `viewport`, één `<title>`, meta description, canonical (absoluut), robots via de WordPress robots-API.
- OG: locale `nl_NL`, site_name, type, title, description, url, image 1200×630 met maten. Twitter: `summary_large_image`.
- JSON-LD in één `@graph`.
- Zelf gehoste fonts met preload en `font-display: swap`.
- Favicon en apple-touch-icon via het WordPress-site-icoon.
- Emoji-script, generator-tag, wlwmanifest en RSD zijn al verwijderd.
- AI-crawlers zijn welkom in robots.txt.

**Ontbreekt of kan beter.**
- `<html lang>` volgt de taalinstelling van WordPress. Op de testsite is dat `en-US`. Staat de live site niet op Nederlands, dan is dat fout. Het thema kan `nl-NL` afdwingen.
- Geen `theme-color`.
- De apple-touch-icon is 300×300; standaard is 180×180. Dat werkt wel.
- REST- en oEmbed-links (`wp-json`, `oembed`, shortlink) staan in de head: ballast.
- Geen hreflang. Dat is niet nodig, de site is alleen Nederlands.
- `twitter:title` en `twitter:description` ontbreken. Twitter valt terug op OG, dus dat is laag.

**Schema per paginatype (nu).**

| Paginatype | Schema |
|---|---|
| Alle pagina's | `Organization`+`ProfessionalService` (NAP, areaServed, sameAs Instagram, KvK), `WebSite`, `WebPage`, `BreadcrumbList` (behalve home) |
| Diensten, branches, regio's, oplossingen, Collega (45 pagina's) | `Service` en `FAQPage` |
| Homepage en /leeuwarden/ | Ook `LocalBusiness` |
| Blog | `Article` met auteur en datums |

Wat ontbreekt:
- `Course` op de trainingspagina's.
- `Person` voor de oprichter op /over-veryo/ (nu alleen `founder` binnen Organization).
- `serviceType` in Service.
- `openingHours` en LinkedIn (nog niet bekend).

## 4. Performance-risico's

**Goed.**
- Alle scripts staan op `defer`, er wordt geen jQuery geladen.
- Fonts: 2 variabele woff2-bestanden (64 en 34 KB), zelf gehost, met swap.
- Afbeeldingen zijn WebP, via `wp_get_attachment_image` (srcset, width en height).
- De hero-afbeelding is `eager` met `fetchpriority="high"`.
- De hero-H1 is meteen zichtbaar: hij schuift alleen omhoog, nooit opacity 0. `prefers-reduced-motion` wordt gerespecteerd.
- Alle inhoud staat in de server-HTML, zonder video's.

**Risico's.**
- GSAP, ScrollTrigger, SplitText en Lenis (samen ongeveer 145 KB) plus `motion.js` laden op **elke** pagina, ook op juridische pagina's en de blog.
- Twee preloads voor fonts samen 98 KB, op mobiel wat zwaar. Newsreader zou je alleen hoeven te preloaden als de H1 die gebruikt.
- Het portretje van de oprichter (150 px) laadt een tweede keer `eager` in het contactblok onder de vouw.
- WordPress core zet `<style>`-blokken in de body (layout-ondersteuning). Dat is onschuldig, maar levert html-validate-meldingen op.

## 5. Problemen per pagina, met prioriteit

### Hoog
1. **Kannibalisatie rond "AI automatisering / implementatie / partner / agents".**
   - /ai-automatisering/, /ai-implementatie-mkb/, /ai-partner/ en /ai-agents/ beschrijven alle vier "AI inzetten in het mkb, van advies tot koppeling".
   - /ai-implementatie-mkb/ heeft maar 3 interne links in.
   - De homepage-title ("AI-bureau voor het MKB…") en de /ai-partner/-H1 ("AI-partner: vaste vraagbaak") zitten op hetzelfde merk-/partner-woord.
2. **Drie pagina's voor dezelfde interne AI-assistent.**
   - /veryo-collega/ (product), /ai-op-maat/interne-assistent/ (rankt op pos. 5,8) en /ai-automatisering/kennis-en-documenten/ ("Interne AI-assistent en documenten").
   - Google weet niet welke pagina de "interne AI-assistent" is. Collega, het belangrijkste product, staat daardoor op 4 vertoningen.
3. **Veryo Collega onder-geoptimaliseerd.**
   - De H1 "Een AI-collega die alles weet van jouw bedrijf." bevat het primaire zoekwoord niet. De title noemt "lokale AI voor bedrijven", niet "lokale AI-assistent".
   - De pagina is lang (2.280 woorden) en goed gelinkt (45 in), dus de basis is er.
4. **Inhoud die niet bij Veryo past (irrelevante vertoningen).**
   - "digitaal opleveren bouw": opleverrapporten in /branches/bouw/, /ai-automatisering/werkprocessen/ en de catalogus.
   - "online marketing installatiebedrijven": /ai-automatisering/marketing/ en /branches/installatie/.
   - "isolatie", "makelaar renovatie": de verduurzamingsteksten op /branches/installatie/ en /branches/makelaardij/.
   - Deze pagina's gaan meer over de branche dan over Veryo's eigen diensten (Collega, training, automatisering).
5. **Te veel dunne of verspreide pagina's voor de huidige autoriteit.**
   - 56 indexeerbare pagina's bij 2.142 vertoningen per maand.
   - 8 automatiseringssubpagina's, 4 ai-op-maat-subpagina's en 10 branches: veel daarvan ranken nergens en verdelen interne linkkracht.
6. **CTR-probleem op goed rankende pagina's.**
   - /ai-op-maat/interne-assistent/ (pos. 5,8): de title is generiek ("AI-assistent op je eigen documenten | Veryo"), zonder voordeel of CTA.
   - /over-veryo/ (pos. 7): de title mist " | Veryo" en een belofte.
   - /academy/ (pos. 12): de title mist " | Veryo"; de cursus bestaat nog niet, er is alleen een wachtlijst.

### Middel
7. **Title-lengtes.** 27 van de 56 indexeerbare titles zijn korter dan 50 tekens; /over-veryo/ en /academy/ eindigen niet op " | Veryo". Duplicaten zijn er niet, bij titles en descriptions.
8. **Zoekwoord-overlap /prijzen/ en blog "Wat kost AI-automatisering".** Beide mikken nu op "wat kost ai automatisering".
9. **Oplossingenpagina's zijn net te kort** (650–720 woorden, doel 700–1.000). Ook /branches/schoonmaak/ (872), /contact/ (107), /branches/ (477) en /academy/ (450).
10. **Kansen op termen die al dichtbij staan zijn niet gericht uitgewerkt.**
    - "ai workshop bedrijven" en "ai workshop groningen": er is geen workshoppagina.
    - "chatgpt training verkopers": er is geen pagina.
    - "automatisering emmen/meppel": worden op de Drenthe-pagina alleen genoemd.
    - "agrarische automatisering": /branches/agri/ heeft het woord niet in de title.
    - "ai telefoon assistent restaurants": de pagina /ai-op-maat/ai-receptionist-horeca/ staat sinds 1.9.0 niet meer in het menu, maar rankt wel (pos. 42).
11. **Ontbrekend schema:** `Course` op trainingen, `Person` op /over-veryo/, `serviceType`.
12. **Archieven en bijlagen.**
    - Bijlagepagina's worden niet doorgestuurd.
    - Auteur-, tag- en categoriearchieven krijgen geen expliciete noindex (de auteurs-sitemap staat al uit).
    - Zodra de eerste blog live is, verschijnen er categoriearchieven.
13. **404-pagina** heeft links naar de diensten, maar geen zoekveld.
14. **/blog/** is een lege pagina (44 woorden) zolang er geen berichten zijn. Hij staat wel in de sitemap.
15. **Header:** geen klikbaar telefoonnummer of e-mailadres (dat staat alleen in de footer en de contactblokken). Er zijn ook geen GA4-events voor klikken op `tel:`/`mailto:` en voor formulierinzendingen. Alleen de Ads-conversie bestaat.

### Laag
16. /algemene-voorwaarden/ en /cookieverklaring/ staan op noindex door het vinkje "Juridisch concept". Mag indexeerbaar zodra de teksten juridisch gecontroleerd zijn.
17. /oplossingen/ heeft één kopsprong (H2 → H4 in de kaarten). Verder geen kopsprongen en overal precies één H1.
18. Animatiebibliotheken op pagina's zonder animatie, de dubbele eager-afbeelding, REST/oEmbed-links in de head, `theme-color`.
19. `robots.txt` blokkeert /rapport/ én die pagina heeft noindex. Google ziet de noindex dan niet, maar indexeert de inhoud ook niet. Mijn advies: blokkade laten staan, want rapporten zijn persoonlijk.
20. **"tervanoek ai-assistent" (pos. 5) en "digitale medewerker verassist" (pos. 10).**
    - In het thema staan die namen nergens: niet in tekst, alt-teksten, bestandsnamen of metadata.
    - Online vind ik ook geen bedrijf of product met die namen.
    - Waarschijnlijk ranken /ai-op-maat/interne-assistent/ ("AI-assistent") en /ai-agents/ ("Digitale collega's") op de generieke woorden in die zoekopdrachten.
    - Advies: geen vergelijkingspagina maken. Zonder feiten over die partijen kan dat niet eerlijk, en het volume is heel klein. Controleer in Search Console (Prestaties > Zoekopdracht > Pagina's) welke pagina het precies is.

## 6. Keyword-mapping (voorstel)

Uitgangspunt: één primair zoekwoord per indexeerbare pagina. Waar een actie een URL raakt (samenvoegen, 301, noindex), staat **(akkoord nodig)**.

### Kern

| Pagina | Primair | Secundair | Actie |
|---|---|---|---|
| `/` | AI partner mkb | AI advies, AI training, AI automatisering, Leeuwarden | Title met merk vooraan ("Veryo: AI-partner voor het mkb in Noord-Nederland"); H1 houden |
| `/veryo-collega/` | lokale AI-assistent voor bedrijven | AI-kennisbank bedrijf, AI zonder cloud, privacyvriendelijke AI, interne AI-assistent | H1 en title met het primaire zoekwoord; enige pagina die "interne AI-assistent" claimt |
| `/ai-op-maat/interne-assistent/` | — | — | **(akkoord nodig)** A: 301 naar /veryo-collega/ (signaal pos. 5,8 gaat mee). B: houden als "Chatbot op eigen documenten (cloud)", met nieuwe title en duidelijke link naar Collega. Advies: **A** |
| `/ai-automatisering/kennis-en-documenten/` | — | — | **(akkoord nodig)** 301 naar /veryo-collega/ |
| `/ai-training/` | AI training voor bedrijven | AI training teams, ChatGPT training medewerkers | Uitbreiden; `Course`-schema |
| `/ai-workshop/` (nieuw) | AI workshop voor bedrijven | AI workshop Groningen/Friesland/Drenthe, ChatGPT workshop | **(akkoord nodig)** nieuwe pagina |
| `/ai-training/chatgpt-training-verkopers/` (nieuw) | ChatGPT training verkopers | AI voor sales | **(akkoord nodig)** nieuwe pagina |
| `/ai-training/ai-geletterdheid/` | AI-geletterdheid training | AI Act verplichting, AI-geletterdheid medewerkers | Uitbreiden; `Course` |
| `/ai-training/zzp/` | AI training zzp | ChatGPT cursus zzp | Houden; `Course` (online) |
| `/ai-training/ai-strategie/` | AI strategie training directie | AI sessie MT | Houden (1 link in, dus extra links) |
| `/academy/` | online AI cursus | AI cursus beginners | CTR-fix: title en description eerlijk "wachtlijst" |
| `/ai-automatisering/` | AI automatisering mkb | AI automatisering op maat, voorbeelden | Hub van automatisering |
| `/ai-implementatie-mkb/` | AI implementeren stappenplan | AI implementatie mkb | **(akkoord nodig)** A: eigen invalshoek "stappenplan". B: 301 naar /ai-automatisering/. Advies: **A** |
| `/ai-partner/` | AI abonnement mkb | vaste AI-partner, AI support | **(akkoord nodig)** eigen invalshoek "abonnement/vaste partner" (advies), of 301 naar home |
| `/ai-agents/` | AI agents voor bedrijven | AI agent laten bouwen, AI agents zonder programmeren | Houden en scherper maken |
| `/ai-startpakket/` | AI startpakket | AI beleid en training | Houden |
| `/ai-werkplek/` | Copilot inrichten mkb | Gemini inrichten | Houden |
| `/veilig-ai-gebruik/` | veilig AI gebruiken bedrijf | AI beleid | Houden |
| `/prijzen/` | kosten AI voor mkb | prijs AI implementatie, AI training kosten | Primair van "wat kost ai automatisering" naar "kosten AI mkb" (de blog krijgt "wat kost ai automatisering") |
| `/over-veryo/` | over Veryo | oprichter, werkwijze | CTR-fix, `Person`-schema, E-E-A-T-tekst |
| `/waar-begin-ik-met-ai/` | waar begin je met AI | gratis AI-scan | Houden |
| `/oplossingen/` en 7 oplossingen | elk eigen zoekwoord (zoals 1.9.0) | | Uitbreiden tot ≥ 800 woorden |

### Regio

| Pagina | Primair | Secundair |
|---|---|---|
| `/ai-adviseur-friesland/` | AI adviseur Friesland | AI mkb Friesland (pos. 14), automatisering Friesland |
| `/ai-adviseur-groningen/` | AI adviseur Groningen | AI workshop Groningen (pos. 38) |
| `/ai-adviseur-drenthe/` | AI adviseur Drenthe | automatisering bedrijf Drenthe (pos. 25), automatisering Emmen (39), Meppel (52), Assen |
| `/leeuwarden/` | AI en automatisering Leeuwarden | mkb automatisering Leeuwarden |

### Branches
De branchepagina's blijven, maar worden herschreven rond Veryo's eigen diensten (Collega, trainingen, automatisering), zonder opleveren, marketing of verduurzaming.

| Pagina | Primair | Opmerking |
|---|---|---|
| `/branches/agri/` | agrarische automatisering (pos. 41) | Title aanpassen |
| `/branches/beveiliging/` | AI voor beveiligingsbedrijven | Houden |
| `/branches/schoonmaak/` | AI voor schoonmaakbedrijven | Uitbreiden |
| `/branches/bouw/`, `/installatie/`, `/makelaardij/`, `/transport/`, `/horeca-retail/`, `/zakelijke-dienstverlening/`, `/recruitment/` | elk "AI voor [branche]" | Herschrijven; geen opleveren, marketing of verduurzaming |
| `/ai-op-maat/ai-receptionist-horeca/` | AI telefoonassistent restaurant | Rankt (pos. 42): indexeerbaar houden en bijwerken |

### Twijfelgevallen (akkoord nodig)
- **`/ai-automatisering/marketing/`** levert vooral irrelevante vertoningen op. A: noindex, follow. B: 301 naar /ai-automatisering/. Advies: **A**.
- **De overige zes automatiseringssubpagina's** (administratie, hr-en-werving, klantcontact, offertes-en-calculaties, rapportages, werkprocessen) overlappen deels met de 7 oplossingen. Advies: laten staan, van werkprocessen alleen het opleveren schrappen. Samenvoegen kan later op basis van Search Console-data.
- **`/ai-op-maat/chatbot/` en `/ai-op-maat/whatsapp-assistent/`** laten staan.

### Interne structuur (voorstel)
- **Hoofdmenu:** Veryo Collega · AI-trainingen (training, workshop, geletterdheid, verkopers, zzp, strategie) · Automatisering (oplossingen, automatisering, agents, branches) · Advies en partner (startpakket, implementatie, partner, werkplek, veilig AI) · Prijzen · Over · Contact.
- **Nu:** Collega · Diensten · Oplossingen · Branches · Gratis offerte · Over · Contact. **(akkoord nodig: menu omgooien)**
- **Header:** telefoonnummer klikbaar op mobiel.
- Elke subpagina linkt naar de hub en 2–3 verwante pagina's, en elke dienstpagina naar Collega of de trainingen.
