<?php
/**
 * Helpers die geldige Gutenberg block markup (kern-blokken) opbouwen.
 * De uitvoer is identiek aan wat de editor zelf opslaat, zodat alles bewerkbaar blijft.
 *
 * Tekst die hier binnenkomt is door het thema zelf geschreven (vertrouwde bron) en mag
 * eenvoudige inline HTML bevatten (a, strong, em, br).
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Blok-commentaar om HTML heen zetten.
 *
 * @param string              $name  Bloknaam zonder "core/".
 * @param array<string,mixed> $attrs Attributen.
 * @param string              $html  Inhoud.
 * @return string
 */
function veryo_b( $name, $attrs, $html ) {
	$json = empty( $attrs ) ? '' : ' ' . serialize_block_attributes( $attrs );
	return '<!-- wp:' . $name . $json . ' -->' . $html . '<!-- /wp:' . $name . ' -->' . "\n";
}

/**
 * Class-attribuut samenstellen uit blok-attributen.
 *
 * @param string              $base  Standaard blok-class (mag leeg zijn).
 * @param array<string,mixed> $attrs Attributen.
 * @return string Inclusief ' class="…"' of leeg.
 */
function veryo_b_class( $base, $attrs ) {
	$classes = array();
	if ( $base ) {
		$classes[] = $base;
	}
	if ( ! empty( $attrs['align'] ) ) {
		$classes[] = 'align' . $attrs['align'];
	}
	if ( ! empty( $attrs['textAlign'] ) ) {
		$classes[] = 'has-text-align-' . $attrs['textAlign'];
	}
	if ( ! empty( $attrs['fontSize'] ) ) {
		$classes[] = 'has-' . $attrs['fontSize'] . '-font-size';
	}
	if ( ! empty( $attrs['className'] ) ) {
		$classes[] = $attrs['className'];
	}
	return $classes ? ' class="' . esc_attr( implode( ' ', $classes ) ) . '"' : '';
}

/**
 * Paragraaf.
 *
 * @param string              $text  Tekst (inline HTML toegestaan).
 * @param array<string,mixed> $attrs Attributen.
 * @return string
 */
function veryo_b_p( $text, $attrs = array() ) {
	return veryo_b( 'paragraph', $attrs, '<p' . veryo_b_class( '', $attrs ) . '>' . $text . '</p>' );
}

/**
 * Kop.
 *
 * @param string              $text  Tekst.
 * @param int                 $level Niveau 1–6.
 * @param array<string,mixed> $attrs Attributen.
 * @return string
 */
function veryo_b_h( $text, $level = 2, $attrs = array() ) {
	if ( 2 !== $level ) {
		$attrs = array_merge( array( 'level' => $level ), $attrs );
	}
	$tag = 'h' . (int) $level;
	return veryo_b( 'heading', $attrs, '<' . $tag . veryo_b_class( 'wp-block-heading', $attrs ) . '>' . $text . '</' . $tag . '>' );
}

/**
 * Lijst. Items zijn strings of arrays met 'text' en 'class'.
 *
 * @param array<int,string|array<string,string>> $items   Items.
 * @param array<string,mixed>                    $attrs   Attributen (ordered => true voor <ol>).
 * @return string
 */
function veryo_b_list( $items, $attrs = array() ) {
	$tag   = ! empty( $attrs['ordered'] ) ? 'ol' : 'ul';
	$inner = '';
	foreach ( $items as $item ) {
		if ( is_array( $item ) ) {
			$li_attrs = empty( $item['class'] ) ? array() : array( 'className' => $item['class'] );
			$inner   .= veryo_b( 'list-item', $li_attrs, '<li' . veryo_b_class( '', $li_attrs ) . '>' . $item['text'] . '</li>' );
		} else {
			$inner .= veryo_b( 'list-item', array(), '<li>' . $item . '</li>' );
		}
	}
	return veryo_b( 'list', $attrs, '<' . $tag . veryo_b_class( 'wp-block-list', $attrs ) . '>' . $inner . '</' . $tag . '>' );
}

/**
 * Knoppen. Elke knop: array( tekst, url, stijl ) met stijl 'amber', 'petrol' of 'link'.
 *
 * @param array<int,array<int,string>> $buttons Knoppen.
 * @param array<string,mixed>          $attrs   Attributen van de knoppengroep.
 * @return string
 */
function veryo_b_buttons( $buttons, $attrs = array() ) {
	$inner = '';
	foreach ( $buttons as $button ) {
		list( $text, $url ) = $button;
		$style              = isset( $button[2] ) ? $button[2] : 'petrol';
		$b_attrs            = 'petrol' === $style ? array() : array( 'className' => 'is-style-' . $style );
		$inner             .= veryo_b(
			'button',
			$b_attrs,
			'<div' . veryo_b_class( 'wp-block-button', $b_attrs ) . '><a class="wp-block-button__link wp-element-button" href="' . esc_url( $url ) . '">' . $text . '</a></div>'
		);
	}
	return veryo_b( 'buttons', $attrs, '<div' . veryo_b_class( 'wp-block-buttons', $attrs ) . '>' . $inner . '</div>' );
}

/**
 * Groep. Standaard met constrained layout.
 *
 * @param string              $inner Inhoud (blokken).
 * @param array<string,mixed> $attrs Attributen (className, tagName, align).
 * @return string
 */
function veryo_b_group( $inner, $attrs = array() ) {
	$attrs = array_merge( array( 'layout' => array( 'type' => 'constrained' ) ), $attrs );
	if ( false === $attrs['layout'] ) {
		unset( $attrs['layout'] );
	}
	$tag = isset( $attrs['tagName'] ) ? $attrs['tagName'] : 'div';
	// Het anker staat alleen in de HTML (id), niet in de blok-attributen.
	$id = isset( $attrs['anchor'] ) ? ' id="' . esc_attr( $attrs['anchor'] ) . '"' : '';
	// Attribuutvolgorde gelijk aan de editor.
	$ordered = array();
	foreach ( array( 'tagName', 'align', 'className', 'layout' ) as $key ) {
		if ( isset( $attrs[ $key ] ) ) {
			$ordered[ $key ] = $attrs[ $key ];
		}
	}
	return veryo_b( 'group', $ordered, '<' . $tag . $id . veryo_b_class( 'wp-block-group', $attrs ) . '>' . $inner . '</' . $tag . '>' );
}

/**
 * Kolommen. Elke kolom is een string (inhoud) of array( 'inner' => …, 'width' => '60%', 'class' => … ).
 *
 * @param array<int,string|array<string,string>> $cols  Kolommen.
 * @param array<string,mixed>                    $attrs Attributen.
 * @return string
 */
function veryo_b_columns( $cols, $attrs = array() ) {
	$inner = '';
	foreach ( $cols as $col ) {
		$c_attrs = array();
		$style   = '';
		if ( is_array( $col ) ) {
			if ( ! empty( $col['width'] ) ) {
				$c_attrs['width'] = $col['width'];
				$style            = ' style="flex-basis:' . esc_attr( $col['width'] ) . '"';
			}
			if ( ! empty( $col['class'] ) ) {
				$c_attrs['className'] = $col['class'];
			}
			$content = $col['inner'];
		} else {
			$content = $col;
		}
		$inner .= veryo_b( 'column', $c_attrs, '<div' . veryo_b_class( 'wp-block-column', $c_attrs ) . $style . '>' . $content . '</div>' );
	}
	return veryo_b( 'columns', $attrs, '<div' . veryo_b_class( 'wp-block-columns', $attrs ) . '>' . $inner . '</div>' );
}

/**
 * Uitklapblok (voor FAQ).
 *
 * @param string $summary Vraag.
 * @param string $answer  Antwoord (platte tekst of inline HTML).
 * @return string
 */
function veryo_b_details( $summary, $answer ) {
	return veryo_b( 'details', array(), '<details class="wp-block-details"><summary>' . $summary . '</summary>' . veryo_b_p( $answer ) . '</details>' );
}

/**
 * Shortcode-blok.
 *
 * @param string $shortcode Shortcode inclusief haken.
 * @return string
 */
function veryo_b_shortcode( $shortcode ) {
	return veryo_b( 'shortcode', array(), $shortcode );
}
