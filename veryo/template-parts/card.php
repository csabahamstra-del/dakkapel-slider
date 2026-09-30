<?php
/**
 * Berichtkaart in overzichten.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'post-card' ); ?>>
	<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="post-card__meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
	<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
</article>
