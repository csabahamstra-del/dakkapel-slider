/* Veryo: contactformulier en Academy-wachtlijst. */
( function () {
	'use strict';

	var config = window.veryoConfig || {};
	var forms = document.querySelectorAll( '[data-veryo-form]' );
	if ( ! forms.length || ! window.fetch ) {
		return;
	}
	var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
	var phoneRe = /^\+?[0-9\s\-()]{8,20}$/;

	function post( payload, retry ) {
		return window.fetch( config.restUrl + 'form', {
			method: 'POST',
			credentials: 'same-origin',
			headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': config.nonce },
			body: JSON.stringify( payload )
		} ).then( function ( response ) {
			return response.json().catch( function () {
				return {};
			} ).then( function ( body ) {
				if ( 403 === response.status && retry ) {
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
		var type = form.getAttribute( 'data-veryo-form' );
		var status = form.querySelector( '.form-status' );
		var button = form.querySelector( 'button[type="submit"]' );

		function setError( name, message ) {
			var input = form.querySelector( '[name="' + name + '"]' );
			if ( ! input ) {
				return;
			}
			var el = document.getElementById( input.id + '-error' );
			if ( message ) {
				input.setAttribute( 'aria-invalid', 'true' );
			} else {
				input.removeAttribute( 'aria-invalid' );
			}
			if ( el ) {
				el.textContent = message || '';
				el.hidden = ! message;
			}
		}

		function value( name ) {
			var input = form.querySelector( '[name="' + name + '"]' );
			if ( ! input ) {
				return '';
			}
			return 'checkbox' === input.type ? input.checked : input.value.trim();
		}

		form.addEventListener( 'submit', function ( event ) {
			event.preventDefault();
			var errors = {};
			if ( ! value( 'naam' ) ) {
				errors.naam = 'Vul je naam in.';
			}
			if ( ! emailRe.test( value( 'email' ) ) ) {
				errors.email = 'Vul een geldig e-mailadres in.';
			}
			if ( 'contact' === type ) {
				if ( value( 'telefoon' ) && ! phoneRe.test( value( 'telefoon' ) ) ) {
					errors.telefoon = 'Dit telefoonnummer lijkt niet te kloppen.';
				}
				if ( ! value( 'bericht' ) ) {
					errors.bericht = 'Schrijf een kort bericht.';
				}
			}
			if ( value( 'medewerkers' ) && ! /^\d{1,4}$/.test( value( 'medewerkers' ) ) ) {
				errors.medewerkers = 'Vul een aantal tussen 1 en 1000 in.';
			}
			if ( ! value( 'toestemming' ) ) {
				errors.toestemming = 'Geef toestemming om je gegevens te gebruiken.';
			}
			[ 'naam', 'email', 'telefoon', 'bericht', 'medewerkers', 'toestemming' ].forEach( function ( name ) {
				setError( name, errors[ name ] );
			} );
			var names = Object.keys( errors );
			if ( names.length ) {
				form.querySelector( '[name="' + names[ 0 ] + '"]' ).focus();
				return;
			}

			var payload = {
				type: type,
				naam: value( 'naam' ),
				bedrijf: value( 'bedrijf' ),
				email: value( 'email' ),
				telefoon: value( 'telefoon' ),
				bericht: value( 'bericht' ),
				medewerkers: value( 'medewerkers' ),
				toestemming: value( 'toestemming' ),
				website: value( 'website' ),
				pagina: window.location.pathname
			};
			button.disabled = true;
			status.className = 'form-status';
			status.textContent = 'Bezig met versturen…';
			post( payload, true ).then( function ( res ) {
				button.disabled = false;
				if ( 200 === res.status && res.body && res.body.ok ) {
					form.reset();
					status.className = 'form-status is-success';
					status.textContent = res.body.message || 'Verstuurd.';
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
