<?php
/**
 * Cases: echte klantcases, alleen met toestemming van de klant. Eigen berichttype "Cases" in
 * wp-admin met velden voor branche, probleem, aanpak, implementatie, resultaat, tijdwinst en een
 * quote. Op de homepage staat [veryo_cases]: zolang er geen gepubliceerde case is, toont dat niets.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Berichttype registreren (alleen in wp-admin; geen eigen archief of losse pagina's).
 */
function veryo_register_cases() {
	register_post_type(
		'veryo_case',
		array(
			'labels'          => array(
				'name'          => __( 'Cases', 'veryo' ),
				'singular_name' => __( 'Case', 'veryo' ),
				'add_new_item'  => __( 'Nieuwe case', 'veryo' ),
				'edit_item'     => __( 'Case bewerken', 'veryo' ),
				'not_found'     => __( 'Nog geen cases.', 'veryo' ),
				'all_items'     => __( 'Alle cases', 'veryo' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_rest'    => false,
			'menu_icon'       => 'dashicons-awards',
			'menu_position'   => 7,
			'supports'        => array( 'title', 'thumbnail' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'veryo_register_cases' );

/**
 * Velden van een case.
 *
 * @return array<string,string>
 */
function veryo_case_fields() {
	return array(
		'branche'        => __( 'Branche', 'veryo' ),
		'probleem'       => __( 'Probleem', 'veryo' ),
		'aanpak'         => __( 'Aanpak', 'veryo' ),
		'implementatie'  => __( 'Implementatie', 'veryo' ),
		'resultaat'      => __( 'Resultaat (alleen gemeten, controleerbaar)', 'veryo' ),
		'tijdwinst'      => __( 'Tijdwinst (alleen als gemeten)', 'veryo' ),
		'quote'          => __( 'Quote (met toestemming)', 'veryo' ),
		'quote_naam'     => __( 'Naam en functie bij de quote', 'veryo' ),
		'toestemming_ok' => __( 'De klant heeft schriftelijk toestemming gegeven voor publicatie', 'veryo' ),
	);
}

/**
 * Metabox.
 */
function veryo_case_metabox() {
	add_meta_box( 'veryo_case_fields', __( 'Gegevens van de case', 'veryo' ), 'veryo_case_metabox_render', 'veryo_case', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'veryo_case_metabox' );

/**
 * Metabox tonen.
 *
 * @param WP_Post $post Case.
 */
function veryo_case_metabox_render( $post ) {
	wp_nonce_field( 'veryo_case_fields', 'veryo_case_nonce' );
	echo '<p>' . esc_html__( 'De titel is de bedrijfsnaam. De uitgelichte afbeelding is de foto of visual. Een case verschijnt pas op de site als hij is gepubliceerd én het vinkje voor toestemming aan staat.', 'veryo' ) . '</p>';
	foreach ( veryo_case_fields() as $key => $label ) {
		$value = (string) get_post_meta( $post->ID, '_veryo_case_' . $key, true );
		if ( 'toestemming_ok' === $key ) {
			echo '<p><label><input type="checkbox" name="veryo_case[' . esc_attr( $key ) . ']" value="1"' . checked( '1', $value, false ) . '> ' . esc_html( $label ) . '</label></p>';
			continue;
		}
		$multi = in_array( $key, array( 'probleem', 'aanpak', 'implementatie', 'resultaat', 'quote' ), true );
		echo '<p><label for="veryo-case-' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label><br>';
		if ( $multi ) {
			echo '<textarea id="veryo-case-' . esc_attr( $key ) . '" name="veryo_case[' . esc_attr( $key ) . ']" rows="3" class="large-text">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input type="text" id="veryo-case-' . esc_attr( $key ) . '" name="veryo_case[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '" class="regular-text">';
		}
		echo '</p>';
	}
}

/**
 * Metabox opslaan.
 *
 * @param int $post_id Case.
 */
function veryo_case_metabox_save( $post_id ) {
	if ( ! isset( $_POST['veryo_case_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['veryo_case_nonce'] ) ), 'veryo_case_fields' ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$input = isset( $_POST['veryo_case'] ) ? (array) wp_unslash( $_POST['veryo_case'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- per veld hieronder.
	foreach ( array_keys( veryo_case_fields() ) as $key ) {
		$value = isset( $input[ $key ] ) ? sanitize_textarea_field( (string) $input[ $key ] ) : '';
		update_post_meta( $post_id, '_veryo_case_' . $key, $value );
	}
}
add_action( 'save_post_veryo_case', 'veryo_case_metabox_save' );

/**
 * Gepubliceerde cases met toestemming.
 *
 * @return WP_Post[]
 */
function veryo_published_cases() {
	return get_posts(
		array(
			'post_type'      => 'veryo_case',
			'post_status'    => 'publish',
			'posts_per_page' => 6,
			'meta_key'       => '_veryo_case_toestemming_ok', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- kleine set.
			'meta_value'     => '1', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- kleine set.
		)
	);
}

/**
 * Shortcode [veryo_cases]: niets zolang er geen echte, goedgekeurde case is.
 *
 * @return string
 */
function veryo_sc_cases() {
	$cases = veryo_published_cases();
	if ( ! $cases ) {
		return '';
	}
	$cards = '';
	foreach ( $cases as $case ) {
		$m    = static function ( $key ) use ( $case ) {
			return (string) get_post_meta( $case->ID, '_veryo_case_' . $key, true );
		};
		$rows = '';
		foreach ( array(
			'probleem'      => __( 'Probleem', 'veryo' ),
			'aanpak'        => __( 'Aanpak', 'veryo' ),
			'implementatie' => __( 'Implementatie', 'veryo' ),
			'resultaat'     => __( 'Resultaat', 'veryo' ),
			'tijdwinst'     => __( 'Tijdwinst', 'veryo' ),
		) as $key => $label ) {
			if ( '' !== $m( $key ) ) {
				$rows .= '<dt>' . esc_html( $label ) . '</dt><dd>' . esc_html( $m( $key ) ) . '</dd>';
			}
		}
		$quote  = '' !== $m( 'quote' ) ? '<blockquote class="veryo-case__quote"><p>“' . esc_html( $m( 'quote' ) ) . '”</p>' . ( '' !== $m( 'quote_naam' ) ? '<cite>' . esc_html( $m( 'quote_naam' ) ) . '</cite>' : '' ) . '</blockquote>' : '';
		$image  = has_post_thumbnail( $case ) ? get_the_post_thumbnail( $case, 'medium_large', array( 'class' => 'veryo-case__img' ) ) : '';
		$cards .= '<article class="veryo-case">' . $image
			. '<p class="veryo-case__branch">' . esc_html( $m( 'branche' ) ) . '</p>'
			. '<h3 class="veryo-case__title">' . esc_html( get_the_title( $case ) ) . '</h3>'
			. ( $rows ? '<dl class="veryo-case__facts">' . $rows . '</dl>' : '' )
			. $quote . '</article>';
	}
	return '<section class="veryo-section veryo-cases-real alignwide" aria-labelledby="veryo-cases-title"><h2 id="veryo-cases-title">' . esc_html__( 'AI in de praktijk', 'veryo' ) . '</h2><div class="veryo-cases-real__grid">' . $cards . '</div></section>';
}
add_shortcode( 'veryo_cases', 'veryo_sc_cases' );
