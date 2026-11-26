<?php
/**
 * Kennisbank: overzicht van alle kennisartikelen op /kennis/.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
$veryo_term   = is_tax( 'kennis_categorie' ) ? get_queried_object() : null;
$veryo_search = is_search() ? get_search_query() : '';
if ( $veryo_term instanceof WP_Term ) {
	$veryo_title = sprintf( /* translators: %s: categorie. */ __( 'Kennisbank: %s', 'veryo' ), $veryo_term->name );
} elseif ( '' !== $veryo_search ) {
	$veryo_title = sprintf( /* translators: %s: zoekterm. */ __( 'Zoeken in de kennisbank: %s', 'veryo' ), $veryo_search );
} else {
	$veryo_title = __( 'Kennisbank', 'veryo' );
}
get_template_part( 'template-parts/page-header', null, array( 'title' => $veryo_title ) );
$veryo_terms = get_terms(
	array(
		'taxonomy'   => 'kennis_categorie',
		'hide_empty' => true,
	)
);
?>
<div class="archive-list kennis-archive">
	<p class="veryo-lead kennis-archive__intro"><?php esc_html_e( 'Praktische kennis over AI voor het mkb: heldere uitleg, stappenplannen en voorbeelden over automatisering, AI-veiligheid en AI in jullie branche. Geschreven door Csaba Hamstra, oprichter van Veryo.', 'veryo' ); ?></p>
	<form class="kennis-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="kennis-zoek"><?php esc_html_e( 'Zoek in de kennisbank', 'veryo' ); ?></label>
		<div class="kennis-search__row">
			<input type="search" id="kennis-zoek" name="s" value="<?php echo esc_attr( $veryo_search ); ?>">
			<input type="hidden" name="post_type" value="kennis">
			<button type="submit"><?php esc_html_e( 'Zoeken', 'veryo' ); ?></button>
		</div>
	</form>
	<?php if ( $veryo_terms && ! is_wp_error( $veryo_terms ) ) : ?>
		<nav class="kennis-cats" aria-label="<?php esc_attr_e( 'Categorieën', 'veryo' ); ?>">
			<a href="<?php echo esc_url( veryo_kennis_url() ); ?>"<?php echo ( ! $veryo_term && '' === $veryo_search ) ? ' aria-current="page"' : ''; ?>><?php esc_html_e( 'Alles', 'veryo' ); ?></a>
			<?php foreach ( $veryo_terms as $veryo_cat ) : ?>
				<a href="<?php echo esc_url( get_term_link( $veryo_cat ) ); ?>"<?php echo ( $veryo_term instanceof WP_Term && $veryo_term->term_id === $veryo_cat->term_id ) ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $veryo_cat->name ); ?></a>
			<?php endforeach; ?>
		</nav>
	<?php endif; ?>
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/card' );
		endwhile;
		the_posts_pagination();
		?>
	<?php else : ?>
		<p><?php echo esc_html( '' !== $veryo_search ? __( 'Geen artikelen gevonden. Probeer een ander woord, of stel jullie vraag direct.', 'veryo' ) : __( 'De eerste artikelen verschijnen hier binnenkort. Tot die tijd beantwoorden we jullie vragen graag persoonlijk.', 'veryo' ) ); ?> <a href="<?php echo esc_url( veryo_link( 'contact' ) ); ?>"><?php esc_html_e( 'Stel jullie vraag', 'veryo' ); ?></a></p>
	<?php endif; ?>
</div>
<?php
echo do_blocks( veryo_sec_cta_scan() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- eigen block-markup.
get_footer();
