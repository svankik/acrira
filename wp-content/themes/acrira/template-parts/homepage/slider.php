
<div class="as-wrapper">
	
	<section class="as-slider-container">
		<ul class="src">

			<?php
				// check if the repeater field has rows of data
				if( have_rows('slider') ):

					// loop through the rows of data
					while ( have_rows('slider') ) : the_row();

						$image = get_sub_field('image');

						?>
							<li>
								<img src="<?php echo $image['sizes']['aslider']; ?>" alt="<?php echo $image['alt'] ?>" />
								<span><?php if( $image['caption'] ) : ?><?php printf( '&copy; %s', $image['caption'] ); ?><?php endif; ?></span>
							</li>	
						<?php

					endwhile;

				endif;
			?>

		</ul>
	</section>

	<?php
		// check if the repeater field has rows of data
		if ( have_rows('colonne') ) :

			$thematics = array ();

			// loop through the rows of data
			while ( have_rows('colonne') ) : the_row();

				$thematics[] = array(
					'title'   => get_sub_field('titre'),
					'link'    => get_sub_field('lien'),
					'id_menu' => get_sub_field('id_menu'),
					'color'   => get_sub_field('couleur'),
				);

			endwhile;

			?>

				<section class="as-content-container">

					<ul class="thematics">
						<?php
							foreach ( $thematics as $key => $thematic ) :
								?>

									<li data-key="<?php echo $key; ?>" style="border-color: <?php echo $thematic['color']; ?>">
										
										<div>
											<h2>
												<a href="<?php echo $thematic['link']; ?>">
													<span>
														<span class="dot" style="background-color: <?php echo $thematic['color']; ?>"></span>
														<?php echo $thematic['title']; ?>
													</span>
												</a>
											</h2>
											<div class="navigation" style="border-color: <?php echo $thematic['color']; ?>">
												<nav>							
													<?php
														wp_nav_menu( array( 
															'theme_location' => 'top',
															'start_in'       => $thematic['id_menu'],
															'container'      => false,
															'items_wrap'     => '%3$s',
														) );
													?>
												</nav>
											</div>								
										</div>

									</li>

								<?php
							endforeach;
						?>
					</ul>

				</section>

			<?php

		endif;
	?>

</div>