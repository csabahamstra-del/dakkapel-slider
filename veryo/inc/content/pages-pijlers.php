<?php
/**
 * Pijlers: de AI-werkplek (Claude Team), AI-agents en veilig AI-gebruik.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/*
 * De AI-werkplek: /ai-werkplek/
 */
$veryo_werkplek = veryo_page_standard(
	array(
		'contact'     => array(
			__( 'Welk voorbereidend werk wil je sneller doen?', 'veryo' ),
			__( 'Vertel welk werk jullie engineers of werkvoorbereiders steeds opnieuw doen, en met hoeveel mensen. Jullie horen binnen één werkdag hoe we Claude Team daarvoor zouden inrichten.', 'veryo' ),
			__( 'Bijvoorbeeld: bij elke aanvraag lezen we een bestek van tachtig pagina’s door om de eisen eruit te halen.', 'veryo' ),
		),
		'answer_cta'  => array( __( 'Plan een kennismaking', 'veryo' ), '#vraag', 'amber' ),
		'answer'      => __( 'Claude Team inrichten voor technische bedrijven: wij richten Claude Team in met de eigen normen, kengetallen, sjablonen en documenten van jullie bedrijf. Zo krijgt jullie team een AI-werkplek die jullie werk kent. Daarmee lezen engineers en werkvoorbereiders sneller een bestek, zetten ze een calculatieopzet klaar, controleren ze uitgangspunten en schrijven ze rapportages in jullie eigen opmaak. De engineer blijft eindverantwoordelijk. De licenties betalen jullie rechtstreeks aan Anthropic; Veryo richt de werkplek in en na de oplevering leren we jullie team ermee werken.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'Een losse chatbot kent jullie werk niet', 'veryo' ),
			'p' => array(
				__( 'Een AI-chatbot die iedereen op eigen houtje gebruikt, weet niets van de normen waarmee jullie rekenen, de kengetallen uit eerdere projecten of de manier waarop jullie een rapport opbouwen. Het antwoord is dan algemeen, en wie het controleert moet alles opnieuw nalopen.', 'veryo' ),
				__( 'Daarom richten we Claude Team in rond jullie eigen werk: de documenten, normen en templates die jullie al gebruiken, en afspraken over wat er wel en niet in mag. Zo bereidt de AI voor zoals jullie het zelf zouden doen, en ziet de engineer in één keer wat er klopt en wat niet.', 'veryo' ),
			),
		),
		'photo'       => array( __( 'werkplekken met beeldschermen op kantoor', 'veryo' ), __( 'De AI-werkplek met Claude Team op een technisch kantoor', 'veryo' ), 'werkplek' ),
		'sections'    => array(
			array(
				'h'     => __( 'Waar technische kantoren Claude Team voor gebruiken', 'veryo' ),
				'list'  => array(
					'<strong>' . __( 'Bestek lezen.', 'veryo' ) . '</strong> ' . __( 'De eisen, uitsluitingen en risico’s uit een bestek of aanvraag op een rij, met verwijzing naar de paragraaf.', 'veryo' ),
					'<strong>' . __( 'Calculatieopzet.', 'veryo' ) . '</strong> ' . __( 'Een eerste opzet van de calculatie op basis van jullie eigen kengetallen, klaar om door te rekenen.', 'veryo' ),
					'<strong>' . __( 'Uitgangspunten controleren.', 'veryo' ) . '</strong> ' . __( 'Ontbrekende gegevens en tegenstrijdigheden in tekeningen, bestek en uitgangspunten opsporen voordat het werk begint.', 'veryo' ),
					'<strong>' . __( 'Werkvoorbereiding.', 'veryo' ) . '</strong> ' . __( 'Werkplannen, materiaallijsten en vragenlijsten voor de klant opzetten in jullie eigen format.', 'veryo' ),
					'<strong>' . __( 'Rapportages.', 'veryo' ) . '</strong> ' . __( 'Opleverrapporten, adviezen en verslagen in jullie eigen template, op basis van aantekeningen en metingen.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h'     => __( 'Wat “inrichten” precies inhoudt', 'veryo' ),
				'p'     => array( __( 'Claude Team zelf is een abonnement dat jullie in een paar minuten afsluiten. Het verschil zit in de inrichting: zonder die stap is het een algemene chatbot, met die stap een werkplek die jullie normen, sjablonen en projectkennis kent.', 'veryo' ) ),
				'list'  => array(
					'<strong>' . __( 'Projecten en kennisbanken.', 'veryo' ) . '</strong> ' . __( 'Per soort werk, zoals calculatie, werkvoorbereiding of rapportage, een eigen project met de juiste documenten en vaste instructies.', 'veryo' ),
					'<strong>' . __( 'Jullie normen, kengetallen en sjablonen.', 'veryo' ) . '</strong> ' . __( 'We zetten de documenten waarmee jullie werken klaar in Claude, zodat de uitkomst in jullie eigen opmaak en met jullie eigen uitgangspunten komt.', 'veryo' ),
					'<strong>' . __( 'Rollen, rechten en afspraken over veilig gebruik.', 'veryo' ) . '</strong> ' . __( 'Wie welke projecten en documenten ziet, wie beheert, en welke gegevens er nooit in gaan. Dat leggen we vast in een kort AI-beleid.', 'veryo' ),
					'<strong>' . __( 'Koppelingen waar het helpt.', 'veryo' ) . '</strong> ' . __( 'Waar het kan, koppelen we Claude aan de opslag en systemen die jullie al gebruiken. Overstappen is niet nodig.', 'veryo' ),
					'<strong>' . __( 'Na de oplevering leren we jullie team ermee werken.', 'veryo' ) . '</strong> ' . __( 'Op de ingerichte werkplek, met jullie eigen bestekken en sjablonen, zodat iedereen weet wat het kan en waar je op let.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'De engineer blijft eindverantwoordelijk', 'veryo' ),
				'p' => array(
					__( 'Claude bereidt voor en controleert; het neemt geen beslissingen. Een berekening, advies of rapport gaat pas de deur uit als een engineer het heeft nagelopen en ondertekend. Dat staat ook in het AI-beleid dat we samen opstellen.', 'veryo' ),
				),
			),
			array(
				'h'     => __( 'Claude Team, ChatGPT Team of Microsoft Copilot?', 'veryo' ),
				'p'     => array(
					__( 'Alle drie zijn zakelijke AI-werkplekken, en alle drie kunnen een team helpen. Welke het beste past, hangt vooral af van jullie werk en de software die jullie al gebruiken. Een eerlijke vergelijking op hoofdlijnen:', 'veryo' ),
				),
				'list'  => array(
					'<strong>' . __( 'Werken jullie vooral met lange documenten,', 'veryo' ) . '</strong> ' . __( 'zoals bestekken, normen en rapporten, en wil je dat de AI met jullie eigen projectkennis werkt? Daarvoor werken wij met Claude Team: het werkt met projecten waarin jullie eigen documenten en instructies klaarstaan.', 'veryo' ),
					'<strong>' . __( 'Werkt iedereen de hele dag in Word, Outlook en Teams?', 'veryo' ) . '</strong> ' . __( 'Dan is het goed om ook naar Microsoft Copilot te kijken. Claude Team heeft daarnaast een eigen koppeling met Microsoft 365.', 'veryo' ),
					'<strong>' . __( 'Gebruikt het team ChatGPT al veel?', 'veryo' ) . '</strong> ' . __( 'Dan nemen we dat mee in het advies. We kiezen niet voor een merk, maar voor wat bij jullie werk past, en zeggen het eerlijk als iets anders beter aansluit.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'Licenties en gegevens', 'veryo' ),
				'p' => array(
					__( 'Claude Team is een zakelijk abonnement van Anthropic. De licenties sluiten jullie zelf af en betalen jullie rechtstreeks aan Anthropic; Veryo verkoopt geen licenties en verdient er niets aan. Volgens Anthropic worden de gegevens van Team-klanten standaard niet gebruikt om AI-modellen te trainen. Gebruiken medewerkers daarnaast andere AI-tools, dan nemen we die mee in de afspraken.', 'veryo' ),
				),
			),
		),
		'no_steps'    => true,
		'after_price' => veryo_sec_tiered_price(
			__( 'Wat kost de AI-werkplek?', 'veryo' ),
			__( 'Het inrichten is een vaste prijs, inclusief het werken met jullie team na de oplevering. De licenties van Claude Team betalen jullie rechtstreeks aan Anthropic.', 'veryo' ),
			array(),
			''
		) . veryo_sec_ongoing( 'werkplek-onderhoud' ),
		'faq'         => array(
			array( __( 'Wat is Claude Team?', 'veryo' ), __( 'Het zakelijke abonnement op Claude, de AI-assistent van Anthropic, voor teams. Medewerkers werken in gedeelde projecten met de documenten en instructies van het bedrijf.', 'veryo' ) ),
			array( __( 'Wat kost Claude Team?', 'veryo' ), __( 'De licenties nemen jullie rechtstreeks af bij Anthropic, tegen hun actuele prijs per gebruiker. Veryo rekent een vaste prijs voor het inrichten en biedt daarna optioneel doorlopend onderhoud.', 'veryo' ) ),
			array( __( 'Is Claude Team veilig voor bedrijfsgegevens?', 'veryo' ), __( 'Volgens Anthropic worden de gesprekken en documenten van Team-klanten standaard niet gebruikt om modellen te trainen, en vallen ze onder de zakelijke voorwaarden met een verwerkersovereenkomst (DPA). Daarnaast spreken we samen af welke gegevens er nooit in gaan, zoals persoonsgegevens van klanten die er niet nodig zijn.', 'veryo' ) ),
			array( __( 'Neemt de AI beslissingen over?', 'veryo' ), __( 'Nee. Claude bereidt voor en controleert. De engineer blijft eindverantwoordelijk voor elke berekening, elk advies en elk rapport.', 'veryo' ) ),
			array( __( 'Moeten we andere software gaan gebruiken?', 'veryo' ), __( 'Nee. Claude Team komt naast de software die jullie al hebben. Overstappen is nooit nodig.', 'veryo' ) ),
			array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo doet geen algemeen IT-beheer, netwerken of helpdesk. Alleen de machine waarop [veryo_collega_naam] draait, beheren we zelf. Heb je een vaste IT-beheerder, dan werken we graag met die samen.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
			array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Calculatie en werkvoorbereiding', 'veryo' ) ),
			array( 'ai-automatisering/administratie', __( 'De administratieve kringloop', 'veryo' ), __( 'Van werkbon tot factuur en salaris', 'veryo' ) ),
			array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid, rechten en de veiligheidscheck', 'veryo' ) ),
			array( 'ai-agents', __( 'AI-agents voor bedrijven', 'veryo' ), __( 'Digitale collega’s voor terugkerend werk', 'veryo' ) ),
		),
	)
);

/*
 * AI-agents: /ai-agents/
 */
$veryo_agents = veryo_page_standard(
	array(
		'contact'     => array(
			__( 'Welk werk kan een digitale collega overnemen?', 'veryo' ),
			__( 'Beschrijf een taak die steeds terugkomt. Je hoort binnen één werkdag of een AI-agent daar zinvol is.', 'veryo' ),
			__( 'Bijvoorbeeld: alle inkomende storingsmeldingen sorteren en inplannen.', 'veryo' ),
		),
		'answer_cta'  => array( __( 'Bespreek een taak voor een agent', 'veryo' ), '#vraag', 'amber' ),
		'answer'      => __( 'Veryo bouwt AI-agents voor bedrijven in heel Nederland, vanuit Leeuwarden. Een AI-agent is een digitale collega die een terugkerende taak zelfstandig voorbereidt: hij leest, zoekt informatie op en voert een paar stappen uit in jullie eigen systemen, zoals een conceptmail klaarzetten of een aanvraag compleet maken. Veryo richt AI-agents voor bedrijven in bovenop de software die jullie al gebruiken, met een mens die goedkeurt wat ertoe doet. Jullie krijgen vooraf een gratis offerte met een vaste prijs.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'Werk dat elke dag hetzelfde gaat, maar net te veel denkwerk is voor een simpele regel', 'veryo' ),
			'p' => array(
				__( 'Sommige taken komen elke dag terug en volgen een vast patroon, maar vragen toch even lezen en beoordelen. Een aanvraag binnenkrijgen, kijken wat de klant wil, de juiste gegevens erbij zoeken en een conceptantwoord klaarzetten. Een factuur openen, de leverancier en het project herkennen en hem op de goede plek boeken. Voor een gewone automatisering is dat te rommelig; voor een medewerker is het saai werk dat blijft liggen.', 'veryo' ),
				__( 'Daar zijn AI-agents voor. Een agent leest, beoordeelt en voert een paar stappen uit in je eigen systemen. Hij doet het voorbereidende werk, en een mens keurt goed wat ertoe doet.', 'veryo' ),
			),
		),
		'photo'       => array( __( 'twee medewerkers aan het werk achter hun beeldschermen', 'veryo' ), __( 'AI-agents voor bedrijven: digitale collega’s naast je team', 'veryo' ), 'laptop' ),
		'approach'    => true,
		'sections'    => array(
			array(
				'h'     => __( 'Wat doet een AI-agent wel en niet zelfstandig?', 'veryo' ),
				'p'     => array( __( 'Een agent werkt binnen grenzen die jullie samen met ons vastleggen.', 'veryo' ) ),
				'list'  => array(
					'<strong>' . __( 'Wel zelfstandig:', 'veryo' ) . '</strong> ' . __( 'lezen, sorteren, informatie opzoeken in jullie systemen, ontbrekende gegevens opvragen en een concept klaarzetten.', 'veryo' ),
					'<strong>' . __( 'Met goedkeuring van een mens:', 'veryo' ) . '</strong> ' . __( 'iets versturen naar een klant, een afspraak definitief maken of gegevens wijzigen in de boekhouding.', 'veryo' ),
					'<strong>' . __( 'Nooit zelfstandig:', 'veryo' ) . '</strong> ' . __( 'betalingen, afwijzingen, prijsafspraken en andere beslissingen met grote gevolgen.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'Wat is een AI-agent voor bedrijven, en wat is het verschil met een chatbot?', 'veryo' ),
				'p' => array(
					sprintf(
						/* translators: 1: link naar chatbot, 2: link naar AI-automatisering. */
						__( 'Een <a href="%1$s">chatbot</a> beantwoordt vragen, bijvoorbeeld van klanten op jullie website. Een <a href="%2$s">workflow</a> volgt vaste stappen: als er een factuur binnenkomt, gaat hij naar de boekhouding. Een AI-agent combineert die twee: hij begrijpt een vraag of document, kiest de juiste vervolgstap en voert die uit in jullie systemen.', 'veryo' ),
						esc_url( veryo_link( 'ai-op-maat/chatbot' ) ),
						esc_url( veryo_link( 'ai-automatisering' ) )
					),
					__( 'Zijn de stappen altijd hetzelfde, dan is een workflow goedkoper en eenvoudiger. Een agent loont waar er gelezen, beoordeeld en gezocht moet worden.', 'veryo' ),
					__( 'Je hoort daarvoor ook de term agentic AI: AI die niet alleen antwoord geeft, maar zelf stappen zet binnen grenzen die vooraf zijn afgesproken. Bij Veryo zijn die grenzen concreet: wat de agent zelf mag, wat een mens eerst goedkeurt, met welke rechten hij in jullie systemen werkt en een logboek van alles wat hij doet. Hoe dat werkt, staat verderop bij “Goedkeuring, rechten en foutafhandeling”.', 'veryo' ),
					sprintf(
						/* translators: %s: link naar AI op maat. */
						__( 'Zoeken jullie een chatbot of WhatsApp-assistent? Kijk dan bij %s.', 'veryo' ),
						'<a href="' . esc_url( veryo_link( 'ai-op-maat' ) ) . '">' . esc_html__( 'AI-automatisering op maat', 'veryo' ) . '</a>'
					),
				),
			),
			array(
				'html' => veryo_sec_usecases(
					__( 'Toepassingen van AI-agents in het mkb', 'veryo' ),
					__( 'Vijf toepassingen die we het vaakst bespreken. Het zijn voorbeelden van werkwijzen, geen klantcases.', 'veryo' ),
					veryo_sec_usecase(
						__( 'E-mailconcepten', 'veryo' ),
						__( 'de mailbox loopt vol met vragen die steeds op elkaar lijken.', 'veryo' ),
						__( 'de agent leest de mail, zoekt de gegevens erbij en zet een conceptantwoord klaar in jullie eigen toon.', 'veryo' ),
						__( 'Outlook of Gmail, en waar nodig CRM of planning.', 'veryo' ),
						__( 'een medewerker leest en verstuurt het concept.', 'veryo' ),
						__( 'minder typen en sneller antwoord; de omvang hangt af van het aantal mails.', 'veryo' ),
						__( 'een gedeelde mailbox en duidelijke informatie over jullie aanbod.', 'veryo' )
					)
					. veryo_sec_usecase(
						__( 'WhatsApp-assistent', 'veryo' ),
						__( 'klanten of sollicitanten appen buiten kantoortijd en wachten op antwoord.', 'veryo' ),
						__( 'de agent beantwoordt veelgestelde vragen, vraagt gegevens uit en plant een afspraak of belt-terugmoment in.', 'veryo' ),
						__( 'WhatsApp Business en jullie agenda.', 'veryo' ),
						__( 'lastige of gevoelige gesprekken gaan direct naar een collega.', 'veryo' ),
						__( 'vooral snelheid en bereikbaarheid.', 'veryo' ),
						__( 'een WhatsApp Business-account en afspraken over wat de assistent wel en niet zegt.', 'veryo' )
					)
					. veryo_sec_usecase(
						__( 'Offertevoorbereiding', 'veryo' ),
						__( 'aanvragen zijn half compleet en offertes kosten veel uitzoekwerk.', 'veryo' ),
						__( 'de agent maakt de aanvraag compleet, zoekt vergelijkbare eerdere offertes en zet een conceptofferte klaar.', 'veryo' ),
						__( 'mail, jullie prijslijst en het offerte- of boekhoudpakket.', 'veryo' ),
						__( 'de verkoper controleert prijzen en voorwaarden voordat de offerte de deur uitgaat.', 'veryo' ),
						__( 'minder uitzoekwerk per offerte; dat rekenen we vooraf uit.', 'veryo' ),
						__( 'een actuele prijslijst en eerdere offertes als voorbeeld.', 'veryo' )
					)
					. veryo_sec_usecase(
						__( 'Documenten zoeken', 'veryo' ),
						__( 'collega’s zoeken lang naar contracten, handleidingen of eerdere projecten.', 'veryo' ),
						__( 'de agent zoekt op betekenis in jullie mappen en geeft het antwoord met de bron erbij.', 'veryo' ),
						__( 'SharePoint, Google Drive of een netwerkschijf.', 'veryo' ),
						__( 'de bron staat erbij, zodat de collega het zelf kan nagaan.', 'veryo' ),
						__( 'minder zoeken, vooral voor nieuwe collega’s.', 'veryo' ),
						__( 'documenten zijn actueel en rechten per medewerker zijn geregeld.', 'veryo' )
					)
					. veryo_sec_usecase(
						__( 'Interne kennisassistent', 'veryo' ),
						__( 'kennis zit in de hoofden van een paar ervaren collega’s.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar Veryo Collega. */
							__( 'een assistent beantwoordt vragen uit jullie eigen werkinstructies en documenten. Met <a href="%s">Veryo Collega</a> draait dat volledig lokaal, op jullie eigen kantoor.', 'veryo' ),
							esc_url( veryo_collega_url() )
						),
						__( 'jullie documenten, met lokale AI of een zakelijke cloud-AI.', 'veryo' ),
						__( 'bij belangrijke beslissingen controleert een collega de bron.', 'veryo' ),
						__( 'minder vragen aan dezelfde ervaren collega’s.', 'veryo' ),
						__( 'een eigenaar die de kennis actueel houdt.', 'veryo' )
					)
				),
			),
			array(
				'h'     => __( 'Goedkeuring, rechten en foutafhandeling', 'veryo' ),
				'list'  => array(
					'<strong>' . __( 'Menselijke goedkeuring:', 'veryo' ) . '</strong> ' . __( 'per stap leggen we vast wat de agent zelf mag en waar een mens goedkeurt.', 'veryo' ),
					'<strong>' . __( 'Toegangsrechten:', 'veryo' ) . '</strong> ' . __( 'de agent krijgt alleen toegang tot de systemen en gegevens die hij voor de taak nodig heeft.', 'veryo' ),
					'<strong>' . __( 'Logging:', 'veryo' ) . '</strong> ' . __( 'alles wat de agent doet, staat in een logboek, zodat jullie kunnen nagaan wat er is gebeurd.', 'veryo' ),
					'<strong>' . __( 'Foutafhandeling:', 'veryo' ) . '</strong> ' . __( 'twijfelt de agent of lukt een stap niet, dan gaat de taak naar een collega in plaats van dat hij gokt.', 'veryo' ),
					'<strong>' . __( 'Grenzen:', 'veryo' ) . '</strong> ' . __( 'taken die een paar keer per jaar voorkomen of grote gevolgen hebben, laten we bij mensen.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'AI-agent laten bouwen: hoe dat bij Veryo gaat', 'veryo' ),
				'p' => array(
					__( 'We beginnen met één taak, niet met een groot plan. Samen beschrijven we hoe die taak nu gaat, stap voor stap, en waar de beslismomenten zitten. Dan kijken we eerst of software die je al hebt of kunt nemen het kan. Pas als dat niet zo is, bouwen we een agent.', 'veryo' ),
					__( 'Een agent draait in je eigen accounts, met een logboek van alles wat hij doet en een vaste eigenaar bij jou. We testen eerst met echte gegevens in een proefperiode, waarin een medewerker elke uitkomst controleert. Pas als het betrouwbaar werkt, gaat hij zelfstandiger aan de slag.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Digitale medewerker met AI: een voorbeeld', 'veryo' ),
				'p' => array(
					__( 'Een installatiebedrijf met vijftien mensen krijgt per week tientallen storingsmeldingen via mail, WhatsApp en het webformulier. Een agent kan elke melding lezen, het adres en het type installatie herkennen, ontbrekende gegevens bij de klant opvragen en een concept-werkbon klaarzetten in de planning. De planner kijkt alleen nog of het klopt. Dit is een voorbeeld van wat mogelijk is, geen resultaat van een klant.', 'veryo' ),
				),
			),
		),
		'no_steps'    => true,
		'price'       => array(
			'steps' => array( 'agents', 'quickwin', 'maatwerk' ),
			'h'     => __( 'Wat kost een AI-agent?', 'veryo' ),
			'p'     => __( 'Eén afgebakende taak met een agent is meestal een project. Een agent die met veel systemen moet samenwerken, is maatwerk. Na een kort gesprek krijg je een vaste prijs.', 'veryo' ),
		),
		'after_price' => veryo_sec_ongoing( 'onderhoud' ),
		'faq'         => array(
			array( __( 'Wie bouwt AI-agents voor bedrijven in Nederland?', 'veryo' ), __( 'Veryo uit Leeuwarden bouwt AI-agents voor mkb-bedrijven, met een proefperiode op echte data en een vaste prijs vooraf. De agent draait bovenop de software die jullie al gebruiken.', 'veryo' ) ),
			array( __( 'Wat is agentic AI?', 'veryo' ), __( 'AI die niet alleen antwoord geeft, maar zelf stappen uitvoert: mail lezen, gegevens opzoeken, een concept klaarzetten. Bij Veryo gebeurt dat altijd binnen vaste grenzen, en een mens keurt goed wat belangrijk is.', 'veryo' ) ),
			array( __( 'Wat is het verschil tussen een agent en een chatbot?', 'veryo' ), __( 'Een chatbot beantwoordt vragen. Een agent voert ook stappen uit: iets opzoeken, een concept klaarzetten, een gegeven invullen in een ander systeem.', 'veryo' ) ),
			array( __( 'Werkt een agent met onze software?', 'veryo' ), __( 'Meestal wel, via de koppelingen die pakketten als Outlook, Exact, Moneybird of een CRM bieden. We bouwen in je eigen accounts, zodat jij eigenaar blijft.', 'veryo' ) ),
			array( __( 'Wat als de agent een fout maakt?', 'veryo' ), __( 'Daarom begint elke agent met een proefperiode waarin een mens alles controleert, en houdt hij een logboek bij. Beslissingen met grote gevolgen blijven bij een mens.', 'veryo' ) ),
			array( __( 'Waarom is onderhoud verplicht?', 'veryo' ), __( 'Software verandert. Als een pakket een update krijgt, kan een koppeling stoppen. Met onderhoud bewaken we dat en lossen we het op voordat je het merkt.', 'veryo' ) ),
			array( __( 'Gaan onze gegevens naar een AI-dienst?', 'veryo' ), __( 'Alleen wat nodig is voor de taak, via zakelijke API’s waarbij je gegevens niet worden gebruikt om modellen te trainen. Bij persoonsgegevens sluiten we een verwerkersovereenkomst.', 'veryo' ) ),
		),
		'cta_demo'    => true,
		'cta'         => array( __( 'Welke taak zou jullie digitale collega oppakken?', 'veryo' ), __( 'Plan een gratis adviesgesprek. We bekijken één taak en vertellen eerlijk of een agent, een workflow of een chatbot het beste past.', 'veryo' ) ),
		'links'       => array(
			array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Alles wat er mogelijk is, per afdeling', 'veryo' ) ),
			array( 'ai-op-maat/chatbot', __( 'AI-chatbot laten maken', 'veryo' ), __( 'Vragen beantwoorden op jullie website', 'veryo' ) ),
			array( veryo_collega()['slug'], __( 'Veryo Collega', 'veryo' ), __( 'Interne kennisassistent, volledig lokaal', 'veryo' ) ),
			array( 'branches', __( 'AI per branche', 'veryo' ), __( 'Toepassingen per sector', 'veryo' ) ),
			array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Storingen, werkbonnen en offertes', 'veryo' ) ),
		),
	)
);

/*
 * Veilig AI-gebruik: /veilig-ai-gebruik/
 */
$veryo_veilig = veryo_page_standard(
	array(
		'contact'     => array(
			__( 'Twijfel je of AI bij jullie veilig wordt gebruikt?', 'veryo' ),
			__( 'Stel je vraag over beleid, rechten of datalekken. Je krijgt binnen één werkdag een nuchter antwoord.', 'veryo' ),
			__( 'Bijvoorbeeld: medewerkers gebruiken de gratis ChatGPT met klantgegevens. Wat moeten we doen?', 'veryo' ),
		),
		'answer'      => __( 'Veilig AI gebruiken in je bedrijf begint met weten wat medewerkers nu in AI-tools invoeren. Veryo doet een AI-veiligheidscheck: hoe AI nu wordt gebruikt, wie welke gegevens kan zien, of tweestapsverificatie aanstaat en of er beleid is, met een rapport vol concrete acties.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'Weet jij wat er in ChatGPT wordt geplakt?', 'veryo' ),
			'p' => array(
				__( 'In de meeste bedrijven gebruikt iemand al AI, vaak met een privéaccount. Dat is begrijpelijk: het werkt, en het scheelt tijd. Maar een klantmail met naam en adres, een offerte met prijzen of een personeelsdossier hoort niet in een gratis AI-tool waarvan je niet weet wat er met de gegevens gebeurt.', 'veryo' ),
				__( 'Verbieden werkt meestal niet; dan gebeurt het stiekem. Beter is duidelijk maken wat wel mag, met welke tools, en de basis zo regelen dat een fout niet meteen een datalek is.', 'veryo' ),
			),
		),
		'photo'       => array( __( 'team aan het werk op kantoor met beeldschermen', 'veryo' ), __( 'Veilig AI gebruiken in je bedrijf: team op kantoor', 'veryo' ), 'kantoor' ),
		'sections'    => array(
			array(
				'h'     => __( 'Wat we bekijken in de AI-veiligheidscheck', 'veryo' ),
				'list'  => array(
					'<strong>' . __( 'Hoe AI nu wordt gebruikt.', 'veryo' ) . '</strong> ' . __( 'Een korte, anonieme vragenlijst voor het team: welke tools, waarvoor en met welke gegevens.', 'veryo' ),
					'<strong>' . __( 'Toegangsrechten.', 'veryo' ) . '</strong> ' . __( 'Wie kan welke mappen, mailboxen en systemen zien? Dat bepaalt ook wat een AI-assistent kan vinden.', 'veryo' ),
					'<strong>' . __( 'Tweestapsverificatie.', 'veryo' ) . '</strong> ' . __( 'Staat die aan op mail, kantoorsoftware en AI-accounts? Het is de eenvoudigste maatregel met het meeste effect.', 'veryo' ),
					'<strong>' . __( 'Beleid en afspraken.', 'veryo' ) . '</strong> ' . __( 'Is er een AI-beleid, kent het team het, en klopt het met wat er echt gebeurt?', 'veryo' ),
					'<strong>' . __( 'Bewustwording.', 'veryo' ) . '</strong> ' . __( 'Herkent het team phishing en nepberichten die met AI steeds overtuigender worden?', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'ChatGPT veilig gebruiken in je bedrijf: het rapport', 'veryo' ),
				'p' => array(
					__( 'Je krijgt een kort rapport in gewone taal, met per onderwerp wat goed gaat, wat beter kan en wat je als eerste moet doen. Geen lijst van vijftig punten, maar de vijf of zes acties die het meeste verschil maken, met wie ze kan uitvoeren.', 'veryo' ),
					__( 'Een typisch voorbeeld van een actie: zakelijke accounts voor de AI-tool die het team al gebruikt, met de instelling dat gegevens niet worden gebruikt voor training, en een afspraak dat klantnamen er nooit in gaan. Dit is een voorbeeld, geen uitkomst van een echte check.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'AI en de AVG', 'veryo' ),
				'p' => array(
					__( 'Gebruik je AI met persoonsgegevens, dan gelden de gewone regels van de AVG: een doel, zo min mogelijk gegevens, en een verwerkersovereenkomst met de leverancier. Zakelijke versies van AI-tools bieden die meestal; gratis versies vaak niet. In de check kijken we welke tools jullie gebruiken en of dat geregeld is. We geven geen juridisch advies; voor twijfelgevallen verwijzen we naar een jurist.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Europese AI en hosting', 'veryo' ),
				'p' => array(
					__( 'Wil je liever dat je gegevens in Europa blijven, dan zoeken we mee naar Europese alternatieven voor AI-tools en hosting, en wegen we af wat je daarvoor inlevert aan gemak of mogelijkheden. Dat is een keuze, geen verplichting; we adviseren wat bij jullie risico’s past.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Een AI-beleid voor je bedrijf', 'veryo' ),
				'p' => array(
					__( 'Is er nog geen AI-beleid, dan schrijven we er een van één à twee pagina’s: welke tools jullie gebruiken, welke gegevens er nooit in gaan, en wie verantwoordelijk is. Dat beleid zit ook in het AI-Startpakket. Veryo doet geen IT-beheer; technische acties uit het rapport voert je eigen IT-beheerder uit, of we helpen bij wat met AI te maken heeft.', 'veryo' ),
				),
			),
		),
		'no_steps'    => true,
		'price'       => array(
			'steps' => array( 'veiligheidscheck', 'startpakket' ),
			'h'     => __( 'Wat kost de AI-veiligheidscheck?', 'veryo' ),
			'p'     => __( 'De check is een vast bedrag. Wil je meteen ook een beleid en één toepassing, dan is het AI-Startpakket de logische stap.', 'veryo' ),
		),
		'after_price' => veryo_sec_ongoing( 'veilig-blijven' ),
		'faq'         => array(
			array( __( 'Mogen medewerkers ChatGPT gebruiken?', 'veryo' ), __( 'Dat bepaal je zelf, maar verbieden werkt slecht. Beter: een zakelijke versie met de juiste instellingen, en duidelijke afspraken over wat er wel en niet in mag.', 'veryo' ) ),
			array( __( 'Is een AI-beleid verplicht?', 'veryo' ), __( 'Niet als apart document. Wel vraagt artikel 4 van de AI Act organisaties die AI inzetten om maatregelen te nemen die de AI-geletterdheid van hun medewerkers ondersteunen. Een beleid en uitleg bij elke toepassing die je invoert, zijn zulke maatregelen.', 'veryo' ) ),
			array( __( 'Hoe lang duurt de veiligheidscheck?', 'veryo' ), __( 'Ongeveer twee weken: een week voor de vragenlijst en het bekijken van de instellingen, en daarna een gesprek over het rapport.', 'veryo' ) ),
			array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo doet geen algemeen IT-beheer, netwerken of helpdesk. Alleen de machine waarop [veryo_collega_naam] draait, beheren we zelf. We werken graag samen met je vaste IT-beheerder.', 'veryo' ) ),
			array( __( 'Kunnen jullie Europese alternatieven adviseren?', 'veryo' ), __( 'Ja, waar je dat wilt. We leggen uit wat de opties zijn en wat je ervoor inlevert, zodat je een bewuste keuze maakt.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Beleid en één toepassing', 'veryo' ) ),
			array( 'ai-werkplek', __( 'AI-werkplek met Claude Team', 'veryo' ), __( 'Met de juiste rechten en afspraken', 'veryo' ) ),
			array( 'diensten', __( 'Alle diensten', 'veryo' ), __( 'Wat Veryo bouwt en inricht', 'veryo' ) ),
			array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Op locatie in het noorden', 'veryo' ) ),
		),
	)
);


return array(
	'ai-werkplek'       => array(
		'title'       => __( 'Claude Team inrichten: de AI-werkplek voor jullie team', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'Claude Team inrichten voor technische bedrijven | Veryo', 'veryo' ),
		'desc'        => __( 'Wij richten Claude Team in op jullie eigen normen, sjablonen en documenten. Voor calculatie, engineering en werkvoorbereiding. De engineer beslist.', 'veryo' ),
		'kw'          => 'claude team inrichten',
		'schema'      => array(
			'type' => 'service',
		),
		'content'     => $veryo_werkplek,
	),
	'ai-agents'         => array(
		'title'       => __( 'AI-agents voor bedrijven: digitale collega’s die jullie werk voorbereiden', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'AI-agents voor bedrijven in Nederland laten bouwen | Veryo', 'veryo' ),
		'desc'        => __( 'AI-agent laten bouwen voor jullie bedrijf? Veryo bouwt AI-agents die terugkerend werk voorbereiden, bovenop jullie software. Een mens keurt goed.', 'veryo' ),
		'kw'          => 'ai agent nederland',
		'schema'      => array(
			'type' => 'service',
			'min'  => 2500,
			'max'  => 25000,
		),
		'content'     => $veryo_agents,
	),
	'veilig-ai-gebruik' => array(
		'title'     => __( 'Veilig AI gebruiken in je bedrijf', 'veryo' ),
		'seo_title' => __( 'Veilig AI gebruiken in je bedrijf: beleid en check | Veryo', 'veryo' ),
		'desc'      => __( 'AI veilig gebruiken in je bedrijf: de AI-veiligheidscheck van Veryo bekijkt gebruik, rechten, tweestapsverificatie en beleid. Vraag een offerte aan.', 'veryo' ),
		'kw'        => 'ai veilig gebruiken bedrijf',
		'schema'    => array(
			'type' => 'service',
			'min'  => 995,
			'max'  => 995,
		),
		'content'   => $veryo_veilig,
	),
);
