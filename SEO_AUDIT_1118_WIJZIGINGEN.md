# SEO-audit 18 november 2026: wijzigingen ter controle

Thema **2.3.0**, branch `claude/veryo-wordpress-theme-016jd1` (niet op main, niet live). Geen URL's gewijzigd en geen pagina's verwijderd: alle 89 paden van pagina's en berichten zijn gecontroleerd tegen de vorige versie.

Bij het uploaden draait één keer een update (bij het eerste bezoek aan wp-admin). Wat die update in de database doet, staat per onderdeel hieronder.

## 1. Titles en meta descriptions

**Waar het stond:** in de thema-definities (`inc/content/*.php`), en via de koppeling ook in de post meta `rank_math_title` / `rank_math_description`.

**Wat er verandert:**
- In het thema staan de 15 nieuwe titles en descriptions exact zoals aangeleverd. Eén aanpassing: "Cv's" is "Cv’s" geworden (typografische apostrof, zoals elders op de site).
- De update schrijft ze voor deze 15 pagina's direct in `rank_math_title` en `rank_math_description`, **ook als daar een eigen waarde stond** (zo gevraagd).
- `rank_math_facebook_*` en `rank_math_twitter_*` worden alleen bijgewerkt als die apart waren ingevuld.

**Gecontroleerd:** alle 15 pagina's geven 200, met de nieuwe `<title>` en meta description in de HTML.

**Graag even naar kijken:**
- **/ai-implementatie-mkb/:** de description noemt "5 stappen" (inventarisatie, toolkeuze, pilot, training, uitrol). De pagina beschrijft er 7 (met prioritering en evaluatie). Kiezen: de description aanpassen, of de pagina terugbrengen naar 5 stappen.
- **/ai-training/:** de description zegt "van basis tot geavanceerd". Op de pagina staat geen aparte training voor gevorderden; wel workshop, geletterdheid, verkopers en strategie.
- **/oplossingen/werkbonnen-verwerken/:** de description verwijst naar de "gratis werkbon-check" (zie onderdeel 5).
- **Lengte:** zeven descriptions zijn 133–139 tekens (de eerdere richtlijn was 140–155). Dat is geen probleem voor Google; ze staan er zoals aangeleverd.

## 2. Kleine technische fixes

| Fix | Waar het stond | Wat er verandert |
|---|---|---|
| og:site_name "Veryo - Ai automatisatie" | Rank Math gebruikt de sitenaam uit Instellingen → Algemeen. Het thema zelf gaf al "Veryo" | De update zet de sitenaam op "Veryo", alleen als die precies "Veryo - Ai automatisatie" was. Dat geldt ook voor de websitenaam in Rank Math. Daarnaast zet een filter `rank_math/opengraph/facebook/og_site_name` altijd "Veryo" |
| Alt-tekst hero (`veryo-hero.webp`) | Een foto van het thema. De template zette alt bewust leeg (decoratieve achtergrond) | De template gebruikt nu "AI-adviseur voor het mkb in Leeuwarden", en de update zet die tekst ook in de mediabibliotheek |
| robots.txt | De themafunctie `veryo_robots_txt` | Met Rank Math actief: `Sitemap: https://veryo.nl/sitemap_index.xml`. De WordPress-core-sitemap staat dan uit (`wp_sitemaps_enabled` → false; `/wp-sitemap.xml` geeft 404) |
| /academy/ | Paginadefinitie | `noindex, follow`, ook in `rank_math_robots`. Blijft bereikbaar via het menu |

## 3. Structured data

Organization en LocalBusiness krijgen nu exact dezelfde gegevens, uit één functie (`veryo_schema_business_fields`): naam, url, logo, adres, telefoon, e-mail, areaServed en sameAs.

Nieuw:
- `postalCode`
- `geo`
- `openingHoursSpecification`
- `priceRange` ("€€")
- `hasMap`
- `sameAs` met LinkedIn en het Google Bedrijfsprofiel

Lege velden blijven weg uit de JSON-LD; er komt geen "TODO" in de live code.

**Zelf invullen** bij Instellingen → Veryo → Bedrijfsgegevens:
- postcode
- breedte- en lengtegraad
- openingstijden (bijvoorbeeld `ma-vr 09:00-17:00`)
- Google Maps-link
- Google Bedrijfsprofiel-URL
- LinkedIn-URL

## 4. AI-geletterdheid

Je zin staat letterlijk op /ai-training/ai-geletterdheid/, op /ai-training/, in de FAQ op de homepage en op /ai-startpakket/.

Andere formuleringen met "zorgen voor voldoende" zijn op dezelfde manier aangepast ("maatregelen die de AI-geletterdheid ondersteunen"):
- de FAQ op /ai-training/
- /ai-workshop/
- het blok "wat de training wel garandeert"
- de FAQ "Is een AI-beleid verplicht?" op /veilig-ai-gebruik/

De update vervangt de oude zinnen exact in alle pagina's en berichten, dus ook op pagina's die je zelf hebt aangepast. De rest van je tekst blijft staan.

Het concept-artikel over AI-geletterdheid beschreef de Digital Omnibus nog als voorstel. Dat is bijgewerkt naar de geldende situatie (Verordening (EU) 2026/1744, van kracht sinds 27 juli 2026, met [CHECK] voor de letterlijke tekst op EUR-Lex).

## 5. Interne links

Per pagina één alinea in de lopende tekst, met beschrijvende ankerteksten. Ze staan direct na het eerste blok, op de homepage na het blok "onafhankelijk". Op zelf aangepaste pagina's voegt het thema ze toe bij het tonen.

| Pagina | Links naar |
|---|---|
| / , /leeuwarden/, /contact/ | /over-veryo/ |
| /ai-training/ | /ai-training/zzp/, /ai-training/ai-strategie/ |
| /academy/ | /ai-training/zzp/ |
| /ai-startpakket/, /ai-implementatie-mkb/ | /ai-training/ai-strategie/ |
| /oplossingen/werkbonnen-verwerken/ | /werkbon-check/, /ai-automatisering/administratie/ |
| /ai-automatisering/werkprocessen/, /branches/installatie/ | /werkbon-check/ |
| /ai-automatisering/administratie/ (hub) | /oplossingen/inkoopfacturen-automatiseren/, /oplossingen/werkbonnen-verwerken/ |
| /oplossingen/inkoopfacturen-automatiseren/ | /ai-automatisering/administratie/ |
| /ai-automatisering/offertes-en-calculaties/ ↔ /oplossingen/ai-calculatie-offerte-factuur/ | ankers "AI-calculatie" en "offertes automatiseren" |
| /ai-automatisering/hr-en-werving/ | /branches/recruitment/, /oplossingen/ai-recruitment-assistent/ |
| /branches/horeca-retail/ | /ai-op-maat/ai-receptionist-horeca/ |

De links staan in `veryo_context_links()` in `inc/tools-registry.php`.

**Let op:** /werkbon-check/ hoort niet bij het thema. Ik ga ervan uit dat die pagina live bestaat. Klopt dat niet, dan geven deze drie links een 404.

## 6. Kennisbank /kennis/

- **Berichttype:** een eigen berichttype `kennis` (menu "Kennisbank" in wp-admin), met archief `/kennis/` en artikelen op `/kennis/artikelnaam/`. Ik heb bewust geen `/kennis/%postname%/` voor gewone berichten gebruikt: dat zou de URL's van alle bestaande blogberichten veranderen.
- **Artikel:**
  - auteur met link naar /over-veryo/
  - publicatie- en bijwerkdatum, leestijd
  - inhoudsopgave (vanaf 3 kopjes)
  - auteursblok
  - "Hier helpen we bij", met een metabox om de gerelateerde dienstpagina's te kiezen
  - meer uit de kennisbank
  - CTA naar de gratis AI-scan
- **Schema:** Article (author → `#founder`), BreadcrumbList (Home › Kennis › artikel) en FAQPage als het artikel een FAQ-blok heeft.
- **Archief:** staat op `noindex, follow` zolang er geen artikelen zijn; daarna automatisch indexeerbaar.
- **Menu:** "Kennis" komt in de footer onder "Veryo". De update voegt alleen dat ene item toe; je eigen menu-aanpassingen blijven staan. Het hoofdmenu heeft al 7 items.
- **Sitemap:** in de WordPress-sitemap staat `posts-kennis`. **In Rank Math controleren:** Sitemap → Berichttypen → "Kennis" aan.
- **Artikelen:** nog geen geschreven, zoals gevraagd.

## Controles (testsite)

| Controle | Resultaat |
|---|---|
| PHPCS en `php -l` | 0 fouten |
| Inhoudstest | 430 ok. De 7 "fouten" zijn de korte descriptions uit onderdeel 1 |
| Head-check (1 title, description, canonical, 1 H1, OG, geldige JSON-LD) | 0 problemen |
| Interne links (crawl) en FAQ-schema | 0 problemen |
| HTML-validatie en blokken in de editor | 0 fouten |
| Upgrade 2.2.0 → 2.3.0 met zelf aangepaste pagina, eigen Rank Math-titel en eigen footerlink | AI Act-zin vervangen met behoud van eigen tekst, Rank Math- en OG-titel overschreven, sitenaam "Veryo", hero-alt gezet, "Kennis" één keer in de footer en eigen link behouden |

## 7. In de media: artikel OF.nl (6 november 2026)

- Een blok **"Veryo in het nieuws"** op /over-veryo/ (na "Wie er achter Veryo zit") en op /veryo-collega/ (na "Lokale AI: waarom je bedrijfsdata binnen blijft"). Op zelf aangepaste pagina's voegt het thema het bij het tonen toe.
- **Inhoud:** het medium en de datum, de kop met een link naar het artikel, een korte samenvatting in eigen woorden, het citaat van Csaba en "Lees het artikel op OF.nl". De volledige tekst van OF.nl is bewust niet overgenomen: die is van OF.nl, en een kopie geeft dubbele content.
- **Schema:** de organisatie krijgt `subjectOf` met een NewsArticle (kop, url, datum en OF.nl als uitgever).
- **Nieuwe vermelding toevoegen:** zet één regel in `veryo_press_items()` in `inc/press.php`.
