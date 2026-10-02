<?php
/**
 * Pijlers: de AI-werkplek, AI-agents, veilig AI-gebruik, plus AI-strategie en AI-training voor zzp'ers.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/*
 * De AI-werkplek: /ai-werkplek/
 */
$veryo_werkplek = veryo_page_standard(
	array(
		'answer'      => __( 'Veryo richt Copilot in voor het MKB, of Gemini als je met Google Workspace werkt: welke licenties je nodig hebt, wie welke gegevens mag zien vóórdat de AI erbij kan, de juiste instellingen, en een korte training zodat je team het ook echt gebruikt. Vaste prijs: €1.495 tot 10 gebruikers, €2.495 bij 11 tot 25, exclusief btw.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'De AI zit al in je kantoorsoftware, maar wie zet hem goed aan?', 'veryo' ),
			'p' => array(
				__( 'Microsoft 365 heeft Copilot, Google Workspace heeft Gemini. Ze kunnen je mail samenvatten, een conceptofferte schrijven in Word, een Excel-lijst uitleggen en een verslag van een Teams-overleg maken. Op papier is het een kwestie van een licentie kopen. In de praktijk gaat het vaak mis op drie plekken.', 'veryo' ),
				__( 'Ten eerste de licenties: wie heeft welke nodig, en wat zit er al in je huidige abonnement? Ten tweede de rechten. Copilot ziet alles wat een medewerker mag zien. Staat de map met salarissen of klantcontracten voor iedereen open, dan vindt de AI die ook, en vat hem desgevraagd samen. Ten derde het gebruik: zonder uitleg probeert de helft van het team het één keer, en dan nooit meer.', 'veryo' ),
			),
		),
		'photo'       => array( __( 'werkplekken met beeldschermen op kantoor', 'veryo' ), __( 'Copilot inrichten in het MKB: de AI-werkplek op kantoor', 'veryo' ), 'werkplek' ),
		'sections'    => array(
			array(
				'h'     => __( 'Wat we doen als we Copilot inrichten voor het MKB', 'veryo' ),
				'p'     => array( __( 'De AI-werkplek is een pakket met een vaste prijs. Het werkt voor Microsoft 365 met Copilot en voor Google Workspace met Gemini.', 'veryo' ) ),
				'list'  => array(
					'<strong>' . __( 'Licentieadvies.', 'veryo' ) . '</strong> ' . __( 'We kijken welke licenties je nu hebt, wie Copilot of Gemini echt nodig heeft, en waar je geld bespaart door niet iedereen hetzelfde te geven.', 'veryo' ),
					'<strong>' . __( 'Toegangsrechten op orde.', 'veryo' ) . '</strong> ' . __( 'Vóórdat de AI aangaat, controleren we wie welke mappen, sites en mailboxen kan zien. Wat niet gedeeld hoort te worden, zetten we dicht.', 'veryo' ),
					'<strong>' . __( 'Instellingen.', 'veryo' ) . '</strong> ' . __( 'We zetten de functies aan die jullie gebruiken, en de rest uit. Ook regelen we dat bedrijfsgegevens niet worden gebruikt om AI-modellen te trainen.', 'veryo' ),
					'<strong>' . __( 'Korte teamtraining.', 'veryo' ) . '</strong> ' . __( 'Anderhalf uur met voorbeelden uit jullie eigen werk: mail, verslagen, offertes en Excel. Zo weet iedereen wat het kan en waar je op moet letten.', 'veryo' ),
					'<strong>' . __( 'Afspraken op papier.', 'veryo' ) . '</strong> ' . __( 'Een korte notitie met wat is ingericht, wie welke licentie heeft en wat de afspraken zijn, zodat het overdraagbaar is.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'Microsoft 365 Copilot implementatie of Google Workspace met Gemini?', 'veryo' ),
				'p' => array(
					__( 'We adviseren niet welk kantoorpakket je moet nemen; we richten in wat je hebt. Werk je in Outlook, Word, Excel en Teams, dan is Copilot de logische stap. Werk je in Gmail, Docs en Sheets, dan is het Gemini. De aanpak is hetzelfde: eerst de rechten, dan de functies, dan de mensen.', 'veryo' ),
					__( 'Gebruiken medewerkers daarnaast ChatGPT of Claude, dan nemen we dat mee in de afspraken. Het doel is één overzicht van welke AI er in je bedrijf wordt gebruikt, en waarvoor.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Copilot veilig gebruiken: waar het vaak misgaat', 'veryo' ),
				'p' => array(
					__( 'Het grootste risico is niet de AI zelf, maar wat er al openstaat. In veel bedrijven zijn mappen in de loop der jaren met “iedereen in de organisatie” gedeeld, omdat dat makkelijk was. Zolang niemand ernaar zocht, viel dat niet op. Copilot zoekt wel. Een medewerker die vraagt “wat verdienen mijn collega’s?” kan dan een antwoord krijgen.', 'veryo' ),
					__( 'Daarom beginnen we altijd met de rechten. Dat is geen technisch kunstje, maar een gesprek: welke informatie is voor wie? Daarna zetten we het technisch zo neer. Is er een vaste IT-beheerder, dan doen we dit samen; Veryo doet zelf geen IT-beheer.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Wat je na afloop hebt', 'veryo' ),
				'p' => array(
					__( 'Een kantoorpakket waarin de AI aanstaat voor wie hem nodig heeft, rechten die kloppen, een team dat weet hoe je er goed mee werkt, en een notitie met de afspraken. Een voorbeeld: een administratiekantoor met acht mensen kan na de inrichting verslagen van klantgesprekken laten samenvatten en conceptmails laten schrijven, zonder dat de AI bij de dossiers van andere klanten kan.', 'veryo' ),
				),
			),
		),
		'no_steps'    => true,
		'after_price' => veryo_sec_tiered_price(
			__( 'Wat kost de AI-werkplek?', 'veryo' ),
			__( 'Een vaste prijs per aantal gebruikers, inclusief licentieadvies, rechten, instellingen en de teamtraining. De licenties zelf betaal je aan Microsoft of Google.', 'veryo' ),
			veryo_werkplek_prices(),
			__( 'Exclusief btw. Meer dan 25 gebruikers: op aanvraag.', 'veryo' )
		) . veryo_sec_ongoing( 'werkplek-onderhoud' ),
		'faq'         => array(
			array( __( 'Hebben we Copilot of Gemini al?', 'veryo' ), __( 'Misschien gedeeltelijk. In veel abonnementen zit al een gratis variant; de uitgebreide versie die in je eigen bestanden en mail kan zoeken, is een aparte licentie. We zoeken het voor je uit.', 'veryo' ) ),
			array( __( 'Moet iedereen een licentie krijgen?', 'veryo' ), __( 'Nee. Vaak hebben een paar mensen er veel aan en anderen weinig. We adviseren per rol, zodat je niet betaalt voor licenties die niet worden gebruikt.', 'veryo' ) ),
			array( __( 'Is Copilot veilig voor bedrijfsgegevens?', 'veryo' ), __( 'Copilot ziet wat een medewerker mag zien. Als de rechten kloppen, is het risico beperkt. Daarom zetten we die eerst goed, en regelen we dat je gegevens niet worden gebruikt om modellen te trainen.', 'veryo' ) ),
			array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo doet geen IT-beheer, hardware, netwerken of helpdesk. Heb je een vaste IT-beheerder, dan werken we graag met die samen.', 'veryo' ) ),
			array( __( 'Hoe lang duurt de inrichting?', 'veryo' ), __( 'Meestal twee tot drie weken, afhankelijk van hoe de rechten er nu bij staan. De training plannen we als alles klaarstaat.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'veilig-ai-gebruik', __( 'Veilig AI-gebruik', 'veryo' ), __( 'Beleid, rechten en de veiligheidscheck', 'veryo' ) ),
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Een uitgebreidere training voor je team', 'veryo' ) ),
			array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Als je breder wilt beginnen', 'veryo' ) ),
			array( 'branches/zakelijke-dienstverlening', __( 'AI voor accountants en adviesbureaus', 'veryo' ), __( 'Werken met dossiers en verslagen', 'veryo' ) ),
		),
	)
);

/*
 * AI-agents: /ai-agents/
 */
$veryo_agents = veryo_page_standard(
	array(
		'answer'      => __( 'Veryo bouwt AI-agents voor bedrijven: digitale collega’s die een terugkerende taak overnemen, zoals aanvragen beoordelen, inkoopfacturen verwerken of klantvragen beantwoorden, gekoppeld aan de software die je al gebruikt. Als project €2.500 tot €7.500, maatwerk vanaf €5.000, exclusief btw. Alleen als bestaande software het niet al oplost.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'Werk dat elke dag hetzelfde gaat, maar net te veel denkwerk is voor een simpele regel', 'veryo' ),
			'p' => array(
				__( 'Sommige taken komen elke dag terug en volgen een vast patroon, maar vragen toch even lezen en beoordelen. Een aanvraag binnenkrijgen, kijken wat de klant wil, de juiste gegevens erbij zoeken en een conceptantwoord klaarzetten. Een factuur openen, de leverancier en het project herkennen en hem op de goede plek boeken. Voor een gewone automatisering is dat te rommelig; voor een medewerker is het saai werk dat blijft liggen.', 'veryo' ),
				__( 'Daar zijn AI-agents voor. Een agent leest, beoordeelt en voert een paar stappen uit in je eigen systemen. Hij doet het voorbereidende werk, en een mens keurt goed wat ertoe doet.', 'veryo' ),
			),
		),
		'photo'       => array( __( 'twee medewerkers aan het werk achter hun beeldschermen', 'veryo' ), __( 'AI-agents voor bedrijven: digitale collega’s naast je team', 'veryo' ), 'laptop' ),
		'approach'    => true,
		'catalog'     => array(
			'h'   => __( 'Wat een digitale collega voor je kan doen', 'veryo' ),
			'ids' => array( 'mail-concepten', 'whatsapp-assistent', 'offerte-generator', 'inkoopfacturen', 'planningsassistent', 'interne-assistent' ),
		),
		'sections'    => array(
			array(
				'h' => __( 'AI-agent laten bouwen: hoe dat bij Veryo gaat', 'veryo' ),
				'p' => array(
					__( 'We beginnen met één taak, niet met een groot plan. Samen beschrijven we hoe die taak nu gaat, stap voor stap, en waar de beslismomenten zitten. Dan kijken we eerst of software die je al hebt of kunt nemen het kan. Pas als dat niet zo is, bouwen we een agent.', 'veryo' ),
					__( 'Een agent draait in je eigen accounts, met een logboek van alles wat hij doet en een vaste eigenaar bij jou. We testen eerst met echte gegevens in een proefperiode, waarin een medewerker elke uitkomst controleert. Pas als het betrouwbaar werkt, gaat hij zelfstandiger aan de slag.', 'veryo' ),
				),
			),
			array(
				'h'     => __( 'Wat een AI-agent niet doet', 'veryo' ),
				'list'  => array(
					__( 'Beslissingen met grote gevolgen, zoals iemand afwijzen of een betaling doen, laat een agent altijd aan een mens over.', 'veryo' ),
					__( 'Klantgerichte teksten gaan langs een mens voordat ze worden verstuurd, zeker in het begin.', 'veryo' ),
					__( 'Taken die een paar keer per jaar voorkomen, automatiseren we niet; dat levert te weinig op.', 'veryo' ),
					__( 'Een agent vervangt geen medewerker. Hij haalt werk weg dat niemand graag doet.', 'veryo' ),
				),
				'style' => 'checks',
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
			array( __( 'Wat is het verschil tussen een agent en een chatbot?', 'veryo' ), __( 'Een chatbot beantwoordt vragen. Een agent voert ook stappen uit: iets opzoeken, een concept klaarzetten, een gegeven invullen in een ander systeem.', 'veryo' ) ),
			array( __( 'Werkt een agent met onze software?', 'veryo' ), __( 'Meestal wel, via de koppelingen die pakketten als Outlook, Exact, Moneybird of een CRM bieden. We bouwen in je eigen accounts, zodat jij eigenaar blijft.', 'veryo' ) ),
			array( __( 'Wat als de agent een fout maakt?', 'veryo' ), __( 'Daarom begint elke agent met een proefperiode waarin een mens alles controleert, en houdt hij een logboek bij. Beslissingen met grote gevolgen blijven bij een mens.', 'veryo' ) ),
			array( __( 'Waarom is onderhoud verplicht?', 'veryo' ), __( 'Software verandert. Als een pakket een update krijgt, kan een koppeling stoppen. Met onderhoud bewaken we dat en lossen we het op voordat je het merkt.', 'veryo' ) ),
			array( __( 'Gaan onze gegevens naar een AI-dienst?', 'veryo' ), __( 'Alleen wat nodig is voor de taak, via zakelijke API’s waarbij je gegevens niet worden gebruikt om modellen te trainen. Bij persoonsgegevens sluiten we een verwerkersovereenkomst.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'ai-automatisering', __( 'AI-automatisering voor het MKB', 'veryo' ), __( 'Alles wat er mogelijk is, per afdeling', 'veryo' ) ),
			array( 'ai-op-maat', __( 'AI op maat', 'veryo' ), __( 'Chatbots en assistenten', 'veryo' ) ),
			array( 'branches/installatie', __( 'AI voor installateurs', 'veryo' ), __( 'Storingen, werkbonnen en offertes', 'veryo' ) ),
			array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Op locatie in het noorden', 'veryo' ) ),
		),
	)
);

/*
 * Veilig AI-gebruik: /veilig-ai-gebruik/
 */
$veryo_veilig = veryo_page_standard(
	array(
		'answer'      => __( 'Veilig AI gebruiken in je bedrijf begint met weten wat medewerkers nu in AI-tools invoeren. Veryo doet een AI-veiligheidscheck voor €995 exclusief btw: hoe AI nu wordt gebruikt, wie welke gegevens kan zien, of tweestapsverificatie aanstaat en of er beleid is, met een rapport vol concrete acties.', 'veryo' ),
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
			'p'     => __( 'De check is een vast bedrag. Wil je meteen ook training en een beleid, dan is het AI-Startpakket de logische stap.', 'veryo' ),
		),
		'after_price' => veryo_sec_ongoing( 'veilig-blijven' ),
		'faq'         => array(
			array( __( 'Mogen medewerkers ChatGPT gebruiken?', 'veryo' ), __( 'Dat bepaal je zelf, maar verbieden werkt slecht. Beter: een zakelijke versie met de juiste instellingen, en duidelijke afspraken over wat er wel en niet in mag.', 'veryo' ) ),
			array( __( 'Is een AI-beleid verplicht?', 'veryo' ), __( 'Niet als apart document. Wel verplicht de AI Act sinds 2 februari 2025 organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid. Een beleid en een training helpen daarbij.', 'veryo' ) ),
			array( __( 'Hoe lang duurt de veiligheidscheck?', 'veryo' ), __( 'Ongeveer twee weken: een week voor de vragenlijst en het bekijken van de instellingen, en daarna een gesprek over het rapport.', 'veryo' ) ),
			array( __( 'Doen jullie ook IT-beheer?', 'veryo' ), __( 'Nee. Veryo doet geen IT-beheer, hardware, netwerken of helpdesk. We werken graag samen met je vaste IT-beheerder.', 'veryo' ) ),
			array( __( 'Kunnen jullie Europese alternatieven adviseren?', 'veryo' ), __( 'Ja, waar je dat wilt. We leggen uit wat de opties zijn en wat je ervoor inlevert, zodat je een bewuste keuze maakt.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Training, beleid en een quick win', 'veryo' ) ),
			array( 'ai-werkplek', __( 'De AI-werkplek', 'veryo' ), __( 'Copilot of Gemini met de juiste rechten', 'veryo' ) ),
			array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Wat de AI Act vraagt', 'veryo' ) ),
			array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Op locatie in het noorden', 'veryo' ) ),
		),
	)
);

/*
 * AI-strategie: /ai-training/ai-strategie/
 */
$veryo_strategie = veryo_page_standard(
	array(
		'answer'      => __( 'De AI-strategie training van Veryo is een halve dag voor eigenaar, directie of MT: wat betekent AI voor ons bedrijf, waar liggen de kansen, welke keuzes maken we en wie is verantwoordelijk. Inhoudelijk is het de kansensessie uit het AI-Startpakket, los af te nemen voor €750 tot €1.500 exclusief btw.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'Iedereen praat over AI, maar wie in het bedrijf beslist er iets over?', 'veryo' ),
			'p' => array(
				__( 'In veel MKB-bedrijven gebeurt AI van onderop. Een medewerker ontdekt ChatGPT, een ander probeert Copilot, en de directie hoort er pas van als er iets misgaat of als een leverancier een AI-module wil verkopen. Er is geen richting, geen budget en niemand die het overzicht heeft.', 'veryo' ),
				__( 'Een AI-strategie hoeft geen dik rapport te zijn. Het is een paar heldere keuzes: waar zetten we AI wel in, waar niet, wat mag het kosten en wie houdt het bij. Die keuzes horen bij de leiding van het bedrijf, en daar is deze halve dag voor.', 'veryo' ),
			),
		),
		'sections'    => array(
			array(
				'h'     => __( 'Wat er in de AI-strategie training aan bod komt', 'veryo' ),
				'list'  => array(
					'<strong>' . __( 'Wat AI nu kan, en wat niet.', 'veryo' ) . '</strong> ' . __( 'Nuchter, met voorbeelden uit jullie branche, zonder hype.', 'veryo' ),
					'<strong>' . __( 'Waar de kansen liggen.', 'veryo' ) . '</strong> ' . __( 'We lopen samen jullie processen door en zetten de kansen op volgorde van opbrengst en moeite.', 'veryo' ),
					'<strong>' . __( 'De keuzes.', 'veryo' ) . '</strong> ' . __( 'Welke tools, welk budget, wat doen we zelf en wat besteden we uit. Ook: wat laten we bewust liggen.', 'veryo' ),
					'<strong>' . __( 'Verantwoordelijkheid.', 'veryo' ) . '</strong> ' . __( 'Wie is eigenaar van AI in het bedrijf, wie houdt het beleid bij en wie zorgt voor de AI-geletterdheid van het team.', 'veryo' ),
					'<strong>' . __( 'Een roadmap.', 'veryo' ) . '</strong> ' . __( 'Je krijgt een kort rapport met de prioriteiten en de verwachte opbrengst per kans.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'AI-strategie voor het MKB: voor wie', 'veryo' ),
				'p' => array(
					__( 'Voor eigenaren, directeuren en managementteams van bedrijven met vijf tot vijftig medewerkers. Het werkt het best met twee tot zes deelnemers: genoeg om verschillende kanten te horen, klein genoeg om echt keuzes te maken. We doen de sessie bij jullie op locatie, in Leeuwarden of online.', 'veryo' ),
					__( 'Je hoeft niets technisch te weten. Wel helpt het als iemand weet hoe de belangrijkste processen lopen: van aanvraag tot factuur, en waar de tijd in gaat.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'AI masterclass voor ondernemers, of liever meteen aan de slag?', 'veryo' ),
				'p' => array(
					__( 'De strategiesessie is geen presentatie waarin je alleen luistert. Je werkt met je eigen bedrijf, en gaat naar huis met keuzes en een volgorde. Wil je daarna ook het team meenemen, een beleid op papier en één toepassing die werkt, dan is het AI-Startpakket de volgende stap. De kansensessie zit daar al in, dus je betaalt hem niet dubbel als je binnen drie maanden doorgaat.', 'veryo' ),
					__( 'Een voorbeeld: een bouwbedrijf met twintig mensen kan in de sessie concluderen dat de meeste tijd in materiaalstaten en meerwerk zit, dat AI in de planning nog te vroeg is, en dat de bedrijfsleider eigenaar wordt van het AI-beleid. Dat is een voorbeeld, geen klantresultaat.', 'veryo' ),
				),
			),
		),
		'steps_intro' => __( 'De strategiesessie is stap twee. Daarna kies je zelf of je verder gaat.', 'veryo' ),
		'price'       => array(
			'steps' => array( 'kansensessie', 'startpakket' ),
			'h'     => __( 'Wat kost de AI-strategie training?', 'veryo' ),
		),
		'faq'         => array(
			array( __( 'Hoe lang duurt de sessie?', 'veryo' ), __( 'Een halve dag, ongeveer vier uur. Vooraf vul je een korte vragenlijst in, of je doet de gratis AI-scan.', 'veryo' ) ),
			array( __( 'Wat is het verschil met de AI-training voor het team?', 'veryo' ), __( 'De teamtraining gaat over het dagelijks gebruik van AI. Deze sessie gaat over keuzes: waar, waarom, met welk budget en wie verantwoordelijk is.', 'veryo' ) ),
			array( __( 'Krijgen we iets op papier?', 'veryo' ), __( 'Ja, een kort rapport met de kansen op volgorde, de gemaakte keuzes en een voorstel voor de volgende stappen.', 'veryo' ) ),
			array( __( 'Kan het ook online?', 'veryo' ), __( 'Ja. Op locatie werkt het meestal beter, maar online kan prima als je met een kleine groep bent.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'De volgende stap na de strategie', 'veryo' ) ),
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Voor het hele team', 'veryo' ) ),
			array( 'ai-implementatie-mkb', __( 'AI-implementatie MKB', 'veryo' ), __( 'Van plan naar invoering', 'veryo' ) ),
		),
	)
);

/*
 * AI-training voor zzp'ers: /ai-training/zzp/
 */
$veryo_zzp = veryo_page_standard(
	array(
		'answer'      => __( 'AI-training voor zzp’ers en eenmanszaken: leer in korte online modules hoe je ChatGPT, Claude of Copilot gebruikt voor je offertes, mail, administratie en marketing. De online training van de Veryo Academy komt eraan, voor €49 tot €79 per persoon exclusief btw. Schrijf je in voor de wachtlijst.', 'veryo' ),
		'problem'     => array(
			'h' => __( 'Als zzp’er doe je alles zelf, ook het werk waar je niet voor bent begonnen', 'veryo' ),
			'p' => array(
				__( 'Offertes, facturen, mail, je website, een post op LinkedIn: als zzp’er gaat er elke week veel tijd in werk dat geen geld oplevert. AI kan daar veel van overnemen of versnellen. Maar waar begin je, welke tool past, en wat mag je er wel en niet in zetten?', 'veryo' ),
				__( 'Een in-company training is voor één persoon te duur, en de meeste online cursussen zijn óf te technisch óf te vaag. Daarom maken we een korte, praktische training voor wie alleen of met een paar mensen werkt.', 'veryo' ),
			),
		),
		'sections'    => array(
			array(
				'h'     => __( 'Wat je leert in de AI cursus voor zzp’ers', 'veryo' ),
				'list'  => array(
					__( 'Goede opdrachten schrijven voor mail, offertes en teksten, zodat het resultaat klinkt als jij.', 'veryo' ),
					__( 'Een offerte of voorstel opzetten met AI, en controleren of het klopt.', 'veryo' ),
					__( 'Je administratie versnellen: bonnetjes, facturen en samenvattingen.', 'veryo' ),
					__( 'Content maken voor je website en social media, zonder dat het als AI klinkt.', 'veryo' ),
					__( 'Wat wel en niet mag met gegevens van klanten, en welke instellingen je aanzet.', 'veryo' ),
				),
				'style' => 'checks',
			),
			array(
				'h' => __( 'ChatGPT cursus voor zzp’ers: hoe de training werkt', 'veryo' ),
				'p' => array(
					__( 'De training bestaat uit korte modules van tien tot vijftien minuten, met een video met slides en uitleg, en een oefening met je eigen werk. Je doet ze wanneer het jou uitkomt. Na elke module heb je iets dat je meteen kunt gebruiken, zoals een set opdrachten voor je offertes of een vaste werkwijze voor je mail.', 'veryo' ),
					__( 'De Academy is nog in ontwikkeling. Op de wachtlijst hoor je als eerste wanneer hij opengaat, en wat de introductieprijs is. Je zit nergens aan vast.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Open groepstrainingen', 'veryo' ),
				'p' => array(
					__( 'Liever een dagdeel met andere ondernemers? We organiseren ook open groepstrainingen in Leeuwarden. Data, locatie en prijs maken we bekend via de wachtlijst. Laat bij je inschrijving weten dat je interesse hebt in een groepstraining.', 'veryo' ),
					__( 'Een in-company training bieden we op deze pagina bewust niet aan; die is bedoeld voor teams. Werk je met een paar mensen samen en wil je toch iets op maat, neem dan contact op.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Voor wie is de AI-training voor zzp’ers?', 'veryo' ),
				'p' => array(
					__( 'Voor zelfstandigen en eenmanszaken in elke branche: van installateur en schilder tot coach, fotograaf, boekhouder of tekstschrijver. Je hebt geen technische kennis nodig. Wel helpt het als je een paar taken in gedachten hebt die je elke week tegenhouden, zoals offertes uitwerken, mail beantwoorden of je administratie bijwerken. Die gebruik je in de oefeningen, zodat je na elke module iets hebt dat je de volgende dag inzet.', 'veryo' ),
					__( 'Werk je af en toe samen met een of twee anderen, dan kun je de training samen volgen. Vanaf tien deelnemers geldt een staffelkorting, maar voor de meeste zzp’ers gaat het om één licentie.', 'veryo' ),
				),
			),
			array(
				'h' => __( 'Waarom AI voor zzp’ers het verschil maakt', 'veryo' ),
				'p' => array(
					__( 'Een voorbeeld: een zelfstandig installateur die ’s avonds een uur aan offertes en mail besteedt, kan met goede opdrachten en een vaste werkwijze een flink deel van dat uur terugwinnen. Dat is een voorbeeld, geen belofte. Hoeveel het jou oplevert, hangt af van je werk; de gratis AI-scan geeft daar in drie minuten een indicatie van.', 'veryo' ),
				),
			),
		),
		'no_steps'    => true,
		'after_price' => veryo_b_group(
			veryo_b_h( __( 'Schrijf je in voor de wachtlijst', 'veryo' ) )
			. veryo_b_shortcode( '[veryo_form type="academy"]' ),
			array( 'className' => 'veryo-form-wrap is-style-paper' )
		),
		'price'       => array(
			'steps' => array( 'academy', 'scan' ),
			'h'     => __( 'Wat kost de AI-training voor zzp’ers?', 'veryo' ),
		),
		'faq'         => array(
			array( __( 'Wanneer start de online training?', 'veryo' ), __( 'De Academy is in ontwikkeling. Op de wachtlijst hoor je als eerste wanneer hij opengaat.', 'veryo' ) ),
			array( __( 'Heb ik technische kennis nodig?', 'veryo' ), __( 'Nee. Als je kunt mailen en een document kunt maken, kun je de training volgen.', 'veryo' ) ),
			array( __( 'Welke AI-tool gebruik ik in de training?', 'veryo' ), __( 'De oefeningen werken met ChatGPT, Claude of Copilot. Je kiest zelf; we leggen de verschillen uit.', 'veryo' ) ),
			array( __( 'Is de training aftrekbaar?', 'veryo' ), __( 'Scholingskosten voor je onderneming zijn meestal zakelijke kosten. Vraag je boekhouder hoe dat voor jou zit.', 'veryo' ) ),
		),
		'links'       => array(
			array( 'academy', __( 'Veryo Academy', 'veryo' ), __( 'Online AI-cursus voor beginners', 'veryo' ) ),
			array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Voor teams', 'veryo' ) ),
			array( 'leeuwarden', __( 'AI-training in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ),
		),
	)
);

return array(
	'ai-werkplek'              => array(
		'title'     => __( 'De AI-werkplek: Copilot en Gemini goed ingericht', 'veryo' ),
		'seo_title' => __( 'Microsoft Copilot en Gemini inrichten voor het MKB | Veryo', 'veryo' ),
		'desc'      => __( 'Copilot inrichten voor het MKB, of Gemini: licentieadvies, toegangsrechten, instellingen en een teamtraining. Vaste prijs, vanaf €1.495 excl. btw.', 'veryo' ),
		'kw'        => 'copilot inrichten mkb',
		'schema'    => array(
			'type' => 'service',
			'min'  => 1495,
			'max'  => 2495,
		),
		'content'   => $veryo_werkplek,
	),
	'ai-agents'                => array(
		'title'     => __( 'Digitale collega’s: AI-agents voor je bedrijf', 'veryo' ),
		'seo_title' => __( 'AI-agents voor bedrijven: digitale collega’s | Veryo', 'veryo' ),
		'desc'      => __( 'AI-agents voor bedrijven: digitale collega’s die terugkerend werk overnemen, gekoppeld aan je eigen software. Een project kost vanaf €2.500 excl. btw.', 'veryo' ),
		'kw'        => 'ai agents voor bedrijven',
		'schema'    => array(
			'type' => 'service',
			'min'  => 2500,
			'max'  => 25000,
		),
		'content'   => $veryo_agents,
	),
	'veilig-ai-gebruik'        => array(
		'title'     => __( 'Veilig AI gebruiken in je bedrijf', 'veryo' ),
		'seo_title' => __( 'Veilig AI gebruiken in je bedrijf: beleid en check | Veryo', 'veryo' ),
		'desc'      => __( 'AI veilig gebruiken in je bedrijf: de AI-veiligheidscheck van Veryo bekijkt gebruik, rechten, tweestapsverificatie en beleid. €995 excl. btw, met rapport.', 'veryo' ),
		'kw'        => 'ai veilig gebruiken bedrijf',
		'schema'    => array(
			'type' => 'service',
			'min'  => 995,
			'max'  => 995,
		),
		'content'   => $veryo_veilig,
	),
	'ai-training/ai-strategie' => array(
		'title'     => __( 'AI-strategie: training voor directie en MT', 'veryo' ),
		'seo_title' => __( 'AI-strategie training voor directie en MT | Veryo', 'veryo' ),
		'desc'      => __( 'AI-strategie training voor directie en MT: een halve dag over kansen, keuzes en verantwoordelijkheid, met een roadmap. €750–1.500 excl. btw, op locatie.', 'veryo' ),
		'kw'        => 'ai strategie training',
		'schema'    => array(
			'type' => 'service',
			'min'  => 750,
			'max'  => 1500,
		),
		'content'   => $veryo_strategie,
	),
	'ai-training/zzp'          => array(
		'title'     => __( 'AI-training voor zzp’ers', 'veryo' ),
		'seo_title' => __( 'AI-training voor zzp’ers: praktisch en betaalbaar | Veryo', 'veryo' ),
		'desc'      => __( 'AI-training voor zzp’ers: korte online modules over offertes, mail, administratie en marketing met AI. €49–79 per persoon excl. btw. Schrijf je in.', 'veryo' ),
		'kw'        => 'ai training zzp',
		'schema'    => array(
			'type' => 'service',
			'min'  => 49,
			'max'  => 79,
		),
		'content'   => $veryo_zzp,
	),
);
