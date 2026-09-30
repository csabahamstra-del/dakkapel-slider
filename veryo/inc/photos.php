<?php
/**
 * Foto's: een kleine bibliotheek met (rechtenvrije) stockfoto's in het thema.
 * Bij activatie worden ze eenmalig in de mediabibliotheek gezet, zodat WordPress
 * er formaten en srcset voor maakt. Ontbreekt een foto, dan blijft de [FOTO]-plek staan.
 *
 * Bestanden: assets/images/photos/{sleutel}.webp (of .jpg). Bronvermelding: assets/images/photos/CREDITS.md.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Beschikbare onderwerpen: sleutel => titel in de mediabibliotheek.
 *
 * @return array<string,string>
 */
function veryo_photo_library() {
	return array(
		'team'         => __( 'Team aan het werk op kantoor', 'veryo' ),
		'kantoor'      => __( 'Medewerker aan het werk op kantoor', 'veryo' ),
		'laptop'       => __( 'Laptop op een werktafel', 'veryo' ),
		'overleg'      => __( 'Overleg aan tafel', 'veryo' ),
		'training'     => __( 'Groep tijdens een training', 'veryo' ),
		'installateur' => __( 'Installateur aan het werk', 'veryo' ),
		'telefoon'     => __( 'Bericht versturen op een smartphone', 'veryo' ),
		'bouw'         => __( 'Bouwplaats', 'veryo' ),
		'agri'         => __( 'Agrarisch bedrijf', 'veryo' ),
		'horeca'       => __( 'Restaurant', 'veryo' ),
		'logistiek'    => __( 'Transport en logistiek', 'veryo' ),
		'woning'       => __( 'Woning', 'veryo' ),
		'werkplaats'   => __( 'Werkplaats', 'veryo' ),
		'landschap'    => __( 'Landschap in Noord-Nederland', 'veryo' ),
	);
}

/**
 * Pad naar het fotobestand in het thema.
 *
 * @param string $key Sleutel.
 * @return string Leeg als het bestand ontbreekt.
 */
function veryo_photo_file( $key ) {
	foreach ( array( 'webp', 'jpg' ) as $ext ) {
		$file = VERYO_DIR . '/assets/images/photos/' . $key . '.' . $ext;
		if ( file_exists( $file ) ) {
			return $file;
		}
	}
	return '';
}

/**
 * Foto's eenmalig in de mediabibliotheek zetten. Idempotent.
 *
 * @return array<string,int> Sleutel => attachment-ID.
 */
function veryo_import_photos() {
	$ids = get_option( 'veryo_photo_ids', array() );
	$ids = is_array( $ids ) ? $ids : array();
	require_once ABSPATH . 'wp-admin/includes/image.php';
	foreach ( veryo_photo_library() as $key => $title ) {
		if ( ! empty( $ids[ $key ] ) && get_post( (int) $ids[ $key ] ) ) {
			continue;
		}
		$file = veryo_photo_file( $key );
		if ( '' === $file ) {
			continue;
		}
		$bits = wp_upload_bits( 'veryo-' . basename( $file ), null, (string) file_get_contents( $file ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- lokaal themabestand.
		if ( ! empty( $bits['error'] ) ) {
			continue;
		}
		$type          = wp_check_filetype( $bits['file'] );
		$attachment_id = wp_insert_attachment(
			array(
				'post_mime_type' => $type['type'],
				'post_title'     => $title,
				'post_status'    => 'inherit',
			),
			$bits['file']
		);
		if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
			continue;
		}
		wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $bits['file'] ) );
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $title );
		$ids[ $key ] = (int) $attachment_id;
	}
	update_option( 'veryo_photo_ids', $ids, false );
	return $ids;
}

/**
 * Attachment-ID van een foto, of 0.
 *
 * @param string $key Sleutel.
 * @return int
 */
function veryo_photo_id( $key ) {
	$ids = get_option( 'veryo_photo_ids', array() );
	$id  = is_array( $ids ) && ! empty( $ids[ $key ] ) ? (int) $ids[ $key ] : 0;
	return ( $id && wp_attachment_is_image( $id ) ) ? $id : 0;
}

/**
 * Afbeeldingsblok voor een foto uit de bibliotheek.
 *
 * @param int    $id    Attachment-ID.
 * @param string $alt   Alt-tekst (per pagina, met het zoekwoord).
 * @param string $class Extra class.
 * @return string
 */
function veryo_b_image( $id, $alt, $class = 'veryo-img' ) {
	$src   = wp_get_attachment_image_src( $id, 'large' );
	$url   = $src ? $src[0] : (string) wp_get_attachment_url( $id );
	$attrs = array(
		'id'              => $id,
		'sizeSlug'        => 'large',
		'linkDestination' => 'none',
		'className'       => $class,
	);
	return veryo_b(
		'image',
		$attrs,
		'<figure class="wp-block-image size-large ' . esc_attr( $class ) . '"><img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '" class="wp-image-' . (int) $id . '"/></figure>'
	);
}
