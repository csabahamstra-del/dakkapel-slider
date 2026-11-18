<?php
/**
 * Toolregistry: alle AI-modellen, tools en koppelingen waarmee Veryo werkt. De logostroken op
 * de homepage, de "Werkt met"-blokken op dienst- en branchepagina's en de pagina
 * /tools-koppelingen/ lezen allemaal uit deze ene lijst.
 *
 * Tool toevoegen: zet een regel in veryo_tools() en (optioneel) een SVG in assets/logos/
 * met dezelfde naam als de slug. Zonder logo toont het thema een nette tekstbadge.
 * Tool verwijderen: haal de regel weg; overal waar hij stond, valt hij vanzelf weg.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Categorieën, in de volgorde van de toolspagina. 'filter' koppelt een categorie aan een
 * filterknop.
 *
 * @return array<string,array{naam:string,filter:string}>
 */
function veryo_tool_categories() {
	return array(
		'ai-modellen'    => array(
			'naam'   => __( 'AI-modellen (cloud)', 'veryo' ),
			'filter' => 'ai-modellen',
		),
		'open-modellen'  => array(
			'naam'   => __( 'Open en lokale modellen', 'veryo' ),
			'filter' => 'lokaal',
		),
		'lokale-ai'      => array(
			'naam'   => __( 'Lokale AI-omgevingen', 'veryo' ),
			'filter' => 'lokaal',
		),
		'agents'         => array(
			'naam'   => __( 'AI-agents en bouwtools', 'veryo' ),
			'filter' => 'agents',
		),
		'automatisering' => array(
			'naam'   => __( 'Automatisering', 'veryo' ),
			'filter' => 'automatisering',
		),
		'spraak-beeld'   => array(
			'naam'   => __( 'Spraak, beeld en video', 'veryo' ),
			'filter' => 'spraak-beeld',
		),
		'kantoor'        => array(
			'naam'   => __( 'Koppelingen: kantoor', 'veryo' ),
			'filter' => 'koppelingen',
		),
		'boekhouding'    => array(
			'naam'   => __( 'Koppelingen: boekhouding en ERP', 'veryo' ),
			'filter' => 'koppelingen',
		),
		'crm'            => array(
			'naam'   => __( 'Koppelingen: CRM en sales', 'veryo' ),
			'filter' => 'koppelingen',
		),
		'projecten'      => array(
			'naam'   => __( 'Koppelingen: projecten en kennis', 'veryo' ),
			'filter' => 'koppelingen',
		),
		'marketing'      => array(
			'naam'   => __( 'Koppelingen: marketing en web', 'veryo' ),
			'filter' => 'koppelingen',
		),
		'communicatie'   => array(
			'naam'   => __( 'Koppelingen: communicatie en betalen', 'veryo' ),
			'filter' => 'koppelingen',
		),
	);
}

/**
 * Filterknoppen op de toolspagina.
 *
 * @return array<string,string>
 */
function veryo_tool_filters() {
	return array(
		'alles'          => __( 'Alles', 'veryo' ),
		'ai-modellen'    => __( 'AI-modellen', 'veryo' ),
		'lokaal'         => __( 'Lokale AI', 'veryo' ),
		'agents'         => __( 'Agents & bouwen', 'veryo' ),
		'automatisering' => __( 'Automatisering', 'veryo' ),
		'spraak-beeld'   => __( 'Spraak & beeld', 'veryo' ),
		'koppelingen'    => __( 'Koppelingen', 'veryo' ),
	);
}

/**
 * Alle tools (slug => gegevens). Het logo is assets/logos/{slug}.svg als dat bestand bestaat.
 *
 * @return array<string,array{naam:string,categorie:string,omschrijving:string,url:string}>
 */
function veryo_tools() {
	$t     = static function ( $naam, $categorie, $omschrijving, $url = '' ) {
		return array(
			'naam'         => $naam,
			'categorie'    => $categorie,
			'omschrijving' => $omschrijving,
			'url'          => $url,
		);
	};
	$tools = array(
		// AI-modellen (cloud).
		'claude'            => $t( 'Claude', 'ai-modellen', __( 'Ons hoofdmodel voor lange documenten, offertes en analyses, in jullie eigen tone of voice.', 'veryo' ), 'https://www.anthropic.com/claude' ),
		'chatgpt'           => $t( 'ChatGPT', 'ai-modellen', __( 'Het bekendste AI-model van OpenAI: we richten het zakelijk en veilig in voor jullie team.', 'veryo' ), 'https://openai.com/chatgpt' ),
		'gemini'            => $t( 'Gemini', 'ai-modellen', __( 'Het AI-model van Google, handig als jullie al in Google Workspace werken.', 'veryo' ), 'https://gemini.google.com' ),
		'grok'              => $t( 'Grok', 'ai-modellen', __( 'Het model van xAI, dat we inzetten waar het voor een taak de beste keuze is.', 'veryo' ), 'https://x.ai' ),
		'copilot'           => $t( 'Microsoft Copilot', 'ai-modellen', __( 'AI in Word, Outlook, Excel en Teams: we stellen de rechten goed in en leren jullie team ermee werken.', 'veryo' ), 'https://copilot.microsoft.com' ),
		'mistral'           => $t( 'Mistral', 'ai-modellen', __( 'Europees AI-model, een goede keuze als jullie gegevens binnen Europa moeten blijven.', 'veryo' ), 'https://mistral.ai' ),
		'deepseek'          => $t( 'DeepSeek', 'ai-modellen', __( 'Sterk in redeneren en rekenen, en voordelig voor grote hoeveelheden werk.', 'veryo' ), 'https://www.deepseek.com' ),
		'kimi'              => $t( 'Kimi', 'ai-modellen', __( 'Model van Moonshot AI dat goed overweg kan met lange documenten.', 'veryo' ), 'https://www.kimi.com' ),
		'glm'               => $t( 'GLM', 'ai-modellen', __( 'Model van Z.ai dat sterk is in agents en programmeerwerk, ook als open variant.', 'veryo' ), 'https://z.ai' ),
		'perplexity'        => $t( 'Perplexity', 'ai-modellen', __( 'AI-zoekmachine met bronvermelding, handig voor snel en controleerbaar onderzoek.', 'veryo' ), 'https://www.perplexity.ai' ),

		// Open en lokale modellen.
		'llama'             => $t( 'Llama', 'open-modellen', __( 'Open model van Meta dat volledig op jullie eigen hardware kan draaien.', 'veryo' ), 'https://www.llama.com' ),
		'qwen'              => $t( 'Qwen', 'open-modellen', __( 'Open model van Alibaba, sterk in meerdere talen en geschikt voor lokaal gebruik.', 'veryo' ), 'https://qwenlm.github.io' ),
		'mixtral'           => $t( 'Mistral / Mixtral', 'open-modellen', __( 'De open modellen van Mistral: Europees, snel en goed lokaal te draaien.', 'veryo' ), 'https://mistral.ai' ),
		'gemma'             => $t( 'Gemma', 'open-modellen', __( 'Compact open model van Google, licht genoeg voor een gewone werkplek of server.', 'veryo' ), 'https://ai.google.dev/gemma' ),
		'hermes'            => $t( 'Hermes', 'open-modellen', __( 'Open model van Nous Research dat instructies nauwkeurig volgt, ook op eigen hardware.', 'veryo' ), 'https://nousresearch.com' ),
		'deepseek-open'     => $t( 'DeepSeek (open)', 'open-modellen', __( 'De open variant van DeepSeek, zodat sterk redeneren ook lokaal kan.', 'veryo' ), 'https://www.deepseek.com' ),
		'phi'               => $t( 'Phi', 'open-modellen', __( 'Klein open model van Microsoft dat snel draait op bescheiden hardware.', 'veryo' ), 'https://azure.microsoft.com/products/phi' ),
		'whisper'           => $t( 'Whisper', 'open-modellen', __( 'Zet gesproken tekst om in geschreven tekst, ook lokaal, bijvoorbeeld voor gespreksverslagen.', 'veryo' ), 'https://github.com/openai/whisper' ),

		// Lokale AI-omgevingen.
		'ollama'            => $t( 'Ollama', 'lokale-ai', __( 'Hiermee draait AI volledig op jullie eigen hardware. Er gaat geen data naar buiten.', 'veryo' ), 'https://ollama.com' ),
		'lmstudio'          => $t( 'LM Studio', 'lokale-ai', __( 'Overzichtelijke omgeving om lokale modellen te testen en te gebruiken op een eigen computer.', 'veryo' ), 'https://lmstudio.ai' ),
		'vllm'              => $t( 'vLLM', 'lokale-ai', __( 'Laat lokale modellen snel draaien voor meerdere collega’s tegelijk.', 'veryo' ), 'https://docs.vllm.ai' ),
		'openwebui'         => $t( 'Open WebUI', 'lokale-ai', __( 'Een vertrouwde chatomgeving voor jullie lokale AI, met rechten per medewerker.', 'veryo' ), 'https://openwebui.com' ),

		// AI-agents en bouwtools.
		'claude-code'       => $t( 'Claude Code', 'agents', __( 'Hiermee bouwen en onderhouden we automatiseringen en agents snel en zorgvuldig.', 'veryo' ), 'https://www.anthropic.com/claude-code' ),
		'codex'             => $t( 'Codex', 'agents', __( 'De bouwagent van OpenAI, die we inzetten naast Claude Code als dat beter past.', 'veryo' ), 'https://openai.com/codex' ),
		'hermes-agent'      => $t( 'Hermes Agent', 'agents', __( 'Open-source agent die op jullie eigen server kan draaien en niet vastzit aan één AI-leverancier.', 'veryo' ), 'https://nousresearch.com' ),
		'openclaw'          => $t( 'OpenClaw', 'agents', __( 'Open-source agent die taken oppakt via kanalen als WhatsApp, Slack en mail.', 'veryo' ), 'https://openclaw.ai' ),
		'cursor'            => $t( 'Cursor', 'agents', __( 'Programmeeromgeving met AI, waarmee we koppelingen sneller en netjes opleveren.', 'veryo' ), 'https://cursor.com' ),
		'mcp'               => $t( 'MCP (Model Context Protocol)', 'agents', __( 'Open standaard waarmee AI veilig bij jullie systemen kan, met precies de rechten die jullie geven.', 'veryo' ), 'https://modelcontextprotocol.io' ),
		'openrouter'        => $t( 'OpenRouter', 'agents', __( 'Eén toegang tot veel AI-modellen, zodat we per taak het beste model kiezen.', 'veryo' ), 'https://openrouter.ai' ),

		// Automatisering.
		'make'              => $t( 'Make.com', 'automatisering', __( 'Visuele automatiseringen tussen jullie software, zodat niemand meer gegevens overtikt.', 'veryo' ), 'https://www.make.com' ),
		'n8n'               => $t( 'n8n', 'automatisering', __( 'Automatiseringen die ook op jullie eigen server kunnen draaien, met AI erin.', 'veryo' ), 'https://n8n.io' ),
		'zapier'            => $t( 'Zapier', 'automatisering', __( 'Snelle koppelingen tussen duizenden apps, ideaal voor eenvoudige stappen.', 'veryo' ), 'https://zapier.com' ),
		'power-automate'    => $t( 'Microsoft Power Automate', 'automatisering', __( 'Automatiseren binnen Microsoft 365, als jullie daar al alles in doen.', 'veryo' ), 'https://www.microsoft.com/power-platform/products/power-automate' ),

		// Spraak, beeld en video.
		'elevenlabs'        => $t( 'ElevenLabs', 'spraak-beeld', __( 'Natuurlijke Nederlandse stemmen voor een AI-receptie of telefoonassistent.', 'veryo' ), 'https://elevenlabs.io' ),
		'higgsfield'        => $t( 'Higgsfield', 'spraak-beeld', __( 'AI-video voor social media en advertenties, snel en zonder filmploeg.', 'veryo' ), 'https://higgsfield.ai' ),
		'midjourney'        => $t( 'Midjourney', 'spraak-beeld', __( 'Beelden en illustraties voor jullie website, presentaties en social media.', 'veryo' ), 'https://www.midjourney.com' ),
		'runway'            => $t( 'Runway', 'spraak-beeld', __( 'Video bewerken en maken met AI, voor korte uitlegvideo’s en content.', 'veryo' ), 'https://runwayml.com' ),
		'kling'             => $t( 'Kling', 'spraak-beeld', __( 'Realistische AI-video vanuit tekst of een foto.', 'veryo' ), 'https://klingai.com' ),
		'veo'               => $t( 'Google Veo', 'spraak-beeld', __( 'Het videomodel van Google, voor korte video’s van hoge kwaliteit.', 'veryo' ), 'https://deepmind.google/models/veo/' ),

		// Koppelingen: kantoor.
		'microsoft-365'     => $t( 'Microsoft 365', 'kantoor', __( 'We sluiten AI aan op jullie Word-, Excel- en SharePoint-bestanden, met de rechten die al gelden.', 'veryo' ), 'https://www.microsoft.com/microsoft-365' ),
		'outlook'           => $t( 'Outlook', 'kantoor', __( 'Mail automatisch sorteren, samenvatten en beantwoorden in de mailbox die jullie al gebruiken.', 'veryo' ), 'https://outlook.com' ),
		'teams'             => $t( 'Microsoft Teams', 'kantoor', __( 'AI-assistenten en meldingen direct in de chat waar jullie team al werkt.', 'veryo' ), 'https://www.microsoft.com/microsoft-teams' ),
		'google-workspace'  => $t( 'Google Workspace', 'kantoor', __( 'AI gekoppeld aan jullie Drive, Docs en Sheets, zonder over te stappen.', 'veryo' ), 'https://workspace.google.com' ),
		'gmail'             => $t( 'Gmail', 'kantoor', __( 'Mail automatisch sorteren, samenvatten en opvolgen in Gmail.', 'veryo' ), 'https://mail.google.com' ),
		'google-agenda'     => $t( 'Google Agenda', 'kantoor', __( 'Afspraken die AI inplant, komen direct in jullie eigen agenda.', 'veryo' ), 'https://calendar.google.com' ),

		// Koppelingen: boekhouding en ERP.
		'snelstart'         => $t( 'SnelStart', 'boekhouding', __( 'We koppelen AI aan jullie boekhouding, zodat facturen en administratie automatisch verwerkt worden.', 'veryo' ), 'https://www.snelstart.nl' ),
		'exact-online'      => $t( 'Exact Online', 'boekhouding', __( 'Facturen, uren en projecten automatisch in Exact, zonder dubbel invoeren.', 'veryo' ), 'https://www.exact.com/nl' ),
		'moneybird'         => $t( 'Moneybird', 'boekhouding', __( 'Inkoopfacturen en bonnetjes automatisch in Moneybird, klaar om te controleren.', 'veryo' ), 'https://www.moneybird.nl' ),
		'e-boekhouden'      => $t( 'e-Boekhouden', 'boekhouding', __( 'Boekingen en facturen automatisch klaarzetten in e-Boekhouden.', 'veryo' ), 'https://www.e-boekhouden.nl' ),
		'afas'              => $t( 'AFAS', 'boekhouding', __( 'AI en automatiseringen bovenop AFAS, voor administratie en HR.', 'veryo' ), 'https://www.afas.nl' ),

		// Koppelingen: CRM en sales.
		'hubspot'           => $t( 'HubSpot', 'crm', __( 'Leads automatisch opvolgen en gesprekken vastleggen in jullie CRM.', 'veryo' ), 'https://www.hubspot.com' ),
		'pipedrive'         => $t( 'Pipedrive', 'crm', __( 'Deals bijwerken en opvolgmails voorbereiden zonder extra klikwerk.', 'veryo' ), 'https://www.pipedrive.com' ),

		// Koppelingen: projecten en kennis.
		'notion'            => $t( 'Notion', 'projecten', __( 'Jullie kennis en werkinstructies in Notion, doorzoekbaar met AI.', 'veryo' ), 'https://www.notion.com' ),
		'clickup'           => $t( 'ClickUp', 'projecten', __( 'Taken automatisch aanmaken en bijwerken vanuit mail, formulieren en gesprekken.', 'veryo' ), 'https://clickup.com' ),
		'slack'             => $t( 'Slack', 'projecten', __( 'AI-assistenten en meldingen direct in jullie Slack-kanalen.', 'veryo' ), 'https://slack.com' ),

		// Koppelingen: marketing en web.
		'mailerlite'        => $t( 'MailerLite', 'marketing', __( 'Nieuwsbrieven en opvolgmails die automatisch op het juiste moment uitgaan.', 'veryo' ), 'https://www.mailerlite.com' ),
		'wordpress'         => $t( 'WordPress', 'marketing', __( 'AI-chat, formulieren en content gekoppeld aan jullie eigen website.', 'veryo' ), 'https://wordpress.org' ),
		'shopify'           => $t( 'Shopify', 'marketing', __( 'Klantvragen, bestellingen en productteksten automatiseren in jullie webshop.', 'veryo' ), 'https://www.shopify.com' ),
		'meta-ads'          => $t( 'Meta Ads', 'marketing', __( 'Leads uit Facebook en Instagram binnen minuten automatisch opgevolgd.', 'veryo' ), 'https://www.facebook.com/business/ads' ),
		'google-ads'        => $t( 'Google Ads', 'marketing', __( 'Aanvragen uit Google Ads direct opgevolgd en netjes gemeten.', 'veryo' ), 'https://ads.google.com' ),

		// Koppelingen: communicatie en betalen.
		'whatsapp-business' => $t( 'WhatsApp Business', 'communicatie', __( 'Klanten en sollicitanten snel antwoord geven via het kanaal dat ze al gebruiken.', 'veryo' ), 'https://business.whatsapp.com' ),
		'calendly'          => $t( 'Calendly', 'communicatie', __( 'Afspraken laten inplannen zonder heen-en-weer mailen.', 'veryo' ), 'https://calendly.com' ),
		'mollie'            => $t( 'Mollie', 'communicatie', __( 'Betaalverzoeken en aanbetalingen automatisch versturen en verwerken.', 'veryo' ), 'https://www.mollie.com' ),
		'stripe'            => $t( 'Stripe', 'communicatie', __( 'Online betalingen en abonnementen automatisch koppelen aan jullie administratie.', 'veryo' ), 'https://stripe.com' ),
	);
	return apply_filters( 'veryo_tools', $tools );
}

/**
 * URL van het logo van een tool, of een lege string als er geen logo is (dan tekstbadge).
 *
 * @param string $slug Slug.
 * @return string
 */
function veryo_tool_logo( $slug ) {
	$file = '/assets/logos/' . sanitize_file_name( $slug ) . '.svg';
	return file_exists( VERYO_DIR . $file ) ? VERYO_URI . $file : '';
}

/**
 * Eén tool als logo (of tekstbadge) met tooltip. Linkt naar de tool op de toolspagina.
 *
 * @param string $slug Slug.
 * @param bool   $link Als link naar de toolspagina.
 * @return string
 */
function veryo_tool_item( $slug, $link = true ) {
	$tools = veryo_tools();
	if ( ! isset( $tools[ $slug ] ) ) {
		return '';
	}
	$naam = $tools[ $slug ]['naam'];
	$logo = veryo_tool_logo( $slug );
	if ( $logo ) {
		/* translators: %s: naam van de tool. */
		$inner = '<img class="veryo-tool__logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( sprintf( __( 'Logo %s', 'veryo' ), $naam ) ) . '" width="28" height="28" loading="lazy" decoding="async">'
			. '<span class="veryo-tool__tip" aria-hidden="true">' . esc_html( $naam ) . '</span>';
		$class = 'veryo-tool';
	} else {
		$inner = '<span class="veryo-tool__badge">' . esc_html( $naam ) . '</span>';
		$class = 'veryo-tool veryo-tool--badge';
	}
	if ( $link ) {
		$inner = '<a class="veryo-tool__link" href="' . esc_url( veryo_link( 'tools-koppelingen' ) . '#tool-' . $slug ) . '">' . $inner . '</a>';
	}
	return '<li class="' . esc_attr( $class ) . '">' . $inner . '</li>';
}

/**
 * Lijst met slugs uit een kommagescheiden string.
 *
 * @param string|string[] $slugs Slugs.
 * @return string[]
 */
function veryo_tool_slugs( $slugs ) {
	$list = is_array( $slugs ) ? $slugs : explode( ',', (string) $slugs );
	$list = array_filter( array_map( 'sanitize_key', array_map( 'trim', $list ) ) );
	return array_values( array_intersect( $list, array_keys( veryo_tools() ) ) );
}

/**
 * "Werkt met:"-blok: label en een rij logo's.
 *
 * @param string|string[] $slugs Slugs.
 * @return string
 */
function veryo_werkt_met( $slugs ) {
	$slugs = veryo_tool_slugs( $slugs );
	if ( ! $slugs ) {
		return '';
	}
	$items = '';
	foreach ( $slugs as $slug ) {
		$items .= veryo_tool_item( $slug );
	}
	return '<div class="veryo-werkt-met">'
		. '<p class="veryo-werkt-met__label" aria-hidden="true">' . esc_html__( 'Werkt met:', 'veryo' ) . '</p>'
		. '<ul class="veryo-werkt-met__list" role="list" aria-label="' . esc_attr__( 'Werkt met', 'veryo' ) . '">' . $items . '</ul>'
		. '<a class="veryo-werkt-met__more" href="' . esc_url( veryo_link( 'tools-koppelingen' ) ) . '">' . esc_html__( 'Alle tools & koppelingen', 'veryo' ) . '</a>'
		. '</div>';
}

/**
 * Shortcode [veryo_werkt_met tools="claude,make,snelstart"].
 *
 * @param array<string,string>|string $atts Attributen.
 * @return string
 */
function veryo_werkt_met_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'tools' => '' ), $atts, 'veryo_werkt_met' );
	return veryo_werkt_met( $atts['tools'] );
}
add_shortcode( 'veryo_werkt_met', 'veryo_werkt_met_shortcode' );

/**
 * Tools in de doorlopende strook op de homepage, in twee rijen.
 *
 * @return array<int,string[]>
 */
function veryo_tools_strip_rows() {
	return apply_filters(
		'veryo_tools_strip_rows',
		array(
			array( 'claude', 'chatgpt', 'gemini', 'grok', 'copilot', 'mistral', 'llama', 'qwen', 'hermes', 'codex', 'claude-code' ),
			array( 'make', 'n8n', 'zapier', 'elevenlabs', 'snelstart', 'exact-online', 'microsoft-365', 'google-workspace', 'whatsapp-business', 'notion' ),
		)
	);
}

/**
 * Shortcode [veryo_tools_strip]: twee doorlopende logorijen. Zonder JavaScript of met
 * minder beweging: gewone rijen die stilstaan.
 *
 * @return string
 */
function veryo_tools_strip_shortcode() {
	$out = '<div class="veryo-logo-strip">';
	foreach ( veryo_tools_strip_rows() as $i => $row ) {
		$items = '';
		foreach ( veryo_tool_slugs( $row ) as $slug ) {
			$items .= veryo_tool_item( $slug );
		}
		$out .= '<div class="veryo-marquee veryo-logo-row' . ( $i % 2 ? ' is-reverse' : '' ) . '">'
			. '<ul class="veryo-marquee__list" role="list" aria-label="' . esc_attr__( 'AI-tools waarmee Veryo werkt', 'veryo' ) . '">' . $items . '</ul></div>';
	}
	return $out . '</div>';
}
add_shortcode( 'veryo_tools_strip', 'veryo_tools_strip_shortcode' );

/**
 * Shortcode [veryo_tools_overzicht]: zoekbalk, filters en alle tools per categorie. De
 * HTML staat volledig in de pagina (leesbaar voor zoekmachines); JavaScript filtert alleen.
 *
 * @return string
 */
function veryo_tools_overview_shortcode() {
	wp_enqueue_script( 'veryo-tools' );
	$cats  = veryo_tool_categories();
	$tools = veryo_tools();

	$out  = '<div class="veryo-tools" data-veryo-tools>';
	$out .= '<div class="veryo-tools__bar">';
	$out .= '<label class="veryo-tools__search"><span class="screen-reader-text">' . esc_html__( 'Zoek een tool', 'veryo' ) . '</span>'
		. '<input type="search" placeholder="' . esc_attr__( 'Werkt Veryo met…?', 'veryo' ) . '" autocomplete="off" data-tools-search></label>';
	$out .= '<div class="veryo-tools__filters" role="group" aria-label="' . esc_attr__( 'Filter op categorie', 'veryo' ) . '">';
	foreach ( veryo_tool_filters() as $key => $label ) {
		$out .= '<button type="button" class="veryo-tools__filter" data-tools-filter="' . esc_attr( $key ) . '" aria-pressed="' . ( 'alles' === $key ? 'true' : 'false' ) . '">' . esc_html( $label ) . '</button>';
	}
	$out .= '</div></div>';
	$out .= '<p class="veryo-tools__count" aria-live="polite" data-tools-count></p>';

	foreach ( $cats as $key => $cat ) {
		$cards = '';
		foreach ( $tools as $slug => $tool ) {
			if ( $tool['categorie'] !== $key ) {
				continue;
			}
			$logo   = veryo_tool_logo( $slug );
			$visual = $logo
				? '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( sprintf( /* translators: %s: naam van de tool. */ __( 'Logo %s', 'veryo' ), $tool['naam'] ) ) . '" width="40" height="40" loading="lazy" decoding="async">'
				: '<span class="veryo-tool-card__badge" aria-hidden="true">' . esc_html( mb_substr( $tool['naam'], 0, 2 ) ) . '</span>';
			$name   = $tool['url']
				? '<a href="' . esc_url( $tool['url'] ) . '" target="_blank" rel="noopener nofollow">' . esc_html( $tool['naam'] ) . '<span class="screen-reader-text"> ' . esc_html__( '(opent in een nieuw tabblad)', 'veryo' ) . '</span></a>'
				: esc_html( $tool['naam'] );
			$cards .= '<li class="veryo-tool-card" id="tool-' . esc_attr( $slug ) . '" data-tool-name="' . esc_attr( mb_strtolower( $tool['naam'] . ' ' . $slug . ' ' . $cat['naam'] ) ) . '">'
				. '<div class="veryo-tool-card__visual">' . $visual . '</div>'
				. '<h3 class="veryo-tool-card__name">' . $name . '</h3>'
				. '<p class="veryo-tool-card__cat">' . esc_html( $cat['naam'] ) . '</p>'
				. '<p class="veryo-tool-card__desc">' . esc_html( $tool['omschrijving'] ) . '</p>'
				. '</li>';
		}
		if ( '' === $cards ) {
			continue;
		}
		$out .= '<section class="veryo-tools__group" data-tools-group="' . esc_attr( $cat['filter'] ) . '" aria-labelledby="tools-' . esc_attr( $key ) . '">'
			. '<h2 id="tools-' . esc_attr( $key ) . '">' . esc_html( $cat['naam'] ) . '</h2>'
			. '<ul class="veryo-tools__grid">' . $cards . '</ul></section>';
	}

	$out .= '<div class="veryo-tools__empty" data-tools-empty hidden><p>' . esc_html__( 'Staat jullie software er niet tussen? Heeft het een API of export, dan koppelen we het meestal gewoon.', 'veryo' ) . '</p>'
		. '<p><a class="btn btn--petrol" href="' . esc_url( veryo_link( 'contact' ) ) . '">' . esc_html__( 'Vraag het ons', 'veryo' ) . '</a></p></div>';
	return $out . '</div>';
}
add_shortcode( 'veryo_tools_overzicht', 'veryo_tools_overview_shortcode' );

/**
 * "Werkt met" per pagina (pad => intro en tools). Het blok komt direct na het eerste blok
 * van de pagina (meestal het korte antwoord).
 *
 * @return array<string,array{0:string,1:string}>
 */
function veryo_page_tools() {
	$training = array( __( 'Praktische trainingen waarin jullie team leert veilig en slim met AI te werken.', 'veryo' ), 'claude,chatgpt,gemini,copilot' );
	return apply_filters(
		'veryo_page_tools',
		array(
			// Diensten.
			'veryo-collega'                             => array( __( 'Een AI-collega die volledig binnen jullie bedrijf draait: kennisbank, assistent en adviseur in één. Er gaat geen data naar buiten.', 'veryo' ), 'llama,qwen,mixtral,gemma,hermes,ollama' ),
			'ai-werkplek'                               => array( __( 'We helpen jullie het juiste AI-abonnement kiezen, stellen het veilig in en leren het team ermee werken.', 'veryo' ), 'chatgpt,copilot,gemini,claude' ),
			'ai-agents'                                 => array( __( 'Agents die zelfstandig taken oppakken, zoals mail sorteren, opvolgen en rapporteren, via de kanalen die jullie al gebruiken.', 'veryo' ), 'hermes-agent,openclaw,claude-code,codex,whatsapp-business,slack,teams' ),
			'ai-automatisering'                         => array( __( 'Koppelingen tussen jullie bestaande software, zodat er niets meer handmatig overgetikt hoeft te worden.', 'veryo' ), 'make,n8n,zapier,power-automate,snelstart,exact-online,outlook' ),
			'ai-op-maat/ai-receptionist-horeca'         => array( __( 'Een AI-receptie die de telefoon opneemt, afspraken inplant en klanten automatisch bevestigingen en herinneringen stuurt. Voor restaurants, en net zo goed voor praktijken zoals fysio en tandarts.', 'veryo' ), 'elevenlabs,whisper,whatsapp-business,google-agenda,outlook' ),
			'ai-training'                               => $training,
			'ai-workshop'                               => $training,
			'ai-training/ai-geletterdheid'              => $training,
			'ai-training/chatgpt-training-verkopers'    => array( __( 'Jullie verkopers leren offertes, opvolgmails en gespreksverslagen sneller maken met AI, veilig en in jullie eigen toon.', 'veryo' ), 'chatgpt,claude,copilot,hubspot,pipedrive' ),
			'ai-training/ai-strategie'                  => $training,
			'ai-training/zzp'                           => $training,
			'ai-startpakket'                            => array( __( 'In het AI-Startpakket kiezen we samen de tools die bij jullie passen en richten we ze veilig in.', 'veryo' ), 'claude,chatgpt,copilot,gemini,make' ),
			'ai-partner'                                => array( __( 'Als vaste AI-partner houden we de tools en modellen voor jullie bij, en kiezen we per klus wat het beste past.', 'veryo' ), 'claude,chatgpt,gemini,make,n8n,ollama' ),
			'veilig-ai-gebruik'                         => array( __( 'We stellen de AI-tools die jullie gebruiken veilig in, en waar het moet draait AI volledig lokaal.', 'veryo' ), 'copilot,chatgpt,claude,gemini,ollama' ),
			'ai-implementatie-mkb'                      => array( __( 'Bij het invoeren van AI kiezen we per stap de tool die past bij jullie software en jullie gegevens.', 'veryo' ), 'claude,copilot,make,n8n,ollama,microsoft-365' ),
			'ai-op-maat'                                => array( __( 'Maatwerk met AI bovenop de tools die jullie al gebruiken, in de cloud of volledig lokaal.', 'veryo' ), 'claude,chatgpt,make,n8n,whatsapp-business,ollama' ),
			'ai-op-maat/chatbot'                        => array( __( 'Een AI-chatbot op jullie website die antwoordt vanuit jullie eigen informatie en aanvragen netjes doorzet.', 'veryo' ), 'claude,chatgpt,wordpress,shopify,hubspot' ),
			'ai-op-maat/whatsapp-assistent'             => array( __( 'Een WhatsApp-assistent die vragen beantwoordt, afspraken inplant en lastige gesprekken doorzet naar jullie team.', 'veryo' ), 'whatsapp-business,claude,make,calendly,google-agenda' ),
			'ai-automatisering/klantcontact'            => array( __( 'Klantvragen via mail, WhatsApp en telefoon sneller beantwoord, in de systemen die jullie al gebruiken.', 'veryo' ), 'whatsapp-business,elevenlabs,claude,outlook,gmail,make' ),
			'ai-automatisering/offertes-en-calculaties' => array( __( 'Offertes en calculaties sneller de deur uit, bovenop jullie eigen software en prijslijsten.', 'veryo' ), 'claude,make,snelstart,exact-online,microsoft-365' ),
			'ai-automatisering/administratie'           => array( __( 'Facturen, bonnetjes en boekingen automatisch verwerkt in jullie eigen boekhoudpakket.', 'veryo' ), 'snelstart,exact-online,moneybird,e-boekhouden,afas,make' ),
			'ai-automatisering/werkprocessen'           => array( __( 'Terugkerende stappen tussen mail, planning en projecten automatisch afgehandeld.', 'veryo' ), 'make,n8n,power-automate,teams,notion,clickup' ),
			'ai-automatisering/marketing'               => array( __( 'Leads, nieuwsbrieven en content automatisch opgevolgd en klaargezet.', 'veryo' ), 'mailerlite,meta-ads,google-ads,wordpress,claude' ),
			'ai-automatisering/hr-en-werving'           => array( __( 'Sollicitanten snel opgevolgd en gesprekken ingepland, terwijl een mens beslist.', 'veryo' ), 'claude,whatsapp-business,calendly,outlook,make' ),
			'ai-automatisering/rapportages'             => array( __( 'Rapportages en overzichten automatisch opgesteld uit de cijfers die jullie al hebben.', 'veryo' ), 'claude,make,microsoft-365,google-workspace,exact-online' ),
			'oplossingen/urencontrole-beveiliging'      => array( __( 'Uren en zzp-facturen automatisch naast het rooster gelegd, met de uitkomst in jullie eigen administratie.', 'veryo' ), 'claude,make,microsoft-365,snelstart,exact-online' ),
			'oplossingen/ai-lead-opvolging'             => array( __( 'Nieuwe aanvragen binnen minuten opgevolgd via WhatsApp of telefoon, en de afspraak direct in de agenda.', 'veryo' ), 'whatsapp-business,elevenlabs,claude,google-agenda,meta-ads,google-ads' ),
			'oplossingen/ai-klantrapportage'            => array( __( 'Dienst- en incidentrapporten automatisch omgezet in een nette maandrapportage per opdrachtgever.', 'veryo' ), 'claude,make,microsoft-365,google-workspace' ),
			'oplossingen/ai-calculatie-offerte-factuur' => array( __( 'Bestek lezen, calculeren en offreren bovenop jullie eigen pakket, tot en met de factuur.', 'veryo' ), 'claude,make,snelstart,exact-online,moneybird' ),
			'oplossingen/werkbonnen-verwerken'          => array( __( 'Een foto van de werkbon wordt automatisch een conceptfactuur in jullie eigen boekhouding.', 'veryo' ), 'claude,whatsapp-business,make,snelstart,exact-online' ),
			'oplossingen/inkoopfacturen-automatiseren'  => array( __( 'Inkoopfacturen uit de mail automatisch gecontroleerd en klaargezet in jullie boekhouding.', 'veryo' ), 'claude,outlook,gmail,make,snelstart,moneybird' ),
			'oplossingen/ai-recruitment-assistent'      => array( __( 'Kandidaten snel opgevolgd en gesprekken ingepland, terwijl jullie zelf beslissen.', 'veryo' ), 'claude,whatsapp-business,calendly,outlook,make' ),

			// Branches.
			'branches/installatie'                      => array( __( 'Offertes opstellen vanuit de inmeting, werkbonnen automatisch omzetten naar facturen en leads binnen 2 minuten opvolgen.', 'veryo' ), 'claude,make,snelstart,exact-online,outlook,whatsapp-business' ),
			'branches/beveiliging'                      => array( __( 'Uren controleren tegen het rooster, zzp-facturen nakijken en maandelijkse klantrapportages automatisch laten maken.', 'veryo' ), 'claude,make,microsoft-365,snelstart,exact-online' ),
			'branches/bouw'                             => array( __( 'Voor aannemers en vakbedrijven zoals dakkapel-, kozijn- en vloerenbedrijven: leads opvolgen via WhatsApp, inmetingen inplannen en offertes sneller de deur uit.', 'veryo' ), 'claude,make,whatsapp-business,google-agenda,snelstart' ),
			'branches/agri'                             => array( __( 'Onderhoud plannen, onderdelen bestellen en kennis vastleggen, gekoppeld aan jullie administratie.', 'veryo' ), 'claude,make,whatsapp-business,exact-online,ollama' ),
			'branches/makelaardij'                      => array( __( 'Vragen via WhatsApp, telefoon en formulieren op één plek, en bezichtigingen automatisch ingepland.', 'veryo' ), 'claude,whatsapp-business,elevenlabs,google-agenda,outlook' ),
			'branches/zakelijke-dienstverlening'        => array( __( 'Gespreksverslagen, documenten samenvatten en een kennisbank op jullie eigen dossiers.', 'veryo' ), 'claude,whisper,microsoft-365,exact-online,afas,ollama' ),
			'branches/horeca-retail'                    => array( __( 'Een AI-telefoonassistent voor reserveringen en een team dat slim met AI werkt.', 'veryo' ), 'elevenlabs,claude,whatsapp-business,google-agenda,shopify' ),
			'branches/transport'                        => array( __( 'Planning, statusberichten voor klanten en vrachtdocumenten automatisch verwerkt.', 'veryo' ), 'claude,make,whatsapp-business,outlook,exact-online' ),
			'branches/recruitment'                      => array( __( 'Solliciteren via WhatsApp, vacatureteksten en automatische opvolging van kandidaten.', 'veryo' ), 'whatsapp-business,claude,calendly,make,hubspot' ),
			'branches/schoonmaak'                       => array( __( 'Uren en roosters controleren, inkoopfacturen automatisch verwerken en sneller werven.', 'veryo' ), 'claude,make,snelstart,exact-online,whatsapp-business' ),
		)
	);
}

/**
 * Homepage-band: kop, subtekst, de twee logorijen en een link naar de toolspagina.
 *
 * @return string
 */
function veryo_sec_tools_band() {
	return veryo_b_group(
		veryo_b_h( __( 'Wij werken met de beste AI-tools, onafhankelijk', 'veryo' ) )
		. veryo_b_p( __( 'We zijn niet gebonden aan één leverancier. Per klus kiezen we de tool die het beste past, en waarbij jullie data veilig blijft.', 'veryo' ), array( 'className' => 'veryo-tools-band__sub' ) )
		. veryo_b_shortcode( '[veryo_tools_strip]' )
		. veryo_b_p( '<a href="' . esc_url( veryo_link( 'tools-koppelingen' ) ) . '">' . esc_html__( 'Bekijk alle tools & koppelingen →', 'veryo' ) . '</a>', array( 'className' => 'veryo-tools-band__more' ) ),
		array(
			'tagName'   => 'section',
			'align'     => 'full',
			'className' => 'veryo-tools-band',
		)
	);
}

/**
 * Het "Werkt met"-blok voor een pagina als block markup.
 *
 * @param string $intro Korte omschrijving.
 * @param string $slugs Tools.
 * @return string
 */
function veryo_sec_werkt_met( $intro, $slugs ) {
	return veryo_b_group(
		veryo_b_p( $intro, array( 'className' => 'veryo-werkt-met__intro' ) )
		. veryo_b_shortcode( '[veryo_werkt_met tools="' . implode( ',', veryo_tool_slugs( $slugs ) ) . '"]' ),
		array( 'className' => 'veryo-section veryo-werkt-met-sec' )
	);
}

/**
 * "Werkt met" in de pagina-inhoud zetten, direct na het eerste blok op het hoogste niveau.
 *
 * @param string $content Block markup.
 * @param string $intro   Omschrijving.
 * @param string $slugs   Tools.
 * @return string
 */
function veryo_insert_werkt_met( $content, $intro, $slugs ) {
	if ( false !== strpos( $content, '[veryo_werkt_met' ) ) {
		return $content;
	}
	return veryo_insert_after_first_block( $content, veryo_sec_werkt_met( $intro, $slugs ) );
}

/**
 * Positie direct na het eerste blok op het hoogste niveau, of -1 als er geen blok is.
 *
 * @param string $content Block markup.
 * @return int
 */
function veryo_first_block_end( $content ) {
	$depth = 0;
	if ( preg_match_all( '#<!--\s+(/)?wp:[a-z0-9/-]+(?:\s+\{.*?\})?\s*(/)?-->#s', $content, $m, PREG_SET_ORDER | PREG_OFFSET_CAPTURE ) ) {
		foreach ( $m as $tag ) {
			$closing = ! empty( $tag[1][0] );
			$self    = ! empty( $tag[2][0] );
			if ( $self && 0 !== $depth ) {
				continue;
			}
			if ( ! $self ) {
				$depth += $closing ? -1 : 1;
			}
			if ( $self || ( $closing && 0 === $depth ) ) {
				return $tag[0][1] + strlen( $tag[0][0] );
			}
		}
	}
	return -1;
}

/**
 * Block markup invoegen direct na het eerste blok op het hoogste niveau.
 *
 * @param string $content Block markup.
 * @param string $block   In te voegen block markup.
 * @return string
 */
function veryo_insert_after_first_block( $content, $block ) {
	$pos = veryo_first_block_end( $content );
	return $pos < 0 ? $block . $content : substr( $content, 0, $pos ) . "\n" . $block . substr( $content, $pos );
}

/**
 * Logostrook en "Werkt met"-blok bij het tonen van de pagina toevoegen als ze nog niet in de
 * opgeslagen inhoud staan. Zo verschijnen ze ook op pagina's die zelf zijn aangepast, zonder
 * dat de opgeslagen tekst verandert. Staat de shortcode al in de pagina, dan gebeurt er niets.
 * Uitzetten kan met add_filter( 'veryo_auto_tools', '__return_false' ).
 *
 * @param string $content Inhoud (block markup, vóór do_blocks).
 * @return string
 */
function veryo_auto_tools_content( $content ) {
	if ( is_admin() || ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() || ! apply_filters( 'veryo_auto_tools', true ) ) {
		return $content;
	}
	if ( is_front_page() ) {
		if ( false !== strpos( $content, '[veryo_tools_strip' ) ) {
			return $content;
		}
		// De oude tekstband (Offertes, Facturen…) maakt plaats voor de logostrook.
		if ( preg_match( '#<!--\s+wp:group\s+\{[^}]*"className":"veryo-marquee"[^}]*\}\s+-->#', $content, $m, PREG_OFFSET_CAPTURE ) ) {
			$start = $m[0][1];
			$end   = veryo_first_block_end( substr( $content, $start ) );
			if ( $end > 0 ) {
				return substr( $content, 0, $start ) . veryo_sec_tools_band() . substr( $content, $start + $end );
			}
		}
		return veryo_insert_after_first_block( $content, veryo_sec_tools_band() );
	}
	$map  = veryo_page_tools();
	$path = get_page_uri( get_queried_object_id() );
	if ( ! isset( $map[ $path ] ) ) {
		return $content;
	}
	return veryo_insert_werkt_met( $content, $map[ $path ][0], $map[ $path ][1] );
}
add_filter( 'the_content', 'veryo_auto_tools_content', 8 );

/*
 * Contextuele interne links (SEO-audit 18 november 2026)
 */

/**
 * Een link in lopende tekst.
 *
 * @param string $path  Pad (of volledige URL).
 * @param string $label Ankertekst.
 * @return string
 */
function veryo_ctx_link( $path, $label ) {
	$url = 0 === strpos( $path, 'http' ) ? $path : veryo_link( $path );
	return '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
}

/**
 * Per pagina (pad, '' = homepage) één alinea met contextuele links naar verwante pagina's.
 *
 * @return array<string,string>
 */
function veryo_context_links() {
	$l = 'veryo_ctx_link';
	return apply_filters(
		'veryo_context_links',
		array(
			''                                          => sprintf(
				/* translators: %s: link naar Over Veryo. */
				__( 'Wie zit er achter Veryo? Lees %s: wie we zijn, hoe we werken en hoe we met jullie gegevens omgaan.', 'veryo' ),
				$l( 'over-veryo', __( 'meer over Veryo en oprichter Csaba Hamstra', 'veryo' ) )
			),
			'leeuwarden'                                => sprintf(
				/* translators: %s: link naar Over Veryo. */
				__( 'Veryo is in Leeuwarden begonnen en werkt vanuit hier voor heel Noord-Nederland. %s.', 'veryo' ),
				$l( 'over-veryo', __( 'Lees meer over Veryo en onze werkwijze', 'veryo' ) )
			),
			'contact'                                   => sprintf(
				/* translators: %s: link naar Over Veryo. */
				__( 'Eerst weten met wie jullie te maken krijgen? Lees %s.', 'veryo' ),
				$l( 'over-veryo', __( 'meer over Veryo en oprichter Csaba Hamstra', 'veryo' ) )
			),
			'ai-training'                               => sprintf(
				/* translators: 1: link zzp-training, 2: link AI-strategie. */
				__( 'Werken jullie als zelfstandige, kijk dan bij de %1$s. Voor directie en MT is er de %2$s, over kansen, keuzes en verantwoordelijkheid.', 'veryo' ),
				$l( 'ai-training/zzp', __( 'AI-training voor zzp’ers', 'veryo' ) ),
				$l( 'ai-training/ai-strategie', __( 'AI-strategie training voor directie en management', 'veryo' ) )
			),
			'academy'                                   => sprintf(
				/* translators: %s: link zzp-training. */
				__( 'Ben je zzp’er en wil je niet wachten op de online cursus? Bekijk de %s, met korte modules over offertes, mail en administratie.', 'veryo' ),
				$l( 'ai-training/zzp', __( 'AI-training voor zzp’ers', 'veryo' ) )
			),
			'ai-startpakket'                            => sprintf(
				/* translators: %s: link AI-strategie. */
				__( 'Wil de directie eerst zelf de koers bepalen, dan past de %s goed vóór het Startpakket.', 'veryo' ),
				$l( 'ai-training/ai-strategie', __( 'AI-strategie training voor directie en MT', 'veryo' ) )
			),
			'ai-implementatie-mkb'                      => sprintf(
				/* translators: %s: link AI-strategie. */
				__( 'Een implementatie begint bij een gedeeld beeld in de top. Daarvoor is er de %s.', 'veryo' ),
				$l( 'ai-training/ai-strategie', __( 'AI-strategie training voor directie en management', 'veryo' ) )
			),
			'oplossingen/werkbonnen-verwerken'          => sprintf(
				/* translators: 1: link werkbon-check, 2: link administratie. */
				__( 'Benieuwd wat het bij jullie oplevert? Doe de %1$s. Werkbonnen verwerken is onderdeel van %2$s, samen met inkoopfacturen en debiteuren.', 'veryo' ),
				$l( 'werkbon-check', __( 'gratis werkbon-check', 'veryo' ) ),
				$l( 'ai-automatisering/administratie', __( 'administratie automatiseren met AI', 'veryo' ) )
			),
			'ai-automatisering/werkprocessen'           => sprintf(
				/* translators: %s: link werkbon-check. */
				__( 'Gaan bij jullie veel werkbonnen met de hand naar kantoor? Doe de %s en zie hoeveel tijd automatisch verwerken scheelt.', 'veryo' ),
				$l( 'werkbon-check', __( 'gratis werkbon-check', 'veryo' ) )
			),
			'branches/installatie'                      => sprintf(
				/* translators: %s: link werkbon-check. */
				__( 'Typen jullie werkbonnen nog over voor de factuur? Met de %s zien jullie wat automatisch verwerken oplevert.', 'veryo' ),
				$l( 'werkbon-check', __( 'gratis werkbon-check voor installateurs', 'veryo' ) )
			),
			'ai-automatisering/administratie'           => sprintf(
				/* translators: 1: link inkoopfacturen, 2: link werkbonnen. */
				__( 'Twee onderdelen hebben een eigen uitgewerkte oplossing: %1$s en %2$s.', 'veryo' ),
				$l( 'oplossingen/inkoopfacturen-automatiseren', __( 'inkoopfacturen automatisch verwerken', 'veryo' ) ),
				$l( 'oplossingen/werkbonnen-verwerken', __( 'werkbonnen automatisch verwerken tot factuur', 'veryo' ) )
			),
			'oplossingen/inkoopfacturen-automatiseren'  => sprintf(
				/* translators: %s: link administratie. */
				__( 'Inkoopfacturen zijn één onderdeel van %s, naast bonnetjes, werkbonnen en debiteuren.', 'veryo' ),
				$l( 'ai-automatisering/administratie', __( 'administratie automatiseren met AI', 'veryo' ) )
			),
			'ai-automatisering/offertes-en-calculaties' => sprintf(
				/* translators: %s: link AI-calculatie. */
				__( 'Werken jullie met bestekken en tekeningen? Met %s worden hoeveelheden automatisch uitgetrokken voor de calculatie.', 'veryo' ),
				$l( 'oplossingen/ai-calculatie-offerte-factuur', __( 'AI-calculatie', 'veryo' ) )
			),
			'oplossingen/ai-calculatie-offerte-factuur' => sprintf(
				/* translators: %s: link offertes automatiseren. */
				__( 'Wil je vooral sneller offreren vanuit een aanvraag of foto? Lees hoe je %s met automatische opvolging.', 'veryo' ),
				$l( 'ai-automatisering/offertes-en-calculaties', __( 'offertes automatiseren', 'veryo' ) )
			),
			'ai-automatisering/hr-en-werving'           => sprintf(
				/* translators: 1: link recruitment, 2: link recruitment-assistent. */
				__( 'Zoeken jullie vooral vakmensen, kijk dan bij %1$s. Voor het screenen van cv’s en inplannen van gesprekken is er de %2$s.', 'veryo' ),
				$l( 'branches/recruitment', __( 'solliciteren via WhatsApp', 'veryo' ) ),
				$l( 'oplossingen/ai-recruitment-assistent', __( 'AI-recruitment-assistent', 'veryo' ) )
			),
			'branches/horeca-retail'                    => sprintf(
				/* translators: %s: link AI-telefoonassistent. */
				__( 'Gaat de telefoon altijd op het drukste moment? Lees hoe een %s reserveringen noteert en vragen beantwoordt.', 'veryo' ),
				$l( 'ai-op-maat/ai-receptionist-horeca', __( 'AI-telefoonassistent voor restaurants', 'veryo' ) )
			),
		)
	);
}

/**
 * De contextuele links in de inhoud zetten, direct na het eerste blok (meestal het korte
 * antwoord of de hero).
 *
 * @param string $content     Block markup.
 * @param string $text        Alinea met links.
 * @param string $after_class Optioneel: class van het blok waarna de alinea komt.
 * @return string
 */
function veryo_insert_context_links( $content, $text, $after_class = '' ) {
	if ( false !== strpos( $content, 'veryo-context-links' ) ) {
		return $content;
	}
	$block = veryo_b_p( $text, array( 'className' => 'veryo-context-links' ) );
	if ( $after_class && preg_match( '#"className":"[^"]*' . preg_quote( $after_class, '#' ) . '[^"]*"#', $content, $m, PREG_OFFSET_CAPTURE ) ) {
		$start = strrpos( substr( $content, 0, $m[0][1] ), '<!-- wp:' );
		$end   = false === $start ? -1 : veryo_first_block_end( substr( $content, $start ) );
		if ( $end > 0 ) {
			$pos = $start + $end;
			return substr( $content, 0, $pos ) . "\n" . $block . substr( $content, $pos );
		}
	}
	return veryo_insert_after_first_block( $content, $block );
}

/**
 * Na welk blok de contextuele links op een pagina komen (class van het blok). Standaard na
 * het eerste blok.
 *
 * @param string $path Pad.
 * @return string
 */
function veryo_context_links_anchor( $path ) {
	return '' === $path ? 'veryo-independent' : '';
}

/**
 * Contextuele links ook op zelf aangepaste pagina's: bij het tonen toevoegen als ze nog niet
 * in de opgeslagen inhoud staan.
 *
 * @param string $content Inhoud.
 * @return string
 */
function veryo_auto_context_links( $content ) {
	if ( is_admin() || ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() || ! apply_filters( 'veryo_auto_tools', true ) ) {
		return $content;
	}
	$map  = veryo_context_links();
	$path = is_front_page() ? '' : get_page_uri( get_queried_object_id() );
	return isset( $map[ $path ] ) ? veryo_insert_context_links( $content, $map[ $path ], veryo_context_links_anchor( $path ) ) : $content;
}
add_filter( 'the_content', 'veryo_auto_context_links', 7 );
