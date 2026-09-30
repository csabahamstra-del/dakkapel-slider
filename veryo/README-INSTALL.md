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
   - 12 blogconcepten worden aangemaakt (status: concept);
   - de tagline wordt "AI die echt werkt." en het site-icoon wordt het Veryo-beeldmerk.
4. Bovenaan wp-admin verschijnt een melding met een link naar de instellingen en een lijst met alle `[VUL IN]`-placeholders.

Pagina per ongeluk verwijderd? Ga naar **Extra > Veryo-inhoud** en klik op **Veryo-inhoud opnieuw aanmaken (ontbrekende pagina's)**. Alleen ontbrekende pagina's, menu's en concepten worden aangemaakt.

## 2. Permalinks controleren

Ga naar **Instellingen > Permalinks** en controleer dat **Berichtnaam** (`/%postname%/`) is gekozen. Klik één keer op **Wijzigingen opslaan**. Open daarna `/ai-automatisering/` en `/llms.txt` om te checken dat alles werkt.

Gebruikt je hosting nginx en geeft `/llms.txt` een 404? Dan serveert nginx `.txt`-bestanden rechtstreeks. Vraag je hostingpartij om `/llms.txt` door te sturen naar WordPress (`try_files $uri $uri/ /index.php?$args;`).

## 3. Instellingen invullen (Instellingen > Veryo)

**Bedrijfsgegevens.** Deze staan al ingevuld: Veryo (handelsnaam van Merklenz, eenmanszaak), Lange Marktstraat 1, Leeuwarden, 085 060 5752, info@veryo.nl, KvK 73435996, oprichter Csaba. Vul nog aan: **postcode**, eventueel **btw-nummer**, **LinkedIn** en **Instagram**. Deze gegevens verschijnen in de footer, op de contactpagina, in schema.org en in e-mails. Lege velden worden nergens getoond.

**AI-scan.**

- **API-sleutel van Anthropic.** Zet de sleutel bij voorkeur in `wp-config.php`, boven de regel `/* That's all, stop editing! */`:

  ```php
  define( 'VERYO_ANTHROPIC_API_KEY', 'sk-ant-...' );
  ```

  De constante heeft voorrang en het veld in de instellingen wordt dan uitgeschakeld. De sleutel komt nooit in de voorkant, in logs of in foutmeldingen. Zonder sleutel werkt de scan gewoon: dan wordt een regelgebaseerd rapport verstuurd.
- **Model.** Standaard `claude-sonnet-5-5`. Gebruik een geldige model-ID van Anthropic.
- **Kostprijs per uur** (standaard €45) en **werkweken per jaar** (standaard 46) bepalen de berekening in euro's.
- **E-mail voor interne leadmeldingen.** Hier komt "[HEET] Nieuwe AI-scan: Bedrijf (X u/wk)" binnen.
- **Calendly- of afspraaklink.** Is dit veld leeg, dan wordt de knop "Plan een gesprek" niet getoond.
- **Make-webhook-URL** (optioneel, moet met `https://` beginnen). Elke nieuwe lead gaat als JSON naar deze URL, bijvoorbeeld om een taak in ClickUp of Notion te maken. Velden: `lead_id`, `bron`, `datum`, `temperatuur`, `cijfers`, `antwoorden`, `leesbaar`, `contact`, `admin_url`.
- **Bewaartermijn** (standaard 24 maanden). Oudere leads worden dagelijks automatisch verwijderd.
- **Afzendernaam** van e-mails (standaard "Veryo").

Klik daarna op **Test API-verbinding** en **Test e-mail versturen**.

**Weergave.** "Toon cases en reviews" staat uit. Zet het pas aan als de cases- en reviewblokken met echte, toegestane gegevens zijn gevuld.

## 4. E-mail: installeer een SMTP-plugin

WordPress verstuurt mail standaard via de server. Die mails komen vaak in de map met ongewenste mail terecht, of komen helemaal niet aan. Installeer daarom een SMTP-plugin, bijvoorbeeld **WP Mail SMTP** of **FluentSMTP**, en koppel die aan je zakelijke mailbox of een maildienst. Stuur daarna via **Instellingen > Veryo** een testmail.

Zorg dat het e-mailadres in de bedrijfsgegevens een echt adres op je eigen domein is. Dat adres wordt als antwoordadres (Reply-To) van de rapportmails gebruikt.

## 5. Placeholders invullen

Alle plekken waar nog iets moet worden ingevuld, staan als `[VUL IN: …]` in de tekst. Een actuele lijst vind je altijd onder **Extra > Veryo-inhoud**. Bij levering ging het om:

**Pagina's**

- **Homepage** (`/`): echte klantcase en echte review. Het blok is verborgen tot "Toon cases" aan staat.
- **Over Veryo** (`/over-veryo/`): echte klantcase en review (verborgen). De introductie van de oprichter is ingevuld; vul eventueel aan met je achtergrond en ervaring.
- **Privacyverklaring** (`/privacyverklaring/`): datum; grondslag laten controleren; doorgiftemechanisme en bewaartermijn bij Anthropic; Make en de gekoppelde tool (als je de webhook gebruikt); controle van de bewaartermijn; aanvullende beveiligingsmaatregelen. (Handelsnaam, KvK, hosting en maildienst mijn.host staan erin.)
- **Cookieverklaring** (`/cookieverklaring/`): datum; aanvullen als er analytics of embeds bijkomen.
- **Algemene voorwaarden** (`/algemene-voorwaarden/`): datum; factuurfrequentie van abonnementen; aansprakelijkheidsbeperking; looptijd en opzegtermijn. (Handelsnaam, KvK, offertegeldigheid 14 dagen en betaaltermijn 14 dagen staan erin.)

**Blogconcepten** (alle 12, status concept): per artikel `[VUL IN: aanvullen]` bij de FAQ-antwoorden, plus bij de artikelen over ChatGPT/Claude/Copilot, AVG, SLIM en WBSO de actuele voorwaarden, prijzen en officiële bronnen. De concepten bevatten per kop de opzet in 2–4 zinnen; schrijf en controleer ze voor publicatie.

**Foto's.** Op elke dienst-, regio- en branchepagina staat een blok `[FOTO: omschrijving. Alt-tekst: …]`. Vervang het door een echte foto (geen stockfoto's met robots of blauwe breinen) en gebruik de voorgestelde alt-tekst.

## 6. Juridische teksten laten controleren

De privacyverklaring, cookieverklaring en algemene voorwaarden zijn **gestructureerde concepten**. Beheerders zien bovenaan elke pagina de melding "Concepttekst, laat dit juridisch controleren." (bezoekers zien die niet). Laat de teksten door een jurist controleren. Haal daarna het vinkje "Juridisch concept" weg in de box **Veryo SEO** onder de pagina.

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

Alle pagina's bestaan uit gewone Gutenberg-blokken en zijn in de editor aan te passen. Terugkerende secties staan als blokpatronen in de categorie **Veryo** (hero, CTA-blok AI-scan, dienstenoverzicht, prijsladder, FAQ, stappenplan, branche-grid, regioblok, direct antwoord). Een FAQ-blok levert automatisch FAQPage-schema op, met exact de zichtbare vragen en antwoorden. Per pagina stel je in de box **Veryo SEO** de SEO-title (max. 60 tekens), meta description (140–155 tekens), canonical, noindex en het dienstschema met prijsrange in.

Het thema laadt geen externe lettertypes, scripts of trackers. Fonts, logo en afbeeldingen komen allemaal uit het thema zelf.
