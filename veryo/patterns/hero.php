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

echo veryo_sec_hero( __( 'AI bouwen en inrichten.', 'veryo' ), __( 'AI-agents, automatiseringen en de AI-werkplek met Claude Team voor technische bedrijven in Noord-Nederland.', 'veryo' ), array( array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ), array( __( 'Bekijk de diensten', 'veryo' ), veryo_link( 'diensten' ), 'link' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup uit eigen helpers.
