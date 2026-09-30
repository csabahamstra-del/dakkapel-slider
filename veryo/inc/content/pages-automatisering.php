<?php
/**
 * Subpagina's AI-automatisering, per categorie uit de catalogus.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_q = array( 'type' => 'service' );

return array(

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/klantcontact'            => array(
		'title'     => __( 'Klantcontact automatiseren met AI', 'veryo' ),
		'seo_title' => __( 'Klantcontact automatiseren met AI | Veryo', 'veryo' ),
		'desc'      => __( 'Klantvragen automatiseren met AI: mail sorteren, conceptantwoorden, WhatsApp-assistent en klantupdates in je eigen tools. Quick win vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'klantvragen automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo helpt MKB-bedrijven klantvragen automatiseren met AI: inkomende mail wordt gesorteerd, er staan conceptantwoorden klaar in jullie toon, en een WhatsApp-assistent beantwoordt vragen buiten kantoortijd. Een quick win zoals mailsortering kost €750 tot €1.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Te veel vragen, te weinig handen', 'veryo' ),
					'p' => array(
						__( 'De mailbox loopt vol met vragen die je al honderd keer hebt beantwoord. Wanneer komt de monteur? Wat kost een onderhoudsbeurt? Kunnen jullie ook in het weekend? Tussendoor gaat de telefoon en komen er WhatsApp-berichten binnen met foto’s van een lekkende kraan.', 'veryo' ),
						__( 'Wie de vragen beantwoordt, wisselt per dag. Daardoor krijgt de ene klant binnen tien minuten antwoord en de andere pas na drie dagen. En als de collega die alles weet ziek is, blijft er van alles liggen.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'medewerker aan de telefoon met een mailbox open op het scherm', 'veryo' ), __( 'Klantvragen automatiseren met AI op kantoor', 'veryo' ) ),
				'catalog'  => array(
					'h'     => __( 'Wat we automatiseren in klantcontact', 'veryo' ),
					'intro' => __( 'Uit onze catalogus. De tijdwinst is een indicatie voor een team van 5 tot 20 mensen.', 'veryo' ),
					'ids'   => array( 'mail-sortering', 'mail-concepten', 'whatsapp-assistent', 'website-chatbot', 'voicebot', 'gespreksverslagen', 'statusberichten', 'klachten', 'vertalen' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Klantvragen automatiseren zonder de klant kwijt te raken', 'veryo' ),
						'p' => array(
							__( 'Automatiseren betekent hier niet dat klanten met een robot praten die niets begrijpt. De AI leest de vraag, zoekt het antwoord in jullie eigen informatie en zet een concept klaar. Bij eenvoudige vragen kan dat antwoord direct de deur uit; bij alles wat gevoelig of onduidelijk is, beslist een collega.', 'veryo' ),
							__( 'Een voorbeeld: een installatiebedrijf krijgt veel mail met vragen over storingen, afspraken en offertes. De AI labelt elke mail, zet storingen met spoed bovenaan en schrijft bij standaardvragen een concept. De binnendienst hoeft dan vooral te controleren en te versturen.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Waar we op letten', 'veryo' ),
						'list'  => array(
							__( 'Antwoorden komen uit jullie eigen informatie, niet uit het geheugen van een AI-model.', 'veryo' ),
							__( 'Klachten, prijsafspraken en toezeggingen gaan altijd langs een mens.', 'veryo' ),
							__( 'Klanten kunnen altijd een mens bereiken.', 'veryo' ),
							__( 'Persoonsgegevens verwerken we met een verwerkersovereenkomst en zakelijke API’s.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 4, 5, 6 ) ),
				'faq'      => array(
					array( __( 'Worden mails automatisch verstuurd?', 'veryo' ), __( 'Dat bepaal je zelf. Meestal beginnen we met concepten die een collega controleert. Voor eenvoudige vragen, zoals openingstijden of de status van een afspraak, kan het later automatisch.', 'veryo' ) ),
					array( __( 'Werkt dit met Outlook en Gmail?', 'veryo' ), __( 'Ja. We koppelen aan Outlook, Gmail en de meeste zakelijke mailomgevingen. Je blijft werken in je eigen mailbox.', 'veryo' ) ),
					array( __( 'Kan een WhatsApp-assistent ook afspraken inplannen?', 'veryo' ), __( 'Ja, als je agenda of planningstool een koppeling heeft. De assistent stelt tijden voor en zet de afspraak vast na bevestiging van de klant.', 'veryo' ) ),
					array( __( 'Wat als de AI het antwoord niet weet?', 'veryo' ), __( 'Dan zegt hij dat en zet hij de vraag door naar een collega, met een korte samenvatting. Hij verzint geen antwoord.', 'veryo' ) ),
					array( __( 'Kunnen berichten in andere talen?', 'veryo' ), __( 'Ja. Veel bedrijven gebruiken het om berichten van en naar Poolse, Duitse of Engelse klanten en medewerkers te vertalen.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent voor je bedrijf', 'veryo' ), __( 'Vragen 24/7 beantwoord', 'veryo' ) ),
					array( 'ai-op-maat/chatbot', __( 'AI-chatbot laten maken', 'veryo' ), __( 'Op je eigen kennis', 'veryo' ) ),
					array( 'branches/makelaardij', __( 'AI voor makelaars', 'veryo' ), __( 'Eén inbox voor alle kanalen', 'veryo' ) ),
					array( 'ai-adviseur-friesland', __( 'AI-adviseur in Friesland', 'veryo' ), __( 'Op locatie in heel Friesland', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/offertes-en-calculaties' => array(
		'title'     => __( 'Offertes en calculaties automatiseren met AI', 'veryo' ),
		'seo_title' => __( 'Offertes en calculaties automatiseren met AI | Veryo', 'veryo' ),
		'desc'      => __( 'Offertes automatiseren met AI: van aanvraag of foto naar conceptofferte, automatische opvolging en een eigen calculatietool. Vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'offertes automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo helpt je offertes automatiseren: een aanvraag, notities of foto worden een conceptofferte met jullie prijzen, openstaande offertes worden vanzelf opgevolgd en calculaties komen in één eigen tool. Offerte-opvolging kost €750 tot €1.500, een offerte-generator €2.500 tot €7.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Offertes die blijven liggen', 'veryo' ),
					'p' => array(
						__( 'Een aanvraag komt binnen op maandag. De calculator heeft pas donderdag tijd. Dan blijkt dat er informatie mist, dus gaat er een mail heen en weer. Tegen de tijd dat de offerte de deur uitgaat, heeft de klant al bij een ander getekend.', 'veryo' ),
						__( 'En de offertes die wél verstuurd zijn, worden vaak niet opgevolgd. Niemand heeft tijd om na een week te bellen, dus blijven ze in het luchtledige hangen. Ondertussen zitten de prijzen, uurtarieven en marges verspreid over Excel-bestanden en het hoofd van één collega.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'calculator aan een bureau met een tekening en een laptop met een conceptofferte', 'veryo' ), __( 'Offertes automatiseren met een AI-offerte-generator', 'veryo' ) ),
				'catalog'  => array(
					'h'     => __( 'Wat we automatiseren bij verkoop, offertes en calculaties', 'veryo' ),
					'intro' => __( 'Bij calculaties leggen we de rekenregels vast in formules of code. AI gebruiken we voor het lezen, invullen en uitleggen, niet voor het rekenen zelf.', 'veryo' ),
					'ids'   => array( 'offerte-generator', 'offerte-opvolging', 'calculatietool', 'offerte-uit-calculatie', 'materiaalstaat', 'nacalculatie', 'meerwerk', 'lead-invoer', 'leadkwalificatie', 'prijsindicator', 'contracten', 'terugverdien' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Zo werkt het offertes automatiseren in de praktijk', 'veryo' ),
						'p' => array(
							__( 'Een voorbeeld: een installatiebedrijf krijgt via de website een aanvraag voor een warmtepomp, met een paar foto’s van de meterkast. De offerte-generator leest de aanvraag, haalt de juiste onderdelen en uurtarieven uit de calculatietool en zet een conceptofferte klaar in de huisstijl. De calculator controleert, past aan waar nodig en verstuurt.', 'veryo' ),
							__( 'Drie dagen later heeft de klant nog niet gereageerd. Dan gaat er automatisch een vriendelijke herinnering uit. Na zeven en veertien dagen nog een keer, tenzij de klant intussen heeft gereageerd. Je ziet in één overzicht welke offertes openstaan en wat ze waard zijn.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Waarom de rekenregels van jou blijven', 'veryo' ),
						'p' => array( __( 'AI-taalmodellen zijn goed in lezen en schrijven, maar niet betrouwbaar in rekenen. Daarom zetten we prijzen, marges en rekenregels vast in de calculatietool, en laat AI alleen de aanvraag lezen, velden invullen en de offerte formuleren. Zo krijg je snelheid zonder verrassingen in de bedragen.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 4, 5, 6 ) ),
				'faq'      => array(
					array( __( 'Verstuurt de AI offertes zelf?', 'veryo' ), __( 'Nee. De AI maakt een concept, een mens controleert en verstuurt. Een offerte is een toezegging; die laten we niet aan AI over.', 'veryo' ) ),
					array( __( 'Werkt het met ons offerteprogramma?', 'veryo' ), __( 'Vaak wel. Veel offerte- en boekhoudpakketten hebben een koppeling. Zo niet, dan maken we de offerte in je huisstijl als document en zetten we de gegevens klaar voor je pakket.', 'veryo' ) ),
					array( __( 'Kan het een materiaallijst maken uit een tekening?', 'veryo' ), __( 'Er kan een concept-materiaallijst uit een tekening of bestek worden gemaakt. Dat is maatwerk en een calculator moet het altijd controleren. Het scheelt vooral tijd bij het beginnen.', 'veryo' ) ),
					array( __( 'Is offerte-opvolging niet opdringerig?', 'veryo' ), __( 'Dat hangt af van de toon. We schrijven de berichten samen met jou, kort en vriendelijk. Reageert de klant, dan stopt de reeks direct.', 'veryo' ) ),
					array( __( 'Wat levert het op?', 'veryo' ), __( 'Dat verschilt per bedrijf. In de catalogus rekenen we met 3 tot 8 uur per week voor een offerte-generator bij een team van 5 tot 20 mensen. De AI-scan maakt een schatting op basis van jouw uren.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Offerte-generator en calculatietool', 'veryo' ) ),
					array( 'branches/bouw', __( 'AI in de bouw', 'veryo' ), __( 'Materiaalstaat en nacalculatie', 'veryo' ) ),
					array( 'ai-automatisering/administratie', __( 'Administratie automatiseren', 'veryo' ), __( 'Van werkbon naar factuur', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Voor maakindustrie en installatie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/administratie'           => array(
		'title'     => __( 'Administratie en facturen automatiseren', 'veryo' ),
		'seo_title' => __( 'Administratie en facturen automatiseren | Veryo', 'veryo' ),
		'desc'      => __( 'Administratie automatiseren: inkoopfacturen, bonnetjes, werkbon naar factuur en debiteuren, gekoppeld aan Exact, Moneybird of SnelStart. Vanaf €750.', 'veryo' ),
		'kw'        => 'administratie automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo helpt MKB-bedrijven hun administratie automatiseren: inkoopfacturen en bonnetjes worden automatisch verwerkt, afgeronde werkbonnen worden facturen en debiteuren krijgen vanzelf een herinnering. We koppelen aan je bestaande boekhoudpakket. Een quick win kost €750 tot €1.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'De administratie die ’s avonds wordt gedaan', 'veryo' ),
					'p' => array(
						__( 'Overdag wordt er gewerkt, ’s avonds of op zaterdag wordt de administratie bijgewerkt. Inkoopfacturen uit de mail overtypen. Bonnetjes zoeken die nog in de bus liggen. Werkbonnen omzetten in facturen. En dan nog de klanten die al zestig dagen niet hebben betaald.', 'veryo' ),
						__( 'Het is werk dat moet gebeuren, maar geen werk waar je bedrijf beter van wordt. Bovendien sluipen er fouten in als je moe bent: een verkeerd bedrag, een factuur die twee keer wordt geboekt, een werkbon die nooit gefactureerd wordt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'ondernemer aan de keukentafel met een stapel bonnetjes en een laptop', 'veryo' ), __( 'Administratie automatiseren voor het MKB', 'veryo' ) ),
				'catalog'  => array(
					'h'     => __( 'Wat we automatiseren in de administratie', 'veryo' ),
					'intro' => __( 'We koppelen aan het boekhoudpakket dat je al hebt, zoals Exact, Moneybird of SnelStart. We vervangen het niet.', 'veryo' ),
					'ids'   => array( 'inkoopfacturen', 'bonnetjes', 'werkbon-factuur', 'debiteuren', 'bankmutaties', 'urenregistratie', 'archiveren', 'formulieren' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Hoe je administratie automatiseren aanpakt', 'veryo' ),
						'p' => array(
							__( 'We beginnen bijna altijd bij de inkoopfacturen. Dat is goed af te bakenen, het komt elke week terug en je ziet direct of het werkt. Alle inkoopfacturen gaan naar één mailadres; de AI leest leverancier, bedrag, btw en factuurnummer uit en zet de boeking als concept klaar. Jij of je boekhouder keurt goed.', 'veryo' ),
							__( 'Daarna volgt vaak de koppeling van werkbon naar factuur. Een voorbeeld: een klein technisch bedrijf rondt een klus af in de werkbon-app. De uren en materialen gaan automatisch naar een conceptfactuur, zodat er niet meer aan het eind van de maand overgetypt hoeft te worden.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Wat er niet verandert', 'veryo' ),
						'list'  => array(
							__( 'Je boekhouder of accountant houdt de controle. Boekingen staan als concept klaar tot iemand ze goedkeurt.', 'veryo' ),
							__( 'Je blijft werken in je eigen boekhoudpakket.', 'veryo' ),
							__( 'Aanmaningen met gevolgen, zoals incasso, gaan nooit automatisch.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 4, 5, 7 ) ),
				'faq'      => array(
					array( __( 'Welke boekhoudpakketten ondersteunen jullie?', 'veryo' ), __( 'We werken veel met Exact, Moneybird en SnelStart. Andere pakketten met een koppeling (API) kunnen ook. In de kennismaking checken we wat er bij jou mogelijk is.', 'veryo' ) ),
					array( __( 'Vervangt dit mijn boekhouder?', 'veryo' ), __( 'Nee. Het haalt het invoerwerk weg, zodat je boekhouder zich kan richten op controle en advies.', 'veryo' ) ),
					array( __( 'Hoe betrouwbaar is het uitlezen van facturen?', 'veryo' ), __( 'Bij nette pdf-facturen is het uitlezen betrouwbaar; bij foto’s van verfrommelde bonnetjes minder. Daarom blijft alles een concept tot iemand het goedkeurt, en markeren we twijfelgevallen.', 'veryo' ) ),
					array( __( 'Is het veilig om facturen door AI te laten lezen?', 'veryo' ), __( 'We gebruiken zakelijke API’s waarbij je gegevens niet worden gebruikt om modellen te trainen, en sluiten een verwerkersovereenkomst als er persoonsgegevens in zitten.', 'veryo' ) ),
					array( __( 'Wat kost administratie automatiseren?', 'veryo' ), __( 'Het automatisch verwerken van inkoopfacturen is meestal een quick win van €750 tot €1.500. Een koppeling van werkbon naar factuur is een project van €2.500 tot €7.500. Alles exclusief btw.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-automatisering/werkprocessen', __( 'Werkprocessen automatiseren', 'veryo' ), __( 'Digitale werkbon en planning', 'veryo' ) ),
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Van werkbon naar factuur', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Voor zakelijke dienstverlening en techniek', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/werkprocessen'           => array(
		'title'     => __( 'Planning, werkbonnen en inkoop automatiseren', 'veryo' ),
		'seo_title' => __( 'Planning, werkbonnen en inkoop automatiseren | Veryo', 'veryo' ),
		'desc'      => __( 'Werkprocessen automatiseren met AI: planning als voorstel, digitale werkbon, opleverrapport, inkoop en onderhoudsplanning. Voor het MKB, vanaf €750.', 'veryo' ),
		'kw'        => 'werkprocessen automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo helpt technische MKB-bedrijven werkprocessen automatiseren: een weekplanning als voorstel, een werkbon die je inspreekt, opleverrapporten uit foto’s, bestellingen uit een materiaallijst en onderhoud dat vanzelf wordt ingepland. Een quick win kost €750 tot €1.500, een project €2.500 tot €7.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Het werk loopt, de papierwinkel eromheen niet', 'veryo' ),
					'p' => array(
						__( 'De monteurs zijn goed in hun vak, maar de werkbon wordt in de bus op de knie ingevuld, als hij al wordt ingevuld. De planner schuift elke ochtend met namen omdat er iemand ziek is. Materiaal wordt besteld als het op is, niet als het nodig is. En de onderhoudscontracten staan in een Excel die alleen de eigenaar begrijpt.', 'veryo' ),
						__( 'Daardoor gaat er tijd verloren aan bellen, zoeken en herstellen. Klussen worden te laat gefactureerd en meerwerk raakt kwijt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'monteur in een bedrijfsbus die een werkbon inspreekt op zijn telefoon', 'veryo' ), __( 'Werkprocessen automatiseren: digitale werkbon inspreken', 'veryo' ) ),
				'catalog'  => array(
					'h'     => __( 'Welke werkprocessen we automatiseren', 'veryo' ),
					'intro' => __( 'Tijdwinst is een indicatie voor een team van 5 tot 20 mensen.', 'veryo' ),
					'ids'   => array( 'planningsassistent', 'digitale-werkbon', 'opleverrapport', 'inkoop-bestellingen', 'voorraad', 'onderhoudsplanning', 'checklists', 'overdracht', 'storingen', 'koppelingen' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Een voorbeeld uit de praktijk', 'veryo' ),
						'p' => array(
							__( 'Een installatiebedrijf met acht monteurs kan de werkbon laten inspreken: na de klus vertelt de monteur in een paar zinnen wat er gedaan is en maakt hij twee foto’s. Daar komt een nette werkbon uit, met uren en materialen, die de klant digitaal aftekent. Aan het eind van de dag verschijnt in de teamapp een overzicht van wat klaar is en wat morgen moet.', 'veryo' ),
							__( 'De planningsassistent kijkt naar beschikbaarheid, vaardigheden en locatie en stelt een weekplanning voor. De planner beslist, maar begint niet meer met een leeg scherm.', 'veryo' ),
						),
					),
					array(
						'h'    => __( 'Waar we eerlijk over zijn', 'veryo' ),
						'list' => array(
							__( 'Een planningsassistent is maatwerk en vraagt goede basisgegevens. Zonder actuele beschikbaarheid werkt hij niet.', 'veryo' ),
							__( 'Een rommelig proces maken we eerst helder, anders automatiseer je de rommel.', 'veryo' ),
							__( 'De planner of werkvoorbereider houdt het laatste woord.', 'veryo' ),
						),
					),
				),
				'price'    => array( 'steps' => array( 4, 5, 6 ) ),
				'faq'      => array(
					array( __( 'Moeten de monteurs een nieuwe app leren?', 'veryo' ), __( 'Liefst niet. Als jullie al een werkbon- of planningsapp gebruiken, koppelen we daaraan. Anders gebruiken we WhatsApp of een eenvoudig formulier dat iedereen snapt.', 'veryo' ) ),
					array( __( 'Werkt het met onze planningstool?', 'veryo' ), __( 'Als de planningstool een koppeling heeft, meestal wel. Dat checken we in de kansensessie.', 'veryo' ) ),
					array( __( 'Kan het ook VCA-checklists bijhouden?', 'veryo' ), __( 'Ja. Digitale kwaliteits- en VCA-checklists zijn een quick win; ze worden per klus ingevuld en automatisch gearchiveerd.', 'veryo' ) ),
					array( __( 'Wat als er een storing binnenkomt?', 'veryo' ), __( 'Storingsmeldingen kunnen automatisch beoordeeld en toegewezen worden. Spoed gaat meteen naar de dienstdoende monteur, de rest wordt ingepland.', 'veryo' ) ),
					array( __( 'Hoe begin ik met werkprocessen automatiseren?', 'veryo' ), __( 'Kies één proces dat elke week veel tijd of ergernis kost, bijvoorbeeld de werkbon. Doe de AI-scan of plan een kansensessie om te zien wat het oplevert.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Werkbon, storingen en offertes', 'veryo' ) ),
					array( 'branches/agri', __( 'AI in de landbouw', 'veryo' ), __( 'Onderhoud, keuringen en onderdelen', 'veryo' ) ),
					array( 'branches/transport', __( 'AI in de logistiek', 'veryo' ), __( 'Planning en statusberichten', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Maakindustrie en installatie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/marketing'               => array(
		'title'     => __( 'AI-marketing voor het MKB', 'veryo' ),
		'seo_title' => __( 'AI-marketing voor het MKB: SEO, content en social | Veryo', 'veryo' ),
		'desc'      => __( 'AI-marketing voor het MKB: SEO-blogs, lokale pagina’s, social posts, reviews en e-mailflows, altijd met menselijke check. Quick wins vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'ai marketing mkb',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo zet AI-marketing voor het MKB in: van zoekwoordenplanning en SEO-blogs tot social posts, reviews en e-mailflows. AI maakt de concepten, een mens controleert alles voordat het online gaat. Een quick win zoals social captions of reviewverzoeken kost €750 tot €1.500, exclusief btw.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Marketing die er altijd bij moet', 'veryo' ),
					'p' => array(
						__( 'Je weet dat je vaker iets zou moeten posten, dat je website beter gevonden zou moeten worden en dat tevreden klanten een review zouden moeten achterlaten. Maar marketing is bij de meeste MKB-bedrijven iets wat de eigenaar er ’s avonds bij doet. Of niet doet.', 'veryo' ),
						__( 'Het resultaat: een Instagram die maanden stilstaat, een Google Bedrijfsprofiel met drie reviews en een website die op de verkeerde woorden wordt gevonden.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'projectfoto van een afgeronde klus naast een telefoon met een conceptpost', 'veryo' ), __( 'AI-marketing voor het MKB: projectfoto naar social post', 'veryo' ) ),
				'catalog'  => array(
					'h'     => __( 'Wat we automatiseren in marketing', 'veryo' ),
					'intro' => __( 'Alle content gaat langs een menselijke check voordat het online komt.', 'veryo' ),
					'ids'   => array( 'zoekwoordenplanning', 'blogs', 'lokale-paginas', 'seo-check', 'geo', 'bedrijfsprofiel', 'contenthergebruik', 'social-captions', 'projectfotos', 'shorts', 'advertentieteksten', 'advertentierapportage', 'nieuwsbrief', 'emailflows', 'reviews', 'concurrentiemonitor' ),
				),
				'sections' => array(
					array(
						'h' => __( 'AI-marketing die klinkt als jouw bedrijf', 'veryo' ),
						'p' => array(
							__( 'AI kan in een paar seconden een tekst schrijven, maar die klinkt vaak als iedereen. Daarom beginnen we met jullie tone of voice: hoe praten jullie met klanten, welke woorden gebruiken jullie wel en niet. Alle concepten worden daarop afgestemd en gaan langs iemand die het vak kent.', 'veryo' ),
							__( 'Een voorbeeld: een bouwbedrijf zet projectfoto’s in een gedeelde map. Elke vrijdag staat er een concept voor een “project van de week”-post klaar, met een korte tekst over wat er gebouwd is. De eigenaar keurt goed op zijn telefoon en de post gaat maandag online.', 'veryo' ),
						),
					),
					array(
						'h' => __( 'Vindbaar in Google en in AI-zoekmachines', 'veryo' ),
						'p' => array( __( 'Steeds meer mensen stellen hun vraag aan ChatGPT of een andere AI-zoekmachine in plaats van aan Google. Die citeren vooral pagina’s met een helder, direct antwoord en consistente bedrijfsgegevens. We helpen je website daarop in te richten, naast de gewone SEO-basis. Garanties op posities geven we niet; niemand kan die eerlijk geven.', 'veryo' ) ),
					),
				),
				'price'    => array( 'steps' => array( 4, 5, 8 ) ),
				'faq'      => array(
					array( __( 'Gaat AI zelf posts plaatsen?', 'veryo' ), __( 'Alleen na jouw akkoord. Concepten worden klaargezet; jij of een collega keurt goed. Klantgerichte content gaat altijd langs een mens.', 'veryo' ) ),
					array( __( 'Straft Google AI-teksten af?', 'veryo' ), __( 'Google kijkt naar kwaliteit en nut voor de lezer, niet naar hoe een tekst is gemaakt. Een AI-concept dat door een vakman is aangevuld en gecontroleerd, kan dus prima werken. Massaal ongecontroleerde teksten plaatsen raden we af.', 'veryo' ) ),
					array( __( 'Kunnen jullie ook advertenties beheren?', 'veryo' ), __( 'We maken advertentievarianten en een wekelijkse samenvatting van de resultaten. Het budget en de keuzes blijven bij jou of je marketingbureau.', 'veryo' ) ),
					array( __( 'Hoe krijg ik meer Google-reviews?', 'veryo' ), __( 'Door het vragen makkelijk en vast onderdeel van je werk te maken. Na elke klus gaat er automatisch een vriendelijk reviewverzoek uit. Reviews kopen of neppen doen we niet.', 'veryo' ) ),
					array( __( 'Wat kost AI-marketing?', 'veryo' ), __( 'Losse flows, zoals reviewverzoeken of social captions, zijn quick wins van €750 tot €1.500. Een contentmachine met blogs, lokale pagina’s en hergebruik is een project van €2.500 tot €7.500. Alles exclusief btw.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/horeca-retail', __( 'AI voor horeca en retail', 'veryo' ), __( 'Reviews en social', 'veryo' ) ),
					array( 'branches/makelaardij', __( 'AI voor makelaars', 'veryo' ), __( 'Woningteksten en inbox', 'veryo' ) ),
					array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Training en automatisering', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/hr-en-werving'           => array(
		'title'     => __( 'Werving en HR automatiseren met AI', 'veryo' ),
		'seo_title' => __( 'Werving en HR automatiseren met AI | Veryo', 'veryo' ),
		'desc'      => __( 'Werving automatiseren met AI: vacatures in de taal van vakmensen, solliciteren via WhatsApp, voorselectie en opvolging van kandidaten. Vanaf €750.', 'veryo' ),
		'kw'        => 'werving automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo helpt MKB-bedrijven werving automatiseren: vacatures in de taal van vakmensen, solliciteren via WhatsApp zonder cv, een shortlist op harde eisen en automatische opvolging van kandidaten. De mens beslist. Een quick win zoals kandidaatopvolging kost €750 tot €1.500, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Wat je vooraf regelt', 'veryo' ), array( __( 'Werving automatiseren begint niet bij de techniek maar bij drie afspraken. Welke eisen zijn echt hard, zoals een rijbewijs of een VCA-diploma? Wie voert de gesprekken en wanneer is die persoon beschikbaar? En hoe snel krijgt een kandidaat antwoord? Als die drie dingen vastliggen, is de automatisering een kwestie van inrichten.', 'veryo' ), __( 'Ook HR na de werving levert tijd op. Verlof en verzuim melden via WhatsApp of een formulier, certificaten die op tijd een herinnering geven en een onboarding die vanzelf klaarstaat: het zijn kleine flows die samen elke maand uren schelen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Vakmensen vinden is lastig genoeg', 'veryo' ),
					'p' => array(
						__( 'Goede monteurs, timmerlieden en chauffeurs zitten niet te wachten op een sollicitatieformulier met twaalf velden en een verplicht cv. Ze reageren op hun telefoon, ’s avonds, en haken af als ze een week niets horen.', 'veryo' ),
						__( 'Ondertussen heeft de eigenaar of de planner geen tijd om elke reactie te bekijken, elke kandidaat te bellen en iedereen netjes af te wijzen. Het gevolg: kandidaten die afhaken en een slechte naam als werkgever.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'vakman die op zijn telefoon via WhatsApp op een vacature reageert', 'veryo' ), __( 'Werving automatiseren via WhatsApp', 'veryo' ) ),
				'catalog'  => array(
					'h'   => __( 'Wat we automatiseren in HR en werving', 'veryo' ),
					'ids' => array( 'vacatureteksten', 'whatsapp-sollicitatie', 'voorselectie', 'kandidaatopvolging', 'onboarding', 'verlof', 'certificaten' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Hoe werving automatiseren eruitziet', 'veryo' ),
						'p' => array(
							__( 'Een kandidaat ziet de vacature en stuurt een WhatsApp-bericht. De assistent stelt vijf korte vragen: welk vak, hoeveel ervaring, rijbewijs, welke regio, wanneer beschikbaar. Voldoet de kandidaat aan de harde eisen, dan plant hij zelf een kennismaking in je agenda. Zo niet, dan krijgt hij een nette afwijzing met uitleg.', 'veryo' ),
							__( 'Jij krijgt per kandidaat een korte samenvatting en voert alleen nog de gesprekken. Na afloop krijgt iedereen automatisch bericht, ook als het niets wordt.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Grenzen die we aanhouden', 'veryo' ),
						'list'  => array(
							__( 'Afwijzingen op basis van harde eisen (zoals een verplicht rijbewijs) kunnen automatisch; bij twijfel beslist altijd een mens.', 'veryo' ),
							__( 'Geen selectie op leeftijd, geslacht, afkomst of andere kenmerken die niet mogen.', 'veryo' ),
							__( 'Kandidaten weten dat ze met een assistent praten en kunnen altijd een mens spreken.', 'veryo' ),
							__( 'Sollicitatiegegevens bewaren we niet langer dan nodig.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 4, 5 ) ),
				'faq'      => array(
					array( __( 'Is solliciteren zonder cv wel serieus?', 'veryo' ), __( 'Voor veel vakfuncties wel. Een monteur met tien jaar ervaring heeft vaak geen actueel cv, maar kan in vijf vragen laten zien of hij past. Het cv kan later nog.', 'veryo' ) ),
					array( __( 'Mag AI kandidaten afwijzen?', 'veryo' ), __( 'Beslissingen met grote gevolgen laten we niet zonder mens over aan AI. Automatisch afwijzen doen we alleen op harde, objectieve eisen die jij vooraf vastlegt. Bij twijfel beslist een mens.', 'veryo' ) ),
					array( __( 'Werkt dit met ons wervingsplatform?', 'veryo' ), __( 'Veel platforms hebben een koppeling. Anders zetten we kandidaten in een eenvoudig overzicht, bijvoorbeeld in je CRM of een gedeelde lijst.', 'veryo' ) ),
					array( __( 'Kan het ook helpen bij onboarding?', 'veryo' ), __( 'Ja. Documenten, accounts en een planning voor de eerste weken worden automatisch klaargezet zodra iemand tekent.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/recruitment', __( 'Werving via WhatsApp', 'veryo' ), __( 'Voor recruitment en uitzendbureaus', 'veryo' ) ),
					array( 'ai-op-maat/whatsapp-assistent', __( 'WhatsApp-assistent', 'veryo' ), __( 'Maatwerk voor je bedrijf', 'veryo' ) ),
					array( 'branches/transport', __( 'AI voor transport', 'veryo' ), __( 'Ook chauffeurs werven', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/kennis-en-documenten'    => array(
		'title'     => __( 'Interne AI-assistent en documenten', 'veryo' ),
		'seo_title' => __( 'Interne AI-assistent en documenten | Veryo', 'veryo' ),
		'desc'      => __( 'Een interne kennisbank met AI: een assistent op je eigen documenten en procedures, werkinstructies uit video en documenten samenvatten. Vanaf €750.', 'veryo' ),
		'kw'        => 'interne kennisbank ai',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo bouwt een interne kennisbank met AI: een assistent die vragen van collega’s beantwoordt uit jullie eigen documenten, handleidingen en procedures, met verwijzing naar de bron. Ook maken we werkinstructies uit video en vatten we documenten samen. Een interne assistent is maatwerk vanaf €5.000; losse flows vanaf €750, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Waar een kennisbank het meest oplevert', 'veryo' ), array( __( 'De winst zit vooral bij vragen die vaak terugkomen en waarvan het antwoord ergens op papier staat: hoe werkt dit toestel, welke procedure geldt hier, wat hebben we met deze klant afgesproken. Hoe meer collega’s dezelfde vragen stellen, hoe meer tijd een interne assistent bespaart.', 'veryo' ), __( 'Een voorbeeld: een installatiebedrijf met drie nieuwe monteurs per jaar kan de inwerkperiode verkorten door werkinstructies uit korte video’s te laten maken en ze doorzoekbaar te zetten. De ervaren collega’s worden minder vaak gebeld en de nieuwe mensen durven eerder zelf aan de slag.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Kennis die in één hoofd zit', 'veryo' ),
					'p' => array(
						__( 'Elk bedrijf heeft een collega die alles weet. Waar de handleiding van die ene ketel staat, hoe je een klacht afhandelt, welke procedure geldt bij een nieuwe klant. Gaat die collega met vakantie of met pensioen, dan wordt het zoeken.', 'veryo' ),
						__( 'De documenten zijn er wel, maar verspreid over mappen, mailtjes en een intranet dat niemand gebruikt. Nieuwe medewerkers stellen dezelfde vragen die vorig jaar ook al gesteld werden.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'nieuwe medewerker die op een laptop een vraag stelt aan de interne assistent', 'veryo' ), __( 'Interne kennisbank met AI voor medewerkers', 'veryo' ) ),
				'catalog'  => array(
					'h'   => __( 'Wat we automatiseren rond kennis en documenten', 'veryo' ),
					'ids' => array( 'interne-assistent', 'werkinstructies', 'documenten-samenvatten', 'technische-documentatie', 'beleid', 'presentaties' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Hoe een interne kennisbank met AI werkt', 'veryo' ),
						'p' => array(
							__( 'Je kiest welke documenten erin gaan: werkinstructies, productbladen, procedures, prijslijsten. De assistent doorzoekt alleen die bronnen en geeft antwoord met een verwijzing, zodat je kunt nakijken waar het staat. Staat het er niet in, dan zegt hij dat.', 'veryo' ),
							__( 'Een voorbeeld: een monteur staat bij een onbekende installatie en vraagt via zijn telefoon hoe de foutcode op dit type toestel moet worden gereset. De assistent zoekt het op in de handleiding van de fabrikant en geeft de stappen, met paginanummer.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Toegang en veiligheid', 'veryo' ),
						'list'  => array(
							__( 'Alleen medewerkers met een account hebben toegang.', 'veryo' ),
							__( 'Gevoelige documenten, zoals personeelsdossiers, gaan er niet in, tenzij met aparte rechten.', 'veryo' ),
							__( 'Zakelijke API’s, waarbij je documenten niet worden gebruikt om modellen te trainen.', 'veryo' ),
							__( 'Samenvattingen van contracten zijn voorbereiding, geen juridisch advies.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'price'    => array( 'steps' => array( 4, 6, 7 ) ),
				'faq'      => array(
					array( __( 'Welke documenten kunnen erin?', 'veryo' ), __( 'Pdf’s, Word-bestanden, webpagina’s en de meeste gangbare formaten. Scans van slechte kwaliteit werken minder goed; die zetten we eerst om.', 'veryo' ) ),
					array( __( 'Kan de assistent fouten maken?', 'veryo' ), __( 'Ja, daarom geeft hij altijd de bron, zodat je kunt nakijken. We testen vooraf met echte vragen en verbeteren de bronnen als hij iets mist.', 'veryo' ) ),
					array( __( 'Hoe blijft de kennisbank actueel?', 'veryo' ), __( 'Nieuwe of gewijzigde documenten in de gekoppelde map worden automatisch meegenomen. Elke kennisbank heeft een eigenaar binnen je bedrijf.', 'veryo' ) ),
					array( __( 'Kunnen jullie een AI-beleid schrijven?', 'veryo' ), __( 'We maken een concept voor een AI-beleid, privacyverklaring of protocol. Laat het juridisch controleren voordat je het vaststelt.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-op-maat/interne-assistent', __( 'AI-assistent op je eigen documenten', 'veryo' ), __( 'Maatwerk', 'veryo' ) ),
					array( 'branches/zakelijke-dienstverlening', __( 'AI voor accountants', 'veryo' ), __( 'Documenten en verslagen', 'veryo' ) ),
					array( 'ai-training', __( 'AI-training', 'veryo' ), __( 'Zodat je team ermee werkt', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/rapportages'             => array(
		'title'     => __( 'Rapportages en dashboards automatiseren', 'veryo' ),
		'seo_title' => __( 'Rapportages en dashboards automatiseren | Veryo', 'veryo' ),
		'desc'      => __( 'Rapportages automatiseren met AI: een ondernemersdashboard, elke maandag je cijfers in gewone taal en Excel zonder gedoe. Quick win vanaf €750 excl. btw.', 'veryo' ),
		'kw'        => 'rapportages automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'answer'   => __( 'Veryo helpt MKB-bedrijven rapportages automatiseren: omzet, offertes, debiteuren, planning en leads in één dashboard, en elke maandag een kort bericht met je belangrijkste cijfers in gewone taal. Een maandagbericht kost €750 tot €1.500, een dashboard €2.500 tot €7.500, exclusief btw.', 'veryo' ),
				'extra'    => array( __( 'Welke cijfers het meest opleveren', 'veryo' ), array( __( 'De meeste ondernemers hebben genoeg aan drie tot vijf cijfers: openstaande offertes en hun waarde, facturen die te lang openstaan, de bezetting van de planning voor de komende weken en het aantal nieuwe aanvragen. Wie die elke week ziet, stuurt eerder bij.', 'veryo' ), __( 'Een voorbeeld: een technisch bedrijf met vijftien mensen kan elke maandagochtend een bericht in Teams krijgen met die vier cijfers en twee zinnen uitleg. Het kost niemand tijd om te maken en het gesprek in het weekoverleg gaat meteen over wat er moet gebeuren.', 'veryo' ), __( 'Voor wie dieper wil kijken, is rendement per project of klanttype de volgende stap. Dan zie je welke klussen goed verdienen en welke structureel tegenvallen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Cijfers bij elkaar zoeken', 'veryo' ),
					'p' => array(
						__( 'Je wilt weten hoe het gaat, maar daarvoor moet je in vier systemen kijken: de boekhouding, het offerteprogramma, de planning en een Excel met leads. Dus doe je het één keer per kwartaal, of als de accountant erom vraagt.', 'veryo' ),
						__( 'Ondertussen stuur je op gevoel. Je merkt pas laat dat de offertes teruglopen, dat een grote klant niet betaalt of dat een bepaald type klus structureel geld kost.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'ondernemer die op maandagochtend op zijn telefoon het weekoverzicht leest', 'veryo' ), __( 'Rapportages automatiseren: maandagbericht met cijfers', 'veryo' ) ),
				'catalog'  => array(
					'h'   => __( 'Welke rapportages we automatiseren', 'veryo' ),
					'ids' => array( 'dashboard', 'weekupdate', 'excel', 'projectrendement', 'klanttevredenheid', 'voorspellingen' ),
				),
				'sections' => array(
					array(
						'h' => __( 'Rapportages automatiseren zonder dat je een analist wordt', 'veryo' ),
						'p' => array(
							__( 'We halen de cijfers op uit de systemen die je al hebt en zetten ze in één overzicht. Belangrijker nog: AI schrijft er in gewone taal bij wat opvalt. Bijvoorbeeld dat er deze week minder offertes zijn verstuurd dan gemiddeld, of dat drie facturen boven de zestig dagen openstaan.', 'veryo' ),
							__( 'De cijfers zelf komen rechtstreeks uit je systemen en worden niet door AI berekend. AI vat samen en wijst aan waar je moet kijken.', 'veryo' ),
						),
					),
					array(
						'h'    => __( 'Wat je nodig hebt', 'veryo' ),
						'list' => array(
							__( 'Systemen met een koppeling of export, zoals je boekhoudpakket, CRM of planningstool.', 'veryo' ),
							__( 'Een keuze voor de drie tot vijf cijfers die er voor jou toe doen.', 'veryo' ),
							__( 'Iemand die het overzicht leest. Klinkt vanzelfsprekend, maar daar begint het.', 'veryo' ),
						),
					),
				),
				'price'    => array( 'steps' => array( 4, 5, 6 ) ),
				'faq'      => array(
					array( __( 'Moeten we een BI-pakket aanschaffen?', 'veryo' ), __( 'Meestal niet. Voor een MKB-bedrijf is een eenvoudig dashboard of een wekelijks bericht vaak genoeg. Als een BI-pakket echt nodig is, zeggen we dat.', 'veryo' ) ),
					array( __( 'Kan AI voorspellingen doen?', 'veryo' ), __( 'Met genoeg historische gegevens kun je werkaanbod, pieken en cashflow voorspellen. Dat is maatwerk en de betrouwbaarheid hangt sterk af van je data. We zijn daar vooraf eerlijk over.', 'veryo' ) ),
					array( __( 'Kunnen jullie onze Excel-bestanden opschonen?', 'veryo' ), __( 'Ja. Opschonen, samenvoegen en analyseren van Excel-bestanden is een quick win.', 'veryo' ) ),
					array( __( 'Hoe vaak wordt het dashboard bijgewerkt?', 'veryo' ), __( 'Dat hangt af van de koppelingen; meestal dagelijks of per uur. Het maandagbericht komt, zoals de naam zegt, elke maandag.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-automatisering/administratie', __( 'Administratie automatiseren', 'veryo' ), __( 'Debiteuren en facturen', 'veryo' ) ),
					array( 'branches/bouw', __( 'AI in de bouw', 'veryo' ), __( 'Nacalculatie per project', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Voor logistiek en dienstverlening', 'veryo' ) ),
				),
			)
		),
	),
);
