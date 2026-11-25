<?php
/**
 * Kennisbank: uitgeschreven naslagartikelen (status: concept). Ze worden als concept aangemaakt;
 * publiceer ze één voor één, niet allemaal op dezelfde dag.
 *
 * Geen klantcases, cijfers of prijzen: alleen uitleg en werkwijze.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_k_link = static function ( $path, $label ) {
	return '<a href="' . esc_url( veryo_link( $path ) ) . '">' . esc_html( $label ) . '</a>';
};

/**
 * Artikel opbouwen: intro, secties (kop, alinea's, optionele lijst, genummerd) en FAQ.
 */
$veryo_k_article = static function ( $intro, $sections, $faq ) {
	$out = '';
	foreach ( $intro as $para ) {
		$out .= veryo_b_p( $para );
	}
	foreach ( $sections as $section ) {
		$out .= veryo_b_h( $section[0] );
		foreach ( array_filter( (array) $section[1] ) as $para ) {
			$out .= veryo_b_p( $para );
		}
		if ( ! empty( $section[2] ) ) {
			$out .= veryo_b_list( $section[2], ! empty( $section[3] ) ? array( 'ordered' => true ) : array() );
		}
	}
	$out .= veryo_sec_faq( $faq );
	return $out;
};

return array(

	/* ------------------------------------------------------------------------- */
	'bestek-lezen-met-ai'                      => array(
		'title'     => __( 'Bestek lezen met AI: wat kan wel en wat niet', 'veryo' ),
		'seo_title' => __( 'Bestek lezen met AI: wat kan wel en wat niet | Veryo', 'veryo' ),
		'desc'      => __( 'Kan AI een bestek lezen? Wat het goed doet, waar het misgaat en hoe jullie het veilig inzetten bij calculatie en werkvoorbereiding. De engineer beslist.', 'veryo' ),
		'kw'        => 'bestek lezen met ai',
		'excerpt'   => __( 'Wat AI goed doet met een bestek, waar het misgaat en hoe jullie het inzetten zonder dat de controle verdwijnt.', 'veryo' ),
		'services'  => array( 'ai-werkplek', 'ai-automatisering/offertes-en-calculaties', 'diensten' ),
		'content'   => $veryo_k_article(
			array(
				__( 'Een bestek doorlezen kost tijd. Tientallen pagina’s, verwijzingen naar normen en tekeningen, en ergens in paragraaf 4.3 een eis die de hele calculatie verandert. AI kan daar veel van het leeswerk overnemen. Maar niet alles, en niet zonder controle.', 'veryo' ),
				__( 'In dit artikel lees je wat AI goed doet met een bestek, waar de grenzen liggen en hoe jullie het zo inzetten dat de engineer of calculator de baas blijft.', 'veryo' ),
			),
			array(
				array(
					__( 'Wat AI goed doet met een bestek', 'veryo' ),
					__( 'Taalmodellen zijn sterk in het lezen en samenvatten van lange teksten. Bij een bestek betekent dat:', 'veryo' ),
					array(
						__( 'De eisen per onderdeel op een rij zetten, met de paragraaf waar ze staan.', 'veryo' ),
						__( 'Uitsluitingen, stelposten en bijzondere voorwaarden apart benoemen.', 'veryo' ),
						__( 'Tegenstrijdigheden signaleren, bijvoorbeeld als twee paragrafen iets anders zeggen over hetzelfde onderdeel.', 'veryo' ),
						__( 'Een eerste lijst vragen opstellen voor de nota van inlichtingen.', 'veryo' ),
						__( 'De relevante posten klaarzetten in jullie eigen calculatiesjabloon.', 'veryo' ),
					),
				),
				array(
					__( 'Waar het misgaat', 'veryo' ),
					array(
						__( 'AI kan zich vergissen. Een taalmodel kan een eis over het hoofd zien, twee onderdelen door elkaar halen of iets formuleren alsof het in het bestek staat terwijl dat niet zo is. Dat is geen reden om het niet te gebruiken, wel een reden om het zo in te richten dat je elke bewering kunt nalopen.', 'veryo' ),
						__( 'Ook tekeningen, maatvoering en details blijven vakwerk. AI kan een tekening beschrijven, maar het lezen van een detail of het controleren van een maat hoort bij de engineer. En de verantwoordelijkheid voor de calculatie en het advies ligt altijd bij een mens.', 'veryo' ),
					),
				),
				array(
					__( 'Zo zetten jullie het veilig in', 'veryo' ),
					__( 'Een werkwijze die de controle bij jullie houdt:', 'veryo' ),
					array(
						__( 'Vraag altijd om een verwijzing naar de paragraaf, zodat elke regel na te lopen is.', 'veryo' ),
						__( 'Laat tegenstrijdigheden en onduidelijkheden apart markeren in plaats van ze op te lossen.', 'veryo' ),
						__( 'Werk met vaste instructies en jullie eigen sjablonen, zodat de uitkomst elke keer dezelfde opbouw heeft.', 'veryo' ),
						__( 'Loop de uitkomst na alsof een nieuwe collega hem heeft gemaakt: steekproefsgewijs, en volledig op de posten die er financieel toe doen.', 'veryo' ),
						__( 'Leg vast wie de uitkomst controleert en aftekent.', 'veryo' ),
					),
					true,
				),
				array(
					__( 'Vertrouwelijkheid', 'veryo' ),
					array(
						__( 'Een bestek van een opdrachtgever is vaak vertrouwelijk. Gebruik daarom een zakelijke AI-omgeving waarin jullie gegevens niet worden gebruikt om modellen te trainen, en spreek af welke documenten er wel en niet in mogen. Controleer ook de voorwaarden van de opdrachtgever: soms staat daar iets over het delen van stukken met derden.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar de AI-werkplek. */
							__( 'Wil je dit goed ingericht hebben, met jullie eigen sjablonen en afspraken? Lees hoe we %s.', 'veryo' ),
							$veryo_k_link( 'ai-werkplek', __( 'Claude Team inrichten', 'veryo' ) )
						),
					),
				),
			),
			array(
				array( __( 'Kan AI een heel bestek in één keer lezen?', 'veryo' ), __( 'Met de huidige zakelijke AI-modellen kunnen lange documenten in één keer worden verwerkt. Bij heel omvangrijke stukken is het verstandig om per hoofdstuk te werken, zodat de uitkomst overzichtelijk en controleerbaar blijft.', 'veryo' ) ),
				array( __( 'Vervangt AI de calculator?', 'veryo' ), __( 'Nee. AI neemt leeswerk en voorbereiding over. De calculator bepaalt de prijs, controleert de posten en is verantwoordelijk voor de calculatie.', 'veryo' ) ),
				array( __( 'Kan AI tekeningen lezen?', 'veryo' ), __( 'AI kan een tekening beschrijven, maar het betrouwbaar lezen van details en maatvoering blijft werk van de engineer. Gebruik AI vooral voor de tekst van het bestek.', 'veryo' ) ),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'normen-kengetallen-sjablonen-klaarzetten' => array(
		'title'     => __( 'Normen, kengetallen en sjablonen klaarzetten voor AI: een checklist', 'veryo' ),
		'seo_title' => __( 'Kengetallen en sjablonen klaarzetten voor AI | Veryo', 'veryo' ),
		'desc'      => __( 'Wat verzamelen jullie voordat AI met jullie eigen werk aan de slag kan? Een checklist voor sjablonen, kengetallen, werkinstructies en afspraken.', 'veryo' ),
		'kw'        => 'ai sjablonen kengetallen',
		'excerpt'   => __( 'Een checklist van wat jullie klaarzetten voordat AI met jullie eigen werk aan de slag kan, en wat er beter niet in kan.', 'veryo' ),
		'services'  => array( 'ai-werkplek', 'diensten', 'veilig-ai-gebruik' ),
		'content'   => $veryo_k_article(
			array(
				__( 'Een algemene AI-assistent weet niets van jullie bedrijf. Hij kent jullie rapportopbouw niet, rekent niet met jullie kengetallen en weet niet welke uitgangspunten jullie altijd hanteren. Het antwoord is dan algemeen, en wie het controleert, moet alles opnieuw nalopen.', 'veryo' ),
				__( 'Het verschil zit in wat je klaarzet. Met deze checklist weten jullie wat je verzamelt voordat AI met jullie eigen werk aan de slag kan.', 'veryo' ),
			),
			array(
				array(
					__( 'De checklist', 'veryo' ),
					'',
					array(
						'<strong>' . __( 'Sjablonen.', 'veryo' ) . '</strong> ' . __( 'De actuele versie van jullie rapporten, offertes, werkplannen en verslagen. Liefst één goed voorbeeld per soort document.', 'veryo' ),
						'<strong>' . __( 'Kengetallen.', 'veryo' ) . '</strong> ' . __( 'De getallen waarmee jullie rekenen: normuren, opslagen, standaardhoeveelheden. Met de datum waarop ze voor het laatst zijn bijgewerkt.', 'veryo' ),
						'<strong>' . __( 'Werkinstructies en uitgangspunten.', 'veryo' ) . '</strong> ' . __( 'Wat jullie altijd controleren, welke aannames jullie standaard doen en welke fouten jullie willen voorkomen.', 'veryo' ),
						'<strong>' . __( 'Een lijst met normen.', 'veryo' ) . '</strong> ' . __( 'Welke normen en richtlijnen jullie gebruiken. Controleer bij normteksten eerst de licentievoorwaarden voordat je de tekst zelf in een AI-tool zet; vaak is een verwijzing naar de norm genoeg.', 'veryo' ),
						'<strong>' . __( 'Voorbeelden van goed werk.', 'veryo' ) . '</strong> ' . __( 'Een paar afgeronde projecten waar jullie tevreden over zijn, zonder gegevens die er niet in horen.', 'veryo' ),
						'<strong>' . __( 'Afspraken.', 'veryo' ) . '</strong> ' . __( 'Wat er nooit in de AI-omgeving mag, wie controleert en wie eigenaar is van de sjablonen en kengetallen.', 'veryo' ),
					),
					true,
				),
				array(
					__( 'Wat er beter niet in kan', 'veryo' ),
					array(
						__( 'Persoonsgegevens die voor het werk niet nodig zijn, wachtwoorden en documenten waarvan de opdrachtgever heeft gezegd dat ze binnen moeten blijven. Spreek dat vooraf af en leg het vast in een kort AI-beleid.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar veilig AI-gebruik. */
							__( 'Meer over afspraken en rechten lees je bij %s.', 'veryo' ),
							$veryo_k_link( 'veilig-ai-gebruik', __( 'veilig AI-gebruik', 'veryo' ) )
						),
					),
				),
				array(
					__( 'Actueel houden', 'veryo' ),
					array(
						__( 'Een sjabloon dat verouderd is, levert verouderde uitkomsten op. Wijs daarom per soort document een eigenaar aan, en zet een vast moment in de agenda om kengetallen en sjablonen na te lopen, bijvoorbeeld na elke nacalculatie of elk kwartaal.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar de AI-werkplek. */
							__( 'Willen jullie dat iemand dit samen met jullie inricht? Lees hoe we %s.', 'veryo' ),
							$veryo_k_link( 'ai-werkplek', __( 'Claude Team inrichten', 'veryo' ) )
						),
					),
				),
			),
			array(
				array( __( 'Hoeveel sjablonen hebben we nodig om te beginnen?', 'veryo' ), __( 'Begin met één soort document dat vaak terugkomt, zoals een rapport of werkplan. Werkt dat goed, dan breiden jullie uit.', 'veryo' ) ),
				array( __( 'Mogen normteksten in een AI-tool?', 'veryo' ), __( 'Dat hangt af van de licentie waaronder jullie de norm gebruiken. Controleer die eerst. Vaak is het genoeg om naar de norm te verwijzen en de eigen uitgangspunten te beschrijven.', 'veryo' ) ),
				array( __( 'Wie is eigenaar van de sjablonen?', 'veryo' ), __( 'Jullie. Wijs per soort document iemand aan die de sjablonen en kengetallen bijhoudt.', 'veryo' ) ),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'begroot-versus-werkelijk-per-project'     => array(
		'title'     => __( 'Begroot naast werkelijk per project: bijhouden terwijl het project loopt', 'veryo' ),
		'seo_title' => __( 'Begroot versus werkelijk per project bijhouden | Veryo', 'veryo' ),
		'desc'      => __( 'Begroot naast werkelijk per project bijhouden terwijl het werk nog loopt: wat jullie nodig hebben, waar het misgaat en hoe automatisering helpt.', 'veryo' ),
		'kw'        => 'begroot versus werkelijk project',
		'excerpt'   => __( 'Hoe jullie begroot naast werkelijk per project bijhouden terwijl het werk nog loopt, en niet pas bij de nacalculatie.', 'veryo' ),
		'services'  => array( 'ai-automatisering/administratie', 'oplossingen/inkoopfacturen-automatiseren', 'oplossingen/werkbonnen-verwerken' ),
		'content'   => $veryo_k_article(
			array(
				__( 'In veel projectbedrijven komt de nacalculatie pas als het project klaar is. Dan blijkt dat er meer uren in zaten dan begroot, of dat de inkoop hoger uitviel. Bijsturen kan dan niet meer.', 'veryo' ),
				__( 'Begroot naast werkelijk bijhouden terwijl het project loopt, vraagt geen nieuw pakket. Het vraagt vooral dat uren, inkoop en meerwerk op tijd en op het juiste project terechtkomen.', 'veryo' ),
			),
			array(
				array(
					__( 'Wat jullie nodig hebben', 'veryo' ),
					'',
					array(
						__( 'Een begroting per project, liefst per post of fase.', 'veryo' ),
						__( 'Uren die per project en per medewerker worden geregistreerd.', 'veryo' ),
						__( 'Inkoopfacturen die aan een project of inkooporder gekoppeld zijn.', 'veryo' ),
						__( 'Meerwerk dat apart wordt vastgelegd, met een akkoord van de klant.', 'veryo' ),
					),
				),
				array(
					__( 'Waar het meestal misgaat', 'veryo' ),
					array(
						__( 'Uren komen laat binnen of zonder projectnummer. Inkoopfacturen worden geboekt zonder koppeling aan het project. Meerwerk wordt uitgevoerd maar niet vastgelegd. Elk van die gaten maakt het overzicht onbetrouwbaar, en dan wordt er niet meer naar gekeken.', 'veryo' ),
					),
				),
				array(
					__( 'Hoe automatisering helpt', 'veryo' ),
					__( 'De winst zit in het werk tussen het veld en de administratie:', 'veryo' ),
					array(
						__( 'Uren en werkbonnen worden ingelezen, ook als ze als foto of via WhatsApp binnenkomen, en op het juiste project gezet.', 'veryo' ),
						__( 'Inkoopfacturen worden uitgelezen en gekoppeld aan het project of de inkooporder.', 'veryo' ),
						__( 'Elke week staat er per project een overzicht klaar van begroot naast werkelijk.', 'veryo' ),
						__( 'Afwijkingen worden gemarkeerd, zodat de projectleider ze ziet terwijl er nog bijgestuurd kan worden.', 'veryo' ),
					),
				),
				array(
					__( 'Wat een mens blijft doen', 'veryo' ),
					array(
						__( 'Het overzicht laat zien waar het afwijkt; de projectleider beoordeelt waarom en beslist wat er gebeurt. Een overschrijding kan terecht zijn, bijvoorbeeld door meerwerk dat de klant heeft goedgekeurd.', 'veryo' ),
						sprintf(
							/* translators: 1: link naar de administratieve kringloop, 2: link naar inkoopfacturen. */
							__( 'Dit is een onderdeel van %1$s. Voor de inkoopkant zie ook %2$s.', 'veryo' ),
							$veryo_k_link( 'ai-automatisering/administratie', __( 'de administratieve kringloop', 'veryo' ) ),
							$veryo_k_link( 'oplossingen/inkoopfacturen-automatiseren', __( 'facturen automatiseren', 'veryo' ) )
						),
					),
				),
			),
			array(
				array( __( 'Hebben we hier een nieuw pakket voor nodig?', 'veryo' ), __( 'Meestal niet. De gegevens staan vaak al in jullie boekhouding, urenregistratie en projectadministratie. Het gaat erom dat ze op tijd en op het juiste project terechtkomen.', 'veryo' ) ),
				array( __( 'Hoe vaak moeten we begroot naast werkelijk bekijken?', 'veryo' ), __( 'Voor lopende projecten werkt een vast moment per week goed, bijvoorbeeld bij de weekafsluiting.', 'veryo' ) ),
				array( __( 'Wat als uren zonder projectnummer binnenkomen?', 'veryo' ), __( 'Die worden gemarkeerd, zodat iemand ze aan het juiste project koppelt voordat ze in het overzicht meetellen.', 'veryo' ) ),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'werkbonnen-digitaliseren'                 => array(
		'title'     => __( 'Werkbonnen digitaliseren: foto, WhatsApp of formulier?', 'veryo' ),
		'seo_title' => __( 'Werkbonnen digitaliseren: foto, WhatsApp, formulier | Veryo', 'veryo' ),
		'desc'      => __( 'Werkbonnen digitaliseren zonder dat monteurs anders gaan werken? Voor- en nadelen van een foto, WhatsApp of formulier, en wat er op een werkbon hoort.', 'veryo' ),
		'kw'        => 'werkbonnen digitaliseren',
		'excerpt'   => __( 'Drie manieren om werkbonnen te digitaliseren, met eerlijke voor- en nadelen, en wat er altijd op een werkbon hoort.', 'veryo' ),
		'services'  => array( 'oplossingen/werkbonnen-verwerken', 'ai-automatisering/administratie' ),
		'content'   => $veryo_k_article(
			array(
				__( 'Papieren werkbonnen raken kwijt, zijn slecht leesbaar en worden op kantoor overgetypt. Digitaliseren klinkt als de oplossing, maar een nieuwe app die monteurs niet gebruiken, lost niets op.', 'veryo' ),
				__( 'Er zijn grofweg drie manieren om werkbonnen digitaal binnen te krijgen. Welke past, hangt vooral af van hoe jullie monteurs nu werken.', 'veryo' ),
			),
			array(
				array(
					__( 'Wat er op een werkbon hoort', 'veryo' ),
					__( 'Welke route jullie ook kiezen, deze gegevens moeten er altijd op staan:', 'veryo' ),
					array(
						__( 'Klant en adres, of het projectnummer.', 'veryo' ),
						__( 'Datum, monteur en gewerkte uren.', 'veryo' ),
						__( 'Gebruikt materiaal, met aantallen.', 'veryo' ),
						__( 'Wat er is gedaan, en of er meerwerk was.', 'veryo' ),
						__( 'Akkoord van de klant, als jullie dat vragen.', 'veryo' ),
					),
				),
				array(
					__( '1. Een foto van de papieren werkbon', 'veryo' ),
					array(
						__( 'Monteurs blijven werken zoals ze gewend zijn en maken aan het eind een foto. AI leest de werkbon uit en zet de gegevens klaar. Voordeel: er verandert bijna niets voor de monteur. Nadeel: handschrift en slechte foto’s zijn niet altijd goed leesbaar. Twijfelgevallen worden dan gemarkeerd, zodat kantoor even meekijkt.', 'veryo' ),
					),
				),
				array(
					__( '2. Via WhatsApp', 'veryo' ),
					array(
						__( 'De monteur stuurt foto’s, een spraakbericht of een korte tekst naar een vast nummer. Voordeel: iedereen kent WhatsApp, en ontbrekende gegevens kunnen direct worden nagevraagd. Let op: gebruik een zakelijk WhatsApp-account en spreek af wat er wel en niet via WhatsApp gaat.', 'veryo' ),
					),
				),
				array(
					__( '3. Een digitaal formulier', 'veryo' ),
					array(
						__( 'Een formulier op de telefoon met vaste velden. Voordeel: de gegevens komen compleet en gestructureerd binnen. Nadeel: monteurs moeten eraan wennen, en een formulier dat te lang is, wordt slordig ingevuld. Houd het daarom kort.', 'veryo' ),
					),
				),
				array(
					__( 'Hoe jullie kiezen', 'veryo' ),
					array(
						__( 'Begin bij hoe het nu gaat. Werken jullie monteurs met papier en willen ze dat graag zo houden, begin dan met de foto. Gebruiken ze WhatsApp al voor overleg met kantoor, dan ligt die route voor de hand. Combineren kan ook: een foto via WhatsApp, met een korte vraag als er iets ontbreekt.', 'veryo' ),
						sprintf(
							/* translators: 1: link naar werkbonnen verwerken, 2: link naar de administratieve kringloop. */
							__( 'Hoe een werkbon daarna automatisch een conceptfactuur wordt, lees je bij %1$s. Het hele traject van werkbon tot salarisadministratie staat bij %2$s.', 'veryo' ),
							$veryo_k_link( 'oplossingen/werkbonnen-verwerken', __( 'werkbonnen verwerken', 'veryo' ) ),
							$veryo_k_link( 'ai-automatisering/administratie', __( 'de administratieve kringloop', 'veryo' ) )
						),
					),
				),
			),
			array(
				array( __( 'Kan AI handgeschreven werkbonnen lezen?', 'veryo' ), __( 'Vaak wel, als de foto scherp is. Twijfelt de AI, dan wordt het veld gemarkeerd zodat iemand op kantoor meekijkt.', 'veryo' ) ),
				array( __( 'Moeten monteurs een nieuwe app leren?', 'veryo' ), __( 'Niet per se. Met een foto of WhatsApp blijven ze grotendeels werken zoals nu.', 'veryo' ) ),
				array( __( 'Waar komen de gegevens terecht?', 'veryo' ), __( 'In het pakket dat jullie al gebruiken voor planning, uren of administratie. Daar staan ze als concept klaar om te controleren.', 'veryo' ) ),
			)
		),
	),
);
