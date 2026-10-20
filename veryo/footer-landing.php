<?php
/**
 * Minimale footer voor landingspagina's: KvK, privacyverklaring en voorwaarden.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_company = veryo_company();
?>
</main>
<footer class="site-footer site-footer--landing">
	<p>
		&copy; <?php echo esc_html( wp_date( 'Y' ) . ' ' . $veryo_company['name'] ); ?>
		<?php if ( $veryo_company['kvk'] ) : ?>
			<span class="sep" aria-hidden="true">·</span> <?php echo esc_html( sprintf( /* translators: %s: KvK-nummer. */ __( 'KvK %s', 'veryo' ), $veryo_company['kvk'] ) ); ?>
		<?php endif; ?>
		<span class="sep" aria-hidden="true">·</span> <a href="<?php echo esc_url( veryo_url( 'privacyverklaring' ) ); ?>"><?php esc_html_e( 'Privacyverklaring', 'veryo' ); ?></a>
		<span class="sep" aria-hidden="true">·</span> <a href="<?php echo esc_url( veryo_url( 'algemene-voorwaarden' ) ); ?>"><?php esc_html_e( 'Algemene voorwaarden', 'veryo' ); ?></a>
	</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
