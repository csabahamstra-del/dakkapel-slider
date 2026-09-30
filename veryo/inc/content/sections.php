<?php
/**
 * Terugkerende secties als block markup. Dezelfde functies voeden de block patterns
 * en de pagina-inhoud die bij activatie wordt aangemaakt.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Relatieve URL naar een pagina van het thema (werkt vóór en na het aanmaken van pagina's).
 *
 * @param string $path Pad.
 * @return string
 */
function veryo_link( $path ) {
	$path = trim( $path, '/' );
	return '' === $path ? home_url( '/' ) : home_url( '/' . $path . '/' );
}

/**
 * Hero op petrol met groot vinkje.
 *
 * @param string                       $title    H1.
 * @param string                       $sub      Subregel.
 * @param array<int,array<int,string>> $buttons  Knoppen.
 * @param string                       $extra    Extra blokken onder de knoppen.
 * @return string
 */
function veryo_sec_hero( $title, $sub, $buttons = array(), $extra = '' ) {
	$inner  = veryo_b_h( $title, 1, array( 'fontSize' => 'display-xl' ) );
	$inner .= veryo_b_p( $sub, array( 'className' => 'veryo-lead' ) );
	if ( $buttons ) {
		$inner .= veryo_b_buttons( $buttons );
	}
	$inner .= $extra;
	return veryo_b_group(
		$inner,
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'is-style-petrol veryo-hero has-check',
		)
	);
}

/**
 * Het direct-antwoordblok bovenaan dienst-, regio- en branchepagina's.
 *
 * @param string $text Antwoord in 2–3 zinnen.
 * @return string
 */
function veryo_sec_answer( $text ) {
	return veryo_b_group(
		veryo_b_p( $text, array( 'fontSize' => 'body-l' ) ),
		array( 'className' => 'is-style-answer veryo-answer' )
	);
}

/**
 * Plek voor een echte foto.
 *
 * @param string $desc Omschrijving van de gewenste foto.
 * @param string $alt  Voorgestelde alt-tekst.
 * @return string
 */
function veryo_sec_photo( $desc, $alt ) {
	/* translators: 1: omschrijving foto, 2: alt-tekst. */
	$text = sprintf( __( '[FOTO: %1$s. Alt-tekst: %2$s]', 'veryo' ), $desc, $alt );
	return veryo_b_group(
		veryo_b_p( $text ),
		array( 'className' => 'veryo-photo' )
	);
}

/**
 * Kop met alinea's en optioneel een lijst.
 *
 * @param string   $title Kop (H2).
 * @param string[] $paras Alinea's.
 * @param string[] $items Lijstitems.
 * @param string   $style Lijststijl: '', 'checks'.
 * @return string
 */
function veryo_sec_text( $title, $paras = array(), $items = array(), $style = '' ) {
	$out = $title ? veryo_b_h( $title ) : '';
	foreach ( $paras as $para ) {
		$out .= veryo_b_p( $para );
	}
	if ( $items ) {
		$out .= veryo_b_list( $items, $style ? array( 'className' => 'is-style-' . $style ) : array() );
	}
	return $out;
}

/**
 * Catalogusitems als lijst met naam, uitleg en indicatie.
 *
 * @param string[] $ids   Catalogus-ID's.
 * @param string   $title Kop (H2).
 * @param string   $intro Inleiding.
 * @param int      $level Kopniveau.
 * @return string
 */
function veryo_sec_catalog( $ids, $title, $intro = '', $level = 2 ) {
	$levels = veryo_catalog_levels();
	$items  = array();
	foreach ( $ids as $id ) {
		$item = veryo_catalog_item( $id );
		if ( ! $item ) {
			continue;
		}
		$meta = sprintf(
			/* translators: 1: tijdwinst, 2: niveau, 3: prijs. */
			__( 'Indicatie: %1$s · %2$s (%3$s)', 'veryo' ),
			$item['tijdwinst_tekst'],
			$levels[ $item['niveau'] ]['label'],
			$levels[ $item['niveau'] ]['price']
		);
		$items[] = '<strong>' . esc_html( $item['naam'] ) . '</strong><br>' . esc_html( $item['wat'] ) . '<br><span class="veryo-meta">' . esc_html( $meta ) . '</span>';
	}
	$out = $title ? veryo_b_h( $title, $level ) : '';
	if ( $intro ) {
		$out .= veryo_b_p( $intro );
	}
	$out .= veryo_b_list( $items, array( 'className' => 'is-style-catalog' ) );
	return $out;
}

/**
 * De vier echte stappen: AI-scan, kansensessie, bouwen, onderhoud.
 *
 * @param string $title Kop.
 * @param string $intro Optionele inleiding.
 * @return string
 */
function veryo_sec_steps( $title = '', $intro = '' ) {
	$title = $title ? $title : __( 'Zo werkt het', 'veryo' );
	$steps = array(
		'<strong>' . __( 'Gratis AI-scan', 'veryo' ) . '</strong><br>' . sprintf(
			/* translators: %s: link naar de AI-scan. */
			__( 'Je beantwoordt negen vragen over je bedrijf en krijgt een rapport met je drie grootste tijdwinsten. Duurt ongeveer drie minuten. <a href="%s">Start de AI-scan</a>.', 'veryo' ),
			esc_url( veryo_link( 'waar-begin-ik-met-ai' ) )
		),
		'<strong>' . __( 'Kansensessie', 'veryo' ) . '</strong><br>' . __( 'Samen lopen we je processen door en zetten we de kansen op volgorde: wat levert het meest op, wat is snel te doen, wat laten we liggen. Je krijgt een roadmap met prioriteiten.', 'veryo' ),
		'<strong>' . __( 'Bouwen', 'veryo' ) . '</strong><br>' . __( 'We bouwen in je eigen accounts en koppelen aan de software die je al gebruikt. Eerst een proefperiode met echte gegevens, dan pas live.', 'veryo' ),
		'<strong>' . __( 'Onderhoud', 'veryo' ) . '</strong><br>' . __( 'We houden de automatiseringen in de gaten, passen aan als er iets verandert en elke automatisering heeft een logboek en een vaste eigenaar.', 'veryo' ),
	);
	$out   = veryo_b_h( $title );
	if ( $intro ) {
		$out .= veryo_b_p( $intro );
	}
	$out .= veryo_b_list(
		$steps,
		array(
			'ordered'   => true,
			'className' => 'is-style-steps',
		)
	);
	return veryo_b_group( $out, array( 'className' => 'veryo-steps' ) );
}

/**
 * Prijsindicatie met enkele treden van de ladder en link naar /prijzen/.
 *
 * @param int[]  $steps Stapnummers uit de prijsladder.
 * @param string $title Kop.
 * @param string $intro Inleiding.
 * @return string
 */
function veryo_sec_price( $steps, $title = '', $intro = '' ) {
	$ladder = veryo_price_ladder();
	$items  = array();
	foreach ( $steps as $n ) {
		if ( ! isset( $ladder[ $n ] ) ) {
			continue;
		}
		$items[] = '<strong>' . esc_html( $ladder[ $n ]['dienst'] ) . '</strong>: ' . esc_html( $ladder[ $n ]['prijs'] );
	}
	$title = $title ? $title : __( 'Wat kost het?', 'veryo' );
	$out   = veryo_b_h( $title );
	if ( $intro ) {
		$out .= veryo_b_p( $intro );
	}
	$out .= veryo_b_list( $items, array( 'className' => 'is-style-prices' ) );
	$out .= veryo_b_p(
		sprintf(
			/* translators: %s: link naar prijzen. */
			__( 'Alle bedragen zijn exclusief btw en een indicatie. Je krijgt vooraf altijd een vaste prijs. <a href="%s">Bekijk alle prijzen</a>.', 'veryo' ),
			esc_url( veryo_link( 'prijzen' ) )
		),
		array( 'className' => 'veryo-small' )
	);
	return veryo_b_group( $out, array( 'className' => 'is-style-soft veryo-price' ) );
}

/**
 * De volledige prijsladder (§7) als opeenvolging.
 *
 * @return string
 */
function veryo_sec_ladder() {
	$items = array();
	foreach ( veryo_price_ladder() as $row ) {
		$items[] = '<strong>' . esc_html( $row['dienst'] ) . '</strong> <span class="veryo-price-tag">' . esc_html( $row['prijs'] ) . '</span><br>' . esc_html( $row['wat'] ) . '<br><span class="veryo-meta">' . esc_html( $row['voor'] ) . '</span>';
	}
	return veryo_b_list(
		$items,
		array(
			'ordered'   => true,
			'className' => 'is-style-ladder',
		)
	);
}

/**
 * FAQ-blok. Het schema (FAQPage) wordt uit dit blok gegenereerd.
 *
 * @param array<int,array<int,string>> $faqs  Lijst van array( vraag, antwoord ).
 * @param string                       $title Kop.
 * @return string
 */
function veryo_sec_faq( $faqs, $title = '' ) {
	$title = $title ? $title : __( 'Veelgestelde vragen', 'veryo' );
	$inner = veryo_b_h( $title );
	foreach ( $faqs as $faq ) {
		$inner .= veryo_b_details( $faq[0], $faq[1] );
	}
	return veryo_b_group( $inner, array( 'className' => 'veryo-faq' ) );
}

/**
 * CTA-blok voor de AI-scan, op petrol met groot vinkje.
 *
 * @param string $title Kop.
 * @param string $text  Tekst.
 * @return string
 */
function veryo_sec_cta_scan( $title = '', $text = '' ) {
	$title = $title ? $title : __( 'Benieuwd wat AI jouw bedrijf oplevert?', 'veryo' );
	$text  = $text ? $text : __( 'Doe de gratis AI-scan. Negen vragen, ongeveer drie minuten, en je krijgt een persoonlijk rapport met je drie grootste tijdwinsten. Je zit nergens aan vast.', 'veryo' );
	$inner = veryo_b_h( $title, 2, array( 'fontSize' => 'display-l' ) )
		. veryo_b_p( $text, array( 'className' => 'veryo-lead' ) )
		. veryo_b_buttons( array( array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ) ) );
	return veryo_b_group(
		$inner,
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'is-style-petrol veryo-cta has-check',
		)
	);
}

/**
 * Overzicht van alle branches met links.
 *
 * @param string $title Kop.
 * @param string $intro Inleiding.
 * @return string
 */
function veryo_sec_branches( $title = '', $intro = '' ) {
	$branches = array(
		'installatie'               => array( __( 'Installatietechniek', 'veryo' ), __( 'Offertes, werkbonnen en storingen', 'veryo' ) ),
		'bouw'                      => array( __( 'Bouw en aannemerij', 'veryo' ), __( 'Materiaalstaten, nacalculatie en meerwerk', 'veryo' ) ),
		'agri'                      => array( __( 'Agri en mechanisatie', 'veryo' ), __( 'Onderhoud, keuringen en onderdelen', 'veryo' ) ),
		'makelaardij'               => array( __( 'Makelaardij', 'veryo' ), __( 'Inbox, bezichtigingen en woningteksten', 'veryo' ) ),
		'zakelijke-dienstverlening' => array( __( 'Accountants en adviesbureaus', 'veryo' ), __( 'Verslagen, samenvattingen en kennis', 'veryo' ) ),
		'horeca-retail'             => array( __( 'Horeca en retail', 'veryo' ), __( 'Reviews, social en reserveringen', 'veryo' ) ),
		'transport'                 => array( __( 'Transport en logistiek', 'veryo' ), __( 'Planning, statusberichten en documenten', 'veryo' ) ),
		'recruitment'               => array( __( 'Werving en recruitment', 'veryo' ), __( 'Solliciteren via WhatsApp', 'veryo' ) ),
	);
	$items    = array();
	foreach ( $branches as $slug => $b ) {
		$items[] = '<a href="' . esc_url( veryo_link( 'branches/' . $slug ) ) . '">' . esc_html( $b[0] ) . '</a><br><span class="veryo-meta">' . esc_html( $b[1] ) . '</span>';
	}
	$out = veryo_b_h( $title ? $title : __( 'AI per branche', 'veryo' ) );
	if ( $intro ) {
		$out .= veryo_b_p( $intro );
	}
	$out .= veryo_b_list( $items, array( 'className' => 'is-style-grid' ) );
	return veryo_b_group( $out, array( 'className' => 'veryo-branches' ) );
}

/**
 * Regioblok: Friesland, Groningen, Drenthe en Leeuwarden.
 *
 * @param string $title Kop.
 * @param string $intro Inleiding.
 * @return string
 */
function veryo_sec_regions( $title = '', $intro = '' ) {
	$title = $title ? $title : __( 'Uit Leeuwarden, voor heel Noord-Nederland', 'veryo' );
	$intro = $intro ? $intro : __( 'Veryo zit in Leeuwarden. In Friesland, Groningen en Drenthe komen we gewoon langs: aan de keukentafel, in de werkplaats of op kantoor. Trainingen en online diensten doen we ook in de rest van Nederland.', 'veryo' );
	$items = array(
		'<a href="' . esc_url( veryo_link( 'ai-adviseur-friesland' ) ) . '">' . __( 'AI-adviseur in Friesland', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Leeuwarden, Heerenveen, Sneek, Drachten, Harlingen, Dokkum', 'veryo' ) . '</span>',
		'<a href="' . esc_url( veryo_link( 'ai-adviseur-groningen' ) ) . '">' . __( 'AI-adviseur in Groningen', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Stad Groningen, Veendam, Hoogezand, Delfzijl, Winsum', 'veryo' ) . '</span>',
		'<a href="' . esc_url( veryo_link( 'ai-adviseur-drenthe' ) ) . '">' . __( 'AI-adviseur in Drenthe', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Assen, Emmen, Hoogeveen, Meppel', 'veryo' ) . '</span>',
		'<a href="' . esc_url( veryo_link( 'leeuwarden' ) ) . '">' . __( 'AI-training en automatisering in Leeuwarden', 'veryo' ) . '</a><br><span class="veryo-meta">' . __( 'Onze thuisbasis', 'veryo' ) . '</span>',
	);
	$inner = veryo_b_columns(
		array(
			array(
				'width' => '42%',
				'inner' => veryo_b_h( $title ) . veryo_b_p( $intro ),
			),
			array(
				'width' => '58%',
				'inner' => veryo_b_list( $items, array( 'className' => 'is-style-regions' ) ),
			),
		)
	);
	return veryo_b_group( $inner, array( 'className' => 'veryo-regions' ) );
}

/**
 * Interne links naar gerelateerde pagina's.
 *
 * @param array<int,array<int,string>> $links Lijst van array( pad, linktekst, korte uitleg ).
 * @param string                       $title Kop.
 * @return string
 */
function veryo_sec_links( $links, $title = '' ) {
	$items = array();
	foreach ( $links as $link ) {
		$items[] = '<a href="' . esc_url( veryo_link( $link[0] ) ) . '">' . esc_html( $link[1] ) . '</a>' . ( ! empty( $link[2] ) ? '<br><span class="veryo-meta">' . esc_html( $link[2] ) . '</span>' : '' );
	}
	$out = veryo_b_h( $title ? $title : __( 'Verder lezen', 'veryo' ) ) . veryo_b_list( $items, array( 'className' => 'is-style-related' ) );
	return veryo_b_group( $out, array( 'className' => 'veryo-related' ) );
}

/**
 * Cases en reviews. Verborgen zolang "Toon cases" uit staat (zie veryo_hide_cases_block).
 *
 * @return string
 */
function veryo_sec_cases() {
	$inner  = veryo_b_h( __( 'Wat klanten zeggen', 'veryo' ) );
	$inner .= veryo_b_p( __( '[VUL IN: echte klantcase, met toestemming van de klant: branche, uitgangssituatie, wat we hebben gebouwd en het gemeten resultaat]', 'veryo' ) );
	$inner .= veryo_b_p( __( '[VUL IN: echte review met naam, functie en bedrijf, alleen met toestemming]', 'veryo' ) );
	return veryo_b_group( $inner, array( 'className' => 'veryo-cases is-style-paper' ) );
}

/**
 * Diensten op de homepage: bewust drie verschillende vormen, geen identieke kaarten.
 *
 * @return string
 */
function veryo_sec_services() {
	$main  = veryo_b_h( __( 'AI-automatisering', 'veryo' ), 3, array( 'fontSize' => 'display-m' ) );
	$main .= veryo_b_p( __( 'Terugkerend werk dat elke week uren kost, laten we door AI en slimme koppelingen doen: mail, offertes, facturen, werkbonnen en planning. We bouwen in je eigen software en accounts.', 'veryo' ) );
	$main .= veryo_b_list(
		array(
			__( 'Offertes van aanvraag tot concept', 'veryo' ),
			__( 'Inkoopfacturen automatisch in je boekhouding', 'veryo' ),
			__( 'WhatsApp-vragen 24/7 beantwoord', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	);
	$main .= veryo_b_buttons( array( array( __( 'Bekijk AI-automatisering', 'veryo' ), veryo_link( 'ai-automatisering' ), 'link' ) ) );

	$training  = veryo_b_h( __( 'AI-training', 'veryo' ), 3 );
	$training .= veryo_b_p( __( 'Een halve of hele dag met je eigen team. Praktisch, met voorbeelden uit jullie werk, en je voldoet meteen aan de AI-geletterdheidsplicht uit de AI Act.', 'veryo' ) );
	$training .= veryo_b_buttons( array( array( __( 'Over de training', 'veryo' ), veryo_link( 'ai-training' ), 'link' ) ) );

	$maat  = veryo_b_h( __( 'AI op maat', 'veryo' ), 3 );
	$maat .= veryo_b_p( __( 'Een chatbot op je eigen kennis, een WhatsApp-assistent of een AI-agent die een heel proces oppakt. Voor vragen die een standaardflow niet oplost.', 'veryo' ) );
	$maat .= veryo_b_buttons( array( array( __( 'Over AI op maat', 'veryo' ), veryo_link( 'ai-op-maat' ), 'link' ) ) );

	$inner  = veryo_b_h( __( 'Drie manieren waarop we helpen', 'veryo' ) );
	$inner .= veryo_b_columns(
		array(
			array(
				'width' => '58%',
				'class' => 'veryo-service-main',
				'inner' => $main,
			),
			array(
				'width' => '42%',
				'class' => 'veryo-service-side',
				'inner' => veryo_b_group( $training, array( 'className' => 'is-style-soft' ) ) . veryo_b_group( $maat, array( 'className' => 'veryo-service-plain' ) ),
			),
		)
	);
	return veryo_b_group(
		$inner,
		array(
			'align'     => 'wide',
			'className' => 'veryo-services',
			'anchor'    => 'wat-we-doen',
			'layout'    => false,
		)
	);
}

/**
 * Standaardopbouw voor dienst-, regio- en branchepagina's (§5).
 *
 * @param array<string,mixed> $d Pagina-onderdelen.
 * @return string
 */
function veryo_page_standard( $d ) {
	$out = veryo_sec_answer( $d['answer'] );

	if ( ! empty( $d['problem'] ) ) {
		$out .= veryo_sec_text( $d['problem']['h'], $d['problem']['p'], isset( $d['problem']['list'] ) ? $d['problem']['list'] : array() );
	}
	if ( ! empty( $d['photo'] ) ) {
		$out .= veryo_sec_photo( $d['photo'][0], $d['photo'][1] );
	}
	if ( ! empty( $d['catalog'] ) ) {
		$out .= veryo_sec_catalog( $d['catalog']['ids'], $d['catalog']['h'], isset( $d['catalog']['intro'] ) ? $d['catalog']['intro'] : '' );
	}
	if ( ! empty( $d['sections'] ) ) {
		foreach ( $d['sections'] as $section ) {
			$out .= veryo_sec_text(
				$section['h'],
				isset( $section['p'] ) ? $section['p'] : array(),
				isset( $section['list'] ) ? $section['list'] : array(),
				isset( $section['style'] ) ? $section['style'] : ''
			);
		}
	}
	if ( ! empty( $d['extra'] ) ) {
		$out .= veryo_sec_text( $d['extra'][0], $d['extra'][1] );
	}
	$out .= veryo_sec_steps( isset( $d['steps_title'] ) ? $d['steps_title'] : '', isset( $d['steps_intro'] ) ? $d['steps_intro'] : '' );
	if ( ! empty( $d['price'] ) ) {
		$out .= veryo_sec_price( $d['price']['steps'], isset( $d['price']['h'] ) ? $d['price']['h'] : '', isset( $d['price']['p'] ) ? $d['price']['p'] : '' );
	}
	if ( ! empty( $d['after_price'] ) ) {
		$out .= $d['after_price'];
	}
	if ( ! empty( $d['faq'] ) ) {
		$out .= veryo_sec_faq( $d['faq'] );
	}
	$cta  = isset( $d['cta'] ) ? $d['cta'] : array( '', '' );
	$out .= veryo_sec_cta_scan( $cta[0], $cta[1] );
	if ( ! empty( $d['links'] ) ) {
		$out .= veryo_sec_links( $d['links'] );
	}
	return $out;
}
