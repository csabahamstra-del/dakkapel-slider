<?php
/**
 * Rapport van de AI-scan: payload zonder persoonsgegevens, aanroep van de Anthropic API,
 * robuuste verwerking van het antwoord, regelgebaseerde fallback en de verzending.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

add_action( 'veryo_generate_report', 'veryo_cron_generate_report' );

/**
 * Cron-callback.
 *
 * @param int $lead_id Lead.
 */
function veryo_cron_generate_report( $lead_id ) {
	veryo_scan_process_report( (int) $lead_id, false );
}

/**
 * E-mailadressen en telefoonnummers uit vrije tekst halen, voor het naar de API gaat.
 *
 * @param string $text Tekst.
 * @return string
 */
function veryo_scrub_pii( $text ) {
	$text = preg_replace( '/[A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,}/iu', '[e-mailadres verwijderd]', (string) $text );
	$text = preg_replace( '/(?:\+|00)?\d[\d\s\-().]{7,}\d/u', '[nummer verwijderd]', (string) $text );
	return (string) $text;
}

/**
 * De gegevens die naar de AI-dienst gaan. Bewust alleen antwoorden en cijfers:
 * NOOIT naam, bedrijfsnaam, e-mail of telefoon. Deze functie krijgt contactgegevens
 * daarom ook niet als invoer.
 *
 * @param array<string,mixed> $answers Antwoorden uit de scan (zonder contactgegevens).
 * @param array<string,mixed> $calc    Berekening.
 * @return array<string,mixed>
 */
function veryo_scan_ai_payload( $answers, $calc ) {
	$branches = veryo_scan_branches();
	$teams    = veryo_scan_team_sizes();
	$tasks    = veryo_scan_tasks();
	$tools    = veryo_scan_tools();
	$usage    = veryo_scan_ai_usage();
	$timing   = veryo_scan_timing();

	$task_rows = array();
	foreach ( (array) $answers['taken'] as $task ) {
		$task_rows[] = array(
			'taak'          => isset( $tasks[ $task ] ) ? $tasks[ $task ] : $task,
			'uren_per_week' => (int) ( isset( $answers['uren'][ $task ] ) ? $answers['uren'][ $task ] : 0 ),
		);
	}
	$tool_names = array();
	foreach ( (array) $answers['tools'] as $tool ) {
		$tool_names[] = isset( $tools[ $tool ] ) ? $tools[ $tool ] : $tool;
	}
	$catalog = array();
	foreach ( veryo_catalog() as $item ) {
		$catalog[] = array(
			'id'        => $item['id'],
			'categorie' => $item['categorie'],
			'naam'      => $item['naam'],
			'wat'       => $item['wat'],
			'niveau'    => $item['niveau'],
		);
	}

	return array(
		'antwoorden' => array(
			'branche'             => isset( $branches[ $answers['branche'] ] ) ? $branches[ $answers['branche'] ] : '',
			'branche_toelichting' => 'overig' === $answers['branche'] ? veryo_scrub_pii( (string) $answers['branche_overig'] ) : '',
			'teamgrootte'         => isset( $teams[ $answers['team'] ] ) ? $teams[ $answers['team'] ] : '',
			'taken'               => $task_rows,
			'tools'               => $tool_names,
			'huidig_ai_gebruik'   => isset( $usage[ $answers['ai_gebruik'] ] ) ? $usage[ $answers['ai_gebruik'] ] : '',
			'grootste_frustratie' => veryo_scrub_pii( (string) $answers['frustratie'] ),
			'timing'              => isset( $timing[ $answers['timing'] ] ) ? $timing[ $answers['timing'] ] : '',
		),
		'berekening' => array(
			'besparing_uren_per_week' => (int) $calc['besparing_uren_per_week'],
			'besparing_euro_per_jaar' => (int) $calc['besparing_euro_per_jaar'],
			'kansenscore'             => (int) $calc['kansenscore'],
			'aannames'                => veryo_scan_assumptions_text( $calc ),
		),
		'catalogus'  => $catalog,
	);
}

/**
 * Systeemprompt voor het rapport.
 *
 * @return string
 */
function veryo_scan_system_prompt() {
	$prompt = <<<'PROMPT'
Je schrijft het persoonlijke rapport van de gratis AI-scan van Veryo, een AI-bureau uit Leeuwarden voor het MKB in Noord-Nederland.

Schrijfstijl:
- Schrijf als Veryo: nuchter, direct en menselijk, zoals een goede adviseur aan de keukentafel.
- Spreek de lezer aan met "je". Korte zinnen, concreet, in het Nederlands.
- Geen superlatieven, geen uitroeptekens, geen emoji, geen woorden als "revolutionair", "cutting-edge" of "eindeloze mogelijkheden".
- Wees eerlijk over grenzen: een mens blijft controleren en beslissen.

Inhoud:
- Kies precies 3 aanbevelingen, uitsluitend uit de meegegeven catalogus. Gebruik alleen bestaande waarden van "id" als catalogus_id.
- Kies items die passen bij de taken met de meeste uren en bij de branche. Kies drie verschillende items.
- Verzin geen cijfers, percentages, klantnamen of resultaten. Gebruik alleen de meegegeven getallen uit "berekening". Noem geen prijzen; die voegt Veryo zelf toe.
- Koppel "waarom" aan de antwoorden van de lezer (taken, uren, tools, frustratie).
- "eerste_stap" is één concrete stap om met die aanbeveling te beginnen.
- "zelf_beginnen" is één concrete stap die de lezer deze week zelf kan zetten, zonder Veryo.

Antwoord uitsluitend met geldige JSON, zonder tekst ervoor of erna, volgens dit schema:
{
  "samenvatting": "2-3 zinnen",
  "aanbevelingen": [
    {"catalogus_id": "offerte-generator", "titel": "…", "waarom": "1-2 zinnen gekoppeld aan hun antwoorden", "hoe": "2-3 zinnen hoe het werkt", "eerste_stap": "1 zin"}
  ],
  "zelf_beginnen": "1 concrete stap die ze deze week zelf kunnen zetten",
  "afsluiting": "1-2 zinnen"
}
PROMPT;
	return (string) apply_filters( 'veryo_scan_system_prompt', $prompt );
}

/**
 * Aanroep van de Anthropic Messages API.
 *
 * @param string $system     Systeemprompt.
 * @param string $user       Gebruikersbericht.
 * @param int    $max_tokens Maximum aantal tokens.
 * @param int    $timeout    Timeout in seconden.
 * @return array{ok:bool,text:string,error:string}
 */
function veryo_anthropic_request( $system, $user, $max_tokens = 2000, $timeout = 60 ) {
	$key = veryo_api_key();
	if ( '' === $key ) {
		return array(
			'ok'    => false,
			'text'  => '',
			'error' => 'Geen API-sleutel ingesteld.',
		);
	}
	$model    = trim( (string) veryo_setting( 'model', 'claude-sonnet-5-5' ) );
	$response = wp_remote_post(
		'https://api.anthropic.com/v1/messages',
		array(
			'timeout' => $timeout,
			'headers' => array(
				'x-api-key'         => $key,
				'anthropic-version' => '2023-06-01',
				'content-type'      => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'model'      => $model ? $model : 'claude-sonnet-5-5',
					'max_tokens' => $max_tokens,
					'system'     => $system,
					'messages'   => array(
						array(
							'role'    => 'user',
							'content' => $user,
						),
					),
				)
			),
		)
	);
	if ( is_wp_error( $response ) ) {
		return array(
			'ok'    => false,
			'text'  => '',
			'error' => 'Verbindingsfout: ' . $response->get_error_message(),
		);
	}
	$code = (int) wp_remote_retrieve_response_code( $response );
	$body = json_decode( (string) wp_remote_retrieve_body( $response ), true );
	if ( 200 !== $code || ! is_array( $body ) ) {
		$type = is_array( $body ) && isset( $body['error']['type'] ) ? (string) $body['error']['type'] : 'onbekend';
		$msg  = is_array( $body ) && isset( $body['error']['message'] ) ? (string) $body['error']['message'] : '';
		return array(
			'ok'    => false,
			'text'  => '',
			'error' => sprintf( 'API-fout %d (%s) %s', $code, $type, mb_substr( str_replace( $key, '[sleutel]', $msg ), 0, 200 ) ),
		);
	}
	$text = '';
	foreach ( (array) ( isset( $body['content'] ) ? $body['content'] : array() ) as $block ) {
		if ( is_array( $block ) && isset( $block['type'] ) && 'text' === $block['type'] && isset( $block['text'] ) ) {
			$text .= (string) $block['text'];
		}
	}
	return array(
		'ok'    => '' !== trim( $text ),
		'text'  => $text,
		'error' => '' === trim( $text ) ? 'Leeg antwoord van de API.' : '',
	);
}

/**
 * JSON uit de modeltekst halen (codeblok-fences en tekst rondom verwijderen).
 *
 * @param string $text Tekst.
 * @return array<string,mixed>|null
 */
function veryo_parse_model_json( $text ) {
	$text = trim( $text );
	$text = preg_replace( '/^```(?:json)?\s*/i', '', $text );
	$text = preg_replace( '/\s*```\s*$/', '', (string) $text );
	$data = json_decode( (string) $text, true );
	if ( ! is_array( $data ) ) {
		$start = strpos( (string) $text, '{' );
		$end   = strrpos( (string) $text, '}' );
		if ( false !== $start && false !== $end && $end > $start ) {
			$data = json_decode( substr( (string) $text, $start, $end - $start + 1 ), true );
		}
	}
	return is_array( $data ) ? $data : null;
}

/**
 * Regelgebaseerde keuze van 3 catalogusitems op basis van taken (meeste uren eerst) en branche.
 *
 * @param array<string,mixed> $answers Antwoorden.
 * @param string[]            $exclude Uit te sluiten ID's.
 * @return array<string,string> catalogus_id => taak.
 */
function veryo_scan_fallback_pick( $answers, $exclude = array() ) {
	$map        = veryo_scan_task_map();
	$branch_map = veryo_scan_branch_map();
	$branche    = (string) $answers['branche'];

	$tasks = (array) $answers['taken'];
	usort(
		$tasks,
		static function ( $a, $b ) use ( $answers ) {
			$ha = isset( $answers['uren'][ $a ] ) ? (int) $answers['uren'][ $a ] : 0;
			$hb = isset( $answers['uren'][ $b ] ) ? (int) $answers['uren'][ $b ] : 0;
			return $hb <=> $ha;
		}
	);
	if ( ! $tasks ) {
		$tasks = array( 'email' );
	}

	// Kandidatenlijst per taak: eerst branchespecifiek, dan standaard.
	$candidates = array();
	foreach ( $tasks as $task ) {
		$list                = isset( $branch_map[ $branche ][ $task ] ) ? $branch_map[ $branche ][ $task ] : array();
		$list                = array_merge( $list, isset( $map[ $task ] ) ? $map[ $task ] : array() );
		$candidates[ $task ] = array_values( array_unique( $list ) );
	}

	$picked = array();
	$round  = 0;
	$have   = 0;
	while ( $have < 3 && $round < 6 ) {
		foreach ( $tasks as $task ) {
			foreach ( $candidates[ $task ] as $id ) {
				if ( ! isset( $picked[ $id ] ) && ! in_array( $id, $exclude, true ) && veryo_catalog_item( $id ) ) {
					$picked[ $id ] = $task;
					++$have;
					break;
				}
			}
			if ( $have >= 3 ) {
				break;
			}
		}
		++$round;
	}
	// Laatste vangnet: algemene quick wins.
	foreach ( array( 'mail-concepten', 'inkoopfacturen', 'weekupdate', 'offerte-opvolging' ) as $id ) {
		if ( count( $picked ) >= 3 ) {
			break;
		}
		if ( ! isset( $picked[ $id ] ) && ! in_array( $id, $exclude, true ) ) {
			$picked[ $id ] = $tasks[0];
		}
	}
	return array_slice( $picked, 0, 3, true );
}

/**
 * Vooraf geschreven aanbeveling voor één catalogusitem.
 *
 * @param string              $id      Catalogus-ID.
 * @param string              $task    Taak waaraan het item gekoppeld is.
 * @param array<string,mixed> $answers Antwoorden.
 * @param bool                $repeat  Tweede aanbeveling voor dezelfde taak.
 * @return array<string,string>
 */
function veryo_scan_fallback_recommendation( $id, $task, $answers, $repeat = false ) {
	$item  = veryo_catalog_item( $id );
	$texts = veryo_catalog_fallback_texts();
	$tasks = veryo_scan_tasks();
	$hours = isset( $answers['uren'][ $task ] ) ? (int) $answers['uren'][ $task ] : 0;
	$label = isset( $tasks[ $task ] ) ? mb_strtolower( $tasks[ $task ] ) : '';
	if ( $repeat ) {
		/* translators: 1: taak, 2: uren. */
		$waarom = sprintf( __( 'Een tweede manier om de %2$d uur per week aan %1$s omlaag te brengen. Het werkt goed samen met de aanbeveling hierboven.', 'veryo' ), $label, $hours );
	} else {
		$waarom = '';
	}
	$waarom = '' !== $waarom ? $waarom : ( $hours > 0
		/* translators: 1: taak, 2: uren. */
		? sprintf( __( 'Je gaf aan dat %1$s bij jullie ongeveer %2$d uur per week kost. Dit is een van de plekken waar in jouw situatie de meeste tijd te winnen valt.', 'veryo' ), $label, $hours )
		/* translators: %s: taak. */
		: sprintf( __( 'Je noemde %s als onderdeel waar tijd naartoe gaat. Dit is een logische plek om te beginnen.', 'veryo' ), $label ) );
	return array(
		'catalogus_id' => $id,
		'titel'        => $item['naam'],
		'waarom'       => $waarom,
		'hoe'          => isset( $texts[ $id ] ) ? $texts[ $id ][0] : $item['wat'] . ' ' . __( 'We bouwen het in de software die je al gebruikt, en een mens controleert de uitkomst.', 'veryo' ),
		'eerste_stap'  => isset( $texts[ $id ] ) ? $texts[ $id ][1] : __( 'Noteer een week lang hoe vaak dit werk voorkomt en hoeveel tijd het kost.', 'veryo' ),
	);
}

/**
 * Volledig regelgebaseerd rapport.
 *
 * @param array<string,mixed> $answers Antwoorden.
 * @param array<string,mixed> $calc    Berekening.
 * @return array<string,mixed>
 */
function veryo_scan_fallback_report( $answers, $calc ) {
	$recs = array();
	$used = array();
	foreach ( veryo_scan_fallback_pick( $answers ) as $id => $task ) {
		$recs[]        = veryo_scan_fallback_recommendation( $id, $task, $answers, isset( $used[ $task ] ) );
		$used[ $task ] = true;
	}
	return array(
		'samenvatting'  => veryo_scan_fallback_summary( $answers, $calc ),
		'aanbevelingen' => $recs,
		'zelf_beginnen' => veryo_scan_fallback_self_start( $answers ),
		'afsluiting'    => __( 'Wil je weten wat dit concreet voor jullie betekent en wat het kost? Plan een gesprek of reageer op deze mail. Je zit nergens aan vast.', 'veryo' ),
	);
}

/**
 * Samenvatting voor het fallback-rapport.
 *
 * @param array<string,mixed> $answers Antwoorden.
 * @param array<string,mixed> $calc    Berekening.
 * @return string
 */
function veryo_scan_fallback_summary( $answers, $calc ) {
	$tasks  = veryo_scan_tasks();
	$sorted = (array) $answers['taken'];
	usort(
		$sorted,
		static function ( $a, $b ) use ( $answers ) {
			return ( isset( $answers['uren'][ $b ] ) ? (int) $answers['uren'][ $b ] : 0 ) <=> ( isset( $answers['uren'][ $a ] ) ? (int) $answers['uren'][ $a ] : 0 );
		}
	);
	$top = array();
	foreach ( array_slice( $sorted, 0, 2 ) as $task ) {
		$top[] = mb_strtolower( isset( $tasks[ $task ] ) ? $tasks[ $task ] : $task );
	}
	$top_text = implode( __( ' en ', 'veryo' ), $top );
	$hours    = (int) $calc['besparing_uren_per_week'];
	if ( $hours > 0 ) {
		/* translators: 1: taken, 2: uren. */
		return sprintf( __( 'Uit je antwoorden blijkt dat de meeste tijd zit in %1$s. Met gerichte automatisering schatten we dat je ongeveer %2$d uur per week kunt terugwinnen. Hieronder staan de drie stappen die daar het meest aan bijdragen.', 'veryo' ), $top_text, $hours );
	}
	/* translators: %s: taken. */
	return sprintf( __( 'Uit je antwoorden blijkt dat er op dit moment weinig uren in terugkerend werk zitten; de meeste tijd gaat naar %s. Automatisering levert dan vooral rust en minder fouten op. Hieronder staan drie stappen om mee te beginnen.', 'veryo' ), $top_text );
}

/**
 * "Hier kun je zelf mee beginnen" voor het fallback-rapport.
 *
 * @param array<string,mixed> $answers Antwoorden.
 * @return string
 */
function veryo_scan_fallback_self_start( $answers ) {
	if ( in_array( $answers['ai_gebruik'], array( 'nee', 'geprobeerd' ), true ) ) {
		return __( 'Kies deze week één mail die je vaak beantwoordt en laat ChatGPT of Claude een conceptantwoord schrijven. Laat namen en klantgegevens weg, en vergelijk het met wat je zelf zou schrijven.', 'veryo' );
	}
	return __( 'Houd deze week met het team bij hoeveel tijd de taak met de meeste uren echt kost, en noteer welke stappen elke keer hetzelfde zijn. Dat is de basis voor een goede automatisering.', 'veryo' );
}

/**
 * Het modelantwoord valideren en aanvullen. Ongeldige of dubbele aanbevelingen worden
 * vervangen door de regelgebaseerde keuze; niveau en prijs komen altijd uit de catalogus.
 *
 * @param array<string,mixed>|null $data    Geparste JSON.
 * @param array<string,mixed>      $answers Antwoorden.
 * @param array<string,mixed>      $calc    Berekening.
 * @return array{report:array<string,mixed>,replaced:int}
 */
function veryo_scan_normalize_report( $data, $answers, $calc ) {
	$fallback = veryo_scan_fallback_report( $answers, $calc );
	$clean    = static function ( $value, $max ) {
		return is_string( $value ) ? mb_substr( trim( wp_strip_all_tags( $value ) ), 0, $max ) : '';
	};

	$report = array(
		'samenvatting'  => $clean( is_array( $data ) && isset( $data['samenvatting'] ) ? $data['samenvatting'] : '', 800 ),
		'zelf_beginnen' => $clean( is_array( $data ) && isset( $data['zelf_beginnen'] ) ? $data['zelf_beginnen'] : '', 500 ),
		'afsluiting'    => $clean( is_array( $data ) && isset( $data['afsluiting'] ) ? $data['afsluiting'] : '', 500 ),
		'aanbevelingen' => array(),
	);
	foreach ( array( 'samenvatting', 'zelf_beginnen', 'afsluiting' ) as $field ) {
		if ( '' === $report[ $field ] ) {
			$report[ $field ] = $fallback[ $field ];
		}
	}

	$seen  = array();
	$items = is_array( $data ) && isset( $data['aanbevelingen'] ) && is_array( $data['aanbevelingen'] ) ? $data['aanbevelingen'] : array();
	foreach ( $items as $rec ) {
		if ( ! is_array( $rec ) || empty( $rec['catalogus_id'] ) || ! is_string( $rec['catalogus_id'] ) ) {
			continue;
		}
		$id = sanitize_key( $rec['catalogus_id'] );
		if ( isset( $seen[ $id ] ) || ! veryo_catalog_item( $id ) ) {
			continue;
		}
		$row = array(
			'catalogus_id' => $id,
			'titel'        => $clean( isset( $rec['titel'] ) ? $rec['titel'] : '', 120 ),
			'waarom'       => $clean( isset( $rec['waarom'] ) ? $rec['waarom'] : '', 500 ),
			'hoe'          => $clean( isset( $rec['hoe'] ) ? $rec['hoe'] : '', 700 ),
			'eerste_stap'  => $clean( isset( $rec['eerste_stap'] ) ? $rec['eerste_stap'] : '', 300 ),
		);
		if ( '' === $row['titel'] ) {
			$row['titel'] = veryo_catalog_item( $id )['naam'];
		}
		if ( '' === $row['waarom'] || '' === $row['hoe'] || '' === $row['eerste_stap'] ) {
			continue;
		}
		$seen[ $id ]               = true;
		$report['aanbevelingen'][] = $row;
		if ( 3 === count( $report['aanbevelingen'] ) ) {
			break;
		}
	}

	$replaced = 3 - count( $report['aanbevelingen'] );
	if ( $replaced > 0 ) {
		foreach ( veryo_scan_fallback_pick( $answers, array_keys( $seen ) ) as $id => $task ) {
			if ( count( $report['aanbevelingen'] ) >= 3 ) {
				break;
			}
			$report['aanbevelingen'][] = veryo_scan_fallback_recommendation( $id, $task, $answers );
		}
	}

	// Niveau en prijsindicatie altijd uit de catalogus.
	$levels = veryo_catalog_levels();
	foreach ( $report['aanbevelingen'] as &$rec ) {
		$item          = veryo_catalog_item( $rec['catalogus_id'] );
		$rec['niveau'] = $levels[ $item['niveau'] ]['label'];
		$rec['prijs']  = $levels[ $item['niveau'] ]['price'];
		$rec['tijd']   = $item['tijdwinst_tekst'];
	}
	unset( $rec );

	return array(
		'report'   => $report,
		'replaced' => $replaced,
	);
}

/**
 * Rapport maken: eerst via de API, anders (of bij fouten) regelgebaseerd.
 *
 * @param int $lead_id Lead.
 * @return array{report:array<string,mixed>,source:string}
 */
function veryo_scan_build_report( $lead_id ) {
	$lead    = veryo_lead_get( $lead_id );
	$answers = $lead['answers'];
	$calc    = $lead['calc'];

	if ( '' === veryo_api_key() ) {
		veryo_lead_log( $lead_id, 'Geen API-sleutel: regelgebaseerd rapport gebruikt.' );
		return array(
			'report' => veryo_scan_normalize_report( null, $answers, $calc )['report'],
			'source' => 'fallback',
		);
	}

	$payload = veryo_scan_ai_payload( $answers, $calc );
	$user    = "Hier zijn de antwoorden, de berekende cijfers en de catalogus als JSON. Schrijf het rapport.\n\n" . wp_json_encode( $payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	$result  = veryo_anthropic_request( veryo_scan_system_prompt(), $user, 2000, 60 );

	if ( ! $result['ok'] ) {
		veryo_lead_log( $lead_id, 'AI-rapport mislukt, regelgebaseerd rapport gebruikt. ' . $result['error'] );
		return array(
			'report' => veryo_scan_normalize_report( null, $answers, $calc )['report'],
			'source' => 'fallback',
		);
	}
	$data = veryo_parse_model_json( $result['text'] );
	if ( null === $data ) {
		veryo_lead_log( $lead_id, 'AI-antwoord was geen geldige JSON, regelgebaseerd rapport gebruikt.' );
		return array(
			'report' => veryo_scan_normalize_report( null, $answers, $calc )['report'],
			'source' => 'fallback',
		);
	}
	$normalized = veryo_scan_normalize_report( $data, $answers, $calc );
	if ( $normalized['replaced'] > 0 ) {
		veryo_lead_log( $lead_id, sprintf( 'AI-rapport: %d aanbeveling(en) vervangen door regelgebaseerde keuze.', $normalized['replaced'] ) );
	}
	return array(
		'report' => $normalized['report'],
		'source' => 3 === $normalized['replaced'] ? 'fallback' : 'ai',
	);
}

/**
 * Rapport maken, opslaan, mailen en de webhook aanroepen.
 *
 * @param int  $lead_id Lead.
 * @param bool $force   Ook als het al verstuurd is (knop in de admin).
 * @return bool True als de rapport-e-mail is verstuurd.
 */
function veryo_scan_process_report( $lead_id, $force = false ) {
	if ( 'veryo_lead' !== get_post_type( $lead_id ) || 'ai-scan' !== get_post_meta( $lead_id, '_veryo_source', true ) ) {
		return false;
	}
	if ( ! $force && get_post_meta( $lead_id, '_veryo_report_sent', true ) ) {
		return true;
	}
	$lock = 'veryo_lock_' . $lead_id;
	if ( ! $force && get_transient( $lock ) ) {
		return false;
	}
	set_transient( $lock, 1, 2 * MINUTE_IN_SECONDS );

	$built = veryo_scan_build_report( $lead_id );
	update_post_meta( $lead_id, '_veryo_report', $built['report'] );
	update_post_meta( $lead_id, '_veryo_report_source', $built['source'] );

	// Verlopen token vernieuwen zodat de link in de nieuwe mail werkt.
	$created = (int) get_post_meta( $lead_id, '_veryo_token_created', true );
	if ( ! get_post_meta( $lead_id, '_veryo_token', true ) || $created < time() - 90 * DAY_IN_SECONDS ) {
		update_post_meta( $lead_id, '_veryo_token', wp_generate_password( 32, false ) );
		update_post_meta( $lead_id, '_veryo_token_created', time() );
	}

	$sent = veryo_mail_report( $lead_id );
	if ( $sent ) {
		update_post_meta( $lead_id, '_veryo_report_sent', gmdate( 'c' ) );
		veryo_lead_log( $lead_id, 'Rapport-e-mail verstuurd (' . $built['source'] . ').' );
	} else {
		veryo_lead_log( $lead_id, 'Versturen van de rapport-e-mail is mislukt (wp_mail gaf false).' );
	}

	if ( ! get_post_meta( $lead_id, '_veryo_webhook_done', true ) ) {
		veryo_send_webhook( $lead_id );
	}

	delete_transient( $lock );
	return $sent;
}

/**
 * Optionele Make-webhook.
 *
 * @param int $lead_id Lead.
 */
function veryo_send_webhook( $lead_id ) {
	$url = (string) veryo_setting( 'make_webhook', '' );
	if ( '' === $url ) {
		return;
	}
	$lead     = veryo_lead_get( $lead_id );
	$response = wp_safe_remote_post(
		$url,
		array(
			'timeout' => 10,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode(
				array(
					'lead_id'     => $lead_id,
					'bron'        => $lead['source'],
					'datum'       => $lead['date'],
					'temperatuur' => $lead['temp'],
					'cijfers'     => $lead['calc'],
					'antwoorden'  => $lead['answers'],
					'leesbaar'    => veryo_answers_readable( $lead['answers'] ),
					'contact'     => $lead['contact'],
					'admin_url'   => admin_url( 'post.php?post=' . $lead_id . '&action=edit' ),
				)
			),
		)
	);
	update_post_meta( $lead_id, '_veryo_webhook_done', 1 );
	if ( is_wp_error( $response ) ) {
		veryo_lead_log( $lead_id, 'Make-webhook mislukt: ' . $response->get_error_message() );
		return;
	}
	$code = (int) wp_remote_retrieve_response_code( $response );
	veryo_lead_log( $lead_id, $code >= 200 && $code < 300 ? 'Make-webhook verstuurd.' : 'Make-webhook gaf status ' . $code . '.' );
}

/**
 * Webhook voor niet-scan-leads (contact, academy) direct, niet-blokkerend.
 *
 * @param int $lead_id Lead.
 */
function veryo_send_webhook_async( $lead_id ) {
	$url = (string) veryo_setting( 'make_webhook', '' );
	if ( '' === $url ) {
		return;
	}
	$lead = veryo_lead_get( $lead_id );
	wp_safe_remote_post(
		$url,
		array(
			'timeout'  => 10,
			'blocking' => false,
			'headers'  => array( 'Content-Type' => 'application/json' ),
			'body'     => wp_json_encode(
				array(
					'lead_id'   => $lead_id,
					'bron'      => $lead['source'],
					'datum'     => $lead['date'],
					'contact'   => $lead['contact'],
					'admin_url' => admin_url( 'post.php?post=' . $lead_id . '&action=edit' ),
				)
			),
		)
	);
	update_post_meta( $lead_id, '_veryo_webhook_done', 1 );
}

/**
 * Test van de API-verbinding (knop in de instellingen).
 *
 * @return array{ok:bool,message:string}
 */
function veryo_api_test() {
	$result = veryo_anthropic_request( 'Antwoord met precies het woord OK.', 'Test', 10, 20 );
	if ( $result['ok'] ) {
		return array(
			'ok'      => true,
			/* translators: %s: model. */
			'message' => sprintf( __( 'Verbinding werkt (model: %s).', 'veryo' ), (string) veryo_setting( 'model' ) ),
		);
	}
	return array(
		'ok'      => false,
		'message' => __( 'Verbinding mislukt: ', 'veryo' ) . $result['error'],
	);
}
