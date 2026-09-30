<?php
/**
 * Walker voor het footermenu.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Footermenu: items op het hoogste niveau worden kolomkoppen.
 */
class Veryo_Footer_Walker extends Walker_Nav_Menu {

	/**
	 * Start submenu.
	 *
	 * @param string   $output Uitvoer.
	 * @param int      $depth  Diepte.
	 * @param stdClass $args   Argumenten.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="footer-links">';
	}

	/**
	 * Einde submenu.
	 *
	 * @param string   $output Uitvoer.
	 * @param int      $depth  Diepte.
	 * @param stdClass $args   Argumenten.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	/**
	 * Item.
	 *
	 * @param string   $output            Uitvoer.
	 * @param WP_Post  $data_object       Item.
	 * @param int      $depth             Diepte.
	 * @param stdClass $args              Argumenten.
	 * @param int      $current_object_id Huidig object.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item  = $data_object;
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$url   = (string) $item->url;
		if ( 0 === $depth ) {
			$output .= '<li class="footer-col"><h2 class="footer-heading">';
			$output .= ( '' === $url || '#' === $url ) ? esc_html( $title ) : '<a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a>';
			$output .= '</h2>';
			return;
		}
		$output .= '<li><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a>';
	}

	/**
	 * Einde item.
	 *
	 * @param string   $output      Uitvoer.
	 * @param WP_Post  $data_object Item.
	 * @param int      $depth       Diepte.
	 * @param stdClass $args        Argumenten.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}
