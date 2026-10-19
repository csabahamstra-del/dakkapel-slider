<?php
/**
 * Webhook na de AI-scan: de inzending met berekeningen als JSON naar Make.
 *
 * Wordt server-side verstuurd, ná de rapportmail (vanuit de achtergrondtaak die het rapport
 * maakt), met een timeout van 5 seconden. Het rapport en de bevestiging voor de bezoeker
 * wachten dus nooit op de webhook. Mislukt de webhook, dan wordt dat gelogd bij de lead en
 * gaat de inzending als back-up per mail naar info@veryo.nl.
 *
 * URL: Instellingen > Veryo > Webhook AI-scan, of anders de constante VERYO_SCAN_WEBHOOK_URL
 * (eventueel in wp-config.php te overschrijven).
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'VERYO_SCAN_WEBHOOK_URL' ) ) {
	define( 'VERYO_SCAN_WEBHOOK_URL', 'https://hook.eu2.make.com/1f8seo3p7ifiuezpvd5i1rfpdeovfucm' );
}

/**
 * De URL van de scan-webhook.
 *
 * @return string
 */
function veryo_scan_webhook_url() {
	$own = (string) veryo_setting( 'scan_webhook', '' );
	return '' !== $own ? $own : (string) VERYO_SCAN_WEBHOOK_URL;
}

/**
 * Het passende AI-Startpakket (naam en prijs) bij een teamgrootte uit de scan.
 *
 * @param string $team Teamgrootte-sleutel.
 * @return array{label:string,price:int} Prijs 0 = op maat.
 */
function veryo_scan_webhook_package( $team ) {
	$prices = veryo_startpakket_prices();
	$tier   = '';
	if ( in_array( $team, array( '1', '2-10', '2-5' ), true ) ) {
		$tier = 'tot-10';
	} elseif ( '11-25' === $team ) {
		$tier = '11-25';
	} elseif ( '26-50' === $team ) {
		$tier = '26-50';
	}
	if ( '' === $tier ) {
		return array(
			'label' => __( 'AI-Startpakket op maat', 'veryo' ),
			'price' => 0,
		);
	}
	return array(
		'label' => __( 'AI-Startpakket', 'veryo' ) . ' ' . veryo_euro( $prices[ $tier ]['price'] ),
		'price' => (int) $prices[ $tier ]['price'],
	);
}

/**
 * Segment voor de opvolging: Heet, Warm of Koud.
 *
 * Heet: team van 6 of meer, minstens 5 uur per week en timing Nu of Binnen 3 maanden.
 * Koud: team van 1, of timing Ik oriënteer me. Anders Warm.
 * Team "2-10" telt niet als 6 of meer, omdat dat bij die keuze niet vaststaat.
 *
 * @param string $team   Teamgrootte-sleutel.
 * @param int    $hours  Uren per week (ingevuld).
 * @param string $timing Timing-sleutel.
 * @return string
 */
function veryo_scan_webhook_segment( $team, $hours, $timing ) {
	$six_plus = in_array( $team, array( '11-25', '26-50', '50+', '6-20', '21-50' ), true );
	if ( $six_plus && $hours >= 5 && in_array( $timing, array( 'nu', '3-maanden' ), true ) ) {
		return 'Heet';
	}
	if ( '1' === $team || 'orienteren' === $timing ) {
		return 'Koud';
	}
	return 'Warm';
}

/**
 * De JSON-gegevens voor de webhook, met precies de afgesproken velden.
 *
 * @param int $lead_id Lead.
 * @return array<string,mixed>
 */
function veryo_scan_webhook_payload( $lead_id ) {
	$lead    = veryo_lead_get( $lead_id );
	$a       = $lead['answers'];
	$c       = $lead['contact'];
	$calc    = $lead['calc'];
	$labels  = static function ( $keys, $options ) {
		$out = array();
		foreach ( (array) $keys as $key ) {
			$out[] = isset( $options[ $key ] ) ? $options[ $key ] : (string) $key;
		}
		return $out;
	};
	$one     = static function ( $key, $options ) {
		return isset( $options[ $key ] ) ? $options[ $key ] : (string) $key;
	};
	$team    = isset( $a['team'] ) ? (string) $a['team'] : '';
	$timing  = isset( $a['timing'] ) ? (string) $a['timing'] : '';
	$hours   = (int) array_sum( array_map( 'intval', isset( $a['uren'] ) ? (array) $a['uren'] : array() ) );
	$package = veryo_scan_webhook_package( $team );
	$report  = get_post_meta( $lead_id, '_veryo_report', true );
	$top     = is_array( $report ) && ! empty( $report['aanbevelingen'][0]['titel'] ) ? (string) $report['aanbevelingen'][0]['titel'] : '';
	$source  = (string) get_post_meta( $lead_id, '_veryo_utm_source', true );

	return array(
		'voornaam'                => isset( $c['voornaam'] ) ? (string) $c['voornaam'] : '',
		'bedrijfsnaam'            => isset( $c['bedrijf'] ) ? (string) $c['bedrijf'] : '',
		'email'                   => isset( $c['email'] ) ? (string) $c['email'] : '',
		'telefoon'                => isset( $c['telefoon'] ) ? (string) $c['telefoon'] : '',
		'branche'                 => $one( isset( $a['branche'] ) ? $a['branche'] : '', veryo_scan_branches() ),
		'teamgrootte'             => $one( $team, veryo_scan_team_sizes() ),
		'tijdvreters'             => $labels( isset( $a['taken'] ) ? $a['taken'] : array(), veryo_scan_tasks() ),
		'uren_per_week'           => $hours,
		'tools'                   => $labels( isset( $a['tools'] ) ? $a['tools'] : array(), veryo_scan_tools() ),
		'ai_gebruik'              => $one( isset( $a['ai_gebruik'] ) ? $a['ai_gebruik'] : '', veryo_scan_ai_usage() ),
		'frustratie'              => isset( $a['frustratie'] ) ? (string) $a['frustratie'] : '',
		'timing'                  => $one( $timing, veryo_scan_timing() ),
		'tijdwinst_uren_per_week' => isset( $calc['besparing_uren_per_week'] ) ? (int) $calc['besparing_uren_per_week'] : 0,
		'kansenscore'             => isset( $calc['kansenscore'] ) ? (int) $calc['kansenscore'] : 0,
		'top_tijdwinst'           => $top,
		'urenlek_per_jaar'        => (int) round( $hours * 46 * 45 ),
		'pakket'                  => $package['label'],
		'terugverdientijd_weken'  => ( $package['price'] > 0 && $hours > 0 ) ? (int) ceil( $package['price'] / ( 0.5 * $hours * 45 ) ) : null,
		'segment'                 => veryo_scan_webhook_segment( $team, $hours, $timing ),
		'deur'                    => 'AI-deur',
		'bron'                    => '' !== $source ? $source : 'Direct',
	);
}

/**
 * Webhook versturen (eenmalig per lead). Fouten worden gelogd; bij een mislukte webhook gaat
 * de inzending als back-up per mail naar info@veryo.nl.
 *
 * @param int $lead_id Lead.
 * @return bool Gelukt.
 */
function veryo_send_scan_webhook( $lead_id ) {
	$url = veryo_scan_webhook_url();
	if ( '' === $url || 'ai-scan' !== get_post_meta( $lead_id, '_veryo_source', true ) ) {
		return false;
	}
	update_post_meta( $lead_id, '_veryo_scan_webhook_done', gmdate( 'c' ) );
	$payload  = veryo_scan_webhook_payload( $lead_id );
	$response = wp_safe_remote_post(
		$url,
		array(
			'timeout' => 5,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode( $payload ),
		)
	);
	$error    = '';
	if ( is_wp_error( $response ) ) {
		$error = $response->get_error_message();
	} else {
		$code = (int) wp_remote_retrieve_response_code( $response );
		if ( $code < 200 || $code >= 300 ) {
			$error = 'HTTP-status ' . $code;
		}
	}
	if ( '' === $error ) {
		veryo_lead_log( $lead_id, 'Scan-webhook (Make) verstuurd.' );
		return true;
	}
	veryo_lead_log( $lead_id, 'Scan-webhook (Make) mislukt: ' . rtrim( $error, '.' ) . '.' );
	veryo_lead_log( $lead_id, veryo_mail_scan_webhook_backup( $lead_id, $payload, $error ) ? 'Back-up van de inzending gemaild naar info@veryo.nl.' : 'Back-upmail naar info@veryo.nl kon niet worden verstuurd.' );
	return false;
}

/**
 * Back-upmail met de inzending, als de webhook mislukt.
 *
 * @param int                 $lead_id Lead.
 * @param array<string,mixed> $payload Gegevens.
 * @param string              $error   Foutmelding.
 * @return bool
 */
function veryo_mail_scan_webhook_backup( $lead_id, $payload, $error ) {
	/* translators: %s: bedrijfsnaam. */
	$subject = sprintf( __( '[AI-scan] Webhook mislukt, back-up van de inzending: %s', 'veryo' ), $payload['bedrijfsnaam'] );
	$html    = '<tr><td style="padding:24px 32px"><p style="margin:0 0 16px">' . esc_html(
		sprintf(
			/* translators: %s: foutmelding. */
			__( 'De webhook naar Make is mislukt (%s). Hieronder staat de inzending, zodat je hem met de hand kunt verwerken.', 'veryo' ),
			$error
		)
	) . '</p><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">';
	$text = '';
	foreach ( $payload as $key => $value ) {
		$value = is_array( $value ) ? implode( ', ', $value ) : ( null === $value ? '' : (string) $value );
		$html .= '<tr><td style="padding:4px 12px 4px 0;vertical-align:top;color:#55635F;width:35%">' . esc_html( $key ) . '</td><td style="padding:4px 0">' . nl2br( esc_html( $value ) ) . '</td></tr>';
		$text .= $key . ': ' . $value . "\n";
	}
	$admin = admin_url( 'post.php?post=' . $lead_id . '&action=edit' );
	$html .= '</table><p style="margin:16px 0 0"><a href="' . esc_url( $admin ) . '" style="color:#1D4B44;font-weight:600">' . esc_html__( 'Open de lead in WordPress', 'veryo' ) . '</a></p>';
	$html .= '<p style="margin:16px 0 0;font-family:monospace;font-size:12px;color:#55635F">' . esc_html( (string) wp_json_encode( $payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ) . '</p></td></tr>';
	$text .= "\n" . $admin . "\n";
	return veryo_send_mail( 'info@veryo.nl', $subject, veryo_mail_layout( $subject, $html ), $text, $payload['email'] );
}
