<?php
/**
 * Title: FAQ
 * Slug: veryo/faq
 * Categories: veryo
 * Description: Veelgestelde vragen; levert automatisch FAQPage-schema op.
 * Viewport Width: 1280
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

echo veryo_sec_faq( array( array( __( 'Vraag 1?', 'veryo' ), __( 'Antwoord in 2–4 zinnen.', 'veryo' ) ), array( __( 'Vraag 2?', 'veryo' ), __( 'Antwoord in 2–4 zinnen.', 'veryo' ) ), array( __( 'Vraag 3?', 'veryo' ), __( 'Antwoord in 2–4 zinnen.', 'veryo' ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup uit eigen helpers.
