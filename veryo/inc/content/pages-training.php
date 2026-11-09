<?php
/**
 * Trainingen: de AI-workshop voor bedrijven en de ChatGPT-training voor verkopers.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/*
 * AI-workshop voor bedrijven
 */
$veryo_workshop = veryo_page_standard(
	array(
		'contact'  => array(
			__( 'Een AI-workshop voor jullie team?', 'veryo' ),
			__( 'Vertel met hoeveel collega’s jullie zijn en wat ze nu met AI doen. Je krijgt binnen één werkdag een voorstel voor de opzet en een datum.', 'veryo' ),
			__( 'Bijvoorbeeld: workshop voor 12 collega’s in Groningen, de helft gebruikt al ChatGPT.', 'veryo' ),
		),
		'answer'   => __( 'Een AI-workshop voor bedrijven is een praktische sessie van een dagdeel waarin jullie team met AI aan de slag gaat, met taken uit jullie eigen werk. Geen presentatie vol beloftes, maar zelf oefenen met ChatGPT, Copilot of Claude. Veryo geeft de workshop op locatie in Friesland, Groningen en Drenthe, en online in heel Nederland.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Waarom een AI-workshop, en geen lange cursus?', 'veryo' ),
			'p' => array(
				__( 'In veel bedrijven is AI nog iets van een paar enthousiaste collega’s. De rest heeft het een keer geprobeerd, of durft niet goed. Dat is jammer, want juist het gewone werk, zoals mail, verslagen en teksten, gaat met AI vaak sneller.', 'veryo' ),
				__( 'Een workshop is de snelste manier om het hele team op hetzelfde startpunt te krijgen. In een dagdeel ontdekken collega’s wat AI voor hun eigen werk kan doen, en wat beter niet. Ze gaan naar huis met opdrachten die ze de volgende dag gebruiken. Wie daarna meer wil, kan doorgaan met een uitgebreide training.', 'veryo' ),
			),
		),
		'photo'    => array( __( 'team van een MKB-bedrijf rond een tafel met laptops tijdens een workshop', 'veryo' ), __( 'AI-workshop voor bedrijven: team aan het oefenen met AI', 'veryo' ), 'training' ),
		'sections' => array(
			array(
				'h'     => __( 'Wat jullie doen in de AI-workshop', 'veryo' ),
				'list'  => array(
					__( 'Kort uitleg: wat AI wel en niet kan, en waarom het soms met grote stelligheid onzin vertelt.', 'veryo' ),
					__( 'Live laten zien: een mail, een offertetekst en een verslag maken met AI, met taken uit jullie eigen bedrijf.', 'veryo' ),
					__( 'Zelf oefenen: iedereen werkt aan een taak uit zijn eigen werk, met hulp waar dat nodig is.', 'veryo' ),
					__( 'Veilig werken: welke gegevens wel en niet in een AI-tool mogen, en welke instellingen je aanzet.', 'veryo' ),
					__( 'Afspraken: een eerste lijstje met afspraken voor het team, als begin van jullie AI-beleid.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h'    => __( 'Zo ziet een workshop eruit', 'veryo' ),
				'p'    => array( __( 'Een workshop duurt een dagdeel, ongeveer drie tot vier uur. We stemmen de opzet af op jullie team:', 'veryo' ) ),
				'list' => array(
					'<strong>' . __( 'Vooraf.', 'veryo' ) . '</strong> ' . __( 'Een korte vragenlijst: welke tools gebruiken jullie, wat doen collega’s al met AI en welke taken kosten veel tijd? Die taken gebruiken we als oefening.', 'veryo' ),
					'<strong>' . __( 'Tijdens.', 'veryo' ) . '</strong> ' . __( 'Afwisselend uitleg, voordoen en zelf oefenen. Iedereen werkt op zijn eigen laptop, in de tools die jullie gebruiken.', 'veryo' ),
					'<strong>' . __( 'Na afloop.', 'veryo' ) . '</strong> ' . __( 'De slides, een overzicht met goede opdrachten voor jullie werk en een deelnamebevestiging. Handig als onderbouwing voor de AI-geletterdheid die de AI Act vraagt.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'AI-workshop in Friesland, Groningen of Drenthe', 'veryo' ),
				'p' => array(
					__( 'We komen bij jullie op locatie. Vanuit Leeuwarden zijn we snel in heel Friesland, in de stad Groningen en de rest van de provincie, en in Drenthe, van Assen tot Emmen. Een AI-workshop in Groningen of Assen plannen we net zo makkelijk als een workshop om de hoek.', 'veryo' ),
					__( 'Werken jullie verspreid over meerdere vestigingen, of zit het team buiten Noord-Nederland? Dan geven we de workshop online, in kleinere groepen, zodat iedereen kan meedoen en vragen kan stellen.', 'veryo' ),
				),
			),
			array(
				'h'     => __( 'Voor welke teams is een AI-workshop geschikt?', 'veryo' ),
				'list'  => array(
					__( 'Kantoorteams die veel mailen, plannen en verslagen schrijven.', 'veryo' ),
					__( 'Verkoopteams die offertes en opvolgmails maken. Daarvoor is er ook een aparte ChatGPT-training voor verkopers.', 'veryo' ),
					__( 'Directie en MT die willen begrijpen wat AI voor het bedrijf betekent, voordat er keuzes worden gemaakt.', 'veryo' ),
					__( 'Teams die net Copilot of Gemini hebben gekregen en er meer uit willen halen.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'ChatGPT-workshop of Copilot-workshop?', 'veryo' ),
				'p' => array( __( 'De workshop werkt met de tools die jullie gebruiken. Werken jullie in Microsoft 365, dan ligt een Copilot-workshop voor de hand. Gebruiken collega’s vooral ChatGPT, dan beginnen we daar. Zijn jullie benieuwd naar AI die op jullie eigen kantoor draait, dan laten we ook Veryo Collega zien: een lokale AI-assistent waarbij jullie bedrijfsgegevens binnen blijven.', 'veryo' ) ),
			),
			array(
				'h' => __( 'Workshop of training?', 'veryo' ),
				'p' => array(
					sprintf(
						/* translators: %s: link naar AI-training. */
						__( 'Een workshop is een eerste kennismaking in een dagdeel. Een <a href="%s">AI-training</a> gaat dieper, duurt een halve of hele dag en sluit af met afspraken voor het hele team. Twijfel je, begin dan met de workshop: na afloop weet je wat jullie team nodig heeft.', 'veryo' ),
						esc_url( veryo_link( 'ai-training' ) )
					),
				),
			),
		),
		'price'    => array(
			'steps' => array( 'training', 'startpakket' ),
			'p'     => __( 'Een workshop is een vast bedrag per sessie. Mogelijk is er subsidie via de SLIM-regeling voor trainingen; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie.', 'veryo' ),
		),
		'faq'      => array(
			array( __( 'Hoe lang duurt een AI-workshop?', 'veryo' ), __( 'Een dagdeel, ongeveer drie tot vier uur. Zo blijft er genoeg tijd om zelf te oefenen.', 'veryo' ) ),
			array( __( 'Hoeveel collega’s kunnen meedoen?', 'veryo' ), __( 'Tot twintig per sessie. Bij grotere groepen splitsen we op, zodat iedereen zelf kan oefenen.', 'veryo' ) ),
			array( __( 'Geven jullie ook een AI-workshop in Groningen?', 'veryo' ), __( 'Ja. We komen in de stad Groningen en de rest van de provincie op locatie, net als in Friesland en Drenthe.', 'veryo' ) ),
			array( __( 'Is voorkennis nodig?', 'veryo' ), __( 'Nee. We stemmen de oefeningen af op wat collega’s al weten. Wie al veel met AI doet, krijgt lastigere opdrachten.', 'veryo' ) ),
			array( __( 'Telt de workshop mee voor de AI-geletterdheid uit de AI Act?', 'veryo' ), __( 'De workshop is een concrete stap om te zorgen voor voldoende AI-geletterdheid, zoals artikel 4 van de AI Act vraagt. Je krijgt een deelnamebevestiging. Voor een volledige aanpak is er de AI-geletterdheid training.', 'veryo' ) ),
			array( __( 'Kan de workshop online?', 'veryo' ), __( 'Ja, voor teams buiten Noord-Nederland of op meerdere vestigingen. Op locatie werkt meestal beter voor de interactie.', 'veryo' ) ),
		),
		'cta_demo' => true,
		'cta'      => array( __( 'Een AI-workshop voor jullie team plannen?', 'veryo' ), __( 'Plan een gratis kennismaking van 15 minuten. We bespreken jullie team, de tools en een datum.', 'veryo' ) ),
		'links'    => array(
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Een halve of hele dag, dieper', 'veryo' ) ),
			array( 'ai-training/chatgpt-training-verkopers', __( 'ChatGPT-training voor verkopers', 'veryo' ), __( 'Voor sales en accountmanagers', 'veryo' ) ),
			array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Wat de AI Act vraagt', 'veryo' ) ),
			array( veryo_collega()['slug'], __( 'Veryo Collega', 'veryo' ), __( 'Lokale AI-assistent voor bedrijven', 'veryo' ) ),
			array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Workshops in stad en provincie', 'veryo' ) ),
		),
	)
);

/*
 * ChatGPT-training voor verkopers
 */
$veryo_sales = veryo_page_standard(
	array(
		'contact'  => array(
			__( 'Een ChatGPT-training voor jullie verkopers?', 'veryo' ),
			__( 'Vertel hoe groot jullie verkoopteam is en hoe jullie nu offertes en opvolging doen. Je krijgt binnen één werkdag een voorstel.', 'veryo' ),
			__( 'Bijvoorbeeld: 6 accountmanagers die veel offertes en opvolgmails schrijven.', 'veryo' ),
		),
		'answer'   => __( 'De ChatGPT-training voor verkopers van Veryo leert jullie salesteam hoe je AI gebruikt voor het werk rond de verkoop: klanten voorbereiden, offertes en opvolgmails schrijven, gespreksverslagen maken en bezwaren voorbereiden. Praktisch, met jullie eigen klanten en producten als oefening, en met duidelijke afspraken over wat wel en niet in ChatGPT mag.', 'veryo' ),
		'problem'  => array(
			'h' => __( 'Waar verkopers hun tijd aan kwijt zijn', 'veryo' ),
			'p' => array(
				__( 'Een goede verkoper wil met klanten praten. Maar een groot deel van de week gaat op aan werk eromheen: een gesprek voorbereiden, een offerte schrijven, een verslag in het CRM zetten, een opvolgmail sturen die net persoonlijk genoeg is. Dat werk is belangrijk, maar het is ook precies het soort werk waar AI goed in is.', 'veryo' ),
				__( 'Veel verkopers gebruiken ChatGPT al op eigen houtje. Dat levert soms mooie resultaten op, en soms teksten die klinken als een robot of klantgegevens op een plek waar ze niet horen. Een training zorgt dat het hele team het goed en veilig doet.', 'veryo' ),
			),
		),
		'sections' => array(
			array(
				'h'     => __( 'AI voor sales: wat jullie verkopers leren', 'veryo' ),
				'list'  => array(
					'<strong>' . __( 'Klant en gesprek voorbereiden.', 'veryo' ) . '</strong> ' . __( 'Openbare informatie over een prospect samenvatten en gespreksvragen voorbereiden.', 'veryo' ),
					'<strong>' . __( 'Offertes en voorstellen.', 'veryo' ) . '</strong> ' . __( 'Een sterke eerste versie van een offertetekst of voorstel, in jullie toon. De verkoper controleert en past aan.', 'veryo' ),
					'<strong>' . __( 'Opvolgmails die gelezen worden.', 'veryo' ) . '</strong> ' . __( 'Kort, persoonlijk en met een duidelijke volgende stap, zonder dat het klinkt als een sjabloon.', 'veryo' ),
					'<strong>' . __( 'Gespreksverslagen.', 'veryo' ) . '</strong> ' . __( 'Van aantekeningen of een ingesproken memo naar een net verslag met afspraken en actiepunten.', 'veryo' ),
					'<strong>' . __( 'Bezwaren voorbereiden.', 'veryo' ) . '</strong> ' . __( 'Oefenen met de vragen en bezwaren die klanten vaak hebben, met ChatGPT als sparringpartner.', 'veryo' ),
					'<strong>' . __( 'Veilig werken.', 'veryo' ) . '</strong> ' . __( 'Welke klantgegevens wel en niet in ChatGPT mogen, en hoe je de zakelijke instellingen goed zet.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h'    => __( 'Zo werkt de training', 'veryo' ),
				'list' => array(
					'<strong>' . __( 'Vooraf.', 'veryo' ) . '</strong> ' . __( 'Een korte vragenlijst over jullie producten, klanten en het verkoopproces. Daaruit halen we de oefeningen.', 'veryo' ),
					'<strong>' . __( 'De training.', 'veryo' ) . '</strong> ' . __( 'Een dagdeel, op locatie of online. Steeds kort uitleg en dan zelf oefenen met echte situaties uit jullie verkoop.', 'veryo' ),
					'<strong>' . __( 'Na afloop.', 'veryo' ) . '</strong> ' . __( 'Een overzicht met opdrachten (prompts) die het team direct kan gebruiken, en afspraken over wat wel en niet mag.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Wat AI niet doet', 'veryo' ),
				'p' => array( __( 'AI verkoopt niet voor je. Een klant koopt van een mens die hij vertrouwt. AI helpt alleen met het voorbereidende en het schrijfwerk, zodat verkopers meer tijd hebben voor het gesprek zelf. En alles wat AI schrijft, leest een verkoper na voordat het naar een klant gaat. Dat leren we in de training ook.', 'veryo' ) ),
			),
			array(
				'h' => __( 'ChatGPT, Copilot of een eigen AI?', 'veryo' ),
				'p' => array(
					__( 'De training werkt met de tools die jullie gebruiken: ChatGPT, Copilot in Microsoft 365 of Gemini. Werken jullie met gevoelige klantgegevens en wil je die niet in de cloud, dan laten we ook zien hoe Veryo Collega werkt: een lokale AI-assistent die op jullie eigen kantoor draait en jullie eigen offertes en productinformatie kent.', 'veryo' ),
				),
			),
		),
		'price'    => array(
			'steps' => array( 'training' ),
			'p'     => __( 'De training is een vast bedrag per sessie. Mogelijk is er subsidie via de SLIM-regeling voor trainingen; openstellingsperiodes en voorwaarden wisselen, check de actuele situatie.', 'veryo' ),
		),
		'faq'      => array(
			array( __( 'Voor wie is de ChatGPT-training voor verkopers?', 'veryo' ), __( 'Voor verkopers, accountmanagers, binnendienst en iedereen die offertes en opvolging doet. Voorkennis is niet nodig.', 'veryo' ) ),
			array( __( 'Mogen we klantgegevens in ChatGPT zetten?', 'veryo' ), __( 'Dat hangt af van de versie en de afspraken. In de training leggen we uit wat wel en niet verstandig is, en welke zakelijke instellingen je aanzet.', 'veryo' ) ),
			array( __( 'Werkt het met ons CRM?', 'veryo' ), __( 'De training gaat over het werken met AI zelf. Wil je daarna verslagen of opvolging automatisch in je CRM, dan kan dat met een automatisering bovenop je CRM.', 'veryo' ) ),
			array( __( 'Hoe lang duurt de training?', 'veryo' ), __( 'Een dagdeel. Voor teams die meer willen, plannen we een vervolgsessie na een paar weken.', 'veryo' ) ),
			array( __( 'Kan de training online?', 'veryo' ), __( 'Ja. Op locatie werkt meestal beter, maar online kan prima voor verkoopteams die veel onderweg zijn.', 'veryo' ) ),
		),
		'cta_demo' => true,
		'cta'      => array( __( 'Jullie verkoopteam slimmer laten werken met AI?', 'veryo' ), __( 'Plan een gratis kennismaking van 15 minuten. We bespreken het team, de tools en een datum.', 'veryo' ) ),
		'links'    => array(
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Voor het hele team', 'veryo' ) ),
			array( 'ai-workshop', __( 'AI-workshop voor bedrijven', 'veryo' ), __( 'Een dagdeel, praktisch', 'veryo' ) ),
			array( 'oplossingen/ai-lead-opvolging', __( 'AI lead-opvolging', 'veryo' ), __( 'Elke lead binnen minuten opgevolgd', 'veryo' ) ),
			array( veryo_collega()['slug'], __( 'Veryo Collega', 'veryo' ), __( 'Lokale AI op jullie eigen kennis', 'veryo' ) ),
		),
	)
);

return array(
	'ai-workshop'                            => array(
		'title'     => __( 'AI-workshop voor bedrijven', 'veryo' ),
		'seo_title' => __( 'AI-workshop voor bedrijven: praktisch, op locatie | Veryo', 'veryo' ),
		'desc'      => __( 'AI-workshop voor bedrijven: in een dagdeel aan de slag met AI, met taken uit jullie eigen werk. Op locatie of online. Plan een gratis kennismaking.', 'veryo' ),
		'kw'        => 'ai workshop bedrijven',
		'schema'    => array(
			'type'   => 'service',
			'area'   => 'Nederland',
			'course' => array( 'onsite', 'online' ),
		),
		'content'   => $veryo_workshop,
	),
	'ai-training/chatgpt-training-verkopers' => array(
		'title'     => __( 'ChatGPT-training voor verkopers', 'veryo' ),
		'seo_title' => __( 'ChatGPT-training voor verkopers: AI voor sales | Veryo', 'veryo' ),
		'desc'      => __( 'ChatGPT-training voor verkopers: offertes, opvolgmails en gespreksverslagen sneller met AI, veilig en in jullie eigen toon. Plan een kennismaking.', 'veryo' ),
		'kw'        => 'chatgpt training verkopers',
		'schema'    => array(
			'type'   => 'service',
			'area'   => 'Nederland',
			'course' => array( 'onsite', 'online' ),
		),
		'content'   => $veryo_sales,
	),
);
