<?php
/**
 * Berichtenoverzicht (blog) en terugvaltemplate.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();

$veryo_blog_title = is_home() && get_option( 'page_for_posts' ) ? get_the_title( (int) get_option( 'page_for_posts' ) ) : __( 'Blog', 'veryo' );
get_template_part( 'template-parts/page-header', null, array( 'title' => $veryo_blog_title ) );
?>
<div class="archive-list">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/card' );
		endwhile;
		?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Er staan nog geen berichten online.', 'veryo' ); ?></p>
	<?php endif; ?>
</div>
<?php
echo do_blocks( veryo_sec_cta_scan() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- eigen block-markup.
get_footer();
