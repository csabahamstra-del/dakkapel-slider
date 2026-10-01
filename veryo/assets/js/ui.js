/* Veryo: kleine interacties die altijd werken (ook zonder animaties). Zonder JavaScript blijft alle inhoud gewoon zichtbaar. */
( function () {
	'use strict';

	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var root = document.documentElement;

	/* FAQ: vloeiend open en dicht via grid-template-rows, aria-expanded op de vraag. */
	document.querySelectorAll( '.wp-block-details' ).forEach( function ( details ) {
		var summary = details.querySelector( 'summary' );
		if ( ! summary || details.querySelector( '.faq-panel' ) ) {
			return;
		}
		var panel = document.createElement( 'div' );
		var inner = document.createElement( 'div' );
		panel.className = 'faq-panel';
		panel.appendChild( inner );
		Array.prototype.slice.call( details.childNodes ).forEach( function ( node ) {
			if ( node !== summary ) {
				inner.appendChild( node );
			}
		} );
		details.appendChild( panel );
		summary.setAttribute( 'aria-expanded', details.open ? 'true' : 'false' );
		if ( details.open ) {
			details.classList.add( 'is-open' );
		}
		summary.addEventListener( 'click', function ( event ) {
			event.preventDefault();
			if ( details.classList.contains( 'is-open' ) ) {
				details.classList.remove( 'is-open' );
				summary.setAttribute( 'aria-expanded', 'false' );
				var close = function () {
					if ( ! details.classList.contains( 'is-open' ) ) {
						details.open = false;
					}
				};
				if ( reduce ) {
					close();
				} else {
					window.setTimeout( close, 360 );
				}
			} else {
				details.open = true;
				summary.setAttribute( 'aria-expanded', 'true' );
				window.requestAnimationFrame( function () {
					window.requestAnimationFrame( function () {
						details.classList.add( 'is-open' );
					} );
				} );
			}
		} );
	} );

	/* Prijsschakelaar per teamgrootte, met een korte telanimatie. */
	var euro = function ( n ) {
		return '€' + Math.round( n ).toString().replace( /\B(?=(\d{3})+(?!\d))/g, '.' );
	};
	document.querySelectorAll( '.veryo-price-switch' ).forEach( function ( box, index ) {
		var rows = box.querySelectorAll( '.veryo-tiers li' );
		if ( rows.length < 2 ) {
			return;
		}
		var group = document.createElement( 'div' );
		group.className = 'veryo-switch';
		group.setAttribute( 'role', 'group' );
		group.setAttribute( 'aria-label', 'Teamgrootte' );
		var price = document.createElement( 'p' );
		price.className = 'veryo-switch__price';
		price.setAttribute( 'aria-live', 'polite' );
		var current = 0;
		var buttons = [];
		rows.forEach( function ( row, i ) {
			var label = row.querySelector( 'span' );
			var amount = row.querySelector( '[data-price]' );
			if ( ! label || ! amount ) {
				return;
			}
			var button = document.createElement( 'button' );
			button.type = 'button';
			button.textContent = label.textContent;
			button.setAttribute( 'aria-pressed', 0 === i ? 'true' : 'false' );
			button.dataset.price = amount.getAttribute( 'data-price' );
			button.id = 'veryo-switch-' + index + '-' + i;
			button.addEventListener( 'click', function () {
				buttons.forEach( function ( b ) {
					b.setAttribute( 'aria-pressed', b === button ? 'true' : 'false' );
				} );
				var to = parseInt( button.dataset.price, 10 );
				var from = current;
				current = to;
				if ( reduce ) {
					price.textContent = euro( to );
					return;
				}
				var start = null;
				var step = function ( t ) {
					if ( null === start ) {
						start = t;
					}
					var p = Math.min( 1, ( t - start ) / 500 );
					var eased = 1 - Math.pow( 1 - p, 3 );
					price.textContent = euro( from + ( to - from ) * eased );
					if ( p < 1 ) {
						window.requestAnimationFrame( step );
					}
				};
				window.requestAnimationFrame( step );
			} );
			buttons.push( button );
			group.appendChild( button );
		} );
		if ( buttons.length < 2 ) {
			return;
		}
		current = parseInt( buttons[ 0 ].dataset.price, 10 );
		price.textContent = euro( current );
		var list = box.querySelector( '.veryo-tiers' );
		list.parentNode.insertBefore( group, list );
		list.parentNode.insertBefore( price, list );
		box.classList.add( 'is-enhanced' );
	} );

	/* Marquee: inhoud verdubbelen zodat de band naadloos doorloopt. Alleen met beweging. */
	if ( root.classList.contains( 'has-motion' ) && ! reduce ) {
		document.querySelectorAll( '.veryo-marquee' ).forEach( function ( band ) {
			var list = band.querySelector( '.veryo-marquee__list' );
			if ( ! list ) {
				return;
			}
			var track = document.createElement( 'div' );
			track.className = 'veryo-marquee__track';
			list.parentNode.insertBefore( track, list );
			track.appendChild( list );
			var copy = list.cloneNode( true );
			copy.setAttribute( 'aria-hidden', 'true' );
			track.appendChild( copy );
			band.classList.add( 'is-running' );
		} );
	}

	/* Sticky CTA op mobiel: zichtbaar na de hero, weg boven de footer. */
	var sticky = document.querySelector( '.veryo-sticky-cta' );
	var hero = document.querySelector( '.veryo-hero' ) || document.querySelector( '.page-header' );
	var footer = document.querySelector( '.site-footer' );
	if ( sticky && 'IntersectionObserver' in window ) {
		sticky.hidden = false;
		var pastHero = false;
		var nearFooter = false;
		var update = function () {
			var show = pastHero && ! nearFooter;
			sticky.classList.toggle( 'is-visible', show );
			sticky.setAttribute( 'tabindex', show ? '0' : '-1' );
			sticky.setAttribute( 'aria-hidden', show ? 'false' : 'true' );
			document.body.classList.toggle( 'has-sticky-cta', show );
		};
		if ( hero ) {
			new IntersectionObserver( function ( entries ) {
				pastHero = ! entries[ 0 ].isIntersecting && entries[ 0 ].boundingClientRect.top < 0;
				update();
			} ).observe( hero );
		} else {
			pastHero = true;
		}
		if ( footer ) {
			new IntersectionObserver( function ( entries ) {
				nearFooter = entries[ 0 ].isIntersecting;
				update();
			} ).observe( footer );
		}
		update();
	}
}() );
