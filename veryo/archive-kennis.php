<?php
/**
 * Kennisbank: overzicht van alle kennisartikelen op /kennis/.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => __( 'Kennisbank', 'veryo' ) ) );
?>
<div class="archive-list kennis-archive">
	<p class="veryo-lead kennis-archive__intro"><?php esc_html_e( 'Praktische kennis over AI voor het mkb: heldere uitleg, stappenplannen en voorbeelden over automatisering, AI-training en lokale AI. Geschreven door Csaba Hamstra, oprichter van Veryo.', 'veryo' ); ?></p>
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/card' );
		endwhile;
		the_posts_pagination();
		?>
	<?php else : ?>
		<p><?php esc_html_e( 'De eerste artikelen verschijnen hier binnenkort. Tot die tijd beantwoorden we jullie vragen graag persoonlijk.', 'veryo' ); ?> <a href="<?php echo esc_url( veryo_link( 'contact' ) ); ?>"><?php esc_html_e( 'Stel jullie vraag', 'veryo' ); ?></a></p>
	<?php endif; ?>
</div>
<?php
echo do_blocks( veryo_sec_cta_scan() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- eigen block-markup.
get_footer();
