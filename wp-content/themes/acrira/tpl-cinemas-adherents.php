<?php
/**
 * Template Name: Cinémas Adhérents (Cinémas en réseau)
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="container">

	<div class="content-area row">

		<main id="main" class="site-main col-md-12" role="main">

			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/page/content', 'page' );

				endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<?php

		$cinemas = new WP_Query( 
			array(
				'post_type'      => 'cinema',
				'category_name'  => 'cinemas-en-reseau',
				'orderby'        => 'meta_value',
				'meta_key'		 => 'ville',
				'order'          => 'ASC',
				'posts_per_page' => -1,
			)
		);

		?>

		<div class="entry-map">
				
			<div class="acf-map" style="width:100%; height: 400px;">

				<?php

				while ( $cinemas->have_posts() ) : $cinemas->the_post();

					$map = get_field ( 'location' );

				?>

					<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>">
						
						<div class="sr-only">

							<h1 class="bold"><?php bloginfo( 'name' ); ?></h1>

							<?php

								$description = get_bloginfo( 'description', 'display' );

								if ( $description || is_customize_preview() ) :
								
									?>
										<p class="bold"><?php echo $description; ?></p>
									<?php 

								endif; 

							?>	
						
						</div>

						<div class="logo"><span class="icon-logo"></span></div>

						<p class="map-address bold"><?php echo $map['address']; ?></p>

					</div>
				<?php

				endwhile; // End of the loop.

				?>
			</div>
		</div>


		<div class="accordion col-md-12">
		
			<?php
				
				$cinemas->wp_rewind_posts();

				while ( $cinemas->have_posts() ) : $cinemas->the_post();

					get_template_part( 'template-parts/post/content', 'accordion' );

				endwhile; // End of the loop.

			?>
		
		</div>

	</div><!-- #primary -->

</div><!-- .wrap -->

<?php get_footer();
