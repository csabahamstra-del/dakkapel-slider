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
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 72,
			'width'       => 266,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
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
	// Het ingekorte bestand (tools/build.sh) als dat er is, anders de bron.
	$min = VERYO_DIR . '/assets/css/main.min.css';
	$css = ( file_exists( $min ) && filemtime( $min ) >= filemtime( VERYO_DIR . '/assets/css/main.css' ) ) ? 'main.min.css' : 'main.css';
	$ver = VERYO_VERSION . '-' . (string) filemtime( VERYO_DIR . '/assets/css/' . $css );
	wp_enqueue_style( 'veryo-main', VERYO_URI . '/assets/css/' . $css, array(), $ver );

	$defer = array(
		'strategy'  => 'defer',
		'in_footer' => true,
	);
	// Kleine interacties die altijd werken: FAQ, prijsschakelaar, sticky CTA, marquee.
	wp_enqueue_script( 'veryo-ui', VERYO_URI . '/assets/js/ui.js', array(), VERYO_VERSION . '-' . (string) filemtime( VERYO_DIR . '/assets/js/ui.js' ), $defer );

	// Beweging: GSAP, ScrollTrigger, SplitText en (optioneel) Lenis, allemaal lokaal.
	if ( veryo_motion_enabled() ) {
		$vendor = VERYO_URI . '/assets/vendor/';
		wp_register_script( 'veryo-gsap', $vendor . 'gsap/gsap.min.js', array(), '3.15.0', $defer );
		wp_register_script( 'veryo-gsap-scrolltrigger', $vendor . 'gsap/ScrollTrigger.min.js', array( 'veryo-gsap' ), '3.15.0', $defer );
		wp_register_script( 'veryo-gsap-splittext', $vendor . 'gsap/SplitText.min.js', array( 'veryo-gsap' ), '3.15.0', $defer );
		$deps = array( 'veryo-gsap', 'veryo-gsap-scrolltrigger', 'veryo-gsap-splittext' );
		if ( veryo_smooth_scroll_enabled() ) {
			wp_register_script( 'veryo-lenis', $vendor . 'lenis/lenis.min.js', array(), '1.3.26', $defer );
			$deps[] = 'veryo-lenis';
		}
		wp_enqueue_script( 'veryo-motion', VERYO_URI . '/assets/js/motion.js', $deps, VERYO_VERSION . '-' . (string) filemtime( VERYO_DIR . '/assets/js/motion.js' ), $defer );
	}

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
 * Oude fotoplekken ([FOTO: …]) uit eerdere versies nooit tonen, ook niet aan beheerders.
 *
 * @param string               $content Blok-HTML.
 * @param array<string, mixed> $block   Blok.
 * @return string
 */
function veryo_hide_photo_placeholders( $content, $block ) {
	if ( 'core/group' !== $block['blockName'] || empty( $block['attrs']['className'] ) ) {
		return $content;
	}
	if ( false !== strpos( (string) $block['attrs']['className'], 'veryo-photo' ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block', 'veryo_hide_photo_placeholders', 10, 2 );

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

/**
 * Oude adressen doorsturen naar hun nieuwe plek (alleen als de oude pagina niet meer bestaat).
 */
function veryo_legacy_redirects() {
	if ( ! is_404() ) {
		return;
	}
	$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '', PHP_URL_PATH ), '/' );
	$map  = array(
		'ai-op-maat/ai-agents' => 'ai-agents',
	);
	if ( isset( $map[ $path ] ) ) {
		wp_safe_redirect( veryo_url( $map[ $path ] ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'veryo_legacy_redirects', 1 );

/**
 * Staan animaties aan (instelling)? Bezoekers met "beweging beperken" krijgen ze sowieso niet.
 *
 * @return bool
 */
function veryo_motion_enabled() {
	return (bool) veryo_setting( 'animations', 1 ) && ! is_admin();
}

/**
 * Smooth scrolling: alleen met animaties aan en niet op een pagina met de AI-scan.
 *
 * @return bool
 */
function veryo_smooth_scroll_enabled() {
	if ( ! veryo_motion_enabled() || ! veryo_setting( 'smooth_scroll', 1 ) ) {
		return false;
	}
	$post = get_post();
	return ! ( is_singular() && $post && has_shortcode( (string) $post->post_content, 'veryo_ai_scan' ) );
}

/**
 * Klasse has-motion op <html>, vóór de eerste weergave. Alleen als animaties aan staan en de
 * bezoeker geen "beweging beperken" heeft ingesteld. Zonder JavaScript blijft alles statisch.
 */
function veryo_motion_flag() {
	if ( ! veryo_motion_enabled() ) {
		return;
	}
	echo "<script>if(!window.matchMedia('(prefers-reduced-motion: reduce)').matches){document.documentElement.classList.add('has-motion');}</script>\n";
}
add_action( 'wp_head', 'veryo_motion_flag', 0 );

/**
 * De grote hero-kop (display-xl) in woorden splitsen, zodat ze met alleen CSS uit een masker
 * omhoog schuiven. Zo is de kop (het LCP-element) direct zichtbaar, zonder te wachten op JavaScript.
 *
 * @param string               $content Blok-HTML.
 * @param array<string, mixed> $block   Blok.
 * @return string
 */
function veryo_split_hero_heading( $content, $block ) {
	if ( 'core/heading' !== $block['blockName'] || false === strpos( $content, 'has-display-xl-font-size' ) || false === strpos( $content, '<h1' ) ) {
		return $content;
	}
	return (string) preg_replace_callback(
		'/(<h1[^>]*>)(.*?)(<\/h1>)/s',
		static function ( $m ) {
			if ( false !== strpos( $m[2], '<' ) ) {
				return $m[0];
			}
			$words = preg_split( '/\s+/u', trim( $m[2] ) );
			$out   = array();
			foreach ( $words as $i => $word ) {
				$out[] = '<span class="veryo-w"><span style="--i:' . (int) $i . '">' . $word . '</span></span>';
			}
			return $m[1] . implode( ' ', $out ) . $m[3];
		},
		$content,
		1
	);
}
add_filter( 'render_block', 'veryo_split_hero_heading', 10, 2 );
