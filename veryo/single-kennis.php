<?php
/**
 * Kennisartikel: auteur met link naar Over Veryo, publicatie- en bijwerkdatum, leestijd,
 * inhoudsopgave (via the_content), gerelateerde diensten en de CTA naar de gratis AI-scan.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'single-post single-kennis' ); ?>>
		<header class="page-header">
			<div class="page-header__inner">
				<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<p class="post-meta">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<?php if ( get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) ) : ?>
						<span aria-hidden="true">·</span>
						<?php esc_html_e( 'Bijgewerkt', 'veryo' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time>
					<?php endif; ?>
					<span aria-hidden="true">·</span>
					<?php echo esc_html( sprintf( /* translators: %d: minuten. */ _n( '%d minuut lezen', '%d minuten lezen', veryo_reading_time(), 'veryo' ), veryo_reading_time() ) ); ?>
					<?php $veryo_author = veryo_blog_author(); ?>
					<?php if ( $veryo_author['name'] ) : ?>
						<span aria-hidden="true">·</span>
						<?php if ( veryo_founder_photo_id() ) : ?>
							<?php
							echo wp_get_attachment_image(
								veryo_founder_photo_id(),
								'thumbnail',
								false,
								array(
									'class' => 'post-meta__avatar',
									'alt'   => '',
								)
							);
							?>
						<?php endif; ?>
						<?php esc_html_e( 'Door', 'veryo' ); ?> <a href="<?php echo esc_url( veryo_link( 'over-veryo' ) ); ?>" rel="author"><?php echo esc_html( $veryo_author['name'] ); ?></a>, <?php echo esc_html( $veryo_author['job'] ); ?>
					<?php endif; ?>
				</p>
			</div>
		</header>
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="post-thumb"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?></figure>
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<div class="post-after">
			<?php get_template_part( 'template-parts/author-box' ); ?>
			<?php
			$veryo_services = array_intersect_key( veryo_kennis_service_choices(), array_flip( (array) get_post_meta( get_the_ID(), '_veryo_kennis_services', true ) ) );
			if ( $veryo_services ) :
				?>
				<section class="post-related post-services" aria-labelledby="post-services-title">
					<h2 id="post-services-title"><?php esc_html_e( 'Hier helpen we bij', 'veryo' ); ?></h2>
					<ul>
						<?php foreach ( $veryo_services as $veryo_path => $veryo_label ) : ?>
							<li><a href="<?php echo esc_url( veryo_link( $veryo_path ) ); ?>"><?php echo esc_html( $veryo_label ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endif; ?>
			<?php
			$veryo_related = veryo_kennis_related( get_the_ID() );
			if ( $veryo_related ) :
				?>
				<section class="post-related" aria-labelledby="post-related-title">
					<h2 id="post-related-title"><?php esc_html_e( 'Meer uit de kennisbank', 'veryo' ); ?></h2>
					<ul>
						<?php foreach ( $veryo_related as $veryo_rel ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $veryo_rel ) ); ?>"><?php echo esc_html( get_the_title( $veryo_rel ) ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endif; ?>
		</div>
		<?php echo do_blocks( veryo_sec_cta_scan( __( 'Wat levert AI jullie bedrijf op?', 'veryo' ), __( 'Doe de gratis AI-scan. Negen vragen, ongeveer drie minuten, en jullie krijgen een persoonlijk rapport met de drie grootste tijdwinsten.', 'veryo' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- eigen block-markup. ?>
	</article>
	<?php
endwhile;
get_footer();
