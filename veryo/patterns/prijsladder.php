<?php
/**
 * Title: Prijsladder
 * Slug: veryo/prijsladder
 * Categories: veryo
 * Description: Alle stappen van gratis scan tot partner-abonnement.
 * Viewport Width: 1280
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

echo veryo_b_h( __( 'Van instap naar partner', 'veryo' ) ) . veryo_sec_ladder(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup uit eigen helpers.
