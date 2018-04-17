<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-branding container">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="logo-container">
				<?php the_custom_logo(); ?>
			</div>
		</div>

		<?php 

			if ( is_front_page() && have_rows('actualites') ) :

				?>					

					<div class="col-md-9 col-sm-6 hidden-xs">

						<h2><?php _e( 'News', 'acrira' ); ?></h2>

						<div class="news">

							<div class="wrapper">
								<div class="scroll">

									<?php 

									
										while ( have_rows('actualites') ) : the_row();

												$title  = get_sub_field( 'titre' );
												$text   = get_sub_field( 'texte' );
												$photo  = get_sub_field( 'photo' );
												$link   = get_sub_field( 'lien' );
												$color  = get_sub_field( 'secteur' );
												$target = strpos( $link, get_bloginfo( 'url' ) ) !== false ? '_blank' : '';

												?>					

													<div class="news-item" style="border-color: <?php echo $color; ?>;"> 
														<h3>
															<?php if ( $link ) : ?><a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php endif; ?>
																<span class="dot" style="background-color: <?php echo $color; ?>;"></span>
																<?php echo $title; ?>
															<?php if ( $link ) : ?></a><?php endif; ?>
														</h3>

														<?php if ( $link && $photo ) : ?><a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php endif; ?>
															<img src="<?php echo $photo['sizes']['news']; ?>" alt="<?php $photo['alt'] ?>" class="align-left" />
														<?php if ( $link && $photo ) : ?></a><?php endif; ?>

														<?php echo $text; ?>
													</div>

												<?php 

										endwhile;

									?>					

								</div><!-- .scroll -->
							</div><!-- .wrapper -->
						</div><!-- .news -->
					</div>

				<?php 


			endif;

		?>

		<?php 
			if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : 
				?>
					<a href="#content" class="menu-scroll-down">
						<?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?>
						<span class="screen-reader-text"><?php _e( 'menu-scroll-downll down to content', 'twentyseventeen' ); ?></span>
					</a>
				<?php 
			endif; 
		?>
	</div><!-- .row -->
</div><!-- .site-branding -->
