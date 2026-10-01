/* Veryo: de gratis AI-scan. Eén vraag per scherm, bedienbaar met toetsenbord.
 * Antwoorden (geen contactgegevens) worden tijdelijk in sessionStorage bewaard. */
( function () {
	'use strict';

	var root = document.querySelector( '[data-veryo-scan]' );
	var config = window.veryoConfig || {};
	if ( ! root || ! window.fetch ) {
		return;
	}

	var form = root.querySelector( '.scan-form' );
	var steps = Array.prototype.slice.call( root.querySelectorAll( '.scan-step' ) );
	var total = steps.length;
	var live = root.querySelector( '#scan-live' );
	var progress = root.querySelector( '.scan-progress' );
	var bar = root.querySelector( '.scan-progress__bar' );
	var backBtn = root.querySelector( '.scan-back' );
	var nextBtn = root.querySelector( '.scan-next' );
	var submitBtn = root.querySelector( '.scan-submit' );
	var status = root.querySelector( '.scan-status' );
	var result = root.querySelector( '.scan-result' );
	var STORE = 'veryoScan';
	var CONTACT = [ 'voornaam', 'bedrijf', 'email', 'telefoon', 'toestemming', 'website' ];
	var current = 0;
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	root.classList.add( 'is-ready' );

	/* ---------- Opslag ---------- */

	function collect() {
		var data = { taken: [], tools: [], uren: {} };
		var fd = new FormData( form );
		fd.forEach( function ( value, name ) {
			if ( 'taken' === name || 'tools' === name ) {
				data[ name ].push( value );
			} else if ( 0 === name.indexOf( 'uren[' ) ) {
				data.uren[ name.slice( 5, -1 ) ] = parseInt( value, 10 ) || 0;
			} else {
				data[ name ] = value;
			}
		} );
		data.toestemming = !! form.querySelector( '[name="toestemming"]' ).checked;
		return data;
	}

	function save() {
		var data = collect();
		CONTACT.forEach( function ( key ) {
			delete data[ key ];
		} );
		data._step = current;
		try {
			window.sessionStorage.setItem( STORE, JSON.stringify( data ) );
		} catch ( e ) {}
	}

	function restore() {
		var data;
		try {
			data = JSON.parse( window.sessionStorage.getItem( STORE ) || 'null' );
		} catch ( e ) {
			data = null;
		}
		if ( ! data ) {
			return 0;
		}
		Object.keys( data ).forEach( function ( key ) {
			if ( '_step' === key ) {
				return;
			}
			if ( 'uren' === key ) {
				Object.keys( data.uren ).forEach( function ( task ) {
					var input = form.querySelector( '[name="uren[' + task + ']"]' );
					if ( input ) {
						input.value = data.uren[ task ];
					}
				} );
				return;
			}
			var values = Array.isArray( data[ key ] ) ? data[ key ] : [ data[ key ] ];
			form.querySelectorAll( '[name="' + key + '"]' ).forEach( function ( input ) {
				if ( 'radio' === input.type || 'checkbox' === input.type ) {
					input.checked = values.indexOf( input.value ) !== -1;
				} else {
					input.value = data[ key ];
				}
			} );
		} );
		return Math.min( parseInt( data._step, 10 ) || 0, total - 1 );
	}

	/* ---------- Weergave ---------- */

	function updateSliders() {
		var chosen = collect().taken;
		root.querySelectorAll( '.scan-slider' ).forEach( function ( wrap ) {
			wrap.hidden = chosen.indexOf( wrap.getAttribute( 'data-task' ) ) === -1;
		} );
		root.querySelectorAll( '.scan-slider input' ).forEach( updateOutput );
	}

	function updateOutput( input ) {
		var out = input.parentNode.querySelector( 'output' );
		var n = parseInt( input.value, 10 ) || 0;
		if ( out ) {
			out.textContent = n + ' uur';
		}
		input.setAttribute( 'aria-valuetext', n + ' uur per week' );
	}

	function updateOther() {
		var checked = form.querySelector( '[name="branche"]:checked' );
		var other = root.querySelector( '.scan-other' );
		if ( other ) {
			other.hidden = ! checked || 'overig' !== checked.value;
		}
	}

	function showStep( index, focus ) {
		var back = index < current;
		current = index;
		steps.forEach( function ( step, i ) {
			step.hidden = i !== index;
			step.classList.remove( 'is-entering', 'is-back' );
		} );
		var step = steps[ index ];
		if ( ! reduce ) {
			// Vooruit schuift de stap van rechts naar links in, terug van links naar rechts.
			void step.offsetWidth;
			step.classList.add( 'is-entering' );
			if ( back ) {
				step.classList.add( 'is-back' );
			}
		}
		if ( 3 === index ) {
			updateSliders();
		}
		var n = index + 1;
		live.textContent = 'Vraag ' + n + ' van ' + total;
		progress.setAttribute( 'aria-valuenow', String( n ) );
		bar.style.width = Math.round( ( n / total ) * 100 ) + '%';
		backBtn.hidden = 0 === index;
		nextBtn.hidden = index === total - 1;
		submitBtn.hidden = index !== total - 1;
		if ( focus ) {
			var legend = step.querySelector( '.scan-q' );
			if ( legend ) {
				legend.focus( { preventScroll: true } );
			}
			var top = root.getBoundingClientRect().top;
			if ( top < 0 ) {
				root.scrollIntoView( { behavior: reduce ? 'auto' : 'smooth', block: 'start' } );
			}
		}
	}

	/* ---------- Validatie ---------- */

	function setStepError( step, message ) {
		var el = step.querySelector( '.scan-error' );
		if ( ! el ) {
			return;
		}
		el.textContent = message || '';
		el.hidden = ! message;
	}

	function setFieldError( name, message ) {
		var input = form.querySelector( '[name="' + name + '"]' );
		var el = root.querySelector( '#scan-' + name + '-error' );
		if ( input ) {
			if ( message ) {
				input.setAttribute( 'aria-invalid', 'true' );
			} else {
				input.removeAttribute( 'aria-invalid' );
			}
		}
		if ( el ) {
			el.textContent = message || '';
			el.hidden = ! message;
		}
	}

	var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
	var phoneRe = /^\+?[0-9\s\-()]{8,20}$/;

	function validate( index ) {
		var step = steps[ index ];
		var key = step.getAttribute( 'data-key' );
		var data = collect();
		var msg = '';
		switch ( key ) {
			case 'branche':
				if ( ! data.branche ) {
					msg = 'Kies een branche.';
				} else if ( 'overig' === data.branche && ! ( data.branche_overig || '' ).trim() ) {
					msg = 'Vul in welke branche.';
				}
				break;
			case 'team':
				msg = data.team ? '' : 'Kies een teamgrootte.';
				break;
			case 'taken':
				msg = data.taken.length ? '' : 'Kies minstens één taak.';
				break;
			case 'ai_gebruik':
				msg = data.ai_gebruik ? '' : 'Kies een antwoord.';
				break;
			case 'timing':
				msg = data.timing ? '' : 'Kies wanneer je iets wilt doen.';
				break;
			case 'contact':
				return validateContact( data );
		}
		setStepError( step, msg );
		if ( msg ) {
			var first = step.querySelector( 'input, textarea' );
			if ( first ) {
				first.focus();
			}
			return false;
		}
		return true;
	}

	function validateContact( data ) {
		var errors = {};
		if ( ! ( data.voornaam || '' ).trim() ) {
			errors.voornaam = 'Vul je voornaam in.';
		}
		if ( ! ( data.bedrijf || '' ).trim() ) {
			errors.bedrijf = 'Vul je bedrijfsnaam in.';
		}
		if ( ! emailRe.test( ( data.email || '' ).trim() ) ) {
			errors.email = 'Vul een geldig e-mailadres in.';
		}
		if ( ( data.telefoon || '' ).trim() && ! phoneRe.test( data.telefoon.trim() ) ) {
			errors.telefoon = 'Dit telefoonnummer lijkt niet te kloppen.';
		}
		if ( ! data.toestemming ) {
			errors.toestemming = 'Geef toestemming om je rapport te kunnen maken.';
		}
		[ 'voornaam', 'bedrijf', 'email', 'telefoon', 'toestemming' ].forEach( function ( name ) {
			setFieldError( name, errors[ name ] );
		} );
		var names = Object.keys( errors );
		if ( names.length ) {
			var input = form.querySelector( '[name="' + names[ 0 ] + '"]' );
			if ( input ) {
				input.focus();
			}
			return false;
		}
		return true;
	}

	/* ---------- Versturen ---------- */

	function post( payload, retry ) {
		return window.fetch( config.restUrl + 'scan', {
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

	function showServerErrors( errors ) {
		var stepIndex = -1;
		Object.keys( errors ).forEach( function ( name ) {
			var contactField = [ 'voornaam', 'bedrijf', 'email', 'telefoon', 'toestemming' ].indexOf( name ) !== -1;
			if ( contactField ) {
				setFieldError( name, errors[ name ] );
				stepIndex = stepIndex === -1 ? total - 1 : stepIndex;
			} else {
				steps.forEach( function ( step, i ) {
					if ( step.getAttribute( 'data-key' ) === name ) {
						setStepError( step, errors[ name ] );
						stepIndex = stepIndex === -1 || i < stepIndex ? i : stepIndex;
					}
				} );
			}
		} );
		if ( stepIndex > -1 ) {
			showStep( stepIndex, true );
		}
	}

	function escapeHtml( text ) {
		var div = document.createElement( 'div' );
		div.textContent = String( text );
		return div.innerHTML;
	}

	function showResult( body ) {
		var score = Math.max( 0, Math.min( 100, parseInt( body.score, 10 ) || 0 ) );
		var html = '<p class="scan-result__label">Jouw geschatte tijdwinst</p>' +
			'<p class="scan-result__big"><span class="scan-result__check" aria-hidden="true"><svg viewBox="0 0 64 64" focusable="false"><polyline points="18,23 29,45 47,16" fill="none" stroke="#E0A03A" stroke-width="7.5" stroke-linecap="round" stroke-linejoin="round" pathLength="1"/></svg></span><span class="scan-result__hours" data-to="' + escapeHtml( body.uren ) + '">' + escapeHtml( body.uren ) + '</span> uur per week <span class="scan-result__euro">(±' + escapeHtml( body.euro ) + ' per jaar)</span></p>' +
			'<div class="scan-result__score"><span>Kansenscore: <strong>' + score + '</strong> van 100</span>' +
			'<span class="scan-result__meter" aria-hidden="true"><span style="width:' + score + '%"></span></span></div>' +
			'<p class="veryo-meta">' + escapeHtml( body.aannames ) + '</p>' +
			'<p><strong>Je volledige rapport staat binnen enkele minuten in je mailbox.</strong> Zie je niets? Kijk dan even in je map met ongewenste mail.</p>' +
			'<div class="scan-actions">';
		if ( body.calendly ) {
			html += '<a class="btn btn--amber" href="' + escapeHtml( body.calendly ) + '">Plan direct een gesprek</a>';
		}
		if ( config.thanksUrl ) {
			html += '<a class="btn btn--link" href="' + escapeHtml( config.thanksUrl ) + '">Verder naar de bedankpagina</a>';
		}
		html += '</div>';
		result.innerHTML = html;
		form.hidden = true;
		result.hidden = false;
		result.focus();
		// Het aantal uren telt op van 0 naar de uitkomst; daarna tekent het vinkje zichzelf.
		var hours = result.querySelector( '.scan-result__hours' );
		var check = result.querySelector( '.scan-result__check' );
		var target = parseInt( hours ? hours.getAttribute( 'data-to' ) : '0', 10 ) || 0;
		if ( hours && ! reduce && target > 0 ) {
			var start = null;
			var tick = function ( t ) {
				if ( null === start ) {
					start = t;
				}
				var p = Math.min( 1, ( t - start ) / 900 );
				hours.textContent = String( Math.round( target * ( 1 - Math.pow( 1 - p, 3 ) ) ) );
				if ( p < 1 ) {
					window.requestAnimationFrame( tick );
				} else if ( check ) {
					check.classList.add( 'is-drawn' );
				}
			};
			hours.textContent = '0';
			window.requestAnimationFrame( tick );
		} else if ( check ) {
			check.classList.add( 'is-drawn' );
		}
		try {
			window.sessionStorage.removeItem( STORE );
		} catch ( e ) {}
	}

	function submit() {
		for ( var i = 0; i < total; i++ ) {
			if ( ! validate( i ) ) {
				showStep( i, false );
				validate( i );
				return;
			}
		}
		var data = collect();
		var chosen = {};
		data.taken.forEach( function ( task ) {
			chosen[ task ] = data.uren[ task ] || 0;
		} );
		data.uren = chosen;
		submitBtn.disabled = true;
		status.className = 'scan-status';
		status.textContent = 'Bezig met versturen…';
		post( data, true ).then( function ( res ) {
			submitBtn.disabled = false;
			if ( 200 === res.status && res.body && res.body.ok ) {
				status.textContent = '';
				showResult( res.body );
				return;
			}
			status.className = 'scan-status is-error';
			if ( res.body && res.body.data && res.body.data.errors ) {
				status.textContent = res.body.message || 'Niet alle velden zijn goed ingevuld.';
				showServerErrors( res.body.data.errors );
			} else {
				status.textContent = ( res.body && res.body.message ) || 'Er ging iets mis. Probeer het later opnieuw.';
			}
		} ).catch( function () {
			submitBtn.disabled = false;
			status.className = 'scan-status is-error';
			status.textContent = 'Er ging iets mis met de verbinding. Probeer het opnieuw.';
		} );
	}

	/* ---------- Gebeurtenissen ---------- */

	nextBtn.addEventListener( 'click', function () {
		if ( validate( current ) ) {
			setStepError( steps[ current ], '' );
			showStep( current + 1, true );
			save();
		}
	} );

	backBtn.addEventListener( 'click', function () {
		if ( current > 0 ) {
			showStep( current - 1, true );
			save();
		}
	} );

	form.addEventListener( 'submit', function ( event ) {
		event.preventDefault();
		if ( current < total - 1 ) {
			nextBtn.click();
		} else {
			submit();
		}
	} );

	form.addEventListener( 'change', function ( event ) {
		var target = event.target;
		if ( 'tools' === target.name ) {
			// "Geen van deze" sluit de andere keuzes uit.
			if ( 'geen' === target.value && target.checked ) {
				form.querySelectorAll( '[name="tools"]' ).forEach( function ( input ) {
					if ( 'geen' !== input.value ) {
						input.checked = false;
					}
				} );
			} else if ( target.checked ) {
				var none = form.querySelector( '[name="tools"][value="geen"]' );
				if ( none ) {
					none.checked = false;
				}
			}
		}
		if ( 'branche' === target.name ) {
			updateOther();
		}
		var step = target.closest( '.scan-step' );
		if ( step && 'contact' !== step.getAttribute( 'data-key' ) ) {
			setStepError( step, '' );
		} else if ( target.name ) {
			setFieldError( target.name, '' );
		}
		save();
	} );

	form.addEventListener( 'input', function ( event ) {
		var target = event.target;
		if ( 'range' === target.type ) {
			updateOutput( target );
		}
		if ( 'frustratie' === target.name ) {
			var count = root.querySelector( '.scan-count' );
			if ( count ) {
				count.textContent = String( target.value.length );
			}
		}
	} );

	// Start.
	var start = restore();
	updateOther();
	updateSliders();
	var frustration = form.querySelector( '[name="frustratie"]' );
	if ( frustration ) {
		root.querySelector( '.scan-count' ).textContent = String( frustration.value.length );
	}
	showStep( start, false );
}() );
