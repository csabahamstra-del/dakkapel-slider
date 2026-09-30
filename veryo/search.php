<?php
/**
 * Zoekresultaten.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
/* translators: %s: zoekterm. */
get_template_part( 'template-parts/page-header', null, array( 'title' => sprintf( __( 'Zoekresultaten voor: %s', 'veryo' ), get_search_query() ) ) );
?>
<div class="archive-list">
	<?php get_search_form(); ?>
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/card' );
		endwhile;
		the_posts_pagination();
		?>
	<?php else : ?>
		<p><?php esc_html_e( 'Niets gevonden. Probeer een ander woord, of doe de gratis AI-scan om te zien waar AI jou tijd bespaart.', 'veryo' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
