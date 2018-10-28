<?php
/**
 * The template for displaying all pages
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
	<?php get_sidebar(); ?>
	<div class="content-area row">

		<main id="main" class="site-main col-md-12" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

			endwhile; // End of the loop.
			?>

			<?php

			global $current_user;
			get_currentuserinfo();

			?>

			<div class="welcome">
                <?php echo 'Bienvenue ' . $current_user->user_login . "\n"; ?>
            </div>

            <div class="parlons-cinema">
                <?php
	            the_field( 'parlons_cinema' );
	            ?>
            </div>

            <div class="documents-ressources">
				<?php
				the_field( 'documents_ressources' );
				?>
            </div>

            <div class="rapport-annuel-activites">
				<?php
				the_field( 'rapport_annuel_activites' );
				?>
            </div>

            <div class="comptes-rendus">
				<?php
				the_field( 'comptes_rendus' );
				?>
            </div>


		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
