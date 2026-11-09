<?php
/**
 * Blog: categorieën per onderwerp, leestijd, inhoudsopgave, auteursblok en gerelateerde
 * artikelen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Blogcategorieën (slug => naam en artikelen). Een artikel dat nog alleen in de
 * standaardcategorie staat, krijgt bij de setup de categorie uit deze lijst.
 *
 * @return array<string,array{name:string,desc:string,posts:array<int,string>}>
 */
function veryo_blog_categories() {
	return array(
		'ai-in-de-praktijk'   => array(
			'name'  => __( 'AI in de praktijk', 'veryo' ),
			'desc'  => __( 'Waar begin je met AI, welke processen automatiseer je eerst en welke tools passen bij een mkb-bedrijf? Praktische artikelen van Veryo. Lees en pas het toe.', 'veryo' ),
			'posts' => array( 'waar-begin-je-met-ai-in-je-bedrijf', 'wat-kan-ai-voor-mijn-bedrijf-doen', 'welke-processen-automatiseren', 'welke-ai-tool-past-bij-jouw-bedrijf', 'wat-zijn-ai-agents', 'ai-prompts-voor-installateurs', 'ai-voor-hr', 'chatgpt-voor-verkopers' ),
		),
		'lokale-ai-en-kennis' => array(
			'name'  => __( 'Lokale AI en kennis', 'veryo' ),
			'desc'  => __( 'Lokale AI, een AI-kennisbank opzetten en kennis vasthouden in je bedrijf, met Veryo Collega als voorbeeld. Lees de artikelen en plan een gratis demo.', 'veryo' ),
			'posts' => array( 'lokale-ai-of-chatgpt', 'kennis-ervaren-medewerkers-behouden', 'wat-kost-een-eigen-ai-assistent', 'ai-kennisbank-opzetten' ),
		),
		'ai-regels-en-veilig' => array(
			'name'  => __( 'AI-regels en veiligheid', 'veryo' ),
			'desc'  => __( 'AI Act, AI-geletterdheid, AVG en AI-beleid: wat de regels voor werkgevers in het mkb betekenen en hoe je het praktisch regelt. Lees de artikelen van Veryo.', 'veryo' ),
			'posts' => array( 'ai-geletterdheid-ai-act-mkb', 'ai-beleid-bedrijf-template', 'ai-beleid-medewerkers', 'is-chatgpt-veilig-ai-en-avg', 'chatgpt-claude-copilot-zakelijk', 'copilot-veilig-inrichten' ),
		),
		'kosten-en-subsidie'  => array(
			'name'  => __( 'Kosten en subsidie', 'veryo' ),
			'desc'  => __( 'Wat kost AI voor het mkb, hoe reken je de opbrengst uit en welke regelingen zoals SLIM en WBSO zijn er? Lees de artikelen en vraag een gratis offerte aan.', 'veryo' ),
			'posts' => array( 'wat-kost-ai-automatisering', 'wat-kost-een-ai-chatbot', 'slim-subsidie-ai-training', 'wbso-voor-ai-projecten' ),
		),
		'beveiligingsbranche' => array(
			'name'  => __( 'Beveiligingsbranche', 'veryo' ),
			'desc'  => __( 'Administratie in de beveiligingsbranche: zzp-facturen controleren, toeslagen voor nacht en weekend en schijnzelfstandigheid. Lees de artikelen van Veryo.', 'veryo' ),
			'posts' => array( 'zzp-facturen-controleren-beveiliging', 'schijnzelfstandigheid-beveiliging', 'toeslagen-beveiliging-nacht-weekend' ),
		),
	);
}

/**
 * Categorieën aanmaken en toewijzen aan artikelen die nog in de standaardcategorie staan.
 * Zelf gekozen categorieën blijven staan.
 */
function veryo_assign_blog_categories() {
	$default = (int) get_option( 'default_category' );
	foreach ( veryo_blog_categories() as $slug => $cat ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term instanceof WP_Term ) {
			$new = wp_insert_term(
				$cat['name'],
				'category',
				array(
					'slug'        => $slug,
					'description' => $cat['desc'],
				)
			);
			if ( is_wp_error( $new ) ) {
				continue;
			}
			$term_id = (int) $new['term_id'];
		} else {
			$term_id = (int) $term->term_id;
		}
		foreach ( $cat['posts'] as $post_slug ) {
			$post = get_page_by_path( $post_slug, OBJECT, 'post' );
			if ( ! $post instanceof WP_Post ) {
				continue;
			}
			$current = wp_get_post_categories( $post->ID );
			if ( empty( $current ) || array( $default ) === array_map( 'intval', $current ) ) {
				wp_set_post_categories( $post->ID, array( $term_id ) );
			}
		}
	}
}

/**
 * Leestijd in minuten (200 woorden per minuut, minimaal 1).
 *
 * @param WP_Post|int|null $post Bericht.
 * @return int
 */
function veryo_reading_time( $post = null ) {
	$post = get_post( $post );
	if ( ! $post instanceof WP_Post ) {
		return 1;
	}
	$words = count( preg_split( '/\s+/u', trim( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ) ), -1, PREG_SPLIT_NO_EMPTY ) );
	return max( 1, (int) round( $words / 200 ) );
}

/**
 * Tekst omzetten naar een anker-id.
 *
 * @param string             $text Koptekst.
 * @param array<string,bool> $used Al gebruikte id's.
 * @return string
 */
function veryo_toc_id( $text, &$used ) {
	$base = sanitize_title( wp_strip_all_tags( $text ) );
	$base = '' === $base ? 'sectie' : $base;
	$id   = $base;
	$i    = 2;
	while ( isset( $used[ $id ] ) ) {
		$id = $base . '-' . $i;
		++$i;
	}
	$used[ $id ] = true;
	return $id;
}

/**
 * Inhoudsopgave boven lange artikelen (vanaf drie H2's). De H2's krijgen een id als ze er
 * nog geen hebben. Het grote kopje van het slotblok (CTA) telt niet mee.
 *
 * @param string $content Inhoud.
 * @return string
 */
function veryo_post_toc( $content ) {
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$used  = array();
	$items = array();
	$out   = preg_replace_callback(
		'#<h2(\s[^>]*)?>(.*?)</h2>#is',
		static function ( $m ) use ( &$used, &$items ) {
			$attrs = isset( $m[1] ) ? $m[1] : '';
			$text  = trim( wp_strip_all_tags( $m[2] ) );
			if ( '' === $text || preg_match( '/veryo-faq|veryo-contact|veryo-cta|has-display-l-font-size/', $attrs ) ) {
				return $m[0];
			}
			if ( preg_match( '/\sid="([^"]+)"/', $attrs, $idm ) ) {
				$id          = $idm[1];
				$used[ $id ] = true;
			} else {
				$id    = veryo_toc_id( $text, $used );
				$attrs = ' id="' . esc_attr( $id ) . '"' . $attrs;
			}
			$items[] = array( $id, $text );
			return '<h2' . $attrs . '>' . $m[2] . '</h2>';
		},
		$content
	);
	if ( null === $out || count( $items ) < 3 ) {
		return $content;
	}
	$toc = '<nav class="post-toc" aria-labelledby="post-toc-title"><p class="post-toc__title" id="post-toc-title">' . esc_html__( 'In dit artikel', 'veryo' ) . '</p><ol>';
	foreach ( $items as $item ) {
		$toc .= '<li><a href="#' . esc_attr( $item[0] ) . '">' . esc_html( $item[1] ) . '</a></li>';
	}
	$toc .= '</ol></nav>';
	$pos  = stripos( $out, '<h2' );
	return false === $pos ? $toc . $out : substr( $out, 0, $pos ) . $toc . substr( $out, $pos );
}
add_filter( 'the_content', 'veryo_post_toc', 20 );

/**
 * Gerelateerde artikelen: eerst uit dezelfde categorie, aangevuld met de nieuwste.
 *
 * @param int $post_id Bericht.
 * @param int $count   Aantal.
 * @return WP_Post[]
 */
function veryo_related_posts( $post_id, $count = 3 ) {
	$cats    = wp_get_post_categories( $post_id );
	$related = array();
	if ( $cats ) {
		$related = get_posts(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => $count,
				'category__in'        => $cats,
				'post__not_in'        => array( $post_id ),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
	}
	if ( count( $related ) < $count ) {
		$exclude = array_merge( array( $post_id ), wp_list_pluck( $related, 'ID' ) );
		$related = array_merge(
			$related,
			get_posts(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => $count - count( $related ),
					'post__not_in'        => $exclude,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			)
		);
	}
	return $related;
}

/**
 * Categorieën met berichten, als filter boven het blogoverzicht.
 */
function veryo_blog_category_nav() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'category',
			'hide_empty' => true,
			'exclude'    => array( (int) get_option( 'default_category' ) ),
		)
	);
	if ( is_wp_error( $terms ) || ! $terms ) {
		return;
	}
	$current = is_category() ? (int) get_queried_object_id() : 0;
	echo '<nav class="blog-cats" aria-label="' . esc_attr__( 'Onderwerpen', 'veryo' ) . '"><ul>';
	$blog = (int) get_option( 'page_for_posts' );
	if ( $blog ) {
		echo '<li><a href="' . esc_url( get_permalink( $blog ) ) . '"' . ( is_home() ? ' aria-current="page"' : '' ) . '>' . esc_html__( 'Alle artikelen', 'veryo' ) . '</a></li>';
	}
	foreach ( $terms as $term ) {
		echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '"' . ( $current === (int) $term->term_id ? ' aria-current="page"' : '' ) . '>' . esc_html( $term->name ) . '</a></li>';
	}
	echo '</ul></nav>';
}
