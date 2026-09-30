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

		<p><?php esc_html_e( 'Deze knop maakt pagina’s, menu’s en blogconcepten van het thema aan die nog ontbreken. Bestaande pagina’s worden nooit overschreven; heb je een pagina verwijderd of hernoemd, dan wordt hij opnieuw aangemaakt.', 'veryo' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="veryo_rerun_setup">
			<?php wp_nonce_field( 'veryo_rerun_setup' ); ?>
			<?php submit_button( __( 'Veryo-inhoud opnieuw aanmaken (ontbrekende pagina’s)', 'veryo' ), 'primary', 'submit', false ); ?>
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
		<p class="description"><?php esc_html_e( 'Let ook op de [FOTO: …]-blokken: vervang ze door echte foto’s met de voorgestelde alt-tekst.', 'veryo' ); ?></p>
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
