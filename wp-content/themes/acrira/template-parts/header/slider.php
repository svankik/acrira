<?php

	$menu_parent_id = acrira_get_menu_parent_ID( 'top');

	print 'menu_parent_id' . $menu_parent_id;

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
			$section = 'home';
			break;
	}

	if( $section != 'home' ) {
		$images = array();
		for( $i = 1; $i <= 3; $i++ ) {
			$image_url = acrira_get_slider_image_src('acrira_header_images_' . $section . '_image_' . $i);
			if( $image_url != '' ) {
				$images[] = $image_url;
			}
		}
	}
?>

<?php if( $section != 'home' ): ?>
	<div id="header-slider" style="position:absolute; top:0; width: 100%; height: 400px; background-image: url(<?php echo $images[0]; ?>);">
	</div>
<?php endif; ?>