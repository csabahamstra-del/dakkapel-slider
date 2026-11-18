<?php
/**
 * Kennisbank: eigen berichttype "kennis" met archief /kennis/ en artikelen op
 * /kennis/artikelnaam/. Los van de blog, zodat bestaande blog-URL's niet veranderen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Berichttype registreren.
 */
function veryo_register_kennis() {
	register_post_type(
		'kennis',
		array(
			'labels'        => array(
				'name'               => __( 'Kennis', 'veryo' ),
				'singular_name'      => __( 'Kennisartikel', 'veryo' ),
				'menu_name'          => __( 'Kennisbank', 'veryo' ),
				'add_new'            => __( 'Nieuw artikel', 'veryo' ),
				'add_new_item'       => __( 'Nieuw kennisartikel', 'veryo' ),
				'edit_item'          => __( 'Kennisartikel bewerken', 'veryo' ),
				'new_item'           => __( 'Nieuw kennisartikel', 'veryo' ),
				'view_item'          => __( 'Kennisartikel bekijken', 'veryo' ),
				'search_items'       => __( 'Kennisartikelen zoeken', 'veryo' ),
				'not_found'          => __( 'Nog geen kennisartikelen.', 'veryo' ),
				'not_found_in_trash' => __( 'Geen kennisartikelen in de prullenbak.', 'veryo' ),
				'all_items'          => __( 'Alle kennisartikelen', 'veryo' ),
			),
			'public'        => true,
			'has_archive'   => 'kennis',
			'rewrite'       => array(
				'slug'       => 'kennis',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-book-alt',
			'menu_position' => 6,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'custom-fields' ),
		)
	);
}
add_action( 'init', 'veryo_register_kennis' );

/**
 * Is dit (een onderdeel van) de kennisbank?
 *
 * @return bool
 */
function veryo_is_kennis() {
	return is_singular( 'kennis' ) || is_post_type_archive( 'kennis' );
}

/**
 * Dienstpagina's die je onder een kennisartikel kunt tonen (pad => naam).
 *
 * @return array<string,string>
 */
function veryo_kennis_service_choices() {
	return array(
		veryo_collega()['slug']                     => veryo_collega()['naam'],
		'ai-automatisering'                         => __( 'AI-automatisering', 'veryo' ),
		'ai-agents'                                 => __( 'AI-agents', 'veryo' ),
		'ai-implementatie-mkb'                      => __( 'AI implementeren in het mkb', 'veryo' ),
		'ai-training'                               => __( 'AI-training voor bedrijven', 'veryo' ),
		'ai-workshop'                               => __( 'AI-workshop', 'veryo' ),
		'ai-training/ai-geletterdheid'              => __( 'AI-geletterdheid training', 'veryo' ),
		'ai-training/chatgpt-training-verkopers'    => __( 'ChatGPT-training voor verkopers', 'veryo' ),
		'ai-startpakket'                            => __( 'AI-Startpakket', 'veryo' ),
		'ai-werkplek'                               => __( 'De AI-werkplek', 'veryo' ),
		'veilig-ai-gebruik'                         => __( 'Veilig AI-gebruik', 'veryo' ),
		'ai-automatisering/administratie'           => __( 'Administratie automatiseren', 'veryo' ),
		'ai-automatisering/offertes-en-calculaties' => __( 'Offertes automatiseren', 'veryo' ),
		'oplossingen/werkbonnen-verwerken'          => __( 'Werkbonnen verwerken', 'veryo' ),
		'oplossingen/inkoopfacturen-automatiseren'  => __( 'Inkoopfacturen automatiseren', 'veryo' ),
		'branches'                                  => __( 'AI per branche', 'veryo' ),
		'prijzen'                                   => __( 'Prijzen en offerte', 'veryo' ),
	);
}

/**
 * Metabox: gerelateerde dienstpagina's.
 */
function veryo_kennis_metabox() {
	add_meta_box( 'veryo_kennis_services', __( 'Gerelateerde diensten', 'veryo' ), 'veryo_kennis_metabox_render', 'kennis', 'side' );
}
add_action( 'add_meta_boxes', 'veryo_kennis_metabox' );

/**
 * Metabox tonen.
 *
 * @param WP_Post $post Artikel.
 */
function veryo_kennis_metabox_render( $post ) {
	$chosen = (array) get_post_meta( $post->ID, '_veryo_kennis_services', true );
	wp_nonce_field( 'veryo_kennis_services', 'veryo_kennis_nonce' );
	echo '<p>' . esc_html__( 'Deze pagina’s staan onder het artikel als "Hier helpen we bij". Kies er twee of drie.', 'veryo' ) . '</p>';
	foreach ( veryo_kennis_service_choices() as $path => $label ) {
		echo '<label style="display:block;margin:4px 0"><input type="checkbox" name="veryo_kennis_services[]" value="' . esc_attr( $path ) . '"' . checked( in_array( $path, $chosen, true ), true, false ) . '> ' . esc_html( $label ) . '</label>';
	}
}

/**
 * Metabox opslaan.
 *
 * @param int $post_id Artikel.
 */
function veryo_kennis_metabox_save( $post_id ) {
	if ( ! isset( $_POST['veryo_kennis_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['veryo_kennis_nonce'] ) ), 'veryo_kennis_services' ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$allowed = array_keys( veryo_kennis_service_choices() );
	$chosen  = isset( $_POST['veryo_kennis_services'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['veryo_kennis_services'] ) ) : array();
	update_post_meta( $post_id, '_veryo_kennis_services', array_values( array_intersect( $chosen, $allowed ) ) );
}
add_action( 'save_post_kennis', 'veryo_kennis_metabox_save' );

/**
 * Het archief staat op noindex, follow zolang er nog geen artikelen zijn.
 *
 * @return bool
 */
function veryo_kennis_archive_empty() {
	if ( ! is_post_type_archive( 'kennis' ) ) {
		return false;
	}
	$count = wp_count_posts( 'kennis' );
	return empty( $count->publish );
}

/**
 * Gerelateerde kennisartikelen: de nieuwste, zonder het huidige.
 *
 * @param int $post_id Artikel.
 * @param int $count   Aantal.
 * @return WP_Post[]
 */
function veryo_kennis_related( $post_id, $count = 3 ) {
	return get_posts(
		array(
			'post_type'      => 'kennis',
			'posts_per_page' => $count,
			'post__not_in'   => array( $post_id ),
			'no_found_rows'  => true,
		)
	);
}

/**
 * Link naar het kennisarchief.
 *
 * @return string
 */
function veryo_kennis_url() {
	$url = get_post_type_archive_link( 'kennis' );
	return $url ? $url : home_url( '/kennis/' );
}

/**
 * "Kennis" in de footer onder Veryo, zonder het menu opnieuw op te bouwen (eigen
 * menu-aanpassingen blijven staan).
 */
function veryo_add_kennis_menu_item() {
	$menu = wp_get_nav_menu_object( 'Veryo footer' );
	if ( ! $menu ) {
		return;
	}
	$items  = (array) wp_get_nav_menu_items( $menu->term_id );
	$parent = 0;
	foreach ( $items as $item ) {
		if ( untrailingslashit( (string) $item->url ) === untrailingslashit( veryo_kennis_url() ) ) {
			return;
		}
		if ( 'Veryo' === $item->title && ! $item->menu_item_parent ) {
			$parent = (int) $item->ID;
		}
	}
	wp_update_nav_menu_item(
		$menu->term_id,
		0,
		array(
			'menu-item-title'     => __( 'Kennis', 'veryo' ),
			'menu-item-type'      => 'custom',
			'menu-item-url'       => veryo_kennis_url(),
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent,
			'menu-item-position'  => 99,
		)
	);
}
