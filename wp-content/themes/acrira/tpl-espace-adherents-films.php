<?php
/**
 * Template Name: Page Espace Adhérents - Les films
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

          $films = new WP_Query(
            array(
              'post_type'      => 'film',
              'order'          => 'ASC',
              'posts_per_page' => -1,
            )
          );

          ?>

            <div class="accordion col-md-12">

              <?php

              while ( $films->have_posts() ) : $films->the_post();

                get_template_part( 'template-parts/page/content', 'film' );

              endwhile; // End of the loop.

              ?>

            </div>

        </div><!-- #primary -->

    </div><!-- .wrap -->

<?php get_footer();
