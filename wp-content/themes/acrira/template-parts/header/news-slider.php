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

<div class="col-md-9 col-sm-6 hidden-xs">

	<div class="news">

		<h2><?php _e( 'News', 'acrira' ); ?></h2>

		<div class="wrapper">
			<ul class="news-slider">

				<?php 
				
					while ( have_rows('actualites') ) : the_row();

							$title  = get_sub_field( 'titre' );
							$text   = get_sub_field( 'texte' );
							$photo  = get_sub_field( 'photo' );
							$link   = get_sub_field( 'lien' );
							$color  = get_sub_field( 'secteur' );
							$target = strpos( $link, get_bloginfo( 'url' ) ) === false ? '_blank' : '';

							?>					

								<li class="news-item" style="border-color: <?php echo $color; ?>;"> 
									<ul class="scroll">
										<li>
											<?php if ( $link && $photo ) : ?><a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php endif; ?>
												<?php if ( $photo ) : ?><img src="<?php echo $photo['sizes']['news']; ?>" alt="<?php $photo['alt'] ?>" class="align-left" /><?php endif; ?>
											<?php if ( $link && $photo ) : ?></a><?php endif; ?>

											<div class="text-wrapper">
												<h3>
													<?php if ( $link ) : ?><a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php endif; ?>
														<span class="dot" style="background-color: <?php echo $color; ?>;"></span>
														<?php echo $title; ?>
													<?php if ( $link ) : ?></a><?php endif; ?>
												</h3>												
											</div>

											<?php echo $text; ?>
										</li>															
									</ul>
								</li>

							<?php 

					endwhile;

				?>					

			</ul><!-- .scroll -->
		</div><!-- .wrapper -->
	</div><!-- .news -->
</div>
