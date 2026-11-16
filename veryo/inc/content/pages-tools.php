<?php
/**
 * Pagina "Tools & koppelingen": met welke AI-modellen, agents, automatiseringstools en
 * software Veryo werkt. Het overzicht zelf komt uit inc/tools-registry.php.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_tc = veryo_company();

$veryo_tools_page  = veryo_sec_hero(
	__( 'Waar werken jullie mee? Grote kans dat wij het kunnen koppelen.', 'veryo' ),
	__( 'Wij werken met de nieuwste AI-modellen, agents en automatiseringstools, en sluiten aan op de software die jullie al gebruiken. Niet gebonden aan één leverancier, en waar nodig volledig lokaal.', 'veryo' ),
	array(),
	'',
	'veryo-hero--tools'
);
$veryo_tools_page .= veryo_b_group(
	veryo_b_shortcode( '[veryo_tools_overzicht]' ),
	array(
		'align'     => 'wide',
		'className' => 'veryo-section veryo-tools-sec',
		'layout'    => false,
	)
);
$veryo_tools_page .= veryo_b_group(
	veryo_b_p( __( 'Lokale AI', 'veryo' ), array( 'className' => 'veryo-kicker' ) )
	. veryo_b_h( __( 'AI op jullie eigen hardware: er gaat geen data naar buiten', 'veryo' ) )
	. veryo_b_p( __( 'Lokale AI betekent dat het AI-model op een eigen machine binnen jullie bedrijf draait, in plaats van in de cloud van een externe partij. Documenten, klantgegevens en vragen van collega’s verlaten het pand niet voor AI-verwerking.', 'veryo' ) )
	. veryo_b_list(
		array(
			__( 'Geschikt voor vertrouwelijke kennis: prijzen, dossiers, contracten en werkinstructies.', 'veryo' ),
			__( 'Werkt met open modellen zoals Llama, Qwen, Mistral, Gemma en Hermes.', 'veryo' ),
			__( 'Rechten per medewerker, zodat iedereen alleen ziet wat hij ook zonder AI mag inzien.', 'veryo' ),
		),
		array( 'className' => 'is-style-checks' )
	)
	. veryo_b_buttons( array( array( __( 'Bekijk Veryo Collega', 'veryo' ), veryo_collega_url() ) ) ),
	array(
		'tagName'   => 'section',
		'className' => 'veryo-section veryo-tools-local',
	)
);
$veryo_tools_page .= veryo_sec_links(
	array(
		array( veryo_collega()['slug'], __( 'Veryo Collega', 'veryo' ), __( 'Lokale AI-assistent en kennisbank', 'veryo' ) ),
		array( 'ai-werkplek', __( 'ChatGPT, Copilot en Gemini voor teams', 'veryo' ), __( 'Het juiste abonnement, veilig ingesteld', 'veryo' ) ),
		array( 'ai-agents', __( 'AI-agents', 'veryo' ), __( 'Taken die zelfstandig worden opgepakt', 'veryo' ) ),
		array( 'ai-automatisering', __( 'Automatisering', 'veryo' ), __( 'Koppelingen tussen jullie software', 'veryo' ) ),
		array( 'ai-training', __( 'AI-trainingen', 'veryo' ), __( 'Jullie team leert veilig werken met AI', 'veryo' ) ),
		array( 'branches', __( 'AI per branche', 'veryo' ), __( 'Voorbeelden uit jullie sector', 'veryo' ) ),
	),
	__( 'Waar we deze tools voor inzetten', 'veryo' )
);
$veryo_tools_page .= veryo_sec_cta_scan(
	__( 'Benieuwd wat AI voor jullie kan doen?', 'veryo' ),
	sprintf(
		/* translators: 1: e-mailadres, 2: telefoonnummer. */
		__( 'Doe de gratis AI-scan, of neem direct contact op via %1$s of %2$s.', 'veryo' ),
		'<a href="mailto:' . esc_attr( $veryo_tc['email'] ? $veryo_tc['email'] : 'info@veryo.nl' ) . '">' . esc_html( $veryo_tc['email'] ? $veryo_tc['email'] : 'info@veryo.nl' ) . '</a>',
		'<a href="' . esc_attr( veryo_tel_href( $veryo_tc['phone'] ? $veryo_tc['phone'] : '085-0605752' ) ) . '">' . str_replace( ' ', '&nbsp;', esc_html( $veryo_tc['phone'] ? $veryo_tc['phone'] : '085-0605752' ) ) . '</a>'
	)
);

return array(
	'tools-koppelingen' => array(
		'title'     => __( 'Tools & koppelingen', 'veryo' ),
		'seo_title' => __( 'Tools & koppelingen | Met welke AI werkt Veryo?', 'veryo' ),
		'desc'      => __( 'Met welke AI werkt Veryo? Claude, ChatGPT, lokale modellen, agents, Make en koppelingen met SnelStart of Exact. Zoek jullie software in het overzicht.', 'veryo' ),
		'kw'        => 'ai tools en koppelingen',
		'meta'      => array( 'hide_title' => 1 ),
		'content'   => $veryo_tools_page,
	),
);
