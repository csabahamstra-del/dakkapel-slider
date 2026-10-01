<?php
/**
 * Algemene helpers: instellingen, bedrijfsgegevens, logo en iconen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Standaardwaarden voor de optie-array veryo_settings.
 *
 * @return array<string,mixed>
 */
function veryo_settings_defaults() {
	return array(
		// Bedrijfsgegevens.
		'company_name'     => 'Veryo',
		'street'           => 'Lange Marktstraat 1',
		'postcode'         => '',
		'city'             => 'Leeuwarden',
		'phone'            => '085 060 5752',
		'email'            => 'info@veryo.nl',
		'kvk'              => '73435996',
		'legal_name'       => 'Merklenz',
		'btw'              => '',
		'linkedin'         => '',
		'instagram'        => '',
		'founder_first'    => 'Csaba',
		'founder_last'     => '',
		'founder_photo'    => '',
		// AI-scan.
		'api_key'          => '',
		'model'            => 'claude-sonnet-5-5',
		'hourly_cost'      => 45,
		'work_weeks'       => 46,
		'lead_email'       => get_option( 'admin_email' ),
		'calendly_url'     => '',
		'make_webhook'     => '',
		'retention_months' => 24,
		'mail_from_name'   => 'Veryo',
		// Weergave.
		'show_cases'       => 0,
		'academy_waitlist' => 1,
		'animations'       => 1,
		'smooth_scroll'    => 1,
		'whatsapp'         => 0,
		'whatsapp_number'  => '',
		'client_logos'     => '',
	);
}

/**
 * Domein van de site zonder www, voor standaard e-mailadres.
 *
 * @return string
 */
function veryo_site_domain() {
	$host = wp_parse_url( home_url(), PHP_URL_HOST );
	$host = is_string( $host ) ? $host : 'example.nl';
	return preg_replace( '/^www\./', '', $host );
}

/**
 * Alle instellingen, aangevuld met standaardwaarden.
 *
 * @return array<string,mixed>
 */
function veryo_settings() {
	$saved = get_option( 'veryo_settings', array() );
	if ( ! is_array( $saved ) ) {
		$saved = array();
	}
	return wp_parse_args( $saved, veryo_settings_defaults() );
}

/**
 * Eén instelling ophalen.
 *
 * @param string $key     Sleutel.
 * @param mixed  $fallback Terugvalwaarde.
 * @return mixed
 */
function veryo_setting( $key, $fallback = '' ) {
	$settings = veryo_settings();
	return array_key_exists( $key, $settings ) ? $settings[ $key ] : $fallback;
}

/**
 * Anthropic API-sleutel. De constante in wp-config.php heeft voorrang.
 *
 * @return string
 */
function veryo_api_key() {
	if ( defined( 'VERYO_ANTHROPIC_API_KEY' ) && is_string( VERYO_ANTHROPIC_API_KEY ) && '' !== VERYO_ANTHROPIC_API_KEY ) {
		return VERYO_ANTHROPIC_API_KEY;
	}
	return (string) veryo_setting( 'api_key', '' );
}

/**
 * Bedrijfsgegevens voor header, footer, schema en e-mail. Lege velden vallen weg.
 *
 * @return array<string,string>
 */
function veryo_company() {
	$s       = veryo_settings();
	$founder = trim( $s['founder_first'] . ' ' . $s['founder_last'] );
	$data    = array(
		'name'       => $s['company_name'] ? $s['company_name'] : 'Veryo',
		'street'     => $s['street'],
		'postcode'   => $s['postcode'],
		'city'       => $s['city'],
		'phone'      => $s['phone'],
		'email'      => $s['email'],
		'kvk'        => $s['kvk'],
		'btw'        => $s['btw'],
		'linkedin'   => $s['linkedin'],
		'instagram'  => $s['instagram'],
		'founder'    => $founder,
		'legal_name' => (string) $s['legal_name'],
	);
	return array_map( 'strval', $data );
}

/**
 * Telefoonnummer geschikt voor een tel:-link.
 *
 * @param string $phone Nummer zoals ingevuld.
 * @return string
 */
function veryo_tel_href( $phone ) {
	$clean = preg_replace( '/[^0-9+]/', '', $phone );
	return 'tel:' . $clean;
}

/**
 * Standaard merkomschrijving, overal gelijk (ook voor AI-zoekmachines).
 *
 * @return string
 */
function veryo_brand_line() {
	return __( 'Veryo, AI voor het MKB, uit Leeuwarden', 'veryo' );
}

/**
 * URL van een door het thema aangemaakte pagina op basis van het pad.
 *
 * @param string $path Pad zonder slashes, bv. "ai-training/ai-geletterdheid".
 * @return string
 */
function veryo_url( $path ) {
	$path = trim( $path, '/' );
	if ( '' === $path ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $path );
	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $path . '/' );
}

/**
 * Het officiële Veryo-logo, inline als SVG (geen los bestand dat de server moet leveren).
 * Is er onder Weergave > Customizer > Site-identiteit een eigen logo ingesteld, dan wordt
 * dat in de header gebruikt.
 *
 * @param string $variant 'default' (op licht) of 'wit' (op petrol).
 * @param int    $height  Hoogte in pixels.
 * @return string
 */
function veryo_logo_img( $variant = 'default', $height = 36 ) {
	if ( 'default' === $variant && has_custom_logo() ) {
		$logo_id = (int) get_theme_mod( 'custom_logo' );
		return (string) wp_get_attachment_image(
			$logo_id,
			'full',
			false,
			array(
				'class'   => 'veryo-logo-img',
				'alt'     => __( 'Veryo', 'veryo' ),
				'loading' => false,
			)
		);
	}
	$file = VERYO_DIR . '/assets/logo/' . ( 'wit' === $variant ? 'veryo-logo-wit.svg' : 'veryo-logo.svg' );
	$svg  = file_exists( $file ) ? (string) file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- lokaal themabestand.
	if ( '' === $svg ) {
		return esc_html__( 'Veryo', 'veryo' );
	}
	$width = (int) round( $height * 236.2 / 64 );
	$attrs = sprintf( '<svg class="veryo-logo-img" role="img" aria-label="%1$s" focusable="false" width="%2$d" height="%3$d"', esc_attr__( 'Veryo', 'veryo' ), $width, (int) $height );
	$svg   = preg_replace( '/<svg\b[^>]*?(viewBox="[^"]*")[^>]*>/', $attrs . ' $1 xmlns="http://www.w3.org/2000/svg">', $svg, 1 );
	return (string) $svg;
}

/**
 * Het grote decoratieve vinkje (petrol-deep) voor petrol vlakken.
 *
 * @return string
 */
function veryo_big_check_svg() {
	return '<svg class="veryo-bigcheck" viewBox="0 0 64 64" aria-hidden="true" focusable="false"><polyline points="18,23 29,45 47,16" fill="none" stroke="currentColor" stroke-width="7.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Lijnicoon (24px, lijndikte 1,75, ronde uiteinden), inline SVG.
 *
 * @param string $name Naam van het icoon.
 * @return string
 */
function veryo_icon( $name ) {
	$paths = array(
		'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'    => '<path d="M6 6l12 12M18 6L6 18"/>',
		'down'     => '<path d="M6 9l6 6 6-6"/>',
		'check'    => '<path d="M5 12.5l4.5 4.5L19 7"/>',
		'whatsapp' => '<path d="M3.5 20.5l1.3-4A8.5 8.5 0 1 1 8 19.3z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1.2-1.4-2-1-1 .8a4 4 0 01-2.1-2.1l.8-1-1-2z"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3.5 6.5l8.5 6.5 8.5-6.5"/>',
		'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z"/>',
		'pin'      => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0114 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="veryo-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}

/**
 * Toegestane HTML voor inline SVG-iconen in wp_kses.
 *
 * @return array<string,array<string,bool>>
 */
function veryo_svg_kses() {
	$common = array(
		'fill'            => true,
		'stroke'          => true,
		'stroke-width'    => true,
		'stroke-linecap'  => true,
		'stroke-linejoin' => true,
	);
	return array(
		'svg'      => array_merge(
			$common,
			array(
				'class'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'focusable'   => true,
			)
		),
		'path'     => array_merge( $common, array( 'd' => true ) ),
		'rect'     => array_merge(
			$common,
			array(
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'rx'     => true,
			)
		),
		'circle'   => array_merge(
			$common,
			array(
				'cx' => true,
				'cy' => true,
				'r'  => true,
			)
		),
		'polyline' => array_merge( $common, array( 'points' => true ) ),
	);
}

/**
 * Prijs in euro's netjes formatteren (Nederlandse notatie).
 *
 * @param int|float $amount Bedrag.
 * @return string
 */
function veryo_euro( $amount ) {
	return '€' . number_format( (float) $amount, 0, ',', '.' );
}

/**
 * IP-adres van de bezoeker, alleen gebruikt om gehasht te worden.
 *
 * @return string
 */
function veryo_client_ip() {
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	return filter_var( $ip, FILTER_VALIDATE_IP ) ? $ip : '0.0.0.0';
}

/**
 * Onleesbare hash van het IP-adres (met site-salt).
 *
 * @return string
 */
function veryo_ip_hash() {
	return hash_hmac( 'sha256', veryo_client_ip(), wp_salt( 'nonce' ) );
}

/**
 * Eenvoudige rate limiting per IP-hash via transients.
 *
 * @param string $bucket Naam van de teller.
 * @param int    $max    Maximaal aantal per uur.
 * @return bool True als de limiet is bereikt.
 */
function veryo_rate_limited( $bucket, $max = 5 ) {
	$key   = 'veryo_rl_' . $bucket . '_' . substr( veryo_ip_hash(), 0, 32 );
	$count = (int) get_transient( $key );
	if ( $count >= $max ) {
		return true;
	}
	set_transient( $key, $count + 1, HOUR_IN_SECONDS );
	return false;
}

/**
 * Het officiële woordmerk als inline SVG in currentColor (groot in de footer).
 *
 * @return string
 */
function veryo_wordmark_svg() {
	$file = VERYO_DIR . '/assets/logo/veryo-woordmerk.svg';
	$svg  = file_exists( $file ) ? (string) file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- lokaal themabestand.
	if ( '' === $svg ) {
		return '';
	}
	$svg = preg_replace( '/fill="#[0-9A-Fa-f]{3,6}"/', 'fill="currentColor"', $svg );
	return (string) preg_replace( '/<svg\b[^>]*?(viewBox="[^"]*")[^>]*>/', '<svg $1 xmlns="http://www.w3.org/2000/svg" focusable="false" preserveAspectRatio="xMinYMid meet">', $svg, 1 );
}
