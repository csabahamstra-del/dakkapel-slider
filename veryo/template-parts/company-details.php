<?php
/**
 * Bedrijfsgegevens. Lege velden worden niet getoond.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_c       = veryo_company();
$veryo_address = trim( $veryo_c['street'] );
$veryo_place   = trim( $veryo_c['postcode'] . ' ' . $veryo_c['city'] );
?>
<ul class="company-details">
	<?php if ( $veryo_address || $veryo_place ) : ?>
		<li><?php echo wp_kses( veryo_icon( 'pin' ), veryo_svg_kses() ); ?><span><?php echo esc_html( $veryo_c['name'] ); ?><br><?php echo $veryo_address ? esc_html( $veryo_address ) . '<br>' : ''; ?><?php echo esc_html( $veryo_place ); ?></span></li>
	<?php endif; ?>
	<?php if ( $veryo_c['phone'] ) : ?>
		<li><?php echo wp_kses( veryo_icon( 'phone' ), veryo_svg_kses() ); ?><a href="<?php echo esc_attr( veryo_tel_href( $veryo_c['phone'] ) ); ?>"><?php echo esc_html( $veryo_c['phone'] ); ?></a></li>
	<?php endif; ?>
	<?php if ( $veryo_c['email'] ) : ?>
		<li><?php echo wp_kses( veryo_icon( 'mail' ), veryo_svg_kses() ); ?><a href="mailto:<?php echo esc_attr( antispambot( $veryo_c['email'] ) ); ?>"><?php echo esc_html( antispambot( $veryo_c['email'] ) ); ?></a></li>
	<?php endif; ?>
	<?php if ( $veryo_c['linkedin'] ) : ?>
		<li class="company-details__social"><a href="<?php echo esc_url( $veryo_c['linkedin'] ); ?>" rel="me"><?php esc_html_e( 'LinkedIn', 'veryo' ); ?></a></li>
	<?php endif; ?>
	<?php if ( $veryo_c['instagram'] ) : ?>
		<li class="company-details__social"><a href="<?php echo esc_url( $veryo_c['instagram'] ); ?>" rel="me"><?php esc_html_e( 'Instagram', 'veryo' ); ?></a></li>
	<?php endif; ?>
</ul>
