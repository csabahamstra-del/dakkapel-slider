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
		'seo_title' => sprintf( __( '%s: lokale AI voor bedrijven op kantoor | Veryo', 'veryo' ), $veryo_cc['naam'] ),
		/* translators: %s: productnaam. */
		'desc'      => sprintf( __( '%s: een AI-assistent op je eigen kantoor die alles weet van je bedrijf. AVG-proof, je gegevens verlaten het pand niet. Plan een demo.', 'veryo' ), $veryo_cc['naam'] ),
		'kw'        => 'lokale ai voor bedrijven',
		'schema'    => array(
			'type' => 'collega',
			'min'  => (int) reset( $veryo_cc['pakketten'] )['prijs'],
			'area' => 'Nederland',
		),
		'meta'      => array( 'hide_title' => 1 ),
		'og_image'  => 'og-collega.png',
		'content'   => veryo_page_collega(),
	),
);
