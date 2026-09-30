<?php
/**
 * Hoofdpagina's: home, AI-scan, diensten, prijzen, over, contact en overzichten.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_home_faq = array(
	array( __( 'Is AI iets voor mijn bedrijf?', 'veryo' ), __( 'Als er in je bedrijf werk is dat elke week terugkomt, zoals mail beantwoorden, offertes maken of facturen verwerken, dan is de kans groot dat AI daar tijd bespaart. Of het de moeite waard is, hangt af van hoeveel uur het nu kost. De gratis AI-scan geeft daar in drie minuten een eerste antwoord op.', 'veryo' ) ),
	array( __( 'Wat kost het?', 'veryo' ), __( 'Een afgebakende automatisering (quick win) kost €750 tot €1.500, een project met meerdere koppelingen €2.500 tot €7.500 en AI op maat vanaf €5.000. Een in-company training kost €1.200 voor een halve dag. Alle prijzen zijn exclusief btw en je krijgt vooraf een vaste prijs.', 'veryo' ) ),
	array( __( 'Is het veilig met onze gegevens?', 'veryo' ), __( 'We werken met zakelijke API’s waarbij je gegevens niet worden gebruikt om AI-modellen te trainen. Bij persoonsgegevens sluiten we een verwerkersovereenkomst. Jij blijft eigenaar van je data en waar mogelijk draaien de automatiseringen in je eigen accounts.', 'veryo' ) ),
	array( __( 'Moeten wij zelf technisch zijn?', 'veryo' ), __( 'Nee. Wij bouwen, koppelen en onderhouden. Jij en je team gebruiken het in de software die je al kent, zoals Outlook, WhatsApp of je boekhoudpakket. We leggen uit hoe het werkt en wie waarvoor aanspreekpunt is.', 'veryo' ) ),
	array( __( 'Wat is de AI-geletterdheidsplicht?', 'veryo' ), __( 'Sinds 2 februari 2025 verplicht de Europese AI Act (artikel 4) organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid van hun medewerkers. Dat betekent dat mensen die met AI werken moeten snappen wat het kan, wat niet en waar de risico’s zitten. Een training is een praktische manier om daaraan te werken.', 'veryo' ) ),
	array( __( 'Werken jullie ook buiten Noord-Nederland?', 'veryo' ), __( 'Ja. We zitten in Leeuwarden en komen in Friesland, Groningen en Drenthe op locatie. Trainingen en online diensten doen we ook in de rest van Nederland, op locatie of online.', 'veryo' ) ),
);

$veryo_home  = veryo_sec_hero(
	__( 'AI die echt werkt.', 'veryo' ),
	__( 'Automatiseringen, trainingen en AI op maat voor het MKB in Noord-Nederland. Met resultaten die je in uren en euro’s terugziet.', 'veryo' ),
	array(
		array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ),
		array( __( 'Bekijk wat we doen', 'veryo' ), '#wat-we-doen', 'link' ),
	)
);
$veryo_home .= veryo_b_group(
	veryo_b_h( __( 'Iedereen roept dat je iets met AI moet. Maar wat dan?', 'veryo' ) )
	. veryo_b_p( __( 'Veryo is een AI-bureau voor het MKB. We helpen bedrijven tot ongeveer vijftig mensen om AI in te zetten waar het echt tijd scheelt: bij de mail, de offertes, de administratie en de planning. Eerst snappen, dan slim inzetten. Zonder hype, met vaste prijzen.', 'veryo' ) )
	. veryo_b_p( __( 'Weet je nog niet waar je moet beginnen? Doe dan de gratis AI-scan. Je beantwoordt negen korte vragen over je bedrijf en krijgt een persoonlijk rapport met je drie grootste tijdwinsten, wat ze ongeveer opleveren en hoe je begint.', 'veryo' ) )
	. veryo_b_buttons( array( array( __( 'Zo werkt de AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ) ) ) ),
	array( 'className' => 'veryo-intro' )
);
$veryo_home .= veryo_sec_services();
$veryo_home .= veryo_sec_steps( __( 'Zo werken we', 'veryo' ), __( 'Vier stappen, van eerste vraag tot automatisering die elke dag draait. Je kunt na elke stap stoppen.', 'veryo' ) );
$veryo_home .= veryo_b_group(
	veryo_b_h( __( 'Wat we automatiseren', 'veryo' ) )
	. veryo_b_p( __( 'Een greep uit wat we voor MKB-bedrijven bouwen. Tijdwinst is een indicatie voor teams van 5 tot 20 mensen.', 'veryo' ) )
	. veryo_b_columns(
		array(
			veryo_b_h( __( 'Klantcontact', 'veryo' ), 3, array( 'fontSize' => 'heading' ) ) . veryo_b_list( array( __( 'Conceptantwoorden op mail in jullie toon', 'veryo' ), __( 'WhatsApp-assistent die 24/7 vragen beantwoordt', 'veryo' ), __( 'Klanten automatisch op de hoogte houden', 'veryo' ) ) ),
			veryo_b_h( __( 'Offertes en administratie', 'veryo' ), 3, array( 'fontSize' => 'heading' ) ) . veryo_b_list( array( __( 'Van aanvraag of foto naar conceptofferte', 'veryo' ), __( 'Inkoopfacturen direct in Exact, Moneybird of SnelStart', 'veryo' ), __( 'Afgeronde werkbon wordt factuur', 'veryo' ) ) ),
			veryo_b_h( __( 'Werk en overzicht', 'veryo' ), 3, array( 'fontSize' => 'heading' ) ) . veryo_b_list( array( __( 'Weekplanning als voorstel klaar', 'veryo' ), __( 'Onderhoud en keuringen vanzelf ingepland', 'veryo' ), __( 'Elke maandag je cijfers in gewone taal', 'veryo' ) ) ),
		)
	)
	. veryo_b_buttons( array( array( __( 'Alles over AI-automatisering', 'veryo' ), veryo_link( 'ai-automatisering' ), 'link' ) ) ),
	array( 'className' => 'veryo-catalog-teaser' )
);
$veryo_home .= veryo_sec_price( array( 0, 2, 4, 5, 6 ), __( 'Vaste prijzen, vooraf duidelijk', 'veryo' ), __( 'Je begint klein en bouwt uit als het werkt. Dit zijn de vanaf-prijzen van de belangrijkste stappen.', 'veryo' ) );
$veryo_home .= veryo_sec_branches( __( 'AI voor jouw branche', 'veryo' ), __( 'We kennen de praktijk van bouw, installatie, agri en techniek het best, maar werken voor het hele MKB.', 'veryo' ) );
$veryo_home .= veryo_sec_regions();
$veryo_home .= veryo_b_group(
	veryo_b_h( __( 'Waarom Veryo', 'veryo' ) )
	. veryo_b_list(
		array(
			'<strong>' . __( 'Nuchter.', 'veryo' ) . '</strong> ' . __( 'We beginnen bij je werk, niet bij de techniek. Als iets niet de moeite waard is, zeggen we dat.', 'veryo' ),
			'<strong>' . __( 'Vaste prijzen.', 'veryo' ) . '</strong> ' . __( 'Je weet vooraf wat het kost. Geen uurtje-factuurtje zonder einde.', 'veryo' ),
			'<strong>' . __( 'Eerlijk over wat niet kan.', 'veryo' ) . '</strong> ' . __( 'Beslissingen met grote gevolgen laten we niet aan AI over, en wat een paar keer per jaar voorkomt automatiseren we niet.', 'veryo' ),
			'<strong>' . __( 'Van training tot onderhoud.', 'veryo' ) . '</strong> ' . __( 'Leren, bouwen en bijhouden bij één partij. Je hoeft niet zelf drie bureaus aan te sturen.', 'veryo' ),
			'<strong>' . __( 'AVG-bewust.', 'veryo' ) . '</strong> ' . __( 'Zakelijke API’s, een verwerkersovereenkomst waar nodig en jouw data blijft van jou.', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	),
	array( 'className' => 'veryo-why' )
);
$veryo_home .= veryo_sec_cases();
$veryo_home .= veryo_sec_faq( $veryo_home_faq );
$veryo_home .= veryo_sec_cta_scan( __( 'Begin met de gratis AI-scan', 'veryo' ) );

/*
 * AI-scan: /waar-begin-ik-met-ai/
 */
$veryo_scan_faq = array(
	array( __( 'Is AI iets voor mijn bedrijf?', 'veryo' ), __( 'Dat hangt af van hoeveel terugkerend werk er is. De AI-scan rekent uit hoeveel uur je ongeveer terug kunt winnen op basis van jouw eigen antwoorden. Komt daar weinig uit, dan zeggen we dat ook.', 'veryo' ) ),
	array( __( 'Wat kost het?', 'veryo' ), __( 'De AI-scan en het rapport zijn gratis. Als je daarna iets wilt laten bouwen, begint een afgebakende automatisering bij €750 exclusief btw. Je krijgt altijd eerst een vaste prijs.', 'veryo' ) ),
	array( __( 'Is het veilig?', 'veryo' ), __( 'Je antwoorden gaan via een beveiligde verbinding naar onze website. We vragen geen gegevens van klanten of medewerkers en je kunt de vragen invullen zonder gevoelige bedrijfsinformatie te delen.', 'veryo' ) ),
	array( __( 'Wat gebeurt er met mijn gegevens?', 'veryo' ), __( 'We gebruiken je gegevens om het rapport te maken en contact met je op te nemen. Om het rapport te schrijven gaan alleen je antwoorden naar de AI-dienst van Anthropic, zonder je naam, bedrijfsnaam, e-mailadres of telefoonnummer. We bewaren de gegevens maximaal [veryo_bewaartermijn]. Meer staat in de privacyverklaring.', 'veryo' ) ),
	array( __( 'Moet ik daarna iets afnemen?', 'veryo' ), __( 'Nee. Het rapport is van jou en je zit nergens aan vast. Als je telefoonnummer is ingevuld, bellen we een keer om het rapport kort door te lopen. Wil je dat niet, dan laat je het veld leeg.', 'veryo' ) ),
);

$veryo_scan  = veryo_b_group(
	veryo_b_h( __( 'Wil je iets met AI, maar weet je niet wat?', 'veryo' ), 1, array( 'fontSize' => 'display-xl' ) )
	. veryo_b_p( __( 'Doe de gratis AI-scan in 3 minuten. Je krijgt een persoonlijk rapport met jouw 3 grootste tijdwinsten.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
	. veryo_b_buttons( array( array( __( 'Start de AI-scan', 'veryo' ), '#ai-scan', 'amber' ) ) ),
	array(
		'tagName'   => 'section',
		'align'     => 'full',
		'className' => 'is-style-petrol veryo-hero veryo-hero--scan has-check',
	)
);
$veryo_scan .= veryo_sec_answer( __( 'Waar begin je met AI in je bedrijf? Bij het werk dat elke week terugkomt en veel tijd kost. De gratis AI-scan van Veryo laat in drie minuten zien waar dat bij jou zit, hoeveel uur en euro’s het ongeveer oplevert, en wat je als eerste kunt doen.', 'veryo' ) );
$veryo_scan .= veryo_b_group( veryo_b_shortcode( '[veryo_ai_scan]' ), array( 'className' => 'veryo-scan-wrap' ) );
$veryo_scan .= veryo_b_group(
	veryo_b_h( __( 'Wat je krijgt', 'veryo' ) )
	. veryo_b_p( __( 'Direct na het invullen zie je je geschatte tijdwinst per week en een kansenscore. Binnen enkele minuten staat het volledige rapport in je mailbox. Daarin staan:', 'veryo' ) )
	. veryo_b_list(
		array(
			__( 'je geschatte besparing in uren per week en euro’s per jaar, met de aannames erbij', 'veryo' ),
			__( 'drie concrete automatiseringen die passen bij jouw antwoorden, met wat ze kosten', 'veryo' ),
			__( 'per automatisering: waarom, hoe het werkt en de eerste stap', 'veryo' ),
			__( 'één ding dat je deze week zelf al kunt doen', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	)
	. veryo_b_shortcode( '[veryo_report_preview]' ),
	array( 'className' => 'veryo-scan-get' )
);
$veryo_scan .= veryo_sec_text(
	__( 'Hoe ziet dat eruit in de praktijk?', 'veryo' ),
	array(
		__( 'Drie voorbeelden van wat uit een AI-scan kan komen. Het zijn voorbeelden, geen resultaten van klanten.', 'veryo' ),
	),
	array(
		'<strong>' . __( 'Een installatiebedrijf met twaalf mensen', 'veryo' ) . '</strong> ' . __( 'dat offertes met de hand maakt, kan met een offerte-generator van aanvraag en foto’s een conceptofferte laten maken. De calculator controleert in plaats van alles zelf te typen.', 'veryo' ),
		'<strong>' . __( 'Een makelaarskantoor', 'veryo' ) . '</strong> ' . __( 'dat vragen binnenkrijgt via WhatsApp, telefoon en webformulieren, kan die in één AI-inbox laten binnenkomen, met een conceptantwoord en een voorstel voor een bezichtiging.', 'veryo' ),
		'<strong>' . __( 'Een agrarisch loonbedrijf', 'veryo' ) . '</strong> ' . __( 'dat onderhoud en keuringen in een schrift bijhoudt, kan die automatisch laten inplannen, met een herinnering aan de klant en een bestelling voor de onderdelen.', 'veryo' ),
	)
);
$veryo_scan .= veryo_sec_faq( $veryo_scan_faq );
$veryo_scan .= veryo_sec_links(
	array(
		array( 'ai-automatisering', __( 'AI-automatisering voor het MKB', 'veryo' ), __( 'Alles wat we automatiseren, per afdeling', 'veryo' ) ),
		array( 'prijzen', __( 'Prijzen', 'veryo' ), __( 'Van gratis scan tot partner-abonnement', 'veryo' ) ),
		array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Als je eerst zelf wilt snappen hoe het werkt', 'veryo' ) ),
	)
);

/*
 * AI-automatisering
 */
$veryo_auto_cats  = array(
	'klantcontact'            => __( 'Mail, WhatsApp, chatbot en telefoon: vragen sneller en consequenter beantwoord.', 'veryo' ),
	'offertes-en-calculaties' => __( 'Van aanvraag naar offerte, opvolging en calculatie, zonder alles over te typen.', 'veryo' ),
	'administratie'           => __( 'Inkoopfacturen, bonnetjes, werkbonnen en debiteuren, gekoppeld aan je boekhoudpakket.', 'veryo' ),
	'werkprocessen'           => __( 'Planning, werkbonnen, inkoop, onderhoud en overdracht.', 'veryo' ),
	'marketing'               => __( 'SEO, content, social en reviews, altijd met een menselijke check.', 'veryo' ),
	'hr-en-werving'           => __( 'Vacatures, solliciteren via WhatsApp, opvolging en onboarding.', 'veryo' ),
	'kennis-en-documenten'    => __( 'Een interne AI-assistent op je eigen documenten en procedures.', 'veryo' ),
	'rapportages'             => __( 'Dashboards, een maandagbericht met cijfers en Excel zonder gedoe.', 'veryo' ),
);
$veryo_auto_items = array();
foreach ( $veryo_auto_cats as $veryo_slug => $veryo_desc ) {
	$veryo_labels       = veryo_catalog_categories();
	$veryo_auto_items[] = '<a href="' . esc_url( veryo_link( 'ai-automatisering/' . $veryo_slug ) ) . '">' . esc_html( $veryo_labels[ $veryo_slug ] ) . '</a><br><span class="veryo-meta">' . esc_html( $veryo_desc ) . '</span>';
}

$veryo_auto = veryo_page_standard(
	array(
		'answer'   => __( 'Veryo bouwt AI-automatiseringen voor het MKB: terugkerend werk zoals mail, offertes, facturen en planning laten we door AI en slimme koppelingen doen, in de software die je al gebruikt. Een afgebakende automatisering kost €750 tot €1.500, een project met meerdere koppelingen €2.500 tot €7.500, exclusief btw.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Herken je dit?', 'veryo' ),
			'p' => array(
				__( 'Je team is druk, maar een flink deel van die drukte is hetzelfde werk, elke week opnieuw. Mail doorzetten naar de juiste collega. Een offerte in elkaar zetten uit een aanvraag die half compleet is. Inkoopfacturen overtypen in het boekhoudpakket. Klanten terugbellen die willen weten wanneer de monteur komt.', 'veryo' ),
				__( 'Dat werk is niet moeilijk, maar het kost uren en het blijft liggen op drukke dagen. Juist daar is AI-automatisering voor het MKB sterk in: het leest, sorteert, vult in en zet klaar. Een mens controleert en beslist.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'medewerker op kantoor die een conceptofferte controleert op een laptop', 'veryo' ), __( 'AI-automatisering in het MKB: offerte controleren', 'veryo' ) ),
		'sections' => array(
			array(
				'h'     => __( 'Wat we automatiseren, per onderdeel van je bedrijf', 'veryo' ),
				'p'     => array( __( 'We werken met een vaste catalogus van automatiseringen die in het MKB hun waarde hebben bewezen als bouwsteen. Per onderdeel zie je wat er kan, hoeveel tijd het ongeveer scheelt en in welke prijsklasse het valt.', 'veryo' ) ),
				'list'  => $veryo_auto_items,
				'style' => 'grid',
			),
			array(
				'h' => __( 'Hoe we bedrijfsprocessen automatiseren', 'veryo' ),
				'p' => array(
					__( 'We bouwen met bewezen bouwstenen: Make, Zapier of n8n voor de workflow, de Claude- of OpenAI-API voor het lees- en schrijfwerk, en jouw bestaande software. Denk aan Outlook of Gmail, Exact, Moneybird, SnelStart, je CRM of je planningstool. Je hoeft dus niet over te stappen op een nieuw pakket.', 'veryo' ),
					__( 'Elke workflow-automatisering krijgt een logboek en een eigenaar binnen je bedrijf. Zo weet je altijd wat er is gebeurd en wie je moet bellen als er iets verandert.', 'veryo' ),
				),
			),
			array(
				'h'     => __( 'Wat we niet automatiseren', 'veryo' ),
				'p'     => array( __( 'AI is goed in lezen, samenvatten en invullen. Het is geen vervanging voor vakmanschap of verantwoordelijkheid. Daarom houden we ons aan een paar vaste grenzen:', 'veryo' ) ),
				'list'  => array(
					__( 'Geen beslissingen met grote gevolgen zonder dat er een mens tussen zit, zoals afwijzingen, aanmaningen met incasso of prijsafspraken.', 'veryo' ),
					__( 'Eerst het proces helder, dan automatiseren. Een rommelig proces wordt door automatisering alleen sneller rommelig.', 'veryo' ),
					__( 'We automatiseren niet wat een paar keer per jaar voorkomt. Dat verdient zich niet terug.', 'veryo' ),
					__( 'Klantgerichte content gaat altijd langs een mens voordat het de deur uitgaat.', 'veryo' ),
				),
				'style' => '',
			),
			array(
				'h'     => __( 'Veilig werken', 'veryo' ),
				'list'  => array(
					__( 'Een verwerkersovereenkomst zodra er persoonsgegevens door de automatisering gaan.', 'veryo' ),
					__( 'Zakelijke API’s, waarbij je gegevens niet worden gebruikt om modellen te trainen.', 'veryo' ),
					__( 'Jij bent eigenaar van je data en, waar mogelijk, van de automatiseringen in je eigen accounts.', 'veryo' ),
					__( 'Elke automatisering heeft een logboek en een vaste eigenaar.', 'veryo' ),
				),
				'style' => 'checks',
			),
		),
		'price'    => array(
			'steps' => array( 3, 4, 5, 7 ),
			'p'     => __( 'Tijdwinst en prijs hangen af van hoe je werk nu loopt. Deze bedragen geven een eerlijk beeld van waar je op uitkomt.', 'veryo' ),
		),
		'faq'      => array(
			array( __( 'Wat is het verschil tussen AI-automatisering en gewone automatisering?', 'veryo' ), __( 'Gewone automatisering volgt vaste regels: als dit, dan dat. AI-automatisering kan ook ongestructureerde informatie aan, zoals een mail in gewone taal, een foto of een pdf. Daardoor kun je werk automatiseren dat eerder altijd mensenwerk bleef.', 'veryo' ) ),
			array( __( 'Moeten we andere software gaan gebruiken?', 'veryo' ), __( 'Nee. We koppelen aan wat je al hebt, zoals Outlook, Gmail, Exact, Moneybird, SnelStart, je CRM of planningstool. Alleen als een koppeling echt niet kan, bespreken we een alternatief.', 'veryo' ) ),
			array( __( 'Hoe lang duurt het voordat een automatisering draait?', 'veryo' ), __( 'Een quick win staat meestal binnen twee tot vier weken live, inclusief een proefperiode met echte gegevens. Een project met meerdere koppelingen duurt langer; dat staat in de planning die je vooraf krijgt.', 'veryo' ) ),
			array( __( 'Wat als er iets misgaat?', 'veryo' ), __( 'Elke automatisering heeft een logboek, zodat we kunnen zien wat er is gebeurd. Met een onderhoudsabonnement houden wij de boel in de gaten en lossen we het op. Belangrijke stappen blijven altijd door een mens gecontroleerd.', 'veryo' ) ),
			array( __( 'Voor welke bedrijven is dit geschikt?', 'veryo' ), __( 'Voor MKB-bedrijven tot ongeveer vijftig mensen met werk dat elke week terugkomt. We kennen bouw, installatie, agri en techniek het best, maar de meeste automatiseringen werken in elke branche.', 'veryo' ) ),
		),
		'links'    => array(
			array( 'ai-implementatie-mkb', __( 'AI-implementatie voor het MKB', 'veryo' ), __( 'Van plan tot live, stap voor stap', 'veryo' ) ),
			array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Offertes, werkbonnen en storingen', 'veryo' ) ),
			array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Op locatie in heel Friesland', 'veryo' ) ),
			array( 'prijzen', __( 'Alle prijzen', 'veryo' ), __( 'Vaste pakketprijzen, exclusief btw', 'veryo' ) ),
		),
	)
);

/*
 * AI-implementatie MKB
 */
$veryo_impl = veryo_page_standard(
	array(
		'answer'   => __( 'Veryo begeleidt AI-implementatie voor het MKB van plan tot live: we zoeken uit waar AI in jouw bedrijf het meest oplevert, bouwen de oplossingen in je eigen software en zorgen dat je team ermee werkt. Een kansensessie met roadmap kost €750 tot €1.500, exclusief btw.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Waarom AI-implementatie in het MKB vaak blijft hangen', 'veryo' ),
			'p' => array(
				__( 'Veel ondernemers hebben ChatGPT een keer geprobeerd en zien de mogelijkheden. Maar tussen “dit is handig” en “dit draait elke dag in ons bedrijf” zit een gat. Wie gaat het bouwen? Welke software moet waarop aansluiten? Wat mag wel en niet met klantgegevens? En wat doe je als de collega die ermee begon op vakantie is?', 'veryo' ),
				__( 'Daardoor blijft het vaak bij losse experimenten. Iedereen gebruikt het een beetje, niemand weet precies wat het oplevert, en de echte tijdvreters blijven liggen. Een AI-consultant die alleen een rapport schrijft, lost dat niet op. Je hebt iemand nodig die het ook bouwt en bijhoudt.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'ondernemer en adviseur aan tafel met een procesoverzicht op papier', 'veryo' ), __( 'AI-implementatie MKB: kansensessie aan tafel', 'veryo' ) ),
		'sections' => array(
			array(
				'h'    => __( 'Wat een AI-adviseur van Veryo concreet doet', 'veryo' ),
				'p'    => array( __( 'We werken als AI-adviseur én als bouwer. Dat betekent dat het advies altijd uitvoerbaar is, want wij moeten het zelf ook maken. De implementatie bestaat uit vier onderdelen:', 'veryo' ) ),
				'list' => array(
					'<strong>' . __( 'Inventariseren.', 'veryo' ) . '</strong> ' . __( 'We lopen je processen door: waar gaat de tijd heen, welke software gebruik je, waar zitten de fouten en de ergernissen.', 'veryo' ),
					'<strong>' . __( 'Prioriteren.', 'veryo' ) . '</strong> ' . __( 'Elke kans krijgt een inschatting van tijdwinst, kosten en risico. Je kiest zelf waar je begint.', 'veryo' ),
					'<strong>' . __( 'Bouwen en koppelen.', 'veryo' ) . '</strong> ' . __( 'We bouwen in je eigen accounts, testen met echte gegevens en zetten pas live als het werkt.', 'veryo' ),
					'<strong>' . __( 'Borgen.', 'veryo' ) . '</strong> ' . __( 'Je team krijgt uitleg of een training, elke automatisering een eigenaar en een logboek, en wij houden het bij.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Waar we meestal beginnen', 'veryo' ),
				'p' => array(
					__( 'Bij de meeste MKB-bedrijven zit de eerste winst op dezelfde plekken: de mailbox, de offertes en de administratie. Dat werk komt elke week terug, kost meerdere uren en is goed af te bakenen. Daarom beginnen we vaak met één quick win, zodat je binnen een paar weken ziet of het werkt voordat je verder investeert.', 'veryo' ),
					__( 'Een voorbeeld: een technisch bedrijf dat inkoopfacturen met de hand overtypt, kan beginnen met automatische verwerking naar het boekhoudpakket. Werkt dat goed, dan volgt de koppeling van werkbon naar factuur, en daarna de planning.', 'veryo' ),
				),
			),
		),
		'catalog'  => array(
			'h'     => __( 'Veelgekozen eerste stappen', 'veryo' ),
			'intro' => __( 'Uit onze catalogus, met indicatie van tijdwinst voor een team van 5 tot 20 mensen:', 'veryo' ),
			'ids'   => array( 'mail-concepten', 'inkoopfacturen', 'offerte-generator', 'offerte-opvolging', 'weekupdate' ),
		),
		'price'    => array( 'steps' => array( 3, 4, 5, 6, 8 ) ),
		'faq'      => array(
			array( __( 'Wat is het verschil tussen een AI-consultant en Veryo?', 'veryo' ), __( 'Een AI-consultant adviseert meestal alleen. Veryo adviseert, bouwt en onderhoudt. Dat houdt het advies realistisch, want we moeten het zelf ook werkend krijgen.', 'veryo' ) ),
			array( __( 'Hoe lang duurt een AI-implementatie?', 'veryo' ), __( 'De kansensessie en roadmap kosten een dagdeel plus uitwerking. Een eerste quick win staat meestal binnen twee tot vier weken. Een groter traject verdelen we in stappen, zodat je na elke stap kunt beoordelen of je doorgaat.', 'veryo' ) ),
			array( __( 'Hebben we een AI-strategie nodig voordat we beginnen?', 'veryo' ), __( 'Nee, geen dik document. Wel een helder beeld van waar de tijd heen gaat en wat je als eerste wilt oplossen. Dat is precies wat de kansensessie oplevert.', 'veryo' ) ),
			array( __( 'Wat als onze processen nog niet op orde zijn?', 'veryo' ), __( 'Dan beginnen we daar. Een rommelig proces automatiseren maakt het alleen sneller rommelig. Vaak helpt het al om een proces op papier te zetten voordat er iets gebouwd wordt.', 'veryo' ) ),
			array( __( 'Wie is eigenaar van wat jullie bouwen?', 'veryo' ), __( 'Jij bent eigenaar van je data en waar mogelijk van de automatiseringen, omdat we in je eigen accounts bouwen. Stop je met Veryo, dan kun je ermee verder.', 'veryo' ) ),
		),
		'links'    => array(
			array( 'ai-automatisering', __( 'AI-automatisering voor het MKB', 'veryo' ), __( 'Alle automatiseringen per onderdeel', 'veryo' ) ),
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Zodat je team ermee kan werken', 'veryo' ) ),
			array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Voor bedrijven in stad en provincie', 'veryo' ) ),
			array( 'branches/bouw', __( 'AI in de bouw', 'veryo' ), __( 'Voor aannemers en bouwbedrijven', 'veryo' ) ),
		),
	)
);

/*
 * AI-training
 */
$veryo_training = veryo_page_standard(
	array(
		'answer'   => __( 'Veryo geeft AI-training voor bedrijven: een praktische incompany training of workshop voor teams tot twintig mensen, met oefeningen uit jullie eigen werk in ChatGPT, Claude of Copilot. Een halve dag kost €1.200, een hele dag €2.800, exclusief btw.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Waarom een AI-training voor je team?', 'veryo' ),
			'p' => array(
				__( 'In de meeste bedrijven gebruikt al iemand ChatGPT, vaak zonder dat iemand weet hoe en waarvoor. Sommige collega’s halen er veel uit, anderen hebben het één keer geprobeerd en vonden het niets. En niemand weet precies wat wel en niet mag met klantgegevens.', 'veryo' ),
				__( 'Een goede AI-training haalt iedereen op hetzelfde niveau. Niet met theorie over neurale netwerken, maar met de vraag: hoe gebruik je dit morgen in je eigen werk, veilig en met resultaat. Daarnaast verplicht de Europese AI Act (artikel 4) sinds 2 februari 2025 organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid van hun medewerkers.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'team van een MKB-bedrijf rond een tafel met laptops tijdens een workshop', 'veryo' ), __( 'AI-training voor bedrijven: incompany workshop', 'veryo' ) ),
		'sections' => array(
			array(
				'h'     => __( 'Wat je team leert in de incompany AI-training', 'veryo' ),
				'list'  => array(
					__( 'Wat AI wel en niet kan, en waarom het soms met grote stelligheid onzin vertelt.', 'veryo' ),
					__( 'Goede opdrachten (prompts) schrijven voor mail, offertes, samenvattingen en teksten.', 'veryo' ),
					__( 'Werken met ChatGPT, Claude of Copilot: de verschillen en wat bij jullie past.', 'veryo' ),
					__( 'Wat wel en niet mag met klant- en bedrijfsgegevens, en welke instellingen je aanzet.', 'veryo' ),
					__( 'Oefenen met taken uit jullie eigen werk, zodat je iets meeneemt wat je morgen gebruikt.', 'veryo' ),
					__( 'Afspraken voor het team: een eerste opzet voor jullie AI-beleid.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'ChatGPT-training, Copilot-training of een workshop?', 'veryo' ),
				'p' => array(
					__( 'We stemmen de training af op de tools die jullie gebruiken of willen gaan gebruiken. Werken jullie in Microsoft 365, dan ligt een Copilot-training voor de hand. Gebruiken mensen vooral ChatGPT, dan beginnen we daar. Een halve dag is een stevige workshop voor de basis; een hele dag geeft ruimte om per afdeling aan eigen taken te werken.', 'veryo' ),
					__( 'Voorafgaand aan de training sturen we een korte vragenlijst, zodat we weten waar het team staat en welke taken we als oefening gebruiken. De training geven we bij jullie op locatie, in Leeuwarden of online.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Na de training', 'veryo' ),
				'p' => array( __( 'Je krijgt de slides, een overzicht met goede opdrachten voor jullie werk en een opzet voor afspraken over AI-gebruik. Wie daarna verder wil, kan doorgaan met een kansensessie of een eerste automatisering. Voor pakketten met meerdere sessies en een jaarlijkse update-sessie maken we een voorstel op maat.', 'veryo' ) ),
			),
		),
		'price'    => array(
			'steps' => array( 1, 2, 3 ),
			'p'     => __( 'Mogelijk is er subsidie via de SLIM-regeling voor trainingen; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie.', 'veryo' ),
		),
		'faq'      => array(
			array( __( 'Voor wie is de AI-training bedoeld?', 'veryo' ), __( 'Voor iedereen in je bedrijf die met AI werkt of gaat werken: van kantoor en planning tot de directie. Voorkennis is niet nodig. We stemmen de oefeningen af op de functies in de groep.', 'veryo' ) ),
			array( __( 'Hoeveel mensen kunnen meedoen?', 'veryo' ), __( 'Tot twintig personen per sessie. Bij grotere groepen splitsen we op, zodat iedereen zelf kan oefenen.', 'veryo' ) ),
			array( __( 'Voldoen we na de training aan de AI-geletterdheidsplicht?', 'veryo' ), __( 'De training is een concrete stap om te zorgen voor voldoende AI-geletterdheid, zoals artikel 4 van de AI Act vraagt. Je krijgt een deelnameoverzicht voor je eigen dossier. Wat voldoende is, hangt af van hoe jullie AI inzetten; dat bespreken we vooraf.', 'veryo' ) ),
			array( __( 'Kunnen we de training online volgen?', 'veryo' ), __( 'Ja. Op locatie werkt meestal beter voor de interactie, maar online kan ook, bijvoorbeeld voor teams op meerdere vestigingen.', 'veryo' ) ),
			array( __( 'Is er subsidie mogelijk?', 'veryo' ), __( 'Mogelijk via de SLIM-regeling voor trainingen. Openstellingsperiodes en voorwaarden wisselen, dus check de actuele situatie voordat je ervan uitgaat.', 'veryo' ) ),
		),
		'links'    => array(
			array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Specifiek voor de AI Act', 'veryo' ) ),
			array( 'academy', __( 'Veryo Academy', 'veryo' ), __( 'Online AI-cursus, binnenkort', 'veryo' ) ),
			array( 'leeuwarden', __( 'AI-training in Leeuwarden', 'veryo' ), __( 'Op locatie of bij jou', 'veryo' ) ),
			array( 'branches/zakelijke-dienstverlening', __( 'AI voor accountants', 'veryo' ), __( 'En andere adviesbureaus', 'veryo' ) ),
		),
	)
);

/*
 * AI-geletterdheid
 */
$veryo_literacy = veryo_page_standard(
	array(
		'answer'   => __( 'De AI-geletterdheid training van Veryo helpt je team voldoen aan artikel 4 van de AI Act: medewerkers leren wat AI kan, waar de risico’s zitten en hoe ze er veilig mee werken. De training duurt een halve of hele dag, kost €1.200 tot €2.800 exclusief btw, en is geschikt voor groepen tot twintig mensen.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Wat vraagt de AI Act van je als werkgever?', 'veryo' ),
			'p' => array(
				__( 'Sinds 2 februari 2025 verplicht de Europese AI Act (artikel 4) organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid van hun medewerkers. Dat geldt ook voor het MKB, en ook als het “alleen” om ChatGPT of Copilot gaat.', 'veryo' ),
				__( 'De wet schrijft geen vast lesprogramma voor. Wat voldoende is, hangt af van hoe je AI gebruikt, wie ermee werkt en welke risico’s daarbij horen. Een medewerker die AI gebruikt om klantmails te beantwoorden, moet andere dingen weten dan iemand die er een marketingtekst mee schrijft.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'trainer legt aan een kleine groep uit hoe je AI-antwoorden controleert', 'veryo' ), __( 'AI-geletterdheid training voor medewerkers', 'veryo' ) ),
		'sections' => array(
			array(
				'h'     => __( 'Wat de AI-geletterdheid training behandelt', 'veryo' ),
				'list'  => array(
					__( 'Hoe AI-taalmodellen werken, in gewone taal, en waarom ze fouten maken.', 'veryo' ),
					__( 'Welke AI-toepassingen jullie gebruiken en wat de risico’s per toepassing zijn.', 'veryo' ),
					__( 'Privacy en vertrouwelijkheid: wat je wel en niet invoert.', 'veryo' ),
					__( 'Controleren van AI-uitvoer: bronnen, cijfers en toon.', 'veryo' ),
					__( 'Verantwoordelijkheid: wie beslist en wie controleert.', 'veryo' ),
					__( 'Praktisch oefenen met eigen taken.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'AI Act training voor medewerkers, zonder bangmakerij', 'veryo' ),
				'p' => array(
					__( 'We houden het nuchter. De AI Act is geen reden om AI te laten liggen, maar wel een goede aanleiding om het goed te regelen. Na de training weet je team wat het mag, wat het moet controleren en wanneer het een collega inschakelt.', 'veryo' ),
					__( 'Je krijgt een deelnameoverzicht, de trainingsinhoud en een opzet voor een AI-beleid. Daarmee kun je laten zien welke stappen je hebt gezet. Nieuwe medewerkers kunnen later instromen via een volgende sessie of de online cursus van de Veryo Academy, zodra die beschikbaar is.', 'veryo' ),
				),
			),
			array(
				'h'    => __( 'Checklist: waar sta je nu?', 'veryo' ),
				'list' => array(
					__( 'Weet je welke AI-tools er in je bedrijf worden gebruikt, ook de gratis?', 'veryo' ),
					__( 'Zijn er afspraken over welke gegevens er wel en niet in mogen?', 'veryo' ),
					__( 'Weten medewerkers dat AI-uitvoer gecontroleerd moet worden?', 'veryo' ),
					__( 'Is er iemand verantwoordelijk voor AI-gebruik?', 'veryo' ),
					__( 'Kun je laten zien welke training of uitleg medewerkers hebben gehad?', 'veryo' ),
				),
			),
		),
		'price'    => array(
			'steps' => array( 2, 1 ),
			'p'     => __( 'Mogelijk is er subsidie via de SLIM-regeling voor trainingen; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie.', 'veryo' ),
		),
		'faq'      => array(
			array( __( 'Geldt de AI-geletterdheidsplicht ook voor kleine bedrijven?', 'veryo' ), __( 'Ja. Artikel 4 van de AI Act geldt voor organisaties die AI inzetten, ongeacht hun grootte. Wat voldoende is, hangt wel af van hoe en hoeveel je AI gebruikt.', 'veryo' ) ),
			array( __( 'Is het gebruik van ChatGPT ook “AI inzetten”?', 'veryo' ), __( 'Als medewerkers ChatGPT, Copilot of een vergelijkbare tool voor hun werk gebruiken, zet je organisatie AI in. Ook dan is het verstandig om te zorgen dat ze weten hoe ze er verantwoord mee werken.', 'veryo' ) ),
			array( __( 'Krijgen deelnemers een certificaat?', 'veryo' ), __( 'Je krijgt een deelnameoverzicht per sessie voor je eigen dossier. Er bestaat geen officieel wettelijk certificaat voor AI-geletterdheid.', 'veryo' ) ),
			array( __( 'Hoe vaak moet de training herhaald worden?', 'veryo' ), __( 'De wet noemt geen termijn. Omdat AI-tools snel veranderen, raden we een jaarlijkse update-sessie aan, en een instroommoment voor nieuwe medewerkers.', 'veryo' ) ),
			array( __( 'Kunnen jullie ook een AI-beleid opstellen?', 'veryo' ), __( 'We leveren een opzet die je in de training met het team invult. Voor de juridische kant raden we aan dat een jurist er daarna naar kijkt.', 'veryo' ) ),
		),
		'links'    => array(
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Alle trainingsvormen', 'veryo' ) ),
			array( 'academy', __( 'Online AI-cursus', 'veryo' ), __( 'Voor nieuwe medewerkers, binnenkort', 'veryo' ) ),
			array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Training op locatie in Drenthe', 'veryo' ) ),
		),
	)
);

/*
 * Academy
 */
$veryo_academy  = veryo_sec_answer( __( 'De Veryo Academy wordt een online AI-cursus voor beginners: korte modules van 10 tot 15 minuten met oefeningen, als video met slides en voice-over. De cursus is nog in ontwikkeling. De verwachte prijs is €79 tot €129 eenmalig, met een introductieprijs van €49 tot €59, exclusief btw.', 'veryo' ) );
$veryo_academy .= veryo_sec_text(
	__( 'Een online AI-cursus voor mensen die gewoon willen beginnen', 'veryo' ),
	array(
		__( 'Niet iedereen kan een dag vrijmaken voor een training. En niet ieder bedrijf wil voor twee mensen een incompany sessie organiseren. Daarom bouwen we een online AI-cursus die je in je eigen tempo volgt, bijvoorbeeld een module per dag bij de koffie.', 'veryo' ),
		__( 'De cursus is bedoeld voor beginners: ondernemers, kantoormedewerkers, planners en iedereen die AI wil gebruiken zonder technische achtergrond. Je leert met voorbeelden uit het MKB, niet uit Silicon Valley.', 'veryo' ),
	)
);
$veryo_academy .= veryo_sec_text(
	__( 'Hoe de AI-cursus voor beginners eruitziet', 'veryo' ),
	array(),
	array(
		__( 'Korte modules van 10 tot 15 minuten, zodat het tussen het werk door past.', 'veryo' ),
		__( 'Elke module met een oefening die je direct in je eigen werk kunt doen.', 'veryo' ),
		__( 'Video met slides en voice-over, ook terug te kijken.', 'veryo' ),
		__( 'Onderwerpen: wat AI is, goede opdrachten schrijven, mail en teksten, samenvatten, veilig werken met gegevens en de basis van de AI Act.', 'veryo' ),
	),
	'checks'
);
$veryo_academy .= veryo_sec_photo( __( 'laptop op een keukentafel met een module van de online cursus in beeld', 'veryo' ), __( 'Online AI-cursus van de Veryo Academy', 'veryo' ) );
$veryo_academy .= veryo_b_group(
	veryo_b_h( __( 'Zet je op de wachtlijst', 'veryo' ) )
	. veryo_b_p( __( 'Je krijgt één bericht zodra de cursus beschikbaar is, met de introductieprijs. Geen nieuwsbrief, geen verplichting.', 'veryo' ) )
	. veryo_b_shortcode( '[veryo_form type="academy"]' ),
	array( 'className' => 'is-style-paper veryo-form-wrap' )
);
$veryo_academy .= veryo_sec_faq(
	array(
		array( __( 'Wanneer is de cursus beschikbaar?', 'veryo' ), __( 'We werken eraan. Wie op de wachtlijst staat, hoort het als eerste. We noemen geen datum die we niet zeker weten.', 'veryo' ) ),
		array( __( 'Wat gaat de online AI-cursus kosten?', 'veryo' ), __( 'De verwachte prijs is €79 tot €129 eenmalig, met een introductieprijs van €49 tot €59, exclusief btw. De definitieve prijs hoor je voordat je iets koopt.', 'veryo' ) ),
		array( __( 'Is de cursus geschikt voor de AI-geletterdheidsplicht?', 'veryo' ), __( 'De cursus behandelt de basis van veilig en verantwoord AI-gebruik en kan een onderdeel zijn van hoe je werkt aan AI-geletterdheid. Voor een team is een incompany training vaak effectiever.', 'veryo' ) ),
		array( __( 'Is dit een cursus voor programmeurs?', 'veryo' ), __( 'Nee. De cursus is voor beginners zonder technische achtergrond.', 'veryo' ) ),
	)
);
$veryo_academy .= veryo_sec_links(
	array(
		array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Incompany, met je eigen team', 'veryo' ) ),
		array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Voor de AI Act', 'veryo' ) ),
	)
);

/*
 * AI op maat
 */
$veryo_opmaat = veryo_page_standard(
	array(
		'answer'   => __( 'Veryo bouwt AI op maat voor het MKB: een maatwerk AI-oplossing zoals een chatbot op je eigen kennis, een WhatsApp-assistent, een AI-agent of een interne AI-assistent voor je bedrijf. Maatwerk kost €5.000 tot €25.000 of meer, exclusief btw, afhankelijk van koppelingen en omvang.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Wanneer kies je voor een maatwerk AI-oplossing?', 'veryo' ),
			'p' => array(
				__( 'Een standaardautomatisering is genoeg als het werk steeds hetzelfde verloopt. Maar soms is de vraag breder. Klanten stellen vragen die je alleen met jullie eigen kennis kunt beantwoorden. Collega’s zoeken dagelijks in handleidingen en procedures. Of een heel proces, van aanvraag tot planning, moet slimmer zonder dat er vijf losse tools bij komen.', 'veryo' ),
				__( 'Dan bouwen we AI op maat: een assistent, chatbot of agent die werkt met jullie gegevens, in jullie toon, en die weet wanneer hij een mens moet inschakelen.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'medewerker aan de balie die op een tablet een antwoord van de interne assistent bekijkt', 'veryo' ), __( 'Maatwerk AI-oplossing: AI-assistent voor bedrijf', 'veryo' ) ),
		'sections' => array(
			array(
				'h'     => __( 'Wat we op maat bouwen', 'veryo' ),
				'list'  => array(
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/chatbot' ) ) . '">' . __( 'AI-chatbot voor je website', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Beantwoordt vragen op basis van jullie eigen informatie', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/whatsapp-assistent' ) ) . '">' . __( 'WhatsApp-assistent', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Vragen, gegevens en foto’s verzamelen, afspraken plannen', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/ai-agents' ) ) . '">' . __( 'AI-agents', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Voeren meerdere stappen van een proces zelfstandig uit', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/interne-assistent' ) ) . '">' . __( 'Interne AI-assistent', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Een chatbot op je eigen documenten en procedures', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/ai-receptionist-horeca' ) ) . '">' . __( 'AI-receptionist voor horeca', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Neemt de telefoon aan en noteert reserveringen', 'veryo' ) . '</span>',
				),
				'style' => 'grid',
			),
			array(
				'h' => __( 'Hoe we een AI-assistent voor je bedrijf bouwen', 'veryo' ),
				'p' => array(
					__( 'We beginnen klein: een eerste versie met een beperkt aantal onderwerpen, getest door je eigen team. Pas als de antwoorden kloppen, gaat hij naar klanten of breder in het bedrijf. Daarna breiden we uit.', 'veryo' ),
					__( 'Elke assistent heeft duidelijke grenzen. Hij geeft geen prijzen of toezeggingen die niet in de bronnen staan, verwijst bij twijfel door en logt de gesprekken, zodat je kunt zien wat er gevraagd wordt en waar hij tekortschiet. Gevoelige gegevens verwerken we alleen met een verwerkersovereenkomst en zakelijke API’s.', 'veryo' ),
				),
			),
		),
		'catalog'  => array(
			'h'   => __( 'Bouwstenen uit de catalogus', 'veryo' ),
			'ids' => array( 'website-chatbot', 'whatsapp-assistent', 'voicebot', 'interne-assistent', 'planningsassistent' ),
		),
		'price'    => array( 'steps' => array( 3, 6, 7 ) ),
		'faq'      => array(
			array( __( 'Wat is het verschil tussen een chatbot en een AI-agent?', 'veryo' ), __( 'Een chatbot beantwoordt vragen. Een AI-agent voert ook stappen uit, zoals gegevens opzoeken, een afspraak inplannen of een concept klaarzetten in een ander systeem. Agents krijgen altijd duidelijke grenzen en controlemomenten.', 'veryo' ) ),
			array( __( 'Kan de assistent met onze eigen documenten werken?', 'veryo' ), __( 'Ja. We koppelen de assistent aan de bronnen die jij kiest, zoals handleidingen, procedures, prijslijsten of je website. Hij gebruikt alleen die bronnen en verwijst ernaar.', 'veryo' ) ),
			array( __( 'Wat gebeurt er als de AI een fout antwoord geeft?', 'veryo' ), __( 'We testen vooraf met echte vragen, stellen grenzen in en loggen de gesprekken. Bij twijfel verwijst de assistent naar een mens. Fouten die we in de logs zien, gebruiken we om de bronnen te verbeteren.', 'veryo' ) ),
			array( __( 'Wie betaalt de kosten van het AI-gebruik?', 'veryo' ), __( 'De verbruikskosten van de AI-dienst lopen via je eigen account of via ons onderhoudsabonnement. Voor een MKB-bedrijf zijn die kosten meestal beperkt; we geven vooraf een inschatting.', 'veryo' ) ),
			array( __( 'Hoe lang duurt het bouwen?', 'veryo' ), __( 'Een eerste werkende versie staat meestal binnen vier tot acht weken, afhankelijk van de koppelingen. Je krijgt vooraf een planning.', 'veryo' ) ),
		),
		'links'    => array(
			array( 'ai-op-maat/chatbot', __( 'AI-chatbot laten maken', 'veryo' ), __( 'Wat het kost en wat je krijgt', 'veryo' ) ),
			array( 'ai-automatisering', __( 'AI-automatisering', 'veryo' ), __( 'Als een standaardflow volstaat', 'veryo' ) ),
			array( 'branches/makelaardij', __( 'AI voor makelaars', 'veryo' ), __( 'Inbox, bezichtigingen en teksten', 'veryo' ) ),
		),
	)
);

/*
 * Prijzen
 */
$veryo_prices  = veryo_sec_answer( __( 'Wat kost AI voor je bedrijf? Bij Veryo begin je met een gratis AI-scan. Een afgebakende AI-automatisering kost €750 tot €1.500, een project €2.500 tot €7.500, AI op maat vanaf €5.000 en een incompany training €1.200 tot €2.800. Alle prijzen zijn exclusief btw en een indicatie.', 'veryo' ) );
$veryo_prices .= veryo_sec_text(
	__( 'Van instap naar partner', 'veryo' ),
	array( __( 'Je hoeft niet alles tegelijk te doen. De meeste bedrijven beginnen met de scan of een training, doen daarna één automatisering en bouwen uit als het werkt. Hieronder staan de stappen op volgorde, met voor wie ze zijn.', 'veryo' ) )
);
$veryo_prices .= veryo_sec_ladder();
$veryo_prices .= veryo_b_p( __( 'Alle bedragen zijn exclusief btw en bedoeld als indicatie. Voordat we beginnen, krijg je altijd een vaste prijs op papier.', 'veryo' ), array( 'className' => 'veryo-small' ) );
$veryo_prices .= veryo_sec_text(
	__( 'Wat bepaalt de kosten van AI-automatisering?', 'veryo' ),
	array(
		__( 'De prijs hangt vooral af van het aantal stappen en koppelingen. Eén flow die inkoopfacturen uit de mail naar Moneybird zet, is een quick win. Een traject van aanvraag via offerte en werkbon naar factuur, met koppelingen tussen drie systemen, is een project. Een chatbot die op jullie eigen kennis antwoord geeft en afspraken inplant, is maatwerk.', 'veryo' ),
		__( 'Daarnaast zijn er verbruikskosten voor software zoals Make, Zapier of de AI-dienst. Die lopen bij voorkeur via je eigen account, zodat je precies ziet wat je betaalt. Voor een MKB-bedrijf gaat het meestal om tientallen euro’s per maand; we geven vooraf een inschatting.', 'veryo' ),
		__( 'Mogelijk subsidie via de SLIM-regeling voor trainingen; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie.', 'veryo' ),
	)
);
$veryo_prices .= veryo_sec_text(
	__( 'Wat kost een chatbot laten maken?', 'veryo' ),
	array( __( 'Een chatbot op je website die antwoord geeft op basis van je eigen informatie, valt meestal onder een project (€2.500 tot €7.500). Moet hij ook koppelen met je agenda, CRM of WhatsApp, of meerdere talen spreken, dan wordt het maatwerk (vanaf €5.000). Op de pagina over de AI-chatbot lees je wat je voor dat bedrag krijgt.', 'veryo' ) )
);
$veryo_prices .= veryo_sec_faq(
	array(
		array( __( 'Zijn de prijzen inclusief btw?', 'veryo' ), __( 'Nee, alle prijzen zijn exclusief btw.', 'veryo' ) ),
		array( __( 'Waarom staan er bandbreedtes en geen vaste bedragen?', 'veryo' ), __( 'Omdat de omvang per bedrijf verschilt. Na de AI-scan of een kort gesprek krijg je een vaste prijs voor jouw situatie. Daar blijven we aan vast zitten, tenzij je zelf iets toevoegt.', 'veryo' ) ),
		array( __( 'Zijn er terugkerende kosten?', 'veryo' ), __( 'Alleen als je dat wilt: onderhoud en hosting kost €150 tot €500 per maand, en een AI-partner-abonnement €750 tot €2.000 per maand. Daarnaast zijn er verbruikskosten voor de gebruikte software, bij voorkeur op je eigen account.', 'veryo' ) ),
		array( __( 'Wat kost AI-automatisering per maand?', 'veryo' ), __( 'De bouw betaal je eenmalig. Daarna zijn er verbruikskosten van de software, meestal tientallen euro’s per maand, en optioneel een onderhoudsabonnement van €150 tot €500 per maand.', 'veryo' ) ),
		array( __( 'Wanneer verdient een automatisering zich terug?', 'veryo' ), __( 'Dat reken je uit met het aantal uren dat het scheelt. Een quick win van €1.000 die drie uur per week bespaart, verdient zich bij een kostprijs van €45 per uur in ongeveer acht weken terug. Dat is een rekenvoorbeeld, geen belofte.', 'veryo' ) ),
	)
);
$veryo_prices .= veryo_sec_cta_scan( __( 'Weet wat het jou oplevert', 'veryo' ), __( 'De gratis AI-scan rekent uit hoeveel uur en euro’s er bij jou te halen is, en welke stap daarbij past.', 'veryo' ) );
$veryo_prices .= veryo_sec_links(
	array(
		array( 'ai-automatisering', __( 'AI-automatisering', 'veryo' ), __( 'Wat we per onderdeel automatiseren', 'veryo' ) ),
		array( 'ai-training', __( 'AI-training', 'veryo' ), __( 'Halve of hele dag, tot 20 personen', 'veryo' ) ),
		array( 'ai-op-maat/chatbot', __( 'AI-chatbot laten maken', 'veryo' ), __( 'Kosten en aanpak', 'veryo' ) ),
	)
);

/*
 * Over Veryo
 */
$veryo_about  = veryo_sec_answer( __( 'Veryo is een AI-bureau uit Leeuwarden voor het MKB in Noord-Nederland. We helpen bedrijven tot ongeveer vijftig mensen met AI-automatiseringen, AI-trainingen en AI op maat, met vaste prijzen en resultaten die je in uren en euro’s kunt meten.', 'veryo' ) );
$veryo_about .= veryo_sec_text(
	__( 'Waarom Veryo bestaat', 'veryo' ),
	array(
		__( 'De naam Veryo komt van het Latijnse vero: waar, echt, werkelijk. Dat is ook wat we willen zijn in een markt vol grote beloftes. AI kan veel, maar niet alles, en lang niet elke toepassing is de moeite waard voor een bedrijf met tien of twintig mensen.', 'veryo' ),
		__( 'We zien bij ondernemers in Friesland, Groningen en Drenthe hetzelfde patroon: ze horen overal dat ze iets met AI moeten, maar niemand vertelt ze wat, wat het kost en wat het oplevert. Veryo is de nuchtere partner die dat wel doet. Eerst snappen, dan slim inzetten.', 'veryo' ),
	)
);
$veryo_about .= veryo_sec_photo( __( 'portret van de oprichter in de werkplaats of op kantoor in Leeuwarden', 'veryo' ), __( 'Oprichter van Veryo, AI-bureau in Leeuwarden', 'veryo' ) );
$veryo_about .= veryo_sec_text(
	__( 'Wie er achter Veryo zit', 'veryo' ),
	array(
		__( '[VUL IN: korte introductie van de oprichter (Csaba): achtergrond, ervaring en waarom je Veryo bent begonnen, in 3–4 zinnen]', 'veryo' ),
	)
);
$veryo_about .= veryo_sec_text(
	__( 'Hoe we werken', 'veryo' ),
	array(),
	array(
		'<strong>' . __( 'Van leren naar doen bij één partij.', 'veryo' ) . '</strong> ' . __( 'Training, implementatie en onderhoud, zonder dat je drie bureaus hoeft aan te sturen.', 'veryo' ),
		'<strong>' . __( 'Vaste pakketprijzen.', 'veryo' ) . '</strong> ' . __( 'Je weet vooraf wat het kost.', 'veryo' ),
		'<strong>' . __( 'Sterk in bouw, installatie, agri en techniek.', 'veryo' ) . '</strong> ' . __( 'We kennen de praktijk van werkbonnen, calculaties en storingen.', 'veryo' ),
		'<strong>' . __( 'Eerlijk over grenzen.', 'veryo' ) . '</strong> ' . __( 'Als iets niet de moeite waard is om te automatiseren, zeggen we dat.', 'veryo' ),
		'<strong>' . __( 'AVG-bewust.', 'veryo' ) . '</strong> ' . __( 'Zakelijke API’s, verwerkersovereenkomsten waar nodig en jouw data blijft van jou.', 'veryo' ),
	),
	'checks'
);
$veryo_about .= veryo_sec_regions( __( 'Een AI-bureau in Leeuwarden, voor het hele noorden', 'veryo' ) );
$veryo_about .= veryo_sec_cases();
$veryo_about .= veryo_sec_cta_scan( __( 'Kennismaken?', 'veryo' ), __( 'De snelste manier om te zien of we iets voor je kunnen betekenen, is de gratis AI-scan. Liever eerst even praten? Dat kan ook via de contactpagina.', 'veryo' ) );
$veryo_about .= veryo_sec_links(
	array(
		array( 'contact', __( 'Contact', 'veryo' ), __( 'Mail, bel of vul het formulier in', 'veryo' ) ),
		array( 'leeuwarden', __( 'AI-training in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ),
		array( 'prijzen', __( 'Prijzen', 'veryo' ), __( 'Vaste pakketprijzen', 'veryo' ) ),
	)
);

/*
 * Contact
 */
$veryo_contact  = veryo_b_p( __( 'Heb je een vraag, wil je een training plannen of eerst even sparren? Stuur een bericht of neem direct contact op. We reageren binnen één werkdag.', 'veryo' ), array( 'fontSize' => 'body-l' ) );
$veryo_contact .= veryo_b_columns(
	array(
		array(
			'width' => '60%',
			'inner' => veryo_b_group(
				veryo_b_h( __( 'Stuur een bericht', 'veryo' ) ) . veryo_b_shortcode( '[veryo_form type="contact"]' ),
				array( 'className' => 'is-style-paper veryo-form-wrap' )
			),
		),
		array(
			'width' => '40%',
			'inner' => veryo_b_h( __( 'Direct contact', 'veryo' ) ) . veryo_b_shortcode( '[veryo_contact_details]' )
				. veryo_b_h( __( 'Liever eerst weten wat AI je oplevert?', 'veryo' ), 3, array( 'fontSize' => 'heading' ) )
				. veryo_b_p( __( 'Doe de gratis AI-scan en krijg binnen enkele minuten een rapport met je drie grootste tijdwinsten.', 'veryo' ) )
				. veryo_b_buttons( array( array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'link' ) ) ),
		),
	),
	array( 'className' => 'veryo-contact' )
);

/*
 * Branches (overzicht)
 */
$veryo_branches  = veryo_sec_answer( __( 'AI per branche: Veryo zet AI in voor installatie, bouw, agri, makelaardij, zakelijke dienstverlening, horeca en retail, transport en werving. Per sector verschillen de tijdvreters, dus per sector verschillen de toepassingen. Een eerste automatisering begint bij €750, exclusief btw.', 'veryo' ) );
$veryo_branches .= veryo_sec_text(
	__( 'Waarom per branche kijken?', 'veryo' ),
	array(
		__( 'Een installateur verliest tijd aan werkbonnen en storingsmeldingen, een makelaar aan een inbox die via vijf kanalen volloopt, een accountantskantoor aan verslagen en samenvattingen. De techniek is vaak dezelfde, maar wat het oplevert verschilt per sector. Daarom beginnen we bij jouw werk en jouw software.', 'veryo' ),
		__( 'We zijn het sterkst in bouw, installatie, agri en techniek, maar werken voor het hele MKB. Staat jouw branche er niet tussen? Doe dan de AI-scan en kies “overig”. De aanbevelingen komen dan uit je antwoorden over taken en uren.', 'veryo' ),
	)
);
$veryo_branches .= veryo_sec_branches( __( 'Kies je branche', 'veryo' ) );
$veryo_branches .= veryo_sec_steps();
$veryo_branches .= veryo_sec_cta_scan();

/*
 * Bedankt
 */
$veryo_thanks  = veryo_b_p( __( 'Dank je wel. We hebben je gegevens ontvangen.', 'veryo' ), array( 'fontSize' => 'body-l' ) );
$veryo_thanks .= veryo_b_p( __( 'Heb je de AI-scan gedaan? Dan staat je volledige rapport binnen enkele minuten in je mailbox. Zie je niets? Kijk dan even in je map met ongewenste mail.', 'veryo' ) );
$veryo_thanks .= veryo_b_p( __( 'Heb je een bericht gestuurd? Dan reageren we binnen één werkdag.', 'veryo' ) );
$veryo_thanks .= veryo_b_shortcode( '[veryo_calendly_button]' );
$veryo_thanks .= veryo_sec_links(
	array(
		array( 'ai-automatisering', __( 'Wat we automatiseren', 'veryo' ), '' ),
		array( 'prijzen', __( 'Prijzen', 'veryo' ), '' ),
		array( 'over-veryo', __( 'Over Veryo', 'veryo' ), '' ),
	),
	__( 'Alvast verder kijken', 'veryo' )
);

return array(
	''                             => array(
		'title'     => __( 'AI die echt werkt', 'veryo' ),
		'seo_title' => __( 'AI-bureau voor het MKB in Noord-Nederland | Veryo', 'veryo' ),
		'desc'      => __( 'Veryo is het nuchtere AI-bureau voor het MKB in Noord-Nederland: automatiseringen, trainingen en AI op maat met vaste prijzen. Doe de gratis AI-scan.', 'veryo' ),
		'kw'        => 'ai bureau mkb',
		'meta'      => array( 'hide_title' => 1 ),
		'content'   => $veryo_home,
	),
	'waar-begin-ik-met-ai'         => array(
		'title'     => __( 'Wil je iets met AI, maar weet je niet wat?', 'veryo' ),
		'seo_title' => __( 'Waar begin je met AI? Doe de gratis AI-scan | Veryo', 'veryo' ),
		'desc'      => __( 'Waar begin ik met AI in mijn bedrijf? Doe de gratis AI-scan in 3 minuten en krijg een persoonlijk rapport met je 3 grootste tijdwinsten in uren en euro’s.', 'veryo' ),
		'kw'        => 'waar begin ik met ai in mijn bedrijf',
		'meta'      => array( 'hide_title' => 1 ),
		'content'   => $veryo_scan,
	),
	'ai-automatisering'            => array(
		'title'     => __( 'AI-automatisering voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-automatisering voor het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'AI-automatisering voor het MKB: mail, offertes, facturen en planning automatiseren in je eigen software. Vaste prijzen vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'ai automatisering mkb',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 7500,
		),
		'content'   => $veryo_auto,
	),
	'ai-implementatie-mkb'         => array(
		'title'     => __( 'AI-implementatie voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-implementatie voor het MKB: van plan tot live | Veryo', 'veryo' ),
		'desc'      => __( 'AI-implementatie voor het MKB: Veryo zoekt uit waar AI het meest oplevert, bouwt het in je eigen software en borgt het. Kansensessie vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'ai implementatie mkb',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'   => $veryo_impl,
	),
	'ai-training'                  => array(
		'title'     => __( 'AI-training voor bedrijven', 'veryo' ),
		'seo_title' => __( 'AI-training en workshops voor bedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'AI-training voor bedrijven: praktische incompany training of workshop in ChatGPT, Claude of Copilot voor teams tot 20 mensen. Halve dag €1.200 excl. btw.', 'veryo' ),
		'kw'        => 'ai training voor bedrijven',
		'schema'    => array(
			'type' => 'service',
			'min'  => 1200,
			'max'  => 2800,
		),
		'content'   => $veryo_training,
	),
	'ai-training/ai-geletterdheid' => array(
		'title'     => __( 'AI-geletterdheid: training voor je team', 'veryo' ),
		'seo_title' => __( 'AI-geletterdheid training (AI Act) | Veryo', 'veryo' ),
		'desc'      => __( 'AI-geletterdheid training voor je team: voldoe aan artikel 4 van de AI Act met een praktische training over veilig AI-gebruik. Halve dag €1.200 excl. btw.', 'veryo' ),
		'kw'        => 'ai geletterdheid training',
		'schema'    => array(
			'type' => 'service',
			'min'  => 1200,
			'max'  => 2800,
		),
		'content'   => $veryo_literacy,
	),
	'academy'                      => array(
		'title'     => __( 'Veryo Academy: online AI-cursus', 'veryo' ),
		'seo_title' => __( 'Online AI-cursus voor beginners | Veryo Academy', 'veryo' ),
		'desc'      => __( 'Online AI-cursus voor beginners van de Veryo Academy: korte modules van 10–15 minuten met oefeningen. Binnenkort beschikbaar, zet je nu op de wachtlijst.', 'veryo' ),
		'kw'        => 'ai cursus online',
		'content'   => $veryo_academy,
	),
	'ai-op-maat'                   => array(
		'title'     => __( 'AI op maat', 'veryo' ),
		'seo_title' => __( 'AI op maat: chatbots, agents en assistenten | Veryo', 'veryo' ),
		'desc'      => __( 'Een maatwerk AI-oplossing voor je bedrijf: chatbot, WhatsApp-assistent, AI-agent of interne assistent op je eigen kennis. Vanaf €5.000 excl. btw.', 'veryo' ),
		'kw'        => 'maatwerk ai oplossing',
		'schema'    => array(
			'type' => 'service',
			'min'  => 5000,
			'max'  => 25000,
		),
		'content'   => $veryo_opmaat,
	),
	'prijzen'                      => array(
		'title'     => __( 'Wat kost AI voor je bedrijf?', 'veryo' ),
		'seo_title' => __( 'Prijzen AI-automatisering en training | Veryo', 'veryo' ),
		'desc'      => __( 'Wat kost AI-automatisering? Van gratis AI-scan tot partner-abonnement: quick win €750–1.500, project €2.500–7.500, training vanaf €1.200. Alles excl. btw.', 'veryo' ),
		'kw'        => 'ai automatisering kosten',
		'content'   => $veryo_prices,
	),
	'over-veryo'                   => array(
		'title'     => __( 'Over Veryo', 'veryo' ),
		'seo_title' => __( 'Over Veryo, AI-partner uit Leeuwarden', 'veryo' ),
		'desc'      => __( 'Over Veryo: het nuchtere AI-bureau uit Leeuwarden voor het MKB in Friesland, Groningen en Drenthe. Eerst snappen, dan slim inzetten, met vaste prijzen.', 'veryo' ),
		'kw'        => 'veryo',
		'content'   => $veryo_about,
	),
	'contact'                      => array(
		'title'     => __( 'Contact', 'veryo' ),
		'seo_title' => __( 'Contact | Veryo', 'veryo' ),
		'desc'      => __( 'Neem contact op met Veryo, AI voor het MKB, uit Leeuwarden. Stel je vraag over AI-automatisering, training of AI op maat; we reageren binnen één werkdag.', 'veryo' ),
		'kw'        => 'veryo contact',
		'content'   => $veryo_contact,
	),
	'branches'                     => array(
		'title'     => __( 'AI per branche', 'veryo' ),
		'seo_title' => __( 'AI per branche: toepassingen voor jouw sector | Veryo', 'veryo' ),
		'desc'      => __( 'AI per branche: toepassingen voor installatie, bouw, agri, makelaardij, accountancy, horeca, transport en werving. Zie wat AI in jouw sector oplevert.', 'veryo' ),
		'kw'        => 'ai per branche',
		'content'   => $veryo_branches,
	),
	'bedankt'                      => array(
		'title'     => __( 'Bedankt', 'veryo' ),
		'seo_title' => __( 'Bedankt | Veryo', 'veryo' ),
		'desc'      => __( 'Bedankt voor je bericht of het invullen van de AI-scan van Veryo. Je rapport staat binnen enkele minuten in je mailbox; we reageren binnen één werkdag.', 'veryo' ),
		'kw'        => '',
		'meta'      => array( 'noindex' => 1 ),
		'content'   => $veryo_thanks,
	),
	'rapport'                      => array(
		'title'     => __( 'Je AI-scan-rapport', 'veryo' ),
		'seo_title' => __( 'Je AI-scan-rapport | Veryo', 'veryo' ),
		'desc'      => __( 'Je persoonlijke rapport van de AI-scan van Veryo, met je geschatte tijdwinst en drie aanbevelingen. Alleen bereikbaar via je persoonlijke link.', 'veryo' ),
		'kw'        => '',
		'meta'      => array(
			'noindex'    => 1,
			'nofollow'   => 1,
			'hide_title' => 1,
		),
		'content'   => veryo_b_shortcode( '[veryo_rapport]' ),
	),
	'blog'                         => array(
		'title'     => __( 'Blog', 'veryo' ),
		'seo_title' => __( 'Blog over AI in het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'Nuchtere artikelen over AI in het MKB: waar je begint, wat het kost, wat mag volgens de AVG en de AI Act, en voorbeelden per branche. Door Veryo.', 'veryo' ),
		'kw'        => '',
		'content'   => '',
	),
);
