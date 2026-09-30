<?php
/**
 * Draai met: wp eval-file tools/test-scan.php
 * Test de AI-scan: payload zonder persoonsgegevens, ongeldige sleutel (fallback + log zonder sleutel),
 * honeypot, validatie en rate limiting.
 */
$fail = 0; $ok = 0;
$check = function ( $cond, $msg ) use ( &$fail, &$ok ) { if ( $cond ) { $ok++; echo "ok   $msg\n"; } else { $fail++; echo "FOUT $msg\n"; } };

$body = array(
	'branche' => 'bouw', 'team' => '2-5', 'taken' => array( 'administratie', 'planning' ),
	'uren' => array( 'administratie' => 6, 'planning' => 4, 'content' => 30 ), 'tools' => array( 'moneybird' ),
	'ai_gebruik' => 'paar', 'frustratie' => 'Mail piet@klant.nl of bel 0612345678 als het niet lukt.', 'timing' => '3-maanden',
	'voornaam' => 'Piet', 'bedrijf' => 'Bouwbedrijf Geheim', 'email' => 'piet@geheim-bouw.nl', 'telefoon' => '058 1234567', 'toestemming' => true,
);
$send = function ( $data ) {
	$req = new WP_REST_Request( 'POST', '/veryo/v1/scan' );
	$req->set_header( 'content-type', 'application/json' );
	$req->set_header( 'X-WP-Nonce', wp_create_nonce( 'wp_rest' ) );
	$req->set_body( wp_json_encode( $data ) );
	return rest_do_request( $req );
};
// Schone rate limit.
delete_transient( 'veryo_rl_scan_' . substr( veryo_ip_hash(), 0, 32 ) );

// 1. Zonder nonce geweigerd.
$req = new WP_REST_Request( 'POST', '/veryo/v1/scan' );
$req->set_body( wp_json_encode( $body ) );
$check( 403 === rest_do_request( $req )->get_status(), 'zonder nonce: 403' );

// 2. Validatie.
$bad = $body; $bad['email'] = 'geen-mail'; $bad['taken'] = array( 'onzin' ); unset( $bad['toestemming'] );
$r = $send( $bad );
$errors = $r->get_data()['data']['errors'] ?? array();
$check( 400 === $r->get_status() && isset( $errors['email'], $errors['taken'], $errors['toestemming'] ), 'validatiefouten: ' . implode( ',', array_keys( $errors ) ) );

// 3. Honeypot: geen lead.
$count = (int) wp_count_posts( 'veryo_lead' )->publish;
$hp = $body; $hp['website'] = 'http://spam';
$r = $send( $hp );
$check( 200 === $r->get_status() && (int) wp_count_posts( 'veryo_lead' )->publish === $count, 'honeypot: 200 maar geen lead' );

// 4. Ongeldige API-sleutel.
$settings = get_option( 'veryo_settings', array() );
$settings['api_key'] = 'sk-ant-api03-ONGELDIGE-TESTSLEUTEL-1234';
update_option( 'veryo_settings', $settings );
$r = $send( $body );
$data = $r->get_data();
$check( 200 === $r->get_status() && 4 === $data['uren'], 'geldige inzending, uren = 4 (6×0,5 + 4×0,3 = 4,2): ' . $data['uren'] );
$check( '€8.300' === $data['euro'], 'euro = 4×46×45 = 8.280 → €8.300: ' . $data['euro'] );
$check( 40 === $data['score'], 'score = 20 + 5×4 + 0 + 0 = 40: ' . $data['score'] );
$ids  = get_posts( array( 'post_type' => 'veryo_lead', 'posts_per_page' => 1, 'fields' => 'ids' ) );
$lead = $ids[0];
$check( 'warm' === get_post_meta( $lead, '_veryo_temp', true ), 'temperatuur warm (3 maanden)' );
$check( ! isset( veryo_lead_get( $lead )['answers']['uren']['content'] ), 'uren voor niet-gekozen taak genegeerd' );
$check( 32 === strlen( get_post_meta( $lead, '_veryo_token', true ) ), 'token van 32 tekens' );
$check( 64 === strlen( get_post_meta( $lead, '_veryo_ip_hash', true ) ), 'IP gehasht opgeslagen' );

veryo_scan_process_report( $lead, true );
$l   = veryo_lead_get( $lead );
$log = wp_json_encode( $l['log'] );
echo "     log: $log\n";
$check( 'fallback' === get_post_meta( $lead, '_veryo_report_source', true ), 'ongeldige sleutel: regelgebaseerd rapport' );
$check( false !== strpos( $log, 'API-fout 401' ), 'fout gelogd (401)' );
$check( false === strpos( $log, 'ONGELDIGE-TESTSLEUTEL' ), 'sleutel staat niet in het log' );
$check( 3 === count( $l['report']['aanbevelingen'] ), '3 aanbevelingen' );
foreach ( $l['report']['aanbevelingen'] as $rec ) {
	$check( null !== veryo_catalog_item( $rec['catalogus_id'] ) && '' !== $rec['prijs'], 'aanbeveling uit catalogus: ' . $rec['catalogus_id'] . ' (' . $rec['niveau'] . ', ' . $rec['prijs'] . ')' );
}
$check( (bool) $l['report_sent'], 'rapportmail verstuurd' );

// 5. Payload bevat geen persoonsgegevens.
$payload = wp_json_encode( veryo_scan_ai_payload( $l['answers'], $l['calc'] ), JSON_UNESCAPED_UNICODE );
foreach ( array( 'Piet', 'Bouwbedrijf Geheim', 'piet@geheim-bouw.nl', '058 1234567', 'piet@klant.nl', '0612345678' ) as $pii ) {
	$check( false === stripos( $payload, $pii ), "payload bevat geen '$pii'" );
}
$check( false !== strpos( $payload, '[e-mailadres verwijderd]' ) && false !== strpos( $payload, '[nummer verwijderd]' ), 'PII uit frustratietekst gefilterd' );
$check( false !== strpos( $payload, 'Bouw en aannemerij' ) && false !== strpos( $payload, 'offerte-generator' ), 'payload bevat antwoorden en catalogus' );

// 6. Normalisatie van een (nep)modelantwoord met ongeldige en dubbele ID's.
$fake = "```json\n" . wp_json_encode( array(
	'samenvatting' => 'Test.',
	'aanbevelingen' => array(
		array( 'catalogus_id' => 'bestaat-niet', 'titel' => 'x', 'waarom' => 'x', 'hoe' => 'x', 'eerste_stap' => 'x' ),
		array( 'catalogus_id' => 'inkoopfacturen', 'titel' => 'A', 'waarom' => 'w', 'hoe' => 'h', 'eerste_stap' => 'e' ),
		array( 'catalogus_id' => 'inkoopfacturen', 'titel' => 'B', 'waarom' => 'w', 'hoe' => 'h', 'eerste_stap' => 'e' ),
	),
	'zelf_beginnen' => 'Z', 'afsluiting' => 'A',
) ) . "\n```";
$n = veryo_scan_normalize_report( veryo_parse_model_json( $fake ), $l['answers'], $l['calc'] );
$idsr = wp_list_pluck( $n['report']['aanbevelingen'], 'catalogus_id' );
$check( 3 === count( array_unique( $idsr ) ) && 'inkoopfacturen' === $idsr[0] && 2 === $n['replaced'], 'fences gestript, ongeldig/dubbel vervangen: ' . implode( ',', $idsr ) );

// 7. Rate limiting: na 5 inzendingen per uur 429.
delete_transient( 'veryo_rl_scan_' . substr( veryo_ip_hash(), 0, 32 ) );
$statuses = array();
for ( $i = 0; $i < 6; $i++ ) { $statuses[] = $send( $body )->get_status(); }
$check( array( 200, 200, 200, 200, 200, 429 ) === $statuses, 'rate limit: ' . implode( ',', $statuses ) );

// 8. Privacy-exporter en -eraser.
$exp = veryo_privacy_exporter( 'piet@geheim-bouw.nl', 1 );
$check( count( $exp['data'] ) >= 1, 'exporter vindt ' . count( $exp['data'] ) . ' lead(s)' );
$before = count( veryo_leads_by_email( 'piet@geheim-bouw.nl' ) );
veryo_privacy_eraser( 'piet@geheim-bouw.nl', 1 );
$check( 0 === count( veryo_leads_by_email( 'piet@geheim-bouw.nl' ) ), "eraser verwijdert $before lead(s)" );

// 9. Opschonen na bewaartermijn.
$old = veryo_lead_create( 'contact', array( 'naam' => 'Oud', 'email' => 'oud@example.com' ) );
wp_update_post( array( 'ID' => $old, 'post_date' => '2020-01-01 10:00:00', 'post_date_gmt' => '2020-01-01 09:00:00' ) );
veryo_cleanup_leads();
$check( null === get_post( $old ), 'lead ouder dan bewaartermijn verwijderd' );

$settings['api_key'] = '';
update_option( 'veryo_settings', $settings );
echo "\nResultaat: $ok ok, $fail fout\n";
