/**
 * Homepage: de workflow in de hero en de demo's. Zonder JavaScript staat alles gewoon zichtbaar.
 * Houdt rekening met prefers-reduced-motion: dan geen animatie, alle stappen direct zichtbaar.
 */
( function () {
	'use strict';

	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* Hero: de stappen lichten een voor een op. */
	document.querySelectorAll( '[data-flow]' ).forEach( function ( flow ) {
		var steps = flow.querySelectorAll( '.veryo-flow__step' );
		if ( ! steps.length || reduce ) {
			return;
		}
		flow.classList.add( 'is-animated' );
		var i = 0;
		var timer = null;
		function tick() {
			steps.forEach( function ( s, n ) {
				s.classList.toggle( 'is-done', n < i );
				s.classList.toggle( 'is-active', n === i );
			} );
			i = ( i + 1 ) % ( steps.length + 2 );
		}
		function start() {
			if ( ! timer ) {
				tick();
				timer = window.setInterval( tick, 1400 );
			}
		}
		function stop() {
			window.clearInterval( timer );
			timer = null;
		}
		if ( 'IntersectionObserver' in window ) {
			new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( e ) {
					if ( e.isIntersecting ) {
						start();
					} else {
						stop();
					}
				} );
			} ).observe( flow );
		} else {
			start();
		}
	} );

	/* Demo's: tabs en stap voor stap afspelen. */
	document.querySelectorAll( '[data-demos]' ).forEach( function ( root ) {
		var tablist = root.querySelector( '[role="tablist"]' );
		var tabs = Array.prototype.slice.call( root.querySelectorAll( '[role="tab"]' ) );
		var panes = Array.prototype.slice.call( root.querySelectorAll( '[role="tabpanel"]' ) );
		if ( ! tablist || ! tabs.length ) {
			return;
		}
		root.classList.add( 'is-enhanced' );
		tablist.hidden = false;

		function select( index, focus ) {
			tabs.forEach( function ( t, n ) {
				var on = n === index;
				t.setAttribute( 'aria-selected', on ? 'true' : 'false' );
				t.tabIndex = on ? 0 : -1;
				panes[ n ].hidden = ! on;
			} );
			if ( focus ) {
				tabs[ index ].focus();
			}
		}
		tabs.forEach( function ( tab, n ) {
			tab.addEventListener( 'click', function () {
				select( n, false );
			} );
			tab.addEventListener( 'keydown', function ( e ) {
				var next = null;
				if ( 'ArrowRight' === e.key ) {
					next = ( n + 1 ) % tabs.length;
				} else if ( 'ArrowLeft' === e.key ) {
					next = ( n - 1 + tabs.length ) % tabs.length;
				} else if ( 'Home' === e.key ) {
					next = 0;
				} else if ( 'End' === e.key ) {
					next = tabs.length - 1;
				}
				if ( null !== next ) {
					e.preventDefault();
					select( next, true );
				}
			} );
		} );
		select( 0, false );

		panes.forEach( function ( pane ) {
			var button = pane.querySelector( '.veryo-demo__play' );
			var steps = pane.querySelectorAll( '.veryo-demo__step' );
			if ( ! button ) {
				return;
			}
			button.hidden = false;
			if ( ! reduce ) {
				pane.classList.add( 'is-waiting' );
			}
			button.addEventListener( 'click', function () {
				if ( reduce ) {
					return;
				}
				pane.classList.remove( 'is-waiting' );
				steps.forEach( function ( s ) {
					s.classList.remove( 'is-shown' );
				} );
				steps.forEach( function ( s, n ) {
					window.setTimeout( function () {
						s.classList.add( 'is-shown' );
					}, 500 * ( n + 1 ) );
				} );
				button.textContent = button.getAttribute( 'data-again' ) || button.textContent;
			} );
		} );
	} );
}() );
