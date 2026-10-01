<?php
/**
 * Draai met: wp eval-file tools/test-content.php
 * Controleert alle pagina's uit het register, SEO-lengtes, woordenaantallen en idempotente setup.
 */
$fail  = 0;
$ok    = 0;
$check = function ( $cond, $msg ) use ( &$fail, &$ok ) {
	if ( $cond ) { $ok++; } else { $fail++; echo "FOUT: $msg\n"; }
};
$long_types = '/^(ai-startpakket|ai-partner|ai-werkplek|ai-agents|veilig-ai-gebruik|ai-automatisering|ai-implementatie-mkb|ai-training|ai-op-maat|ai-adviseur-|leeuwarden|branches\/)/';
printf( "%-45s %-5s %-4s %-4s %s\n", 'pad', 'parent', 'tit', 'desc', 'woorden' );
foreach ( veryo_content_pages() as $path => $def ) {
	$page = veryo_find_page( $path );
	$check( (bool) $page, "pagina ontbreekt: /$path/" );
	if ( ! $page ) { continue; }
	$url      = '' === $path ? home_url( '/' ) : get_permalink( $page );
	$expected = '' === $path ? home_url( '/' ) : home_url( '/' . $path . '/' );
	$check( '' === $path ? (int) get_option( 'page_on_front' ) === $page->ID : $url === $expected, "URL klopt niet voor $path: $url" );
	$parent_ok = true;
	if ( false !== strpos( $path, '/' ) ) {
		$parent    = veryo_find_page( dirname( $path ) );
		$parent_ok = $parent && $parent->ID === (int) $page->post_parent;
	}
	$check( $parent_ok, "parent klopt niet: $path" );
	$t  = get_post_meta( $page->ID, '_veryo_seo_title', true );
	$d  = get_post_meta( $page->ID, '_veryo_seo_desc', true );
	$tl = mb_strlen( $t );
	$dl = mb_strlen( $d );
	$check( $tl > 0 && $tl <= 60, "SEO-title te lang ($tl): $path" );
	$check( $dl >= 140 && $dl <= 155, "meta description $dl tekens: $path" );
	$words = str_word_count( wp_strip_all_tags( do_blocks( $page->post_content ) ), 0, 'ÀÁÂÃÄÅàáâãäåÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖòóôõöÙÚÛÜùúûü’€0123456789-' );
	if ( preg_match( $long_types, $path ) && ! in_array( $path, array( 'branches' ), true ) ) {
		$check( $words >= 700, "te weinig woorden ($words): $path" );
	}
	printf( "%-45s %-5s %-4d %-4d %d\n", '/' . $path . ( $path ? '/' : '' ), $parent_ok ? 'ok' : 'FOUT', $tl, $dl, $words );
}
foreach ( veryo_content_posts() as $slug => $def ) {
	$post = get_page_by_path( $slug, OBJECT, 'post' );
	$check( $post && 'draft' === $post->post_status, "blogconcept ontbreekt of niet concept: $slug" );
	$check( mb_strlen( $def['seo_title'] ) <= 60, "blog SEO-title te lang: $slug (" . mb_strlen( $def['seo_title'] ) . ')' );
	$dl = mb_strlen( $def['desc'] );
	$check( $dl >= 140 && $dl <= 155, "blog description $dl: $slug" );
}

// Idempotentie.
$before_pages = (int) wp_count_posts( 'page' )->publish;
$before_posts = (int) wp_count_posts( 'post' )->draft;
$before_menus = count( wp_get_nav_menus() );
$before_items = count( wp_get_nav_menu_items( 'Veryo hoofdmenu' ) );
$report       = veryo_run_setup();
$check( 0 === count( $report['created'] ), 'tweede setup maakte pagina\'s aan: ' . implode( ',', $report['created'] ) );
$check( (int) wp_count_posts( 'page' )->publish === $before_pages, 'aantal pagina\'s veranderd' );
$check( (int) wp_count_posts( 'post' )->draft === $before_posts, 'aantal concepten veranderd' );
$check( count( wp_get_nav_menus() ) === $before_menus, 'aantal menu\'s veranderd' );
$check( count( wp_get_nav_menu_items( 'Veryo hoofdmenu' ) ) === $before_items, 'menu-items veranderd' );
echo "\nPagina's: $before_pages, concepten: $before_posts, menu's: $before_menus, items hoofdmenu: $before_items\n";
echo "Resultaat: $ok ok, $fail fout\n";
