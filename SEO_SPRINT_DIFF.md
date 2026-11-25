# SEO-sprint 25 november 2026: wijzigingen ter controle

Thema 2.5.0, branch `seo-sprint`. **Nog niets is live.** Hieronder staat per pagina wat er verandert (oud → nieuw). Pas na jouw akkoord gaat het thema op de site.

## Waar de instellingen staan

- **Title, meta description en focuszoekwoord** staan in het thema (`veryo/inc/content/…`). Het thema zet ze bij de update in Rank Math, zoals bij 2.3.0 en 2.4.0. Rank Math geeft ze daarna uit. Er is dus één bron (het thema) en één uitvoer (Rank Math).
- **H1** is de paginatitel in WordPress. De update zet die alleen op de pagina's uit deze sprint.
- **Tekst, secties en FAQ's** staan als blokken in de pagina-inhoud. Ongewijzigde pagina's krijgen de nieuwe inhoud automatisch. Pagina's die je in WordPress zelf hebt aangepast niet; zie "Na de update".
- **FAQ-schema (FAQPage)** wordt bij het tonen opgebouwd uit de FAQ-blokken van de pagina. Nieuwe FAQ's staan er dus automatisch in. Gecontroleerd: op alle 54 pagina's is de JSON geldig en komen de vragen 1-op-1 overeen met wat er op de pagina staat.
- **De 4 nieuwsartikelen (sectie 8)** krijgen bij de update `noindex, follow` in het Rank Math-veld (`rank_math_robots`). Rank Math haalt ze dan zelf uit de sitemap. Ze worden niet verwijderd.
- **Het factuur-blogartikel (sectie 1b)** staat alleen in de database. De update voegt er de twee links in toe en meldt in wp-admin wat er gebeurd is. Getest op een kopie met dezelfde opbouw. Kan het de plek niet vinden, dan verandert er niets en staat dat in de melding.

## Niet gedaan of anders gedaan (graag je beslissing)

1. **Sectie 6 (Recruitment via WhatsApp)**: niet doorgevoerd, want daar was eerst jouw akkoord voor nodig. Daarom staat de recruitmentlink ook niet in het blok "Veelgevraagd" op de homepage. Geef je akkoord, dan voer ik sectie 6 door zoals in de brief.
2. **[INVULLEN]-plekken**: niet op de site gezet. Je had eerder gevraagd geen [INVULLEN] op de site te laten zien, en theme-tekst kun je na upload niet makkelijk aanpassen. De onderdelen hieronder heb ik weggelaten tot je antwoordt:
   - **Claude Team en jullie boekhouding of ERP (H3 op /ai-werkplek/)**: koppelt Veryo Claude echt aan Exact Online of SnelStart? Zo niet, dan blijft de sectie weg.
   - **FAQ "Hoe lang duurt het inrichten?" op /ai-werkplek/**: hoeveel weken noem je?
   - **"Samen met partners in de regio" op /ai-adviseur-friesland/**: mag MKB Cyber Campus genoemd worden?
   - **Drenthe**: de pagina noemt al Assen, Emmen, Meppel en Hoogeveen (dat stond er al). Kom je daar echt langs? Zo niet, dan haal ik de plaatsnamen weg.
3. **Vergelijking Claude Team / ChatGPT Team / Copilot**: alleen beweringen die ik kon controleren.
   - Gecontroleerd op claude.com/pricing en de Commercial Terms van Anthropic: Team heeft projecten, connectoren en Claude for Microsoft 365, standaard geen training op jullie content, en een verwerkersovereenkomst (DPA) in de voorwaarden.
   - De pagina's van OpenAI en Microsoft waren vanaf hier niet bereikbaar. Over ChatGPT en Copilot staan daarom geen productclaims, alleen keuzecriteria.
   - **Graag controleren:** (a) heet het abonnement van OpenAI nog "ChatGPT Team"? Dat staat in de kop, zoals in de brief. (b) Klopt "Claude Team heeft een eigen koppeling met Microsoft 365"? Dat staat op de prijspagina van Anthropic ("Claude for Microsoft 365").
4. **FAQ "Is Claude Team veilig?"**: geformuleerd op basis van de prijspagina en de Commercial Terms van Anthropic ("Anthropic may not train models on Customer Content", DPA). Bron: claude.com/pricing en anthropic.com/legal/commercial-terms.
5. **Meta /ai-automatisering/**: de brief zegt "Met voorbeelden en prijzen", maar er staan geen prijzen op de site. Dat is nu "Met voorbeelden en aanpak". De title uit de brief had 61 tekens; nu "AI automatisering voor het mkb, met voorbeelden | Veryo" (53).
6. **Meta /ai-implementatie-mkb/**: "training" is "het team ermee leren werken" geworden, in lijn met 19 november. "Vaste prijs" is "Met vaste prijs vooraf" geworden. Er staan geen bedragen bij.
7. **Meta /branches/transport/**: de tekst uit de brief had 134 tekens; met "De planner beslist altijd." is het 141, zodat hij binnen de 140–155 valt.
8. **FAQ "Welk bedrijf helpt met AI implementatie?"**: "door heel Nederland" is geworden "in Noord-Nederland op locatie en daarbuiten online". Zo staat het ook elders op de site. Wil je "door heel Nederland"? Laat het weten.
9. **FAQ-dubbeling op de factuurpagina**: de oude vraag "Wordt er automatisch betaald?" is vervangen door "Wie keurt de betaling goed?", zodat dezelfde vraag niet twee keer staat. Op /ai-werkplek/ is "Wie betaalt de licenties?" op dezelfde manier vervangen door "Wat kost Claude Team?".
10. **Kleine extra fix**: op /ai-op-maat/ stond nog "AI-receptionist voor horeca"; dat is nu "Veryo Receptie voor zorgpraktijken".
11. **Footer**: "Werkgebied: Leeuwarden · Friesland · Groningen · Drenthe", met links naar de regiopagina's, in de bestaande footerstijl.

## Na de update (jij, in WordPress en Search Console)

1. Back-up maken, thema-zip uploaden en "Huidige vervangen" kiezen. Daarna één pagina in wp-admin openen; de update draait dan en toont een melding met wat er gebeurd is (noindex en blogartikel).
2. **Pagina's die je in WordPress zelf hebt aangepast**, krijgen de nieuwe tekst niet vanzelf. Op de live site lijkt dat zo te zijn voor /ai-adviseur-friesland/, want daar staan nog trainingen. Ga in wp-admin naar Extra → Veryo-inhoud → "Zelf aangepaste pagina’s toch bijwerken" en vink de sprintpagina's aan. Title, meta en H1 worden wel altijd bijgewerkt.
3. Controleer in Rank Math dat de 4 nieuwsartikelen op noindex staan en dat ze uit `sitemap_index.xml` zijn verdwenen.
4. Sectie 9 uit de brief: sitemap opnieuw indienen en per URL indexering aanvragen.

## Getest

- PHPCS (WordPress-standaard): schoon.
- test-content: 392 goed, 4 fout. Die 4 zijn bestaande, zelf ingevulde descriptions van 133 tot 139 tekens; de descriptions van de sprintpagina's vallen allemaal binnen 140–155.
- test-scan: 31 goed, 0 fout.
- Crawl: 0 problemen en 0 dode links. Op 54 pagina's is het FAQ-schema geldig en gelijk aan de pagina.
- html-validate: geen nieuwe fouten.
- Editor: alle blokken geldig, ook in het aangepaste blogartikel.
- Upgrade vanaf 2.4.0 getest: een eigen menu-item blijft staan, noindex zit in het Rank Math-veld en de testartikelen verdwijnen uit de sitemap.
- Op 375 en 1440 px scrollt geen pagina zijwaarts.

---

# Per pagina: oud → nieuw

Regels met − verdwijnen, regels met + komen erbij. Tekst tussen [ ] is een link.

## 1a. Facturen automatiseren — `/oplossingen/inkoopfacturen-automatiseren/`

| | Oud | Nieuw |
|---|---|---|
| Title | Inkoopfacturen automatisch verwerken met AI | Veryo | Facturen automatiseren met AI: inkoopfacturen | Veryo (53 tekens) |
| Meta description | Inkoopfacturen uit je mailbox automatisch uitgelezen, gecontroleerd en klaargezet in SnelStart, Exact of Moneybird. Vraag een gratis offerte aan. | Facturen automatiseren zonder nieuwe software. Inkoopfacturen uit de mail automatisch uitgelezen, gecontroleerd en klaargezet in jullie boekhouding. (148 tekens) |
| H1 | Inkoopfacturen automatiseren | Facturen automatiseren: inkoopfacturen automatisch verwerken (60 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-Inkoopfacturen automatiseren betekent: facturen automatisch verwerken in plaats van overtypen. Inkoopfacturen die per mail binnenkomen, worden uitgelezen, gecontroleerd, gematcht met inkooporders of werkbonnen en in je boekhouding gezet, zoals SnelStart, Exact of Moneybird, of in je ERP. Je administratie hoeft alleen nog de afwijkingen te bekijken.
+Facturen automatiseren zonder nieuwe software: inkoopfacturen die per mail binnenkomen, worden automatisch uitgelezen, gecontroleerd, gematcht met inkooporders, werkbonnen of projecten en klaargezet in jullie boekhouding, zoals SnelStart, Exact Online of Moneybird, of in jullie ERP. Niemand hoeft nog iets over te typen. Jullie administratie kijkt alleen nog naar de afwijkingen en keurt goed.
 Inkoopfacturen uit de mail automatisch gecontroleerd en klaargezet in jullie boekhouding.
@@ -7,10 +7,26 @@
 Het is precies, saai en foutgevoelig werk. Een factuur die dubbel wordt betaald of een prijs die niet klopt met de afspraak, valt pas op als het te laat is.
+## Hoe touchless is jullie factuurproces?
+Een touchless factuurproces betekent: de factuur komt binnen, wordt gecontroleerd en staat klaar in de boekhouding, en een mens kijkt alleen nog naar de afwijkingen. Hoe dicht zitten jullie daarbij? Loop deze vragen eens langs:
+Hoeveel facturen tikt iemand bij jullie nog met de hand over?
+Wie controleert prijs en aantal tegen de inkooporder of de werkbon, en hoeveel tijd kost dat?
+Hoe vaak wordt een factuur twee keer betaald, of juist gemist?
+Hoe lang ligt een factuur gemiddeld voordat hij is ingeboekt?
+Weten jullie aan het eind van de week wat een project aan inkoop heeft gekost?
+## Factuurverwerking in de bouw en techniek
+In de bouw, de installatietechniek en de metaal hoort bijna elke inkoopfactuur bij een project. Daarom koppelt de automatisering de factuur niet alleen aan de leverancier, maar ook aan de inkooporder, de werkbon of het projectnummer. Staat er meer op de factuur dan er is besteld, of wijkt de prijs af van de afspraak, dan wordt de factuur gemarkeerd.
+Meerwerk en afwijkingen vallen zo op voordat er betaald wordt, en de inkoopkosten per project zijn sneller inzichtelijk. Dat helpt bij de nacalculatie: jullie zien terwijl het project nog loopt hoe de inkoop zich verhoudt tot de begroting.
+## Facturen automatiseren in SnelStart, Exact Online of Moneybird
+De automatisering draait bovenop het boekhoudpakket dat jullie al gebruiken, zoals SnelStart, Exact Online of Moneybird. Jullie hoeven dus niet over te stappen. De factuur staat als concept klaar in jullie eigen pakket, met leverancier, bedragen, btw en het project ingevuld. Welke andere pakketten een koppeling hebben, staat hieronder bij de veelgestelde vragen.
+Kan jullie pakket zelf al facturen uitlezen? Dan kijken we eerst wat dat al oplevert. Vaak ontbreekt vooral de controle tegen inkooporders en werkbonnen, en daar zit de meeste tijdwinst.
 ## Wat je nodig hebt om te starten
-Om inkoopfacturen te automatiseren hebben we het mailadres nodig waar ze binnenkomen, toegang tot je boekhoudpakket (zoals SnelStart, Exact of Moneybird) en, als je dat gebruikt, de inkooporders of werkbonnen waartegen gematcht moet worden.
-In de proefperiode boekt de administratie nog mee. Zo zie je per leverancier hoe goed de herkenning is, voordat de automatisering het overneemt. Afwijkingen in prijs of aantal blijven altijd zichtbaar voor een mens.
-## Facturen uit je mail automatisch verwerken
-Factuur komt binnen per mailLeveranciers mailen naar je vaste facturenadres, zoals nu. Er hoeft niets te veranderen.
+Om inkoopfacturen te automatiseren hebben we het mailadres nodig waar ze binnenkomen, toegang tot jullie boekhoudpakket (zoals SnelStart, Exact Online of Moneybird) en, als jullie dat gebruiken, de inkooporders of werkbonnen waartegen gematcht moet worden.
+In de proefperiode boekt de administratie nog mee. Zo zien jullie per leverancier hoe goed de herkenning is, voordat de automatisering het overneemt. Afwijkingen in prijs of aantal blijven altijd zichtbaar voor een mens.
+## Wat we bewust niet automatiseren
+De betaling en het akkoord op een factuur blijven een menselijke beslissing. De automatisering leest, controleert en zet klaar; jullie administratie keurt goed en betaalt. Twijfelt de AI over een factuur, bijvoorbeeld omdat hij slecht leesbaar is of nergens bij past, dan zet hij hem niet stilletjes door, maar markeert hem.
+Zoeken jullie ook een oplossing voor de andere kant, de offertes en verkoopfacturen? Kijk dan bij [offertes en facturen automatiseren].
+## Facturen uit jullie mail automatisch verwerken
+Factuur komt binnen per mailLeveranciers mailen naar jullie vaste facturenadres, zoals nu. Er hoeft niets te veranderen.
 Uitgelezen en gecontroleerdDe AI leest leverancier, bedragen, regels en btw uit en controleert op dubbele facturen en rekenfouten.
 GematchtDe factuur wordt gekoppeld aan de juiste inkooporder, werkbon of project. Wijken prijzen of aantallen af, dan wordt de factuur gemarkeerd.
-IngeboektKlopt alles, dan staat de factuur klaar in je ERP of boekhoudpakket. Jouw administratie keurt goed en bekijkt alleen de uitzonderingen.
+KlaargezetKlopt alles, dan staat de factuur klaar in jullie ERP of boekhoudpakket. Jullie administratie keurt goed en bekijkt alleen de uitzonderingen.
 ## Voor wie
@@ -37,8 +53,14 @@
 ## Veelgestelde vragen
+Wat betekent een touchless factuurproces?
+Een factuur komt binnen, wordt automatisch uitgelezen, gecontroleerd tegen de order of het project en klaargezet in jullie boekhouding, zonder dat iemand iets overtypt. Jullie administratie kijkt alleen nog naar de facturen die afwijken.
+Moeten we overstappen op nieuwe software?
+Nee. Veryo bouwt de automatisering bovenop het boekhoudpakket of ERP dat jullie al gebruiken.
 Welke boekhoudpakketten ondersteunen jullie?
-Gangbare pakketten zoals Exact, Twinfield, AFAS, Moneybird en e-Boekhouden hebben koppelingen. Gebruik je een ERP, dan bekijken we de koppeling vooraf.
-Heeft mijn boekhoudpakket dit niet al?
-Veel pakketten lezen facturen uit, maar matchen niet met inkooporders of werkbonnen en controleren niet op afwijkende prijzen. Doet jouw pakket al genoeg, dan zeggen we dat eerlijk.
-Wordt er automatisch betaald?
-Nee. De AI bereidt voor en controleert; je administratie keurt goed en betaalt.
+Gangbare pakketten zoals Exact, Twinfield, AFAS, Moneybird en e-Boekhouden hebben koppelingen. Gebruiken jullie een ERP, dan bekijken we de koppeling vooraf.
+Heeft ons boekhoudpakket dit niet al?
+Veel pakketten lezen facturen uit, maar matchen niet met inkooporders of werkbonnen en controleren niet op afwijkende prijzen. Doet jullie pakket al genoeg, dan zeggen we dat eerlijk.
+Wie keurt de betaling goed?
+Altijd een mens. De automatisering zet facturen klaar en markeert afwijkingen. Betalen blijft jullie beslissing.
+Werkt dit ook voor facturen in de bouw, met projecten en werkbonnen?
+Ja. Facturen kunnen gekoppeld worden aan inkooporders, werkbonnen of projectnummers, zodat afwijkingen in prijs of aantal direct zichtbaar zijn.
 ## Benieuwd wat AI jouw bedrijf oplevert?
@@ -53,2 +75,4 @@
 [AI recruitment-assistent]Voor bedrijven die veel werven
+[AI in de bouw]Branche
+[AI voor installateurs]Branche
 [AI voor agri en mechanisatie]Branche
@@ -58 +82,2 @@
 [AI voor beveiligingsbedrijven]Branche
+[De administratieve kringloop]Van werkbon tot factuur en salaris
```


## 2. Claude Team — `/ai-werkplek/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI-werkplek met Claude Team voor technische kantoren | Veryo | Claude Team inrichten voor technische bedrijven | Veryo (55 tekens) |
| Meta description | Claude Team ingericht met jullie eigen normen, kengetallen en templates: bestek lezen, calculatie en rapportages. De engineer blijft eindverantwoordelijk. | Wij richten Claude Team in op jullie eigen normen, sjablonen en documenten. Voor calculatie, engineering en werkvoorbereiding. De engineer beslist. (147 tekens) |
| H1 | De AI-werkplek met Claude Team | Claude Team inrichten: de AI-werkplek voor jullie team (54 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-De AI-werkplek is Claude Team, ingericht met de eigen normen, kengetallen en templates van jullie bedrijf. Daarmee lezen engineers en werkvoorbereiders sneller een bestek, zetten ze een calculatieopzet klaar, controleren ze uitgangspunten en schrijven ze rapportages in jullie eigen opmaak. De engineer blijft eindverantwoordelijk. De licenties betalen jullie rechtstreeks aan Anthropic; Veryo richt de werkplek in en na de oplevering leren we jullie team ermee werken.
+Claude Team inrichten voor technische bedrijven: wij richten Claude Team in met de eigen normen, kengetallen, sjablonen en documenten van jullie bedrijf. Zo krijgt jullie team een AI-werkplek die jullie werk kent. Daarmee lezen engineers en werkvoorbereiders sneller een bestek, zetten ze een calculatieopzet klaar, controleren ze uitgangspunten en schrijven ze rapportages in jullie eigen opmaak. De engineer blijft eindverantwoordelijk. De licenties betalen jullie rechtstreeks aan Anthropic; Veryo richt de werkplek in en na de oplevering leren we jullie team ermee werken.
 [Plan een kennismaking]
@@ -13,11 +13,18 @@
 Rapportages. Opleverrapporten, adviezen en verslagen in jullie eigen template, op basis van aantekeningen en metingen.
-## Wat we inrichten
-Jullie normen, kengetallen en templates. We zetten de documenten waarmee jullie werken klaar in Claude, met vaste instructies per soort werk.
-Rechten en afspraken. Wie welke projecten en documenten ziet, en welke gegevens er nooit in gaan. Dat leggen we vast in een kort AI-beleid.
+## Wat “inrichten” precies inhoudt
+Claude Team zelf is een abonnement dat jullie in een paar minuten afsluiten. Het verschil zit in de inrichting: zonder die stap is het een algemene chatbot, met die stap een werkplek die jullie normen, sjablonen en projectkennis kent.
+Projecten en kennisbanken. Per soort werk, zoals calculatie, werkvoorbereiding of rapportage, een eigen project met de juiste documenten en vaste instructies.
+Jullie normen, kengetallen en sjablonen. We zetten de documenten waarmee jullie werken klaar in Claude, zodat de uitkomst in jullie eigen opmaak en met jullie eigen uitgangspunten komt.
+Rollen, rechten en afspraken over veilig gebruik. Wie welke projecten en documenten ziet, wie beheert, en welke gegevens er nooit in gaan. Dat leggen we vast in een kort AI-beleid.
 Koppelingen waar het helpt. Waar het kan, koppelen we Claude aan de opslag en systemen die jullie al gebruiken. Overstappen is niet nodig.
-Na de oplevering leren we jullie team ermee werken. Met jullie eigen bestekken en templates, zodat iedereen weet wat het kan en waar je op let.
+Na de oplevering leren we jullie team ermee werken. Op de ingerichte werkplek, met jullie eigen bestekken en sjablonen, zodat iedereen weet wat het kan en waar je op let.
 ## De engineer blijft eindverantwoordelijk
 Claude bereidt voor en controleert; het neemt geen beslissingen. Een berekening, advies of rapport gaat pas de deur uit als een engineer het heeft nagelopen en ondertekend. Dat staat ook in het AI-beleid dat we samen opstellen.
+## Claude Team, ChatGPT Team of Microsoft Copilot?
+Alle drie zijn zakelijke AI-werkplekken, en alle drie kunnen een team helpen. Welke het beste past, hangt vooral af van jullie werk en de software die jullie al gebruiken. Een eerlijke vergelijking op hoofdlijnen:
+Werken jullie vooral met lange documenten, zoals bestekken, normen en rapporten, en wil je dat de AI met jullie eigen projectkennis werkt? Daarvoor werken wij met Claude Team: het werkt met projecten waarin jullie eigen documenten en instructies klaarstaan.
+Werkt iedereen de hele dag in Word, Outlook en Teams? Dan is het goed om ook naar Microsoft Copilot te kijken. Claude Team heeft daarnaast een eigen koppeling met Microsoft 365.
+Gebruikt het team ChatGPT al veel? Dan nemen we dat mee in het advies. We kiezen niet voor een merk, maar voor wat bij jullie werk past, en zeggen het eerlijk als iets anders beter aansluit.
 ## Licenties en gegevens
-Claude Team is een zakelijk abonnement van Anthropic. De licenties sluiten jullie zelf af en betalen jullie rechtstreeks aan Anthropic; Veryo verkoopt geen licenties en verdient er niets aan. Bij een zakelijk abonnement worden jullie gegevens standaard niet gebruikt om AI-modellen te trainen. Gebruiken medewerkers daarnaast andere AI-tools, dan nemen we die mee in de afspraken.
+Claude Team is een zakelijk abonnement van Anthropic. De licenties sluiten jullie zelf af en betalen jullie rechtstreeks aan Anthropic; Veryo verkoopt geen licenties en verdient er niets aan. Volgens Anthropic worden de gegevens van Team-klanten standaard niet gebruikt om AI-modellen te trainen. Gebruiken medewerkers daarnaast andere AI-tools, dan nemen we die mee in de afspraken.
 ## Wat kost de AI-werkplek?
@@ -41,4 +48,6 @@
 Het zakelijke abonnement op Claude, de AI-assistent van Anthropic, voor teams. Medewerkers werken in gedeelde projecten met de documenten en instructies van het bedrijf.
-Wie betaalt de licenties?
-Jullie, rechtstreeks aan Anthropic. Veryo richt de werkplek in en verkoopt geen licenties.
+Wat kost Claude Team?
+De licenties nemen jullie rechtstreeks af bij Anthropic, tegen hun actuele prijs per gebruiker. Veryo rekent een vaste prijs voor het inrichten en biedt daarna optioneel doorlopend onderhoud.
+Is Claude Team veilig voor bedrijfsgegevens?
+Volgens Anthropic worden de gesprekken en documenten van Team-klanten standaard niet gebruikt om modellen te trainen, en vallen ze onder de zakelijke voorwaarden met een verwerkersovereenkomst (DPA). Daarnaast spreken we samen af welke gegevens er nooit in gaan, zoals persoonsgegevens van klanten die er niet nodig zijn.
 Neemt de AI beslissingen over?
@@ -54,4 +63,5 @@
 [Alle diensten]Wat Veryo bouwt en inricht
+[AI voor installateurs]Calculatie en werkvoorbereiding
 [De administratieve kringloop]Van werkbon tot factuur en salaris
 [Veilig AI-gebruik]Beleid, rechten en de veiligheidscheck
-[AI-agents]Digitale collega’s voor terugkerend werk
+[AI-agents voor bedrijven]Digitale collega’s voor terugkerend werk
```


## 3. AI voor installateurs — `/branches/installatie/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | AI voor installateurs en installatiebedrijven | Veryo |
| Meta description | ongewijzigd | AI voor installateurs: een offerte-generator met calculatietool, digitale werkbon naar factuur en een WhatsApp-assistent voor storingen. Gratis offerte. |
| H1 | ongewijzigd | AI voor installateurs en installatiebedrijven |

**Tekst (− oud, + nieuw):**

```diff
@@ -7,6 +7,6 @@
 Het vakwerk loopt meestal prima. Het werk eromheen, van aanvraag tot factuur, kost de meeste uren. Daar zit ook de meeste winst voor AI voor installateurs.
-## Zo helpt Veryo installatiebedrijven
+## Zo helpt Veryo installateurs
 [Veryo Collega, lokale AI-assistent]. Monteurs en binnendienst vragen hun eigen kennisbank naar storingscodes, handleidingen en eerdere klussen, op jullie eigen server.
 [AI-werkplek met Claude Team]. Claude ingericht met jullie eigen normen en templates, voor offertes en werkvoorbereiding door binnendienst en planners.
-[Automatisering]. Offertes, werkbonnen en storingsmeldingen automatiseren bovenop jullie bestaande pakket.
+[AI automatisering voor het mkb]. Offertes, werkbonnen en storingsmeldingen automatiseren bovenop jullie bestaande pakket.
 ## Vaste oplossingen voor installateurs
@@ -65,2 +65,5 @@
 Randvoorwaarden: werkbonnen bevatten steeds dezelfde basisgegevens.
+## AI voor installatie-adviesbureaus en engineering
+Niet elk installatiebedrijf werkt alleen met monteurs. Installatie-adviesbureaus en installateurs met een eigen engineeringafdeling besteden veel tijd aan voorbereidend werk: bestekken lezen, posten uitzoeken, een calculatie opzetten en de werkvoorbereiding op papier zetten.
+Daarvoor richten we Claude Team in met jullie eigen normen, kengetallen en sjablonen. Claude leest het bestek, haalt de relevante posten eruit en zet een eerste opzet klaar in jullie eigen calculatiesjabloon. De engineer of calculator controleert, past aan en blijft eindverantwoordelijk. Lees meer over hoe we [Claude Team inrichten].
 ## Zo ziet AI voor installateurs eruit in de praktijk
@@ -91,2 +94,4 @@
 Veel pakketten voor installateurs hebben een koppeling. Zo niet, dan werken we met exports of een eenvoudige tussenlaag. Dat checken we in de kansensessie.
+Kan AI een installatiebestek lezen en een calculatie voorbereiden?
+Ja. AI kan een bestek doorlezen, de relevante posten eruit halen en een eerste opzet maken in jullie eigen sjabloon. Jullie calculator controleert en beslist.
 Maakt de AI zelf de prijs?
@@ -103,2 +108,3 @@
 ## Verder lezen
+[Claude Team inrichten]Voor calculatie en werkvoorbereiding
 [Offertes en calculaties automatiseren]Alles over de offerte-generator
```


## 4a. Friesland — `/ai-adviseur-friesland/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | AI-adviseur Friesland: AI voor het Friese mkb | Veryo |
| Meta description | ongewijzigd | AI-adviseur in Friesland: Veryo uit Leeuwarden bouwt AI-agents en automatiseringen voor technische bedrijven in Friesland. Plan een kennismaking. |
| H1 | ongewijzigd | AI-adviseur in Friesland voor het MKB |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-Veryo is een AI-adviseur in Friesland, gevestigd in Leeuwarden. We bouwen en richten AI in voor Friese technische bedrijven: AI-agents, automatiseringen, de AI-werkplek met Claude Team en de administratieve kringloop. Daarvoor komen we gewoon langs. Je krijgt vooraf een gratis offerte met een vaste prijs.
+Veryo is een AI-adviseur in Friesland, gevestigd in Leeuwarden. We brengen AI voor het mkb in Friesland naar de praktijk: AI-agents, automatiseringen bovenop jullie eigen software, het inrichten van Claude Team en Veryo Collega, de lokale AI-assistent. Training hoort bij de oplevering: na de oplevering leren we jullie team ermee werken. Daarvoor komen we gewoon langs. Je krijgt vooraf een gratis offerte met een vaste prijs.
 [Plan een kennismaking]
@@ -76,3 +76,3 @@
 [Alle diensten]Wat Veryo bouwt en inricht
-[AI-automatisering voor bedrijven]Welke processen je kunt automatiseren
+[AI automatisering voor het mkb]Welke processen je kunt automatiseren
 [Contact]Bel, mail of plan een afspraak
```


## 4b. Drenthe — `/ai-adviseur-drenthe/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI-adviseur Drenthe: automatisering voor je bedrijf | Veryo | AI-automatisering voor bedrijven in Drenthe | Veryo (51 tekens) |
| Meta description | ongewijzigd | AI-adviseur in Drenthe: AI-agents en automatisering voor technische bedrijven in Assen, Emmen, Meppel en Hoogeveen. Plan een gratis kennismaking. |
| H1 | AI-adviseur in Drenthe voor het MKB | AI en automatisering voor bedrijven in Drenthe (46 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-Veryo is een AI-adviseur voor het MKB in Drenthe. We helpen bedrijven in Assen, Emmen, Hoogeveen, Meppel en omgeving met AI-agents, automatiseringen, de AI-werkplek met Claude Team en de administratieve kringloop. Je krijgt vooraf een gratis offerte met een vaste prijs.
+Veryo is een AI-adviseur voor het MKB in Drenthe. We helpen bedrijven in Assen, Emmen, Hoogeveen, Meppel en omgeving met AI en automatisering: AI-agents, automatiseringen bovenop jullie eigen software, de AI-werkplek met Claude Team en de administratieve kringloop. Je krijgt vooraf een gratis offerte met een vaste prijs.
 ## Drentse maakbedrijven, boeren en installateurs
```


## 4c. Groningen — `/ai-adviseur-groningen/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | AI-adviseur Groningen: AI-agents en automatisering | Veryo |
| Meta description | ongewijzigd | AI-adviseur in Groningen: AI-agents, automatisering en Claude Team voor technische bedrijven in stad en provincie, op locatie. Plan een kennismaking. |
| H1 | ongewijzigd | AI-adviseur in Groningen voor het MKB |

**Tekst (− oud, + nieuw):**

```diff
@@ -64,3 +64,3 @@
 [AI voor accountants en adviesbureaus]Verslagen en kennis
-[AI-implementatie voor het MKB]Van plan tot live
+[AI implementatie in het mkb]Van plan tot live
 [AI-adviseur in Drenthe]Assen, Emmen, Hoogeveen, Meppel
```


## 5. Transport — `/branches/transport/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI voor transport: orderinvoer, documenten en status | Veryo | AI orderinvoer en e-mailverwerking voor transport | Veryo (57 tekens) |
| Meta description | AI voor transport en logistiek: automatische orderinvoer, transportdocumenten verwerken, statusupdates en planning. Bespreek jullie proces met Veryo. | Orders uit e-mail en pdf automatisch klaargezet in jullie TMS. AI-e-mailverwerking, statusberichten en documenten. De planner beslist altijd. (141 tekens) |
| H1 | AI voor transport en logistiek | AI orderinvoer en e-mailverwerking voor transportbedrijven (58 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-Veryo zet AI in de logistiek in voor transportbedrijven: een planningsassistent die ritten voorstelt, automatische statusberichten zodat klanten niet hoeven te bellen, en vrachtdocumenten die vanzelf worden benoemd en gearchiveerd. Je krijgt vooraf een gratis offerte met een vaste prijs.
+AI orderverwerking voor logistiek en transport: Veryo zorgt dat orders uit e-mail en pdf automatisch worden uitgelezen en als concept klaarstaan in jullie TMS, dat inkomende mail wordt gesorteerd en dat klanten automatisch statusberichten krijgen. Vrachtdocumenten worden vanzelf benoemd en gearchiveerd. De planner controleert en beslist. Jullie krijgen vooraf een gratis offerte met een vaste prijs.
 Planning, statusberichten voor klanten en vrachtdocumenten automatisch verwerkt.
@@ -9,3 +9,3 @@
 [AI-werkplek met Claude Team]. Claude ingericht met jullie eigen afspraken en templates, voor planning en binnendienst.
-[Automatisering]. Statusberichten, planning en vrachtdocumenten automatiseren bovenop jullie TMS of planningspakket.
+[AI automatisering voor het mkb]. Statusberichten, planning en vrachtdocumenten automatiseren bovenop jullie TMS of planningspakket.
 ## Vaste oplossingen voor transport en logistiek
@@ -19,3 +19,3 @@
 Gematcht
-Ingeboekt
+Klaargezet
 Gratis offerte op maat
@@ -59,2 +59,12 @@
 Randvoorwaarden: statusgegevens zijn beschikbaar in het systeem.
+## Automatische orderinvoer: van e-mail naar TMS
+Een order komt binnen per mail of als pdf in de bijlage. De AI leest laad- en losadres, datum, tijdvenster, lading en referenties uit en zet de order als concept klaar in jullie TMS of planning. De planner controleert en bevestigt. Mist er iets, zoals een referentie of een tijdvenster, dan staat dat er duidelijk bij.
+Zo is AI orderverwerking voor logistiek geen zwarte doos: er gaat niets door zonder dat de planner het heeft gezien. Het overtypen verdwijnt, de controle blijft.
+## AI e-mailverwerking voor transportbedrijven
+De gedeelde mailbox van de planning krijgt van alles: orders, statusvragen, klachten, vrachtbrieven en afleverbonnen. De AI sorteert elke mail op soort en zet hem bij de juiste persoon of in de juiste map. Op statusvragen staat een conceptantwoord klaar met de actuele status uit jullie systeem.
+Klachten en vragen over schade of vertraging gaan altijd direct naar een planner; daar komt geen automatisch antwoord op.
+## Wat kost handmatige orderinvoer?
+Dat kunnen jullie zelf uitrekenen met een eenvoudige formule:
+orders per dag × minuten per order × uurkosten × werkdagen per jaar
+Een rekenvoorbeeld, geen klantcase: stel dat er 40 orders per dag binnenkomen en het invoeren 4 minuten per order kost. Dan is dat 160 minuten per dag, ruim 2,5 uur. Bij 220 werkdagen is dat ongeveer 590 uur per jaar. Vermenigvuldig dat met jullie eigen uurkosten en je weet wat overtypen nu kost. Vul jullie eigen aantallen in; die verschillen per bedrijf.
 ## Een voorbeeld
@@ -87,4 +97,6 @@
 ## Veelgestelde vragen
-Werkt dit met ons TMS?
-Als je transportmanagementsysteem een koppeling heeft, meestal wel. Dat checken we eerst.
+Werkt automatische orderinvoer met ons TMS?
+De automatisering draait bovenop jullie bestaande TMS. Welke koppeling mogelijk is, bekijken we in de kansensessie.
+Wat gebeurt er met een order die de AI niet goed kan lezen?
+Die komt bij de planner terecht als uitzondering. Er gaat niets automatisch door zonder controle.
 Kan AI rekening houden met rij- en rusttijden?
```


## 7. Homepage — `/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | AI bouwen en inrichten voor technische bedrijven | Veryo |
| Meta description | ongewijzigd | Veryo bouwt AI-agents, automatiseringen en de AI-werkplek met Claude Team voor technische bedrijven in Noord-Nederland. Plan een kennismaking. |
| H1 | ongewijzigd | AI bouwen en inrichten voor technische bedrijven |

**Tekst (− oud, + nieuw):**

```diff
@@ -205,2 +205,7 @@
 Ja. We zitten in Leeuwarden en komen in Friesland, Groningen en Drenthe op locatie. Online werken we ook voor bedrijven in de rest van Nederland.
+## Veelgevraagd
+[Facturen automatiseren]
+[Claude Team inrichten]
+[AI voor installateurs]
+[AI orderinvoer voor transport]
 ## Begin met de gratis AI-scan
```


## 2. /diensten/ (link Claude Team, anchors) — `/diensten/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | Diensten: AI-agents, automatisering en Claude Team | Veryo |
| Meta description | ongewijzigd | Alle diensten van Veryo: AI-agents, automatiseringen, de AI-werkplek met Claude Team en de administratieve kringloop, bovenop jullie eigen software. |
| H1 | ongewijzigd | Diensten: AI bouwen en inrichten voor technische bedrijven |

**Tekst (− oud, + nieuw):**

```diff
@@ -13,3 +13,3 @@
 Werkvoorbereiding en rapportages opzetten in jullie eigen templates.
-[Meer over de AI-werkplek]
+[Claude Team inrichten]
 ## [De administratieve kringloop]
@@ -26,3 +26,3 @@
 Documenten en eerdere projecten doorzoeken, met de bron erbij.
-[Meer over AI-agents]
+[AI-agents voor bedrijven]
 ## [Automatiseringen]
@@ -32,3 +32,3 @@
 Rapportages en overzichten uit de cijfers die er al zijn.
-[Meer over automatiseringen]
+[AI automatisering voor het mkb]
 ## Ook: Veryo Collega, lokale AI op kantoor
@@ -66,3 +66,3 @@
 [De administratieve kringloop]Van werkbon tot factuur en salaris
-[AI-agents]Digitale collega’s voor terugkerend werk
-[Automatiseringen]Koppelingen tussen jullie software
+[AI-agents voor bedrijven]Digitale collega’s voor terugkerend werk
+[AI automatisering voor het mkb]Koppelingen tussen jullie software
```


## 2. /leeuwarden/ (link Claude Team, anchors) — `/leeuwarden/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | AI-agents en automatisering in Leeuwarden | Veryo |
| Meta description | ongewijzigd | Veryo is gevestigd in Leeuwarden en bouwt AI-agents, automatiseringen en de AI-werkplek met Claude Team voor technische bedrijven in de stad en omgeving. |
| H1 | ongewijzigd | AI-agents en automatisering in Leeuwarden |

**Tekst (− oud, + nieuw):**

```diff
@@ -13,6 +13,6 @@
 ## Wat we bouwen en inrichten in Leeuwarden
-[AI-werkplek met Claude Team]. Bestek lezen, calculatieopzet, uitgangspunten controleren en rapportages, met jullie eigen normen en templates.
+[Claude Team inrichten]. Bestek lezen, calculatieopzet, uitgangspunten controleren en rapportages, met jullie eigen normen en templates.
 [De administratieve kringloop]. Uren en werkbonnen inlezen, inkoopfacturen aan projecten koppelen en de weekafsluiting met conceptfacturen.
-[AI-agents]. Digitale collega’s die aanvragen, meldingen en mail voorbereiden in jullie eigen systemen.
-[Automatiseringen]. Koppelingen tussen de software die jullie al gebruiken. Overstappen is nooit nodig.
+[AI-agents voor bedrijven]. Digitale collega’s die aanvragen, meldingen en mail voorbereiden in jullie eigen systemen.
+[AI automatisering voor het mkb]. Koppelingen tussen de software die jullie al gebruiken. Overstappen is nooit nodig.
 ## Zo werken we in Leeuwarden
```


## 10a. AI implementatie — `/ai-implementatie-mkb/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI implementeren in het mkb: stappenplan | Veryo | AI implementatie in het mkb: van plan tot uitrol | Veryo (56 tekens) |
| Meta description | AI implementeren in 5 stappen: inventarisatie, toolkeuze, pilot, oplevering en uitrol, met afspraken over privacy. Praktisch voor het mkb. | AI implementatie voor het mkb in zeven stappen: inventarisatie, pilot met echte data, het team ermee leren werken en uitrol. Met vaste prijs vooraf. (148 tekens) |
| H1 | AI implementeren in het mkb: praktische begeleiding van plan tot uitrol | AI implementatie in het mkb: begeleiding van plan tot uitrol (60 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-AI implementeren in het mkb is meer dan een tool aanzetten: het is een traject van inventarisatie, prioritering en toolselectie via een pilot naar uitrol en evaluatie. Na de oplevering leren we jullie team ermee werken. Veryo begeleidt dat traject praktisch, bovenop de software die jullie al gebruiken, met aandacht voor privacy, rollen en draagvlak bij collega’s. Jullie krijgen vooraf een gratis offerte met een vaste prijs.
+AI-implementatie in het mkb is meer dan een tool aanzetten: het is een traject van inventarisatie, prioritering en toolselectie via een pilot naar uitrol en evaluatie. Na de oplevering leren we jullie team ermee werken. Veryo begeleidt dat traject praktisch, bovenop de software die jullie al gebruiken, met aandacht voor privacy, rollen en draagvlak bij collega’s. Jullie krijgen vooraf een gratis offerte met een vaste prijs.
 [Plan een kennismaking]
@@ -7,2 +7,3 @@
 Veel ondernemers hebben ChatGPT een keer geprobeerd en zien de mogelijkheden. Maar tussen “dit is handig” en “dit draait elke dag in ons bedrijf” zit een gat. Wie gaat het bouwen? Welke software moet waarop aansluiten? Wat mag wel en niet met klantgegevens? En wat doe je als de collega die ermee begon op vakantie is?
+Zoeken jullie één concrete automatisering in plaats van een invoeringstraject? Kijk dan bij [AI automatisering voor het mkb].
 Daardoor blijft het vaak bij losse experimenten. Iedereen gebruikt het een beetje, niemand weet precies wat het oplevert, en de echte tijdvreters blijven liggen. Een AI-consultant die alleen een rapport schrijft, lost dat niet op. Je hebt een stappenplan nodig, en iemand die het ook inricht en bijhoudt.
@@ -66,2 +67,6 @@
 ## Veelgestelde vragen
+Welk bedrijf helpt met AI implementatie voor het mkb?
+Veryo uit Leeuwarden begeleidt mkb-bedrijven van inventarisatie tot uitrol, in Noord-Nederland op locatie en daarbuiten online. We bouwen bovenop de software die jullie al gebruiken, bouwen geen nieuwe software en verkopen geen licenties.
+Wat kost AI implementatie in het mkb?
+Dat hangt af van het aantal toepassingen, de systemen die gekoppeld moeten worden en hoeveel begeleiding jullie willen. Vaak is het AI-Startpakket de eerste stap. Jullie krijgen vooraf een gratis offerte met een vaste prijs; meer staat hierboven bij “Wat kost een AI-implementatie?”.
 Wat is het verschil tussen een AI-consultant en Veryo?
@@ -86,3 +91,3 @@
 [Het AI-Startpakket]Kansensessie, AI-beleid en één toepassing
-[AI-automatisering voor het MKB]Wat er per onderdeel mogelijk is
+[AI automatisering voor het mkb]Wat er per onderdeel mogelijk is
 [Alle diensten]Wat Veryo bouwt en inricht
```


## 10b. AI-agents — `/ai-agents/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI-agents voor bedrijven: digitale collega’s op maat | Veryo | AI-agents voor bedrijven in Nederland laten bouwen | Veryo (58 tekens) |
| Meta description | Wat doet een AI-agent voor jullie bedrijf? Voorbeelden, het verschil met een chatbot en hoe goedkeuring en rechten geregeld zijn. Bespreek een taak. | AI-agent laten bouwen voor jullie bedrijf? Veryo bouwt AI-agents die terugkerend werk voorbereiden, bovenop jullie software. Een mens keurt goed. (145 tekens) |
| H1 | AI-agents voor bedrijven: digitale collega’s op maat | AI-agents voor bedrijven: digitale collega’s die jullie werk voorbereiden (73 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-Een AI-agent is een digitale collega die een terugkerende taak zelfstandig voorbereidt: hij leest, zoekt informatie op en voert een paar stappen uit in jullie eigen systemen, zoals een conceptmail klaarzetten of een aanvraag compleet maken. Veryo richt AI-agents voor bedrijven in bovenop de software die jullie al gebruiken, met een mens die goedkeurt wat ertoe doet. Jullie krijgen vooraf een gratis offerte met een vaste prijs.
+Veryo bouwt AI-agents voor bedrijven in heel Nederland, vanuit Leeuwarden. Een AI-agent is een digitale collega die een terugkerende taak zelfstandig voorbereidt: hij leest, zoekt informatie op en voert een paar stappen uit in jullie eigen systemen, zoals een conceptmail klaarzetten of een aanvraag compleet maken. Veryo richt AI-agents voor bedrijven in bovenop de software die jullie al gebruiken, met een mens die goedkeurt wat ertoe doet. Jullie krijgen vooraf een gratis offerte met een vaste prijs.
 [Bespreek een taak voor een agent]
@@ -16,5 +16,7 @@
 Nooit zelfstandig: betalingen, afwijzingen, prijsafspraken en andere beslissingen met grote gevolgen.
-## AI-agent, chatbot of workflow: wat is het verschil?
+## Wat is een AI-agent voor bedrijven, en wat is het verschil met een chatbot?
 Een [chatbot] beantwoordt vragen, bijvoorbeeld van klanten op jullie website. Een [workflow] volgt vaste stappen: als er een factuur binnenkomt, gaat hij naar de boekhouding. Een AI-agent combineert die twee: hij begrijpt een vraag of document, kiest de juiste vervolgstap en voert die uit in jullie systemen.
 Zijn de stappen altijd hetzelfde, dan is een workflow goedkoper en eenvoudiger. Een agent loont waar er gelezen, beoordeeld en gezocht moet worden.
+Je hoort daarvoor ook de term agentic AI: AI die niet alleen antwoord geeft, maar zelf stappen zet binnen grenzen die vooraf zijn afgesproken. Bij Veryo zijn die grenzen concreet: wat de agent zelf mag, wat een mens eerst goedkeurt, met welke rechten hij in jullie systemen werkt en een logboek van alles wat hij doet. Hoe dat werkt, staat verderop bij “Goedkeuring, rechten en foutafhandeling”.
+Zoeken jullie een chatbot of WhatsApp-assistent? Kijk dan bij [AI-automatisering op maat].
 ## Toepassingen van AI-agents in het mkb
@@ -86,2 +88,6 @@
 ## Veelgestelde vragen
+Wie bouwt AI-agents voor bedrijven in Nederland?
+Veryo uit Leeuwarden bouwt AI-agents voor mkb-bedrijven, met een proefperiode op echte data en een vaste prijs vooraf. De agent draait bovenop de software die jullie al gebruiken.
+Wat is agentic AI?
+AI die niet alleen antwoord geeft, maar zelf stappen uitvoert: mail lezen, gegevens opzoeken, een concept klaarzetten. Bij Veryo gebeurt dat altijd binnen vaste grenzen, en een mens keurt goed wat belangrijk is.
 Wat is het verschil tussen een agent en een chatbot?
@@ -101,3 +107,3 @@
 ## Verder lezen
-[AI-automatisering voor het MKB]Alles wat er mogelijk is, per afdeling
+[AI automatisering voor het mkb]Alles wat er mogelijk is, per afdeling
 [AI-chatbot laten maken]Vragen beantwoorden op jullie website
```


## 10c. AI automatisering — `/ai-automatisering/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI-automatisering voor bedrijven en het mkb | Veryo | AI automatisering voor het mkb, met voorbeelden | Veryo (55 tekens) |
| Meta description | Welke processen kun je met AI automatiseren? Veryo helpt het mkb met advies, slimme koppelingen en praktische AI-oplossingen. Bespreek jullie proces. | AI automatisering voor het mkb: mail, offertes, facturen en planning automatiseren met de software die jullie al hebben. Met voorbeelden en aanpak. (147 tekens) |
| H1 | AI-automatisering voor bedrijven: maak tijd vrij voor belangrijk werk | AI automatisering voor het mkb: maak tijd vrij voor belangrijk werk (67 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-AI-automatisering voor bedrijven betekent dat terugkerend werk, zoals mail sorteren, offertes voorbereiden, facturen verwerken en planning bijwerken, automatisch gebeurt in de software die jullie al gebruiken. Veryo helpt het mkb met advies, slimme koppelingen en praktische AI-oplossingen. Een mens blijft controleren wat ertoe doet, en jullie krijgen vooraf een gratis offerte met een vaste prijs.
+AI automatisering voor het mkb betekent dat terugkerend werk, zoals mail sorteren, offertes voorbereiden, facturen verwerken en planning bijwerken, automatisch gebeurt in de software die jullie al gebruiken. Veryo helpt het mkb met advies, slimme koppelingen en praktische AI-oplossingen. Een mens blijft controleren wat ertoe doet, en jullie krijgen vooraf een gratis offerte met een vaste prijs.
 [Bespreek jullie proces]
@@ -7,2 +7,3 @@
 Dat werk is niet moeilijk, maar het kost uren en het blijft liggen op drukke dagen. Juist daar is AI-automatisering voor het mkb sterk in: het leest, sorteert, vult in en zet klaar. Een mens controleert en beslist.
+Willen jullie AI breder invoeren in het hele bedrijf? Lees dan over [AI implementatie in het mkb].
 ## Welke bedrijfsprocessen kun je met AI automatiseren?
@@ -16,5 +17,5 @@
 CRM-overdracht: leads, gesprekken en afspraken automatisch vastleggen in jullie CRM.
-## Voorbeelden van AI-automatisering in het mkb
-Drie voorbeelden van hoe dat er in de praktijk uitziet. Het zijn voorbeelden van werkwijzen, geen klantcases: per bedrijf kijken we eerst hoe het werk nu loopt.
-## Voorbeeld 1: inkoopfacturen automatisch verwerken
+## AI automatisering: voorbeelden voor het mkb
+Vijf voorbeelden van hoe dat er in de praktijk uitziet. Het zijn voorbeelden van werkwijzen, geen klantcases: per bedrijf kijken we eerst hoe het werk nu loopt.
+## [Voorbeeld 1: inkoopfacturen automatisch verwerken]
 Probleem: facturen komen binnen in de mailbox en worden met de hand overgetypt in de boekhouding.
@@ -25,3 +26,3 @@
 Randvoorwaarden: het boekhoudpakket heeft een koppeling (API) en er zijn vaste afspraken over kostenplaatsen.
-## Voorbeeld 2: aanvragen sneller beantwoorden
+## [Voorbeeld 2: klantcontact, aanvragen sneller beantwoorden]
 Probleem: aanvragen komen binnen via mail, formulier en WhatsApp en liggen soms dagen op een antwoord te wachten.
@@ -32,3 +33,3 @@
 Randvoorwaarden: duidelijke informatie over aanbod, werkgebied en planning, zodat de AI goede antwoorden kan geven.
-## Voorbeeld 3: van werkbon naar factuur
+## [Voorbeeld 3: werkbonnen verwerken tot factuur]
 Probleem: monteurs leveren werkbonnen op papier of als foto aan, kantoor typt ze over voor de factuur.
@@ -39,2 +40,16 @@
 Randvoorwaarden: werkbonnen bevatten steeds dezelfde basisgegevens, zoals klant, uren en materiaal.
+## [Voorbeeld 4: offertes en calculaties voorbereiden]
+Probleem: elke offerte wordt opnieuw in elkaar gezet uit een aanvraag, een prijslijst en eerdere offertes.
+Workflow: de aanvraag wordt gelezen en er staat een conceptofferte klaar op basis van jullie prijslijst, rekenregels en eerdere offertes.
+Systemen: mail of websiteformulier, en jullie offerte- of calculatiepakket.
+Menselijke controle: prijzen, marges en materiaal worden door de calculator gecontroleerd voordat de offerte de deur uitgaat.
+Verwachte tijdwinst: minder uitzoekwerk per offerte en sneller reageren; hoeveel, rekenen we vooraf uit met jullie aantallen.
+Randvoorwaarden: een actuele prijslijst en vaste rekenregels.
+## [Voorbeeld 5: lead-opvolging]
+Probleem: aanvragen uit advertenties en de website worden pas uren of een dag later teruggebeld.
+Workflow: een nieuwe lead krijgt snel een WhatsApp-bericht of telefoontje, de vaste kwalificatievragen worden gesteld en er wordt een afspraak voorgesteld in jullie agenda.
+Systemen: websiteformulier, Google Ads of Meta, WhatsApp Business en jullie agenda of CRM.
+Menselijke controle: jullie bepalen de vragen en wie de afspraak krijgt; prijsafspraken maakt altijd een mens.
+Verwachte tijdwinst: vooral snelheid: de klant hoort snel iets, ook als jullie op een klus staan.
+Randvoorwaarden: duidelijke afspraken over werkgebied, soorten klussen en beschikbaarheid in de agenda.
 ## Wat er mogelijk is, per onderdeel van jullie bedrijf
@@ -92,3 +107,3 @@
 [AI-agents voor bedrijven]Digitale collega’s die zelf stappen uitvoeren
-[AI implementeren in het mkb]Van inventarisatie tot uitrol
+[AI implementatie in het mkb]Van inventarisatie tot uitrol
 [AI per branche]Voorbeelden uit jullie sector
```


## 10d. AI op maat — `/ai-op-maat/`

| | Oud | Nieuw |
|---|---|---|
| Title | AI op maat: chatbots, agents en assistenten | Veryo | AI-automatisering op maat voor jullie bedrijf | Veryo (53 tekens) |
| Meta description | Een maatwerk AI-oplossing voor je bedrijf: chatbot, WhatsApp-assistent, AI-agent of interne assistent op je eigen kennis. Vraag een gratis offerte aan. | AI-automatisering op maat wanneer geen pakket past: chatbot op eigen kennis, WhatsApp-assistent of interne assistent. Gratis AI-scan, vaste prijs. (146 tekens) |
| H1 | AI op maat | AI-automatisering op maat (25 tekens) |

**Tekst (− oud, + nieuw):**

```diff
@@ -1,2 +1,2 @@
-Veryo bouwt AI op maat voor het MKB als bestaande software tekortschiet: een maatwerk AI-oplossing zoals een chatbot op je eigen kennis, een WhatsApp-assistent, een AI-agent of een interne AI-assistent voor je bedrijf. Je krijgt vooraf een gratis offerte met een vaste prijs.
+AI-automatisering op maat: Veryo bouwt AI op maat voor het mkb als geen pakket past of bestaande software tekortschiet: een maatwerk AI-oplossing zoals een chatbot op je eigen kennis, een WhatsApp-assistent, een AI-agent of een interne AI-assistent voor je bedrijf. Je krijgt vooraf een gratis offerte met een vaste prijs.
 Maatwerk met AI bovenop de tools die jullie al gebruiken, in de cloud of volledig lokaal.
@@ -15,5 +15,5 @@
 [WhatsApp-assistent]Vragen, gegevens en foto’s verzamelen, afspraken plannen
-[AI-agents]Voeren meerdere stappen van een proces zelfstandig uit
+[AI-agents voor bedrijven]Voeren meerdere stappen van een proces zelfstandig uit
 [Interne AI-assistent: Veryo Collega]Lokale AI-assistent op jullie eigen documenten en procedures
-[AI-receptionist voor horeca]Neemt de telefoon aan en noteert reserveringen
+[Veryo Receptie voor zorgpraktijken]Neemt de telefoon op en plant afspraken in
 ## Hoe we een AI-assistent voor je bedrijf bouwen
@@ -49,2 +49,4 @@
 De verbruikskosten van de AI-dienst lopen via je eigen account of via ons onderhoudsabonnement. Voor een MKB-bedrijf zijn die kosten meestal beperkt; we geven vooraf een inschatting.
+Wat kost AI-automatisering op maat?
+Dat hangt af van wat er gebouwd wordt, hoeveel systemen erbij komen en hoeveel onderhoud jullie willen. Jullie krijgen vooraf een gratis offerte met een vaste prijs, plus een inschatting van de verbruikskosten van de AI-dienst. Meer staat hierboven bij de prijzen.
 Hoe lang duurt het bouwen?
@@ -56,3 +58,4 @@
 [AI-chatbot laten maken]Wat het kost en wat je krijgt
-[AI-automatisering]Als een standaardflow volstaat
+[AI automatisering voor het mkb]Als een standaardflow volstaat
+[AI-agents voor bedrijven]Als er zelfstandig stappen gezet moeten worden
 [AI voor makelaars]Inbox, bezichtigingen en teksten
```


## 1a. Administratieve kringloop (link) — `/ai-automatisering/administratie/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | Administratieve kringloop automatiseren | Veryo |
| Meta description | ongewijzigd | Uren en werkbonnen inlezen, inkoopfacturen aan projecten koppelen, weekafsluiting met conceptfacturen en begroot naast werkelijk. Bovenop jullie pakket. |
| H1 | ongewijzigd | De administratieve kringloop automatiseren |

**Tekst (− oud, + nieuw):**

```diff
@@ -4,3 +4,3 @@
 [veryo_werkt_met tools="snelstart,exact-online,moneybird,e-boekhouden,afas,make"]
-Twee onderdelen hebben een eigen uitgewerkte oplossing: [inkoopfacturen automatisch verwerken] en [werkbonnen automatisch verwerken tot factuur].
+Twee onderdelen hebben een eigen uitgewerkte oplossing: [inkoopfacturen automatiseren] en [werkbonnen automatisch verwerken tot factuur].
 ## Het werk is af, maar de administratie loopt achter
```


## 10e. Bedankt (anchor) — `/bedankt/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | Bedankt | Veryo |
| Meta description | ongewijzigd | Bedankt voor je bericht of het invullen van de AI-scan van Veryo. Je rapport staat binnen enkele minuten in je mailbox; we reageren binnen één werkdag. |
| H1 | ongewijzigd | Bedankt |

**Tekst (− oud, + nieuw):**

```diff
@@ -5,3 +5,3 @@
 ## Alvast verder kijken
-[Wat we automatiseren]
+[AI automatisering voor het mkb]
 [Gratis offerte]
```


## 10e. Tools & koppelingen (anchors) — `/tools-koppelingen/`

| | Oud | Nieuw |
|---|---|---|
| Title | ongewijzigd | Tools & koppelingen | Met welke AI werkt Veryo? |
| Meta description | ongewijzigd | Met welke AI werkt Veryo? Claude, ChatGPT, lokale modellen, agents, Make en koppelingen met SnelStart of Exact. Zoek jullie software in het overzicht. |
| H1 | ongewijzigd | Tools & koppelingen |

**Tekst (− oud, + nieuw):**

```diff
@@ -13,4 +13,4 @@
 [AI-werkplek met Claude Team]Claude met jullie eigen normen en templates
-[AI-agents]Taken die zelfstandig worden opgepakt
-[Automatisering]Koppelingen tussen jullie software
+[AI-agents voor bedrijven]Taken die zelfstandig worden opgepakt
+[AI automatisering voor het mkb]Koppelingen tussen jullie software
 [Alle diensten]Wat Veryo bouwt en inricht
```

---

# Kennisbank: vier artikelen (concept)

De update maakt vier kennisartikelen aan als **concept**. Ze staan in wp-admin onder Kennisbank. Publiceer ze één voor één, bijvoorbeeld één per week, niet allemaal op dezelfde dag. Zolang er niets gepubliceerd is, blijft `/kennis/` op noindex.

De artikelen bevatten geen klantcases, cijfers of prijzen: alleen uitleg en werkwijze, met links naar de diensten. Elk artikel heeft een FAQ (met FAQ-schema), een inhoudsopgave, een auteursblok en het blok "Hier helpen we bij".

| Artikel | URL | Title | Linkt naar |
|---|---|---|---|
| Bestek lezen met AI: wat kan wel en wat niet | /kennis/bestek-lezen-met-ai/ | Bestek lezen met AI: wat kan wel en wat niet \| Veryo | Claude Team inrichten |
| Normen, kengetallen en sjablonen klaarzetten voor AI: een checklist | /kennis/normen-kengetallen-sjablonen-klaarzetten/ | Kengetallen en sjablonen klaarzetten voor AI \| Veryo | Claude Team inrichten, veilig AI-gebruik |
| Begroot naast werkelijk per project | /kennis/begroot-versus-werkelijk-per-project/ | Begroot versus werkelijk per project bijhouden \| Veryo | administratieve kringloop, facturen automatiseren |
| Werkbonnen digitaliseren: foto, WhatsApp of formulier? | /kennis/werkbonnen-digitaliseren/ | Werkbonnen digitaliseren: foto, WhatsApp, formulier \| Veryo | werkbonnen verwerken, administratieve kringloop |

**Graag even nalezen:** in "Normen, kengetallen en sjablonen" staat dat je bij normteksten eerst de licentievoorwaarden controleert voordat je de tekst zelf in een AI-tool zet. Dat is bewust voorzichtig geformuleerd. Pas het aan als je daar andere afspraken over hebt (bijvoorbeeld met NEN).
