
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

		/**
		 * Equalize Height
		 */
		var equalizeHeight = function () {
			var maxH       = 0,
				$infoBlocs = $( '.info-bloc', '.page-template-tpl-cinema-a-portee-de-main' ),
				$logo      = $( '.logo-container', '.site-branding' ),
				$news      = $( '.news', '.site-branding' )
			;

			$infoBlocs.css( 'height', 'auto' );

			$infoBlocs.each( function() {
				var h = parseInt( $( this ).height() );

				if( h > maxH ) {
					maxH = h;
				}
			} );

			$infoBlocs.height( maxH );

			$newsH = $logo.height() - $news.prev().outerHeight() - 30 - 2;
			$news.height( $newsH );
			// $news.find( '.wrapper' ).height( $newsH );
			newsScroll.refresh();
		}

		$( window ).on( 'load resize', equalizeHeight );

		/**
		 * Partners Filters
		 */
		var $partners = $( '.partner', '.entry-partners' ),
			$filters  = $( 'a', '.entry-partners-filters' )
		;

		$filters.on( 'click', function(e) {
			e.preventDefault();

			var filter = $( this ).data( 'key' );

			switch( filter ) {
				case 'all' : 
					$partners.fadeIn(400);
					break;

				case 'cultural' : 
					$partners.not( '.culturel' ).fadeOut(200);
					$partners.filter( '.culturel' ).fadeIn(400);
					break;

				case 'financial' : 
					$partners.not( '.financier' ).fadeOut(200);
					$partners.filter( '.financier' ).fadeIn(400);
					break;
			} 
		} );

		/**
		 * News
		 */
		var newsScroll = new IScroll('.site-branding .news .wrapper', {
			mouseWheel: true,
			click: true,
			scrollbars: true
		} );

	} );

} )( jQuery );