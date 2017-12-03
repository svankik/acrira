<?php
	$images = array();
	for( $i = 1; $i <= 10; $i++ ) {
		$image_url = acrira_get_slider_image_src('acrira_homepage_slider_image_' . $i);
		if( $image_url != '' ) {
			$images[] = $image_url;
		}
	}
?>

<div id="slider">
	
	<div id="cinemas-en-reseau" style="background-image: url(<?php echo $images[0]; ?>);">
		<div class="sector-title">
			Cinémas en réseau
		</div>
		<div class="menu">
			<?php 
			wp_nav_menu( array( 
				'theme_location' => 'top',
				'start_in' => 32,
				'container' => false,
				'items_wrap' => '%3$s',
			) );
			?>
		</div>
	</div>

	<div id="lyceens-et-apprentis-au-cinema" style="background-image: url(<?php echo $images[0]; ?>);">
		<div class="sector-title">
			Lycéens & apprentis au cinéma
		</div>
		<div class="menu">
			<?php 
			wp_nav_menu( array( 
				'theme_location' => 'top',
				'start_in' => 57,
				'container' => false,
				'items_wrap' => '%3$s',
			) );
			?>
		</div>
	</div>

	<div id="passeurs-dimages" style="background-image: url(<?php echo $images[0]; ?>);">
		<div class="sector-title">
			Passeurs d'images
		</div>
		<div class="menu">
			<?php 
			wp_nav_menu( array( 
				'theme_location' => 'top',
				'start_in' => 92,
				'container' => false,
				'items_wrap' => '%3$s',
			) );
			?>
		</div>
	</div>

	<div id="le-cinema-a-portee-de-main" style="background-image: url(<?php echo $images[0]; ?>);">
		<div class="sector-title">
			Le cinéma à portée de main
		</div>
		<div class="menu">
			<?php 
			wp_nav_menu( array( 
				'theme_location' => 'top',
				'start_in' => 107,
				'container' => false,
				'items_wrap' => '%3$s',
			) );
			?>
		</div>
	</div>
</div>