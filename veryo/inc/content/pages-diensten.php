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
		'ai-implementatie-mkb'            => __( 'AI implementatie in het mkb', 'veryo' ),
		'ai-startpakket'                  => __( 'Bekijk Veryo Start', 'veryo' ),
		'veilig-ai-gebruik'               => __( 'Meer over de AI-veiligheidscheck', 'veryo' ),
		'ai-partner'                      => __( 'Bekijk Veryo Partner', 'veryo' ),
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
		'answer_cta' => array( __( 'Doe de gratis AI-scan', 'veryo' ), veryo_link( 'waar-begin-ik-met-ai' ), 'amber' ),
		'answer'     => __( 'Veryo helpt mkb-bedrijven AI praktisch inzetten: we ontdekken waar AI tijd bespaart, bouwen en richten de oplossing in bovenop de software die jullie al gebruiken, en zorgen dat het blijft werken. Hieronder staan onze diensten in vijf categorieën. Voor elke dienst krijg je vooraf een gratis offerte met een vaste prijs. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
		'sections'   => array(
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( '1. AI-strategie: weten waar je begint', 'veryo' ) )
					. veryo_b_p( __( 'Voor bedrijven die AI goed willen introduceren en eerst willen weten waar het iets oplevert.', 'veryo' ) )
					. $veryo_dienst(
						'ai-implementatie-mkb',
						__( 'AI-kansensessie', 'veryo' ),
						__( 'Een dagdeel samen jullie processen doorlopen: waar gaat de tijd heen, welke software gebruiken jullie al en wat levert AI daar op.', 'veryo' ),
						array(
							__( 'Analyse van jullie bedrijfsprocessen.', 'veryo' ),
							__( 'AI-kansen op volgorde van opbrengst, met een inschatting van tijdwinst waar dat kan.', 'veryo' ),
							__( 'Concreet advies over tools en de eerste stap.', 'veryo' ),
						)
					)
					. $veryo_dienst(
						'ai-startpakket',
						__( 'Veryo Start: het AI-Startpakket', 'veryo' ),
						__( 'In één keer een goede basis: kansensessie, AI-beleid, één toepassing gebouwd of ingericht en 30 dagen nazorg.', 'veryo' ),
						array(
							__( 'AI-scan en kansensessie.', 'veryo' ),
							__( 'Een AI-beleid van één à twee pagina’s.', 'veryo' ),
							__( 'Eén toepassing gebouwd of ingericht, en jullie team ermee leren werken.', 'veryo' ),
							__( '30 dagen nazorg en een plan voor de volgende stap.', 'veryo' ),
						)
					),
					array( 'className' => 'veryo-section veryo-diensten' )
				),
			),
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( '2. AI-werkplek: AI dat jullie werk kent', 'veryo' ) )
					. $veryo_dienst(
						'ai-werkplek',
						__( 'AI-werkplek met Claude Team', 'veryo' ),
						__( 'Claude ingericht met jullie eigen normen, kengetallen, sjablonen en documenten. De licenties sluiten jullie zelf af bij Anthropic.', 'veryo' ),
						array(
							__( 'Projecten met jullie eigen documenten en vaste instructies.', 'veryo' ),
							__( 'Afspraken over veilig gebruik, rollen en rechten.', 'veryo' ),
							__( 'Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
						)
					),
					array( 'className' => 'veryo-section veryo-diensten' )
				),
			),
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( '3. AI-automatisering: werk dat vanzelf gaat', 'veryo' ) )
					. veryo_b_p( __( 'Van één afgebakende automatisering tot een project met meerdere koppelingen. De prijs hangt af van de complexiteit, de software, de koppelingen en de omvang; dat staat vooraf in de offerte.', 'veryo' ) )
					. $veryo_dienst(
						'ai-automatisering',
						__( 'Veryo Automation', 'veryo' ),
						__( 'Koppelingen en AI bovenop de software die jullie al gebruiken, zodat niemand meer gegevens overtypt.', 'veryo' ),
						array(
							__( 'Quick win: één afgebakende taak, meestal binnen een paar weken live.', 'veryo' ),
							__( 'Implementatieproject: meerdere stappen of systemen.', 'veryo' ),
							__( 'Maatwerk: als geen bestaande oplossing past.', 'veryo' ),
							__( 'Voorbeelden: offertes, facturen, e-mail, documenten, klantenservice, CRM, leadopvolging, planning en rapportage.', 'veryo' ),
						)
					)
					. $veryo_dienst(
						'ai-automatisering/administratie',
						__( 'De administratieve kringloop', 'veryo' ),
						__( 'Van uren en werkbonnen tot factuur en salarisadministratie, bovenop het pakket dat jullie al hebben.', 'veryo' ),
						array(
							__( 'Uren en werkbonnen inlezen, als foto, via WhatsApp of een formulier.', 'veryo' ),
							__( 'Inkoopfacturen aan projecten koppelen en in de boekhouding zetten.', 'veryo' ),
							__( 'Weekafsluiting met conceptfacturen, en begroot naast werkelijk per project.', 'veryo' ),
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
					),
					array( 'className' => 'veryo-section veryo-diensten' )
				),
			),
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( '4. AI-veiligheid: verantwoord gebruik', 'veryo' ) )
					. $veryo_dienst(
						'veilig-ai-gebruik',
						__( 'AI-veiligheidscheck', 'veryo' ),
						__( 'Hoe wordt AI nu gebruikt in jullie bedrijf, en wat is er nodig om dat veilig te doen? Je krijgt een rapport met concrete acties. Dit is geen juridische toets.', 'veryo' ),
						array(
							__( 'AI-gebruik, gegevens en privacy in kaart.', 'veryo' ),
							__( 'Risico’s en praktische richtlijnen.', 'veryo' ),
							__( 'Een AI-beleid, en wat de AI Act vraagt over AI-geletterdheid.', 'veryo' ),
						)
					),
					array( 'className' => 'veryo-section veryo-diensten' )
				),
			),
			array(
				'html' => veryo_b_group(
					veryo_b_h( __( '5. AI-partner: structureel verder', 'veryo' ) )
					. $veryo_dienst(
						'ai-partner',
						__( 'Veryo Partner', 'veryo' ),
						__( 'Doorlopende begeleiding in één abonnement, zodat het niet stilvalt na de eerste maand. Er zijn niveaus op basis van jullie teamgrootte; de verschillen staan op de pagina.', 'veryo' ),
						array(
							__( 'Support, monitoring en periodieke evaluatie.', 'veryo' ),
							__( 'Elke maand uren voor verbeteringen en nieuwe automatiseringen.', 'veryo' ),
							__( 'Nieuwe medewerkers leren werken met wat is ingericht.', 'veryo' ),
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
					'<strong>' . __( 'Ontdek.', 'veryo' ) . '</strong> ' . __( 'We beginnen bij jullie werk en de software die jullie al gebruiken.', 'veryo' ),
					'<strong>' . __( 'Adviseer.', 'veryo' ) . '</strong> ' . __( 'We kiezen samen wat echt waarde oplevert.', 'veryo' ),
					'<strong>' . __( 'Implementeer.', 'veryo' ) . '</strong> ' . __( 'In jullie eigen accounts, getest met echte gegevens voordat het live gaat. Na de oplevering leren we jullie team ermee werken.', 'veryo' ),
					'<strong>' . __( 'Verbeter.', 'veryo' ) . '</strong> ' . __( 'We houden in de gaten of alles blijft werken en verbeteren waar het kan.', 'veryo' ),
				),
				'style' => 'checks',
			),
		),
		'no_steps'   => true,
		'contact'    => array(
			__( 'Welk werk kost jullie de meeste tijd?', 'veryo' ),
			__( 'Beschrijf kort wat er steeds terugkomt. Je hoort binnen één werkdag welke dienst past en wat de volgende stap is.', 'veryo' ),
			__( 'Bijvoorbeeld: onze werkbonnen komen op papier binnen en worden met de hand overgetypt. Kan dat anders?', 'veryo' ),
		),
		'faq'        => array(
			array( __( 'Welke dienst past bij ons?', 'veryo' ), __( 'Weet je nog niet waar je begint, dan past Veryo Start of een kansensessie. Weet je welk werk te veel tijd kost, dan past een automatisering. Draait er al iets, dan helpt Veryo Partner. De gratis AI-scan geeft een eerste richting.', 'veryo' ) ),
			array( __( 'Wat kost het?', 'veryo' ), __( 'Dat hangt af van de dienst, de software en de omvang. Je krijgt altijd eerst een gratis offerte met een vaste prijs.', 'veryo' ) ),
			array( __( 'Geven jullie ook AI-trainingen?', 'veryo' ), __( 'Niet als los product. Wel leren we na de oplevering jullie team werken met wat we hebben gebouwd of ingericht.', 'veryo' ) ),
			array( __( 'Moeten we andere software gaan gebruiken?', 'veryo' ), __( 'Nee. Veryo bouwt geen nieuwe software. We bouwen bovenop wat jullie al hebben; overstappen is nooit nodig.', 'veryo' ) ),
			array( __( 'Wie is verantwoordelijk voor de uitkomst?', 'veryo' ), __( 'Jullie medewerkers. AI bereidt voor en controleert; beslissingen blijven bij een mens.', 'veryo' ) ),
		),
		'cta_demo'   => true,
		'cta'        => array( __( 'Plan een vrijblijvende kennismaking', 'veryo' ), __( 'We kijken samen naar één proces en vertellen eerlijk of AI daar iets oplevert.', 'veryo' ) ),
		'links'      => array(
			array( 'oplossingen', __( 'Kant-en-klare oplossingen', 'veryo' ), __( 'Vaste toepassingen voor veelvoorkomend werk', 'veryo' ) ),
			array( 'branches', __( 'AI per branche', 'veryo' ), __( 'Voorbeelden uit jullie sector', 'veryo' ) ),
			array( 'prijzen', __( 'Prijzen en offerte', 'veryo' ), __( 'Hoe de offerte werkt', 'veryo' ) ),
			array( 'waar-begin-ik-met-ai', __( 'Gratis AI-scan', 'veryo' ), __( 'In drie minuten een eerste richting', 'veryo' ) ),
		),
	)
);

return array(
	'diensten' => array(
		'title'       => __( 'Diensten: AI voor het mkb, van advies tot automatisering', 'veryo' ),
		'force_title' => true,
		'seo_title'   => __( 'Diensten: van AI-advies tot automatisering | Veryo', 'veryo' ),
		'desc'        => __( 'Alle diensten van Veryo: AI-kansensessie, AI-Startpakket, AI-werkplek, automatisering, AI-veiligheidscheck en AI-partner. Vooraf een vaste prijs.', 'veryo' ),
		'kw'          => 'ai diensten technische bedrijven',
		'schema'      => array(
			'type' => 'service',
			'area' => 'Nederland',
		),
		'content'     => $veryo_diensten,
	),
);
