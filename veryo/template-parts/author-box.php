<?php
/**
 * Auteursblok onder een blogartikel: wie schrijft er, en waarom die iets over het onderwerp
 * kan zeggen. Linkt naar de over-pagina en, als die is ingevuld, naar LinkedIn.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_author   = veryo_blog_author();
$veryo_linkedin = veryo_company()['linkedin'];
?>
<aside class="author-box" aria-label="<?php esc_attr_e( 'Over de auteur', 'veryo' ); ?>">
	<?php if ( veryo_founder_photo_id() ) : ?>
		<?php
		echo wp_get_attachment_image(
			veryo_founder_photo_id(),
			'thumbnail',
			false,
			array(
				'class'   => 'author-box__photo',
				'alt'     => '',
				'loading' => 'lazy',
			)
		);
		?>
	<?php endif; ?>
	<div class="author-box__text">
		<p class="author-box__name"><?php echo esc_html( $veryo_author['name'] ); ?> <span><?php echo esc_html( $veryo_author['job'] ); ?></span></p>
		<p><?php esc_html_e( 'Helpt mkb-bedrijven uit Noord-Nederland met AI die in het dagelijkse werk past: Veryo Collega, de lokale AI-assistent, AI-trainingen voor teams en automatisering bovenop de software die jullie al hebben.', 'veryo' ); ?></p>
		<p class="author-box__links">
			<a href="<?php echo esc_url( veryo_link( 'over-veryo' ) ); ?>"><?php esc_html_e( 'Meer over Veryo', 'veryo' ); ?></a>
			<?php if ( $veryo_linkedin ) : ?>
				<span aria-hidden="true">·</span> <a href="<?php echo esc_url( $veryo_linkedin ); ?>" rel="me noopener" target="_blank"><?php esc_html_e( 'LinkedIn', 'veryo' ); ?></a>
			<?php endif; ?>
		</p>
	</div>
</aside>
