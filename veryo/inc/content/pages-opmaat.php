<?php
/**
 * Subpagina's AI op maat.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

return array(

	/* ------------------------------------------------------------------------- */
	'ai-op-maat/chatbot'                => array(
		'title'     => __( 'AI-chatbot laten maken voor je bedrijf', 'veryo' ),
		'seo_title' => __( 'AI-chatbot laten maken voor je bedrijf | Veryo', 'veryo' ),
		'desc'      => __( 'Een AI-chatbot laten maken voor je website die antwoord geeft uit je eigen kennis en doorverwijst naar een mens. Wat het kost: vanaf €2.500 excl. btw.', 'veryo' ),
		'kw'        => 'ai chatbot laten maken',
		'schema'    => array(
			'type' => 'service',
			'min'  => 2500,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Bij Veryo kun je een AI-chatbot laten maken voor je website die vragen beantwoordt op basis van jullie eigen informatie, en bij twijfel doorverwijst naar een collega. Een chatbot voor je website kost €2.500 tot €7.500; met koppelingen naar agenda, CRM of WhatsApp wordt het maatwerk vanaf €5.000, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Waarom een chatbot voor je website?', 'veryo' ),
					'p' => array(
						__( 'Bezoekers van je website hebben vragen op momenten dat niemand de telefoon opneemt: ’s avonds, in het weekend, tijdens de lunch. Ze willen weten of je in hun regio werkt, wat een klus ongeveer kost of hoe snel je kunt komen. Vinden ze het antwoord niet, dan klikken ze door naar de volgende.', 'veryo' ),
						__( 'De oude chatbots met vaste knoppen en keuzemenu’s werken daar slecht voor. Een AI-chatbot begrijpt vragen in gewone taal en zoekt het antwoord in jullie eigen teksten, prijzen en voorwaarden.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'telefoon met een chatgesprek op de website van een installatiebedrijf', 'veryo' ), __( 'AI-chatbot laten maken voor je website', 'veryo' ), 'telefoon' ),
				'sections' => array(
					array(
						'h'     => __( 'Wat je krijgt als je een AI-chatbot laat maken', 'veryo' ),
						'list'  => array(
							__( 'Een chatbot op je website, in jullie huisstijl en toon.', 'veryo' ),
							__( 'Antwoorden alleen uit bronnen die jij kiest: je website, prijslijsten, voorwaarden, veelgestelde vragen.', 'veryo' ),
							__( 'Doorverwijzen naar een mens bij twijfel, met een samenvatting van de vraag.', 'veryo' ),
							__( 'Contactgegevens of een terugbelverzoek verzamelen als de bezoeker dat wil.', 'veryo' ),
							__( 'Een logboek van gesprekken, zodat je ziet wat er gevraagd wordt.', 'veryo' ),
							__( 'Een testperiode met je eigen team voordat hij live gaat.', 'veryo' ),
						),
						'style' => 'checks',
					),
					array(
						'h' => __( 'Chatbot laten maken: kosten en wat ze bepaalt', 'veryo' ),
						'p' => array(
							__( 'Een chatbot die vragen beantwoordt op basis van je website en een paar documenten, valt meestal in een project van €2.500 tot €7.500. Moet hij afspraken inplannen in je agenda, gegevens in je CRM zetten, via WhatsApp werken of meerdere talen spreken, dan wordt het maatwerk vanaf €5.000.', 'veryo' ),
							__( 'Daarnaast zijn er verbruikskosten voor de AI-dienst en de hosting. Voor een MKB-website met een normaal aantal gesprekken gaat het meestal om tientallen euro’s per maand. Onderhoud en bijwerken kan via een abonnement van €150 tot €500 per maand.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Wat een chatbot niet doet', 'veryo' ),
						'p' => array( __( 'Een chatbot doet geen toezeggingen die niet in de bronnen staan, geeft geen prijzen die niet zijn vastgelegd en neemt geen beslissingen over klachten of garanties. Dat blijft mensenwerk. Hij is er om de eenvoudige vragen snel en goed te beantwoorden, zodat je team tijd heeft voor de rest.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'project', 'maatwerk', 'onderhoud' ) ),
				'faq'      => array(
					array( __( 'Wat kost een chatbot laten maken?', 'veryo' ), __( 'Een AI-chatbot voor je website kost meestal €2.500 tot €7.500. Met koppelingen naar agenda, CRM of WhatsApp wordt het maatwerk vanaf €5.000. Daarnaast zijn er verbruikskosten van meestal tientallen euro’s per maand. Alles exclusief btw.', 'veryo' ) ),
					array( __( 'Hoe lang duurt het om een chatbot te laten maken?', 'veryo' ), __( 'Een eerste versie staat meestal binnen vier tot zes weken, inclusief een testperiode met je eigen team.', 'veryo' ) ),
					array( __( 'Werkt de chatbot op elke website?', 'veryo' ), __( 'Op vrijwel elke website, of het nu WordPress is of een ander systeem. Het is een klein stukje code dat we plaatsen of dat je webbouwer toevoegt.', 'veryo' ) ),
					array( __( 'Wat als de chatbot iets verkeerds zegt?', 'veryo' ), __( 'We beperken de chatbot tot jouw bronnen, testen vooraf met echte vragen en loggen de gesprekken. Zien we een fout, dan verbeteren we de bronnen of de instructies.', 'veryo' ) ),
					array( __( 'Is een chatbot AVG-proof?', 'veryo' ), __( 'We gebruiken zakelijke API’s, vragen alleen gegevens die nodig zijn en vermelden in de privacyverklaring hoe het werkt. Bij persoonsgegevens sluiten we een verwerkersovereenkomst.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent', 'veryo' ), __( 'Dezelfde kennis, via WhatsApp', 'veryo' ) ),
					array( 'ai-automatisering/klantcontact', __( 'Klantcontact automatiseren', 'veryo' ), __( 'Mail, telefoon en berichten', 'veryo' ) ),
					array( 'prijzen', __( 'Prijzen', 'veryo' ), __( 'Alle pakketten op een rij', 'veryo' ) ),
					array( 'branches/horeca-retail', __( 'AI voor horeca en retail', 'veryo' ), __( 'Chatbot en reserveringen', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-op-maat/whatsapp-assistent'     => array(
		'title'     => __( 'WhatsApp-assistent voor je bedrijf', 'veryo' ),
		'seo_title' => __( 'WhatsApp-assistent voor je bedrijf | Veryo', 'veryo' ),
		'desc'      => __( 'Een WhatsApp-chatbot voor je bedrijf: vragen 24/7 beantwoorden, gegevens en foto’s verzamelen en afspraken inplannen via de officiële API. Vanaf €2.500.', 'veryo' ),
		'kw'        => 'whatsapp chatbot bedrijf',
		'schema'    => array(
			'type' => 'service',
			'min'  => 2500,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo bouwt een WhatsApp-chatbot voor je bedrijf: een assistent die vragen 24/7 beantwoordt, gegevens en foto’s verzamelt en afspraken inplant, via de officiële WhatsApp Business API. Een WhatsApp-assistent kost €2.500 tot €7.500, met uitgebreide koppelingen maatwerk vanaf €5.000, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Wat je vooraf beslist', 'veryo' ), array( __( 'Voordat we bouwen, leggen we samen vast welke vragen de assistent zelf mag beantwoorden, welke gegevens hij opvraagt en wanneer hij doorzet naar een collega. Ook spreken we af binnen welke tijd een collega reageert op een doorgezet gesprek, zodat de klant weet waar hij aan toe is.', 'veryo' ), __( 'Een WhatsApp-assistent werkt het best met een beperkt aantal onderwerpen om mee te beginnen, bijvoorbeeld storingen, afspraken en veelgestelde vragen. Na een paar weken kijken we in de gesprekken wat er nog meer gevraagd wordt en breiden we uit waar het zin heeft.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Iedereen appt, maar wie appt er terug?', 'veryo' ),
					'p' => array(
						__( 'Klanten sturen liever een WhatsApp-bericht dan dat ze bellen of een formulier invullen. Dat is handig, tot er tientallen berichten per dag binnenkomen op de telefoon van de eigenaar. Foto’s van een storing, een vraag over een offerte, een verzoek om een afspraak. En alles door elkaar.', 'veryo' ),
						__( 'Berichten blijven liggen, collega’s weten niet wat er is afgesproken en de klant moet drie keer hetzelfde vertellen. WhatsApp automatisering brengt daar orde in.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'klant die een foto van een storing via WhatsApp naar een installatiebedrijf stuurt', 'veryo' ), __( 'WhatsApp-chatbot voor je bedrijf', 'veryo' ), 'telefoon' ),
				'sections' => array(
					array(
						'h'     => __( 'Wat een WhatsApp-assistent doet', 'veryo' ),
						'list'  => array(
							__( 'Beantwoordt veelgestelde vragen direct, ook buiten kantoortijd.', 'veryo' ),
							__( 'Vraagt de gegevens op die je nodig hebt: adres, type toestel, foto’s van het probleem.', 'veryo' ),
							__( 'Plant een afspraak in je agenda of zet een terugbelverzoek klaar.', 'veryo' ),
							__( 'Zet een samenvatting in je CRM, planning of mailbox.', 'veryo' ),
							__( 'Draagt het gesprek over aan een collega als dat nodig is.', 'veryo' ),
						),
						'style' => 'checks',
					),
					array(
						'h' => __( 'WhatsApp automatisering, officieel en veilig', 'veryo' ),
						'p' => array(
							__( 'We werken met de officiële WhatsApp Business API, niet met trucjes op een losse telefoon. Daardoor kunnen meerdere collega’s meekijken, blijft de geschiedenis bewaard en voldoet het aan de voorwaarden van WhatsApp. Klanten zien dat ze met een assistent praten en kunnen altijd een mens vragen.', 'veryo' ),
							__( 'Een voorbeeld: een installatiebedrijf krijgt ’s avonds een bericht over een cv-ketel die niet aanslaat. De assistent vraagt naar het merk, de foutcode en een foto, geeft de standaardtips uit de handleiding en plant, als dat niet helpt, een monteur in voor de volgende ochtend.', 'veryo' ),
						),
					),
				),
				'catalog'  => array(
					'h'   => __( 'Gerelateerd uit de catalogus', 'veryo' ),
					'ids' => array( 'whatsapp-assistent', 'statusberichten', 'whatsapp-sollicitatie', 'bonnetjes' ),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'project', 'maatwerk', 'onderhoud' ) ),
				'faq'      => array(
					array( __( 'Heb ik een WhatsApp Business-account nodig?', 'veryo' ), __( 'Ja, een account op de WhatsApp Business API. Wij regelen de aanvraag en de koppeling. Je kunt je bestaande nummer vaak meenemen.', 'veryo' ) ),
					array( __( 'Zijn er kosten per bericht?', 'veryo' ), __( 'WhatsApp rekent kosten voor bepaalde soorten gesprekken, afhankelijk van wie het gesprek begint. Voor de meeste MKB-bedrijven zijn die beperkt. We geven vooraf een inschatting.', 'veryo' ) ),
					array( __( 'Kunnen collega’s meelezen?', 'veryo' ), __( 'Ja. Gesprekken komen in een gedeeld overzicht, zodat iedereen kan zien wat er is gevraagd en afgesproken.', 'veryo' ) ),
					array( __( 'Kan de assistent ook sollicitaties afhandelen?', 'veryo' ), __( 'Ja, solliciteren via WhatsApp is een aparte flow uit onze catalogus en goed te combineren.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'WhatsApp bij storingen', 'veryo' ) ),
					array( 'branches/recruitment', __( 'Werving via WhatsApp', 'veryo' ), __( 'Solliciteren zonder cv', 'veryo' ) ),
					array( 'ai-op-maat/chatbot', __( 'AI-chatbot voor je website', 'veryo' ), __( 'Dezelfde kennis op je site', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-op-maat/interne-assistent'      => array(
		'title'     => __( 'AI-assistent op je eigen documenten', 'veryo' ),
		'seo_title' => __( 'AI-assistent op je eigen documenten | Veryo', 'veryo' ),
		'desc'      => __( 'Een chatbot op je eigen documenten: een interne AI-assistent die vragen beantwoordt uit je handleidingen en procedures, met bronvermelding. Vanaf €5.000.', 'veryo' ),
		'kw'        => 'chatbot eigen documenten',
		'schema'    => array(
			'type' => 'service',
			'min'  => 5000,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo bouwt een chatbot op je eigen documenten: een interne AI-assistent die vragen van collega’s beantwoordt uit jullie handleidingen, procedures en productbladen, met een verwijzing naar de bron. Een interne assistent is maatwerk van €5.000 tot €25.000, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Voor wie een interne assistent het meest oplevert', 'veryo' ), array( __( 'Een interne assistent verdient zich het snelst terug bij bedrijven met veel technische documentatie, wisselende projecten of regelmatig nieuwe medewerkers. Denk aan installatiebedrijven met honderden toestellen van verschillende fabrikanten, adviesbureaus met eigen werkwijzen en procedures, of bedrijven waar de kennis nu bij één of twee ervaren collega’s zit.', 'veryo' ), __( 'Een voorbeeld: een servicemonteur staat bij een klant met een toestel dat hij zelden ziet. In plaats van de collega op kantoor te bellen, vraagt hij de assistent naar de juiste instelling en krijgt hij het antwoord met de pagina uit de handleiding. De collega op kantoor kan doorwerken.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Zoeken kost meer tijd dan het antwoord', 'veryo' ),
					'p' => array(
						__( 'Het antwoord staat ergens. In een map op de server, in een pdf van de leverancier, in een mail van twee jaar geleden. Maar wie het nodig heeft, weet niet waar. Dus wordt er gebeld, gezocht of gegokt.', 'veryo' ),
						__( 'Vooral nieuwe medewerkers en monteurs op locatie lopen daar tegenaan. En de ervaren collega die het wel weet, wordt tien keer per dag gestoord.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'monteur op locatie die op zijn telefoon een vraag stelt aan de interne assistent', 'veryo' ), __( 'Chatbot op eigen documenten voor monteurs', 'veryo' ), 'werkplaats' ),
				'sections' => array(
					array(
						'h' => __( 'Hoe een chatbot op eigen documenten werkt', 'veryo' ),
						'p' => array(
							__( 'Je kiest de bronnen: werkinstructies, handleidingen, procedures, prijslijsten, het personeelshandboek. We maken die doorzoekbaar voor de assistent. Een collega stelt een vraag in gewone taal, en de assistent antwoordt op basis van die bronnen, met een link naar het document en de plek waar het staat.', 'veryo' ),
							__( 'Staat het antwoord niet in de bronnen, dan zegt de assistent dat. Hij vult niet aan uit het algemene geheugen van een AI-model. Zo weet je waar je aan toe bent.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Waar je op kunt rekenen', 'veryo' ),
						'list'  => array(
							__( 'Toegang alleen voor medewerkers, eventueel per afdeling of rol.', 'veryo' ),
							__( 'Bronvermelding bij elk antwoord.', 'veryo' ),
							__( 'Nieuwe documenten worden automatisch meegenomen.', 'veryo' ),
							__( 'Zakelijke API’s: je documenten worden niet gebruikt om modellen te trainen.', 'veryo' ),
							__( 'Te gebruiken via de browser, Teams of je telefoon.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'catalog'  => array(
					'h'   => __( 'Past goed bij', 'veryo' ),
					'ids' => array( 'interne-assistent', 'technische-documentatie', 'werkinstructies', 'documenten-samenvatten' ),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'maatwerk', 'onderhoud' ) ),
				'faq'      => array(
					array( __( 'Is een interne kennisbank met AI veilig?', 'veryo' ), __( 'We regelen toegang per medewerker, gebruiken zakelijke API’s en sluiten een verwerkersovereenkomst als er persoonsgegevens in de documenten staan. Echt gevoelige documenten laten we eruit of zetten we achter aparte rechten.', 'veryo' ) ),
					array( __( 'Werkt het met SharePoint of Google Drive?', 'veryo' ), __( 'Ja, dat zijn de meest gebruikte bronnen. Andere systemen met een koppeling kunnen ook.', 'veryo' ) ),
					array( __( 'Hoeveel documenten kunnen erin?', 'veryo' ), __( 'Van een paar tientallen tot duizenden. Meer documenten betekent niet automatisch betere antwoorden; we helpen kiezen wat erin hoort.', 'veryo' ) ),
					array( __( 'Wat kost een chatbot op eigen documenten?', 'veryo' ), __( 'Maatwerk van €5.000 tot €25.000, afhankelijk van het aantal bronnen, gebruikers en koppelingen. Daarnaast verbruikskosten, meestal beperkt. Alles exclusief btw.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-automatisering/kennis-en-documenten', __( 'Kennis en documenten', 'veryo' ), __( 'Alle toepassingen', 'veryo' ) ),
					array( 'branches/zakelijke-dienstverlening', __( 'AI voor accountants', 'veryo' ), __( 'En adviesbureaus', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Op locatie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-op-maat/ai-receptionist-horeca' => array(
		'title'     => __( 'AI-receptionist voor restaurants en horeca', 'veryo' ),
		'seo_title' => __( 'AI-receptionist voor restaurants en horeca | Veryo', 'veryo' ),
		'desc'      => __( 'AI-receptionist voor restaurants: een AI-telefoonassistent die opneemt, reserveringen noteert en vragen beantwoordt als jij het druk hebt. Vanaf €5.000.', 'veryo' ),
		'kw'        => 'ai receptionist voor restaurants',
		'schema'    => array(
			'type' => 'service',
			'min'  => 5000,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo bouwt een AI-receptionist voor restaurants en horeca: een AI-telefoonassistent die de telefoon opneemt als het druk is of je gesloten bent, reserveringen noteert, vragen over openingstijden en allergenen beantwoordt en lastige vragen doorzet. Een AI-voicebot is maatwerk vanaf €5.000, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Zo pakken we het aan', 'veryo' ), array( __( 'We beginnen met het vastleggen van de informatie die de assistent nodig heeft: openingstijden, menu en allergenen, bereikbaarheid, regels voor groepen en wat er moet gebeuren bij een klacht. Daarna testen we met echte gesprekken door jou en je team, voordat er een gast mee belt.', 'veryo' ), __( 'In de eerste weken luisteren we gesprekken terug en passen we aan waar de assistent twijfelt of te lang praat. Pas als het goed loopt, zetten we hem ook in als overloop tijdens drukke uren.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'De telefoon gaat altijd op het verkeerde moment', 'veryo' ),
					'p' => array(
						__( 'Om half zeven staat de keuken vol, de bediening loopt en precies dan gaat de telefoon. Iemand wil reserveren voor zaterdag, iemand vraagt of er glutenvrije opties zijn, iemand wil weten tot hoe laat de keuken open is. Neem je op, dan staat een tafel te wachten. Neem je niet op, dan belt de gast het volgende restaurant.', 'veryo' ),
						__( 'Buiten openingstijden is het nog lastiger. Een voicemail wordt zelden ingesproken en nog minder vaak teruggebeld.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'drukke restaurantbar met een telefoon op de toonbank', 'veryo' ), __( 'AI-receptionist voor restaurants neemt de telefoon op', 'veryo' ), 'horeca' ),
				'sections' => array(
					array(
						'h'     => __( 'Wat een AI-telefoonassistent doet', 'veryo' ),
						'list'  => array(
							__( 'Neemt op met een natuurlijke stem, in het Nederlands en eventueel Engels of Duits.', 'veryo' ),
							__( 'Noteert reserveringen of zet ze direct in je reserveringssysteem, als dat een koppeling heeft.', 'veryo' ),
							__( 'Beantwoordt vragen over openingstijden, bereikbaarheid, menu en allergenen uit jouw informatie.', 'veryo' ),
							__( 'Zet afwijkende vragen, zoals groepen of klachten, als terugbelverzoek klaar.', 'veryo' ),
							__( 'Stuurt je een overzicht van alle gesprekken.', 'veryo' ),
						),
						'style' => 'checks',
					),
					array(
						'h' => __( 'AI-voicebot: wat je moet weten', 'veryo' ),
						'p' => array(
							__( 'Een AI-receptionist is een van de meer complexe toepassingen. Spraak herkennen in een rumoerige omgeving, dialecten en snelle beslissingen vragen veel testen. Daarom beginnen we vaak buiten openingstijden of als overloop wanneer niemand binnen een paar keer overgaan opneemt. Zo leer je het systeem kennen zonder risico in de drukste uren.', 'veryo' ),
							__( 'Bellers horen aan het begin van het gesprek dat ze met een digitale assistent praten, en kunnen altijd vragen om teruggebeld te worden door een mens.', 'veryo' ),
						),
					),
				),
				'catalog'  => array(
					'h'   => __( 'Past goed bij', 'veryo' ),
					'ids' => array( 'voicebot', 'reviews', 'social-captions', 'website-chatbot' ),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'maatwerk', 'onderhoud' ) ),
				'faq'      => array(
					array( __( 'Klinkt een AI-receptionist als een robot?', 'veryo' ), __( 'De stemmen zijn tegenwoordig goed verstaanbaar en natuurlijk. Toch merkt een beller dat het een assistent is, en dat vertellen we ook aan het begin van het gesprek.', 'veryo' ) ),
					array( __( 'Werkt het met mijn reserveringssysteem?', 'veryo' ), __( 'Als je reserveringssysteem een koppeling heeft, kan de assistent reserveringen direct inboeken. Zo niet, dan noteert hij ze en krijg je een overzicht.', 'veryo' ) ),
					array( __( 'Wat kost een AI-telefoonassistent?', 'veryo' ), __( 'Maatwerk vanaf €5.000, exclusief btw, plus verbruikskosten per gespreksminuut. Die hangen af van het aantal gesprekken; we geven vooraf een inschatting.', 'veryo' ) ),
					array( __( 'Kan het ook voor andere bedrijven dan horeca?', 'veryo' ), __( 'Ja. Een AI-telefoonassistent buiten kantoortijd werkt ook voor installateurs, makelaars en dienstverleners.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/horeca-retail', __( 'AI voor horeca', 'veryo' ), __( 'Reviews, social en meer', 'veryo' ) ),
					array( 'ai-automatisering/klantcontact', __( 'Klantcontact automatiseren', 'veryo' ), __( 'Mail en WhatsApp', 'veryo' ) ),
					array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Op locatie', 'veryo' ) ),
				),
			)
		),
	),
);
