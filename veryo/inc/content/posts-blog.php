<?php
/**
 * Blogconcepten (status: concept). Per bericht een H2/H3-opbouw met opzet per sectie,
 * een FAQ met drie vragen en onderaan het CTA-blok voor de AI-scan.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Concept opbouwen.
 *
 * @param array<int,array<int,mixed>>  $sections Secties: array( H2, opzet, array( array( H3, opzet ) ) ).
 * @param array<int,array<int,string>> $faq      Drie vragen.
 * @return string
 */
$veryo_draft = static function ( $sections, $faq ) {
	$out = veryo_b_p( __( '[CONCEPT: schrijf en controleer dit artikel voor publicatie. Onder elke kop staat de opzet in 2–4 zinnen.]', 'veryo' ), array( 'className' => 'veryo-draft-note' ) );
	foreach ( $sections as $section ) {
		$out .= veryo_b_h( $section[0] );
		$out .= veryo_b_p( $section[1] );
		if ( ! empty( $section[2] ) ) {
			foreach ( $section[2] as $sub ) {
				$out .= veryo_b_h( $sub[0], 3 );
				$out .= veryo_b_p( $sub[1] );
			}
		}
	}
	$out .= veryo_sec_faq( $faq );
	$out .= veryo_sec_cta_scan();
	return $out;
};

return array(

	'waar-begin-je-met-ai-in-je-bedrijf' => array(
		'title'     => __( 'Waar begin je met AI in je bedrijf? Een nuchter stappenplan', 'veryo' ),
		'seo_title' => __( 'Waar begin je met AI in je bedrijf? Stappenplan | Veryo', 'veryo' ),
		'desc'      => __( 'AI toepassen in het MKB zonder hype: een nuchter stappenplan in vijf stappen, van tijdvreters in kaart brengen tot je eerste automatisering.', 'veryo' ),
		'kw'        => 'ai toepassen mkb',
		'content'   => $veryo_draft(
			array(
				array( __( 'Begin bij je werk, niet bij de techniek', 'veryo' ), __( 'Leg uit waarom de vraag “wat kan AI?” de verkeerde start is. De betere vraag: welk werk komt elke week terug en kost veel tijd? Gebruik een voorbeeld uit de installatie of bouw.', 'veryo' ) ),
				array(
					__( 'Stap 1 tot en met 5', 'veryo' ),
					__( 'Kort overzicht van de vijf stappen, als opstap naar de H3’s.', 'veryo' ),
					array(
						array( __( 'Stap 1: breng je tijdvreters in kaart', 'veryo' ), __( 'Laat het team een week bijhouden waar tijd naartoe gaat. Geef een eenvoudig schema: taak, uren per week, ergernis.', 'veryo' ) ),
						array( __( 'Stap 2: kies één afgebakende taak', 'veryo' ), __( 'Waarom één taak beter is dan een groot project. Criteria: komt vaak voor, duidelijke in- en uitvoer, weinig risico.', 'veryo' ) ),
						array( __( 'Stap 3: probeer het eerst met de hand', 'veryo' ), __( 'Laat zien hoe je met ChatGPT of Claude een taak test voordat je automatiseert. Let op: geen klantgegevens invoeren.', 'veryo' ) ),
						array( __( 'Stap 4: automatiseer en meet', 'veryo' ), __( 'Van losse test naar automatisering in je eigen software. Meet de tijd vóór en na.', 'veryo' ) ),
						array( __( 'Stap 5: maak afspraken', 'veryo' ), __( 'Wie is eigenaar, wat mag wel en niet, en hoe train je het team (AI-geletterdheid, AI Act artikel 4).', 'veryo' ) ),
					),
				),
				array( __( 'Wat je beter niet doet', 'veryo' ), __( 'Drie valkuilen: alles tegelijk willen, een rommelig proces automatiseren, en automatiseren wat een paar keer per jaar voorkomt.', 'veryo' ) ),
			),
			array(
				array( __( 'Hoeveel tijd kost het om met AI te beginnen?', 'veryo' ), __( 'Een eerste inventarisatie kost een paar uur. Een eerste automatisering staat vaak binnen een paar weken. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Moet ik technisch zijn om AI te gebruiken?', 'veryo' ), __( 'Nee. Voor de eerste stappen heb je alleen nieuwsgierigheid nodig. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Wat is een goede eerste AI-toepassing?', 'veryo' ), __( 'Vaak mail, offertes of inkoopfacturen: werk dat vaak terugkomt en goed af te bakenen is. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'wat-kan-ai-voor-mijn-bedrijf-doen'  => array(
		'title'     => __( 'Wat kan AI voor jouw bedrijf doen? Voorbeelden per afdeling', 'veryo' ),
		'seo_title' => __( 'Wat kan AI voor mijn bedrijf doen? Voorbeelden | Veryo', 'veryo' ),
		'desc'      => __( 'Wat kan AI voor mijn bedrijf doen? Concrete voorbeelden per afdeling: klantcontact, offertes, administratie, planning, marketing, HR en rapportages.', 'veryo' ),
		'kw'        => 'wat kan ai voor mijn bedrijf doen',
		'content'   => $veryo_draft(
			array(
				array( __( 'AI in gewone taal', 'veryo' ), __( 'Leg in drie zinnen uit wat AI-taalmodellen goed kunnen (lezen, samenvatten, schrijven, sorteren) en wat niet (rekenen, beslissen, zeker weten).', 'veryo' ) ),
				array(
					__( 'Voorbeelden per afdeling', 'veryo' ),
					__( 'Per afdeling twee of drie voorbeelden uit de catalogus, als voorbeeld geformuleerd, met indicatie van tijdwinst.', 'veryo' ),
					array(
						array( __( 'Klantcontact', 'veryo' ), __( 'Mail sorteren, conceptantwoorden, WhatsApp-assistent.', 'veryo' ) ),
						array( __( 'Offertes en calculaties', 'veryo' ), __( 'Offerte-generator, opvolging, calculatietool met vaste rekenregels.', 'veryo' ) ),
						array( __( 'Administratie', 'veryo' ), __( 'Inkoopfacturen, bonnetjes, werkbon naar factuur.', 'veryo' ) ),
						array( __( 'Planning en werkplaats', 'veryo' ), __( 'Planningsvoorstel, digitale werkbon, onderhoudsplanning.', 'veryo' ) ),
						array( __( 'Marketing', 'veryo' ), __( 'Projectfoto’s naar posts, reviews, blogconcepten.', 'veryo' ) ),
						array( __( 'HR en werving', 'veryo' ), __( 'Vacatureteksten, solliciteren via WhatsApp.', 'veryo' ) ),
						array( __( 'Rapportages', 'veryo' ), __( 'Maandagbericht met cijfers, dashboard.', 'veryo' ) ),
					),
				),
				array( __( 'Hoe kies je wat bij jou past?', 'veryo' ), __( 'Verwijs naar de AI-scan en de rekensom: uren per week keer besparingsfactor.', 'veryo' ) ),
			),
			array(
				array( __( 'Kan AI mijn medewerkers vervangen?', 'veryo' ), __( 'In het MKB gaat het vooral om werk weghalen dat niemand leuk vindt, niet om mensen vervangen. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Welke afdeling levert het meeste op?', 'veryo' ), __( 'Dat verschilt per bedrijf; vaak zit het in offertes en administratie. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Werkt AI met mijn bestaande software?', 'veryo' ), __( 'Meestal wel, via koppelingen met Outlook, Exact, Moneybird en andere pakketten. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'wat-kost-een-ai-chatbot'            => array(
		'title'     => __( 'Wat kost een AI-chatbot? Prijzen en wat je ervoor krijgt', 'veryo' ),
		'seo_title' => __( 'Wat kost een AI-chatbot? Prijzen uitgelegd | Veryo', 'veryo' ),
		'desc'      => __( 'Wat kost een AI-chatbot voor je bedrijf? Een eerlijk overzicht van bouwkosten, verbruikskosten en onderhoud, en wat je voor dat bedrag wel en niet krijgt.', 'veryo' ),
		'kw'        => 'wat kost een ai chatbot',
		'content'   => $veryo_draft(
			array(
				array( __( 'Het korte antwoord', 'veryo' ), __( 'Noem de bandbreedtes: project €2.500–7.500, maatwerk vanaf €5.000, plus verbruik en optioneel onderhoud €150–500 per maand. Alles exclusief btw.', 'veryo' ) ),
				array(
					__( 'Waar de kosten uit bestaan', 'veryo' ),
					__( 'Leg de drie soorten kosten uit.', 'veryo' ),
					array(
						array( __( 'Bouwen en inrichten', 'veryo' ), __( 'Bronnen verzamelen, instructies schrijven, testen met het team.', 'veryo' ) ),
						array( __( 'Verbruik', 'veryo' ), __( 'Kosten per gesprek bij de AI-dienst en hosting; meestal tientallen euro’s per maand voor een MKB-site.', 'veryo' ) ),
						array( __( 'Onderhoud', 'veryo' ), __( 'Bronnen bijwerken, logs bekijken, verbeteren.', 'veryo' ) ),
					),
				),
				array( __( 'Wat bepaalt of het een project of maatwerk wordt?', 'veryo' ), __( 'Koppelingen (agenda, CRM, WhatsApp), talen, aantal bronnen en hoeveel de chatbot zelf mag doen.', 'veryo' ) ),
				array( __( 'Goedkope chatbots: waar je op moet letten', 'veryo' ), __( 'Vergelijk abonnementen met een chatbot op maat; let op datagebruik, eigenaarschap en of hij bij twijfel doorverwijst.', 'veryo' ) ),
			),
			array(
				array( __( 'Zijn er maandelijkse kosten?', 'veryo' ), __( 'Ja, verbruik en eventueel onderhoud. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Hoe lang duurt het bouwen van een chatbot?', 'veryo' ), __( 'Meestal vier tot zes weken voor een eerste versie. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Kan een chatbot ook via WhatsApp?', 'veryo' ), __( 'Ja, via de WhatsApp Business API. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'wat-kost-ai-automatisering'         => array(
		'title'     => __( 'Wat kost AI-automatisering voor het MKB?', 'veryo' ),
		'seo_title' => __( 'Wat kost AI-automatisering voor het MKB? | Veryo', 'veryo' ),
		'desc'      => __( 'Wat kost AI-automatisering? Van quick win (€750–1.500) tot maatwerk (vanaf €5.000), plus verbruik en onderhoud. Met een rekenvoorbeeld erbij.', 'veryo' ),
		'kw'        => 'wat kost ai automatisering',
		'content'   => $veryo_draft(
			array(
				array( __( 'Drie niveaus', 'veryo' ), __( 'Quick win, project en maatwerk, met de prijsbandbreedtes en een voorbeeld per niveau.', 'veryo' ) ),
				array( __( 'Eenmalige en terugkerende kosten', 'veryo' ), __( 'Bouw eenmalig; software-verbruik en optioneel onderhoud maandelijks. Waarom verbruik via je eigen account transparanter is.', 'veryo' ) ),
				array(
					__( 'Rekenvoorbeeld: wanneer verdien je het terug?', 'veryo' ),
					__( 'Werk de rekensom uit met uren × kostprijs. Duidelijk vermelden dat het een voorbeeld is.', 'veryo' ),
					array(
						array( __( 'De formule', 'veryo' ), __( 'Besparing per jaar = uren per week × werkweken × kostprijs per uur.', 'veryo' ) ),
						array( __( 'Een voorbeeld', 'veryo' ), __( 'Quick win van €1.000, drie uur per week, €45 per uur: ongeveer acht weken.', 'veryo' ) ),
					),
				),
				array( __( 'Wanneer AI-automatisering niet de moeite waard is', 'veryo' ), __( 'Werk dat zelden voorkomt, processen die nog niet helder zijn, beslissingen met grote gevolgen.', 'veryo' ) ),
			),
			array(
				array( __( 'Is AI-automatisering subsidiabel?', 'veryo' ), __( 'Soms; regelingen wisselen en moeten per situatie gecheckt worden. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Waarom werken jullie met vaste prijzen?', 'veryo' ), __( 'Zodat je vooraf weet waar je aan toe bent. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Wat als de automatisering niet werkt?', 'veryo' ), __( 'We testen met echte gegevens voordat we live gaan. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'ai-geletterdheid-ai-act-mkb'        => array(
		'title'     => __( 'AI-geletterdheid en de AI Act: wat moet je als MKB’er doen?', 'veryo' ),
		'seo_title' => __( 'AI-geletterdheid en de AI Act voor het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'AI Act en AI-geletterdheid: sinds 2 februari 2025 moet je zorgen dat medewerkers voldoende AI-geletterd zijn. Wat betekent dat voor het MKB? Met checklist.', 'veryo' ),
		'kw'        => 'ai act ai-geletterdheid',
		'content'   => $veryo_draft(
			array(
				array( __( 'Wat staat er in artikel 4?', 'veryo' ), __( 'Feitelijk: sinds 2 februari 2025 verplicht de AI Act organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid van hun medewerkers. Geen bangmakerij.', 'veryo' ) ),
				array( __( 'Geldt dit ook voor jou?', 'veryo' ), __( 'Als medewerkers ChatGPT, Copilot of andere AI-tools voor hun werk gebruiken: waarschijnlijk wel. Verwijs voor juridische zekerheid naar een jurist.', 'veryo' ) ),
				array(
					__( 'Wat is “voldoende”?', 'veryo' ),
					__( 'De wet schrijft geen lesprogramma voor; het hangt af van gebruik en risico.', 'veryo' ),
					array(
						array( __( 'Kennis', 'veryo' ), __( 'Wat AI kan en niet kan.', 'veryo' ) ),
						array( __( 'Risico’s', 'veryo' ), __( 'Fouten, privacy, vertrouwelijkheid.', 'veryo' ) ),
						array( __( 'Afspraken', 'veryo' ), __( 'Wie mag wat, wie controleert.', 'veryo' ) ),
					),
				),
				array( __( 'Checklist voor het MKB', 'veryo' ), __( 'Vijf vragen: welke tools, welke gegevens, wie controleert, wie is verantwoordelijk, welke training is gegeven. Maak hier een lijst van in het definitieve artikel.', 'veryo' ) ),
			),
			array(
				array( __( 'Is er een boete als je niets doet?', 'veryo' ), __( 'Beschrijf alleen wat vaststaat en verwijs naar de officiële bronnen. [VUL IN: laat controleren]', 'veryo' ) ),
				array( __( 'Is er een officieel certificaat?', 'veryo' ), __( 'Nee, er is geen wettelijk certificaat voor AI-geletterdheid. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Hoe vaak moet je trainen?', 'veryo' ), __( 'De wet noemt geen termijn; een jaarlijkse update is verstandig. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'ai-beleid-bedrijf-template'         => array(
		'title'     => __( 'Template: AI-beleid voor je bedrijf', 'veryo' ),
		'seo_title' => __( 'AI-beleid voor je bedrijf: gratis template | Veryo', 'veryo' ),
		'desc'      => __( 'Een AI-beleid voor je bedrijf opstellen? Gebruik deze template met wat in een beleid hoort: tools, gegevens, controle, verantwoordelijkheid en training.', 'veryo' ),
		'kw'        => 'ai beleid bedrijf template',
		'content'   => $veryo_draft(
			array(
				array( __( 'Waarom een AI-beleid?', 'veryo' ), __( 'Duidelijkheid voor het team en onderdeel van werken aan AI-geletterdheid. Kort houden: één of twee pagina’s.', 'veryo' ) ),
				array(
					__( 'De template', 'veryo' ),
					__( 'Per onderdeel een voorbeeldtekst die de lezer kan overnemen.', 'veryo' ),
					array(
						array( __( 'Doel en reikwijdte', 'veryo' ), __( 'Voor wie geldt het, welke tools.', 'veryo' ) ),
						array( __( 'Toegestane tools', 'veryo' ), __( 'Lijst met goedgekeurde tools en accounts.', 'veryo' ) ),
						array( __( 'Gegevens', 'veryo' ), __( 'Wat wel en niet mag worden ingevoerd.', 'veryo' ) ),
						array( __( 'Controle', 'veryo' ), __( 'AI-uitvoer altijd controleren voor gebruik.', 'veryo' ) ),
						array( __( 'Verantwoordelijkheid en training', 'veryo' ), __( 'Wie is aanspreekpunt, hoe wordt het team getraind.', 'veryo' ) ),
					),
				),
				array( __( 'Invoeren in je bedrijf', 'veryo' ), __( 'Bespreek het beleid met het team, laat het juridisch checken en plan een jaarlijkse update.', 'veryo' ) ),
			),
			array(
				array( __( 'Is een AI-beleid verplicht?', 'veryo' ), __( 'Niet als apart document, maar het helpt bij AI-geletterdheid. [VUL IN: laat controleren]', 'veryo' ) ),
				array( __( 'Hoe lang moet een AI-beleid zijn?', 'veryo' ), __( 'Kort: één tot twee pagina’s. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Moet een jurist ernaar kijken?', 'veryo' ), __( 'Dat is verstandig. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'chatgpt-claude-copilot-zakelijk'    => array(
		'title'     => __( 'ChatGPT, Claude of Copilot: wat past bij jouw bedrijf?', 'veryo' ),
		'seo_title' => __( 'ChatGPT, Claude of Copilot zakelijk vergeleken | Veryo', 'veryo' ),
		'desc'      => __( 'ChatGPT vs Claude vs Copilot zakelijk: een nuchtere vergelijking voor het MKB op gebruik, Microsoft 365, privacy-instellingen en kosten per gebruiker.', 'veryo' ),
		'kw'        => 'chatgpt vs claude vs copilot zakelijk',
		'content'   => $veryo_draft(
			array(
				array( __( 'Eerst: wat wil je ermee doen?', 'veryo' ), __( 'De keuze hangt af van taken en bestaande software, niet van welk model “het beste” is.', 'veryo' ) ),
				array(
					__( 'De drie op een rij', 'veryo' ),
					__( 'Per tool sterke punten en aandachtspunten. Controleer actuele functies en prijzen voor publicatie.', 'veryo' ),
					array(
						array( __( 'ChatGPT', 'veryo' ), __( 'Breed inzetbaar, veel gebruikers kennen het. Let op de zakelijke versie en instellingen.', 'veryo' ) ),
						array( __( 'Claude', 'veryo' ), __( 'Sterk in lange documenten en schrijven. Let op de zakelijke versie en instellingen.', 'veryo' ) ),
						array( __( 'Copilot', 'veryo' ), __( 'Geïntegreerd in Microsoft 365, handig als je daar al in werkt.', 'veryo' ) ),
					),
				),
				array( __( 'Zakelijk versus gratis', 'veryo' ), __( 'Waarom de zakelijke versies andere afspraken hebben over gegevensgebruik. [VUL IN: actuele voorwaarden checken]', 'veryo' ) ),
				array( __( 'Ons advies', 'veryo' ), __( 'Kies één tool voor het team, maak afspraken en train. Wisselen kan later.', 'veryo' ) ),
			),
			array(
				array( __( 'Kun je meerdere tools tegelijk gebruiken?', 'veryo' ), __( 'Kan, maar maakt afspraken lastiger. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Wat kost een zakelijk account?', 'veryo' ), __( '[VUL IN: actuele prijzen per gebruiker, controleer voor publicatie]', 'veryo' ) ),
				array( __( 'Welke is het veiligst?', 'veryo' ), __( 'Dat hangt vooral af van de gekozen versie en instellingen. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'is-chatgpt-veilig-ai-en-avg'        => array(
		'title'     => __( 'Is ChatGPT veilig voor bedrijfsgegevens? AI en de AVG', 'veryo' ),
		'seo_title' => __( 'Is ChatGPT veilig? AI en de AVG voor bedrijven | Veryo', 'veryo' ),
		'desc'      => __( 'AI en de AVG: is ChatGPT veilig voor bedrijfsgegevens? Wat mag je invoeren, wat verschilt tussen gratis en zakelijk, en wanneer heb je een verwerker nodig?', 'veryo' ),
		'kw'        => 'ai en avg',
		'content'   => $veryo_draft(
			array(
				array( __( 'Het korte antwoord', 'veryo' ), __( 'Het hangt af van de versie, de instellingen en wat je invoert. Geen ja of nee, wel een paar vaste regels.', 'veryo' ) ),
				array(
					__( 'Wat de AVG vraagt', 'veryo' ),
					__( 'Grondslag, dataminimalisatie, verwerkersovereenkomst, doorgifte buiten de EU. In gewone taal.', 'veryo' ),
					array(
						array( __( 'Persoonsgegevens invoeren', 'veryo' ), __( 'Wanneer het mag en wanneer niet.', 'veryo' ) ),
						array( __( 'Verwerkersovereenkomst', 'veryo' ), __( 'Wanneer je die nodig hebt met een AI-leverancier.', 'veryo' ) ),
					),
				),
				array( __( 'Vijf praktische regels voor je team', 'veryo' ), __( 'Geen klantnamen in gratis tools, zakelijke accounts, instellingen voor training uit, uitvoer controleren, afspraken vastleggen.', 'veryo' ) ),
				array( __( 'Hoe Veryo hiermee omgaat', 'veryo' ), __( 'Zakelijke API’s, verwerkersovereenkomst, klant is eigenaar van data. Voorbeeld: de AI-scan stuurt geen contactgegevens naar de AI-dienst.', 'veryo' ) ),
			),
			array(
				array( __( 'Traint ChatGPT op mijn gegevens?', 'veryo' ), __( '[VUL IN: actuele voorwaarden gratis en zakelijke versies checken]', 'veryo' ) ),
				array( __( 'Mag ik klantmails in AI plakken?', 'veryo' ), __( 'Alleen onder voorwaarden. [VUL IN: aanvullen, juridisch laten checken]', 'veryo' ) ),
				array( __( 'Heb ik een DPIA nodig?', 'veryo' ), __( 'Bij hoog risico mogelijk wel. [VUL IN: laten checken]', 'veryo' ) ),
			)
		),
	),

	'ai-prompts-voor-installateurs'      => array(
		'title'     => __( 'Handige AI-prompts voor installateurs (en andere vakmensen)', 'veryo' ),
		'seo_title' => __( 'Handige ChatGPT-prompts voor installateurs | Veryo', 'veryo' ),
		'desc'      => __( 'ChatGPT-prompts voor installateurs en andere vakmensen: kant-en-klare opdrachten voor offertes, klantmails, werkinstructies en vacatureteksten.', 'veryo' ),
		'kw'        => 'chatgpt prompts voor installateurs',
		'content'   => $veryo_draft(
			array(
				array( __( 'Zo schrijf je een goede prompt', 'veryo' ), __( 'Rol, taak, context, vorm. Eén voorbeeld voor en na.', 'veryo' ) ),
				array(
					__( 'Prompts per taak', 'veryo' ),
					__( 'Per taak een prompt in een codeblok of citaat, met uitleg wat je aanpast.', 'veryo' ),
					array(
						array( __( 'Offerte-tekst', 'veryo' ), __( 'Van steekwoorden naar een heldere offerte-omschrijving.', 'veryo' ) ),
						array( __( 'Klantmail na een storing', 'veryo' ), __( 'Vriendelijk, kort, met vervolgstappen.', 'veryo' ) ),
						array( __( 'Werkinstructie', 'veryo' ), __( 'Van inspreekbericht naar stappenplan.', 'veryo' ) ),
						array( __( 'Vacaturetekst', 'veryo' ), __( 'In de taal van monteurs.', 'veryo' ) ),
					),
				),
				array( __( 'Wat je niet invoert', 'veryo' ), __( 'Geen namen, adressen of telefoonnummers van klanten in gratis tools.', 'veryo' ) ),
			),
			array(
				array( __( 'Werkt dit ook met Claude of Copilot?', 'veryo' ), __( 'Ja, de prompts werken in alle gangbare tools. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Kan AI technische vragen beantwoorden?', 'veryo' ), __( 'Soms, maar controleer altijd met de handleiding. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Hoe maak ik de prompts nog beter?', 'veryo' ), __( 'Geef voorbeelden van je eigen stijl mee. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'slim-subsidie-ai-training'          => array(
		'title'     => __( 'SLIM-subsidie voor AI-training: zo werkt het', 'veryo' ),
		'seo_title' => __( 'SLIM-subsidie voor AI-training: zo werkt het | Veryo', 'veryo' ),
		'desc'      => __( 'SLIM-subsidie voor AI-training: wat de regeling is, voor wie ze mogelijk geschikt is en waar je op let. Periodes en voorwaarden wisselen, dus check altijd.', 'veryo' ),
		'kw'        => 'slim subsidie ai training',
		'content'   => $veryo_draft(
			array(
				array( __( 'Wat is de SLIM-regeling?', 'veryo' ), __( 'Korte, feitelijke uitleg met link naar de officiële bron. Benadrukken dat openstellingsperiodes en voorwaarden wisselen en gecheckt moeten worden. [VUL IN: actuele informatie]', 'veryo' ) ),
				array( __( 'Kan AI-training eronder vallen?', 'veryo' ), __( 'Mogelijk, afhankelijk van de voorwaarden van de openstelling. Geen belofte.', 'veryo' ) ),
				array(
					__( 'Waar je op let', 'veryo' ),
					__( 'Praktische aandachtspunten.', 'veryo' ),
					array(
						array( __( 'Timing', 'veryo' ), __( 'Aanvraagperiodes en volgorde van aanvragen.', 'veryo' ) ),
						array( __( 'Administratie', 'veryo' ), __( 'Wat je moet bijhouden.', 'veryo' ) ),
					),
				),
				array( __( 'Wat Veryo wel en niet doet', 'veryo' ), __( 'Veryo geeft de training en levert de gegevens die je nodig hebt; het aanvragen doe je zelf of met een subsidieadviseur.', 'veryo' ) ),
			),
			array(
				array( __( 'Wanneer is de SLIM-regeling open?', 'veryo' ), __( '[VUL IN: actuele openstellingsperiode, check de officiële bron]', 'veryo' ) ),
				array( __( 'Vraagt Veryo de subsidie aan?', 'veryo' ), __( 'Nee. We leveren wel de informatie over de training. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Hoeveel subsidie krijg je?', 'veryo' ), __( '[VUL IN: actuele percentages en maxima, check de officiële bron]', 'veryo' ) ),
			)
		),
	),

	'welke-processen-automatiseren'      => array(
		'title'     => __( 'Welke processen kun je het beste automatiseren?', 'veryo' ),
		'seo_title' => __( 'Welke processen kun je het beste automatiseren? | Veryo', 'veryo' ),
		'desc'      => __( 'Welke processen automatiseren? Vier criteria om te kiezen, voorbeelden uit het MKB en de processen die je beter niet automatiseert. Nuchter uitgelegd.', 'veryo' ),
		'kw'        => 'welke processen automatiseren',
		'content'   => $veryo_draft(
			array(
				array(
					__( 'Vier criteria', 'veryo' ),
					__( 'Een eenvoudige toets voor elk proces.', 'veryo' ),
					array(
						array( __( 'Komt het vaak voor?', 'veryo' ), __( 'Wekelijks of vaker.', 'veryo' ) ),
						array( __( 'Is het voorspelbaar?', 'veryo' ), __( 'Duidelijke in- en uitvoer.', 'veryo' ) ),
						array( __( 'Kost het veel tijd?', 'veryo' ), __( 'Meerdere uren per week.', 'veryo' ) ),
						array( __( 'Is het risico beperkt?', 'veryo' ), __( 'Fouten zijn te herstellen.', 'veryo' ) ),
					),
				),
				array( __( 'Voorbeelden die meestal goed scoren', 'veryo' ), __( 'Inkoopfacturen, offerte-opvolging, mail sorteren, onderhoudsplanning.', 'veryo' ) ),
				array( __( 'Wat je beter niet automatiseert', 'veryo' ), __( 'Beslissingen met grote gevolgen, zelden voorkomend werk, processen die nog niet helder zijn.', 'veryo' ) ),
			),
			array(
				array( __( 'Wat is het verschil tussen automatiseren en AI?', 'veryo' ), __( 'Automatisering volgt regels; AI kan ook ongestructureerde informatie aan. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Hoe meet je het resultaat?', 'veryo' ), __( 'Tijd voor en na, aantal fouten. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Moet je eerst je processen op orde hebben?', 'veryo' ), __( 'Ja, anders automatiseer je de rommel. [VUL IN: aanvullen]', 'veryo' ) ),
			)
		),
	),

	'wbso-voor-ai-projecten'             => array(
		'title'     => __( 'WBSO voor AI-projecten: zo werkt het', 'veryo' ),
		'seo_title' => __( 'WBSO voor AI-projecten: zo werkt het | Veryo', 'veryo' ),
		'desc'      => __( 'WBSO en AI: wanneer een AI-project mogelijk in aanmerking komt, wat de regeling vraagt en waarom je een subsidiespecialist inschakelt. Geen advies.', 'veryo' ),
		'kw'        => 'wbso ai',
		'content'   => $veryo_draft(
			array(
				array( __( 'Eerst dit: Veryo is geen subsidieadviseur', 'veryo' ), __( 'Maak vanaf de eerste alinea duidelijk dat dit artikel een oriëntatie is en dat je voor een aanvraag een subsidiespecialist inschakelt. Veryo vraagt geen subsidies aan.', 'veryo' ) ),
				array( __( 'Wat is de WBSO?', 'veryo' ), __( 'Korte, feitelijke uitleg met link naar de officiële bron. Voorwaarden en percentages wisselen; check de actuele situatie. [VUL IN: actuele informatie]', 'veryo' ) ),
				array(
					__( 'Wanneer kan een AI-project mogelijk in aanmerking komen?', 'veryo' ),
					__( 'Voorzichtig formuleren: het gaat om eigen technisch nieuw ontwikkelwerk, niet om het inzetten van bestaande tools.', 'veryo' ),
					array(
						array( __( 'Waarschijnlijk niet', 'veryo' ), __( 'Een bestaande chatbot of standaardautomatisering inrichten.', 'veryo' ) ),
						array( __( 'Mogelijk wel', 'veryo' ), __( 'Zelf technisch nieuwe software ontwikkelen met onzekere uitkomst. Laat een specialist beoordelen.', 'veryo' ) ),
					),
				),
				array( __( 'Wat je nodig hebt', 'veryo' ), __( 'Projectbeschrijving, urenadministratie, tijdige aanvraag. Details via een specialist.', 'veryo' ) ),
			),
			array(
				array( __( 'Valt een AI-chatbot onder de WBSO?', 'veryo' ), __( 'Meestal niet als het om het inrichten van bestaande technologie gaat. Laat het beoordelen. [VUL IN: laten checken]', 'veryo' ) ),
				array( __( 'Helpt Veryo met de aanvraag?', 'veryo' ), __( 'Nee, schakel een subsidiespecialist in. [VUL IN: aanvullen]', 'veryo' ) ),
				array( __( 'Waar vind ik de actuele voorwaarden?', 'veryo' ), __( '[VUL IN: link naar de officiële bron]', 'veryo' ) ),
			)
		),
	),
);
