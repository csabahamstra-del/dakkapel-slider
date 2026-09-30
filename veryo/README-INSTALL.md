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
   - 14 blogconcepten worden aangemaakt (status: concept);
   - de tagline wordt "AI die echt werkt." en het site-icoon wordt het Veryo-beeldmerk.
   - de standaardinhoud van WordPress ("Hello world!" en "Sample Page") gaat naar de prullenbak, maar alleen als je die nog niet hebt aangepast.
4. Bovenaan wp-admin verschijnt een melding met een link naar de instellingen en een lijst met alle `[VUL IN]`-placeholders.

**Had je een eerdere versie van het thema al actief?** Dan worden alleen de ontbrekende pagina's aangemaakt (zoals `/ai-startpakket/` en `/ai-partner/`). Een bestaande homepage, prijzenpagina en bestaande menu's blijven zoals ze waren. Wil je de nieuwe versie daarvan: verwijder die pagina's of menu's (of zet ze in de prullenbak) en klik daarna op de knop hieronder.

Pagina per ongeluk verwijderd? Ga naar **Extra > Veryo-inhoud** en klik op **Veryo-inhoud opnieuw aanmaken (ontbrekende pagina's)**. Alleen ontbrekende pagina's, menu's en concepten worden aangemaakt.

## 2. Permalinks controleren

Ga naar **Instellingen > Permalinks** en controleer dat **Berichtnaam** (`/%postname%/`) is gekozen. Klik één keer op **Wijzigingen opslaan**. Open daarna `/ai-automatisering/` en `/llms.txt` om te checken dat alles werkt.

Gebruikt je hosting nginx en geeft `/llms.txt` een 404? Dan serveert nginx `.txt`-bestanden rechtstreeks. Vraag je hostingpartij om `/llms.txt` door te sturen naar WordPress (`try_files $uri $uri/ /index.php?$args;`).

## 3. Instellingen invullen (Instellingen > Veryo)

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
- **Blogconcepten** (14, status concept): per kop staat de opzet. Schrijf ze uit en controleer actuele voorwaarden, prijzen en regelingen (SLIM, WBSO) voor je publiceert.
- **LinkedIn en Instagram**: vul de URL's in onder **Instellingen > Veryo** zodra ze er zijn.

## Aanbod, prijzen en menu

Veryo staat op de site als **onafhankelijke AI-partner** die geen eigen software verkoopt. Het aanbod en alle prijzen staan op één plek: `inc/quiz/catalog.php` (`veryo_price_ladder()`, `veryo_startpakket_prices()` en `veryo_startpakket_parts()`). Pas je daar een prijs aan, dan verandert die in de prijsladder, het Startpakket-blok, de rapportmail en de AI-scan. Prijzen in de lopende tekst van pagina's pas je in de editor aan.

- **AI-Startpakket** (`/ai-startpakket/`, hoofdproduct): tot 10 medewerkers €1.995, 11–25 €2.995, 26–50 €4.495, excl. btw. Vijf onderdelen: AI-scan en kansensessie, training voor het hele team, AI-beleid op maat, één quick win ingericht en 30 dagen nazorg. De pagina heeft Service-schema met drie Offers (box **Veryo SEO** > schema "AI-Startpakket"). Het blok staat ook als patroon **AI-Startpakket (uitgelicht)** in de editor. Alleen het prijsblok van het Startpakket krijgt het amberkleurige accent.
- **AI-partner** (`/ai-partner/`): €495–995 per maand excl. btw, per maand opzegbaar. **Let op:** de opzegtermijn van één maand is een aanname, gelijk aan de algemene voorwaarden. Klopt die niet, pas dan de pagina én de voorwaarden aan.
- **Veryo Academy** (`/academy/`): €49–79 per persoon, staffelkorting vanaf 10 deelnemers. Het wachtlijstformulier vraagt naam, bedrijf, aantal medewerkers, e-mail en toestemming. Het aantal staat bij de lead en in de CSV-export (`aantal_medewerkers`).
- **Prijzenpagina** (`/prijzen/`): instap (gratis scan), hoofdproduct (Startpakket), losse onderdelen en doorlopend (partner, onderhoud).
- **Hoofdmenu > Diensten**: AI-Startpakket, AI-training, AI-implementatie MKB, AI-automatisering en koppelingen, AI op maat, AI-partner.
- **Rapportmail van de AI-scan**: onderaan staat het blok "Je volgende stap: het AI-Startpakket" met de prijs voor de teamgrootte uit de scan. Het rapport adviseert eerst te kijken wat bestaande software al kan, en noemt geen softwaremerken.

## Publicatie-checklist

1. Thema geïnstalleerd en geactiveerd; permalinks op **Berichtnaam** (§2).
2. **Instellingen > Lezen**: het vinkje "Zoekmachines ontmoedigen deze site te indexeren" staat **uit**.
3. SMTP-plugin ingesteld en testmail ontvangen (§4).
4. API-sleutel in `wp-config.php`, "Test API-verbinding" gelukt; Calendly-link en e-mail voor leadmeldingen ingevuld (§3).
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

## 10. Bewerken

Alle pagina's bestaan uit gewone Gutenberg-blokken en zijn in de editor aan te passen. Terugkerende secties staan als blokpatronen in de categorie **Veryo** (hero, CTA-blok AI-scan, AI-Startpakket, dienstenoverzicht, prijsladder, FAQ, stappenplan, branche-grid, regioblok, direct antwoord). Een FAQ-blok levert automatisch FAQPage-schema op, met exact de zichtbare vragen en antwoorden. Per pagina stel je in de box **Veryo SEO** de SEO-title (max. 60 tekens), meta description (140–155 tekens), canonical, noindex en het dienstschema met prijsrange in.

Het thema laadt geen externe lettertypes, scripts of trackers. Fonts, logo en afbeeldingen komen allemaal uit het thema zelf.
