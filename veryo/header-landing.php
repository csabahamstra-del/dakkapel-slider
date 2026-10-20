<?php
/**
 * Header voor landingspagina's: alleen het logo, niet klikbaar en zonder menu.
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
<header class="site-header site-header--landing">
	<div class="site-header__inner">
		<span class="site-logo">
			<?php echo veryo_logo_img( 'default', 36 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- opgebouwd met esc_* in veryo_logo_img. ?>
		</span>
	</div>
</header>
<main id="inhoud" class="site-main" tabindex="-1">
