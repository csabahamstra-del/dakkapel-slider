<?php
/**
 * Extra > Veryo-inhoud: ontbrekende pagina's opnieuw aanmaken en placeholders bekijken.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Menu-item onder Extra.
 */
function veryo_tools_menu() {
	add_management_page( __( 'Veryo-inhoud', 'veryo' ), __( 'Veryo-inhoud', 'veryo' ), 'manage_options', 'veryo-content', 'veryo_tools_page' );
}
add_action( 'admin_menu', 'veryo_tools_menu' );

/**
 * De pagina.
 */
function veryo_tools_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$report = get_transient( 'veryo_setup_ran_' . get_current_user_id() );
	if ( $report ) {
		delete_transient( 'veryo_setup_ran_' . get_current_user_id() );
	}
	$placeholders = veryo_find_placeholders();
	$refresh      = get_transient( 'veryo_refresh_ran_' . get_current_user_id() );
	if ( $refresh ) {
		delete_transient( 'veryo_refresh_ran_' . get_current_user_id() );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Veryo-inhoud', 'veryo' ); ?></h1>
		<?php if ( is_array( $report ) ) : ?>
			<div class="notice notice-success is-dismissible">
				<p>
					<?php
					/* translators: 1: aantal aangemaakt, 2: aantal bestaand, 3: aantal blogconcepten. */
					echo esc_html( sprintf( __( 'Klaar. Aangemaakt: %1$d pagina’s. Al aanwezig (niet aangepast): %2$d. Nieuwe blogconcepten: %3$d.', 'veryo' ), count( $report['created'] ), count( $report['skipped'] ), count( $report['posts'] ) ) );
					?>
				</p>
				<?php if ( $report['created'] ) : ?>
					<p><?php echo esc_html( implode( ', ', $report['created'] ) ); ?></p>
				<?php endif; ?>
				<?php foreach ( $report['messages'] as $veryo_msg ) : ?>
					<p><?php echo esc_html( $veryo_msg ); ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php $veryo_health = veryo_site_health(); ?>
		<h2><?php esc_html_e( 'Stand van de website', 'veryo' ); ?></h2>
		<table class="widefat striped" style="max-width:720px">
			<tbody>
				<tr><td><?php esc_html_e( 'Themaversie', 'veryo' ); ?></td><td><?php echo esc_html( VERYO_VERSION ); ?></td></tr>
				<tr><td><?php esc_html_e( 'Ontbrekende pagina’s', 'veryo' ); ?></td><td><?php echo esc_html( $veryo_health['missing'] ? implode( ', ', $veryo_health['missing'] ) : '0' ); ?></td></tr>
				<tr><td><?php esc_html_e( 'Pagina’s als concept', 'veryo' ); ?></td><td><?php echo esc_html( $veryo_health['drafts'] ? implode( ', ', $veryo_health['drafts'] ) : '0' ); ?></td></tr>
				<tr><td><?php esc_html_e( 'Menu op plek Hoofdmenu', 'veryo' ); ?></td><td><?php echo esc_html( '' !== $veryo_health['location'] ? sprintf( '%s (%d items)', $veryo_health['location'], $veryo_health['items'] ) : __( 'geen', 'veryo' ) ); ?></td></tr>
				<tr><td><?php esc_html_e( 'Foto’s in mediabibliotheek', 'veryo' ); ?></td><td><?php echo esc_html( (string) count( array_filter( (array) get_option( 'veryo_photo_ids', array() ), 'get_post' ) ) ); ?></td></tr>
			</tbody>
		</table>
		<p><?php esc_html_e( 'Klopt hier iets niet, of zie je op de website geen menu? Deze knop zet pagina’s, concepten van het thema en het hoofdmenu en de footer recht.', 'veryo' ); ?></p>
		<?php veryo_repair_button( __( 'Website herstellen', 'veryo' ) ); ?>

		<p><?php esc_html_e( 'Deze knop maakt pagina’s, menu’s en blogconcepten van het thema aan die nog ontbreken. Bestaande pagina’s worden nooit overschreven; heb je een pagina verwijderd of hernoemd, dan wordt hij opnieuw aangemaakt.', 'veryo' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="veryo_rerun_setup">
			<?php wp_nonce_field( 'veryo_rerun_setup' ); ?>
			<?php submit_button( __( 'Veryo-inhoud opnieuw aanmaken (ontbrekende pagina’s)', 'veryo' ), 'primary', 'submit', false ); ?>
		</form>

		<h2><?php esc_html_e( 'Pagina’s bijwerken naar de nieuwste versie', 'veryo' ); ?></h2>
		<?php if ( is_array( $refresh ) ) : ?>
			<div class="notice notice-success is-dismissible">
				<p>
					<?php
					/* translators: 1: bijgewerkt, 2: al actueel, 3: zelf aangepast (overgeslagen). */
					echo esc_html( sprintf( __( 'Klaar. Bijgewerkt: %1$d. Al actueel: %2$d. Zelf aangepast en daarom niet aangeraakt: %3$d.', 'veryo' ), count( $refresh['updated'] ), count( $refresh['same'] ), count( $refresh['kept'] ) ) );
					?>
				</p>
				<?php if ( $refresh['updated'] ) : ?>
					<p><strong><?php esc_html_e( 'Bijgewerkt:', 'veryo' ); ?></strong> <?php echo esc_html( implode( ', ', $refresh['updated'] ) ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $refresh['photos'] ) ) : ?>
					<p><strong><?php esc_html_e( 'Zelf aangepast, alleen een foto toegevoegd:', 'veryo' ); ?></strong> <?php echo esc_html( implode( ', ', $refresh['photos'] ) ); ?></p>
				<?php endif; ?>
				<?php if ( $refresh['kept'] ) : ?>
					<p><strong><?php esc_html_e( 'Niet aangeraakt (zelf aangepast):', 'veryo' ); ?></strong> <?php echo esc_html( implode( ', ', $refresh['kept'] ) ); ?></p>
				<?php endif; ?>
				<?php foreach ( $refresh['messages'] as $veryo_msg ) : ?>
					<p><?php echo esc_html( $veryo_msg ); ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<p><?php esc_html_e( 'Werkt het thema bij en wil je de nieuwe teksten en indeling ook op je bestaande pagina’s? Deze knop vervangt alleen pagina’s die je zelf niet hebt aangepast. De vorige versie blijft bewaard als revisie, zodat je altijd terug kunt.', 'veryo' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="veryo_refresh_content">
			<?php wp_nonce_field( 'veryo_refresh_content' ); ?>
			<p><label><input type="checkbox" name="veryo_menus" value="1"> <?php esc_html_e( 'Ook het Veryo-hoofdmenu en de Veryo-footer opnieuw opbouwen (eigen menu-aanpassingen gaan dan verloren)', 'veryo' ); ?></label></p>
			<?php submit_button( __( 'Pagina’s bijwerken', 'veryo' ), 'secondary', 'submit', false ); ?>
		</form>

		<h2><?php esc_html_e( 'Nog in te vullen: [VUL IN]-placeholders', 'veryo' ); ?></h2>
		<?php if ( ! $placeholders ) : ?>
			<p><?php esc_html_e( 'Er staan geen placeholders meer in pagina’s of berichten.', 'veryo' ); ?></p>
		<?php else : ?>
			<table class="widefat striped">
				<thead><tr><th><?php esc_html_e( 'Pagina of bericht', 'veryo' ); ?></th><th><?php esc_html_e( 'Status', 'veryo' ); ?></th><th><?php esc_html_e( 'Placeholders', 'veryo' ); ?></th></tr></thead>
				<tbody>
					<?php foreach ( $placeholders as $veryo_row ) : ?>
						<tr>
							<td><a href="<?php echo esc_url( (string) get_edit_post_link( $veryo_row['id'] ) ); ?>"><?php echo esc_html( $veryo_row['title'] ); ?></a></td>
							<td><?php echo esc_html( $veryo_row['status'] ); ?></td>
							<td><ul style="margin:0">
							<?php
							foreach ( $veryo_row['items'] as $veryo_item ) :
								?>
								<li><?php echo esc_html( $veryo_item ); ?></li><?php endforeach; ?></ul></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Knop: setup opnieuw draaien.
 */
function veryo_handle_rerun_setup() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_rerun_setup' );
	$report = veryo_run_setup();
	set_transient( 'veryo_setup_ran_' . get_current_user_id(), $report, MINUTE_IN_SECONDS );
	wp_safe_redirect( admin_url( 'tools.php?page=veryo-content' ) );
	exit;
}
add_action( 'admin_post_veryo_rerun_setup', 'veryo_handle_rerun_setup' );

/**
 * Knop: pagina's bijwerken naar de nieuwste versie.
 */
function veryo_handle_refresh_content() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_refresh_content' );
	$result = veryo_refresh_content( ! empty( $_POST['veryo_menus'] ) );
	set_transient( 'veryo_refresh_ran_' . get_current_user_id(), $result, MINUTE_IN_SECONDS );
	wp_safe_redirect( admin_url( 'tools.php?page=veryo-content' ) );
	exit;
}
add_action( 'admin_post_veryo_refresh_content', 'veryo_handle_refresh_content' );

/**
 * Pagina's van het thema die niet (meer) bestaan, bijvoorbeeld na verwijderen.
 *
 * @return array<int,string> Paden.
 */
function veryo_missing_pages() {
	$missing = array();
	foreach ( veryo_content_pages() as $path => $def ) {
		if ( ! veryo_find_page( $path ) ) {
			$missing[] = '' === $path ? '/' : '/' . $path . '/';
		}
	}
	return $missing;
}

/**
 * Stand van pagina's en menu's: wat er mis is en hersteld kan worden.
 *
 * @return array<string,mixed>
 */
function veryo_site_health() {
	$health = array(
		'missing'  => array(),
		'drafts'   => array(),
		'location' => '',
		'items'    => 0,
		'repair'   => false,
	);
	foreach ( veryo_content_pages() as $path => $def ) {
		$page  = veryo_find_page( $path );
		$label = '' === $path ? '/' : '/' . $path . '/';
		if ( ! $page ) {
			$health['missing'][] = $label;
		} elseif ( 'publish' !== $page->post_status ) {
			// Bijvoorbeeld teruggezet uit de prullenbak: WordPress maakt daar een concept van.
			$health['drafts'][] = $label;
		}
	}
	$locations = get_nav_menu_locations();
	$assigned  = ! empty( $locations['primary'] ) ? wp_get_nav_menu_object( (int) $locations['primary'] ) : false;
	if ( $assigned ) {
		$health['location'] = $assigned->name;
		$health['items']    = count( (array) wp_get_nav_menu_items( $assigned->term_id ) );
	}
	$health['repair'] = $health['missing'] || $health['drafts'] || 'Veryo hoofdmenu' !== $health['location'] || veryo_menus_need_repair();
	return $health;
}

/**
 * Alles herstellen: ontbrekende pagina's aanmaken, concepten van het thema publiceren,
 * de Veryo-menu's opnieuw vullen en aan hoofdmenu en footer koppelen.
 *
 * @return array<string,mixed> Verslag zoals veryo_run_setup().
 */
function veryo_repair_site() {
	$published = array();
	foreach ( veryo_content_pages() as $path => $def ) {
		$page = veryo_find_page( $path );
		if ( $page && in_array( $page->post_status, array( 'draft', 'pending', 'private' ), true ) ) {
			wp_update_post(
				array(
					'ID'          => $page->ID,
					'post_status' => 'publish',
				)
			);
			$published[] = '' === $path ? '/' : '/' . $path . '/';
		}
	}
	$report = veryo_run_setup();
	$ids    = array();
	foreach ( array_keys( veryo_content_pages() ) as $path ) {
		$page = veryo_find_page( $path );
		if ( $page ) {
			$ids[ $path ] = $page->ID;
		}
	}
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$locations = is_array( $locations ) ? $locations : array();
	foreach ( veryo_menu_definitions() as $location => $menu ) {
		$object  = wp_get_nav_menu_object( $menu['name'] );
		$menu_id = $object ? (int) $object->term_id : wp_create_nav_menu( $menu['name'] );
		if ( is_wp_error( $menu_id ) ) {
			continue;
		}
		foreach ( (array) wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) ) as $item ) {
			wp_delete_post( $item->ID, true );
		}
		$errors = array();
		veryo_add_menu_items( $menu_id, $menu['items'], $ids, 0, $errors );
		$locations[ $location ] = $menu_id;
		wp_cache_delete( 'last_changed', 'posts' );
		/* translators: 1: menunaam, 2: aantal items. */
		$report['messages'][] = sprintf( __( '%1$s: %2$d items.', 'veryo' ), $menu['name'], count( (array) wp_get_nav_menu_items( $menu_id ) ) );
		foreach ( $errors as $error ) {
			$report['messages'][] = __( 'Fout bij menu-item', 'veryo' ) . ' ' . $error;
		}
	}
	set_theme_mod( 'nav_menu_locations', $locations );
	if ( $published ) {
		/* translators: %s: lijst met pagina's. */
		$report['messages'][] = sprintf( __( 'Weer gepubliceerd (stonden als concept): %s', 'veryo' ), implode( ', ', $published ) );
	}
	$report['messages'][] = __( 'Hoofdmenu en footer opnieuw gevuld en gekoppeld.', 'veryo' );
	return $report;
}

/**
 * Knop: alles herstellen.
 */
function veryo_handle_repair_site() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Geen toegang.', 'veryo' ) );
	}
	check_admin_referer( 'veryo_repair_site' );
	$report = veryo_repair_site();
	set_transient( 'veryo_setup_ran_' . get_current_user_id(), $report, MINUTE_IN_SECONDS );
	wp_safe_redirect( admin_url( 'tools.php?page=veryo-content' ) );
	exit;
}
add_action( 'admin_post_veryo_repair_site', 'veryo_handle_repair_site' );

/**
 * Formulier met de herstelknop.
 *
 * @param string $label Tekst op de knop.
 */
function veryo_repair_button( $label ) {
	?>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0 0 10px">
		<input type="hidden" name="action" value="veryo_repair_site">
		<?php wp_nonce_field( 'veryo_repair_site' ); ?>
		<?php submit_button( $label, 'primary', 'submit', false ); ?>
	</form>
	<?php
}

/**
 * Melding met één knop als pagina's of het menu niet in orde zijn. Een thema opnieuw
 * uploaden maakt in WordPress geen pagina's of menu's aan; deze knop wel.
 */
function veryo_missing_pages_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'themes', 'edit-page', 'upload', 'nav-menus', 'tools_page_veryo-content' ), true ) ) {
		return;
	}
	$health = veryo_site_health();
	if ( ! $health['repair'] ) {
		return;
	}
	?>
	<div class="notice notice-warning">
		<p><strong><?php esc_html_e( 'Veryo: de website is niet compleet.', 'veryo' ); ?></strong></p>
		<ul style="list-style:disc;padding-left:20px">
			<?php if ( $health['missing'] ) : ?>
				<li>
					<?php
					/* translators: %d: aantal pagina's. */
					echo esc_html( sprintf( _n( '%d pagina ontbreekt.', '%d pagina’s ontbreken.', count( $health['missing'] ), 'veryo' ), count( $health['missing'] ) ) );
					?>
				</li>
			<?php endif; ?>
			<?php if ( $health['drafts'] ) : ?>
				<li>
					<?php
					/* translators: %d: aantal pagina's. */
					echo esc_html( sprintf( _n( '%d pagina staat als concept (bijvoorbeeld na terugzetten uit de prullenbak) en is dus onzichtbaar, ook in het menu.', '%d pagina’s staan als concept (bijvoorbeeld na terugzetten uit de prullenbak) en zijn dus onzichtbaar, ook in het menu.', count( $health['drafts'] ), 'veryo' ), count( $health['drafts'] ) ) );
					?>
				</li>
			<?php endif; ?>
			<?php if ( 'Veryo hoofdmenu' !== $health['location'] || veryo_menus_need_repair() ) : ?>
				<li><?php esc_html_e( 'Het hoofdmenu is onvolledig of niet gekoppeld.', 'veryo' ); ?></li>
			<?php endif; ?>
		</ul>
		<p><?php esc_html_e( 'Eén klik zet alles recht: ontbrekende pagina’s komen terug, concepten van het thema worden gepubliceerd en het hoofdmenu en de footer worden opnieuw gevuld. Je eigen teksten blijven staan.', 'veryo' ); ?></p>
		<?php veryo_repair_button( __( 'Website herstellen', 'veryo' ) ); ?>
	</div>
	<?php
}
add_action( 'admin_notices', 'veryo_missing_pages_notice' );
