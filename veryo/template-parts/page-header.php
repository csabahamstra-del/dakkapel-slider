<?php
/**
 * Paginakop met kruimelpad en H1.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_title = isset( $args['title'] ) ? $args['title'] : get_the_title();
$veryo_intro = isset( $args['intro'] ) ? $args['intro'] : '';
?>
<header class="page-header">
	<div class="page-header__inner">
		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
		<h1 class="page-title"><?php echo esc_html( $veryo_title ); ?></h1>
		<?php if ( $veryo_intro ) : ?>
			<p class="page-intro"><?php echo esc_html( $veryo_intro ); ?></p>
		<?php endif; ?>
	</div>
</header>
