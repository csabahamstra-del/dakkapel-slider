<?php
/**
 * Template Name: Landingspagina (zonder menu)
 *
 * Alleen het logo, de blokken van de pagina en een minimale footer met KvK, privacy en
 * voorwaarden. Gebruikt voor /founding-partner, /lead-opvolging en /klantrapportage-beveiliging.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header( 'landing' );
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'veryo-lp' ); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;
get_footer( 'landing' );
