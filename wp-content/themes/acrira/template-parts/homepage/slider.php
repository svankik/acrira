
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
					'color'   => get_sub_field('couleur'),
				);

			endwhile;

			?>

				<section class="as-content-container">

					<ul class="thematics">
						<?php
							foreach ( $thematics as $key => $thematic ) :
								?>

									<li data-key="<?php echo $key; ?>">
										
										<div>
											<h2>
												<span><span class="dot" style="background-color: <?php echo $thematic['color']; ?>"></span><?php echo $thematic['title']; ?></span>
											</h2>
											<div class="text">
												<?php echo $thematic['text']; ?>
											</div>								
											<nav class="visible-xs-block visible-sm-block" style="background-color: <?php echo $thematic['color']; ?>">							
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

<section class="as-navigation-container visible-md-block visible-lg-block">

	<ul class="navigations">
		<?php
			foreach ( $thematics as $key => $thematic ) :
				?>

					<li>
						
						<div style="background-color: <?php echo $thematic['color']; ?>" class="equal-height">
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
