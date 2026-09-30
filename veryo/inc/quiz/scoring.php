<?php
/**
 * Deterministische berekening van de AI-scan (server-side). De AI rekent niets.
 *
 * Formules:
 *  - besparing_uren_per_week = round( Σ ( uren_taak × factor_taak ) ), minimaal 0
 *  - besparing_euro_per_jaar = round( uren_per_week × werkweken × kostprijs_per_uur / 100 ) × 100
 *  - kansenscore (0–100)     = min( 100, round( 20 + 5 × uren_per_week
 *                                     + ( team ≥ 6 ? 10 : 0 )
 *                                     + ( AI-gebruik is "nee" of "een keer geprobeerd" ? 10 : 0 ) ) )
 *  - lead_temperatuur        = heet  als timing "nu" én ( team ≥ 6 of uren_per_week ≥ 8 )
 *                              warm  als timing "nu" of "binnen 3 maanden"
 *                              koud  anders
 *
 * De besparingsfactoren zijn aan te passen met het filter 'veryo_scan_factors', bijvoorbeeld in
 * een eigen plugin of child theme:
 *
 *     add_filter( 'veryo_scan_factors', function ( $f ) { $f['offertes'] = 0.4; return $f; } );
 *
 * Werkweken en kostprijs per uur staan in Instellingen > Veryo.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Besparingsfactoren per taak (aandeel van de uren dat met AI/automatisering te besparen is).
 *
 * @return array<string,float>
 */
function veryo_scan_factors() {
	$defaults = array(
		'email'         => 0.35,
		'offertes'      => 0.50,
		'administratie' => 0.50,
		'planning'      => 0.30,
		'telefoon'      => 0.30,
		'content'       => 0.40,
		'rapportages'   => 0.50,
		'werving'       => 0.30,
	);
	$factors  = apply_filters( 'veryo_scan_factors', $defaults );
	$factors  = is_array( $factors ) ? $factors : $defaults;
	foreach ( $defaults as $key => $value ) {
		$factors[ $key ] = isset( $factors[ $key ] ) ? max( 0.0, min( 1.0, (float) $factors[ $key ] ) ) : $value;
	}
	return $factors;
}

/**
 * Is het team 6 mensen of groter?
 *
 * @param string $team Teamgrootte-sleutel.
 * @return bool
 */
function veryo_scan_team_is_large( $team ) {
	return in_array( $team, array( '6-20', '21-50', '50+' ), true );
}

/**
 * Bereken alle cijfers uit de (gesaniteerde) antwoorden.
 *
 * @param array<string,mixed> $answers Antwoorden.
 * @return array<string,mixed>
 */
function veryo_scan_calculate( $answers ) {
	$factors = veryo_scan_factors();
	$weeks   = max( 1, (int) veryo_setting( 'work_weeks', 46 ) );
	$cost    = max( 0, (float) veryo_setting( 'hourly_cost', 45 ) );

	$per_task = array();
	$total    = 0.0;
	foreach ( (array) $answers['taken'] as $task ) {
		$hours             = isset( $answers['uren'][ $task ] ) ? (int) $answers['uren'][ $task ] : 0;
		$saving            = $hours * ( isset( $factors[ $task ] ) ? $factors[ $task ] : 0 );
		$per_task[ $task ] = array(
			'uren'      => $hours,
			'factor'    => isset( $factors[ $task ] ) ? $factors[ $task ] : 0,
			'besparing' => round( $saving, 1 ),
		);
		$total            += $saving;
	}

	$hours_week = max( 0, (int) round( $total ) );
	$euro_year  = (int) ( round( $hours_week * $weeks * $cost / 100 ) * 100 );

	$score = 20 + 5 * $hours_week;
	if ( veryo_scan_team_is_large( (string) $answers['team'] ) ) {
		$score += 10;
	}
	if ( in_array( $answers['ai_gebruik'], array( 'nee', 'geprobeerd' ), true ) ) {
		$score += 10;
	}
	$score = (int) min( 100, round( $score ) );

	$timing = (string) $answers['timing'];
	if ( 'nu' === $timing && ( veryo_scan_team_is_large( (string) $answers['team'] ) || $hours_week >= 8 ) ) {
		$temp = 'heet';
	} elseif ( in_array( $timing, array( 'nu', '3-maanden' ), true ) ) {
		$temp = 'warm';
	} else {
		$temp = 'koud';
	}

	return array(
		'besparing_uren_per_week' => $hours_week,
		'besparing_euro_per_jaar' => $euro_year,
		'kansenscore'             => $score,
		'lead_temperatuur'        => $temp,
		'per_taak'                => $per_task,
		'aannames'                => array(
			'kostprijs_per_uur' => $cost,
			'werkweken'         => $weeks,
		),
	);
}

/**
 * Zin met de aannames, voor mini-resultaat, rapport en e-mail.
 *
 * @param array<string,mixed> $calc Berekening.
 * @return string
 */
function veryo_scan_assumptions_text( $calc ) {
	return sprintf(
		/* translators: 1: kostprijs per uur, 2: aantal werkweken. */
		__( 'Gerekend met %1$s per uur en %2$d werkweken; dit is een indicatie.', 'veryo' ),
		veryo_euro( $calc['aannames']['kostprijs_per_uur'] ),
		(int) $calc['aannames']['werkweken']
	);
}

/**
 * Label voor een temperatuur.
 *
 * @param string $temp heet|warm|koud.
 * @return string
 */
function veryo_temp_label( $temp ) {
	$labels = array(
		'heet' => __( 'Heet', 'veryo' ),
		'warm' => __( 'Warm', 'veryo' ),
		'koud' => __( 'Koud', 'veryo' ),
	);
	return isset( $labels[ $temp ] ) ? $labels[ $temp ] : '';
}
