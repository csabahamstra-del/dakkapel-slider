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
		'h'     => __( 'Plaatsen waar we komen', 'veryo' ),
		'p'     => array( $intro ),
		'list'  => $places,
		'style' => 'places',
	);
};

return array(

	/* ------------------------------------------------------------------------- */
	'ai-adviseur-friesland' => array(
		'title'     => __( 'AI-adviseur in Friesland voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-adviseur in Friesland voor het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'AI-adviseur in Friesland: Veryo uit Leeuwarden helpt het Friese MKB met AI-automatisering en AI-training, op locatie. Vaste prijzen, vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'ai adviseur friesland',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Friesland',
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo is een AI-adviseur in Friesland, gevestigd in Leeuwarden. We helpen Friese MKB-bedrijven met AI-automatisering, AI-training en AI op maat, en komen daarvoor gewoon langs. Een eerste automatisering kost €750 tot €1.500, een incompany training vanaf €1.200, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'AI voor het Friese MKB, zonder poespas', 'veryo' ),
					'p' => array(
						__( 'Friese ondernemers zijn niet snel onder de indruk. Dat is maar goed ook, want over AI wordt veel beloofd. Wat we in de provincie vooral horen: “Ik lees er overal over, maar wat moet ik er in mijn bedrijf mee?” Een bouwbedrijf in Drachten heeft andere vragen dan een recreatiepark aan de kust of een loonwerker in de Friese Wouden.', 'veryo' ),
						__( 'Als AI-bureau in Friesland beginnen we daarom bij je werk. Waar gaat de tijd heen? Welke software gebruik je? Wat ergert je team het meest? Pas daarna kijken we wat AI kan doen, en wat het oplevert in uren en euro’s.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'bedrijfspand op een Fries bedrijventerrein met een busje van een installateur ervoor', 'veryo' ), __( 'AI-adviseur in Friesland op bezoek bij een MKB-bedrijf', 'veryo' ) ),
				'sections' => array(
					array(
						'h'    => __( 'Sectoren die we in Friesland veel zien', 'veryo' ),
						'list' => array(
							'<strong>' . __( 'Bouw en installatie.', 'veryo' ) . '</strong> ' . __( 'Offertes, werkbonnen, meerwerk en planning. Vaak de plek met de meeste tijdwinst.', 'veryo' ),
							'<strong>' . __( 'Agri en mechanisatie.', 'veryo' ) . '</strong> ' . __( 'Onderhoud en keuringen plannen, onderdelen bestellen en het seizoenswerk organiseren.', 'veryo' ),
							'<strong>' . __( 'Recreatie en toerisme.', 'veryo' ) . '</strong> ' . __( 'Vragen van gasten beantwoorden, reviews opvolgen en berichten in het Duits en Engels.', 'veryo' ),
							'<strong>' . __( 'Zakelijke dienstverlening.', 'veryo' ) . '</strong> ' . __( 'Verslagen, samenvattingen en een interne assistent op eigen kennis.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Een voorbeeld uit de praktijk', 'veryo' ),
						'p' => array( __( 'Een recreatiebedrijf aan het IJsselmeer krijgt in het seizoen veel dezelfde vragen via mail en WhatsApp, deels in het Duits. Met een WhatsApp-assistent die antwoordt in de taal van de gast, en conceptantwoorden op mail, kan de receptie zich richten op de gasten aan de balie. Dit is een voorbeeld van wat kan, geen klantcase.', 'veryo' ) ),
					),
					$veryo_places(
						__( 'Vanuit Leeuwarden zijn we snel in heel Friesland. We komen op locatie voor de kansensessie, de training en de oplevering.', 'veryo' ),
						array( 'Leeuwarden', 'Heerenveen', 'Sneek', 'Drachten', 'Harlingen', 'Dokkum', __( 'en de rest van Friesland, ook de Waddeneilanden in overleg', 'veryo' ) )
					),
				),
				'catalog'  => array(
					'h'   => __( 'Veelgevraagd in Friesland', 'veryo' ),
					'ids' => array( 'offerte-generator', 'digitale-werkbon', 'onderhoudsplanning', 'whatsapp-assistent', 'vertalen' ),
				),
				'price'    => array( 'steps' => array( 0, 2, 3, 4 ) ),
				'faq'      => array(
					array( __( 'Komen jullie op locatie in heel Friesland?', 'veryo' ), __( 'Ja. Vanuit Leeuwarden komen we in heel de provincie langs, van Harlingen tot Oosterwolde en van Dokkum tot Lemmer. Voor de eilanden maken we een afspraak op maat.', 'veryo' ) ),
					array( __( 'Kunnen jullie een AI-training in Friesland geven?', 'veryo' ), __( 'Ja, bij jou op locatie of in Leeuwarden. Een halve dag voor maximaal twintig mensen kost €1.200 exclusief btw.', 'veryo' ) ),
					array( __( 'Werken jullie ook met kleine bedrijven?', 'veryo' ), __( 'Ja. Een groot deel van het Friese MKB bestaat uit bedrijven met twee tot twintig mensen. Juist daar kan één goede automatisering veel schelen.', 'veryo' ) ),
					array( __( 'Kunnen berichten ook in het Duits of Fries?', 'veryo' ), __( 'Vertalen naar Duits en Engels werkt goed, handig voor toerisme en export. Fries is minder vanzelfsprekend voor AI-modellen; dat testen we per toepassing.', 'veryo' ) ),
					array( __( 'Wat kost een AI-adviseur in Friesland?', 'veryo' ), __( 'De AI-scan is gratis. Een kansensessie met roadmap kost €750 tot €1.500, een eerste automatisering €750 tot €1.500. Eventuele reiskosten staan altijd vooraf in de offerte. Alles exclusief btw.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Friese ondernemer? Begin met de AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'leeuwarden', __( 'AI-training en automatisering in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ),
					array( 'branches/agri', __( 'AI in de landbouw', 'veryo' ), __( 'Voor agrarische bedrijven en mechanisatie', 'veryo' ) ),
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Offertes, werkbonnen, storingen', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Incompany, halve of hele dag', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-adviseur-groningen' => array(
		'title'     => __( 'AI-adviseur in Groningen voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-adviseur in Groningen voor het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'AI-adviseur in Groningen: Veryo helpt het MKB in stad en provincie met AI-automatisering, AI-training en AI op maat. Vaste prijzen, vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'ai adviseur groningen',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Groningen',
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo is een AI-adviseur voor het MKB in Groningen, in de stad en de provincie. Vanuit Leeuwarden komen we op locatie voor AI-automatisering, AI-training en AI op maat. De gratis AI-scan is een goed begin; een eerste automatisering kost €750 tot €1.500 en een training vanaf €1.200, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Groningse bedrijven en AI: veel kennis om je heen, weinig tijd', 'veryo' ),
					'p' => array(
						__( 'In Groningen is AI-kennis nooit ver weg, met de universiteit, de hogeschool en een flinke techsector in de stad. Maar voor een technisch bedrijf in Veendam of een logistieke dienstverlener bij Delfzijl voelt dat vaak ver van de dagelijkse praktijk. Onderzoek en prototypes zijn iets anders dan een automatisering die maandagochtend gewoon werkt.', 'veryo' ),
						__( 'Als AI-bureau voor Groningen richten we ons op dat laatste: praktische toepassingen die in je eigen software draaien, met een vaste prijs en iemand die ze onderhoudt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'logistiek bedrijf in de Eemshaven-regio met vrachtwagens aan het dock', 'veryo' ), __( 'AI-adviseur in Groningen bij een logistiek bedrijf', 'veryo' ) ),
				'sections' => array(
					array(
						'h'    => __( 'Waar we Groningse bedrijven mee helpen', 'veryo' ),
						'list' => array(
							'<strong>' . __( 'Techniek en maakindustrie.', 'veryo' ) . '</strong> ' . __( 'Offertes en calculaties, technische documentatie doorzoekbaar maken, storingen triageren.', 'veryo' ),
							'<strong>' . __( 'Logistiek en transport.', 'veryo' ) . '</strong> ' . __( 'Planningsvoorstellen, automatische statusberichten en vrachtdocumenten archiveren.', 'veryo' ),
							'<strong>' . __( 'Zakelijke dienstverlening.', 'veryo' ) . '</strong> ' . __( 'Gespreksverslagen, documenten samenvatten en een interne assistent op eigen kennis.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'AI-training in Groningen', 'veryo' ),
						'p' => array(
							__( 'Veel Groningse bedrijven beginnen met een training. Dat is logisch: als je team snapt wat AI kan en wat niet, komen de goede ideeën vanzelf. We geven de training bij jou op locatie, voor maximaal twintig mensen, met oefeningen uit jullie eigen werk. Daarmee werk je meteen aan de AI-geletterdheid die de AI Act vraagt.', 'veryo' ),
							__( 'Een voorbeeld: een ingenieursbureau in de stad kan een halve dag training combineren met een kansensessie in de middag. Het team leert werken met AI, en aan het eind ligt er een lijst met de drie automatiseringen die het meeste opleveren.', 'veryo' ),
						),
					),
					$veryo_places(
						__( 'Groningen ligt op ongeveer een uur rijden van Leeuwarden. We plannen afspraken in de provincie zo dat we er efficiënt kunnen zijn, en voor veel overleg werkt online ook prima.', 'veryo' ),
						array( __( 'Stad Groningen', 'veryo' ), 'Veendam', 'Hoogezand', 'Delfzijl', 'Winsum', __( 'en de rest van de provincie Groningen', 'veryo' ) )
					),
				),
				'catalog'  => array(
					'h'   => __( 'Veelgevraagd in Groningen', 'veryo' ),
					'ids' => array( 'planningsassistent', 'statusberichten', 'technische-documentatie', 'gespreksverslagen', 'dashboard' ),
				),
				'price'    => array( 'steps' => array( 0, 2, 3, 5 ) ),
				'faq'      => array(
					array( __( 'Komen jullie ook in de stad Groningen?', 'veryo' ), __( 'Ja, in de stad en in de hele provincie. Voor een kansensessie, training of oplevering komen we op locatie.', 'veryo' ) ),
					array( __( 'Rekenen jullie reiskosten voor Groningen?', 'veryo' ), __( 'Eventuele reiskosten staan altijd vooraf in de offerte, zodat je niet voor verrassingen komt te staan.', 'veryo' ) ),
					array( __( 'Werken jullie samen met Groningse onderwijsinstellingen?', 'veryo' ), __( 'Op dit moment niet. We richten ons op praktische toepassingen voor het MKB.', 'veryo' ) ),
					array( __( 'Kunnen jullie een AI-training in Groningen geven?', 'veryo' ), __( 'Ja, bij jou op locatie of online. Een halve dag voor maximaal twintig personen kost €1.200 exclusief btw.', 'veryo' ) ),
					array( __( 'Is een AI-adviseur in Groningen niet dichterbij?', 'veryo' ), __( 'Misschien wel. Het verschil zit in de aanpak: wij adviseren, bouwen en onderhouden, met vaste prijzen. Kies wat bij je past.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Groningse ondernemer? Doe de AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'branches/transport', __( 'AI in de logistiek', 'veryo' ), __( 'Planning en statusberichten', 'veryo' ) ),
					array( 'branches/zakelijke-dienstverlening', __( 'AI voor accountants en adviesbureaus', 'veryo' ), __( 'Verslagen en kennis', 'veryo' ) ),
					array( 'ai-implementatie-mkb', __( 'AI-implementatie voor het MKB', 'veryo' ), __( 'Van plan tot live', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Assen, Emmen, Hoogeveen, Meppel', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-adviseur-drenthe'   => array(
		'title'     => __( 'AI-adviseur in Drenthe voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-adviseur in Drenthe voor het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'AI-adviseur in Drenthe: AI-automatisering en training voor het MKB in Assen, Emmen, Hoogeveen en Meppel. Voor agri, maakindustrie en installatie.', 'veryo' ),
		'kw'        => 'ai adviseur drenthe',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Drenthe',
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo is een AI-adviseur voor het MKB in Drenthe. We helpen bedrijven in Assen, Emmen, Hoogeveen, Meppel en omgeving met AI-automatisering, AI-training en AI op maat, met vaste prijzen. Een eerste automatisering kost €750 tot €1.500, een incompany training vanaf €1.200, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'AI-training in Drenthe', 'veryo' ), array( __( 'Veel Drentse bedrijven beginnen met een training voor het team, bij hen op locatie. In een halve dag leert iedereen wat AI kan en niet kan, hoe je het veilig gebruikt en hoe je het inzet voor offertes, mail en werkinstructies. Daarmee werk je ook aan de AI-geletterdheid die de AI Act sinds 2 februari 2025 vraagt.', 'veryo' ), __( 'Een voorbeeld: een maakbedrijf in Hoogeveen kan de training combineren met een korte ronde door de werkplaats en het kantoor. Aan het eind van de dag ligt er een lijst met de automatiseringen die het meeste opleveren, en weet het team hoe het zelf al kan beginnen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Drentse maakbedrijven, boeren en installateurs', 'veryo' ),
					'p' => array(
						__( 'Drenthe heeft een sterke basis van maakindustrie, agrarische bedrijven en installatietechniek. Bedrijven waar het echte werk in de werkplaats, op het land of bij de klant gebeurt, en waar het kantoorwerk vaak op de schouders van één of twee mensen ligt.', 'veryo' ),
						__( 'Juist daar kan AI-automatisering in Drenthe veel schelen. Niet door de werkplaats te veranderen, maar door het werk eromheen lichter te maken: de offertes, de onderhoudsplanning, de bestellingen en de administratie.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'werkplaats van een Drents metaalbedrijf met een medewerker aan een tablet', 'veryo' ), __( 'AI-adviseur in Drenthe bij een maakbedrijf', 'veryo' ) ),
				'sections' => array(
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
					$veryo_places(
						__( 'Assen ligt op ongeveer een uur rijden van Leeuwarden, Emmen iets verder. We komen op locatie voor kansensessies, trainingen en opleveringen.', 'veryo' ),
						array( 'Assen', 'Emmen', 'Hoogeveen', 'Meppel', __( 'en de rest van Drenthe', 'veryo' ) )
					),
				),
				'catalog'  => array(
					'h'   => __( 'Veelgevraagd in Drenthe', 'veryo' ),
					'ids' => array( 'onderhoudsplanning', 'inkoop-bestellingen', 'calculatietool', 'nacalculatie', 'projectfotos' ),
				),
				'price'    => array( 'steps' => array( 0, 3, 4, 5 ) ),
				'faq'      => array(
					array( __( 'Komen jullie in heel Drenthe?', 'veryo' ), __( 'Ja. We komen in Assen, Emmen, Hoogeveen, Meppel en alles daartussen, voor kansensessies, trainingen en opleveringen.', 'veryo' ) ),
					array( __( 'Werken jullie ook voor agrarische bedrijven?', 'veryo' ), __( 'Ja. Agri en mechanisatie is een van de sectoren die we het best kennen, van loonwerk tot machinehandel.', 'veryo' ) ),
					array( __( 'Wat betekent de afstand voor de prijs?', 'veryo' ), __( 'Je krijgt vooraf een vaste prijs. Eventuele reiskosten staan daar gewoon in, zodat je weet waar je aan toe bent.', 'veryo' ) ),
					array( __( 'Kunnen we beginnen met een training?', 'veryo' ), __( 'Ja, dat is vaak een goede eerste stap. Een halve dag incompany training voor maximaal twintig mensen kost €1.200 exclusief btw.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Drents bedrijf? Zie wat AI je oplevert', 'veryo' ), '' ),
				'links'    => array(
					array( 'branches/agri', __( 'AI in de landbouw', 'veryo' ), __( 'Agrarische bedrijven en mechanisatie', 'veryo' ) ),
					array( 'ai-automatisering/offertes-en-calculaties', __( 'Offertes en calculaties automatiseren', 'veryo' ), __( 'Voor maakbedrijven', 'veryo' ) ),
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Onze thuisprovincie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'leeuwarden'            => array(
		'title'     => __( 'AI-training en automatisering in Leeuwarden', 'veryo' ),
		'seo_title' => __( 'AI-training en automatisering in Leeuwarden | Veryo', 'veryo' ),
		'desc'      => __( 'AI-training in Leeuwarden en AI-automatisering voor bedrijven in de stad en omgeving. Veryo is hier gevestigd; training op locatie vanaf €1.200 excl. btw.', 'veryo' ),
		'kw'        => 'ai training leeuwarden',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 25000,
			'area' => 'Friesland',
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo geeft AI-training in Leeuwarden en helpt bedrijven in de stad met AI-automatisering. Leeuwarden is onze thuisbasis: trainingen doen we op een locatie in de stad of bij jou op kantoor. Een incompany training kost €1.200 voor een halve dag, een eerste automatisering €750 tot €1.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Een AI-specialist in Leeuwarden, om de hoek', 'veryo' ),
					'p' => array(
						__( 'Voor een Leeuwarder bedrijf is het prettig als de AI-specialist niet uit de Randstad hoeft te komen. Even langskomen voor een kop koffie, een vervolgafspraak zonder reisdag, en iemand die weet hoe het er hier aan toe gaat.', 'veryo' ),
						__( 'We zien in de stad een mix van zakelijke dienstverleners, winkels en horeca in de binnenstad en technische bedrijven op de bedrijventerreinen aan de rand. Allemaal met dezelfde vraag: hoe zet ik AI in zonder dat het een project van een jaar wordt?', 'veryo' ),
					),
				),
				'photo'    => array( __( 'trainingsruimte in Leeuwarden met een groep deelnemers en een scherm', 'veryo' ), __( 'AI-training in Leeuwarden voor een MKB-team', 'veryo' ) ),
				'sections' => array(
					array(
						'h' => __( 'AI-training in Leeuwarden: op locatie of bij jou', 'veryo' ),
						'p' => array(
							__( 'De training is praktisch: je team werkt met ChatGPT, Claude of Copilot aan taken uit jullie eigen werk. Mail, offertes, samenvattingen, teksten. We behandelen wat wel en niet mag met gegevens, en je werkt meteen aan de AI-geletterdheid die de AI Act sinds 2 februari 2025 vraagt.', 'veryo' ),
							__( 'We geven de training bij jou op kantoor, of op een trainingslocatie in Leeuwarden als je team liever even weg is van de werkplek. Een halve dag voor maximaal twintig personen kost €1.200, een hele dag €2.800, exclusief btw.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'AI-automatisering in Leeuwarden', 'veryo' ),
						'p' => array( __( 'Na een training willen veel bedrijven direct iets toepassen. Een voorbeeld: een administratiekantoor in de binnenstad kan beginnen met gespreksverslagen die automatisch worden gemaakt en een assistent die klantdocumenten samenvat als voorbereiding. Een winkel of horecazaak begint vaak met reviews en social media. Omdat we om de hoek zitten, is een tussentijds overleg zo geregeld.', 'veryo' ) ),
					),
					$veryo_places(
						__( 'In en rond Leeuwarden komen we overal, ook voor een kort overleg.', 'veryo' ),
						array( __( 'Binnenstad', 'veryo' ), __( 'Bedrijventerreinen De Zwette en Hemrik', 'veryo' ), 'Stiens', 'Grou', 'Dronryp', 'Wirdum' )
					),
				),
				'catalog'  => array(
					'h'   => __( 'Veelgevraagd in Leeuwarden', 'veryo' ),
					'ids' => array( 'gespreksverslagen', 'documenten-samenvatten', 'reviews', 'social-captions', 'mail-concepten' ),
				),
				'price'    => array( 'steps' => array( 1, 2, 3, 4 ) ),
				'faq'      => array(
					array( __( 'Waar in Leeuwarden geven jullie de training?', 'veryo' ), __( 'Bij jou op kantoor of op een trainingslocatie in Leeuwarden. [VUL IN: vaste trainingslocatie, als die er is]', 'veryo' ) ),
					array( __( 'Kan ik gewoon even langskomen?', 'veryo' ), __( 'Graag, maar maak even een afspraak, want we zijn vaak op locatie bij klanten.', 'veryo' ) ),
					array( __( 'Wat kost een AI-training in Leeuwarden?', 'veryo' ), __( 'Een halve dag voor maximaal twintig personen kost €1.200, een hele dag €2.800, exclusief btw. Mogelijk is er subsidie via de SLIM-regeling; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie.', 'veryo' ) ),
					array( __( 'Is er ook een open training voor losse deelnemers?', 'veryo' ), __( 'Op dit moment niet. Voor losse deelnemers komt er de online cursus van de Veryo Academy; zet je op de wachtlijst.', 'veryo' ) ),
				),
				'cta'      => array( __( 'Uit Leeuwarden? Begin met de gratis AI-scan', 'veryo' ), '' ),
				'links'    => array(
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Voor de hele provincie', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Alle trainingsvormen', 'veryo' ) ),
					array( 'branches/horeca-retail', __( 'AI voor horeca en retail', 'veryo' ), __( 'Reviews en social', 'veryo' ) ),
					array( 'over-veryo', __( 'Over Veryo', 'veryo' ), __( 'Wie we zijn', 'veryo' ) ),
				),
			)
		),
	),
);
