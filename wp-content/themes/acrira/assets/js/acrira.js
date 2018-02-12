
( function ( $ ) {
	
	$ ( function() {
		
		$ ( "#accordion" ).accordion ( {
			active     : false,
			collapsible: true,
			header     : "header"
		} );

		/**
		 * Header Slider
		 */
		$( '.header-slider' ).bxSlider( {
			mode: 'fade',
			auto: true,
			controls: false,
		} );

	} );

} )( jQuery );