<?php
/**
 * Register van alle pagina's en blogconcepten die het thema bij activatie aanmaakt.
 * De inhoudsbestanden worden alleen geladen als ze nodig zijn (activatie, Extra-knop).
 *
 * Per pagina:
 *  - title      H1 / paginatitel
 *  - seo_title  SEO-title (≤ 60 tekens)
 *  - desc       meta description (140–155 tekens)
 *  - kw         hoofdzoekwoord (ter referentie opgeslagen)
 *  - schema     optioneel: type service + prijsrange + areaServed
 *  - meta       optioneel: hide_title, noindex, legal_draft
 *  - content    block markup
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Alle pagina's, ouders vóór kinderen. Sleutel = pad.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_content_pages() {
	static $pages = null;
	if ( null !== $pages ) {
		return $pages;
	}
	$pages = array();
	foreach ( array( 'pages-main', 'pages-training', 'pages-tools', 'pages-collega', 'pages-producten', 'pages-oplossingen', 'pages-pijlers', 'pages-automatisering', 'pages-opmaat', 'pages-regio', 'pages-branches', 'pages-landing', 'pages-legal' ) as $file ) {
		$pages = array_merge( $pages, require VERYO_DIR . '/inc/content/' . $file . '.php' );
	}
	// "Werkt met"-blok op dienst- en branchepagina's (zie inc/tools-registry.php).
	foreach ( veryo_page_tools() as $path => $tools ) {
		if ( isset( $pages[ $path ] ) ) {
			$pages[ $path ]['content'] = veryo_insert_werkt_met( $pages[ $path ]['content'], $tools[0], $tools[1] );
		}
	}
	return $pages;
}

/**
 * Blogconcepten.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_content_posts() {
	// Uitgeschreven artikelen staan apart en vervangen een concept met dezelfde slug.
	return array_merge( require VERYO_DIR . '/inc/content/posts-blog.php', require VERYO_DIR . '/inc/content/posts-artikelen.php', require VERYO_DIR . '/inc/content/posts-gidsen.php' );
}
