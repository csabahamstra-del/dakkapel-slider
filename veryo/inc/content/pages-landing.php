<?php
/**
 * Landingspagina's zonder menu (template templates/landing.php). Copy uit het document
 * "Veryo landingspagina's", secties 1 tot en met 3.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hero voor een landingspagina.
 *
 * @param string $kicker Bovenkop (mag leeg zijn).
 * @param string $title  H1.
 * @param string $sub    Subkop.
 * @param string $after  Extra blokken (knoppen, teller).
 * @return string
 */
$veryo_lp_hero = static function ( $kicker, $title, $sub, $after ) {
	$inner  = $kicker ? veryo_b_p( esc_html( $kicker ), array( 'className' => 'veryo-kicker' ) ) : '';
	$inner .= veryo_b_h( esc_html( $title ), 1, array( 'fontSize' => 'display-xl' ) );
	$inner .= veryo_b_p( esc_html( $sub ), array( 'className' => 'veryo-lead' ) );
	$inner .= $after;
	return veryo_b_group(
		$inner,
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'is-style-petrol veryo-hero has-check veryo-lp-hero',
		)
	);
};

/**
 * Afsluiter op petrol: kop en één knop.
 *
 * @param string $title Kop.
 * @param string $label Knoptekst.
 * @param string $url   Link.
 * @return string
 */
$veryo_lp_closer = static function ( $title, $label, $url ) {
	return veryo_b_group(
		veryo_b_h( esc_html( $title ), 2, array( 'fontSize' => 'display-l' ) )
		. veryo_b_buttons( array( array( esc_html( $label ), $url, 'amber' ) ) ),
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'is-style-petrol veryo-cta has-check veryo-lp-closer',
		)
	);
};

/**
 * Genummerde stappen.
 *
 * @param string   $title Kop.
 * @param string[] $steps Stappen.
 * @return string
 */
$veryo_lp_steps = static function ( $title, $steps ) {
	return veryo_sec_wide( veryo_b_h( esc_html( $title ) ) . veryo_b_list( array_map( 'esc_html', $steps ), array( 'className' => 'is-style-steps' ) ), 'veryo-steps--home veryo-lp-steps' );
};

$veryo_calendly = VERYO_LP_CALENDLY_URL;

/*
 * 1. Founding Partner.
 */
$veryo_fp       = $veryo_lp_hero(
	__( 'Founding Partners 2026', 'veryo' ),
	__( 'Veryo zoekt 6 bedrijven om mee te bouwen.', 'veryo' ),
	__( 'Jij krijgt een AI-oplossing tegen een lagere instap. Wij krijgen een eerlijk verhaal over wat het oplevert. Twee plekken per oplossing.', 'veryo' ),
	veryo_b_shortcode( '[veryo_lp_teller]' )
	. veryo_b_buttons( array( array( esc_html__( 'Vraag een plek aan', 'veryo' ), '#aanvragen', 'amber' ) ) )
);
$veryo_fp      .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Voor wie', 'veryo' ) )
	. veryo_b_list(
		array(
			esc_html__( 'Je hebt 5 tot 50 mensen in dienst.', 'veryo' ),
			esc_html__( 'Er is werk dat elke week terugkomt en te veel tijd kost: aanvragen opvolgen, rapportages maken, kantoorwerk.', 'veryo' ),
			esc_html__( 'Je wilt binnen 60 dagen zien of het werkt, met cijfers.', 'veryo' ),
			esc_html__( 'Je durft daarna te vertellen hoe het ging, ook als het tegenvalt.', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	),
	'veryo-lp-for'
);
$veryo_fp_rows  = array(
	array( __( 'AI-Startpakket (tot 10 medewerkers)', 'veryo' ), '€1.995', '€995' ),
	array( __( 'AI lead-opvolging', 'veryo' ), __( '€1.500 + €195 p/m', 'veryo' ), __( '€750 + €195 p/m', 'veryo' ) ),
	array( __( 'AI Klantrapportage', 'veryo' ), __( 'setup + €750–2.500 p/m', 'veryo' ), __( 'setup -50% + normaal maandbedrag', 'veryo' ) ),
	array( 'Veryo Collega', __( 'op aanvraag', 'veryo' ), __( 'inrichting -50% + normaal maandbedrag', 'veryo' ) ),
);
$veryo_fp_table = '<thead><tr><th>' . esc_html__( 'Oplossing', 'veryo' ) . '</th><th>' . esc_html__( 'Normaal', 'veryo' ) . '</th><th>' . esc_html__( 'Als Founding Partner', 'veryo' ) . '</th></tr></thead><tbody>';
foreach ( $veryo_fp_rows as $veryo_row ) {
	$veryo_fp_table .= '<tr><td>' . esc_html( $veryo_row[0] ) . '</td><td>' . esc_html( $veryo_row[1] ) . '</td><td>' . esc_html( $veryo_row[2] ) . '</td></tr>';
}
$veryo_fp_table .= '</tbody>';
$veryo_fp       .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Wat je krijgt', 'veryo' ) )
	. veryo_b( 'table', array( 'className' => 'veryo-lp-table' ), '<figure class="wp-block-table veryo-lp-table"><table class="has-fixed-layout">' . $veryo_fp_table . '</table></figure>' )
	. veryo_b_p( esc_html__( 'Het abonnement loopt de eerste maand gratis mee. Daarna kies je zelf of het doorloopt. Alle prijzen exclusief btw.', 'veryo' ), array( 'className' => 'veryo-small' ) ),
	'veryo-lp-offer'
);
$veryo_fp       .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Wat we van je vragen', 'veryo' ) )
	. veryo_b_list(
		array(
			esc_html__( 'Na 60 dagen een korte case met cijfers: hoeveel uur of hoeveel aanvragen, voor en na.', 'veryo' ),
			esc_html__( 'Een video van 1 tot 2 minuten op je werkplek. Wij nemen hem op, jij praat.', 'veryo' ),
			esc_html__( 'Je logo en bedrijfsnaam op veryo.nl.', 'veryo' ),
			esc_html__( 'Twee keer per jaar een belletje met een ondernemer die overweegt met Veryo te starten.', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	),
	'veryo-lp-ask'
);
$veryo_fp       .= $veryo_lp_steps(
	__( 'Zo werkt het', 'veryo' ),
	array(
		__( 'Je vult het formulier in (2 minuten).', 'veryo' ),
		__( 'Csaba belt je binnen één werkdag voor een kennismaking van 15 minuten.', 'veryo' ),
		__( 'Past het, dan krijg je dezelfde week een voorstel met vaste prijs.', 'veryo' ),
	)
);
$veryo_fp       .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Vraag een plek aan', 'veryo' ) )
	. veryo_b_group( veryo_b_shortcode( '[veryo_lp_form type="founding_partner"]' ), array( 'className' => 'is-style-paper veryo-form-wrap' ) ),
	'veryo-lp-formblock',
	'aanvragen'
);
$veryo_fp       .= veryo_sec_faq(
	array(
		array( __( 'Waarom een lagere prijs?', 'veryo' ), __( 'Omdat we Veryo net zijn begonnen en liever met cijfers dan met beloftes laten zien wat het oplevert.', 'veryo' ) ),
		array( __( 'Zit ik ergens aan vast?', 'veryo' ), __( 'Aan het eenmalige deel wel, aan het abonnement niet: de eerste maand is gratis en daarna maandelijks opzegbaar na de minimale looptijd.', 'veryo' ) ),
		array( __( 'Wat als het niet werkt?', 'veryo' ), __( 'Dan vertellen we dat eerlijk in de case, en zoeken we samen uit waarom.', 'veryo' ) ),
		array( __( 'Hoe lang loopt het programma?', 'veryo' ), __( 'Tot de 6 plekken vol zijn. Daarna gaat deze pagina offline.', 'veryo' ) ),
	),
	__( 'Kleine lettertjes', 'veryo' )
);

/*
 * 2. Vakbedrijven: AI lead-opvolging.
 */
$veryo_lo  = $veryo_lp_hero(
	'',
	__( 'Elke aanvraag binnen 2 minuten opgevolgd. Ook om 22:00.', 'veryo' ),
	__( 'Je betaalt voor advertenties en Werkspot-leads. Veryo zorgt dat geen aanvraag blijft liggen: de AI reageert direct, vraagt door en zet de inmeting in je agenda.', 'veryo' ),
	veryo_b_buttons(
		array(
			array( esc_html__( 'Probeer het zelf', 'veryo' ), '#probeer', 'amber' ),
			array( esc_html__( 'Plan een gesprek', 'veryo' ), $veryo_calendly, 'link' ),
		)
	)
);
$veryo_lo .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Wie het eerst belt, krijgt vaak de klus.', 'veryo' ) )
	. veryo_b_p( esc_html__( 'Een aanvraag komt binnen terwijl je op de steiger staat. Je belt ’s avonds terug, of de volgende dag. Intussen heeft de klant ook twee andere bedrijven benaderd. Niet omdat je slecht werk levert, maar omdat je er niet aan toe kwam.', 'veryo' ), array( 'className' => 'veryo-lead' ) ),
	'veryo-lp-problem'
);
$veryo_lo .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Ervaar wat je klant zou ervaren.', 'veryo' ) )
	. veryo_b_shortcode( '[veryo_lp_probeer]' ),
	'veryo-lp-try',
	'probeer'
);
$veryo_lo .= $veryo_lp_steps(
	__( 'Zo werkt het', 'veryo' ),
	array(
		__( 'Aanvraag komt binnen via je site, Google, Werkspot of Trustoo, zoals nu.', 'veryo' ),
		__( 'De AI reageert binnen 2 minuten via WhatsApp, in jullie toon, en vraagt wat jij altijd vraagt: wat, waar, wanneer, budget.', 'veryo' ),
		__( 'De inmeting staat in je agenda. Jij krijgt een samenvatting en hoeft alleen nog te gaan.', 'veryo' ),
	)
);
$veryo_lo .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Werkt met wat je al hebt', 'veryo' ) )
	. veryo_b_p( esc_html__( 'Geen nieuwe software. Het werkt met je website, je agenda en je WhatsApp. Jouw team werkt verder zoals nu, alleen zonder achter aanvragen aan te hoeven bellen.', 'veryo' ), array( 'className' => 'veryo-lead' ) ),
	'veryo-lp-fits'
);
$veryo_lo .= veryo_sec_wide(
	veryo_b_group(
		veryo_b_h( esc_html__( 'Prijs', 'veryo' ) )
		. veryo_b_list(
			array(
				'<strong>' . esc_html__( '€1.500 eenmalig', 'veryo' ) . '</strong> ' . esc_html__( 'voor inrichten en afstemmen op jullie werkwijze', 'veryo' ),
				'<strong>' . esc_html__( '€195 per maand', 'veryo' ) . '</strong> ' . esc_html__( 'voor de AI, onderhoud en aanpassingen', 'veryo' ),
				esc_html__( 'De eerste maand loopt het abonnement gratis mee', 'veryo' ),
				esc_html__( 'Exclusief btw en verbruikskosten (meestal enkele tientjes per maand, op je eigen account)', 'veryo' ),
			),
			array( 'className' => 'is-style-checks' )
		)
		. veryo_b_buttons( array( array( esc_html__( 'Plan een gesprek', 'veryo' ), $veryo_calendly, 'amber' ) ) ),
		array( 'className' => 'is-style-soft veryo-price veryo-lp-price' )
	),
	'veryo-lp-pricing'
);
$veryo_lo .= veryo_sec_faq(
	array(
		array( __( 'Klinkt dat niet als een robot?', 'veryo' ), __( 'De AI schrijft in jullie toon en zegt eerlijk dat hij een digitale assistent is. Klanten vinden een snel antwoord belangrijker dan wie het stuurt.', 'veryo' ) ),
		array( __( 'Wat als een klant iets vreemds vraagt?', 'veryo' ), __( 'Dan zet de AI het gesprek door naar jou, met de samenvatting erbij.', 'veryo' ) ),
		array( __( 'Wat gebeurt er met de gegevens?', 'veryo' ), __( 'We werken met zakelijke versies en een verwerkersovereenkomst. De gegevens blijven van jou.', 'veryo' ) ),
		array( __( 'Hoe snel draait het?', 'veryo' ), __( 'Meestal binnen twee weken na het eerste gesprek.', 'veryo' ) ),
	)
);
$veryo_lo .= $veryo_lp_closer( __( 'Hoeveel aanvragen liet je vorige maand liggen?', 'veryo' ), __( 'Plan een gesprek van 30 minuten', 'veryo' ), $veryo_calendly );

/*
 * 3. Beveiliging: AI Klantrapportage.
 */
$veryo_kr  = $veryo_lp_hero(
	'',
	__( 'Je maandrapportage maakt zichzelf.', 'veryo' ),
	__( 'Dienst- en incidentrapporten gaan erin, een strak klantrapport in jullie huisstijl komt eruit. Elke maand, automatisch.', 'veryo' ),
	veryo_b_buttons( array( array( esc_html__( 'Vraag een gratis proefrapport aan', 'veryo' ), '#proefrapport', 'amber' ) ) )
);
$veryo_kr .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Goed werk op de vloer, uren werk op kantoor.', 'veryo' ) )
	. veryo_b_p( esc_html__( 'Opdrachtgevers willen elke maand zien wat er gebeurd is. Dus zoekt iemand op kantoor alle rapporten bij elkaar, telt incidenten, schrijft een samenvatting en maakt er een PDF van. Per opdrachtgever. Elke maand opnieuw.', 'veryo' ), array( 'className' => 'veryo-lead' ) ),
	'veryo-lp-problem'
);
$veryo_kr .= veryo_sec_wide(
	veryo_b_columns(
		array(
			array( 'inner' => veryo_b_shortcode( '[veryo_lp_voorbeeld kant="voor"]' ) ),
			array( 'inner' => veryo_b_shortcode( '[veryo_lp_voorbeeld kant="na"]' ) ),
		)
	),
	'veryo-lp-beforeafter'
);
$veryo_kr .= $veryo_lp_steps(
	__( 'Zo werkt het', 'veryo' ),
	array(
		__( 'Rapporten komen binnen zoals nu: via mail of jullie systeem.', 'veryo' ),
		__( 'De AI leest en ordent ze: per opdrachtgever, per object, per type incident.', 'veryo' ),
		__( 'Het klantrapport staat klaar in jullie huisstijl. Een mens kijkt het na en verstuurt.', 'veryo' ),
	)
);
$veryo_kr .= veryo_sec_wide(
	veryo_b_h( esc_html__( 'Zie het eerst op je eigen rapporten.', 'veryo' ) )
	. veryo_b_p( esc_html__( 'Stuur ons één maand aan rapporten, zonder namen, kentekens of andere persoonsgegevens. Binnen 24 uur krijg je het klantrapport terug dat automatisch is gemaakt. Kost niks, je zit nergens aan vast.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
	. veryo_b_group( veryo_b_shortcode( '[veryo_lp_form type="proefrapport"]' ), array( 'className' => 'is-style-paper veryo-form-wrap' ) ),
	'veryo-lp-formblock',
	'proefrapport'
);
$veryo_kr .= veryo_sec_wide(
	veryo_b_group(
		veryo_b_h( esc_html__( 'Prijs', 'veryo' ) )
		. veryo_b_shortcode( '[veryo_lp_kr_prijs]' ),
		array( 'className' => 'is-style-soft veryo-price veryo-lp-price' )
	),
	'veryo-lp-pricing'
);
$veryo_kr .= veryo_sec_faq(
	array(
		array( __( 'Is dit veilig met onze gegevens?', 'veryo' ), __( 'Voor het proefrapport werken we alleen met geanonimiseerde rapporten. Bij een samenwerking sluiten we een verwerkersovereenkomst en blijven de gegevens van jullie.', 'veryo' ) ),
		array( __( 'Moeten we overstappen op een ander systeem?', 'veryo' ), __( 'Nee. Het werkt met hoe de rapporten nu binnenkomen.', 'veryo' ) ),
		array( __( 'Wie controleert het rapport?', 'veryo' ), __( 'Altijd een mens van jullie kant, voordat het naar de opdrachtgever gaat.', 'veryo' ) ),
		array( __( 'Kan het in onze huisstijl?', 'veryo' ), __( 'Ja, met jullie logo, kleuren en vaste opbouw.', 'veryo' ) ),
	)
);
$veryo_kr .= $veryo_lp_closer( __( 'Hoeveel uur kostte de rapportage van vorige maand?', 'veryo' ), __( 'Vraag een gratis proefrapport aan', 'veryo' ), '#proefrapport' );

return array(
	'founding-partner'            => array(
		'title'     => __( 'Founding Partners 2026', 'veryo' ),
		'seo_title' => __( 'Founding Partners 2026: bouw mee met Veryo | Veryo', 'veryo' ),
		'desc'      => __( 'Veryo zoekt 6 bedrijven die als Founding Partner een AI-oplossing krijgen tegen een lagere instap. Twee plekken per oplossing. Vraag een plek aan.', 'veryo' ),
		'kw'        => 'founding partner veryo',
		'meta'      => array(
			'hide_title' => 1,
			'noindex'    => 1,
		),
		'template'  => 'templates/landing.php',
		'content'   => $veryo_fp,
	),
	'lead-opvolging'              => array(
		'title'     => __( 'Elke aanvraag binnen 2 minuten opgevolgd', 'veryo' ),
		'seo_title' => __( 'Elke aanvraag binnen 2 minuten opgevolgd | Veryo', 'veryo' ),
		'desc'      => __( 'Elke aanvraag binnen 2 minuten opgevolgd, ook om 22:00. De AI reageert via WhatsApp, vraagt door en zet de inmeting in je agenda. Plan een gesprek.', 'veryo' ),
		'kw'        => 'leads opvolgen vakbedrijf',
		'meta'      => array( 'hide_title' => 1 ),
		'template'  => 'templates/landing.php',
		'content'   => $veryo_lo,
	),
	'klantrapportage-beveiliging' => array(
		'title'     => __( 'Je maandrapportage maakt zichzelf', 'veryo' ),
		'seo_title' => __( 'Klantrapportage voor beveiligingsbedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'Je maandrapportage maakt zichzelf: dienst- en incidentrapporten worden een klantrapport in jullie huisstijl. Vraag een gratis proefrapport aan.', 'veryo' ),
		'kw'        => 'klantrapportage beveiliging',
		'meta'      => array( 'hide_title' => 1 ),
		'template'  => 'templates/landing.php',
		'content'   => $veryo_kr,
	),
);
