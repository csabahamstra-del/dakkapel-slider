<?php
/**
 * Blogbericht.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'single-post' ); ?>>
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
						<?php echo esc_html( sprintf( /* translators: 1: naam auteur, 2: functie. */ __( 'Door %1$s, %2$s', 'veryo' ), $veryo_author['name'], $veryo_author['job'] ) ); ?>
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
			<aside class="post-cta" aria-labelledby="post-cta-title">
				<p class="post-cta__title" id="post-cta-title"><?php esc_html_e( 'Zelf aan de slag met AI?', 'veryo' ); ?></p>
				<p><?php esc_html_e( 'Bekijk Veryo Collega, de lokale AI-assistent voor jullie eigen kennis, of leer je team in één dagdeel veilig werken met AI.', 'veryo' ); ?></p>
				<p class="post-cta__links">
					<a class="btn btn--petrol" href="<?php echo esc_url( veryo_link( veryo_collega()['slug'] ) ); ?>"><?php esc_html_e( 'Bekijk Veryo Collega', 'veryo' ); ?></a>
					<a class="btn btn--link" href="<?php echo esc_url( veryo_link( 'ai-training' ) ); ?>"><?php esc_html_e( 'AI-trainingen', 'veryo' ); ?></a>
				</p>
			</aside>
			<?php
			$veryo_related = veryo_related_posts( get_the_ID() );
			if ( $veryo_related ) :
				?>
				<section class="post-related" aria-labelledby="post-related-title">
					<h2 id="post-related-title"><?php esc_html_e( 'Lees ook', 'veryo' ); ?></h2>
					<ul>
						<?php foreach ( $veryo_related as $veryo_rel ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $veryo_rel ) ); ?>"><?php echo esc_html( get_the_title( $veryo_rel ) ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endif; ?>
		</div>
		<div class="entry-content">
			<?php
			// Na het lezen: direct een vraag kunnen stellen over het onderwerp.
			echo do_shortcode( shortcode_unautop( do_blocks( veryo_sec_contact( __( 'Vraag over dit onderwerp?', 'veryo' ), __( 'Stel hem direct. Je krijgt binnen één werkdag een persoonlijk antwoord, toegespitst op jouw bedrijf.', 'veryo' ) ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- eigen block markup, opgebouwd met escaping.
			?>
		</div>
	</article>
	<?php
endwhile;
get_footer();
