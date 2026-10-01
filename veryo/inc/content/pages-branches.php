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
		'desc'      => __( 'AI voor installateurs: een offerte-generator met calculatietool, digitale werkbon naar factuur en een WhatsApp-assistent voor storingen. Vanaf €750.', 'veryo' ),
		'kw'        => 'ai voor installateurs',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in voor installateurs en installatiebedrijven: een offerte-generator met eigen calculatietool, een digitale werkbon die automatisch een factuur wordt en een WhatsApp-assistent die storingsmeldingen opvangt. Een quick win kost €750 tot €1.500, een project €2.500 tot €7.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Herkenbaar voor elk installatiebedrijf', 'veryo' ),
					'p' => array(
						__( 'De vraag naar warmtepompen, zonnepanelen en verduurzaming is groot, maar goede monteurs zijn schaars en de binnendienst zit vol. Offerteaanvragen stapelen zich op omdat calculeren tijd kost. Werkbonnen komen onvolledig terug, dus wordt er te laat of te weinig gefactureerd. En bij elke storing gaat de telefoon, ook ’s avonds.', 'veryo' ),
						__( 'Het vakwerk loopt meestal prima. Het werk eromheen, van aanvraag tot factuur, kost de meeste uren. Daar zit ook de meeste winst voor AI voor installateurs.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'installateur met tablet bij een warmtepomp op locatie', 'veryo' ), __( 'AI voor installateurs: werkbon op de tablet', 'veryo' ), 'installateur' ),
				'catalog'  => array(
					'h'     => __( 'De drie automatiseringen die installateurs het meest opleveren', 'veryo' ),
					'intro' => __( 'Plus een paar die er goed bij passen. Tijdwinst is een indicatie voor een team van 5 tot 20 mensen.', 'veryo' ),
					'ids'   => array( 'offerte-generator', 'calculatietool', 'digitale-werkbon', 'werkbon-factuur', 'whatsapp-assistent', 'storingen', 'onderhoudsplanning', 'subsidiecheck' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo ziet AI voor installateurs eruit in de praktijk', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: een klant vraagt via de website een offerte aan voor een hybride warmtepomp en stuurt foto’s van de ketel en de meterkast mee. De offerte-generator leest de aanvraag, haalt uit de calculatietool de juiste onderdelen, uren en marges, en zet een conceptofferte klaar. De calculator controleert en verstuurt dezelfde dag.', 'veryo' ),
							__( 'Na de installatie spreekt de monteur de werkbon in: wat er is gedaan, welke materialen zijn gebruikt, bijzonderheden. Daar komt een nette werkbon uit die de klant digitaal aftekent, en een conceptfactuur voor de administratie. ’s Avonds meldt een andere klant een storing via WhatsApp. De assistent vraagt naar merk, foutcode en een foto, geeft de standaardtips en plant zo nodig een monteur in.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Regelingen en terugverdientijd in de offerte', 'veryo' ),
						'p' => array( __( 'Bij verduurzaming vragen klanten vaak naar subsidies en terugverdientijd. We kunnen per project laten nagaan welke regelingen mogelijk van toepassing zijn en een terugverdienberekening aan de offerte toevoegen. Regelingen veranderen regelmatig, dus de installateur controleert altijd de actuele voorwaarden.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'training', 'quickwin', 'project', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Werkt dit met ons installatiesoftwarepakket?', 'veryo' ), __( 'Veel pakketten voor installateurs hebben een koppeling. Zo niet, dan werken we met exports of een eenvoudige tussenlaag. Dat checken we in de kansensessie.', 'veryo' ) ),
					array( __( 'Maakt de AI zelf de prijs?', 'veryo' ), __( 'Nee. Prijzen, uurtarieven en marges staan in de calculatietool met vaste rekenregels. AI leest de aanvraag en vult in; de calculator controleert.', 'veryo' ) ),
					array( __( 'Hoeveel tijd scheelt een offerte-generator?', 'veryo' ), __( 'In de catalogus rekenen we met 3 tot 8 uur per week voor een team van 5 tot 20 mensen. Wat het bij jou oplevert, hangt af van het aantal offertes en hoe je nu werkt. De AI-scan maakt een schatting.', 'veryo' ) ),
					array( __( 'Kunnen monteurs de werkbon echt inspreken?', 'veryo' ), __( 'Ja. Ze spreken in de telefoon in wat er is gedaan en maken foto’s. De AI maakt er een gestructureerde werkbon van, die de monteur nog even controleert.', 'veryo' ) ),
					array( __( 'Is een training voor ons team ook mogelijk?', 'veryo' ), __( 'Ja. Een halve dag AI-training met voorbeelden uit de installatietechniek kost €1.200 exclusief btw.', 'veryo' ) ),
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
		'desc'      => __( 'AI in de bouw voor aannemers: materiaalstaat uit het bestek, nacalculatie per project en meerwerk inspreken op de bouwplaats. Vaste prijs, vanaf €750.', 'veryo' ),
		'kw'        => 'ai in de bouw',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in de bouw in voor aannemers en bouwbedrijven: een concept-materiaalstaat uit tekening of bestek, nacalculatie die begroot en werkelijk per project naast elkaar zet, en meerwerk dat op de bouwplaats wordt ingesproken. Een quick win kost €750 tot €1.500, maatwerk vanaf €5.000, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Waar een bouwbedrijf geld laat liggen', 'veryo' ),
					'p' => array(
						__( 'In de bouw zit het risico zelden in het vakwerk. Het zit in de calculatie die te krap was, het meerwerk dat nooit is gefactureerd en het project dat verlies draaide zonder dat iemand het doorhad tot de jaarrekening. En in de uren die de werkvoorbereider kwijt is aan het uitpluizen van bestekken.', 'veryo' ),
						__( 'Tegelijk is de uitvoerder druk op de bouwplaats en heeft hij geen zin om ’s avonds formulieren in te vullen. Alles wat niet direct wordt vastgelegd, raakt kwijt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'uitvoerder op een bouwplaats die meerwerk fotografeert met zijn telefoon', 'veryo' ), __( 'AI in de bouw: meerwerk vastleggen op de bouwplaats', 'veryo' ), 'bouw' ),
				'catalog'  => array(
					'h'     => __( 'Wat AI in de bouw concreet doet', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen voor aannemers, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'materiaalstaat', 'nacalculatie', 'meerwerk', 'calculatietool', 'urenregistratie', 'inkoop-bestellingen', 'opleverrapport', 'aanbestedingsscan' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Van bestek tot oplevering', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: een aannemer met vijftien mensen krijgt een bestek voor een verbouwing. Uit de tekening en het bestek maakt AI een concept-materiaalstaat, die de calculator controleert en aanvult. Dat scheelt vooral het begin, waar nu uren in gaan.', 'veryo' ),
							__( 'Tijdens de bouw spreekt de uitvoerder meerwerk in of maakt hij een foto met een korte toelichting. Daar komt direct een meerwerkregel van, die aan het project wordt gekoppeld. Wekelijks zie je per project begroot tegenover werkelijk, zodat je bijstuurt terwijl het nog kan. Bij oplevering worden de foto’s en notities een opleverrapport in huisstijl.', 'veryo' ),
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
		'title'     => __( 'AI voor agrarische bedrijven en mechanisatie', 'veryo' ),
		'seo_title' => __( 'AI voor agrarische bedrijven en mechanisatie | Veryo', 'veryo' ),
		'desc'      => __( 'AI in de landbouw en mechanisatie: onderhoud en keuringen automatisch plannen, onderdelen bestellen en projectfoto’s omzetten in posts. Vanaf €750.', 'veryo' ),
		'kw'        => 'ai in de landbouw',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in de landbouw en mechanisatie in waar het kantoorwerk zit: onderhoud en keuringen van machines automatisch plannen, onderdelen en inkoop regelen, en projectfoto’s omzetten in posts. Voor loonbedrijven, mechanisatiebedrijven en machinehandel. Een quick win kost €750 tot €1.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Het seizoen wacht niet op de administratie', 'veryo' ),
					'p' => array(
						__( 'In het seizoen draait alles om het werk op het land. Machines moeten het doen, onderdelen moeten op voorraad zijn en klanten willen weten wanneer de loonwerker komt. De onderhoudsplanning staat in een schrift of in het hoofd van de werkplaatschef, en de keuringsdata van klantmachines in een Excel die niemand bijhoudt.', 'veryo' ),
						__( 'Buiten het seizoen komt de administratie. Maar dan is het vaak te laat: een gemiste keuring, een onderdeel dat net niet op tijd binnen is, een klant die naar een ander is gegaan.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'monteur in de werkplaats van een mechanisatiebedrijf bij een trekker', 'veryo' ), __( 'AI in de landbouw: onderhoud in de werkplaats plannen', 'veryo' ), 'agri' ),
				'catalog'  => array(
					'h'     => __( 'Wat AI in de landbouw en mechanisatie oplevert', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'onderhoudsplanning', 'inkoop-bestellingen', 'projectfotos', 'voorraad', 'upsell-signalen', 'urenregistratie', 'technische-documentatie' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Een voorbeeld uit de mechanisatie', 'veryo' ),
						'p' => array(
							__( 'Een mechanisatiebedrijf onderhoudt machines van tweehonderd klanten. Alle machines met de datum van de laatste beurt of keuring komen in één lijst. Zes weken voor de volgende datum krijgt de klant automatisch een bericht met een voorstel voor een afspraak. Zodra de afspraak staat, wordt gecheckt of de onderdelen op voorraad zijn en zo niet, staat de bestelling klaar.', 'veryo' ),
							__( 'Klanten met een machine die bijna uit de garantie of het onderhoudscontract loopt, worden gesignaleerd, zodat de verkoper op tijd kan bellen. En de mooie klussen van de week worden met een foto en een korte tekst een post voor de website en social media.', 'veryo' ),
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
					array( 'ai-automatisering/marketing', __( 'AI-marketing', 'veryo' ), __( 'Projectfoto’s naar posts', 'veryo' ) ),
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
				'answer'   => __( 'Veryo zet AI in voor makelaars: één AI-inbox waarin berichten uit WhatsApp, telefoon en webformulieren samenkomen met een conceptantwoord, bezichtigingen die automatisch worden ingepland, en woningteksten in de toon van je kantoor. Een quick win kost €750 tot €1.500, een project €2.500 tot €7.500, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Waar een makelaarskantoor begint', 'veryo' ), array( __( 'De meeste kantoren beginnen met de AI-inbox, omdat daar direct zichtbaar wordt hoeveel reacties er binnenkomen en hoe snel ze worden beantwoord. Daarna volgen de woningteksten en het inplannen van bezichtigingen. Een kantoor met twee of drie makelaars merkt vooral rust in de week na een nieuwe woning: de reacties zijn beantwoord, de bezichtigingen staan en niemand heeft ’s avonds nog zitten plannen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Vijf kanalen, één makelaar', 'veryo' ),
					'p' => array(
						__( 'Een nieuwe woning staat online en binnen een uur komen de reacties binnen. Via Funda, de website, WhatsApp, de telefoon en de mail. Iedereen wil een bezichtiging, liefst dit weekend. Ondertussen moet de volgende woning nog worden opgenomen en moet er een tekst voor worden geschreven.', 'veryo' ),
						__( 'Het gevolg: reacties blijven liggen, geïnteresseerden haken af en de makelaar is ’s avonds bezig met het plannen van bezichtigingen in plaats van met zijn klanten.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'makelaar bij een woning met een tablet en de agenda voor bezichtigingen', 'veryo' ), __( 'AI voor makelaars: bezichtigingen plannen', 'veryo' ), 'woning' ),
				'catalog'  => array(
					'h'     => __( 'Wat AI voor makelaars concreet doet', 'veryo' ),
					'intro' => __( 'Samen vormen deze bouwstenen de AI-inbox voor je kantoor.', 'veryo' ),
					'ids'   => array( 'lead-invoer', 'mail-concepten', 'whatsapp-assistent', 'voicebot', 'statusberichten', 'social-captions', 'reviews' ),
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
		'desc'      => __( 'AI voor accountants en adviesbureaus: gespreksverslagen met actiepunten, documenten samenvatten en een interne AI-assistent op je eigen kennis. Vanaf €750.', 'veryo' ),
		'kw'        => 'ai voor accountants',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in voor accountants, administratiekantoren en adviesbureaus: gespreksverslagen met actiepunten die automatisch in je CRM komen, documenten samenvatten als voorbereiding en een interne AI-assistent op jullie eigen kennis. Een quick win kost €750 tot €1.500, een interne assistent is maatwerk vanaf €5.000, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Kenniswerk dat verzandt in typewerk', 'veryo' ),
					'p' => array(
						__( 'Een adviseur of accountant verdient zijn geld met kennis en advies. Toch gaat een groot deel van de dag op aan verslagen uittypen, mails beantwoorden, documenten doorlezen om te zien wat er echt in staat, en zoeken naar hoe het kantoor iets de vorige keer heeft aangepakt.', 'veryo' ),
						__( 'Tegelijk is de druk op tarieven en capaciteit hoog. Elk uur dat niet declarabel is, kost geld.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'adviseur in gesprek met een klant aan tafel, met een laptop die meeluistert', 'veryo' ), __( 'AI voor accountants: gespreksverslag automatisch', 'veryo' ), 'overleg' ),
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
					array( 'ai-automatisering/kennis-en-documenten', __( 'Kennis en documenten', 'veryo' ), __( 'Interne assistent', 'veryo' ) ),
					array( 'ai-op-maat/interne-assistent', __( 'AI-assistent op je eigen documenten', 'veryo' ), __( 'Maatwerk', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training', 'veryo' ), __( 'Voor het hele kantoor', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Zakelijke dienstverlening', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/horeca-retail'             => array(
		'title'     => __( 'AI voor horeca en retail', 'veryo' ),
		'seo_title' => __( 'AI voor horeca en retail | Veryo', 'veryo' ),
		'desc'      => __( 'AI voor horeca en retail: reviews verzamelen en beantwoorden, social media plannen en een AI-receptionist die de telefoon opneemt. Vanaf €750.', 'veryo' ),
		'kw'        => 'ai voor horeca',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in voor horeca en retail: reviews verzamelen en beantwoorden, social media plannen met kant-en-klare posts, en een AI-receptionist die de telefoon opneemt als het druk is. Reviews en social zijn quick wins van €750 tot €1.500; een AI-receptionist is maatwerk vanaf €5.000, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Waar je begint', 'veryo' ), array( __( 'De meeste horecazaken en winkels beginnen met reviews: het levert snel iets zichtbaars op en het kost weinig. Daarna volgt vaak de social planning, omdat het team toch al foto’s maakt. De AI-receptionist is een grotere stap, die we pas zetten als duidelijk is hoeveel gesprekken er gemist worden.', 'veryo' ), __( 'Voor winkels met een webshop is een chatbot op de website een logische volgende stap: vragen over levertijden, retouren en voorraad komen daar veel voor en zijn goed te beantwoorden uit je eigen informatie.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Gastvrij zijn kost al je aandacht', 'veryo' ),
					'p' => array(
						__( 'In de horeca en de winkel draait alles om de gast of klant die voor je staat. Maar ondertussen moeten er reviews worden beantwoord, moet Instagram worden bijgehouden en gaat de telefoon precies als het het drukst is.', 'veryo' ),
						__( 'Dat werk schiet er als eerste bij in. Een negatieve review blijft onbeantwoord, de laatste post is van drie maanden geleden en een gast die wilde reserveren, belt het restaurant verderop.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'eigenaar van een lunchroom die achter de bar op haar telefoon reviews bekijkt', 'veryo' ), __( 'AI voor horeca: reviews beantwoorden', 'veryo' ), 'horeca' ),
				'catalog'  => array(
					'h'     => __( 'Wat AI voor horeca en retail doet', 'veryo' ),
					'intro' => __( 'De drie belangrijkste automatiseringen, plus wat er goed bij past.', 'veryo' ),
					'ids'   => array( 'reviews', 'bedrijfsprofiel', 'social-captions', 'voicebot', 'website-chatbot', 'nieuwsbrief', 'klanttevredenheid' ),
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
					array( __( 'Wat kost een AI-receptionist voor een restaurant?', 'veryo' ), __( 'Maatwerk vanaf €5.000 exclusief btw, plus verbruikskosten per gespreksminuut. Op de pagina over de AI-receptionist lees je meer.', 'veryo' ) ),
					array( __( 'Kunnen de posts in onze eigen stijl?', 'veryo' ), __( 'Ja. We beginnen met jullie toon en een paar voorbeelden, en stellen bij tot het klinkt zoals jullie praten.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Horeca of winkel? Zie wat AI je oplevert', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-op-maat/ai-receptionist-horeca', __( 'AI-receptionist voor restaurants', 'veryo' ), __( 'Telefoon en reserveringen', 'veryo' ) ),
					array( 'ai-automatisering/marketing', __( 'AI-marketing', 'veryo' ), __( 'Social en reviews', 'veryo' ) ),
					array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Voor de binnenstad', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'branches/transport'                 => array(
		'title'     => __( 'AI voor transport en logistiek', 'veryo' ),
		'seo_title' => __( 'AI voor transport en logistiek | Veryo', 'veryo' ),
		'desc'      => __( 'AI in de logistiek: een planningsassistent, automatische statusberichten voor klanten en vrachtdocumenten archiveren. Vanaf €750, excl. btw.', 'veryo' ),
		'kw'        => 'ai in de logistiek',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI in de logistiek in voor transportbedrijven: een planningsassistent die ritten voorstelt, automatische statusberichten zodat klanten niet hoeven te bellen, en vrachtdocumenten die vanzelf worden benoemd en gearchiveerd. Statusberichten zijn een quick win van €750 tot €1.500; een planningsassistent is maatwerk, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Waar je begint in transport', 'veryo' ), array( __( 'Statusberichten zijn meestal de beste eerste stap: ze zijn goed af te bakenen, klanten merken het direct en het scheelt de planning telefoontjes. Daarna volgt het archiveren van documenten, omdat dat elke dag terugkomt en foutgevoelig is.', 'veryo' ), __( 'De planningsassistent is een grotere stap. Die zetten we pas op als de basisgegevens op orde zijn en de planner weet welke regels hij in zijn hoofd gebruikt. Vaak helpt het al om die regels eerst samen op papier te zetten.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Planning, bellen en papier', 'veryo' ),
					'p' => array(
						__( 'In transport en logistiek loopt de planning zelden zoals gepland. Een chauffeur valt uit, een klant wil een extra rit, een lading is later klaar. De planner past aan, belt chauffeurs en klanten, en houdt het overzicht in zijn hoofd.', 'veryo' ),
						__( 'Ondertussen bellen klanten om te vragen waar hun zending is, en stapelen de vrachtbrieven, CMR’s en afleverbonnen zich op. Allemaal werk dat nodig is, maar niet het werk waar je het verschil mee maakt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'planner op een transportkantoor met een planbord en twee schermen', 'veryo' ), __( 'AI in de logistiek: planningsassistent voor de planner', 'veryo' ), 'logistiek' ),
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
				'answer'   => __( 'Veryo zet WhatsApp-werving met AI op voor werkgevers en recruitmentbureaus: kandidaten solliciteren via WhatsApp zonder cv, vacatureteksten worden geschreven in de taal van vakmensen, en elke kandidaat krijgt automatisch bericht. Solliciteren via WhatsApp is een project van €2.500 tot €7.500; opvolging een quick win vanaf €750, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Voor wie het werkt', 'veryo' ), array( __( 'WhatsApp-werving werkt het best voor functies waar kandidaten vooral op hun telefoon zitten en weinig tijd hebben voor een formulier: monteurs, chauffeurs, productiemedewerkers, horecapersoneel en schoonmakers. Voor functies waar een uitgebreide motivatie of portfolio belangrijk is, blijft een klassieke sollicitatie vaak beter.', 'veryo' ), __( 'Een voorbeeld: een uitzendbureau in het noorden met veel vacatures in productie en logistiek kan alle eerste reacties via WhatsApp laten binnenkomen. De intercedent ziet per kandidaat een korte samenvatting en belt alleen nog met wie echt past.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Kandidaten zitten op WhatsApp, niet op je sollicitatieformulier', 'veryo' ),
					'p' => array(
						__( 'De beste vakmensen hebben al een baan. Ze kijken ’s avonds op hun telefoon naar vacatures, en haken af bij een formulier met tien velden en een verplicht cv. Een WhatsApp-bericht sturen doen ze wel.', 'veryo' ),
						__( 'Voor recruiters en werkgevers betekent dat: snel reageren, eerlijk communiceren en niemand in het ongewisse laten. Met een volle agenda is dat lastig, zeker als er tientallen reacties per week binnenkomen.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'chauffeur in de cabine die via WhatsApp reageert op een vacature', 'veryo' ), __( 'WhatsApp-werving: solliciteren zonder cv', 'veryo' ), 'telefoon' ),
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
					array( __( 'Wat kost het?', 'veryo' ), __( 'Solliciteren via WhatsApp is een project van €2.500 tot €7.500. Vacatureteksten en kandidaatopvolging zijn quick wins van €750 tot €1.500. Alles exclusief btw.', 'veryo' ) ),
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
);
