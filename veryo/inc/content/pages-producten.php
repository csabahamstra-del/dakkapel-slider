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
	'<strong>' . __( 'AI-training voor het hele team', 'veryo' ) . '</strong><br>' . __( 'Een halve dag praktisch aan de slag met ChatGPT, Claude of Copilot, afhankelijk van wat bij jullie past. Met oefeningen uit jullie eigen werk, zoals mail, offertes en samenvattingen. En helder wat wel en niet mag met klant- en bedrijfsgegevens.', 'veryo' ),
	'<strong>' . __( 'AI-beleid op maat', 'veryo' ) . '</strong><br>' . __( 'Een beleid van één à twee pagina’s dat het team echt leest: welke tools jullie gebruiken, welke gegevens er nooit in gaan en wie verantwoordelijk is. We stellen het samen met je op, op basis van wat in de kansensessie en de training naar voren kwam.', 'veryo' ),
	'<strong>' . __( 'Eén quick win ingericht', 'veryo' ) . '</strong><br>' . __( 'We richten één afgebakende toepassing daadwerkelijk in, bijvoorbeeld conceptantwoorden op veelgestelde vragen of het verwerken van inkoopfacturen. Waar het kan met software die je al hebt. Zo heeft het team direct iets dat werkt, en geen rapport dat in een la verdwijnt.', 'veryo' ),
	'<strong>' . __( '30 dagen nazorg', 'veryo' ) . '</strong><br>' . __( 'Een maand lang een vast aanspreekpunt voor vragen uit het team. Aan het eind evalueren we samen: wat werkt, wat niet, en wat de logische volgende stappen zijn.', 'veryo' ),
);

$veryo_startpakket  = veryo_sec_answer( __( 'Het Veryo AI-Startpakket is de manier om AI in één keer goed en veilig in je bedrijf neer te zetten: een kansensessie met onafhankelijk advies, een training voor het hele team, een AI-beleid op maat, één toepassing die echt werkt en 30 dagen nazorg. Voor MKB-teams tot 50 mensen, vanaf €1.995 exclusief btw.', 'veryo' ) );
$veryo_startpakket .= veryo_sec_text(
	__( 'Iedereen moet iets met AI, maar wat gebeurt er nu al?', 'veryo' ),
	array(
		__( 'In de meeste bedrijven gebruiken medewerkers ChatGPT of een vergelijkbare tool al op eigen houtje. Soms slim, soms niet. De een schrijft er offertes mee, de ander plakt er een klantmail met naam en adres in. Niemand weet precies wat er wordt ingevoerd, en niemand heeft afgesproken wat wel en niet mag.', 'veryo' ),
		__( 'Tegelijk hoor je overal dat je iets met AI moet, maar niet wat, en ook niet wat het kost. Het AI-Startpakket brengt daar in een paar weken rust in: het team snapt wat AI kan, er zijn duidelijke afspraken, en er draait één toepassing die tijd bespaart. Dat is een goede basis om daarna verder te bouwen.', 'veryo' ),
	)
);
$veryo_startpakket .= veryo_sec_photo( __( 'team van een MKB-bedrijf tijdens een AI-training aan tafel', 'veryo' ), __( 'AI-startpakket voor het MKB: training met het hele team', 'veryo' ), 'training' );
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
		__( 'Een team dat AI veilig en nuttig gebruikt, met voorbeelden uit het eigen werk.', 'veryo' ),
		__( 'Een AI-beleid van één à twee pagina’s dat iedereen kent.', 'veryo' ),
		__( 'Eén werkende toepassing die elke week tijd bespaart.', 'veryo' ),
		__( 'Een plan voor de volgende stappen, op volgorde van opbrengst.', 'veryo' ),
	),
	'checks'
);
$veryo_startpakket .= veryo_sec_tiered_price(
	__( 'Wat kost het AI-Startpakket?', 'veryo' ),
	__( 'Een vaste prijs per teamgrootte. De inhoud is voor iedereen gelijk; bij een groter team gaan de training, het beleid en de nazorg over meer mensen.', 'veryo' ),
	veryo_startpakket_prices(),
	sprintf(
		/* translators: %s: link naar prijzen. */
		__( 'Alle prijzen exclusief btw. Je betaalt het pakket één keer; er zit geen software aan vast. Mogelijk is er subsidie via de SLIM-regeling voor het trainingsdeel; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie. <a href="%s">Bekijk alle prijzen</a>.', 'veryo' ),
		esc_url( veryo_link( 'prijzen' ) )
	),
	true
);
$veryo_startpakket .= veryo_sec_ongoing( 'bijblijven' );
$veryo_startpakket .= veryo_sec_text(
	__( 'Het AI-Startpakket en de AI Act', 'veryo' ),
	array(
		__( 'Sinds 2 februari 2025 verplicht de Europese AI Act (artikel 4) organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid van hun medewerkers. Dat geldt ook voor het MKB, en ook als het “alleen” om ChatGPT of Copilot gaat.', 'veryo' ),
		__( 'De wet schrijft geen vast programma voor. De training en het AI-beleid uit het Startpakket zijn concrete stappen om daaraan te werken: medewerkers weten wat AI kan en wat niet, en er zijn afspraken over veilig gebruik. Je krijgt een deelnameoverzicht voor je eigen dossier.', 'veryo' ),
	)
);
$veryo_startpakket .= veryo_sec_text(
	__( 'Wat het AI-Startpakket niet is', 'veryo' ),
	array(),
	array(
		'<strong>' . __( 'Geen software.', 'veryo' ) . '</strong> ' . __( 'We verkopen geen eigen tool. We adviseren onafhankelijk en werken zoveel mogelijk met wat je al hebt.', 'veryo' ),
		'<strong>' . __( 'Geen certificaat.', 'veryo' ) . '</strong> ' . __( 'Er bestaat geen officieel wettelijk certificaat voor AI-geletterdheid. Je krijgt wel een deelnameoverzicht.', 'veryo' ),
		'<strong>' . __( 'Geen verplicht abonnement.', 'veryo' ) . '</strong> ' . __( 'Je betaalt het pakket één keer. Het abonnement Bijblijven loopt de eerste maand kosteloos mee; daarna kies je zelf of je doorgaat.', 'veryo' ),
		'<strong>' . __( 'Geen juridisch advies.', 'veryo' ) . '</strong> ' . __( 'Het AI-beleid is praktisch. Wil je het juridisch laten toetsen, dan raden we een jurist aan.', 'veryo' ),
	)
);
$veryo_startpakket .= veryo_sec_faq(
	array(
		array( __( 'Voor welke bedrijven is het AI-Startpakket?', 'veryo' ), __( 'Voor MKB-bedrijven met een team tot ongeveer 50 mensen die AI goed willen invoeren. Het maakt niet uit of er al iemand met ChatGPT werkt of nog niemand.', 'veryo' ) ),
		array( __( 'Hoe lang duurt het?', 'veryo' ), __( 'Meestal een paar weken, afhankelijk van jullie agenda. De kansensessie en de training zijn elk een halve dag; daarna richten we de quick win in en begint de nazorg van 30 dagen.', 'veryo' ) ),
		array( __( 'Moeten we daarna iets afnemen?', 'veryo' ), __( 'Nee. Je krijgt een plan voor de volgende stappen, en die kun je zelf uitvoeren, met ons of met iemand anders.', 'veryo' ) ),
		array( __( 'Welke AI-tool gaan we gebruiken?', 'veryo' ), __( 'Dat hangt af van jullie werk en de software die je al hebt. We adviseren onafhankelijk; vaak zit er in je bestaande pakketten al meer AI dan je denkt.', 'veryo' ) ),
		array( __( 'Wat als de quick win meer werk is dan verwacht?', 'veryo' ), __( 'Dan kiezen we samen een kleinere quick win binnen het pakket, en krijg je voor de grotere toepassing een aparte vaste prijs. Je betaalt niets wat niet vooraf is afgesproken.', 'veryo' ) ),
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
		array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Alleen de training, zonder de rest', 'veryo' ) ),
		array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Meer over de AI Act', 'veryo' ) ),
		array( 'ai-partner', __( 'AI-partner-abonnement', 'veryo' ), __( 'Na het Startpakket', 'veryo' ) ),
		array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Op locatie in het noorden', 'veryo' ) ),
	)
);

/*
 * AI-partner
 */
$veryo_partner  = veryo_sec_answer( __( 'Als AI-partner voor het MKB is Veryo je vaste vraagbaak voor alles rond AI, in één abonnement: Bijblijven, Werkplek-onderhoud en Veilig blijven, plus elke maand uren voor verbeteringen en nieuwe toepassingen. Het AI-partner-abonnement kost €495 tot €995 per maand, exclusief btw, afhankelijk van je teamgrootte.', 'veryo' ) );
$veryo_partner .= veryo_sec_text(
	__( 'Na de eerste maand valt het vaak stil', 'veryo' ),
	array(
		__( 'De training was goed, het beleid staat op papier en de eerste toepassing draait. Maar dan komt het gewone werk weer. Nieuwe medewerkers weten niet wat er is afgesproken. Copilot of Gemini krijgt een nieuwe functie, maar niemand zet hem aan. En die tweede toepassing waar iedereen enthousiast over was, blijft liggen.', 'veryo' ),
		__( 'Een eigen AI-specialist aannemen is voor een bedrijf met tien of twintig mensen te veel. Met een AI-partner heb je wel iemand die meedenkt, bijhoudt wat er verandert en zorgt dat het niet stilvalt.', 'veryo' ),
	)
);
$veryo_partner .= veryo_sec_photo( __( 'maandelijks overleg aan tafel met laptops', 'veryo' ), __( 'AI-partner voor het MKB: maandelijks overleg met het team', 'veryo' ), 'overleg' );
$veryo_partner .= veryo_sec_text(
	__( 'Wat zit er in het AI-partner-abonnement?', 'veryo' ),
	array( __( 'AI-partner bundelt de drie losse abonnementen en voegt er uren en overleg aan toe.', 'veryo' ) ),
	array(
		'<strong>' . __( 'Bijblijven.', 'veryo' ) . '</strong> ' . __( 'Elk kwartaal een update-sessie, nieuwe medewerkers krijgen toegang tot de Academy, je AI-beleid wordt jaarlijks bijgewerkt en je kunt vragen per mail stellen.', 'veryo' ),
		'<strong>' . __( 'Werkplek-onderhoud.', 'veryo' ) . '</strong> ' . __( 'Nieuwe medewerkers inrichten in Microsoft 365 of Google Workspace, toegangsrechten bijhouden en nieuwe AI-functies beoordelen en aanzetten.', 'veryo' ),
		'<strong>' . __( 'Veilig blijven.', 'veryo' ) . '</strong> ' . __( 'Elke maand een controle van rechten en instellingen, twee keer per jaar een korte bewustwordingssessie, en een beleid dat actueel blijft.', 'veryo' ),
		'<strong>' . __( 'Uren voor verbeteringen.', 'veryo' ) . '</strong> ' . __( 'Vier, zes of tien uur per maand voor kleine verbeteringen en nieuwe toepassingen, afhankelijk van je teamgrootte.', 'veryo' ),
		'<strong>' . __( 'Overleg en voorrang.', 'veryo' ) . '</strong> ' . __( 'Vanaf 11 medewerkers een maandelijks overleg; vanaf 26 medewerkers ook voorrang bij vragen.', 'veryo' ),
	),
	'checks'
);
$veryo_partner .= veryo_b_group(
	veryo_b_h( __( 'Wat kost een AI-partner?', 'veryo' ) )
	. veryo_b_p( __( 'Een vaste maandprijs per teamgrootte, exclusief btw.', 'veryo' ) )
	. veryo_sec_partner_tiers(),
	array( 'className' => 'veryo-partner-prices' )
);
$veryo_partner .= veryo_sec_text(
	__( 'Wat er niet onder AI-partner valt', 'veryo' ),
	array(
		__( 'Onderhoud van koppelingen en agents die we voor je bouwen, valt er niet onder. Dat is apart, omdat het per bedrijf sterk verschilt: €150 tot €500 per maand, afhankelijk van het aantal koppelingen. Grotere projecten krijgen altijd een eigen vaste prijs, zodat het abonnement voorspelbaar blijft.', 'veryo' ),
		__( 'Veryo doet ook geen IT-beheer, hardware, netwerken of helpdesk. Heb je een vaste IT-beheerder, dan werken we graag met die samen.', 'veryo' ),
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
$veryo_partner .= veryo_sec_faq(
	array(
		array( __( 'Moet ik eerst het AI-Startpakket afnemen?', 'veryo' ), __( 'Het hoeft niet, maar het helpt. Zonder basis gaat het eerste deel van de uren op aan wat in het Startpakket zit.', 'veryo' ) ),
		array( __( 'Wat is de looptijd?', 'veryo' ), __( 'AI-partner sluit je af per jaar en wordt maandelijks gefactureerd. Betaal je het jaar vooruit, dan krijg je korting.', 'veryo' ) ),
		array( __( 'Wat als ik mijn uren in een maand niet gebruik?', 'veryo' ), __( 'Die vervallen aan het eind van de maand. In het overleg kijken we samen hoe je de uren het best inzet.', 'veryo' ) ),
		array( __( 'Is AI-partner goedkoper dan losse abonnementen?', 'veryo' ), esc_html( veryo_partner_comparison() ) ),
		array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo doet geen IT-beheer, hardware, netwerken of helpdesk. We werken graag samen met je vaste IT-beheerder.', 'veryo' ) ),
		array( __( 'Komen jullie ook langs?', 'veryo' ), __( 'In Friesland, Groningen en Drenthe kan het overleg op locatie. Elders doen we het online.', 'veryo' ) ),
	)
);
$veryo_partner .= veryo_sec_cta_scan();
$veryo_partner .= veryo_sec_links(
	array(
		array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'De basis vóór het abonnement', 'veryo' ) ),
		array( 'ai-werkplek', __( 'De AI-werkplek', 'veryo' ), __( 'Copilot of Gemini goed ingericht', 'veryo' ) ),
		array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid, rechten en de veiligheidscheck', 'veryo' ) ),
		array( 'prijzen', __( 'Alle prijzen', 'veryo' ), __( 'Pakketten en abonnementen', 'veryo' ) ),
	)
);

return array(
	'ai-startpakket' => array(
		'title'     => __( 'Het Veryo AI-Startpakket', 'veryo' ),
		'seo_title' => __( 'AI-Startpakket: advies, training en beleid | Veryo', 'veryo' ),
		'desc'      => __( 'Het AI-startpakket voor het MKB: kansensessie, teamtraining, AI-beleid op maat, één quick win en 30 dagen nazorg. Vaste prijs, vanaf €1.995 excl. btw.', 'veryo' ),
		'kw'        => 'ai startpakket mkb',
		'schema'    => array(
			'type' => 'startpakket',
			'min'  => 1995,
			'max'  => 4495,
		),
		'content'   => $veryo_startpakket,
	),
	'ai-partner'     => array(
		'title'     => __( 'AI-partner: vaste vraagbaak voor AI', 'veryo' ),
		'seo_title' => __( 'AI-partner voor het MKB: maandelijks abonnement | Veryo', 'veryo' ),
		'desc'      => __( 'AI-partner voor het MKB: bijblijven, werkplek-onderhoud en veilig blijven in één abonnement, plus uren voor verbeteringen. €495–995 per maand excl. btw.', 'veryo' ),
		'kw'        => 'ai partner mkb',
		'schema'    => array(
			'type' => 'partner',
			'min'  => 495,
			'max'  => 995,
		),
		'content'   => $veryo_partner,
	),
);
