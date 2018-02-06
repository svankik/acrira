
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

	<section class="as-content-container">

		<ul class="thematics">

			<?php
				$cols = 12 / get_field('nombre_de_colonnes');

				// check if the repeater field has rows of data
				if( have_rows('colonne') ):

					// loop through the rows of data
					while ( have_rows('colonne') ) : the_row();

						?>

							<li>
								
								<div>
									<h2>
										<?php the_sub_field('titre'); ?>
									</h2>
									
									<div>
										<?php the_sub_field('texte'); ?>
									</div>								

									<nav>							
										<?php
											wp_nav_menu( array( 
												'theme_location' => 'top',
												'start_in'       => get_sub_field('id_menu'),
												'container'      => false,
												'items_wrap'     => '%3$s',
											) );
										?>
									</nav>
								</div>

							</li>

						<?php
					endwhile;

				endif;
			?>

		</ul>

	</section>

</div>
