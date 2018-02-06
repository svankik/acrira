
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
								<img src="<?php echo $image['sizes']['aslider']; ?>" alt="<?php $image['alt'] ?>" />
							</li>	
						<?php

					endwhile;

				endif;
			?>

		</ul>
	</section>

	<?php
		// check if the repeater field has rows of data
		if( have_rows('colonne') ):

			$thematics = array ();

			// loop through the rows of data
			while ( have_rows('colonne') ) : the_row();

				$thematics[] = array(
					'title'   => get_sub_field('titre'),
					'text'    => get_sub_field('texte'),
					'id_menu' => get_sub_field('id_menu'),
				);

			endwhile;

			?>

				<section class="as-content-container">

					<ul class="titles">
						<?php
							foreach ( $thematics as $key => $thematic ) :
								?>

									<li>
										
										<div>
											<h2>
												<?php echo $thematic['title']; ?>
											</h2>
										</div>

									</li>

								<?php
							endforeach;
						?>
					</ul>

					<ul class="texts">
						<?php
							foreach ( $thematics as $key => $thematic ) :
								?>

									<li>
										
										<div>
											<div>
												<?php echo $thematic['text']; ?>
											</div>								
										</div>

									</li>

								<?php
							endforeach;
						?>
					</ul>

				</section>

				<section class="as-navigation-container">

					<ul class="navigations">
						<?php
							foreach ( $thematics as $key => $thematic ) :
								?>

									<li>
										
										<div>
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
