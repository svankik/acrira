<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

$user = wp_get_current_user();

get_header(); ?>

<div class="container">
	<div class="content-area row">
		<main id="main" class="site-main col-md-12" role="main">

			<?php if ( $user->ID ) : ?>
				
				<?php if ( have_posts() ) : ?>
					<header class="page-header">
						<?php
							$title        = '';
							$introduction = '';

							if ( isset( $_GET['secteur'] ) ) {
								switch($_GET['secteur']) {
									case 'lyceens-et-apprentis-au-cinema':
										$title = 'Les films';
										$introduction = __( '%% lycéens et apprentis au cinema / films introduction', 'acrira' );
										break;
								}				
							}

							if ( ! empty ( $title ) ) {
								echo '<h1 class="page-title">'.$title.'</h1>';
							}

							echo $introduction;
						?>
					</header><!-- .page-header -->
				<?php endif; ?>

				<?php

					if ( have_posts() ) : ?>
						<div id="film-list">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/post/content', get_post_type() );

							endwhile;

							the_posts_pagination( array(
								'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
								'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
							) ); ?>
						</div>
					<?php
					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
				
			else : 

				get_template_part( 'template-parts/post/content', 'none' );

			endif;

			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
