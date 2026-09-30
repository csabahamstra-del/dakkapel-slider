<?php
/**
 * Voorpagina: de inhoud (blokken) bepaalt de opbouw, inclusief de H1 in de hero.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

if ( 'posts' === get_option( 'show_on_front' ) ) {
	require VERYO_DIR . '/index.php';
	return;
}

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php
endwhile;
get_footer();
