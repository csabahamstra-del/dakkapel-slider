<?php
/**
 * Archieven.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => wp_strip_all_tags( get_the_archive_title() ) ) );
?>
<div class="archive-list">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/card' );
		endwhile;
		the_posts_pagination();
		?>
	<?php else : ?>
		<p><?php esc_html_e( 'Hier staat nog niets.', 'veryo' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
