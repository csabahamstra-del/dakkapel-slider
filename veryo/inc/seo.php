<?php
/**
 * SEO: metabox, title, meta description, canonical, robots, Open Graph, JSON-LD (@graph),
 * breadcrumbs, sitemap-uitsluitingen, robots.txt en /llms.txt.
 *
 * Is Yoast SEO of Rank Math actief, dan geeft het thema geen eigen title, meta, canonical,
 * robots-meta, Open Graph of schema uit. De opgeslagen waarden blijven bewaard.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is er een SEO-plugin actief die de head-uitvoer overneemt?
 *
 * @return bool
 */
function veryo_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' );
}

/*
 * Post meta en metabox
 */

/**
 * Meta-velden registreren.
 */
function veryo_register_seo_meta() {
	$fields = array(
		'_veryo_seo_title'   => 'string',
		'_veryo_seo_desc'    => 'string',
		'_veryo_canonical'   => 'string',
		'_veryo_focus_kw'    => 'string',
		'_veryo_noindex'     => 'boolean',
		'_veryo_nofollow'    => 'boolean',
		'_veryo_hide_title'  => 'boolean',
		'_veryo_legal_draft' => 'boolean',
		'_veryo_schema_type' => 'string',
		'_veryo_price_min'   => 'integer',
		'_veryo_price_max'   => 'integer',
		'_veryo_area'        => 'string',
	);
	foreach ( array( 'page', 'post' ) as $type ) {
		foreach ( $fields as $key => $kind ) {
			register_post_meta(
				$type,
				$key,
				array(
					'type'          => $kind,
					'single'        => true,
					'show_in_rest'  => false,
					'auth_callback' => static function () {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}
}
add_action( 'init', 'veryo_register_seo_meta' );

/**
 * Metabox toevoegen.
 */
function veryo_add_seo_metabox() {
	foreach ( array( 'page', 'post' ) as $type ) {
		add_meta_box( 'veryo_seo', __( 'Veryo SEO', 'veryo' ), 'veryo_seo_metabox', $type, 'normal', 'high' );
	}
}
add_action( 'add_meta_boxes', 'veryo_add_seo_metabox' );

/**
 * Metabox tonen.
 *
 * @param WP_Post $post Bericht.
 */
function veryo_seo_metabox( $post ) {
	wp_nonce_field( 'veryo_seo_save', 'veryo_seo_nonce' );
	$m = static function ( $key ) use ( $post ) {
		return get_post_meta( $post->ID, $key, true );
	};
	if ( veryo_seo_plugin_active() ) {
		echo '<p class="description"><strong>' . esc_html__( 'Yoast SEO of Rank Math is actief: het thema geeft deze waarden nu niet zelf uit. Je kunt ze overnemen in de SEO-plugin.', 'veryo' ) . '</strong></p>';
	}
	?>
	<p>
		<label for="veryo_seo_title"><strong><?php esc_html_e( 'SEO-title', 'veryo' ); ?></strong> <span class="veryo-count" data-for="veryo_seo_title" data-max="60"></span></label><br>
		<input type="text" class="widefat" id="veryo_seo_title" name="veryo_seo_title" value="<?php echo esc_attr( $m( '_veryo_seo_title' ) ); ?>">
		<span class="description"><?php esc_html_e( 'Maximaal 60 tekens. Leeg = paginatitel | Veryo.', 'veryo' ); ?></span>
	</p>
	<p>
		<label for="veryo_seo_desc"><strong><?php esc_html_e( 'Meta description', 'veryo' ); ?></strong> <span class="veryo-count" data-for="veryo_seo_desc" data-min="140" data-max="155"></span></label><br>
		<textarea class="widefat" rows="3" id="veryo_seo_desc" name="veryo_seo_desc"><?php echo esc_textarea( $m( '_veryo_seo_desc' ) ); ?></textarea>
		<span class="description"><?php esc_html_e( 'Streef naar 140–155 tekens, met het hoofdzoekwoord.', 'veryo' ); ?></span>
	</p>
	<p>
		<label for="veryo_focus_kw"><strong><?php esc_html_e( 'Hoofdzoekwoord (ter referentie)', 'veryo' ); ?></strong></label><br>
		<input type="text" class="widefat" id="veryo_focus_kw" name="veryo_focus_kw" value="<?php echo esc_attr( $m( '_veryo_focus_kw' ) ); ?>">
	</p>
	<p>
		<label for="veryo_canonical"><strong><?php esc_html_e( 'Canonical-URL (optioneel)', 'veryo' ); ?></strong></label><br>
		<input type="url" class="widefat" id="veryo_canonical" name="veryo_canonical" value="<?php echo esc_attr( $m( '_veryo_canonical' ) ); ?>" placeholder="<?php echo esc_attr( (string) get_permalink( $post ) ); ?>">
	</p>
	<p>
		<label><input type="checkbox" name="veryo_noindex" value="1" <?php checked( (bool) $m( '_veryo_noindex' ) ); ?>> <?php esc_html_e( 'Niet laten indexeren (noindex)', 'veryo' ); ?></label>
		&nbsp; <label><input type="checkbox" name="veryo_nofollow" value="1" <?php checked( (bool) $m( '_veryo_nofollow' ) ); ?>> <?php esc_html_e( 'Links niet volgen (nofollow)', 'veryo' ); ?></label>
	</p>
	<?php if ( 'page' === $post->post_type ) : ?>
		<hr>
		<p>
			<label for="veryo_schema_type"><strong><?php esc_html_e( 'Schema', 'veryo' ); ?></strong></label><br>
			<select id="veryo_schema_type" name="veryo_schema_type">
				<option value=""><?php esc_html_e( 'Alleen webpagina', 'veryo' ); ?></option>
				<option value="service" <?php selected( $m( '_veryo_schema_type' ), 'service' ); ?>><?php esc_html_e( 'Dienst (Service)', 'veryo' ); ?></option>
				<option value="startpakket" <?php selected( $m( '_veryo_schema_type' ), 'startpakket' ); ?>><?php esc_html_e( 'AI-Startpakket (drie vaste prijzen)', 'veryo' ); ?></option>
				<option value="partner" <?php selected( $m( '_veryo_schema_type' ), 'partner' ); ?>><?php esc_html_e( 'AI-partner (maandprijs per teamgrootte)', 'veryo' ); ?></option>
			</select>
			<label for="veryo_price_min"><?php esc_html_e( 'Prijs vanaf (€)', 'veryo' ); ?></label>
			<input type="number" min="0" step="1" id="veryo_price_min" name="veryo_price_min" value="<?php echo esc_attr( (string) $m( '_veryo_price_min' ) ); ?>" style="width:100px">
			<label for="veryo_price_max"><?php esc_html_e( 'tot (€)', 'veryo' ); ?></label>
			<input type="number" min="0" step="1" id="veryo_price_max" name="veryo_price_max" value="<?php echo esc_attr( (string) $m( '_veryo_price_max' ) ); ?>" style="width:100px">
			<label for="veryo_area"><?php esc_html_e( 'Regio (areaServed)', 'veryo' ); ?></label>
			<select id="veryo_area" name="veryo_area">
				<option value=""><?php esc_html_e( 'Friesland, Groningen en Drenthe', 'veryo' ); ?></option>
				<?php foreach ( array( 'Friesland', 'Groningen', 'Drenthe' ) as $veryo_area ) : ?>
					<option value="<?php echo esc_attr( $veryo_area ); ?>" <?php selected( $m( '_veryo_area' ), $veryo_area ); ?>><?php echo esc_html( $veryo_area ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label><input type="checkbox" name="veryo_hide_title" value="1" <?php checked( (bool) $m( '_veryo_hide_title' ) ); ?>> <?php esc_html_e( 'Paginakop verbergen (de H1 staat in de inhoud)', 'veryo' ); ?></label>
			&nbsp; <label><input type="checkbox" name="veryo_legal_draft" value="1" <?php checked( (bool) $m( '_veryo_legal_draft' ) ); ?>> <?php esc_html_e( 'Juridisch concept (toont een melding in de editor)', 'veryo' ); ?></label>
		</p>
	<?php endif; ?>
	<script>
	( function () {
		document.querySelectorAll( '.veryo-count' ).forEach( function ( el ) {
			var input = document.getElementById( el.dataset.for );
			if ( ! input ) { return; }
			var update = function () {
				var n = input.value.length, max = parseInt( el.dataset.max, 10 ), min = parseInt( el.dataset.min || '0', 10 );
				el.textContent = n + ' / ' + max;
				el.style.color = ( n > max || ( min && n > 0 && n < min ) ) ? '#B3261E' : '#2E7A4E';
			};
			input.addEventListener( 'input', update );
			update();
		} );
	} )();
	</script>
	<?php
}

/**
 * Metabox opslaan.
 *
 * @param int $post_id Bericht.
 */
function veryo_save_seo_metabox( $post_id ) {
	if ( ! isset( $_POST['veryo_seo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['veryo_seo_nonce'] ) ), 'veryo_seo_save' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$text = array(
		'veryo_seo_title' => '_veryo_seo_title',
		'veryo_focus_kw'  => '_veryo_focus_kw',
		'veryo_area'      => '_veryo_area',
	);
	foreach ( $text as $field => $key ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
	if ( isset( $_POST['veryo_seo_desc'] ) ) {
		update_post_meta( $post_id, '_veryo_seo_desc', sanitize_textarea_field( wp_unslash( $_POST['veryo_seo_desc'] ) ) );
	}
	if ( isset( $_POST['veryo_canonical'] ) ) {
		update_post_meta( $post_id, '_veryo_canonical', esc_url_raw( wp_unslash( $_POST['veryo_canonical'] ) ) );
	}
	if ( isset( $_POST['veryo_schema_type'] ) ) {
		$type = sanitize_key( wp_unslash( $_POST['veryo_schema_type'] ) );
		update_post_meta( $post_id, '_veryo_schema_type', in_array( $type, array( 'service', 'startpakket', 'partner' ), true ) ? $type : '' );
	}
	foreach ( array(
		'veryo_price_min' => '_veryo_price_min',
		'veryo_price_max' => '_veryo_price_max',
	) as $field => $key ) {
		if ( isset( $_POST[ $field ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $field ] ) );
			if ( '' === $value ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, absint( $value ) );
			}
		}
	}
	$flags = array( 'veryo_noindex', 'veryo_nofollow' );
	if ( 'page' === get_post_type( $post_id ) ) {
		$flags = array_merge( $flags, array( 'veryo_hide_title', 'veryo_legal_draft' ) );
	}
	foreach ( $flags as $flag ) {
		if ( ! empty( $_POST[ $flag ] ) ) {
			update_post_meta( $post_id, '_' . $flag, 1 );
		} else {
			delete_post_meta( $post_id, '_' . $flag );
		}
	}
}
add_action( 'save_post', 'veryo_save_seo_metabox' );

/*
 * Hulpfuncties voor de huidige pagina
 */

/**
 * Het object waar SEO-waarden van komen (pagina, bericht of berichtenpagina).
 *
 * @return int Post-ID of 0.
 */
function veryo_seo_object_id() {
	if ( is_singular() ) {
		return (int) get_queried_object_id();
	}
	if ( is_home() && get_option( 'page_for_posts' ) ) {
		return (int) get_option( 'page_for_posts' );
	}
	return 0;
}

/**
 * SEO-title voor de huidige pagina.
 *
 * @return string
 */
function veryo_seo_title() {
	$id = veryo_seo_object_id();
	if ( $id ) {
		$title = (string) get_post_meta( $id, '_veryo_seo_title', true );
		if ( '' !== $title ) {
			return $title;
		}
		return wp_strip_all_tags( get_the_title( $id ) ) . ' | Veryo';
	}
	return '';
}

/**
 * Meta description voor de huidige pagina.
 *
 * @return string
 */
function veryo_seo_description() {
	$id = veryo_seo_object_id();
	if ( $id ) {
		$desc = (string) get_post_meta( $id, '_veryo_seo_desc', true );
		if ( '' !== $desc ) {
			return $desc;
		}
		$post = get_post( $id );
		if ( $post ) {
			$text = $post->post_excerpt ? $post->post_excerpt : wp_strip_all_tags( strip_shortcodes( excerpt_remove_blocks( $post->post_content ) ) );
			$text = trim( preg_replace( '/\s+/', ' ', (string) $text ) );
			if ( '' !== $text ) {
				return mb_strlen( $text ) > 155 ? rtrim( mb_substr( $text, 0, 152 ) ) . '…' : $text;
			}
		}
	}
	if ( is_front_page() || is_home() ) {
		return veryo_brand_line() . '. ' . __( 'AI-automatiseringen, trainingen en AI op maat voor het MKB in Noord-Nederland.', 'veryo' );
	}
	return '';
}

/**
 * Canonical-URL voor de huidige pagina.
 *
 * @return string
 */
function veryo_seo_canonical() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	$id = veryo_seo_object_id();
	if ( ! $id ) {
		return '';
	}
	$custom = (string) get_post_meta( $id, '_veryo_canonical', true );
	if ( '' !== $custom ) {
		return $custom;
	}
	$url   = (string) get_permalink( $id );
	$paged = max( (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
	if ( $paged > 1 && $url ) {
		$url = trailingslashit( $url ) . user_trailingslashit( 'page/' . $paged );
	}
	return $url;
}

/*
 * Head-uitvoer
 */

/**
 * Title-tag.
 *
 * @param string $title Titel.
 * @return string
 */
function veryo_pre_document_title( $title ) {
	if ( veryo_seo_plugin_active() ) {
		return $title;
	}
	$seo = veryo_seo_title();
	return '' !== $seo ? $seo : $title;
}
add_filter( 'pre_get_document_title', 'veryo_pre_document_title', 20 );

/**
 * Scheidingsteken in titels.
 *
 * @return string
 */
function veryo_title_separator() {
	return '|';
}
add_filter( 'document_title_separator', 'veryo_title_separator' );

/**
 * Robots-meta via de WordPress robots-API.
 *
 * @param array<string,bool|string> $robots Directieven.
 * @return array<string,bool|string>
 */
function veryo_wp_robots( $robots ) {
	if ( veryo_seo_plugin_active() ) {
		return $robots;
	}
	$id = veryo_seo_object_id();
	if ( $id && get_post_meta( $id, '_veryo_noindex', true ) ) {
		$robots['noindex'] = true;
		unset( $robots['max-image-preview'] );
	}
	if ( $id && get_post_meta( $id, '_veryo_nofollow', true ) ) {
		$robots['nofollow'] = true;
	}
	if ( is_404() || is_search() ) {
		$robots['noindex'] = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'veryo_wp_robots' );

/**
 * Meta description, canonical, Open Graph en Twitter.
 */
function veryo_head_meta() {
	if ( veryo_seo_plugin_active() ) {
		return;
	}
	$desc      = veryo_seo_description();
	$canonical = veryo_seo_canonical();
	$title     = veryo_seo_title();
	if ( '' === $title ) {
		$title = wp_get_document_title();
	}
	if ( '' !== $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( '' !== $canonical ) {
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
	}

	$id    = veryo_seo_object_id();
	$image = array( VERYO_URI . '/assets/images/og-default.png', 1200, 630 );
	if ( $id && has_post_thumbnail( $id ) ) {
		$src = wp_get_attachment_image_src( (int) get_post_thumbnail_id( $id ), 'large' );
		if ( $src ) {
			$image = array( $src[0], (int) $src[1], (int) $src[2] );
		}
	}
	$og = array(
		'og:locale'       => 'nl_NL',
		'og:site_name'    => veryo_company()['name'],
		'og:type'         => is_singular( 'post' ) ? 'article' : 'website',
		'og:title'        => $title,
		'og:description'  => $desc,
		'og:url'          => $canonical ? $canonical : home_url( add_query_arg( array() ) ),
		'og:image'        => $image[0],
		'og:image:width'  => (string) $image[1],
		'og:image:height' => (string) $image[2],
	);
	foreach ( $og as $property => $content ) {
		if ( '' === (string) $content ) {
			continue;
		}
		$value = in_array( $property, array( 'og:url', 'og:image' ), true ) ? esc_url( $content ) : esc_attr( $content );
		echo '<meta property="' . esc_attr( $property ) . '" content="' . $value . '">' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- hierboven ge-escaped.
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'veryo_head_meta', 2 );

/**
 * Standaard canonical van WordPress uitzetten als het thema die zelf geeft.
 */
function veryo_remove_core_canonical() {
	if ( ! veryo_seo_plugin_active() ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
}
add_action( 'wp', 'veryo_remove_core_canonical' );

/*
 * Breadcrumbs
 */

/**
 * Kruimelpad voor de huidige pagina.
 *
 * @return array<int,array<string,string>> Lijst van array( name, url ).
 */
function veryo_breadcrumbs() {
	if ( is_front_page() ) {
		return array();
	}
	$crumbs = array(
		array(
			'name' => __( 'Home', 'veryo' ),
			'url'  => home_url( '/' ),
		),
	);
	$blog   = (int) get_option( 'page_for_posts' );
	if ( is_page() ) {
		$id = (int) get_queried_object_id();
		foreach ( array_reverse( get_post_ancestors( $id ) ) as $ancestor ) {
			$crumbs[] = array(
				'name' => wp_strip_all_tags( get_the_title( $ancestor ) ),
				'url'  => (string) get_permalink( $ancestor ),
			);
		}
		$crumbs[] = array(
			'name' => wp_strip_all_tags( get_the_title( $id ) ),
			'url'  => (string) get_permalink( $id ),
		);
	} elseif ( is_singular( 'post' ) ) {
		if ( $blog ) {
			$crumbs[] = array(
				'name' => wp_strip_all_tags( get_the_title( $blog ) ),
				'url'  => (string) get_permalink( $blog ),
			);
		}
		$crumbs[] = array(
			'name' => wp_strip_all_tags( get_the_title() ),
			'url'  => (string) get_permalink(),
		);
	} elseif ( is_home() && $blog ) {
		$crumbs[] = array(
			'name' => wp_strip_all_tags( get_the_title( $blog ) ),
			'url'  => (string) get_permalink( $blog ),
		);
	} elseif ( is_archive() ) {
		if ( $blog ) {
			$crumbs[] = array(
				'name' => wp_strip_all_tags( get_the_title( $blog ) ),
				'url'  => (string) get_permalink( $blog ),
			);
		}
		$crumbs[] = array(
			'name' => wp_strip_all_tags( get_the_archive_title() ),
			'url'  => '',
		);
	} elseif ( is_search() ) {
		$crumbs[] = array(
			'name' => __( 'Zoeken', 'veryo' ),
			'url'  => '',
		);
	} elseif ( is_404() ) {
		$crumbs[] = array(
			'name' => __( 'Niet gevonden', 'veryo' ),
			'url'  => '',
		);
	}
	return $crumbs;
}

/*
 * Schema.org (JSON-LD)
 */

/**
 * Platte tekst zoals die zichtbaar op de pagina staat.
 *
 * @param string $html HTML.
 * @return string
 */
function veryo_visible_text( $html ) {
	$text = wptexturize( do_shortcode( $html ) );
	$text = html_entity_decode( wp_strip_all_tags( $text ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
	return trim( preg_replace( '/\s+/u', ' ', $text ) );
}

/**
 * Vraag/antwoord-paren uit FAQ-blokken (groep met class veryo-faq) halen.
 *
 * @param array<int,array<string,mixed>> $blocks Blokken.
 * @param bool                           $in_faq Binnen een FAQ-groep.
 * @return array<int,array<string,string>>
 */
function veryo_extract_faq( $blocks, $in_faq = false ) {
	$faq = array();
	foreach ( $blocks as $block ) {
		$is_faq = $in_faq || ( 'core/group' === $block['blockName'] && ! empty( $block['attrs']['className'] ) && false !== strpos( (string) $block['attrs']['className'], 'veryo-faq' ) );
		if ( $is_faq && 'core/details' === $block['blockName'] ) {
			$question = '';
			if ( preg_match( '/<summary[^>]*>(.*?)<\/summary>/s', (string) $block['innerHTML'], $m ) ) {
				$question = veryo_visible_text( $m[1] );
			}
			$answer = '';
			foreach ( $block['innerBlocks'] as $inner ) {
				$answer .= ' ' . render_block( $inner );
			}
			$answer = veryo_visible_text( $answer );
			if ( '' !== $question && '' !== $answer ) {
				$faq[] = array(
					'q' => $question,
					'a' => $answer,
				);
			}
			continue;
		}
		if ( ! empty( $block['innerBlocks'] ) ) {
			$faq = array_merge( $faq, veryo_extract_faq( $block['innerBlocks'], $is_faq ) );
		}
	}
	return $faq;
}

/**
 * Organization + ProfessionalService.
 *
 * @return array<string,mixed>
 */
function veryo_schema_organization() {
	$c     = veryo_company();
	$areas = array();
	foreach ( array( 'Friesland', 'Groningen', 'Drenthe' ) as $province ) {
		$areas[] = array(
			'@type' => 'AdministrativeArea',
			'name'  => $province,
		);
	}
	$org = array(
		'@type'       => array( 'Organization', 'ProfessionalService' ),
		'@id'         => home_url( '/#organization' ),
		'name'        => $c['name'],
		'url'         => home_url( '/' ),
		'description' => veryo_brand_line() . '.',
		'slogan'      => __( 'AI die echt werkt.', 'veryo' ),
		'logo'        => array(
			'@type'  => 'ImageObject',
			'url'    => VERYO_URI . '/assets/images/icon-512.png',
			'width'  => 512,
			'height' => 512,
		),
		'image'       => VERYO_URI . '/assets/images/og-default.png',
		'areaServed'  => $areas,
	);
	if ( $c['email'] ) {
		$org['email'] = $c['email'];
	}
	if ( $c['phone'] ) {
		$org['telephone'] = $c['phone'];
	}
	$address = array_filter(
		array(
			'streetAddress'   => $c['street'],
			'postalCode'      => $c['postcode'],
			'addressLocality' => $c['city'],
		)
	);
	if ( $address ) {
		$org['address'] = array_merge(
			array( '@type' => 'PostalAddress' ),
			$address,
			array( 'addressCountry' => 'NL' )
		);
	}
	$same = array_values( array_filter( array( $c['linkedin'], $c['instagram'] ) ) );
	if ( $same ) {
		$org['sameAs'] = $same;
	}
	if ( $c['founder'] ) {
		$org['founder'] = array(
			'@type' => 'Person',
			'name'  => $c['founder'],
		);
	}
	if ( $c['legal_name'] ) {
		$org['legalName'] = $c['legal_name'];
	}
	if ( $c['kvk'] ) {
		$org['identifier'] = array(
			'@type'      => 'PropertyValue',
			'propertyID' => 'KvK',
			'value'      => $c['kvk'],
		);
	}
	return $org;
}

/**
 * Volledige @graph voor de huidige pagina.
 *
 * @return array<int,array<string,mixed>>
 */
function veryo_schema_graph() {
	$graph   = array( veryo_schema_organization() );
	$website = array(
		'@type'      => 'WebSite',
		'@id'        => home_url( '/#website' ),
		'url'        => home_url( '/' ),
		'name'       => veryo_company()['name'],
		'inLanguage' => 'nl-NL',
		'publisher'  => array( '@id' => home_url( '/#organization' ) ),
	);
	if ( is_front_page() ) {
		$graph[] = $website;
	}

	$id  = veryo_seo_object_id();
	$url = veryo_seo_canonical();
	if ( ! $id || ! $url ) {
		return $graph;
	}

	$crumbs = veryo_breadcrumbs();
	$page   = array(
		'@type'      => 'WebPage',
		'@id'        => $url . '#webpage',
		'url'        => $url,
		'name'       => veryo_seo_title(),
		'inLanguage' => 'nl-NL',
		'isPartOf'   => array( '@id' => home_url( '/#website' ) ),
		'about'      => array( '@id' => home_url( '/#organization' ) ),
	);
	$desc   = veryo_seo_description();
	if ( $desc ) {
		$page['description'] = $desc;
	}
	if ( count( $crumbs ) > 1 ) {
		$page['breadcrumb'] = array( '@id' => $url . '#breadcrumb' );
		$items              = array();
		foreach ( $crumbs as $i => $crumb ) {
			$item = array(
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => $crumb['name'],
			);
			if ( $crumb['url'] ) {
				$item['item'] = $crumb['url'];
			}
			$items[] = $item;
		}
		$graph[] = array(
			'@type'           => 'BreadcrumbList',
			'@id'             => $url . '#breadcrumb',
			'itemListElement' => $items,
		);
	}
	$graph[] = $page;

	// Dienst.
	$schema_type = (string) get_post_meta( $id, '_veryo_schema_type', true );
	if ( is_page() && in_array( $schema_type, array( 'service', 'startpakket', 'partner' ), true ) ) {
		$area    = (string) get_post_meta( $id, '_veryo_area', true );
		$areas   = $area ? array( $area ) : array( 'Friesland', 'Groningen', 'Drenthe' );
		$service = array(
			'@type'       => 'Service',
			'@id'         => $url . '#service',
			'name'        => wp_strip_all_tags( get_the_title( $id ) ),
			'description' => $desc,
			'url'         => $url,
			'provider'    => array( '@id' => home_url( '/#organization' ) ),
			'areaServed'  => array_map(
				static function ( $name ) {
					return array(
						'@type' => 'AdministrativeArea',
						'name'  => $name,
					);
				},
				$areas
			),
		);
		$min     = get_post_meta( $id, '_veryo_price_min', true );
		$max     = get_post_meta( $id, '_veryo_price_max', true );
		if ( 'startpakket' === $schema_type ) {
			$offers = array();
			foreach ( veryo_startpakket_prices() as $row ) {
				$offers[] = array(
					'@type'              => 'Offer',
					'name'               => $row['label'],
					'price'              => $row['price'],
					'priceCurrency'      => 'EUR',
					'priceSpecification' => array(
						'@type'                 => 'PriceSpecification',
						'price'                 => $row['price'],
						'priceCurrency'         => 'EUR',
						'valueAddedTaxIncluded' => false,
					),
				);
			}
			$service['offers'] = $offers;
		} elseif ( 'partner' === $schema_type ) {
			$service['offers'] = veryo_schema_partner_offers();
		} elseif ( '' !== (string) $min ) {
			$spec = array(
				'@type'                 => 'PriceSpecification',
				'minPrice'              => (int) $min,
				'priceCurrency'         => 'EUR',
				'valueAddedTaxIncluded' => false,
			);
			if ( '' !== (string) $max ) {
				$spec['maxPrice'] = (int) $max;
			}
			$service['offers'] = array(
				'@type'              => 'Offer',
				'priceCurrency'      => 'EUR',
				'priceSpecification' => $spec,
			);
		}
		// Het abonnement dat bij dit pakket hoort.
		$sub_key = veryo_schema_subscription_for_page( $id );
		if ( $sub_key ) {
			$offers            = isset( $service['offers'] ) ? $service['offers'] : array();
			$offers            = isset( $offers['@type'] ) ? array( $offers ) : $offers;
			$offers[]          = veryo_schema_subscription_offer( $sub_key );
			$service['offers'] = $offers;
		}
		$graph[] = $service;
	}

	// Prijzenpagina: alle abonnementen en AI-partner.
	$page_ids = get_option( 'veryo_page_ids', array() );
	if ( is_page() && is_array( $page_ids ) && ! empty( $page_ids['prijzen'] ) && (int) $page_ids['prijzen'] === $id ) {
		$offers = array();
		foreach ( array_keys( veryo_subscriptions() ) as $sub_key ) {
			$offers[] = veryo_schema_subscription_offer( $sub_key );
		}
		$graph[] = array(
			'@type'    => 'Service',
			'@id'      => $url . '#abonnementen',
			'name'     => __( 'Abonnementen en AI-partner', 'veryo' ),
			'provider' => array( '@id' => home_url( '/#organization' ) ),
			'offers'   => array_merge( $offers, veryo_schema_partner_offers() ),
		);
	}

	// Blogbericht.
	if ( is_singular( 'post' ) ) {
		$founder = veryo_company()['founder'];
		$article = array(
			'@type'            => 'Article',
			'@id'              => $url . '#article',
			'headline'         => wp_strip_all_tags( get_the_title( $id ) ),
			'datePublished'    => get_the_date( 'c', $id ),
			'dateModified'     => get_the_modified_date( 'c', $id ),
			'mainEntityOfPage' => array( '@id' => $url . '#webpage' ),
			'publisher'        => array( '@id' => home_url( '/#organization' ) ),
			'author'           => $founder ? array(
				'@type' => 'Person',
				'name'  => $founder,
			) : array( '@id' => home_url( '/#organization' ) ),
			'inLanguage'       => 'nl-NL',
			'image'            => has_post_thumbnail( $id ) ? (string) get_the_post_thumbnail_url( $id, 'large' ) : VERYO_URI . '/assets/images/og-default.png',
		);
		if ( $desc ) {
			$article['description'] = $desc;
		}
		$graph[] = $article;
	}

	// FAQ.
	$post = get_post( $id );
	if ( $post && has_blocks( $post->post_content ) ) {
		$faq = veryo_extract_faq( parse_blocks( $post->post_content ) );
		if ( $faq ) {
			$graph[] = array(
				'@type'      => 'FAQPage',
				'@id'        => $url . '#faq',
				'mainEntity' => array_map(
					static function ( $row ) {
						return array(
							'@type'          => 'Question',
							'name'           => $row['q'],
							'acceptedAnswer' => array(
								'@type' => 'Answer',
								'text'  => $row['a'],
							),
						);
					},
					$faq
				),
			);
		}
	}
	return $graph;
}

/**
 * JSON-LD uitvoeren.
 */
function veryo_output_schema() {
	if ( veryo_seo_plugin_active() || is_404() || is_page( 'rapport' ) ) {
		return;
	}
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => veryo_schema_graph(),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON met JSON_HEX_TAG.
}
add_action( 'wp_head', 'veryo_output_schema', 30 );

/*
 * Sitemap, robots.txt en llms.txt
 */

/**
 * Leads nooit in de sitemap.
 *
 * @param array<string,WP_Post_Type> $post_types Post types.
 * @return array<string,WP_Post_Type>
 */
function veryo_sitemap_post_types( $post_types ) {
	unset( $post_types['veryo_lead'] );
	return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'veryo_sitemap_post_types' );

/**
 * Noindex-pagina's, /rapport/ en /bedankt/ uit de sitemap.
 *
 * @param array<string,mixed> $args      Query-argumenten.
 * @param string              $post_type Post type.
 * @return array<string,mixed>
 */
function veryo_sitemap_query_args( $args, $post_type ) {
	if ( ! in_array( $post_type, array( 'page', 'post' ), true ) ) {
		return $args;
	}
	$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- alleen bij het opbouwen van de sitemap.
		'relation' => 'OR',
		array(
			'key'     => '_veryo_noindex',
			'compare' => 'NOT EXISTS',
		),
		array(
			'key'     => '_veryo_noindex',
			'value'   => '1',
			'compare' => '!=',
		),
	);
	if ( 'page' === $post_type ) {
		$exclude = array();
		foreach ( array( 'rapport', 'bedankt' ) as $path ) {
			$page = get_page_by_path( $path );
			if ( $page ) {
				$exclude[] = $page->ID;
			}
		}
		if ( $exclude ) {
			$args['post__not_in'] = array_merge( isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array(), $exclude ); // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in -- twee pagina's.
		}
	}
	return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'veryo_sitemap_query_args', 10, 2 );

/**
 * Geen auteurs-sitemap (voorkomt het tonen van gebruikersnamen).
 *
 * @param WP_Sitemaps_Provider|false $provider Provider.
 * @param string                     $name     Naam.
 * @return WP_Sitemaps_Provider|false
 */
function veryo_sitemap_providers( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}
add_filter( 'wp_sitemaps_add_provider', 'veryo_sitemap_providers', 10, 2 );

/**
 * Robots.txt: niemand blokkeren (ook AI-crawlers niet), wel /rapport/ en /wp-admin/.
 *
 * @param string $output Uitvoer.
 * @param bool   $is_public Site zichtbaar voor zoekmachines.
 * @return string
 */
function veryo_robots_txt( $output, $is_public ) {
	if ( ! $is_public ) {
		return $output;
	}
	$path  = (string) wp_parse_url( home_url(), PHP_URL_PATH );
	$base  = trailingslashit( $path );
	$lines = array(
		'# Zoekmachines en AI-crawlers (Googlebot, Bingbot, GPTBot, OAI-SearchBot, ChatGPT-User, PerplexityBot, ClaudeBot) zijn welkom.',
		'User-agent: *',
		'Disallow: ' . $base . 'wp-admin/',
		'Allow: ' . $base . 'wp-admin/admin-ajax.php',
		'Disallow: ' . $base . 'rapport/',
		'',
		'Sitemap: ' . home_url( '/wp-sitemap.xml' ),
	);
	return implode( "\n", $lines ) . "\n";
}
add_filter( 'robots_txt', 'veryo_robots_txt', 20, 2 );

/**
 * /llms.txt serveren (Markdown als platte tekst).
 *
 * @param WP $wp Request.
 */
function veryo_maybe_serve_llms( $wp ) {
	if ( 'llms.txt' !== $wp->request ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo veryo_llms_txt(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- platte tekst, opgebouwd uit gesaniteerde waarden.
	exit;
}
add_action( 'parse_request', 'veryo_maybe_serve_llms' );

/**
 * Inhoud van /llms.txt, opgebouwd uit instellingen en pagina's.
 *
 * @return string
 */
function veryo_llms_txt() {
	$c     = veryo_company();
	$clean = static function ( $text ) {
		return trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $text ) ) );
	};
	$out   = array();
	$out[] = '# ' . $clean( $c['name'] );
	$out[] = '';
	$out[] = '> ' . veryo_brand_line() . '. ' . __( 'AI die echt werkt.', 'veryo' );
	$out[] = '';
	$out[] = $clean(
		sprintf(
			/* translators: %s: plaats. */
			__( 'Veryo is de onafhankelijke AI-partner voor het MKB (teams tot ongeveer 50 mensen), gevestigd in %s. Veryo adviseert welke AI past, voert die in en traint het team, en bouwt koppelingen of maatwerk waar bestaande software tekortschiet. Veryo verkoopt geen eigen software. Hoofdproduct is het Veryo AI-Startpakket. Zes pijlers: advies en AI-Startpakket, training, de AI-werkplek (Copilot en Gemini), digitale collega’s (AI-agents) en automatisering, veilig AI-gebruik en AI-partner. Veryo is geen IT-bedrijf en doet geen IT-beheer, hardware of helpdesk. Vaste pakketprijzen en resultaten die je in uren en euro’s kunt meten. Werkgebied: Friesland, Groningen en Drenthe (op locatie); trainingen en online diensten ook landelijk. Sterk in bouw, installatie, agri en techniek.', 'veryo' ),
			$c['city'] ? $c['city'] : 'Leeuwarden'
		)
	);
	$out[] = '';
	$out[] = '## ' . __( 'Diensten en prijsindicaties (exclusief btw)', 'veryo' );
	$out[] = '';
	foreach ( veryo_price_ladder() as $row ) {
		$out[] = '- [' . $clean( $row['dienst'] ) . '](' . veryo_url( $row['path'] ) . '): ' . $clean( $row['prijs'] ) . '. ' . $clean( $row['wat'] );
	}
	$out[] = '';
	$out[] = '## ' . __( 'Abonnementen (per maand, exclusief btw)', 'veryo' );
	$out[] = '';
	foreach ( veryo_subscriptions() as $sub ) {
		$out[] = '- ' . $clean( $sub['naam'] ) . ' (' . $clean( $sub['bij'] ) . '): ' . $clean( $sub['prijs'] ) . '. ' . $clean( $sub['inhoud'] );
	}
	foreach ( veryo_partner_tiers() as $tier ) {
		/* translators: 1: teamgrootte, 2: prijs. */
		$out[] = '- ' . $clean( sprintf( __( 'AI-partner, %1$s: €%2$d per maand.', 'veryo' ), mb_strtolower( $tier['label'] ), (int) $tier['price'] ) ) . ' ' . $clean( $tier['extra'] );
	}
	$out[] = '';
	$out[] = '## ' . __( 'Regio’s', 'veryo' );
	$out[] = '';
	foreach ( array( 'ai-adviseur-friesland', 'ai-adviseur-groningen', 'ai-adviseur-drenthe', 'leeuwarden' ) as $path ) {
		$page = get_page_by_path( $path );
		if ( $page && 'publish' === $page->post_status ) {
			$out[] = '- [' . $clean( get_the_title( $page ) ) . '](' . get_permalink( $page ) . ')';
		}
	}
	$out[] = '';
	$out[] = '## ' . __( 'Belangrijkste pagina’s', 'veryo' );
	$out[] = '';
	$map   = get_option( 'veryo_page_ids', array() );
	foreach ( is_array( $map ) ? $map : array() as $path => $page_id ) {
		$page = get_post( (int) $page_id );
		if ( ! $page || 'publish' !== $page->post_status || get_post_meta( $page->ID, '_veryo_noindex', true ) || in_array( $path, array( 'blog' ), true ) ) {
			continue;
		}
		$desc  = (string) get_post_meta( $page->ID, '_veryo_seo_desc', true );
		$url   = 'home' === $path ? home_url( '/' ) : get_permalink( $page );
		$out[] = '- [' . $clean( get_the_title( $page ) ) . '](' . $url . ')' . ( $desc ? ': ' . $clean( $desc ) : '' );
	}
	$out[] = '';
	$out[] = '## ' . __( 'Contact', 'veryo' );
	$out[] = '';
	if ( $c['email'] ) {
		$out[] = '- E-mail: ' . $c['email'];
	}
	if ( $c['phone'] ) {
		$out[] = '- Telefoon: ' . $c['phone'];
	}
	$out[] = '- ' . __( 'Contactpagina', 'veryo' ) . ': ' . veryo_url( 'contact' );
	$out[] = '- ' . __( 'Gratis AI-scan', 'veryo' ) . ': ' . veryo_url( 'waar-begin-ik-met-ai' );
	return implode( "\n", $out ) . "\n";
}

/**
 * Melding in de editor bij juridische concepten (op de website zelf is niets te zien).
 */
function veryo_legal_draft_notice() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'page' !== $screen->id || empty( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- alleen lezen.
		return;
	}
	if ( ! get_post_meta( absint( $_GET['post'] ), '_veryo_legal_draft', true ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- alleen lezen.
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>' . esc_html__( 'Concepttekst, laat dit juridisch controleren.', 'veryo' ) . '</strong> ' . esc_html__( 'Haal daarna het vinkje "Juridisch concept" weg in de box Veryo SEO.', 'veryo' ) . '</p></div>';
}
add_action( 'admin_notices', 'veryo_legal_draft_notice' );

/**
 * Offer met maandprijs voor een abonnement (UnitPriceSpecification).
 *
 * @param string $key Sleutel uit veryo_subscriptions().
 * @return array<string,mixed>
 */
function veryo_schema_subscription_offer( $key ) {
	$sub  = veryo_subscriptions()[ $key ];
	$spec = array(
		'@type'                 => 'UnitPriceSpecification',
		'priceCurrency'         => 'EUR',
		'unitText'              => $sub['unit'],
		'valueAddedTaxIncluded' => false,
	);
	if ( isset( $sub['min'], $sub['max'] ) ) {
		$spec['minPrice'] = (int) $sub['min'];
		$spec['maxPrice'] = (int) $sub['max'];
	} else {
		$spec['price'] = (int) $sub['price'];
	}
	return array(
		'@type'              => 'Offer',
		'name'               => $sub['naam'],
		'description'        => $sub['inhoud'],
		'priceCurrency'      => 'EUR',
		'priceSpecification' => $spec,
	);
}

/**
 * Offers voor AI-partner, één per teamgrootte.
 *
 * @return array<int,array<string,mixed>>
 */
function veryo_schema_partner_offers() {
	$offers = array();
	foreach ( veryo_partner_tiers() as $tier ) {
		$offers[] = array(
			'@type'              => 'Offer',
			/* translators: %s: teamgrootte. */
			'name'               => sprintf( __( 'AI-partner, %s', 'veryo' ), mb_strtolower( $tier['label'] ) ),
			'description'        => $tier['extra'],
			'priceCurrency'      => 'EUR',
			'priceSpecification' => array(
				'@type'                 => 'UnitPriceSpecification',
				'price'                 => (int) $tier['price'],
				'priceCurrency'         => 'EUR',
				'unitText'              => 'maand',
				'valueAddedTaxIncluded' => false,
			),
		);
	}
	return $offers;
}

/**
 * Welk abonnement hoort bij deze pakketpagina?
 *
 * @param int $id Pagina-ID.
 * @return string Sleutel of leeg.
 */
function veryo_schema_subscription_for_page( $id ) {
	$map = array(
		'ai-startpakket'    => 'bijblijven',
		'ai-werkplek'       => 'werkplek-onderhoud',
		'veilig-ai-gebruik' => 'veilig-blijven',
		'ai-agents'         => 'onderhoud',
	);
	$ids = get_option( 'veryo_page_ids', array() );
	foreach ( $map as $path => $key ) {
		if ( is_array( $ids ) && ! empty( $ids[ $path ] ) && (int) $ids[ $path ] === (int) $id ) {
			return $key;
		}
	}
	return '';
}

