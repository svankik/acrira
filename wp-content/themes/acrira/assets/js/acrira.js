
( function ( $ ) {
	
	$ ( function() {
		
		/**
		 * Header Slider
		 */
		$( '.header-slider' ).bxSlider( {
			mode: 'fade',
			auto: true,
			controls: false,
		} );


		/**
		 * Accordion
		 */
		$( '.accordion' ).each( function () {

			$( 'article', $( this ) ).each( function() {

				$( '.entry-header', $( this ) ).on( 'click', function(e) {
					e.preventDefault();

					$( this ).toggleClass( 'active' );
				} );

			} );

		} );

	} );

} )( jQuery );