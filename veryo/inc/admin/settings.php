<?php
/**
 * Instellingen > Veryo: bedrijfsgegevens, AI-scan en weergave, met testknoppen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Optie aanmaken zonder autoload (bevat de API-sleutel).
 */
function veryo_ensure_settings_option() {
	if ( false === get_option( 'veryo_settings', false ) ) {
		add_option( 'veryo_settings', array(), '', false );
	}
}
add_action( 'admin_init', 'veryo_ensure_settings_option', 1 );
add_action( 'after_switch_theme', 'veryo_ensure_settings_option', 1 );

/**
 * Menu-item.
 */
function veryo_settings_menu() {
	add_options_page( __( 'Veryo', 'veryo' ), __( 'Veryo', 'veryo' ), 'manage_options', 'veryo', 'veryo_settings_page' );
}
add_action( 'admin_menu', 'veryo_settings_menu' );

/**
 * Definitie van alle velden per sectie.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_settings_fields() {
	return array(
		'company' => array(
			'title'  => __( 'Bedrijfsgegevens', 'veryo' ),
			'intro'  => __( 'Deze gegevens verschijnen in de header, footer, contactpagina, schema.org en e-mails. Een leeg veld wordt nergens getoond.', 'veryo' ),
			'fields' => array(
				'company_name'  => array( 'text', __( 'Bedrijfsnaam', 'veryo' ), __( 'Altijd "Veryo", tenzij je handelsnaam anders is.', 'veryo' ) ),
				'street'        => array( 'text', __( 'Straat en huisnummer', 'veryo' ), '' ),
				'postcode'      => array( 'text', __( 'Postcode', 'veryo' ), '' ),
				'city'          => array( 'text', __( 'Plaats', 'veryo' ), '' ),
				'phone'         => array( 'text', __( 'Telefoon', 'veryo' ), __( 'Zoals je hem wilt tonen, bv. 06 12 34 56 78.', 'veryo' ) ),
				'email'         => array( 'email', __( 'E-mailadres', 'veryo' ), __( 'Het openbare adres, bv. hallo@jouwdomein.nl. Wordt ook als antwoordadres voor rapportmails gebruikt.', 'veryo' ) ),
				'kvk'           => array( 'text', __( 'KvK-nummer', 'veryo' ), '' ),
				'btw'           => array( 'text', __( 'Btw-nummer', 'veryo' ), '' ),
				'linkedin'      => array( 'url', __( 'LinkedIn-URL', 'veryo' ), '' ),
				'instagram'     => array( 'url', __( 'Instagram-URL', 'veryo' ), '' ),
				'founder_first' => array( 'text', __( 'Voornaam oprichter', 'veryo' ), __( 'Wordt als auteur van blogberichten en onder e-mails gebruikt.', 'veryo' ) ),
				'founder_last'  => array( 'text', __( 'Achternaam oprichter', 'veryo' ), '' ),
			),
		),
		'scan'    => array(
			'title'  => __( 'AI-scan', 'veryo' ),
			'intro'  => __( 'Instellingen voor de gratis AI-scan, het rapport en de opvolging.', 'veryo' ),
			'fields' => array(
				'api_key'          => array( 'secret', __( 'Anthropic API-sleutel', 'veryo' ), __( 'Bij voorkeur in wp-config.php met define( \'VERYO_ANTHROPIC_API_KEY\', \'...\' ); die heeft voorrang. Zonder sleutel wordt een regelgebaseerd rapport verstuurd.', 'veryo' ) ),
				'model'            => array( 'text', __( 'Model', 'veryo' ), __( 'Standaard claude-sonnet-5-5. Vul een geldige model-ID van Anthropic in.', 'veryo' ) ),
				'hourly_cost'      => array( 'number', __( 'Kostprijs per uur (€)', 'veryo' ), __( 'Gebruikt om de tijdwinst in euro’s om te rekenen. Standaard €45.', 'veryo' ) ),
				'work_weeks'       => array( 'number', __( 'Werkweken per jaar', 'veryo' ), __( 'Standaard 46.', 'veryo' ) ),
				'lead_email'       => array( 'email', __( 'E-mail voor interne leadmeldingen', 'veryo' ), __( 'Hier komt de melding "[HEET] Nieuwe AI-scan: …" binnen.', 'veryo' ) ),
				'calendly_url'     => array( 'url', __( 'Calendly- of afspraaklink', 'veryo' ), __( 'Leeg = de knop "Plan een gesprek" wordt niet getoond.', 'veryo' ) ),
				'make_webhook'     => array( 'url', __( 'Make-webhook-URL (optioneel)', 'veryo' ), __( 'Elke nieuwe lead wordt als JSON naar deze URL gestuurd, bijvoorbeeld om een taak in ClickUp of Notion te maken.', 'veryo' ) ),
				'retention_months' => array( 'number', __( 'Bewaartermijn leads (maanden)', 'veryo' ), __( 'Oudere leads worden dagelijks automatisch verwijderd. Standaard 24.', 'veryo' ) ),
				'mail_from_name'   => array( 'text', __( 'Afzendernaam e-mails', 'veryo' ), __( 'Standaard "Veryo".', 'veryo' ) ),
			),
		),
		'display' => array(
			'title'  => __( 'Weergave', 'veryo' ),
			'intro'  => '',
			'fields' => array(
				'show_cases'       => array( 'checkbox', __( 'Toon cases en reviews', 'veryo' ), __( 'Zet dit pas aan als de [VUL IN]-blokken met echte cases en reviews zijn gevuld.', 'veryo' ) ),
				'academy_waitlist' => array( 'checkbox', __( 'Toon Academy als "binnenkort/wachtlijst"', 'veryo' ), __( 'De Academy-pagina toont het wachtlijstformulier.', 'veryo' ) ),
			),
		),
	);
}

/**
 * Setting registreren.
 */
function veryo_register_settings() {
	register_setting(
		'veryo_settings_group',
		'veryo_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'veryo_sanitize_settings',
			'show_in_rest'      => false,
			'default'           => array(),
		)
	);
}
add_action( 'admin_init', 'veryo_register_settings' );

/**
 * Instellingen saniteren.
 *
 * @param mixed $input Invoer.
 * @return array<string,mixed>
 */
function veryo_sanitize_settings( $input ) {
	$input   = is_array( $input ) ? $input : array();
	$current = get_option( 'veryo_settings', array() );
	$current = is_array( $current ) ? $current : array();
	$out     = array();

	foreach ( veryo_settings_fields() as $section ) {
		foreach ( $section['fields'] as $key => $field ) {
			$type  = $field[0];
			$value = isset( $input[ $key ] ) ? wp_unslash( $input[ $key ] ) : '';
			switch ( $type ) {
				case 'email':
					$out[ $key ] = sanitize_email( (string) $value );
					break;
				case 'url':
					$out[ $key ] = esc_url_raw( trim( (string) $value ), array( 'https', 'http' ) );
					break;
				case 'number':
					$out[ $key ] = '' === $value ? veryo_settings_defaults()[ $key ] : absint( $value );
					break;
				case 'checkbox':
					$out[ $key ] = empty( $value ) ? 0 : 1;
					break;
				case 'secret':
					if ( ! empty( $input['api_key_remove'] ) ) {
						$out[ $key ] = '';
					} elseif ( '' !== trim( (string) $value ) ) {
						$out[ $key ] = sanitize_text_field( (string) $value );
					} else {
						$out[ $key ] = isset( $current[ $key ] ) ? $current[ $key ] : '';
					}
					break;
				default:
					$out[ $key ] = sanitize_text_field( (string) $value );
			}
		}
	}
	$out['work_weeks']       = max( 1, min( 52, (int) $out['work_weeks'] ) );
	$out['retention_months'] = max( 1, min( 120, (int) $out['retention_months'] ) );
	if ( '' === $out['model'] ) {
		$out['model'] = 'claude-sonnet-5-5';
	}
	if ( '' !== $out['make_webhook'] && 0 !== strpos( $out['make_webhook'], 'https://' ) ) {
		add_settings_error( 'veryo_settings', 'veryo_webhook', __( 'De webhook-URL moet met https:// beginnen.', 'veryo' ) );
		$out['make_webhook'] = '';
	}
	return $out;
}

/**
 * Veld tonen.
 *
 * @param string              $key      Sleutel.
 * @param array<int,string>   $field    Veld: type, label, uitleg.
 * @param array<string,mixed> $settings Huidige instellingen.
 */
function veryo_render_setting_field( $key, $field, $settings ) {
	list( $type, $label, $help ) = $field;
	$name                        = 'veryo_settings[' . $key . ']';
	$id                          = 'veryo_' . $key;
	$value                       = isset( $settings[ $key ] ) ? $settings[ $key ] : '';
	echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label></th><td>';
	switch ( $type ) {
		case 'checkbox':
			echo '<input type="hidden" name="' . esc_attr( $name ) . '" value="0">';
			echo '<label><input type="checkbox" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="1" ' . checked( (int) $value, 1, false ) . '> ' . esc_html__( 'Aan', 'veryo' ) . '</label>';
			break;
		case 'secret':
			$constant = defined( 'VERYO_ANTHROPIC_API_KEY' ) && VERYO_ANTHROPIC_API_KEY;
			$masked   = '';
			$key_val  = $constant ? (string) VERYO_ANTHROPIC_API_KEY : (string) $value;
			if ( '' !== $key_val ) {
				$masked = '••••' . substr( $key_val, -4 );
			}
			echo '<input type="password" class="regular-text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="" autocomplete="new-password" placeholder="' . esc_attr( $masked ) . '"' . ( $constant ? ' disabled' : '' ) . '>';
			if ( $constant ) {
				echo '<p class="description"><strong>' . esc_html__( 'De sleutel staat in wp-config.php (VERYO_ANTHROPIC_API_KEY) en heeft voorrang. Dit veld is uitgeschakeld.', 'veryo' ) . '</strong></p>';
			} elseif ( '' !== $masked ) {
				echo '<p class="description">' . esc_html__( 'Laat leeg om de huidige sleutel te houden.', 'veryo' ) . ' <label><input type="checkbox" name="veryo_settings[api_key_remove]" value="1"> ' . esc_html__( 'Sleutel verwijderen', 'veryo' ) . '</label></p>';
			}
			break;
		case 'number':
			echo '<input type="number" min="0" step="1" class="small-text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '">';
			break;
		default:
			$input_type = in_array( $type, array( 'email', 'url' ), true ) ? $type : 'text';
			echo '<input type="' . esc_attr( $input_type ) . '" class="regular-text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '">';
	}
	if ( $help ) {
		echo '<p class="description">' . esc_html( $help ) . '</p>';
	}
	echo '</td></tr>';
}

/**
 * De instellingenpagina.
 */
function veryo_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$settings = veryo_settings();
	$result   = get_transient( 'veryo_test_result_' . get_current_user_id() );
	if ( $result ) {
		delete_transient( 'veryo_test_result_' . get_current_user_id() );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Veryo-instellingen', 'veryo' ); ?></h1>
		<?php if ( is_array( $result ) ) : ?>
			<div class="notice notice-<?php echo $result['ok'] ? 'success' : 'error'; ?> is-dismissible"><p><?php echo esc_html( $result['message'] ); ?></p></div>
		<?php endif; ?>
		<?php settings_errors( 'veryo_settings' ); ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'veryo_settings_group' ); ?>
			<?php foreach ( veryo_settings_fields() as $section ) : ?>
				<h2><?php echo esc_html( $section['title'] ); ?></h2>
				<?php if ( $section['intro'] ) : ?>
					<p><?php echo esc_html( $section['intro'] ); ?></p>
				<?php endif; ?>
				<table class="form-table" role="presentation">
					<?php
					foreach ( $section['fields'] as $key => $field ) {
						veryo_render_setting_field( $key, $field, $settings );
					}
					?>
				</table>
			<?php endforeach; ?>
			<?php submit_button( __( 'Instellingen opslaan', 'veryo' ) ); ?>
		</form>

		<h2><?php esc_html_e( 'Testen', 'veryo' ); ?></h2>
		<p><?php esc_html_e( 'Sla eerst je instellingen op.', 'veryo' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline-block;margin-right:12px">
			<input type="hidden" name="action" value="veryo_test_api">
			<?php wp_nonce_field( 'veryo_test_api' ); ?>
			<?php submit_button( __( 'Test API-verbinding', 'veryo' ), 'secondary', 'submit', false ); ?>
		</form>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline-block">
			<input type="hidden" name="action" value="veryo_test_mail">
			<?php wp_nonce_field( 'veryo_test_mail' ); ?>
			<?php submit_button( __( 'Test e-mail versturen', 'veryo' ), 'secondary', 'submit', false ); ?>
			<span class="description">
				<?php
				/* translators: %s: e-mailadres. */
				echo esc_html( sprintf( __( 'Naar %s', 'veryo' ), veryo_internal_email() ) );
				?>
			</span>
		</form>

		<h2><?php esc_html_e( 'Berekening van de AI-scan', 'veryo' ); ?></h2>
		<p><?php esc_html_e( 'Besparing (uren/week) = Σ (uren per taak × factor), afgerond. Euro’s per jaar = uren × werkweken × kostprijs per uur, afgerond op €100. De factoren pas je aan met het filter veryo_scan_factors (zie README-INSTALL.md).', 'veryo' ); ?></p>
		<table class="widefat striped" style="max-width:520px">
			<thead><tr><th><?php esc_html_e( 'Taak', 'veryo' ); ?></th><th><?php esc_html_e( 'Factor', 'veryo' ); ?></th></tr></thead>
			<tbody>
				<?php
				$veryo_tasks = veryo_scan_tasks();
				foreach ( veryo_scan_factors() as $veryo_task => $veryo_factor ) :
					?>
					<tr><td><?php echo esc_html( $veryo_tasks[ $veryo_task ] ); ?></td><td><?php echo esc_html( number_format_i18n( $veryo_factor, 2 ) ); ?></td></tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * Knop: API-verbinding testen.
 */
function veryo_handle_test_api() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_test_api' );
	set_transient( 'veryo_test_result_' . get_current_user_id(), veryo_api_test(), MINUTE_IN_SECONDS );
	wp_safe_redirect( admin_url( 'options-general.php?page=veryo' ) );
	exit;
}
add_action( 'admin_post_veryo_test_api', 'veryo_handle_test_api' );

/**
 * Knop: testmail versturen.
 */
function veryo_handle_test_mail() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_test_mail' );
	$to = veryo_internal_email();
	$ok = veryo_mail_test( $to );
	set_transient(
		'veryo_test_result_' . get_current_user_id(),
		array(
			'ok'      => $ok,
			/* translators: %s: e-mailadres. */
			'message' => $ok ? sprintf( __( 'Testmail verstuurd naar %s. Kijk ook in je map met ongewenste mail.', 'veryo' ), $to ) : __( 'De testmail kon niet worden verstuurd. Installeer een SMTP-plugin (zie README-INSTALL.md).', 'veryo' ),
		),
		MINUTE_IN_SECONDS
	);
	wp_safe_redirect( admin_url( 'options-general.php?page=veryo' ) );
	exit;
}
add_action( 'admin_post_veryo_test_mail', 'veryo_handle_test_mail' );
