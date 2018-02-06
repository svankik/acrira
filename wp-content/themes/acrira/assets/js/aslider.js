
( function( $ ) {

	'use strict';

	var allItems   = [],
		split      = 4,
		delay      = 0.15,
		transition = 3000,
		margin     = 2,
		ratio      = 1.5
	;

	/**
	 * GUID
	 *
	 * @return  String
	 */
	function getGuid() {
		function s4() {
			return Math.floor((1 + Math.random()) * 0x10000)
				.toString(16)
				.substring(1)
			;
		}

		return 'id' + s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
	}

	function onAnimationEnd( elems, len, callback ) {
		var finished = 0,
			onEndFn = function() {
				$(this).off( 'webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend', onEndFn );
				++finished;
				if( finished === len ) {
					callback.call();
				}
			};

		$(elems).each( function(i, el) {
			$(el).find('.as-item').on( 'webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend', onEndFn )
		} );
	}

	function resizeAs( $grid ) {
		var guid        = $grid.attr( 'id' ),
			$items      = $grid.find( '.as-item' ),
			$parts      = $items.not( '.as-old' ).find( '.part' ),
			gridW       = parseInt($grid.width()),
			gridH       = gridW / ratio,
			count       = split,
			itemW       = ( gridW - (count - 1) * margin ) / count,
			selector    = guid,
			$stylesheet = $( '#st-' + guid ),
			style       = ''
		;

		if( $stylesheet.length ) {
			$stylesheet.remove();
		}

		style += '#' + selector + ' li { ' +
					'width: ' + (itemW - 2 * margin) + 'px;' +
					'height: ' + gridH + 'px;' +
					'margin: ' + margin + 'px;' +
				'} '
		;

		$parts.each( function( index, el ) {
			var xPos = itemW * index,
				d    = delay * index
			;

			style += '#' + selector + ' li:nth-child(' + (index + 1) + ') .as-item:first-child { ' +
						'-webkit-animation-delay: ' + d + 's;' +
						'animation-delay: ' + d + 's;' +
					'} '
			;

			style += '#' + selector + ' li:nth-child(' + (index + 1) + ') .part { ' +
						'background-position: -' + xPos + 'px' +
					'} '
			;
		} );

		$stylesheet = $( '<style />', {
			id: 'st-' + guid,
			type: 'text/css',
			html: style
		} );

		$stylesheet.appendTo( 'head' );

	}

	function init() {

		$( '.as-slider-container' ).each( function( index, el ) {

			var $src        = $( el ).find( '.src' ),
				slideCount  = $src.find( 'li' ).length,
				guid        = getGuid(),
				$grid       = $( '<ul />', {
					class: 'as-grid as-effect-slide',
					id   : guid
				} ),
				isAnimating = false,
				current     = 0,
				tTimer      = null,
				dTimer      = null,
				rTimer      = null,
				$items
			;

			$grid.appendTo( $( el ) );

			$src.find( 'li' ).each( function( i, item ) {
				var itemSrc = $( item ).find( 'img' ).attr( 'src' );
				
				allItems[i] = [];

				for (var j = 0; j < split; j++) {
					allItems[i][j] = itemSrc;

					if( i === 0 ) {
						$grid.append( 
							$( '<li />', {
								html: $( '<div />', {
									 class: 'as-item',
									 html: $( '<div />', {
									 	class: 'part'
									 } ).css( {
									 	backgroundImage: 'url(' + itemSrc + ')'
									 } )
								} )
							} )
						);
					}
				}
			} );

			$items = $grid.find( 'li' );

			resizeAs( $grid );

			function play( i ) {
				isAnimating = true;
				current     = i;
				loadNewSet( i );

				tTimer = setTimeout( function() {
					i++;
					i = i < slideCount ? i : 0;
					play(i);
				}, transition );
			}

			// this is just a way we can test this. You would probably get your images with an AJAX request...
			function loadNewSet( set ) {
				var newItems = allItems[set];

				// apply effect
				dTimer = setTimeout( function() {
					
					// append new elements
					$( newItems ).each( function( i, itemSrc ) {
						var $parent  = $( $items[ i ] ),
							$oldItem = $parent.find( '.as-item' ),
							$newItem = $oldItem.clone()
						;

						$oldItem.addClass( 'as-old' );

						$newItem.find( '.part' ).css( {
							backgroundImage: 'url(' + itemSrc + ')'
						} );

						$newItem.appendTo( $parent );
					} );

					// add "effect" class to the grid
					$grid.addClass( 'as-effect-active' );
					
					// wait that animations end
					var onEndAnimFn = function() {
						// remove old elements
						$items.each( function( index, el ) {
							// remove old elems
							var old = $(el).find( '.as-item.as-old' );
							if( old.length ) { old.remove(); }
							// remove class "as-empty" from the empty items
							$(el).removeClass( 'as-empty' );
							// now apply that same class to the items that got no children (special case)
							if ( !el.hasChildNodes() ) {
								$(el).addClass( 'as-empty' );
							};
						} );
						// remove the "effect" class
						$grid.removeClass( 'as-effect-active' );
						isAnimating = false;
					};
					
					onAnimationEnd( $items, $items.length, onEndAnimFn );

				}, 25 );
				
			}

			tTimer = setTimeout( function() {
				play(1);
			}, transition );

			$( window ).on( 'resize', function () {
				rTimer = setTimeout( function() {
					clearTimeout( rTimer );
					clearTimeout( tTimer );
					// clearTimeout( dTimer );
					resizeAs( $grid );
					play( current );
				}, 250 );
			} );

		} );		
	}

	$( window ).on( 'load', init );

} )( jQuery );