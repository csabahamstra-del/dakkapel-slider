<?php
/**
 * Foto's: een kleine bibliotheek met (rechtenvrije) stockfoto's in het thema.
 * Bij activatie worden ze eenmalig in de mediabibliotheek gezet, zodat WordPress
 * er formaten en srcset voor maakt. Ontbreekt een foto, dan komt er op die plek niets.
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
		'werkplek'     => __( 'Werkplekken met beeldschermen op kantoor', 'veryo' ),
		'oprichter'    => __( 'Csaba, oprichter van Veryo', 'veryo' ),
		'hero'         => __( 'Team aan het werk op kantoor', 'veryo' ),
	);
}

/**
 * Sleutels die dezelfde foto gebruiken als een andere sleutel (zo staat een foto maar één keer
 * in de mediabibliotheek).
 *
 * @return array<string,string>
 */
function veryo_photo_aliases() {
	return array(
		'training' => 'team',
	);
}

/**
 * Pad naar het fotobestand in het thema.
 *
 * @param string $key Sleutel.
 * @param string $ext Alleen deze extensie proberen (webp of jpg).
 * @return string Leeg als het bestand ontbreekt.
 */
function veryo_photo_file( $key, $ext = '' ) {
	foreach ( $ext ? array( $ext ) : array( 'webp', 'jpg' ) as $try ) {
		$file = VERYO_DIR . '/assets/images/photos/' . $key . '.' . $try;
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
	$errors = array();
	foreach ( veryo_photo_library() as $key => $title ) {
		if ( ! empty( $ids[ $key ] ) && get_post( (int) $ids[ $key ] ) ) {
			continue;
		}
		// Eerst WebP; lukt dat niet (sommige hosting staat WebP niet toe), dan JPG.
		foreach ( array( 'webp', 'jpg' ) as $ext ) {
			$file = veryo_photo_file( $key, $ext );
			if ( '' === $file ) {
				continue;
			}
			$attachment_id = veryo_import_photo_file( $file, $title );
			if ( is_wp_error( $attachment_id ) ) {
				$errors[ $key ] = $attachment_id->get_error_message();
				continue;
			}
			$ids[ $key ] = $attachment_id;
			unset( $errors[ $key ] );
			break;
		}
	}
	update_option( 'veryo_photo_ids', $ids, false );
	update_option( 'veryo_photo_errors', $errors, false );
	if ( $errors ) {
		// Later nog eens proberen, maar niet bij elke klik in wp-admin.
		set_transient( 'veryo_photos_retry', 1, HOUR_IN_SECONDS );
	} else {
		update_option( 'veryo_photos_version', veryo_photos_fingerprint(), false );
	}
	return $ids;
}

/**
 * Eén fotobestand in de mediabibliotheek zetten.
 *
 * @param string $file  Pad naar het bestand in het thema.
 * @param string $title Titel en alt-tekst.
 * @return int|WP_Error Attachment-ID of fout.
 */
function veryo_import_photo_file( $file, $title ) {
	$bits = wp_upload_bits( 'veryo-' . basename( $file ), null, (string) file_get_contents( $file ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- lokaal themabestand.
	if ( ! empty( $bits['error'] ) ) {
		return new WP_Error( 'veryo_upload', (string) $bits['error'] );
	}
	$type          = wp_check_filetype( $bits['file'] );
	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => $type['type'] ? $type['type'] : 'image/jpeg',
			'post_title'     => $title,
			'post_status'    => 'inherit',
		),
		$bits['file'],
		0,
		true
	);
	if ( is_wp_error( $attachment_id ) ) {
		return $attachment_id;
	}
	wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $bits['file'] ) );
	update_post_meta( $attachment_id, '_wp_attachment_image_alt', $title );
	return (int) $attachment_id;
}

/**
 * Vingerafdruk van de foto's in het thema, om te zien of er nieuwe zijn bijgekomen.
 *
 * @return string
 */
function veryo_photos_fingerprint() {
	$files = glob( VERYO_DIR . '/assets/images/photos/*.{webp,jpg}', GLOB_BRACE );
	return md5( implode( '|', array_map( 'basename', is_array( $files ) ? $files : array() ) ) );
}

/**
 * Na een thema-update: nieuwe foto's automatisch in de mediabibliotheek zetten, zonder knop.
 */
function veryo_maybe_import_photos() {
	if ( ! current_user_can( 'upload_files' ) || wp_doing_ajax() ) {
		return;
	}
	if ( get_option( 'veryo_photos_version' ) === veryo_photos_fingerprint() || get_transient( 'veryo_photos_retry' ) ) {
		return;
	}
	$before = get_option( 'veryo_photo_ids', array() );
	$after  = veryo_import_photos();
	if ( count( (array) $after ) > count( (array) $before ) ) {
		update_option( 'veryo_photos_new', 1, false );
	}
}
add_action( 'admin_init', 'veryo_maybe_import_photos' );

/**
 * Melding over de foto's: klaar om op de pagina's te zetten, of een fout bij het importeren.
 */
function veryo_photos_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$errors = get_option( 'veryo_photo_errors', array() );
	if ( is_array( $errors ) && $errors ) {
		echo '<div class="notice notice-error"><p><strong>' . esc_html__( 'Veryo: niet alle foto’s konden in de mediabibliotheek worden gezet.', 'veryo' ) . '</strong> ';
		foreach ( $errors as $key => $message ) {
			echo esc_html( $key . ': ' . $message ) . '. ';
		}
		echo esc_html__( 'Controleer of de map wp-content/uploads schrijfbaar is, of upload de foto’s uit het thema (assets/images/photos) zelf via Media.', 'veryo' ) . '</p></div>';
		return;
	}
	if ( get_option( 'veryo_photos_new' ) ) {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( $screen && 'tools_page_veryo-content' === $screen->id ) {
			return;
		}
		echo '<div class="notice notice-info"><p>' . esc_html__( 'Veryo: de foto’s staan in je mediabibliotheek. Zet ze op je pagina’s via', 'veryo' ) . ' <a href="' . esc_url( admin_url( 'tools.php?page=veryo-content' ) ) . '">' . esc_html__( 'Extra > Veryo-inhoud > Pagina’s bijwerken', 'veryo' ) . '</a>.</p></div>';
	}
}
add_action( 'admin_notices', 'veryo_photos_notice' );

/**
 * Attachment-ID van een foto, of 0.
 *
 * @param string $key Sleutel.
 * @return int
 */
function veryo_photo_id( $key ) {
	$ids = get_option( 'veryo_photo_ids', array() );
	if ( ( ! is_array( $ids ) || empty( $ids[ $key ] ) ) && isset( veryo_photo_aliases()[ $key ] ) ) {
		$key = veryo_photo_aliases()[ $key ];
	}
	$id = is_array( $ids ) && ! empty( $ids[ $key ] ) ? (int) $ids[ $key ] : 0;
	return ( $id && wp_attachment_is_image( $id ) ) ? $id : 0;
}

/**
 * Afbeeldingsblok voor een foto uit de bibliotheek.
 *
 * @param int    $id    Attachment-ID.
 * @param string $alt   Alt-tekst (per pagina, met het zoekwoord).
 * @param string $css_class Extra class.
 * @param string $align     Uitlijning: '' of 'wide'.
 * @return string
 */
function veryo_b_image( $id, $alt, $css_class = 'veryo-img', $align = '' ) {
	$size  = 'wide' === $align ? 'full' : 'large';
	$src   = wp_get_attachment_image_src( $id, $size );
	$url   = $src ? $src[0] : (string) wp_get_attachment_url( $id );
	$attrs = array( 'id' => $id );
	if ( $align ) {
		$attrs['align'] = $align;
	}
	$attrs['sizeSlug']        = $size;
	$attrs['linkDestination'] = 'none';
	$attrs['className']       = $css_class;
	$classes                  = 'wp-block-image' . ( $align ? ' align' . $align : '' ) . ' size-' . $size . ' ' . $css_class;
	return veryo_b(
		'image',
		$attrs,
		'<figure class="' . esc_attr( $classes ) . '"><img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '" class="wp-image-' . (int) $id . '"/></figure>'
	);
}

/**
 * Foto's in de pagina-inhoud staan in dit thema nooit in de hero (de kop is het grootste element
 * bovenaan). WordPress laadt de eerste afbeeldingen standaard direct en met hoge prioriteit; hier
 * laden ze allemaal pas als ze in beeld komen, zodat de kop sneller verschijnt.
 *
 * @return int
 */
function veryo_lazy_all_content_images() {
	return 0;
}
add_filter( 'wp_omit_loading_attr_threshold', 'veryo_lazy_all_content_images' );

/**
 * Diensten die rechts in de homepage-banner voorbij draaien.
 *
 * @return array<int,array<int,string>> Lijst van array( icoon, label, pad ).
 */
function veryo_hero_services() {
	return array(
		array( 'scan', __( 'Gratis AI-scan', 'veryo' ), 'waar-begin-ik-met-ai' ),
		array( 'box', __( 'AI-Startpakket', 'veryo' ), 'ai-startpakket' ),
		array( 'monitor', __( 'Copilot en Gemini inrichten', 'veryo' ), 'ai-werkplek' ),
		array( 'bot', __( 'AI-agents als digitale collega', 'veryo' ), 'ai-agents' ),
		array( 'flow', __( 'Automatisering en koppelingen', 'veryo' ), 'ai-automatisering' ),
		array( 'users', __( 'AI-training voor je team', 'veryo' ), 'ai-training' ),
		array( 'shield', __( 'Veilig AI-gebruik', 'veryo' ), 'veilig-ai-gebruik' ),
		array( 'partner', __( 'AI-partner per maand', 'veryo' ), 'ai-partner' ),
	);
}

/**
 * Homepage-banner: grote foto op de achtergrond en rechts de diensten die voorbij draaien.
 * Gebeurt bij het tonen, zodat het ook werkt op pagina's die al bestaan.
 *
 * @param string              $html  HTML van het blok.
 * @param array<string,mixed> $block Blok.
 * @return string
 */
function veryo_render_home_hero( $html, $block ) {
	if ( 'core/group' !== $block['blockName'] || empty( $block['attrs']['className'] ) || false === strpos( $block['attrs']['className'], 'veryo-hero--home' ) ) {
		return $html;
	}
	$photo = veryo_photo_id( 'hero' );
	$open  = strpos( $html, '>' );
	$close = strrpos( $html, '</section>' );
	if ( ! $photo || false === $open || false === $close ) {
		return $html;
	}
	$media = '<div class="veryo-hero__bg" aria-hidden="true">' . wp_get_attachment_image(
		$photo,
		'full',
		false,
		array(
			'alt'           => '',
			'loading'       => 'eager',
			'fetchpriority' => 'high',
			'decoding'      => 'async',
			'sizes'         => '(max-width: 767px) 60vw, 100vw',
		)
	) . '</div>';
	$items = '';
	foreach ( veryo_hero_services() as $service ) {
		$items .= '<li><a href="' . esc_url( veryo_url( $service[2] ) ) . '">' . veryo_icon( $service[0] ) . '<span>' . esc_html( $service[1] ) . '</span></a></li>';
	}
	$services = '<nav class="veryo-hero__services" aria-label="' . esc_attr__( 'Diensten van Veryo', 'veryo' ) . '"><ul>' . $items . '</ul>'
		. '<span class="veryo-hero__tick" aria-hidden="true">' . veryo_icon( 'check' ) . '</span></nav>';
	$html     = substr( $html, 0, $close ) . $services . substr( $html, $close );
	$html     = substr( $html, 0, $open + 1 ) . $media . substr( $html, $open + 1 );
	return preg_replace( '/class="([^"]*veryo-hero--home)/', 'class="$1 veryo-hero--photo', $html, 1 );
}
add_filter( 'render_block', 'veryo_render_home_hero', 10, 2 );
