
( function ( $ ) {
	
	$ ( function() {

		var $infoBlocs  = $( '.info-bloc', '.page-template-tpl-titre-intro-blocs' ),
			$logo       = $( '.logo-container', '.site-branding' ),
			$news       = $( '.news', '.site-branding' ),
			$newsWrap   = $( '.wrapper', $news ),
			$newsSlider = $( '.news-slider', $news ),
			$newsItems  = $( '.news-item', $newsSlider ),
			newsScroll
		;

		/**
		 * Header Slider
		 */
		$( '.header-slider' ).bxSlider( {
			mode    : 'fade',
			auto    : true,
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
			var maxH = 0;

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
		if ( $newsSlider.length ) {

			$( window ).on( 'load', function () {			
				var $newsH = $logo.height() - 30 - 2;
				$news.height( $newsH );
				// $newsItems.height( $newsH - $news.find( 'h2' ).outerHeight() );
				$newsItems.height( $newsH );
				$newsItems.each( function(i, el) {
					$(el).data( 'scroll', new IScroll(el, {
						mouseWheel: true,
						// click: true,
						// tap: true,
						disablePointer: false,
						disableTouch: false,
						disableMouse: false,
						scrollbars: true
					} ) );
				} );

				$newsSlider.bxSlider( {
					mode          : 'fade',
					auto          : true,
					controls      : true,
					autoControls  : true,
					pause         : 6000,
					onSliderLoad  : function () {
					},
					onSliderResize: function () {
						// var $newsH = $logo.height();
						// $news.height( $newsH );
						// // $newsItems.height( $newsH - $news.find( 'h2' ).outerHeight() );
						// $newsItems.height( $newsH );
						// $newsItems.each( function(i, el) {
						// 	$(el).data( 'scroll' ).refresh();
						// } );
					},
					onSlideAfter  : function ($item) {
						$item.data( 'scroll' ).refresh();
					}
				} );
			} );

			$( window ).on( 'resize', function () {			
				var $newsH = $logo.height() - 30 - 2;
				$news.height( $newsH );
				// $newsItems.height( $newsH - $news.find( 'h2' ).outerHeight() );
				$newsItems.height( $newsH );
				$newsItems.each( function(i, el) {
					$(el).data( 'scroll' ).refresh();
				} );
			} );
		}

	} );

} )( jQuery );