<?php
/**
 * Herbruikbaar blok over Veryo Collega. Invoegen met get_template_part( 'template-parts/collega-blok' )
 * of in de editor met de shortcode [veryo_collega_blok] (variant=regio regio=friesland, of variant=intern).
 *
 * @package Veryo
 */

defined( 'ABSPATH' ) || exit;

$veryo_cc      = veryo_collega();
$veryo_variant = isset( $args['variant'] ) ? (string) $args['variant'] : 'standaard';
$veryo_regions = array(
	'friesland'  => 'Friesland',
	'groningen'  => 'Groningen',
	'drenthe'    => 'Drenthe',
	'leeuwarden' => 'Leeuwarden',
);
$veryo_region  = isset( $args['regio'], $veryo_regions[ $args['regio'] ] ) ? $veryo_regions[ $args['regio'] ] : '';

if ( 'regio' === $veryo_variant && $veryo_region ) {
	/* translators: %s: regio. */
	$veryo_title = sprintf( __( 'Lokale AI voor bedrijven in %s. Wij installeren hem bij je op kantoor.', 'veryo' ), $veryo_region );
	/* translators: 1: productnaam, 2: regio. */
	$veryo_text = sprintf( __( 'Met %1$s krijg je een AI-collega die op een eigen machine bij jou op kantoor draait en alles weet van je bedrijf. We komen langs in %2$s om hem te installeren, in te richten en te vullen met de kennis van je team. Je gegevens verlaten het pand niet voor AI-verwerking.', 'veryo' ), $veryo_cc['naam'], $veryo_region );
	/* translators: %s: regio. */
	$veryo_more = sprintf( __( 'Lokale AI in %s bekijken', 'veryo' ), $veryo_region );
} elseif ( 'intern' === $veryo_variant ) {
	$veryo_title = __( 'Liever een assistent die op je eigen kantoor draait?', 'veryo' );
	/* translators: %s: productnaam. */
	$veryo_text = sprintf( __( '%s is onze vaste uitvoering van een interne AI-assistent: op een eigen machine bij jou op kantoor, gevuld met de kennis van je bedrijf en beheerd door Veryo. Je gegevens gaan niet naar een externe AI-dienst.', 'veryo' ), $veryo_cc['naam'] );
	/* translators: %s: productnaam. */
	$veryo_more = sprintf( __( 'Bekijk %s', 'veryo' ), $veryo_cc['naam'] );
} else {
	$veryo_title = __( 'Alles wat je bedrijf weet, in één AI-collega op je eigen kantoor.', 'veryo' );
	/* translators: %s: productnaam. */
	$veryo_text = sprintf( __( '%s beantwoordt vragen van je medewerkers uit jullie eigen documenten en systemen. Hij draait op een eigen machine bij jou op kantoor, dus je gegevens verlaten het pand niet voor AI-verwerking.', 'veryo' ), $veryo_cc['naam'] );
	/* translators: %s: productnaam. */
	$veryo_more = sprintf( __( 'Meer over %s', 'veryo' ), $veryo_cc['naam'] );
}
?>
<aside class="veryo-collega-blok" aria-label="<?php echo esc_attr( $veryo_cc['naam'] ); ?>">
	<div class="veryo-collega-blok__text">
		<p class="veryo-kicker"><?php echo esc_html( $veryo_cc['naam'] ); ?></p>
		<h2><?php echo esc_html( $veryo_title ); ?></h2>
		<p><?php echo esc_html( $veryo_text ); ?></p>
		<ul class="veryo-collega-blok__points">
			<li><?php esc_html_e( 'Kent je documenten, mail en systemen', 'veryo' ); ?></li>
			<li><?php esc_html_e( 'Werkt zelfs zonder internet', 'veryo' ); ?></li>
			<?php /* translators: %s: maandprijs. */ ?>
			<li><?php echo esc_html( sprintf( __( 'Vanaf %s per maand, exclusief btw', 'veryo' ), veryo_collega_euro( reset( $veryo_cc['pakketten'] )['prijs'] ) ) ); ?></li>
		</ul>
		<div class="veryo-cta-buttons">
			<a class="btn btn--amber" href="<?php echo esc_url( veryo_collega_url( 'demo' ) ); ?>"><?php echo esc_html( $veryo_cc['cta_primair'] ); ?></a>
			<a class="btn btn--link" href="<?php echo esc_url( veryo_collega_url() ); ?>"><?php echo esc_html( $veryo_more ); ?></a>
		</div>
	</div>
	<?php echo veryo_sc_collega_visual( array( 'type' => 'kastje' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- statische SVG, ge-escaped opgebouwd. ?>
</aside>
