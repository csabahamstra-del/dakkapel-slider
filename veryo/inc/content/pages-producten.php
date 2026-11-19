<?php
/**
 * Producten: het Veryo AI-Startpakket (hoofdproduct) en het AI-partner-abonnement.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/*
 * AI-Startpakket
 */
$veryo_sp_parts = array(
	'<strong>' . __( 'AI-scan en kansensessie', 'veryo' ) . '</strong><br>' . __( 'We beginnen met de gratis AI-scan en een halve dag kansensessie bij jullie op locatie. Samen lopen we je processen door: waar gaat de tijd heen, welke software gebruik je al, wat ergert het team. Je krijgt onafhankelijk advies welke bestaande tools het best passen, en een lijst met kansen op volgorde van opbrengst.', 'veryo' ),
	'<strong>' . __( 'AI-beleid op maat', 'veryo' ) . '</strong><br>' . __( 'Een beleid van één à twee pagina’s dat het team echt leest: welke tools jullie gebruiken, welke gegevens er nooit in gaan en wie verantwoordelijk is. We stellen het samen met jullie op, op basis van wat in de kansensessie naar voren kwam.', 'veryo' ),
	'<strong>' . __( 'Eén toepassing gebouwd of ingericht', 'veryo' ) . '</strong><br>' . __( 'We bouwen of richten één afgebakende toepassing daadwerkelijk in, bijvoorbeeld het inlezen van werkbonnen, het koppelen van inkoopfacturen aan projecten of Claude Team met jullie eigen templates. Bovenop de software die jullie al hebben. Zo heeft het team direct iets dat werkt, en geen rapport dat in een la verdwijnt.', 'veryo' ),
	'<strong>' . __( 'Jullie team ermee leren werken', 'veryo' ) . '</strong><br>' . __( 'Na de oplevering leren we jullie team ermee werken, met de toepassing die we hebben gebouwd. Helder wat wel en niet mag met klant- en bedrijfsgegevens.', 'veryo' ),
	'<strong>' . __( '30 dagen nazorg', 'veryo' ) . '</strong><br>' . __( 'Een maand lang een vast aanspreekpunt voor vragen uit het team. Aan het eind evalueren we samen: wat werkt, wat niet, en wat de logische volgende stappen zijn.', 'veryo' ),
);

$veryo_startpakket  = veryo_sec_answer( __( 'Het Veryo AI-Startpakket is de manier om AI in één keer goed en veilig in je bedrijf neer te zetten: een kansensessie met onafhankelijk advies, een AI-beleid op maat, één toepassing die we bouwen of inrichten, jullie team ermee leren werken en 30 dagen nazorg. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ), array( __( 'Vraag het AI-Startpakket aan', 'veryo' ), '#vraag', 'amber' ) );
$veryo_startpakket .= veryo_sec_text(
	__( 'Iedereen moet iets met AI, maar wat gebeurt er nu al?', 'veryo' ),
	array(
		__( 'In de meeste bedrijven gebruiken medewerkers ChatGPT of een vergelijkbare tool al op eigen houtje. Soms slim, soms niet. De een schrijft er offertes mee, de ander plakt er een klantmail met naam en adres in. Niemand weet precies wat er wordt ingevoerd, en niemand heeft afgesproken wat wel en niet mag.', 'veryo' ),
		__( 'Tegelijk hoor je overal dat je iets met AI moet, maar niet wat, en ook niet wat het kost. Het AI-Startpakket brengt daar in een paar weken rust in: er zijn duidelijke afspraken, er draait één toepassing die tijd bespaart en het team weet hoe het ermee werkt. Dat is een goede basis om daarna verder te bouwen.', 'veryo' ),
	)
);
$veryo_startpakket .= veryo_sec_photo( __( 'team van een MKB-bedrijf in overleg aan tafel', 'veryo' ), __( 'AI-startpakket voor het MKB: kansensessie met het team', 'veryo' ), 'overleg' );
$veryo_startpakket .= veryo_b_group(
	veryo_b_h( __( 'Wat zit er in het AI-Startpakket?', 'veryo' ) )
	. veryo_b_p( __( 'Vijf onderdelen, in deze volgorde. Elk onderdeel bouwt voort op het vorige.', 'veryo' ) )
	. veryo_b_list(
		$veryo_sp_parts,
		array(
			'ordered'   => true,
			'className' => 'is-style-steps',
		)
	),
	array( 'className' => 'veryo-steps' )
);
$veryo_startpakket .= veryo_sec_text(
	__( 'Wat je na afloop hebt', 'veryo' ),
	array(),
	array(
		__( 'Een team dat weet hoe het met de opgeleverde toepassing werkt.', 'veryo' ),
		__( 'Een AI-beleid van één à twee pagina’s dat iedereen kent.', 'veryo' ),
		__( 'Eén werkende toepassing die elke week tijd bespaart.', 'veryo' ),
		__( 'Een plan voor de volgende stappen, op volgorde van opbrengst.', 'veryo' ),
	),
	'checks'
);
$veryo_startpakket .= veryo_sec_tiered_price(
	__( 'Wat kost het AI-Startpakket?', 'veryo' ),
	__( 'De inhoud is voor iedereen gelijk; bij een groter team gaan het beleid, de uitleg na de oplevering en de nazorg over meer mensen.', 'veryo' ),
	veryo_startpakket_prices(),
	sprintf(
		/* translators: %s: link naar de offerte. */
		__( 'Je betaalt het pakket één keer; er zit geen software aan vast. <a href="%s">Hoe de offerte werkt</a>.', 'veryo' ),
		esc_url( veryo_link( 'prijzen' ) )
	),
	true
);
$veryo_startpakket .= veryo_sec_ongoing( 'bijblijven' );
$veryo_startpakket .= veryo_sec_text(
	__( 'Het AI-Startpakket en de AI Act', 'veryo' ),
	array(
		__( 'Artikel 4 van de Europese AI Act geldt sinds 2 februari 2025. Sinds de wijziging door de Digital Omnibus op 27 juli 2026 vraagt het organisaties die AI inzetten om maatregelen te nemen die de AI-geletterdheid van hun medewerkers ondersteunen. Een vast kennisniveau per persoon hoeft niet gegarandeerd te worden, maar de plicht zelf blijft bindend. Dat geldt ook voor het MKB, en ook als het “alleen” om ChatGPT of Copilot gaat.', 'veryo' ),
		__( 'De wet schrijft geen vast programma voor. Het AI-beleid uit het Startpakket en de uitleg na de oplevering zijn concrete stappen om daaraan te werken: medewerkers weten wat de toepassing kan en wat niet, en er zijn afspraken over veilig gebruik.', 'veryo' ),
	)
);
$veryo_startpakket .= veryo_sec_text(
	__( 'Wat het AI-Startpakket niet is', 'veryo' ),
	array(),
	array(
		'<strong>' . __( 'Geen software.', 'veryo' ) . '</strong> ' . __( 'We verkopen geen eigen tool. We adviseren onafhankelijk en werken zoveel mogelijk met wat je al hebt.', 'veryo' ),
		'<strong>' . __( 'Geen losse training of certificaat.', 'veryo' ) . '</strong> ' . __( 'Er bestaat geen officieel wettelijk certificaat voor AI-geletterdheid. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
		'<strong>' . __( 'Geen verplicht abonnement.', 'veryo' ) . '</strong> ' . __( 'Je betaalt het pakket één keer. Het abonnement Bijblijven loopt de eerste maand kosteloos mee; daarna kies je zelf of je doorgaat.', 'veryo' ),
		'<strong>' . __( 'Geen juridisch advies.', 'veryo' ) . '</strong> ' . __( 'Het AI-beleid is praktisch. Wil je het juridisch laten toetsen, dan raden we een jurist aan.', 'veryo' ),
	)
);
$veryo_startpakket .= veryo_sec_collega_blok();
$veryo_startpakket .= veryo_sec_contact(
	__( 'Vragen over het AI-Startpakket?', 'veryo' ),
	__( 'Twijfel je of het pakket bij jouw team past, of wil je een datum voor de kansensessie? Stel je vraag; je krijgt binnen één werkdag antwoord.', 'veryo' ),
	__( 'Bijvoorbeeld: past het Startpakket bij een team van 8 mensen met Google Workspace?', 'veryo' )
);
$veryo_startpakket .= veryo_sec_faq(
	array(
		array( __( 'Voor welke bedrijven is het AI-Startpakket?', 'veryo' ), __( 'Voor MKB-bedrijven met een team tot ongeveer 50 mensen die AI goed willen invoeren. Het maakt niet uit of er al iemand met ChatGPT werkt of nog niemand.', 'veryo' ) ),
		array( __( 'Hoe lang duurt het?', 'veryo' ), __( 'Meestal een paar weken, afhankelijk van jullie agenda. De kansensessie is een dagdeel; daarna bouwen of richten we de toepassing in, leren we jullie team ermee werken en begint de nazorg van 30 dagen.', 'veryo' ) ),
		array( __( 'Moeten we daarna iets afnemen?', 'veryo' ), __( 'Nee. Je krijgt een plan voor de volgende stappen, en die kun je zelf uitvoeren, met ons of met iemand anders.', 'veryo' ) ),
		array( __( 'Welke AI-tool gaan we gebruiken?', 'veryo' ), __( 'Dat hangt af van jullie werk en de software die je al hebt. We adviseren onafhankelijk; vaak zit er in je bestaande pakketten al meer AI dan je denkt.', 'veryo' ) ),
		array( __( 'Wat als de toepassing meer werk is dan verwacht?', 'veryo' ), __( 'Dan kiezen we samen een kleinere toepassing binnen het pakket, en krijg je voor de grotere toepassing een aparte vaste prijs. Je betaalt niets wat niet vooraf is afgesproken.', 'veryo' ) ),
		array( __( 'Kunnen we eerst kennismaken?', 'veryo' ), __( 'Ja. Plan een kennismaking of doe eerst de gratis AI-scan; dan weten we allebei al waar de kansen zitten.', 'veryo' ) ),
	)
);
$veryo_startpakket .= veryo_b_group(
	veryo_b_h( __( 'Klaar om AI goed neer te zetten?', 'veryo' ), 2, array( 'fontSize' => 'display-l' ) )
	. veryo_b_p( __( 'Plan een kennismaking van een half uur, of doe eerst de gratis AI-scan. Je zit nergens aan vast.', 'veryo' ), array( 'className' => 'veryo-lead' ) )
	. veryo_b_shortcode( '[veryo_kennismaking]' ),
	array(
		'tagName'   => 'section',
		'align'     => 'full',
		'className' => 'is-style-petrol veryo-cta has-check',
	)
);
$veryo_startpakket .= veryo_sec_links(
	array(
		array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
		array( 'ai-werkplek', __( 'AI-werkplek met Claude Team', 'veryo' ), __( 'Claude met jullie eigen normen en templates', 'veryo' ) ),
		array( 'ai-partner', __( 'AI-partner-abonnement', 'veryo' ), __( 'Na het Startpakket', 'veryo' ) ),
		array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Op locatie in het noorden', 'veryo' ) ),
	)
);

/*
 * AI-partner
 */
$veryo_partner  = veryo_sec_answer( __( 'Met een AI-abonnement heb je een vaste AI-partner: Veryo is elke maand jullie vraagbaak voor alles rond AI, in één abonnement: Bijblijven, Werkplek-onderhoud en Veilig blijven, plus elke maand uren voor verbeteringen en nieuwe toepassingen. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) );
$veryo_partner .= veryo_sec_text(
	__( 'Na de eerste maand valt het vaak stil', 'veryo' ),
	array(
		__( 'Het beleid staat op papier en de eerste toepassing draait. Maar dan komt het gewone werk weer. Nieuwe medewerkers weten niet wat er is afgesproken. Claude krijgt een nieuwe functie, maar niemand zet hem aan. En die tweede toepassing waar iedereen enthousiast over was, blijft liggen.', 'veryo' ),
		__( 'Een eigen AI-specialist aannemen is voor een bedrijf met tien of twintig mensen te veel. Met een AI-partner heb je wel iemand die meedenkt, bijhoudt wat er verandert en zorgt dat het niet stilvalt.', 'veryo' ),
	)
);
$veryo_partner .= veryo_sec_photo( __( 'maandelijks overleg aan tafel met laptops', 'veryo' ), __( 'AI-partner voor het MKB: maandelijks overleg met het team', 'veryo' ), 'overleg' );
$veryo_partner .= veryo_sec_text(
	__( 'Wat zit er in het AI-partner-abonnement?', 'veryo' ),
	array( __( 'AI-partner bundelt de drie losse abonnementen en voegt er uren en overleg aan toe.', 'veryo' ) ),
	array(
		'<strong>' . __( 'Bijblijven.', 'veryo' ) . '</strong> ' . __( 'Elk kwartaal een korte update over wat er nieuw is, nieuwe medewerkers leren werken met wat we hebben ingericht, het AI-beleid wordt jaarlijks bijgewerkt en jullie kunnen vragen per mail stellen.', 'veryo' ),
		'<strong>' . __( 'Werkplek-onderhoud.', 'veryo' ) . '</strong> ' . __( 'Nieuwe medewerkers toevoegen aan Claude Team, rechten bijhouden, normen en templates actueel houden en nieuwe functies beoordelen.', 'veryo' ),
		'<strong>' . __( 'Veilig blijven.', 'veryo' ) . '</strong> ' . __( 'Elke maand een controle van rechten en instellingen, twee keer per jaar een korte bewustwordingssessie, en een beleid dat actueel blijft.', 'veryo' ),
		'<strong>' . __( 'Uren voor verbeteringen.', 'veryo' ) . '</strong> ' . __( 'Vier, zes of tien uur per maand voor kleine verbeteringen en nieuwe toepassingen, afhankelijk van je teamgrootte.', 'veryo' ),
		'<strong>' . __( 'Overleg en voorrang.', 'veryo' ) . '</strong> ' . __( 'Vanaf 11 medewerkers een maandelijks overleg; vanaf 26 medewerkers ook voorrang bij vragen.', 'veryo' ),
	),
	'checks'
);
$veryo_partner .= veryo_b_group(
	veryo_b_h( __( 'Wat kost een AI-partner?', 'veryo' ) )
	. veryo_b_p( __( 'Een vast bedrag per maand, afgestemd op je teamgrootte. Je krijgt vooraf een gratis offerte.', 'veryo' ) )
	. veryo_sec_partner_tiers()
	. veryo_b_buttons( array( array( veryo_offerte_label(), veryo_offerte_url() ) ) ),
	array( 'className' => 'veryo-partner-prices' )
);
$veryo_partner .= veryo_sec_text(
	__( 'Wat er niet onder AI-partner valt', 'veryo' ),
	array(
		__( 'Onderhoud van koppelingen en agents die we voor je bouwen, valt er niet onder. Grotere projecten krijgen altijd een eigen vaste prijs, zodat het abonnement voorspelbaar blijft. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
		__( 'Veryo doet ook geen algemeen IT-beheer, netwerken of helpdesk. Alleen de machine waarop [veryo_collega_naam] draait, beheren we zelf. Heb je een vaste IT-beheerder, dan werken we graag met die samen.', 'veryo' ),
	)
);
$veryo_partner .= veryo_sec_text(
	__( 'Hoe een maand met een AI-partner eruitziet', 'veryo' ),
	array(
		__( 'Aan het begin van de maand kijken we wat er de afgelopen weken is gebruikt, waar vragen over waren en wat er is veranderd in de software die jullie gebruiken. Daaruit kiezen we één of twee verbeteringen voor die maand.', 'veryo' ),
		__( 'Tussendoor kunnen collega’s vragen stellen. Komt er een nieuwe medewerker, dan richten we die in en plannen we een korte introductie op het AI-beleid. Aan het eind van de maand krijg je een kort overzicht van wat er is gedaan en wat er klaarligt voor de volgende maand.', 'veryo' ),
	)
);
$veryo_partner .= veryo_sec_subscription_terms();
$veryo_partner .= veryo_sec_collega_blok();
$veryo_partner .= veryo_sec_contact(
	__( 'Welk niveau AI-partner past bij jullie?', 'veryo' ),
	__( 'Vertel hoe groot je team is en wat er al draait. Je krijgt binnen één werkdag advies over het niveau dat past, en wat je er per maand voor krijgt.', 'veryo' ),
	__( 'Bijvoorbeeld: we hebben het Startpakket gedaan en willen nu doorlopende hulp voor 20 mensen.', 'veryo' )
);
$veryo_partner .= veryo_sec_faq(
	array(
		array( __( 'Moet ik eerst het AI-Startpakket afnemen?', 'veryo' ), __( 'Het hoeft niet, maar het helpt. Zonder basis gaat het eerste deel van de uren op aan wat in het Startpakket zit.', 'veryo' ) ),
		array( __( 'Wat is de looptijd?', 'veryo' ), __( 'AI-partner sluit je af per jaar en wordt maandelijks gefactureerd. Betaal je het jaar vooruit, dan krijg je korting.', 'veryo' ) ),
		array( __( 'Wat als ik mijn uren in een maand niet gebruik?', 'veryo' ), __( 'Die vervallen aan het eind van de maand. In het overleg kijken we samen hoe je de uren het best inzet.', 'veryo' ) ),
		array( __( 'Is AI-partner goedkoper dan losse abonnementen?', 'veryo' ), __( 'Ja, zodra je meer dan één abonnement nodig hebt. AI-partner combineert Bijblijven, Werkplek-onderhoud en Veilig blijven, en je krijgt er elke maand uren voor verbeteringen bij. In de offerte zie je het verschil voor jouw situatie.', 'veryo' ) ),
		array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo doet geen algemeen IT-beheer, netwerken of helpdesk. Alleen de machine waarop [veryo_collega_naam] draait, beheren we zelf. We werken graag samen met je vaste IT-beheerder.', 'veryo' ) ),
		array( __( 'Komen jullie ook langs?', 'veryo' ), __( 'In Friesland, Groningen en Drenthe kan het overleg op locatie. Elders doen we het online.', 'veryo' ) ),
	)
);
$veryo_partner .= veryo_sec_cta_scan();
$veryo_partner .= veryo_sec_links(
	array(
		array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'De basis vóór het abonnement', 'veryo' ) ),
		array( 'ai-werkplek', __( 'AI-werkplek met Claude Team', 'veryo' ), __( 'Claude met jullie eigen normen en templates', 'veryo' ) ),
		array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid, rechten en de veiligheidscheck', 'veryo' ) ),
		array( 'prijzen', __( 'Gratis offerte', 'veryo' ), __( 'Vooraf een vaste prijs', 'veryo' ) ),
	)
);

return array(
	'ai-startpakket' => array(
		'title'     => __( 'Het Veryo AI-Startpakket', 'veryo' ),
		'seo_title' => __( 'AI-Startpakket: advies, beleid en één toepassing | Veryo', 'veryo' ),
		'desc'      => __( 'Het AI-startpakket voor het MKB: kansensessie, AI-beleid op maat, één toepassing gebouwd of ingericht en 30 dagen nazorg. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai startpakket mkb',
		'schema'    => array(
			'type' => 'startpakket',
			'min'  => 1995,
			'max'  => 4495,
		),
		'content'   => $veryo_startpakket,
	),
	'ai-partner'     => array(
		'title'     => __( 'AI-abonnement voor het mkb: een vaste AI-partner', 'veryo' ),
		'seo_title' => __( 'AI-abonnement voor het mkb: een vaste AI-partner | Veryo', 'veryo' ),
		'desc'      => __( 'Een AI-abonnement voor het mkb: elke maand een vaste AI-partner voor vragen, updates, veiligheid en verbeteringen. Plan een gratis kennismaking.', 'veryo' ),
		'kw'        => 'ai abonnement mkb',
		'schema'    => array(
			'type' => 'partner',
			'min'  => 495,
			'max'  => 995,
		),
		'content'   => $veryo_partner,
	),
);
