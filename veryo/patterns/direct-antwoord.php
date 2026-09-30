<?php
/**
 * Title: Direct antwoord
 * Slug: veryo/direct-antwoord
 * Categories: veryo
 * Description: Kort antwoordblok bovenaan een pagina (wordt geciteerd door AI-zoekmachines).
 * Viewport Width: 1280
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

echo veryo_sec_answer( __( 'Wat Veryo hier doet, voor wie, en wat het kost (vanaf-prijs), in 2–3 zinnen.', 'veryo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup uit eigen helpers.
