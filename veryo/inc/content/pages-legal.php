<?php
/**
 * Juridische concepten: privacy, cookies, voorwaarden. In de u-vorm.
 * Bovenaan staat (alleen voor beheerders) de waarschuwing dat de tekst juridisch gecontroleerd moet worden.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_privacy  = veryo_b_p( __( 'In deze privacyverklaring leest u welke persoonsgegevens Veryo verwerkt, waarom, hoe lang we ze bewaren en welke rechten u heeft. Versie: 30 september 2026.', 'veryo' ), array( 'fontSize' => 'body-l' ) );
$veryo_privacy .= veryo_sec_text(
	__( '1. Wie is verantwoordelijk?', 'veryo' ),
	array( __( 'Verantwoordelijk voor de verwerking van uw persoonsgegevens is Veryo, een handelsnaam van Merklenz (eenmanszaak), Lange Marktstraat 1, Leeuwarden. KvK-nummer: 73435996. U kunt ons bereiken via de contactgegevens hieronder.', 'veryo' ) )
);
$veryo_privacy .= veryo_b_shortcode( '[veryo_contact_details]' );
$veryo_privacy .= veryo_sec_text(
	__( '2. Welke gegevens verzamelt de AI-scan?', 'veryo' ),
	array( __( 'Als u de gratis AI-scan invult, verwerken we:', 'veryo' ) ),
	array(
		__( 'Uw antwoorden: branche, teamgrootte, de taken waar tijd naartoe gaat en het aantal uren per taak, de tools die u gebruikt, hoe u nu AI gebruikt, de optionele tekst over uw grootste frustratie en wanneer u iets wilt doen.', 'veryo' ),
		__( 'Uw contactgegevens: voornaam, bedrijfsnaam, e-mailadres en, als u dat invult, uw telefoonnummer.', 'veryo' ),
		__( 'Het tijdstip waarop u toestemming gaf.', 'veryo' ),
		__( 'Een onleesbaar gemaakte (gehashte) versie van uw IP-adres, om misbruik te voorkomen. Het leesbare IP-adres slaan we niet op.', 'veryo' ),
		__( 'De cijfers die we uit uw antwoorden berekenen (geschatte tijdwinst, kansenscore) en het rapport dat we voor u maken.', 'veryo' ),
	)
);
$veryo_privacy .= veryo_sec_text(
	__( '3. Waarvoor gebruiken we deze gegevens?', 'veryo' ),
	array(),
	array(
		__( 'Om uw persoonlijke rapport te maken en naar u te mailen.', 'veryo' ),
		__( 'Om contact met u op te nemen over het rapport, bijvoorbeeld telefonisch als u uw nummer heeft ingevuld.', 'veryo' ),
		__( 'Om vragen te beantwoorden die u via het contactformulier stuurt.', 'veryo' ),
		__( 'Om u te informeren als de Veryo Academy beschikbaar is, als u zich op de wachtlijst heeft gezet.', 'veryo' ),
		__( 'Voor eigen, anonieme statistieken over AI-gebruik in het MKB. Daarvoor gebruiken we alleen antwoorden en cijfers, zonder contactgegevens en zonder de frustratietekst.', 'veryo' ),
	)
);
$veryo_privacy .= veryo_sec_text(
	__( '4. Op welke grondslag?', 'veryo' ),
	array( __( 'We verwerken deze gegevens op basis van uw toestemming, die u geeft met het vinkje onder het formulier. U kunt uw toestemming altijd intrekken; dat heeft geen gevolgen voor de verwerking daarvoor. [VUL IN: laat controleren of voor het opvolgen van een aanvraag ook “uitvoering van een overeenkomst” of “gerechtvaardigd belang” van toepassing is]', 'veryo' ) )
);
$veryo_privacy .= veryo_sec_text(
	__( '5. Gebruik van AI bij het maken van het rapport', 'veryo' ),
	array(
		__( 'Om het rapport te schrijven, sturen we uw antwoorden naar de AI-dienst van Anthropic (Claude). Het gaat om: branche, teamgrootte, taken en uren, tools, huidig AI-gebruik, de frustratietekst en de timing, samen met de door ons berekende cijfers. Uw naam, bedrijfsnaam, e-mailadres en telefoonnummer sturen we nooit mee. E-mailadressen en telefoonnummers die u eventueel in de frustratietekst zet, halen we er vooraf automatisch uit.', 'veryo' ),
		__( 'We gebruiken de zakelijke API van Anthropic. Volgens de voorwaarden van Anthropic worden gegevens die via de zakelijke API worden verstuurd niet gebruikt om AI-modellen te trainen. Anthropic kan gegevens buiten de Europese Economische Ruimte verwerken. [VUL IN: doorgiftemechanisme, bijvoorbeeld het EU-VS Data Privacy Framework of standaardcontractbepalingen, en bewaartermijn bij Anthropic volgens de actuele voorwaarden]', 'veryo' ),
		__( 'De cijfers in het rapport (tijdwinst en euro’s) worden niet door AI berekend maar door een vaste formule op onze website. Lukt het niet om het rapport met AI te maken, dan maken we het met vooraf geschreven teksten.', 'veryo' ),
	)
);
$veryo_privacy .= veryo_sec_text(
	__( '6. Met wie delen we gegevens?', 'veryo' ),
	array(),
	array(
		__( 'Anthropic, voor het schrijven van het rapport (zonder contactgegevens, zie hierboven).', 'veryo' ),
		__( 'Onze hostingpartij mijn.host, waar de website en de gegevens staan, in Nederland.', 'veryo' ),
		__( 'Onze e-maildienst voor het versturen van e-mail: mijn.host (Nederland).', 'veryo' ),
		__( '[VUL IN: als de Make-koppeling wordt gebruikt: Make (Celonis) en de gekoppelde tool, bijvoorbeeld ClickUp of Notion, voor het opvolgen van aanvragen]', 'veryo' ),
		__( 'Met deze partijen hebben we een verwerkersovereenkomst of zij verwerken de gegevens onder hun eigen zakelijke voorwaarden. We verkopen uw gegevens nooit.', 'veryo' ),
	)
);
$veryo_privacy .= veryo_sec_text(
	__( '7. Hoe lang bewaren we gegevens?', 'veryo' ),
	array( __( 'Gegevens uit de AI-scan, het contactformulier en de wachtlijst bewaren we maximaal [veryo_bewaartermijn] na het invullen. Daarna worden ze automatisch verwijderd. De online versie van uw rapport is 90 dagen bereikbaar via de persoonlijke link. Wordt u klant, dan gelden de bewaartermijnen uit onze administratie en de wet. [VUL IN: controleer of de ingestelde bewaartermijn overeenkomt]', 'veryo' ) )
);
$veryo_privacy .= veryo_sec_text(
	__( '8. Cookies en lokale opslag', 'veryo' ),
	array( __( 'De AI-scan gebruikt geen cookies. Tijdens het invullen bewaren we uw antwoorden tijdelijk in de sessie-opslag van uw browser (sessionStorage), zodat ze niet verloren gaan als u de pagina ververst. Uw contactgegevens bewaren we daar niet. De sessie-opslag wordt gewist als u het tabblad sluit. Zie ook onze cookieverklaring.', 'veryo' ) )
);
$veryo_privacy .= veryo_sec_text(
	__( '9. Uw rechten', 'veryo' ),
	array( __( 'U heeft het recht om uw gegevens in te zien, te laten corrigeren of verwijderen, de verwerking te laten beperken, bezwaar te maken en uw gegevens over te laten dragen. Stuur daarvoor een e-mail naar het adres hierboven. We reageren binnen een maand. U heeft ook het recht een klacht in te dienen bij de Autoriteit Persoonsgegevens.', 'veryo' ) )
);
$veryo_privacy .= veryo_sec_text(
	__( '10. Beveiliging', 'veryo' ),
	array( __( 'De website gebruikt een beveiligde verbinding (https). Toegang tot de gegevens is beperkt tot beheerders. Formulieren zijn beschermd tegen misbruik. [VUL IN: aanvullende maatregelen, zoals tweestapsverificatie voor beheerders en back-ups]', 'veryo' ) )
);

$veryo_cookies  = veryo_b_p( __( 'Deze cookieverklaring legt uit welke cookies en vergelijkbare technieken deze website gebruikt. Versie: 30 september 2026.', 'veryo' ), array( 'fontSize' => 'body-l' ) );
$veryo_cookies .= veryo_sec_text(
	__( 'Geen tracking- of advertentiecookies', 'veryo' ),
	array( __( 'Deze website plaatst standaard geen analytische, tracking- of advertentiecookies en laadt geen scripts, lettertypes of afbeeldingen van externe partijen. Daardoor is er geen cookiebanner nodig.', 'veryo' ) )
);
$veryo_cookies .= veryo_sec_text(
	__( 'Functionele cookies', 'veryo' ),
	array(),
	array(
		__( 'WordPress plaatst functionele cookies voor beheerders die zijn ingelogd. Deze zijn nodig om in te loggen en worden niet voor bezoekers gebruikt.', 'veryo' ),
		__( 'Als u een reactie plaatst en daarvoor kiest, kan WordPress uw naam en e-mailadres in een cookie onthouden.', 'veryo' ),
	)
);
$veryo_cookies .= veryo_sec_text(
	__( 'Sessie-opslag bij de AI-scan', 'veryo' ),
	array( __( 'Tijdens het invullen van de AI-scan bewaren we uw antwoorden tijdelijk in de sessie-opslag van uw browser (sessionStorage). Dit is geen cookie en wordt niet naar ons verstuurd tot u het formulier verzendt. Contactgegevens bewaren we daar niet. De opslag verdwijnt als u het tabblad sluit.', 'veryo' ) )
);
$veryo_cookies .= veryo_sec_text(
	__( 'Wijzigingen', 'veryo' ),
	array( __( 'Als we later analytische of andere cookies gaan gebruiken, passen we deze verklaring aan en vragen we waar nodig eerst uw toestemming. [VUL IN: aanvullen als er analytics of embeds worden toegevoegd]', 'veryo' ) )
);

$veryo_terms  = veryo_b_p( __( 'Deze algemene voorwaarden zijn van toepassing op alle offertes, opdrachten en diensten van Veryo. Versie: 30 september 2026.', 'veryo' ), array( 'fontSize' => 'body-l' ) );
$veryo_terms .= veryo_sec_text(
	__( '1. Definities', 'veryo' ),
	array(),
	array(
		__( '<strong>Veryo</strong>: handelsnaam van Merklenz, eenmanszaak, Lange Marktstraat 1, Leeuwarden, KvK 73435996.', 'veryo' ),
		__( '<strong>Opdrachtgever</strong>: de organisatie die Veryo een opdracht geeft.', 'veryo' ),
		__( '<strong>Diensten</strong>: trainingen, kansensessies, automatiseringen, AI op maat, onderhoud en abonnementen.', 'veryo' ),
		__( '<strong>Automatisering</strong>: een door Veryo ingerichte workflow, koppeling, assistent of agent.', 'veryo' ),
	)
);
$veryo_terms .= veryo_sec_text(
	__( '2. Offertes en prijzen', 'veryo' ),
	array( __( 'Offertes zijn vrijblijvend en 14 dagen geldig. Alle prijzen zijn exclusief btw. Een vaste prijs geldt voor de omschrijving in de offerte; wijzigingen of uitbreidingen op verzoek van opdrachtgever worden vooraf besproken en apart geoffreerd. Verbruikskosten van software van derden (zoals AI-diensten en automatiseringsplatforms) zijn voor rekening van opdrachtgever, tenzij anders afgesproken.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '3. Uitvoering', 'veryo' ),
	array( __( 'Veryo voert opdrachten zorgvuldig en naar beste kunnen uit. Opdrachtgever zorgt tijdig voor de benodigde toegang, gegevens en een contactpersoon. Veryo bouwt automatiseringen waar mogelijk in accounts van opdrachtgever. Iedere automatisering krijgt een eigenaar bij opdrachtgever.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '4. Gebruik van AI', 'veryo' ),
	array( __( 'AI-systemen kunnen fouten maken. Uitvoer van AI (zoals concepten, samenvattingen en voorstellen) is bedoeld als ondersteuning. Opdrachtgever blijft verantwoordelijk voor beslissingen en voor het controleren van uitvoer voordat die wordt gebruikt of naar derden gaat. Veryo richt automatiseringen zo in dat beslissingen met grote gevolgen door een mens worden genomen.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '5. Betaling', 'veryo' ),
	array( __( 'Facturen worden betaald binnen 14 dagen na factuurdatum. Abonnementen worden maandelijks vooraf gefactureerd. Bij te late betaling is opdrachtgever na een herinnering de wettelijke (handels)rente verschuldigd.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '6. Eigendom en gegevens', 'veryo' ),
	array( __( 'Opdrachtgever blijft eigenaar van zijn gegevens. Automatiseringen in accounts van opdrachtgever worden na volledige betaling eigendom van opdrachtgever, met uitzondering van algemene kennis, sjablonen en werkwijzen van Veryo. Trainingsmateriaal blijft eigendom van Veryo en mag intern worden gebruikt.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '7. Privacy', 'veryo' ),
	array( __( 'Als Veryo bij de uitvoering persoonsgegevens verwerkt namens opdrachtgever, sluiten partijen een verwerkersovereenkomst.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '8. Aansprakelijkheid', 'veryo' ),
	array( __( '[VUL IN: aansprakelijkheidsbeperking, bijvoorbeeld beperkt tot het factuurbedrag van de betreffende opdracht, en uitsluiting van indirecte schade. Laat dit juridisch formuleren.]', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '9. Duur en opzegging', 'veryo' ),
	array( __( 'Onderhouds- en partnerabonnementen lopen per [VUL IN: maand/jaar] en zijn opzegbaar met een termijn van [VUL IN: termijn]. Bij beëindiging helpt Veryo bij een ordentelijke overdracht van de automatiseringen.', 'veryo' ) )
);
$veryo_terms .= veryo_sec_text(
	__( '10. Toepasselijk recht', 'veryo' ),
	array( __( 'Op deze voorwaarden en alle overeenkomsten is Nederlands recht van toepassing. Geschillen worden voorgelegd aan de bevoegde rechter in het arrondissement Noord-Nederland.', 'veryo' ) )
);

return array(
	'privacyverklaring'    => array(
		'title'     => __( 'Privacyverklaring', 'veryo' ),
		'seo_title' => __( 'Privacyverklaring | Veryo', 'veryo' ),
		'desc'      => __( 'Privacyverklaring van Veryo: welke gegevens de AI-scan verzamelt, wat naar de AI-dienst van Anthropic gaat, hoe lang we bewaren en welke rechten u heeft.', 'veryo' ),
		'kw'        => '',
		'meta'      => array( 'legal_draft' => 1 ),
		'content'   => $veryo_privacy,
	),
	'cookieverklaring'     => array(
		'title'     => __( 'Cookieverklaring', 'veryo' ),
		'seo_title' => __( 'Cookieverklaring | Veryo', 'veryo' ),
		'desc'      => __( 'Cookieverklaring van Veryo: deze website gebruikt geen tracking- of advertentiecookies. Lees welke functionele cookies en opslag we wel gebruiken.', 'veryo' ),
		'kw'        => '',
		'meta'      => array(
			'legal_draft' => 1,
			'noindex'     => 1,
		),
		'content'   => $veryo_cookies,
	),
	'algemene-voorwaarden' => array(
		'title'     => __( 'Algemene voorwaarden', 'veryo' ),
		'seo_title' => __( 'Algemene voorwaarden | Veryo', 'veryo' ),
		'desc'      => __( 'Algemene voorwaarden van Veryo voor trainingen, automatiseringen, AI op maat en abonnementen: offertes, uitvoering, AI-gebruik, betaling en eigendom.', 'veryo' ),
		'kw'        => '',
		'meta'      => array(
			'legal_draft' => 1,
			'noindex'     => 1,
		),
		'content'   => $veryo_terms,
	),
);
