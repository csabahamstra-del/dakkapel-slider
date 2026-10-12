<?php
/**
 * Vaste producten (Oplossingen): één register voor het overzicht, de detailpagina's,
 * het menu, de homepage en de branchepagina's.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Alle oplossingen, in volgorde van belang. De eerste is het instapproduct.
 *
 * Per oplossing: naam, voor (korte doelgroep), kort (pitch op de kaart), pitch (antwoord
 * bovenaan de detailpagina), probleem, stappen, voorwie, oplevert, faq, placeholder,
 * branches (paden), seo_title, desc, kw.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_products() {
	static $products = null;
	if ( null !== $products ) {
		return $products;
	}
	$products = array(
		'ai-lead-opvolging'             => array(
			'naam'        => __( 'AI lead-opvolging', 'veryo' ),
			'voor'        => __( 'Voor vakbedrijven die adverteren', 'veryo' ),
			'kort'        => __( 'Binnen ongeveer twee minuten na een aanvraag stuurt de AI een WhatsApp of belt hij de lead, stelt de kwalificatievragen en plant direct een inmeting in je agenda.', 'veryo' ),
			'pitch'       => __( 'AI lead-opvolging van Veryo neemt binnen ongeveer twee minuten contact op met elke nieuwe lead: via WhatsApp of telefonisch. De assistent stelt je kwalificatievragen en plant direct een inmeting of afspraak in je agenda. Zo koelt geen enkele lead meer af en haal je meer afspraken uit hetzelfde advertentiebudget. Vanaf €750 per maand, exclusief btw.', 'veryo' ),
			'probleem'    => array(
				__( 'Je betaalt voor elke lead uit Google, Meta of een vergelijkingssite. Maar de aanvraag komt binnen terwijl je op het dak staat, een vloer legt of een kozijn afmontert. Je belt ’s avonds terug, of de volgende dag. Tegen die tijd heeft de klant al met twee andere bedrijven gesproken.', 'veryo' ),
				__( 'Hoe langer een lead wacht, hoe kleiner de kans op een afspraak. Dat is geen kwestie van harder werken: je kunt simpelweg niet altijd direct opnemen. Precies dat deel neemt de AI over.', 'veryo' ),
			),
			'stappen'     => array(
				array( __( 'Er komt een lead binnen', 'veryo' ), __( 'Via je website, een advertentie op Meta of Google, of een platform waar je op adverteert. De gegevens komen automatisch bij de assistent.', 'veryo' ) ),
				array( __( 'Binnen ongeveer twee minuten contact', 'veryo' ), __( 'De assistent stuurt een WhatsApp of belt de lead, stelt zich voor namens jouw bedrijf en maakt duidelijk dat het een digitale assistent is.', 'veryo' ) ),
				array( __( 'Kwalificatievragen', 'veryo' ), __( 'Jouw vragen, in jouw volgorde: wat moet er gebeuren, waar, hoe groot, wanneer, en past het budget. Leads die niet passen, worden netjes afgehandeld.', 'veryo' ) ),
				array( __( 'Afspraak in je agenda', 'veryo' ), __( 'Past de lead, dan plant de assistent direct een inmeting of afspraak in je agenda. Jij krijgt een samenvatting met alle antwoorden, zodat je goed voorbereid langskomt.', 'veryo' ) ),
			),
			'voorwie'     => array(
				__( 'Vakbedrijven die adverteren en leads binnenkrijgen: dakkapellen, vloeren, kozijnen, bouw en installatie', 'veryo' ),
				__( 'Bedrijven waar de eigenaar of het team overdag op locatie werkt en niet direct kan opnemen', 'veryo' ),
				__( 'Bedrijven die al geld uitgeven aan advertenties en daar meer afspraken uit willen halen', 'veryo' ),
			),
			'oplevert'    => array(
				__( 'Geen leads meer die afkoelen: elke aanvraag krijgt binnen minuten een reactie, ook ’s avonds en in het weekend', 'veryo' ),
				__( 'Meer afspraken uit hetzelfde advertentiebudget', 'veryo' ),
				__( 'Alleen gekwalificeerde afspraken in je agenda, met de antwoorden er al bij', 'veryo' ),
				__( 'Minder tijd aan bellen, terugbellen en heen-en-weer appen', 'veryo' ),
			),
			'faq'         => array(
				array( __( 'Weet de klant dat hij met een AI praat?', 'veryo' ), __( 'Ja. De assistent stelt zich voor als digitale assistent van jouw bedrijf. Dat is eerlijk, en de AI Act vraagt het ook. Wil de klant liever een mens spreken, dan krijg jij direct een seintje.', 'veryo' ) ),
				array( __( 'Werkt het met mijn agenda en mijn leadbronnen?', 'veryo' ), __( 'Meestal wel. We koppelen met gangbare agenda’s zoals Google en Outlook, en met formulieren en advertentieplatforms als Meta en Google. In het eerste gesprek checken we wat jij gebruikt.', 'veryo' ) ),
				array( __( 'Mag ik leads zomaar bellen of appen?', 'veryo' ), __( 'Een lead heeft zelf om contact gevraagd; daarop reageren mag. We richten het AVG-proof in: duidelijk wie er contact opneemt, alleen de gegevens die nodig zijn en een verwerkersovereenkomst.', 'veryo' ) ),
				array( __( 'Wat als de lead een vraag stelt die de AI niet kan beantwoorden?', 'veryo' ), __( 'Dan zegt de assistent dat eerlijk en zet hij de vraag door naar jou. Je bepaalt vooraf welke onderwerpen altijd naar een mens gaan, zoals prijzen of klachten.', 'veryo' ) ),
			),
			'placeholder' => __( 'Bijvoorbeeld: we krijgen 40 leads per maand via Meta en bellen vaak pas de volgende dag terug.', 'veryo' ),
			'branches'    => array( 'branches/bouw', 'branches/installatie', 'branches/makelaardij' ),
			'seo_title'   => __( 'AI lead-opvolging: elke lead binnen 2 minuten gebeld | Veryo', 'veryo' ),
			'desc'        => __( 'AI lead-opvolging voor vakbedrijven: binnen ongeveer 2 minuten een WhatsApp of belletje, kwalificatievragen en direct een inmeting in je agenda.', 'veryo' ),
			'kw'          => 'ai lead opvolging',
		),
		'ai-klantrapportage'            => array(
			'naam'        => __( 'AI Klantrapportage', 'veryo' ),
			'voor'        => __( 'Voor beveiligingsbedrijven', 'veryo' ),
			'kort'        => __( 'Dienst- en incidentrapporten worden automatisch verwerkt tot nette maandelijkse PDF-rapportages per opdrachtgever.', 'veryo' ),
			'pitch'       => __( 'AI Klantrapportage verwerkt dienst- en incidentrapporten automatisch tot nette maandelijkse PDF-rapportages per opdrachtgever. De rapporten komen binnen via de mail of uit je eigen systeem; de AI ordent ze, vat samen en zet ze in jouw huisstijl. Dat scheelt uren rapportagewerk per maand en geeft een professionelere uitstraling richting klanten. Vanaf €750 per maand, exclusief btw.', 'veryo' ),
			'probleem'    => array(
				__( 'Elke dienst levert een rapport op, en elk incident een verslag. Aan het eind van de maand wil elke opdrachtgever een overzicht: wat is er gebeurd, hoe vaak, welke rondes zijn gelopen en welke bijzonderheden waren er.', 'veryo' ),
				__( 'Dat overzicht wordt nu vaak met de hand gemaakt: rapporten doorlezen, tellen, knippen en plakken in Word of Excel. Uren werk per opdrachtgever, elke maand opnieuw, terwijl de inhoud er al ligt.', 'veryo' ),
			),
			'stappen'     => array(
				array( __( 'Rapporten verzamelen', 'veryo' ), __( 'Dienst- en incidentrapporten komen binnen via een vast mailadres of uit je eigen planning- of rapportagesysteem.', 'veryo' ) ),
				array( __( 'Lezen en ordenen', 'veryo' ), __( 'De AI leest elk rapport, koppelt het aan de juiste opdrachtgever en locatie en haalt de belangrijke gegevens eruit: tijden, soort melding, opvolging.', 'veryo' ) ),
				array( __( 'Maandrapportage opstellen', 'veryo' ), __( 'Per opdrachtgever komt er een nette PDF in jouw huisstijl: overzicht, aantallen, incidenten met een korte samenvatting en de bijzonderheden van de maand.', 'veryo' ) ),
				array( __( 'Controleren en versturen', 'veryo' ), __( 'Jij of je planner leest de concepten na, past aan waar nodig en verstuurt. Op termijn kan het versturen ook automatisch.', 'veryo' ) ),
			),
			'voorwie'     => array(
				__( 'Beveiligingsbedrijven met meerdere opdrachtgevers en maandelijkse rapportageverplichtingen', 'veryo' ),
				__( 'Bedrijven waar planners of leidinggevenden nu zelf de rapportages in elkaar zetten', 'veryo' ),
				__( 'Ook bruikbaar voor andere dienstverleners met vaste rapportages per klant, zoals schoonmaak en facilitair', 'veryo' ),
			),
			'oplevert'    => array(
				__( 'Uren rapportagewerk per maand bespaard', 'veryo' ),
				__( 'Een professionelere uitstraling richting opdrachtgevers: elke maand dezelfde nette opmaak', 'veryo' ),
				__( 'Rapportages op tijd, ook in drukke maanden', 'veryo' ),
				__( 'Overzicht over incidenten per locatie, waardoor patronen sneller opvallen', 'veryo' ),
			),
			'faq'         => array(
				array( __( 'Werkt het met ons rapportagesysteem?', 'veryo' ), __( 'Komen de rapporten als mail of PDF binnen, dan werkt het altijd. Heeft je systeem een export of koppeling, dan halen we ze daar rechtstreeks uit. Dat bekijken we in het eerste gesprek.', 'veryo' ) ),
				array( __( 'Blijven de gegevens van onze opdrachtgevers veilig?', 'veryo' ), __( 'We werken met zakelijke AI-diensten die je gegevens niet gebruiken om modellen te trainen, sluiten een verwerkersovereenkomst en geven alleen toegang tot wat nodig is.', 'veryo' ) ),
				array( __( 'Kan de AI zelf iets verzinnen in een rapportage?', 'veryo' ), __( 'De rapportage wordt opgebouwd uit jullie eigen rapporten, en een mens leest het concept na voor het de deur uitgaat. Klopt iets niet, dan pas je het aan voor verzending.', 'veryo' ) ),
			),
			'placeholder' => __( 'Bijvoorbeeld: we hebben 25 opdrachtgevers en maken elke maand handmatig de rapportages.', 'veryo' ),
			'branches'    => array( 'branches/beveiliging' ),
			'seo_title'   => __( 'AI Klantrapportage voor beveiligingsbedrijven | Veryo', 'veryo' ),
			'desc'        => __( 'Dienst- en incidentrapporten automatisch verwerkt tot nette maandelijkse PDF-rapportages per opdrachtgever. Voor beveiligers, vanaf €750 per maand.', 'veryo' ),
			'kw'          => 'rapportage beveiligingsbedrijf automatiseren',
		),
		'ai-calculatie-offerte-factuur' => array(
			'naam'        => __( 'AI voor calculatie, offerte en factuur', 'veryo' ),
			'voor'        => __( 'Voor bouw, installatie en techniek', 'veryo' ),
			'kort'        => __( 'Leest bestekken en tekeningen, helpt met de calculatie, maakt de offerte en na afloop de factuur. Bovenop je bestaande pakket.', 'veryo' ),
			'pitch'       => __( 'AI voor calculatie, offerte en factuur leest bestekken en tekeningen, helpt met de calculatie, maakt de offerte en na afloop de factuur. Het werkt bovenop je bestaande offerte- of boekhoudpakket, dus je hoeft niet over te stappen. Offertes in minuten in plaats van uren, en minder kantoorwerk. Vanaf €750 per maand, exclusief btw.', 'veryo' ),
			'probleem'    => array(
				__( 'Een goede offerte kost tijd: het bestek doorlezen, hoeveelheden uit de tekening halen, prijzen opzoeken, de calculatie opbouwen en dan alles netjes in een offerte zetten. Vaak ’s avonds, omdat overdag het werk voorgaat.', 'veryo' ),
				__( 'En als het werk klaar is, begint het opnieuw: meerwerk verzamelen, uren en materialen nalopen en de factuur maken. Dubbel werk, met kans op fouten en te laat factureren.', 'veryo' ),
			),
			'stappen'     => array(
				array( __( 'Aanvraag, bestek of tekening erin', 'veryo' ), __( 'Je zet de aanvraag, het bestek of de tekening klaar. De AI leest het en haalt de werkzaamheden en hoeveelheden eruit.', 'veryo' ) ),
				array( __( 'Calculatie met jouw prijzen', 'veryo' ), __( 'De calculatie wordt opgebouwd met jouw eigen prijzen, uurtarieven en marges uit je bestaande pakket of prijslijst. Jij controleert en past aan.', 'veryo' ) ),
				array( __( 'Offerte in jouw opmaak', 'veryo' ), __( 'Er staat een conceptofferte klaar in je eigen offertepakket of huisstijl, met heldere omschrijvingen. Jij keurt goed en verstuurt.', 'veryo' ) ),
				array( __( 'Na afloop de factuur', 'veryo' ), __( 'Is het werk klaar, dan maakt de AI uit offerte, uren en meerwerk een conceptfactuur in je boekhoudpakket.', 'veryo' ) ),
			),
			'voorwie'     => array(
				__( 'Aannemers, installateurs en technische bedrijven die veel offertes maken', 'veryo' ),
				__( 'Bedrijven waar de eigenaar of één calculator alle offertes doet', 'veryo' ),
				__( 'Bedrijven die al een offerte- of boekhoudpakket hebben en dat willen houden', 'veryo' ),
			),
			'oplevert'    => array(
				__( 'Offertes in minuten in plaats van uren', 'veryo' ),
				__( 'Sneller reageren op aanvragen, dus vaker de opdracht', 'veryo' ),
				__( 'Minder kantoorwerk ’s avonds', 'veryo' ),
				__( 'Sneller en vollediger factureren, inclusief meerwerk', 'veryo' ),
			),
			'faq'         => array(
				array( __( 'Bepaalt de AI zelf mijn prijzen?', 'veryo' ), __( 'Nee. Prijzen, uurtarieven en marges komen uit jouw pakket of prijslijst, met vaste rekenregels. De AI leest en vult in; jij controleert en beslist.', 'veryo' ) ),
				array( __( 'Werkt het met mijn offerte- of boekhoudpakket?', 'veryo' ), __( 'Het werkt bovenop je bestaande pakket. Veel pakketten hebben een koppeling; anders werken we met exports of een eenvoudige tussenlaag. Dat checken we vooraf.', 'veryo' ) ),
				array( __( 'Kan de AI tekeningen lezen?', 'veryo' ), __( 'Tekst in bestekken en duidelijke tekeningen leest hij goed. Bij complexe tekeningen helpt hij met het uittrekken van hoeveelheden, en controleert de calculator het resultaat.', 'veryo' ) ),
			),
			'placeholder' => __( 'Bijvoorbeeld: we maken 30 offertes per maand en elke offerte kost ons twee uur.', 'veryo' ),
			'branches'    => array( 'branches/bouw', 'branches/installatie' ),
			'seo_title'   => __( 'AI voor calculatie, offerte en factuur | Veryo', 'veryo' ),
			'desc'        => __( 'AI die bestekken en tekeningen leest, helpt calculeren, de offerte maakt en na afloop de factuur. Bovenop je eigen pakket, vanaf €750 per maand.', 'veryo' ),
			'kw'          => 'offerte maken met ai',
		),
		'werkbonnen-verwerken'          => array(
			'naam'        => __( 'Werkbonnen verwerken', 'veryo' ),
			'voor'        => __( 'Voor bedrijven met monteurs en buitendienst', 'veryo' ),
			'kort'        => __( 'Ingevulde werkbonnen (foto, PDF of formulier) worden automatisch uitgelezen, gecontroleerd en verwerkt, zodat facturatie direct kan starten.', 'veryo' ),
			'pitch'       => __( 'Met Werkbonnen verwerken van Veryo worden ingevulde werkbonnen automatisch uitgelezen, gecontroleerd en verwerkt in je administratie of planning. Of de bon nu als foto, PDF of formulier binnenkomt. Zo kan facturatie direct starten en hoeft niemand meer over te typen. Vanaf €750 per maand, exclusief btw.', 'veryo' ),
			'probleem'    => array(
				__( 'Monteurs vullen werkbonnen in op papier, in een app of als PDF. Op kantoor typt iemand ze over in de administratie: uren, materialen, bijzonderheden. Bonnen zijn soms onleesbaar of onvolledig, dus wordt er nagebeld.', 'veryo' ),
				__( 'Ondertussen ligt de factuur stil. Hoe langer een bon blijft liggen, hoe later het geld binnenkomt, en hoe groter de kans dat er uren of materialen niet worden gefactureerd.', 'veryo' ),
			),
			'stappen'     => array(
				array( __( 'Werkbon komt binnen', 'veryo' ), __( 'Als foto via WhatsApp of mail, als PDF of via een digitaal formulier. Het formaat dat je monteurs nu al gebruiken.', 'veryo' ) ),
				array( __( 'Automatisch uitgelezen', 'veryo' ), __( 'De AI leest de bon uit: klant, project, uren, materialen en bijzonderheden, ook bij handgeschreven bonnen.', 'veryo' ) ),
				array( __( 'Gecontroleerd', 'veryo' ), __( 'Ontbreken er gegevens of klopt er iets niet, zoals uren zonder project? Dan krijgt de monteur of het kantoor direct een seintje.', 'veryo' ) ),
				array( __( 'Verwerkt en klaar voor de factuur', 'veryo' ), __( 'De gegevens gaan naar je administratie of planning en er staat een conceptfactuur klaar.', 'veryo' ) ),
			),
			'voorwie'     => array(
				__( 'Installateurs, aannemers, onderhoudsbedrijven en agrarische loonwerkers en mechanisatiebedrijven', 'veryo' ),
				__( 'Bedrijven waar iemand op kantoor nu werkbonnen overtypt', 'veryo' ),
				__( 'Bedrijven die sneller willen factureren na het werk', 'veryo' ),
			),
			'oplevert'    => array(
				__( 'Geen overtypwerk meer op kantoor', 'veryo' ),
				__( 'Facturatie start direct na het werk, dus sneller betaald', 'veryo' ),
				__( 'Minder vergeten uren en materialen op de factuur', 'veryo' ),
				__( 'Onvolledige bonnen vallen meteen op, niet pas weken later', 'veryo' ),
			),
			'faq'         => array(
				array( __( 'Kan de AI handgeschreven werkbonnen lezen?', 'veryo' ), __( 'In de meeste gevallen wel, als de foto scherp is. Twijfelt de AI, dan markeert hij het veld zodat iemand op kantoor even meekijkt.', 'veryo' ) ),
				array( __( 'Moeten onze monteurs anders gaan werken?', 'veryo' ), __( 'Nee. We sluiten aan op hoe ze nu werken. Wil je overstappen op een digitale werkbon, dan helpen we daar ook bij.', 'veryo' ) ),
				array( __( 'In welk pakket komen de gegevens?', 'veryo' ), __( 'In je eigen administratie- of planningspakket. Veel pakketten hebben een koppeling; anders werken we met een import.', 'veryo' ) ),
			),
			'placeholder' => __( 'Bijvoorbeeld: onze 8 monteurs leveren elke week zo’n 60 papieren werkbonnen in.', 'veryo' ),
			'branches'    => array( 'branches/installatie', 'branches/bouw', 'branches/agri', 'branches/transport' ),
			'seo_title'   => __( 'Werkbonnen automatisch verwerken met AI | Veryo', 'veryo' ),
			'desc'        => __( 'Werkbonnen als foto, PDF of formulier automatisch uitgelezen, gecontroleerd en verwerkt in je administratie. Direct factureren, vanaf €750 per maand.', 'veryo' ),
			'kw'          => 'werkbonnen automatisch verwerken',
		),
		'inkoopfacturen-automatiseren'  => array(
			'naam'        => __( 'Inkoopfacturen automatiseren', 'veryo' ),
			'voor'        => __( 'Voor elk bedrijf met veel inkoop', 'veryo' ),
			'kort'        => __( 'Inkoopfacturen uit de mail worden automatisch uitgelezen, gecontroleerd, gematcht met inkooporders of werkbonnen en in je boekhouding gezet.', 'veryo' ),
			'pitch'       => __( 'Met Inkoopfacturen automatiseren worden inkoopfacturen die per mail binnenkomen automatisch uitgelezen, gecontroleerd, gematcht met inkooporders of werkbonnen en in je ERP of boekhoudpakket gezet. Je administratie hoeft alleen nog de afwijkingen te bekijken. Vanaf €750 per maand, exclusief btw.', 'veryo' ),
			'probleem'    => array(
				__( 'Tientallen of honderden inkoopfacturen per maand, elk in een andere opmaak. Iemand opent ze, controleert bedragen en aantallen, zoekt de bijbehorende inkooporder of werkbon en boekt ze in.', 'veryo' ),
				__( 'Het is precies, saai en foutgevoelig werk. Een factuur die dubbel wordt betaald of een prijs die niet klopt met de afspraak, valt pas op als het te laat is.', 'veryo' ),
			),
			'stappen'     => array(
				array( __( 'Factuur komt binnen per mail', 'veryo' ), __( 'Leveranciers mailen naar je vaste facturenadres, zoals nu. Er hoeft niets te veranderen.', 'veryo' ) ),
				array( __( 'Uitgelezen en gecontroleerd', 'veryo' ), __( 'De AI leest leverancier, bedragen, regels en btw uit en controleert op dubbele facturen en rekenfouten.', 'veryo' ) ),
				array( __( 'Gematcht', 'veryo' ), __( 'De factuur wordt gekoppeld aan de juiste inkooporder, werkbon of project. Wijken prijzen of aantallen af, dan wordt de factuur gemarkeerd.', 'veryo' ) ),
				array( __( 'Ingeboekt', 'veryo' ), __( 'Klopt alles, dan staat de factuur klaar in je ERP of boekhoudpakket. Jouw administratie keurt goed en bekijkt alleen de uitzonderingen.', 'veryo' ) ),
			),
			'voorwie'     => array(
				__( 'Bedrijven met veel inkoopfacturen: bouw, installatie, agri, transport, horeca en retail', 'veryo' ),
				__( 'Administraties die facturen nu handmatig controleren en inboeken', 'veryo' ),
				__( 'Bedrijven die inkoop willen koppelen aan projecten of werkbonnen', 'veryo' ),
			),
			'oplevert'    => array(
				__( 'Veel minder handmatig inboeken', 'veryo' ),
				__( 'Afwijkingen in prijs of aantal vallen direct op', 'veryo' ),
				__( 'Geen dubbel betaalde facturen meer', 'veryo' ),
				__( 'Inkoopkosten sneller per project in beeld', 'veryo' ),
			),
			'faq'         => array(
				array( __( 'Welke boekhoudpakketten ondersteunen jullie?', 'veryo' ), __( 'Gangbare pakketten zoals Exact, Twinfield, AFAS, Moneybird en e-Boekhouden hebben koppelingen. Gebruik je een ERP, dan bekijken we de koppeling vooraf.', 'veryo' ) ),
				array( __( 'Heeft mijn boekhoudpakket dit niet al?', 'veryo' ), __( 'Veel pakketten lezen facturen uit, maar matchen niet met inkooporders of werkbonnen en controleren niet op afwijkende prijzen. Doet jouw pakket al genoeg, dan zeggen we dat eerlijk.', 'veryo' ) ),
				array( __( 'Wordt er automatisch betaald?', 'veryo' ), __( 'Nee. De AI bereidt voor en controleert; je administratie keurt goed en betaalt.', 'veryo' ) ),
			),
			'placeholder' => __( 'Bijvoorbeeld: we krijgen 300 inkoopfacturen per maand en boeken ze allemaal met de hand in.', 'veryo' ),
			'branches'    => array( 'branches/agri', 'branches/transport', 'branches/horeca-retail', 'branches/zakelijke-dienstverlening', 'branches/beveiliging' ),
			'seo_title'   => __( 'Inkoopfacturen automatiseren met AI | Veryo', 'veryo' ),
			'desc'        => __( 'Inkoopfacturen uit de mail automatisch uitgelezen, gecontroleerd, gematcht met inkooporders of werkbonnen en in je boekhouding gezet. Vanaf €750 per maand.', 'veryo' ),
			'kw'          => 'inkoopfacturen automatiseren',
		),
		'ai-recruitment-assistent'      => array(
			'naam'        => __( 'AI recruitment-assistent', 'veryo' ),
			'voor'        => __( 'Voor bedrijven die veel werven', 'veryo' ),
			'kort'        => __( 'Screent en kwalificeert cv’s, plant sollicitatiegesprekken in en verstuurt de mails naar kandidaten. De beslissing neemt altijd een mens.', 'veryo' ),
			'pitch'       => __( 'De AI recruitment-assistent van Veryo screent en kwalificeert cv’s, plant sollicitatiegesprekken in en verstuurt de mails naar kandidaten. Zo krijgt elke sollicitant snel antwoord en houdt je recruiter tijd over voor de gesprekken. De beslissing over wie wordt aangenomen, neemt altijd een mens. Vanaf €750 per maand, exclusief btw.', 'veryo' ),
			'probleem'    => array(
				__( 'Op een vacature komen tientallen reacties binnen. Elk cv moet worden gelezen, kandidaten willen snel horen waar ze staan en het plannen van gesprekken kost eindeloos heen-en-weer mailen.', 'veryo' ),
				__( 'Goede kandidaten haken af als het te lang duurt. En je recruiters besteden hun tijd aan administratie in plaats van aan de gesprekken die er echt toe doen.', 'veryo' ),
			),
			'stappen'     => array(
				array( __( 'Sollicitatie komt binnen', 'veryo' ), __( 'Via je vacaturesite, een jobboard of de mail. Elke kandidaat krijgt direct een bevestiging.', 'veryo' ) ),
				array( __( 'Screenen op jouw criteria', 'veryo' ), __( 'De AI leest het cv en zet per kandidaat op een rij hoe die scoort op de eisen die jij hebt opgesteld, met een korte onderbouwing.', 'veryo' ) ),
				array( __( 'Recruiter beslist', 'veryo' ), __( 'Je recruiter bekijkt het overzicht en kiest wie er op gesprek komt. De AI selecteert niet zelf en wijst niemand af.', 'veryo' ) ),
				array( __( 'Gesprek gepland, mails verstuurd', 'veryo' ), __( 'De assistent plant de gesprekken in de agenda en verstuurt uitnodigingen, herinneringen en, na de keuze van de recruiter, de afwijzingsmails.', 'veryo' ) ),
			),
			'voorwie'     => array(
				__( 'Werving- en selectiebureaus en uitzendbureaus', 'veryo' ),
				__( 'Bedrijven met veel vacatures of veel reacties per vacature', 'veryo' ),
				__( 'HR-afdelingen die snel willen reageren zonder meer mensen aan te nemen', 'veryo' ),
			),
			'oplevert'    => array(
				__( 'Elke kandidaat krijgt snel antwoord', 'veryo' ),
				__( 'Recruiters besteden hun tijd aan gesprekken in plaats van aan administratie', 'veryo' ),
				__( 'Geen eindeloos heen-en-weer mailen om een gesprek te plannen', 'veryo' ),
				__( 'Een eerlijk, consequent overzicht per kandidaat op basis van jouw criteria', 'veryo' ),
			),
			'faq'         => array(
				array( __( 'Beslist de AI wie er wordt aangenomen?', 'veryo' ), __( 'Nee, nooit. De AI maakt een overzicht en plant in; een mens beslist wie er op gesprek komt en wie wordt aangenomen.', 'veryo' ) ),
				array( __( 'Mag dit onder de AI Act?', 'veryo' ), __( 'AI bij werving en selectie valt onder de AI Act in de categorie hoog risico. Daarom richten we het zo in dat een mens altijd beslist, de criteria vastliggen en kandidaten weten dat er AI wordt gebruikt. We helpen je met de afspraken die daarbij horen; voor juridisch advies verwijzen we naar een jurist.', 'veryo' ) ),
				array( __( 'Hoe voorkom je dat de AI discrimineert?', 'veryo' ), __( 'De AI beoordeelt alleen op de eisen uit de vacature, niet op naam, leeftijd, foto of afkomst. Die gegevens laten we buiten de beoordeling. En de uiteindelijke keuze ligt altijd bij een mens.', 'veryo' ) ),
			),
			'placeholder' => __( 'Bijvoorbeeld: we krijgen 80 reacties per vacature en plannen alle gesprekken met de hand.', 'veryo' ),
			'branches'    => array( 'branches/recruitment', 'branches/beveiliging' ),
			'seo_title'   => __( 'AI recruitment-assistent: cv’s screenen en plannen | Veryo', 'veryo' ),
			'desc'        => __( 'Een AI recruitment-assistent die cv’s screent, gesprekken inplant en kandidaten mailt. De mens beslist altijd wie wordt aangenomen. Vanaf €750 per maand.', 'veryo' ),
			'kw'          => 'ai recruitment assistent',
		),
	);
	return $products;
}

/**
 * Prijsregel voor een oplossing.
 *
 * @return string
 */
function veryo_product_price() {
	return __( 'Vanaf €750 per maand', 'veryo' );
}

/**
 * Kaarten met oplossingen. De eerste (uitgelichte) kaart is groter.
 *
 * @param array<int,string> $keys     Sleutels uit veryo_products(); leeg = alle.
 * @param string            $featured Sleutel die uitgelicht wordt ('' = geen).
 * @return string
 */
function veryo_product_cards( $keys = array(), $featured = 'ai-lead-opvolging' ) {
	$all   = veryo_products();
	$keys  = $keys ? $keys : array_keys( $all );
	$cards = '';
	foreach ( $keys as $key ) {
		if ( ! isset( $all[ $key ] ) ) {
			continue;
		}
		$p      = $all[ $key ];
		$is_big = $key === $featured;
		$steps  = '';
		if ( $is_big ) {
			// Uitgelichte kaart: de stappen in het kort, zodat je in één oogopslag ziet hoe het werkt.
			$steps = veryo_b_list(
				array_map( 'esc_html', wp_list_pluck( $p['stappen'], 0 ) ),
				array(
					'className' => 'veryo-product__steps',
					'ordered'   => true,
				)
			);
		}
		$cards .= veryo_b_group(
			veryo_b_p( esc_html( $p['voor'] ), array( 'className' => 'veryo-product__for' ) )
			. veryo_b_h( '<a href="' . esc_url( veryo_link( 'oplossingen/' . $key ) ) . '">' . esc_html( $p['naam'] ) . '</a>', 3 )
			. veryo_b_p( esc_html( $p['kort'] ) )
			. $steps
			. veryo_b_p( esc_html( veryo_product_price() ) . ' <span>' . esc_html__( 'excl. btw', 'veryo' ) . '</span>', array( 'className' => 'veryo-product__price' ) )
			. veryo_b_p( esc_html__( 'Bekijk hoe het werkt', 'veryo' ), array( 'className' => 'veryo-product__more' ) ),
			array(
				'className' => 'veryo-product' . ( $is_big ? ' is-featured' : '' ),
				'layout'    => false,
			)
		);
	}
	return veryo_b_group(
		$cards,
		array(
			'className' => 'veryo-products__grid has-' . count( $keys ),
			'layout'    => false,
		)
	);
}

/**
 * Sectie met oplossingen (homepage, overzicht, branchepagina's).
 *
 * @param array<int,string> $keys     Sleutels; leeg = alle.
 * @param string            $title    Kop.
 * @param string            $intro    Inleiding.
 * @param bool              $overview Link naar het overzicht tonen.
 * @param string            $featured Uitgelichte sleutel.
 * @return string
 */
function veryo_sec_products( $keys = array(), $title = '', $intro = '', $overview = true, $featured = 'ai-lead-opvolging' ) {
	$title = $title ? $title : __( 'Kant-en-klare AI-oplossingen', 'veryo' );
	$intro = $intro ? $intro : __( 'Vaste oplossingen voor werk dat in veel bedrijven hetzelfde gaat. We richten ze in op jouw systemen en houden ze draaiende, voor een vaste prijs per maand.', 'veryo' );
	$head  = veryo_b_p( $intro );
	if ( $overview ) {
		$head .= veryo_b_buttons( array( array( __( 'Alle oplossingen', 'veryo' ), veryo_link( 'oplossingen' ), 'link' ) ) );
	}
	return veryo_sec_wide( veryo_sec_head( $title, $head ) . veryo_product_cards( $keys, $featured ), 'veryo-products', 'oplossingen' );
}

/**
 * Detailpagina van een oplossing.
 *
 * @param string $key Sleutel uit veryo_products().
 * @return string
 */
function veryo_page_product( $key ) {
	$p   = veryo_products()[ $key ];
	$out = veryo_sec_answer( $p['pitch'] );

	$out .= veryo_sec_text( __( 'Het probleem', 'veryo' ), $p['probleem'] );

	$steps = array();
	foreach ( $p['stappen'] as $step ) {
		$steps[] = '<strong>' . esc_html( $step[0] ) . '</strong><br>' . esc_html( $step[1] );
	}
	$out .= veryo_sec_wide(
		veryo_b_h( __( 'Zo werkt het', 'veryo' ) )
		. veryo_b_list( $steps, array( 'className' => 'is-style-steps' ) ),
		'veryo-steps--home veryo-product-steps'
	);

	$out .= veryo_sec_wide(
		veryo_b_columns(
			array(
				array( 'inner' => veryo_b_h( __( 'Voor wie', 'veryo' ) ) . veryo_b_list( array_map( 'esc_html', $p['voorwie'] ), array( 'className' => 'is-style-checks' ) ) ),
				array( 'inner' => veryo_b_h( __( 'Wat het oplevert', 'veryo' ) ) . veryo_b_list( array_map( 'esc_html', $p['oplevert'] ), array( 'className' => 'is-style-checks' ) ) ),
			)
		),
		'veryo-product-fit'
	);

	$out .= veryo_b_group(
		veryo_b_h( __( 'Wat kost het?', 'veryo' ) )
		. veryo_b_p( '<strong class="veryo-product__big">' . esc_html( veryo_product_price() ) . '</strong> ' . esc_html__( 'exclusief btw', 'veryo' ) )
		. veryo_b_p( esc_html__( 'Wat het voor jou kost, hangt af van het volume en de systemen waarop we aansluiten. Na een kort gesprek krijg je vooraf een vaste prijs. We richten de oplossing in op jouw systemen, testen met echte voorbeelden en houden hem daarna draaiende.', 'veryo' ) )
		. veryo_b_buttons(
			array(
				array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ),
				array( __( 'Neem contact op', 'veryo' ), veryo_link( 'contact' ), 'link' ),
			)
		),
		array( 'className' => 'is-style-soft veryo-price veryo-product-price' )
	);

	$out .= veryo_sec_collega_blok();
	$out .= veryo_sec_contact(
		/* translators: %s: naam van de oplossing. */
		sprintf( __( 'Is %s iets voor jou?', 'veryo' ), $p['naam'] ),
		__( 'Vertel kort hoe het nu bij jullie gaat. Je hoort binnen één werkdag of het past en wat het ongeveer kost.', 'veryo' ),
		$p['placeholder']
	);
	$out .= veryo_sec_faq( $p['faq'] );
	$out .= veryo_sec_cta_scan();

	$links = array();
	foreach ( veryo_products() as $other => $o ) {
		if ( $other !== $key ) {
			$links[] = array( 'oplossingen/' . $other, $o['naam'], $o['voor'] );
		}
	}
	$branches = veryo_branch_labels();
	foreach ( $p['branches'] as $path ) {
		if ( isset( $branches[ $path ] ) ) {
			$links[] = array( $path, $branches[ $path ], __( 'Branche', 'veryo' ) );
		}
	}
	$out .= veryo_sec_links( $links, __( 'Andere oplossingen en branches', 'veryo' ) );
	return $out;
}

/**
 * Namen van de branchepagina's, voor links.
 *
 * @return array<string,string>
 */
function veryo_branch_labels() {
	return array(
		'branches/installatie'               => __( 'AI voor installateurs', 'veryo' ),
		'branches/bouw'                      => __( 'AI in de bouw', 'veryo' ),
		'branches/agri'                      => __( 'AI voor agri en mechanisatie', 'veryo' ),
		'branches/makelaardij'               => __( 'AI voor makelaars', 'veryo' ),
		'branches/zakelijke-dienstverlening' => __( 'AI voor accountants en adviesbureaus', 'veryo' ),
		'branches/horeca-retail'             => __( 'AI voor horeca en retail', 'veryo' ),
		'branches/transport'                 => __( 'AI voor transport en logistiek', 'veryo' ),
		'branches/recruitment'               => __( 'AI voor werving en recruitment', 'veryo' ),
		'branches/beveiliging'               => __( 'AI voor beveiligingsbedrijven', 'veryo' ),
	);
}
