<?php
/**
 * Leads: custom post type, opslag, beheerscherm, filters, exports en opschonen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Statussen van een lead.
 *
 * @return array<string,string>
 */
function veryo_lead_statuses() {
	return array(
		'nieuw'          => __( 'Nieuw', 'veryo' ),
		'gebeld'         => __( 'Gebeld', 'veryo' ),
		'kansensessie'   => __( 'Kansensessie gepland', 'veryo' ),
		'klant'          => __( 'Klant', 'veryo' ),
		'geen-interesse' => __( 'Geen interesse', 'veryo' ),
	);
}

/**
 * Bronnen van een lead.
 *
 * @return array<string,string>
 */
function veryo_lead_sources() {
	return array(
		'ai-scan' => __( 'AI-scan', 'veryo' ),
		'academy' => __( 'Academy-wachtlijst', 'veryo' ),
		'contact' => __( 'Contactformulier', 'veryo' ),
	);
}

/**
 * Post type registreren. Niet publiek; alleen zichtbaar voor beheerders.
 */
function veryo_register_lead_cpt() {
	register_post_type(
		'veryo_lead',
		array(
			'labels'              => array(
				'name'               => __( 'Leads', 'veryo' ),
				'singular_name'      => __( 'Lead', 'veryo' ),
				'menu_name'          => __( 'Leads', 'veryo' ),
				'edit_item'          => __( 'Lead bekijken', 'veryo' ),
				'search_items'       => __( 'Leads zoeken', 'veryo' ),
				'not_found'          => __( 'Nog geen leads.', 'veryo' ),
				'not_found_in_trash' => __( 'Geen leads in de prullenbak.', 'veryo' ),
				'all_items'          => __( 'Alle leads', 'veryo' ),
			),
			'public'              => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'show_in_rest'        => false,
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
			'menu_position'       => 26,
			'menu_icon'           => 'dashicons-yes-alt',
			'supports'            => array( 'title' ),
			'map_meta_cap'        => false,
			'capabilities'        => array(
				'edit_post'              => 'manage_options',
				'read_post'              => 'manage_options',
				'delete_post'            => 'manage_options',
				'edit_posts'             => 'manage_options',
				'edit_others_posts'      => 'manage_options',
				'delete_posts'           => 'manage_options',
				'delete_others_posts'    => 'manage_options',
				'publish_posts'          => 'manage_options',
				'read_private_posts'     => 'manage_options',
				'delete_private_posts'   => 'manage_options',
				'delete_published_posts' => 'manage_options',
				'edit_published_posts'   => 'manage_options',
				'edit_private_posts'     => 'manage_options',
				'create_posts'           => 'do_not_allow',
			),
		)
	);
}
add_action( 'init', 'veryo_register_lead_cpt' );

/**
 * Lead aanmaken.
 *
 * @param string              $source  ai-scan|academy|contact.
 * @param array<string,mixed> $contact Contactgegevens.
 * @param array<string,mixed> $answers Antwoorden (alleen AI-scan).
 * @param array<string,mixed> $calc    Berekening (alleen AI-scan).
 * @return int|WP_Error
 */
function veryo_lead_create( $source, $contact, $answers = array(), $calc = array() ) {
	$company = isset( $contact['bedrijf'] ) ? $contact['bedrijf'] : '';
	$name    = isset( $contact['voornaam'] ) ? $contact['voornaam'] : ( isset( $contact['naam'] ) ? $contact['naam'] : '' );
	$title   = trim( $company . ( $company && $name ? ' – ' : '' ) . $name );
	$post_id = wp_insert_post(
		array(
			'post_type'   => 'veryo_lead',
			'post_status' => 'publish',
			'post_title'  => $title ? $title : __( 'Lead', 'veryo' ),
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}
	update_post_meta( $post_id, '_veryo_source', $source );
	update_post_meta( $post_id, '_veryo_contact', $contact );
	update_post_meta( $post_id, '_veryo_email', strtolower( (string) $contact['email'] ) );
	update_post_meta( $post_id, '_veryo_status', 'nieuw' );
	update_post_meta( $post_id, '_veryo_consent_at', gmdate( 'c' ) );
	update_post_meta( $post_id, '_veryo_ip_hash', veryo_ip_hash() );
	if ( 'ai-scan' === $source ) {
		update_post_meta( $post_id, '_veryo_answers', $answers );
		update_post_meta( $post_id, '_veryo_calc', $calc );
		update_post_meta( $post_id, '_veryo_temp', $calc['lead_temperatuur'] );
		update_post_meta( $post_id, '_veryo_hours', (int) $calc['besparing_uren_per_week'] );
		update_post_meta( $post_id, '_veryo_token', wp_generate_password( 32, false ) );
		update_post_meta( $post_id, '_veryo_token_created', time() );
		update_post_meta( $post_id, '_veryo_report_sent', '' );
	}
	return (int) $post_id;
}

/**
 * Regel toevoegen aan het logboek van een lead (zonder sleutels of persoonsgegevens).
 *
 * @param int    $lead_id Lead.
 * @param string $message Bericht.
 */
function veryo_lead_log( $lead_id, $message ) {
	$log   = get_post_meta( $lead_id, '_veryo_log', true );
	$log   = is_array( $log ) ? $log : array();
	$key   = veryo_api_key();
	$clean = $key ? str_replace( $key, '[sleutel]', $message ) : $message;
	$log[] = array(
		'time' => gmdate( 'c' ),
		'msg'  => mb_substr( sanitize_text_field( $clean ), 0, 500 ),
	);
	update_post_meta( $lead_id, '_veryo_log', array_slice( $log, -50 ) );
}

/**
 * Alle gegevens van een lead.
 *
 * @param int $lead_id Lead.
 * @return array<string,mixed>
 */
function veryo_lead_get( $lead_id ) {
	$get     = static function ( $key ) use ( $lead_id ) {
		$value = get_post_meta( $lead_id, $key, true );
		return $value;
	};
	$contact = $get( '_veryo_contact' );
	$answers = $get( '_veryo_answers' );
	$calc    = $get( '_veryo_calc' );
	$report  = $get( '_veryo_report' );
	$log     = $get( '_veryo_log' );
	return array(
		'id'          => (int) $lead_id,
		'source'      => (string) $get( '_veryo_source' ),
		'contact'     => is_array( $contact ) ? $contact : array(),
		'answers'     => is_array( $answers ) ? $answers : array(),
		'calc'        => is_array( $calc ) ? $calc : array(),
		'temp'        => (string) $get( '_veryo_temp' ),
		'status'      => (string) $get( '_veryo_status' ),
		'consent_at'  => (string) $get( '_veryo_consent_at' ),
		'token'       => (string) $get( '_veryo_token' ),
		'token_time'  => (int) $get( '_veryo_token_created' ),
		'report'      => is_array( $report ) ? $report : array(),
		'report_sent' => (string) $get( '_veryo_report_sent' ),
		'log'         => is_array( $log ) ? $log : array(),
		'date'        => get_post_time( 'c', true, $lead_id ),
	);
}

/**
 * URL van het online rapport.
 *
 * @param string $token Token.
 * @return string
 */
function veryo_report_url( $token ) {
	return add_query_arg( 't', rawurlencode( $token ), veryo_url( 'rapport' ) );
}

/*
 * Beheerscherm: kolommen en filters
 */

/**
 * Kolommen.
 *
 * @return array<string,string>
 */
function veryo_lead_columns() {
	return array(
		'cb'       => '<input type="checkbox" />',
		'date'     => __( 'Datum', 'veryo' ),
		'title'    => __( 'Bedrijf', 'veryo' ),
		'voornaam' => __( 'Voornaam', 'veryo' ),
		'source'   => __( 'Bron', 'veryo' ),
		'branche'  => __( 'Branche', 'veryo' ),
		'uren'     => __( 'Uren/week', 'veryo' ),
		'temp'     => __( 'Temperatuur', 'veryo' ),
		'status'   => __( 'Status', 'veryo' ),
		'rapport'  => __( 'Rapport verstuurd', 'veryo' ),
	);
}
add_filter( 'manage_veryo_lead_posts_columns', 'veryo_lead_columns' );

/**
 * Kolominhoud.
 *
 * @param string $column  Kolom.
 * @param int    $post_id Lead.
 */
function veryo_lead_column_content( $column, $post_id ) {
	$lead = veryo_lead_get( $post_id );
	switch ( $column ) {
		case 'voornaam':
			echo esc_html( isset( $lead['contact']['voornaam'] ) ? $lead['contact']['voornaam'] : ( isset( $lead['contact']['naam'] ) ? $lead['contact']['naam'] : '' ) );
			break;
		case 'source':
			$sources = veryo_lead_sources();
			echo esc_html( isset( $sources[ $lead['source'] ] ) ? $sources[ $lead['source'] ] : $lead['source'] );
			break;
		case 'branche':
			$branches = veryo_scan_branches();
			$branche  = isset( $lead['answers']['branche'] ) ? $lead['answers']['branche'] : '';
			echo esc_html( isset( $branches[ $branche ] ) ? $branches[ $branche ] : '–' );
			break;
		case 'uren':
			echo isset( $lead['calc']['besparing_uren_per_week'] ) ? esc_html( (string) $lead['calc']['besparing_uren_per_week'] ) : '–';
			break;
		case 'temp':
			if ( $lead['temp'] ) {
				printf( '<span class="veryo-temp veryo-temp--%1$s">%2$s</span>', esc_attr( $lead['temp'] ), esc_html( veryo_temp_label( $lead['temp'] ) ) );
			} else {
				echo '–';
			}
			break;
		case 'status':
			$statuses = veryo_lead_statuses();
			echo esc_html( isset( $statuses[ $lead['status'] ] ) ? $statuses[ $lead['status'] ] : '' );
			break;
		case 'rapport':
			if ( 'ai-scan' !== $lead['source'] ) {
				echo '–';
			} else {
				echo $lead['report_sent'] ? esc_html__( 'Ja', 'veryo' ) : esc_html__( 'Nee', 'veryo' );
			}
			break;
	}
}
add_action( 'manage_veryo_lead_posts_custom_column', 'veryo_lead_column_content', 10, 2 );

/**
 * Filters boven de lijst, plus exportknoppen.
 *
 * @param string $post_type Post type.
 */
function veryo_lead_filters( $post_type ) {
	if ( 'veryo_lead' !== $post_type ) {
		return;
	}
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- alleen filteren in de lijstweergave.
	$temp   = isset( $_GET['veryo_temp'] ) ? sanitize_key( wp_unslash( $_GET['veryo_temp'] ) ) : '';
	$status = isset( $_GET['veryo_status'] ) ? sanitize_key( wp_unslash( $_GET['veryo_status'] ) ) : '';
	$source = isset( $_GET['veryo_source'] ) ? sanitize_key( wp_unslash( $_GET['veryo_source'] ) ) : '';
	// phpcs:enable
	echo '<label class="screen-reader-text" for="veryo_temp">' . esc_html__( 'Temperatuur', 'veryo' ) . '</label>';
	echo '<select name="veryo_temp" id="veryo_temp"><option value="">' . esc_html__( 'Alle temperaturen', 'veryo' ) . '</option>';
	foreach ( array( 'heet', 'warm', 'koud' ) as $t ) {
		printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $t ), selected( $temp, $t, false ), esc_html( veryo_temp_label( $t ) ) );
	}
	echo '</select>';
	echo '<label class="screen-reader-text" for="veryo_status">' . esc_html__( 'Status', 'veryo' ) . '</label>';
	echo '<select name="veryo_status" id="veryo_status"><option value="">' . esc_html__( 'Alle statussen', 'veryo' ) . '</option>';
	foreach ( veryo_lead_statuses() as $key => $label ) {
		printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $key ), selected( $status, $key, false ), esc_html( $label ) );
	}
	echo '</select>';
	echo '<label class="screen-reader-text" for="veryo_source">' . esc_html__( 'Bron', 'veryo' ) . '</label>';
	echo '<select name="veryo_source" id="veryo_source"><option value="">' . esc_html__( 'Alle bronnen', 'veryo' ) . '</option>';
	foreach ( veryo_lead_sources() as $key => $label ) {
		printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $key ), selected( $source, $key, false ), esc_html( $label ) );
	}
	echo '</select>';
}
add_action( 'restrict_manage_posts', 'veryo_lead_filters' );

/**
 * Exportknoppen naast de filters.
 *
 * @param string $which top|bottom.
 */
function veryo_lead_export_buttons( $which ) {
	$screen = get_current_screen();
	if ( 'top' !== $which || ! $screen || 'edit-veryo_lead' !== $screen->id || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$full  = wp_nonce_url( admin_url( 'admin-post.php?action=veryo_export_leads' ), 'veryo_export_leads' );
	$stats = wp_nonce_url( admin_url( 'admin-post.php?action=veryo_export_stats' ), 'veryo_export_stats' );
	echo '<div class="alignleft actions">';
	printf( '<a class="button" href="%1$s">%2$s</a> ', esc_url( $full ), esc_html__( 'Exporteer leads (CSV)', 'veryo' ) );
	printf( '<a class="button" href="%1$s">%2$s</a>', esc_url( $stats ), esc_html__( 'Anonieme statistieken (CSV)', 'veryo' ) );
	echo '</div>';
}
add_action( 'manage_posts_extra_tablenav', 'veryo_lead_export_buttons' );

/**
 * Filters toepassen op de query.
 *
 * @param WP_Query $query Query.
 */
function veryo_lead_filter_query( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() || 'veryo_lead' !== $query->get( 'post_type' ) ) {
		return;
	}
	$meta = array();
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- alleen filteren.
	$map = array(
		'veryo_temp'   => '_veryo_temp',
		'veryo_status' => '_veryo_status',
		'veryo_source' => '_veryo_source',
	);
	foreach ( $map as $param => $key ) {
		if ( ! empty( $_GET[ $param ] ) ) {
			$meta[] = array(
				'key'   => $key,
				'value' => sanitize_key( wp_unslash( $_GET[ $param ] ) ),
			);
		}
	}
	// phpcs:enable
	if ( $meta ) {
		$query->set( 'meta_query', $meta );
	}
}
add_action( 'pre_get_posts', 'veryo_lead_filter_query' );

/**
 * Stijl voor temperatuurlabels in de admin.
 */
function veryo_lead_admin_css() {
	$screen = get_current_screen();
	if ( ! $screen || 'veryo_lead' !== $screen->post_type ) {
		return;
	}
	echo '<style>.veryo-temp{display:inline-block;padding:2px 8px;border-radius:6px;font-weight:600;font-size:12px}.veryo-temp--heet{background:#B3261E;color:#fff}.veryo-temp--warm{background:#E0A03A;color:#0F1F1C}.veryo-temp--koud{background:#DDE8E4;color:#0F1F1C}.veryo-lead-table th{text-align:left;width:34%;vertical-align:top;padding:4px 8px 4px 0}.veryo-lead-table td{padding:4px 0}.veryo-lead-log li{font-family:monospace;font-size:12px}</style>';
}
add_action( 'admin_head', 'veryo_lead_admin_css' );

/*
 * Bewerkscherm
 */

/**
 * Metaboxen.
 */
function veryo_lead_metaboxes() {
	add_meta_box( 'veryo_lead_details', __( 'Gegevens', 'veryo' ), 'veryo_lead_box_details', 'veryo_lead', 'normal', 'high' );
	add_meta_box( 'veryo_lead_report', __( 'Rapport', 'veryo' ), 'veryo_lead_box_report', 'veryo_lead', 'normal', 'default' );
	add_meta_box( 'veryo_lead_status', __( 'Status', 'veryo' ), 'veryo_lead_box_status', 'veryo_lead', 'side', 'high' );
	add_meta_box( 'veryo_lead_log', __( 'Logboek', 'veryo' ), 'veryo_lead_box_log', 'veryo_lead', 'side', 'default' );
}
add_action( 'add_meta_boxes_veryo_lead', 'veryo_lead_metaboxes' );

/**
 * Leesbare antwoorden als label => waarde.
 *
 * @param array<string,mixed> $answers Antwoorden.
 * @return array<string,string>
 */
function veryo_answers_readable( $answers ) {
	if ( empty( $answers ) ) {
		return array();
	}
	$branches = veryo_scan_branches();
	$teams    = veryo_scan_team_sizes();
	$tasks    = veryo_scan_tasks();
	$tools    = veryo_scan_tools();
	$usage    = veryo_scan_ai_usage();
	$timing   = veryo_scan_timing();

	$task_lines = array();
	foreach ( (array) $answers['taken'] as $task ) {
		$task_lines[] = ( isset( $tasks[ $task ] ) ? $tasks[ $task ] : $task ) . ': ' . (int) ( isset( $answers['uren'][ $task ] ) ? $answers['uren'][ $task ] : 0 ) . ' u/wk';
	}
	$tool_names = array();
	foreach ( (array) $answers['tools'] as $tool ) {
		$tool_names[] = isset( $tools[ $tool ] ) ? $tools[ $tool ] : $tool;
	}
	$branche = isset( $branches[ $answers['branche'] ] ) ? $branches[ $answers['branche'] ] : '';
	if ( 'overig' === $answers['branche'] && ! empty( $answers['branche_overig'] ) ) {
		$branche .= ' (' . $answers['branche_overig'] . ')';
	}
	return array(
		__( 'Branche', 'veryo' )             => $branche,
		__( 'Teamgrootte', 'veryo' )         => isset( $teams[ $answers['team'] ] ) ? $teams[ $answers['team'] ] : '',
		__( 'Taken en uren', 'veryo' )       => implode( '; ', $task_lines ),
		__( 'Tools', 'veryo' )               => implode( ', ', $tool_names ),
		__( 'AI-gebruik', 'veryo' )          => isset( $usage[ $answers['ai_gebruik'] ] ) ? $usage[ $answers['ai_gebruik'] ] : '',
		__( 'Grootste frustratie', 'veryo' ) => (string) $answers['frustratie'],
		__( 'Timing', 'veryo' )              => isset( $timing[ $answers['timing'] ] ) ? $timing[ $answers['timing'] ] : '',
	);
}

/**
 * Metabox: gegevens.
 *
 * @param WP_Post $post Lead.
 */
function veryo_lead_box_details( $post ) {
	$lead    = veryo_lead_get( $post->ID );
	$sources = veryo_lead_sources();
	$rows    = array(
		__( 'Bron', 'veryo' )        => isset( $sources[ $lead['source'] ] ) ? $sources[ $lead['source'] ] : $lead['source'],
		__( 'Toestemming', 'veryo' ) => $lead['consent_at'] ? wp_date( 'j F Y H:i', (int) strtotime( $lead['consent_at'] ) ) : '',
	);
	$labels  = array(
		'voornaam'    => __( 'Voornaam', 'veryo' ),
		'naam'        => __( 'Naam', 'veryo' ),
		'bedrijf'     => __( 'Bedrijf', 'veryo' ),
		'medewerkers' => __( 'Aantal medewerkers', 'veryo' ),
		'email'       => __( 'E-mail', 'veryo' ),
		'telefoon'    => __( 'Telefoon', 'veryo' ),
		'bericht'     => __( 'Bericht', 'veryo' ),
		'pagina'      => __( 'Verstuurd vanaf', 'veryo' ),
	);
	foreach ( $labels as $key => $label ) {
		if ( isset( $lead['contact'][ $key ] ) && '' !== $lead['contact'][ $key ] ) {
			$rows[ $label ] = $lead['contact'][ $key ];
		}
	}
	$rows = array_merge( $rows, veryo_answers_readable( $lead['answers'] ) );
	if ( $lead['calc'] ) {
		$rows[ __( 'Besparing', 'veryo' ) ]   = sprintf( '%d u/wk · %s per jaar', (int) $lead['calc']['besparing_uren_per_week'], veryo_euro( $lead['calc']['besparing_euro_per_jaar'] ) );
		$rows[ __( 'Kansenscore', 'veryo' ) ] = (string) $lead['calc']['kansenscore'];
		$rows[ __( 'Temperatuur', 'veryo' ) ] = veryo_temp_label( $lead['temp'] );
	}
	echo '<table class="veryo-lead-table">';
	foreach ( $rows as $label => $value ) {
		echo '<tr><th scope="row">' . esc_html( $label ) . '</th><td>';
		if ( __( 'E-mail', 'veryo' ) === $label ) {
			echo '<a href="mailto:' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a>';
		} elseif ( __( 'Telefoon', 'veryo' ) === $label ) {
			echo '<a href="' . esc_attr( veryo_tel_href( $value ) ) . '">' . esc_html( $value ) . '</a>';
		} else {
			echo nl2br( esc_html( $value ) );
		}
		echo '</td></tr>';
	}
	echo '</table>';
}

/**
 * Metabox: rapport.
 *
 * @param WP_Post $post Lead.
 */
function veryo_lead_box_report( $post ) {
	$lead = veryo_lead_get( $post->ID );
	if ( 'ai-scan' !== $lead['source'] ) {
		echo '<p>' . esc_html__( 'Deze lead komt niet uit de AI-scan en heeft geen rapport.', 'veryo' ) . '</p>';
		return;
	}
	$regen = wp_nonce_url( admin_url( 'admin-post.php?action=veryo_regenerate_report&lead=' . $post->ID ), 'veryo_regenerate_' . $post->ID );
	if ( $lead['report_sent'] ) {
		/* translators: %s: datum. */
		echo '<p>' . esc_html( sprintf( __( 'Rapport verstuurd op %s.', 'veryo' ), wp_date( 'j F Y H:i', (int) strtotime( $lead['report_sent'] ) ) ) ) . '</p>';
	} else {
		echo '<p>' . esc_html__( 'Het rapport is nog niet verstuurd. Als WP-Cron traag is, kun je het hier handmatig maken en versturen.', 'veryo' ) . '</p>';
	}
	if ( ! empty( $lead['report']['samenvatting'] ) ) {
		$source = get_post_meta( $post->ID, '_veryo_report_source', true );
		echo '<p><strong>' . esc_html__( 'Samenvatting', 'veryo' ) . '</strong> (' . esc_html( 'ai' === $source ? __( 'geschreven door AI', 'veryo' ) : __( 'regelgebaseerd', 'veryo' ) ) . '): ' . esc_html( $lead['report']['samenvatting'] ) . '</p>';
		echo '<ol>';
		foreach ( (array) $lead['report']['aanbevelingen'] as $rec ) {
			echo '<li>' . esc_html( $rec['titel'] ) . ' <code>' . esc_html( $rec['catalogus_id'] ) . '</code></li>';
		}
		echo '</ol>';
		if ( $lead['token'] ) {
			echo '<p><a href="' . esc_url( veryo_report_url( $lead['token'] ) ) . '" target="_blank" rel="noopener">' . esc_html__( 'Online rapport bekijken', 'veryo' ) . '</a></p>';
		}
	}
	echo '<p><a class="button button-primary" href="' . esc_url( $regen ) . '">' . esc_html__( 'Rapport (opnieuw) genereren en versturen', 'veryo' ) . '</a></p>';
}

/**
 * Metabox: status.
 *
 * @param WP_Post $post Lead.
 */
function veryo_lead_box_status( $post ) {
	$status = (string) get_post_meta( $post->ID, '_veryo_status', true );
	wp_nonce_field( 'veryo_lead_status', 'veryo_lead_status_nonce' );
	echo '<label for="veryo_lead_status_field" class="screen-reader-text">' . esc_html__( 'Status', 'veryo' ) . '</label>';
	echo '<select name="veryo_lead_status" id="veryo_lead_status_field" style="width:100%">';
	foreach ( veryo_lead_statuses() as $key => $label ) {
		printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $key ), selected( $status, $key, false ), esc_html( $label ) );
	}
	echo '</select><p class="description">' . esc_html__( 'Klik op Bijwerken om op te slaan.', 'veryo' ) . '</p>';
}

/**
 * Metabox: logboek.
 *
 * @param WP_Post $post Lead.
 */
function veryo_lead_box_log( $post ) {
	$lead = veryo_lead_get( $post->ID );
	if ( ! $lead['log'] ) {
		echo '<p>' . esc_html__( 'Nog geen meldingen.', 'veryo' ) . '</p>';
		return;
	}
	echo '<ul class="veryo-lead-log">';
	foreach ( array_reverse( $lead['log'] ) as $row ) {
		echo '<li>' . esc_html( wp_date( 'd-m H:i', (int) strtotime( $row['time'] ) ) . ' ' . $row['msg'] ) . '</li>';
	}
	echo '</ul>';
}

/**
 * Status opslaan.
 *
 * @param int $post_id Lead.
 */
function veryo_lead_save_status( $post_id ) {
	if ( ! isset( $_POST['veryo_lead_status_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['veryo_lead_status_nonce'] ) ), 'veryo_lead_status' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
		return;
	}
	$status = isset( $_POST['veryo_lead_status'] ) ? sanitize_key( wp_unslash( $_POST['veryo_lead_status'] ) ) : '';
	if ( isset( veryo_lead_statuses()[ $status ] ) ) {
		update_post_meta( $post_id, '_veryo_status', $status );
	}
}
add_action( 'save_post_veryo_lead', 'veryo_lead_save_status' );

/**
 * Rapport opnieuw genereren vanuit het leadscherm.
 */
function veryo_admin_regenerate_report() {
	$lead_id = isset( $_GET['lead'] ) ? absint( $_GET['lead'] ) : 0;
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_regenerate_' . $lead_id );
	if ( 'veryo_lead' !== get_post_type( $lead_id ) ) {
		wp_die( esc_html__( 'Onbekende lead.', 'veryo' ) );
	}
	$ok = veryo_scan_process_report( $lead_id, true );
	wp_safe_redirect( add_query_arg( 'veryo_regen', $ok ? '1' : '0', get_edit_post_link( $lead_id, 'raw' ) ) );
	exit;
}
add_action( 'admin_post_veryo_regenerate_report', 'veryo_admin_regenerate_report' );

/**
 * Melding na opnieuw genereren.
 */
function veryo_admin_regen_notice() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- alleen een melding tonen.
	if ( ! isset( $_GET['veryo_regen'] ) ) {
		return;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$ok = '1' === $_GET['veryo_regen'];
	printf(
		'<div class="notice notice-%1$s is-dismissible"><p>%2$s</p></div>',
		$ok ? 'success' : 'error',
		esc_html( $ok ? __( 'Rapport gemaakt en verstuurd.', 'veryo' ) : __( 'Het rapport kon niet worden verstuurd. Bekijk het logboek.', 'veryo' ) )
	);
}
add_action( 'admin_notices', 'veryo_admin_regen_notice' );

/*
 * Exports
 */

/**
 * Waarde veilig maken voor CSV (voorkomt formule-injectie in Excel).
 *
 * @param mixed $value Waarde.
 * @return string
 */
function veryo_csv_cell( $value ) {
	$value = is_array( $value ) ? implode( '; ', array_map( 'strval', $value ) ) : (string) $value;
	if ( '' !== $value && in_array( $value[0], array( '=', '+', '-', '@', "\t", "\r" ), true ) ) {
		$value = "'" . $value;
	}
	return $value;
}

/**
 * CSV naar de browser sturen.
 *
 * @param string                  $filename Bestandsnaam.
 * @param string[]                $header   Kolomkoppen.
 * @param array<int,array<mixed>> $rows     Rijen.
 */
function veryo_send_csv( $filename, $header, $rows ) {
	nocache_headers();
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $filename ) . '"' );
	$out = fopen( 'php://output', 'w' );
	if ( false === $out ) {
		exit;
	}
	fwrite( $out, "\xEF\xBB\xBF" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fwrite -- BOM voor Excel.
	fputcsv( $out, $header, ';', '"', '\\' );
	foreach ( $rows as $row ) {
		fputcsv( $out, array_map( 'veryo_csv_cell', $row ), ';', '"', '\\' );
	}
	fclose( $out ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
	exit;
}

/**
 * Alle lead-ID's.
 *
 * @return int[]
 */
function veryo_all_lead_ids() {
	return get_posts(
		array(
			'post_type'      => 'veryo_lead',
			'post_status'    => 'any',
			'posts_per_page' => 5000, // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page -- export voor beheerders.
			'fields'         => 'ids',
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);
}

/**
 * Volledige export (alleen beheerders).
 */
function veryo_export_leads() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_export_leads' );
	$tasks  = array_keys( veryo_scan_tasks() );
	$header = array_merge(
		array( 'id', 'datum', 'bron', 'status', 'temperatuur', 'voornaam_of_naam', 'bedrijf', 'email', 'telefoon', 'bericht', 'aantal_medewerkers', 'branche', 'branche_overig', 'team', 'taken' ),
		array_map(
			static function ( $t ) {
				return 'uren_' . $t;
			},
			$tasks
		),
		array( 'tools', 'ai_gebruik', 'frustratie', 'timing', 'besparing_uren_week', 'besparing_euro_jaar', 'kansenscore', 'rapport_verstuurd', 'toestemming' )
	);
	$rows   = array();
	foreach ( veryo_all_lead_ids() as $id ) {
		$l   = veryo_lead_get( $id );
		$a   = $l['answers'];
		$c   = $l['contact'];
		$row = array(
			$id,
			$l['date'],
			$l['source'],
			$l['status'],
			$l['temp'],
			isset( $c['voornaam'] ) ? $c['voornaam'] : ( isset( $c['naam'] ) ? $c['naam'] : '' ),
			isset( $c['bedrijf'] ) ? $c['bedrijf'] : '',
			isset( $c['email'] ) ? $c['email'] : '',
			isset( $c['telefoon'] ) ? $c['telefoon'] : '',
			isset( $c['bericht'] ) ? $c['bericht'] : '',
			isset( $c['medewerkers'] ) ? $c['medewerkers'] : '',
			isset( $a['branche'] ) ? $a['branche'] : '',
			isset( $a['branche_overig'] ) ? $a['branche_overig'] : '',
			isset( $a['team'] ) ? $a['team'] : '',
			isset( $a['taken'] ) ? $a['taken'] : array(),
		);
		foreach ( $tasks as $t ) {
			$row[] = isset( $a['uren'][ $t ] ) ? (int) $a['uren'][ $t ] : '';
		}
		$rows[] = array_merge(
			$row,
			array(
				isset( $a['tools'] ) ? $a['tools'] : array(),
				isset( $a['ai_gebruik'] ) ? $a['ai_gebruik'] : '',
				isset( $a['frustratie'] ) ? $a['frustratie'] : '',
				isset( $a['timing'] ) ? $a['timing'] : '',
				isset( $l['calc']['besparing_uren_per_week'] ) ? $l['calc']['besparing_uren_per_week'] : '',
				isset( $l['calc']['besparing_euro_per_jaar'] ) ? $l['calc']['besparing_euro_per_jaar'] : '',
				isset( $l['calc']['kansenscore'] ) ? $l['calc']['kansenscore'] : '',
				$l['report_sent'],
				$l['consent_at'],
			)
		);
	}
	veryo_send_csv( 'veryo-leads-' . gmdate( 'Y-m-d' ) . '.csv', $header, $rows );
}
add_action( 'admin_post_veryo_export_leads', 'veryo_export_leads' );

/**
 * Anonieme statistieken: alleen antwoorden en cijfers, zonder contactgegevens en zonder frustratietekst.
 */
function veryo_export_stats() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_export_stats' );
	$tasks  = array_keys( veryo_scan_tasks() );
	$header = array_merge(
		array( 'maand', 'branche', 'team', 'taken' ),
		array_map(
			static function ( $t ) {
				return 'uren_' . $t;
			},
			$tasks
		),
		array( 'tools', 'ai_gebruik', 'timing', 'besparing_uren_week', 'besparing_euro_jaar', 'kansenscore', 'temperatuur' )
	);
	$rows   = array();
	foreach ( veryo_all_lead_ids() as $id ) {
		$l = veryo_lead_get( $id );
		if ( 'ai-scan' !== $l['source'] || empty( $l['answers'] ) ) {
			continue;
		}
		$a   = $l['answers'];
		$row = array( substr( $l['date'], 0, 7 ), $a['branche'], $a['team'], $a['taken'] );
		foreach ( $tasks as $t ) {
			$row[] = isset( $a['uren'][ $t ] ) ? (int) $a['uren'][ $t ] : '';
		}
		$rows[] = array_merge( $row, array( $a['tools'], $a['ai_gebruik'], $a['timing'], $l['calc']['besparing_uren_per_week'], $l['calc']['besparing_euro_per_jaar'], $l['calc']['kansenscore'], $l['temp'] ) );
	}
	veryo_send_csv( 'veryo-ai-scan-statistieken-' . gmdate( 'Y-m-d' ) . '.csv', $header, $rows );
}
add_action( 'admin_post_veryo_export_stats', 'veryo_export_stats' );

/*
 * Bewaartermijn: dagelijks opschonen
 */

/**
 * Dagelijkse taak inplannen.
 */
function veryo_schedule_cleanup() {
	if ( ! wp_next_scheduled( 'veryo_cleanup_leads' ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'veryo_cleanup_leads' );
	}
}
add_action( 'init', 'veryo_schedule_cleanup' );

/**
 * Leads ouder dan de bewaartermijn verwijderen.
 *
 * @return int Aantal verwijderd.
 */
function veryo_cleanup_leads() {
	$months = max( 1, (int) veryo_setting( 'retention_months', 24 ) );
	$ids    = get_posts(
		array(
			'post_type'      => 'veryo_lead',
			'post_status'    => 'any',
			'posts_per_page' => 200, // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page -- export voor beheerders.
			'fields'         => 'ids',
			'date_query'     => array(
				array(
					'column' => 'post_date_gmt',
					'before' => gmdate( 'Y-m-d H:i:s', (int) strtotime( '-' . $months . ' months' ) ),
				),
			),
		)
	);
	foreach ( $ids as $id ) {
		wp_delete_post( $id, true );
	}
	return count( $ids );
}
add_action( 'veryo_cleanup_leads', 'veryo_cleanup_leads' );

/**
 * Geplande taken opruimen als het thema wordt uitgeschakeld.
 */
function veryo_unschedule_on_switch() {
	wp_clear_scheduled_hook( 'veryo_cleanup_leads' );
}
add_action( 'switch_theme', 'veryo_unschedule_on_switch' );
