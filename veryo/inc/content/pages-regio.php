<?php
/**
 * Regiopagina's: Friesland, Groningen, Drenthe en Leeuwarden.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Blok "Plaatsen waar we komen".
 *
 * @param string   $intro  Inleiding.
 * @param string[] $places Plaatsen.
 * @return array<string,mixed>
 */
$veryo_places = static function ( $intro, $places ) {
	return array(
		'h'     => __( 'Waar we werken', 'veryo' ),
		'p'     => array( $intro ),
		'list'  => $places,
		'style' => 'places',
	);
};

return array(

	/* ------------------------------------------------------------------------- */
	'ai-adviseur-friesland' => array(
		'title'     => __( 'AI-adviseur in Friesland voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-adviseur Friesland: AI voor het Friese mkb | Veryo', 'veryo' ),
		'desc'      => __( 'AI-adviseur in Friesland: Veryo uit Leeuwarden bouwt AI-agents en automatiseringen voor technische bedrijven in Friesland. Plan een kennismaking.', 'veryo' ),
		'kw'        => 'ai adviseur friesland',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Friesland',
		),
		'content'   => veryo_page_standard(
			array(
				'collega_regio' => 'friesland',
				'answer_cta'    => array( __( 'Plan een kennismaking', 'veryo' ), '#vraag', 'amber' ),
				'answer'        => __( 'Veryo is een AI-adviseur in Friesland, gevestigd in Leeuwarden. We brengen AI voor het mkb in Friesland naar de praktijk: AI-agents, automatiseringen bovenop jullie eigen software, het inrichten van Claude Team en Veryo Collega, de lokale AI-assistent. Training hoort bij de oplevering: na de oplevering leren we jullie team ermee werken. Daarvoor komen we gewoon langs. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'problem'       => array(
					'h' => __( 'AI voor het Friese MKB, zonder poespas', 'veryo' ),
					'p' => array(
						__( 'Friese ondernemers zijn niet snel onder de indruk. Dat is maar goed ook, want over AI wordt veel beloofd. Wat we in de provincie vooral horen: “Ik lees er overal over, maar wat moet ik er in mijn bedrijf mee?” Een bouwbedrijf in Drachten heeft andere vragen dan een recreatiepark aan de kust of een loonwerker in de Friese Wouden.', 'veryo' ),
						__( 'Als AI-bureau in Friesland beginnen we daarom bij je werk. Waar gaat de tijd heen? Welke software gebruik je? Wat ergert je team het meest? Pas daarna kijken we wat AI kan doen, en wat het oplevert in uren en euro’s.', 'veryo' ),
					),
				),
				'photo'         => array( __( 'bedrijfspand op een Fries bedrijventerrein met een busje van een installateur ervoor', 'veryo' ), __( 'AI-adviseur in Friesland op bezoek bij een MKB-bedrijf', 'veryo' ), 'landschap' ),
				'sections'      => array(
					array(
						'h'    => __( 'Sectoren waar we in Friesland op focussen', 'veryo' ),
						'list' => array(
							'<strong>' . __( 'Bouw en installatie.', 'veryo' ) . '</strong> ' . __( 'Offertes, werkbonnen, meerwerk en planning. Vaak de plek met de meeste tijdwinst.', 'veryo' ),
							'<strong>' . __( 'Agri en mechanisatie.', 'veryo' ) . '</strong> ' . __( 'Onderhoud en keuringen plannen, onderdelen bestellen en het seizoenswerk organiseren.', 'veryo' ),
							'<strong>' . __( 'Recreatie en toerisme.', 'veryo' ) . '</strong> ' . __( 'Vragen van gasten beantwoorden, reviews opvolgen en berichten in het Duits en Engels.', 'veryo' ),
							'<strong>' . __( 'Zakelijke dienstverlening.', 'veryo' ) . '</strong> ' . __( 'Verslagen, samenvattingen en een interne assistent op eigen kennis.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Een voorbeeld van een toepassing', 'veryo' ),
						'p' => array( __( 'Een recreatiebedrijf aan het IJsselmeer krijgt in het seizoen veel dezelfde vragen via mail en WhatsApp, deels in het Duits. Met een WhatsApp-assistent die antwoordt in de taal van de gast, en conceptantwoorden op mail, kan de receptie zich richten op de gasten aan de balie. Dit is een voorbeeld van wat kan, geen klantcase.', 'veryo' ) ),
					),
					array(
						'h' => __( 'AI voor het mkb in Friesland: waar je begint', 'veryo' ),
						'p' => array(
							__( 'De eerste stap is meestal klein: één automatisering voor het werk dat elke week terugkomt. Bedrijven die veel kennis in een paar hoofden hebben, kiezen voor Veryo Collega, een lokale AI-assistent die op het eigen kantoor draait. Vanuit Leeuwarden zijn we snel in Sneek, Heerenveen, Drachten of Harlingen voor een kennismaking.', 'veryo' ),
						),
					),
					array(
						'html' => veryo_sec_local(
							__( 'Zo werken we in Friesland', 'veryo' ),
							array(
								__( 'Kennismaking bij jullie op kantoor, of eerst online als dat makkelijker is.', 'veryo' ),
								__( 'Na de oplevering leren we jullie team ermee werken, op jullie eigen locatie.', 'veryo' ),
								__( 'Inrichten en testen samen met jullie team, met korte lijnen via telefoon en mail.', 'veryo' ),
								__( 'Geen reiskosten binnen Noord-Nederland.', 'veryo' ),
							)
						),
					),
					$veryo_places(
						__( 'Vanuit Leeuwarden zijn we snel in heel Friesland. We werken voor bedrijven in Leeuwarden, Drachten, Heerenveen en Sneek, en komen op locatie voor de kansensessie, het inrichten en de oplevering.', 'veryo' ),
						array( 'Leeuwarden', 'Drachten', 'Heerenveen', 'Sneek', 'Harlingen', 'Dokkum', __( 'en de rest van Friesland, ook de Waddeneilanden in overleg', 'veryo' ) )
					),
				),
				'catalog'       => array(
					'h'   => __( 'Veelgevraagd in Friesland', 'veryo' ),
					'ids' => array( 'offerte-generator', 'digitale-werkbon', 'onderhoudsplanning', 'whatsapp-assistent', 'vertalen' ),
				),
				'price'         => array( 'steps' => array( 'scan', 'startpakket', 'quickwin' ) ),
				'faq'           => array(
					array( __( 'Werken jullie ook in Drachten, Heerenveen en Sneek?', 'veryo' ), __( 'Ja. Drachten, Heerenveen en Sneek liggen op een half uur tot drie kwartier rijden van Leeuwarden. We komen langs voor de kennismaking, het inrichten en de oplevering; tussendoor overleggen we vaak online.', 'veryo' ) ),
					array( __( 'Komen jullie op locatie in heel Friesland?', 'veryo' ), __( 'Ja. Vanuit Leeuwarden komen we in heel de provincie langs, van Harlingen tot Oosterwolde en van Dokkum tot Lemmer. Voor de eilanden maken we een afspraak op maat.', 'veryo' ) ),
					array( __( 'Geven jullie ook AI-trainingen?', 'veryo' ), __( 'Niet als los product. Wel leren we na de oplevering jullie team werken met wat we hebben gebouwd of ingericht.', 'veryo' ) ),
					array( __( 'Werken jullie ook met kleine bedrijven?', 'veryo' ), __( 'Ja. Een groot deel van het Friese MKB bestaat uit bedrijven met twee tot twintig mensen. Juist daar kan één goede automatisering veel schelen.', 'veryo' ) ),
					array( __( 'Kunnen berichten ook in het Duits of Fries?', 'veryo' ), __( 'Vertalen naar Duits en Engels werkt goed, handig voor toerisme en export. Fries is minder vanzelfsprekend voor AI-modellen; dat testen we per toepassing.', 'veryo' ) ),
					array( __( 'Wat kost een AI-adviseur in Friesland?', 'veryo' ), __( 'De AI-scan is gratis. In Noord-Nederland rekenen we geen reiskosten. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) ),
				),
				'cta_demo'      => true,
				'cta'           => array( __( 'Friese ondernemer? Maak kennis', 'veryo' ), __( 'Plan een gratis kennismaking, bij jullie op kantoor of online. Liever eerst zelf kijken? Doe dan de gratis AI-scan.', 'veryo' ) ),
				'links'         => array(
					array( 'leeuwarden', __( 'AI-agents en automatisering in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ),
					array( 'branches/agri', __( 'AI in de landbouw', 'veryo' ), __( 'Voor agrarische bedrijven en mechanisatie', 'veryo' ) ),
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Offertes, werkbonnen, storingen', 'veryo' ) ),
					array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
					array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Welke processen je kunt automatiseren', 'veryo' ) ),
					array( 'contact', __( 'Contact', 'veryo' ), __( 'Bel, mail of plan een afspraak', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-adviseur-groningen' => array(
		'title'     => __( 'AI-adviseur in Groningen voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-adviseur Groningen: AI-agents en automatisering | Veryo', 'veryo' ),
		'desc'      => __( 'AI-adviseur in Groningen: AI-agents, automatisering en Claude Team voor technische bedrijven in stad en provincie, op locatie. Plan een kennismaking.', 'veryo' ),
		'kw'        => 'ai adviseur groningen',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Groningen',
		),
		'content'   => veryo_page_standard(
			array(
				'collega_regio' => 'groningen',
				'answer'        => __( 'Veryo is een AI-adviseur voor het MKB in Groningen, in de stad en de provincie. Vanuit Leeuwarden komen we op locatie om AI-agents, automatiseringen en de AI-werkplek met Claude Team te bouwen en in te richten. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'problem'       => array(
					'h' => __( 'Groningse bedrijven en AI: veel kennis om je heen, weinig tijd', 'veryo' ),
					'p' => array(
						__( 'In Groningen is AI-kennis nooit ver weg, met de universiteit, de hogeschool en een flinke techsector in de stad. Maar voor een technisch bedrijf in Veendam of een logistieke dienstverlener bij Delfzijl voelt dat vaak ver van de dagelijkse praktijk. Onderzoek en prototypes zijn iets anders dan een automatisering die maandagochtend gewoon werkt.', 'veryo' ),
						__( 'Als AI-bureau voor Groningen richten we ons op dat laatste: praktische toepassingen die in je eigen software draaien, met een vaste prijs en iemand die ze onderhoudt.', 'veryo' ),
					),
				),
				'photo'         => array( __( 'logistiek bedrijf in de Eemshaven-regio met vrachtwagens aan het dock', 'veryo' ), __( 'AI-adviseur in Groningen bij een logistiek bedrijf', 'veryo' ), 'logistiek' ),
				'sections'      => array(
					array(
						'h'    => __( 'Waar we Groningse bedrijven mee helpen', 'veryo' ),
						'list' => array(
							'<strong>' . __( 'Techniek en maakindustrie.', 'veryo' ) . '</strong> ' . __( 'Offertes en calculaties, technische documentatie doorzoekbaar maken, storingen triageren.', 'veryo' ),
							'<strong>' . __( 'Logistiek en transport.', 'veryo' ) . '</strong> ' . __( 'Planningsvoorstellen, automatische statusberichten en vrachtdocumenten archiveren.', 'veryo' ),
							'<strong>' . __( 'Zakelijke dienstverlening.', 'veryo' ) . '</strong> ' . __( 'Gespreksverslagen, documenten samenvatten en een interne assistent op eigen kennis.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Waar je begint in Groningen', 'veryo' ),
						'p' => array(
							__( 'We beginnen met een kennismaking bij jullie op locatie en kijken samen naar het werk dat de meeste tijd kost. Voor een ingenieurs- of adviesbureau is dat vaak het voorbereidende werk: bestekken lezen, uitgangspunten controleren en rapportages schrijven. Daar past de AI-werkplek met Claude Team bij. Voor een installateur of projectbedrijf zit het eerder in de administratieve kringloop, van werkbon tot factuur.', 'veryo' ),
							__( 'Na de oplevering leren we jullie team ermee werken, bij jullie op locatie.', 'veryo' ),
						),
					),
					$veryo_places(
						__( 'Groningen ligt op ongeveer een uur rijden van Leeuwarden. We werken voor bedrijven in de stad Groningen, Leek en Winschoten en de rest van de provincie. Afspraken plannen we zo dat we er efficiënt kunnen zijn, en voor veel overleg werkt online ook prima.', 'veryo' ),
						array( __( 'Groningen stad', 'veryo' ), 'Leek', 'Winschoten', 'Veendam', 'Hoogezand', 'Delfzijl', __( 'en de rest van de provincie Groningen', 'veryo' ) )
					),
				),
				'catalog'       => array(
					'h'   => __( 'Veelgevraagd in Groningen', 'veryo' ),
					'ids' => array( 'planningsassistent', 'statusberichten', 'technische-documentatie', 'gespreksverslagen', 'dashboard' ),
				),
				'price'         => array( 'steps' => array( 'scan', 'startpakket', 'project' ) ),
				'faq'           => array(
					array( __( 'Werken jullie ook in Leek en Winschoten?', 'veryo' ), __( 'Ja. Leek ligt aan de kant van Friesland, Winschoten in het oosten van de provincie. In beide plaatsen komen we op locatie voor de kennismaking, het inrichten en de oplevering.', 'veryo' ) ),
					array( __( 'Komen jullie ook in de stad Groningen?', 'veryo' ), __( 'Ja, in de stad en in de hele provincie. Voor een kansensessie, het inrichten of de oplevering komen we op locatie.', 'veryo' ) ),
					array( __( 'Rekenen jullie reiskosten voor Groningen?', 'veryo' ), __( 'Nee. In Friesland, Groningen en Drenthe rekenen we geen reiskosten. Dat zit in de vaste prijs.', 'veryo' ) ),
					array( __( 'Werken jullie samen met Groningse onderwijsinstellingen?', 'veryo' ), __( 'Op dit moment niet. We richten ons op praktische toepassingen voor het MKB.', 'veryo' ) ),
					array( __( 'Geven jullie ook AI-trainingen?', 'veryo' ), __( 'Niet als los product. Wel leren we na de oplevering jullie team werken met wat we hebben gebouwd of ingericht.', 'veryo' ) ),
					array( __( 'Is een AI-adviseur in Groningen niet dichterbij?', 'veryo' ), __( 'Misschien wel. Het verschil zit in de aanpak: wij adviseren, bouwen en onderhouden, met vaste prijzen. Kies wat bij je past.', 'veryo' ) ),
				),
				'cta'           => array( __( 'Groningse ondernemer? Doe de AI-scan', 'veryo' ), '' ),
				'links'         => array(
					array( 'branches/transport', __( 'AI in de logistiek', 'veryo' ), __( 'Planning en statusberichten', 'veryo' ) ),
					array( 'branches/zakelijke-dienstverlening', __( 'AI voor accountants en adviesbureaus', 'veryo' ), __( 'Verslagen en kennis', 'veryo' ) ),
					array( 'ai-implementatie-mkb', __( 'AI implementatie in het mkb', 'veryo' ), __( 'Van plan tot live', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Assen, Emmen, Hoogeveen, Meppel', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-adviseur-drenthe'   => array(
		'title'       => __( 'AI en automatisering voor bedrijven in Drenthe', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI-automatisering voor bedrijven in Drenthe | Veryo', 'veryo' ),
		'desc'        => __( 'AI-adviseur in Drenthe: AI-agents en automatisering voor technische bedrijven in Assen, Emmen, Meppel en Hoogeveen. Plan een gratis kennismaking.', 'veryo' ),
		'kw'          => 'ai adviseur drenthe',
		'schema'      => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Drenthe',
		),
		'content'     => veryo_page_standard(
			array(
				'collega_regio' => 'drenthe',
				'answer'        => __( 'Veryo is een AI-adviseur voor het MKB in Drenthe. We helpen bedrijven in Assen, Emmen, Hoogeveen, Meppel en omgeving met AI en automatisering: AI-agents, automatiseringen bovenop jullie eigen software, de AI-werkplek met Claude Team en de administratieve kringloop. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'extra'         => array( __( 'Waar je begint in Drenthe', 'veryo' ), array( __( 'We komen langs voor een kennismaking en een korte ronde door de werkplaats en het kantoor. Aan het eind ligt er een lijst met de automatiseringen die het meeste opleveren, en de eerste die we bouwen. Na de oplevering leren we jullie team ermee werken.', 'veryo' ) ) ),
				'problem'       => array(
					'h' => __( 'Drentse maakbedrijven, boeren en installateurs', 'veryo' ),
					'p' => array(
						__( 'Drenthe heeft een sterke basis van maakindustrie, agrarische bedrijven en installatietechniek. Bedrijven waar het echte werk in de werkplaats, op het land of bij de klant gebeurt, en waar het kantoorwerk vaak op de schouders van één of twee mensen ligt.', 'veryo' ),
						__( 'Juist daar kan AI-automatisering in Drenthe veel schelen. Niet door de werkplaats te veranderen, maar door het werk eromheen lichter te maken: de offertes, de onderhoudsplanning, de bestellingen en de administratie.', 'veryo' ),
					),
				),
				'photo'         => array( __( 'werkplaats van een Drents metaalbedrijf met een medewerker aan een tablet', 'veryo' ), __( 'AI-adviseur in Drenthe bij een maakbedrijf', 'veryo' ), 'werkplaats' ),
				'sections'      => array(
					array(
						'h'    => __( 'AI-automatisering in Drenthe: waar het meestal zit', 'veryo' ),
						'list' => array(
							'<strong>' . __( 'Agri.', 'veryo' ) . '</strong> ' . __( 'Onderhoud en keuringen van machines plannen, onderdelen bestellen, projectfoto’s omzetten in posts voor de website.', 'veryo' ),
							'<strong>' . __( 'Maakindustrie.', 'veryo' ) . '</strong> ' . __( 'Calculaties en offertes, technische documentatie doorzoekbaar maken, nacalculatie per order.', 'veryo' ),
							'<strong>' . __( 'Installatie.', 'veryo' ) . '</strong> ' . __( 'Digitale werkbon, van werkbon naar factuur en WhatsApp bij storingen.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Een voorbeeld', 'veryo' ),
						'p' => array( __( 'Een mechanisatiebedrijf bij Emmen houdt de keuringsdata van machines van klanten bij in een Excel. Met een automatische onderhouds- en keuringsplanning krijgt de klant op tijd een uitnodiging, wordt de afspraak ingepland en staat de onderdelenbestelling klaar. Dit is een voorbeeld van wat kan, geen klantcase.', 'veryo' ) ),
					),
					array(
						'h' => __( 'Automatisering voor bedrijven in Emmen, Meppel en Assen', 'veryo' ),
						'p' => array(
							__( 'Automatisering voor je bedrijf in Drenthe begint bij het werk dat elke week terugkomt. In Emmen en omgeving zien we veel maakindustrie en techniek: offertes, werkvoorbereiding en onderhoudsplanning. Rond Meppel en Hoogeveen veel bouw, transport en installatie, met planning, werkbonnen en inkoopfacturen. In Assen vooral zakelijke dienstverlening, waar gespreksverslagen en documenten de meeste tijd kosten.', 'veryo' ),
							__( 'Waar je ook zit, de aanpak is hetzelfde: we komen langs voor een kennismaking, zoeken samen de grootste tijdvreter en automatiseren die bovenop de software die je al gebruikt. Voor kennis die in een paar hoofden zit, is er Veryo Collega: een lokale AI-assistent op jullie eigen kantoor.', 'veryo' ),
						),
					),
					$veryo_places(
						__( 'Assen ligt op ongeveer een uur rijden van Leeuwarden, Emmen iets verder. We werken voor bedrijven in Assen, Emmen en Hoogeveen en de rest van Drenthe, en komen op locatie voor kansensessies, het inrichten en opleveringen.', 'veryo' ),
						array( 'Assen', 'Emmen', 'Hoogeveen', 'Meppel', __( 'en de rest van Drenthe', 'veryo' ) )
					),
				),
				'catalog'       => array(
					'h'   => __( 'Veelgevraagd in Drenthe', 'veryo' ),
					'ids' => array( 'onderhoudsplanning', 'inkoop-bestellingen', 'calculatietool', 'nacalculatie', 'projectfotos' ),
				),
				'price'         => array( 'steps' => array( 'scan', 'startpakket', 'quickwin', 'project' ) ),
				'faq'           => array(
					array( __( 'Komen jullie in heel Drenthe?', 'veryo' ), __( 'Ja. We komen in Assen, Emmen, Hoogeveen, Meppel en alles daartussen, voor kansensessies, het inrichten en opleveringen.', 'veryo' ) ),
					array( __( 'Is Veryo een AI-consultancy voor Drentse bedrijven?', 'veryo' ), __( 'Ja, maar dan praktisch: we adviseren niet alleen, we richten de automatisering ook in bovenop de tools die je al gebruikt en leren je team ermee werken. Voor bedrijven in Assen, Emmen, Hoogeveen en de rest van Drenthe.', 'veryo' ) ),
					array( __( 'Werken jullie ook voor agrarische bedrijven?', 'veryo' ), __( 'Ja. Agri en mechanisatie is een van de sectoren die we het best kennen, van loonwerk tot machinehandel.', 'veryo' ) ),
					array( __( 'Wat betekent de afstand voor de prijs?', 'veryo' ), __( 'Niets. In Friesland, Groningen en Drenthe rekenen we geen reiskosten. Je krijgt vooraf een vaste prijs.', 'veryo' ) ),
					array( __( 'Geven jullie ook AI-trainingen?', 'veryo' ), __( 'Niet als los product. Wel leren we na de oplevering jullie team werken met wat we hebben gebouwd of ingericht.', 'veryo' ) ),
				),
				'cta'           => array( __( 'Drents bedrijf? Zie wat AI je oplevert', 'veryo' ), '' ),
				'links'         => array(
					array( 'branches/agri', __( 'AI in de landbouw', 'veryo' ), __( 'Agrarische bedrijven en mechanisatie', 'veryo' ) ),
					array( 'ai-automatisering/offertes-en-calculaties', __( 'Offertes en calculaties automatiseren', 'veryo' ), __( 'Voor maakbedrijven', 'veryo' ) ),
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Onze thuisprovincie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'leeuwarden'            => array(
		'title'       => __( 'AI-agents en automatisering in Leeuwarden', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI-agents en automatisering in Leeuwarden | Veryo', 'veryo' ),
		'desc'        => __( 'Veryo is gevestigd in Leeuwarden en bouwt AI-agents, automatiseringen en de AI-werkplek met Claude Team voor technische bedrijven in de stad en omgeving.', 'veryo' ),
		'kw'          => 'ai en automatisering leeuwarden',
		'schema'      => array(
			'type' => 'service',
			'area' => 'Friesland',
		),
		'content'     => veryo_page_standard(
			array(
				'collega_regio' => 'leeuwarden',
				'answer_cta'    => array( __( 'Plan een afspraak in Leeuwarden', 'veryo' ), '#vraag', 'amber' ),
				'answer'        => __( 'Veryo zit in Leeuwarden en helpt mkb-bedrijven in de stad en omgeving AI praktisch inzetten: AI-agents, automatiseringen bovenop de systemen die jullie al hebben, de AI-werkplek met Claude Team en de administratieve kringloop. Leeuwarden is onze thuisbasis, dus langskomen is zo geregeld. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
				'problem'       => array(
					'h' => __( 'Een AI-specialist in Leeuwarden, om de hoek', 'veryo' ),
					'p' => array(
						__( 'Voor een Leeuwarder bedrijf is het prettig als de AI-specialist niet uit de Randstad hoeft te komen. Even langskomen voor een kop koffie, een vervolgafspraak zonder reisdag, en iemand die weet hoe het er hier aan toe gaat.', 'veryo' ),
						__( 'Op de bedrijventerreinen rond de stad zitten technische bedrijven, installateurs en adviesbureaus waar engineers en kantoor veel tijd kwijt zijn aan lezen, overtypen en uitzoeken. Allemaal met dezelfde vraag: hoe zet ik AI in zonder dat het een project van een jaar wordt?', 'veryo' ),
					),
				),
				'photo'         => array( __( 'overleg aan tafel op kantoor in Leeuwarden', 'veryo' ), __( 'AI-automatisering in Leeuwarden: overleg op kantoor', 'veryo' ), 'overleg' ),
				'sections'      => array(
					array(
						'h'    => __( 'Wat we bouwen en inrichten in Leeuwarden', 'veryo' ),
						'list' => array(
							'<strong><a href="' . esc_url( veryo_link( 'ai-werkplek' ) ) . '">' . __( 'Claude Team inrichten', 'veryo' ) . '</a>.</strong> ' . __( 'Bestek lezen, calculatieopzet, uitgangspunten controleren en rapportages, met jullie eigen normen en templates.', 'veryo' ),
							'<strong><a href="' . esc_url( veryo_link( 'ai-automatisering/administratie' ) ) . '">' . __( 'De administratieve kringloop', 'veryo' ) . '</a>.</strong> ' . __( 'Uren en werkbonnen inlezen, inkoopfacturen aan projecten koppelen en de weekafsluiting met conceptfacturen.', 'veryo' ),
							'<strong><a href="' . esc_url( veryo_link( 'ai-agents' ) ) . '">' . __( 'AI-agents voor bedrijven', 'veryo' ) . '</a>.</strong> ' . __( 'Digitale collega’s die aanvragen, meldingen en mail voorbereiden in jullie eigen systemen.', 'veryo' ),
							'<strong><a href="' . esc_url( veryo_link( 'ai-automatisering' ) ) . '">' . __( 'AI automatisering voor het mkb', 'veryo' ) . '</a>.</strong> ' . __( 'Koppelingen tussen de software die jullie al gebruiken. Overstappen is nooit nodig.', 'veryo' ),
						),
					),
					array(
						'html' => veryo_sec_local(
							__( 'Zo werken we in Leeuwarden', 'veryo' ),
							array(
								__( 'Even langskomen voor een kort overleg kan, op afspraak: we zijn vaak onderweg.', 'veryo' ),
								__( 'Inrichten en testen bij jullie op kantoor, met jullie eigen gegevens.', 'veryo' ),
								__( 'Een vervolgafspraak zonder reisdag: we zitten om de hoek.', 'veryo' ),
								__( 'Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
							)
						),
					),
					$veryo_places(
						__( 'In en rond Leeuwarden komen we overal, ook voor een kort overleg. Vanuit Leeuwarden werken we ook voor bedrijven in Drachten, Heerenveen en Sneek.', 'veryo' ),
						array( __( 'Binnenstad', 'veryo' ), __( 'Bedrijventerreinen De Zwette en Hemrik', 'veryo' ), 'Stiens', 'Grou', 'Dronryp', 'Wirdum' )
					),
				),
				'catalog'       => array(
					'h'   => __( 'Veelgevraagd in Leeuwarden', 'veryo' ),
					'ids' => array( 'inkoopfacturen', 'werkbon-factuur', 'offerte-generator', 'documenten-samenvatten', 'mail-concepten' ),
				),
				'price'         => array( 'steps' => array( 'startpakket', 'quickwin' ) ),
				'faq'           => array(
					array( __( 'Werken jullie alleen in Leeuwarden?', 'veryo' ), __( 'Nee. Leeuwarden is onze thuisbasis, maar we werken in heel Friesland, Groningen en Drenthe op locatie, en online in de rest van Nederland.', 'veryo' ) ),
					array( __( 'Kan ik gewoon even langskomen?', 'veryo' ), __( 'Graag, maar maak even een afspraak, want we zijn vaak onderweg.', 'veryo' ) ),
					array( __( 'Geven jullie ook AI-trainingen in Leeuwarden?', 'veryo' ), __( 'Niet als los product. Wel leren we na de oplevering jullie team werken met wat we hebben gebouwd of ingericht.', 'veryo' ) ),
					array( __( 'Wat kost het?', 'veryo' ), __( 'Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) ),
				),
				'cta_demo'      => true,
				'cta'           => array( __( 'Uit Leeuwarden? Kom kennismaken', 'veryo' ), __( 'Plan een gratis kennismaking bij jullie op kantoor of bij ons in de stad. Liever eerst zelf kijken? Doe de gratis AI-scan.', 'veryo' ) ),
				'links'         => array(
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Voor de hele provincie', 'veryo' ) ),
					array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
					array( 'contact', __( 'Contact', 'veryo' ), __( 'Bel, mail of plan een afspraak', 'veryo' ) ),
					array( 'over-veryo', __( 'Over Veryo', 'veryo' ), __( 'Wie we zijn', 'veryo' ) ),
				),
			)
		),
	),
);
