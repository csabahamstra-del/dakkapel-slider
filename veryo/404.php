<?php
/**
 * Pagina niet gevonden.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => __( 'Deze pagina bestaat niet (meer)', 'veryo' ) ) );
?>
<div class="archive-list">
	<p><?php esc_html_e( 'De link klopt niet of de pagina is verhuisd. Hieronder vind je de belangrijkste plekken op de site.', 'veryo' ); ?></p>
	<ul class="plain-links">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Naar de homepage', 'veryo' ); ?></a></li>
		<li><a href="<?php echo esc_url( veryo_url( 'waar-begin-ik-met-ai' ) ); ?>"><?php esc_html_e( 'Doe de gratis AI-scan', 'veryo' ); ?></a></li>
		<li><a href="<?php echo esc_url( veryo_url( 'ai-automatisering' ) ); ?>"><?php esc_html_e( 'AI-automatisering voor het MKB', 'veryo' ); ?></a></li>
		<li><a href="<?php echo esc_url( veryo_url( 'prijzen' ) ); ?>"><?php esc_html_e( 'Prijzen', 'veryo' ); ?></a></li>
		<li><a href="<?php echo esc_url( veryo_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'veryo' ); ?></a></li>
	</ul>
</div>
<?php
get_footer();
