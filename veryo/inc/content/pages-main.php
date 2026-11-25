<?php
/**
 * Hoofdpagina's: home, AI-scan, diensten, prijzen, over, contact en overzichten.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_home_faq = array(
	array( __( 'Is AI iets voor mijn bedrijf?', 'veryo' ), __( 'Als er in je bedrijf werk is dat elke week terugkomt, zoals mail beantwoorden, offertes maken of facturen verwerken, dan is de kans groot dat AI daar tijd bespaart. Of het de moeite waard is, hangt af van hoeveel uur het nu kost. De gratis AI-scan geeft daar in drie minuten een eerste antwoord op.', 'veryo' ) ),
	array( __( 'Wat kost het?', 'veryo' ), __( 'De AI-scan is gratis. Voor alles daarna krijg je een gratis offerte op maat, met vooraf een vaste prijs.', 'veryo' ) ),
	array( __( 'Verkopen jullie software?', 'veryo' ), __( 'Nee. We verkopen geen eigen software en adviseren onafhankelijk welke tools bij jullie passen. Vaak is dat software die je al hebt. Worden we ooit partner van een leverancier waar we een vergoeding voor krijgen, dan zeggen we dat erbij.', 'veryo' ) ),
	array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo is geen IT-bedrijf: we doen geen algemeen IT-beheer, netwerken, helpdesk of storingsdienst. Alleen de machine waarop [veryo_collega_naam] draait, beheren we zelf. We werken wel prettig samen met je vaste IT-beheerder, bijvoorbeeld bij het inrichten van Claude Team of het op orde brengen van toegangsrechten.', 'veryo' ) ),
	array( __( 'Is het veilig met onze gegevens?', 'veryo' ), __( 'We werken met zakelijke versies en API’s waarbij je gegevens niet worden gebruikt om AI-modellen te trainen. Bij persoonsgegevens sluiten we een verwerkersovereenkomst. Jij blijft eigenaar van je data, en in het AI-beleid leggen we vast welke gegevens nooit in een AI-tool mogen.', 'veryo' ) ),
	array( __( 'Moeten wij zelf technisch zijn?', 'veryo' ), __( 'Nee. Wij adviseren, richten in en koppelen. Jullie werken in de software die jullie al kennen. Na de oplevering leren we jullie team ermee werken, en we leggen uit wie waarvoor aanspreekpunt is.', 'veryo' ) ),
	array( __( 'Wat is de AI-geletterdheidsplicht?', 'veryo' ), __( 'Artikel 4 van de Europese AI Act geldt sinds 2 februari 2025. Sinds de wijziging door de Digital Omnibus op 27 juli 2026 vraagt het organisaties die AI inzetten om maatregelen te nemen die de AI-geletterdheid van hun medewerkers ondersteunen. Een vast kennisniveau per persoon hoeft niet gegarandeerd te worden, maar de plicht zelf blijft bindend. Dat betekent dat mensen die met AI werken moeten snappen wat het kan, wat niet en waar de risico’s zitten. Bij elke oplevering leggen we uit wat de toepassing doet en waar de grenzen liggen; dat helpt daarbij.', 'veryo' ) ),
	array( __( 'Werken jullie ook buiten Noord-Nederland?', 'veryo' ), __( 'Ja. We zitten in Leeuwarden en komen in Friesland, Groningen en Drenthe op locatie. Online werken we ook voor bedrijven in de rest van Nederland.', 'veryo' ) ),
);

$veryo_home       = veryo_b_group(
	veryo_b_p( __( 'AI-bureau uit Leeuwarden', 'veryo' ), array( 'className' => 'veryo-kicker' ) )
	. veryo_b_h( __( 'AI bouwen en inrichten voor technische bedrijven.', 'veryo' ), 1, array( 'fontSize' => 'display-xl' ) )
	. veryo_b_p( __( 'AI-agents, automatiseringen bovenop de systemen die jullie al hebben, de AI-werkplek met Claude Team en de administratieve kringloop van werkbon tot factuur. Voor technische kantoren en projectbedrijven in Noord-Nederland met 15 tot 50 medewerkers. Overstappen is nooit nodig.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
	. veryo_b_buttons(
		array(
			array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ),
			array( __( 'Bekijk de diensten', 'veryo' ), veryo_link( 'diensten' ), 'link' ),
		)
	)
	. veryo_sec_founder_row(),
	array(
		'tagName'   => 'section',
		'align'     => 'full',
		'className' => 'is-style-petrol veryo-hero has-check veryo-hero--home',
	)
);
$veryo_home      .= veryo_sec_tools_band();
$veryo_home      .= veryo_sec_wide(
	veryo_b_columns(
		array(
			array(
				'width' => '50%',
				'inner' => veryo_b_p( '[veryo_collega_naam]', array( 'className' => 'veryo-kicker' ) )
					. veryo_b_h( __( 'Een AI-collega die alles weet van jouw bedrijf.', 'veryo' ), 2, array( 'fontSize' => 'display-l' ) ),
			),
			array(
				'width' => '50%',
				'inner' => veryo_b_p( __( 'Draait op je eigen kantoor. [veryo_collega_naam] kent jullie documenten, mail en systemen, en je gegevens verlaten het pand niet voor AI-verwerking.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
					. veryo_b_shortcode( '[veryo_collega_cta]' ),
			),
		)
	),
	'veryo-home-partner'
);
$veryo_home      .= veryo_sec_wide(
	veryo_b_columns(
		array(
			array(
				'width' => '50%',
				'inner' => veryo_b_h( __( 'Iedereen roept dat je iets met AI moet. Maar wat dan?', 'veryo' ) ),
			),
			array(
				'width' => '50%',
				'inner' => veryo_b_p( __( 'Veryo bouwt en richt AI in voor technische kantoren en projectbedrijven: ingenieurs- en adviesbureaus, installateurs met eigen engineering, staal- en metaalbouw, interieurbouw, loonbedrijven en vergelijkbare bedrijven met 15 tot 50 medewerkers. We bouwen geen nieuwe software, maar zetten AI in bovenop wat jullie al gebruiken: bij het lezen van bestekken, de calculatie, de werkvoorbereiding en de administratie. Na de oplevering leren we jullie team ermee werken.', 'veryo' ) )
					. veryo_b_p( __( 'Weet je nog niet waar je moet beginnen? Doe dan de gratis AI-scan. Je beantwoordt negen korte vragen over je bedrijf en krijgt een persoonlijk rapport met je drie grootste tijdwinsten, wat ze ongeveer opleveren en hoe je begint.', 'veryo' ) )
					. veryo_b_buttons( array( array( __( 'Zo werkt de AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ) ) ) ),
			),
		),
		array( 'className' => 'veryo-head' )
	),
	'veryo-intro veryo-intro-split'
);
$veryo_home_photo = veryo_photo_id( 'team' );
if ( $veryo_home_photo ) {
	$veryo_home .= veryo_b_image( $veryo_home_photo, __( 'AI-bureau voor het MKB: team aan tafel aan het werk met laptops', 'veryo' ), 'veryo-img veryo-img--wide', 'wide' );
}
$veryo_home .= veryo_sec_contrast();
$veryo_home .= veryo_sec_startpakket( __( 'Het Veryo AI-Startpakket', 'veryo' ), __( 'Eerst één ding goed neerzetten? Met het AI-Startpakket bouwen of richten we één afgebakende toepassing in, met een AI-beleid en 30 dagen nazorg: vijf onderdelen, met vooraf een vaste prijs in een gratis offerte.', 'veryo' ) );
$veryo_home .= veryo_sec_pillars();
$veryo_home .= veryo_sec_products(
	array(),
	__( 'Kant-en-klare AI-oplossingen', 'veryo' ),
	__( 'Voor werk dat in veel bedrijven hetzelfde gaat, hebben we vaste oplossingen. We richten ze in op jouw systemen en houden ze draaiende. Vraag een gratis offerte aan.', 'veryo' )
);
$veryo_home .= veryo_sec_collega_offline();
$veryo_home .= veryo_sec_steps_home();
$veryo_home .= veryo_sec_independent( '', true );
$veryo_home .= veryo_sec_wide(
	veryo_sec_head(
		__( 'Wat er mogelijk is', 'veryo' ),
		veryo_b_p( __( 'Een greep uit wat AI in het MKB kan doen. Vaak kan de software die je al hebt het meeste; waar niet, bouwen we een koppeling. Tijdwinst is een indicatie voor teams van 5 tot 20 mensen.', 'veryo' ) )
	)
	. veryo_b_columns(
		array(
			veryo_b_h( __( 'Klantcontact', 'veryo' ), 3, array( 'fontSize' => 'heading' ) ) . veryo_b_list( array( __( 'Conceptantwoorden op mail in jullie toon', 'veryo' ), __( 'WhatsApp-assistent die 24/7 vragen beantwoordt', 'veryo' ), __( 'Klanten automatisch op de hoogte houden', 'veryo' ) ) ),
			veryo_b_h( __( 'Offertes en administratie', 'veryo' ), 3, array( 'fontSize' => 'heading' ) ) . veryo_b_list( array( __( 'Van aanvraag of foto naar conceptofferte', 'veryo' ), __( 'Inkoopfacturen direct in je boekhoudpakket', 'veryo' ), __( 'Afgeronde werkbon wordt factuur', 'veryo' ) ) ),
			veryo_b_h( __( 'Werk en overzicht', 'veryo' ), 3, array( 'fontSize' => 'heading' ) ) . veryo_b_list( array( __( 'Weekplanning als voorstel klaar', 'veryo' ), __( 'Onderhoud en keuringen vanzelf ingepland', 'veryo' ), __( 'Elke maandag je cijfers in gewone taal', 'veryo' ) ) ),
		)
	)
	. veryo_b_buttons( array( array( __( 'Alles over AI-automatisering en koppelingen', 'veryo' ), veryo_link( 'ai-automatisering' ), 'link' ) ) ),
	'veryo-catalog-teaser veryo-possible'
);
$veryo_home .= veryo_sec_wide(
	veryo_sec_head(
		__( 'Vooraf duidelijk wat het kost', 'veryo' ),
		veryo_b_p( __( 'Je begint met de gratis scan, zet de basis neer met het Startpakket en bouwt uit als het werkt. Voor elke stap krijg je een gratis offerte met vooraf een vaste prijs.', 'veryo' ) )
	)
	. veryo_sec_price_table( array( 'scan', 'startpakket', 'werkplek', 'partner' ) )
	. veryo_b_buttons( array( array( veryo_offerte_label(), veryo_offerte_url() ) ) ),
	'veryo-price-home'
);
$veryo_home .= veryo_sec_contact(
	__( 'Weet je niet welke stap bij jou past?', 'veryo' ),
	__( 'Vertel in een paar zinnen hoe jullie werken. Je krijgt binnen één werkdag een persoonlijk advies over waar je het best kunt beginnen. Gratis en zonder verplichtingen.', 'veryo' ),
	__( 'Bijvoorbeeld: onze werkbonnen komen op papier binnen en worden met de hand overgetypt. Kan dat anders?', 'veryo' )
);
$veryo_home .= veryo_sec_branches( __( 'AI voor jouw branche', 'veryo' ), __( 'We kennen de praktijk van bouw, installatie, agri en techniek het best, maar werken voor het hele MKB.', 'veryo' ), true );
$veryo_home .= veryo_sec_regions( '', '', true );
$veryo_home .= veryo_sec_wide(
	veryo_sec_head( __( 'Waarom Veryo', 'veryo' ), veryo_b_p( __( 'Zes dingen waar je ons aan kunt houden.', 'veryo' ) ) )
	. veryo_b_list(
		array(
			'<strong>' . __( 'Nuchter.', 'veryo' ) . '</strong> ' . __( 'We beginnen bij je werk, niet bij de techniek. Als iets niet de moeite waard is, zeggen we dat.', 'veryo' ),
			'<strong>' . __( 'Onafhankelijk.', 'veryo' ) . '</strong> ' . __( 'We verkopen geen eigen software en adviseren wat bij jou past, ook als dat iets is wat je al hebt.', 'veryo' ),
			'<strong>' . __( 'Vaste prijzen.', 'veryo' ) . '</strong> ' . __( 'Je weet vooraf wat het kost. Geen uurtje-factuurtje zonder einde.', 'veryo' ),
			'<strong>' . __( 'Eerlijk over wat niet kan.', 'veryo' ) . '</strong> ' . __( 'Beslissingen met grote gevolgen laten we niet aan AI over, en wat een paar keer per jaar voorkomt automatiseren we niet.', 'veryo' ),
			'<strong>' . __( 'Van advies tot partner.', 'veryo' ) . '</strong> ' . __( 'Advies, bouwen, inrichten en een vaste vraagbaak bij één partij.', 'veryo' ),
			'<strong>' . __( 'AVG-bewust.', 'veryo' ) . '</strong> ' . __( 'Zakelijke versies, een verwerkersovereenkomst waar nodig en jouw data blijft van jou.', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	),
	'veryo-why'
);
$veryo_home .= veryo_sec_conviction();
$veryo_home .= veryo_sec_cases();
$veryo_home .= veryo_b_shortcode( '[veryo_klantlogos]' );
$veryo_phone = veryo_setting( 'phone' );
$veryo_email = veryo_setting( 'email' );
$veryo_home .= veryo_sec_wide(
	veryo_b_columns(
		array(
			array(
				'width' => '40%',
				'inner' => veryo_b_h( __( 'Veelgestelde vragen', 'veryo' ) )
					. veryo_b_p(
						sprintf(
							/* translators: 1: tel-link, 2: telefoonnummer, 3: e-mailadres. */
							__( 'Staat je vraag er niet bij? Bel <a href="%1$s">%2$s</a> of mail <a href="mailto:%3$s">%3$s</a>. We reageren binnen één werkdag.', 'veryo' ),
							esc_attr( veryo_tel_href( $veryo_phone ) ),
							str_replace( ' ', '&nbsp;', esc_html( $veryo_phone ) ),
							esc_html( $veryo_email )
						),
						array( 'className' => 'veryo-small' )
					),
			),
			array(
				'width' => '60%',
				'inner' => veryo_sec_faq( $veryo_home_faq, false ),
			),
		)
	),
	'veryo-questions'
);
$veryo_home .= veryo_sec_wide(
	veryo_b_h( __( 'Veelgevraagd', 'veryo' ) )
	. veryo_b_list(
		array(
			'<a href="' . esc_url( veryo_link( 'oplossingen/inkoopfacturen-automatiseren' ) ) . '">' . esc_html__( 'Facturen automatiseren', 'veryo' ) . '</a>',
			'<a href="' . esc_url( veryo_link( 'ai-werkplek' ) ) . '">' . esc_html__( 'Claude Team inrichten', 'veryo' ) . '</a>',
			'<a href="' . esc_url( veryo_link( 'branches/installatie' ) ) . '">' . esc_html__( 'AI voor installateurs', 'veryo' ) . '</a>',
			'<a href="' . esc_url( veryo_link( 'branches/transport' ) ) . '">' . esc_html__( 'AI orderinvoer voor transport', 'veryo' ) . '</a>',
		),
		array( 'className' => 'is-style-checks' )
	),
	'veryo-popular'
);
$veryo_home .= veryo_sec_cta_scan( __( 'Begin met de gratis AI-scan', 'veryo' ) );

/*
 * AI-scan: /waar-begin-ik-met-ai/
 */
$veryo_scan_faq = array(
	array( __( 'Is AI iets voor mijn bedrijf?', 'veryo' ), __( 'Dat hangt af van hoeveel terugkerend werk er is. De AI-scan rekent uit hoeveel uur je ongeveer terug kunt winnen op basis van jouw eigen antwoorden. Komt daar weinig uit, dan zeggen we dat ook.', 'veryo' ) ),
	array( __( 'Wat kost het?', 'veryo' ), __( 'De AI-scan en het rapport zijn gratis. Wil je daarna verder, dan plan je een gratis kennismaking of demo. Voor wat we bouwen of inrichten krijg je altijd eerst een gratis offerte met een vaste prijs.', 'veryo' ) ),
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
		array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Alles wat we automatiseren, per afdeling', 'veryo' ) ),
		array( 'prijzen', __( 'Gratis offerte', 'veryo' ), __( 'Een vaste prijs voor jouw situatie', 'veryo' ) ),
		array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
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
	'hr-en-werving'           => __( 'Vacatures, solliciteren via WhatsApp, opvolging en onboarding.', 'veryo' ),
	'rapportages'             => __( 'Dashboards, een maandagbericht met cijfers en Excel zonder gedoe.', 'veryo' ),
);
$veryo_auto_items = array();
foreach ( $veryo_auto_cats as $veryo_slug => $veryo_desc ) {
	$veryo_labels       = veryo_catalog_categories();
	$veryo_auto_items[] = '<a href="' . esc_url( veryo_link( 'ai-automatisering/' . $veryo_slug ) ) . '">' . esc_html( $veryo_labels[ $veryo_slug ] ) . '</a><br><span class="veryo-meta">' . esc_html( $veryo_desc ) . '</span>';
}

$veryo_auto = veryo_page_standard(
	array(
		'answer_cta' => array( __( 'Bespreek jullie proces', 'veryo' ), '#vraag', 'amber' ),
		'contact'    => array(
			__( 'Welke taak kost jullie de meeste tijd?', 'veryo' ),
			__( 'Beschrijf kort welk werk steeds terugkomt. Jullie horen binnen één werkdag of het te automatiseren is, hoe we het zouden aanpakken en wat de volgende stap is.', 'veryo' ),
			__( 'Bijvoorbeeld: we typen werkbonnen over in de boekhouding. Kan dat automatisch?', 'veryo' ),
		),
		'answer'     => __( 'AI automatisering voor het mkb betekent dat terugkerend werk, zoals mail sorteren, offertes voorbereiden, facturen verwerken en planning bijwerken, automatisch gebeurt in de software die jullie al gebruiken. Veryo helpt het mkb met advies, slimme koppelingen en praktische AI-oplossingen. Een mens blijft controleren wat ertoe doet, en jullie krijgen vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
		'problem'    => array(
			'h' => __( 'Herkennen jullie dit?', 'veryo' ),
			'p' => array(
				__( 'Jullie team is druk, maar een flink deel van die drukte is hetzelfde werk, elke week opnieuw. Mail doorzetten naar de juiste collega. Een offerte in elkaar zetten uit een aanvraag die half compleet is. Inkoopfacturen overtypen in het boekhoudpakket. Klanten terugbellen die willen weten wanneer de monteur komt.', 'veryo' ),
				__( 'Dat werk is niet moeilijk, maar het kost uren en het blijft liggen op drukke dagen. Juist daar is AI-automatisering voor het mkb sterk in: het leest, sorteert, vult in en zet klaar. Een mens controleert en beslist.', 'veryo' ),
				sprintf(
					/* translators: %s: link naar AI-implementatie. */
					__( 'Willen jullie AI breder invoeren in het hele bedrijf? Lees dan over %s.', 'veryo' ),
					'<a href="' . esc_url( veryo_link( 'ai-implementatie-mkb' ) ) . '">' . esc_html__( 'AI implementatie in het mkb', 'veryo' ) . '</a>'
				),
			),
		),
		'sections'   => array(
			array(
				'h'     => __( 'Welke bedrijfsprocessen kun je met AI automatiseren?', 'veryo' ),
				'p'     => array( __( 'De meeste winst zit in werk dat elke week terugkomt, uit tekst of documenten bestaat en nu met de hand van het ene naar het andere systeem gaat. Bij mkb-bedrijven zijn dat meestal deze processen:', 'veryo' ) ),
				'list'  => array(
					'<strong>' . __( 'E-mail:', 'veryo' ) . '</strong> ' . __( 'inkomende mail lezen, sorteren, doorzetten en een conceptantwoord klaarzetten.', 'veryo' ),
					'<strong>' . __( 'Intake van aanvragen:', 'veryo' ) . '</strong> ' . __( 'aanvragen uit mail, formulier of WhatsApp compleet maken en in het juiste systeem zetten.', 'veryo' ),
					'<strong>' . __( 'Offertes:', 'veryo' ) . '</strong> ' . __( 'een conceptofferte opstellen uit de aanvraag, jullie prijslijst en eerdere offertes.', 'veryo' ),
					'<strong>' . __( 'Administratie:', 'veryo' ) . '</strong> ' . __( 'inkoopfacturen, bonnetjes en werkbonnen uitlezen en klaarzetten in het boekhoudpakket.', 'veryo' ),
					'<strong>' . __( 'Documentverwerking:', 'veryo' ) . '</strong> ' . __( 'pdf’s, contracten en rapporten samenvatten, controleren en archiveren.', 'veryo' ),
					'<strong>' . __( 'Planning:', 'veryo' ) . '</strong> ' . __( 'afspraken inplannen, bevestigingen en herinneringen versturen.', 'veryo' ),
					'<strong>' . __( 'CRM-overdracht:', 'veryo' ) . '</strong> ' . __( 'leads, gesprekken en afspraken automatisch vastleggen in jullie CRM.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( 'AI automatisering: voorbeelden voor het mkb', 'veryo' ) )
					. veryo_b_p( __( 'Vijf voorbeelden van hoe dat er in de praktijk uitziet. Het zijn voorbeelden van werkwijzen, geen klantcases: per bedrijf kijken we eerst hoe het werk nu loopt.', 'veryo' ) )
					. veryo_sec_usecase(
						'<a href="' . esc_url( veryo_link( 'oplossingen/inkoopfacturen-automatiseren' ) ) . '">' . esc_html__( 'Voorbeeld 1: inkoopfacturen automatisch verwerken', 'veryo' ) . '</a>',
						__( 'facturen komen binnen in de mailbox en worden met de hand overgetypt in de boekhouding.', 'veryo' ),
						__( 'de factuur wordt uitgelezen, gekoppeld aan leverancier en project, gecontroleerd op bedrag en btw en als concept klaargezet.', 'veryo' ),
						__( 'Outlook of Gmail, en SnelStart, Exact Online, Moneybird of een vergelijkbaar pakket.', 'veryo' ),
						__( 'afwijkingen en twijfelgevallen komen op een lijst; de administratie keurt goed.', 'veryo' ),
						__( 'hangt af van het aantal facturen per maand; dat rekenen we vooraf met jullie eigen aantallen uit.', 'veryo' ),
						__( 'het boekhoudpakket heeft een koppeling (API) en er zijn vaste afspraken over kostenplaatsen.', 'veryo' )
					)
					. veryo_sec_usecase(
						'<a href="' . esc_url( veryo_link( 'ai-automatisering/klantcontact' ) ) . '">' . esc_html__( 'Voorbeeld 2: klantcontact, aanvragen sneller beantwoorden', 'veryo' ) . '</a>',
						__( 'aanvragen komen binnen via mail, formulier en WhatsApp en liggen soms dagen op een antwoord te wachten.', 'veryo' ),
						__( 'de aanvraag wordt gelezen, ontbrekende gegevens worden opgevraagd en er staat een conceptantwoord of afspraakvoorstel klaar.', 'veryo' ),
						__( 'jullie mailbox, website, WhatsApp Business en agenda of CRM.', 'veryo' ),
						__( 'een medewerker leest het concept na en verstuurt het, zeker in de eerste weken.', 'veryo' ),
						__( 'vooral snelheid: klanten krijgen eerder antwoord, het team zoekt minder.', 'veryo' ),
						__( 'duidelijke informatie over aanbod, werkgebied en planning, zodat de AI goede antwoorden kan geven.', 'veryo' )
					)
					. veryo_sec_usecase(
						'<a href="' . esc_url( veryo_link( 'oplossingen/werkbonnen-verwerken' ) ) . '">' . esc_html__( 'Voorbeeld 3: werkbonnen verwerken tot factuur', 'veryo' ) . '</a>',
						__( 'monteurs leveren werkbonnen op papier of als foto aan, kantoor typt ze over voor de factuur.', 'veryo' ),
						__( 'de werkbon wordt uitgelezen en wordt een conceptfactuur in jullie eigen boekhouding.', 'veryo' ),
						__( 'WhatsApp of mail, en jullie boekhoud- of planningspakket.', 'veryo' ),
						__( 'twijfel over uren of materiaal gaat naar kantoor voordat de factuur de deur uitgaat.', 'veryo' ),
						__( 'minder overtypen en sneller factureren; de omvang rekenen we vooraf uit.', 'veryo' ),
						__( 'werkbonnen bevatten steeds dezelfde basisgegevens, zoals klant, uren en materiaal.', 'veryo' )
					)
					. veryo_sec_usecase(
						'<a href="' . esc_url( veryo_link( 'ai-automatisering/offertes-en-calculaties' ) ) . '">' . esc_html__( 'Voorbeeld 4: offertes en calculaties voorbereiden', 'veryo' ) . '</a>',
						__( 'elke offerte wordt opnieuw in elkaar gezet uit een aanvraag, een prijslijst en eerdere offertes.', 'veryo' ),
						__( 'de aanvraag wordt gelezen en er staat een conceptofferte klaar op basis van jullie prijslijst, rekenregels en eerdere offertes.', 'veryo' ),
						__( 'mail of websiteformulier, en jullie offerte- of calculatiepakket.', 'veryo' ),
						__( 'prijzen, marges en materiaal worden door de calculator gecontroleerd voordat de offerte de deur uitgaat.', 'veryo' ),
						__( 'minder uitzoekwerk per offerte en sneller reageren; hoeveel, rekenen we vooraf uit met jullie aantallen.', 'veryo' ),
						__( 'een actuele prijslijst en vaste rekenregels.', 'veryo' )
					)
					. veryo_sec_usecase(
						'<a href="' . esc_url( veryo_link( 'oplossingen/ai-lead-opvolging' ) ) . '">' . esc_html__( 'Voorbeeld 5: lead-opvolging', 'veryo' ) . '</a>',
						__( 'aanvragen uit advertenties en de website worden pas uren of een dag later teruggebeld.', 'veryo' ),
						__( 'een nieuwe lead krijgt snel een WhatsApp-bericht of telefoontje, de vaste kwalificatievragen worden gesteld en er wordt een afspraak voorgesteld in jullie agenda.', 'veryo' ),
						__( 'websiteformulier, Google Ads of Meta, WhatsApp Business en jullie agenda of CRM.', 'veryo' ),
						__( 'jullie bepalen de vragen en wie de afspraak krijgt; prijsafspraken maakt altijd een mens.', 'veryo' ),
						__( 'vooral snelheid: de klant hoort snel iets, ook als jullie op een klus staan.', 'veryo' ),
						__( 'duidelijke afspraken over werkgebied, soorten klussen en beschikbaarheid in de agenda.', 'veryo' )
					),
					array( 'className' => 'veryo-section veryo-usecases' )
				),
			),
			array(
				'h'     => __( 'Wat er mogelijk is, per onderdeel van jullie bedrijf', 'veryo' ),
				'p'     => array( __( 'Per onderdeel van jullie bedrijf staat hieronder wat er mogelijk is. Per proces kijken we eerst of jullie bestaande software het al kan.', 'veryo' ) ),
				'list'  => $veryo_auto_items,
				'style' => 'grid',
			),
			array(
				'h' => __( 'AI-agent, chatbot of workflow: wat past bij jullie proces?', 'veryo' ),
				'p' => array(
					sprintf(
						/* translators: 1: link naar AI-agents, 2: link naar chatbot. */
						__( 'Een <strong>workflow</strong> volgt vaste stappen: als er een factuur binnenkomt, gaat hij naar de boekhouding. Een <a href="%2$s">chatbot</a> beantwoordt vragen van klanten of collega’s. Een <a href="%1$s">AI-agent</a> doet allebei: hij leest, beoordeelt en voert een paar stappen zelf uit, en vraagt een mens om goedkeuring waar dat nodig is.', 'veryo' ),
						esc_url( veryo_link( 'ai-agents' ) ),
						esc_url( veryo_link( 'ai-op-maat/chatbot' ) )
					),
					__( 'Vuistregel: zijn de stappen altijd hetzelfde, dan is een workflow genoeg. Moet er gelezen en beoordeeld worden, dan helpt AI in de workflow. Moet er zelfstandig gezocht en gehandeld worden, dan is een agent de juiste keuze.', 'veryo' ),
				),
			),
			array( 'html' => veryo_sec_approach( __( 'Zo pakt Veryo een automatisering aan', 'veryo' ) ) ),
		),
		'no_steps'   => true,
		'extra'      => array(
			__( 'Veiligheid, menselijke controle en beheer', 'veryo' ),
			array(
				__( 'Elke automatisering krijgt een logboek en een vaste eigenaar binnen jullie bedrijf. Zo weten jullie altijd wat er is gebeurd. Beslissingen met grote gevolgen, zoals afwijzingen, incasso of prijsafspraken, blijven bij een mens. Klantgerichte teksten gaan langs een mens voordat ze de deur uitgaan.', 'veryo' ),
				__( 'We werken met zakelijke API’s waarbij jullie gegevens niet worden gebruikt om modellen te trainen, en sluiten een verwerkersovereenkomst zodra er persoonsgegevens door de automatisering gaan. Jullie zijn eigenaar van de data en, waar mogelijk, van de automatiseringen in jullie eigen accounts. Met het onderhoudsabonnement houden wij in de gaten of alles blijft werken als software verandert.', 'veryo' ),
			),
		),
		'price'      => array(
			'h'     => __( 'Wat kost AI-automatisering?', 'veryo' ),
			'steps' => array( 'startpakket', 'quickwin', 'project', 'onderhoud' ),
			'p'     => __( 'De prijs hangt vooral af van vier dingen: hoeveel processen het zijn, hoeveel systemen gekoppeld moeten worden, hoeveel werk er per maand doorheen gaat en hoeveel beheer jullie willen. Een quick win is één afgebakende taak; een project raakt meerdere systemen. Onderhoud dekt bewaking, kleine aanpassingen en updates; grote uitbreidingen vallen erbuiten en krijgen een eigen voorstel.', 'veryo' ),
		),
		'faq'        => array(
			array( __( 'Wat is het verschil tussen AI-automatisering en gewone automatisering?', 'veryo' ), __( 'Gewone automatisering volgt vaste regels: als dit, dan dat. AI-automatisering kan ook ongestructureerde informatie aan, zoals een mail in gewone taal, een foto of een pdf. Daardoor kun je werk automatiseren dat eerder altijd mensenwerk bleef.', 'veryo' ) ),
			array( __( 'Moeten we andere software gaan gebruiken?', 'veryo' ), __( 'Nee. We koppelen aan wat jullie al hebben, zoals Outlook, Gmail, Exact, Moneybird, SnelStart, een CRM of planningstool. Alleen als een koppeling echt niet kan, bespreken we een alternatief.', 'veryo' ) ),
			array( __( 'Kunnen jullie een automatisering op maat laten bouwen?', 'veryo' ), __( 'Ja, als bestaande software het niet oplost. We bouwen dan met bewezen bouwstenen zoals Make, n8n of Zapier en een zakelijke AI-API, in jullie eigen accounts. Veryo is geen softwarebedrijf: we bouwen geen nieuw pakket, maar verbinden wat er al is.', 'veryo' ) ),
			array( __( 'Hoe lang duurt het voordat een automatisering draait?', 'veryo' ), __( 'Een quick win staat meestal binnen twee tot vier weken live, inclusief een proefperiode met echte gegevens. Een project met meerdere koppelingen duurt langer; dat staat in de planning die jullie vooraf krijgen.', 'veryo' ) ),
			array( __( 'Wat als er iets misgaat?', 'veryo' ), __( 'Elke automatisering heeft een logboek, zodat we kunnen zien wat er is gebeurd. Met een onderhoudsabonnement houden wij de boel in de gaten en lossen we het op. Belangrijke stappen blijven altijd door een mens gecontroleerd.', 'veryo' ) ),
			array( __( 'Voor welke bedrijven is dit geschikt?', 'veryo' ), __( 'Voor mkb-bedrijven tot ongeveer vijftig mensen met werk dat elke week terugkomt. Kijk ook bij de toepassingen per branche voor voorbeelden uit jullie sector.', 'veryo' ) ),
		),
		'cta_demo'   => true,
		'cta'        => array( __( 'Bespreek welk proces in jullie bedrijf slimmer kan', 'veryo' ), __( 'Plan een gratis kennismaking van een half uur. We kijken samen naar één proces en vertellen eerlijk of automatiseren loont.', 'veryo' ) ),
		'links'      => array(
			array( 'ai-agents', __( 'AI-agents voor bedrijven', 'veryo' ), __( 'Digitale collega’s die zelf stappen uitvoeren', 'veryo' ) ),
			array( 'ai-implementatie-mkb', __( 'AI implementatie in het mkb', 'veryo' ), __( 'Van inventarisatie tot uitrol', 'veryo' ) ),
			array( 'branches', __( 'AI per branche', 'veryo' ), __( 'Voorbeelden uit jullie sector', 'veryo' ) ),
			array( 'prijzen', __( 'Prijzen en offerte', 'veryo' ), __( 'Waar de kosten van afhangen', 'veryo' ) ),
			array( 'contact', __( 'Contact', 'veryo' ), __( 'Stel jullie vraag direct', 'veryo' ) ),
		),
	)
);

/*
 * AI-implementatie MKB
 */
$veryo_impl = veryo_page_standard(
	array(
		'contact'    => array(
			__( 'Vraag over invoering in jullie bedrijf?', 'veryo' ),
			__( 'Vertel kort hoe jullie nu werken. Jullie krijgen binnen één werkdag een eerlijk antwoord over wat zinvol is en wat niet.', 'veryo' ),
			__( 'Bijvoorbeeld: we zijn met 15 mensen en weten niet waar we moeten beginnen.', 'veryo' ),
		),
		'answer_cta' => array( __( 'Plan een kennismaking', 'veryo' ), '#vraag', 'amber' ),
		'answer'     => __( 'AI-implementatie in het mkb is meer dan een tool aanzetten: het is een traject van inventarisatie, prioritering en toolselectie via een pilot naar uitrol en evaluatie. Na de oplevering leren we jullie team ermee werken. Veryo begeleidt dat traject praktisch, bovenop de software die jullie al gebruiken, met aandacht voor privacy, rollen en draagvlak bij collega’s. Jullie krijgen vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
		'problem'    => array(
			'h' => __( 'Waarom AI-implementatie in het MKB vaak blijft hangen', 'veryo' ),
			'p' => array(
				__( 'Veel ondernemers hebben ChatGPT een keer geprobeerd en zien de mogelijkheden. Maar tussen “dit is handig” en “dit draait elke dag in ons bedrijf” zit een gat. Wie gaat het bouwen? Welke software moet waarop aansluiten? Wat mag wel en niet met klantgegevens? En wat doe je als de collega die ermee begon op vakantie is?', 'veryo' ),
				sprintf(
					/* translators: %s: link naar AI-automatisering. */
					__( 'Zoeken jullie één concrete automatisering in plaats van een invoeringstraject? Kijk dan bij %s.', 'veryo' ),
					'<a href="' . esc_url( veryo_link( 'ai-automatisering' ) ) . '">' . esc_html__( 'AI automatisering voor het mkb', 'veryo' ) . '</a>'
				),
				__( 'Daardoor blijft het vaak bij losse experimenten. Iedereen gebruikt het een beetje, niemand weet precies wat het oplevert, en de echte tijdvreters blijven liggen. Een AI-consultant die alleen een rapport schrijft, lost dat niet op. Je hebt een stappenplan nodig, en iemand die het ook inricht en bijhoudt.', 'veryo' ),
			),
		),
		'photo'      => array( __( 'ondernemer en adviseur aan tafel met een procesoverzicht op papier', 'veryo' ), __( 'AI-implementatie MKB: kansensessie aan tafel', 'veryo' ), 'overleg' ),
		'sections'   => array(
			array(
				'h'     => __( 'Het implementatietraject in zeven stappen', 'veryo' ),
				'p'     => array( __( 'Zo pakken we een AI-implementatie in het mkb aan. Na elke stap beslissen jullie of we doorgaan.', 'veryo' ) ),
				'list'  => array(
					'<strong>' . __( '1. Inventarisatie.', 'veryo' ) . '</strong> ' . __( 'Waar gaat de tijd van jullie collega’s heen, welk werk komt elke week terug en in welke software gebeurt het? De gratis AI-scan is een goed begin.', 'veryo' ),
					'<strong>' . __( '2. Prioritering.', 'veryo' ) . '</strong> ' . __( 'Elke kans krijgt een inschatting van tijdwinst, kosten en risico. Jullie kiezen waar we beginnen, meestal bij één afgebakende taak.', 'veryo' ),
					'<strong>' . __( '3. Toolselectie.', 'veryo' ) . '</strong> ' . __( 'Eerst kijken we wat jullie bestaande software al kan. Daarna kiezen we onafhankelijk de tool of koppeling die het beste past, en waarbij jullie data veilig blijft.', 'veryo' ),
					'<strong>' . __( '4. Pilot.', 'veryo' ) . '</strong> ' . __( 'We richten de eerste toepassing in en testen met echte gegevens en een kleine groep collega’s. Een mens controleert elke uitkomst.', 'veryo' ),
					'<strong>' . __( '5. Jullie team ermee leren werken.', 'veryo' ) . '</strong> ' . __( 'Na de oplevering leren we jullie team ermee werken: wat de toepassing doet, wat wel en niet mag en waar de grenzen liggen.', 'veryo' ),
					'<strong>' . __( '6. Uitrol.', 'veryo' ) . '</strong> ' . __( 'Werkt de pilot, dan gaat de toepassing naar het hele team, met een vaste eigenaar en een logboek.', 'veryo' ),
					'<strong>' . __( '7. Evaluatie.', 'veryo' ) . '</strong> ' . __( 'Na een paar weken meten we wat het oplevert en wat beter kan. Daarna kiezen jullie de volgende toepassing.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h'     => __( 'Governance, privacy en draagvlak', 'veryo' ),
				'p'     => array( __( 'Een implementatie slaagt pas als de afspraken kloppen en collega’s erachter staan. Daarom regelen we in elk traject:', 'veryo' ) ),
				'list'  => array(
					'<strong>' . __( 'Rollen:', 'veryo' ) . '</strong> ' . __( 'wie is eigenaar van een toepassing, wie controleert de uitkomst en wie beslist bij twijfel.', 'veryo' ),
					'<strong>' . __( 'Privacy:', 'veryo' ) . '</strong> ' . __( 'welke gegevens in een AI-tool mogen, een verwerkersovereenkomst waar nodig en, voor vertrouwelijke kennis, lokale AI.', 'veryo' ),
					'<strong>' . __( 'Beveiliging:', 'veryo' ) . '</strong> ' . __( 'zakelijke accounts, de juiste rechten per medewerker en tweestapsverificatie.', 'veryo' ),
					'<strong>' . __( 'Beleid:', 'veryo' ) . '</strong> ' . __( 'een kort AI-beleid dat iedereen begrijpt, in plaats van een dik document.', 'veryo' ),
					'<strong>' . __( 'Acceptatie:', 'veryo' ) . '</strong> ' . __( 'collega’s denken mee in de pilot, zodat AI hun werk makkelijker maakt en niet als bedreiging voelt.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h'     => __( 'Wat jullie concreet krijgen', 'veryo' ),
				'list'  => array(
					__( 'Een overzicht van kansen op volgorde, met tijdwinst, kosten en risico per kans.', 'veryo' ),
					__( 'Een advies over tools en koppelingen, onafhankelijk van leveranciers.', 'veryo' ),
					__( 'Eén werkende toepassing na de pilot, in jullie eigen accounts.', 'veryo' ),
					__( 'Uitleg aan het team bij de oplevering.', 'veryo' ),
					__( 'Een kort AI-beleid en een overzicht van rollen en eigenaren.', 'veryo' ),
					__( 'Een evaluatie met de volgende stap.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h'    => __( 'Voorbeeldplanning', 'veryo' ),
				'p'    => array( __( 'Een indicatie voor een eerste traject met één toepassing. De echte planning hangt af van jullie software en beschikbaarheid, en staat in de offerte.', 'veryo' ) ),
				'list' => array(
					'<strong>' . __( 'Week 1:', 'veryo' ) . '</strong> ' . __( 'inventarisatie en kansensessie.', 'veryo' ),
					'<strong>' . __( 'Week 2:', 'veryo' ) . '</strong> ' . __( 'prioriteiten, toolselectie en afspraken.', 'veryo' ),
					'<strong>' . __( 'Week 3–5:', 'veryo' ) . '</strong> ' . __( 'inrichten en pilot met echte gegevens.', 'veryo' ),
					'<strong>' . __( 'Week 5–6:', 'veryo' ) . '</strong> ' . __( 'oplevering en uitrol naar het team.', 'veryo' ),
					'<strong>' . __( 'Na 4–6 weken gebruik:', 'veryo' ) . '</strong> ' . __( 'evaluatie en de volgende stap.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Waar we meestal beginnen', 'veryo' ),
				'p' => array(
					__( 'Bij de meeste MKB-bedrijven zit de eerste winst op dezelfde plekken: de mailbox, de offertes en de administratie. Dat werk komt elke week terug, kost meerdere uren en is goed af te bakenen. Daarom beginnen we vaak met één quick win, zodat je binnen een paar weken ziet of het werkt voordat je verder investeert.', 'veryo' ),
					__( 'Een voorbeeld: een technisch bedrijf dat inkoopfacturen met de hand overtypt, kan beginnen met automatische verwerking naar het boekhoudpakket. Werkt dat goed, dan volgt de koppeling van werkbon naar factuur, en daarna de planning.', 'veryo' ),
				),
			),
			array( 'html' => veryo_sec_catalog( array( 'mail-concepten', 'inkoopfacturen', 'offerte-generator', 'offerte-opvolging', 'weekupdate' ), __( 'Veelgekozen eerste stappen', 'veryo' ), __( 'Uit onze catalogus, met indicatie van tijdwinst voor een team van 5 tot 20 mensen:', 'veryo' ) ) ),
		),
		'no_steps'   => true,
		'price'      => array(
			'h'     => __( 'Wat kost een AI-implementatie?', 'veryo' ),
			'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk', 'partner' ),
			'p'     => __( 'Dat hangt af van het aantal toepassingen, de systemen die gekoppeld moeten worden en hoeveel begeleiding jullie willen. Vaak is het AI-Startpakket de eerste stap.', 'veryo' ),
		),
		'cta_demo'   => true,
		'cta'        => array( __( 'Klaar om AI in te voeren?', 'veryo' ), __( 'Plan een gratis kennismaking. We kijken samen waar jullie staan en wat een logische eerste stap is.', 'veryo' ) ),
		'faq'        => array(
			array( __( 'Welk bedrijf helpt met AI implementatie voor het mkb?', 'veryo' ), __( 'Veryo uit Leeuwarden begeleidt mkb-bedrijven van inventarisatie tot uitrol, in Noord-Nederland op locatie en daarbuiten online. We bouwen bovenop de software die jullie al gebruiken, bouwen geen nieuwe software en verkopen geen licenties.', 'veryo' ) ),
			array( __( 'Wat kost AI implementatie in het mkb?', 'veryo' ), __( 'Dat hangt af van het aantal toepassingen, de systemen die gekoppeld moeten worden en hoeveel begeleiding jullie willen. Vaak is het AI-Startpakket de eerste stap. Jullie krijgen vooraf een gratis offerte met een vaste prijs; meer staat hierboven bij “Wat kost een AI-implementatie?”.', 'veryo' ) ),
			array( __( 'Wat is het verschil tussen een AI-consultant en Veryo?', 'veryo' ), __( 'Een AI-consultant adviseert meestal alleen. Veryo adviseert, richt in en onderhoudt, bovenop de software die je al hebt. Dat houdt het advies realistisch, want we moeten het zelf ook werkend krijgen.', 'veryo' ) ),
			array( __( 'Met welke stap beginnen we?', 'veryo' ), __( 'Met de inventarisatie: weten waar de tijd heen gaat. Doe de gratis AI-scan of plan een kennismaking. Daarna kiezen we samen één taak om mee te beginnen.', 'veryo' ) ),
			array( __( 'Is AI-implementatie hetzelfde als AI-automatisering?', 'veryo' ), __( 'Nee. Automatisering is één toepassing: een proces dat automatisch gaat. Implementatie is het hele traject eromheen: kiezen wat zinvol is, afspraken maken, het team ermee leren werken en zorgen dat het blijft werken.', 'veryo' ) ),
			array( __( 'Hoe lang duurt een AI-implementatie?', 'veryo' ), __( 'De kansensessie en roadmap kosten een dagdeel plus uitwerking. Een eerste quick win staat meestal binnen twee tot vier weken. Een groter traject verdelen we in stappen, zodat je na elke stap kunt beoordelen of je doorgaat.', 'veryo' ) ),
			array( __( 'Hebben we een AI-strategie nodig voordat we beginnen?', 'veryo' ), __( 'Nee, geen dik document. Wel een helder beeld van waar de tijd heen gaat en wat je als eerste wilt oplossen. Dat is precies wat de kansensessie oplevert.', 'veryo' ) ),
			array( __( 'Wat als onze processen nog niet op orde zijn?', 'veryo' ), __( 'Dan beginnen we daar. Een rommelig proces automatiseren maakt het alleen sneller rommelig. Vaak helpt het al om een proces op papier te zetten voordat er iets gebouwd wordt.', 'veryo' ) ),
			array( __( 'Wie is eigenaar van wat jullie bouwen?', 'veryo' ), __( 'Jij bent eigenaar van je data en waar mogelijk van de automatiseringen, omdat we in je eigen accounts bouwen. Stop je met Veryo, dan kun je ermee verder.', 'veryo' ) ),
		),
		'links'      => array(
			array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Kansensessie, AI-beleid en één toepassing', 'veryo' ) ),
			array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Wat er per onderdeel mogelijk is', 'veryo' ) ),
			array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
			array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Op locatie in heel Friesland', 'veryo' ) ),
			array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Bouwen en inrichten vanuit Leeuwarden', 'veryo' ) ),
		),
	)
);

/*
 * AI op maat
 */
$veryo_opmaat = veryo_page_standard(
	array(
		'contact'  => array(
			__( 'Iets wat geen pakket goed doet?', 'veryo' ),
			__( 'Beschrijf kort wat je zoekt. Je hoort binnen één werkdag of maatwerk nodig is of dat het met bestaande software kan.', 'veryo' ),
			__( 'Bijvoorbeeld: we willen dat offerteaanvragen uit de mail automatisch in ons CRM komen.', 'veryo' ),
		),
		'answer'   => __( 'AI-automatisering op maat: Veryo bouwt AI op maat voor het mkb als geen pakket past of bestaande software tekortschiet: een maatwerk AI-oplossing zoals een chatbot op je eigen kennis, een WhatsApp-assistent, een AI-agent of een interne AI-assistent voor je bedrijf. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Wanneer kies je voor een maatwerk AI-oplossing?', 'veryo' ),
			'p' => array(
				__( 'Meestal is maatwerk niet nodig: veel software die je al hebt of kunt nemen, heeft AI ingebouwd, en daar kijken we altijd eerst naar. Maar soms is de vraag breder. Klanten stellen vragen die je alleen met jullie eigen kennis kunt beantwoorden. Collega’s zoeken dagelijks in handleidingen en procedures. Of een heel proces, van aanvraag tot planning, moet slimmer zonder dat er vijf losse tools bij komen.', 'veryo' ),
				__( 'Dan bouwen we AI op maat: een assistent, chatbot of agent die werkt met jullie gegevens, in jullie toon, en die weet wanneer hij een mens moet inschakelen.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'medewerker aan de balie die op een tablet een antwoord van de interne assistent bekijkt', 'veryo' ), __( 'Maatwerk AI-oplossing: AI-assistent voor bedrijf', 'veryo' ), 'laptop' ),
		'sections' => array(
			array(
				'h'     => __( 'Wat we op maat bouwen', 'veryo' ),
				'list'  => array(
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/chatbot' ) ) . '">' . __( 'AI-chatbot voor je website', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Beantwoordt vragen op basis van jullie eigen informatie', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/whatsapp-assistent' ) ) . '">' . __( 'WhatsApp-assistent', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Vragen, gegevens en foto’s verzamelen, afspraken plannen', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-agents' ) ) . '">' . __( 'AI-agents voor bedrijven', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Voeren meerdere stappen van een proces zelfstandig uit', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_collega_url() ) . '">' . __( 'Interne AI-assistent: Veryo Collega', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Lokale AI-assistent op jullie eigen documenten en procedures', 'veryo' ) . '</span>',
					'<a href="' . esc_url( veryo_link( 'ai-op-maat/ai-receptionist-horeca' ) ) . '">' . __( 'Veryo Receptie voor zorgpraktijken', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Neemt de telefoon op en plant afspraken in', 'veryo' ) . '</span>',
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
		'price'    => array( 'steps' => array( 'startpakket', 'maatwerk', 'onderhoud' ) ),
		'faq'      => array(
			array( __( 'Wat is het verschil tussen een chatbot en een AI-agent?', 'veryo' ), __( 'Een chatbot beantwoordt vragen. Een AI-agent voert ook stappen uit, zoals gegevens opzoeken, een afspraak inplannen of een concept klaarzetten in een ander systeem. Agents krijgen altijd duidelijke grenzen en controlemomenten.', 'veryo' ) ),
			array( __( 'Kan de assistent met onze eigen documenten werken?', 'veryo' ), __( 'Ja. We koppelen de assistent aan de bronnen die jij kiest, zoals handleidingen, procedures, prijslijsten of je website. Hij gebruikt alleen die bronnen en verwijst ernaar.', 'veryo' ) ),
			array( __( 'Wat gebeurt er als de AI een fout antwoord geeft?', 'veryo' ), __( 'We testen vooraf met echte vragen, stellen grenzen in en loggen de gesprekken. Bij twijfel verwijst de assistent naar een mens. Fouten die we in de logs zien, gebruiken we om de bronnen te verbeteren.', 'veryo' ) ),
			array( __( 'Wie betaalt de kosten van het AI-gebruik?', 'veryo' ), __( 'De verbruikskosten van de AI-dienst lopen via je eigen account of via ons onderhoudsabonnement. Voor een MKB-bedrijf zijn die kosten meestal beperkt; we geven vooraf een inschatting.', 'veryo' ) ),
			array( __( 'Wat kost AI-automatisering op maat?', 'veryo' ), __( 'Dat hangt af van wat er gebouwd wordt, hoeveel systemen erbij komen en hoeveel onderhoud jullie willen. Jullie krijgen vooraf een gratis offerte met een vaste prijs, plus een inschatting van de verbruikskosten van de AI-dienst. Meer staat hierboven bij de prijzen.', 'veryo' ) ),
			array( __( 'Hoe lang duurt het bouwen?', 'veryo' ), __( 'Een eerste werkende versie staat meestal binnen vier tot acht weken, afhankelijk van de koppelingen. Je krijgt vooraf een planning.', 'veryo' ) ),
		),
		'links'    => array(
			array( 'ai-op-maat/chatbot', __( 'AI-chatbot laten maken', 'veryo' ), __( 'Wat het kost en wat je krijgt', 'veryo' ) ),
			array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Als een standaardflow volstaat', 'veryo' ) ),
			array( 'ai-agents', __( 'AI-agents voor bedrijven', 'veryo' ), __( 'Als er zelfstandig stappen gezet moeten worden', 'veryo' ) ),
			array( 'branches/makelaardij', __( 'AI voor makelaars', 'veryo' ), __( 'Inbox, bezichtigingen en teksten', 'veryo' ) ),
		),
	)
);

/*
 * Prijzen
 */
$veryo_prices  = veryo_sec_answer( __( 'Wat kost AI-automatisering voor je bedrijf? Dat hangt af van je team, de software die je al hebt en wat je wilt aanpakken. Daarom werken we niet met een prijslijst, maar met een gratis offerte op maat: vooraf een vaste prijs op papier, zonder verplichtingen. Twijfel je nog waar je moet beginnen, doe dan eerst de gratis AI-scan.', 'veryo' ), array( __( 'Vraag een gratis offerte aan', 'veryo' ), '#offerte', 'amber' ) );
$veryo_prices .= veryo_sec_contact(
	__( 'Vraag een gratis offerte aan', 'veryo' ),
	__( 'Vertel kort wat je wilt aanpakken en met hoeveel mensen je werkt. Je krijgt binnen één werkdag een reactie, en daarna een offerte met een vaste prijs. Je zit nergens aan vast.', 'veryo' ),
	__( 'Bijvoorbeeld: we willen offertes sneller maken, met een team van 6.', 'veryo' ),
	'offerte',
	__( 'Vraag offerte aan', 'veryo' )
);
$veryo_prices .= veryo_sec_text(
	__( 'Zo komt je offerte tot stand', 'veryo' ),
	array(),
	array(
		__( 'Je vertelt kort wat je wilt aanpakken, via het formulier, de telefoon of de gratis AI-scan.', 'veryo' ),
		__( 'Binnen één werkdag nemen we contact op. Soms is een kort gesprek nodig om de situatie goed te begrijpen.', 'veryo' ),
		__( 'Je krijgt een offerte met een vaste prijs: wat we doen, wat het oplevert en wat het kost.', 'veryo' ),
		__( 'Pas als je akkoord bent, beginnen we. Breiden we later iets uit, dan krijg je daar eerst een nieuwe offerte voor.', 'veryo' ),
	),
	'checks'
);
$veryo_prices .= veryo_sec_text(
	__( 'Van scan naar partner', 'veryo' ),
	array( __( 'Je hoeft niet alles tegelijk te doen. Je begint met de gratis scan, zet de basis neer met het AI-Startpakket, voert daarna de beste kansen in en houdt het bij met een abonnement of met AI-partner. Hieronder staan de stappen op volgorde, met voor wie ze zijn.', 'veryo' ) )
);
$veryo_prices .= veryo_sec_ladder();
$veryo_prices .= veryo_sec_subscription_terms();
$veryo_prices .= veryo_sec_text(
	__( 'Wat kost AI-automatisering? Waar hangen de kosten van af?', 'veryo' ),
	array(
		__( 'We kijken altijd eerst wat je bestaande software kan. Is het een kwestie van inrichten, dan valt het vaak binnen het Startpakket, de AI-werkplek of een quick win. Moet er een koppeling komen tussen systemen die niet met elkaar praten, dan hangt de prijs af van het aantal stappen en koppelingen: één afgebakende flow is een quick win, een heel traject van aanvraag tot factuur is een project.', 'veryo' ),
		__( 'Een AI-agent of maatwerk bouwen we alleen als bestaande software tekortschiet. Daarnaast zijn er verbruikskosten voor de gebruikte software. Die lopen bij voorkeur via je eigen account, zodat je precies ziet wat je betaalt. In de offerte staat vooraf een inschatting.', 'veryo' ),
	)
);
$veryo_prices .= veryo_sec_text(
	__( 'Wat wel en niet in de prijs zit', 'veryo' ),
	array(),
	array(
		'<strong>' . __( 'Wel:', 'veryo' ) . '</strong> ' . __( 'advies, inrichten, testen met echte gegevens, jullie team ermee leren werken na de oplevering en de afgesproken nazorg.', 'veryo' ),
		'<strong>' . __( 'Wel:', 'veryo' ) . '</strong> ' . __( 'een vaste prijs voor wat in de offerte staat, ook als het meer tijd kost dan gedacht.', 'veryo' ),
		'<strong>' . __( 'Niet:', 'veryo' ) . '</strong> ' . __( 'licenties en verbruikskosten van software, zoals Microsoft 365, ChatGPT of een automatiseringsplatform. Die lopen bij voorkeur via jullie eigen account.', 'veryo' ),
		'<strong>' . __( 'Niet:', 'veryo' ) . '</strong> ' . __( 'uitbreidingen die niet in de offerte staan. Daarvoor krijgen jullie eerst een nieuw voorstel.', 'veryo' ),
		'<strong>' . __( 'Niet:', 'veryo' ) . '</strong> ' . __( 'algemeen IT-beheer of een helpdesk. Veryo beheert alleen wat we zelf hebben ingericht.', 'veryo' ),
	),
	'checks'
);
$veryo_prices .= veryo_sec_faq(
	array(
		array( __( 'Waarom staan er geen prijzen op de website?', 'veryo' ), __( 'Omdat geen twee bedrijven hetzelfde zijn. Een prijs zonder je situatie te kennen, klopt bijna nooit. Met een offerte op maat weet je precies waar je aan toe bent.', 'veryo' ) ),
		array( __( 'Kost de offerte iets?', 'veryo' ), __( 'Nee. De offerte is gratis en vrijblijvend, net als de AI-scan.', 'veryo' ) ),
		array( __( 'Is de prijs in de offerte vast?', 'veryo' ), __( 'Ja. Je krijgt een vaste prijs voor wat in de offerte staat. Daar blijven we aan vastzitten, tenzij je zelf iets toevoegt.', 'veryo' ) ),
		array( __( 'Zijn er terugkerende kosten?', 'veryo' ), __( 'Alleen als je dat wilt, en dat staat vooraf in de offerte. Onderhoud van gebouwde koppelingen en agents is verplicht zolang die draaien. Daarnaast zijn er verbruikskosten voor software, bij voorkeur op je eigen account.', 'veryo' ) ),
		array( __( 'Loopt een abonnement automatisch door?', 'veryo' ), __( 'Nee. Na een pakket loopt het passende abonnement de eerste maand kosteloos mee, en je kiest vooraf zelf of het daarna doorloopt. Losse abonnementen hebben een minimale looptijd van drie maanden en zijn daarna maandelijks opzegbaar.', 'veryo' ) ),
		array( __( 'Wanneer verdient een automatisering zich terug?', 'veryo' ), __( 'Dat reken je uit met het aantal uren dat het scheelt, maal wat een uur je kost. In de offerte zetten we die opbrengst naast de prijs. Het blijft een indicatie, geen belofte.', 'veryo' ) ),
	)
);
$veryo_prices .= veryo_sec_cta_scan( __( 'Weet wat het jou oplevert', 'veryo' ), __( 'De gratis AI-scan rekent uit hoeveel uur en euro’s er bij jou te halen is, en welke stap daarbij past.', 'veryo' ) );
$veryo_prices .= veryo_sec_links(
	array(
		array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Vijf onderdelen, vaste prijs vooraf', 'veryo' ) ),
		array( 'ai-partner', __( 'AI-partner-abonnement', 'veryo' ), __( 'Een vaste vraagbaak per maand', 'veryo' ) ),
		array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Wat er per onderdeel mogelijk is', 'veryo' ) ),
		array( 'ai-op-maat/chatbot', __( 'AI-chatbot laten maken', 'veryo' ), __( 'Aanpak en wat je krijgt', 'veryo' ) ),
	)
);

/*
 * Over Veryo
 */
$veryo_about  = veryo_sec_answer( __( 'Veryo is de onafhankelijke AI-partner uit Leeuwarden voor het MKB in Noord-Nederland. We bouwen en richten AI in voor technische kantoren en projectbedrijven met 15 tot 50 medewerkers: AI-agents, automatiseringen bovenop de systemen die jullie al hebben, de AI-werkplek met Claude Team en de administratieve kringloop. Veryo bouwt geen nieuwe software; overstappen is nooit nodig. Na de oplevering leren we jullie team ermee werken.', 'veryo' ) );
$veryo_about .= veryo_sec_text(
	__( 'Waarom Veryo bestaat', 'veryo' ),
	array(
		__( 'De naam Veryo komt van het Latijnse vero: waar, echt, werkelijk. Dat is ook wat we willen zijn in een markt vol grote beloftes. AI kan veel, maar niet alles, en lang niet elke toepassing is de moeite waard voor een bedrijf met tien of twintig mensen.', 'veryo' ),
		__( 'We zien bij ondernemers in Friesland, Groningen en Drenthe hetzelfde patroon: ze horen overal dat ze iets met AI moeten, maar niemand vertelt ze wat, wat het kost en wat het oplevert. Veryo is de nuchtere partner die dat wel doet. Eerst snappen, dan slim inzetten.', 'veryo' ),
	)
);
$veryo_about .= veryo_sec_wide(
	veryo_b_columns(
		array(
			array(
				'width' => '58%',
				'inner' => veryo_b_h( __( 'Wie er achter Veryo zit', 'veryo' ) )
					. veryo_b_p( __( 'Veryo is opgericht door Csaba. Hij begon Veryo omdat hij gelooft in wat AI voor het MKB kan betekenen, mits je het nuchter en goed inzet. Veel processen in een bedrijf kunnen een stuk makkelijker, en dat levert elke week tijd op die je aan je eigenlijke werk kunt besteden.', 'veryo' ) )
					. veryo_b_p( __( 'Daar draait Veryo om: niet om de techniek, maar om het werk dat daarna lichter wordt. Csaba kijkt met je mee, adviseert welke tools passen, richt het in en blijft aanspreekpunt als het eenmaal draait.', 'veryo' ) ),
			),
			array(
				'width' => '42%',
				'inner' => veryo_b_shortcode( '[veryo_portret size="large"]' ),
			),
		)
	),
	'veryo-conviction veryo-about-founder'
);
$veryo_about .= veryo_sec_text(
	__( 'Ervaring en achtergrond', 'veryo' ),
	array(
		__( 'Csaba werkt dagelijks met AI-tools, automatiseringsplatforms en lokale AI-modellen, en zet die in voor het werk van mkb-bedrijven: mail, offertes, administratie, planning en kennis. Hij kijkt daarbij niet naar wat technisch kan, maar naar wat in een gewone werkweek tijd scheelt en veilig is voor jullie gegevens.', 'veryo' ),
		__( 'Veryo is onafhankelijk: we verkopen geen eigen software en hebben geen belang bij een bepaalde leverancier. Daardoor kunnen we eerlijk adviseren welke tool past, ook als dat een tool is die jullie al hebben. Csaba is de vaste contactpersoon: van het eerste gesprek tot de oplevering en daarna.', 'veryo' ),
	)
);
$veryo_about .= veryo_sec_text(
	__( 'Hoe Veryo omgaat met data en veiligheid', 'veryo' ),
	array( __( 'Bedrijfsgegevens zijn vertrouwelijk. Daarom gelden bij Veryo een paar vaste regels:', 'veryo' ) ),
	array(
		'<strong>' . __( 'Liefst lokaal.', 'veryo' ) . '</strong> ' . __( 'Met Veryo Collega draait de AI op een eigen machine bij jullie op kantoor. Jullie gegevens verlaten het pand niet voor AI-verwerking.', 'veryo' ),
		'<strong>' . __( 'Zakelijke versies in de cloud.', 'veryo' ) . '</strong> ' . __( 'Gebruiken we toch een clouddienst, dan een zakelijke versie waarbij jullie gegevens niet worden gebruikt om AI-modellen te trainen.', 'veryo' ),
		'<strong>' . __( 'Verwerkersovereenkomst.', 'veryo' ) . '</strong> ' . __( 'Bij persoonsgegevens sluiten we een verwerkersovereenkomst, en we krijgen alleen toegang tot wat nodig is.', 'veryo' ),
		'<strong>' . __( 'Rechten per medewerker.', 'veryo' ) . '</strong> ' . __( 'Niet iedereen hoeft alles te zien. Wie welke bronnen mag gebruiken, leggen we samen vast.', 'veryo' ),
		'<strong>' . __( 'Een mens beslist.', 'veryo' ) . '</strong> ' . __( 'AI maakt concepten en voorstellen. Wat naar een klant gaat of geld kost, controleert altijd een collega.', 'veryo' ),
	),
	'checks'
);
$veryo_about .= veryo_sec_independent();
$veryo_about .= veryo_sec_text(
	__( 'Wat we doen, in zes pijlers', 'veryo' ),
	array( __( 'Alles wat Veryo bouwt en inricht, past in zes pijlers. Je kunt bij elke pijler instappen.', 'veryo' ) ),
	array(
		'<a href="' . esc_url( veryo_link( 'ai-werkplek' ) ) . '">' . __( 'AI-werkplek met Claude Team', 'veryo' ) . '</a>: ' . __( 'Claude ingericht met jullie eigen normen, kengetallen en templates.', 'veryo' ),
		'<a href="' . esc_url( veryo_link( 'ai-automatisering/administratie' ) ) . '">' . __( 'De administratieve kringloop', 'veryo' ) . '</a>: ' . __( 'van uren en werkbonnen tot factuur, salarisadministratie en begroot naast werkelijk.', 'veryo' ),
		'<a href="' . esc_url( veryo_link( 'ai-agents' ) ) . '">' . __( 'AI-agents', 'veryo' ) . '</a>: ' . __( 'digitale collega’s die terugkerend werk voorbereiden in jullie eigen systemen.', 'veryo' ),
		'<a href="' . esc_url( veryo_link( 'ai-automatisering' ) ) . '">' . __( 'Automatiseringen', 'veryo' ) . '</a>: ' . __( 'koppelingen bovenop de software die jullie al gebruiken.', 'veryo' ),
		'<a href="' . esc_url( veryo_link( 'veilig-ai-gebruik' ) ) . '">' . __( 'Veilig AI-gebruik', 'veryo' ) . '</a>: ' . __( 'beleid, toegangsrechten, tweestapsverificatie, bewustwording en waar je wilt Europese alternatieven.', 'veryo' ),
		'<a href="' . esc_url( veryo_link( 'ai-partner' ) ) . '">' . __( 'AI-abonnement', 'veryo' ) . '</a>: ' . __( 'een vaste AI-partner en doorlopende begeleiding in één abonnement.', 'veryo' ),
	)
);
$veryo_about .= veryo_sec_text(
	__( 'Veryo is geen IT-bedrijf', 'veryo' ),
	array(
		__( 'We doen geen algemeen IT-beheer, netwerken, helpdesk of storingsdienst. Alleen de machine waarop [veryo_collega_naam] draait, beheren we zelf. Daar zijn goede IT-beheerders voor, en die heb je misschien al. Veryo richt zich op AI: welke past, hoe je hem veilig inricht, en hoe je team er goed mee werkt.', 'veryo' ),
		__( 'Heb je een vaste IT-beheerder, dan werken we graag met die samen. Bijvoorbeeld bij het inrichten van Claude Team, het op orde brengen van toegangsrechten of het uitvoeren van acties uit de AI-veiligheidscheck.', 'veryo' ),
	)
);
$veryo_about .= veryo_sec_text(
	__( 'Hoe we werken', 'veryo' ),
	array(),
	array(
		'<strong>' . __( 'Van advies tot oplevering bij één partij.', 'veryo' ) . '</strong> ' . __( 'Advies, bouwen, inrichten en een vaste vraagbaak, zonder dat je drie bureaus hoeft aan te sturen.', 'veryo' ),
		'<strong>' . __( 'Geen eigen software.', 'veryo' ) . '</strong> ' . __( 'We adviseren wat bij jou past, ook als dat iets is wat je al hebt.', 'veryo' ),
		'<strong>' . __( 'Vaste prijs vooraf.', 'veryo' ) . '</strong> ' . __( 'Je krijgt een gratis offerte en weet vooraf wat het kost.', 'veryo' ),
		'<strong>' . __( 'Sterk in bouw, installatie, agri en techniek.', 'veryo' ) . '</strong> ' . __( 'We kennen de praktijk van werkbonnen, calculaties en storingen.', 'veryo' ),
		'<strong>' . __( 'Eerlijk over grenzen.', 'veryo' ) . '</strong> ' . __( 'Als iets niet de moeite waard is om te automatiseren, zeggen we dat.', 'veryo' ),
		'<strong>' . __( 'AVG-bewust.', 'veryo' ) . '</strong> ' . __( 'Zakelijke API’s, verwerkersovereenkomsten waar nodig en jouw data blijft van jou.', 'veryo' ),
	),
	'checks'
);
$veryo_about .= veryo_sec_regions( __( 'Een AI-bureau in Leeuwarden, voor het hele noorden', 'veryo' ) );
$veryo_about .= veryo_sec_cases();
$veryo_about .= veryo_sec_contact(
	__( 'Kennismaken?', 'veryo' ),
	__( 'Stel je vraag of vertel kort wat je zoekt. Ik reageer zelf, binnen één werkdag, en we kijken samen of Veryo iets voor je kan betekenen.', 'veryo' ),
	__( 'Bijvoorbeeld: ik wil graag een keer kennismaken en horen wat AI voor ons bedrijf kan doen.', 'veryo' )
);
$veryo_about .= veryo_sec_cta_scan( __( 'Eerst zelf ontdekken wat AI oplevert?', 'veryo' ), __( 'Doe de gratis AI-scan: negen vragen, ongeveer drie minuten, en je krijgt een persoonlijk rapport met je drie grootste tijdwinsten.', 'veryo' ) );
$veryo_about .= veryo_sec_links(
	array(
		array( 'contact', __( 'Contact', 'veryo' ), __( 'Mail, bel of vul het formulier in', 'veryo' ) ),
		array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ),
		array( 'prijzen', __( 'Gratis offerte', 'veryo' ), __( 'Vooraf een vaste prijs', 'veryo' ) ),
	)
);

/*
 * Contact
 */
$veryo_contact  = veryo_b_p( __( 'Heb je een vraag, wil je een demo of eerst even sparren? Stuur een bericht of neem direct contact op. We reageren binnen één werkdag.', 'veryo' ), array( 'fontSize' => 'body-l' ) );
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
			'inner' => veryo_b_shortcode( '[veryo_portret size="small"]' ) . veryo_b_h( __( 'Direct contact', 'veryo' ) ) . veryo_b_shortcode( '[veryo_contact_details]' )
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
$veryo_branches  = veryo_sec_answer(
	__( 'AI per branche: Veryo zet AI in voor installatie, bouw en vakbedrijven, beveiliging, makelaardij, transport, agri, accountancy, horeca, werving en schoonmaak. Per sector verschillen de tijdvreters, dus per sector verschillen de toepassingen. Kies hieronder jullie branche voor herkenbare workflows en voorbeelden.', 'veryo' ),
	array( __( 'Bespreek jullie branche', 'veryo' ), '#vraag', 'amber' )
);
$veryo_branches .= veryo_sec_text(
	__( 'Waarom per branche kijken?', 'veryo' ),
	array(
		__( 'Een installateur verliest tijd aan werkbonnen en storingsmeldingen, een makelaar aan een inbox die via vijf kanalen volloopt, een transportbedrijf aan orders die met de hand worden ingevoerd. De techniek is vaak dezelfde, maar wat het oplevert verschilt per sector. Daarom beginnen we bij jullie werk en jullie software.', 'veryo' ),
		__( 'Staat jullie branche er niet tussen? Doe dan de AI-scan en kies “overig”. De aanbevelingen komen dan uit jullie antwoorden over taken en uren.', 'veryo' ),
	)
);
$veryo_branches .= veryo_sec_text(
	__( 'Uitgewerkte branches met een complete workflow', 'veryo' ),
	array( __( 'Voor deze branches staat per pagina een realistische workflow: van de eerste aanvraag tot de factuur of het rapport, met de systemen die jullie al gebruiken.', 'veryo' ) ),
	array(
		'<strong><a href="' . esc_url( veryo_link( 'branches/installatie' ) ) . '">' . esc_html__( 'Installatiebedrijven', 'veryo' ) . '</a>.</strong> ' . esc_html__( 'Aanvraagintake, storingsvragen, planning, werkbonnen, rapportage en factuur in één doorlopende workflow.', 'veryo' ),
		'<strong><a href="' . esc_url( veryo_link( 'branches/bouw' ) ) . '">' . esc_html__( 'Bouw en vakbedrijven', 'veryo' ) . '</a>.</strong> ' . esc_html__( 'Calculatie en werkvoorbereiding, projectdocumentatie en digitaal opleveren, ook voor dakkapel-, kozijn- en vloerenbedrijven.', 'veryo' ),
		'<strong><a href="' . esc_url( veryo_link( 'branches/beveiliging' ) ) . '">' . esc_html__( 'Beveiligingsbedrijven', 'veryo' ) . '</a>.</strong> ' . esc_html__( 'Uren controleren tegen het rooster, zzp-facturen nakijken en maandrapportages per opdrachtgever.', 'veryo' ),
		'<strong><a href="' . esc_url( veryo_link( 'branches/makelaardij' ) ) . '">' . esc_html__( 'Makelaars', 'veryo' ) . '</a>.</strong> ' . esc_html__( 'Leadopvolging, bezichtigingsaanvragen, woningteksten en documentvragen van kopers en verkopers.', 'veryo' ),
		'<strong><a href="' . esc_url( veryo_link( 'branches/transport' ) ) . '">' . esc_html__( 'Transport en logistiek', 'veryo' ) . '</a>.</strong> ' . esc_html__( 'Automatische orderinvoer, transportdocumenten, e-mailverwerking en statusupdates voor klanten.', 'veryo' ),
	),
	'checks'
);
$veryo_branches .= veryo_sec_branches( __( 'Alle branches', 'veryo' ) );
$veryo_branches .= veryo_sec_steps();
$veryo_branches .= veryo_sec_contact(
	__( 'Staat jullie branche er niet bij?', 'veryo' ),
	__( 'We werken voor het hele mkb. Vertel kort wat voor bedrijf jullie hebben; jullie horen binnen één werkdag waar AI het meeste oplevert.', 'veryo' ),
	__( 'Bijvoorbeeld: we zijn een schildersbedrijf met 9 mensen. Wat kan AI voor ons doen?', 'veryo' )
);
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
		array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), '' ),
		array( 'prijzen', __( 'Gratis offerte', 'veryo' ), '' ),
		array( 'over-veryo', __( 'Over Veryo', 'veryo' ), '' ),
	),
	__( 'Alvast verder kijken', 'veryo' )
);

return array(
	''                     => array(
		'title'       => __( 'AI bouwen en inrichten voor technische bedrijven', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI bouwen en inrichten voor technische bedrijven | Veryo', 'veryo' ),
		'desc'        => __( 'Veryo bouwt AI-agents, automatiseringen en de AI-werkplek met Claude Team voor technische bedrijven in Noord-Nederland. Plan een kennismaking.', 'veryo' ),
		'kw'          => 'ai bureau mkb',
		'meta'        => array( 'hide_title' => 1 ),
		'content'     => $veryo_home,
	),
	'waar-begin-ik-met-ai' => array(
		'title'     => __( 'Wil je iets met AI, maar weet je niet wat?', 'veryo' ),
		'seo_title' => __( 'Waar begin je met AI? Doe de gratis AI-scan | Veryo', 'veryo' ),
		'desc'      => __( 'Waar begin ik met AI in mijn bedrijf? Doe de gratis AI-scan in 3 minuten en krijg een persoonlijk rapport met je 3 grootste tijdwinsten in uren en euro’s.', 'veryo' ),
		'kw'        => 'waar begin ik met ai in mijn bedrijf',
		'meta'      => array( 'hide_title' => 1 ),
		'content'   => $veryo_scan,
	),
	'ai-automatisering'    => array(
		'title'       => __( 'AI automatisering voor het mkb: maak tijd vrij voor belangrijk werk', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI automatisering voor het mkb, met voorbeelden | Veryo', 'veryo' ),
		'desc'        => __( 'AI automatisering voor het mkb: mail, offertes, facturen en planning automatiseren met de software die jullie al hebben. Met voorbeelden en aanpak.', 'veryo' ),
		'kw'          => 'ai automatisering mkb',
		'schema'      => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 7500,
		),
		'content'     => $veryo_auto,
	),
	'ai-implementatie-mkb' => array(
		'title'       => __( 'AI implementatie in het mkb: begeleiding van plan tot uitrol', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI implementatie in het mkb: van plan tot uitrol | Veryo', 'veryo' ),
		'desc'        => __( 'AI implementatie voor het mkb in zeven stappen: inventarisatie, pilot met echte data, het team ermee leren werken en uitrol. Met vaste prijs vooraf.', 'veryo' ),
		'kw'          => 'ai implementatie mkb',
		'schema'      => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
		),
		'content'     => $veryo_impl,
	),
	'ai-op-maat'           => array(
		'title'       => __( 'AI-automatisering op maat', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI-automatisering op maat voor jullie bedrijf | Veryo', 'veryo' ),
		'desc'        => __( 'AI-automatisering op maat wanneer geen pakket past: chatbot op eigen kennis, WhatsApp-assistent of interne assistent. Gratis AI-scan, vaste prijs.', 'veryo' ),
		'kw'          => 'ai automatisering op maat',
		'schema'      => array(
			'type' => 'service',
			'min'  => 5000,
			'max'  => 25000,
		),
		'content'     => $veryo_opmaat,
	),
	'prijzen'              => array(
		'title'       => __( 'Prijzen en offerte', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'Kosten van AI voor het mkb: gratis offerte op maat | Veryo', 'veryo' ),
		'desc'        => __( 'Wat kost AI voor het mkb? De kosten hangen af van je team, je software en de koppelingen. Vraag een gratis offerte aan: een vaste prijs, vrijblijvend.', 'veryo' ),
		'kw'          => 'kosten ai voor mkb',
		'content'     => $veryo_prices,
	),
	'over-veryo'           => array(
		'title'     => __( 'Over Veryo', 'veryo' ),
		'seo_title' => __( 'Over Veryo: nuchtere AI-partner uit Leeuwarden | Veryo', 'veryo' ),
		'desc'      => __( 'Over Veryo: wie er achter zit, hoe we werken en hoe we met jullie data omgaan. De nuchtere AI-partner uit Leeuwarden. Maak kennis met Csaba.', 'veryo' ),
		'kw'        => 'over veryo',
		'content'   => $veryo_about,
	),
	'contact'              => array(
		'title'     => __( 'Contact', 'veryo' ),
		'seo_title' => __( 'Contact: bel, mail of plan een kennismaking | Veryo', 'veryo' ),
		'desc'      => __( 'Neem contact op met Veryo, AI voor het MKB, uit Leeuwarden. Stel je vraag over AI-agents, automatisering of de AI-werkplek; we reageren binnen één werkdag.', 'veryo' ),
		'kw'        => 'veryo contact',
		'content'   => $veryo_contact,
	),
	'branches'             => array(
		'title'     => __( 'AI per branche', 'veryo' ),
		'seo_title' => __( 'AI per branche: workflows en voorbeelden per sector | Veryo', 'veryo' ),
		'desc'      => __( 'AI per branche: herkenbare workflows voor installatie, bouw, beveiliging, makelaardij, transport en meer. Zie wat AI in jullie sector oplevert.', 'veryo' ),
		'kw'        => 'ai per branche',
		'content'   => $veryo_branches,
	),
	'bedankt'              => array(
		'title'     => __( 'Bedankt', 'veryo' ),
		'seo_title' => __( 'Bedankt | Veryo', 'veryo' ),
		'desc'      => __( 'Bedankt voor je bericht of het invullen van de AI-scan van Veryo. Je rapport staat binnen enkele minuten in je mailbox; we reageren binnen één werkdag.', 'veryo' ),
		'kw'        => '',
		'meta'      => array( 'noindex' => 1 ),
		'content'   => $veryo_thanks,
	),
	'rapport'              => array(
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
	'blog'                 => array(
		'title'     => __( 'Blog', 'veryo' ),
		'seo_title' => __( 'Blog over AI in het mkb: uitleg en praktijk | Veryo', 'veryo' ),
		'desc'      => __( 'Nuchtere artikelen over AI in het MKB: waar je begint, wat het kost, wat mag volgens de AVG en de AI Act, en voorbeelden per branche. Door Veryo.', 'veryo' ),
		'kw'        => '',
		'content'   => '',
	),
);
