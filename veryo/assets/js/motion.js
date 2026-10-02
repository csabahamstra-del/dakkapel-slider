/*
 * Veryo: beweging met GSAP, ScrollTrigger, SplitText en Lenis (allemaal lokaal).
 *
 * Uitgangspunten:
 * - Alle inhoud is zichtbaar zonder JavaScript. Beginstanden (verborgen, verschoven) zet dit script
 *   pas vlak voor een animatie, dus als het niet laadt, staat alles gewoon in beeld.
 * - Bij "beweging beperken" gebeurt er niets: geen smooth scroll, geen pinning, geen scrub.
 * - Onder 768px geen pinning en geen horizontale scroll.
 * - Alleen transform, opacity en stroke-dashoffset worden geanimeerd.
 */
( function () {
	'use strict';

	var gsap = window.gsap;
	var ScrollTrigger = window.ScrollTrigger;
	var SplitText = window.SplitText;
	var root = document.documentElement;

	if ( ! gsap || ! ScrollTrigger || ! root.classList.contains( 'has-motion' ) ) {
		return;
	}
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}
	gsap.registerPlugin( ScrollTrigger );
	if ( SplitText ) {
		gsap.registerPlugin( SplitText );
	}
	gsap.defaults( { ease: 'power3.out', duration: 0.8 } );

	var SVGNS = 'http://www.w3.org/2000/svg';

	/* Het vinkje uit het beeldmerk als tekenbare SVG. */
	function makeCheck( className, color ) {
		var svg = document.createElementNS( SVGNS, 'svg' );
		svg.setAttribute( 'viewBox', '0 0 64 64' );
		svg.setAttribute( 'aria-hidden', 'true' );
		svg.setAttribute( 'focusable', 'false' );
		svg.setAttribute( 'class', className );
		var line = document.createElementNS( SVGNS, 'polyline' );
		line.setAttribute( 'points', '18,23 29,45 47,16' );
		line.setAttribute( 'fill', 'none' );
		line.setAttribute( 'stroke', color || 'currentColor' );
		line.setAttribute( 'stroke-width', '7.5' );
		line.setAttribute( 'stroke-linecap', 'round' );
		line.setAttribute( 'stroke-linejoin', 'round' );
		line.setAttribute( 'pathLength', '1' );
		svg.appendChild( line );
		return svg;
	}

	function drawFrom( svg ) {
		var line = svg.querySelector( 'polyline, rect' );
		gsap.set( line, { strokeDasharray: 1, strokeDashoffset: 1 } );
		return line;
	}

	/* Smooth scroll met Lenis, gekoppeld aan ScrollTrigger. */
	var lenis = null;
	if ( window.Lenis ) {
		lenis = new window.Lenis( { lerp: 0.12, anchors: true } );
		lenis.on( 'scroll', ScrollTrigger.update );
		gsap.ticker.add( function ( time ) {
			lenis.raf( time * 1000 );
		} );
		gsap.ticker.lagSmoothing( 0 );
	}

	var mm = gsap.matchMedia();

	mm.add(
		{
			desktop: '(min-width: 768px)',
			mobile: '(max-width: 767px)'
		},
		function ( context ) {
			var desktop = context.conditions.desktop;
			var cleanup = [];
			var tasks = [];

			tasks.push( function () {
				/* 1. Hero: het grote vinkje tekent zichzelf en schuift licht mee. */
				document.querySelectorAll( '.veryo-hero.has-check' ).forEach( function ( hero ) {
					var check = hero.querySelector( '.veryo-hero-check' );
					if ( ! check ) {
						check = makeCheck( 'veryo-hero-check' );
						hero.insertBefore( check, hero.firstChild );
					}
					gsap.to( drawFrom( check ), { strokeDashoffset: 0, duration: 0.9, ease: 'power2.inOut', delay: 0.2 } );
					gsap.to( check, {
						y: 40,
						ease: 'none',
						scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true }
					} );
				} );
			} );

			tasks.push( function () {
				/* 4. Zonder aanpak / met Veryo. */
				document.querySelectorAll( '.veryo-contrast' ).forEach( function ( section ) {
					var pains = section.querySelectorAll( '.veryo-pains li' );
					var gains = section.querySelectorAll( '.veryo-gains li' );
					var gainList = section.querySelector( '.veryo-gains' );
					if ( ! pains.length || ! gains.length ) {
						return;
					}
					gainList.classList.add( 'has-js-checks' );
					var checks = [];
					var strikes = [];
					gains.forEach( function ( li ) {
						var c = li.querySelector( '.veryo-check' );
						if ( ! c ) {
							c = makeCheck( 'veryo-check', '#E0A03A' );
							li.insertBefore( c, li.firstChild );
						}
						checks.push( drawFrom( c ) );
					} );
					pains.forEach( function ( li ) {
						var s = li.querySelector( '.veryo-strike' );
						if ( ! s ) {
							s = document.createElement( 'span' );
							s.className = 'veryo-strike';
							s.setAttribute( 'aria-hidden', 'true' );
							li.appendChild( s );
						}
						strikes.push( s );
					} );
					if ( desktop ) {
						gsap.set( gains, { autoAlpha: 0, x: 24 } );
						var tl = gsap.timeline( {
							scrollTrigger: { trigger: section, start: 'top 96px', end: '+=150%', pin: true, scrub: 0.6 }
						} );
						pains.forEach( function ( li, i ) {
							tl.to( strikes[ i ], { scaleX: 1, duration: 0.4, ease: 'none' }, i )
								.to( li, { opacity: 0.45, duration: 0.3 }, i )
								.to( gains[ i ], { autoAlpha: 1, x: 0, duration: 0.4 }, i + 0.2 )
								.to( checks[ i ], { strokeDashoffset: 0, duration: 0.4 }, i + 0.3 );
						} );
						tl.to( {}, { duration: 0.4 } );
					} else {
						gains.forEach( function ( li, i ) {
							gsap.to( checks[ i ], { strokeDashoffset: 0, duration: 0.7, scrollTrigger: { trigger: li, start: 'top 85%', once: true } } );
						} );
						pains.forEach( function ( li, i ) {
							gsap.to( strikes[ i ], { scaleX: 1, duration: 0.6, scrollTrigger: { trigger: li, start: 'top 80%', once: true } } );
						} );
					}
				} );
			} );

			tasks.push( function () {
				/* 5. De zes pijlers: horizontaal scrollen op desktop (vastgepind), swipen op mobiel (CSS). */
				document.querySelectorAll( '.veryo-pillars' ).forEach( function ( section ) {
					var track = section.querySelector( '.veryo-pillars__track' );
					if ( ! track ) {
						return;
					}
					section.querySelectorAll( '.veryo-pillar' ).forEach( function ( card ) {
						if ( ! card.querySelector( '.veryo-check' ) ) {
							card.appendChild( makeCheck( 'veryo-check', card.classList.contains( 'is-large' ) ? '#E0A03A' : '#1D4B44' ) );
						}
					} );
					if ( ! desktop ) {
						return;
					}
					section.classList.add( 'is-horizontal' );
					var distance = function () {
						return Math.max( 0, track.scrollWidth - section.clientWidth );
					};
					gsap.to( track, {
						x: function () {
							return -distance();
						},
						ease: 'none',
						scrollTrigger: {
							trigger: section,
							start: 'top 12%',
							end: function () {
								return '+=' + distance();
							},
							pin: true,
							scrub: 0.6,
							invalidateOnRefresh: true
						}
					} );
					cleanup.push( function () {
						section.classList.remove( 'is-horizontal' );
					} );
				} );
			} );

			tasks.push( function () {
				/* 6. Stappenplan: een lijn die vult, stappen lichten op. */
				document.querySelectorAll( '.veryo-steps--home .is-style-steps' ).forEach( function ( list ) {
					if ( ! desktop ) {
						return;
					}
					var fill = list.querySelector( '.veryo-steps__fill' );
					if ( ! fill ) {
						fill = document.createElement( 'span' );
						fill.className = 'veryo-steps__fill';
						fill.setAttribute( 'aria-hidden', 'true' );
						list.appendChild( fill );
					}
					gsap.to( fill, {
						scaleY: 1,
						ease: 'none',
						scrollTrigger: { trigger: list, start: 'top 65%', end: 'bottom 70%', scrub: true }
					} );
					list.querySelectorAll( 'li' ).forEach( function ( li ) {
						ScrollTrigger.create( {
							trigger: li,
							start: 'top 65%',
							onEnter: function () {
								li.classList.add( 'is-active' );
							},
							onLeaveBack: function () {
								li.classList.remove( 'is-active' );
							}
						} );
					} );
				} );
			} );

			tasks.push( function () {
				/* 7. Overtuiging: woorden kleuren van 20% naar 100% terwijl je scrolt. */
				document.querySelectorAll( '.veryo-conviction' ).forEach( function ( section ) {
					var quote = section.querySelector( '.veryo-quote' );
					if ( quote && SplitText ) {
						var split = SplitText.create( quote, { type: 'words', aria: 'none' } );
						// Pas dimmen als het citaat in beeld komt; daarvoor staat de tekst gewoon vol in beeld.
						ScrollTrigger.create( {
							trigger: quote,
							start: 'top 95%',
							once: true,
							onEnter: function () {
								gsap.fromTo(
									split.words,
									{ opacity: 0.2 },
									{
										opacity: 1,
										stagger: 0.08,
										ease: 'none',
										scrollTrigger: { trigger: quote, start: 'top 80%', end: 'bottom 45%', scrub: true }
									}
								);
							}
						} );
					}
					var portrait = section.querySelector( '.veryo-portret' );
					if ( portrait ) {
						gsap.from( portrait, { x: 40, autoAlpha: 0, duration: 0.9, scrollTrigger: { trigger: section, start: 'top 75%', once: true } } );
					}
				} );
			} );

			tasks.push( function () {
				/* 8. Sectiekoppen: regels schuiven uit een masker omhoog. Niet voor elke alinea. */
				if ( SplitText ) {
					document.querySelectorAll( '.entry-content h2' ).forEach( function ( h ) {
						if ( h.closest( '.veryo-hero' ) || h.getBoundingClientRect().top < window.innerHeight ) {
							return;
						}
						// Elke kop een eigen klein taakje.
						tasks.push( function () {
							SplitText.create( h, {
								type: 'lines',
								mask: 'lines',
								aria: 'auto',
								autoSplit: true,
								onSplit: function ( self ) {
									return gsap.from( self.lines, {
										yPercent: 100,
										duration: 0.8,
										stagger: 0.08,
										ease: 'expo.out',
										scrollTrigger: { trigger: h, start: 'top 88%', once: true }
									} );
								}
							} );
						} );
					} );
				}
			} );

			tasks.push( function () {
				/* 8b. Kaartgroepen: subtiel binnenkomen, gestaggerd per groep. */
				var groups = [
					'.veryo-pillars:not(.is-horizontal) .veryo-pillar',
					'.is-style-grid li',
					'.is-style-related li',
					'.veryo-price-table li',
					'.is-style-ladder li',
					'.veryo-why .is-style-checks li',
					'.is-style-catalog li',
					'.entry-content .veryo-img'
				];
				groups.forEach( function ( selector ) {
					var items = Array.prototype.filter.call( document.querySelectorAll( selector ), function ( el ) {
						return el.getBoundingClientRect().top > window.innerHeight;
					} );
					if ( ! items.length ) {
						return;
					}
					gsap.set( items, { autoAlpha: 0, y: 24 } );
					ScrollTrigger.batch( items, {
						start: 'top 90%',
						once: true,
						onEnter: function ( batch ) {
							gsap.to( batch, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.07, overwrite: true } );
						}
					} );
				} );
			} );

			tasks.push( function () {
				/* 10. Prijsblok AI-Startpakket: een amber rand tekent zich rondom. */
				document.querySelectorAll( '.veryo-price-switch.is-featured, .veryo-featured' ).forEach( function ( box ) {
					var rect = box.querySelector( '.veryo-draw-border rect' );
					if ( ! rect ) {
						var svg = document.createElementNS( SVGNS, 'svg' );
						svg.setAttribute( 'class', 'veryo-draw-border' );
						svg.setAttribute( 'aria-hidden', 'true' );
						svg.setAttribute( 'focusable', 'false' );
						rect = document.createElementNS( SVGNS, 'rect' );
						rect.setAttribute( 'width', '100%' );
						rect.setAttribute( 'height', '100%' );
						rect.setAttribute( 'rx', '16' );
						rect.setAttribute( 'pathLength', '1' );
						svg.appendChild( rect );
						box.appendChild( svg );
					}
					gsap.set( rect, { strokeDasharray: 1, strokeDashoffset: 1 } );
					gsap.to( rect, { strokeDashoffset: 0, duration: 1.1, ease: 'power2.inOut', scrollTrigger: { trigger: box, start: 'top 75%', once: true } } );
				} );
			} );

			tasks.push( function () {
				/* 14. Footer: het grote woordmerk schuift omhoog. */
				document.querySelectorAll( '.footer-wordmark svg' ).forEach( function ( mark ) {
					gsap.from( mark, { yPercent: 60, duration: 1.1, ease: 'expo.out', scrollTrigger: { trigger: mark.parentNode, start: 'top 95%', once: true } } );
				} );
			} );

			// Het opbouwen gebeurt in kleine stukjes, zodat de pagina tussendoor reageert.
			var step = 0;
			var runNext = function () {
				if ( step >= tasks.length ) {
					ScrollTrigger.refresh();
					return;
				}
				context.add( tasks[ step++ ] );
				window.setTimeout( runNext, 0 );
			};
			runNext();

			return function () {
				cleanup.forEach( function ( fn ) {
					fn();
				} );
			};
		}
	);

	/* Na het laden van lettertypes en afbeeldingen de maten opnieuw berekenen. */
	window.addEventListener( 'load', function () {
		ScrollTrigger.refresh();
	} );
}() );
