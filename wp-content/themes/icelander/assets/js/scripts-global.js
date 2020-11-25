/**
 * Theme frontend scripts
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 * 10) Basics
 * 20) Content
 * 30) Custom header
 * 40) Sticky header
 */

( function( $ ) {

	'use strict';





	/**
	 * 10) Basics
	 */

		var
			$breakpoints           = ( 'undefined' !== typeof $icelanderBreakpoints ) ? ( $icelanderBreakpoints ) : ( { 'xl' : 1280 } ),
			$introMedia            = $( document.getElementById( 'intro-media' ) ),
			$compactLayoutProjects = $( '.portfolio-style-compact .posts .type-wm_projects' );



		/**
		 * Tell CSS that JS is enabled...
		 */

			$( '.no-js' )
				.removeClass( 'no-js' );



		/**
		 * Fixing Recent Comments widget multiple appearances
		 */

			$( '.widget_recent_comments ul' )
				.attr( 'id', '' );



		/**
		 * Back to top link
		 */

			if ( parseInt( $breakpoints['xl'] ) < window.innerWidth ) {

				$( '.back-to-top' )
					.on( 'click', function( e ) {

						// Processing

							// Scroll the page to top.
							$( 'html, body' )
								.animate( {
									scrollTop : 0
								}, 600 );

							// Reset focus on top of the page.
							$( 'body' )
								.attr( 'tabindex', 0 )
								.focus();

							// Do not alter URL in browser.
							return false;

					} );

			}



		/**
		 * Responsive videos
		 */

			if ( $().fitVids ) {

				$( document.getElementById( 'page' ) )
					.fitVids();

			} // /fitVids



		/**
		 * Primary menu fallback
		 */

			$( '#menu-primary.menu-fallback .menu-item-has-children > a' )
				.append( ' <span class="expander" aria-hidden="true"></span>' );





	/**
	 * 20) Content
	 */

		/**
		 * Comment form improvements
		 *
		 * Set input fields placeholders from field labels.
		 */

			$( document.getElementById( 'commentform' ) )
				.find( 'input[type="text"], input[type="email"], input[type="url"], textarea' )
					.each( function( index, el ) {

						// Helper variables

							var
								$this = $( el );


						// Processing

							$this
								.attr( 'placeholder', $this.prev( 'label' ).text() )
								.prev( 'label' )
									.addClass( 'screen-reader-text' );

					} );



		/**
		 * Compact projects layout focus
		 */

			$compactLayoutProjects
				.on( 'focus.aria mouseenter.aria', 'a', function( e ) {

					// Processing

						$( this )
							.closest( '.type-wm_projects' )
								.addClass( 'focus' );

				} )
				.on( 'blur.aria mouseleave.aria', 'a', function( e ) {

					// Processing

						$( this )
							.closest( '.type-wm_projects' )
								.removeClass( 'focus' );

				} );





	/**
	 * 30) Custom header
	 */

		if ( $introMedia.length ) {
			$introMedia
				.parent( '.intro-special' )
					.addClass( 'intro-special-has-media' );
		}

		$( document )
			.on( 'wp-custom-header-video-loaded', function() {

				// Processing

					$introMedia
						.addClass( 'has-header-video' );

			} );





	/**
	 * 40) Sticky header
	 */

		if ( $().scrollWatch && $( 'body' ).hasClass( 'has-sticky-header' ) ) {

			$( document.getElementById( 'masthead' ) )
				.scrollWatch( {
					offset : 50,
				} );

		} // /scrollWatch





} )( jQuery );
