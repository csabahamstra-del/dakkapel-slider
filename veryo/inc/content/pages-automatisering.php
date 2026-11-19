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
		'seo_title' => __( 'Klantcontact automatiseren met AI voor het mkb | Veryo', 'veryo' ),
		'desc'      => __( 'Klantvragen automatiseren met AI: mail sorteren, conceptantwoorden, WhatsApp-assistent en klantupdates in je eigen tools. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'klantvragen automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'approach' => true,
				'answer'   => __( 'Veryo helpt MKB-bedrijven klantvragen automatiseren met AI: inkomende mail wordt gesorteerd, er staan conceptantwoorden klaar in jullie toon, en een WhatsApp-assistent beantwoordt vragen buiten kantoortijd. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Te veel vragen, te weinig handen', 'veryo' ),
					'p' => array(
						__( 'De mailbox loopt vol met vragen die je al honderd keer hebt beantwoord. Wanneer komt de monteur? Wat kost een onderhoudsbeurt? Kunnen jullie ook in het weekend? Tussendoor gaat de telefoon en komen er WhatsApp-berichten binnen met foto’s van een lekkende kraan.', 'veryo' ),
						__( 'Wie de vragen beantwoordt, wisselt per dag. Daardoor krijgt de ene klant binnen tien minuten antwoord en de andere pas na drie dagen. En als de collega die alles weet ziek is, blijft er van alles liggen.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'medewerker aan de telefoon met een mailbox open op het scherm', 'veryo' ), __( 'Klantvragen automatiseren met AI op kantoor', 'veryo' ), 'telefoon' ),
				'catalog'  => array(
					'h'     => __( 'Wat er mogelijk is in klantcontact', 'veryo' ),
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
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
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
		'seo_title' => __( 'Offertes automatiseren met AI voor vakbedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'Van aanvraag of foto naar conceptofferte, met automatische opvolging. Offertes automatiseren met AI, bovenop je eigen software. Gratis offerte.', 'veryo' ),
		'kw'        => 'offertes automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'approach' => true,
				'answer'   => __( 'Veryo helpt je offertes automatiseren: een aanvraag, notities of foto worden een conceptofferte met jullie prijzen, openstaande offertes worden vanzelf opgevolgd en calculaties komen in één eigen tool. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Offertes die blijven liggen', 'veryo' ),
					'p' => array(
						__( 'Een aanvraag komt binnen op maandag. De calculator heeft pas donderdag tijd. Dan blijkt dat er informatie mist, dus gaat er een mail heen en weer. Tegen de tijd dat de offerte de deur uitgaat, heeft de klant al bij een ander getekend.', 'veryo' ),
						__( 'En de offertes die wél verstuurd zijn, worden vaak niet opgevolgd. Niemand heeft tijd om na een week te bellen, dus blijven ze in het luchtledige hangen. Ondertussen zitten de prijzen, uurtarieven en marges verspreid over Excel-bestanden en het hoofd van één collega.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'calculator aan een bureau met een tekening en een laptop met een conceptofferte', 'veryo' ), __( 'Offertes automatiseren met een AI-offerte-generator', 'veryo' ), 'kantoor' ),
				'catalog'  => array(
					'h'     => __( 'Wat er mogelijk is bij verkoop, offertes en calculaties', 'veryo' ),
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
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
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
					array( 'ai-automatisering/administratie', __( 'De administratieve kringloop', 'veryo' ), __( 'Van werkbon naar factuur', 'veryo' ) ),
					array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Voor maakindustrie en installatie', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/administratie'           => array(
		'title'       => __( 'De administratieve kringloop automatiseren', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'Administratieve kringloop automatiseren | Veryo', 'veryo' ),
		'desc'        => __( 'Uren en werkbonnen inlezen, inkoopfacturen aan projecten koppelen, weekafsluiting met conceptfacturen en begroot naast werkelijk. Bovenop jullie pakket.', 'veryo' ),
		'kw'          => 'administratie automatiseren',
		'schema'      => $veryo_q,
		'content'     => veryo_page_standard(
			array(
				'approach'   => true,
				'answer_cta' => array( __( 'Plan een kennismaking', 'veryo' ), '#vraag', 'amber' ),
				'answer'     => __( 'De administratieve kringloop is alles wat er gebeurt tussen het werk op de bouwplaats of in de werkplaats en de factuur: uren en werkbonnen, inkoopfacturen, de weekafsluiting, de salarisadministratie en de nacalculatie. Veryo automatiseert die kringloop voor projectbedrijven bovenop het boekhoud- en projectpakket dat jullie al hebben. Overstappen is nooit nodig. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
				'problem'    => array(
					'h' => __( 'Het werk is af, maar de administratie loopt achter', 'veryo' ),
					'p' => array(
						__( 'Uren staan op papier, in een app of in een WhatsApp-bericht. Werkbonnen komen als foto binnen. Inkoopfacturen moeten met de hand aan het juiste project worden gekoppeld. Aan het eind van de week of de maand zit iemand op kantoor alles over te typen, en pas daarna kan er gefactureerd worden.', 'veryo' ),
						__( 'Ondertussen weet niemand precies hoe een project ervoor staat. Begroot en werkelijk worden pas vergeleken als het project al klaar is, en dan is het te laat om bij te sturen.', 'veryo' ),
					),
				),
				'photo'      => array( __( 'medewerker op kantoor met werkbonnen en een laptop', 'veryo' ), __( 'De administratieve kringloop automatiseren voor projectbedrijven', 'veryo' ), 'laptop' ),
				'sections'   => array(
					array(
						'h'     => __( 'Wat we automatiseren in de kringloop', 'veryo' ),
						'list'  => array(
							'<strong>' . __( 'Uren en werkbonnen inlezen.', 'veryo' ) . '</strong> ' . __( 'Als foto, via WhatsApp of via een formulier. De gegevens komen op het juiste project en de juiste medewerker te staan.', 'veryo' ),
							'<strong>' . __( 'Inkoopfacturen koppelen.', 'veryo' ) . '</strong> ' . __( 'Leverancier, bedrag en project worden herkend; de factuur staat als concept klaar in de boekhouding.', 'veryo' ),
							'<strong>' . __( 'Weekafsluiting met conceptfacturen.', 'veryo' ) . '</strong> ' . __( 'Aan het eind van de week staan de conceptfacturen klaar op basis van uren, werkbonnen en materialen.', 'veryo' ),
							'<strong>' . __( 'Uren voor de salarisadministratie.', 'veryo' ) . '</strong> ' . __( 'Gewerkte uren, toeslagen en verlof in één overzicht, klaar voor de salarisverwerking.', 'veryo' ),
							'<strong>' . __( 'Begroot naast werkelijk.', 'veryo' ) . '</strong> ' . __( 'Per project een overzicht van begrote en werkelijke uren en kosten, terwijl het project nog loopt.', 'veryo' ),
						),
						'style' => 'checks',
					),
					array(
						'h' => __( 'Bovenop wat jullie al hebben', 'veryo' ),
						'p' => array(
							__( 'Veryo bouwt geen nieuwe software. We koppelen aan het boekhoudpakket, de urenregistratie en de projectadministratie die jullie al gebruiken, zoals Exact, Moneybird, SnelStart of een ander pakket met een koppeling (API). Waar het pakket iets zelf al kan, zetten we dat aan in plaats van iets nieuws te bouwen.', 'veryo' ),
							__( 'We beginnen met één stap uit de kringloop, meestal de stap die nu de meeste tijd kost. Eerst een proefperiode met echte gegevens, dan pas live.', 'veryo' ),
						),
					),
					array(
						'h'     => __( 'Wat er niet verandert', 'veryo' ),
						'list'  => array(
							__( 'Jullie boekhouder of accountant houdt de controle. Boekingen en facturen staan als concept klaar tot iemand ze goedkeurt.', 'veryo' ),
							__( 'Jullie blijven werken in je eigen pakketten.', 'veryo' ),
							__( 'Twijfelgevallen worden gemarkeerd en niet automatisch verwerkt.', 'veryo' ),
						),
						'style' => 'checks',
					),
				),
				'catalog'    => array(
					'h'     => __( 'Wat er nog meer kan in de administratie', 'veryo' ),
					'intro' => __( 'Naast de kringloop zelf zijn dit losse toepassingen die we vaak meenemen.', 'veryo' ),
					'ids'   => array( 'inkoopfacturen', 'werkbon-factuur', 'urenregistratie', 'bonnetjes', 'debiteuren', 'bankmutaties', 'archiveren', 'formulieren' ),
				),
				'price'      => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'onderhoud' ) ),
				'faq'        => array(
					array( __( 'Met welke pakketten werkt het?', 'veryo' ), __( 'Met het boekhoud-, uren- en projectpakket dat jullie al hebben, zolang er een koppeling (API) of export is. Denk aan Exact, Moneybird of SnelStart. In de kennismaking kijken we wat er bij jullie mogelijk is.', 'veryo' ) ),
					array( __( 'Moeten we overstappen op een ander pakket?', 'veryo' ), __( 'Nee. Veryo bouwt bovenop wat jullie al gebruiken. Overstappen is nooit nodig.', 'veryo' ) ),
					array( __( 'Vervangt dit onze boekhouder?', 'veryo' ), __( 'Nee. Het haalt het overtypen weg, zodat de boekhouder zich kan richten op controle en advies.', 'veryo' ) ),
					array( __( 'Hoe betrouwbaar is het inlezen van werkbonnen en facturen?', 'veryo' ), __( 'Nette pdf’s en formulieren gaan goed; handgeschreven werkbonnen en foto’s minder. Daarom blijft alles een concept tot iemand het goedkeurt, en markeren we twijfelgevallen.', 'veryo' ) ),
					array( __( 'Is het veilig?', 'veryo' ), __( 'We gebruiken zakelijke API’s waarbij jullie gegevens niet worden gebruikt om modellen te trainen, en sluiten een verwerkersovereenkomst als er persoonsgegevens in zitten.', 'veryo' ) ),
				),
				'links'      => array(
					array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
					array( 'oplossingen/werkbonnen-verwerken', __( 'Werkbonnen verwerken', 'veryo' ), __( 'Van foto naar project', 'veryo' ) ),
					array( 'oplossingen/inkoopfacturen-automatiseren', __( 'Inkoopfacturen automatiseren', 'veryo' ), __( 'Direct op het juiste project', 'veryo' ) ),
					array( 'ai-automatisering/werkprocessen', __( 'Werkprocessen automatiseren', 'veryo' ), __( 'Digitale werkbon en planning', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/werkprocessen'           => array(
		'title'     => __( 'Planning, werkbonnen en inkoop automatiseren', 'veryo' ),
		'seo_title' => __( 'Planning, werkbonnen en inkoop automatiseren | Veryo', 'veryo' ),
		'desc'      => __( 'Werkprocessen automatiseren met AI: planning als voorstel, digitale werkbon, opleverrapport, inkoop en onderhoudsplanning. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'werkprocessen automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'approach' => true,
				'answer'   => __( 'Veryo helpt technische MKB-bedrijven werkprocessen automatiseren: een weekplanning als voorstel, een werkbon die je inspreekt, opleverrapporten uit foto’s, bestellingen uit een materiaallijst en onderhoud dat vanzelf wordt ingepland. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Het werk loopt, de papierwinkel eromheen niet', 'veryo' ),
					'p' => array(
						__( 'De monteurs zijn goed in hun vak, maar de werkbon wordt in de bus op de knie ingevuld, als hij al wordt ingevuld. De planner schuift elke ochtend met namen omdat er iemand ziek is. Materiaal wordt besteld als het op is, niet als het nodig is. En de onderhoudscontracten staan in een Excel die alleen de eigenaar begrijpt.', 'veryo' ),
						__( 'Daardoor gaat er tijd verloren aan bellen, zoeken en herstellen. Klussen worden te laat gefactureerd en meerwerk raakt kwijt.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'monteur in een bedrijfsbus die een werkbon inspreekt op zijn telefoon', 'veryo' ), __( 'Werkprocessen automatiseren: digitale werkbon inspreken', 'veryo' ), 'installateur' ),
				'catalog'  => array(
					'h'     => __( 'Welke werkprocessen je kunt automatiseren', 'veryo' ),
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
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
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
		'desc'      => __( 'AI-marketing voor het MKB: SEO-blogs, lokale pagina’s, social posts, reviews en e-mailflows, altijd met menselijke check. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'ai marketing mkb',
		// Buiten de focus van Veryo: blijft bestaan, maar niet in Google.
		'meta'      => array( 'noindex' => 1 ),
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'approach' => true,
				'answer'   => __( 'Veryo zet AI-marketing voor het MKB in: van zoekwoordenplanning en SEO-blogs tot social posts, reviews en e-mailflows. AI maakt de concepten, een mens controleert alles voordat het online gaat. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'problem'  => array(
					'h' => __( 'Marketing die er altijd bij moet', 'veryo' ),
					'p' => array(
						__( 'Je weet dat je vaker iets zou moeten posten, dat je website beter gevonden zou moeten worden en dat tevreden klanten een review zouden moeten achterlaten. Maar marketing is bij de meeste MKB-bedrijven iets wat de eigenaar er ’s avonds bij doet. Of niet doet.', 'veryo' ),
						__( 'Het resultaat: een Instagram die maanden stilstaat, een Google Bedrijfsprofiel met drie reviews en een website die op de verkeerde woorden wordt gevonden.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'projectfoto van een afgeronde klus naast een telefoon met een conceptpost', 'veryo' ), __( 'AI-marketing voor het MKB: projectfoto naar social post', 'veryo' ), 'bouw' ),
				'catalog'  => array(
					'h'     => __( 'Wat er mogelijk is in marketing', 'veryo' ),
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
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'partner' ) ),
				'faq'      => array(
					array( __( 'Gaat AI zelf posts plaatsen?', 'veryo' ), __( 'Alleen na jouw akkoord. Concepten worden klaargezet; jij of een collega keurt goed. Klantgerichte content gaat altijd langs een mens.', 'veryo' ) ),
					array( __( 'Straft Google AI-teksten af?', 'veryo' ), __( 'Google kijkt naar kwaliteit en nut voor de lezer, niet naar hoe een tekst is gemaakt. Een AI-concept dat door een vakman is aangevuld en gecontroleerd, kan dus prima werken. Massaal ongecontroleerde teksten plaatsen raden we af.', 'veryo' ) ),
					array( __( 'Kunnen jullie ook advertenties beheren?', 'veryo' ), __( 'We maken advertentievarianten en een wekelijkse samenvatting van de resultaten. Het budget en de keuzes blijven bij jou of je marketingbureau.', 'veryo' ) ),
					array( __( 'Hoe krijg ik meer Google-reviews?', 'veryo' ), __( 'Door het vragen makkelijk en vast onderdeel van je werk te maken. Na elke klus gaat er automatisch een vriendelijk reviewverzoek uit. Reviews kopen of neppen doen we niet.', 'veryo' ) ),
					array( __( 'Wat kost AI-marketing?', 'veryo' ), __( 'Dat hangt af van de omvang en het aantal koppelingen. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'branches/horeca-retail', __( 'AI voor horeca en retail', 'veryo' ), __( 'Reviews en social', 'veryo' ) ),
					array( 'branches/makelaardij', __( 'AI voor makelaars', 'veryo' ), __( 'Woningteksten en inbox', 'veryo' ) ),
					array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Bouwen en inrichten vanuit Leeuwarden', 'veryo' ) ),
				),
			)
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-automatisering/hr-en-werving'           => array(
		'title'     => __( 'Werving en HR automatiseren met AI', 'veryo' ),
		'seo_title' => __( 'Werving automatiseren met AI voor het mkb | Veryo', 'veryo' ),
		'desc'      => __( 'Vacatureteksten, voorselectie en kandidaatopvolging automatisch. Zo vind je sneller vakmensen zonder extra HR-uren. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'werving automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 7500,
		),
		'content'   => veryo_page_standard(
			array(
				'approach' => true,
				'answer'   => __( 'Veryo helpt MKB-bedrijven werving automatiseren: vacatures in de taal van vakmensen, solliciteren via WhatsApp zonder cv, een shortlist op harde eisen en automatische opvolging van kandidaten. De mens beslist. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'extra'    => array( __( 'Wat je vooraf regelt', 'veryo' ), array( __( 'Werving automatiseren begint niet bij de techniek maar bij drie afspraken. Welke eisen zijn echt hard, zoals een rijbewijs of een VCA-diploma? Wie voert de gesprekken en wanneer is die persoon beschikbaar? En hoe snel krijgt een kandidaat antwoord? Als die drie dingen vastliggen, is de automatisering een kwestie van inrichten.', 'veryo' ), __( 'Ook HR na de werving levert tijd op. Verlof en verzuim melden via WhatsApp of een formulier, certificaten die op tijd een herinnering geven en een onboarding die vanzelf klaarstaat: het zijn kleine flows die samen elke maand uren schelen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Vakmensen vinden is lastig genoeg', 'veryo' ),
					'p' => array(
						__( 'Goede monteurs, timmerlieden en chauffeurs zitten niet te wachten op een sollicitatieformulier met twaalf velden en een verplicht cv. Ze reageren op hun telefoon, ’s avonds, en haken af als ze een week niets horen.', 'veryo' ),
						__( 'Ondertussen heeft de eigenaar of de planner geen tijd om elke reactie te bekijken, elke kandidaat te bellen en iedereen netjes af te wijzen. Het gevolg: kandidaten die afhaken en een slechte naam als werkgever.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'vakman die op zijn telefoon via WhatsApp op een vacature reageert', 'veryo' ), __( 'Werving automatiseren via WhatsApp', 'veryo' ), 'telefoon' ),
				'catalog'  => array(
					'h'   => __( 'Wat er mogelijk is in HR en werving', 'veryo' ),
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
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project' ) ),
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
	'ai-automatisering/rapportages'             => array(
		'title'     => __( 'Rapportages en dashboards automatiseren', 'veryo' ),
		'seo_title' => __( 'Rapportages en dashboards automatiseren met AI | Veryo', 'veryo' ),
		'desc'      => __( 'Rapportages automatiseren met AI: een ondernemersdashboard, elke maandag je cijfers in gewone taal en Excel zonder gedoe. Vraag een gratis offerte aan.', 'veryo' ),
		'kw'        => 'rapportages automatiseren',
		'schema'    => $veryo_q + array(
			'min' => 750,
			'max' => 25000,
		),
		'content'   => veryo_page_standard(
			array(
				'approach' => true,
				'answer'   => __( 'Veryo helpt MKB-bedrijven rapportages automatiseren: omzet, offertes, debiteuren, planning en leads in één dashboard, en elke maandag een kort bericht met je belangrijkste cijfers in gewone taal. Je krijgt vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
				'extra'    => array( __( 'Welke cijfers het meest opleveren', 'veryo' ), array( __( 'De meeste ondernemers hebben genoeg aan drie tot vijf cijfers: openstaande offertes en hun waarde, facturen die te lang openstaan, de bezetting van de planning voor de komende weken en het aantal nieuwe aanvragen. Wie die elke week ziet, stuurt eerder bij.', 'veryo' ), __( 'Een voorbeeld: een technisch bedrijf met vijftien mensen kan elke maandagochtend een bericht in Teams krijgen met die vier cijfers en twee zinnen uitleg. Het kost niemand tijd om te maken en het gesprek in het weekoverleg gaat meteen over wat er moet gebeuren.', 'veryo' ), __( 'Voor wie dieper wil kijken, is rendement per project of klanttype de volgende stap. Dan zie je welke klussen goed verdienen en welke structureel tegenvallen.', 'veryo' ) ) ),
				'problem'  => array(
					'h' => __( 'Cijfers bij elkaar zoeken', 'veryo' ),
					'p' => array(
						__( 'Je wilt weten hoe het gaat, maar daarvoor moet je in vier systemen kijken: de boekhouding, het offerteprogramma, de planning en een Excel met leads. Dus doe je het één keer per kwartaal, of als de accountant erom vraagt.', 'veryo' ),
						__( 'Ondertussen stuur je op gevoel. Je merkt pas laat dat de offertes teruglopen, dat een grote klant niet betaalt of dat een bepaald type klus structureel geld kost.', 'veryo' ),
					),
				),
				'photo'    => array( __( 'ondernemer die op maandagochtend op zijn telefoon het weekoverzicht leest', 'veryo' ), __( 'Rapportages automatiseren: maandagbericht met cijfers', 'veryo' ), 'kantoor' ),
				'catalog'  => array(
					'h'   => __( 'Welke rapportages je kunt automatiseren', 'veryo' ),
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
				'price'    => array( 'steps' => array( 'startpakket', 'quickwin', 'project', 'maatwerk' ) ),
				'faq'      => array(
					array( __( 'Moeten we een BI-pakket aanschaffen?', 'veryo' ), __( 'Meestal niet. Voor een MKB-bedrijf is een eenvoudig dashboard of een wekelijks bericht vaak genoeg. Als een BI-pakket echt nodig is, zeggen we dat.', 'veryo' ) ),
					array( __( 'Kan AI voorspellingen doen?', 'veryo' ), __( 'Met genoeg historische gegevens kun je werkaanbod, pieken en cashflow voorspellen. Dat is maatwerk en de betrouwbaarheid hangt sterk af van je data. We zijn daar vooraf eerlijk over.', 'veryo' ) ),
					array( __( 'Kunnen jullie onze Excel-bestanden opschonen?', 'veryo' ), __( 'Ja. Opschonen, samenvoegen en analyseren van Excel-bestanden is een quick win.', 'veryo' ) ),
					array( __( 'Hoe vaak wordt het dashboard bijgewerkt?', 'veryo' ), __( 'Dat hangt af van de koppelingen; meestal dagelijks of per uur. Het maandagbericht komt, zoals de naam zegt, elke maandag.', 'veryo' ) ),
				),
				'links'    => array(
					array( 'ai-automatisering/administratie', __( 'De administratieve kringloop', 'veryo' ), __( 'Van werkbon tot factuur', 'veryo' ) ),
					array( 'branches/bouw', __( 'AI in de bouw', 'veryo' ), __( 'Nacalculatie per project', 'veryo' ) ),
					array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Voor logistiek en dienstverlening', 'veryo' ) ),
				),
			)
		),
	),
);
