<?php
/**
 * Drie uitgeschreven gidsartikelen (status: concept): AI-geletterdheid en de AI Act, ChatGPT
 * voor verkopers en een AI-kennisbank opzetten. Feiten over wet- en regelgeving staan met
 * [CHECK] gemarkeerd: controleer die vóór publicatie bij de genoemde bron.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_g_article = static function ( $check, $intro, $sections, $faq, $sources, $cta ) {
	/* translators: %s: wat te controleren. */
	$out = veryo_b_p( sprintf( __( '[CONCEPT: controleer vóór publicatie: %s Haal deze notitie en de [CHECK]-markeringen daarna weg.]', 'veryo' ), $check ), array( 'className' => 'veryo-draft-note' ) );
	foreach ( $intro as $para ) {
		$out .= veryo_b_p( $para );
	}
	foreach ( $sections as $section ) {
		$out .= veryo_b_h( $section[0] );
		foreach ( (array) $section[1] as $para ) {
			$out .= veryo_b_p( $para );
		}
		if ( ! empty( $section[2] ) ) {
			$out .= veryo_b_list( $section[2], ! empty( $section[4] ) ? array( 'ordered' => true ) : array() );
		}
		if ( ! empty( $section[3] ) ) {
			foreach ( $section[3] as $sub ) {
				$out .= veryo_b_h( $sub[0], 3 );
				foreach ( (array) $sub[1] as $para ) {
					$out .= veryo_b_p( $para );
				}
			}
		}
	}
	$out .= veryo_sec_faq( $faq );
	$out .= veryo_b_h( __( 'Bronnen', 'veryo' ) );
	$out .= veryo_b_list( $sources );
	$out .= $cta;
	return $out;
};

$veryo_g_link = static function ( $slug, $label ) {
	return '<a href="' . esc_url( veryo_link( $slug ) ) . '">' . esc_html( $label ) . '</a>';
};

$veryo_g_collega = '<a href="' . esc_url( veryo_collega_url() ) . '">' . esc_html__( 'Veryo Collega', 'veryo' ) . '</a>';

return array(

	/* ------------------------------------------------------------------------- */
	'ai-geletterdheid-ai-act-mkb' => array(
		'title'     => __( 'AI-geletterdheid: wat de AI Act van werkgevers vraagt', 'veryo' ),
		'seo_title' => __( 'AI-geletterdheid: wat de AI Act van je vraagt | Veryo', 'veryo' ),
		'desc'      => __( 'AI-geletterdheid onder de AI Act: wat artikel 4 van werkgevers vraagt, voor wie het geldt en hoe je het in het mkb praktisch regelt. Met checklist.', 'veryo' ),
		'kw'        => 'ai geletterdheid werkgever',
		'content'   => $veryo_g_article(
			__( 'alle met [CHECK] gemarkeerde feiten over de AI Act, het toezicht en het Digital Omnibus-voorstel bij de officiële bronnen hieronder; de status van het Omnibus-voorstel kan sindsdien veranderd zijn.', 'veryo' ),
			array(
				__( 'Kort antwoord: sinds 2 februari 2025 moeten organisaties die AI-systemen gebruiken, zorgen dat hun medewerkers voldoende AI-geletterd zijn. Dat staat in artikel 4 van de Europese AI-verordening, de AI Act. Gebruiken jullie collega’s ChatGPT, Copilot of een andere AI-tool voor hun werk, dan geldt dit vrijwel zeker ook voor jullie. De wet schrijft geen vaste cursus of certificaat voor. Je moet kunnen laten zien dat je er serieus werk van hebt gemaakt, passend bij hoe jullie AI gebruiken. [CHECK]', 'veryo' ),
				__( 'In dit artikel lees je wat er precies in de wet staat, wat “voldoende” betekent voor een mkb-bedrijf, hoe je het in een paar stappen regelt en wat je beter niet kunt doen. Het is geen juridisch advies: twijfel je over je eigen situatie, vraag dan een jurist mee te kijken.', 'veryo' ),
			),
			array(
				array(
					__( 'Wat staat er in artikel 4 van de AI Act?', 'veryo' ),
					array(
						__( 'Artikel 4 is kort. Aanbieders en gebruiksverantwoordelijken van AI-systemen nemen maatregelen om, zoveel als mogelijk, te zorgen voor een toereikend niveau van AI-geletterdheid bij hun personeel en bij anderen die namens hen met AI-systemen werken. Daarbij houden ze rekening met de technische kennis, ervaring, opleiding en achtergrond van die mensen, en met de context waarin de AI wordt gebruikt. [CHECK: letterlijke tekst in de Nederlandse versie van Verordening (EU) 2024/1689]', 'veryo' ),
						__( 'Een “gebruiksverantwoordelijke” is in gewone taal: de organisatie die een AI-systeem onder eigen verantwoordelijkheid gebruikt. Dat is dus niet alleen het techbedrijf dat de AI bouwt, maar ook de installateur, het accountantskantoor of de beveiliger waarvan de medewerkers AI-tools inzetten in hun werk.', 'veryo' ),
						__( 'AI-geletterdheid zelf omschrijft de AI Act als de vaardigheden, kennis en het begrip om AI-systemen geïnformeerd in te zetten en je bewust te zijn van de kansen, de risico’s en de mogelijke schade. [CHECK: definitie in artikel 3, punt 56]', 'veryo' ),
					),
				),
				array(
					__( 'Geldt de plicht ook voor jullie bedrijf?', 'veryo' ),
					array(
						__( 'De plicht hangt niet af van de grootte van je bedrijf, maar van het gebruik. De vraag is dus niet “zijn we groot genoeg?”, maar “gebruiken we AI in ons werk?”. Een paar voorbeelden waarbij dat het geval is:', 'veryo' ),
					),
					array(
						__( 'Een verkoper laat ChatGPT een offertetekst of opvolgmail schrijven.', 'veryo' ),
						__( 'De administratie gebruikt een tool die facturen met AI uitleest.', 'veryo' ),
						__( 'Collega’s vatten notulen of documenten samen met Copilot.', 'veryo' ),
						__( 'Er draait een chatbot of telefoonassistent op je website of telefoonlijn.', 'veryo' ),
						__( 'Jullie werken met een interne AI-assistent op de eigen kennis, zoals Veryo Collega.', 'veryo' ),
					),
					array(
						array( __( 'Ook als niemand het officieel heeft ingevoerd', 'veryo' ), array( __( 'In veel mkb-bedrijven gebruiken medewerkers al AI zonder dat daar afspraken over zijn. Dat heet ook wel schaduw-AI. Juist dan is aandacht voor AI-geletterdheid nodig: de risico’s zijn het grootst als niemand weet welke gegevens waar in gaan.', 'veryo' ) ) ),
					),
				),
				array(
					__( 'Wat is “voldoende” AI-geletterdheid?', 'veryo' ),
					array(
						__( 'De wet noemt geen aantal uren, geen examen en geen verplicht certificaat. Wat voldoende is, hangt af van wie de AI gebruikt, waarvoor en met welke risico’s. Een receptionist die af en toe een mail laat herschrijven, heeft andere kennis nodig dan een HR-medewerker die AI gebruikt bij het selecteren van sollicitanten.', 'veryo' ),
						__( 'De Europese Commissie heeft in een vraag-en-antwoorddocument laten weten dat een certificaat niet nodig is en dat een interne registratie van trainingen en maatregelen kan volstaan. [CHECK: AI Literacy Q&A van de Europese Commissie] In de praktijk komt “voldoende” neer op drie dingen:', 'veryo' ),
					),
					array(
						'<strong>' . __( 'Kennis:', 'veryo' ) . '</strong> ' . __( 'collega’s weten wat AI kan, waar het de mist in gaat en waarom een antwoord dat overtuigend klinkt toch onjuist kan zijn.', 'veryo' ),
						'<strong>' . __( 'Risico’s:', 'veryo' ) . '</strong> ' . __( 'ze herkennen wanneer gegevens vertrouwelijk zijn, wat persoonsgegevens zijn onder de AVG en wanneer een uitkomst eerst door een mens gecontroleerd moet worden.', 'veryo' ),
						'<strong>' . __( 'Afspraken:', 'veryo' ) . '</strong> ' . __( 'er is duidelijk welke tools mogen, met welke gegevens, wie controleert en bij wie je terechtkunt met een vraag.', 'veryo' ),
					),
				),
				array(
					__( 'Zo regel je AI-geletterdheid in vijf stappen', 'veryo' ),
					array(
						__( 'Voor een mkb-bedrijf hoeft dit geen groot project te zijn. Met deze vijf stappen heb je de basis staan en kun je ook laten zien wat je hebt gedaan.', 'veryo' ),
					),
					array(
						'<strong>' . __( 'Breng in kaart wie welke AI gebruikt.', 'veryo' ) . '</strong> ' . __( 'Vraag het gewoon aan je team: welke tools, waarvoor, met welke gegevens. Een eenvoudige lijst is genoeg.', 'veryo' ),
						'<strong>' . __( 'Bepaal per groep wat ze moeten weten.', 'veryo' ) . '</strong> ' . __( 'Directie, verkoop, administratie en HR hebben elk andere risico’s. Pas het niveau daarop aan.', 'veryo' ),
						'<strong>' . __( 'Maak afspraken op papier.', 'veryo' ) . '</strong> ' . __( 'Een kort AI-beleid van één à twee pagina’s: welke tools mogen, wat niet in AI mag (zoals klantgegevens in een gratis account), en dat AI-output altijd wordt nagekeken.', 'veryo' ),
						'<strong>' . __( 'Train je team met eigen voorbeelden.', 'veryo' ) . '</strong> ' . __( 'Een algemene online video helpt weinig. Oefenen met taken uit het eigen werk blijft beter hangen en laat meteen zien waar de grenzen liggen.', 'veryo' ),
						'<strong>' . __( 'Leg vast wat je hebt gedaan en herhaal het.', 'veryo' ) . '</strong> ' . __( 'Noteer wie wanneer welke training kreeg en welke afspraken er zijn. Nieuwe collega’s en nieuwe tools vragen om een update, bijvoorbeeld één keer per jaar.', 'veryo' ),
					),
					array(),
					true,
				),
				array(
					__( 'Toezicht en handhaving: wat weten we?', 'veryo' ),
					array(
						__( 'De plicht geldt sinds 2 februari 2025. Het toezicht door nationale toezichthouders komt later op gang: de regels voor toezicht en sancties gelden vanaf 2 augustus 2026. In Nederland is de Autoriteit Persoonsgegevens aangewezen als coördinerend toezichthouder op algoritmes en AI; welke toezichthouder precies op artikel 4 let, was bij het schrijven nog niet volledig uitgewerkt. [CHECK: actuele stand van de Nederlandse uitvoeringswet]', 'veryo' ),
						__( 'De AI Act noemt in het boeteartikel geen aparte boete voor artikel 4. Dat betekent niet dat het vrijblijvend is: gaat er iets mis met AI, bijvoorbeeld een datalek of een verkeerde beslissing over een klant, dan zal een toezichthouder of rechter kijken of je medewerkers wisten wat ze deden. [CHECK]', 'veryo' ),
						__( 'In november 2025 heeft de Europese Commissie in het zogeheten Digital Omnibus-voorstel voorgesteld om de plicht uit artikel 4 af te zwakken tot een taak voor lidstaten en de Commissie om AI-geletterdheid te stimuleren. Dat is een voorstel, geen geldende wet. Tot het Europees Parlement en de Raad anders besluiten, geldt artikel 4 zoals het er staat. [CHECK: status van het Digital Omnibus-voorstel op de publicatiedatum]', 'veryo' ),
						__( 'Wat er ook verandert: een team dat weet hoe het veilig en slim met AI werkt, maakt minder fouten en haalt meer uit de tools. Dat is ook zonder wettelijke plicht de moeite waard.', 'veryo' ),
					),
				),
				array(
					__( 'Veelgemaakte fouten', 'veryo' ),
					array(),
					array(
						'<strong>' . __( 'Alleen een document rondsturen.', 'veryo' ) . '</strong> ' . __( 'Een beleid dat niemand leest, maakt niemand AI-geletterd. Bespreek het en oefen ermee.', 'veryo' ),
						'<strong>' . __( 'AI verbieden.', 'veryo' ) . '</strong> ' . __( 'Een verbod zorgt er vaak voor dat collega’s het stiekem toch gebruiken, zonder afspraken. Duidelijke spelregels werken beter.', 'veryo' ),
						'<strong>' . __( 'Iedereen dezelfde training geven.', 'veryo' ) . '</strong> ' . __( 'Wie met persoonsgegevens werkt, heeft meer nodig dan wie af en toe een tekst laat herschrijven.', 'veryo' ),
						'<strong>' . __( 'Niets vastleggen.', 'veryo' ) . '</strong> ' . __( 'Je kunt pas laten zien wat je hebt gedaan als je het hebt opgeschreven.', 'veryo' ),
					),
				),
				array(
					__( 'Hoe Veryo hierbij helpt', 'veryo' ),
					array(
						sprintf(
							/* translators: 1: link naar de AI-geletterdheid training, 2: link naar de AI-workshop. */
							__( 'Veryo geeft een %1$s voor teams in het mkb: op locatie of online, met voorbeelden uit jullie eigen werk en een kort AI-beleid dat jullie direct kunnen gebruiken. Wil je eerst kennismaken met AI zonder het wettelijke kader, dan past een %2$s beter.', 'veryo' ),
							$veryo_g_link( 'ai-training/ai-geletterdheid', __( 'training AI-geletterdheid', 'veryo' ) ),
							$veryo_g_link( 'ai-workshop', __( 'praktische AI-workshop', 'veryo' ) )
						),
						sprintf(
							/* translators: %s: link naar Veryo Collega. */
							__( 'Werken jullie met vertrouwelijke kennis, zoals prijzen, klantdossiers of werkinstructies? Dan is %s een optie: een lokale AI-assistent op jullie eigen kantoor, zodat die gegevens niet naar een externe cloud gaan.', 'veryo' ),
							$veryo_g_collega
						),
					),
				),
			),
			array(
				array( __( 'Moet ik een certificaat AI-geletterdheid hebben?', 'veryo' ), __( 'Nee. De AI Act vraagt geen certificaat. Je moet wel kunnen laten zien welke maatregelen je hebt genomen, bijvoorbeeld met een overzicht van trainingen en afspraken. [CHECK]', 'veryo' ) ),
				array( __( 'Geldt AI-geletterdheid ook als we alleen ChatGPT gebruiken?', 'veryo' ), __( 'Waarschijnlijk wel. ChatGPT is een AI-systeem, en als jullie het voor het werk gebruiken, zijn jullie gebruiksverantwoordelijke. Het niveau dat nodig is, hangt af van waarvoor jullie het gebruiken.', 'veryo' ) ),
				array( __( 'Hoe vaak moeten medewerkers getraind worden?', 'veryo' ), __( 'De wet noemt geen termijn. Een update bij nieuwe tools, nieuwe collega’s en minstens één keer per jaar is een verstandige vuistregel.', 'veryo' ) ),
				array( __( 'Is er een boete als we niets doen?', 'veryo' ), __( 'De AI Act noemt geen aparte boete voor artikel 4. Het toezicht start vanaf augustus 2026. Gaat er iets mis met AI, dan weegt mee of je team voldoende was voorbereid. [CHECK]', 'veryo' ) ),
			),
			array(
				__( 'Verordening (EU) 2024/1689 (AI-verordening), artikel 3 punt 56, artikel 4 en artikel 113, via EUR-Lex. [CHECK]', 'veryo' ),
				__( 'Europese Commissie, AI Literacy – Questions & Answers (2025). [CHECK]', 'veryo' ),
				__( 'Autoriteit Persoonsgegevens, “Aan de slag met AI-geletterdheid” (2025). [CHECK]', 'veryo' ),
				__( 'Europese Commissie, Digital Omnibus-voorstel over de AI-verordening (november 2025). [CHECK]', 'veryo' ),
			),
			veryo_sec_cta_demo( __( 'Jullie team AI-geletterd in één dagdeel', 'veryo' ), __( 'Plan een gratis kennismaking. We kijken samen welke AI jullie gebruiken en wat jullie team nodig heeft.', 'veryo' ) )
		),
	),

	/* ------------------------------------------------------------------------- */
	'chatgpt-voor-verkopers'      => array(
		'title'     => __( 'ChatGPT voor verkopers: 10 praktische toepassingen', 'veryo' ),
		'seo_title' => __( 'ChatGPT voor verkopers: 10 praktische toepassingen | Veryo', 'veryo' ),
		'desc'      => __( 'ChatGPT voor verkopers: tien praktische toepassingen, van gespreksvoorbereiding tot opvolgmail, met voorbeeldprompts en wat je níet in AI zet. Lees verder.', 'veryo' ),
		'kw'        => 'chatgpt voor verkopers',
		'content'   => $veryo_g_article(
			__( 'de beschrijving van de zakelijke abonnementen van ChatGPT en Copilot klopt met de actuele voorwaarden van die diensten.', 'veryo' ),
			array(
				__( 'Kort antwoord: ChatGPT is voor verkopers vooral een snelle schrijf- en denkpartner. Je gebruikt het om gesprekken voor te bereiden, opvolgmails en offerteteksten op te zetten, bezwaren te oefenen en verslagen samen te vatten. Het werkt het best als jij de klantkennis en het oordeel levert, en de AI het schrijfwerk. Klantgegevens zet je alleen in een zakelijke omgeving met goede afspraken, nooit in een gratis account.', 'veryo' ),
				__( 'Hieronder staan tien toepassingen die we in trainingen het vaakst zien werken bij verkopers in het mkb: accountmanagers, binnendienst en ondernemers die zelf verkopen. Bij elke toepassing staat een voorbeeldprompt die je zo kunt overnemen.', 'veryo' ),
			),
			array(
				array(
					__( 'Voordat je begint: drie spelregels', 'veryo' ),
					array(
						__( 'AI maakt een verkoper niet overbodig. Een klant koopt van iemand die zijn situatie begrijpt. ChatGPT helpt je om sneller te schrijven en beter voorbereid te zijn, maar het kent jullie klant niet en het weet niet wat er in het vorige gesprek is gezegd, tenzij jij dat vertelt.', 'veryo' ),
					),
					array(
						'<strong>' . __( 'Geen klantgegevens in een gratis account.', 'veryo' ) . '</strong> ' . __( 'Gebruik een zakelijk abonnement waarbij jullie gegevens volgens de voorwaarden niet voor training worden gebruikt, en haal namen en contactgegevens weg als het ook zonder kan. [CHECK]', 'veryo' ),
						'<strong>' . __( 'Altijd nalezen.', 'veryo' ) . '</strong> ' . __( 'AI kan prijzen, levertijden of productdetails verzinnen. Wat de deur uitgaat, controleer je zelf.', 'veryo' ),
						'<strong>' . __( 'Jouw toon, niet die van de AI.', 'veryo' ) . '</strong> ' . __( 'Geef voorbeelden van mails die je zelf goed vindt, dan schrijft de AI in jullie stijl in plaats van in standaard verkooptaal.', 'veryo' ),
					),
				),
				array(
					__( 'De 10 toepassingen', 'veryo' ),
					array(
						__( 'Elke toepassing begint met een duidelijke opdracht: wie je bent, wat je wilt bereiken, voor wie, en in welke vorm. Hoe meer context, hoe bruikbaarder het resultaat.', 'veryo' ),
					),
					array(),
					array(
						array( __( '1. Een klantgesprek voorbereiden', 'veryo' ), array( __( 'Laat ChatGPT op basis van openbare informatie over een bedrijf en je eigen aantekeningen een gespreksvoorbereiding maken: wat speelt er waarschijnlijk, welke vragen stel je, welke bezwaren kun je verwachten.', 'veryo' ), '<em>' . __( 'Voorbeeldprompt: “Ik ben accountmanager bij een installatiebedrijf. Morgen spreek ik een facilitair manager van een schoolbestuur. Geef me vijf open vragen om te ontdekken waar ze nu tegenaan lopen bij onderhoud.”', 'veryo' ) . '</em>' ) ),
						array( __( '2. Een opvolgmail na een gesprek', 'veryo' ), array( __( 'Plak je eigen korte aantekeningen in, zonder persoonsgegevens, en vraag om een opvolgmail met de afspraken en een duidelijke volgende stap. Je bent zo minuten in plaats van een kwartier kwijt.', 'veryo' ), '<em>' . __( 'Voorbeeldprompt: “Schrijf een korte, vriendelijke opvolgmail op basis van deze aantekeningen. Eindig met een voorstel voor een vervolgafspraak. Geen verkooptaal, maximaal 120 woorden.”', 'veryo' ) . '</em>' ) ),
						array( __( '3. Een offertetekst opzetten', 'veryo' ), array( __( 'De prijzen komen uit jullie eigen systeem, maar de begeleidende tekst kan AI opzetten: de samenvatting van de vraag van de klant, wat je voorstelt en waarom. Jij vult aan en controleert.', 'veryo' ) ) ),
						array( __( '4. Bezwaren oefenen', 'veryo' ), array( __( 'Laat ChatGPT de rol van een kritische inkoper spelen. Je oefent je antwoord op “te duur”, “we hebben al een leverancier” of “stuur maar wat informatie”. Zo ga je beter voorbereid het echte gesprek in.', 'veryo' ) ) ),
						array( __( '5. Een gespreksverslag samenvatten', 'veryo' ), array( __( 'Heb je een lang verslag of transcript, laat dan de kern, de afspraken en de open punten eruit halen. Let op: een opname van een gesprek bevat persoonsgegevens. Doe dit alleen in een zakelijke omgeving en met toestemming van wie je opneemt.', 'veryo' ) ) ),
						array( __( '6. Koude e-mails en LinkedIn-berichten', 'veryo' ), array( __( 'Vraag om drie korte varianten van een eerste bericht, elk met een andere invalshoek. Kies de beste en maak hem persoonlijk. Een bericht dat duidelijk door AI is geschreven, werkt averechts.', 'veryo' ) ) ),
						array( __( '7. Productinformatie vertalen naar klantvoordeel', 'veryo' ), array( __( 'Technische specificaties zeggen een klant weinig. Laat AI per specificatie beschrijven wat het de klant oplevert, voor een bepaald type klant. Controleer of het klopt.', 'veryo' ) ) ),
						array( __( '8. Een belscript of gespreksstructuur', 'veryo' ), array( __( 'Voor de binnendienst kan een eenvoudige structuur helpen: opening, twee vragen, één voorstel. AI zet een eerste versie neer, het team maakt hem eigen.', 'veryo' ) ) ),
						array( __( '9. Een lastige mail beantwoorden', 'veryo' ), array( __( 'Een boze klant of een klacht over een levering? Laat AI een rustige, feitelijke eerste versie schrijven. Dat helpt om de emotie eruit te halen voordat je reageert.', 'veryo' ) ) ),
						array( __( '10. Je eigen week plannen', 'veryo' ), array( __( 'Zet je lijst met klanten, open offertes en taken in en vraag om een prioriteitenlijst. AI weet niet wat het belangrijkst is voor jullie bedrijf, maar het helpt om overzicht te krijgen.', 'veryo' ) ) ),
					),
				),
				array(
					__( 'Zo bouw je een goede prompt voor verkoopwerk', 'veryo' ),
					array(
						__( 'De meeste teleurstellingen met ChatGPT komen door een te korte opdracht. “Schrijf een opvolgmail” levert een standaardmail op die je klant meteen herkent. Een goede prompt voor verkoopwerk heeft vier onderdelen, en kost je hooguit een minuut extra.', 'veryo' ),
					),
					array(
						'<strong>' . __( 'Rol en context:', 'veryo' ) . '</strong> ' . __( 'wie ben je, wat verkoop je, aan wie. Bijvoorbeeld: “Ik ben accountmanager bij een groothandel in technische onderdelen en verkoop aan installatiebedrijven.”', 'veryo' ),
						'<strong>' . __( 'Doel:', 'veryo' ) . '</strong> ' . __( 'wat moet de tekst bereiken? Een afspraak, een reactie op een offerte, een excuus na een late levering.', 'veryo' ),
						'<strong>' . __( 'Input:', 'veryo' ) . '</strong> ' . __( 'je eigen aantekeningen, de vraag van de klant of de punten die erin moeten, zonder persoonsgegevens als het ook zonder kan.', 'veryo' ),
						'<strong>' . __( 'Vorm:', 'veryo' ) . '</strong> ' . __( 'lengte, toon en opbouw. “Maximaal 120 woorden, je-vorm, geen uitroeptekens, eindig met één concrete vraag.”', 'veryo' ),
					),
					array(
						array(
							__( 'Laat de AI vragen stellen', 'veryo' ),
							array(
								__( 'Een handige truc: eindig je prompt met “Stel me eerst drie vragen als je informatie mist.” De AI vraagt dan naar wat er ontbreekt, zoals de levertijd of de naam van het product, in plaats van het zelf in te vullen. Dat voorkomt verzonnen details in een mail die naar een klant gaat.', 'veryo' ),
								__( 'Bewaar prompts die goed werken in een gedeeld document. Na een paar weken heeft het team een eigen bibliotheek, afgestemd op jullie producten en klanten.', 'veryo' ),
							),
						),
					),
				),
				array(
					__( 'Wat je níet in ChatGPT zet', 'veryo' ),
					array(
						__( 'De meeste risico’s ontstaan niet door de tool, maar door wat erin gaat. Spreek met elkaar af wat wel en niet mag. Een paar vuistregels:', 'veryo' ),
					),
					array(
						__( 'Geen namen, telefoonnummers of e-mailadressen van klanten als het niet nodig is.', 'veryo' ),
						__( 'Geen inkoopprijzen, marges of contracten in een tool zonder zakelijke afspraken.', 'veryo' ),
						__( 'Geen gegevens van derden die je niet zou mogen delen met een externe partij.', 'veryo' ),
						__( 'Geen beslissingen over klanten op basis van alleen AI-uitkomsten.', 'veryo' ),
					),
					array(
						array(
							__( 'Klantkennis zonder de cloud', 'veryo' ),
							array(
								sprintf(
									/* translators: %s: link naar Veryo Collega. */
									__( 'Wil je dat verkopers vragen kunnen stellen over jullie eigen prijslijsten, productinformatie en eerdere offertes, zonder dat die gegevens naar een externe cloud gaan? Dan is een lokale AI-assistent zoals %s een betere plek dan ChatGPT.', 'veryo' ),
									$veryo_g_collega
								),
							),
						),
					),
				),
				array(
					__( 'Zo maak je het een gewoonte in je verkoopteam', 'veryo' ),
					array(
						__( 'Losse tips leveren weinig op als iedereen het anders doet. Teams die echt tijd winnen, maken een paar vaste afspraken: welke tool, welke taken, en een gedeelde map met prompts die goed werken. Zo leert het hele team van wat één collega ontdekt.', 'veryo' ),
						__( 'Begin met twee of drie toepassingen waar jullie de meeste tijd aan kwijt zijn, meestal de opvolgmail en de offertetekst. Spreek na een maand af wat werkt en wat niet. Breid daarna pas uit.', 'veryo' ),
						sprintf(
							/* translators: 1: link naar de ChatGPT-training voor verkopers, 2: link naar AI-geletterdheid. */
							__( 'In de %1$s oefenen jullie dit met eigen offertes, mails en gesprekken, en maken we samen de afspraken over veilig gebruik. Dat telt meteen mee voor %2$s onder de AI Act.', 'veryo' ),
							$veryo_g_link( 'ai-training/chatgpt-training-verkopers', __( 'ChatGPT-training voor verkopers', 'veryo' ) ),
							$veryo_g_link( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid', 'veryo' ) )
						),
					),
				),
			),
			array(
				array( __( 'Mag ik klantgegevens in ChatGPT zetten?', 'veryo' ), __( 'Alleen in een zakelijke omgeving met goede afspraken, en alleen als het nodig is. In een gratis of persoonlijk account zet je geen klantgegevens. Haal namen en contactgegevens weg als het ook zonder kan.', 'veryo' ) ),
				array( __( 'Is ChatGPT beter dan Copilot voor verkopers?', 'veryo' ), __( 'Dat hangt af van wat jullie al gebruiken. Copilot zit in Microsoft 365 en kan bij je mail en documenten, ChatGPT is een losse tool. Voor schrijfwerk doen ze veel hetzelfde; de keuze hangt vooral af van jullie IT-omgeving en afspraken.', 'veryo' ) ),
				array( __( 'Merken klanten dat een mail met AI is geschreven?', 'veryo' ), __( 'Vaak wel, als je de tekst niet aanpast. Gebruik AI voor de eerste versie en maak hem daarna persoonlijk, met iets wat alleen jij over deze klant weet.', 'veryo' ) ),
				array( __( 'Hoeveel tijd levert het op?', 'veryo' ), __( 'Dat verschilt per verkoper en per taak. Meet het zelf: noteer een week lang hoeveel tijd opvolgmails en offerteteksten kosten, en doe dat nog eens na een maand werken met AI.', 'veryo' ) ),
			),
			array(
				__( 'OpenAI, Enterprise privacy en zakelijke voorwaarden van ChatGPT (Team, Enterprise). [CHECK]', 'veryo' ),
				__( 'Autoriteit Persoonsgegevens, informatie over AI-chatbots en persoonsgegevens. [CHECK]', 'veryo' ),
				__( 'Verordening (EU) 2024/1689 (AI-verordening), artikel 4 over AI-geletterdheid. [CHECK]', 'veryo' ),
			),
			veryo_sec_cta_demo( __( 'Jullie verkoopteam sneller met AI', 'veryo' ), __( 'Plan een gratis kennismaking voor de ChatGPT-training voor verkopers, met voorbeelden uit jullie eigen werk.', 'veryo' ) )
		),
	),

	/* ------------------------------------------------------------------------- */
	'ai-kennisbank-opzetten'      => array(
		'title'     => __( 'Een AI-kennisbank voor je bedrijf opzetten: zo pak je het aan', 'veryo' ),
		'seo_title' => __( 'AI-kennisbank voor je bedrijf opzetten: stappenplan | Veryo', 'veryo' ),
		'desc'      => __( 'Een AI-kennisbank opzetten voor je bedrijf: welke documenten erin horen, cloud of lokaal, rechten per medewerker en de stappen om te beginnen. Lees meer.', 'veryo' ),
		'kw'        => 'ai kennisbank bedrijf',
		'content'   => $veryo_g_article(
			__( 'de technische beschrijving van RAG en de verwijzingen naar AVG en AI Act.', 'veryo' ),
			array(
				__( 'Kort antwoord: een AI-kennisbank is een verzameling van de documenten van je bedrijf, zoals werkinstructies, prijslijsten, handleidingen en eerdere offertes, waarin collega’s met gewone vragen kunnen zoeken. De AI zoekt het antwoord op in jullie eigen documenten en laat zien waar het staat. Je zet er een op door eerst te kiezen welke vragen hij moet beantwoorden, daarna de juiste documenten te verzamelen en op te schonen, rechten per medewerker te regelen en klein te beginnen met één team.', 'veryo' ),
				__( 'In deze gids lees je hoe een AI-kennisbank werkt, welke keuzes je moet maken en welke stappen je zet. We schrijven het vanuit de praktijk van mkb-bedrijven, waar kennis vaak in de hoofden van een paar ervaren mensen zit en in mappen die alleen zij kunnen vinden.', 'veryo' ),
			),
			array(
				array(
					__( 'Wat is een AI-kennisbank en hoe werkt hij?', 'veryo' ),
					array(
						__( 'Een gewone zoekfunctie zoekt op woorden. Typ je “garantie warmtepomp”, dan vind je documenten waarin die woorden staan. Een AI-kennisbank begrijpt de vraag. Vraag je “hoe lang hebben klanten garantie als de compressor kapot is?”, dan zoekt hij de passages die daarover gaan, ook als die woorden er niet letterlijk in staan, en formuleert hij een antwoord.', 'veryo' ),
						__( 'Technisch heet dit vaak RAG: retrieval-augmented generation. De documenten worden in stukken opgedeeld en doorzoekbaar gemaakt. Bij een vraag haalt het systeem eerst de relevante stukken op en geeft die aan een taalmodel, dat er een antwoord van maakt. Een goede kennisbank toont daarbij de bron, zodat de collega kan nagaan of het klopt.', 'veryo' ),
						__( 'Belangrijk om te weten: het taalmodel leert niet van jullie documenten in de zin van “trainen”. Het leest ze op het moment van de vraag. Pas je een document aan, dan geeft de kennisbank daarna het nieuwe antwoord.', 'veryo' ),
					),
				),
				array(
					__( 'Waarom een AI-kennisbank voor het mkb?', 'veryo' ),
					array(
						__( 'In veel bedrijven gaat een groot deel van de dag op aan zoeken en vragen. Nieuwe collega’s lopen steeds bij dezelfde ervaren mensen langs. Monteurs bellen naar kantoor voor een storingscode. De binnendienst zoekt in drie mappen naar de juiste voorwaarden. En als een ervaren collega met pensioen gaat, gaat er kennis mee de deur uit.', 'veryo' ),
					),
					array(
						__( 'Nieuwe collega’s vinden zelf antwoorden en zijn sneller zelfstandig.', 'veryo' ),
						__( 'Ervaren collega’s worden minder vaak gestoord met dezelfde vragen.', 'veryo' ),
						__( 'Antwoorden zijn consistenter, omdat ze uit dezelfde bron komen.', 'veryo' ),
						__( 'Kennis blijft in het bedrijf, ook als iemand vertrekt.', 'veryo' ),
					),
				),
				array(
					__( 'Cloud of lokaal: waar staat jullie kennis?', 'veryo' ),
					array(
						__( 'Dit is de belangrijkste keuze. Bij een cloudoplossing worden jullie documenten verwerkt op servers van een externe partij. Dat is snel ingericht, maar je moet goed kijken naar de voorwaarden: waar staan de servers, wie heeft toegang en wat gebeurt er met de gegevens. Voor documenten met persoonsgegevens heb je onder de AVG onder meer een verwerkersovereenkomst nodig. [CHECK]', 'veryo' ),
						__( 'Bij een lokale kennisbank draait de AI op een eigen machine binnen het bedrijf. De documenten en de vragen verlaten het kantoor niet. Dat is vaak de betere keuze als het gaat om prijzen, klantdossiers, contracten, personeelsinformatie of technische kennis die jullie concurrentievoordeel is.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar Veryo Collega. */
							__( '%s is zo’n lokale AI-assistent en kennisbank: Veryo zet een machine op jullie kantoor neer, vult die met jullie documenten, regelt de rechten en houdt alles bij. Veryo bouwt daarvoor geen eigen software, maar richt bewezen open-source AI in en koppelt die aan wat jullie al gebruiken.', 'veryo' ),
							$veryo_g_collega
						),
					),
				),
				array(
					__( 'Stappenplan: een AI-kennisbank opzetten', 'veryo' ),
					array(
						__( 'Deze stappen gelden of je nu voor een cloudoplossing kiest of voor een lokale.', 'veryo' ),
					),
					array(),
					array(
						array( __( 'Stap 1: kies de vragen, niet de documenten', 'veryo' ), array( __( 'Begin niet met “we zetten alles erin”. Vraag aan een paar collega’s welke vragen ze het vaakst stellen of krijgen. Twintig echte vragen zijn een prima start. Ze bepalen welke documenten nodig zijn en vormen later je test.', 'veryo' ) ) ),
						array( __( 'Stap 2: verzamel en schoon de bronnen op', 'veryo' ), array( __( 'Zoek de documenten die de antwoorden bevatten. Haal oude versies en dubbele bestanden weg: een kennisbank met drie verschillende prijslijsten geeft drie verschillende antwoorden. Kennis die alleen in hoofden zit, leg je vast in korte notities of door een ervaren collega te interviewen.', 'veryo' ) ) ),
						array( __( 'Stap 3: regel wie wat mag zien', 'veryo' ), array( __( 'Niet iedereen hoeft alles te zien. Salarisinformatie, personeelsdossiers en marges horen alleen bij wie daar recht op heeft. Een goede kennisbank houdt rekening met rechten per medewerker of per groep, zodat de AI een collega alleen antwoorden geeft uit documenten die die collega ook zonder AI mag inzien.', 'veryo' ) ) ),
						array( __( 'Stap 4: begin met één team', 'veryo' ), array( __( 'Start met één afdeling, bijvoorbeeld de binnendienst of de werkplaats. Laat ze een paar weken werken met de kennisbank en verzamel waar de antwoorden niet goed zijn. Meestal ligt dat aan een ontbrekend of verouderd document, niet aan de AI.', 'veryo' ) ) ),
						array( __( 'Stap 5: spreek af wie de kennis bijhoudt', 'veryo' ), array( __( 'Een kennisbank is nooit af. Wijs per onderwerp iemand aan die de documenten actueel houdt. Plan een vast moment, bijvoorbeeld elk kwartaal, om te kijken welke vragen geen goed antwoord kregen.', 'veryo' ) ) ),
						array( __( 'Stap 6: leer het team ermee werken', 'veryo' ), array( __( 'Collega’s moeten weten wat de kennisbank wel en niet kan, en dat ze de bron controleren bij belangrijke beslissingen. Dat hoort ook bij AI-geletterdheid onder de AI Act.', 'veryo' ) ) ),
					),
				),
				array(
					__( 'Veelgemaakte fouten', 'veryo' ),
					array(),
					array(
						'<strong>' . __( 'Alles in één keer erin zetten.', 'veryo' ) . '</strong> ' . __( 'Meer documenten betekent niet betere antwoorden. Rommel erin is rommel eruit.', 'veryo' ),
						'<strong>' . __( 'Geen bronvermelding.', 'veryo' ) . '</strong> ' . __( 'Zonder bron kan niemand controleren of een antwoord klopt, en verdwijnt het vertrouwen snel.', 'veryo' ),
						'<strong>' . __( 'Rechten vergeten.', 'veryo' ) . '</strong> ' . __( 'Een kennisbank die iedereen alles laat zien, is een datalek dat wacht om te gebeuren.', 'veryo' ),
						'<strong>' . __( 'Geen eigenaar.', 'veryo' ) . '</strong> ' . __( 'Zonder iemand die het bijhoudt, veroudert de kennisbank binnen een jaar.', 'veryo' ),
					),
				),
				array(
					__( 'Wat heb je nodig om te beginnen?', 'veryo' ),
					array(
						__( 'Minder dan je denkt. Een lijst met de vragen die het vaakst terugkomen, de mappen waar de antwoorden staan en één of twee collega’s die willen meedenken. De technische kant, het inrichten van de AI, het koppelen aan jullie bestanden en het regelen van de rechten, kun je laten doen.', 'veryo' ),
						sprintf(
							/* translators: 1: link naar Veryo Collega, 2: link naar de AI-training. */
							__( 'Wil je zien hoe dat eruitziet met jullie eigen documenten? Plan een demo van %1$s. Wil je eerst je team leren werken met AI, dan is een %2$s een goede eerste stap.', 'veryo' ),
							$veryo_g_collega,
							$veryo_g_link( 'ai-training', __( 'AI-training', 'veryo' ) )
						),
					),
				),
			),
			array(
				array( __( 'Wat is het verschil tussen een AI-kennisbank en ChatGPT?', 'veryo' ), __( 'ChatGPT antwoordt op basis van algemene kennis. Een AI-kennisbank antwoordt op basis van jullie eigen documenten en laat zien waar het antwoord staat. Bij een lokale kennisbank verlaten die documenten het bedrijf niet.', 'veryo' ) ),
				array( __( 'Welke documenten kun je in een AI-kennisbank zetten?', 'veryo' ), __( 'De meeste gangbare documenten: Word, pdf, tekstbestanden en vaak ook e-mails of exports uit andere systemen. Belangrijker dan het formaat is dat de inhoud actueel en eenduidig is.', 'veryo' ) ),
				array( __( 'Kan de kennisbank fouten maken?', 'veryo' ), __( 'Ja. Daarom toont een goede kennisbank de bron, en spreek je af dat collega’s die bij belangrijke beslissingen controleren. De meeste fouten komen door verouderde of tegenstrijdige documenten.', 'veryo' ) ),
				array( __( 'Is een AI-kennisbank AVG-proof?', 'veryo' ), __( 'Dat hangt af van waar de gegevens worden verwerkt en hoe de rechten zijn geregeld. Een lokale kennisbank maakt het eenvoudiger, omdat de gegevens binnen het bedrijf blijven. Je blijft zelf verantwoordelijk voor wat je met persoonsgegevens doet.', 'veryo' ) ),
			),
			array(
				__( 'Autoriteit Persoonsgegevens, informatie over verwerkersovereenkomsten en AI. [CHECK]', 'veryo' ),
				__( 'Lewis e.a., “Retrieval-Augmented Generation for Knowledge-Intensive NLP Tasks” (2020), het oorspronkelijke artikel over RAG. [CHECK]', 'veryo' ),
				__( 'Verordening (EU) 2024/1689 (AI-verordening), artikel 4 over AI-geletterdheid. [CHECK]', 'veryo' ),
			),
			veryo_sec_cta_demo( __( 'Jullie eigen AI-kennisbank zien werken?', 'veryo' ), __( 'Plan een gratis demo van Veryo Collega, de lokale AI-assistent voor jullie eigen kennis.', 'veryo' ) )
		),
	),
);
