<?php
/**
 * Footer.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_company = veryo_company();
?>
</main>
<footer class="site-footer">
	<?php echo veryo_big_check_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- statische SVG. ?>
	<div class="site-footer__inner">
		<div class="footer-brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
				<?php echo veryo_logo_img( 'wit', 36 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- opgebouwd met esc_*. ?>
			</a>
			<p class="footer-tagline"><?php esc_html_e( 'AI die echt werkt.', 'veryo' ); ?><br><?php echo esc_html( veryo_brand_line() ); ?>.</p>
			<?php get_template_part( 'template-parts/company-details', null, array( 'context' => 'footer' ) ); ?>
		</div>
		<?php
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu(
				array(
					'theme_location'       => 'footer',
					'container'            => 'nav',
					'container_class'      => 'footer-nav',
					'container_aria_label' => __( 'Footermenu', 'veryo' ),
					'menu_class'           => 'footer-cols',
					'depth'                => 2,
					'walker'               => new Veryo_Footer_Walker(),
					'fallback_cb'          => false,
				)
			);
		}
		?>
	</div>
	<div class="footer-wordmark" aria-hidden="true"><?php echo veryo_wordmark_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- lokaal themabestand. ?></div>
	<div class="site-footer__legal">
		<p>
			&copy; <?php echo esc_html( wp_date( 'Y' ) . ' ' . $veryo_company['name'] . ( $veryo_company['legal_name'] ? sprintf( /* translators: %s: juridische naam. */ __( ', een handelsnaam van %s', 'veryo' ), $veryo_company['legal_name'] ) : '' ) ); ?>
			<?php if ( $veryo_company['kvk'] ) : ?>
				<span class="sep" aria-hidden="true">·</span> <?php echo esc_html( sprintf( /* translators: %s: KvK-nummer. */ __( 'KvK %s', 'veryo' ), $veryo_company['kvk'] ) ); ?>
			<?php endif; ?>
			<?php if ( $veryo_company['btw'] ) : ?>
				<span class="sep" aria-hidden="true">·</span> <?php echo esc_html( sprintf( /* translators: %s: btw-nummer. */ __( 'Btw %s', 'veryo' ), $veryo_company['btw'] ) ); ?>
			<?php endif; ?>
			<span class="sep" aria-hidden="true">·</span> <?php esc_html_e( 'Alle prijzen exclusief btw.', 'veryo' ); ?>
		</p>
	</div>
</footer>
<?php
$veryo_post = get_post();
if ( ! ( is_singular() && $veryo_post && has_shortcode( (string) $veryo_post->post_content, 'veryo_ai_scan' ) ) ) :
	?>
	<a class="veryo-sticky-cta" href="<?php echo esc_url( veryo_url( 'waar-begin-ik-met-ai' ) ); ?>" hidden><?php esc_html_e( 'Doe de gratis AI-scan', 'veryo' ); ?></a>
	<?php
endif;
$veryo_wa = preg_replace( '/\D/', '', (string) veryo_setting( 'whatsapp_number' ) );
if ( veryo_setting( 'whatsapp' ) && $veryo_wa ) :
	?>
	<a class="veryo-whatsapp" href="<?php echo esc_url( 'https://wa.me/' . $veryo_wa ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Stuur Veryo een WhatsApp-bericht', 'veryo' ); ?>"><?php echo wp_kses( veryo_icon( 'whatsapp' ), veryo_svg_kses() ); ?></a>
	<?php
endif;
wp_footer();
?>
</body>
</html>
