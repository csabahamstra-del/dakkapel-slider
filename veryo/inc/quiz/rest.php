<?php
/**
 * REST-endpoints: AI-scan, formulieren (contact, academy) en een verse nonce.
 * Alle invoer wordt gevalideerd en gesaniteerd; nonce, honeypot en rate limiting.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Routes registreren.
 */
function veryo_register_rest_routes() {
	register_rest_route(
		'veryo/v1',
		'/scan',
		array(
			'methods'             => 'POST',
			'callback'            => 'veryo_rest_scan',
			'permission_callback' => 'veryo_rest_check_nonce',
		)
	);
	register_rest_route(
		'veryo/v1',
		'/form',
		array(
			'methods'             => 'POST',
			'callback'            => 'veryo_rest_form',
			'permission_callback' => 'veryo_rest_check_nonce',
		)
	);
	register_rest_route(
		'veryo/v1',
		'/nonce',
		array(
			'methods'             => 'GET',
			'callback'            => 'veryo_rest_nonce',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'veryo_register_rest_routes' );

/**
 * Nonce controleren (ook voor bezoekers die niet zijn ingelogd).
 *
 * @param WP_REST_Request $request Verzoek.
 * @return true|WP_Error
 */
function veryo_rest_check_nonce( $request ) {
	$nonce = (string) $request->get_header( 'X-WP-Nonce' );
	if ( '' !== $nonce && wp_verify_nonce( $nonce, 'wp_rest' ) ) {
		return true;
	}
	return new WP_Error( 'veryo_invalid_nonce', __( 'De pagina is verlopen. Ververs de pagina en probeer het opnieuw.', 'veryo' ), array( 'status' => 403 ) );
}

/**
 * Verse nonce voor pagina's uit een cache.
 *
 * @return WP_REST_Response
 */
function veryo_rest_nonce() {
	$response = new WP_REST_Response( array( 'nonce' => wp_create_nonce( 'wp_rest' ) ) );
	$response->header( 'Cache-Control', 'no-store, private' );
	return $response;
}

/**
 * Foutantwoord met veldfouten.
 *
 * @param array<string,string> $errors Veld => melding.
 * @return WP_Error
 */
function veryo_rest_validation_error( $errors ) {
	return new WP_Error(
		'veryo_invalid',
		__( 'Niet alle velden zijn goed ingevuld.', 'veryo' ),
		array(
			'status' => 400,
			'errors' => $errors,
		)
	);
}

/**
 * Tekst inkorten tot een maximum aantal tekens.
 *
 * @param mixed $value Waarde.
 * @param int   $max   Maximum.
 * @param bool  $multi Meerdere regels toestaan.
 * @return string
 */
function veryo_clean_text( $value, $max, $multi = false ) {
	$value = is_scalar( $value ) ? (string) $value : '';
	$value = $multi ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
	return mb_substr( trim( $value ), 0, $max );
}

/**
 * Veilige sleutel uit willekeurige invoer.
 *
 * @param mixed $value Waarde.
 * @return string
 */
function veryo_key( $value ) {
	return is_scalar( $value ) ? sanitize_key( (string) $value ) : '';
}

/**
 * Telefoonnummer valideren (cijfers, spaties, +, -, haakjes).
 *
 * @param string $phone Nummer.
 * @return bool
 */
function veryo_valid_phone( $phone ) {
	return (bool) preg_match( '/^\+?[0-9\s\-()]{8,20}$/', $phone );
}

/**
 * Antwoorden van de AI-scan valideren en saniteren.
 *
 * @param array<string,mixed>  $p      Ruwe invoer.
 * @param array<string,string> $errors Veldfouten (uitvoer).
 * @return array<string,mixed>
 */
function veryo_scan_sanitize_answers( $p, &$errors ) {
	$branches = veryo_scan_branches();
	$teams    = veryo_scan_team_sizes();
	$tasks    = veryo_scan_tasks();
	$tools    = veryo_scan_tools();
	$usage    = veryo_scan_ai_usage();
	$timing   = veryo_scan_timing();

	$a = array();

	$a['branche'] = isset( $p['branche'] ) ? veryo_key( $p['branche'] ) : '';
	if ( ! isset( $branches[ $a['branche'] ] ) ) {
		$errors['branche'] = __( 'Kies een branche.', 'veryo' );
	}
	$a['branche_overig'] = 'overig' === $a['branche'] ? veryo_clean_text( isset( $p['branche_overig'] ) ? $p['branche_overig'] : '', 100 ) : '';

	$a['team'] = isset( $p['team'] ) && is_string( $p['team'] ) ? sanitize_text_field( $p['team'] ) : '';
	if ( ! isset( $teams[ $a['team'] ] ) ) {
		$errors['team'] = __( 'Kies een teamgrootte.', 'veryo' );
	}

	$a['taken'] = array();
	foreach ( (array) ( isset( $p['taken'] ) ? $p['taken'] : array() ) as $task ) {
		$task = veryo_key( $task );
		if ( isset( $tasks[ $task ] ) && ! in_array( $task, $a['taken'], true ) ) {
			$a['taken'][] = $task;
		}
	}
	if ( ! $a['taken'] ) {
		$errors['taken'] = __( 'Kies minstens één taak.', 'veryo' );
	}

	$a['uren'] = array();
	$raw_hours = isset( $p['uren'] ) && is_array( $p['uren'] ) ? $p['uren'] : array();
	foreach ( $a['taken'] as $task ) {
		$a['uren'][ $task ] = isset( $raw_hours[ $task ] ) ? max( 0, min( 40, is_scalar( $raw_hours[ $task ] ) ? (int) $raw_hours[ $task ] : 0 ) ) : 0;
	}

	$a['tools'] = array();
	foreach ( (array) ( isset( $p['tools'] ) ? $p['tools'] : array() ) as $tool ) {
		$tool = veryo_key( $tool );
		if ( isset( $tools[ $tool ] ) && ! in_array( $tool, $a['tools'], true ) ) {
			$a['tools'][] = $tool;
		}
	}
	if ( in_array( 'geen', $a['tools'], true ) ) {
		$a['tools'] = array( 'geen' );
	}

	$a['ai_gebruik'] = isset( $p['ai_gebruik'] ) ? veryo_key( $p['ai_gebruik'] ) : '';
	if ( ! isset( $usage[ $a['ai_gebruik'] ] ) ) {
		$errors['ai_gebruik'] = __( 'Kies een antwoord.', 'veryo' );
	}

	$a['frustratie'] = veryo_clean_text( isset( $p['frustratie'] ) ? $p['frustratie'] : '', 500, true );

	$a['timing'] = isset( $p['timing'] ) ? veryo_key( $p['timing'] ) : '';
	if ( ! isset( $timing[ $a['timing'] ] ) ) {
		$errors['timing'] = __( 'Kies wanneer je iets wilt doen.', 'veryo' );
	}
	return $a;
}

/**
 * AI-scan verwerken.
 *
 * @param WP_REST_Request $request Verzoek.
 * @return WP_REST_Response|WP_Error
 */
function veryo_rest_scan( $request ) {
	$p = $request->get_json_params();
	$p = is_array( $p ) ? $p : array();

	// Honeypot: bots krijgen een neutraal antwoord en er wordt niets opgeslagen.
	if ( ! empty( $p['website'] ) ) {
		return new WP_REST_Response( array( 'ok' => true ), 200 );
	}

	$errors  = array();
	$answers = veryo_scan_sanitize_answers( $p, $errors );

	$contact = array(
		'voornaam' => veryo_clean_text( isset( $p['voornaam'] ) ? $p['voornaam'] : '', 60 ),
		'bedrijf'  => veryo_clean_text( isset( $p['bedrijf'] ) ? $p['bedrijf'] : '', 120 ),
		'email'    => sanitize_email( isset( $p['email'] ) && is_string( $p['email'] ) ? $p['email'] : '' ),
		'telefoon' => veryo_clean_text( isset( $p['telefoon'] ) ? $p['telefoon'] : '', 20 ),
	);
	if ( '' === $contact['voornaam'] ) {
		$errors['voornaam'] = __( 'Vul je voornaam in.', 'veryo' );
	}
	if ( '' === $contact['bedrijf'] ) {
		$errors['bedrijf'] = __( 'Vul je bedrijfsnaam in.', 'veryo' );
	}
	if ( ! is_email( $contact['email'] ) ) {
		$errors['email'] = __( 'Vul een geldig e-mailadres in.', 'veryo' );
	}
	if ( '' !== $contact['telefoon'] && ! veryo_valid_phone( $contact['telefoon'] ) ) {
		$errors['telefoon'] = __( 'Dit telefoonnummer lijkt niet te kloppen.', 'veryo' );
	}
	if ( empty( $p['toestemming'] ) || true !== filter_var( $p['toestemming'], FILTER_VALIDATE_BOOLEAN ) ) {
		$errors['toestemming'] = __( 'Geef toestemming om je rapport te kunnen maken.', 'veryo' );
	}
	if ( $errors ) {
		return veryo_rest_validation_error( $errors );
	}

	if ( veryo_rate_limited( 'scan', 5 ) ) {
		return new WP_Error( 'veryo_rate_limited', __( 'Je hebt de scan het afgelopen uur al een paar keer ingevuld. Probeer het later opnieuw, of neem contact met ons op.', 'veryo' ), array( 'status' => 429 ) );
	}

	$calc    = veryo_scan_calculate( $answers );
	$lead_id = veryo_lead_create( 'ai-scan', $contact, $answers, $calc );
	if ( is_wp_error( $lead_id ) ) {
		return new WP_Error( 'veryo_save_failed', __( 'Er ging iets mis bij het opslaan. Probeer het later opnieuw.', 'veryo' ), array( 'status' => 500 ) );
	}

	// Interne melding direct, zodat een lead ook bij een trage WP-Cron binnenkomt.
	if ( ! veryo_mail_internal_scan( $lead_id ) ) {
		veryo_lead_log( $lead_id, 'Interne melding kon niet worden verstuurd.' );
	}

	// Rapport asynchroon maken, zodat de bezoeker niet op de API wacht.
	wp_schedule_single_event( time(), 'veryo_generate_report', array( $lead_id ) );
	if ( ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) ) {
		spawn_cron();
	}

	$calendly = (string) veryo_setting( 'calendly_url', '' );
	return new WP_REST_Response(
		array(
			'ok'       => true,
			'uren'     => (int) $calc['besparing_uren_per_week'],
			'euro'     => veryo_euro( $calc['besparing_euro_per_jaar'] ),
			'score'    => (int) $calc['kansenscore'],
			'aannames' => veryo_scan_assumptions_text( $calc ),
			'calendly' => $calendly ? esc_url_raw( $calendly ) : '',
		),
		200
	);
}

/**
 * Contactformulier en wachtlijst verwerken.
 *
 * @param WP_REST_Request $request Verzoek.
 * @return WP_REST_Response|WP_Error
 */
function veryo_rest_form( $request ) {
	$p = $request->get_json_params();
	$p = is_array( $p ) ? $p : array();

	if ( ! empty( $p['website'] ) ) {
		return new WP_REST_Response( array( 'ok' => true ), 200 );
	}

	$type = isset( $p['type'] ) ? veryo_key( $p['type'] ) : '';
	if ( ! in_array( $type, array( 'contact', 'academy' ), true ) ) {
		return new WP_Error( 'veryo_invalid_type', __( 'Onbekend formulier.', 'veryo' ), array( 'status' => 400 ) );
	}

	$errors  = array();
	$contact = array(
		'naam'  => veryo_clean_text( isset( $p['naam'] ) ? $p['naam'] : '', 80 ),
		'email' => sanitize_email( isset( $p['email'] ) && is_string( $p['email'] ) ? $p['email'] : '' ),
	);
	if ( '' === $contact['naam'] ) {
		$errors['naam'] = __( 'Vul je naam in.', 'veryo' );
	}
	if ( ! is_email( $contact['email'] ) ) {
		$errors['email'] = __( 'Vul een geldig e-mailadres in.', 'veryo' );
	}
	if ( 'contact' === $type ) {
		$contact['bedrijf']  = veryo_clean_text( isset( $p['bedrijf'] ) ? $p['bedrijf'] : '', 120 );
		$contact['telefoon'] = veryo_clean_text( isset( $p['telefoon'] ) ? $p['telefoon'] : '', 20 );
		$contact['bericht']  = veryo_clean_text( isset( $p['bericht'] ) ? $p['bericht'] : '', 2000, true );
		if ( '' !== $contact['telefoon'] && ! veryo_valid_phone( $contact['telefoon'] ) ) {
			$errors['telefoon'] = __( 'Dit telefoonnummer lijkt niet te kloppen.', 'veryo' );
		}
		if ( '' === $contact['bericht'] ) {
			$errors['bericht'] = __( 'Schrijf een kort bericht.', 'veryo' );
		}
	}
	if ( empty( $p['toestemming'] ) || true !== filter_var( $p['toestemming'], FILTER_VALIDATE_BOOLEAN ) ) {
		$errors['toestemming'] = __( 'Geef toestemming om je gegevens te gebruiken.', 'veryo' );
	}
	if ( $errors ) {
		return veryo_rest_validation_error( $errors );
	}
	if ( veryo_rate_limited( 'form', 5 ) ) {
		return new WP_Error( 'veryo_rate_limited', __( 'Je hebt het afgelopen uur al een paar berichten gestuurd. Probeer het later opnieuw.', 'veryo' ), array( 'status' => 429 ) );
	}

	$lead_id = veryo_lead_create( $type, $contact );
	if ( is_wp_error( $lead_id ) ) {
		return new WP_Error( 'veryo_save_failed', __( 'Er ging iets mis bij het opslaan. Probeer het later opnieuw.', 'veryo' ), array( 'status' => 500 ) );
	}
	if ( ! veryo_mail_internal_form( $lead_id ) ) {
		veryo_lead_log( $lead_id, 'Interne melding kon niet worden verstuurd.' );
	}
	veryo_send_webhook_async( $lead_id );

	return new WP_REST_Response(
		array(
			'ok'      => true,
			'message' => 'academy' === $type
				? __( 'Je staat op de wachtlijst. We sturen je één bericht zodra de cursus beschikbaar is.', 'veryo' )
				: __( 'Dank je, je bericht is verstuurd. We reageren binnen één werkdag.', 'veryo' ),
		),
		200
	);
}
