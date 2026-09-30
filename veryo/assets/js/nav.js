/* Veryo: mobiel menu en toegankelijke submenu's. */
( function () {
	'use strict';

	var header = document.querySelector( '.site-header' );
	if ( ! header ) {
		return;
	}
	var toggle = header.querySelector( '.nav-toggle' );
	var nav = header.querySelector( '.site-nav' );

	function closeSubs( except ) {
		header.querySelectorAll( '.has-sub.is-open' ).forEach( function ( li ) {
			if ( li !== except ) {
				li.classList.remove( 'is-open' );
				var btn = li.querySelector( '.nav-toggle-sub' );
				if ( btn ) {
					btn.setAttribute( 'aria-expanded', 'false' );
				}
			}
		} );
	}

	function setMenu( open ) {
		header.classList.toggle( 'nav-open', open );
		if ( toggle ) {
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		}
		if ( ! open ) {
			closeSubs();
		}
	}

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			setMenu( ! header.classList.contains( 'nav-open' ) );
		} );
	}

	header.querySelectorAll( '.nav-toggle-sub' ).forEach( function ( btn ) {
		btn.addEventListener( 'click', function ( event ) {
			event.preventDefault();
			var li = btn.closest( '.has-sub' );
			var open = ! li.classList.contains( 'is-open' );
			closeSubs( li );
			li.classList.toggle( 'is-open', open );
			btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' !== event.key ) {
			return;
		}
		var openSub = header.querySelector( '.has-sub.is-open' );
		if ( openSub ) {
			var btn = openSub.querySelector( '.nav-toggle-sub' );
			closeSubs();
			if ( btn ) {
				btn.focus();
			}
			return;
		}
		if ( header.classList.contains( 'nav-open' ) ) {
			setMenu( false );
			if ( toggle ) {
				toggle.focus();
			}
		}
	} );

	document.addEventListener( 'click', function ( event ) {
		if ( ! header.contains( event.target ) ) {
			closeSubs();
		}
	} );

	// Submenu sluiten als de focus het submenu verlaat (toetsenbord).
	header.querySelectorAll( '.has-sub' ).forEach( function ( li ) {
		li.addEventListener( 'focusout', function ( event ) {
			if ( event.relatedTarget && ! li.contains( event.relatedTarget ) ) {
				li.classList.remove( 'is-open' );
				var btn = li.querySelector( '.nav-toggle-sub' );
				if ( btn ) {
					btn.setAttribute( 'aria-expanded', 'false' );
				}
			}
		} );
	} );

	// Op grote schermen: submenu ook openen met de muis.
	var desktop = window.matchMedia( '(hover: hover) and (min-width: 1100px)' );
	header.querySelectorAll( '.has-sub' ).forEach( function ( li ) {
		var btn = li.querySelector( '.nav-toggle-sub' );
		li.addEventListener( 'mouseenter', function () {
			if ( desktop.matches && btn ) {
				closeSubs( li );
				li.classList.add( 'is-open' );
				btn.setAttribute( 'aria-expanded', 'true' );
			}
		} );
		li.addEventListener( 'mouseleave', function () {
			if ( desktop.matches && btn ) {
				li.classList.remove( 'is-open' );
				btn.setAttribute( 'aria-expanded', 'false' );
			}
		} );
	} );
}() );
