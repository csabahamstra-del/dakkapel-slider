<?php
/**
 * Veryo Collega: de centrale plek voor productnaam, teksten op knoppen, contact en prijzen.
 *
 * Pas hier de waarden aan. Teksten op de site lezen ze op het moment van tonen (via de
 * shortcodes [veryo_collega_naam], [veryo_collega_prijs], enzovoort), dus een nieuwe naam of
 * prijs staat direct overal goed. Alleen de paginatitel, SEO-titel, metabeschrijving en de
 * blogconcepten worden bij het aanmaken vastgelegd: klik na een wijziging op
 * Extra > Veryo-inhoud > Pagina's bijwerken.
 *
 * Liever niet in het thema zelf wijzigen? Gebruik dan in een eigen plugin het filter
 * 'veryo_collega_config', bijvoorbeeld:
 *   add_filter( 'veryo_collega_config', function ( $c ) { $c['naam'] = 'Veryo Kantoor-AI'; return $c; } );
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Alle variabelen van Veryo Collega.
 *
 * @return array<string,mixed>
 */
function veryo_collega() {
	static $config = null;
	if ( null !== $config ) {
		return $config;
	}
	$config = apply_filters(
		'veryo_collega_config',
		array(
			// Naam en kernboodschap.
			'naam'             => 'Veryo Collega',
			'slug'             => 'veryo-collega',
			'ondertitel'       => __( 'De AI-collega die alles weet van jouw bedrijf. Draait op je eigen kantoor.', 'veryo' ),

			// Knoppen.
			'cta_primair'      => __( 'Plan een demo', 'veryo' ),
			'cta_secundair'    => __( 'Bereken wat het je oplevert', 'veryo' ),

			// Contact (zelfde gegevens als Instellingen > Veryo).
			'email'            => 'info@veryo.nl',
			'telefoon'         => '085-0605752',
			'plaats'           => 'Leeuwarden',
			'werkgebied'       => __( 'werkzaam in heel Nederland', 'veryo' ),

			// Eenmalige kosten, exclusief btw. vanaf = true toont "vanaf". De sleutel gebruik je in [veryo_collega_prijs id=...].
			'eenmalig'         => array(
				'intake'      => array(
					'label'   => __( 'Intake en AI-scan', 'veryo' ),
					'prijs'   => 495,
					'vanaf'   => false,
					'notitie' => __( 'verrekend bij akkoord', 'veryo' ),
				),
				'installatie' => array(
					'label'   => __( 'Installatie en inrichting', 'veryo' ),
					'prijs'   => 2500,
					'vanaf'   => true,
					'notitie' => '',
				),
				'kennisoogst' => array(
					'label'   => __( 'Kennisoogst', 'veryo' ),
					'prijs'   => 1500,
					'vanaf'   => true,
					'notitie' => __( 'documenten verzamelen en interviews met ervaren medewerkers', 'veryo' ),
				),
				'koppelingen' => array(
					'label'   => __( 'Koppelingen', 'veryo' ),
					'prijs'   => 750,
					'vanaf'   => true,
					'notitie' => __( 'per systeem', 'veryo' ),
				),
				'training'    => array(
					'label'   => __( 'Training team', 'veryo' ),
					'prijs'   => 1200,
					'vanaf'   => false,
					'notitie' => '',
				),
			),

			// Maandelijkse pakketten, exclusief btw: prijs, aantal koppelingen en uren kennisonderhoud.
			'pakketten'        => array(
				'start' => array(
					'naam'        => __( 'Start', 'veryo' ),
					'team'        => __( '5–10 medewerkers', 'veryo' ),
					'tot'         => 10,
					'prijs'       => 395,
					'koppelingen' => 1,
					'uren'        => 2,
					'uitgelicht'  => false,
				),
				'groei' => array(
					'naam'        => __( 'Groei', 'veryo' ),
					'team'        => __( '10–25 medewerkers', 'veryo' ),
					'tot'         => 25,
					'prijs'       => 695,
					'koppelingen' => 3,
					'uren'        => 4,
					'uitgelicht'  => true,
				),
				'pro'   => array(
					'naam'        => __( 'Pro', 'veryo' ),
					'team'        => __( '25–50 medewerkers', 'veryo' ),
					'tot'         => 50,
					'prijs'       => 1195,
					'koppelingen' => 5,
					'uren'        => 8,
					'uitgelicht'  => false,
				),
			),
			'uitgelicht_label' => __( 'Meest gekozen', 'veryo' ),
			'hardware'         => __( 'Hardware kopen of in het abonnement verwerken, jij kiest.', 'veryo' ),

			// Rekenhulp: standaardwaarden en de aanname over hoeveel tijd het scheelt.
			'rekenhulp'        => array(
				'medewerkers' => 10,
				'uren'        => 2,
				'tarief'      => 50,
				'besparing'   => 0.3,
				'weken'       => 4.33,
			),
		)
	);
	return $config;
}

/**
 * Link naar de productpagina, eventueel met anker (demo, rekenhulp).
 *
 * @param string $anchor Anker zonder #.
 * @return string
 */
function veryo_collega_url( $anchor = '' ) {
	// Bestaat de productpagina (nog) niet, dan liever naar contact dan naar een 404.
	if ( ! veryo_collega_page_exists() ) {
		return veryo_url( 'contact' );
	}
	return veryo_url( veryo_collega()['slug'] ) . ( $anchor ? '#' . $anchor : '' );
}

/**
 * Staat de productpagina gepubliceerd op de site?
 *
 * @return bool
 */
function veryo_collega_page_exists() {
	static $exists = null;
	if ( null === $exists ) {
		$page   = get_page_by_path( veryo_collega()['slug'] );
		$exists = $page instanceof WP_Post && 'publish' === $page->post_status;
	}
	return $exists;
}

/**
 * Bedrag als "€1.195".
 *
 * @param int|float $amount Bedrag.
 * @return string
 */
function veryo_collega_euro( $amount ) {
	return '€' . number_format( (float) $amount, 0, ',', '.' );
}

/**
 * Het passende maandpakket voor een aantal medewerkers.
 *
 * @param int $team Aantal medewerkers.
 * @return string Sleutel van het pakket.
 */
function veryo_collega_package_for( $team ) {
	$last = '';
	foreach ( veryo_collega()['pakketten'] as $key => $package ) {
		$last = $key;
		if ( $team <= (int) $package['tot'] ) {
			return $key;
		}
	}
	return $last;
}
