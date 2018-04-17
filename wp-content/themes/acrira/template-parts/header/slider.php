<?php
	
	$menu_parent_id = acrira_get_menu_parent_ID( 'top' );

	?>
		<!-- <?php echo '@@ menu parent id: ' . $menu_parent_id ?> -->
	<?php

	switch ($menu_parent_id) {
		case get_theme_mod( 'acrira_menu_entry_1' ):
			$section = 'section1';
			break;

		case get_theme_mod( 'acrira_menu_entry_2' ):
			$section = 'section2';
			break;
		
		case get_theme_mod( 'acrira_menu_entry_3' ):
			$section = 'section3';
			break;

		case get_theme_mod( 'acrira_menu_entry_4' ):
			$section = 'section4';
			break;

		default:
			$section = false;
			break;
	}

	if( $section ) :
		
		$images = array();
		
		for( $i = 1; $i <= 3; $i++ ) {
			$image = acrira_get_slider_image( 'acrira_header_images_' . $section . '_image_' . $i );
			if( $image ) {
				$images[] = $image;
			}
		}

		if( ! empty( $images ) ) :

			?>

				<div class="header-slider-container">

					<div class="header-slider">
								
						<?php
							
							foreach ( $images as $key => $image ) :
								
								?>

									<div style="background-image: url(<?php echo $image['url']; ?>);">
										<?php if( $image['copyright'] ) : ?>
											<span class="copyright"><?php printf( '&copy; %s', $image['copyright'] ); ?></span>
										<?php endif; ?>
									</div>

								<?php
								 
							endforeach;

						?>

					</div>

				</div>

			<?php

		endif;

	endif;