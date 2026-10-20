<?php
/**
 * Oplossingen: overzicht en een detailpagina per vaste oplossing.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_solutions  = veryo_sec_answer( __( 'Oplossingen van Veryo zijn vaste AI-toepassingen voor werk dat in veel bedrijven hetzelfde gaat: leads opvolgen, rapporteren, offertes en facturen maken, werkbonnen en inkoopfacturen verwerken en kandidaten screenen. We richten ze in op jouw systemen en houden ze draaiende. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) );
$veryo_solutions .= veryo_sec_wide( veryo_product_cards(), 'veryo-products veryo-products--overview' );
$veryo_solutions .= veryo_sec_wide(
	veryo_b_h( __( 'Zo zetten we een oplossing neer', 'veryo' ) )
	. veryo_b_list(
		array(
			'<strong>' . __( 'Kennismaken', 'veryo' ) . '</strong><br>' . __( 'Via de gratis AI-scan of een kort gesprek. We kijken of de oplossing past en wat het oplevert.', 'veryo' ),
			'<strong>' . __( 'Inrichten', 'veryo' ) . '</strong><br>' . __( 'We koppelen de oplossing aan jouw systemen: mail, agenda, administratie of planning. Jouw vragen, jouw opmaak, jouw regels.', 'veryo' ),
			'<strong>' . __( 'Testen met echte voorbeelden', 'veryo' ) . '</strong><br>' . __( 'Eerst draait alles mee naast je huidige werkwijze, zodat je ziet wat de oplossing doet voordat hij het overneemt.', 'veryo' ),
			'<strong>' . __( 'Live en bijsturen', 'veryo' ) . '</strong><br>' . __( 'Daarna draait hij zelfstandig. We houden hem in de gaten, sturen bij en passen aan als je werkwijze verandert.', 'veryo' ),
		),
		array( 'className' => 'is-style-steps' )
	),
	'veryo-steps--home'
);
$veryo_solutions .= veryo_sec_text(
	__( 'Oplossing of maatwerk?', 'veryo' ),
	array(
		sprintf(
			/* translators: 1: link naar automatisering, 2: link naar AI op maat. */
			__( 'Een oplossing is een beproefde aanpak voor een vaak voorkomend probleem, met een vaste maandprijs. Past jouw situatie er niet in, dan bouwen we een losse <a href="%1$s">automatisering</a> of <a href="%2$s">maatwerk</a>. In het eerste gesprek hoor je eerlijk wat het beste past.', 'veryo' ),
			esc_url( veryo_link( 'ai-automatisering' ) ),
			esc_url( veryo_link( 'ai-op-maat' ) )
		),
	)
);
$veryo_solutions .= veryo_sec_contact(
	__( 'Welke oplossing past bij jullie?', 'veryo' ),
	__( 'Vertel kort waar de meeste tijd in gaat. Je hoort binnen één werkdag welke oplossing past, of dat iets anders slimmer is.', 'veryo' ),
	__( 'Bijvoorbeeld: we zijn een kozijnenbedrijf en bellen leads vaak pas na een dag terug.', 'veryo' )
);
$veryo_solutions .= veryo_sec_faq(
	array(
		array( __( 'Wat kost een oplossing?', 'veryo' ), __( 'De prijs hangt af van het volume en de systemen waarop we aansluiten. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) ),
		array( __( 'Moet ik andere software gaan gebruiken?', 'veryo' ), __( 'Nee. De oplossingen werken bovenop je bestaande mail, agenda, administratie en planning. We verkopen geen eigen software.', 'veryo' ) ),
		array( __( 'Hoe snel draait het?', 'veryo' ), __( 'Dat hangt af van de koppelingen. Na het eerste gesprek hoor je wat de planning is; daar houden we ons aan.', 'veryo' ) ),
		array( __( 'Wat gebeurt er met onze gegevens?', 'veryo' ), __( 'We werken met zakelijke AI-diensten die je gegevens niet gebruiken om modellen te trainen, sluiten een verwerkersovereenkomst en geven alleen toegang tot wat nodig is.', 'veryo' ) ),
	)
);
$veryo_solutions .= veryo_sec_cta_scan( __( 'Benieuwd welke oplossing het meeste oplevert?', 'veryo' ) );

$veryo_solution_pages = array(
	'oplossingen' => array(
		'title'     => __( 'AI-oplossingen voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-oplossingen voor het MKB: vaste prijs per maand | Veryo', 'veryo' ),
		'desc'      => __( 'Kant-en-klare AI-oplossingen: lead-opvolging, klantrapportage, offertes, werkbonnen, inkoopfacturen en recruitment. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai oplossingen mkb',
		'content'   => $veryo_solutions,
	),
);
foreach ( veryo_products() as $veryo_key => $veryo_product ) {
	$veryo_solution_pages[ 'oplossingen/' . $veryo_key ] = array(
		'title'     => $veryo_product['naam'],
		'seo_title' => $veryo_product['seo_title'],
		'desc'      => $veryo_product['desc'],
		'kw'        => $veryo_product['kw'],
		'schema'    => array(
			'type' => 'oplossing',
			'min'  => 750,
			'area' => 'Nederland',
		),
		'content'   => veryo_page_product( $veryo_key ),
	);
}
unset( $veryo_key, $veryo_product );

return $veryo_solution_pages;
