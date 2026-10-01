# Veryo-thema: installeren en inrichten

Dit thema zet bij activatie de complete Veryo-site klaar: alle pagina's, menu's, de gratis AI-scan, leadbeheer en de SEO-basis. Werkt op WordPress 6.6 of nieuwer en PHP 8.1 of nieuwer, op gewone shared hosting (geen Node of Composer nodig).

## 1. Installeren en activeren

1. Ga in WordPress naar **Weergave > Thema's > Nieuw thema > Thema uploaden**.
2. Kies `veryo.zip` en klik op **Nu installeren**, daarna op **Activeren**.
3. Bij activeren gebeurt automatisch het volgende (veilig om vaker te draaien):
   - alle pagina's worden aangemaakt met de juiste URL, parent, inhoud en SEO-waarden. **Bestaande pagina's worden nooit overschreven**;
   - de homepage wordt de statische voorpagina en `/blog/` de berichtenpagina (alleen als er nog geen geldige keuze was);
   - het hoofdmenu en het footermenu worden aangemaakt en gekoppeld;
   - de permalinks worden op `/%postname%/` gezet, maar **alleen** als ze op "Standaard" stonden;
   - 17 blogconcepten worden aangemaakt (status: concept);
   - de tagline wordt "AI die echt werkt." en het site-icoon wordt het Veryo-beeldmerk.
   - de standaardinhoud van WordPress ("Hello world!" en "Sample Page") gaat naar de prullenbak, maar alleen als je die nog niet hebt aangepast.
4. Bovenaan wp-admin verschijnt een melding met een link naar de instellingen en een lijst met alle `[VUL IN]`-placeholders.

**Had je een eerdere versie van het thema al actief?** Upload de nieuwe zip (Weergave > Thema's > Thema uploaden > "Vervangen door geüpload"). De nieuwe vormgeving geldt dan meteen op alle pagina's. Wil je ook de nieuwe teksten en indeling van de pagina's zelf (bijvoorbeeld de nieuwe homepage), ga dan naar **Extra > Veryo-inhoud** en klik op **Pagina's bijwerken**:
   - alleen pagina's die je zelf niet hebt aangepast worden vervangen; pagina's die je wel hebt bewerkt, blijven staan en worden in de melding genoemd;
   - de vorige versie blijft bewaard als revisie (in de editor onder Revisies), zodat je altijd terug kunt;
   - vink "Ook het Veryo-hoofdmenu en de Veryo-footer opnieuw opbouwen" aan als je ook de nieuwe menu's wilt. Eigen menu-aanpassingen gaan dan verloren.

Pagina per ongeluk verwijderd? Ga naar **Extra > Veryo-inhoud** en klik op **Veryo-inhoud opnieuw aanmaken (ontbrekende pagina's)**. Alleen ontbrekende pagina's, menu's en concepten worden aangemaakt.

## 2. Permalinks controleren

Ga naar **Instellingen > Permalinks** en controleer dat **Berichtnaam** (`/%postname%/`) is gekozen. Klik één keer op **Wijzigingen opslaan**. Open daarna `/ai-automatisering/` en `/llms.txt` om te checken dat alles werkt.

Gebruikt je hosting nginx en geeft `/llms.txt` een 404? Dan serveert nginx `.txt`-bestanden rechtstreeks. Vraag je hostingpartij om `/llms.txt` door te sturen naar WordPress (`try_files $uri $uri/ /index.php?$args;`).

## 3. Logo

Het thema gebruikt het officiële Veryo-logo uit de huisstijl (`assets/logo/`): `veryo-logo.svg` in de header en `veryo-logo-wit.svg` (amber beeldmerk met witte tekst) in de footer. Het logo staat als inline SVG in de pagina, zodat het altijd scherp is en niet afhankelijk is van hoe je hosting `.svg`-bestanden aanbiedt. Wil je een ander logobestand in de header, upload dat dan onder **Weergave > Customizer > Site-identiteit > Logo**. Het site-icoon en de afbeelding in e-mails zijn gemaakt van het officiële beeldmerk.

## 3b. Instellingen invullen (Instellingen > Veryo)

**Bedrijfsgegevens.** Deze staan al ingevuld: Veryo (handelsnaam van Merklenz, eenmanszaak), Lange Marktstraat 1, Leeuwarden, 085 060 5752, info@veryo.nl, KvK 73435996, oprichter Csaba. Vul nog aan zodra ze er zijn: **LinkedIn** en **Instagram**. Postcode en btw-nummer worden bewust niet getoond. Deze gegevens verschijnen in de footer, op de contactpagina, in schema.org en in e-mails. Lege velden worden nergens getoond.

**AI-scan.**

- **API-sleutel van Anthropic.** Zet de sleutel bij voorkeur in `wp-config.php`, boven de regel `/* That's all, stop editing! */`:

  ```php
  define( 'VERYO_ANTHROPIC_API_KEY', 'sk-ant-...' );
  ```

  De constante heeft voorrang en het veld in de instellingen wordt dan uitgeschakeld. De sleutel komt nooit in de voorkant, in logs of in foutmeldingen. Zonder sleutel werkt de scan gewoon: dan wordt een regelgebaseerd rapport verstuurd.
- **Model.** Standaard `claude-sonnet-5-5`. Gebruik een geldige model-ID van Anthropic.
- **Kostprijs per uur** (standaard €45) en **werkweken per jaar** (standaard 46) bepalen de berekening in euro's.
- **E-mail voor interne leadmeldingen.** Hier komt "[HEET] Nieuwe AI-scan: Bedrijf (X u/wk)" binnen.
- **Calendly- of afspraaklink.** Is dit veld leeg, dan wordt de knop "Plan een gesprek" niet getoond. De knop "Plan een kennismaking" (shortcode `[veryo_kennismaking]`, onder andere op de Startpakket-pagina) gaat dan naar `/contact/`.
- **Make-webhook-URL** (optioneel, moet met `https://` beginnen). Elke nieuwe lead gaat als JSON naar deze URL, bijvoorbeeld om een taak in ClickUp of Notion te maken. Velden: `lead_id`, `bron`, `datum`, `temperatuur`, `cijfers`, `antwoorden`, `leesbaar`, `contact`, `admin_url`.
- **Bewaartermijn** (standaard 24 maanden). Oudere leads worden dagelijks automatisch verwijderd.
- **Afzendernaam** van e-mails (standaard "Veryo").

Klik daarna op **Test API-verbinding** en **Test e-mail versturen**.

**Weergave.** "Toon cases en reviews" staat uit. Zet het pas aan als de cases- en reviewblokken met echte, toegestane gegevens zijn gevuld.

## 4. E-mail: installeer een SMTP-plugin

WordPress verstuurt mail standaard via de server. Die mails komen vaak in de map met ongewenste mail terecht, of komen helemaal niet aan. Installeer daarom een SMTP-plugin, bijvoorbeeld **WP Mail SMTP** of **FluentSMTP**, en koppel die aan je zakelijke mailbox of een maildienst. Stuur daarna via **Instellingen > Veryo** een testmail.

Zorg dat het e-mailadres in de bedrijfsgegevens een echt adres op je eigen domein is. Dat adres wordt als antwoordadres (Reply-To) van de rapportmails gebruikt.

## 5. Wat nog open staat

Op de site staat nergens een `[VUL IN]`- of `[FOTO]`-plek of iets dat op "under construction" lijkt, ook niet als je ingelogd bent. De site is klaar voor publicatie. Wat je later nog kunt toevoegen (overzicht onder **Extra > Veryo-inhoud**):

- **Cases en reviews** (homepage en Over Veryo): het blok is verborgen tot je onder **Instellingen > Veryo** "Toon cases en reviews" aanzet. Vul het eerst met een echte klantcase en review, met toestemming.
- **Foto's**: de pagina's hebben nu geen foto's. Je kunt er twee manieren voor gebruiken:
  - in de editor een afbeeldingsblok toevoegen waar je wilt (geef het een alt-tekst met het zoekwoord van de pagina);
  - of foto's als `assets/images/photos/{sleutel}.webp` in het thema zetten (sleutels en bronvermelding in `assets/images/photos/CREDITS.md`). Bij een nieuwe installatie komen ze dan automatisch op de juiste plekken.
  Een echte foto van jezelf op Over Veryo werkt goed voor vertrouwen.
- **Blogconcepten** (17, status concept): per kop staat de opzet. Schrijf ze uit en controleer actuele voorwaarden, prijzen en regelingen (SLIM, WBSO) voor je publiceert.
- **LinkedIn en Instagram**: vul de URL's in onder **Instellingen > Veryo** zodra ze er zijn.
- **Foto van jezelf**: kies onder **Instellingen > Veryo > Foto oprichter** een portret. Het verschijnt onder de hero, naast je citaat op de homepage, op Over Veryo en op Contact. Zonder foto staat er een vormgegeven merkvlak met je naam (geen lege plek).
- **Jaarkorting AI-partner**: de site zegt dat je korting krijgt als je een jaar vooruitbetaalt, zonder percentage. Wil je het percentage noemen, zet het dan in de tekst op `/ai-partner/` en `/prijzen/`.
- **Open groepstrainingen voor zzp'ers**: op `/ai-training/zzp/` staat dat data, locatie en prijs via de wachtlijst bekend worden gemaakt. Vul ze aan zodra ze vaststaan.
- **Opzegtermijn**: overal één maand (losse abonnementen na de minimale looptijd van drie maanden, en AI-partner na het eerste jaar). Dit is een aanname, gelijk aan de algemene voorwaarden; pas beide aan als het anders moet.

## Aanbod, prijzen en menu

Veryo staat op de site als **onafhankelijke AI-partner** die geen eigen software verkoopt, en uitdrukkelijk **geen IT-bedrijf** (geen IT-beheer, hardware of helpdesk; dat staat op Over Veryo en in de FAQ). Het aanbod is opgebouwd in zes pijlers. Alle prijzen staan op één plek: `inc/quiz/catalog.php` (`veryo_price_ladder()`, `veryo_startpakket_prices()`, `veryo_subscriptions()`, `veryo_partner_tiers()` en `veryo_werkplek_prices()`). Pas je daar een prijs aan, dan verandert die in de prijsblokken, de schema.org-gegevens, llms.txt, de rapportmail en de AI-scan. Prijzen in de lopende tekst van pagina's pas je in de editor aan.

**De zes pijlers en hun pagina's**

1. **Advies en AI-Startpakket**: `/waar-begin-ik-met-ai/` (gratis scan), `/ai-startpakket/` (hoofdproduct: €1.995 / €2.995 / €4.495), `/ai-implementatie-mkb/`.
2. **Training**: `/ai-training/`, `/ai-training/ai-geletterdheid/`, `/ai-training/ai-strategie/` (directie en MT, €750–1.500), `/ai-training/zzp/` (online, €49–79), `/academy/`.
3. **De AI-werkplek**: `/ai-werkplek/` (Copilot of Gemini inrichten, €1.495 tot 10 gebruikers, €2.495 bij 11–25).
4. **Digitale collega's en automatisering**: `/ai-agents/` (project €2.500–7.500, maatwerk vanaf €5.000), `/ai-automatisering/` met subpagina's, `/ai-op-maat/`. Het oude adres `/ai-op-maat/ai-agents/` stuurt door naar `/ai-agents/`.
5. **Veilig AI-gebruik**: `/veilig-ai-gebruik/` (AI-veiligheidscheck €995).
6. **AI-partner**: `/ai-partner/` (€495 / €745 / €995 per maand, met 4 / 6 / 10 uur).

**Abonnementen.** Bij elk pakket hoort één abonnement, dat op de pakketpagina direct onder de prijs staat ("Daarna doorlopend"): Bijblijven €195 (bij het Startpakket), Werkplek-onderhoud €10 per gebruiker met minimaal €99, Veilig blijven €149, en Onderhoud €150–500 (verplicht bij gebouwde koppelingen en agents). De eerste maand loopt kosteloos mee en de klant kiest vooraf zelf of het doorloopt. De rekenvergelijking op `/ai-partner/` en `/prijzen/` (€195 + €100 + €149 = €444 tegenover €495 met 4 uur erbij) wordt uit de tabellen berekend, dus klopt altijd. Elk abonnement staat in schema.org als `Offer` met een `UnitPriceSpecification`.

**Menu.** Diensten is een mega-menu met drie kolommen: Starten, Inrichten, en Veilig en doorlopend. Op mobiel staan de kolommen onder elkaar.

## Publicatie-checklist

1. Thema geïnstalleerd en geactiveerd; permalinks op **Berichtnaam** (§2).
2. **Instellingen > Lezen**: het vinkje "Zoekmachines ontmoedigen deze site te indexeren" staat **uit**.
3. SMTP-plugin ingesteld en testmail ontvangen (§4).
4. API-sleutel in `wp-config.php`, "Test API-verbinding" gelukt; Calendly-link en e-mail voor leadmeldingen ingevuld (§3b).
5. Zelf één keer de AI-scan en het contactformulier ingevuld; rapportmail en interne melding ontvangen.
6. Juridische teksten laten controleren (§6).
7. https actief (slotje in de browser), daarna sitemap indienen bij Google en Bing (§7).

## 6. Juridische teksten laten controleren

De privacyverklaring, cookieverklaring en algemene voorwaarden zijn volledig ingevuld met jouw gegevens (Veryo, handelsnaam van Merklenz, KvK 73435996, hosting en mail via mijn.host, offertes 14 dagen geldig, betaaltermijn 14 dagen, maandelijkse facturatie, abonnementen maandelijks opzegbaar met één maand opzegtermijn) en gangbare standaardformuleringen, onder andere voor de aansprakelijkheidsbeperking en de doorgifte van gegevens aan Anthropic. Versiedatum: 30 september 2026.

Het blijven **concepten**: in de editor van deze pagina's staat de melding "Concepttekst, laat dit juridisch controleren." Op de website zelf is die melding niet te zien. Laat de teksten door een jurist controleren, zeker de aansprakelijkheidsbeperking en de opzegtermijn. Haal daarna het vinkje "Juridisch concept" weg in de box **Veryo SEO** onder de pagina en pas zo nodig de versiedatum aan.

## 7. Google Search Console, Bing en Google Bedrijfsprofiel

1. Voeg de site toe aan **Google Search Console** (domeineigendom via DNS) en dien de sitemap in: `https://jouwdomein.nl/wp-sitemap.xml`.
2. Doe hetzelfde in **Bing Webmaster Tools**; je kunt de site daar importeren vanuit Search Console.
3. Maak een **Google Bedrijfsprofiel** aan, met precies dezelfde naam, hetzelfde adres, telefoonnummer en dezelfde omschrijving als op de site: "Veryo, AI voor het MKB, uit Leeuwarden". Consistente gegevens helpen zoekmachines en AI-zoekmachines.

`/robots.txt` blokkeert geen zoekmachines of AI-crawlers, alleen `/wp-admin/` en `/rapport/`. `/llms.txt` wordt automatisch opgebouwd uit de instellingen en pagina's.

Gebruik je **Yoast SEO** of **Rank Math**? Dan schakelt het thema zijn eigen title, meta description, canonical, Open Graph en schema automatisch uit om dubbele uitvoer te voorkomen. De waarden in de box "Veryo SEO" blijven bewaard, zodat je ze kunt overnemen.

## 8. De AI-scan aanpassen

De scan staat op `/waar-begin-ik-met-ai/` en kan op elke pagina worden geplaatst met de shortcode `[veryo_ai_scan]`. Elke knop "Doe de gratis AI-scan" linkt naar die pagina.

**Berekening** (server-side, de AI rekent niets):

- uren per week = Σ (uren per taak × factor), afgerond;
- euro's per jaar = uren per week × werkweken × kostprijs per uur, afgerond op €100;
- kansenscore = min(100, 20 + 5 × uren per week + 10 bij een team van 6 of meer + 10 als AI nog niet of één keer is gebruikt);
- **heet** = timing "Nu" én (team ≥ 6 of ≥ 8 u/wk); **warm** = "Nu" of "Binnen 3 maanden"; anders **koud**.

Standaardfactoren: e-mail 0,35 · offertes 0,50 · administratie 0,50 · planning 0,30 · telefoon/WhatsApp 0,30 · content 0,40 · rapportages 0,50 · werving 0,30.

**Factoren aanpassen** doe je met een filter, bijvoorbeeld in een eigen mini-plugin (`wp-content/mu-plugins/veryo-factoren.php`), zodat het een thema-update overleeft:

```php
<?php
add_filter( 'veryo_scan_factors', function ( $factors ) {
	$factors['offertes'] = 0.40;
	$factors['email']    = 0.30;
	return $factors;
} );
```

De huidige factoren staan onderaan **Instellingen > Veryo**. De systeemprompt voor het rapport pas je aan met het filter `veryo_scan_system_prompt`.

**Wat er naar de AI gaat.** Alleen de antwoorden (branche, teamgrootte, taken en uren, tools, AI-gebruik, frustratietekst, timing), de berekende cijfers en de dienstencatalogus. Nooit naam, bedrijfsnaam, e-mailadres of telefoonnummer. E-mailadressen en telefoonnummers in de frustratietekst worden er vooraf uitgehaald. De AI mag alleen aanbevelingen uit de catalogus kiezen (`inc/quiz/catalog.php`); niveau en prijs komen altijd uit de catalogus. Bij een fout, time-out of ongeldige JSON wordt een regelgebaseerd rapport gebruikt, en de fout wordt (zonder sleutel of persoonsgegevens) in het logboek van de lead gezet.

**WP-Cron.** Het rapport wordt op de achtergrond gemaakt via WP-Cron. Op sites met weinig bezoek of met `DISABLE_WP_CRON` kan dat later gebeuren. Stel in dat geval bij je hosting een echte cronjob in die elke 5 minuten `https://jouwdomein.nl/wp-cron.php` aanroept. Je kunt een rapport altijd handmatig versturen via de knop in de lead.

## 9. Leads beheren en exporteren

Onder **Leads** in wp-admin (alleen voor beheerders) staan alle inzendingen van de AI-scan, het contactformulier en de Academy-wachtlijst.

- Kolommen: datum, bedrijf, voornaam, bron, branche, uren/week, temperatuur, status en of het rapport is verstuurd.
- Filter op temperatuur, status en bron.
- Open een lead om alle antwoorden, contactgegevens en het logboek te zien, de status te wijzigen (Nieuw, Gebeld, Kansensessie gepland, Klant, Geen interesse) en het rapport **(opnieuw) te genereren en te versturen**.
- **Exporteer leads (CSV)**: alle velden, inclusief contactgegevens.
- **Anonieme statistieken (CSV)**: alleen antwoorden en cijfers per maand, zonder contactgegevens en zonder frustratietekst. Bedoeld voor eigen onderzoek, bijvoorbeeld "AI-gebruik in het Noord-Nederlandse MKB".

Verzoeken om inzage of verwijdering handel je af via **Extra > Persoonsgegevens exporteren/wissen**; leads worden daar op e-mailadres gevonden.

## 10. Beweging en interactie

De site gebruikt GSAP (met ScrollTrigger en SplitText) en Lenis voor animaties en vloeiend scrollen. Alles staat lokaal in het thema (`assets/vendor/`), er wordt niets van een CDN geladen. De licenties staan in `assets/vendor/gsap/LICENSE.md` (GSAP Standard "no charge" license) en `assets/vendor/lenis/LICENSE` (MIT). Controleer de GSAP-licentie bij elke update.

- **Aan- en uitzetten**: onder **Instellingen > Veryo > Weergave** staan "Animaties" en "Smooth scrolling". Bezoekers die in hun systeem "beweging beperken" hebben ingesteld, krijgen nooit animaties, pinning of smooth scrolling.
- **Zonder JavaScript** is alle inhoud zichtbaar; de animaties zetten hun beginstand pas als het script geladen is.
- **Op mobiel** zijn er geen vastgepinde secties of horizontale scroll: de zes pijlers zijn dan swipebare kaarten.
- **Wat er beweegt**: de hero-kop schuift woord voor woord omhoog (met CSS, zodat hij direct zichtbaar is), het grote vinkje tekent zichzelf, een doorlopende band met processen, "Zonder aanpak / met Veryo" met doorstrepen en vinkjes, de zes pijlers horizontaal, een stappenlijn die vult, je citaat dat woord voor woord kleurt, sectiekoppen die uit een masker schuiven, de prijsschakelaar per teamgrootte, de FAQ, de AI-scan (stappen schuiven, uren tellen op), een sticky "Doe de gratis AI-scan" op mobiel en het grote woordmerk in de footer.
- **WhatsApp-knop**: zet hem aan onder **Instellingen > Veryo > Weergave** en vul het nummer internationaal in (bijv. 31612345678).
- **Klantlogo's**: kies ze onder **Instellingen > Veryo**. Ze verschijnen pas als "Toon cases en reviews" aan staat.

**Lettertypes.** Newsreader en Plus Jakarta Sans staan lokaal in het thema, ingekort tot Latijnse tekens (alle Nederlandse letters, €, aanhalingstekens). Newsreader staat vast op gewicht 500 (zoals de huisstijl voorschrijft), met variabele optische grootte. Daardoor laden ze veel sneller. Licentie: SIL Open Font License, zie `assets/fonts/LICENSE.md`.

**CSS.** `assets/css/main.css` is de bron; de site laadt `main.min.css` (ingekort, onder 60 KB) als die nieuwer is. Pas je de CSS aan, maak dan opnieuw `main.min.css` met `tools/minify-css.py` uit de projectmap, of haal `main.min.css` weg (dan wordt `main.css` geladen).

## 11. Bewerken

Alle pagina's bestaan uit gewone Gutenberg-blokken en zijn in de editor aan te passen. Terugkerende secties staan als blokpatronen in de categorie **Veryo** (hero, CTA-blok AI-scan, AI-Startpakket, dienstenoverzicht, prijsladder, FAQ, stappenplan, branche-grid, regioblok, direct antwoord). Een FAQ-blok levert automatisch FAQPage-schema op, met exact de zichtbare vragen en antwoorden. Per pagina stel je in de box **Veryo SEO** de SEO-title (max. 60 tekens), meta description (140–155 tekens), canonical, noindex en het dienstschema met prijsrange in.

Het thema laadt geen externe lettertypes, scripts of trackers. Fonts, logo en afbeeldingen komen allemaal uit het thema zelf.
