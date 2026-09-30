<?php
/**
 * E-mails: rapport voor de invuller, interne meldingen en testmail.
 * HTML in huisstijl met tabel-layout en inline CSS, plus een platte-tekstversie.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * E-mail versturen met afzendernaam uit de instellingen en een platte-tekstalternatief.
 *
 * @param string $to       Ontvanger.
 * @param string $subject  Onderwerp.
 * @param string $html     HTML-versie.
 * @param string $text     Platte tekst.
 * @param string $reply_to Optioneel antwoordadres.
 * @return bool
 */
function veryo_send_mail( $to, $subject, $html, $text, $reply_to = '' ) {
	$from_name = (string) veryo_setting( 'mail_from_name', 'Veryo' );
	$name_cb   = static function () use ( $from_name ) {
		return $from_name ? $from_name : 'Veryo';
	};
	$alt_cb    = static function ( $phpmailer ) use ( $text ) {
		$phpmailer->AltBody = $text; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase -- PHPMailer-eigenschap.
	};
	$headers   = array( 'Content-Type: text/html; charset=UTF-8' );
	if ( $reply_to && is_email( $reply_to ) ) {
		$headers[] = 'Reply-To: ' . $reply_to;
	}
	add_filter( 'wp_mail_from_name', $name_cb );
	add_action( 'phpmailer_init', $alt_cb );
	$sent = wp_mail( $to, $subject, $html, $headers );
	remove_filter( 'wp_mail_from_name', $name_cb );
	remove_action( 'phpmailer_init', $alt_cb );
	return (bool) $sent;
}

/**
 * HTML-omlijsting voor e-mails.
 *
 * @param string $title Titel (voor <title> en preheader).
 * @param string $body  Inhoud (HTML-rijen).
 * @return string
 */
function veryo_mail_layout( $title, $body ) {
	$c        = veryo_company();
	$footer   = array();
	$footer[] = esc_html( $c['name'] ) . ( $c['city'] ? ' · ' . esc_html( $c['city'] ) : '' );
	if ( $c['email'] ) {
		$footer[] = '<a href="mailto:' . esc_attr( $c['email'] ) . '" style="color:#1D4B44">' . esc_html( $c['email'] ) . '</a>';
	}
	if ( $c['phone'] ) {
		$footer[] = esc_html( $c['phone'] );
	}
	if ( $c['kvk'] ) {
		$footer[] = 'KvK ' . esc_html( $c['kvk'] );
	}
	$privacy = veryo_url( 'privacyverklaring' );
	$icon    = VERYO_URI . '/assets/images/icon-512.png';

	return '<!doctype html><html lang="nl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>' . esc_html( $title ) . '</title></head>'
		. '<body style="margin:0;padding:0;background:#F3EFE6;color:#0F1F1C;font-family:\'Segoe UI\',Helvetica,Arial,sans-serif;font-size:16px;line-height:25px">'
		. '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#F3EFE6"><tr><td align="center" style="padding:24px 12px">'
		. '<table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:600px;background:#FFFFFF;border-radius:10px">'
		. '<tr><td style="background:#1D4B44;border-radius:10px 10px 0 0;padding:24px 32px"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr>'
		. '<td style="padding-right:12px"><img src="' . esc_url( $icon ) . '" width="36" height="36" alt="" style="display:block;border:0;border-radius:8px"></td>'
		. '<td style="color:#FFFFFF;font-size:22px;font-weight:700;letter-spacing:-0.01em">Veryo</td></tr></table></td></tr>'
		. $body
		. '<tr><td style="padding:24px 32px;border-top:1px solid #D9D2C3;color:#55635F;font-size:13px;line-height:20px">'
		. implode( ' · ', $footer ) . '<br>'
		. esc_html__( 'AI die echt werkt.', 'veryo' ) . ' <a href="' . esc_url( $privacy ) . '" style="color:#1D4B44">' . esc_html__( 'Privacyverklaring', 'veryo' ) . '</a>'
		. '</td></tr></table></td></tr></table></body></html>';
}

/**
 * Knop voor e-mails (amber, ink tekst).
 *
 * @param string $label Tekst.
 * @param string $url   Link.
 * @return string
 */
function veryo_mail_button( $label, $url ) {
	return '<table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr><td style="background:#E0A03A;border-radius:10px"><a href="' . esc_url( $url ) . '" style="display:inline-block;padding:14px 24px;color:#0F1F1C;font-weight:700;text-decoration:none">' . esc_html( $label ) . '</a></td></tr></table>';
}

/**
 * Rapport-e-mail naar de invuller.
 *
 * @param int $lead_id Lead.
 * @return bool
 */
function veryo_mail_report( $lead_id ) {
	$lead   = veryo_lead_get( $lead_id );
	$report = $lead['report'];
	$calc   = $lead['calc'];
	$email  = isset( $lead['contact']['email'] ) ? $lead['contact']['email'] : '';
	if ( ! is_email( $email ) || empty( $report['aanbevelingen'] ) ) {
		return false;
	}
	$name     = isset( $lead['contact']['voornaam'] ) ? $lead['contact']['voornaam'] : '';
	$phone    = ! empty( $lead['contact']['telefoon'] );
	$calendly = (string) veryo_setting( 'calendly_url', '' );
	$hours    = (int) $calc['besparing_uren_per_week'];

	/* translators: %d: uren per week. */
	$subject = sprintf( __( 'Je AI-scan: %d uur per week tijdwinst', 'veryo' ), $hours );
	$p       = 'margin:0 0 16px';
	$h2      = 'margin:0 0 8px;font-family:Georgia,\'Times New Roman\',serif;font-weight:500;font-size:24px;line-height:30px;color:#0F1F1C';

	$body = '<tr><td style="padding:32px 32px 8px">';
	/* translators: %s: voornaam. */
	$body .= '<p style="' . $p . '">' . esc_html( sprintf( __( 'Hoi %s,', 'veryo' ), $name ) ) . '</p>';
	$body .= '<p style="' . $p . '">' . esc_html__( 'Dank je voor het invullen van de AI-scan. Hieronder staat je persoonlijke rapport.', 'veryo' ) . '</p>';
	$body .= '</td></tr>';

	// Cijfers.
	$body .= '<tr><td style="padding:0 32px"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#DDE8E4;border-radius:10px"><tr><td style="padding:20px 24px">';
	$body .= '<p style="margin:0;font-size:13px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#1D4B44">' . esc_html__( 'Geschatte tijdwinst', 'veryo' ) . '</p>';
	/* translators: 1: uren, 2: euro. */
	$body .= '<p style="margin:4px 0 8px;font-family:Georgia,serif;font-size:30px;line-height:36px;color:#0F1F1C">' . esc_html( sprintf( __( '%1$d uur per week (±%2$s per jaar)', 'veryo' ), $hours, veryo_euro( $calc['besparing_euro_per_jaar'] ) ) ) . '</p>';
	/* translators: %d: score. */
	$body .= '<p style="margin:0 0 4px">' . esc_html( sprintf( __( 'Kansenscore: %d van 100', 'veryo' ), (int) $calc['kansenscore'] ) ) . '</p>';
	$body .= '<p style="margin:0;font-size:13px;color:#55635F">' . esc_html( veryo_scan_assumptions_text( $calc ) ) . '</p>';
	$body .= '</td></tr></table></td></tr>';

	// Samenvatting.
	$body .= '<tr><td style="padding:24px 32px 0"><h2 style="' . $h2 . '">' . esc_html__( 'Samenvatting', 'veryo' ) . '</h2><p style="' . $p . '">' . esc_html( $report['samenvatting'] ) . '</p></td></tr>';

	// Aanbevelingen.
	$body .= '<tr><td style="padding:8px 32px 0"><h2 style="' . $h2 . '">' . esc_html__( 'Je 3 grootste kansen', 'veryo' ) . '</h2></td></tr>';
	$n     = 0;
	foreach ( $report['aanbevelingen'] as $rec ) {
		++$n;
		$body .= '<tr><td style="padding:8px 32px"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D2C3;border-radius:10px"><tr><td style="padding:20px 24px">';
		$body .= '<p style="margin:0 0 8px;font-weight:700;font-size:18px;line-height:26px">' . (int) $n . '. ' . esc_html( $rec['titel'] ) . '</p>';
		$body .= '<p style="margin:0 0 8px"><strong>' . esc_html__( 'Waarom:', 'veryo' ) . '</strong> ' . esc_html( $rec['waarom'] ) . '</p>';
		$body .= '<p style="margin:0 0 8px"><strong>' . esc_html__( 'Hoe het werkt:', 'veryo' ) . '</strong> ' . esc_html( $rec['hoe'] ) . '</p>';
		$body .= '<p style="margin:0 0 8px"><strong>' . esc_html__( 'Eerste stap:', 'veryo' ) . '</strong> ' . esc_html( $rec['eerste_stap'] ) . '</p>';
		/* translators: 1: niveau, 2: prijs, 3: tijdwinst. */
		$body .= '<p style="margin:0;font-size:13px;color:#55635F">' . esc_html( sprintf( __( '%1$s · %2$s excl. btw · indicatie tijdwinst %3$s', 'veryo' ), $rec['niveau'], $rec['prijs'], $rec['tijd'] ) ) . '</p>';
		$body .= '</td></tr></table></td></tr>';
	}

	// Zelf beginnen en volgende stap.
	$body .= '<tr><td style="padding:24px 32px 0"><h2 style="' . $h2 . '">' . esc_html__( 'Hier kun je zelf mee beginnen', 'veryo' ) . '</h2><p style="' . $p . '">' . esc_html( $report['zelf_beginnen'] ) . '</p>';
	$body .= '<p style="' . $p . '">' . esc_html( $report['afsluiting'] ) . '</p></td></tr>';
	$body .= '<tr><td style="padding:8px 32px 8px"><h2 style="' . $h2 . '">' . esc_html__( 'Volgende stap', 'veryo' ) . '</h2>';
	if ( $calendly ) {
		$body .= veryo_mail_button( __( 'Plan een gesprek', 'veryo' ), $calendly ) . '<p style="margin:16px 0 0"></p>';
	}
	$body   .= '<p style="' . $p . '">' . esc_html( $phone ? __( 'We bellen je binnen één werkdag om het rapport kort door te lopen.', 'veryo' ) : __( 'Reageer op deze mail als je vragen hebt.', 'veryo' ) ) . '</p>';
	$body   .= '<p style="' . $p . '"><a href="' . esc_url( veryo_report_url( $lead['token'] ) ) . '" style="color:#1D4B44;font-weight:600">' . esc_html__( 'Bekijk je rapport online', 'veryo' ) . '</a></p>';
	$founder = veryo_company()['founder'];
	$body   .= '<p style="' . $p . '">' . esc_html__( 'Groet,', 'veryo' ) . '<br>' . esc_html( $founder ? $founder . ', Veryo' : 'Veryo' ) . '</p>';
	$body   .= '</td></tr>';

	$html = veryo_mail_layout( $subject, $body );
	$text = veryo_mail_report_text( $lead, $hours, $phone, $calendly );
	$c    = veryo_company();
	return veryo_send_mail( $email, $subject, $html, $text, $c['email'] );
}

/**
 * Platte-tekstversie van de rapportmail.
 *
 * @param array<string,mixed> $lead     Lead.
 * @param int                 $hours    Uren per week.
 * @param bool                $phone    Telefoon ingevuld.
 * @param string              $calendly Afspraaklink.
 * @return string
 */
function veryo_mail_report_text( $lead, $hours, $phone, $calendly ) {
	$r     = $lead['report'];
	$calc  = $lead['calc'];
	$lines = array();
	/* translators: %s: voornaam. */
	$lines[] = sprintf( __( 'Hoi %s,', 'veryo' ), isset( $lead['contact']['voornaam'] ) ? $lead['contact']['voornaam'] : '' );
	$lines[] = '';
	$lines[] = __( 'Dank je voor het invullen van de AI-scan. Hieronder staat je persoonlijke rapport.', 'veryo' );
	$lines[] = '';
	/* translators: 1: uren, 2: euro. */
	$lines[] = sprintf( __( 'Geschatte tijdwinst: %1$d uur per week (±%2$s per jaar)', 'veryo' ), $hours, veryo_euro( $calc['besparing_euro_per_jaar'] ) );
	/* translators: %d: score. */
	$lines[] = sprintf( __( 'Kansenscore: %d van 100', 'veryo' ), (int) $calc['kansenscore'] );
	$lines[] = veryo_scan_assumptions_text( $calc );
	$lines[] = '';
	$lines[] = strtoupper( __( 'Samenvatting', 'veryo' ) );
	$lines[] = $r['samenvatting'];
	$lines[] = '';
	$lines[] = strtoupper( __( 'Je 3 grootste kansen', 'veryo' ) );
	$n       = 0;
	foreach ( $r['aanbevelingen'] as $rec ) {
		++$n;
		$lines[] = '';
		$lines[] = $n . '. ' . $rec['titel'];
		$lines[] = __( 'Waarom:', 'veryo' ) . ' ' . $rec['waarom'];
		$lines[] = __( 'Hoe het werkt:', 'veryo' ) . ' ' . $rec['hoe'];
		$lines[] = __( 'Eerste stap:', 'veryo' ) . ' ' . $rec['eerste_stap'];
		/* translators: 1: niveau, 2: prijs, 3: tijdwinst. */
		$lines[] = sprintf( __( '%1$s · %2$s excl. btw · indicatie tijdwinst %3$s', 'veryo' ), $rec['niveau'], $rec['prijs'], $rec['tijd'] );
	}
	$lines[] = '';
	$lines[] = strtoupper( __( 'Hier kun je zelf mee beginnen', 'veryo' ) );
	$lines[] = $r['zelf_beginnen'];
	$lines[] = '';
	$lines[] = $r['afsluiting'];
	$lines[] = '';
	if ( $calendly ) {
		$lines[] = __( 'Plan een gesprek:', 'veryo' ) . ' ' . $calendly;
	}
	$lines[] = $phone ? __( 'We bellen je binnen één werkdag om het rapport kort door te lopen.', 'veryo' ) : __( 'Reageer op deze mail als je vragen hebt.', 'veryo' );
	$lines[] = __( 'Bekijk je rapport online:', 'veryo' ) . ' ' . veryo_report_url( $lead['token'] );
	$lines[] = '';
	$lines[] = '--';
	$lines[] = veryo_company()['name'] . ' · ' . __( 'AI die echt werkt.', 'veryo' );
	$lines[] = __( 'Privacyverklaring:', 'veryo' ) . ' ' . veryo_url( 'privacyverklaring' );
	return implode( "\n", $lines );
}

/**
 * Adres voor interne meldingen.
 *
 * @return string
 */
function veryo_internal_email() {
	$to = (string) veryo_setting( 'lead_email', '' );
	return is_email( $to ) ? $to : (string) get_option( 'admin_email' );
}

/**
 * Interne melding bij een nieuwe AI-scan.
 *
 * @param int $lead_id Lead.
 * @return bool
 */
function veryo_mail_internal_scan( $lead_id ) {
	$lead    = veryo_lead_get( $lead_id );
	$c       = $lead['contact'];
	$calc    = $lead['calc'];
	$temp    = $lead['temp'];
	$subject = sprintf( '[%s] %s: %s (%d u/wk)', strtoupper( $temp ), __( 'Nieuwe AI-scan', 'veryo' ), $c['bedrijf'], (int) $calc['besparing_uren_per_week'] );
	$rows    = array(
		__( 'Voornaam', 'veryo' )    => $c['voornaam'],
		__( 'Bedrijf', 'veryo' )     => $c['bedrijf'],
		__( 'E-mail', 'veryo' )      => $c['email'],
		__( 'Telefoon', 'veryo' )    => $c['telefoon'] ? $c['telefoon'] : __( '(niet ingevuld)', 'veryo' ),
		__( 'Temperatuur', 'veryo' ) => veryo_temp_label( $temp ),
		__( 'Tijdwinst', 'veryo' )   => sprintf( '%d u/wk · %s per jaar', (int) $calc['besparing_uren_per_week'], veryo_euro( $calc['besparing_euro_per_jaar'] ) ),
		__( 'Kansenscore', 'veryo' ) => (string) $calc['kansenscore'],
	);
	$rows    = array_merge( $rows, veryo_answers_readable( $lead['answers'] ) );
	$admin   = admin_url( 'post.php?post=' . $lead_id . '&action=edit' );
	$call    = in_array( $temp, array( 'heet', 'warm' ), true );

	$html = '<tr><td style="padding:24px 32px">';
	if ( $call ) {
		$html .= '<p style="margin:0 0 16px;font-weight:700;color:#B3261E">' . esc_html__( 'Bel binnen 24 uur', 'veryo' ) . '</p>';
	}
	$html .= '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">';
	foreach ( $rows as $label => $value ) {
		$html .= '<tr><td style="padding:4px 12px 4px 0;vertical-align:top;color:#55635F;width:38%">' . esc_html( $label ) . '</td><td style="padding:4px 0;vertical-align:top">' . nl2br( esc_html( (string) $value ) ) . '</td></tr>';
	}
	$html .= '</table><p style="margin:16px 0 0"><a href="' . esc_url( $admin ) . '" style="color:#1D4B44;font-weight:600">' . esc_html__( 'Open de lead in WordPress', 'veryo' ) . '</a></p></td></tr>';

	$text = ( $call ? __( 'Bel binnen 24 uur', 'veryo' ) . "\n\n" : '' );
	foreach ( $rows as $label => $value ) {
		$text .= $label . ': ' . $value . "\n";
	}
	$text .= "\n" . __( 'Lead in WordPress:', 'veryo' ) . ' ' . $admin . "\n";

	return veryo_send_mail( veryo_internal_email(), $subject, veryo_mail_layout( $subject, $html ), $text, $c['email'] );
}

/**
 * Interne melding bij contactformulier of wachtlijst.
 *
 * @param int $lead_id Lead.
 * @return bool
 */
function veryo_mail_internal_form( $lead_id ) {
	$lead    = veryo_lead_get( $lead_id );
	$c       = $lead['contact'];
	$sources = veryo_lead_sources();
	$label   = isset( $sources[ $lead['source'] ] ) ? $sources[ $lead['source'] ] : $lead['source'];
	$who     = trim( ( isset( $c['bedrijf'] ) ? $c['bedrijf'] . ' – ' : '' ) . ( isset( $c['naam'] ) ? $c['naam'] : '' ), ' –' );
	$subject = sprintf( '[%s] %s', $label, $who );
	$labels  = array(
		'naam'     => __( 'Naam', 'veryo' ),
		'bedrijf'  => __( 'Bedrijf', 'veryo' ),
		'email'    => __( 'E-mail', 'veryo' ),
		'telefoon' => __( 'Telefoon', 'veryo' ),
		'bericht'  => __( 'Bericht', 'veryo' ),
	);
	$admin   = admin_url( 'post.php?post=' . $lead_id . '&action=edit' );
	$html    = '<tr><td style="padding:24px 32px"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">';
	$text    = '';
	foreach ( $labels as $key => $name ) {
		if ( empty( $c[ $key ] ) ) {
			continue;
		}
		$html .= '<tr><td style="padding:4px 12px 4px 0;vertical-align:top;color:#55635F;width:30%">' . esc_html( $name ) . '</td><td style="padding:4px 0">' . nl2br( esc_html( $c[ $key ] ) ) . '</td></tr>';
		$text .= $name . ': ' . $c[ $key ] . "\n";
	}
	$html .= '</table><p style="margin:16px 0 0"><a href="' . esc_url( $admin ) . '" style="color:#1D4B44;font-weight:600">' . esc_html__( 'Open in WordPress', 'veryo' ) . '</a></p></td></tr>';
	$text .= "\n" . $admin . "\n";
	return veryo_send_mail( veryo_internal_email(), $subject, veryo_mail_layout( $subject, $html ), $text, $c['email'] );
}

/**
 * Testmail (knop in de instellingen).
 *
 * @param string $to Ontvanger.
 * @return bool
 */
function veryo_mail_test( $to ) {
	$subject = __( 'Testmail van je Veryo-website', 'veryo' );
	$html    = '<tr><td style="padding:32px"><p style="margin:0 0 16px">' . esc_html__( 'Deze testmail laat zien dat je website e-mail kan versturen. Komt hij in je map met ongewenste mail terecht? Installeer dan een SMTP-plugin, zoals beschreven in README-INSTALL.md.', 'veryo' ) . '</p>'
		. veryo_mail_button( __( 'Naar de website', 'veryo' ), home_url( '/' ) ) . '</td></tr>';
	$text    = __( 'Deze testmail laat zien dat je website e-mail kan versturen.', 'veryo' ) . "\n" . home_url( '/' );
	return veryo_send_mail( $to, $subject, veryo_mail_layout( $subject, $html ), $text );
}
