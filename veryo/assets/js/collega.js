/* Veryo Collega: tabs per branche en de rekenhulp. Zonder JavaScript blijft alles leesbaar. */
( function () {
	'use strict';

	var thousands = function ( n ) {
		return Math.round( n ).toString().replace( /\B(?=(\d{3})+(?!\d))/g, '.' );
	};
	var euro = function ( n ) {
		return '€' + thousands( n );
	};

	/* Tabs: de branches staan als losse blokken onder elkaar; met JavaScript worden het tabs. */
	document.querySelectorAll( '.veryo-tabs' ).forEach( function ( wrap, w ) {
		var panels = Array.prototype.filter.call( wrap.children, function ( el ) {
			return el.classList.contains( 'veryo-tab' );
		} );
		if ( panels.length < 2 ) {
			return;
		}
		var list = document.createElement( 'div' );
		list.className = 'veryo-tabs__list';
		list.setAttribute( 'role', 'tablist' );
		list.setAttribute( 'aria-label', 'Branches' );
		var tabs = [];

		var select = function ( index, focus ) {
			tabs.forEach( function ( tab, j ) {
				var on = j === index;
				tab.setAttribute( 'aria-selected', on ? 'true' : 'false' );
				tab.tabIndex = on ? 0 : -1;
				panels[ j ].hidden = ! on;
			} );
			if ( focus ) {
				tabs[ index ].focus();
			}
		};

		panels.forEach( function ( panel, i ) {
			var heading = panel.querySelector( 'h3' );
			var tab = document.createElement( 'button' );
			tab.type = 'button';
			tab.className = 'veryo-tabs__tab';
			tab.setAttribute( 'role', 'tab' );
			tab.id = 'veryo-tab-' + w + '-' + i;
			panel.id = panel.id || 'veryo-panel-' + w + '-' + i;
			tab.setAttribute( 'aria-controls', panel.id );
			tab.textContent = heading ? heading.textContent : String( i + 1 );
			panel.setAttribute( 'role', 'tabpanel' );
			panel.setAttribute( 'aria-labelledby', tab.id );
			panel.tabIndex = 0;
			tab.addEventListener( 'click', function () {
				select( i, false );
			} );
			tab.addEventListener( 'keydown', function ( event ) {
				var next = null;
				if ( 'ArrowRight' === event.key || 'ArrowDown' === event.key ) {
					next = ( i + 1 ) % panels.length;
				} else if ( 'ArrowLeft' === event.key || 'ArrowUp' === event.key ) {
					next = ( i - 1 + panels.length ) % panels.length;
				} else if ( 'Home' === event.key ) {
					next = 0;
				} else if ( 'End' === event.key ) {
					next = panels.length - 1;
				}
				if ( null !== next ) {
					event.preventDefault();
					select( next, true );
				}
			} );
			list.appendChild( tab );
			tabs.push( tab );
		} );
		wrap.insertBefore( list, wrap.firstChild );
		wrap.classList.add( 'is-enhanced' );
		select( 0, false );
	} );

	/* Rekenhulp: uren en waarde per maand, en het passende pakket. */
	document.querySelectorAll( '.veryo-calc' ).forEach( function ( box ) {
		var config = {};
		try {
			config = JSON.parse( box.getAttribute( 'data-calc' ) ) || {};
		} catch ( e ) {
			config = {};
		}
		var plans = config.plans || [];
		var number = function ( id ) {
			var input = box.querySelector( '#' + id );
			var value = input ? parseFloat( String( input.value ).replace( ',', '.' ) ) : 0;
			return isFinite( value ) && value > 0 ? value : 0;
		};
		var out = function ( key ) {
			return box.querySelector( '[data-out="' + key + '"]' );
		};
		var update = function () {
			var people = number( 'calc-medewerkers' );
			var hours = people * number( 'calc-uren' ) * ( config.besparing || 0.3 ) * ( config.weken || 4.33 );
			out( 'uren' ).textContent = thousands( hours );
			out( 'waarde' ).textContent = euro( hours * number( 'calc-tarief' ) );
			var plan = null;
			plans.forEach( function ( p ) {
				if ( ! plan && people <= p.tot ) {
					plan = p;
				}
			} );
			var larger = ! plan && plans.length;
			plan = plan || plans[ plans.length - 1 ];
			if ( plan ) {
				out( 'pakket' ).textContent = plan.naam + ', ' + euro( plan.prijs ) + ' per maand' + ( larger ? ' (bij meer dan ' + plan.tot + ' medewerkers maken we een voorstel op maat)' : '' );
			}
		};
		box.addEventListener( 'input', update );
		update();
	} );
}() );
