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
		'seo_title' => __( 'AI-chatbot laten maken voor je website en bedrijf | Veryo', 'veryo' ),
		'desc'      => __( 'Een AI-chatbot laten maken voor je website die antwoord geeft uit je eigen kennis en doorverwijst naar een mens. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai chatbot laten maken',
		'schema'    => array(
			'type' => 'service',
			'min'  => 2500,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Bij Veryo kun je een AI-chatbot laten maken voor je website die vragen beantwoordt op basis van jullie eigen informatie, en bij twijfel doorverwijst naar een collega. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
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
							__( 'Dat hangt af van de omvang en het aantal koppelingen. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
							__( 'Dat hangt af van de omvang en het aantal koppelingen. Je krijgt vooraf een gratis offerte met een vaste prijs. Daarnaast zijn er verbruikskosten voor de AI-dienst en de hosting. Voor een MKB-website met een normaal aantal gesprekken gaat het meestal om tientallen euro’s per maand.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Wat een chatbot niet doet', 'veryo' ),
						'p' => array( __( 'Een chatbot doet geen toezeggingen die niet in de bronnen staan, geeft geen prijzen die niet zijn vastgelegd en neemt geen beslissingen over klachten of garanties. Dat blijft mensenwerk. Hij is er om de eenvoudige vragen snel en goed te beantwoorden, zodat je team tijd heeft voor de rest.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 'startpakket', 'project', 'maatwerk', 'onderhoud' ) ),
				'faq'      => array(
					array( __( 'Wat kost een chatbot laten maken?', 'veryo' ), __( 'Dat hangt af van de omvang en het aantal koppelingen. Je krijgt vooraf een gratis offerte met een vaste prijs. Daarnaast zijn er verbruikskosten van meestal tientallen euro’s per maand.', 'veryo' ) ),
					array( __( 'Hoe lang duurt het om een chatbot te laten maken?', 'veryo' ), __( 'Een eerste versie staat meestal binnen vier tot zes weken, inclusief een testperiode met je eigen team.', 'veryo' ) ),
					array( __( 'Werkt de chatbot op elke website?', 'veryo' ), __( 'Op vrijwel elke website, of het nu WordPress is of een ander systeem. Het is een klein stukje code dat we plaatsen of dat je webbouwer toevoegt.', 'veryo' ) ),
					array( __( 'Wat als de chatbot iets verkeerds zegt?', 'veryo' ), __( 'We beperken de chatbot tot jouw bronnen, testen vooraf met echte vragen en loggen de gesprekken. Zien we een fout, dan verbeteren we de bronnen of de instructies.', 'veryo' ) ),
					array( __( 'Is een chatbot AVG-proof?', 'veryo' ), __( 'We gebruiken zakelijke API’s, vragen alleen gegevens die nodig zijn en vermelden in de privacyverklaring hoe het werkt. Bij persoonsgegevens sluiten we een verwerkersovereenkomst.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent', 'veryo' ), __( 'Dezelfde kennis, via WhatsApp', 'veryo' ) ),
					array( 'ai-automatisering/klantcontact', __( 'Klantcontact automatiseren', 'veryo' ), __( 'Mail, telefoon en berichten', 'veryo' ) ),
					array( 'prijzen', __( 'Gratis offerte', 'veryo' ), __( 'Vooraf een vaste prijs', 'veryo' ) ),
					array( 'branches/horeca-retail', __( 'AI voor horeca en retail', 'veryo' ), __( 'Chatbot en reserveringen', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-op-maat/whatsapp-assistent'     => array(
		'title'     => __( 'WhatsApp-assistent voor je bedrijf', 'veryo' ),
		'seo_title' => __( 'WhatsApp-assistent laten maken voor je bedrijf | Veryo', 'veryo' ),
		'desc'      => __( 'Een WhatsApp-chatbot voor je bedrijf: vragen 24/7 beantwoorden, gegevens en foto’s verzamelen en afspraken inplannen via de officiële API. Gratis offerte.', 'veryo' ),
		'kw'        => 'whatsapp chatbot bedrijf',
		'schema'    => array(
			'type' => 'service',
			'min'  => 2500,
			'max'  => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo bouwt een WhatsApp-chatbot voor je bedrijf: een assistent die vragen 24/7 beantwoordt, gegevens en foto’s verzamelt en afspraken inplant, via de officiële WhatsApp Business API. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
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
	'ai-op-maat/ai-receptionist-horeca' => array(
		'title'       => __( 'Veryo Receptie: AI-receptionist voor zorgpraktijken', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'Veryo Receptie: AI-receptionist voor zorgpraktijken | Veryo', 'veryo' ),
		'desc'        => __( 'Veryo Receptie neemt de telefoon op tijdens behandelingen en na sluitingstijd, en plant afspraken in. Voor fysiotherapie, tandarts en andere praktijken.', 'veryo' ),
		'kw'          => 'ai receptionist zorgpraktijk',
		'schema'      => array(
			'type' => 'service',
		),
		'content'     => veryo_page_standard(
			array(
				'answer_cta' => array( __( 'Vraag een demo aan', 'veryo' ), '#vraag', 'amber' ),
				'answer'     => __( 'Veryo Receptie is een AI-receptionist voor zorgpraktijken, zoals fysiotherapie, tandarts en andere praktijken. Hij neemt de telefoon op tijdens behandelingen en na sluitingstijd, plant afspraken in en beantwoordt praktische vragen. Afwijkende vragen zet hij klaar als terugbelverzoek. Medisch advies geeft hij nooit.', 'veryo' ),
				'problem'    => array(
					'h' => __( 'De telefoon gaat terwijl je behandelt', 'veryo' ),
					'p' => array(
						__( 'In een kleine praktijk staat niemand de hele dag bij de telefoon. Tijdens een behandeling kun je niet opnemen, en na sluitingstijd gaat de lijn naar de voicemail. Wie een afspraak wil maken of verzetten, belt later terug, of belt een andere praktijk.', 'veryo' ),
						__( 'Tussen de behandelingen door voicemails afluisteren en terugbellen kost tijd die je liever aan patiënten besteedt.', 'veryo' ),
					),
				),
				'photo'      => array( __( 'telefoon op een balie', 'veryo' ), __( 'Veryo Receptie neemt de telefoon op voor zorgpraktijken', 'veryo' ), 'telefoon' ),
				'sections'   => array(
					array(
						'h'     => __( 'Wat Veryo Receptie doet', 'veryo' ),
						'list'  => array(
							__( 'Neemt op tijdens behandelingen en na sluitingstijd, met een natuurlijke stem.', 'veryo' ),
							__( 'Plant afspraken in, verzet ze of zegt ze af in jullie agenda, als die een koppeling heeft.', 'veryo' ),
							__( 'Beantwoordt praktische vragen, zoals openingstijden, bereikbaarheid en wat iemand moet meenemen.', 'veryo' ),
							__( 'Zet andere vragen klaar als terugbelverzoek, met naam en reden.', 'veryo' ),
							__( 'Stuurt jullie een overzicht van alle gesprekken.', 'veryo' ),
						),
						'style' => 'checks',
					),
					array(
						'h'     => __( 'Wat Veryo Receptie niet doet', 'veryo' ),
						'list'  => array(
							__( 'Geen medisch advies en geen beoordeling van klachten.', 'veryo' ),
							__( 'Bij spoed verwijst hij direct naar 112 of de huisartsenpost.', 'veryo' ),
							__( 'Geen inzage in het patiëntendossier.', 'veryo' ),
						),
						'style' => 'checks',
					),
					array(
						'h' => __( 'Zorgvuldig met gegevens', 'veryo' ),
						'p' => array(
							__( 'Bellers horen aan het begin dat ze met een digitale assistent praten, en kunnen altijd vragen om teruggebeld te worden. De assistent vraagt alleen wat nodig is om een afspraak te maken. We sluiten een verwerkersovereenkomst en leggen samen vast welke gegevens worden bewaard en hoe lang.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Zo beginnen we', 'veryo' ),
						'p' => array(
							__( 'We leggen samen vast wat de assistent moet weten: openingstijden, soorten afspraken, regels voor nieuwe patiënten en wat er moet gebeuren bij vragen die hij niet kan beantwoorden. Daarna testen jullie hem zelf met proefgesprekken, voordat er een patiënt mee belt. Vaak beginnen we na sluitingstijd, en daarna ook tijdens behandelingen. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
						),
					),
				),
				'price'      => array( 'steps' => array( 'maatwerk', 'onderhoud' ) ),
				'faq'        => array(
					array( __( 'Klinkt het als een robot?', 'veryo' ), __( 'De stemmen zijn goed verstaanbaar en natuurlijk. Toch merkt een beller dat het een assistent is, en dat vertellen we ook aan het begin van het gesprek.', 'veryo' ) ),
					array( __( 'Werkt het met onze agenda?', 'veryo' ), __( 'Als jullie agenda- of praktijksysteem een koppeling heeft, kan de assistent afspraken direct inplannen. Zo niet, dan noteert hij het verzoek en krijgen jullie een overzicht.', 'veryo' ) ),
					array( __( 'Geeft de assistent medisch advies?', 'veryo' ), __( 'Nee, nooit. Bij spoed verwijst hij naar 112 of de huisartsenpost, en inhoudelijke vragen zet hij klaar als terugbelverzoek.', 'veryo' ) ),
					array( __( 'Wat kost Veryo Receptie?', 'veryo' ), __( 'Je krijgt vooraf een gratis offerte met een vaste prijs, plus een inschatting van de verbruikskosten per gespreksminuut. Die hangen af van het aantal gesprekken.', 'veryo' ) ),
				),
				'cta_demo'   => true,
				'cta'        => array( __( 'Minder gemiste telefoontjes in jullie praktijk?', 'veryo' ), __( 'Vraag een demo aan. We laten zien hoe Veryo Receptie een gesprek afhandelt en wat er nodig is om het aan jullie agenda te koppelen.', 'veryo' ) ),
				'links'      => array(
					array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
					array( 'ai-automatisering/klantcontact', __( 'Klantcontact automatiseren', 'veryo' ), __( 'Mail en WhatsApp', 'veryo' ) ),
					array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid en afspraken over gegevens', 'veryo' ) ),
				),
			)
		),
	),
);
