<?php
/**
 * "In de media": vermeldingen van Veryo in andere media. Een korte samenvatting in eigen
 * woorden, een citaat van Csaba en een link naar het originele artikel. De tekst van het
 * medium zelf nemen we niet over (auteursrecht en dubbele content).
 *
 * Nieuwe vermelding: voeg een regel toe aan veryo_press_items(). De nieuwste staat bovenaan.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Alle vermeldingen.
 *
 * @return array<int,array{medium:string,title:string,url:string,date:string,summary:string,quote:string}>
 */
function veryo_press_items() {
	return apply_filters(
		'veryo_press_items',
		array(
			array(
				'medium'  => 'OF.nl',
				'title'   => 'Leeuwarder bedrijf Veryo bouwt AI-assistent die bedrijfsdata binnen de deur houdt',
				'url'     => 'https://www.of.nl/leeuwarder-bedrijf-veryo-bouwt-ai-assistent-die-bedrijfsdata-binnen-de-deur-houdt/',
				'date'    => '2026-11-06',
				'summary' => __( 'OF.nl schreef over Veryo Collega: de AI-assistent die volledig lokaal binnen een bedrijf draait en de documenten, cijfers, facturen en planning van het bedrijf kent. Het verschil met tools als ChatGPT: er gaat geen data naar buiten. Daarmee speelt Veryo in op de zorg van veel Friese mkb-bedrijven over hun bedrijfsgegevens.', 'veryo' ),
				'quote'   => __( 'Ondernemers zien de kansen van AI, maar willen niet dat hun klantgegevens ergens op een server in het buitenland belanden.', 'veryo' ),
			),
		)
	);
}

/**
 * Het blok "In de media" als block markup.
 *
 * @return string
 */
function veryo_sec_press() {
	$items = veryo_press_items();
	if ( ! $items ) {
		return '';
	}
	$founder = veryo_blog_author()['name'];
	$inner   = veryo_b_p( __( 'In de media', 'veryo' ), array( 'className' => 'veryo-kicker' ) )
		. veryo_b_h( __( 'Veryo in het nieuws', 'veryo' ) );
	foreach ( $items as $item ) {
		$date   = mysql2date( 'j F Y', $item['date'] );
		$inner .= veryo_b_group(
			veryo_b_p( esc_html( $item['medium'] ) . ' · <time datetime="' . esc_attr( $item['date'] ) . '">' . esc_html( $date ) . '</time>', array( 'className' => 'veryo-press__meta' ) )
			. veryo_b_h( '<a href="' . esc_url( $item['url'] ) . '" target="_blank" rel="noopener">' . esc_html( $item['title'] ) . '</a>', 3, array( 'className' => 'veryo-press__title' ) )
			. veryo_b_p( esc_html( $item['summary'] ) )
			. veryo_b( 'quote', array( 'className' => 'veryo-press__quote' ), '<blockquote class="wp-block-quote veryo-press__quote">' . veryo_b_p( '“' . esc_html( $item['quote'] ) . '”' ) . '<cite>' . esc_html( $founder ) . ', ' . esc_html__( 'oprichter Veryo', 'veryo' ) . '</cite></blockquote>' )
			. veryo_b_p( '<a href="' . esc_url( $item['url'] ) . '" target="_blank" rel="noopener">' . esc_html( sprintf( /* translators: %s: medium. */ __( 'Lees het artikel op %s', 'veryo' ), $item['medium'] ) ) . '<span class="screen-reader-text"> ' . esc_html__( '(opent in een nieuw tabblad)', 'veryo' ) . '</span></a>', array( 'className' => 'veryo-press__more' ) ),
			array(
				'tagName'   => 'article',
				'className' => 'veryo-press__item',
			)
		);
	}
	return veryo_b_group(
		$inner,
		array(
			'tagName'   => 'section',
			'className' => 'veryo-section veryo-press',
		)
	);
}

/**
 * Op welke pagina's het blok staat, en na welk blok (class).
 *
 * @return array<string,string>
 */
function veryo_press_pages() {
	return apply_filters(
		'veryo_press_pages',
		array(
			'over-veryo'            => 'veryo-about-founder',
			veryo_collega()['slug'] => 'veryo-collega-local',
		)
	);
}

/**
 * Het blok in de inhoud zetten, na het blok met de opgegeven class (anders na het eerste blok).
 *
 * @param string $content Block markup.
 * @param string $after_class Class van het blok waarna het komt.
 * @return string
 */
function veryo_insert_press( $content, $after_class ) {
	if ( false !== strpos( $content, 'veryo-press' ) ) {
		return $content;
	}
	$block = veryo_sec_press();
	if ( '' === $block ) {
		return $content;
	}
	if ( preg_match( '#"className":"[^"]*' . preg_quote( $after_class, '#' ) . '[^"]*"#', $content, $m, PREG_OFFSET_CAPTURE ) ) {
		$start = strrpos( substr( $content, 0, $m[0][1] ), '<!-- wp:' );
		$end   = false === $start ? -1 : veryo_first_block_end( substr( $content, $start ) );
		if ( $end > 0 ) {
			return substr( $content, 0, $start + $end ) . "\n" . $block . substr( $content, $start + $end );
		}
	}
	return veryo_insert_after_first_block( $content, $block );
}

/**
 * Ook op zelf aangepaste pagina's: bij het tonen toevoegen als het blok er nog niet staat.
 *
 * @param string $content Inhoud.
 * @return string
 */
function veryo_auto_press( $content ) {
	if ( is_admin() || ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() || ! apply_filters( 'veryo_auto_tools', true ) ) {
		return $content;
	}
	$pages = veryo_press_pages();
	$path  = get_page_uri( get_queried_object_id() );
	return isset( $pages[ $path ] ) ? veryo_insert_press( $content, $pages[ $path ] ) : $content;
}
add_filter( 'the_content', 'veryo_auto_press', 6 );

/**
 * Vermeldingen voor schema.org (subjectOf van de organisatie).
 *
 * @return array<int,array<string,mixed>>
 */
function veryo_schema_press() {
	$out = array();
	foreach ( veryo_press_items() as $item ) {
		$out[] = array(
			'@type'         => 'NewsArticle',
			'headline'      => $item['title'],
			'url'           => $item['url'],
			'datePublished' => $item['date'],
			'inLanguage'    => 'nl-NL',
			'publisher'     => array(
				'@type' => 'Organization',
				'name'  => $item['medium'],
			),
			'about'         => array( '@id' => home_url( '/#organization' ) ),
		);
	}
	return $out;
}
