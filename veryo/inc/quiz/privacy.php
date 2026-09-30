<?php
/**
 * AVG: exporters en erasers voor de WordPress-privacytools (op e-mailadres),
 * plus een suggestie voor de privacyverklaring.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Leads bij een e-mailadres.
 *
 * @param string $email E-mail.
 * @param int    $page  Pagina.
 * @return int[]
 */
function veryo_leads_by_email( $email, $page = 1 ) {
	return get_posts(
		array(
			'post_type'      => 'veryo_lead',
			'post_status'    => 'any',
			'posts_per_page' => 50,
			'paged'          => max( 1, (int) $page ),
			'fields'         => 'ids',
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- alleen bij privacyverzoeken.
				array(
					'key'   => '_veryo_email',
					'value' => strtolower( $email ),
				),
			),
		)
	);
}

/**
 * Exporter registreren.
 *
 * @param array<string,array<string,mixed>> $exporters Exporters.
 * @return array<string,array<string,mixed>>
 */
function veryo_register_exporter( $exporters ) {
	$exporters['veryo-leads'] = array(
		'exporter_friendly_name' => __( 'Veryo: AI-scan en formulieren', 'veryo' ),
		'callback'               => 'veryo_privacy_exporter',
	);
	return $exporters;
}
add_filter( 'wp_privacy_personal_data_exporters', 'veryo_register_exporter' );

/**
 * Gegevens exporteren.
 *
 * @param string $email E-mail.
 * @param int    $page  Pagina.
 * @return array<string,mixed>
 */
function veryo_privacy_exporter( $email, $page = 1 ) {
	$items = array();
	$ids   = veryo_leads_by_email( $email, $page );
	foreach ( $ids as $id ) {
		$lead = veryo_lead_get( $id );
		$data = array(
			array(
				'name'  => __( 'Datum', 'veryo' ),
				'value' => $lead['date'],
			),
			array(
				'name'  => __( 'Bron', 'veryo' ),
				'value' => $lead['source'],
			),
			array(
				'name'  => __( 'Toestemming gegeven op', 'veryo' ),
				'value' => $lead['consent_at'],
			),
		);
		foreach ( $lead['contact'] as $key => $value ) {
			$data[] = array(
				'name'  => ucfirst( $key ),
				'value' => (string) $value,
			);
		}
		foreach ( veryo_answers_readable( $lead['answers'] ) as $label => $value ) {
			$data[] = array(
				'name'  => $label,
				'value' => $value,
			);
		}
		if ( $lead['calc'] ) {
			$data[] = array(
				'name'  => __( 'Geschatte tijdwinst (u/wk)', 'veryo' ),
				'value' => (string) $lead['calc']['besparing_uren_per_week'],
			);
		}
		if ( ! empty( $lead['report']['samenvatting'] ) ) {
			$data[] = array(
				'name'  => __( 'Rapport: samenvatting', 'veryo' ),
				'value' => $lead['report']['samenvatting'],
			);
		}
		$items[] = array(
			'group_id'    => 'veryo-leads',
			'group_label' => __( 'Veryo: AI-scan en formulieren', 'veryo' ),
			'item_id'     => 'veryo-lead-' . $id,
			'data'        => $data,
		);
	}
	return array(
		'data' => $items,
		'done' => count( $ids ) < 50,
	);
}

/**
 * Eraser registreren.
 *
 * @param array<string,array<string,mixed>> $erasers Erasers.
 * @return array<string,array<string,mixed>>
 */
function veryo_register_eraser( $erasers ) {
	$erasers['veryo-leads'] = array(
		'eraser_friendly_name' => __( 'Veryo: AI-scan en formulieren', 'veryo' ),
		'callback'             => 'veryo_privacy_eraser',
	);
	return $erasers;
}
add_filter( 'wp_privacy_personal_data_erasers', 'veryo_register_eraser' );

/**
 * Gegevens wissen: de hele lead wordt verwijderd.
 *
 * @param string $email E-mail.
 * @param int    $page  Pagina.
 * @return array<string,mixed>
 */
function veryo_privacy_eraser( $email, $page = 1 ) {
	unset( $page ); // Na verwijderen schuift de lijst op; altijd de eerste pagina nemen.
	$ids     = veryo_leads_by_email( $email, 1 );
	$removed = false;
	foreach ( $ids as $id ) {
		if ( wp_delete_post( $id, true ) ) {
			$removed = true;
		}
	}
	return array(
		'items_removed'  => $removed,
		'items_retained' => false,
		'messages'       => array(),
		'done'           => count( $ids ) < 50,
	);
}

/**
 * Tekst voor de privacyhandleiding van WordPress.
 */
function veryo_privacy_policy_content() {
	if ( ! function_exists( 'wp_add_privacy_policy_content' ) ) {
		return;
	}
	wp_add_privacy_policy_content(
		'Veryo',
		wp_kses_post( wpautop( __( 'De AI-scan slaat antwoorden, voornaam, bedrijfsnaam, e-mailadres, optioneel telefoonnummer, het toestemmingstijdstip en een gehasht IP-adres op als lead. Voor het rapport gaan alleen de antwoorden (zonder naam, bedrijfsnaam, e-mail en telefoon) naar de AI-dienst van Anthropic. Leads worden na de ingestelde bewaartermijn automatisch verwijderd. De scan gebruikt geen cookies, alleen sessionStorage voor antwoorden tijdens het invullen.', 'veryo' ) ) )
	);
}
add_action( 'admin_init', 'veryo_privacy_policy_content' );
