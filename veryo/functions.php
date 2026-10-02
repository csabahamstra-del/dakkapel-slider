<?php
/**
 * Veryo thema: laadt alle onderdelen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

define( 'VERYO_VERSION', '1.1.2' );
define( 'VERYO_DIR', get_template_directory() );
define( 'VERYO_URI', get_template_directory_uri() );

$veryo_includes = array(
	'inc/helpers.php',
	'inc/setup.php',
	'inc/class-veryo-primary-walker.php',
	'inc/class-veryo-footer-walker.php',
	'inc/content/blocks.php',
	'inc/photos.php',
	'inc/content/sections.php',
	'inc/content/registry.php',
	'inc/quiz/catalog.php',
	'inc/quiz/scoring.php',
	'inc/quiz/leads.php',
	'inc/quiz/mail.php',
	'inc/quiz/report.php',
	'inc/quiz/rest.php',
	'inc/quiz/shortcodes.php',
	'inc/quiz/privacy.php',
	'inc/seo.php',
	'inc/activation.php',
	'inc/admin/settings.php',
	'inc/admin/tools.php',
);

foreach ( $veryo_includes as $veryo_file ) {
	require_once VERYO_DIR . '/' . $veryo_file;
}
unset( $veryo_includes, $veryo_file );
