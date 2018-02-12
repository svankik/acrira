<?php
	
	$menu_parent_id = acrira_get_menu_parent_ID( 'top');

	// print 'menu_parent_id' . $menu_parent_id;

	switch ($menu_parent_id) {
		case '32':
			$section = 'section1';
			break;

		case '57':
			$section = 'section2';
			break;
		
		case '92':
			$section = 'section3';
			break;

		case '107':
			$section = 'section4';
			break;

		default:
			$section = false;
			break;
	}

	if( $section ) :
		
		$images = array();
		
		for( $i = 1; $i <= 3; $i++ ) {
			$image_url = acrira_get_slider_image_src( 'acrira_header_images_' . $section . '_image_' . $i );
			if( $image_url ) {
				$images[] = $image_url;
			}
		}

		if( ! empty( $images ) ) :

			?>

				<div class="header-slider-container">

					<div class="header-slider">
								
						<?php
							
							foreach ( $images as $key => $image ) :
								
								?>

									<div style="background-image: url(<?php echo $image; ?>);"></div>

								<?php
								 
							endforeach;

						?>

					</div>
					
				</div>

			<?php

		endif;

	endif;