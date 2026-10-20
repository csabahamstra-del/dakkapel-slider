<?php
/**
 * Landingspagina's zonder menu: /founding-partner, /lead-opvolging en
 * /klantrapportage-beveiliging. Formulieren, webhook naar Make, teller en de schakelaar
 * voor de live WhatsApp-test.
 *
 * Instellingen staan in Instellingen > Veryo > Landingspagina's. Daarnaast kun je in
 * wp-config.php VERYO_FORMS_WEBHOOK_URL en VERYO_WHATSAPP_LIVE zetten.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'VERYO_FORMS_WEBHOOK_URL' ) ) {
	define( 'VERYO_FORMS_WEBHOOK_URL', 'https://hook.eu2.make.com/erf8jxiy2lnxj18fjr8tsc3j4mvmw5hx' );
}
if ( ! defined( 'VERYO_LP_CALENDLY_URL' ) ) {
	define( 'VERYO_LP_CALENDLY_URL', 'https://calendly.com/wearecue-info/kennismaking-veryo' );
}

add_shortcode( 'veryo_lp_form', 'veryo_sc_lp_form' );
add_shortcode( 'veryo_lp_teller', 'veryo_sc_lp_teller' );
add_shortcode( 'veryo_lp_probeer', 'veryo_sc_lp_probeer' );
add_shortcode( 'veryo_lp_voorbeeld', 'veryo_sc_lp_voorbeeld' );
add_shortcode( 'veryo_lp_kr_prijs', 'veryo_sc_lp_kr_prijs' );

/**
 * De webhook-URL voor de landingsformulieren.
 *
 * @return string
 */
function veryo_forms_webhook_url() {
	$own = (string) veryo_setting( 'forms_webhook', '' );
	return '' !== $own ? $own : (string) VERYO_FORMS_WEBHOOK_URL;
}

/**
 * Staat de live WhatsApp-test op /lead-opvolging aan?
 *
 * @return bool
 */
function veryo_whatsapp_live() {
	if ( defined( 'VERYO_WHATSAPP_LIVE' ) ) {
		return (bool) VERYO_WHATSAPP_LIVE;
	}
	return (bool) veryo_setting( 'whatsapp_live', 0 );
}

/**
 * Oplossingen in het Founding Partner-programma: sleutel => naam (zoals in de JSON) en
 * de instelling met het aantal vrije plekken.
 *
 * @return array<string,array<string,string>>
 */
function veryo_fp_solutions() {
	return array(
		'startpakket'     => array(
			'naam'    => 'Startpakket',
			'label'   => __( 'AI-Startpakket', 'veryo' ),
			'setting' => 'fp_startpakket',
		),
		'lead-opvolging'  => array(
			'naam'    => 'Lead-opvolging',
			'label'   => __( 'AI lead-opvolging', 'veryo' ),
			'setting' => 'fp_leadopvolging',
		),
		'klantrapportage' => array(
			'naam'    => 'Klantrapportage',
			'label'   => __( 'AI Klantrapportage', 'veryo' ),
			'setting' => 'fp_klantrapportage',
		),
		'veryo-collega'   => array(
			'naam'    => 'Veryo Collega',
			'label'   => 'Veryo Collega',
			'setting' => 'fp_collega',
		),
	);
}

/**
 * Definitie van de drie formulieren: velden (in de volgorde van de JSON), keuzes, verplicht,
 * deur, bevestigingstekst en akkoordtekst.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_lp_forms() {
	$branches  = veryo_scan_branches();
	$branches  = array_slice( $branches, 0, -1, true ) + array( 'beveiliging' => __( 'Beveiliging', 'veryo' ) ) + array_slice( $branches, -1, 1, true );
	$solutions = array();
	foreach ( veryo_fp_solutions() as $solution ) {
		$solutions[ $solution['naam'] ] = $solution['naam'];
	}
	$branch_options = array();
	foreach ( $branches as $label ) {
		$branch_options[ $label ] = $label;
	}
	return array(
		'founding_partner'    => array(
			'deur'    => 'Founding Partner',
			'bron'    => 'founding-partner',
			'knop'    => __( 'Vraag mijn plek aan', 'veryo' ),
			'klaar'   => __( 'Dank je. Csaba belt je binnen één werkdag.', 'veryo' ),
			/* translators: %s: link naar de privacyverklaring. */
			'akkoord' => __( 'Ik ga akkoord dat Veryo mijn gegevens gebruikt om contact met mij op te nemen over het Founding Partner-programma, zoals beschreven in de %s.', 'veryo' ),
			'velden'  => array(
				'voornaam'     => array(
					'text',
					__( 'Voornaam', 'veryo' ),
					true,
					array(
						'autocomplete' => 'given-name',
						'maxlength'    => '60',
					),
				),
				'achternaam'   => array(
					'text',
					__( 'Achternaam', 'veryo' ),
					true,
					array(
						'autocomplete' => 'family-name',
						'maxlength'    => '80',
					),
				),
				'bedrijfsnaam' => array(
					'text',
					__( 'Bedrijfsnaam', 'veryo' ),
					true,
					array(
						'autocomplete' => 'organization',
						'maxlength'    => '120',
					),
				),
				'email'        => array(
					'email',
					__( 'E-mailadres', 'veryo' ),
					true,
					array(
						'autocomplete' => 'email',
						'maxlength'    => '120',
					),
				),
				'telefoon'     => array(
					'tel',
					__( 'Telefoonnummer', 'veryo' ),
					true,
					array(
						'autocomplete' => 'tel',
						'maxlength'    => '20',
					),
				),
				'branche'      => array( 'select', __( 'Branche', 'veryo' ), true, $branch_options ),
				'medewerkers'  => array(
					'select',
					__( 'Aantal medewerkers', 'veryo' ),
					true,
					array(
						'1'     => '1',
						'2-10'  => '2–10',
						'11-25' => '11–25',
						'26-50' => '26–50',
						'50+'   => '50+',
					),
				),
				'oplossing'    => array( 'radio', __( 'Welke oplossing interesseert je?', 'veryo' ), true, $solutions ),
				'tijdvreter'   => array(
					'textarea',
					__( 'Wat kost je nu de meeste tijd?', 'veryo' ),
					false,
					array(
						'maxlength' => '300',
						'rows'      => '3',
					),
				),
			),
		),
		'lead_opvolging_test' => array(
			'deur'    => 'Vakbedrijven',
			'bron'    => 'lead-opvolging-test',
			'knop'    => __( 'Stuur mijn testaanvraag', 'veryo' ),
			'klaar'   => __( 'Dank je. Binnen 2 minuten krijg je een WhatsApp van de AI.', 'veryo' ),
			/* translators: %s: link naar de privacyverklaring. */
			'akkoord' => __( 'Ik ga akkoord dat ik voor deze test een WhatsApp-bericht krijg op het nummer hierboven, zoals beschreven in de %s.', 'veryo' ),
			'velden'  => array(
				'voornaam' => array(
					'text',
					__( 'Voornaam', 'veryo' ),
					true,
					array(
						'autocomplete' => 'given-name',
						'maxlength'    => '60',
					),
				),
				'telefoon' => array(
					'tel',
					__( 'Telefoonnummer (voor WhatsApp)', 'veryo' ),
					true,
					array(
						'autocomplete' => 'tel',
						'maxlength'    => '20',
					),
				),
				'klus'     => array(
					'select',
					__( 'Wat wil je laten doen?', 'veryo' ),
					true,
					array(
						'Dakkapel' => __( 'Dakkapel', 'veryo' ),
						'Vloer'    => __( 'Vloer', 'veryo' ),
						'Kozijnen' => __( 'Kozijnen', 'veryo' ),
						'Anders'   => __( 'Anders', 'veryo' ),
					),
				),
				'postcode' => array(
					'text',
					__( 'Postcode', 'veryo' ),
					false,
					array(
						'autocomplete' => 'postal-code',
						'maxlength'    => '7',
					),
				),
			),
		),
		'proefrapport'        => array(
			'deur'    => 'Beveiliging',
			'bron'    => 'proefrapport',
			'knop'    => __( 'Vraag mijn proefrapport aan', 'veryo' ),
			'klaar'   => __( 'Dank je. Je krijgt binnen één werkdag een mail met een veilige uploadlink.', 'veryo' ),
			/* translators: %s: link naar de privacyverklaring. */
			'akkoord' => __( 'Ik ga akkoord dat Veryo mijn gegevens gebruikt om contact met mij op te nemen over het proefrapport, zoals beschreven in de %s.', 'veryo' ),
			'velden'  => array(
				'naam'                  => array(
					'text',
					__( 'Naam', 'veryo' ),
					true,
					array(
						'autocomplete' => 'name',
						'maxlength'    => '80',
					),
				),
				'bedrijfsnaam'          => array(
					'text',
					__( 'Bedrijfsnaam', 'veryo' ),
					true,
					array(
						'autocomplete' => 'organization',
						'maxlength'    => '120',
					),
				),
				'email'                 => array(
					'email',
					__( 'E-mailadres', 'veryo' ),
					true,
					array(
						'autocomplete' => 'email',
						'maxlength'    => '120',
					),
				),
				'telefoon'              => array(
					'tel',
					__( 'Telefoonnummer', 'veryo' ),
					true,
					array(
						'autocomplete' => 'tel',
						'maxlength'    => '20',
					),
				),
				'aantal_opdrachtgevers' => array(
					'select',
					__( 'Aantal opdrachtgevers', 'veryo' ),
					true,
					array(
						'1-5'  => '1–5',
						'6-20' => '6–20',
						'20+'  => '20+',
					),
				),
				'rapporten_via'         => array(
					'select',
					__( 'Hoe komen rapporten nu binnen?', 'veryo' ),
					true,
					array(
						'Mail'          => __( 'Mail', 'veryo' ),
						'Eigen systeem' => __( 'Eigen systeem', 'veryo' ),
						'App'           => __( 'App', 'veryo' ),
						'Anders'        => __( 'Anders', 'veryo' ),
					),
				),
			),
		),
	);
}

/**
 * Formulier tonen.
 *
 * @param array<string,string>|string $atts Attributen: type.
 * @return string
 */
function veryo_sc_lp_form( $atts ) {
	$atts  = shortcode_atts( array( 'type' => 'founding_partner' ), $atts, 'veryo_lp_form' );
	$forms = veryo_lp_forms();
	if ( ! isset( $forms[ $atts['type'] ] ) ) {
		return '';
	}
	$form = $forms[ $atts['type'] ];
	$p    = 'lp-' . str_replace( '_', '-', $atts['type'] );
	veryo_enqueue_with_config( 'veryo-landing' );

	$out = '<form class="veryo-lp-form" data-lp-form="' . esc_attr( $atts['type'] ) . '" data-done="' . esc_attr( $form['klaar'] ) . '" novalidate>';
	foreach ( $form['velden'] as $name => $field ) {
		list( $type, $label, $required, $extra ) = $field;
		$id                                      = $p . '-' . $name;
		$err                                     = $id . '-error';
		$req                                     = $required ? ' <span class="req" aria-hidden="true">*</span>' : '';
		$attrs                                   = $required ? ' required aria-required="true"' : '';
		if ( 'radio' === $type ) {
			$out .= '<fieldset class="field field--choices" aria-describedby="' . esc_attr( $err ) . '"><legend>' . esc_html( $label ) . $req . '</legend>';
			foreach ( $extra as $value => $text ) {
				$rid  = $id . '-' . sanitize_title( $value );
				$out .= '<label class="choice" for="' . esc_attr( $rid ) . '"><input type="radio" id="' . esc_attr( $rid ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '"' . $attrs . '><span>' . esc_html( $text ) . '</span></label>';
			}
			$out .= '<p class="field-error" id="' . esc_attr( $err ) . '" hidden></p></fieldset>';
			continue;
		}
		$out .= '<div class="field' . ( 'textarea' === $type ? ' field--wide' : '' ) . '"><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . $req . '</label>';
		if ( 'select' === $type ) {
			$out .= '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '"' . $attrs . ' aria-describedby="' . esc_attr( $err ) . '"><option value="">' . esc_html__( 'Maak een keuze', 'veryo' ) . '</option>';
			foreach ( $extra as $value => $text ) {
				$out .= '<option value="' . esc_attr( $value ) . '">' . esc_html( $text ) . '</option>';
			}
			$out .= '</select>';
		} else {
			$more = '';
			foreach ( $extra as $k => $v ) {
				$more .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
			}
			$out .= 'textarea' === $type
				? '<textarea id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '"' . $attrs . $more . ' aria-describedby="' . esc_attr( $err ) . '"></textarea>'
				: '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '"' . $attrs . $more . ' aria-describedby="' . esc_attr( $err ) . '">';
		}
		$out .= '<p class="field-error" id="' . esc_attr( $err ) . '" hidden></p></div>';
	}
	$privacy = '<a href="' . esc_url( veryo_url( 'privacyverklaring' ) ) . '" target="_blank" rel="noopener">' . esc_html__( 'privacyverklaring', 'veryo' ) . '</a>';
	$out    .= '<div class="field field--check field--wide"><input type="checkbox" id="' . esc_attr( $p ) . '-toestemming" name="toestemming" value="1" required aria-describedby="' . esc_attr( $p ) . '-toestemming-error"><label for="' . esc_attr( $p ) . '-toestemming">' . sprintf( esc_html( $form['akkoord'] ), $privacy ) . '</label><p class="field-error" id="' . esc_attr( $p ) . '-toestemming-error" hidden></p></div>';
	$out    .= '<div class="hp-field" aria-hidden="true"><label for="' . esc_attr( $p ) . '-website">' . esc_html__( 'Laat dit veld leeg', 'veryo' ) . '</label><input type="text" id="' . esc_attr( $p ) . '-website" name="website" tabindex="-1" autocomplete="off"></div>';
	$out    .= '<button type="submit" class="btn btn--amber">' . esc_html( $form['knop'] ) . '</button>';
	$out    .= '<p class="form-status" role="status" aria-live="polite"></p>';
	return $out . '</form>';
}

/**
 * Teller: per oplossing "nog X van 2 plekken", uit de instellingen.
 *
 * @return string
 */
function veryo_sc_lp_teller() {
	$out = '<ul class="veryo-fp-teller" aria-label="' . esc_attr__( 'Vrije plekken per oplossing', 'veryo' ) . '">';
	foreach ( veryo_fp_solutions() as $solution ) {
		$free = max( 0, min( 2, (int) veryo_setting( $solution['setting'], 2 ) ) );
		$text = $free > 0
			/* translators: %d: aantal vrije plekken. */
			? sprintf( _n( 'nog %d van 2 plekken', 'nog %d van 2 plekken', $free, 'veryo' ), $free )
			: __( 'vol', 'veryo' );
		$out .= '<li class="' . ( $free > 0 ? '' : 'is-full' ) . '"><span class="veryo-fp-teller__name">' . esc_html( $solution['label'] ) . '</span><span class="veryo-fp-teller__dots" aria-hidden="true">' . str_repeat( '<i class="is-free"></i>', $free ) . str_repeat( '<i></i>', 2 - $free ) . '</span><span class="veryo-fp-teller__text">' . esc_html( $text ) . '</span></li>';
	}
	return $out . '</ul>';
}

/**
 * Blok "Probeer het zelf": het formulier als de WhatsApp-AI live is, anders een
 * video-placeholder met "Binnenkort zelf te testen".
 *
 * @return string
 */
function veryo_sc_lp_probeer() {
	if ( veryo_whatsapp_live() ) {
		return '<p class="veryo-lead">' . esc_html__( 'Vul hieronder een aanvraag in alsof je een klant bent. Binnen 2 minuten krijg je een WhatsApp van de AI. Hij stelt een paar vragen en plant een inmeting voor je in.', 'veryo' ) . '</p>'
			. '<div class="veryo-form-wrap is-style-paper">' . veryo_sc_lp_form( array( 'type' => 'lead_opvolging_test' ) ) . '</div>';
	}
	$bubbles = array(
		array( 'in', __( 'Nieuwe aanvraag: dakkapel', 'veryo' ) ),
		array( 'out', __( 'Hoi! Bedankt voor je aanvraag. Mag ik een paar korte vragen stellen?', 'veryo' ) ),
		array( 'out', __( 'Wanneer komt een inmeting je uit?', 'veryo' ) ),
	);
	$chat    = '';
	foreach ( $bubbles as $i => $bubble ) {
		$chat .= '<span class="veryo-wa__msg is-' . esc_attr( $bubble[0] ) . '" style="--i:' . (int) $i . '">' . esc_html( $bubble[1] ) . '</span>';
	}
	return '<div class="veryo-lp-video" role="img" aria-label="' . esc_attr__( 'Voorbeeld van de WhatsApp-flow. Binnenkort zelf te testen.', 'veryo' ) . '">'
		. '<div class="veryo-wa" aria-hidden="true">' . $chat . '</div>'
		. '<span class="veryo-lp-video__play" aria-hidden="true"></span>'
		. '<p class="veryo-lp-video__label">' . esc_html__( 'Binnenkort zelf te testen', 'veryo' ) . '</p></div>';
}

/**
 * Voor-en-na-illustratie voor de beveiligingspagina, zonder echte gegevens of cijfers.
 *
 * @param array<string,string>|string $atts Attributen: kant = voor|na.
 * @return string
 */
function veryo_sc_lp_voorbeeld( $atts ) {
	$atts = shortcode_atts( array( 'kant' => 'voor' ), $atts, 'veryo_lp_voorbeeld' );
	if ( 'na' === $atts['kant'] ) {
		$parts = array( __( 'Samenvatting', 'veryo' ), __( 'Incidenten per type', 'veryo' ), __( 'Trend ten opzichte van vorige maand', 'veryo' ), __( 'Opvolging', 'veryo' ), __( 'Aanbevelingen', 'veryo' ) );
		$rows  = '';
		foreach ( $parts as $i => $part ) {
			$rows .= '<div class="veryo-doc__row"><strong>' . esc_html( $part ) . '</strong>' . ( 1 === $i ? '<span class="veryo-doc__bars"><i></i><i></i><i></i><i></i></span>' : ( 2 === $i ? '<span class="veryo-doc__trend"></span>' : '<span class="veryo-doc__line"></span><span class="veryo-doc__line is-short"></span>' ) ) . '</div>';
		}
		return '<figure class="veryo-doc"><div class="veryo-doc__page" aria-hidden="true"><div class="veryo-doc__head"><span class="veryo-doc__logo"></span><span>' . esc_html__( 'Maandrapportage', 'veryo' ) . '</span></div>' . $rows . '</div><figcaption>' . esc_html__( 'Na: één klantrapport in jullie huisstijl. Illustratie, geen echte gegevens.', 'veryo' ) . '</figcaption></figure>';
	}
	$sheets = '';
	foreach ( array( __( 'Dienstrapport', 'veryo' ), __( 'Incident', 'veryo' ), __( 'Mail', 'veryo' ), __( 'Dienstrapport', 'veryo' ) ) as $i => $label ) {
		$sheets .= '<div class="veryo-pile__sheet" style="--i:' . (int) $i . '"><span>' . esc_html( $label ) . '</span><span class="veryo-doc__line"></span><span class="veryo-doc__line is-short"></span><span class="veryo-doc__line"></span></div>';
	}
	return '<figure class="veryo-pile"><div class="veryo-pile__stack" aria-hidden="true">' . $sheets . '</div><figcaption>' . esc_html__( 'Voor: een stapel losse dienstrapporten en mails. Illustratie, geanonimiseerd.', 'veryo' ) . '</figcaption></figure>';
}

/**
 * Blok "wat kost het" voor AI Klantrapportage, zonder bedragen.
 *
 * @return string
 */
function veryo_sc_lp_kr_prijs() {
	$items = array(
		__( 'Een maandbedrag dat afhangt van het aantal opdrachtgevers en objecten', 'veryo' ),
		__( 'De eerste maand loopt het abonnement gratis mee', 'veryo' ),
		__( 'Na het proefrapport krijg je een gratis offerte op maat, met vooraf een vaste prijs', 'veryo' ),
	);
	$out   = '<ul class="is-style-checks">';
	foreach ( $items as $item ) {
		$out .= '<li>' . esc_html( $item ) . '</li>';
	}
	return $out . '</ul>';
}

/**
 * REST-route voor de landingsformulieren.
 */
function veryo_lp_register_route() {
	register_rest_route(
		'veryo/v1',
		'/lp',
		array(
			'methods'             => 'POST',
			'callback'            => 'veryo_rest_lp',
			'permission_callback' => 'veryo_rest_check_nonce',
		)
	);
}
add_action( 'rest_api_init', 'veryo_lp_register_route' );

/**
 * Inzending verwerken: valideren, als lead bewaren, webhook versturen.
 *
 * @param WP_REST_Request $request Verzoek.
 * @return WP_REST_Response|WP_Error
 */
function veryo_rest_lp( $request ) {
	$p = $request->get_json_params();
	$p = is_array( $p ) ? $p : array();

	// Honeypot: bots krijgen een neutraal antwoord en er wordt niets opgeslagen.
	if ( ! empty( $p['website'] ) ) {
		return new WP_REST_Response( array( 'ok' => true ), 200 );
	}
	$forms = veryo_lp_forms();
	$type  = isset( $p['formulier'] ) && is_string( $p['formulier'] ) ? $p['formulier'] : '';
	if ( ! isset( $forms[ $type ] ) ) {
		return new WP_Error( 'veryo_invalid_type', __( 'Onbekend formulier.', 'veryo' ), array( 'status' => 400 ) );
	}
	$form   = $forms[ $type ];
	$errors = array();
	$values = array();
	foreach ( $form['velden'] as $name => $field ) {
		list( $kind, $label, $required, $extra ) = $field;
		$raw                                     = isset( $p[ $name ] ) && is_scalar( $p[ $name ] ) ? (string) $p[ $name ] : '';
		if ( in_array( $kind, array( 'select', 'radio' ), true ) ) {
			$value = isset( $extra[ $raw ] ) ? $raw : '';
		} elseif ( 'email' === $kind ) {
			$value = sanitize_email( $raw );
			if ( '' !== $raw && ! is_email( $value ) ) {
				$errors[ $name ] = __( 'Vul een geldig e-mailadres in.', 'veryo' );
			}
		} elseif ( 'tel' === $kind ) {
			$value = veryo_clean_text( $raw, 20 );
			if ( '' !== $value && ! veryo_valid_phone( $value ) ) {
				$errors[ $name ] = __( 'Dit telefoonnummer lijkt niet te kloppen.', 'veryo' );
			}
		} else {
			$value = veryo_clean_text( $raw, isset( $extra['maxlength'] ) ? (int) $extra['maxlength'] : 200, 'textarea' === $kind );
		}
		if ( $required && '' === $value && ! isset( $errors[ $name ] ) ) {
			$errors[ $name ] = in_array( $kind, array( 'select', 'radio' ), true ) ? __( 'Maak een keuze.', 'veryo' ) : __( 'Dit veld is verplicht.', 'veryo' );
		}
		$values[ $name ] = $value;
	}
	if ( empty( $p['toestemming'] ) || true !== filter_var( $p['toestemming'], FILTER_VALIDATE_BOOLEAN ) ) {
		$errors['toestemming'] = __( 'Geef toestemming om je gegevens te gebruiken.', 'veryo' );
	}
	if ( $errors ) {
		return veryo_rest_validation_error( $errors );
	}
	if ( 'lead_opvolging_test' === $type && ! veryo_whatsapp_live() ) {
		return new WP_Error( 'veryo_not_live', __( 'Deze test is nog niet beschikbaar.', 'veryo' ), array( 'status' => 403 ) );
	}
	if ( veryo_rate_limited( 'lp', 5 ) ) {
		return new WP_Error( 'veryo_rate_limited', __( 'Je hebt het afgelopen uur al een paar keer een formulier verstuurd. Probeer het later opnieuw.', 'veryo' ), array( 'status' => 429 ) );
	}

	// Herkomst en pagina, alleen interne paden en een eenvoudige utm_source.
	$utm  = isset( $p['utm_source'] ) && is_string( $p['utm_source'] ) ? mb_substr( sanitize_text_field( $p['utm_source'] ), 0, 80 ) : '';
	$path = isset( $p['pagina'] ) && is_string( $p['pagina'] ) && preg_match( '#^/[a-z0-9/_\-]{0,150}$#i', $p['pagina'] ) ? $p['pagina'] : '/';

	$payload = array(
		'formulier'  => $type,
		'deur'       => $form['deur'],
		'bron'       => '' !== $utm ? $utm : 'Direct',
		'pagina_url' => home_url( $path ),
	);
	foreach ( $form['velden'] as $name => $field ) {
		$payload[ $name ] = $values[ $name ];
	}

	// Altijd ook als lead in WordPress bewaren, zodat er nooit iets verloren gaat.
	$contact = $values;
	if ( isset( $values['naam'] ) || isset( $values['voornaam'] ) ) {
		$contact['naam'] = isset( $values['naam'] ) ? $values['naam'] : trim( $values['voornaam'] . ' ' . ( isset( $values['achternaam'] ) ? $values['achternaam'] : '' ) );
	}
	$contact['bedrijf'] = isset( $values['bedrijfsnaam'] ) ? $values['bedrijfsnaam'] : '';
	$contact['email']   = isset( $values['email'] ) ? $values['email'] : '';
	$contact['pagina']  = $path;
	$lead_id            = veryo_lead_create( $form['bron'], $contact );
	if ( is_wp_error( $lead_id ) ) {
		$lead_id = 0;
	}

	veryo_send_lp_webhook( $payload, (int) $lead_id );

	return new WP_REST_Response(
		array(
			'ok'      => true,
			'message' => $form['klaar'],
		),
		200
	);
}

/**
 * Webhook naar Make, timeout 5 seconden. Mislukt hij, dan loggen en de inzending als
 * back-up mailen naar info@veryo.nl.
 *
 * @param array<string,mixed> $payload Gegevens.
 * @param int                 $lead_id Lead (0 als opslaan mislukte).
 * @return bool
 */
function veryo_send_lp_webhook( $payload, $lead_id ) {
	$response = wp_safe_remote_post(
		veryo_forms_webhook_url(),
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
		if ( $lead_id ) {
			veryo_lead_log( $lead_id, 'Formulier-webhook (Make) verstuurd.' );
		}
		return true;
	}
	$sent = veryo_mail_lp_backup( $payload, $error, $lead_id );
	$note = 'Formulier-webhook (Make) mislukt: ' . rtrim( $error, '.' ) . '. ' . ( $sent ? 'Back-up gemaild naar info@veryo.nl.' : 'Back-upmail kon niet worden verstuurd.' );
	if ( $lead_id ) {
		veryo_lead_log( $lead_id, $note );
	} else {
		error_log( 'Veryo: ' . $note ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log -- laatste vangnet als ook de lead niet is opgeslagen.
	}
	return false;
}

/**
 * Back-upmail met de inzending.
 *
 * @param array<string,mixed> $payload Gegevens.
 * @param string              $error   Foutmelding.
 * @param int                 $lead_id Lead.
 * @return bool
 */
function veryo_mail_lp_backup( $payload, $error, $lead_id ) {
	/* translators: 1: deur, 2: formulier. */
	$subject = sprintf( __( '[%1$s] Webhook mislukt, back-up van formulier %2$s', 'veryo' ), $payload['deur'], $payload['formulier'] );
	$html    = '<tr><td style="padding:24px 32px"><p style="margin:0 0 16px">' . esc_html(
		sprintf(
			/* translators: %s: foutmelding. */
			__( 'De webhook naar Make is mislukt (%s). Hieronder staat de inzending, zodat je hem met de hand kunt verwerken.', 'veryo' ),
			$error
		)
	) . '</p><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">';
	$text = '';
	foreach ( $payload as $key => $value ) {
		$html .= '<tr><td style="padding:4px 12px 4px 0;vertical-align:top;color:#55635F;width:35%">' . esc_html( $key ) . '</td><td style="padding:4px 0">' . nl2br( esc_html( (string) $value ) ) . '</td></tr>';
		$text .= $key . ': ' . $value . "\n";
	}
	$html .= '</table>';
	if ( $lead_id ) {
		$admin = admin_url( 'post.php?post=' . $lead_id . '&action=edit' );
		$html .= '<p style="margin:16px 0 0"><a href="' . esc_url( $admin ) . '" style="color:#1D4B44;font-weight:600">' . esc_html__( 'Open de lead in WordPress', 'veryo' ) . '</a></p>';
		$text .= "\n" . $admin . "\n";
	}
	$html .= '<p style="margin:16px 0 0;font-family:monospace;font-size:12px;color:#55635F">' . esc_html( (string) wp_json_encode( $payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ) . '</p></td></tr>';
	$reply = isset( $payload['email'] ) ? (string) $payload['email'] : '';
	return veryo_send_mail( 'info@veryo.nl', $subject, veryo_mail_layout( $subject, $html ), $text, $reply );
}

/**
 * Script registreren.
 */
function veryo_lp_scripts() {
	wp_register_script( 'veryo-landing', VERYO_URI . '/assets/js/landing.js', array(), VERYO_VERSION . '-' . (string) filemtime( VERYO_DIR . '/assets/js/landing.js' ), array( 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', 'veryo_lp_scripts', 5 );

/**
 * Body-class voor de landingstemplate.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function veryo_lp_body_class( $classes ) {
	if ( is_page_template( 'templates/landing.php' ) ) {
		$classes[] = 'is-landing';
	}
	return $classes;
}
add_filter( 'body_class', 'veryo_lp_body_class' );

/**
 * Na een thema-update: de drie landingspagina's eenmalig vanzelf aanmaken als ze ontbreken.
 * Ze komen niet in het menu.
 */
function veryo_lp_autocreate() {
	if ( ! current_user_can( 'manage_options' ) || wp_doing_ajax() || get_option( 'veryo_lp_pages_done' ) ) {
		return;
	}
	$defs = veryo_content_pages();
	$map  = get_option( 'veryo_page_ids', array() );
	$map  = is_array( $map ) ? $map : array();
	foreach ( array( 'founding-partner', 'lead-opvolging', 'klantrapportage-beveiliging' ) as $slug ) {
		if ( veryo_find_page( $slug ) || ! isset( $defs[ $slug ] ) ) {
			continue;
		}
		kses_remove_filters();
		$post_id = wp_insert_post(
			wp_slash(
				array(
					'post_type'      => 'page',
					'post_status'    => 'publish',
					'post_title'     => $defs[ $slug ]['title'],
					'post_name'      => $slug,
					'post_content'   => $defs[ $slug ]['content'],
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				)
			),
			true
		);
		kses_init();
		if ( is_wp_error( $post_id ) ) {
			continue;
		}
		veryo_apply_page_meta( $post_id, $defs[ $slug ] );
		veryo_remember_content( $post_id );
		$map[ $slug ] = $post_id;
	}
	update_option( 'veryo_page_ids', $map, false );
	update_option( 'veryo_lp_pages_done', 1, false );
}
add_action( 'admin_init', 'veryo_lp_autocreate' );
