# SEO-changelog: thema 2.0.0 (SEO-proof)

Bijbehorende documenten: [SEO_AUDIT.md](SEO_AUDIT.md) (bevindingen vooraf), [REDIRECTS.md](REDIRECTS.md), [CONTENTPLAN.md](CONTENTPLAN.md), [INVULLEN.md](INVULLEN.md), [OFF_PAGE_TODO.md](OFF_PAGE_TODO.md).

Design, animaties en scrolleffecten zijn ongewijzigd.

## Wat er bij de update gebeurt

Bij het eerste bezoek aan wp-admin na het uploaden van de zip draait één keer een upgrade-routine:

1. De nieuwe pagina's worden aangemaakt (`/ai-workshop/`, `/ai-training/chatgpt-training-verkopers/`) en de menu's opnieuw opgebouwd.
2. `/ai-op-maat/interne-assistent/` en `/ai-automatisering/kennis-en-documenten/` gaan naar **concept**; de oude URL's sturen met een 301 door naar `/veryo-collega/`.
3. Pagina's die je niet zelf hebt aangepast, krijgen de nieuwe tekst. WordPress bewaart de oude versie als revisie. Zelf aangepaste pagina's blijven staan.
4. De SEO-titel, beschrijving en het focuszoekwoord gaan ook naar **Rank Math**, maar alleen in velden die leeg zijn of nog de vorige waarde van het thema hebben. Wat je zelf in Rank Math hebt ingevuld, blijft staan.
5. Ongewijzigde blogconcepten krijgen de uitgeschreven tekst; de blogcategorieën worden aangemaakt en toegewezen.

## Techniek

- **Rank Math en het thema werken samen.** Rank Math geeft title, description, canonical, robots, Open Graph en de sitemap uit. Het thema geeft één JSON-LD-`@graph` per pagina uit en zet het schema van Rank Math (en Yoast) uit, zodat er geen dubbele entiteiten zijn. Zonder SEO-plugin doet het thema alles zelf.
- **Schema:** Organization + ProfessionalService, WebSite, WebPage, BreadcrumbList en Person (Csaba, met `@id` waar Organization en blogartikelen naar verwijzen) op elke pagina. Service met `provider`, `areaServed` en `serviceType`. **Course** met `hasCourseInstance` en `courseMode` op de trainingspagina's. Veryo Collega als Service zonder `aggregateRating`. FAQPage waar een FAQ staat. **BlogPosting** in plaats van Article. LocalBusiness op home en `/leeuwarden/`.
- **Head:** altijd `lang="nl-NL"`, `theme-color` #1D4B44, REST-, oEmbed- en shortlink-ballast weg.
- **Indexatie:** noindex, follow voor zoekresultaten, auteur-, tag- en datumarchieven, lege categorieën, bijlagen en `/ai-automatisering/marketing/` (ook via Rank Math). Bijlagepagina's 301 naar de bovenliggende pagina. Tags en formats uit de sitemap.
- **404:** zoekveld en links naar Collega, trainingen, automatisering, AI-scan en prijzen.
- **Performance:** GSAP, ScrollTrigger, SplitText en Lenis laden niet meer op 404, zoekresultaten en de juridische, bedankt- en rapportpagina's. Fonts (swap, zelf gehost), WebP met srcset en de LCP-afbeelding met `fetchpriority="high"` waren al in orde.
- **Meten:** `veryoTrack()` stuurt `generate_lead` (contactformulier, AI-scan, landingspagina's), `click_phone` en `click_email` naar GA4 (`gtag`) of GTM (`dataLayer`). Het meet-ID zelf moet nog gekoppeld worden, zie INVULLEN.md.
- **Header:** klikbaar telefoonnummer op mobiel en tablet (icoon, met nummer vanaf 640 px); in de footer stonden telefoon en e-mail al.
- **llms.txt:** nieuwe positionering, trainingenoverzicht, Instagram en (zodra ingevuld) LinkedIn.

## Structuur en zoekwoorden

- Kannibalisatie opgelost: één primair zoekwoord per pagina, geen dubbelingen meer (gecontroleerd met script).
- Samengevoegd naar `/veryo-collega/`: interne assistent en kennis-en-documenten.
- Geherpositioneerd: `/ai-implementatie-mkb/` → "AI implementeren: stappenplan", `/ai-partner/` → "AI-abonnement (vaste AI-partner)", `/prijzen/` → "kosten AI voor mkb".
- Nieuw: `/ai-workshop/` en `/ai-training/chatgpt-training-verkopers/`.
- Nieuw hoofdmenu: Veryo Collega · AI-trainingen · Automatisering · Advies en partner · Prijzen · Over Veryo · Contact.
- Branchepagina's: ballast weg (onderwerpen die Veryo niet doet), per branche een eigen blok "Hoe Veryo helpt" met links naar Collega, trainingen en automatisering.
- Oplossingen: per oplossing een unieke sectie "Wat je nodig hebt om te starten".
- Regio's: echte lokale secties voor Friesland, Groningen en Drenthe.

## Titles en descriptions

- Alle indexeerbare pagina's en berichten: title 50–60 tekens eindigend op " | Veryo" (home met merk vooraan), description 140–155 tekens met CTA. Gecontroleerd met script; geen dubbele titles of descriptions.
- CTR-verbeteringen: home ("Veryo | AI-partner en lokale AI-assistent voor het mkb"), Collega ("lokale AI-assistent voor bedrijven"), `/over-veryo/`, `/academy/` (eerlijk: wachtlijst), AI-receptionist → "AI-telefoonassistent voor restaurants".

## Inhoud

- Veryo Collega premium gepositioneerd: "De lokale AI-assistent voor bedrijven", aanspreekvorm jullie en collega's.
- `/over-veryo/`: secties "Ervaring en achtergrond" (met `[INVULLEN]`) en "Hoe Veryo omgaat met data en veiligheid" voor E-E-A-T.

## Blog

- Categorieën: AI in de praktijk, Lokale AI en kennis, AI-regels en veiligheid, Kosten en subsidie, Beveiligingsbranche, met een filter boven het overzicht.
- Bij elk artikel: publicatie- en bijwerkdatum, leestijd, inhoudsopgave (vanaf 3 kopjes), auteursblok, CTA naar Collega en trainingen, drie gerelateerde artikelen en het vraagformulier. Paginering werkt.
- Drie volledige gidsen (1.200–1.400 woorden, met bronnen en `[CHECK]`): AI-geletterdheid en de AI Act, ChatGPT voor verkopers, een AI-kennisbank opzetten. Ze staan als **concept**.

## Controle (uitgevoerd op een testsite met WordPress 6.8.3)

| Controle | Resultaat |
|---|---|
| `php -l` en PHPCS (WordPress-standaard) | 0 fouten |
| Inhoudstest (63 pagina's, 25 concepten, menu's) | 432 ok, 0 fout |
| AI-scan-test | 31 ok, 0 fout |
| Head-check 87 URL's (1 title, description, canonical, 1 H1, OG, Twitter, lang, theme-color, 1 geldig JSON-LD) | 0 problemen, geen dubbele titles of descriptions |
| Interne links (crawl) en FAQ-schema tegen zichtbare FAQ | 0 problemen, 244 FAQ's gelijk |
| Redirects | beide 301 naar /veryo-collega/ |
| Sitemap | geen noindex-pagina's, auteurs, tags of bijlagen |
| Met Rank Math actief (gesimuleerd) | thema geeft geen description/OG uit, wel één JSON-LD; Rank Math-velden gevuld |
| Blokken in de editor | 0 ongeldige blokken |
| Zonder JavaScript | alle tekst zichtbaar; met JS geen fouten |
| Mobiel 375 px | geen horizontale scroll |
| Upgrade 1.9.0 → 2.0.0 | nieuwe pagina's, menu, concepten, Rank Math-velden (eigen waarde blijft staan) |

## Checklist voor jou na het uploaden

1. [ ] Zip uploaden via Weergave > Thema's > Nieuw thema > Uploaden en "Vervangen" kiezen. Daarna één keer naar het dashboard gaan (dan draait de upgrade).
2. [ ] Controleren: `/veryo-collega/`, het nieuwe menu en `/ai-workshop/`.
3. [ ] `curl -I` of browser: de twee oude URL's sturen door naar `/veryo-collega/`.
4. [ ] **Rank Math > Algemene instellingen > Links:** "Redirect attachments" mag aan of uit (het thema doet het al). **Sitemap:** bijlagen, tags en auteurs uit. **Schema:** het thema zet het schema van Rank Math uit; geen extra schema per pagina toevoegen.
5. [ ] Rank Math > Titels & Meta > Categorieën: noindex uitlaten (lege categorieën zet het thema zelf op noindex).
6. [ ] PageSpeed Insights voor home, `/veryo-collega/` en een blogartikel (mobiel).
7. [ ] Rich Results Test (search.google.com/test/rich-results) voor home, `/veryo-collega/`, `/ai-training/ai-geletterdheid/` (Course + FAQ) en een blogartikel.
8. [ ] Search Console: sitemap `https://veryo.nl/sitemap_index.xml` (Rank Math) indienen; URL-inspectie voor home, `/veryo-collega/`, `/ai-workshop/` en `/ai-training/chatgpt-training-verkopers/`.
9. [ ] De drie gidsen controleren (alle `[CHECK]`), notitie weghalen en publiceren.
10. [ ] `[INVULLEN]` op `/over-veryo/` invullen of weghalen; LinkedIn-URL invullen bij Instellingen > Veryo.
11. [ ] GA4 of GTM koppelen en in GA4 `generate_lead` als belangrijke gebeurtenis markeren.
12. [ ] Na 2–4 weken: in Search Console kijken of de nieuwe titels meer klikken opleveren.
