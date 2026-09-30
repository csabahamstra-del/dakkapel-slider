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
	foreach ( array( 'pages-main', 'pages-producten', 'pages-automatisering', 'pages-opmaat', 'pages-regio', 'pages-branches', 'pages-legal' ) as $file ) {
		$pages = array_merge( $pages, require VERYO_DIR . '/inc/content/' . $file . '.php' );
	}
	return $pages;
}

/**
 * Blogconcepten.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_content_posts() {
	return require VERYO_DIR . '/inc/content/posts-blog.php';
}
