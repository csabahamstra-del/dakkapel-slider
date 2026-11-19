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
			__( 'alle met [CHECK] gemarkeerde feiten over de AI Act, de Digital Omnibus en het toezicht bij de officiële bronnen hieronder, vooral de letterlijke tekst van het gewijzigde artikel 4 op EUR-Lex.', 'veryo' ),
			array(
				__( 'Kort antwoord: artikel 4 van de Europese AI-verordening, de AI Act, geldt sinds 2 februari 2025. Sinds de wijziging door de Digital Omnibus op 27 juli 2026 vraagt het organisaties die AI inzetten om maatregelen te nemen die de AI-geletterdheid van hun medewerkers ondersteunen. Een vast kennisniveau per persoon hoeft niet gegarandeerd te worden, maar de plicht zelf blijft bindend. Gebruiken jullie collega’s ChatGPT, Copilot of een andere AI-tool voor hun werk, dan geldt dit vrijwel zeker ook voor jullie. De wet schrijft geen vaste cursus of certificaat voor. Je moet kunnen laten zien dat je er serieus werk van hebt gemaakt, passend bij hoe jullie AI gebruiken. [CHECK]', 'veryo' ),
				__( 'In dit artikel lees je wat er precies in de wet staat, welke maatregelen passen bij een mkb-bedrijf, hoe je het in een paar stappen regelt en wat je beter niet kunt doen. Het is geen juridisch advies: twijfel je over je eigen situatie, vraag dan een jurist mee te kijken.', 'veryo' ),
			),
			array(
				array(
					__( 'Wat staat er in artikel 4 van de AI Act?', 'veryo' ),
					array(
						__( 'Artikel 4 is kort. In de oorspronkelijke tekst moesten aanbieders en gebruiksverantwoordelijken zoveel als mogelijk zorgen voor een toereikend niveau van AI-geletterdheid bij hun personeel. Sinds de Digital Omnibus (Verordening (EU) 2026/1744, van kracht sinds 27 juli 2026) moeten ze maatregelen nemen die de ontwikkeling van AI-geletterdheid ondersteunen, bij hun personeel en bij anderen die namens hen met AI-systemen werken. Een bepaald niveau per persoon hoeft niet gegarandeerd te worden. [CHECK: letterlijke tekst van het gewijzigde artikel 4 op EUR-Lex]', 'veryo' ),
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
					__( 'Welke maatregelen zijn genoeg?', 'veryo' ),
					array(
						__( 'De wet noemt geen aantal uren, geen examen en geen verplicht certificaat. Welke maatregelen passen, hangt af van wie de AI gebruikt, waarvoor en met welke risico’s. Een receptionist die af en toe een mail laat herschrijven, heeft andere kennis nodig dan een HR-medewerker die AI gebruikt bij het selecteren van sollicitanten.', 'veryo' ),
						__( 'De Europese Commissie heeft in een vraag-en-antwoorddocument laten weten dat een certificaat niet nodig is en dat een interne registratie van trainingen en maatregelen kan volstaan. [CHECK: AI Literacy Q&A van de Europese Commissie] In de praktijk komen goede maatregelen neer op drie dingen:', 'veryo' ),
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
						__( 'Met de Digital Omnibus is artikel 4 per 27 juli 2026 gewijzigd. De plicht is minder streng geformuleerd: organisaties moeten maatregelen nemen die AI-geletterdheid ondersteunen, in plaats van een toereikend niveau te garanderen. De plicht zelf is niet verdwenen en blijft bindend. Wie aantoonbaar traint en afspraken maakt, zit dus goed. [CHECK: Verordening (EU) 2026/1744]', 'veryo' ),
						__( 'Los van de wet: een team dat weet hoe het veilig en slim met AI werkt, maakt minder fouten en haalt meer uit de tools. Dat is ook zonder wettelijke plicht de moeite waard.', 'veryo' ),
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
							/* translators: 1: link naar het AI-Startpakket, 2: link naar de diensten. */
							__( 'Veryo geeft geen losse trainingen, maar bouwt en richt AI in. Bij elke oplevering leren we jullie team ermee werken: wat de toepassing doet, wat wel en niet mag en waar de grenzen liggen. Het %1$s bevat ook een kort AI-beleid dat jullie direct kunnen gebruiken. Bekijk %2$s.', 'veryo' ),
							$veryo_g_link( 'ai-startpakket', __( 'AI-Startpakket', 'veryo' ) ),
							$veryo_g_link( 'diensten', __( 'wat Veryo bouwt en inricht', 'veryo' ) )
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
				__( 'Verordening (EU) 2026/1744 (Digital Omnibus over AI), van kracht sinds 27 juli 2026, via EUR-Lex. [CHECK]', 'veryo' ),
			),
			veryo_sec_cta_demo( __( 'Jullie team AI-geletterd in één dagdeel', 'veryo' ), __( 'Plan een gratis kennismaking. We kijken samen welke AI jullie gebruiken en wat jullie team nodig heeft.', 'veryo' ) )
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
							/* translators: 1: link naar Veryo Collega, 2: link naar de AI-werkplek. */
							__( 'Wil je zien hoe dat eruitziet met jullie eigen documenten? Plan een demo van %1$s. Werken jullie liever in de cloud met jullie eigen normen en templates, kijk dan naar de %2$s.', 'veryo' ),
							$veryo_g_collega,
							$veryo_g_link( 'ai-werkplek', __( 'AI-werkplek met Claude Team', 'veryo' ) )
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
