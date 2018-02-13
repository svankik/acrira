
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

		var equalizeHeight = function () {
			var maxH       = 0,
				$infoBlocs = $( '.info-bloc', '.page-template-tpl-cinema-a-portee-de-main' )
			;

			$infoBlocs.css( 'height', 'auto' );

			$infoBlocs.each( function() {
				var h = parseInt( $( this ).height() );

				if( h > maxH ) {
					maxH = h;
				}
			} );

			$infoBlocs.height( maxH );
		}

		$( window ).on( 'load resize', equalizeHeight );

	} );

} )( jQuery );