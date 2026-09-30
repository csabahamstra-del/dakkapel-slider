<?php
/**
 * Pagina.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
while ( have_posts() ) :
	the_post();
	if ( get_post_meta( get_the_ID(), '_veryo_hide_title', true ) ) {
		echo '<div class="landing-crumbs">';
		get_template_part( 'template-parts/breadcrumbs' );
		echo '</div>';
	} else {
		get_template_part( 'template-parts/page-header' );
	}
	if ( get_post_meta( get_the_ID(), '_veryo_legal_draft', true ) && current_user_can( 'edit_pages' ) ) :
		?>
		<div class="admin-warning" role="note">
			<strong><?php esc_html_e( 'Concepttekst, laat dit juridisch controleren.', 'veryo' ); ?></strong>
			<?php esc_html_e( 'Deze melding ziet alleen een ingelogde beheerder. Verwijder het vinkje "juridisch concept" in de Veryo SEO-box als de tekst is gecontroleerd.', 'veryo' ); ?>
		</div>
		<?php
	endif;
	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php
endwhile;
get_footer();
