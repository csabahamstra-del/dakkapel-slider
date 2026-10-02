<?php
/**
 * Eenmalige, idempotente setup bij activeren: pagina's, menu's, blogconcepten,
 * permalinks, site-icoon en tagline. Bestaande inhoud wordt nooit overschreven.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

define( 'VERYO_SETUP_VERSION', '1.0.0' );

add_action( 'after_switch_theme', 'veryo_on_activate' );

/**
 * Bij activeren: setup draaien en de melding klaarzetten.
 */
function veryo_on_activate() {
	veryo_run_setup();
	update_option( 'veryo_show_setup_notice', 1, false );
}

/**
 * Zoek een pagina op pad, ongeacht status (behalve prullenbak).
 *
 * @param string $path Pad.
 * @return WP_Post|null
 */
function veryo_find_page( $path ) {
	if ( '' === $path ) {
		$map = get_option( 'veryo_page_ids', array() );
		if ( is_array( $map ) && ! empty( $map['home'] ) ) {
			$page = get_post( (int) $map['home'] );
			if ( $page instanceof WP_Post && 'trash' !== $page->post_status ) {
				return $page;
			}
		}
		$path = 'home';
	}
	$page = get_page_by_path( $path, OBJECT, 'page' );
	return ( $page instanceof WP_Post && 'trash' !== $page->post_status ) ? $page : null;
}

/**
 * SEO- en weergave-meta opslaan voor een pagina of bericht.
 *
 * @param int                 $post_id ID.
 * @param array<string,mixed> $def     Definitie uit het register.
 */
function veryo_apply_page_meta( $post_id, $def ) {
	update_post_meta( $post_id, '_veryo_seo_title', $def['seo_title'] );
	update_post_meta( $post_id, '_veryo_seo_desc', $def['desc'] );
	if ( ! empty( $def['kw'] ) ) {
		update_post_meta( $post_id, '_veryo_focus_kw', $def['kw'] );
	}
	$meta = isset( $def['meta'] ) ? $def['meta'] : array();
	foreach ( array( 'noindex', 'nofollow', 'hide_title', 'legal_draft' ) as $flag ) {
		if ( ! empty( $meta[ $flag ] ) ) {
			update_post_meta( $post_id, '_veryo_' . $flag, 1 );
		}
	}
	if ( ! empty( $def['schema'] ) ) {
		update_post_meta( $post_id, '_veryo_schema_type', $def['schema']['type'] );
		if ( isset( $def['schema']['min'] ) ) {
			update_post_meta( $post_id, '_veryo_price_min', (int) $def['schema']['min'] );
			update_post_meta( $post_id, '_veryo_price_max', (int) $def['schema']['max'] );
		}
		if ( ! empty( $def['schema']['area'] ) ) {
			update_post_meta( $post_id, '_veryo_area', $def['schema']['area'] );
		}
	}
}

/**
 * De volledige setup. Veilig om vaker te draaien.
 *
 * @return array<string,mixed> Verslag: aangemaakt, overgeslagen, meldingen.
 */
function veryo_run_setup() {
	$report = array(
		'created'  => array(),
		'skipped'  => array(),
		'posts'    => array(),
		'messages' => array(),
	);

	// Eigen, vertrouwde block markup: niet door kses laten filteren.
	kses_remove_filters();

	// 0. Foto's in de mediabibliotheek (voor de pagina's ze gebruiken).
	veryo_import_photos();

	// 1. Pagina's.
	$ids   = array();
	$order = 0;
	foreach ( veryo_content_pages() as $path => $def ) {
		++$order;
		$existing = veryo_find_page( $path );
		if ( $existing ) {
			$ids[ $path ]        = $existing->ID;
			$report['skipped'][] = '' === $path ? '/' : '/' . $path . '/';
			continue;
		}
		$slug        = '' === $path ? 'home' : basename( $path );
		$parent_path = false === strpos( $path, '/' ) ? '' : dirname( $path );
		$parent_id   = 0;
		if ( '' !== $parent_path ) {
			if ( isset( $ids[ $parent_path ] ) ) {
				$parent_id = $ids[ $parent_path ];
			} else {
				$parent    = veryo_find_page( $parent_path );
				$parent_id = $parent ? $parent->ID : 0;
			}
		}
		$post_id = wp_insert_post(
			wp_slash(
				array(
					'post_type'      => 'page',
					'post_status'    => 'publish',
					'post_title'     => $def['title'],
					'post_name'      => $slug,
					'post_parent'    => $parent_id,
					'post_content'   => $def['content'],
					'menu_order'     => $order,
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				)
			),
			true
		);
		if ( is_wp_error( $post_id ) ) {
			$report['messages'][] = sprintf( 'Fout bij %s: %s', $path, $post_id->get_error_message() );
			continue;
		}
		veryo_apply_page_meta( $post_id, $def );
		veryo_remember_content( $post_id );
		$ids[ $path ]        = $post_id;
		$report['created'][] = '' === $path ? '/' : '/' . $path . '/';
	}
	$map = array();
	foreach ( $ids as $path => $id ) {
		$map[ '' === $path ? 'home' : $path ] = $id;
	}
	update_option( 'veryo_page_ids', $map, false );

	// 2. Statische voorpagina en berichtenpagina (alleen als er nog geen geldige keuze is).
	$front = (int) get_option( 'page_on_front' );
	if ( 'page' !== get_option( 'show_on_front' ) || ! $front || ! get_post( $front ) ) {
		if ( isset( $ids[''] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $ids[''] );
		}
	}
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( ( ! $posts_page || ! get_post( $posts_page ) ) && isset( $ids['blog'] ) ) {
		update_option( 'page_for_posts', $ids['blog'] );
	}

	// 3. Menu's.
	veryo_setup_menus( $ids, $report );

	// 4. Permalinks alleen aanpassen als ze op "Standaard" staan.
	if ( '' === (string) get_option( 'permalink_structure' ) ) {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$report['messages'][] = __( 'Permalinkstructuur ingesteld op /%postname%/.', 'veryo' );
	}

	// 5. Blogconcepten.
	foreach ( veryo_content_posts() as $slug => $def ) {
		$existing = get_page_by_path( $slug, OBJECT, 'post' );
		if ( $existing instanceof WP_Post && 'trash' !== $existing->post_status ) {
			continue;
		}
		$post_id = wp_insert_post(
			wp_slash(
				array(
					'post_type'    => 'post',
					'post_status'  => 'draft',
					'post_title'   => $def['title'],
					'post_name'    => $slug,
					'post_content' => $def['content'],
				)
			),
			true
		);
		if ( ! is_wp_error( $post_id ) ) {
			veryo_apply_page_meta( $post_id, $def );
			$report['posts'][] = $def['title'];
		}
	}

	kses_init();

	// 5b. Standaardinhoud van WordPress opruimen, alleen als die nog onaangepast is.
	foreach ( array( array( 'hello-world', 'post' ), array( 'sample-page', 'page' ) ) as $default ) {
		$item = get_page_by_path( $default[0], OBJECT, $default[1] );
		if ( $item instanceof WP_Post && 'publish' === $item->post_status && $item->post_modified_gmt === $item->post_date_gmt ) {
			wp_trash_post( $item->ID );
		}
	}

	// 6. Tagline en site-icoon.
	$tagline = (string) get_option( 'blogdescription' );
	if ( '' === $tagline || in_array( $tagline, array( 'Just another WordPress site', 'Nog een WordPress website', 'Zomaar een WordPress website' ), true ) ) {
		update_option( 'blogdescription', __( 'AI die echt werkt.', 'veryo' ) );
	}
	if ( ! get_option( 'site_icon' ) ) {
		$icon_id = veryo_create_site_icon();
		if ( $icon_id ) {
			update_option( 'site_icon', $icon_id );
		}
	}

	flush_rewrite_rules( false );
	update_option( 'veryo_setup_version', VERYO_SETUP_VERSION, false );
	update_option( 'veryo_last_setup_report', $report, false );

	return $report;
}

/**
 * Vingerafdruk van de inhoud zoals het thema die heeft geplaatst. Zo is later te zien
 * of iemand de pagina zelf heeft aangepast.
 *
 * @param int $post_id ID.
 */
function veryo_remember_content( $post_id ) {
	update_post_meta( $post_id, '_veryo_content_hash', md5( (string) get_post_field( 'post_content', $post_id, 'raw' ) ) );
}

/**
 * Is deze pagina nog precies zoals het thema hem heeft geplaatst?
 *
 * @param WP_Post $page Pagina.
 * @return bool
 */
function veryo_page_untouched( $page ) {
	$hash = (string) get_post_meta( $page->ID, '_veryo_content_hash', true );
	if ( '' !== $hash ) {
		return md5( (string) $page->post_content ) === $hash;
	}
	// Pagina's uit een eerdere versie van het thema: nooit opgeslagen sinds het aanmaken.
	return $page->post_modified_gmt === $page->post_date_gmt;
}

/**
 * Pagina's van het thema bijwerken naar de nieuwste inhoud. Alleen pagina's die niemand
 * zelf heeft aangepast; WordPress bewaart de vorige versie als revisie.
 *
 * @param bool $with_menus Ook de Veryo-menu's opnieuw opbouwen.
 * @return array<string,array<int,string>>
 */
function veryo_refresh_content( $with_menus = false ) {
	$report = veryo_run_setup();
	$result = array(
		'updated'  => array(),
		'same'     => array(),
		'kept'     => array(),
		'photos'   => array(),
		'created'  => $report['created'],
		'messages' => array(),
	);
	kses_remove_filters();
	foreach ( veryo_content_pages() as $path => $def ) {
		$page  = veryo_find_page( $path );
		$label = '' === $path ? '/' : '/' . $path . '/';
		if ( ! $page || in_array( $label, $report['created'], true ) ) {
			continue;
		}
		if ( ! veryo_page_untouched( $page ) ) {
			// Zelf aangepast: tekst blijft staan, alleen een ontbrekende foto komt erbij.
			if ( veryo_add_missing_photo( $page, $def ) ) {
				$result['photos'][] = $label;
			} else {
				$result['kept'][] = $label;
			}
			continue;
		}
		if ( $page->post_content === $def['content'] ) {
			$result['same'][] = $label;
			continue;
		}
		// Huidige versie eerst als revisie bewaren, zodat je altijd terug kunt.
		if ( wp_revisions_enabled( $page ) ) {
			_wp_put_post_revision( $page );
		}
		$updated = wp_update_post(
			wp_slash(
				array(
					'ID'           => $page->ID,
					'post_content' => $def['content'],
				)
			),
			true
		);
		if ( is_wp_error( $updated ) ) {
			$result['messages'][] = sprintf( 'Fout bij %s: %s', $label, $updated->get_error_message() );
			continue;
		}
		veryo_apply_page_meta( $page->ID, $def );
		veryo_remember_content( $page->ID );
		$result['updated'][] = $label;
	}
	kses_init();
	delete_option( 'veryo_photos_new' );

	if ( $with_menus ) {
		foreach ( array( 'Veryo hoofdmenu', 'Veryo footer' ) as $name ) {
			$menu = wp_get_nav_menu_object( $name );
			if ( $menu ) {
				wp_delete_nav_menu( $menu->term_id );
			}
		}
		$ids = array();
		foreach ( array_keys( veryo_content_pages() ) as $path ) {
			$page = veryo_find_page( $path );
			if ( $page ) {
				$ids[ $path ] = $page->ID;
			}
		}
		$menu_report = array( 'messages' => array() );
		veryo_setup_menus( $ids, $menu_report );
		$result['messages'] = array_merge( $result['messages'], $menu_report['messages'] );
	}
	return $result;
}

/**
 * Op een zelf aangepaste pagina alleen de foto uit de nieuwste inhoud toevoegen, op de plek
 * waar hij in het ontwerp staat. De tekst van de pagina blijft ongewijzigd.
 *
 * @param WP_Post             $page Pagina.
 * @param array<string,mixed> $def  Definitie uit veryo_content_pages().
 * @return bool Of er een foto is toegevoegd.
 */
function veryo_add_missing_photo( $page, $def ) {
	if ( false !== strpos( (string) $page->post_content, 'wp-block-image' ) || false === strpos( $def['content'], 'wp:image' ) ) {
		return false;
	}
	$new_blocks = parse_blocks( $def['content'] );
	$image      = null;
	$anchor     = '';
	foreach ( $new_blocks as $i => $block ) {
		if ( 'core/image' !== $block['blockName'] ) {
			continue;
		}
		$image = $block;
		for ( $j = $i - 1; $j >= 0; $j-- ) {
			if ( null !== $new_blocks[ $j ]['blockName'] ) {
				$anchor = veryo_block_fingerprint( $new_blocks[ $j ] );
				break;
			}
		}
		break;
	}
	if ( ! $image ) {
		return false;
	}
	$old_blocks = parse_blocks( (string) $page->post_content );
	$position   = null;
	$first      = null;
	foreach ( $old_blocks as $i => $block ) {
		if ( null === $block['blockName'] ) {
			continue;
		}
		if ( null === $first ) {
			$first = $i;
		}
		if ( '' !== $anchor && veryo_block_fingerprint( $block ) === $anchor ) {
			$position = $i;
			break;
		}
	}
	if ( null === $position ) {
		$position = $first;
	}
	if ( null === $position ) {
		return false;
	}
	array_splice( $old_blocks, $position + 1, 0, array( $image ) );
	if ( wp_revisions_enabled( $page ) ) {
		_wp_put_post_revision( $page );
	}
	$updated = wp_update_post(
		wp_slash(
			array(
				'ID'           => $page->ID,
				'post_content' => serialize_blocks( $old_blocks ),
			)
		),
		true
	);
	return ! is_wp_error( $updated );
}

/**
 * Herkenning van een blok: de eerste kop, anders het begin van de tekst.
 *
 * @param array<string,mixed> $block Blok uit parse_blocks().
 * @return string
 */
function veryo_block_fingerprint( $block ) {
	$html = render_block( $block );
	if ( preg_match( '/<h[1-6][^>]*>(.*?)<\/h[1-6]>/is', $html, $m ) ) {
		$text = $m[1];
	} else {
		$text = $html;
	}
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $text ) ) );
	return function_exists( 'mb_substr' ) ? mb_substr( $text, 0, 60 ) : substr( $text, 0, 60 );
}

/**
 * Menu-items toevoegen.
 *
 * @param int                          $menu_id  Menu.
 * @param array<int,array<int,string>> $items    Items: array( label, pad of '#' ), of array( label, pad, children[] ).
 * @param array<string,int>            $ids      Pagina-ID's per pad.
 * @param int                          $parent_item Parent menu-item.
 */
function veryo_add_menu_items( $menu_id, $items, $ids, $parent_item = 0 ) {
	$position = 0;
	foreach ( $items as $item ) {
		++$position;
		$label = $item[0];
		$path  = $item[1];
		$args  = array(
			'menu-item-title'     => $label,
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_item,
			'menu-item-position'  => $position,
		);
		if ( '#' !== $path && isset( $ids[ $path ] ) ) {
			$args['menu-item-type']      = 'post_type';
			$args['menu-item-object']    = 'page';
			$args['menu-item-object-id'] = $ids[ $path ];
		} else {
			$args['menu-item-type'] = 'custom';
			$args['menu-item-url']  = '#' === $path ? '#' : home_url( '/' . $path . '/' );
		}
		$item_id = wp_update_nav_menu_item( $menu_id, 0, $args );
		if ( ! is_wp_error( $item_id ) && ! empty( $item[2] ) ) {
			veryo_add_menu_items( $menu_id, $item[2], $ids, $item_id );
		}
	}
}

/**
 * Hoofd- en footermenu aanmaken (alleen als ze nog niet bestaan) en aan locaties koppelen.
 *
 * @param array<string,int>   $ids    Pagina-ID's.
 * @param array<string,mixed> $report Verslag.
 */
function veryo_setup_menus( $ids, &$report ) {
	$branches = array(
		array( __( 'Installatietechniek', 'veryo' ), 'branches/installatie' ),
		array( __( 'Bouw en aannemerij', 'veryo' ), 'branches/bouw' ),
		array( __( 'Agri en mechanisatie', 'veryo' ), 'branches/agri' ),
		array( __( 'Makelaardij', 'veryo' ), 'branches/makelaardij' ),
		array( __( 'Accountants en adviesbureaus', 'veryo' ), 'branches/zakelijke-dienstverlening' ),
		array( __( 'Horeca en retail', 'veryo' ), 'branches/horeca-retail' ),
		array( __( 'Transport en logistiek', 'veryo' ), 'branches/transport' ),
		array( __( 'Werving en recruitment', 'veryo' ), 'branches/recruitment' ),
	);

	$menus = array(
		'primary' => array(
			'name'  => 'Veryo hoofdmenu',
			'items' => array(
				array(
					__( 'Diensten', 'veryo' ),
					'#',
					array(
						array(
							__( 'Starten', 'veryo' ),
							'#',
							array(
								array( __( 'Gratis AI-scan', 'veryo' ), 'waar-begin-ik-met-ai' ),
								array( __( 'AI-Startpakket', 'veryo' ), 'ai-startpakket' ),
								array( __( 'AI-implementatie MKB', 'veryo' ), 'ai-implementatie-mkb' ),
								array( __( 'AI-training', 'veryo' ), 'ai-training' ),
							),
						),
						array(
							__( 'Inrichten', 'veryo' ),
							'#',
							array(
								array( __( 'De AI-werkplek', 'veryo' ), 'ai-werkplek' ),
								array( __( 'AI-agents', 'veryo' ), 'ai-agents' ),
								array( __( 'Automatisering en koppelingen', 'veryo' ), 'ai-automatisering' ),
								array( __( 'AI op maat', 'veryo' ), 'ai-op-maat' ),
							),
						),
						array(
							__( 'Veilig en doorlopend', 'veryo' ),
							'#',
							array(
								array( __( 'Veilig AI-gebruik', 'veryo' ), 'veilig-ai-gebruik' ),
								array( __( 'AI-partner', 'veryo' ), 'ai-partner' ),
							),
						),
					),
				),
				array( __( 'Branches', 'veryo' ), 'branches', $branches ),
				array( __( 'Prijzen', 'veryo' ), 'prijzen' ),
				array( __( 'Over Veryo', 'veryo' ), 'over-veryo' ),
				array( __( 'Contact', 'veryo' ), 'contact' ),
			),
		),
		'footer'  => array(
			'name'  => 'Veryo footer',
			'items' => array(
				array(
					__( 'Diensten', 'veryo' ),
					'#',
					array(
						array( __( 'AI-Startpakket', 'veryo' ), 'ai-startpakket' ),
						array( __( 'De AI-werkplek', 'veryo' ), 'ai-werkplek' ),
						array( __( 'AI-agents', 'veryo' ), 'ai-agents' ),
						array( __( 'Veilig AI-gebruik', 'veryo' ), 'veilig-ai-gebruik' ),
						array( __( 'AI-automatisering', 'veryo' ), 'ai-automatisering' ),
						array( __( 'AI-implementatie MKB', 'veryo' ), 'ai-implementatie-mkb' ),
						array( __( 'AI-training', 'veryo' ), 'ai-training' ),
						array( __( 'AI-geletterdheid', 'veryo' ), 'ai-training/ai-geletterdheid' ),
						array( __( 'AI op maat', 'veryo' ), 'ai-op-maat' ),
						array( __( 'AI-partner', 'veryo' ), 'ai-partner' ),
						array( __( 'Veryo Academy', 'veryo' ), 'academy' ),
						array( __( 'Prijzen', 'veryo' ), 'prijzen' ),
						array( __( 'Gratis AI-scan', 'veryo' ), 'waar-begin-ik-met-ai' ),
					),
				),
				array(
					__( 'Regio’s', 'veryo' ),
					'#',
					array(
						array( __( 'AI-adviseur Friesland', 'veryo' ), 'ai-adviseur-friesland' ),
						array( __( 'AI-adviseur Groningen', 'veryo' ), 'ai-adviseur-groningen' ),
						array( __( 'AI-adviseur Drenthe', 'veryo' ), 'ai-adviseur-drenthe' ),
						array( __( 'Leeuwarden', 'veryo' ), 'leeuwarden' ),
					),
				),
				array( __( 'Branches', 'veryo' ), 'branches', $branches ),
				array(
					__( 'Veryo', 'veryo' ),
					'#',
					array(
						array( __( 'Over Veryo', 'veryo' ), 'over-veryo' ),
						array( __( 'Contact', 'veryo' ), 'contact' ),
						array( __( 'Blog', 'veryo' ), 'blog' ),
						array( __( 'Privacy', 'veryo' ), 'privacyverklaring' ),
						array( __( 'Cookies', 'veryo' ), 'cookieverklaring' ),
						array( __( 'Voorwaarden', 'veryo' ), 'algemene-voorwaarden' ),
					),
				),
			),
		),
	);

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$locations = is_array( $locations ) ? $locations : array();
	foreach ( $menus as $location => $menu ) {
		$object = wp_get_nav_menu_object( $menu['name'] );
		if ( $object ) {
			$menu_id = (int) $object->term_id;
			// Verwijzen menu-items naar pagina's die er niet meer zijn (verwijderd en opnieuw
			// aangemaakt), dan het menu opnieuw vullen.
			if ( veryo_menu_is_broken( $menu_id, $menu['items'], $ids ) ) {
				foreach ( (array) wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) ) as $item ) {
					wp_delete_post( $item->ID, true );
				}
				veryo_add_menu_items( $menu_id, $menu['items'], $ids );
				/* translators: %s: menunaam. */
				$report['messages'][] = sprintf( __( 'Menu "%s" hersteld.', 'veryo' ), $menu['name'] );
			}
		} else {
			$menu_id = wp_create_nav_menu( $menu['name'] );
			if ( is_wp_error( $menu_id ) ) {
				continue;
			}
			veryo_add_menu_items( $menu_id, $menu['items'], $ids );
			/* translators: %s: menunaam. */
			$report['messages'][] = sprintf( __( 'Menu "%s" aangemaakt.', 'veryo' ), $menu['name'] );
		}
		if ( empty( $locations[ $location ] ) || ! wp_get_nav_menu_object( (int) $locations[ $location ] ) ) {
			$locations[ $location ] = $menu_id;
		}
	}
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Of een Veryo-menu pagina's mist die wel bestaan (bijvoorbeeld na verwijderen en opnieuw aanmaken).
 *
 * @param int                         $menu_id Menu.
 * @param array<int,array<int,mixed>> $items   Menudefinitie.
 * @param array<string,int>           $ids     Pad => pagina-ID.
 * @return bool
 */
function veryo_menu_is_broken( $menu_id, $items, $ids ) {
	$present = array();
	foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
		if ( 'post_type' === $item->type && 'publish' === get_post_status( (int) $item->object_id ) ) {
			$present[ (int) $item->object_id ] = true;
		}
	}
	$stack = $items;
	while ( $stack ) {
		$entry = array_shift( $stack );
		if ( isset( $entry[1] ) && is_string( $entry[1] ) && isset( $ids[ $entry[1] ] ) && empty( $present[ $ids[ $entry[1] ] ] ) ) {
			return true;
		}
		if ( ! empty( $entry[2] ) && is_array( $entry[2] ) ) {
			$stack = array_merge( $stack, $entry[2] );
		}
	}
	return false;
}

/**
 * Site-icoon aanmaken uit het beeldmerk (512×512 PNG in het thema).
 *
 * @return int Attachment-ID of 0.
 */
function veryo_create_site_icon() {
	$source = VERYO_DIR . '/assets/images/icon-512.png';
	if ( ! file_exists( $source ) ) {
		return 0;
	}
	$bits = wp_upload_bits( 'veryo-site-icon.png', null, (string) file_get_contents( $source ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- lokaal themabestand.
	if ( ! empty( $bits['error'] ) ) {
		return 0;
	}
	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => 'image/png',
			'post_title'     => 'Veryo site-icoon',
			'post_status'    => 'inherit',
		),
		$bits['file']
	);
	if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $bits['file'] ) );
	update_post_meta( $attachment_id, '_wp_attachment_context', 'site-icon' );
	return (int) $attachment_id;
}

/**
 * Alle [VUL IN]-placeholders in pagina's en berichten.
 *
 * @return array<int,array<string,mixed>> Per bericht: id, title, status, items.
 */
function veryo_find_placeholders() {
	$query = new WP_Query(
		array(
			'post_type'              => array( 'page', 'post' ),
			'post_status'            => array( 'publish', 'draft', 'pending', 'private', 'future' ),
			'posts_per_page'         => 200, // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page -- eenmalige beheerderslijst.
			'orderby'                => 'menu_order title',
			'order'                  => 'ASC',
			's'                      => '[VUL IN',
			'search_columns'         => array( 'post_content' ),
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);
	$out   = array();
	foreach ( $query->posts as $post ) {
		if ( ! preg_match_all( '/\[VUL IN:[^\]]*\]/u', $post->post_content, $m ) ) {
			continue;
		}
		$out[] = array(
			'id'     => $post->ID,
			'title'  => get_the_title( $post ),
			'type'   => $post->post_type,
			'status' => $post->post_status,
			'items'  => array_values( array_unique( $m[0] ) ),
		);
	}
	return $out;
}

/**
 * Melding na activatie.
 */
function veryo_setup_notice() {
	if ( ! get_option( 'veryo_show_setup_notice' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$placeholders = veryo_find_placeholders();
	$dismiss      = wp_nonce_url( admin_url( 'admin-post.php?action=veryo_dismiss_notice' ), 'veryo_dismiss_notice' );
	?>
	<div class="notice notice-success veryo-setup-notice">
		<p><strong><?php esc_html_e( 'Veryo is geïnstalleerd. Vul nu je bedrijfsgegevens en de AI-scan-instellingen in.', 'veryo' ); ?></strong></p>
		<p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'options-general.php?page=veryo' ) ); ?>"><?php esc_html_e( 'Naar Instellingen > Veryo', 'veryo' ); ?></a>
			<a class="button" href="<?php echo esc_url( admin_url( 'tools.php?page=veryo-content' ) ); ?>"><?php esc_html_e( 'Veryo-inhoud en placeholders', 'veryo' ); ?></a>
			<a href="<?php echo esc_url( $dismiss ); ?>"><?php esc_html_e( 'Melding sluiten', 'veryo' ); ?></a>
		</p>
		<?php if ( $placeholders ) : ?>
			<details>
				<summary>
					<?php
					/* translators: %d: aantal pagina's. */
					echo esc_html( sprintf( _n( '%d pagina of bericht bevat nog [VUL IN]-placeholders', '%d pagina’s en berichten bevatten nog [VUL IN]-placeholders', count( $placeholders ), 'veryo' ), count( $placeholders ) ) );
					?>
				</summary>
				<ul style="list-style:disc;padding-left:20px">
					<?php foreach ( $placeholders as $row ) : ?>
						<li>
							<a href="<?php echo esc_url( (string) get_edit_post_link( $row['id'] ) ); ?>"><?php echo esc_html( $row['title'] ); ?></a>
							(<?php echo esc_html( 'draft' === $row['status'] ? __( 'concept', 'veryo' ) : $row['status'] ); ?>):
							<?php echo esc_html( implode( ' · ', $row['items'] ) ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</details>
		<?php endif; ?>
	</div>
	<?php
}
add_action( 'admin_notices', 'veryo_setup_notice' );

/**
 * Melding sluiten.
 */
function veryo_dismiss_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_dismiss_notice' );
	delete_option( 'veryo_show_setup_notice' );
	wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );
	exit;
}
add_action( 'admin_post_veryo_dismiss_notice', 'veryo_dismiss_notice' );
