<?php
/**
 * Dienstencatalogus, prijsladder en de regelgebaseerde mapping voor het fallback-rapport.
 * De AI-scan mag uitsluitend ID's uit deze catalogus aanbevelen.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Categorieën: slug => label (slug gelijk aan de URL onder /ai-automatisering/).
 *
 * @return array<string,string>
 */
function veryo_catalog_categories() {
	return array(
		'klantcontact'            => __( 'Klantcontact', 'veryo' ),
		'offertes-en-calculaties' => __( 'Verkoop, offertes en calculaties', 'veryo' ),
		'administratie'           => __( 'Administratie', 'veryo' ),
		'werkprocessen'           => __( 'Werkprocessen', 'veryo' ),
		'marketing'               => __( 'Marketing', 'veryo' ),
		'hr-en-werving'           => __( 'HR en werving', 'veryo' ),
		'kennis-en-documenten'    => __( 'Kennis en documenten', 'veryo' ),
		'rapportages'             => __( 'Rapportages', 'veryo' ),
	);
}

/**
 * Niveaus met prijsindicatie (exclusief btw).
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_catalog_levels() {
	return array(
		'quick-win' => array(
			'label'  => __( 'Quick win', 'veryo' ),
			'min'    => 750,
			'max'    => 1500,
			'price'  => __( '€750–1.500', 'veryo' ),
			'uitleg' => __( 'invoering of koppeling van één afgebakende flow', 'veryo' ),
		),
		'project'   => array(
			'label'  => __( 'Project', 'veryo' ),
			'min'    => 2500,
			'max'    => 7500,
			'price'  => __( '€2.500–7.500', 'veryo' ),
			'uitleg' => __( 'meerdere flows of koppelingen', 'veryo' ),
		),
		'maatwerk'  => array(
			'label'  => __( 'Maatwerk', 'veryo' ),
			'min'    => 5000,
			'max'    => 25000,
			'price'  => __( '€5.000–25.000+', 'veryo' ),
			'uitleg' => __( 'eigen AI-agent, chatbot of tool', 'veryo' ),
		),
	);
}

/**
 * De volledige catalogus. Per item: id, categorie, naam, wat, tijdwinst_tekst, niveau.
 *
 * @return array<string,array<string,string>>
 */
function veryo_catalog() {
	static $catalog = null;
	if ( null !== $catalog ) {
		return $catalog;
	}
	// Compacte bron: id => [categorie, naam, wat, tijdwinst, niveau].
	$rows = array(
		// 1. Klantcontact.
		'mail-sortering'          => array( 'klantcontact', 'Slimme mailbox-sortering', 'AI labelt inkomende mail en zet hem bij de juiste persoon.', '2–4 u/wk', 'quick-win' ),
		'mail-concepten'          => array( 'klantcontact', 'Conceptantwoorden op mail', 'Conceptantwoorden op binnenkomende mail, in jullie eigen toon en huisstijl.', '3–6 u/wk', 'quick-win' ),
		'whatsapp-assistent'      => array( 'klantcontact', 'WhatsApp-assistent', 'Beantwoordt vragen 24/7, verzamelt gegevens en foto\'s en plant afspraken in.', '3–8 u/wk', 'project' ),
		'website-chatbot'         => array( 'klantcontact', 'Website-chatbot op eigen kennis', 'Een chatbot die antwoord geeft op basis van jullie eigen informatie.', '2–5 u/wk', 'project' ),
		'voicebot'                => array( 'klantcontact', 'AI-telefoonassistent', 'Neemt buiten kantoortijd de telefoon op, noteert de vraag en plant een terugbelmoment.', '2–6 u/wk', 'maatwerk' ),
		'gespreksverslagen'       => array( 'klantcontact', 'Gespreksverslagen', 'Gespreksverslagen met actiepunten, direct naar CRM of mail.', '1–3 u/wk', 'quick-win' ),
		'statusberichten'         => array( 'klantcontact', 'Automatische klantupdates', 'Klanten krijgen vanzelf een bericht als de status van hun opdracht verandert.', '1–3 u/wk', 'quick-win' ),
		'klachten'                => array( 'klantcontact', 'Klachtenafhandeling', 'Klachten herkennen, prioriteren en een eerste reactie klaarzetten.', '1–3 u/wk', 'project' ),
		'vertalen'                => array( 'klantcontact', 'Vertalen van berichten', 'Mail en berichten vertalen, bijvoorbeeld Pools, Duits en Engels.', '1–2 u/wk', 'quick-win' ),
		// 2. Verkoop en offertes.
		'offerte-generator'       => array( 'offertes-en-calculaties', 'Offerte-generator', 'Van aanvraag, notities of foto naar een complete offerte.', '3–8 u/wk', 'project' ),
		'offerte-opvolging'       => array( 'offertes-en-calculaties', 'Offerte-opvolging', 'Automatische herinneringen na 3, 7 en 14 dagen.', '1–3 u/wk', 'quick-win' ),
		'leadkwalificatie'        => array( 'offertes-en-calculaties', 'Leadkwalificatie', 'Nieuwe aanvragen beoordelen en prioriteren.', '1–2 u/wk', 'quick-win' ),
		'lead-invoer'             => array( 'offertes-en-calculaties', 'Aanvragen in één overzicht', 'Aanvragen uit site, mail, WhatsApp en platforms samen in één overzicht.', '1–3 u/wk', 'quick-win' ),
		'prospect-briefing'       => array( 'offertes-en-calculaties', 'Prospect-briefing', 'Een korte briefing over een prospect vóór een gesprek.', '1–2 u/wk', 'quick-win' ),
		'outreach'                => array( 'offertes-en-calculaties', 'Persoonlijke eerste berichten', 'Gepersonaliseerde eerste mails en LinkedIn-berichten.', '2–5 u/wk', 'project' ),
		'aanbestedingsscan'       => array( 'offertes-en-calculaties', 'Aanbestedingsscan', 'Passende aanbestedingen vinden en de eisen samenvatten.', '2–4 u/wk', 'project' ),
		'contracten'              => array( 'offertes-en-calculaties', 'Opdrachtbevestigingen en contracten', 'Opdrachtbevestigingen en contracten opgemaakt uit de offerte.', '1–2 u/wk', 'quick-win' ),
		'upsell-signalen'         => array( 'offertes-en-calculaties', 'Signalen voor vervolgopdrachten', 'Klanten met aflopend onderhoud of contract herkennen en benaderen.', 'omzet', 'project' ),
		// 3. Calculaties.
		'calculatietool'          => array( 'offertes-en-calculaties', 'Eigen calculatietool', 'Een calculatietool met jullie prijzen, uurtarieven en marges.', '3–10 u/wk', 'project' ),
		'materiaalstaat'          => array( 'offertes-en-calculaties', 'Materiaalstaat uit tekening of bestek', 'Een concept-materiaallijst uit tekening of bestek.', '2–6 u/wk', 'maatwerk' ),
		'prijzen-actueel'         => array( 'offertes-en-calculaties', 'Actuele inkoopprijzen', 'Inkoopprijzen automatisch bijwerken.', '1–3 u/wk', 'project' ),
		'offerte-uit-calculatie'  => array( 'offertes-en-calculaties', 'Calculatie naar offerte', 'De calculatie in één klik omzetten naar een offerte.', '1–3 u/wk', 'quick-win' ),
		'nacalculatie'            => array( 'offertes-en-calculaties', 'Nacalculatie', 'Begroot tegenover werkelijk, per project.', '1–3 u/wk', 'project' ),
		'prijsindicator'          => array( 'offertes-en-calculaties', 'Online prijsindicator', 'Een prijsindicator voor klanten op de website.', 'meer leads', 'project' ),
		'meerwerk'                => array( 'offertes-en-calculaties', 'Meerwerk registreren', 'Meerwerk inspreken of fotograferen en er een meerwerkregel van maken.', '1–2 u/wk', 'quick-win' ),
		'subsidiecheck'           => array( 'offertes-en-calculaties', 'Regelingencheck per project', 'Per project nagaan welke regelingen mogelijk van toepassing zijn.', '1–2 u/wk', 'quick-win' ),
		'terugverdien'            => array( 'offertes-en-calculaties', 'Terugverdienberekening', 'Een rendements- en terugverdienberekening bij de offerte.', '1–2 u/wk', 'quick-win' ),
		// 4. Administratie.
		'inkoopfacturen'          => array( 'administratie', 'Inkoopfacturen verwerken', 'Inkoopfacturen uit de mail verwerken naar Exact, Moneybird of SnelStart.', '2–5 u/wk', 'quick-win' ),
		'bonnetjes'               => array( 'administratie', 'Bonnetjes automatisch boeken', 'Bonnetjes via een foto of WhatsApp automatisch boeken.', '1–3 u/wk', 'quick-win' ),
		'werkbon-factuur'         => array( 'administratie', 'Van werkbon naar factuur', 'Een afgeronde werkbon wordt automatisch een factuur.', '2–4 u/wk', 'project' ),
		'debiteuren'              => array( 'administratie', 'Debiteurenbeheer', 'Herinneringen en aanmaningen, met een melding wanneer je moet bellen.', '1–3 u/wk', 'quick-win' ),
		'bankmutaties'            => array( 'administratie', 'Bankmutaties koppelen', 'Betalingen automatisch koppelen aan facturen.', '1–2 u/wk', 'quick-win' ),
		'urenregistratie'         => array( 'administratie', 'Urenregistratie verwerken', 'Uren uit een app, WhatsApp of briefjes verwerken.', '2–4 u/wk', 'project' ),
		'archiveren'              => array( 'administratie', 'Documenten archiveren', 'Documenten benoemen, sorteren en waarschuwen bij een vervaldatum.', '1–2 u/wk', 'quick-win' ),
		'formulieren'             => array( 'administratie', 'Formulieren invullen', 'Terugkerende formulieren automatisch invullen.', '1–2 u/wk', 'project' ),
		// 5. Werkprocessen.
		'planningsassistent'      => array( 'werkprocessen', 'Planningsassistent', 'Een weekplanning voorstellen op basis van beschikbaarheid, vaardigheden en locatie.', '3–6 u/wk', 'maatwerk' ),
		'digitale-werkbon'        => array( 'werkprocessen', 'Digitale werkbon', 'Inspreken of foto\'s maken, en er komt een nette werkbon uit.', '2–5 u/wk', 'project' ),
		'opleverrapport'          => array( 'werkprocessen', 'Opleverrapport', 'Foto\'s en notities worden een opleverrapport in huisstijl.', '1–3 u/wk', 'quick-win' ),
		'inkoop-bestellingen'     => array( 'werkprocessen', 'Inkoop en bestellingen', 'Van materiaallijst naar bestelling bij de groothandel.', '1–3 u/wk', 'project' ),
		'voorraad'                => array( 'werkprocessen', 'Voorraadsignalering', 'Signaleren wat bijbesteld moet worden, op basis van geplande projecten.', '1–2 u/wk', 'project' ),
		'onderhoudsplanning'      => array( 'werkprocessen', 'Onderhouds- en keuringsplanning', 'Periodiek onderhoud en keuringen automatisch inplannen.', '1–3 u/wk', 'quick-win' ),
		'checklists'              => array( 'werkprocessen', 'Digitale checklists', 'Digitale kwaliteits- en VCA-checklists.', '1–2 u/wk', 'quick-win' ),
		'overdracht'              => array( 'werkprocessen', 'Dagelijkse overdracht', 'Een dagelijkse samenvatting per team in WhatsApp of Teams.', '1–2 u/wk', 'quick-win' ),
		'storingen'               => array( 'werkprocessen', 'Storingsmeldingen triageren', 'Storingsmeldingen beoordelen, prioriteren en toewijzen.', '1–3 u/wk', 'project' ),
		'koppelingen'             => array( 'werkprocessen', 'Systemen koppelen', 'Systemen koppelen zodat niets dubbel wordt ingevoerd.', '2–6 u/wk', 'project' ),
		// 6. Marketing.
		'zoekwoordenplanning'     => array( 'marketing', 'Zoekwoorden- en contentkalender', 'Een zoekwoordenplanning en contentkalender.', '2–4 u/mnd', 'quick-win' ),
		'blogs'                   => array( 'marketing', 'SEO-blogconcepten', 'Blogconcepten in jullie tone of voice, klaar voor een menselijke check.', '2–4 u/blog', 'project' ),
		'lokale-paginas'          => array( 'marketing', 'Lokale landingspagina\'s', 'Unieke lokale landingspagina\'s per werkgebied.', '5–15 u/mnd', 'project' ),
		'seo-check'               => array( 'marketing', 'Maandelijkse SEO-check', 'Een maandelijkse technische SEO-check.', '2–3 u/mnd', 'quick-win' ),
		'geo'                     => array( 'marketing', 'Vindbaar in AI-zoekmachines', 'Vindbaarheid in ChatGPT en andere AI-zoekmachines.', '2–4 u/mnd', 'project' ),
		'bedrijfsprofiel'         => array( 'marketing', 'Google Bedrijfsprofiel', 'Posts en reviewreacties voor je Google Bedrijfsprofiel.', '1–2 u/wk', 'quick-win' ),
		'contenthergebruik'       => array( 'marketing', 'Content hergebruiken', 'Eén video of blog wordt posts en een nieuwsbrief-item.', '3–6 u/wk', 'project' ),
		'social-captions'         => array( 'marketing', 'Social captions en planning', 'Captions schrijven en posts inplannen.', '2–4 u/wk', 'quick-win' ),
		'projectfotos'            => array( 'marketing', 'Project van de week', 'Projectfoto\'s worden een "project van de week"-post.', '1–3 u/wk', 'quick-win' ),
		'shorts'                  => array( 'marketing', 'Korte clips', 'Lange video\'s worden korte clips met ondertitels.', '2–5 u/wk', 'project' ),
		'advertentieteksten'      => array( 'marketing', 'Advertentieteksten', 'Advertentievarianten voor Google en Meta.', '1–3 u/wk', 'quick-win' ),
		'advertentierapportage'   => array( 'marketing', 'Advertentierapportage', 'Een wekelijkse samenvatting van je advertenties.', '1–2 u/wk', 'quick-win' ),
		'nieuwsbrief'             => array( 'marketing', 'Nieuwsbrief samenstellen', 'De maandelijkse nieuwsbrief samenstellen.', '2–4 u/mnd', 'quick-win' ),
		'emailflows'              => array( 'marketing', 'E-mailflows', 'Welkomst-, opvolg-, onderhouds- en heractivatiemails.', 'omzet', 'project' ),
		'reviews'                 => array( 'marketing', 'Reviews verzamelen', 'Na elke klus automatisch een reviewverzoek.', '1–2 u/wk', 'quick-win' ),
		'concurrentiemonitor'     => array( 'marketing', 'Concurrentiemonitor', 'Een maandelijkse update over wat concurrenten doen.', '2–3 u/mnd', 'project' ),
		// 7. HR en werving.
		'vacatureteksten'         => array( 'hr-en-werving', 'Vacatureteksten', 'Vacatures in de taal van vakmensen.', '1–2 u/vacature', 'quick-win' ),
		'whatsapp-sollicitatie'   => array( 'hr-en-werving', 'Solliciteren via WhatsApp', 'Solliciteren via WhatsApp zonder cv, en zelf een kennismaking inplannen.', '2–5 u/wk', 'project' ),
		'voorselectie'            => array( 'hr-en-werving', 'Voorselectie', 'Een shortlist op basis van harde eisen.', '1–3 u/wk', 'quick-win' ),
		'kandidaatopvolging'      => array( 'hr-en-werving', 'Kandidaatopvolging', 'Bevestiging, status en afwijzing automatisch versturen.', '1–2 u/wk', 'quick-win' ),
		'onboarding'              => array( 'hr-en-werving', 'Onboarding', 'Documenten, accounts en planning klaarzetten voor een nieuwe medewerker.', '1–3 u/medewerker', 'project' ),
		'verlof'                  => array( 'hr-en-werving', 'Verlof en verzuim', 'Verlof en verzuim melden via WhatsApp of een formulier.', '1–2 u/wk', 'quick-win' ),
		'certificaten'            => array( 'hr-en-werving', 'Certificaten bijhouden', 'VCA, keuringen en opleidingen bijhouden.', '1–2 u/mnd', 'quick-win' ),
		// 8. Kennis en documenten.
		'interne-assistent'       => array( 'kennis-en-documenten', 'Interne AI-assistent', 'Een chatbot op jullie eigen documenten en procedures.', '2–6 u/wk', 'maatwerk' ),
		'werkinstructies'         => array( 'kennis-en-documenten', 'Werkinstructies', 'Van video of inspreekbericht naar een werkinstructie.', '2–4 u/stuk', 'quick-win' ),
		'documenten-samenvatten'  => array( 'kennis-en-documenten', 'Documenten samenvatten', 'Samenvatten en risico\'s markeren, als voorbereiding op juridisch advies.', '1–3 u/wk', 'quick-win' ),
		'technische-documentatie' => array( 'kennis-en-documenten', 'Technische documentatie doorzoeken', 'Productbladen en handleidingen doorzoekbaar maken.', '1–3 u/wk', 'project' ),
		'beleid'                  => array( 'kennis-en-documenten', 'Beleid en protocollen', 'Concepten voor AI-beleid, privacyverklaring en protocollen.', '2–4 u/stuk', 'quick-win' ),
		'presentaties'            => array( 'kennis-en-documenten', 'Presentaties en rapporten', 'Ruwe input wordt een presentatie of rapport in huisstijl.', '2–4 u/stuk', 'quick-win' ),
		// 9. Rapportages.
		'dashboard'               => array( 'rapportages', 'Ondernemersdashboard', 'Omzet, offertes, debiteuren, planning en leads in één overzicht.', '2–4 u/wk', 'project' ),
		'weekupdate'              => array( 'rapportages', 'Maandagbericht met cijfers', 'Elke maandag de belangrijkste cijfers in gewone taal.', '1–2 u/wk', 'quick-win' ),
		'excel'                   => array( 'rapportages', 'Excel opschonen en analyseren', 'Excel-bestanden opschonen, samenvoegen en analyseren.', '1–3 u/wk', 'quick-win' ),
		'projectrendement'        => array( 'rapportages', 'Rendement per project', 'Rendement per project of klanttype.', '1–2 u/wk', 'project' ),
		'klanttevredenheid'       => array( 'rapportages', 'Klanttevredenheid analyseren', 'Reviews en enquêtes analyseren.', '1–2 u/mnd', 'quick-win' ),
		'voorspellingen'          => array( 'rapportages', 'Voorspellingen', 'Werkaanbod, pieken en cashflow voorspellen.', 'afhankelijk van data', 'maatwerk' ),
	);

	$catalog = array();
	foreach ( $rows as $id => $row ) {
		$catalog[ $id ] = array(
			'id'              => $id,
			'categorie'       => $row[0],
			'naam'            => $row[1],
			'wat'             => $row[2],
			'tijdwinst_tekst' => $row[3],
			'niveau'          => $row[4],
		);
	}
	return $catalog;
}

/**
 * Eén catalogusitem.
 *
 * @param string $id ID.
 * @return array<string,string>|null
 */
function veryo_catalog_item( $id ) {
	$catalog = veryo_catalog();
	return isset( $catalog[ $id ] ) ? $catalog[ $id ] : null;
}

/**
 * Prijzen van het Veryo AI-Startpakket per teamgrootte (exclusief btw, vaste prijs).
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_startpakket_prices() {
	return array(
		'tot-10' => array(
			'label' => __( 'Tot 10 medewerkers', 'veryo' ),
			'price' => 1995,
		),
		'11-25'  => array(
			'label' => __( '11–25 medewerkers', 'veryo' ),
			'price' => 2995,
		),
		'26-50'  => array(
			'label' => __( '26–50 medewerkers', 'veryo' ),
			'price' => 4495,
		),
	);
}

/**
 * De vijf onderdelen van het AI-Startpakket.
 *
 * @return array<int,array<int,string>> Lijst van array( titel, uitleg ).
 */
function veryo_startpakket_parts() {
	return array(
		array( __( 'AI-scan en kansensessie', 'veryo' ), __( 'Een halve dag samen je processen doorlopen, inclusief advies welke bestaande tools het best bij jullie passen.', 'veryo' ) ),
		array( __( 'AI-training voor het hele team', 'veryo' ), __( 'Een halve dag praktisch aan de slag met ChatGPT, Claude of Copilot, en helder wat wel en niet mag.', 'veryo' ) ),
		array( __( 'AI-beleid op maat', 'veryo' ), __( 'Een beleid van één à twee pagina’s: welke tools jullie gebruiken, welke gegevens er nooit in gaan en wie verantwoordelijk is.', 'veryo' ) ),
		array( __( 'Eén quick win ingericht', 'veryo' ), __( 'We richten één afgebakende toepassing daadwerkelijk in, zodat je team direct iets heeft dat werkt.', 'veryo' ) ),
		array( __( '30 dagen nazorg', 'veryo' ), __( 'Een maand lang een vast aanspreekpunt voor vragen, afgesloten met een evaluatie en een plan voor de volgende stappen.', 'veryo' ) ),
	);
}

/**
 * De onderdelen van het Startpakket als lopende opsomming ("a, b en c").
 * Een hoofdletter aan het begin wordt klein, behalve bij afkortingen als "AI".
 *
 * @return string
 */
function veryo_startpakket_parts_sentence() {
	$items = array();
	foreach ( veryo_startpakket_parts() as $part ) {
		$title = $part[0];
		$first = mb_substr( $title, 0, 1 );
		$next  = mb_substr( $title, 1, 1 );
		if ( 0 === strpos( $title, 'Eén' ) ) {
			$title = 'één' . substr( $title, strlen( 'Eén' ) );
		} elseif ( mb_strtolower( $next ) === $next ) {
			$title = mb_strtolower( $first ) . mb_substr( $title, 1 );
		}
		$items[] = $title;
	}
	$last = array_pop( $items );
	return $items ? implode( ', ', $items ) . ' ' . __( 'en', 'veryo' ) . ' ' . $last : (string) $last;
}

/**
 * Prijsindicatie van het Startpakket bij een teamgrootte uit de AI-scan.
 *
 * @param string $team Teamgrootte-sleutel uit de scan.
 * @return string
 */
function veryo_startpakket_price_for_team( $team ) {
	$p = veryo_startpakket_prices();
	switch ( $team ) {
		case '1':
		case '2-5':
			/* translators: %s: prijs. */
			return sprintf( __( '%s voor teams tot 10 medewerkers', 'veryo' ), veryo_euro( $p['tot-10']['price'] ) );
		case '6-20':
			/* translators: 1: prijs tot 10, 2: prijs 11–25. */
			return sprintf( __( '%1$s tot 10 medewerkers, %2$s bij 11–25 medewerkers', 'veryo' ), veryo_euro( $p['tot-10']['price'] ), veryo_euro( $p['11-25']['price'] ) );
		case '21-50':
			/* translators: 1: prijs 11–25, 2: prijs 26–50. */
			return sprintf( __( '%1$s bij 11–25 medewerkers, %2$s bij 26–50 medewerkers', 'veryo' ), veryo_euro( $p['11-25']['price'] ), veryo_euro( $p['26-50']['price'] ) );
		default:
			/* translators: %s: prijs. */
			return sprintf( __( 'vanaf %s; voor teams boven de 50 medewerkers maken we een voorstel op maat', 'veryo' ), veryo_euro( $p['26-50']['price'] ) );
	}
}

/**
 * Prijsonderdelen (§7). Alle bedragen exclusief btw, als indicatie. Sleutel => onderdeel.
 * Groep: instap, hoofdproduct, los, doorlopend.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_price_ladder() {
	return array(
		'scan'             => array(
			'groep'  => 'instap',
			'dienst' => __( 'Gratis AI-scan', 'veryo' ),
			'wat'    => __( 'Online vragenlijst, persoonlijk rapport en optioneel een belletje van 15 minuten.', 'veryo' ),
			'voor'   => __( 'Voor iedereen die wil weten waar AI in het eigen bedrijf tijd bespaart.', 'veryo' ),
			'prijs'  => __( 'Gratis', 'veryo' ),
			'min'    => 0,
			'max'    => 0,
			'path'   => 'waar-begin-ik-met-ai',
		),
		'academy'          => array(
			'groep'  => 'instap',
			'dienst' => __( 'Online AI-training, Veryo Academy (binnenkort)', 'veryo' ),
			'wat'    => __( 'Korte modules van 10 tot 15 minuten met oefeningen, per medewerker, met staffelkorting vanaf 10 personen.', 'veryo' ),
			'voor'   => __( 'Voor teams die zelfstandig willen leren, en voor losse deelnemers.', 'veryo' ),
			'prijs'  => __( '€49–79 per persoon', 'veryo' ),
			'min'    => 49,
			'max'    => 79,
			'path'   => 'academy',
		),
		'startpakket'      => array(
			'groep'  => 'hoofdproduct',
			'dienst' => __( 'Veryo AI-Startpakket', 'veryo' ),
			'wat'    => __( 'AI-scan en kansensessie, teamtraining, AI-beleid op maat, één quick win ingericht en 30 dagen nazorg.', 'veryo' ),
			'voor'   => __( 'Voor bedrijven die AI goed en veilig willen invoeren, met het hele team.', 'veryo' ),
			'prijs'  => __( 'vanaf €1.995', 'veryo' ),
			'min'    => 1995,
			'max'    => 4495,
			'path'   => 'ai-startpakket',
		),
		'kansensessie'     => array(
			'groep'  => 'los',
			'dienst' => __( 'AI-kansensessie en roadmap', 'veryo' ),
			'wat'    => __( 'Een workshop en een rapport met prioriteiten en de verwachte opbrengst per kans.', 'veryo' ),
			'voor'   => __( 'Voor wie eerst alleen een plan wil.', 'veryo' ),
			'prijs'  => __( '€750–1.500', 'veryo' ),
			'min'    => 750,
			'max'    => 1500,
			'path'   => 'ai-implementatie-mkb',
		),
		'training'         => array(
			'groep'  => 'los',
			'dienst' => __( 'In-company AI-training tot 20 personen', 'veryo' ),
			'wat'    => __( 'Een halve of hele dag met je eigen team, met oefeningen uit jullie eigen werk.', 'veryo' ),
			'voor'   => __( 'Voor teams die AI veilig en slim willen gebruiken, en voor de AI-geletterdheidsplicht.', 'veryo' ),
			'prijs'  => __( '€1.200 (halve dag) – €2.800 (hele dag)', 'veryo' ),
			'min'    => 1200,
			'max'    => 2800,
			'path'   => 'ai-training',
		),
		'werkplek'         => array(
			'groep'  => 'los',
			'dienst' => __( 'AI-werkplek inrichten', 'veryo' ),
			'wat'    => __( 'Microsoft 365 met Copilot of Google Workspace met Gemini: licentieadvies, toegangsrechten, instellingen en een korte teamtraining.', 'veryo' ),
			'voor'   => __( 'Voor teams die de AI in hun kantoorsoftware veilig en echt willen gebruiken.', 'veryo' ),
			'prijs'  => __( '€1.495 (tot 10 gebruikers) – €2.495 (11–25)', 'veryo' ),
			'min'    => 1495,
			'max'    => 2495,
			'path'   => 'ai-werkplek',
		),
		'veiligheidscheck' => array(
			'groep'  => 'los',
			'dienst' => __( 'AI-veiligheidscheck', 'veryo' ),
			'wat'    => __( 'Hoe wordt AI nu gebruikt, wie mag wat zien, staat tweestapsverificatie aan, is er beleid? Met een rapport vol concrete acties.', 'veryo' ),
			'voor'   => __( 'Voor bedrijven die willen weten of hun AI-gebruik veilig is.', 'veryo' ),
			'prijs'  => __( '€995', 'veryo' ),
			'min'    => 995,
			'max'    => 995,
			'path'   => 'veilig-ai-gebruik',
		),
		'quickwin'         => array(
			'groep'  => 'invoering',
			'dienst' => __( 'Invoering en koppelingen: quick win', 'veryo' ),
			'wat'    => __( 'Eén afgebakende toepassing ingericht of gekoppeld, bijvoorbeeld inkoopfacturen verwerken of offertes opvolgen.', 'veryo' ),
			'voor'   => __( 'Voor wie snel resultaat wil zien op één concreet knelpunt.', 'veryo' ),
			'prijs'  => __( '€750–1.500', 'veryo' ),
			'min'    => 750,
			'max'    => 1500,
			'path'   => 'ai-automatisering',
		),
		'project'          => array(
			'groep'  => 'invoering',
			'dienst' => __( 'Invoering en koppelingen: project', 'veryo' ),
			'wat'    => __( 'Meerdere toepassingen of koppelingen tussen de systemen die je al gebruikt.', 'veryo' ),
			'voor'   => __( 'Voor bedrijven waar een heel proces, van aanvraag tot factuur, soepeler moet.', 'veryo' ),
			'prijs'  => __( '€2.500–7.500', 'veryo' ),
			'min'    => 2500,
			'max'    => 7500,
			'path'   => 'ai-automatisering',
		),
		'agents'           => array(
			'groep'  => 'invoering',
			'dienst' => __( 'AI-agents en digitale collega’s', 'veryo' ),
			'wat'    => __( 'Een AI-assistent of agent die een terugkerende taak overneemt, gekoppeld aan je eigen systemen.', 'veryo' ),
			'voor'   => __( 'Voor taken die elke week veel tijd kosten en een vast patroon hebben.', 'veryo' ),
			'prijs'  => __( '€2.500–7.500 als project, maatwerk vanaf €5.000', 'veryo' ),
			'min'    => 2500,
			'max'    => 25000,
			'path'   => 'ai-agents',
		),
		'maatwerk'         => array(
			'groep'  => 'invoering',
			'dienst' => __( 'Maatwerk', 'veryo' ),
			'wat'    => __( 'Een eigen assistent, agent of tool, alleen als bestaande software tekortschiet.', 'veryo' ),
			'voor'   => __( 'Voor een vraag die geen bestaand pakket goed oplost.', 'veryo' ),
			'prijs'  => __( 'vanaf €5.000', 'veryo' ),
			'min'    => 5000,
			'max'    => 25000,
			'path'   => 'ai-op-maat',
		),
		'partner'          => array(
			'groep'  => 'doorlopend',
			'dienst' => __( 'AI-partner-abonnement', 'veryo' ),
			'wat'    => __( 'Een vaste vraagbaak, maandelijks overleg, nieuwe medewerkers bijscholen, kleine verbeteringen en koppelingen.', 'veryo' ),
			'voor'   => __( 'Voor bedrijven die AI structureel willen blijven verbeteren, zonder eigen specialist.', 'veryo' ),
			'prijs'  => __( '€495–995 per maand', 'veryo' ),
			'min'    => 495,
			'max'    => 995,
			'path'   => 'ai-partner',
		),
		'onderhoud'        => array(
			'groep'  => 'doorlopend',
			'dienst' => __( 'Onderhoud van gebouwde koppelingen', 'veryo' ),
			'wat'    => __( 'Monitoring, updates en kleine aanpassingen, zodat alles blijft werken.', 'veryo' ),
			'voor'   => __( 'Voor iedereen met koppelingen die elke dag moeten draaien.', 'veryo' ),
			'prijs'  => __( '€150–500 per maand', 'veryo' ),
			'min'    => 150,
			'max'    => 500,
			'path'   => 'prijzen',
		),
	);
}

/**
 * Abonnementen: bij elk pakket één passend abonnement.
 * Prijzen per maand, exclusief btw.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_subscriptions() {
	return array(
		'bijblijven'         => array(
			'naam'   => __( 'Bijblijven', 'veryo' ),
			'bij'    => __( 'AI-Startpakket', 'veryo' ),
			'pakket' => 'ai-startpakket',
			'inhoud' => __( 'Elk kwartaal een update-sessie (wat is er nieuw en wat heb je eraan), nieuwe medewerkers krijgen toegang tot de Academy, je AI-beleid wordt jaarlijks bijgewerkt en je kunt vragen per mail stellen.', 'veryo' ),
			'prijs'  => __( '€195 per maand', 'veryo' ),
			'price'  => 195,
			'unit'   => 'maand',
		),
		'werkplek-onderhoud' => array(
			'naam'      => __( 'Werkplek-onderhoud', 'veryo' ),
			'bij'       => __( 'AI-werkplek', 'veryo' ),
			'pakket'    => 'ai-werkplek',
			'inhoud'    => __( 'Nieuwe medewerkers inrichten, toegangsrechten bijhouden, en nieuwe functies van Copilot of Gemini beoordelen en aanzetten.', 'veryo' ),
			'prijs'     => __( '€10 per gebruiker per maand, minimaal €99', 'veryo' ),
			'price'     => 10,
			'min_total' => 99,
			'unit'      => 'gebruiker per maand',
		),
		'veilig-blijven'     => array(
			'naam'   => __( 'Veilig blijven', 'veryo' ),
			'bij'    => __( 'AI-veiligheidscheck', 'veryo' ),
			'pakket' => 'veilig-ai-gebruik',
			'inhoud' => __( 'Elke maand een controle van rechten en instellingen, twee keer per jaar een korte bewustwordingssessie, en je beleid blijft actueel.', 'veryo' ),
			'prijs'  => __( '€149 per maand', 'veryo' ),
			'price'  => 149,
			'unit'   => 'maand',
		),
		'onderhoud'          => array(
			'naam'   => __( 'Onderhoud', 'veryo' ),
			'bij'    => __( 'AI-agents en automatisering', 'veryo' ),
			'pakket' => 'ai-agents',
			'inhoud' => __( 'Verplicht bij elke gebouwde koppeling of agent: bewaking, foutmeldingen oplossen en aanpassen als je software verandert.', 'veryo' ),
			'prijs'  => __( '€150–500 per maand, afhankelijk van het aantal koppelingen', 'veryo' ),
			'min'    => 150,
			'max'    => 500,
			'unit'   => 'maand',
		),
	);
}

/**
 * AI-partner: alles in één, per teamgrootte.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_partner_tiers() {
	return array(
		'tot-10' => array(
			'label' => __( 'Tot 10 medewerkers', 'veryo' ),
			'users' => 10,
			'price' => 495,
			'uren'  => 4,
			'extra' => __( 'Bijblijven, Werkplek-onderhoud en Veilig blijven, plus 4 uur per maand voor verbeteringen en nieuwe toepassingen.', 'veryo' ),
		),
		'11-25'  => array(
			'label' => __( '11–25 medewerkers', 'veryo' ),
			'users' => 25,
			'price' => 745,
			'uren'  => 6,
			'extra' => __( 'Bijblijven, Werkplek-onderhoud en Veilig blijven, plus 6 uur per maand en maandelijks overleg.', 'veryo' ),
		),
		'26-50'  => array(
			'label' => __( '26–50 medewerkers', 'veryo' ),
			'users' => 50,
			'price' => 995,
			'uren'  => 10,
			'extra' => __( 'Bijblijven, Werkplek-onderhoud en Veilig blijven, plus 10 uur per maand, maandelijks overleg en voorrang bij vragen.', 'veryo' ),
		),
	);
}

/**
 * Prijzen AI-werkplek per aantal gebruikers.
 *
 * @return array<int,array<string,mixed>>
 */
function veryo_werkplek_prices() {
	return array(
		array(
			'label' => __( 'Tot 10 gebruikers', 'veryo' ),
			'price' => 1495,
		),
		array(
			'label' => __( '11–25 gebruikers', 'veryo' ),
			'price' => 2495,
		),
	);
}

/**
 * Maandbedrag van de drie losse abonnementen voor een aantal medewerkers.
 *
 * @param int $users Aantal gebruikers.
 * @return int
 */
function veryo_loose_subscriptions_total( $users ) {
	$subs     = veryo_subscriptions();
	$werkplek = max( (int) $subs['werkplek-onderhoud']['min_total'], (int) $subs['werkplek-onderhoud']['price'] * (int) $users );
	return (int) $subs['bijblijven']['price'] + $werkplek + (int) $subs['veilig-blijven']['price'];
}

/**
 * De eerlijke rekenvergelijking (10 medewerkers), berekend uit de tabellen.
 *
 * @return string
 */
function veryo_partner_comparison() {
	$subs     = veryo_subscriptions();
	$tiers    = veryo_partner_tiers();
	$werkplek = max( (int) $subs['werkplek-onderhoud']['min_total'], (int) $subs['werkplek-onderhoud']['price'] * 10 );
	return sprintf(
		/* translators: 1: bijblijven, 2: werkplek, 3: veilig, 4: totaal, 5: AI-partner, 6: uren. */
		__( 'Een bedrijf met 10 medewerkers dat Bijblijven, Werkplek-onderhoud en Veilig blijven los afneemt, betaalt €%1$d + €%2$d + €%3$d = €%4$d per maand. Met AI-partner betaal je €%5$d en krijg je er %6$d uur per maand bij.', 'veryo' ),
		(int) $subs['bijblijven']['price'],
		$werkplek,
		(int) $subs['veilig-blijven']['price'],
		veryo_loose_subscriptions_total( 10 ),
		(int) $tiers['tot-10']['price'],
		(int) $tiers['tot-10']['uren']
	);
}

/**
 * Keuzes in de AI-scan: branches.
 *
 * @return array<string,string>
 */
function veryo_scan_branches() {
	return array(
		'installatie' => __( 'Installatietechniek', 'veryo' ),
		'bouw'        => __( 'Bouw en aannemerij', 'veryo' ),
		'agri'        => __( 'Agri en mechanisatie', 'veryo' ),
		'makelaardij' => __( 'Makelaardij', 'veryo' ),
		'zakelijk'    => __( 'Zakelijke dienstverlening', 'veryo' ),
		'horeca'      => __( 'Horeca en retail', 'veryo' ),
		'transport'   => __( 'Transport en logistiek', 'veryo' ),
		'overig'      => __( 'Overig', 'veryo' ),
	);
}

/**
 * Keuzes: teamgrootte.
 *
 * @return array<string,string>
 */
function veryo_scan_team_sizes() {
	return array(
		'1'     => '1',
		'2-5'   => '2–5',
		'6-20'  => '6–20',
		'21-50' => '21–50',
		'50+'   => '50+',
	);
}

/**
 * Keuzes: taken waar tijd naartoe gaat.
 *
 * @return array<string,string>
 */
function veryo_scan_tasks() {
	return array(
		'email'         => __( 'E-mail en klantvragen', 'veryo' ),
		'offertes'      => __( 'Offertes maken', 'veryo' ),
		'administratie' => __( 'Administratie en facturen', 'veryo' ),
		'planning'      => __( 'Planning en roosters', 'veryo' ),
		'telefoon'      => __( 'Telefoon en WhatsApp', 'veryo' ),
		'content'       => __( 'Content en social media', 'veryo' ),
		'rapportages'   => __( 'Rapportages en Excel', 'veryo' ),
		'werving'       => __( 'Werving van personeel', 'veryo' ),
	);
}

/**
 * Keuzes: tools.
 *
 * @return array<string,string>
 */
function veryo_scan_tools() {
	return array(
		'outlook'    => 'Outlook',
		'gmail'      => 'Gmail',
		'excel'      => 'Excel',
		'exact'      => 'Exact',
		'moneybird'  => 'Moneybird',
		'snelstart'  => 'SnelStart',
		'boekhouden' => __( 'Ander boekhoudpakket', 'veryo' ),
		'crm'        => __( 'Een CRM', 'veryo' ),
		'planning'   => __( 'Een planningstool', 'veryo' ),
		'geen'       => __( 'Geen van deze', 'veryo' ),
	);
}

/**
 * Keuzes: huidig AI-gebruik.
 *
 * @return array<string,string>
 */
function veryo_scan_ai_usage() {
	return array(
		'nee'         => __( 'Nee', 'veryo' ),
		'geprobeerd'  => __( 'ChatGPT een keer geprobeerd', 'veryo' ),
		'paar'        => __( 'Een paar mensen gebruiken het', 'veryo' ),
		'structureel' => __( 'We gebruiken het structureel', 'veryo' ),
	);
}

/**
 * Keuzes: timing.
 *
 * @return array<string,string>
 */
function veryo_scan_timing() {
	return array(
		'nu'         => __( 'Nu', 'veryo' ),
		'3-maanden'  => __( 'Binnen 3 maanden', 'veryo' ),
		'orienteren' => __( 'Ik oriënteer me', 'veryo' ),
	);
}

/**
 * Vaste mapping taak → catalogus-ID's (op volgorde van voorkeur), voor het fallback-rapport.
 *
 * @return array<string,string[]>
 */
function veryo_scan_task_map() {
	return array(
		'email'         => array( 'mail-concepten', 'mail-sortering', 'website-chatbot', 'statusberichten' ),
		'offertes'      => array( 'offerte-generator', 'offerte-opvolging', 'calculatietool', 'lead-invoer' ),
		'administratie' => array( 'inkoopfacturen', 'werkbon-factuur', 'debiteuren', 'bonnetjes' ),
		'planning'      => array( 'planningsassistent', 'onderhoudsplanning', 'overdracht' ),
		'telefoon'      => array( 'whatsapp-assistent', 'voicebot', 'statusberichten' ),
		'content'       => array( 'social-captions', 'projectfotos', 'bedrijfsprofiel', 'blogs' ),
		'rapportages'   => array( 'weekupdate', 'dashboard', 'excel' ),
		'werving'       => array( 'vacatureteksten', 'whatsapp-sollicitatie', 'kandidaatopvolging' ),
	);
}

/**
 * Branchespecifieke voorkeuren per taak. Deze ID's gaan vóór de standaardmapping.
 *
 * @return array<string,array<string,string[]>>
 */
function veryo_scan_branch_map() {
	return array(
		'installatie' => array(
			'offertes'      => array( 'offerte-generator', 'calculatietool' ),
			'administratie' => array( 'werkbon-factuur' ),
			'planning'      => array( 'digitale-werkbon', 'onderhoudsplanning' ),
			'telefoon'      => array( 'whatsapp-assistent', 'storingen' ),
		),
		'bouw'        => array(
			'offertes'      => array( 'materiaalstaat', 'calculatietool' ),
			'administratie' => array( 'meerwerk', 'urenregistratie' ),
			'rapportages'   => array( 'nacalculatie' ),
			'planning'      => array( 'planningsassistent', 'inkoop-bestellingen' ),
		),
		'agri'        => array(
			'planning'      => array( 'onderhoudsplanning' ),
			'administratie' => array( 'inkoop-bestellingen', 'inkoopfacturen' ),
			'content'       => array( 'projectfotos' ),
		),
		'makelaardij' => array(
			'email'    => array( 'mail-concepten', 'lead-invoer' ),
			'telefoon' => array( 'whatsapp-assistent' ),
			'content'  => array( 'social-captions', 'contenthergebruik' ),
			'planning' => array( 'whatsapp-assistent' ),
		),
		'zakelijk'    => array(
			'email'         => array( 'gespreksverslagen', 'mail-concepten' ),
			'rapportages'   => array( 'documenten-samenvatten', 'dashboard' ),
			'administratie' => array( 'archiveren', 'inkoopfacturen' ),
			'planning'      => array( 'interne-assistent' ),
		),
		'horeca'      => array(
			'telefoon' => array( 'voicebot', 'whatsapp-assistent' ),
			'content'  => array( 'reviews', 'social-captions' ),
			'email'    => array( 'mail-concepten', 'reviews' ),
		),
		'transport'   => array(
			'planning'      => array( 'planningsassistent' ),
			'telefoon'      => array( 'statusberichten' ),
			'email'         => array( 'statusberichten', 'mail-sortering' ),
			'administratie' => array( 'archiveren', 'inkoopfacturen' ),
		),
	);
}

/**
 * Vooraf geschreven teksten voor het fallback-rapport: hoe het werkt en een eerste stap.
 *
 * @return array<string,array<string,string>>
 */
function veryo_catalog_fallback_texts() {
	return array(
		'mail-concepten'         => array( 'Inkomende mail wordt gelezen en er staat een conceptantwoord klaar in jullie eigen toon. Iemand van het team leest het na, past aan waar nodig en verstuurt.', 'Verzamel tien veelgestelde vragen met het antwoord dat jullie er meestal op geven.' ),
		'mail-sortering'         => array( 'Elke nieuwe mail krijgt automatisch een label, zoals offerte, factuur of klacht, en komt bij de juiste persoon terecht. Je stelt de regels één keer in en stuurt bij waar het nodig is.', 'Kijk welke vijf soorten mail het vaakst binnenkomen en wie ze nu afhandelt.' ),
		'website-chatbot'        => array( 'Een chatbot op je website beantwoordt vragen op basis van jullie eigen teksten, prijzen en voorwaarden. Weet hij het niet zeker, dan zet hij de vraag door naar een mens.', 'Zet de twintig vragen die je het vaakst krijgt met de antwoorden op een rij.' ),
		'statusberichten'        => array( 'Zodra de status van een opdracht verandert, krijgt de klant automatisch een kort bericht per mail of WhatsApp. Dat scheelt telefoontjes met de vraag hoe het ervoor staat.', 'Noteer een week lang hoe vaak klanten bellen of mailen om te vragen naar de status.' ),
		'offerte-generator'      => array( 'Een aanvraag, je notities of een foto worden omgezet in een conceptofferte met jullie prijzen en voorwaarden. Jij controleert, past aan en verstuurt.', 'Leg drie recente offertes naast elkaar en noteer welke onderdelen steeds terugkomen.' ),
		'offerte-opvolging'      => array( 'Na 3, 7 en 14 dagen gaat er automatisch een vriendelijke herinnering uit als een offerte nog open staat. Reageert de klant, dan stopt de reeks vanzelf.', 'Zet alle openstaande offertes van de afgelopen maand in één lijst met datum en bedrag.' ),
		'calculatietool'         => array( 'Je prijzen, uurtarieven en marges komen in één rekentool met vaste formules. AI helpt met het lezen van de aanvraag en het invullen, de rekenregels blijven van jou.', 'Schrijf op hoe je nu een gemiddelde calculatie opbouwt, stap voor stap.' ),
		'lead-invoer'            => array( 'Aanvragen uit je website, mail, WhatsApp en platforms komen automatisch in één overzicht met dezelfde velden. Niets blijft meer liggen in een inbox die niemand bekijkt.', 'Tel hoeveel kanalen er nu zijn waarlangs aanvragen binnenkomen.' ),
		'inkoopfacturen'         => array( 'Inkoopfacturen die per mail binnenkomen worden uitgelezen en als concept klaargezet in je boekhoudpakket. Jij of je boekhouder keurt ze alleen nog goed.', 'Maak een apart mailadres of een aparte map waar alle inkoopfacturen naartoe gaan.' ),
		'werkbon-factuur'        => array( 'Als een werkbon is afgerond, wordt er automatisch een conceptfactuur van gemaakt met de juiste uren en materialen. Geen overtypen meer aan het eind van de maand.', 'Kijk hoeveel dagen er nu gemiddeld zitten tussen een afgeronde klus en de factuur.' ),
		'debiteuren'             => array( 'Openstaande facturen krijgen automatisch een herinnering en daarna een aanmaning. Je krijgt een melding wanneer het tijd is om zelf te bellen.', 'Draai een lijst met facturen die langer dan 30 dagen openstaan.' ),
		'bonnetjes'              => array( 'Een foto van een bonnetje via WhatsApp of mail wordt uitgelezen en klaargezet in je boekhouding. Het bonnetjesbakje op het dashboard is verleden tijd.', 'Spreek met het team af dat alle bonnetjes deze week naar één adres gaan.' ),
		'planningsassistent'     => array( 'Op basis van beschikbaarheid, vaardigheden en locatie stelt de assistent een weekplanning voor. De planner kijkt mee, schuift waar nodig en zet hem door.', 'Noteer welke regels je nu in je hoofd gebruikt bij het maken van de planning.' ),
		'onderhoudsplanning'     => array( 'Periodiek onderhoud en keuringen worden automatisch ingepland op basis van de laatste datum. Klanten krijgen op tijd een uitnodiging voor een afspraak.', 'Zet alle klanten met terugkerend onderhoud of keuringen in één lijst met de laatste datum.' ),
		'overdracht'             => array( 'Aan het eind van de dag verschijnt per team een korte samenvatting in WhatsApp of Teams: wat is klaar, wat loopt, wat moet morgen. Niemand hoeft meer rond te bellen.', 'Vraag het team welke informatie ze elke ochtend missen.' ),
		'digitale-werkbon'       => array( 'Een monteur spreekt in wat er gedaan is of maakt een paar foto\'s, en er komt een nette werkbon uit. Uren en materialen staan er meteen goed in.', 'Vraag twee monteurs wat ze nu het vervelendst vinden aan de werkbon.' ),
		'whatsapp-assistent'     => array( 'Een assistent in WhatsApp beantwoordt veelgestelde vragen, vraagt gegevens en foto\'s op en plant afspraken in. Lastige vragen gaan met een samenvatting naar een collega.', 'Tel een week lang hoeveel berichten en telefoontjes er buiten kantoortijd binnenkomen.' ),
		'voicebot'               => array( 'Buiten kantoortijd neemt een AI-telefoonassistent op, noteert de vraag en plant een terugbelmoment. De volgende ochtend ligt er een overzicht klaar.', 'Kijk in je telefoonlogboek hoeveel oproepen je mist buiten kantoortijd.' ),
		'storingen'              => array( 'Storingsmeldingen worden gelezen, beoordeeld op urgentie en toegewezen aan de juiste monteur. Spoed gaat meteen door, de rest wordt netjes ingepland.', 'Leg vast welke meldingen jullie als spoed zien en welke niet.' ),
		'social-captions'        => array( 'Je levert een paar foto\'s of steekwoorden aan en krijgt kant-en-klare captions, ingepland in je kalender. Jij keurt goed voordat er iets online gaat.', 'Kies één vaste dag per week waarop je een post plaatst.' ),
		'projectfotos'           => array( 'Projectfoto\'s die je team maakt, worden automatisch een "project van de week"-post met een korte tekst. Jij kiest alleen welke foto\'s mee mogen.', 'Maak een gedeelde map waarin het team foto\'s van mooie klussen zet.' ),
		'bedrijfsprofiel'        => array( 'Je Google Bedrijfsprofiel krijgt regelmatig nieuwe posts en elke review een passende reactie, klaargezet voor jouw akkoord.', 'Beantwoord deze week de drie meest recente reviews zelf, zodat je je eigen toon kent.' ),
		'blogs'                  => array( 'Op basis van de vragen die klanten stellen komen er blogconcepten in jullie toon. Iemand met vakkennis controleert en vult aan voor publicatie.', 'Schrijf vijf vragen op die klanten je vaak stellen: dat zijn je eerste blogonderwerpen.' ),
		'weekupdate'             => array( 'Elke maandag krijg je een kort bericht met de belangrijkste cijfers van vorige week, in gewone taal. Zonder zelf een Excel te openen.', 'Kies de drie cijfers waar je elke week naar wilt kijken.' ),
		'dashboard'              => array( 'Omzet, offertes, debiteuren, planning en leads komen samen in één overzicht dat zichzelf bijwerkt. Je ziet in één oogopslag waar je op moet letten.', 'Noteer uit welke systemen je nu cijfers bij elkaar zoekt.' ),
		'excel'                  => array( 'Rommelige Excel-bestanden worden opgeschoond, samengevoegd en geanalyseerd. De uitkomst krijg je als overzicht met een korte uitleg.', 'Kies het Excel-bestand waar je elke maand het meest tijd in steekt.' ),
		'vacatureteksten'        => array( 'Vacatures worden geschreven in de taal van vakmensen: concreet over het werk, de bus, de uren en het loon. Jij vult aan en plaatst.', 'Vraag een huidige medewerker waarom hij of zij bij jullie werkt.' ),
		'whatsapp-sollicitatie'  => array( 'Kandidaten solliciteren via WhatsApp met een paar korte vragen, zonder cv. Wie past, plant zelf een kennismaking in.', 'Schrijf de vijf harde eisen op waar een kandidaat echt aan moet voldoen.' ),
		'kandidaatopvolging'     => array( 'Elke kandidaat krijgt automatisch een bevestiging, een statusupdate en een nette afwijzing als het niet doorgaat. Niemand blijft in het ongewisse.', 'Maak drie standaardberichten: ontvangen, uitnodiging en afwijzing.' ),
		'materiaalstaat'         => array( 'Uit een tekening of bestek wordt een concept-materiaallijst gemaakt. Een calculator controleert en vult aan, maar begint niet meer bij nul.', 'Kies een afgerond project waarvan je bestek en werkelijke materiaallijst nog hebt.' ),
		'meerwerk'               => array( 'Meerwerk wordt op locatie ingesproken of gefotografeerd en direct omgezet in een meerwerkregel. Aan het eind van het project mist er niets.', 'Spreek af dat meerwerk deze week direct in één app-groep wordt gemeld.' ),
		'urenregistratie'        => array( 'Uren die binnenkomen via een app, WhatsApp of een briefje worden automatisch verwerkt en per project gezet.', 'Kijk hoeveel verschillende manieren er nu zijn waarop uren worden doorgegeven.' ),
		'nacalculatie'           => array( 'Per project zie je begroot tegenover werkelijk, automatisch bijgewerkt. Zo zie je sneller welke klussen geld kosten.', 'Kies drie afgeronde projecten en zet begroting en werkelijke uren naast elkaar.' ),
		'inkoop-bestellingen'    => array( 'Een materiaallijst wordt automatisch een bestelling bij je vaste groothandel, klaar om te bevestigen.', 'Noteer bij welke groothandels je het meest bestelt en hoe je dat nu doet.' ),
		'gespreksverslagen'      => array( 'Na een gesprek staat er een verslag met actiepunten klaar, direct in je CRM of mail. Jij leest het na in plaats van het uit te typen.', 'Kies één type overleg waarvan je deze week het verslag laat maken en vergelijk.' ),
		'documenten-samenvatten' => array( 'Lange documenten worden samengevat en mogelijke risico\'s worden gemarkeerd. Dat is voorbereiding: het vervangt geen juridisch of fiscaal advies.', 'Kies een terugkerend type document dat je nu volledig moet doorlezen.' ),
		'interne-assistent'      => array( 'Een assistent op jullie eigen documenten en procedures beantwoordt vragen van collega\'s, met een verwijzing naar de bron.', 'Zet de belangrijkste werkinstructies en procedures in één map.' ),
		'archiveren'             => array( 'Documenten krijgen automatisch een logische naam, komen in de juiste map en je krijgt een waarschuwing bij een vervaldatum.', 'Bedenk één vaste manier waarop jullie bestanden willen benoemen.' ),
		'reviews'                => array( 'Na elke klus of bezoek gaat er automatisch een vriendelijk reviewverzoek uit. Reacties op reviews staan klaar voor jouw akkoord.', 'Vraag deze week vijf tevreden klanten zelf om een review.' ),
		'contenthergebruik'      => array( 'Eén video of blog wordt automatisch omgezet in een paar posts en een nieuwsbrief-item, zodat je meer uit hetzelfde werk haalt.', 'Kies het beste stuk content van het afgelopen jaar om opnieuw te gebruiken.' ),
	);
}
