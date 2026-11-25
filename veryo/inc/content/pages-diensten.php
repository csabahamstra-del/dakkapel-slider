<?php
/**
 * Dienstenoverzicht: /diensten/. Veryo bouwt en richt in: AI-agents, automatiseringen, de
 * AI-werkplek met Claude Team en de administratieve kringloop. Training is geen los product;
 * na de oplevering leren we het team ermee werken.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_dienst = static function ( $path, $title, $intro, $items ) {
	$more = array(
		'ai-werkplek'                     => __( 'Claude Team inrichten', 'veryo' ),
		'ai-automatisering/administratie' => __( 'Meer over de administratieve kringloop', 'veryo' ),
		'ai-agents'                       => __( 'AI-agents voor bedrijven', 'veryo' ),
		'ai-automatisering'               => __( 'AI automatisering voor het mkb', 'veryo' ),
	);
	return veryo_b_group(
		veryo_b_h( '<a href="' . esc_url( veryo_link( $path ) ) . '">' . esc_html( $title ) . '</a>', 3 )
		. veryo_b_p( $intro )
		. veryo_b_list( $items, array( 'className' => 'is-style-checks' ) )
		. veryo_b_p( '<a href="' . esc_url( veryo_link( $path ) ) . '">' . esc_html( isset( $more[ $path ] ) ? $more[ $path ] : $title ) . '</a>' ),
		array( 'className' => 'veryo-dienst' )
	);
};

$veryo_diensten = veryo_page_standard(
	array(
		'answer_cta' => array( __( 'Plan een kennismaking', 'veryo' ), '#vraag', 'amber' ),
		'answer'     => __( 'Veryo bouwt en richt AI in voor technische kantoren en projectbedrijven met 15 tot 50 medewerkers in Noord-Nederland: AI-agents voor terugkerend werk, automatiseringen bovenop de systemen die jullie al gebruiken, de AI-werkplek met Claude Team en automatisering van de administratieve kringloop. Veryo bouwt geen nieuwe software; overstappen is nooit nodig. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
		'problem'    => array(
			'h' => __( 'Voor wie we werken', 'veryo' ),
			'p' => array(
				__( 'Ingenieurs- en adviesbureaus, installateurs met eigen engineering, koeltechniek, dak, gevel en kozijnen, staal- en metaalbouw, interieurbouw, landbouwmechanisatie en loonbedrijven. Bedrijven waar engineers, werkvoorbereiders en kantoor veel tijd kwijt zijn aan lezen, overtypen en uitzoeken, terwijl de kennis in het bedrijf zelf zit.', 'veryo' ),
			),
		),
		'sections'   => array(
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( 'Wat we bouwen en inrichten', 'veryo' ) )
					. $veryo_dienst(
						'ai-werkplek',
						__( 'AI-werkplek met Claude Team', 'veryo' ),
						__( 'Claude ingericht met de eigen normen, kengetallen en templates van jullie bedrijf, zodat het werk voorbereidt zoals jullie het doen. De engineer blijft eindverantwoordelijk: AI bereidt voor en controleert.', 'veryo' ),
						array(
							__( 'Een bestek lezen en de eisen op een rij zetten.', 'veryo' ),
							__( 'Een calculatieopzet voorbereiden met jullie eigen kengetallen.', 'veryo' ),
							__( 'Uitgangspunten controleren op volledigheid en tegenstrijdigheden.', 'veryo' ),
							__( 'Werkvoorbereiding en rapportages opzetten in jullie eigen templates.', 'veryo' ),
						)
					)
					. $veryo_dienst(
						'ai-automatisering/administratie',
						__( 'De administratieve kringloop', 'veryo' ),
						__( 'Van uren en werkbonnen tot factuur en salarisadministratie, bovenop het pakket dat jullie al hebben.', 'veryo' ),
						array(
							__( 'Uren en werkbonnen inlezen, als foto, via WhatsApp of een formulier.', 'veryo' ),
							__( 'Inkoopfacturen aan projecten koppelen en in de boekhouding zetten.', 'veryo' ),
							__( 'Weekafsluiting met conceptfacturen.', 'veryo' ),
							__( 'Uren klaarzetten voor de salarisadministratie, en begroot naast werkelijk per project.', 'veryo' ),
						)
					)
					. $veryo_dienst(
						'ai-agents',
						__( 'AI-agents', 'veryo' ),
						__( 'Digitale collega’s die een terugkerende taak zelfstandig voorbereiden in jullie eigen systemen. Een mens keurt goed wat ertoe doet.', 'veryo' ),
						array(
							__( 'Aanvragen en storingsmeldingen lezen, aanvullen en klaarzetten in de planning.', 'veryo' ),
							__( 'Conceptantwoorden op mail in jullie eigen toon.', 'veryo' ),
							__( 'Documenten en eerdere projecten doorzoeken, met de bron erbij.', 'veryo' ),
						)
					)
					. $veryo_dienst(
						'ai-automatisering',
						__( 'Automatiseringen', 'veryo' ),
						__( 'Koppelingen tussen de software die jullie al gebruiken, zodat niemand meer gegevens overtypt.', 'veryo' ),
						array(
							__( 'Aanvraag en offerte: van mail of formulier naar een conceptofferte.', 'veryo' ),
							__( 'Projectgegevens automatisch van het ene systeem naar het andere.', 'veryo' ),
							__( 'Rapportages en overzichten uit de cijfers die er al zijn.', 'veryo' ),
						)
					),
					array( 'className' => 'veryo-section veryo-diensten' )
				),
			),
			array(
				'h' => __( 'Ook: Veryo Collega, lokale AI op kantoor', 'veryo' ),
				'p' => array(
					sprintf(
						/* translators: %s: link naar Veryo Collega. */
						__( 'Werken jullie met vertrouwelijke kennis die het pand niet uit mag? %s is een AI-assistent die volledig op een eigen machine bij jullie op kantoor draait en jullie documenten, cijfers en planning kent.', 'veryo' ),
						'<a href="' . esc_url( veryo_collega_url() ) . '">' . esc_html( veryo_collega()['naam'] ) . '</a>'
					),
				),
			),
			array(
				'h' => __( 'Voor zorgpraktijken: Veryo Receptie', 'veryo' ),
				'p' => array(
					sprintf(
						/* translators: %s: link naar Veryo Receptie. */
						__( 'Een AI-receptionist die de telefoon opneemt tijdens behandelingen en na sluitingstijd, en afspraken inplant. %s.', 'veryo' ),
						'<a href="' . esc_url( veryo_link( 'ai-op-maat/ai-receptionist-horeca' ) ) . '">' . esc_html__( 'Meer over Veryo Receptie', 'veryo' ) . '</a>'
					),
				),
			),
			array(
				'h'     => __( 'Zo werken we', 'veryo' ),
				'list'  => array(
					'<strong>' . __( 'Eerst kijken wat er is.', 'veryo' ) . '</strong> ' . __( 'We beginnen bij jullie werk en de software die jullie al gebruiken.', 'veryo' ),
					'<strong>' . __( 'Bouwen en inrichten.', 'veryo' ) . '</strong> ' . __( 'In jullie eigen accounts, getest met echte gegevens voordat het live gaat.', 'veryo' ),
					'<strong>' . __( 'Na de oplevering leren we jullie team ermee werken.', 'veryo' ) . '</strong> ' . __( 'Met de toepassing die we hebben gebouwd, niet met een algemene cursus.', 'veryo' ),
					'<strong>' . __( 'Beheer en onderhoud.', 'veryo' ) . '</strong> ' . __( 'We houden in de gaten of alles blijft werken als software verandert.', 'veryo' ),
				),
				'style' => 'checks',
			),
		),
		'no_steps'   => true,
		'contact'    => array(
			__( 'Welk werk kost jullie de meeste tijd?', 'veryo' ),
			__( 'Beschrijf kort wat er steeds terugkomt. Jullie horen binnen één werkdag wat we zouden bouwen of inrichten, en wat de volgende stap is.', 'veryo' ),
			__( 'Bijvoorbeeld: onze werkvoorbereiders lezen elk bestek met de hand door. Kan dat sneller?', 'veryo' ),
		),
		'faq'        => array(
			array( __( 'Geven jullie ook AI-trainingen?', 'veryo' ), __( 'Niet als los product. Wel leren we na de oplevering jullie team werken met wat we hebben gebouwd of ingericht.', 'veryo' ) ),
			array( __( 'Moeten we andere software gaan gebruiken?', 'veryo' ), __( 'Nee. Veryo bouwt geen nieuwe software. We bouwen bovenop wat jullie al hebben; overstappen is nooit nodig.', 'veryo' ) ),
			array( __( 'Wie betaalt de licenties van Claude Team?', 'veryo' ), __( 'Jullie, rechtstreeks aan Anthropic. Veryo richt de werkplek in en verkoopt geen licenties.', 'veryo' ) ),
			array( __( 'Wie is verantwoordelijk voor de uitkomst?', 'veryo' ), __( 'Jullie engineers en medewerkers. AI bereidt voor en controleert; beslissingen en eindverantwoordelijkheid blijven bij een mens.', 'veryo' ) ),
		),
		'cta_demo'   => true,
		'cta'        => array( __( 'Benieuwd wat we voor jullie kunnen bouwen?', 'veryo' ), __( 'Plan een gratis kennismaking. We kijken samen naar één proces en vertellen eerlijk of het loont.', 'veryo' ) ),
		'links'      => array(
			array( 'ai-werkplek', __( 'AI-werkplek met Claude Team', 'veryo' ), __( 'Claude met jullie eigen normen en templates', 'veryo' ) ),
			array( 'ai-automatisering/administratie', __( 'De administratieve kringloop', 'veryo' ), __( 'Van werkbon tot factuur en salaris', 'veryo' ) ),
			array( 'ai-agents', __( 'AI-agents voor bedrijven', 'veryo' ), __( 'Digitale collega’s voor terugkerend werk', 'veryo' ) ),
			array( 'ai-automatisering', __( 'AI automatisering voor het mkb', 'veryo' ), __( 'Koppelingen tussen jullie software', 'veryo' ) ),
		),
	)
);

return array(
	'diensten' => array(
		'title'     => __( 'Diensten: AI bouwen en inrichten voor technische bedrijven', 'veryo' ),
		'seo_title' => __( 'Diensten: AI-agents, automatisering en Claude Team | Veryo', 'veryo' ),
		'desc'      => __( 'Alle diensten van Veryo: AI-agents, automatiseringen, de AI-werkplek met Claude Team en de administratieve kringloop, bovenop jullie eigen software.', 'veryo' ),
		'kw'        => 'ai diensten technische bedrijven',
		'schema'    => array(
			'type' => 'service',
			'area' => 'Nederland',
		),
		'content'   => $veryo_diensten,
	),
);
