<?php
/**
 * Title: Hero op petrol
 * Slug: veryo/hero
 * Categories: veryo
 * Description: Grote kop met subregel en knoppen, op petrol met het vinkje.
 * Viewport Width: 1280
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

echo veryo_sec_hero( __( 'AI die echt werkt.', 'veryo' ), __( 'Automatiseringen, trainingen en AI op maat voor het MKB in Noord-Nederland.', 'veryo' ), array( array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ), array( __( 'Bekijk wat we doen', 'veryo' ), veryo_link( 'ai-automatisering' ), 'link' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup uit eigen helpers.
