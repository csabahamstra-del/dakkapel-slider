<?php
/**
 * Productpagina Veryo Collega. De inhoud staat in inc/content/collega.php, de variabelen in
 * inc/collega-config.php.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_cc = veryo_collega();

return array(
	$veryo_cc['slug'] => array(
		'title'     => $veryo_cc['naam'],
		/* translators: %s: productnaam. */
		'seo_title' => sprintf( __( '%s: lokale AI-assistent voor bedrijven | Veryo', 'veryo' ), $veryo_cc['naam'] ),
		/* translators: %s: productnaam. */
		'desc'      => sprintf( __( '%s: de lokale AI-assistent en kennisbank voor bedrijven, op jullie eigen kantoor. Jullie data blijft binnen. Plan een gratis demo.', 'veryo' ), $veryo_cc['naam'] ),
		'kw'        => 'lokale ai assistent voor bedrijven',
		'schema'    => array(
			'type' => 'collega',
			'area' => 'Nederland',
		),
		'meta'      => array( 'hide_title' => 1 ),
		'og_image'  => 'og-collega.png',
		'content'   => veryo_page_collega(),
	),
);
