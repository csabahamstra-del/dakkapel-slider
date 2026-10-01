<?php
/**
 * Shortcodes: [veryo_ai_scan], [veryo_form], [veryo_rapport], [veryo_report_preview],
 * [veryo_contact_details], [veryo_calendly_button], [veryo_bewaartermijn].
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'veryo_ai_scan', 'veryo_sc_ai_scan' );
add_shortcode( 'veryo_form', 'veryo_sc_form' );
add_shortcode( 'veryo_rapport', 'veryo_sc_rapport' );
add_shortcode( 'veryo_report_preview', 'veryo_sc_report_preview' );
add_shortcode( 'veryo_contact_details', 'veryo_sc_contact_details' );
add_shortcode( 'veryo_calendly_button', 'veryo_sc_calendly_button' );
add_shortcode( 'veryo_bewaartermijn', 'veryo_sc_retention' );
add_shortcode( 'veryo_kennismaking', 'veryo_sc_kennismaking' );
add_shortcode( 'veryo_portret', 'veryo_sc_portret' );
add_shortcode( 'veryo_klantlogos', 'veryo_sc_klantlogos' );

/**
 * Script-configuratie één keer meegeven.
 *
 * @param string $handle Script.
 */
function veryo_enqueue_with_config( $handle ) {
	static $done = array();
	wp_enqueue_script( $handle );
	if ( empty( $done[ $handle ] ) ) {
		wp_localize_script( $handle, 'veryoConfig', veryo_script_config() );
		$done[ $handle ] = true;
	}
}

/**
 * Keuzeknoppen (radio of checkbox) als groep.
 *
 * @param string               $type    radio|checkbox.
 * @param string               $name    Veldnaam.
 * @param array<string,string> $options Opties.
 * @return string
 */
function veryo_scan_options( $type, $name, $options ) {
	$out = '<div class="scan-options">';
	foreach ( $options as $value => $label ) {
		$out .= sprintf(
			'<label class="scan-option"><input type="%1$s" name="%2$s" value="%3$s"><span>%4$s</span></label>',
			esc_attr( $type ),
			esc_attr( $name ),
			esc_attr( $value ),
			esc_html( $label )
		);
	}
	return $out . '</div>';
}

/**
 * Eén stap van de scan.
 *
 * @param int    $n        Stapnummer.
 * @param string $key      Veldsleutel (voor foutmelding).
 * @param string $question Vraag.
 * @param string $inner    Velden.
 * @param string $hint     Toelichting.
 * @return string
 */
function veryo_scan_step( $n, $key, $question, $inner, $hint = '' ) {
	$hint_id = 'scan-hint-' . $key;
	$err_id  = 'scan-err-' . $key;
	$out     = '<fieldset class="scan-step" data-step="' . (int) $n . '" data-key="' . esc_attr( $key ) . '" aria-describedby="' . esc_attr( ( $hint ? $hint_id . ' ' : '' ) . $err_id ) . '">';
	$out    .= '<legend class="scan-q" tabindex="-1">' . esc_html( $question ) . '</legend>';
	if ( $hint ) {
		$out .= '<p class="scan-hint" id="' . esc_attr( $hint_id ) . '">' . esc_html( $hint ) . '</p>';
	}
	$out .= $inner;
	$out .= '<p class="scan-error" id="' . esc_attr( $err_id ) . '" role="alert" hidden></p>';
	return $out . '</fieldset>';
}

/**
 * De AI-scan (quiz).
 *
 * @return string
 */
function veryo_sc_ai_scan() {
	veryo_enqueue_with_config( 'veryo-scan' );

	$branches = veryo_scan_branches();
	$tasks    = veryo_scan_tasks();

	$sliders = '<div class="scan-sliders">';
	foreach ( $tasks as $key => $label ) {
		$id       = 'scan-uren-' . $key;
		$sliders .= '<div class="scan-slider" data-task="' . esc_attr( $key ) . '" hidden>'
			. '<label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>'
			. '<div class="scan-slider__row"><input type="range" min="0" max="40" step="1" value="4" id="' . esc_attr( $id ) . '" name="uren[' . esc_attr( $key ) . ']" aria-describedby="scan-hint-uren">'
			. '<output for="' . esc_attr( $id ) . '" class="scan-slider__value">4 ' . esc_html__( 'uur', 'veryo' ) . '</output></div></div>';
	}
	$sliders .= '</div>';

	$privacy = '<a href="' . esc_url( veryo_url( 'privacyverklaring' ) ) . '" target="_blank" rel="noopener">' . esc_html__( 'privacyverklaring', 'veryo' ) . '</a>';

	$contact  = '<div class="scan-fields">';
	$contact .= veryo_field(
		'text',
		'voornaam',
		__( 'Voornaam', 'veryo' ),
		true,
		array(
			'autocomplete' => 'given-name',
			'maxlength'    => '60',
		)
	);
	$contact .= veryo_field(
		'text',
		'bedrijf',
		__( 'Bedrijfsnaam', 'veryo' ),
		true,
		array(
			'autocomplete' => 'organization',
			'maxlength'    => '120',
		)
	);
	$contact .= veryo_field(
		'email',
		'email',
		__( 'E-mailadres', 'veryo' ),
		true,
		array(
			'autocomplete' => 'email',
			'maxlength'    => '120',
		)
	);
	$contact .= veryo_field(
		'tel',
		'telefoon',
		__( 'Telefoonnummer (optioneel)', 'veryo' ),
		false,
		array(
			'autocomplete' => 'tel',
			'maxlength'    => '20',
		),
		__( 'We lichten je rapport graag kort telefonisch toe: 15 minuten, vrijblijvend.', 'veryo' )
	);
	$contact .= '<div class="field field--check"><input type="checkbox" id="scan-toestemming" name="toestemming" value="1" required aria-describedby="scan-toestemming-error"><label for="scan-toestemming">'
		/* translators: %s: link naar privacyverklaring. */
		. sprintf( esc_html__( 'Ik ga akkoord dat Veryo mijn gegevens gebruikt om het rapport te maken en contact met mij op te nemen, zoals beschreven in de %s.', 'veryo' ), $privacy )
		. '</label><p class="field-error" id="scan-toestemming-error" hidden></p></div>';
	$contact .= '<div class="hp-field" aria-hidden="true"><label for="scan-website">' . esc_html__( 'Laat dit veld leeg', 'veryo' ) . '</label><input type="text" id="scan-website" name="website" tabindex="-1" autocomplete="off"></div>';
	$contact .= '</div>';

	$steps  = veryo_scan_step(
		1,
		'branche',
		__( 'In welke branche zit je bedrijf?', 'veryo' ),
		veryo_scan_options( 'radio', 'branche', $branches )
			. '<div class="field scan-other" hidden><label for="scan-branche-overig">' . esc_html__( 'Welke branche?', 'veryo' ) . '</label><input type="text" id="scan-branche-overig" name="branche_overig" maxlength="100"></div>'
	);
	$steps .= veryo_scan_step( 2, 'team', __( 'Hoe groot is je team?', 'veryo' ), veryo_scan_options( 'radio', 'team', veryo_scan_team_sizes() ), __( 'Inclusief jezelf.', 'veryo' ) );
	$steps .= veryo_scan_step( 3, 'taken', __( 'Waar gaat de meeste tijd naartoe?', 'veryo' ), veryo_scan_options( 'checkbox', 'taken', $tasks ), __( 'Kies er één of meer.', 'veryo' ) );
	$steps .= veryo_scan_step( 4, 'uren', __( 'Hoeveel uur per week kost dat ongeveer?', 'veryo' ), $sliders, __( 'Voor het hele team samen. Een schatting is prima.', 'veryo' ) );
	$steps .= veryo_scan_step( 5, 'tools', __( 'Welke tools gebruik je?', 'veryo' ), veryo_scan_options( 'checkbox', 'tools', veryo_scan_tools() ), __( 'Kies alles wat van toepassing is.', 'veryo' ) );
	$steps .= veryo_scan_step( 6, 'ai_gebruik', __( 'Gebruik je al AI?', 'veryo' ), veryo_scan_options( 'radio', 'ai_gebruik', veryo_scan_ai_usage() ) );
	$steps .= veryo_scan_step(
		7,
		'frustratie',
		__( 'Wat is je grootste frustratie in het werk?', 'veryo' ),
		'<div class="field"><label for="scan-frustratie" class="screen-reader-text">' . esc_html__( 'Grootste frustratie (optioneel)', 'veryo' ) . '</label><textarea id="scan-frustratie" name="frustratie" rows="4" maxlength="500" placeholder="' . esc_attr__( 'Bijvoorbeeld: offertes blijven liggen omdat niemand tijd heeft.', 'veryo' ) . '"></textarea><p class="field-count" aria-live="polite"><span class="scan-count">0</span>/500</p></div>',
		__( 'Optioneel. Zet hier geen persoonsgegevens van klanten of medewerkers in.', 'veryo' )
	);
	$steps .= veryo_scan_step( 8, 'timing', __( 'Wanneer wil je iets doen?', 'veryo' ), veryo_scan_options( 'radio', 'timing', veryo_scan_timing() ) );
	$steps .= veryo_scan_step( 9, 'contact', __( 'Waar mogen we je rapport naartoe sturen?', 'veryo' ), $contact );

	$out  = '<div class="veryo-scan" id="ai-scan" data-veryo-scan>';
	$out .= '<noscript><p class="scan-noscript">' . wp_kses_post(
		sprintf(
			/* translators: %s: link naar contact. */
			__( 'Voor de AI-scan is JavaScript nodig. Werkt dat niet? <a href="%s">Neem direct contact op</a>, dan lopen we de vragen samen door.', 'veryo' ),
			esc_url( veryo_url( 'contact' ) )
		)
	) . '</p></noscript>';
	$out .= '<form class="scan-form" novalidate aria-label="' . esc_attr__( 'Gratis AI-scan', 'veryo' ) . '">';
	$out .= '<div class="scan-top"><p class="scan-count-label" id="scan-live" aria-live="polite">' . esc_html__( 'Vraag 1 van 9', 'veryo' ) . '</p>';
	$out .= '<div class="scan-progress" role="progressbar" aria-labelledby="scan-live" aria-valuemin="1" aria-valuemax="9" aria-valuenow="1"><span class="scan-progress__bar"></span></div></div>';
	$out .= $steps;
	$out .= '<div class="scan-nav">';
	$out .= '<button type="button" class="btn btn--link scan-back" hidden>' . esc_html__( 'Terug', 'veryo' ) . '</button>';
	$out .= '<button type="button" class="btn btn--amber scan-next">' . esc_html__( 'Volgende', 'veryo' ) . '</button>';
	$out .= '<button type="submit" class="btn btn--amber scan-submit" hidden>' . esc_html__( 'Verstuur en ontvang mijn rapport', 'veryo' ) . '</button>';
	$out .= '</div>';
	$out .= '<p class="scan-status" role="status" aria-live="polite"></p>';
	$out .= '</form>';
	$out .= '<div class="scan-result" hidden tabindex="-1"></div>';
	$out .= '</div>';
	return $out;
}

/**
 * Formulierveld.
 *
 * @param string               $type     Type.
 * @param string               $name     Naam.
 * @param string               $label    Label.
 * @param bool                 $required Verplicht.
 * @param array<string,string> $attrs    Extra attributen.
 * @param string               $help     Uitleg onder het veld.
 * @param string               $prefix   ID-voorvoegsel.
 * @return string
 */
function veryo_field( $type, $name, $label, $required = false, $attrs = array(), $help = '', $prefix = 'scan' ) {
	$id       = $prefix . '-' . $name;
	$err      = $id . '-error';
	$help_id  = $id . '-help';
	$describe = trim( ( $help ? $help_id . ' ' : '' ) . $err );
	$extra    = '';
	foreach ( $attrs as $k => $v ) {
		$extra .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
	}
	$out  = '<div class="field">';
	$out .= '<label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . ( $required ? ' <span class="req" aria-hidden="true">*</span>' : '' ) . '</label>';
	if ( 'textarea' === $type ) {
		$out .= '<textarea id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '"' . ( $required ? ' required' : '' ) . ' aria-describedby="' . esc_attr( $describe ) . '"' . $extra . '></textarea>';
	} else {
		$out .= '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '"' . ( $required ? ' required' : '' ) . ' aria-describedby="' . esc_attr( $describe ) . '"' . $extra . '>';
	}
	if ( $help ) {
		$out .= '<p class="field-help" id="' . esc_attr( $help_id ) . '">' . esc_html( $help ) . '</p>';
	}
	$out .= '<p class="field-error" id="' . esc_attr( $err ) . '" hidden></p>';
	return $out . '</div>';
}

/**
 * Contactformulier of Academy-wachtlijst.
 *
 * @param array<string,string>|string $atts Attributen.
 * @return string
 */
function veryo_sc_form( $atts ) {
	$atts = shortcode_atts( array( 'type' => 'contact' ), $atts, 'veryo_form' );
	$type = 'academy' === $atts['type'] ? 'academy' : 'contact';
	if ( 'academy' === $type && ! veryo_setting( 'academy_waitlist' ) ) {
		return '';
	}
	veryo_enqueue_with_config( 'veryo-forms' );

	$p       = 'form-' . $type;
	$privacy = '<a href="' . esc_url( veryo_url( 'privacyverklaring' ) ) . '" target="_blank" rel="noopener">' . esc_html__( 'privacyverklaring', 'veryo' ) . '</a>';

	$out  = '<form class="veryo-form" data-veryo-form="' . esc_attr( $type ) . '" novalidate>';
	$out .= veryo_field(
		'text',
		'naam',
		__( 'Naam', 'veryo' ),
		true,
		array(
			'autocomplete' => 'name',
			'maxlength'    => '80',
		),
		'',
		$p
	);
	$out .= veryo_field(
		'text',
		'bedrijf',
		__( 'Bedrijf', 'veryo' ),
		false,
		array(
			'autocomplete' => 'organization',
			'maxlength'    => '120',
		),
		'',
		$p
	);
	if ( 'academy' === $type ) {
		$out .= veryo_field(
			'number',
			'medewerkers',
			__( 'Aantal medewerkers dat wil deelnemen', 'veryo' ),
			false,
			array(
				'min'       => '1',
				'max'       => '1000',
				'inputmode' => 'numeric',
			),
			__( 'Staffelkorting vanaf 10 personen. Laat leeg als je alleen voor jezelf inschrijft.', 'veryo' ),
			$p
		);
	}
	$out .= veryo_field(
		'email',
		'email',
		__( 'E-mailadres', 'veryo' ),
		true,
		array(
			'autocomplete' => 'email',
			'maxlength'    => '120',
		),
		'',
		$p
	);
	if ( 'contact' === $type ) {
		$out .= veryo_field(
			'tel',
			'telefoon',
			__( 'Telefoonnummer (optioneel)', 'veryo' ),
			false,
			array(
				'autocomplete' => 'tel',
				'maxlength'    => '20',
			),
			'',
			$p
		);
		$out .= veryo_field(
			'textarea',
			'bericht',
			__( 'Bericht', 'veryo' ),
			true,
			array(
				'rows'      => '5',
				'maxlength' => '2000',
			),
			'',
			$p
		);
	}
	$consent = 'academy' === $type
		/* translators: %s: link naar privacyverklaring. */
		? __( 'Ik ga akkoord dat Veryo mijn gegevens bewaart om mij te laten weten wanneer de cursus beschikbaar is, zoals beschreven in de %s.', 'veryo' )
		/* translators: %s: link naar privacyverklaring. */
		: __( 'Ik ga akkoord dat Veryo mijn gegevens gebruikt om contact met mij op te nemen, zoals beschreven in de %s.', 'veryo' );
	$out .= '<div class="field field--check"><input type="checkbox" id="' . esc_attr( $p ) . '-toestemming" name="toestemming" value="1" required aria-describedby="' . esc_attr( $p ) . '-toestemming-error"><label for="' . esc_attr( $p ) . '-toestemming">' . sprintf( esc_html( $consent ), $privacy ) . '</label><p class="field-error" id="' . esc_attr( $p ) . '-toestemming-error" hidden></p></div>';
	$out .= '<div class="hp-field" aria-hidden="true"><label for="' . esc_attr( $p ) . '-website">' . esc_html__( 'Laat dit veld leeg', 'veryo' ) . '</label><input type="text" id="' . esc_attr( $p ) . '-website" name="website" tabindex="-1" autocomplete="off"></div>';
	$out .= '<button type="submit" class="btn btn--petrol">' . esc_html( 'academy' === $type ? __( 'Zet me op de wachtlijst', 'veryo' ) : __( 'Verstuur bericht', 'veryo' ) ) . '</button>';
	$out .= '<p class="form-status" role="status" aria-live="polite"></p>';
	$out .= '</form>';
	return $out;
}

/**
 * Bewaartermijn uit de instellingen.
 *
 * @return string
 */
function veryo_sc_retention() {
	$months = max( 1, (int) veryo_setting( 'retention_months', 24 ) );
	/* translators: %d: aantal maanden. */
	return esc_html( sprintf( _n( '%d maand', '%d maanden', $months, 'veryo' ), $months ) );
}

/**
 * Contactgegevens (lege velden worden niet getoond).
 *
 * @return string
 */
function veryo_sc_contact_details() {
	ob_start();
	get_template_part( 'template-parts/company-details', null, array( 'context' => 'content' ) );
	return (string) ob_get_clean();
}

/**
 * Knop naar de afspraaklink, alleen als die is ingevuld.
 *
 * @return string
 */
function veryo_sc_calendly_button() {
	$url = (string) veryo_setting( 'calendly_url', '' );
	if ( '' === $url ) {
		return '';
	}
	return '<p><a class="btn btn--petrol" href="' . esc_url( $url ) . '">' . esc_html__( 'Plan direct een gesprek', 'veryo' ) . '</a></p>';
}

/**
 * Knoppen "Plan een kennismaking" (Calendly, anders contactpagina) en "Doe eerst de gratis AI-scan".
 *
 * @return string
 */
function veryo_sc_kennismaking() {
	$url = (string) veryo_setting( 'calendly_url', '' );
	$url = '' !== $url ? $url : veryo_url( 'contact' );
	return '<div class="veryo-cta-buttons"><a class="btn btn--amber" href="' . esc_url( $url ) . '">' . esc_html__( 'Plan een kennismaking', 'veryo' ) . '</a> <a class="btn btn--link" href="' . esc_url( veryo_url( 'waar-begin-ik-met-ai' ) ) . '">' . esc_html__( 'Doe eerst de gratis AI-scan', 'veryo' ) . '</a></div>';
}

/**
 * Gestileerde preview van het rapport (zonder echte of verzonnen klantdata).
 *
 * @return string
 */
function veryo_sc_report_preview() {
	$out  = '<figure class="report-preview">';
	$out .= '<div class="report-preview__card" aria-hidden="true">';
	$out .= '<p class="report-preview__label">' . esc_html__( 'Voorbeeld van je rapport', 'veryo' ) . '</p>';
	$out .= '<p class="report-preview__big"><span class="blur">00</span> ' . esc_html__( 'uur per week', 'veryo' ) . '</p>';
	$out .= '<p class="report-preview__meta">' . esc_html__( 'Kansenscore', 'veryo' ) . ' <span class="blur">00</span>/100</p>';
	$out .= '<ol class="report-preview__list">';
	foreach ( array( __( 'Aanbeveling 1', 'veryo' ), __( 'Aanbeveling 2', 'veryo' ), __( 'Aanbeveling 3', 'veryo' ) ) as $label ) {
		$out .= '<li><strong>' . esc_html( $label ) . '</strong><span class="line"></span><span class="line line--short"></span></li>';
	}
	$out .= '</ol></div>';
	$out .= '<figcaption>' . esc_html__( 'Zo ziet je rapport eruit: je tijdwinst, een kansenscore en drie concrete aanbevelingen met prijsindicatie.', 'veryo' ) . '</figcaption>';
	return $out . '</figure>';
}

/**
 * Lead zoeken op rapport-token.
 *
 * @param string $token Token.
 * @return int Lead-ID of 0.
 */
function veryo_lead_by_token( $token ) {
	if ( ! preg_match( '/^[A-Za-z0-9]{32}$/', $token ) ) {
		return 0;
	}
	$ids = get_posts(
		array(
			'post_type'      => 'veryo_lead',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- één lookup per rapportbezoek.
				array(
					'key'   => '_veryo_token',
					'value' => $token,
				),
			),
		)
	);
	return $ids ? (int) $ids[0] : 0;
}

/**
 * Het online rapport.
 *
 * @return string
 */
function veryo_sc_rapport() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- token in de link, geen formulier.
	$token   = isset( $_GET['t'] ) ? sanitize_text_field( wp_unslash( $_GET['t'] ) ) : '';
	$lead_id = veryo_lead_by_token( $token );
	$invalid = '<div class="report-empty"><h1 class="page-title">' . esc_html__( 'Rapport niet gevonden', 'veryo' ) . '</h1><p>' . esc_html__( 'Deze link werkt niet (meer). Rapporten zijn 90 dagen online te bekijken. Je kunt de AI-scan opnieuw doen of contact met ons opnemen.', 'veryo' ) . '</p><p><a class="btn btn--amber" href="' . esc_url( veryo_url( 'waar-begin-ik-met-ai' ) ) . '">' . esc_html__( 'Doe de AI-scan opnieuw', 'veryo' ) . '</a></p></div>';
	if ( ! $lead_id ) {
		return $invalid;
	}
	$lead = veryo_lead_get( $lead_id );
	if ( ! hash_equals( $lead['token'], $token ) || $lead['token_time'] < time() - 90 * DAY_IN_SECONDS ) {
		return $invalid;
	}
	if ( empty( $lead['report']['aanbevelingen'] ) ) {
		if ( ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) ) {
			spawn_cron();
		}
		return '<div class="report-empty"><h1 class="page-title">' . esc_html__( 'Je rapport wordt nog gemaakt', 'veryo' ) . '</h1><p>' . esc_html__( 'Dat duurt meestal een paar minuten. Ververs deze pagina straks, of wacht op de e-mail.', 'veryo' ) . '</p></div>';
	}

	$r        = $lead['report'];
	$calc     = $lead['calc'];
	$name     = isset( $lead['contact']['voornaam'] ) ? $lead['contact']['voornaam'] : '';
	$calendly = (string) veryo_setting( 'calendly_url', '' );

	$out = '<article class="report">';
	/* translators: %s: voornaam. */
	$out .= '<header class="report__head"><p class="report__label">' . esc_html__( 'Je AI-scan', 'veryo' ) . '</p><h1 class="page-title">' . esc_html( sprintf( __( 'Het rapport van %s', 'veryo' ), $name ) ) . '</h1></header>';
	$out .= '<div class="report__numbers">';
	/* translators: %d: uren. */
	$out .= '<p class="report__big">' . esc_html( sprintf( __( '%d uur per week', 'veryo' ), (int) $calc['besparing_uren_per_week'] ) ) . '</p>';
	/* translators: %s: euro. */
	$out .= '<p>' . esc_html( sprintf( __( 'Geschatte tijdwinst, ongeveer %s per jaar.', 'veryo' ), veryo_euro( $calc['besparing_euro_per_jaar'] ) ) ) . '</p>';
	/* translators: %d: score. */
	$out .= '<p>' . esc_html( sprintf( __( 'Kansenscore: %d van 100', 'veryo' ), (int) $calc['kansenscore'] ) ) . '</p>';
	$out .= '<p class="report__assume">' . esc_html( veryo_scan_assumptions_text( $calc ) ) . '</p>';
	$out .= '</div>';
	$out .= '<h2>' . esc_html__( 'Samenvatting', 'veryo' ) . '</h2><p>' . esc_html( $r['samenvatting'] ) . '</p>';
	$out .= '<h2>' . esc_html__( 'Je 3 grootste kansen', 'veryo' ) . '</h2><ol class="report__recs">';
	foreach ( $r['aanbevelingen'] as $rec ) {
		$out .= '<li><h3>' . esc_html( $rec['titel'] ) . '</h3>';
		$out .= '<p><strong>' . esc_html__( 'Waarom:', 'veryo' ) . '</strong> ' . esc_html( $rec['waarom'] ) . '</p>';
		$out .= '<p><strong>' . esc_html__( 'Hoe het werkt:', 'veryo' ) . '</strong> ' . esc_html( $rec['hoe'] ) . '</p>';
		$out .= '<p><strong>' . esc_html__( 'Eerste stap:', 'veryo' ) . '</strong> ' . esc_html( $rec['eerste_stap'] ) . '</p>';
		/* translators: 1: niveau, 2: prijs, 3: tijdwinst. */
		$out .= '<p class="veryo-meta">' . esc_html( sprintf( __( '%1$s · %2$s excl. btw · indicatie tijdwinst %3$s', 'veryo' ), $rec['niveau'], $rec['prijs'], $rec['tijd'] ) ) . '</p></li>';
	}
	$out .= '</ol>';
	$out .= '<h2>' . esc_html__( 'Hier kun je zelf mee beginnen', 'veryo' ) . '</h2><p>' . esc_html( $r['zelf_beginnen'] ) . '</p>';
	$out .= '<p>' . esc_html( $r['afsluiting'] ) . '</p>';
	$team = isset( $lead['answers']['team'] ) ? (string) $lead['answers']['team'] : '';
	$out .= '<div class="report__next"><h2>' . esc_html__( 'Je volgende stap: het AI-Startpakket', 'veryo' ) . '</h2>';
	$out .= '<p>' . esc_html__( 'Kansensessie, teamtraining, AI-beleid op maat, één quick win ingericht en 30 dagen nazorg.', 'veryo' ) . '</p>';
	/* translators: %s: prijsindicatie voor de teamgrootte. */
	$out .= '<p>' . esc_html( sprintf( __( 'Voor jullie teamgrootte: %s, exclusief btw.', 'veryo' ), veryo_startpakket_price_for_team( $team ) ) ) . ' <a href="' . esc_url( veryo_url( 'ai-startpakket' ) ) . '">' . esc_html__( 'Meer over het AI-Startpakket', 'veryo' ) . '</a></p></div>';
	if ( $calendly ) {
		$out .= '<p><a class="btn btn--amber" href="' . esc_url( $calendly ) . '">' . esc_html__( 'Plan een gesprek', 'veryo' ) . '</a></p>';
	}
	$out .= '</article>';
	return $out;
}

/**
 * Rapportpagina: nooit cachen of indexeren.
 */
function veryo_rapport_headers() {
	if ( ! is_page( 'rapport' ) ) {
		return;
	}
	nocache_headers();
	header( 'Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0' );
	header( 'X-Robots-Tag: noindex, nofollow' );
	header( 'Referrer-Policy: no-referrer' );
}
add_action( 'template_redirect', 'veryo_rapport_headers' );

/**
 * Portret van de oprichter. Zonder foto (Instellingen > Veryo) een rustig monogram,
 * zodat er nooit een lege of "under construction"-plek staat.
 *
 * @param array<string,string>|string $atts Attributen: size small|large.
 * @return string
 */
function veryo_sc_portret( $atts ) {
	$atts  = shortcode_atts( array( 'size' => 'small' ), $atts, 'veryo_portret' );
	$size  = 'large' === $atts['size'] ? 'large' : 'small';
	$name  = trim( veryo_setting( 'founder_first' ) . ' ' . veryo_setting( 'founder_last' ) );
	$photo = absint( veryo_setting( 'founder_photo' ) );
	$class = 'veryo-portret veryo-portret--' . $size;
	if ( $photo && wp_attachment_is_image( $photo ) ) {
		return '<figure class="' . esc_attr( $class ) . '">' . wp_get_attachment_image(
			$photo,
			'large' === $size ? 'large' : 'medium',
			false,
			array(
				/* translators: %s: naam oprichter. */
				'alt'     => sprintf( __( '%s, oprichter van Veryo', 'veryo' ), $name ? $name : 'Veryo' ),
				'loading' => 'large' === $size ? 'lazy' : 'eager',
			)
		) . '</figure>';
	}
	if ( 'large' === $size ) {
		// Zonder foto: een vormgegeven merkvlak met het vinkje, de naam en de plaats.
		$check = '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><polyline points="18,23 29,45 47,16" fill="none" stroke="#E0A03A" stroke-width="7.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
		return '<figure class="' . esc_attr( $class . ' is-monogram' ) . '">' . $check . '<figcaption>' . esc_html( $name ? $name : 'Veryo' ) . '<small>' . esc_html__( 'Oprichter van Veryo, Leeuwarden', 'veryo' ) . '</small></figcaption></figure>';
	}
	$initial = $name ? mb_strtoupper( mb_substr( $name, 0, 1 ) ) : 'V';
	return '<figure class="' . esc_attr( $class . ' is-monogram' ) . '" aria-hidden="true"><span>' . esc_html( $initial ) . '</span></figure>';
}

/**
 * Doorlopende band met klantlogo's, alleen als cases aan staan en er logo's zijn.
 *
 * @return string
 */
function veryo_sc_klantlogos() {
	if ( ! veryo_setting( 'show_cases' ) ) {
		return '';
	}
	$ids = array_filter( array_map( 'absint', explode( ',', (string) veryo_setting( 'client_logos' ) ) ) );
	if ( ! $ids ) {
		return '';
	}
	$out = '<div class="veryo-marquee veryo-marquee--logos"><ul class="veryo-marquee__list" aria-label="' . esc_attr__( 'Klanten van Veryo', 'veryo' ) . '">';
	foreach ( $ids as $id ) {
		$out .= '<li>' . wp_get_attachment_image( $id, 'medium', false, array( 'loading' => 'lazy' ) ) . '</li>';
	}
	return $out . '</ul></div>';
}
