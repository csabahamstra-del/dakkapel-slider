<?php
/**
 * Interactieve demo's op de homepage: [veryo_demos]. Alles is voorbeelddata in de browser; er is
 * geen koppeling met een echt systeem en dat staat er ook bij. Zonder JavaScript staan alle demo's
 * gewoon onder elkaar, met alle stappen zichtbaar.
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

/**
 * De demo's: titel, wat er binnenkomt, de stappen en wat de mens doet.
 *
 * @return array<string,array<string,mixed>>
 */
function veryo_demos() {
	return apply_filters(
		'veryo_demos',
		array(
			'offerte'  => array(
				'tab'   => __( 'Offerteassistent', 'veryo' ),
				'link'  => array( 'ai-automatisering/offertes-en-calculaties', __( 'Meer over offertes automatiseren', 'veryo' ) ),
				'in_h'  => __( 'Binnengekomen mail', 'veryo' ),
				'in'    => __( '“Goedemiddag, wij willen graag een offerte voor het vervangen van de kozijnen aan de achterkant van ons kantoor. Foto’s zitten in de bijlage. Groet, J. de Vries”', 'veryo' ),
				'steps' => array(
					array( __( 'Aanvraag gelezen', 'veryo' ), __( 'Soort klus: kozijnen vervangen. Klant en adres herkend uit de mail.', 'veryo' ) ),
					array( __( 'Ontbrekende gegevens', 'veryo' ), __( 'Maten en aantal kozijnen ontbreken. Er staat een conceptmail klaar met die vragen.', 'veryo' ) ),
					array( __( 'Conceptofferte', 'veryo' ), __( 'Opzet in jullie eigen sjabloon, met posten uit jullie prijslijst.', 'veryo' ) ),
				),
				'human' => __( 'De calculator controleert prijzen en aantallen en verstuurt de offerte.', 'veryo' ),
			),
			'telefoon' => array(
				'tab'   => __( 'Telefonist', 'veryo' ),
				'link'  => array( 'ai-op-maat', __( 'Meer over AI-automatisering op maat', 'veryo' ) ),
				'in_h'  => __( 'Telefoontje na sluitingstijd', 'veryo' ),
				'in'    => __( 'De assistent meldt dat de beller met een digitale assistent spreekt. Beller: “Ik heb een lekkage bij de cv-ketel, kan er morgen iemand komen?”', 'veryo' ),
				'steps' => array(
					array( __( 'Vraag begrepen', 'veryo' ), __( 'Storing aan de cv-ketel, verzoek om een bezoek.', 'veryo' ) ),
					array( __( 'Gegevens gevraagd', 'veryo' ), __( 'Naam, adres en terugbelnummer genoteerd. Gevraagd of er direct gevaar is.', 'veryo' ) ),
					array( __( 'Terugbelverzoek', 'veryo' ), __( 'Klaargezet voor de planning, met een korte samenvatting van het gesprek.', 'veryo' ) ),
				),
				'human' => __( 'De planner belt de volgende ochtend terug en plant de monteur in.', 'veryo' ),
			),
			'document' => array(
				'tab'   => __( 'Documentverwerker', 'veryo' ),
				'link'  => array( 'oplossingen/inkoopfacturen-automatiseren', __( 'Meer over facturen automatiseren', 'veryo' ) ),
				'in_h'  => __( 'Inkoopfactuur (pdf) in de mailbox', 'veryo' ),
				'in'    => __( 'Factuur van Voorbeeldleverancier BV, met zes regels materiaal en een projectreferentie.', 'veryo' ),
				'steps' => array(
					array( __( 'Uitgelezen', 'veryo' ), __( 'Leverancier, factuurnummer, regels, btw en projectreferentie herkend.', 'veryo' ) ),
					array( __( 'Gecontroleerd', 'veryo' ), __( 'Vergeleken met de inkooporder: één regel heeft een hogere prijs dan afgesproken.', 'veryo' ) ),
					array( __( 'Gemarkeerd', 'veryo' ), __( 'Als concept klaargezet in de boekhouding, met de afwijking duidelijk aangegeven.', 'veryo' ) ),
				),
				'human' => __( 'De administratie bekijkt de afwijking en keurt de factuur goed of vraagt een creditnota.', 'veryo' ),
			),
			'lead'     => array(
				'tab'   => __( 'Leadopvolging', 'veryo' ),
				'link'  => array( 'oplossingen/ai-lead-opvolging', __( 'Meer over leadopvolging', 'veryo' ) ),
				'in_h'  => __( 'Nieuwe aanvraag via het websiteformulier', 'veryo' ),
				'in'    => __( '“Graag informatie over een nieuwe badkamer.” Naam en telefoonnummer ingevuld, verder niets.', 'veryo' ),
				'steps' => array(
					array( __( 'Snel contact', 'veryo' ), __( 'Binnen enkele minuten een WhatsApp-bericht met een paar vragen.', 'veryo' ) ),
					array( __( 'Vragen gesteld', 'veryo' ), __( 'Wat moet er gebeuren, wanneer, en in welke plaats? De antwoorden worden vastgelegd.', 'veryo' ) ),
					array( __( 'Afspraakvoorstel', 'veryo' ), __( 'Twee momenten voorgesteld uit jullie agenda voor een inmeting.', 'veryo' ) ),
				),
				'human' => __( 'Jullie zien de lead met alle antwoorden en bevestigen de afspraak.', 'veryo' ),
			),
			'kennis'   => array(
				'tab'   => __( 'Kennisbank', 'veryo' ),
				'link'  => array( veryo_collega()['slug'], __( 'Meer over Veryo Collega', 'veryo' ) ),
				'in_h'  => __( 'Vraag van een collega', 'veryo' ),
				'in'    => __( '“Welke onderhoudsinterval geldt voor dit type installatie?”', 'veryo' ),
				'steps' => array(
					array( __( 'Gezocht', 'veryo' ), __( 'In jullie eigen werkinstructies en eerdere projecten.', 'veryo' ) ),
					array( __( 'Antwoord met bron', 'veryo' ), __( 'Het antwoord, met een verwijzing naar het document en de pagina waar het staat.', 'veryo' ) ),
					array( __( 'Twijfel gemeld', 'veryo' ), __( 'Staat het nergens, dan zegt de assistent dat, in plaats van een antwoord te verzinnen.', 'veryo' ) ),
				),
				'human' => __( 'Bij twijfel vraagt de collega het na bij de vakspecialist.', 'veryo' ),
			),
		)
	);
}

/**
 * Shortcode [veryo_demos].
 *
 * @return string
 */
function veryo_sc_demos() {
	$demos = veryo_demos();
	$tabs  = '';
	$panes = '';
	$i     = 0;
	foreach ( $demos as $key => $d ) {
		$id    = 'veryo-demo-' . $key;
		$tabs .= '<button type="button" role="tab" class="veryo-demos__tab" id="' . esc_attr( $id ) . '-tab" aria-controls="' . esc_attr( $id ) . '" aria-selected="' . ( 0 === $i ? 'true' : 'false' ) . '"' . ( 0 === $i ? '' : ' tabindex="-1"' ) . '>' . esc_html( $d['tab'] ) . '</button>';
		$steps = '';
		foreach ( $d['steps'] as $n => $step ) {
			$steps .= '<li class="veryo-demo__step"><span class="veryo-demo__num" aria-hidden="true">' . ( (int) $n + 1 ) . '</span><span><strong>' . esc_html( $step[0] ) . '</strong> ' . esc_html( $step[1] ) . '</span></li>';
		}
		$steps .= '<li class="veryo-demo__step veryo-demo__step--human"><span class="veryo-demo__num" aria-hidden="true">' . veryo_icon( 'users' ) . '</span><span><strong>' . esc_html__( 'Een mens beslist', 'veryo' ) . '</strong> ' . esc_html( $d['human'] ) . '</span></li>';
		$panes .= '<div class="veryo-demo" role="tabpanel" id="' . esc_attr( $id ) . '" aria-labelledby="' . esc_attr( $id ) . '-tab">'
			. '<h3 class="veryo-demo__title">' . esc_html( $d['tab'] ) . '</h3>'
			. '<div class="veryo-demo__in"><p class="veryo-demo__label">' . esc_html( $d['in_h'] ) . '</p><p>' . esc_html( $d['in'] ) . '</p></div>'
			. '<ol class="veryo-demo__steps">' . $steps . '</ol>'
			. '<p class="veryo-demo__foot"><button type="button" class="veryo-demo__play" data-again="' . esc_attr__( 'Nog een keer afspelen', 'veryo' ) . '" hidden>' . esc_html__( 'Speel de demo af', 'veryo' ) . '</button>'
			. '<a href="' . esc_url( veryo_link( $d['link'][0] ) ) . '">' . esc_html( $d['link'][1] ) . '</a></p>'
			. '</div>';
		++$i;
	}
	return '<div class="veryo-demos" data-demos>'
		. '<p class="veryo-demos__notice">' . esc_html__( 'Demo met voorbeelddata. Er is geen koppeling met een echt systeem; namen en gegevens zijn verzonnen.', 'veryo' ) . '</p>'
		. '<div class="veryo-demos__tabs" role="tablist" aria-label="' . esc_attr__( 'Kies een demo', 'veryo' ) . '" hidden>' . $tabs . '</div>'
		. $panes
		. '</div>';
}
add_shortcode( 'veryo_demos', 'veryo_sc_demos' );
