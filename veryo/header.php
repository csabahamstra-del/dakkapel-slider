<?php
/**
 * Header.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#inhoud"><?php esc_html_e( 'Naar de inhoud', 'veryo' ); ?></a>
<header class="site-header">
	<div class="site-header__inner">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php echo veryo_logo_img( 'default', 36 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- opgebouwd met esc_* in veryo_logo_img. ?>
		</a>
		<button type="button" class="nav-toggle" aria-expanded="false" aria-controls="site-nav">
			<span class="nav-toggle__open"><?php echo wp_kses( veryo_icon( 'menu' ), veryo_svg_kses() ); ?></span>
			<span class="nav-toggle__close"><?php echo wp_kses( veryo_icon( 'close' ), veryo_svg_kses() ); ?></span>
			<span class="nav-toggle__label"><?php esc_html_e( 'Menu', 'veryo' ); ?></span>
		</button>
		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'veryo' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu',
						'depth'          => 2,
						'walker'         => new Veryo_Primary_Walker(),
						'fallback_cb'    => false,
					)
				);
			}
			?>
			<a class="header-cta" href="<?php echo esc_url( veryo_url( 'waar-begin-ik-met-ai' ) ); ?>"><?php esc_html_e( 'Doe de gratis AI-scan', 'veryo' ); ?></a>
		</nav>
	</div>
</header>
<main id="inhoud" class="site-main" tabindex="-1">
