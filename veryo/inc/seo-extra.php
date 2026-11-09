<?php
/**
 * Technische SEO naast inc/seo.php: taal, opgeschoonde head, theme-color, bijlagen, noindex
 * voor archieven, 301-redirects, samenwerking met Rank Math en meet-events.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/*
 * Taal en head
 */

/**
 * De site is Nederlands: altijd lang="nl-NL", ook als de taal van WordPress anders staat.
 *
 * @param string $output Attributen.
 * @return string
 */
function veryo_language_attributes( $output ) {
	return (string) preg_replace( '/lang="[^"]*"/', 'lang="nl-NL"', $output );
}
add_filter( 'language_attributes', 'veryo_language_attributes' );

/**
 * Ballast uit de head: REST- en oEmbed-links en de shortlink.
 */
function veryo_clean_head() {
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
}
add_action( 'init', 'veryo_clean_head' );

/**
 * Theme-color voor de adresbalk op mobiel.
 */
function veryo_theme_color() {
	echo '<meta name="theme-color" content="#1D4B44">' . "\n";
}
add_action( 'wp_head', 'veryo_theme_color', 2 );

/*
 * Indexatie
 */

/**
 * Pagina's die niet in Google horen: zoekresultaten, auteur-, tag- en datumarchieven, lege
 * categorieën en bijlagen.
 *
 * @return bool
 */
function veryo_is_thin_archive() {
	if ( is_search() || is_author() || is_tag() || is_date() || is_attachment() ) {
		return true;
	}
	if ( is_category() ) {
		$term = get_queried_object();
		return ! ( $term instanceof WP_Term ) || (int) $term->count < 1;
	}
	return false;
}

/**
 * Noindex, follow voor dunne archieven (zonder SEO-plugin).
 *
 * @param array<string,bool|string> $robots Directieven.
 * @return array<string,bool|string>
 */
function veryo_robots_archives( $robots ) {
	if ( veryo_is_thin_archive() ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
		unset( $robots['max-image-preview'] );
	}
	return $robots;
}
add_filter( 'wp_robots', 'veryo_robots_archives', 20 );

/**
 * Dezelfde regel als Rank Math actief is.
 *
 * @param array<string,string> $robots Directieven van Rank Math.
 * @return array<string,string>
 */
function veryo_rank_math_robots( $robots ) {
	if ( veryo_is_thin_archive() ) {
		$robots['index']  = 'noindex';
		$robots['follow'] = 'follow';
	}
	return $robots;
}
add_filter( 'rank_math/frontend/robots', 'veryo_rank_math_robots' );

/**
 * Bijlagepagina's bestaan niet voor bezoekers: door naar het bericht of de pagina waar de
 * bijlage bij hoort, en anders naar het bestand zelf.
 */
function veryo_redirect_attachments() {
	if ( ! is_attachment() ) {
		return;
	}
	$post   = get_queried_object();
	$parent = $post instanceof WP_Post && $post->post_parent ? get_permalink( $post->post_parent ) : '';
	$target = $parent ? $parent : wp_get_attachment_url( (int) get_queried_object_id() );
	if ( $target ) {
		wp_safe_redirect( $target, 301 );
		exit;
	}
}
add_action( 'template_redirect', 'veryo_redirect_attachments', 1 );

/*
 * Redirects
 */

/**
 * Vaste 301-redirects van pagina's die zijn samengevoegd (bron-pad => doel-pad). De lijst
 * staat ook in REDIRECTS.md.
 *
 * @return array<string,string>
 */
function veryo_redirects() {
	return apply_filters(
		'veryo_redirects',
		array(
			'ai-op-maat/interne-assistent'         => veryo_collega()['slug'],
			'ai-automatisering/kennis-en-documenten' => veryo_collega()['slug'],
		)
	);
}

/**
 * Redirect uitvoeren als de opgevraagde URL op de lijst staat.
 */
function veryo_do_redirects() {
	if ( is_admin() ) {
		return;
	}
	$path = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_parse_url( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH ) : '';
	$base = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	$path = trim( (string) substr( $path, strlen( rtrim( $base, '/' ) ) ), '/' );
	$map  = veryo_redirects();
	if ( '' !== $path && isset( $map[ $path ] ) ) {
		wp_safe_redirect( home_url( '/' . trim( $map[ $path ], '/' ) . '/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'veryo_do_redirects', 0 );

/*
 * Rank Math
 */

/**
 * Rank Math geeft title, description, canonical, robots, OG en de sitemap uit. Het schema
 * komt van het thema (één @graph met FAQ, Service, Course, Person en LocalBusiness); het
 * schema van Rank Math gaat daarom uit, zodat er geen dubbele entiteiten op de pagina staan.
 *
 * @param array<string,mixed> $data JSON-LD van Rank Math.
 * @return array<string,mixed>
 */
function veryo_rank_math_json_ld( $data ) {
	unset( $data );
	return array();
}
add_filter( 'rank_math/json_ld', 'veryo_rank_math_json_ld', 999 );

/**
 * Hetzelfde voor Yoast, als die ooit actief is.
 *
 * @return bool
 */
function veryo_yoast_json_ld() {
	return false;
}
add_filter( 'wpseo_json_ld_output', 'veryo_yoast_json_ld' );

/**
 * SEO-velden van het thema naar Rank Math: title, description en focuszoekwoord. Een veld
 * wordt alleen overschreven als het leeg is, of nog precies de waarde heeft die het thema er
 * eerder in zette. Zelf ingevulde waarden in Rank Math blijven dus staan.
 *
 * @param int                 $post_id  ID.
 * @param array<string,mixed> $def      Definitie uit het register.
 * @param array<string,string> $previous Vorige waarden van het thema (title, desc, kw).
 */
function veryo_sync_rank_math_fields( $post_id, $def, $previous ) {
	$fields = array(
		'rank_math_title'         => array( isset( $def['seo_title'] ) ? $def['seo_title'] : '', 'title' ),
		'rank_math_description'   => array( isset( $def['desc'] ) ? $def['desc'] : '', 'desc' ),
		'rank_math_focus_keyword' => array( isset( $def['kw'] ) ? $def['kw'] : '', 'kw' ),
	);
	foreach ( $fields as $key => $field ) {
		list( $value, $which ) = $field;
		if ( '' === $value ) {
			continue;
		}
		$current  = (string) get_post_meta( $post_id, $key, true );
		$last     = (string) get_post_meta( $post_id, '_veryo_rm_' . $which, true );
		$was_ours = '' === $current || $current === $last || ( isset( $previous[ $which ] ) && $current === $previous[ $which ] );
		if ( $was_ours ) {
			update_post_meta( $post_id, $key, $value );
			update_post_meta( $post_id, '_veryo_rm_' . $which, $value );
		}
	}
}

/**
 * Geen tag-archieven in de sitemap van WordPress (ze staan op noindex). Categorieën blijven,
 * zodra er berichten in staan.
 *
 * @param array<string,WP_Taxonomy> $taxonomies Taxonomieën.
 * @return array<string,WP_Taxonomy>
 */
function veryo_sitemap_taxonomies( $taxonomies ) {
	unset( $taxonomies['post_tag'], $taxonomies['post_format'] );
	return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'veryo_sitemap_taxonomies' );
