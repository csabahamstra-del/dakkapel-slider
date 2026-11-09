<?php
/**
 * Branchepagina's onder /branches/.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

return array(

	/* ------------------------------------------------------------------------- */
	'branches/installatie'               => array(
		'title'     => __( 'AI voor installateurs en installatiebedrijven', 'veryo' ),
		'seo_title' => __( 'AI voor installateurs en installatiebedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor installateurs: een offerte-generator met calculatietool, digitale werkbon naar factuur en een WhatsApp-assistent voor storingen. Gratis offerte.', 'veryo' ),
		'kw'        => 'ai voor installateurs',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in voor installateurs en installatiebedrijven: een offerte-generator met eigen calculatietool, een digitale werkbon die automatisch een factuur wordt en een WhatsApp-assistent die storingsmeldingen opvangt. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo installatiebedrijven', 'veryo' ), __( 'Monteurs en binnendienst vragen hun eigen kennisbank naar storingscodes, handleidingen en eerdere klussen, op jullie eigen server.', 'veryo' ), __( 'Een praktische AI-workshop voor binnendienst en planners, met offertes en werkbonnen uit jullie eigen praktijk.', 'veryo' ), __( 'Offertes, werkbonnen en storingsmeldingen automatiseren bovenop jullie bestaande pakket.', 'veryo' ) ),
				'problem'  => array(
					'h' => __( 'Herkenbaar voor elk installatiebedrijf', 'veryo' ),
					'p' => array(
						__( 'Er is werk genoeg, maar goede monteurs zijn schaars en de binnendienst zit vol. Offerteaanvragen stapelen zich op omdat calculeren tijd kost. Werkbonnen komen onvolledig terug, dus wordt er te laat of te weinig gefactureerd. En bij elke storing gaat de telefoon, ook ’s avonds.', 'veryo' ),
						__( 'Het vakwerk loopt meestal prima. Het werk eromheen, van aanvraag tot factuur, kost de meeste uren. Daar zit ook de meeste winst voor AI voor installateurs.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'installateur met tablet bij een warmtepomp op locatie', 'veryo' ), __( 'AI voor installateurs: werkbon op de tablet', 'veryo' ), 'installateur' ),
				'products' => array(
					'keys' => array( 'ai-lead-opvolging', 'ai-calculatie-offerte-factuur', 'werkbonnen-verwerken' ),
					'h'    => __( 'Vaste oplossingen voor installateurs', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'De drie automatiseringen die installateurs het meest opleveren', 'veryo' ),
					'intro' => __( 'Plus een paar die er goed bij passen. Tijdwinst is een indicatie voor een team van 5 tot 20 mensen.', 'veryo' ),
					'ids'   => array( 'offerte-generator', 'calculatietool', 'digitale-werkbon', 'werkbon-factuur', 'whatsapp-assistent', 'storingen', 'onderhoudsplanning' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo ziet AI voor installateurs eruit in de praktijk', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: een klant vraagt via de website een offerte aan voor een nieuwe cv-ketel en stuurt foto’s van de ketel en de meterkast mee. De offerte-generator leest de aanvraag, haalt uit de calculatietool de juiste onderdelen, uren en marges, en zet een conceptofferte klaar. De calculator controleert en verstuurt dezelfde dag.', 'veryo' ),
							__( 'Na de installatie spreekt de monteur de werkbon in: wat er is gedaan, welke materialen zijn gebruikt, bijzonderheden. Daar komt een nette werkbon uit die de klant digitaal aftekent, en een conceptfactuur voor de administratie. ’s Avonds meldt een andere klant een storing via WhatsApp. De assistent vraagt naar merk, foutcode en een foto, geeft de standaardtips en plant zo nodig een monteur in.', 'veryo' ),
						),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'training', 'quickwin', 'project', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Werkt dit met ons installatiesoftwarepakket?', 'veryo' ), __( 'Veel pakketten voor installateurs hebben een koppeling. Zo niet, dan werken we met exports of een eenvoudige tussenlaag. Dat checken we in de kansensessie.', 'veryo' ) ),
					array( __( 'Maakt de AI zelf de prijs?', 'veryo' ), __( 'Nee. Prijzen, uurtarieven en marges staan in de calculatietool met vaste rekenregels. AI leest de aanvraag en vult in; de calculator controleert.', 'veryo' ) ),
					array( __( 'Hoeveel tijd scheelt een offerte-generator?', 'veryo' ), __( 'In de catalogus rekenen we met 3 tot 8 uur per week voor een team van 5 tot 20 mensen. Wat het bij jou oplevert, hangt af van het aantal offertes en hoe je nu werkt. De AI-scan maakt een schatting.', 'veryo' ) ),
					array( __( 'Kunnen monteurs de werkbon echt inspreken?', 'veryo' ), __( 'Ja. Ze spreken in de telefoon in wat er is gedaan en maken foto’s. De AI maakt er een gestructureerde werkbon van, die de monteur nog even controleert.', 'veryo' ) ),
					array( __( 'Is een training voor ons team ook mogelijk?', 'veryo' ), __( 'Ja. Vraag een gratis offerte aan.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Installateur? Zie waar jouw uren zitten', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-automatisering/offertes-en-calculaties', __( 'Offertes en calculaties automatiseren', 'veryo' ), __( 'Alles over de offerte-generator', 'veryo' ) ),
					array( 'ai-automatisering/werkprocessen', __( 'Werkprocessen automatiseren', 'veryo' ), __( 'Werkbon, planning en inkoop', 'veryo' ) ),
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent', 'veryo' ), __( 'Voor storingen', 'veryo' ) ),
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Op locatie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/bouw'                      => array(
		'title'     => __( 'AI in de bouw: voor aannemers en bouwbedrijven', 'veryo' ),
		'seo_title' => __( 'AI in de bouw: voor aannemers en bouwbedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'AI in de bouw voor aannemers: materiaalstaat uit het bestek, nacalculatie per project en meerwerk inspreken op de bouwplaats. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai in de bouw',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in de bouw in voor aannemers en bouwbedrijven: een concept-materiaalstaat uit tekening of bestek, nacalculatie die begroot en werkelijk per project naast elkaar zet, en meerwerk dat op de bouwplaats wordt ingesproken. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo bouwbedrijven', 'veryo' ), __( 'Bestekken, eerdere calculaties en projectdossiers op één plek doorzoekbaar, zodat kennis niet bij één calculator blijft.', 'veryo' ), __( 'Een AI-training voor werkvoorbereiding en uitvoering, met bestekken en meerwerk als oefening.', 'veryo' ), __( 'Materiaalstaten, nacalculatie en meerwerk automatiseren in de software die jullie al gebruiken.', 'veryo' ) ),
				'problem'  => array(
					'h' => __( 'Waar een bouwbedrijf geld laat liggen', 'veryo' ),
					'p' => array(
						__( 'In de bouw zit het risico zelden in het vakwerk. Het zit in de calculatie die te krap was, het meerwerk dat nooit is gefactureerd en het project dat verlies draaide zonder dat iemand het doorhad tot de jaarrekening. En in de uren die de werkvoorbereider kwijt is aan het uitpluizen van bestekken.', 'veryo' ),
						__( 'Tegelijk is de uitvoerder druk op de bouwplaats en heeft hij geen zin om ’s avonds formulieren in te vullen. Alles wat niet direct wordt vastgelegd, raakt kwijt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'uitvoerder op een bouwplaats die meerwerk fotografeert met zijn telefoon', 'veryo' ), __( 'AI in de bouw: meerwerk vastleggen op de bouwplaats', 'veryo' ), 'bouw' ),
				'products' => array(
					'keys' => array( 'ai-lead-opvolging', 'ai-calculatie-offerte-factuur', 'werkbonnen-verwerken' ),
					'h'    => __( 'Vaste oplossingen voor aannemers en bouwbedrijven', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat AI in de bouw concreet doet', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen voor aannemers, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'materiaalstaat', 'nacalculatie', 'meerwerk', 'calculatietool', 'urenregistratie', 'inkoop-bestellingen', 'aanbestedingsscan' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Van bestek tot nacalculatie', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: een aannemer met vijftien mensen krijgt een bestek voor een verbouwing. Uit de tekening en het bestek maakt AI een concept-materiaalstaat, die de calculator controleert en aanvult. Dat scheelt vooral het begin, waar nu uren in gaan.', 'veryo' ),
							__( 'Tijdens de bouw spreekt de uitvoerder meerwerk in of maakt hij een foto met een korte toelichting. Daar komt direct een meerwerkregel van, die aan het project wordt gekoppeld. Wekelijks zie je per project begroot tegenover werkelijk, zodat je bijstuurt terwijl het nog kan.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Waar we voorzichtig mee zijn', 'veryo' ),
						'p' => array( __( 'Een materiaalstaat uit een tekening is een concept, geen eindproduct. Tekeningen zijn soms onduidelijk en AI mist dan dingen of telt dubbel. Daarom blijft de calculator verantwoordelijk. De winst zit in het starten met een goede eerste versie in plaats van een leeg rekenblad.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Kan AI een bestek lezen?', 'veryo' ), __( 'AI kan bestekken en tekeningen lezen en er een concept-materiaalstaat of samenvatting van maken. De kwaliteit hangt af van de stukken; een calculator controleert altijd.', 'veryo' ) ),
					array( __( 'Werkt dit met ons calculatiepakket?', 'veryo' ), __( 'Vaak via een export of koppeling. We kijken in de kansensessie wat er met jouw pakket kan.', 'veryo' ) ),
					array( __( 'Hoe helpt AI bij nacalculatie?', 'veryo' ), __( 'Door uren, materialen en meerwerk automatisch per project te verzamelen en naast de begroting te zetten. AI schrijft erbij wat opvalt, de cijfers komen rechtstreeks uit je systemen.', 'veryo' ) ),
					array( __( 'Kunnen uitvoerders dit zonder training?', 'veryo' ), __( 'Inspreken en fotograferen kan iedereen. We geven een korte uitleg op de bouwplaats of in de keet, en kiezen tools die op de telefoon werken.', 'veryo' ) ),
					array( __( 'Kan AI aanbestedingen zoeken?', 'veryo' ), __( 'Ja, een aanbestedingsscan vindt passende aanbestedingen en vat de eisen samen. Of je inschrijft, beslis je zelf.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Aannemer? Doe de gratis AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-automatisering/offertes-en-calculaties', __( 'Calculaties automatiseren', 'veryo' ), __( 'Materiaalstaat en calculatietool', 'veryo' ) ),
					array( 'ai-automatisering/rapportages', __( 'Rapportages automatiseren', 'veryo' ), __( 'Rendement per project', 'veryo' ) ),
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Voor installatiebedrijven', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Op locatie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/agri'                      => array(
		'title'     => __( 'Agrarische automatisering met AI', 'veryo' ),
		'seo_title' => __( 'Agrarische automatisering: AI voor agri en mechanisatie | Veryo', 'veryo' ),
		'desc'      => __( 'Agrarische automatisering met AI: onderhoud en keuringen plannen, onderdelen bestellen en kennis vastleggen, voor loonwerk en mechanisatie. Plan een kennismaking.', 'veryo' ),
		'kw'        => 'ai in de landbouw',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Agrarische automatisering met AI: Veryo zet AI in de landbouw en mechanisatie in waar het kantoorwerk zit. Onderhoud en keuringen van machines automatisch plannen, onderdelen en inkoop regelen, en de kennis van ervaren monteurs vastleggen. Voor loonbedrijven, mechanisatiebedrijven en machinehandel. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo agrarische bedrijven', 'veryo' ), __( 'De kennis van ervaren monteurs en de handleidingen van machines doorzoekbaar voor het hele team, ook in drukke seizoenen.', 'veryo' ), __( 'Een AI-workshop op locatie, met voorbeelden uit loonwerk, mechanisatie en machinehandel.', 'veryo' ), __( 'Onderhoud, keuringen en onderdelenbestellingen automatisch plannen bovenop jullie administratie.', 'veryo' ) ),
				'problem'  => array(
					'h' => __( 'Het seizoen wacht niet op de administratie', 'veryo' ),
					'p' => array(
						__( 'In het seizoen draait alles om het werk op het land. Machines moeten het doen, onderdelen moeten op voorraad zijn en klanten willen weten wanneer de loonwerker komt. De onderhoudsplanning staat in een schrift of in het hoofd van de werkplaatschef, en de keuringsdata van klantmachines in een Excel die niemand bijhoudt.', 'veryo' ),
						__( 'Buiten het seizoen komt de administratie. Maar dan is het vaak te laat: een gemiste keuring, een onderdeel dat net niet op tijd binnen is, een klant die naar een ander is gegaan.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'monteur in de werkplaats van een mechanisatiebedrijf bij een trekker', 'veryo' ), __( 'AI in de landbouw: onderhoud in de werkplaats plannen', 'veryo' ), 'agri' ),
				'products' => array(
					'keys' => array( 'werkbonnen-verwerken', 'inkoopfacturen-automatiseren' ),
					'h'    => __( 'Vaste oplossingen voor agri en mechanisatie', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat AI in de landbouw en mechanisatie oplevert', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'onderhoudsplanning', 'inkoop-bestellingen', 'voorraad', 'upsell-signalen', 'urenregistratie', 'technische-documentatie' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Een voorbeeld uit de mechanisatie', 'veryo' ),
						'p' => array(
							__( 'Een mechanisatiebedrijf onderhoudt machines van tweehonderd klanten. Alle machines met de datum van de laatste beurt of keuring komen in één lijst. Zes weken voor de volgende datum krijgt de klant automatisch een bericht met een voorstel voor een afspraak. Zodra de afspraak staat, wordt gecheckt of de onderdelen op voorraad zijn en zo niet, staat de bestelling klaar.', 'veryo' ),
							__( 'Klanten met een machine die bijna uit de garantie of het onderhoudscontract loopt, worden gesignaleerd, zodat de verkoper op tijd kan bellen.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Nuchter over AI op het land', 'veryo' ),
						'p' => array( __( 'Er wordt veel geschreven over AI in precisielandbouw, drones en sensoren. Dat is een ander vak. Wij richten ons op het kantoor- en werkplaatswerk van agrarische bedrijven en mechanisatiebedrijven, waar met bestaande tools direct tijd te winnen is.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project' ) ),
				'faq'      => array(
					array( __( 'Werkt dit ook voor een klein loonbedrijf?', 'veryo' ), __( 'Ja. Juist bij een klein bedrijf, waar de eigenaar ook de planning en administratie doet, kan één goede automatisering veel schelen.', 'veryo' ) ),
					array( __( 'Kan het koppelen met ons dealersysteem?', 'veryo' ), __( 'Als het systeem een koppeling of export heeft, meestal wel. Anders beginnen we met een gedeelde lijst die later kan worden gekoppeld.', 'veryo' ) ),
					array( __( 'Hoe weet het systeem wanneer een keuring nodig is?', 'veryo' ), __( 'Op basis van de datum van de laatste keuring of beurt en de termijn die jij opgeeft per type machine. Die regels leggen we samen vast.', 'veryo' ) ),
					array( __( 'Kunnen klanten ook via WhatsApp een afspraak maken?', 'veryo' ), __( 'Ja, dat kan gecombineerd worden met een WhatsApp-assistent.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Agrarisch bedrijf? Doe de AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-automatisering/werkprocessen', __( 'Werkprocessen automatiseren', 'veryo' ), __( 'Onderhoud en inkoop', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training voor je team', 'veryo' ), __( 'Op locatie, met voorbeelden uit de agri', 'veryo' ) ),
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Voor de Friese agri', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Voor de Drentse agri', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/makelaardij'               => array(
		'title'     => __( 'AI voor makelaars', 'veryo' ),
		'seo_title' => __( 'AI voor makelaars: inbox, bezichtigingen, teksten | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor makelaars: één AI-inbox voor WhatsApp, telefoon en webformulieren, bezichtigingen automatisch inplannen en woningteksten in je eigen toon.', 'veryo' ),
		'kw'        => 'ai voor makelaars',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in voor makelaars: één AI-inbox waarin berichten uit WhatsApp, telefoon en webformulieren samenkomen met een conceptantwoord, bezichtigingen die automatisch worden ingepland, en woningteksten in de toon van je kantoor. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo makelaarskantoren', 'veryo' ), __( 'Woningdossiers, procedures en eerdere vragen van klanten doorzoekbaar voor het hele kantoor, zonder dat gegevens naar de cloud gaan.', 'veryo' ), __( 'Een AI-training voor het kantoor: mails, woningteksten en verslagen sneller en veilig.', 'veryo' ), __( 'De inbox, bezichtigingen en statusberichten automatiseren bovenop jullie makelaarssoftware.', 'veryo' ) ),
				'extra'    => array( __( 'Waar een makelaarskantoor begint', 'veryo' ), array( __( 'De meeste kantoren beginnen met de AI-inbox, omdat daar direct zichtbaar wordt hoeveel reacties er binnenkomen en hoe snel ze worden beantwoord. Daarna volgen de woningteksten en het inplannen van bezichtigingen. Een kantoor met twee of drie makelaars merkt vooral rust in de week na een nieuwe woning: de reacties zijn beantwoord, de bezichtigingen staan en niemand heeft ’s avonds nog zitten plannen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Vijf kanalen, één makelaar', 'veryo' ),
					'p' => array(
						__( 'Een nieuwe woning staat online en binnen een uur komen de reacties binnen. Via Funda, de website, WhatsApp, de telefoon en de mail. Iedereen wil een bezichtiging, liefst dit weekend. Ondertussen moet de volgende woning nog worden opgenomen en moet er een tekst voor worden geschreven.', 'veryo' ),
						__( 'Het gevolg: reacties blijven liggen, geïnteresseerden haken af en de makelaar is ’s avonds bezig met het plannen van bezichtigingen in plaats van met zijn klanten.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'makelaar bij een woning met een tablet en de agenda voor bezichtigingen', 'veryo' ), __( 'AI voor makelaars: bezichtigingen plannen', 'veryo' ), 'woning' ),
				'products' => array(
					'keys' => array( 'ai-lead-opvolging' ),
					'h'    => __( 'Vaste oplossing voor makelaars', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat AI voor makelaars concreet doet', 'veryo' ),
					'intro' => __( 'Samen vormen deze bouwstenen de AI-inbox voor je kantoor.', 'veryo' ),
					'ids'   => array( 'lead-invoer', 'mail-concepten', 'whatsapp-assistent', 'voicebot', 'statusberichten' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo werkt de AI-inbox', 'veryo' ),
						'p' => array(
							__( 'Alle reacties op een woning komen in één overzicht, ongeacht het kanaal. Bij elke reactie staat een conceptantwoord klaar met de juiste informatie over de woning en de beschikbare bezichtigingsmomenten. Geïnteresseerden kunnen via WhatsApp zelf een moment kiezen; de afspraak komt direct in de agenda van de makelaar.', 'veryo' ),
							__( 'Voor de woningteksten levert de makelaar zijn notities en foto’s van de opname aan. AI schrijft een concepttekst in de toon van het kantoor, die de makelaar controleert en aanvult. Kenmerken en maten komen uit de opname, niet uit de fantasie van een AI-model.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Wat de makelaar blijft doen', 'veryo' ),
						'list'  => array(
							__( 'Onderhandelen en adviseren: dat is het vak.', 'veryo' ),
							__( 'Woningteksten controleren op juistheid, voordat ze online gaan.', 'veryo' ),
							__( 'Beslissen wie er wordt uitgenodigd bij veel belangstelling.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Werkt het met ons makelaarspakket?', 'veryo' ), __( 'Veel makelaarspakketten hebben een koppeling. In de kansensessie kijken we wat er met jouw pakket kan.', 'veryo' ) ),
					array( __( 'Kan AI woningteksten schrijven?', 'veryo' ), __( 'AI schrijft goede concepten op basis van jouw notities en foto’s. De makelaar controleert, want een fout in de tekst kan gevolgen hebben.', 'veryo' ) ),
					array( __( 'Hoe zit het met de privacy van geïnteresseerden?', 'veryo' ), __( 'We verwerken alleen de gegevens die nodig zijn, met een verwerkersovereenkomst en zakelijke API’s, en vermelden dit in je privacyverklaring.', 'veryo' ) ),
					array( __( 'Kunnen we ook buiten kantoortijd bereikbaar zijn?', 'veryo' ), __( 'Ja. De WhatsApp-assistent beantwoordt vragen en plant bezichtigingen, ook ’s avonds en in het weekend.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Makelaar? Zie wat een AI-inbox je oplevert', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-automatisering/klantcontact', __( 'Klantcontact automatiseren', 'veryo' ), __( 'Mail en WhatsApp', 'veryo' ) ),
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent', 'veryo' ), __( 'Bezichtigingen plannen', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Voor makelaars in stad en ommeland', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/zakelijke-dienstverlening' => array(
		'title'     => __( 'AI voor accountants en adviesbureaus', 'veryo' ),
		'seo_title' => __( 'AI voor accountants en adviesbureaus | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor accountants en adviesbureaus: gespreksverslagen met actiepunten, documenten samenvatten en een interne AI-assistent op je kennis. Gratis offerte.', 'veryo' ),
		'kw'        => 'ai voor accountants',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in voor accountants, administratiekantoren en adviesbureaus: gespreksverslagen met actiepunten die automatisch in je CRM komen, documenten samenvatten als voorbereiding en een interne AI-assistent op jullie eigen kennis. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo accountants en adviesbureaus', 'veryo' ), __( 'Dossiers, procedures en vakkennis doorzoekbaar via een lokale AI-assistent, zodat vertrouwelijke klantgegevens binnen blijven.', 'veryo' ), __( 'AI-training en AI-geletterdheid voor het hele kantoor, zoals de AI Act vraagt.', 'veryo' ), __( 'Gespreksverslagen, samenvattingen en documentstromen automatiseren bovenop jullie software.', 'veryo' ) ),
				'problem'  => array(
					'h' => __( 'Kenniswerk dat verzandt in typewerk', 'veryo' ),
					'p' => array(
						__( 'Een adviseur of accountant verdient zijn geld met kennis en advies. Toch gaat een groot deel van de dag op aan verslagen uittypen, mails beantwoorden, documenten doorlezen om te zien wat er echt in staat, en zoeken naar hoe het kantoor iets de vorige keer heeft aangepakt.', 'veryo' ),
						__( 'Tegelijk is de druk op tarieven en capaciteit hoog. Elk uur dat niet declarabel is, kost geld.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'adviseur in gesprek met een klant aan tafel, met een laptop die meeluistert', 'veryo' ), __( 'AI voor accountants: gespreksverslag automatisch', 'veryo' ), 'overleg' ),
				'products' => array(
					'keys' => array( 'inkoopfacturen-automatiseren' ),
					'h'    => __( 'Vaste oplossing voor accountants en adviesbureaus', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat AI voor accountants en adviesbureaus doet', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen voor kennisbedrijven, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'gespreksverslagen', 'documenten-samenvatten', 'interne-assistent', 'mail-concepten', 'archiveren', 'presentaties', 'prospect-briefing' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Een werkdag met AI op kantoor', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: na een klantgesprek staat er binnen een paar minuten een verslag klaar met de besproken punten en de actiepunten, direct gekoppeld aan het klantdossier. De adviseur leest het na in plaats van het uit te typen. Een jaarstuk of contract dat binnenkomt, wordt samengevat met de punten waar je op moet letten, als voorbereiding op de beoordeling.', 'veryo' ),
							__( 'Een nieuwe medewerker vraagt aan de interne assistent hoe het kantoor een bepaald type dossier aanpakt en krijgt het antwoord uit de eigen werkinstructies, met een verwijzing.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Vertrouwelijkheid voorop', 'veryo' ),
						'list'  => array(
							__( 'Zakelijke API’s waarbij gegevens niet worden gebruikt om modellen te trainen.', 'veryo' ),
							__( 'Een verwerkersovereenkomst en afspraken over waar gegevens worden verwerkt.', 'veryo' ),
							__( 'Samenvattingen zijn voorbereiding; het professionele oordeel blijft bij de adviseur.', 'veryo' ),
							__( 'Klanten worden geïnformeerd als er AI meeluistert bij een gesprek.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'training', 'quickwin', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Mag je klantgesprekken door AI laten samenvatten?', 'veryo' ), __( 'Met toestemming van de klant en goede afspraken over de verwerking wel. We helpen je dat zorgvuldig in te richten; laat de juridische kant controleren binnen je eigen beroepsregels.', 'veryo' ) ),
					array( __( 'Vervangt AI het oordeel van de accountant?', 'veryo' ), __( 'Nee. AI vat samen, markeert en zet klaar. Het oordeel en de verantwoordelijkheid blijven bij de professional.', 'veryo' ) ),
					array( __( 'Werkt het met ons praktijkmanagementsysteem?', 'veryo' ), __( 'Als het systeem een koppeling heeft, meestal wel. Anders gaan verslagen naar de mail of een gedeelde map.', 'veryo' ) ),
					array( __( 'Is een AI-training voor ons kantoor zinvol?', 'veryo' ), __( 'Vaak de beste eerste stap. Het team leert veilig werken met AI en je werkt aan de AI-geletterdheid die de AI Act vraagt.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Kantoor vol kenniswerk? Doe de AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( veryo_collega()['slug'], __( 'Veryo Collega', 'veryo' ), __( 'Lokale AI-assistent op jullie eigen kennis', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training', 'veryo' ), __( 'Voor het hele kantoor', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Zakelijke dienstverlening', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/horeca-retail'             => array(
		'title'     => __( 'AI voor horeca en retail', 'veryo' ),
		'seo_title' => __( 'AI voor horeca en retail: telefoon, reserveringen, team | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor horeca en retail: een AI-telefoonassistent voor reserveringen, een AI-training voor je team en kennis die niet verdwijnt. Plan een kennismaking.', 'veryo' ),
		'kw'        => 'ai voor horeca',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'AI voor horeca en retail begint bij de telefoon en het team. Veryo zet een AI-telefoonassistent in die opneemt als het druk is en reserveringen noteert, traint het team in het werken met AI en legt kennis vast die nu in een paar hoofden zit. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo horeca en retail', 'veryo' ), __( 'Recepten, procedures en afspraken doorzoekbaar voor het hele team, handig bij het inwerken van nieuwe medewerkers.', 'veryo' ), __( 'Een korte AI-workshop voor eigenaar en team, gericht op het werk dat elke week terugkomt.', 'veryo' ), __( 'Een AI-telefoonassistent voor reserveringen en vragen, en reviewreacties ter goedkeuring.', 'veryo' ) ),
				'extra'    => array( __( 'Waar je begint', 'veryo' ), array( __( 'De meeste horecazaken beginnen met een korte AI-workshop voor het team en een telling van de gemiste telefoontjes. Blijkt dat er veel gesprekken blijven liggen, dan is een AI-telefoonassistent de logische volgende stap. Reviews beantwoorden met AI kan ook, altijd met jouw akkoord.', 'veryo' ), __( 'Voor winkels met een webshop is een chatbot op de website een logische volgende stap: vragen over levertijden, retouren en voorraad komen daar veel voor en zijn goed te beantwoorden uit je eigen informatie.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Gastvrij zijn kost al je aandacht', 'veryo' ),
					'p' => array(
						__( 'In de horeca en de winkel draait alles om de gast of klant die voor je staat. Maar ondertussen gaat de telefoon precies als het het drukst is, moeten nieuwe medewerkers worden ingewerkt en moeten er reviews worden beantwoord.', 'veryo' ),
						__( 'Dat werk schiet er als eerste bij in. Een negatieve review blijft onbeantwoord, de laatste post is van drie maanden geleden en een gast die wilde reserveren, belt het restaurant verderop.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'eigenaar van een lunchroom die achter de bar op haar telefoon reviews bekijkt', 'veryo' ), __( 'AI voor horeca: reviews beantwoorden', 'veryo' ), 'horeca' ),
				'products' => array(
					'keys' => array( 'inkoopfacturen-automatiseren' ),
					'h'    => __( 'Vaste oplossing voor horeca en retail', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat AI voor horeca en retail doet', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'voicebot', 'website-chatbot', 'reviews', 'klanttevredenheid' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo ziet het eruit', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: een restaurant stuurt na elke reservering de volgende dag automatisch een vriendelijk reviewverzoek. Nieuwe reviews krijgen een conceptreactie in de toon van het restaurant, die de eigenaar met één klik goedkeurt. Elke maandag staan de posts voor de week klaar op basis van de foto’s die het team maakt.', 'veryo' ),
							__( 'Een winkel gebruikt dezelfde bouwstenen, aangevuld met een chatbot op de website die vragen over openingstijden, voorraad en retouren beantwoordt.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Eerlijk over reviews', 'veryo' ),
						'p' => array( __( 'We helpen je om meer echte reviews te krijgen en er goed op te reageren. We schrijven geen nepreviews en filteren geen negatieve reviews weg. Een nette reactie op kritiek doet vaak meer voor je naam dan een extra vijf sterren.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Worden reacties op reviews automatisch geplaatst?', 'veryo' ), __( 'Alleen na jouw akkoord. De reactie staat klaar, jij keurt goed. Bij kritische reviews raden we altijd aan om zelf even mee te lezen.', 'veryo' ) ),
					array( __( 'Werkt het met ons reserveringssysteem?', 'veryo' ), __( 'Veel reserveringssystemen hebben een koppeling. Dat checken we vooraf.', 'veryo' ) ),
					array( __( 'Wat kost een AI-receptionist voor een restaurant?', 'veryo' ), __( 'Je krijgt vooraf een gratis offerte met een vaste prijs, plus een inschatting van de verbruikskosten per gespreksminuut. Op de pagina over de AI-receptionist lees je meer.', 'veryo' ) ),
					array( __( 'Kunnen de posts in onze eigen stijl?', 'veryo' ), __( 'Ja. We beginnen met jullie toon en een paar voorbeelden, en stellen bij tot het klinkt zoals jullie praten.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Horeca of winkel? Zie wat AI je oplevert', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-op-maat/ai-receptionist-horeca', __( 'AI-receptionist voor restaurants', 'veryo' ), __( 'Telefoon en reserveringen', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training voor je team', 'veryo' ), __( 'Praktisch, op locatie', 'veryo' ) ),
					array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Voor de binnenstad', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/transport'                 => array(
		'title'     => __( 'AI voor transport en logistiek', 'veryo' ),
		'seo_title' => __( 'AI voor transport en logistiek | Veryo', 'veryo' ),
		'desc'      => __( 'AI in de logistiek: een planningsassistent, automatische statusberichten voor klanten en vrachtdocumenten archiveren. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai in de logistiek',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in de logistiek in voor transportbedrijven: een planningsassistent die ritten voorstelt, automatische statusberichten zodat klanten niet hoeven te bellen, en vrachtdocumenten die vanzelf worden benoemd en gearchiveerd. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo transportbedrijven', 'veryo' ), __( 'Afspraken met klanten, routes en procedures doorzoekbaar voor planners, zodat niet alles via één persoon loopt.', 'veryo' ), __( 'Een AI-training voor planning en binnendienst, met praktijkvoorbeelden uit de logistiek.', 'veryo' ), __( 'Statusberichten, planning en vrachtdocumenten automatiseren bovenop jullie TMS of planningspakket.', 'veryo' ) ),
				'extra'    => array( __( 'Waar je begint in transport', 'veryo' ), array( __( 'Statusberichten zijn meestal de beste eerste stap: ze zijn goed af te bakenen, klanten merken het direct en het scheelt de planning telefoontjes. Daarna volgt het archiveren van documenten, omdat dat elke dag terugkomt en foutgevoelig is.', 'veryo' ), __( 'De planningsassistent is een grotere stap. Die zetten we pas op als de basisgegevens op orde zijn en de planner weet welke regels hij in zijn hoofd gebruikt. Vaak helpt het al om die regels eerst samen op papier te zetten.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Planning, bellen en papier', 'veryo' ),
					'p' => array(
						__( 'In transport en logistiek loopt de planning zelden zoals gepland. Een chauffeur valt uit, een klant wil een extra rit, een lading is later klaar. De planner past aan, belt chauffeurs en klanten, en houdt het overzicht in zijn hoofd.', 'veryo' ),
						__( 'Ondertussen bellen klanten om te vragen waar hun zending is, en stapelen de vrachtbrieven, CMR’s en afleverbonnen zich op. Allemaal werk dat nodig is, maar niet het werk waar je het verschil mee maakt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'planner op een transportkantoor met een planbord en twee schermen', 'veryo' ), __( 'AI in de logistiek: planningsassistent voor de planner', 'veryo' ), 'logistiek' ),
				'products' => array(
					'keys' => array( 'inkoopfacturen-automatiseren', 'werkbonnen-verwerken' ),
					'h'    => __( 'Vaste oplossingen voor transport en logistiek', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat AI in de logistiek concreet doet', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'planningsassistent', 'statusberichten', 'archiveren', 'vertalen', 'overdracht', 'whatsapp-sollicitatie', 'dashboard' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Een voorbeeld', 'veryo' ),
						'p' => array(
							__( 'Een transportbedrijf met twintig wagens kan de planningsassistent een eerste voorstel laten maken op basis van orders, beschikbare chauffeurs en rijtijden. De planner past aan en zet door. Zodra een zending is geladen of afgeleverd, krijgt de klant automatisch bericht. Afleverbonnen die chauffeurs fotograferen, worden uitgelezen, benoemd en bij de juiste order gearchiveerd.', 'veryo' ),
							__( 'Voor chauffeurs die Pools, Duits of Engels spreken, worden instructies en berichten automatisch vertaald.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Waar we eerlijk over zijn', 'veryo' ),
						'p' => array( __( 'Een planningsassistent is maatwerk en werkt alleen met goede basisgegevens: actuele beschikbaarheid, vaste regels en een systeem met een koppeling. Rijtijden en veiligheid blijven de verantwoordelijkheid van de planner. De assistent stelt voor, de planner beslist.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Werkt dit met ons TMS?', 'veryo' ), __( 'Als je transportmanagementsysteem een koppeling heeft, meestal wel. Dat checken we eerst.', 'veryo' ) ),
					array( __( 'Kan AI rekening houden met rij- en rusttijden?', 'veryo' ), __( 'De regels kunnen worden meegenomen in de voorstellen, maar de planner blijft verantwoordelijk en controleert.', 'veryo' ) ),
					array( __( 'Hoe krijgen klanten statusberichten?', 'veryo' ), __( 'Per mail, sms of WhatsApp, afhankelijk van wat jouw klanten willen. De berichten gaan uit op basis van de status in je systeem.', 'veryo' ) ),
					array( __( 'Kunnen jullie ook helpen chauffeurs te werven?', 'veryo' ), __( 'Ja, solliciteren via WhatsApp werkt goed voor chauffeurs. Zie de pagina over werving.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Transportbedrijf? Doe de AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-agents', __( 'AI-agents voor bedrijven', 'veryo' ), __( 'Planningsagent', 'veryo' ) ),
					array( 'branches/recruitment', __( 'Werving via WhatsApp', 'veryo' ), __( 'Chauffeurs werven', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Logistiek in het noorden', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/recruitment'               => array(
		'title'     => __( 'Werving via WhatsApp en AI', 'veryo' ),
		'seo_title' => __( 'Werving via WhatsApp en AI | Veryo', 'veryo' ),
		'desc'      => __( 'WhatsApp-werving met AI: solliciteren via WhatsApp zonder cv, vacatureteksten voor vakmensen en automatische kandidaatopvolging. Voor werkgevers.', 'veryo' ),
		'kw'        => 'whatsapp werving',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet WhatsApp-werving met AI op voor werkgevers en recruitmentbureaus: kandidaten solliciteren via WhatsApp zonder cv, vacatureteksten worden geschreven in de taal van vakmensen, en elke kandidaat krijgt automatisch bericht. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo werving en recruitment', 'veryo' ), __( 'Kennis over functies, vacatures en kandidaten veilig doorzoekbaar, zonder cv’s naar een externe AI-dienst te sturen.', 'veryo' ), __( 'Een AI-training voor recruiters: vacatureteksten, opvolging en AI-geletterdheid.', 'veryo' ), __( 'Solliciteren via WhatsApp, voorselectie en opvolging automatiseren bovenop jullie ATS.', 'veryo' ) ),
				'extra'    => array( __( 'Voor wie het werkt', 'veryo' ), array( __( 'WhatsApp-werving werkt het best voor functies waar kandidaten vooral op hun telefoon zitten en weinig tijd hebben voor een formulier: monteurs, chauffeurs, productiemedewerkers, horecapersoneel en schoonmakers. Voor functies waar een uitgebreide motivatie of portfolio belangrijk is, blijft een klassieke sollicitatie vaak beter.', 'veryo' ), __( 'Een voorbeeld: een uitzendbureau in het noorden met veel vacatures in productie en logistiek kan alle eerste reacties via WhatsApp laten binnenkomen. De intercedent ziet per kandidaat een korte samenvatting en belt alleen nog met wie echt past.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Kandidaten zitten op WhatsApp, niet op je sollicitatieformulier', 'veryo' ),
					'p' => array(
						__( 'De beste vakmensen hebben al een baan. Ze kijken ’s avonds op hun telefoon naar vacatures, en haken af bij een formulier met tien velden en een verplicht cv. Een WhatsApp-bericht sturen doen ze wel.', 'veryo' ),
						__( 'Voor recruiters en werkgevers betekent dat: snel reageren, eerlijk communiceren en niemand in het ongewisse laten. Met een volle agenda is dat lastig, zeker als er tientallen reacties per week binnenkomen.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'chauffeur in de cabine die via WhatsApp reageert op een vacature', 'veryo' ), __( 'WhatsApp-werving: solliciteren zonder cv', 'veryo' ), 'telefoon' ),
				'products' => array(
					'keys' => array( 'ai-recruitment-assistent' ),
					'h'    => __( 'Vaste oplossing voor werving en selectie', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat we automatiseren in werving', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'whatsapp-sollicitatie', 'vacatureteksten', 'kandidaatopvolging', 'voorselectie', 'onboarding', 'outreach' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo werkt WhatsApp-werving', 'veryo' ),
						'p' => array(
							__( 'In de vacature staat een WhatsApp-knop. De kandidaat stuurt een bericht en krijgt vijf korte vragen: vak, ervaring, regio, rijbewijs, beschikbaarheid. Past hij bij de harde eisen, dan kiest hij zelf een moment voor een kennismaking. Zo niet, dan krijgt hij een nette uitleg en eventueel een tip voor een andere vacature.', 'veryo' ),
							__( 'De recruiter of werkgever krijgt per kandidaat een korte samenvatting en voert alleen nog de gesprekken. Na elk gesprek gaat er automatisch een bericht uit met de volgende stap, zodat niemand vergeten wordt.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Eerlijk werven', 'veryo' ),
						'list'  => array(
							__( 'Kandidaten weten dat ze met een assistent praten en kunnen altijd een mens bereiken.', 'veryo' ),
							__( 'Alleen objectieve, vooraf vastgelegde eisen; geen selectie op kenmerken die niet mogen.', 'veryo' ),
							__( 'Bij twijfel beslist een mens.', 'veryo' ),
							__( 'Gegevens van kandidaten bewaren we niet langer dan nodig.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project' ) ),
				'faq'      => array(
					array( __( 'Is WhatsApp-werving AVG-proof?', 'veryo' ), __( 'Met de officiële WhatsApp Business API, een verwerkersovereenkomst en een duidelijke privacyverklaring kun je het zorgvuldig inrichten. We helpen je daarbij; laat de juridische teksten controleren.', 'veryo' ) ),
					array( __( 'Werkt dit voor recruitmentbureaus én werkgevers?', 'veryo' ), __( 'Ja. Voor een bureau met veel vacatures levert het meer op, maar ook een werkgever met een paar vacatures per jaar bespaart tijd en haalt meer reacties binnen.', 'veryo' ) ),
					array( __( 'Kan het koppelen met ons ATS?', 'veryo' ), __( 'Als je sollicitantvolgsysteem een koppeling heeft, zetten we kandidaten daar direct in.', 'veryo' ) ),
					array( __( 'Wat kost het?', 'veryo' ), __( 'Dat hangt af van de omvang en het aantal koppelingen. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Werven via WhatsApp? Begin met de AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-automatisering/hr-en-werving', __( 'Werving en HR automatiseren', 'veryo' ), __( 'Alle HR-toepassingen', 'veryo' ) ),
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent', 'veryo' ), __( 'Maatwerk', 'veryo' ) ),
					array( 'branches/transport', __( 'AI voor transport', 'veryo' ), __( 'Chauffeurs werven', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/schoonmaak'                => array(
		'title'     => __( 'AI en automatisering voor schoonmaakbedrijven', 'veryo' ),
		'seo_title' => __( 'AI en automatisering voor schoonmaakbedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor schoonmaakbedrijven: uren en roosters controleren, inkoopfacturen automatisch verwerken en sneller werven. Bovenop je eigen tools. Gratis offerte.', 'veryo' ),
		'kw'        => 'ai voor schoonmaakbedrijven',
		'schema'    => array(
			'type' => 'service',
			'area' => 'Nederland',
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'AI voor schoonmaakbedrijven draait vooral om de administratie rond het werk. Veryo zorgt voor automatisering in je schoonmaakbedrijf bovenop de tools die je al gebruikt: uren en roosters controleren, inkoopfacturen verwerken en nieuwe medewerkers sneller werven. Je stapt niet over op nieuwe software. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo schoonmaakbedrijven', 'veryo' ), __( 'Werkinstructies, objectafspraken en procedures doorzoekbaar voor leidinggevenden, ook voor nieuwe collega’s.', 'veryo' ), __( 'Een AI-workshop voor kantoor en leidinggevenden, met roosters en uren als voorbeeld.', 'veryo' ), __( 'Urencontrole, inkoopfacturen en werving automatiseren bovenop jullie planning en boekhouding.', 'veryo' ) ),
				'problem'  => array(
					'h'    => __( 'Waar de kantoortijd in een schoonmaakbedrijf naartoe gaat', 'veryo' ),
					'p'    => array(
						__( 'Het schoonmaakwerk zelf gebeurt verspreid over veel locaties en tijden: vroeg in de ochtend, ’s avonds, in het weekend. Op kantoor komt alles samen, en daar gaat de tijd zitten.', 'veryo' ),
					),
					'list' => array(
						'<strong>' . __( 'Urenregistratie', 'veryo' ) . '</strong>: ' . __( 'gewerkte uren per medewerker en per locatie naast het rooster leggen en klaarzetten voor de salarisadministratie.', 'veryo' ),
						'<strong>' . __( 'Facturen van zzp’ers en onderaannemers', 'veryo' ) . '</strong>: ' . __( 'controleren of de uren en het tarief kloppen met wat er gepland en afgesproken is.', 'veryo' ),
						'<strong>' . __( 'Inkoopfacturen', 'veryo' ) . '</strong>: ' . __( 'middelen, materialen en kleding, allemaal handmatig ingeboekt.', 'veryo' ),
						'<strong>' . __( 'Werving', 'veryo' ) . '</strong>: ' . __( 'veel sollicitanten, veel heen-en-weer en kandidaten die afhaken als het te lang duurt.', 'veryo' ),
					),
				),
				'products' => array(
					'keys'  => array( 'urencontrole-beveiliging', 'inkoopfacturen-automatiseren', 'ai-recruitment-assistent' ),
					'h'     => __( 'Oplossingen die passen bij een schoonmaakbedrijf', 'veryo' ),
					'intro' => __( 'Urencontrole is gebouwd voor beveiligingsbedrijven, maar werkt ook voor schoonmaak: dezelfde wisselende diensten, dezelfde roosters en vaak ook zzp’ers. Inkoopfacturen en de recruitment-assistent passen er goed naast.', 'veryo' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Urenregistratie in je schoonmaakbedrijf, zonder overtypen', 'veryo' ),
						'p' => array(
							__( 'Urencontrole legt de gewerkte uren en de facturen van zzp’ers en onderaannemers naast het rooster. Normale uren, avond, weekend en feestdagen worden apart gezet, en de uren staan klaar in het formaat van je salarisadministratie. Jij ziet alleen wat niet klopt. Lonen berekent Veryo niet; dat blijft bij je salarisadministratie.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Werkt met wat je al hebt', 'veryo' ),
						'p' => array( __( 'Veryo is geen softwareleverancier. We koppelen aan je bestaande planningspakket, je mailbox en je boekhouding, en richten de automatisering daarop in. Je team werkt verder zoals het gewend is.', 'veryo' ) ),
					),
				),
				'faq'      => array(
					array( __( 'Werkt Urencontrole ook voor schoonmaakbedrijven?', 'veryo' ), __( 'Ja. Het is gebouwd voor de beveiliging, maar de roosters en uren in de schoonmaak lijken daar sterk op. In de kennismaking kijken we hoe jullie planning en urenregistratie nu lopen.', 'veryo' ) ),
					array( __( 'Berekent Veryo de lonen?', 'veryo' ), __( 'Nee. Veryo controleert en deelt uren in en zet ze klaar. De loonberekening blijft bij je salarisadministratie.', 'veryo' ) ),
					array( __( 'Moeten we een ander planningspakket nemen?', 'veryo' ), __( 'Nee. De automatisering werkt bovenop wat je al gebruikt.', 'veryo' ) ),
					array( __( 'Wat kost het?', 'veryo' ), __( 'Na een kort gesprek krijg je een gratis offerte met een vaste prijs.', 'veryo' ) ),
				),
				'contact'  => array(
					__( 'Waar gaat bij jullie de meeste kantoortijd in zitten?', 'veryo' ),
					__( 'Vertel kort hoe jullie nu uren, roosters en facturen verwerken. Je hoort binnen één werkdag wat automatisering voor jullie kan betekenen.', 'veryo' ),
					__( 'Bijvoorbeeld: we hebben 60 medewerkers op 25 locaties en verwerken de uren elke maand met de hand.', 'veryo' ),
				),
				'cta'      => array( __( 'Schoonmaakbedrijf? Zie waar jouw uren zitten', 'veryo' ), '' ),
				'links'    => array(
					array( 'oplossingen/urencontrole-beveiliging', __( 'Urencontrole', 'veryo' ), __( 'Werkt ook voor schoonmaak', 'veryo' ) ),
					array( 'oplossingen/inkoopfacturen-automatiseren', __( 'Inkoopfacturen automatiseren', 'veryo' ), __( 'Minder handmatig inboeken', 'veryo' ) ),
					array( 'oplossingen/ai-recruitment-assistent', __( 'AI recruitment-assistent', 'veryo' ), __( 'Sneller nieuwe medewerkers werven', 'veryo' ) ),
					array( 'branches/beveiliging', __( 'AI voor beveiligingsbedrijven', 'veryo' ), __( 'Vergelijkbare roosters en uren', 'veryo' ) ),
				),
			)
		),
	),
	'branches/beveiliging'               => array(
		'title'     => __( 'AI voor beveiligingsbedrijven', 'veryo' ),
		'seo_title' => __( 'AI voor beveiligingsbedrijven: uren en rapportages | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor beveiligingsbedrijven: zzp-facturen naast het rooster, maandrapportages per opdrachtgever en minder administratie. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai voor beveiligingsbedrijven',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Nederland',
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'AI voor beveiligingsbedrijven, zonder nieuw softwarepakket: Veryo automatiseert de administratie van je beveiligingsbedrijf bovenop de tools die je al gebruikt. Bovenaan staat Urencontrole: facturen van zzp’ers en onderaannemers worden automatisch naast het rooster en het afgesproken tarief gelegd. Daarnaast maakt AI Klantrapportage van dienst- en incidentrapporten een maandrapportage per opdrachtgever, en automatiseren we inkoopfacturen en werving. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'help'     => array( __( 'Zo helpt Veryo beveiligingsbedrijven', 'veryo' ), __( 'Procedures, objectinstructies en afspraken met opdrachtgevers doorzoekbaar op jullie eigen server, zonder gevoelige gegevens in de cloud.', 'veryo' ), __( 'Een AI-training voor planning en kantoor, inclusief AI-geletterdheid voor het team.', 'veryo' ), __( 'Urencontrole van zzp-facturen, klantrapportages en inkoopfacturen automatiseren.', 'veryo' ) ),
				'problem'  => array(
					'h'    => __( 'Waar de tijd in de administratie van een beveiligingsbedrijf naartoe gaat', 'veryo' ),
					'p'    => array(
						__( 'Het werk op locatie loopt meestal goed. Het werk eromheen vreet de uren: alles wat er tijdens diensten gebeurt, moet worden vastgelegd, verwerkt en verantwoord richting opdrachtgevers. En dat gebeurt vaak nog met de hand.', 'veryo' ),
					),
					'list' => array(
						'<strong>' . __( 'Uren en zzp-facturen', 'veryo' ) . '</strong>: ' . __( 'elke factuur van een zzp’er of onderaannemer naast het rooster leggen, tarieven narekenen en uren klaarzetten voor de salarisadministratie.', 'veryo' ),
						'<strong>' . __( 'Dienstrapporten', 'veryo' ) . '</strong>: ' . __( 'elke dienst levert een rapport op dat iemand moet lezen en verwerken.', 'veryo' ),
						'<strong>' . __( 'Incidentverslagen', 'veryo' ) . '</strong>: ' . __( 'per incident een verslag, met opvolging richting opdrachtgever.', 'veryo' ),
						'<strong>' . __( 'Maandrapportages voor opdrachtgevers', 'veryo' ) . '</strong>: ' . __( 'per klant een overzicht, elke maand opnieuw met de hand in elkaar gezet.', 'veryo' ),
						'<strong>' . __( 'Roosters', 'veryo' ) . '</strong>: ' . __( 'diensten, beschikbaarheid, passen en diploma’s die op elkaar moeten passen.', 'veryo' ),
						'<strong>' . __( 'Inkoopfacturen', 'veryo' ) . '</strong>: ' . __( 'kleding, middelen, voertuigen en onderaannemers, allemaal handmatig ingeboekt.', 'veryo' ),
					),
				),
				'products' => array(
					'keys'  => array( 'urencontrole-beveiliging', 'ai-klantrapportage', 'inkoopfacturen-automatiseren', 'ai-recruitment-assistent' ),
					'h'     => __( 'Automatisering voor je beveiligingsbedrijf', 'veryo' ),
					'intro' => __( 'Urencontrole en AI Klantrapportage zijn onze vaste oplossingen voor de beveiliging. Inkoopfacturen en de recruitment-assistent passen er goed naast.', 'veryo' ),
				),
				'catalog'  => array(
					'h'     => __( 'Wat er verder te automatiseren valt', 'veryo' ),
					'intro' => __( 'Losse automatiseringen die goed passen bij een beveiligingsbedrijf. Tijdwinst is een indicatie voor een team van 5 tot 50 mensen.', 'veryo' ),
					'ids'   => array( 'planningsassistent', 'certificaten', 'whatsapp-sollicitatie', 'archiveren', 'documenten-samenvatten' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo ziet het eruit in de praktijk', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: beveiligers sturen hun dienstrapport aan het eind van de dienst naar een vast mailadres, of het rapport komt uit jullie eigen systeem. Een incident wordt apart vastgelegd. Gedurende de maand verzamelt AI Klantrapportage alles per opdrachtgever en locatie.', 'veryo' ),
							__( 'Aan het eind van de maand staat per opdrachtgever een conceptrapportage klaar in jullie huisstijl: het aantal diensten en rondes, de incidenten met een korte samenvatting en de bijzonderheden. De planner of leidinggevende leest na, past aan waar nodig en verstuurt. Wat eerst een middag per klant kostte, is nu een kwestie van nalezen.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Vertrouwelijk en zorgvuldig', 'veryo' ),
						'p' => array( __( 'Rapporten in de beveiliging bevatten gevoelige informatie over locaties, personen en incidenten. We werken daarom met zakelijke AI-diensten die gegevens niet gebruiken om modellen te trainen, sluiten een verwerkersovereenkomst en geven alleen toegang tot wat nodig is. Een mens leest elke rapportage na voor die naar de opdrachtgever gaat.', 'veryo' ) ),
					),
				),
				'faq'      => array(
					array( __( 'Kan Veryo de facturen van onze zzp’ers controleren?', 'veryo' ), __( 'Ja, dat doet Urencontrole: elke factuur wordt naast het rooster en het afgesproken tarief gelegd, en je krijgt alleen de afwijkingen te zien. De uren worden ingedeeld en klaargezet voor de salarisadministratie. Lonen berekent Veryo niet.', 'veryo' ) ),
					array( __( 'Werkt AI Klantrapportage met ons rapportagesysteem?', 'veryo' ), __( 'Komen rapporten als mail of PDF binnen, dan altijd. Heeft je systeem een export of koppeling, dan halen we ze daar rechtstreeks uit. Dat checken we in het eerste gesprek.', 'veryo' ) ),
					array( __( 'Kunnen de rapportages in onze eigen huisstijl?', 'veryo' ), __( 'Ja. Logo, kleuren en indeling stemmen we vooraf af, zodat elke opdrachtgever een vertrouwd overzicht krijgt.', 'veryo' ) ),
					array( __( 'Kan AI ook helpen met roosters?', 'veryo' ), __( 'Een planningsassistent kan voorstellen doen op basis van beschikbaarheid, passen en diploma’s. Dat is maatwerk; de planner beslist altijd.', 'veryo' ) ),
					array( __( 'Wat kost het?', 'veryo' ), __( 'Na een kort gesprek krijg je een gratis offerte met een vaste prijs.', 'veryo' ) ),
				),
				'contact'  => array(
					__( 'Waar gaat bij jullie de meeste kantoortijd in zitten?', 'veryo' ),
					__( 'Vertel hoe jullie nu uren, facturen en rapportages verwerken. Je hoort binnen één werkdag wat Urencontrole of AI Klantrapportage voor jullie kan betekenen.', 'veryo' ),
					__( 'Bijvoorbeeld: we werken met 40 zzp’ers en controleren hun facturen elke maand met de hand.', 'veryo' ),
				),
				'cta'      => array( __( 'Beveiligingsbedrijf? Zie waar jouw uren zitten', 'veryo' ), '' ),
				'links'    => array(
					array( 'oplossingen/urencontrole-beveiliging', __( 'Urencontrole', 'veryo' ), __( 'Zzp-facturen naast het rooster', 'veryo' ) ),
					array( 'oplossingen/ai-klantrapportage', __( 'AI Klantrapportage', 'veryo' ), __( 'Maandrapportages per opdrachtgever', 'veryo' ) ),
					array( 'oplossingen/inkoopfacturen-automatiseren', __( 'Inkoopfacturen automatiseren', 'veryo' ), __( 'Minder handmatig inboeken', 'veryo' ) ),
					array( 'oplossingen/ai-recruitment-assistent', __( 'AI recruitment-assistent', 'veryo' ), __( 'Sneller nieuwe beveiligers werven', 'veryo' ) ),
					array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid en rechten op orde', 'veryo' ) ),
				),
			)
		),
	),

);
