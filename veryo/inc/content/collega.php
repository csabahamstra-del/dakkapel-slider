<?php
/**
 * Veryo Collega: shortcodes, herbruikbare blokken en de secties van de productpagina.
 * Naam, prijzen en knopteksten komen uit veryo_collega() (inc/collega-config.php).
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'veryo_collega_naam', 'veryo_sc_collega_naam' );
add_shortcode( 'veryo_collega_ondertitel', 'veryo_sc_collega_ondertitel' );
add_shortcode( 'veryo_collega_prijs', 'veryo_sc_collega_prijs' );
add_shortcode( 'veryo_collega_cta', 'veryo_sc_collega_cta' );
add_shortcode( 'veryo_collega_prijzen', 'veryo_sc_collega_prijzen' );
add_shortcode( 'veryo_collega_rekenhulp', 'veryo_sc_collega_rekenhulp' );
add_shortcode( 'veryo_collega_visual', 'veryo_sc_collega_visual' );
add_shortcode( 'veryo_collega_blok', 'veryo_sc_collega_blok' );
add_shortcode( 'veryo_collega_contact', 'veryo_sc_collega_contact' );

/**
 * Contactregel uit de centrale variabelen.
 *
 * @return string
 */
function veryo_sc_collega_contact() {
	$c = veryo_collega();
	return '<p class="veryo-small veryo-collega-contact">' . sprintf(
		/* translators: 1: tel-link, 2: telefoonnummer, 3: e-mailadres, 4: plaats, 5: werkgebied. */
		esc_html__( 'Liever direct contact? Bel %1$s of mail %3$s. Vanuit %4$s, %5$s.', 'veryo' ),
		'<a href="' . esc_attr( veryo_tel_href( $c['telefoon'] ) ) . '">' . str_replace( '-', '&#8209;', esc_html( $c['telefoon'] ) ) . '</a>',
		'',
		'<a href="mailto:' . esc_attr( $c['email'] ) . '">' . esc_html( $c['email'] ) . '</a>',
		esc_html( $c['plaats'] ),
		esc_html( $c['werkgebied'] )
	) . '</p>';
}

/**
 * Productnaam.
 *
 * @return string
 */
function veryo_sc_collega_naam() {
	return esc_html( veryo_collega()['naam'] );
}

/**
 * Ondertitel.
 *
 * @return string
 */
function veryo_sc_collega_ondertitel() {
	return esc_html( veryo_collega()['ondertitel'] );
}

/**
 * Eén prijs: een maandpakket (start, groei, pro) of een eenmalige post (intake, koppelingen, ...).
 *
 * @param array<string,string>|string $atts Attributen: id.
 * @return string
 */
function veryo_sc_collega_prijs( $atts ) {
	$atts = shortcode_atts( array( 'id' => 'start' ), $atts, 'veryo_collega_prijs' );
	$c    = veryo_collega();
	if ( isset( $c['pakketten'][ $atts['id'] ] ) ) {
		return esc_html( veryo_collega_euro( $c['pakketten'][ $atts['id'] ]['prijs'] ) );
	}
	if ( isset( $c['eenmalig'][ $atts['id'] ] ) ) {
		return esc_html( veryo_collega_euro( $c['eenmalig'][ $atts['id'] ]['prijs'] ) );
	}
	return '';
}

/**
 * De twee knoppen: Plan een demo en Bereken wat het je oplevert.
 *
 * @param array<string,string>|string $atts Attributen: secundair = rekenhulp|product.
 * @return string
 */
function veryo_sc_collega_cta( $atts ) {
	$atts      = shortcode_atts( array( 'secundair' => 'rekenhulp' ), $atts, 'veryo_collega_cta' );
	$c         = veryo_collega();
	$secondary = 'product' === $atts['secundair']
		/* translators: %s: productnaam. */
		? '<a class="btn btn--link" href="' . esc_url( veryo_collega_url() ) . '">' . esc_html( sprintf( __( 'Zo werkt %s', 'veryo' ), $c['naam'] ) ) . '</a>'
		: '<a class="btn btn--link" href="' . esc_url( veryo_collega_url( 'rekenhulp' ) ) . '">' . esc_html( $c['cta_secundair'] ) . '</a>';
	return '<div class="veryo-cta-buttons veryo-collega-cta"><a class="btn btn--amber" href="' . esc_url( veryo_collega_url( 'demo' ) ) . '">' . esc_html( $c['cta_primair'] ) . '</a> ' . $secondary . '</div>';
}

/**
 * Pakketten en prijzen: eenmalige posten en drie maandpakketten.
 *
 * @return string
 */
function veryo_sc_collega_prijzen() {
	$c   = veryo_collega();
	$out = '<div class="veryo-collega-prices">';

	$out .= '<div class="veryo-collega-once"><h3>' . esc_html__( 'Eenmalig', 'veryo' ) . '</h3><ul class="veryo-price-table">';
	foreach ( $c['eenmalig'] as $row ) {
		$price = ( $row['vanaf'] ? __( 'vanaf', 'veryo' ) . ' ' : '' ) . veryo_collega_euro( $row['prijs'] );
		$out  .= '<li><span class="t">' . esc_html( $row['label'] ) . '</span><span class="d">' . esc_html( $row['notitie'] ) . '</span><span class="p">' . esc_html( $price ) . '</span></li>';
	}
	$out .= '</ul></div>';

	$out .= '<h3 class="veryo-collega-monthly-title">' . esc_html__( 'Per maand', 'veryo' ) . '</h3><div class="veryo-collega-plans">';
	foreach ( $c['pakketten'] as $key => $plan ) {
		$items = array(
			__( 'Beheer en monitoring door Veryo', 'veryo' ),
			__( 'Updates van de software en de AI-modellen', 'veryo' ),
			__( 'Dagelijkse backups', 'veryo' ),
			/* translators: %d: aantal koppelingen. */
			sprintf( _n( '%d koppeling inbegrepen', '%d koppelingen inbegrepen', (int) $plan['koppelingen'], 'veryo' ), (int) $plan['koppelingen'] ),
			/* translators: %d: aantal uren. */
			sprintf( _n( '%d uur kennisonderhoud per maand', '%d uur kennisonderhoud per maand', (int) $plan['uren'], 'veryo' ), (int) $plan['uren'] ),
		);
		$out  .= '<div class="veryo-collega-plan' . ( $plan['uitgelicht'] ? ' is-featured' : '' ) . '" id="pakket-' . esc_attr( $key ) . '">';
		if ( $plan['uitgelicht'] ) {
			$out .= '<p class="veryo-collega-plan__badge">' . esc_html( $c['uitgelicht_label'] ) . '</p>';
		}
		$out .= '<h4>' . esc_html( $plan['naam'] ) . '</h4><p class="veryo-collega-plan__team">' . esc_html( $plan['team'] ) . '</p>';
		$out .= '<p class="veryo-collega-plan__price"><strong>' . esc_html( veryo_collega_euro( $plan['prijs'] ) ) . '</strong> ' . esc_html__( 'per maand', 'veryo' ) . '</p>';
		$out .= '<ul class="is-style-checks">';
		foreach ( $items as $item ) {
			$out .= '<li>' . esc_html( $item ) . '</li>';
		}
		$out .= '</ul><a class="btn ' . ( $plan['uitgelicht'] ? 'btn--amber' : 'btn--petrol' ) . '" href="' . esc_url( veryo_collega_url( 'demo' ) ) . '">' . esc_html( $c['cta_primair'] ) . '</a></div>';
	}
	$out .= '</div>';
	$out .= '<p class="veryo-collega-prices__note">' . esc_html( $c['hardware'] ) . ' ' . esc_html__( 'Alle prijzen zijn exclusief btw. De intake wordt verrekend als je doorgaat.', 'veryo' ) . '</p>';
	return $out . '</div>';
}

/**
 * Rekenhulp: medewerkers, uren per week aan zoeken, vragen en mailen, en uurtarief.
 * Werkt met een paar regels JavaScript (assets/js/collega.js); zonder JavaScript staat er
 * een vaste rekenvoorbeeld met de standaardwaarden.
 *
 * @return string
 */
function veryo_sc_collega_rekenhulp() {
	$c  = veryo_collega();
	$r  = $c['rekenhulp'];
	$wp = wp_script_is( 'veryo-collega', 'registered' );
	if ( $wp ) {
		wp_enqueue_script( 'veryo-collega' );
	}
	$plans = array();
	foreach ( $c['pakketten'] as $key => $plan ) {
		$plans[] = array(
			'tot'   => (int) $plan['tot'],
			'naam'  => $plan['naam'],
			'prijs' => (int) $plan['prijs'],
		);
	}
	// Standaarduitkomst, ook voor bezoekers zonder JavaScript.
	$hours   = $r['medewerkers'] * $r['uren'] * $r['besparing'] * $r['weken'];
	$value   = $hours * $r['tarief'];
	$default = $c['pakketten'][ veryo_collega_package_for( (int) $r['medewerkers'] ) ];

	$field = static function ( $id, $label, $value, $attrs, $help = '' ) {
		$extra = '';
		foreach ( $attrs as $k => $v ) {
			$extra .= ' ' . $k . '="' . esc_attr( $v ) . '"';
		}
		return '<div class="field"><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label><input type="number" inputmode="decimal" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '" value="' . esc_attr( (string) $value ) . '"' . $extra . ( $help ? ' aria-describedby="' . esc_attr( $id ) . '-help"' : '' ) . '>' . ( $help ? '<p class="field-help" id="' . esc_attr( $id ) . '-help">' . esc_html( $help ) . '</p>' : '' ) . '</div>';
	};

	$out  = '<div class="veryo-calc" data-calc="' . esc_attr(
		wp_json_encode(
			array(
				'besparing' => (float) $r['besparing'],
				'weken'     => (float) $r['weken'],
				'plans'     => $plans,
			)
		)
	) . '">';
	$out .= '<div class="veryo-calc__form" role="group" aria-label="' . esc_attr__( 'Gegevens voor de rekenhulp', 'veryo' ) . '">';
	$out .= $field(
		'calc-medewerkers',
		__( 'Aantal medewerkers', 'veryo' ),
		$r['medewerkers'],
		array(
			'min'  => '1',
			'max'  => '500',
			'step' => '1',
		)
	);
	$out .= $field(
		'calc-uren',
		__( 'Uren per week per medewerker aan zoeken, vragen en mailen', 'veryo' ),
		$r['uren'],
		array(
			'min'  => '0',
			'max'  => '40',
			'step' => '0.5',
		),
		__( 'Informatie opzoeken, collega’s iets vragen, mails lezen en beantwoorden.', 'veryo' )
	);
	$out .= $field(
		'calc-tarief',
		__( 'Uurtarief of kostprijs per uur in euro', 'veryo' ),
		$r['tarief'],
		array(
			'min'  => '0',
			'max'  => '500',
			'step' => '1',
		)
	);
	$out .= '</div>';
	$out .= '<div class="veryo-calc__result" aria-live="polite">';
	$out .= '<p class="veryo-calc__label">' . esc_html__( 'Indicatie per maand', 'veryo' ) . '</p>';
	/* translators: %s: aantal uren. */
	$out .= '<p class="veryo-calc__hours"><strong data-out="uren">' . esc_html( number_format_i18n( $hours, 0 ) ) . '</strong> ' . esc_html__( 'uur bespaard', 'veryo' ) . '</p>';
	$out .= '<p class="veryo-calc__value">' . esc_html__( 'Waarde:', 'veryo' ) . ' <strong data-out="waarde">' . esc_html( veryo_collega_euro( $value ) ) . '</strong></p>';
	$out .= '<p class="veryo-calc__plan">' . esc_html__( 'Passend pakket:', 'veryo' ) . ' <strong data-out="pakket">' . esc_html( $default['naam'] . ', ' . veryo_collega_euro( $default['prijs'] ) . ' ' . __( 'per maand', 'veryo' ) ) . '</strong></p>';
	$out .= '<p class="veryo-calc__note">' . esc_html(
		sprintf(
			/* translators: %d: percentage. */
			__( 'Dit is een indicatie, geen belofte. We rekenen met de aanname dat %d%% van die tijd wegvalt, en met 4,33 weken per maand. Wat het bij jou oplevert, hangt af van je kennis, je systemen en hoe je team ermee werkt. Exclusief eenmalige kosten en btw.', 'veryo' ),
			(int) round( $r['besparing'] * 100 )
		)
	) . '</p>';
	$out .= '<a class="btn btn--amber" href="' . esc_url( veryo_collega_url( 'demo' ) ) . '">' . esc_html( $c['cta_primair'] ) . '</a>';
	$out .= '</div></div>';
	return $out;
}

/**
 * Abstracte illustraties: het kastje op kantoor met kennis die erin stroomt, of de kabel.
 *
 * @param array<string,string>|string $atts Attributen: type = kastje|kabel.
 * @return string
 */
function veryo_sc_collega_visual( $atts ) {
	$atts = shortcode_atts( array( 'type' => 'kastje' ), $atts, 'veryo_collega_visual' );
	if ( 'kabel' === $atts['type'] ) {
		return '<div class="veryo-cable" aria-hidden="true"><svg viewBox="0 0 320 120" focusable="false">'
			. '<path class="veryo-cable__wire" d="M0 60 H118" />'
			. '<rect class="veryo-cable__plug" x="118" y="46" width="34" height="28" rx="5" />'
			. '<path class="veryo-cable__pins" d="M152 53 h12 M152 67 h12" />'
			. '<g class="veryo-cable__box"><rect x="206" y="22" width="96" height="76" rx="12" /><path d="M224 44 h60 M224 60 h60 M224 76 h36" /><circle class="veryo-cable__led" cx="284" cy="80" r="5" /></g>'
			. '</svg></div>';
	}
	$lines = '';
	$paths = array(
		'M10 40 C 90 40, 120 150, 205 170',
		'M10 110 C 80 110, 120 170, 205 185',
		'M10 190 C 90 190, 130 200, 205 200',
		'M10 270 C 90 270, 120 230, 205 215',
		'M10 340 C 90 340, 130 250, 205 230',
	);
	foreach ( $paths as $i => $d ) {
		$lines .= '<path class="veryo-box__flow" style="--i:' . (int) $i . '" d="' . esc_attr( $d ) . '" />';
	}
	$labels = array( __( 'Offertes', 'veryo' ), __( 'Werkinstructies', 'veryo' ), __( 'Mail', 'veryo' ), __( 'Projecten', 'veryo' ), __( 'Ervaring', 'veryo' ) );
	$tags   = '';
	foreach ( $labels as $i => $label ) {
		$tags .= '<text class="veryo-box__tag" x="10" y="' . ( 30 + 75 * $i ) . '">' . esc_html( $label ) . '</text>';
	}
	return '<div class="veryo-box" aria-hidden="true"><svg viewBox="0 0 420 400" focusable="false">' . $lines . $tags
		. '<g class="veryo-box__unit"><rect x="205" y="120" width="190" height="160" rx="22" /><rect class="veryo-box__screen" x="230" y="146" width="140" height="70" rx="10" />'
		. '<path class="veryo-box__check" d="M268 181 l14 14 28 -30" /><circle class="veryo-box__led" cx="360" cy="252" r="6" /><path class="veryo-box__vent" d="M232 244 h70 M232 256 h50" /></g>'
		. '<path class="veryo-box__floor" d="M170 300 H415" /></svg></div>';
}

/**
 * Herbruikbaar blok over Veryo Collega (template-parts/collega-blok.php).
 *
 * @param array<string,string>|string $atts Attributen: variant = standaard|regio|intern, regio = naam.
 * @return string
 */
function veryo_sc_collega_blok( $atts ) {
	$atts = shortcode_atts(
		array(
			'variant' => 'standaard',
			'regio'   => '',
		),
		$atts,
		'veryo_collega_blok'
	);
	ob_start();
	get_template_part( 'template-parts/collega-blok', null, $atts );
	return (string) ob_get_clean();
}

/**
 * Het blok als blokmarkup, om in pagina's op te nemen.
 *
 * @param string $variant standaard|regio|intern.
 * @param string $regio   Regionaam bij variant regio.
 * @return string
 */
function veryo_sec_collega_blok( $variant = 'standaard', $regio = '' ) {
	$sc = '[veryo_collega_blok variant=' . sanitize_key( $variant ) . ( $regio ? ' regio=' . sanitize_key( $regio ) : '' ) . ']';
	return veryo_b_shortcode( $sc );
}

/**
 * Opvallende band "Trek de internetkabel eruit" (homepage en productpagina).
 *
 * @param bool $with_link Link naar de productpagina tonen.
 * @return string
 */
function veryo_sec_collega_offline( $with_link = true ) {
	$inner = veryo_b_columns(
		array(
			array(
				'width' => '58%',
				'inner' => veryo_b_p( '[veryo_collega_naam]', array( 'className' => 'veryo-kicker' ) )
					. veryo_b_h( __( 'Trek de internetkabel eruit. Hij blijft gewoon werken.', 'veryo' ), 2, array( 'fontSize' => 'display-l' ) )
					. veryo_b_p( __( 'Omdat de AI op een eigen machine bij jou op kantoor draait, beantwoordt [veryo_collega_naam] vragen over je eigen documenten ook zonder internet. Je gegevens verlaten het pand niet voor AI-verwerking. Alleen koppelingen met cloudpakketten, zoals een online boekhoudpakket, verversen pas weer als de verbinding terug is.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
					. ( $with_link ? veryo_b_shortcode( '[veryo_collega_cta secundair=product]' ) : '' ),
			),
			array(
				'width' => '42%',
				'inner' => veryo_b_shortcode( '[veryo_collega_visual type=kabel]' ),
			),
		)
	);
	return veryo_b_group(
		$inner,
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'is-style-petrol veryo-collega-offline',
		)
	);
}

/**
 * Pakt een tekst op met de productnaam ingevuld (voor schema en llms.txt).
 *
 * @param string $text Tekst met [veryo_collega_naam] e.d.
 * @return string
 */
function veryo_collega_expand( $text ) {
	if ( false === strpos( $text, '[veryo_collega_' ) ) {
		return $text;
	}
	return preg_replace_callback(
		'/\[veryo_collega_(naam|ondertitel|prijs)(?:\s+id=([a-z]+))?\]/',
		static function ( $m ) {
			if ( 'naam' === $m[1] ) {
				return veryo_collega()['naam'];
			}
			if ( 'ondertitel' === $m[1] ) {
				return veryo_collega()['ondertitel'];
			}
			return html_entity_decode( veryo_sc_collega_prijs( array( 'id' => isset( $m[2] ) ? $m[2] : 'start' ) ) );
		},
		$text
	);
}

/**
 * Menu-items naar de productpagina tonen altijd de actuele productnaam.
 *
 * @param string $title Titel.
 * @param int    $id    Post-ID.
 * @return string
 */
function veryo_collega_menu_title( $title, $id = 0 ) {
	if ( ! $id || 'nav_menu_item' !== get_post_type( $id ) ) {
		return $title;
	}
	static $page_id = null;
	if ( null === $page_id ) {
		$page    = veryo_find_page( veryo_collega()['slug'] );
		$page_id = $page ? (int) $page->ID : 0;
	}
	if ( $page_id && (int) get_post_meta( $id, '_menu_item_object_id', true ) === $page_id && 'post_type' === get_post_meta( $id, '_menu_item_type', true ) ) {
		return veryo_collega()['naam'];
	}
	return $title;
}
add_filter( 'the_title', 'veryo_collega_menu_title', 10, 2 );

/**
 * Script voor tabs en rekenhulp registreren, en laden op de productpagina.
 */
function veryo_collega_scripts() {
	wp_register_script( 'veryo-collega', VERYO_URI . '/assets/js/collega.js', array(), VERYO_VERSION . '-' . (string) filemtime( VERYO_DIR . '/assets/js/collega.js' ), array( 'strategy' => 'defer' ) );
	if ( is_page( veryo_collega()['slug'] ) ) {
		wp_enqueue_script( 'veryo-collega' );
	}
}
add_action( 'wp_enqueue_scripts', 'veryo_collega_scripts' );

/**
 * Sectie "Voor wie": per branche twee of drie voorbeeldvragen. Met JavaScript worden het tabs.
 *
 * @return string
 */
function veryo_sec_collega_branches() {
	$branches = array(
		array(
			__( 'Vakbedrijven', 'veryo' ),
			__( 'Dakkapel-, vloeren- en kozijnbedrijven', 'veryo' ),
			array(
				__( 'Welk kozijnprofiel hebben we vorig jaar aan de Dorpsstraat geplaatst?', 'veryo' ),
				__( 'Wat is onze standaard levertijd voor een dakkapel van vier meter?', 'veryo' ),
				__( 'Zet een conceptofferte klaar op basis van de drie meest vergelijkbare projecten.', 'veryo' ),
			),
		),
		array(
			__( 'Bouw, installatie en techniek', 'veryo' ),
			__( 'Aannemers, installateurs en technische bedrijven', 'veryo' ),
			array(
				__( 'Wat betekent deze foutcode bij de warmtepompen die wij plaatsen, en hoe hebben we het eerder opgelost?', 'veryo' ),
				__( 'Vat het bestek van dit project samen: wat valt onder ons deel?', 'veryo' ),
				__( 'Welke projecten lopen deze week uit, en waarom?', 'veryo' ),
			),
		),
		array(
			__( 'Beveiliging', 'veryo' ),
			__( 'Beveiligingsbedrijven', 'veryo' ),
			array(
				__( 'Wat is de instructie bij een alarm op dit object als de sleutelhouder niet opneemt?', 'veryo' ),
				__( 'Hoeveel incidenten waren er deze maand bij deze opdrachtgever?', 'veryo' ),
				__( 'Welke afspraken staan er in het contract over de openings- en sluitrondes?', 'veryo' ),
			),
		),
		array(
			__( 'Accountancy en administratie', 'veryo' ),
			__( 'Accountants en administratiekantoren', 'veryo' ),
			array(
				__( 'Hoe hebben we de investeringsaftrek bij deze klant vorig jaar verwerkt?', 'veryo' ),
				__( 'Welke facturen van deze maand wijken af van de inkooporder?', 'veryo' ),
				__( 'Vat de mailwisseling met deze klant over de jaarrekening samen.', 'veryo' ),
			),
		),
		array(
			__( 'Uitzendbureaus', 'veryo' ),
			__( 'Uitzend- en detacheringsbureaus', 'veryo' ),
			array(
				__( 'Welke kandidaten hebben een VCA en een heftruckcertificaat?', 'veryo' ),
				__( 'Wat zijn de afspraken in de raamovereenkomst met deze opdrachtgever?', 'veryo' ),
				__( 'Schrijf een conceptmail aan een kandidaat over zijn eerste werkdag.', 'veryo' ),
			),
		),
		array(
			__( 'Vastgoedbeheer', 'veryo' ),
			__( 'Beheerders van woningen en bedrijfspanden', 'veryo' ),
			array(
				__( 'Welke onderhoudsafspraken gelden er voor dit complex?', 'veryo' ),
				__( 'Wat staat er in het huurcontract over de servicekosten van deze unit?', 'veryo' ),
				__( 'Welke meldingen zijn er dit kwartaal voor dit pand binnengekomen?', 'veryo' ),
			),
		),
		array(
			__( 'Zakelijke dienstverlening', 'veryo' ),
			__( 'Adviesbureaus en andere dienstverleners', 'veryo' ),
			array(
				__( 'Welke voorwaarden hanteren we standaard bij grotere projecten?', 'veryo' ),
				__( 'Zoek het voorstel dat we vorig jaar voor een vergelijkbare klant schreven.', 'veryo' ),
				__( 'Vat het verslag van het klantoverleg van vorige week samen.', 'veryo' ),
			),
		),
	);
	$panels   = '';
	foreach ( $branches as $b ) {
		$panels .= veryo_b_group(
			veryo_b_h( esc_html( $b[0] ), 3 )
			. veryo_b_p( esc_html( $b[1] ), array( 'className' => 'veryo-tab__sub' ) )
			. veryo_b_list( array_map( 'esc_html', $b[2] ), array( 'className' => 'veryo-tab__questions' ) ),
			array(
				'className' => 'veryo-tab',
				'layout'    => false,
			)
		);
	}
	return veryo_sec_wide(
		veryo_sec_head(
			__( 'Voor wie', 'veryo' ),
			veryo_b_p( __( 'Voor mkb-bedrijven met ongeveer 5 tot 50 medewerkers, waar veel kennis in documenten, systemen en hoofden zit. Zo stellen medewerkers er bijvoorbeeld vragen aan:', 'veryo' ) )
		)
		. veryo_b_group(
			$panels,
			array(
				'className' => 'veryo-tabs',
				'layout'    => false,
			)
		),
		'veryo-collega-for',
		'voor-wie'
	);
}

/**
 * De volledige productpagina.
 *
 * @return string
 */
function veryo_page_collega() {
	$n = '[veryo_collega_naam]';

	// 1. Hero.
	$out = veryo_b_group(
		veryo_b_columns(
			array(
				array(
					'width' => '56%',
					'inner' => veryo_b_p( $n, array( 'className' => 'veryo-kicker' ) )
						. veryo_b_h( __( 'Een AI-collega die alles weet van jouw bedrijf.', 'veryo' ), 1, array( 'fontSize' => 'display-xl' ) )
						. veryo_b_p( __( 'Draait op je eigen kantoor. [veryo_collega_naam] beantwoordt vragen van je medewerkers uit jullie eigen documenten en systemen, en je gegevens verlaten het pand niet voor AI-verwerking.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
						. veryo_b_shortcode( '[veryo_collega_cta]' ),
				),
				array(
					'width' => '44%',
					'inner' => veryo_b_shortcode( '[veryo_collega_visual]' ),
				),
			)
		),
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'is-style-petrol veryo-collega-hero',
		)
	);

	// Citeerbaar antwoord.
	$out .= veryo_sec_answer( __( '[veryo_collega_naam] is een AI-assistent die bij een mkb-bedrijf op kantoor draait en vragen van medewerkers beantwoordt uit de eigen documenten en systemen van dat bedrijf. Veryo installeert bewezen open-source AI op een eigen machine bij de klant, richt die in, vult hem met de kennis van het bedrijf en beheert hem daarna. Het is geen eigen software van Veryo.', 'veryo' ) );

	// 2. Het probleem.
	$problems = array(
		array( __( 'De kennis zit in het hoofd van een paar mensen.', 'veryo' ), __( 'Hoe zat het ook alweer bij die klant? Welke maat, welke leverancier, welke afspraak? Vaak weet alleen die ene collega het antwoord. Is die er niet, dan ligt het werk stil of wordt alles opnieuw uitgezocht.', 'veryo' ) ),
		array( __( 'Te weinig handen.', 'veryo' ), __( 'Goede mensen zijn schaars. Valt iemand uit of komt er een nieuwe collega bij, dan kost het inwerken en opvangen veel tijd van je beste mensen.', 'veryo' ) ),
		array( __( 'Je wilt AI, maar niet je klantgegevens in de cloud.', 'veryo' ), __( 'Je ziet wat AI kan, maar je wilt je klantgegevens, prijzen en contracten niet bij een externe clouddienst neerzetten. Dat is een terechte reden om te twijfelen.', 'veryo' ) ),
	);
	$cards    = '';
	foreach ( $problems as $i => $p ) {
		$cards .= veryo_b_group(
			veryo_b_p( sprintf( '%02d', $i + 1 ), array( 'className' => 'veryo-collega-card__nr' ) )
			. veryo_b_h( esc_html( $p[0] ), 3 )
			. veryo_b_p( esc_html( $p[1] ) ),
			array(
				'className' => 'veryo-collega-card',
				'layout'    => false,
			)
		);
	}
	$out .= veryo_sec_wide(
		veryo_b_h( __( 'Herkenbaar?', 'veryo' ) )
		. veryo_b_group(
			$cards,
			array(
				'className' => 'veryo-collega-cards',
				'layout'    => false,
			)
		),
		'veryo-collega-problem'
	);

	// 3. Wat het doet.
	$tasks = array(
		array( 'kennis', __( 'Kennisbank', 'veryo' ), __( 'Beantwoordt vragen uit jullie eigen documenten, met een verwijzing naar de bron.', 'veryo' ) ),
		array( 'inwerken', __( 'Inwerken en vervanging', 'veryo' ), __( 'Nieuwe collega’s en invallers vinden zelf het antwoord, zonder steeds iemand te storen.', 'veryo' ) ),
		array( 'offerte', __( 'Offertes en calculatie', 'veryo' ), __( 'Zoekt eerdere projecten op, maakt conceptoffertes en vat bestekken samen.', 'veryo' ) ),
		array( 'mail', __( 'Mail', 'veryo' ), __( 'Vat lange mails en mailwisselingen samen en zet conceptantwoorden klaar.', 'veryo' ) ),
		array( 'administratie', __( 'Administratie', 'veryo' ), __( 'Controleert facturen en zet openstaande posten op een rij, bijvoorbeeld uit SnelStart.', 'veryo' ) ),
		array( 'planning', __( 'Planning en projectstatus', 'veryo' ), __( 'Vertelt hoe een project ervoor staat en wie wanneer waar is ingepland.', 'veryo' ) ),
		array( 'sparring', __( 'Sparringpartner voor de eigenaar', 'veryo' ), __( 'Denkt mee op basis van je eigen bedrijfsgegevens. Jij beslist.', 'veryo' ) ),
	);
	$grid  = '';
	foreach ( $tasks as $t ) {
		$grid .= veryo_b_group(
			veryo_b_h( esc_html( $t[1] ), 3 ) . veryo_b_p( esc_html( $t[2] ) ),
			array(
				'className' => 'veryo-collega-task is-' . $t[0],
				'layout'    => false,
			)
		);
	}
	$out .= veryo_sec_wide(
		veryo_sec_head(
			__( 'Wat [veryo_collega_naam] voor je doet', 'veryo' ),
			veryo_b_p( __( 'Eén plek waar je team terechtkan met vragen over het werk. De AI maakt concepten, jouw mensen beslissen.', 'veryo' ) )
		)
		. veryo_b_group(
			$grid,
			array(
				'className' => 'veryo-collega-tasks',
				'layout'    => false,
			)
		),
		'veryo-collega-does',
		'wat-het-doet'
	);

	// 4. Zo werkt het.
	$steps = array(
		'<strong>' . __( 'Intake en AI-scan', 'veryo' ) . '</strong><br>' . __( 'We brengen in kaart welke kennis en systemen er zijn, wat het moet opleveren en wie wat mag zien.', 'veryo' ),
		'<strong>' . __( 'Installatie op een eigen machine op kantoor', 'veryo' ) . '</strong><br>' . __( 'We installeren bewezen open-source AI op een machine bij jou op kantoor, goed beveiligd en met backups.', 'veryo' ),
		'<strong>' . __( 'Kennis verzamelen', 'veryo' ) . '</strong><br>' . __( 'We verzamelen documenten, procedures en eerdere projecten, en interviewen je ervaren medewerkers.', 'veryo' ),
		'<strong>' . __( 'Live, met maandelijks beheer', 'veryo' ) . '</strong><br>' . __( 'Je team gaat ermee werken. Wij doen het beheer, de updates en het onderhoud van de kennis.', 'veryo' ),
	);
	$out  .= veryo_sec_wide( veryo_b_h( __( 'Zo werkt het', 'veryo' ) ) . veryo_b_list( $steps, array( 'className' => 'is-style-steps' ) ), 'veryo-steps--home veryo-collega-steps', 'zo-werkt-het' );

	// 5. Privacy en veiligheid.
	$out .= veryo_sec_wide(
		veryo_sec_head(
			__( 'Je gegevens blijven op kantoor', 'veryo' ),
			veryo_b_p( __( 'Privé AI voor het mkb, eerlijk uitgelegd. Goed beveiligd en beheerd door Veryo, zonder grote beloftes.', 'veryo' ) )
		)
		. veryo_b_list(
			array(
				'<strong>' . __( 'Draait op een eigen machine op kantoor.', 'veryo' ) . '</strong> ' . __( 'De AI-verwerking gebeurt op die machine, niet in een datacenter van een ander.', 'veryo' ),
				'<strong>' . __( 'Geen gegevens naar externe AI-diensten.', 'veryo' ) . '</strong> ' . __( 'Je vragen en documenten gaan niet naar ChatGPT, Copilot of een andere AI-dienst.', 'veryo' ),
				'<strong>' . __( 'Rechten per medewerker.', 'veryo' ) . '</strong> ' . __( 'Niet iedereen ziet alles. Je bepaalt per persoon of afdeling welke bronnen meedoen.', 'veryo' ),
				'<strong>' . __( 'Beveiligd, met backups en beheer.', 'veryo' ) . '</strong> ' . __( 'Veryo houdt de machine up-to-date, maakt backups en beheert de toegang. Met een verwerkersovereenkomst.', 'veryo' ),
				'<strong>' . __( 'Eerlijk over koppelingen.', 'veryo' ) . '</strong> ' . __( 'Koppel je een cloudpakket, zoals een online boekhoudpakket, dan haalt de AI de gegevens daar op. De AI-verwerking gebeurt lokaal.', 'veryo' ),
			),
			array( 'className' => 'is-style-checks' )
		),
		'veryo-collega-privacy',
		'privacy'
	);
	$out .= veryo_sec_collega_offline( false );

	// 6. Voor wie.
	$out .= veryo_sec_collega_branches();

	// 7. Kennis die blijft.
	$out .= veryo_sec_wide(
		veryo_b_columns(
			array(
				array(
					'width' => '50%',
					'inner' => veryo_b_h( __( 'Kennis die blijft', 'veryo' ) )
						. veryo_b_p( __( 'Als je ervaren collega met pensioen gaat, blijft zijn kennis in het bedrijf.', 'veryo' ), array( 'className' => 'veryo-statement' ) ),
				),
				array(
					'width' => '50%',
					'inner' => veryo_b_p( __( 'Veel kennis staat nergens op papier. Daarom interviewen we je ervaren medewerkers en laten we ze spraakmemo’s inspreken over hoe ze het werk doen: waar je op let, welke klant wat gewend is, wat er vaak misgaat.', 'veryo' ) )
						. veryo_b_p( __( 'Die kennis komt in [veryo_collega_naam] terecht, zodat nieuwe collega’s er later gewoon naar kunnen vragen. In elk pakket zitten uren kennisonderhoud, zodat er elke maand nieuwe kennis bijkomt.', 'veryo' ) ),
				),
			)
		),
		'veryo-collega-knowledge'
	);

	// 8. Koppelingen.
	$out .= veryo_sec_wide(
		veryo_sec_head(
			__( 'Werkt met de systemen die je al hebt', 'veryo' ),
			veryo_b_p( __( 'Een koppeling kost vanaf [veryo_collega_prijs id=koppelingen] per systeem, eenmalig. Bij cloudpakketten haalt de AI de gegevens op; de verwerking gebeurt lokaal.', 'veryo' ) )
		)
		. veryo_b_list(
			array(
				__( 'Boekhouding, zoals SnelStart', 'veryo' ),
				__( 'Mail en agenda', 'veryo' ),
				__( 'Gedeelde mappen en netwerkschijf', 'veryo' ),
				__( 'Planning', 'veryo' ),
				__( 'Offerte- en calculatiepakket', 'veryo' ),
				__( 'Klant- en projectgegevens', 'veryo' ),
			),
			array( 'className' => 'veryo-tiles' )
		),
		'veryo-collega-links'
	);

	// 9. Pakketten en prijzen.
	$out .= veryo_sec_wide(
		veryo_sec_head(
			__( 'Pakketten en prijzen', 'veryo' ),
			veryo_b_p( __( 'Eenmalig de intake, installatie en het vullen met kennis. Daarna een vast bedrag per maand voor beheer, updates, backups en kennisonderhoud.', 'veryo' ) )
		)
		. veryo_b_shortcode( '[veryo_collega_prijzen]' ),
		'veryo-collega-pricing',
		'prijzen'
	);

	// 10. Rekenhulp.
	$out .= veryo_sec_wide(
		veryo_sec_head(
			__( 'Bereken wat het je oplevert', 'veryo' ),
			veryo_b_p( __( 'Vul in hoeveel mensen er werken en hoeveel tijd ze per week kwijt zijn aan zoeken, vragen en mailen. Je ziet direct een indicatie.', 'veryo' ) )
		)
		. veryo_b_shortcode( '[veryo_collega_rekenhulp]' ),
		'veryo-collega-calc',
		'rekenhulp'
	);

	// Sociaal bewijs: pas zichtbaar als Toon cases aan staat.
	$out .= veryo_b_group(
		veryo_b_h( __( 'Ervaringen', 'veryo' ) ) . veryo_b_p( __( '[CASE VOLGT: echte klantcase met toestemming: branche, aantal medewerkers, wat er is ingericht en wat het heeft opgeleverd]', 'veryo' ) ),
		array( 'className' => 'veryo-cases is-style-paper' )
	);

	// 11. FAQ.
	$out .= veryo_sec_faq(
		array(
			array( __( 'Gaan mijn gegevens naar de cloud?', 'veryo' ), __( 'Niet voor AI-verwerking. De AI draait op een machine bij jou op kantoor en verwerkt je vragen en documenten daar. Koppel je een cloudpakket, zoals een online boekhoudpakket, dan haalt [veryo_collega_naam] de gegevens daar op; de verwerking door de AI gebeurt lokaal.', 'veryo' ) ),
			array( __( 'Wat als we geen internet hebben?', 'veryo' ), __( 'Dan blijft [veryo_collega_naam] werken voor vragen over je eigen documenten en kennis, omdat alles op de machine op kantoor staat. Koppelingen met cloudpakketten verversen weer zodra de verbinding terug is.', 'veryo' ) ),
			array( __( 'Wie mag wat zien?', 'veryo' ), __( 'Dat stel je per medewerker of afdeling in. De werkvloer ziet bijvoorbeeld wel de werkinstructies, maar niet de salarisadministratie. [veryo_collega_naam] antwoordt alleen uit bronnen waar iemand toegang toe heeft.', 'veryo' ) ),
			array( __( 'Hoe komt de kennis erin?', 'veryo' ), __( 'We verzamelen documenten, procedures, eerdere offertes en projecten uit je mappen en systemen. Kennis die alleen in hoofden zit, halen we op met interviews en spraakmemo’s van ervaren medewerkers. Daarna komt er elke maand nieuwe kennis bij.', 'veryo' ) ),
			array( __( 'Welke machine hebben we nodig, en moeten we die kopen?', 'veryo' ), __( 'Een krachtige computer of kleine server die op kantoor staat. Welke precies, hangt af van het aantal medewerkers en wat ze ermee doen; dat adviseren we na de intake. Je kiest zelf: de hardware kopen of in het abonnement verwerken.', 'veryo' ) ),
			array( __( 'Kan het koppelen met ons boekhoudpakket?', 'veryo' ), __( 'In veel gevallen wel, bijvoorbeeld met SnelStart. Een koppeling kost vanaf [veryo_collega_prijs id=koppelingen] per systeem, eenmalig. In de intake kijken we wat er met jouw pakket kan.', 'veryo' ) ),
			array( __( 'Wat als de AI een fout maakt?', 'veryo' ), __( 'Dat kan gebeuren, net als bij een mens. Daarom laat [veryo_collega_naam] bij antwoorden zien uit welke bron ze komen, zodat je het kunt controleren. De AI maakt concepten, jouw mensen beslissen. Berekeningen maakt hij met jouw eigen gegevens, en jouw mensen controleren.', 'veryo' ) ),
			array( __( 'Hoe lang duurt het voordat het werkt?', 'veryo' ), __( 'Dat hangt af van de hoeveelheid kennis en het aantal koppelingen. Na de intake krijg je een planning, en daar houden we ons aan.', 'veryo' ) ),
			array( __( 'Welke techniek gebruiken jullie?', 'veryo' ), __( 'Bewezen open-source software, zoals Ollama om de taalmodellen op de machine te draaien en Open WebUI als omgeving waarin medewerkers vragen stellen. Welke modellen we gebruiken, kiezen we per klant op basis van de taken en de machine. Het is geen eigen software van Veryo: wij installeren, richten in en beheren.', 'veryo' ) ),
			array( __( 'Is dit hetzelfde als ChatGPT of Copilot?', 'veryo' ), __( 'Nee. ChatGPT en Copilot draaien in de cloud van een externe partij. [veryo_collega_naam] draait op je eigen machine, kent jullie eigen documenten en systemen en stuurt je gegevens niet naar een externe AI-dienst. Voor algemene taken kunnen grote cloudmodellen soms meer; [veryo_collega_naam] is er voor de kennis van jouw bedrijf.', 'veryo' ) ),
		)
	);

	// 12. Slot-CTA met demo-aanvraag.
	$out .= veryo_b_group(
		veryo_b_columns(
			array(
				array(
					'width' => '44%',
					'inner' => veryo_b_h( __( 'Zie het zelf: een demo van 20 minuten, met internet uit.', 'veryo' ), 2, array( 'fontSize' => 'display-l' ) )
						. veryo_b_p( __( 'We laten zien hoe [veryo_collega_naam] vragen beantwoordt uit voorbeelddocumenten, en trekken halverwege de internetkabel eruit. Laat je gegevens achter, dan plannen we binnen één werkdag een moment.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
						. veryo_b_shortcode( '[veryo_collega_contact]' ),
				),
				array(
					'width' => '56%',
					'inner' => veryo_b_group( veryo_b_shortcode( '[veryo_form type="demo"]' ), array( 'className' => 'is-style-paper veryo-form-wrap' ) ),
				),
			)
		),
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'anchor'    => 'demo',
			'className' => 'is-style-petrol veryo-collega-demo',
		)
	);
	$out .= veryo_sec_links(
		array(
			array( 'ai-op-maat/interne-assistent', __( 'Interne AI-assistent', 'veryo' ), __( 'Ook in de cloud mogelijk', 'veryo' ) ),
			array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid, rechten en bewustwording', 'veryo' ) ),
			array( 'ai-training', __( 'AI-training voor je team', 'veryo' ), __( 'Zo haal je er het meeste uit', 'veryo' ) ),
			array( 'oplossingen', __( 'Andere AI-oplossingen', 'veryo' ), __( 'Lead-opvolging, rapportages en meer', 'veryo' ) ),
		)
	);
	return $out;
}

/**
 * Keuzes in het demo-formulier.
 *
 * @return array<string,array<string,string>>
 */
function veryo_demo_options() {
	return array(
		'medewerkers' => array(
			'minder-dan-5' => __( 'Minder dan 5', 'veryo' ),
			'5-10'         => __( '5 tot 10', 'veryo' ),
			'10-25'        => __( '10 tot 25', 'veryo' ),
			'25-50'        => __( '25 tot 50', 'veryo' ),
			'meer-dan-50'  => __( 'Meer dan 50', 'veryo' ),
		),
		'branche'     => array(
			'vakbedrijf'      => __( 'Vakbedrijf (dakkapel, vloeren, kozijnen)', 'veryo' ),
			'bouw'            => __( 'Bouw, installatie of techniek', 'veryo' ),
			'beveiliging'     => __( 'Beveiliging', 'veryo' ),
			'accountancy'     => __( 'Accountancy of administratiekantoor', 'veryo' ),
			'uitzendbureau'   => __( 'Uitzendbureau', 'veryo' ),
			'vastgoed'        => __( 'Vastgoedbeheer', 'veryo' ),
			'dienstverlening' => __( 'Zakelijke dienstverlening', 'veryo' ),
			'anders'          => __( 'Anders', 'veryo' ),
		),
	);
}

/**
 * Past Veryo Collega bij de uitkomst van de AI-scan? Ja als een aanbeveling over kennis,
 * documenten of mail gaat, of als het team groter is dan tien mensen.
 *
 * @param array<int,array<string,string>> $recs Aanbevelingen uit het rapport.
 * @param string                          $team Teamgrootte-sleutel.
 * @return bool
 */
function veryo_scan_fits_collega( $recs, $team ) {
	if ( in_array( $team, array( '11-25', '26-50' ), true ) ) {
		return true;
	}
	foreach ( (array) $recs as $rec ) {
		$id   = isset( $rec['catalogus_id'] ) ? (string) $rec['catalogus_id'] : '';
		$item = $id ? veryo_catalog_item( $id ) : null;
		if ( in_array( $id, array( 'mail-sortering', 'mail-concepten', 'interne-assistent', 'werkinstructies', 'technische-documentatie' ), true ) || ( $item && 'kennis-en-documenten' === $item['categorie'] ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Na een thema-update: de productpagina eenmalig vanzelf aanmaken als die ontbreekt, en het
 * Veryo-menu bijwerken. Zo verwijst de knop Plan een demo nooit naar een lege pagina.
 * Andere ontbrekende pagina's blijven bij de knop Website herstellen.
 */
function veryo_collega_autocreate() {
	if ( ! current_user_can( 'manage_options' ) || wp_doing_ajax() || get_option( 'veryo_collega_page_done' ) ) {
		return;
	}
	$slug = veryo_collega()['slug'];
	if ( ! veryo_find_page( $slug ) ) {
		$defs = veryo_content_pages();
		if ( ! isset( $defs[ $slug ] ) ) {
			return;
		}
		$def = $defs[ $slug ];
		kses_remove_filters();
		$post_id = wp_insert_post(
			wp_slash(
				array(
					'post_type'      => 'page',
					'post_status'    => 'publish',
					'post_title'     => $def['title'],
					'post_name'      => $slug,
					'post_content'   => $def['content'],
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				)
			),
			true
		);
		kses_init();
		if ( is_wp_error( $post_id ) ) {
			return;
		}
		veryo_apply_page_meta( $post_id, $def );
		veryo_remember_content( $post_id );
		$map          = get_option( 'veryo_page_ids', array() );
		$map          = is_array( $map ) ? $map : array();
		$map[ $slug ] = $post_id;
		update_option( 'veryo_page_ids', $map, false );
	}
	// Menu's met de nieuwe pagina opnieuw vullen (alleen de Veryo-menu's die iets missen).
	$ids = array();
	foreach ( array_keys( veryo_content_pages() ) as $path ) {
		$page = veryo_find_page( $path );
		if ( $page ) {
			$ids[ $path ] = $page->ID;
		}
	}
	$report = array( 'messages' => array() );
	veryo_setup_menus( $ids, $report );
	update_option( 'veryo_collega_page_done', 1, false );
}
add_action( 'admin_init', 'veryo_collega_autocreate' );

/**
 * Eenmalig: [VUL IN]-notities uit de blogconcepten van het thema halen, ook op sites waar die
 * concepten al bestaan. Alleen concepten, gepubliceerde berichten blijven ongemoeid.
 */
function veryo_blog_remove_placeholders() {
	if ( ! current_user_can( 'manage_options' ) || get_option( 'veryo_blog_placeholders_removed' ) ) {
		return;
	}
	foreach ( array_keys( veryo_content_posts() ) as $slug ) {
		$post = get_page_by_path( $slug, OBJECT, 'post' );
		if ( ! $post instanceof WP_Post || 'draft' !== $post->post_status || false === strpos( $post->post_content, '[VUL IN' ) ) {
			continue;
		}
		// Nooit aangepast? Dan de nieuwe versie van het concept; anders alleen de notities eruit.
		$defs  = veryo_content_posts();
		$clean = $post->post_modified_gmt === $post->post_date_gmt
			? $defs[ $slug ]['content']
			: preg_replace( '/\s?\[VUL IN:[^\]]*\]/u', '', $post->post_content );
		kses_remove_filters();
		wp_update_post(
			wp_slash(
				array(
					'ID'           => $post->ID,
					'post_content' => $clean,
				)
			)
		);
		kses_init();
	}
	update_option( 'veryo_blog_placeholders_removed', 1, false );
}
add_action( 'admin_init', 'veryo_blog_remove_placeholders' );
