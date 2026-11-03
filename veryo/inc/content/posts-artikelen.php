<?php
/**
 * Uitgeschreven blogartikelen (status: concept). Bovenaan elk artikel staat een korte notitie
 * met wat je vóór publicatie moet controleren; haal die weg voordat je publiceert.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Artikel opbouwen.
 *
 * @param string                       $check    Wat te controleren vóór publicatie.
 * @param string[]                     $intro    Inleidende alinea's.
 * @param array<int,array<int,mixed>>  $sections Secties: array( H2, alinea's, lijst, array( array( H3, alinea's ) ) ).
 * @param array<int,array<int,string>> $faq      Veelgestelde vragen.
 * @param string                       $cta      Slotblok (HTML).
 * @return string
 */
$veryo_article = static function ( $check, $intro, $sections, $faq, $cta ) {
	/* translators: %s: wat te controleren. */
	$out = veryo_b_p( sprintf( __( '[CONCEPT: controleer vóór publicatie: %s Haal deze notitie daarna weg.]', 'veryo' ), $check ), array( 'className' => 'veryo-draft-note' ) );
	foreach ( $intro as $para ) {
		$out .= veryo_b_p( $para );
	}
	foreach ( $sections as $section ) {
		$out .= veryo_b_h( $section[0] );
		foreach ( (array) $section[1] as $para ) {
			$out .= veryo_b_p( $para );
		}
		if ( ! empty( $section[2] ) ) {
			$out .= veryo_b_list( $section[2] );
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
	$out .= $cta;
	return $out;
};

$veryo_uc_url  = esc_url( veryo_link( 'oplossingen/urencontrole-beveiliging' ) );
$veryo_uc_cta  = veryo_sec_cta_demo( __( 'Plan een demo van 15 minuten', 'veryo' ), __( 'We laten zien hoe Urencontrole facturen naast het rooster legt, en kijken samen hoe jij het nu doet.', 'veryo' ) );
$veryo_disclmr = __( 'Dit artikel is geen juridisch advies. Twijfel je over je eigen situatie, raadpleeg dan een arbeidsrechtjurist of fiscaal adviseur.', 'veryo' );

return array(

	/* ------------------------------------------------------------------------- */
	'zzp-facturen-controleren-beveiliging' => array(
		'title'     => __( 'Zzp-facturen controleren in de beveiliging: zo voorkom je dat je te veel betaalt', 'veryo' ),
		'seo_title' => __( 'Zzp-facturen controleren in de beveiliging | Veryo', 'veryo' ),
		'desc'      => __( 'Zzp-facturen controleren in de beveiliging: de fouten die vaak voorkomen, een checklist voor handmatige controle en hoe automatische controle werkt.', 'veryo' ),
		'kw'        => 'zzp facturen controleren beveiliging',
		'content'   => $veryo_article(
			__( 'de voorbeelden in de checklist passen bij hoe jouw klanten werken.', 'veryo' ),
			array(
				__( 'Wie in de beveiliging met zzp’ers en onderaannemers werkt, kent het ritueel aan het eind van de maand. De facturen komen binnen, iemand op kantoor legt ze naast het rooster en rekent na. Zzp-facturen controleren in de beveiliging is precies werk: elke dienst, elk uur en elk tarief moet kloppen met wat er gepland en afgesproken was.', 'veryo' ),
				sprintf(
					/* translators: %s: link naar Urencontrole. */
					__( 'In dit artikel lees je welke fouten vaak in zzp-facturen zitten, hoe je ze met een vaste checklist vindt, en hoe je de controle kunt automatiseren met <a href="%s">Urencontrole van Veryo</a>.', 'veryo' ),
					$veryo_uc_url
				),
			),
			array(
				array(
					__( 'Waarom controleren zo veel tijd kost', 'veryo' ),
					array(
						__( 'Een beveiligingsbedrijf werkt met wisselende diensten: evenementen, objectbeveiliging, horeca, mobiele surveillance. Diensten worden geruild, ingekort of verlengd. Wat in het rooster staat, is niet altijd wat er gedraaid is, en wat op de factuur staat, is niet altijd wat er gedraaid is.', 'veryo' ),
						__( 'Daar komt bij dat elke zzp’er een eigen factuur stuurt, in een eigen opmaak, soms als pdf, soms als foto. Wie dat met de hand controleert, zit al snel uren per maand te zoeken en te rekenen. En hoe meer facturen, hoe groter de kans dat er iets doorheen glipt.', 'veryo' ),
					),
				),
				array(
					__( 'Fouten in zzp-facturen die vaak voorkomen', 'veryo' ),
					array( __( 'De meeste fouten zijn geen kwade opzet. Het zijn vergissingen, omdat iemand uit zijn hoofd factureert of een dienst verkeerd overneemt. Dit zijn de fouten die je het vaakst tegenkomt:', 'veryo' ) ),
					array(
						'<strong>' . __( 'Een dienst die niet gedraaid is.', 'veryo' ) . '</strong> ' . __( 'De dienst stond wel in het rooster, maar is geruild of vervallen. Toch staat hij op de factuur.', 'veryo' ),
						'<strong>' . __( 'Een verkeerd tarief.', 'veryo' ) . '</strong> ' . __( 'Het uurtarief wijkt af van wat je hebt afgesproken, bijvoorbeeld een oud tarief of het tarief van een ander soort opdracht.', 'veryo' ),
						'<strong>' . __( 'Dubbele uren.', 'veryo' ) . '</strong> ' . __( 'Dezelfde dienst staat twee keer op de factuur, of op twee facturen van verschillende maanden.', 'veryo' ),
						'<strong>' . __( 'Een toeslag op het verkeerde uur.', 'veryo' ) . '</strong> ' . __( 'Een hoger tarief voor nacht of weekend wordt over meer uren gerekend dan in die periode vallen.', 'veryo' ),
						'<strong>' . __( 'Afgeronde uren.', 'veryo' ) . '</strong> ' . __( 'Een dienst van 7 uur en 40 minuten wordt 8 uur. Eén keer is het niets; over een maand en veel zzp’ers loopt het op.', 'veryo' ),
					),
				),
				array(
					__( 'Checklist: zo controleer je een zzp-factuur met de hand', 'veryo' ),
					array( __( 'Werk elke factuur in dezelfde volgorde af. Dat klinkt saai, maar juist een vaste volgorde voorkomt dat je stappen overslaat als het druk is.', 'veryo' ) ),
					array(
						__( 'Zoek per factuurregel de dienst op in het rooster: datum, locatie, begin- en eindtijd.', 'veryo' ),
						__( 'Controleer of de dienst echt gedraaid is, bijvoorbeeld via het dienstrapport of de registratie in je planningspakket.', 'veryo' ),
						__( 'Vergelijk het aantal uren op de factuur met de gedraaide uren.', 'veryo' ),
						__( 'Controleer het uurtarief tegen de afspraak met deze zzp’er of onderaannemer.', 'veryo' ),
						__( 'Kijk of hogere tarieven voor nacht, weekend of feestdagen alleen over de juiste uren zijn gerekend.', 'veryo' ),
						__( 'Zoek naar diensten die al op een eerdere factuur stonden.', 'veryo' ),
						__( 'Leg afwijkingen vast, met de reden, en vraag ze na voordat je betaalt.', 'veryo' ),
					),
				),
				array(
					__( 'Facturen controleren tegen het rooster: wat maakt het lastig?', 'veryo' ),
					array(
						__( 'Het lastigste is niet het rekenen, maar het zoeken. De factuur staat in je mailbox, het rooster in je planningspakket en de tariefafspraak in een contract of een mail van maanden terug. Voor elke regel spring je tussen drie plekken heen en weer.', 'veryo' ),
						__( 'Bij onderaannemers komt er nog een laag bij: zij factureren vaak voor meerdere beveiligers tegelijk. Dan moet je per persoon nagaan welke diensten bij die factuur horen.', 'veryo' ),
					),
				),
				array(
					__( 'Afspraken die het controleren makkelijker maken', 'veryo' ),
					array(
						__( 'Een groot deel van het zoekwerk kun je voorkomen met een paar vaste afspraken met je zzp’ers en onderaannemers. Hoe gelijker de facturen eruitzien, hoe sneller je ze naast het rooster legt, of je dat nu met de hand doet of automatisch.', 'veryo' ),
					),
					array(
						__( 'Vraag om per dienst de datum, de locatie en de begin- en eindtijd op de factuur te zetten, niet alleen een totaal aantal uren.', 'veryo' ),
						__( 'Spreek een vaste factuurperiode af, bijvoorbeeld per maand of per vier weken, gelijk aan je eigen salarisperiode.', 'veryo' ),
						__( 'Leg tarieven schriftelijk vast, ook de afspraken voor nacht, weekend en feestdagen, en houd die op één plek bij.', 'veryo' ),
						__( 'Vraag onderaannemers om per beveiliger te specificeren wie welke dienst draaide.', 'veryo' ),
						__( 'Laat facturen naar één vast mailadres sturen, zodat er niets in persoonlijke mailboxen blijft hangen.', 'veryo' ),
					),
				),
				array(
					__( 'Hoe automatische controle werkt', 'veryo' ),
					array(
						__( 'Automatische controle doet hetzelfde als de checklist, maar dan zonder het zoekwerk. De factuur wordt uitgelezen zodra hij in je mailbox komt. Elke regel wordt gekoppeld aan de dienst in het rooster en aan de tariefafspraak. Wat klopt, gaat door. Wat niet klopt, komt op een lijst.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar Urencontrole. */
							__( 'Bij <a href="%s">Urencontrole</a> krijg je dus geen stapel facturen meer, maar een overzicht met alleen de afwijkingen: een dienst die op de factuur staat maar niet in het rooster, een afwijkend tarief, dubbele uren. Jij beslist wat je ermee doet: navragen, corrigeren of akkoord geven.', 'veryo' ),
							$veryo_uc_url
						),
						__( 'Urencontrole werkt bovenop je eigen planningspakket en mailbox. Je stapt niet over op nieuwe software. Veryo deelt de uren in en zet ze klaar voor de salarisadministratie; de loonberekening blijft bij je salarisadministratie.', 'veryo' ),
					),
				),
				array(
					__( 'Begin klein', 'veryo' ),
					array(
						__( 'Wil je eerst zelf kijken hoeveel er misgaat? Neem de facturen van één maand en loop ze langs met de checklist hierboven. Houd bij hoeveel afwijkingen je vindt en hoeveel tijd het kost. Dan weet je wat automatische controle je zou opleveren.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar Urencontrole. */
							__( 'Wil je zien hoe het automatisch gaat? Bekijk <a href="%s">Urencontrole voor beveiligingsbedrijven</a> of plan een demo van 15 minuten.', 'veryo' ),
							$veryo_uc_url
						),
					),
				),
			),
			array(
				array( __( 'Hoe vaak komen fouten in zzp-facturen voor?', 'veryo' ), __( 'Dat verschilt per bedrijf. Het enige betrouwbare antwoord krijg je door een maand facturen langs de checklist te leggen en te tellen.', 'veryo' ) ),
				array( __( 'Moet ik elke factuur controleren?', 'veryo' ), __( 'Ja, als je zeker wilt weten dat je niet te veel betaalt. Steekproeven missen juist de kleine afwijkingen die over een maand oplopen.', 'veryo' ) ),
				array( __( 'Berekent Veryo ook de lonen?', 'veryo' ), __( 'Nee. Veryo controleert en deelt uren in en zet ze klaar. De loonberekening blijft bij je salarisadministratie.', 'veryo' ) ),
			),
			$veryo_uc_cta
		),
	),

	/* ------------------------------------------------------------------------- */
	'schijnzelfstandigheid-beveiliging'    => array(
		'title'     => __( 'Schijnzelfstandigheid in de beveiliging: wat moet je als beveiligingsbedrijf vastleggen?', 'veryo' ),
		'seo_title' => __( 'Schijnzelfstandigheid beveiliging: wat vastleggen? | Veryo', 'veryo' ),
		'desc'      => __( 'Schijnzelfstandigheid in de beveiliging: wat de Belastingdienst sinds 2025 handhaaft, wat er in 2026 en 2027 verandert en wat je als bedrijf vastlegt.', 'veryo' ),
		'kw'        => 'schijnzelfstandigheid beveiliging',
		'content'   => $veryo_article(
			__( 'de actuele stand van de handhaving door de Belastingdienst (belastingdienst.nl en rijksoverheid.nl), en de cijfers over zzp’ers in de beveiliging bij Security Management.', 'veryo' ),
			array(
				__( 'Schijnzelfstandigheid in de beveiliging is geen theoretisch onderwerp meer. De Belastingdienst handhaaft de regels voor het werken met zzp’ers sinds 1 januari 2025 weer, en de beveiliging is een branche waar veel met zzp’ers wordt gewerkt.', 'veryo' ),
				sprintf(
					/* translators: %s: link naar Urencontrole. */
					__( 'In dit artikel lees je wat er verandert, waarom de beveiliging extra in beeld is en wat je als beveiligingsbedrijf goed vastlegt. Aan het eind lees je hoe <a href="%s">Urencontrole</a> helpt om die vastlegging op orde te houden.', 'veryo' ),
					$veryo_uc_url
				),
			),
			array(
				array(
					__( 'Wat is er veranderd?', 'veryo' ),
					array(
						__( 'Jarenlang gold een handhavingsmoratorium: de Belastingdienst trad alleen op bij kwaadwillenden. Dat moratorium is per 1 januari 2025 opgeheven. Sindsdien kan de Belastingdienst weer beoordelen of iemand die als zzp’er werkt, eigenlijk in loondienst is.', 'veryo' ),
						__( 'Wel was er een zachte landing. Over 2025 legde de Belastingdienst in beginsel geen boetes op, tenzij er sprake was van kwaadwilligheid of een eerdere aanwijzing niet was opgevolgd. In december 2025 besloot het kabinet die zachte landing in 2026 deels te verlengen: in 2026 worden geen verzuimboetes opgelegd, maar bij opzet of grove schuld zijn vergrijpboetes wel mogelijk. Naheffingen van loonbelasting en premies blijven mogelijk. Vanaf 2027 wordt volledig gehandhaafd. (Bronnen: MKB Servicedesk en SRA, december 2025.)', 'veryo' ),
					),
				),
				array(
					__( 'Waarom de beveiliging extra in beeld is', 'veryo' ),
					array(
						__( 'Het aantal zzp’ers in de beveiliging is in korte tijd sterk gegroeid: van ongeveer 6.400 eind 2022 naar meer dan 12.000, volgens Security Management op basis van cijfers van de Nederlandse Veiligheidsbranche.', 'veryo' ),
						__( 'De Nederlandse Veiligheidsbranche pleit zelf voor actieve handhaving. Volgens de brancheorganisatie werken veel zzp’ers in de beveiliging in de praktijk onder dezelfde gezagsverhouding als werknemers: ze krijgen een rooster, een locatie en instructies van een leidinggevende. Andere partijen in de branche zoeken juist naar manieren om zzp’ers te kunnen blijven inzetten. Het onderwerp ligt dus gevoelig, en het is verstandig om je zaken op orde te hebben.', 'veryo' ),
					),
				),
				array(
					__( 'Waar kijkt de Belastingdienst naar?', 'veryo' ),
					array( __( 'Of iemand zelfstandig is of eigenlijk werknemer, hangt af van de feitelijke situatie, niet van wat er in een contract staat. Punten die in die beoordeling een rol spelen, zijn onder meer:', 'veryo' ) ),
					array(
						__( 'Werkt iemand onder gezag: bepaalt het bedrijf wanneer, waar en hoe er wordt gewerkt?', 'veryo' ),
						__( 'Is het werk ingebed in de organisatie, of is het een afgebakende opdracht?', 'veryo' ),
						__( 'Loopt de zzp’er ondernemersrisico en werkt hij voor meerdere opdrachtgevers?', 'veryo' ),
						__( 'Hoe worden het tarief en de uren afgesproken en gefactureerd?', 'veryo' ),
					),
				),
				array(
					__( 'Wat leg je als beveiligingsbedrijf vast?', 'veryo' ),
					array( __( 'Of een inzet van een zzp’er wel of niet door de beugel kan, is een juridische vraag. Maar in alle gevallen helpt het als je feitelijk kunt laten zien hoe de samenwerking loopt. Leg in elk geval vast:', 'veryo' ) ),
					array(
						'<strong>' . __( 'De opdracht.', 'veryo' ) . '</strong> ' . __( 'Wat is er afgesproken, voor welke periode en welke locaties?', 'veryo' ),
						'<strong>' . __( 'Het tarief.', 'veryo' ) . '</strong> ' . __( 'Welk tarief geldt, en zijn er afspraken over nacht, weekend en feestdagen?', 'veryo' ),
						'<strong>' . __( 'Wie welke dienst draaide.', 'veryo' ) . '</strong> ' . __( 'Per dienst: wie, wanneer, waar en hoeveel uur.', 'veryo' ),
						'<strong>' . __( 'Wat er gefactureerd is.', 'veryo' ) . '</strong> ' . __( 'En of dat klopt met de gedraaide diensten en het afgesproken tarief.', 'veryo' ),
						'<strong>' . __( 'Afwijkingen.', 'veryo' ) . '</strong> ' . __( 'Wat er niet klopte en hoe het is opgelost.', 'veryo' ),
					),
				),
				array(
					__( 'Praktische stappen voor de komende maanden', 'veryo' ),
					array( __( 'Wat je nu al kunt doen, zonder op een uitspraak of een controle te wachten:', 'veryo' ) ),
					array(
						__( 'Maak een overzicht van alle zzp’ers en onderaannemers die je inzet, met per persoon de opdracht en het tarief.', 'veryo' ),
						__( 'Kijk per inzet hoe het werk feitelijk loopt: wie bepaalt het rooster, wie geeft instructies, en werkt de zzp’er ook voor andere opdrachtgevers?', 'veryo' ),
						__( 'Bespreek twijfelgevallen met een adviseur, voordat de volledige handhaving in 2027 begint.', 'veryo' ),
						__( 'Zorg dat je per maand kunt laten zien wie welke dienst draaide, tegen welk tarief, en of de factuur daarmee klopt.', 'veryo' ),
						__( 'Bewaar die gegevens op één plek, zodat je ze bij een vraag van de Belastingdienst snel terugvindt.', 'veryo' ),
					),
				),
				array(
					__( 'Wat het betekent voor je planning en je administratie', 'veryo' ),
					array(
						__( 'Als je minder met zzp’ers gaat werken en meer met eigen personeel, verschuift het werk op kantoor. Je eigen medewerkers hebben een rooster, uren en toeslagen die netjes naar de salarisadministratie moeten. Werk je juist door met zzp’ers, dan wordt de controle van hun facturen en de vastlegging van hun diensten belangrijker.', 'veryo' ),
						__( 'In beide gevallen loont het om die administratie strak te organiseren. Niet omdat het juridisch iets oplost, maar omdat je dan altijd weet wat er gebeurd is en wat je betaald hebt.', 'veryo' ),
					),
				),
				array(
					__( 'Waar een vaste vastlegging bij helpt', 'veryo' ),
					array(
						sprintf(
							/* translators: %s: link naar Urencontrole. */
							__( '<a href="%s">Urencontrole</a> legt elke factuur van een zzp’er of onderaannemer naast het rooster en het afgesproken tarief. Zo ontstaat vanzelf een controleerbare vastlegging van wie wanneer welke dienst draaide en tegen welk tarief. Dat is geen juridisch oordeel over schijnzelfstandigheid, maar het geeft je wel de feiten die je bij een gesprek met een adviseur of de Belastingdienst nodig hebt.', 'veryo' ),
							$veryo_uc_url
						),
					),
				),
				array(
					__( 'Geen juridisch advies', 'veryo' ),
					array( $veryo_disclmr ),
				),
			),
			array(
				array( __( 'Sinds wanneer handhaaft de Belastingdienst weer?', 'veryo' ), __( 'Sinds 1 januari 2025. In 2025 gold een zachte landing zonder boetes in beginsel; in 2026 geldt die deels nog. Controleer de actuele stand op belastingdienst.nl.', 'veryo' ) ),
				array( __( 'Lost goede vastlegging het risico op schijnzelfstandigheid op?', 'veryo' ), __( 'Nee. Het beoordelen gebeurt op de feitelijke situatie. Goede vastlegging helpt je wel om die situatie te laten zien en te bespreken met een adviseur.', 'veryo' ) ),
				array( __( 'Geeft Veryo juridisch advies?', 'veryo' ), __( 'Nee. Veryo automatiseert de controle van uren en facturen. Voor juridisch advies ga je naar een arbeidsrechtjurist of fiscaal adviseur.', 'veryo' ) ),
			),
			$veryo_uc_cta
		),
	),

	/* ------------------------------------------------------------------------- */
	'toeslagen-beveiliging-nacht-weekend'  => array(
		'title'     => __( 'Toeslagen in de beveiliging: nacht-, weekend- en feestdaguren goed indelen', 'veryo' ),
		'seo_title' => __( 'Toeslagen beveiliging: nacht, weekend, feestdag | Veryo', 'veryo' ),
		'desc'      => __( 'Toeslagen in de beveiliging: waarom het indelen van nacht-, weekend- en feestdaguren zo foutgevoelig is, en hoe je die uren wel goed bijhoudt.', 'veryo' ),
		'kw'        => 'toeslagen beveiliging nacht weekend',
		'content'   => $veryo_article(
			__( 'de tijdvakken voor avond- en nachtwerk en de feestdagenregeling in de actuele cao Particuliere Beveiliging. Noem geen percentages tenzij je ze uit de actuele cao haalt, met bron.', 'veryo' ),
			array(
				__( 'In de beveiliging wordt gewerkt als anderen slapen: ’s nachts, in het weekend en op feestdagen. Voor die uren gelden toeslagen. Het indelen van die uren is precies werk, en een fout merk je pas als een medewerker aan de bel trekt of als de salarisadministratie terugkomt met vragen.', 'veryo' ),
				sprintf(
					/* translators: %s: link naar Urencontrole. */
					__( 'In dit artikel lees je waarom het indelen van toeslaguren zo foutgevoelig is en hoe je het bijhoudt. Aan het eind lees je hoe <a href="%s">Urencontrole</a> de uren automatisch indeelt en klaarzet. Veryo deelt in en zet klaar; de loonberekening blijft bij je salarisadministratie.', 'veryo' ),
					$veryo_uc_url
				),
			),
			array(
				array(
					__( 'Welke uren tellen anders?', 'veryo' ),
					array(
						__( 'Welke toeslag geldt, staat in de cao. Voor de cao Particuliere Beveiliging geldt volgens vakbond CNV dat werk tussen 00.00 en 07.00 uur telt als nachtwerk en werk tussen 18.00 en 24.00 uur als avondwerk, met voor elk een eigen toeslag. Daarnaast kent de cao afspraken over werken op feestdagen.', 'veryo' ),
						__( 'Let op: de cao Particuliere Beveiliging loopt tot eind 2026 en de onderhandelingen over een nieuwe cao zijn in september 2026 vastgelopen (bron: CNV). Controleer daarom altijd de actuele cao-tekst voordat je toeslagen instelt of aanpast.', 'veryo' ),
					),
				),
				array(
					__( 'Waarom het indelen foutgevoelig is', 'veryo' ),
					array( __( 'Een dienst valt zelden netjes in één tijdvak. Daardoor ontstaan fouten op een paar vaste plekken:', 'veryo' ) ),
					array(
						'<strong>' . __( 'Diensten over middernacht.', 'veryo' ) . '</strong> ' . __( 'Een dienst van 22.00 tot 06.00 uur bestaat uit avonduren en nachturen, en valt soms in twee verschillende dagen, bijvoorbeeld van zaterdag op zondag.', 'veryo' ),
						'<strong>' . __( 'Weekend en feestdag tegelijk.', 'veryo' ) . '</strong> ' . __( 'Valt een feestdag in het weekend, dan moet duidelijk zijn welke regeling voorgaat.', 'veryo' ),
						'<strong>' . __( 'Geruilde diensten.', 'veryo' ) . '</strong> ' . __( 'Het rooster zegt de ene beveiliger, de werkelijkheid de andere. De uren moeten bij de juiste persoon terechtkomen.', 'veryo' ),
						'<strong>' . __( 'Verlengde diensten.', 'veryo' ) . '</strong> ' . __( 'Een evenement loopt uit. De extra uren vallen in een ander tijdvak en soms ook onder overuren.', 'veryo' ),
						'<strong>' . __( 'Handmatig overtypen.', 'veryo' ) . '</strong> ' . __( 'Uren worden uit het planningspakket overgenomen in een spreadsheet en daarna in het formaat van de salarisadministratie gezet. Elke stap is een kans op een tikfout.', 'veryo' ),
					),
				),
				array(
					__( 'Zo houd je de urenregistratie in je beveiligingsbedrijf op orde', 'veryo' ),
					array( __( 'Een paar vaste afspraken voorkomen de meeste fouten:', 'veryo' ) ),
					array(
						__( 'Leg per dienst de werkelijke begin- en eindtijd vast, niet alleen de geplande.', 'veryo' ),
						__( 'Splits elke dienst op in tijdvakken volgens de cao: dag, avond, nacht, weekend en feestdag.', 'veryo' ),
						__( 'Houd een lijst bij van de feestdagen die de cao noemt, per jaar.', 'veryo' ),
						__( 'Verwerk geruilde en verlengde diensten in het rooster voordat je de uren indeelt.', 'veryo' ),
						__( 'Lever de uren aan in het formaat dat je salarisadministratie gebruikt, zodat er niets overgetypt hoeft te worden.', 'veryo' ),
					),
				),
				array(
					__( 'Een voorbeeld: de dienst van zaterdagavond op zondag', 'veryo' ),
					array(
						__( 'Neem een beveiliger die op zaterdag van 20.00 uur tot zondag 04.00 uur bij een evenement staat. Op het rooster is dat één regel. Voor de indeling zijn het er meer: uren op zaterdagavond, uren na middernacht op zondag, en een deel van die uren valt in het tijdvak voor nachtwerk.', 'veryo' ),
						__( 'Loopt het evenement een uur uit, dan schuift het einde naar 05.00 uur. Dat extra uur valt opnieuw in de nacht, op zondag, en telt mogelijk ook als overwerk. Was het die zondag ook nog een feestdag, dan komt daar de feestdagenregeling bij.', 'veryo' ),
						__( 'Wie dit met de hand indeelt, moet voor één dienst dus drie of vier keer nadenken. Over een maand met honderden diensten is het geen wonder dat er fouten in sluipen. Precies daarom loont het om de indeling vast te leggen in vaste regels, in plaats van in het hoofd van één collega.', 'veryo' ),
					),
				),
				array(
					__( 'Wat je salarisadministratie van je nodig heeft', 'veryo' ),
					array(
						__( 'Of je salarisadministratie nu intern zit of bij een administratiekantoor: ze hebben per medewerker en per periode de uren nodig, verdeeld over de tijdvakken uit de cao. Hoe vollediger en consequenter je die aanlevert, hoe minder vragen er terugkomen.', 'veryo' ),
						__( 'Spreek met je salarisadministratie af in welk formaat ze de uren willen ontvangen, en houd dat elke periode hetzelfde. Een vast bestand met per medewerker de uren per tijdvak werkt beter dan een export die elke maand net anders is.', 'veryo' ),
						__( 'Lever ook de afwijkingen mee: diensten die zijn geruild, verlengd of vervallen. Dan hoeft de salarisadministratie niet zelf te zoeken waarom de uren van deze periode anders zijn dan het rooster, en weet je zeker dat iedereen betaald krijgt voor wat hij echt gewerkt heeft.', 'veryo' ),
					),
				),
				array(
					__( 'Hoe Urencontrole de uren indeelt', 'veryo' ),
					array(
						sprintf(
							/* translators: %s: link naar Urencontrole. */
							__( '<a href="%s">Urencontrole</a> leest de gedraaide diensten uit je planningspakket en deelt ze automatisch in: normaal, nacht, weekend, feestdag en overuren worden apart gezet. De uren van je eigen personeel staan daarna klaar in het formaat van je salarisadministratie. Voor zzp’ers en onderaannemers worden de facturen naast het rooster en het tarief gelegd.', 'veryo' ),
							$veryo_uc_url
						),
						__( 'Belangrijk: Veryo berekent geen lonen. De indeling en het klaarzetten nemen we over; de loonberekening en de toepassing van de cao blijven bij je salarisadministratie.', 'veryo' ),
					),
				),
			),
			array(
				array( __( 'Welke toeslagen gelden in de beveiliging?', 'veryo' ), __( 'Dat staat in de cao Particuliere Beveiliging. Controleer altijd de actuele tekst, want de cao loopt tot eind 2026 en er wordt over een nieuwe cao onderhandeld.', 'veryo' ) ),
				array( __( 'Rekent Veryo de toeslagen uit?', 'veryo' ), __( 'Nee. Veryo deelt de uren in tijdvakken in en zet ze klaar. Het uitrekenen van lonen en toeslagen blijft bij je salarisadministratie.', 'veryo' ) ),
				array( __( 'Werkt dit met ons planningspakket?', 'veryo' ), __( 'Urencontrole werkt bovenop wat je al gebruikt. In een kennismaking van 15 minuten kijken we hoe jouw planningspakket de diensten vastlegt.', 'veryo' ) ),
			),
			$veryo_uc_cta
		),
	),

	/* ------------------------------------------------------------------------- */
	'lokale-ai-of-chatgpt'                 => array(
		'title'     => __( 'Lokale AI vs ChatGPT voor je bedrijf: wat is het verschil?', 'veryo' ),
		'seo_title' => __( 'Lokale AI vs ChatGPT voor je bedrijf | Veryo', 'veryo' ),
		'desc'      => __( 'Lokale AI of ChatGPT voor je bedrijf? Het verschil in waar je data staat, werken zonder internet, kosten per gebruiker en AVG, nuchter uitgelegd.', 'veryo' ),
		'kw'        => 'lokale ai',
		'content'   => $veryo_article(
			__( 'de beschrijving van ChatGPT en Copilot klopt met de actuele voorwaarden van die diensten.', 'veryo' ),
			array(
				__( 'Lokale AI is AI die op een eigen computer of server binnen je bedrijf draait, in plaats van in de cloud van een externe partij. Voor veel MKB-bedrijven is ChatGPT het eerste wat ze met AI doen. Dat werkt goed voor veel taken, maar zodra het gaat over klantgegevens, prijzen of contracten, rijst de vraag: waar gaan die gegevens eigenlijk naartoe?', 'veryo' ),
				sprintf(
					/* translators: %s: link naar Veryo Collega. */
					__( 'In dit artikel zetten we lokale AI en ChatGPT naast elkaar. Aan het eind lees je hoe <a href="%s">Veryo Collega</a> werkt: lokale AI op je eigen kantoor.', 'veryo' ),
					esc_url( veryo_collega_url() )
				),
			),
			array(
				array(
					__( 'Wat is het verschil?', 'veryo' ),
					array(
						__( 'ChatGPT, Copilot en vergelijkbare diensten draaien in de cloud. Wat je intypt of uploadt, gaat via internet naar de servers van de aanbieder, wordt daar verwerkt en komt als antwoord terug. Zakelijke versies hebben afspraken over wat de aanbieder met je gegevens mag doen, maar de verwerking gebeurt buiten je eigen bedrijf.', 'veryo' ),
						__( 'Bij lokale AI draait het taalmodel op een eigen machine. De vraag en het antwoord blijven binnen je bedrijf. Er gaan geen gegevens naar een externe AI-dienst.', 'veryo' ),
					),
				),
				array(
					__( 'Vier punten om te vergelijken', 'veryo' ),
					array(),
					array(),
					array(
						array( __( 'Waar staat je data?', 'veryo' ), array( __( 'Bij cloud-AI staat je data, in elk geval tijdelijk, bij een externe partij. Bij lokale AI blijft hij op je eigen machine, bij jou op kantoor.', 'veryo' ) ) ),
						array( __( 'Werkt het zonder internet?', 'veryo' ), array( __( 'Cloud-AI werkt niet zonder verbinding. Lokale AI wel, voor vragen over de documenten en kennis die op de machine staan.', 'veryo' ) ) ),
						array( __( 'Kosten per gebruiker', 'veryo' ), array( __( 'Cloud-AI werkt meestal met een licentie per gebruiker per maand. Hoe meer medewerkers, hoe hoger de rekening. Bij lokale AI betaal je voor de machine en het beheer, niet per gebruiker.', 'veryo' ) ) ),
						array( __( 'AVG', 'veryo' ), array( __( 'Bij cloud-AI deel je gegevens met een externe verwerker en heb je zakelijke voorwaarden en een verwerkersovereenkomst nodig. Bij lokale AI blijft de verwerking binnen je bedrijf. Dat maakt AVG-proof werken eenvoudiger, al blijf je zelf verantwoordelijk voor wat je met persoonsgegevens doet.', 'veryo' ) ) ),
					),
				),
				array(
					__( 'Wanneer is ChatGPT prima?', 'veryo' ),
					array( __( 'Voor algemene taken zonder gevoelige gegevens is een zakelijke cloud-AI vaak de snelste en goedkoopste keuze: een tekst herschrijven, een mail opstellen zonder klantgegevens, ideeën verzamelen. Grote cloudmodellen kunnen in algemene kennis soms ook meer dan een lokaal model. Het is dus geen kwestie van of-of.', 'veryo' ) ),
				),
				array(
					__( 'Wanneer kies je voor lokale AI?', 'veryo' ),
					array( __( 'Lokale AI is de betere keuze als je AI wilt laten werken met de kennis van je eigen bedrijf, en die kennis niet buiten de deur wilt hebben:', 'veryo' ) ),
					array(
						__( 'Je wilt vragen stellen over eigen documenten, procedures, offertes en projecten.', 'veryo' ),
						__( 'Er zitten klantgegevens, prijzen of contracten in die stukken.', 'veryo' ),
						__( 'Je wilt dat het blijft werken als het internet even uitvalt.', 'veryo' ),
						__( 'Je wilt niet per medewerker een licentie betalen.', 'veryo' ),
					),
				),
				array(
					__( 'Wat heb je nodig voor lokale AI?', 'veryo' ),
					array( __( 'Lokale AI is geen app die je even installeert. Er komen een paar dingen bij kijken:', 'veryo' ) ),
					array(
						'<strong>' . __( 'Een machine.', 'veryo' ) . '</strong> ' . __( 'Een krachtige computer of kleine server op kantoor, waarop het taalmodel draait. Hoe zwaar die moet zijn, hangt af van het aantal medewerkers en wat ze ermee doen.', 'veryo' ),
						'<strong>' . __( 'Kennis.', 'veryo' ) . '</strong> ' . __( 'De AI is zo goed als de documenten die erin staan. Procedures, offertes, handleidingen en projectdossiers moeten worden verzameld en bijgehouden.', 'veryo' ),
						'<strong>' . __( 'Rechten.', 'veryo' ) . '</strong> ' . __( 'Niet iedereen hoeft alles te zien. Je bepaalt per medewerker of afdeling welke bronnen meedoen.', 'veryo' ),
						'<strong>' . __( 'Beheer.', 'veryo' ) . '</strong> ' . __( 'Updates, backups en beveiliging. Een lokale machine die niemand onderhoudt, is na een jaar een risico.', 'veryo' ),
					),
				),
				array(
					__( 'Drie misverstanden over lokale AI', 'veryo' ),
					array(
						'<strong>' . __( '“Lokaal betekent dat het niet veilig hoeft.”', 'veryo' ) . '</strong> ' . __( 'Juist wel. De gegevens blijven binnen, maar de machine moet goed beveiligd en bijgehouden worden.', 'veryo' ),
						'<strong>' . __( '“Lokale AI weet alles wat ChatGPT weet.”', 'veryo' ) . '</strong> ' . __( 'Niet per se. Lokale modellen zijn sterk in het werken met je eigen documenten, grote cloudmodellen hebben vaak meer algemene kennis.', 'veryo' ),
						'<strong>' . __( '“Het is alleen iets voor grote bedrijven.”', 'veryo' ) . '</strong> ' . __( 'Juist voor een MKB-bedrijf met veel kennis in de hoofden van een paar ervaren mensen kan een eigen AI-assistent veel opleveren.', 'veryo' ),
					),
				),
				array(
					__( 'Een eigen ChatGPT voor je bedrijf, op je eigen server', 'veryo' ),
					array(
						sprintf(
							/* translators: %s: link naar Veryo Collega. */
							__( '<a href="%s">Veryo Collega</a> is lokale AI voor het MKB: een AI-assistent die op een eigen machine bij jou op kantoor draait en gevuld is met de kennis van je bedrijf. Medewerkers stellen vragen in een vertrouwde chatomgeving, de AI zoekt het antwoord in jullie eigen documenten en laat zien uit welke bron het komt.', 'veryo' ),
							esc_url( veryo_collega_url() )
						),
						__( 'Veryo ontwikkelt daarvoor geen eigen software. We installeren, richten in en beheren bewezen open-source AI, en koppelen die aan de systemen die je al gebruikt.', 'veryo' ),
						__( 'Je hoeft dus niet te kiezen tussen alles in de cloud of alles zelf doen. Veryo zet de machine neer, vult hem met de kennis van je bedrijf, regelt de rechten per medewerker en houdt alles bij. Jouw team stelt gewoon vragen, en de antwoorden komen uit jullie eigen documenten.', 'veryo' ),
					),
				),
			),
			array(
				array( __( 'Is lokale AI net zo goed als ChatGPT?', 'veryo' ), __( 'Voor vragen over je eigen documenten en kennis werkt lokale AI goed. Voor algemene kennis kunnen grote cloudmodellen soms meer. Daarom combineren veel bedrijven het: lokaal voor de eigen kennis, cloud voor algemene taken zonder gevoelige gegevens.', 'veryo' ) ),
				array( __( 'Is lokale AI AVG-proof?', 'veryo' ), __( 'Lokale AI maakt het eenvoudiger, omdat de AI-verwerking binnen je bedrijf blijft. Je blijft wel zelf verantwoordelijk voor wat je met persoonsgegevens doet.', 'veryo' ) ),
				array( __( 'Heb ik een eigen server nodig?', 'veryo' ), __( 'Ja, een krachtige computer of kleine server op kantoor. Welke precies, hangt af van het aantal medewerkers en wat ze ermee doen.', 'veryo' ) ),
			),
			veryo_sec_cta_demo( __( 'Zie lokale AI zelf werken', 'veryo' ), __( 'Plan een demo van Veryo Collega. We laten zien hoe het werkt, ook met het internet uit.', 'veryo' ) )
		),
	),

	/* ------------------------------------------------------------------------- */
	'wat-kost-ai-automatisering'           => array(
		'title'     => __( 'Wat kost AI-automatisering voor een MKB-bedrijf?', 'veryo' ),
		'seo_title' => __( 'Wat kost AI-automatisering voor het MKB? | Veryo', 'veryo' ),
		'desc'      => __( 'Wat kost AI-automatisering? Waar de kosten van afhangen, hoe je de opbrengst in uren en euro’s uitrekent en hoe je een gratis offerte op maat krijgt.', 'veryo' ),
		'kw'        => 'wat kost ai automatisering',
		'content'   => $veryo_article(
			__( 'de actuele openstelling en voorwaarden van de SLIM-regeling (uitvoering door Uitvoering van Beleid SZW) en of er voor 2027 nieuwe tijdvakken zijn.', 'veryo' ),
			array(
				__( 'Wat kost AI-automatisering voor een MKB-bedrijf? Het eerlijke antwoord: dat hangt af van wat je wilt automatiseren, welke software je al hebt en hoeveel koppelingen er nodig zijn. Een prijslijst zegt daarom weinig. Wat je wel kunt doen, is begrijpen waar de kosten van een AI-implementatie uit bestaan en uitrekenen wat het je oplevert.', 'veryo' ),
				sprintf(
					/* translators: %s: link naar de offertepagina. */
					__( 'In dit artikel lees je waar de kosten van afhangen, hoe je de opbrengst uitrekent en welke subsidie er mogelijk is. Wil je weten wat het voor jou kost, <a href="%s">vraag dan een gratis offerte aan</a>.', 'veryo' ),
					esc_url( veryo_link( 'prijzen' ) )
				),
			),
			array(
				array(
					__( 'Waar hangen de kosten van AI-automatisering van af?', 'veryo' ),
					array( __( 'Drie dingen bepalen het meest wat een automatisering kost:', 'veryo' ) ),
					array(
						'<strong>' . __( 'Wat je al hebt.', 'veryo' ) . '</strong> ' . __( 'Kan je bestaande software het al, dan gaat het om inrichten en trainen. Dat is het goedkoopst.', 'veryo' ),
						'<strong>' . __( 'Het aantal koppelingen.', 'veryo' ) . '</strong> ' . __( 'Moet je mailbox praten met je boekhouding, of je planning met je facturen? Elke koppeling is werk.', 'veryo' ),
						'<strong>' . __( 'Hoe afgebakend de taak is.', 'veryo' ) . '</strong> ' . __( 'Eén duidelijke taak is snel klaar. Een heel traject van aanvraag tot factuur is een project.', 'veryo' ),
					),
				),
				array(
					__( 'Eenmalige en terugkerende kosten', 'veryo' ),
					array(
						__( 'Bij een AI-implementatie betaal je meestal eenmalig voor het inrichten en bouwen. Daarnaast zijn er terugkerende kosten: verbruik van de AI-dienst en, als er koppelingen zijn gebouwd, onderhoud. Software verandert, en een koppeling die niet wordt onderhouden, werkt over een jaar niet meer.', 'veryo' ),
						__( 'Laat het verbruik bij voorkeur via je eigen account lopen. Dan zie je precies wat je betaalt, en blijf je eigenaar van je eigen gegevens en instellingen.', 'veryo' ),
					),
				),
				array(
					__( 'Wat levert het op? Zo reken je het uit', 'veryo' ),
					array(
						__( 'De opbrengst reken je uit in uren. Gebruik deze formule:', 'veryo' ),
						'<strong>' . __( 'Besparing per jaar = uren per week × aantal werkweken × kostprijs per uur.', 'veryo' ) . '</strong>',
						__( 'Vul je eigen cijfers in: hoeveel uur per week gaat er nu in de taak zitten, hoeveel weken per jaar wordt er gewerkt, en wat kost een uur van de mensen die het doen? Zet de uitkomst naast de offerte, en je ziet hoe snel de automatisering zich terugverdient. Het blijft een indicatie, geen belofte.', 'veryo' ),
						sprintf(
							/* translators: %s: link naar de AI-scan. */
							__( 'Weet je niet hoeveel uur er in je taken zit? De <a href="%s">gratis AI-scan</a> rekent het in drie minuten voor je uit.', 'veryo' ),
							esc_url( veryo_link( 'waar-begin-ik-met-ai' ) )
						),
					),
				),
				array(
					__( 'Subsidie voor AI in het MKB', 'veryo' ),
					array(
						__( 'Voor het automatiseren zelf is er geen algemene subsidie. Voor het trainen van je team kan de SLIM-regeling interessant zijn: een subsidie voor leren en ontwikkelen in het MKB. In 2026 waren er voor individuele MKB-ondernemers twee aanvraagtijdvakken, van 7 april tot en met 4 mei en van 19 augustus tot en met 7 september 2026. Die zijn inmiddels gesloten (bron: SRA-Nieuwsbank, april en augustus 2026).', 'veryo' ),
						__( 'Volgens dezelfde bronnen kon een individuele MKB-onderneming maximaal € 24.999 aanvragen, doorgaans 60 procent van de subsidiabele kosten, en werd maar een deel van de aanvragen toegekend. Of en wanneer de regeling in 2027 weer opengaat, is nog niet bekend. Kijk voor de actuele stand op de website van Uitvoering van Beleid SZW.', 'veryo' ),
					),
				),
				array(
					__( 'Wanneer AI-automatisering niet de moeite waard is', 'veryo' ),
					array(
						__( 'Niet alles hoeft geautomatiseerd. Werk dat een paar keer per jaar voorkomt, een proces dat nog niet helder is of beslissingen met grote gevolgen kun je beter met de hand blijven doen. Een goede adviseur zegt dat eerlijk.', 'veryo' ),
						__( 'Een rommelig proces automatiseren levert vooral sneller rommel op. Is de werkwijze nog niet helder, zet die dan eerst op papier en maak afspraken. Daarna is automatiseren vaak eenvoudiger, en dus ook goedkoper.', 'veryo' ),
					),
				),
				array(
					__( 'Zo vraag je een offerte aan die klopt', 'veryo' ),
					array( __( 'Een goede offerte begint met een goede vraag. Hoe meer je vooraf vertelt, hoe nauwkeuriger de prijs. Zet in elk geval op een rij:', 'veryo' ) ),
					array(
						__( 'Welke taak je wilt automatiseren, en hoe die nu loopt, stap voor stap.', 'veryo' ),
						__( 'Hoeveel uur per week er nu in zit, en bij wie.', 'veryo' ),
						__( 'Welke software je gebruikt: mail, boekhouding, planning, CRM.', 'veryo' ),
						__( 'Met hoeveel mensen je werkt, en wie er met de automatisering gaat werken.', 'veryo' ),
						__( 'Of er persoonsgegevens of vertrouwelijke stukken in het proces zitten.', 'veryo' ),
					),
				),
				array(
					__( 'De kosten van niets doen', 'veryo' ),
					array( __( 'Bij de vraag wat een AI-implementatie kost, hoort ook de vraag wat het kost om niets te doen. Werk dat elke week met de hand gaat, kost elke week weer uren. Fouten bij overtypen kosten geld en tijd om recht te zetten. En medewerkers die hun tijd aan routinewerk kwijt zijn, hebben minder tijd voor klanten. Zet ook die kosten naast de offerte.', 'veryo' ) ),
				),
				array(
					__( 'Een prijs voor jouw situatie', 'veryo' ),
					array(
						sprintf(
							/* translators: %s: link naar de offertepagina. */
							__( 'Veryo werkt niet met een prijslijst, maar met een <a href="%s">gratis offerte op maat</a>: vooraf een vaste prijs op papier, zonder verplichtingen. Vertel kort wat je wilt aanpakken en met hoeveel mensen je werkt, en je krijgt binnen één werkdag een reactie.', 'veryo' ),
							esc_url( veryo_link( 'prijzen' ) )
						),
					),
				),
			),
			array(
				array( __( 'Waarom staan er geen prijzen op de website?', 'veryo' ), __( 'Omdat de kosten per bedrijf sterk verschillen. Een prijs zonder je situatie te kennen, klopt bijna nooit. Met een offerte op maat weet je precies waar je aan toe bent.', 'veryo' ) ),
				array( __( 'Is AI-automatisering subsidiabel?', 'veryo' ), __( 'Voor het automatiseren zelf is er geen algemene regeling. Voor training kan de SLIM-regeling interessant zijn als die opengaat. Controleer de actuele stand bij Uitvoering van Beleid SZW.', 'veryo' ) ),
				array( __( 'Wat als de automatisering niet werkt?', 'veryo' ), __( 'We testen met echte gegevens voordat we live gaan, en het draait eerst mee naast je huidige werkwijze.', 'veryo' ) ),
			),
			veryo_sec_cta_scan()
		),
	),
);
