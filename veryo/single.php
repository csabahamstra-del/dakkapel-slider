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
					<?php $veryo_author = veryo_company()['founder']; ?>
					<?php if ( $veryo_author ) : ?>
						<span aria-hidden="true">·</span> <?php echo esc_html( sprintf( /* translators: %s: naam auteur. */ __( 'Door %s', 'veryo' ), $veryo_author ) ); ?>
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
	</article>
	<?php
endwhile;
get_footer();
