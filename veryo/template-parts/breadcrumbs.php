<?php
/**
 * Zichtbare kruimelpad-navigatie.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_crumbs = veryo_breadcrumbs();
if ( count( $veryo_crumbs ) < 2 ) {
	return;
}
$veryo_last = count( $veryo_crumbs ) - 1;
?>
<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Kruimelpad', 'veryo' ); ?>">
	<ol>
		<?php foreach ( $veryo_crumbs as $veryo_i => $veryo_crumb ) : ?>
			<li>
				<?php if ( $veryo_i === $veryo_last ) : ?>
					<span aria-current="page"><?php echo esc_html( $veryo_crumb['name'] ); ?></span>
				<?php else : ?>
					<a href="<?php echo esc_url( $veryo_crumb['url'] ); ?>"><?php echo esc_html( $veryo_crumb['name'] ); ?></a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
