<?php
/**
 * Walker voor het hoofdmenu.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hoofdmenu met knoppen voor submenu's (aria-expanded), bruikbaar met toetsenbord.
 */
class Veryo_Primary_Walker extends Walker_Nav_Menu {

	/**
	 * Teller voor unieke ID's.
	 *
	 * @var int
	 */
	private $sub_count = 0;

	/**
	 * Start submenu.
	 *
	 * @param string   $output Uitvoer.
	 * @param int      $depth  Diepte.
	 * @param stdClass $args   Argumenten.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( $depth > 0 ) {
			$output .= '<ul class="mega-col">';
			return;
		}
		$output .= '<ul class="sub-menu" id="veryo-sub-' . (int) $this->sub_count . '">';
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
	 * Menu-item.
	 *
	 * @param string   $output            Uitvoer.
	 * @param WP_Post  $data_object       Menu-item.
	 * @param int      $depth             Diepte.
	 * @param stdClass $args              Argumenten.
	 * @param int      $current_object_id Huidig object.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item         = $data_object;
		$classes      = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes, true );
		$is_current   = in_array( 'current-menu-item', $classes, true );
		$in_trail     = $is_current || in_array( 'current-menu-ancestor', $classes, true ) || in_array( 'current-menu-parent', $classes, true );

		$li_classes = array( 'menu-item' );
		if ( $has_children ) {
			$li_classes[] = 'has-sub';
		}
		if ( $in_trail ) {
			$li_classes[] = 'is-current';
		}
		$output .= '<li class="' . esc_attr( implode( ' ', $li_classes ) ) . '">';

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$url   = (string) $item->url;

		if ( $has_children && 0 === $depth ) {
			++$this->sub_count;
			$sub_id = 'veryo-sub-' . $this->sub_count;
			if ( '' === $url || '#' === $url ) {
				$output .= '<button type="button" class="nav-toggle-sub nav-label" aria-expanded="false" aria-controls="' . esc_attr( $sub_id ) . '">' . esc_html( $title ) . wp_kses( veryo_icon( 'down' ), veryo_svg_kses() ) . '</button>';
				return;
			}
			$output .= '<a href="' . esc_url( $url ) . '"' . ( $is_current ? ' aria-current="page"' : '' ) . '>' . esc_html( $title ) . '</a>';
			/* translators: %s: naam van het menu-item. */
			$label   = sprintf( __( 'Submenu %s', 'veryo' ), $title );
			$output .= '<button type="button" class="nav-toggle-sub nav-caret" aria-expanded="false" aria-controls="' . esc_attr( $sub_id ) . '" aria-label="' . esc_attr( $label ) . '">' . wp_kses( veryo_icon( 'down' ), veryo_svg_kses() ) . '</button>';
			return;
		}

		// Kolomkop in het mega-menu: een kop zonder link.
		if ( $depth > 0 && $has_children && ( '' === $url || '#' === $url ) ) {
			$output .= '<span class="mega-heading">' . esc_html( $title ) . '</span>';
			return;
		}

		$output .= '<a href="' . esc_url( $url ) . '"' . ( $is_current ? ' aria-current="page"' : '' ) . '>' . esc_html( $title ) . '</a>';
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
