/* Veryo landingspagina's: formulieren valideren en versturen. De webhook gaat server-side. */
( function () {
	'use strict';

	var config = window.veryoConfig || {};
	var forms = document.querySelectorAll( '[data-lp-form]' );
	if ( ! forms.length || ! window.fetch ) {
		return;
	}
	var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
	var phoneRe = /^\+?[0-9\s\-()]{8,20}$/;

	function utmSource() {
		var value = '';
		try {
			value = new URLSearchParams( window.location.search ).get( 'utm_source' ) || window.sessionStorage.getItem( 'veryo_utm_source' ) || '';
		} catch ( e ) {
			value = '';
		}
		return String( value ).slice( 0, 80 );
	}

	function post( payload, retry ) {
		return window.fetch( config.restUrl + 'lp', {
			method: 'POST',
			credentials: 'same-origin',
			headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': config.nonce },
			body: JSON.stringify( payload )
		} ).then( function ( response ) {
			return response.json().catch( function () {
				return {};
			} ).then( function ( body ) {
				if ( 403 === response.status && retry && body && 'rest_cookie_invalid_nonce' === body.code ) {
					return window.fetch( config.restUrl + 'nonce', { credentials: 'same-origin' } )
						.then( function ( r ) {
							return r.json();
						} )
						.then( function ( n ) {
							config.nonce = n.nonce;
							return post( payload, false );
						} );
				}
				return { status: response.status, body: body };
			} );
		} );
	}

	forms.forEach( function ( form ) {
		var type = form.getAttribute( 'data-lp-form' );
		var status = form.querySelector( '.form-status' );
		var button = form.querySelector( 'button[type="submit"]' );

		function fieldsByName() {
			var names = {};
			Array.prototype.forEach.call( form.elements, function ( el ) {
				if ( el.name && 'website' !== el.name ) {
					names[ el.name ] = true;
				}
			} );
			return Object.keys( names );
		}

		function value( name ) {
			var els = form.querySelectorAll( '[name="' + name + '"]' );
			if ( ! els.length ) {
				return '';
			}
			if ( 'radio' === els[ 0 ].type ) {
				var checked = form.querySelector( '[name="' + name + '"]:checked' );
				return checked ? checked.value : '';
			}
			if ( 'checkbox' === els[ 0 ].type ) {
				return els[ 0 ].checked;
			}
			return els[ 0 ].value.trim();
		}

		function errorEl( name ) {
			var first = form.querySelector( '[name="' + name + '"]' );
			if ( ! first ) {
				return null;
			}
			var group = first.closest( 'fieldset' );
			var id = group ? group.getAttribute( 'aria-describedby' ) : first.getAttribute( 'aria-describedby' );
			return id ? document.getElementById( id ) : null;
		}

		function setError( name, message ) {
			var el = errorEl( name );
			form.querySelectorAll( '[name="' + name + '"]' ).forEach( function ( input ) {
				if ( message ) {
					input.setAttribute( 'aria-invalid', 'true' );
				} else {
					input.removeAttribute( 'aria-invalid' );
				}
			} );
			if ( el ) {
				el.textContent = message || '';
				el.hidden = ! message;
			}
		}

		form.addEventListener( 'submit', function ( event ) {
			event.preventDefault();
			var names = fieldsByName();
			var errors = {};
			names.forEach( function ( name ) {
				var input = form.querySelector( '[name="' + name + '"]' );
				var v = value( name );
				if ( input.required && ( '' === v || false === v ) ) {
					if ( 'toestemming' === name ) {
						errors[ name ] = 'Geef toestemming om je gegevens te gebruiken.';
					} else if ( 'radio' === input.type || 'SELECT' === input.tagName ) {
						errors[ name ] = 'Maak een keuze.';
					} else {
						errors[ name ] = 'Dit veld is verplicht.';
					}
				} else if ( 'email' === input.type && v && ! emailRe.test( v ) ) {
					errors[ name ] = 'Vul een geldig e-mailadres in.';
				} else if ( 'tel' === input.type && v && ! phoneRe.test( v ) ) {
					errors[ name ] = 'Dit telefoonnummer lijkt niet te kloppen.';
				}
			} );
			names.forEach( function ( name ) {
				setError( name, errors[ name ] );
			} );
			var wrong = Object.keys( errors );
			if ( wrong.length ) {
				form.querySelector( '[name="' + wrong[ 0 ] + '"]' ).focus();
				return;
			}

			var payload = { formulier: type, website: form.querySelector( '[name="website"]' ).value, utm_source: utmSource(), pagina: window.location.pathname };
			names.forEach( function ( name ) {
				payload[ name ] = value( name );
			} );
			button.disabled = true;
			status.className = 'form-status';
			status.textContent = 'Bezig met versturen…';
			post( payload, true ).then( function ( res ) {
				button.disabled = false;
				if ( 200 === res.status && res.body && res.body.ok ) {
					var done = document.createElement( 'div' );
					done.className = 'veryo-lp-done';
					done.setAttribute( 'role', 'status' );
					done.setAttribute( 'tabindex', '-1' );
					done.textContent = res.body.message || form.getAttribute( 'data-done' );
					form.parentNode.replaceChild( done, form );
					done.focus();
					return;
				}
				status.className = 'form-status is-error';
				status.textContent = ( res.body && res.body.message ) || 'Er ging iets mis. Probeer het later opnieuw.';
				if ( res.body && res.body.data && res.body.data.errors ) {
					Object.keys( res.body.data.errors ).forEach( function ( name ) {
						setError( name, res.body.data.errors[ name ] );
					} );
				}
			} ).catch( function () {
				button.disabled = false;
				status.className = 'form-status is-error';
				status.textContent = 'Er ging iets mis met de verbinding. Probeer het opnieuw.';
			} );
		} );
	} );
}() );
