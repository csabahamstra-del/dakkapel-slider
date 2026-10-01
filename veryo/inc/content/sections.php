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
 * @param string                       $css_class Extra class voor de hero.
 * @return string
 */
function veryo_sec_hero( $title, $sub, $buttons = array(), $extra = '', $css_class = '' ) {
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
			'className' => trim( 'is-style-petrol veryo-hero has-check ' . $css_class ),
		)
	);
}

/**
 * Feitenbalk onder de hero: vier korte, controleerbare feiten.
 *
 * @param array<int,array<int,string>> $facts Lijst van array( label, waarde ).
 * @return string
 */
function veryo_sec_facts( $facts ) {
	$cols = array();
	foreach ( $facts as $fact ) {
		$cols[] = veryo_b_p( esc_html( $fact[0] ) ) . veryo_b_p( esc_html( $fact[1] ) );
	}
	return veryo_b_columns( $cols, array( 'className' => 'veryo-facts' ) );
}

/**
 * Sectiekop over de volle breedte: kop links, inleiding rechts.
 *
 * @param string $title Kop (H2).
 * @param string $intro Inleiding (blokken; leeg = alleen kop).
 * @return string
 */
function veryo_sec_head( $title, $intro = '' ) {
	return veryo_b_columns(
		array(
			array(
				'width' => '50%',
				'inner' => veryo_b_h( $title ),
			),
			array(
				'width' => '50%',
				'inner' => $intro,
			),
		),
		array( 'className' => 'veryo-head' )
	);
}

/**
 * Brede sectie op de homepage of een overzichtspagina.
 *
 * @param string $inner     Inhoud.
 * @param string $css_class Extra class.
 * @param string $anchor    Optioneel anker.
 * @return string
 */
function veryo_sec_wide( $inner, $css_class = '', $anchor = '' ) {
	$attrs = array(
		'align'     => 'wide',
		'className' => trim( 'veryo-section ' . $css_class ),
		'layout'    => false,
	);
	if ( $anchor ) {
		$attrs['anchor'] = $anchor;
	}
	return veryo_b_group( $inner, $attrs );
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
 * Foto uit de fotobibliotheek. Staat de foto niet in het thema, dan komt er niets:
 * geen lege plek of placeholder op de site.
 *
 * @param string $desc Omschrijving van de gewenste foto (ter referentie voor wie later foto's toevoegt).
 * @param string $alt  Alt-tekst (met het hoofdzoekwoord van de pagina).
 * @param string $key  Sleutel uit veryo_photo_library().
 * @return string
 */
function veryo_sec_photo( $desc, $alt, $key = '' ) {
	unset( $desc );
	$id = $key ? veryo_photo_id( $key ) : 0;
	return $id ? veryo_b_image( $id, $alt ) : '';
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
 * De vier echte stappen: AI-scan, kansensessie, invoeren en bouwen, onderhoud.
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
		'<strong>' . __( 'Kansensessie', 'veryo' ) . '</strong><br>' . __( 'Samen lopen we je processen door en zetten we de kansen op volgorde: wat levert het meest op, wat is snel te doen, wat laten we liggen. We kijken ook welke software je al hebt en wat die kan. De kansensessie is onderdeel van het AI-Startpakket.', 'veryo' ),
		'<strong>' . __( 'Invoeren en bouwen', 'veryo' ) . '</strong><br>' . __( 'Eerst richten we software in die je al hebt of kunt nemen, en leren we je team ermee werken. Alleen waar dat tekortschiet, bouwen we een eigen koppeling, in je eigen accounts. Eerst een proefperiode met echte gegevens, dan pas live.', 'veryo' ),
		'<strong>' . __( 'Onderhoud', 'veryo' ) . '</strong><br>' . __( 'We houden alles in de gaten en passen aan als er iets verandert. Elke koppeling heeft een logboek en een vaste eigenaar. Wil je doorlopend een vraagbaak, dan is er het AI-partner-abonnement.', 'veryo' ),
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
 * @param string[] $steps Sleutels uit veryo_price_ladder().
 * @param string   $title Kop.
 * @param string   $intro Inleiding.
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
 * Prijzen als rustige tabel (homepage): dienst, wat het is en de prijs.
 * Alleen het AI-Startpakket krijgt het amber accent.
 *
 * @param string[] $keys Sleutels uit veryo_price_ladder().
 * @return string
 */
function veryo_sec_price_table( $keys ) {
	$ladder = veryo_price_ladder();
	$items  = array();
	foreach ( $keys as $key ) {
		if ( ! isset( $ladder[ $key ] ) ) {
			continue;
		}
		$row     = $ladder[ $key ];
		$text    = '<span class="t">' . esc_html( $row['dienst'] ) . '</span> <span class="d">' . esc_html( $row['wat'] ) . '</span> <span class="p">' . esc_html( $row['prijs'] ) . '</span>';
		$items[] = 'startpakket' === $key ? array(
			'class' => 'is-featured',
			'text'  => $text,
		) : $text;
	}
	return veryo_b_list( $items, array( 'className' => 'veryo-price-table' ) );
}

/**
 * De volledige prijsladder (§7): scan, startpakket, invoering, partner. Plus losse onderdelen.
 * Het AI-Startpakket is de enige trede met een amber accent.
 *
 * @return string
 */
function veryo_sec_ladder() {
	$l   = veryo_price_ladder();
	$tag = static function ( $row ) {
		return '<strong>' . esc_html( $row['dienst'] ) . '</strong> <span class="veryo-price-tag">' . esc_html( $row['prijs'] ) . '</span>';
	};
	$sp  = array();
	foreach ( veryo_startpakket_prices() as $p ) {
		$sp[] = esc_html( $p['label'] ) . ': <strong>' . esc_html( veryo_euro( $p['price'] ) ) . '</strong>';
	}
	$items = array(
		$tag( $l['scan'] ) . '<br>' . esc_html( $l['scan']['wat'] ) . '<br><span class="veryo-meta">' . esc_html( $l['scan']['voor'] ) . '</span>',
		array(
			'class' => 'is-featured',
			'text'  => '<span class="veryo-flag">' . esc_html__( 'Hoofdproduct', 'veryo' ) . '</span><br><strong>' . esc_html( $l['startpakket']['dienst'] ) . '</strong><br>' . esc_html( $l['startpakket']['wat'] ) . '<br>' . implode( ' · ', $sp ) . '<br><span class="veryo-meta">' . esc_html( $l['startpakket']['voor'] ) . ' <a href="' . esc_url( veryo_link( 'ai-startpakket' ) ) . '">' . esc_html__( 'Alles over het AI-Startpakket', 'veryo' ) . '</a></span>',
		),
		'<strong>' . esc_html__( 'Invoering en koppelingen', 'veryo' ) . '</strong><br>' . esc_html__( 'De beste kansen uit de kansensessie invoeren: eerst met software die je al hebt of kunt nemen, alleen waar nodig met een eigen koppeling of maatwerk.', 'veryo' ) . '<br>'
			. esc_html__( 'Quick win', 'veryo' ) . ': <strong>' . esc_html( $l['quickwin']['prijs'] ) . '</strong> · ' . esc_html__( 'Project', 'veryo' ) . ': <strong>' . esc_html( $l['project']['prijs'] ) . '</strong> · ' . esc_html__( 'Maatwerk', 'veryo' ) . ': <strong>' . esc_html( $l['maatwerk']['prijs'] ) . '</strong>',
		$tag( $l['partner'] ) . '<br>' . esc_html( $l['partner']['wat'] ) . '<br><span class="veryo-meta">' . esc_html( $l['partner']['voor'] ) . ' ' . esc_html__( 'Onderhoud van gebouwde koppelingen:', 'veryo' ) . ' ' . esc_html( $l['onderhoud']['prijs'] ) . '.</span>',
	);
	$out   = veryo_b_list(
		$items,
		array(
			'ordered'   => true,
			'className' => 'is-style-ladder',
		)
	);
	$out  .= veryo_b_h( __( 'Losse onderdelen', 'veryo' ), 3 );
	$loose = array();
	foreach ( array( 'kansensessie', 'training', 'academy' ) as $key ) {
		$loose[] = $tag( $l[ $key ] ) . '<br><span class="veryo-meta">' . esc_html( $l[ $key ]['wat'] ) . '</span>';
	}
	$out .= veryo_b_list( $loose, array( 'className' => 'is-style-prices' ) );
	return $out;
}

/**
 * Het AI-Startpakket als uitgelicht product (homepage en elders).
 *
 * @param string $title Kop.
 * @param string $intro Inleiding.
 * @return string
 */
function veryo_sec_startpakket( $title = '', $intro = '' ) {
	$title = $title ? $title : __( 'Het Veryo AI-Startpakket', 'veryo' );
	$intro = $intro ? $intro : __( 'Alles wat je nodig hebt om AI goed en veilig in je bedrijf te laten landen, in één pakket met een vaste prijs.', 'veryo' );
	$parts = array();
	foreach ( veryo_startpakket_parts() as $part ) {
		$parts[] = '<strong>' . esc_html( $part[0] ) . '</strong><br>' . esc_html( $part[1] );
	}
	$prices = array();
	foreach ( veryo_startpakket_prices() as $p ) {
		$prices[] = '<span>' . esc_html( $p['label'] ) . '</span> <strong>' . esc_html( veryo_euro( $p['price'] ) ) . '</strong>';
	}
	$left   = veryo_b_h( $title, 2, array( 'fontSize' => 'display-l' ) ) . veryo_b_p( $intro, array( 'className' => 'veryo-lead' ) );
	$left  .= veryo_b_list( $parts, array( 'className' => 'is-style-parts' ) );
	$right  = veryo_b_h( __( 'Vaste prijs per teamgrootte', 'veryo' ), 3 );
	$right .= veryo_b_list( $prices, array( 'className' => 'is-style-prices' ) );
	$right .= veryo_b_p( __( 'Exclusief btw. Geen software, geen abonnement: je betaalt één keer.', 'veryo' ), array( 'className' => 'veryo-small' ) );
	$right .= veryo_b_buttons( array( array( __( 'Bekijk het AI-Startpakket', 'veryo' ), veryo_link( 'ai-startpakket' ) ) ) );
	return veryo_b_group(
		veryo_b_columns(
			array(
				array(
					'width' => '60%',
					'inner' => $left,
				),
				array(
					'width' => '40%',
					'class' => 'veryo-featured__side',
					'inner' => $right,
				),
			)
		),
		array(
			'align'     => 'wide',
			'className' => 'is-style-paper veryo-featured',
			'layout'    => false,
		)
	);
}

/**
 * "Onafhankelijk advies": Veryo verkoopt geen eigen software.
 *
 * @param string $title Kop.
 * @param bool   $wide  Brede variant met statement (homepage).
 * @return string
 */
function veryo_sec_independent( $title = '', $wide = false ) {
	$title = $title ? $title : __( 'Onafhankelijk advies', 'veryo' );
	if ( $wide ) {
		$left  = veryo_b_h( $title ) . veryo_b_p( __( 'We verkopen geen software. Daardoor kunnen we eerlijk adviseren over welke tool bij jou past.', 'veryo' ), array( 'className' => 'veryo-statement' ) );
		$right = veryo_b_p( __( 'Steeds meer pakketten die je al gebruikt, krijgen AI ingebouwd: je mailprogramma, je boekhouding, je CRM. Daar zit vaak meer in dan je denkt. Wij zorgen dat je de juiste tool kiest, dat hij goed is ingericht en dat je team hem ook echt gebruikt.', 'veryo' ) )
			. veryo_b_p( __( 'Pas als bestaande software tekortschiet, bouwen we een koppeling of iets op maat. En worden we ooit partner van een softwareleverancier waar we een vergoeding voor krijgen, dan zeggen we dat erbij als we die software adviseren.', 'veryo' ) );
		return veryo_b_group(
			veryo_b_columns(
				array(
					array(
						'width' => '50%',
						'inner' => $left,
					),
					array(
						'width' => '50%',
						'inner' => $right,
					),
				)
			),
			array(
				'align'     => 'wide',
				'className' => 'is-style-soft veryo-independent veryo-section',
				'layout'    => false,
			)
		);
	}
	$inner = veryo_b_h( $title )
		. veryo_b_p( __( 'We verkopen geen eigen software. Steeds meer pakketten die je al gebruikt, krijgen AI ingebouwd: je mailprogramma, je boekhouding, je CRM. Daar zit vaak meer in dan je denkt. Wij zorgen dat je de juiste tool kiest, dat hij goed is ingericht en dat je team hem ook echt gebruikt.', 'veryo' ) )
		. veryo_b_p( __( 'Pas als bestaande software tekortschiet, bouwen we een koppeling of iets op maat. En worden we ooit partner van een softwareleverancier waar we een vergoeding voor krijgen, dan zeggen we dat erbij als we die software adviseren.', 'veryo' ) );
	return veryo_b_group( $inner, array( 'className' => 'is-style-soft veryo-independent' ) );
}

/**
 * Aanpak per proces: eerst wat je al hebt, dan pas bouwen.
 *
 * @param string $title Kop.
 * @return string
 */
function veryo_sec_approach( $title = '' ) {
	$title = $title ? $title : __( 'Onze aanpak: eerst wat je al hebt', 'veryo' );
	$items = array(
		'<strong>' . __( 'Kijken wat er al is.', 'veryo' ) . '</strong> ' . __( 'Veel software die je al gebruikt, heeft inmiddels AI-functies. Vaak lost dat een groot deel op.', 'veryo' ),
		'<strong>' . __( 'Inrichten en trainen.', 'veryo' ) . '</strong> ' . __( 'We zetten de juiste functies aan, of kiezen samen een passende tool, en leren je team ermee werken.', 'veryo' ),
		'<strong>' . __( 'Alleen bouwen waar nodig.', 'veryo' ) . '</strong> ' . __( 'Blijft er een gat, bijvoorbeeld tussen twee systemen die niet met elkaar praten, dan bouwen we een koppeling of automatisering.', 'veryo' ),
	);
	return veryo_b_group(
		veryo_b_h( $title ) . veryo_b_list(
			$items,
			array(
				'ordered'   => true,
				'className' => 'is-style-steps',
			)
		),
		array( 'className' => 'veryo-approach' )
	);
}

/**
 * FAQ-blok. Het schema (FAQPage) wordt uit dit blok gegenereerd.
 *
 * @param array<int,array<int,string>> $faqs  Lijst van array( vraag, antwoord ).
 * @param string|false                 $title Kop; false = zonder kop (die staat dan ernaast).
 * @return string
 */
function veryo_sec_faq( $faqs, $title = '' ) {
	if ( false === $title ) {
		$inner = '';
	} else {
		$inner = veryo_b_h( $title ? $title : __( 'Veelgestelde vragen', 'veryo' ) );
	}
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
 * @param bool   $wide  Brede variant (homepage).
 * @return string
 */
function veryo_sec_branches( $title = '', $intro = '', $wide = false ) {
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
	$title = $title ? $title : __( 'AI per branche', 'veryo' );
	if ( $wide ) {
		$out = veryo_sec_head( $title, $intro ? veryo_b_p( $intro ) : '' ) . veryo_b_list( $items, array( 'className' => 'is-style-grid' ) );
		return veryo_sec_wide( $out, 'veryo-branches' );
	}
	$out = veryo_b_h( $title );
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
 * @param bool   $wide  Brede variant (homepage).
 * @return string
 */
function veryo_sec_regions( $title = '', $intro = '', $wide = false ) {
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
	if ( $wide ) {
		return veryo_sec_wide( $inner, 'veryo-regions' );
	}
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
 * Wat we doen, in vier delen, bewust in verschillende vormen (geen identieke kaarten).
 *
 * @return string
 */
function veryo_sec_services() {
	$advies  = veryo_b_h( __( 'Advies', 'veryo' ), 3, array( 'fontSize' => 'display-m' ) );
	$advies .= veryo_b_p( __( 'We zoeken uit waar AI in jouw bedrijf het meeste oplevert en welke tools daarbij passen. Vaak is dat software die je al hebt. Je krijgt een plan met prioriteiten, niet een stapel mogelijkheden.', 'veryo' ) );
	$advies .= veryo_b_list(
		array(
			__( 'Kansensessie met roadmap', 'veryo' ),
			__( 'Onafhankelijk advies over tools', 'veryo' ),
			__( 'AI-beleid op maat', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	);
	$advies .= veryo_b_buttons( array( array( __( 'Over AI-implementatie', 'veryo' ), veryo_link( 'ai-implementatie-mkb' ), 'link' ) ) );

	$training  = veryo_b_h( __( 'Training', 'veryo' ), 3 );
	$training .= veryo_b_p( __( 'Een halve of hele dag met je eigen team. Praktisch, met voorbeelden uit jullie werk, en je werkt meteen aan de AI-geletterdheid die de AI Act vraagt.', 'veryo' ) );
	$training .= veryo_b_buttons( array( array( __( 'Over de training', 'veryo' ), veryo_link( 'ai-training' ), 'link' ) ) );

	$invoering  = veryo_b_h( __( 'Invoering en koppelingen', 'veryo' ), 3 );
	$invoering .= veryo_b_p( __( 'We richten de gekozen tools in en koppelen systemen die niet met elkaar praten. Alleen waar bestaande software tekortschiet, bouwen we iets op maat.', 'veryo' ) );
	$invoering .= veryo_b_buttons( array( array( __( 'Wat er mogelijk is', 'veryo' ), veryo_link( 'ai-automatisering' ), 'link' ) ) );

	$partner = veryo_b_columns(
		array(
			array(
				'width' => '30%',
				'inner' => veryo_b_h( __( 'Partner', 'veryo' ), 3 ),
			),
			array(
				'width' => '70%',
				'inner' => veryo_b_p( __( 'Een vaste vraagbaak voor alles rond AI: maandelijks overleg, nieuwe medewerkers bijscholen en kleine verbeteringen. Zodat het niet stilvalt na de eerste maand.', 'veryo' ) )
					. veryo_b_buttons( array( array( __( 'Over het AI-partner-abonnement', 'veryo' ), veryo_link( 'ai-partner' ), 'link' ) ) ),
			),
		),
		array( 'className' => 'veryo-partner-row' )
	);

	$inner  = veryo_sec_head( __( 'Wat we doen', 'veryo' ), veryo_b_p( __( 'Van het eerste advies tot een vaste vraagbaak. Je kunt bij elke stap instappen, en we doen alleen wat zichtbaar tijd of geld oplevert.', 'veryo' ) ) );
	$inner .= veryo_b_columns(
		array(
			array(
				'width' => '58%',
				'class' => 'veryo-service-main',
				'inner' => $advies,
			),
			array(
				'width' => '42%',
				'class' => 'veryo-service-side',
				'inner' => veryo_b_group( $training, array( 'className' => 'veryo-service-plain' ) ) . veryo_b_group( $invoering, array( 'className' => 'veryo-service-plain' ) ),
			),
		)
	);
	$inner .= $partner;
	return veryo_b_group(
		$inner,
		array(
			'align'     => 'wide',
			'className' => 'veryo-services veryo-section',
			'anchor'    => 'wat-we-doen',
			'layout'    => false,
		)
	);
}

/**
 * Stappen op de homepage: AI-scan, AI-Startpakket, invoering, AI-partner.
 *
 * @return string
 */
function veryo_sec_steps_home() {
	$steps = array(
		'<strong>' . __( 'Gratis AI-scan', 'veryo' ) . '</strong><br>' . __( 'Negen vragen, drie minuten, en je weet waar de tijdwinst zit.', 'veryo' ),
		'<strong>' . __( 'AI-Startpakket', 'veryo' ) . '</strong><br>' . __( 'Kansensessie, teamtraining, AI-beleid, één quick win ingericht en 30 dagen nazorg.', 'veryo' ),
		'<strong>' . __( 'Invoering van de beste kansen', 'veryo' ) . '</strong><br>' . __( 'Eerst met software die je al hebt, alleen waar nodig met een eigen koppeling.', 'veryo' ),
		'<strong>' . __( 'AI-partner', 'veryo' ) . '</strong><br>' . __( 'Een vaste vraagbaak die zorgt dat het blijft werken en beter wordt.', 'veryo' ),
	);
	return veryo_b_group(
		veryo_sec_head( __( 'Zo werken we', 'veryo' ), veryo_b_p( __( 'Vier stappen, van eerste vraag tot een team dat er elke dag mee werkt. Je kunt na elke stap stoppen.', 'veryo' ) ) )
		. veryo_b_list(
			$steps,
			array(
				'ordered'   => true,
				'className' => 'is-style-steps',
			)
		),
		array(
			'align'     => 'wide',
			'className' => 'veryo-steps veryo-steps--home veryo-section',
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
		$out .= veryo_sec_photo( $d['photo'][0], $d['photo'][1], isset( $d['photo'][2] ) ? $d['photo'][2] : '' );
	}
	if ( ! empty( $d['approach'] ) ) {
		$out .= veryo_sec_approach();
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
	if ( empty( $d['no_steps'] ) ) {
		$out .= veryo_sec_steps( isset( $d['steps_title'] ) ? $d['steps_title'] : '', isset( $d['steps_intro'] ) ? $d['steps_intro'] : '' );
	}
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
