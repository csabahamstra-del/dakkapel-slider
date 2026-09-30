<?php
/**
 * Thema-ondersteuning, menu-locaties, assets en blokstijlen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Basisinstellingen van het thema.
 */
function veryo_setup() {
	load_theme_textdomain( 'veryo', VERYO_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	remove_theme_support( 'core-block-patterns' );

	add_editor_style( 'assets/css/main.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Hoofdmenu', 'veryo' ),
			'footer'  => __( 'Footermenu (kolommen)', 'veryo' ),
		)
	);
}
add_action( 'after_setup_theme', 'veryo_setup' );

// Alleen de CSS van blokken die echt op de pagina staan.
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

/**
 * Stijlen en scripts op de voorkant.
 */
function veryo_enqueue_assets() {
	$ver = VERYO_VERSION . '-' . (string) filemtime( VERYO_DIR . '/assets/css/main.css' );
	wp_enqueue_style( 'veryo-main', VERYO_URI . '/assets/css/main.css', array(), $ver );

	wp_enqueue_script(
		'veryo-nav',
		VERYO_URI . '/assets/js/nav.js',
		array(),
		VERYO_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Scripts van de AI-scan en formulieren registreren; ze worden alleen geladen waar de shortcode staat.
	wp_register_script(
		'veryo-scan',
		VERYO_URI . '/assets/js/scan.js',
		array(),
		VERYO_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);
	wp_register_script(
		'veryo-forms',
		VERYO_URI . '/assets/js/forms.js',
		array(),
		VERYO_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Geen emoji-scripts, geen reacties-script tenzij nodig.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'veryo_enqueue_assets' );

/**
 * Configuratie voor de scripts van de AI-scan en formulieren.
 *
 * @return array<string,mixed>
 */
function veryo_script_config() {
	return array(
		'restUrl'   => esc_url_raw( rest_url( 'veryo/v1/' ) ),
		'nonce'     => wp_create_nonce( 'wp_rest' ),
		'thanksUrl' => esc_url_raw( veryo_url( 'bedankt' ) ),
	);
}

/**
 * Lettertypes preloaden, bovenaan in <head>.
 */
function veryo_preload_fonts() {
	$fonts = array( 'PlusJakartaSans-Variable.woff2', 'Newsreader-Variable.woff2' );
	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( VERYO_URI . '/assets/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'veryo_preload_fonts', 1 );

/**
 * Favicon en apple-touch-icon uit het thema, zolang er geen site-icoon is ingesteld.
 */
function veryo_theme_icons() {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( VERYO_URI . '/assets/logo/veryo-beeldmerk.svg' ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( VERYO_URI . '/assets/images/icon-512.png' ) );
}
add_action( 'wp_head', 'veryo_theme_icons', 5 );

/**
 * Onnodige head-uitvoer en externe verzoeken uitschakelen.
 */
function veryo_cleanup_head() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
}
add_action( 'init', 'veryo_cleanup_head' );

// Geen DNS-prefetch naar s.w.org voor emoji.
add_filter( 'emoji_svg_url', '__return_false' );

/**
 * Blokstijlen die bij de huisstijl horen.
 */
function veryo_register_block_styles() {
	$group_styles = array(
		'petrol' => __( 'Petrol vlak', 'veryo' ),
		'soft'   => __( 'Rustig getint vlak', 'veryo' ),
		'paper'  => __( 'Wit vlak', 'veryo' ),
		'answer' => __( 'Direct antwoord', 'veryo' ),
	);
	foreach ( $group_styles as $name => $label ) {
		register_block_style(
			'core/group',
			array(
				'name'  => $name,
				'label' => $label,
			)
		);
	}
	register_block_style(
		'core/button',
		array(
			'name'  => 'amber',
			'label' => __( 'Primair (amber)', 'veryo' ),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name'  => 'link',
			'label' => __( 'Tekstlink', 'veryo' ),
		)
	);
	register_block_style(
		'core/list',
		array(
			'name'  => 'checks',
			'label' => __( 'Vinkjes', 'veryo' ),
		)
	);
	register_block_style(
		'core/list',
		array(
			'name'  => 'steps',
			'label' => __( 'Stappen', 'veryo' ),
		)
	);

	register_block_pattern_category(
		'veryo',
		array( 'label' => __( 'Veryo', 'veryo' ) )
	);
}
add_action( 'init', 'veryo_register_block_styles' );

/**
 * Body-classes voor opmaak.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function veryo_body_class( $classes ) {
	if ( is_singular( 'page' ) && get_post_meta( get_the_ID(), '_veryo_hide_title', true ) ) {
		$classes[] = 'veryo-landing';
	}
	return $classes;
}
add_filter( 'body_class', 'veryo_body_class' );

/**
 * Cases/reviews-blokken verbergen zolang "Toon cases" uit staat.
 *
 * @param string               $content Blok-HTML.
 * @param array<string, mixed> $block   Blok.
 * @return string
 */
function veryo_hide_cases_block( $content, $block ) {
	if ( 'core/group' !== $block['blockName'] || empty( $block['attrs']['className'] ) ) {
		return $content;
	}
	if ( false !== strpos( (string) $block['attrs']['className'], 'veryo-cases' ) && ! veryo_setting( 'show_cases' ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block', 'veryo_hide_cases_block', 10, 2 );

/**
 * Lengte van samenvattingen.
 *
 * @return int
 */
function veryo_excerpt_length() {
	return 28;
}
add_filter( 'excerpt_length', 'veryo_excerpt_length' );

/**
 * Samenvatting eindigt zonder [...].
 *
 * @return string
 */
function veryo_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'veryo_excerpt_more' );
