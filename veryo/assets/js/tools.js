/**
 * Tools & koppelingen: live zoeken en filteren op categorie, zonder herladen. Zonder
 * JavaScript staan alle tools gewoon op de pagina.
 */
( function () {
	'use strict';

	document.querySelectorAll( '[data-veryo-tools]' ).forEach( function ( root ) {
		var input = root.querySelector( '[data-tools-search]' );
		var buttons = Array.prototype.slice.call( root.querySelectorAll( '[data-tools-filter]' ) );
		var groups = Array.prototype.slice.call( root.querySelectorAll( '[data-tools-group]' ) );
		var empty = root.querySelector( '[data-tools-empty]' );
		var count = root.querySelector( '[data-tools-count]' );
		var filter = 'alles';

		function normalize( text ) {
			return ( text || '' ).toLowerCase().normalize( 'NFD' ).replace( /[̀-ͯ]/g, '' ).trim();
		}

		function apply() {
			var query = normalize( input ? input.value : '' );
			var shown = 0;
			groups.forEach( function ( group ) {
				var inFilter = 'alles' === filter || group.getAttribute( 'data-tools-group' ) === filter;
				var visible = 0;
				group.querySelectorAll( '.veryo-tool-card' ).forEach( function ( card ) {
					var haystack = normalize( card.getAttribute( 'data-tool-name' ) );
					var match = inFilter && ( '' === query || -1 !== haystack.indexOf( query ) );
					card.hidden = ! match;
					if ( match ) {
						visible++;
					}
				} );
				group.hidden = 0 === visible;
				shown += visible;
			} );
			if ( empty ) {
				empty.hidden = shown > 0;
			}
			if ( count ) {
				count.textContent = ( '' === query && 'alles' === filter ) ? '' : ( 1 === shown ? '1 tool gevonden' : shown + ' tools gevonden' );
			}
		}

		buttons.forEach( function ( button ) {
			button.addEventListener( 'click', function () {
				filter = button.getAttribute( 'data-tools-filter' );
				buttons.forEach( function ( b ) {
					b.setAttribute( 'aria-pressed', b === button ? 'true' : 'false' );
				} );
				apply();
			} );
		} );

		if ( input ) {
			input.addEventListener( 'input', apply );
		}

		// Link naar een tool (#tool-claude): filter leegmaken zodat hij zichtbaar is.
		if ( /^#tool-/.test( window.location.hash ) ) {
			var target = document.getElementById( window.location.hash.slice( 1 ) );
			if ( target ) {
				target.classList.add( 'is-target' );
			}
		}

		root.classList.add( 'is-enhanced' );
	} );
}() );
