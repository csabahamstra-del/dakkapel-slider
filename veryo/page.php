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
	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php
endwhile;
get_footer();
