<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

            <?php
                if ( $user->ID ) :
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/film/content', get_post_type() );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

	                    add_filter('get_previous_post_sort', 'acrira_previous_post_orderby_name', 10, 1);
	                    add_filter('get_next_post_sort', 'acrira_next_post_orderby_name', 10, 1);
	                    add_filter('get_previous_post_where', 'acrira_previous_post_where_name', 10);
	                    add_filter('get_next_post_where', 'acrira_next_post_where_name', 10);

                        the_post_navigation( array(
                            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
                            'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
                        ) );

	                    remove_filter('get_previous_post_sort', 'acrira_previous_post_orderby_name', 10);
	                    remove_filter('get_next_post_sort', 'acrira_next_post_orderby_name', 10);
	                    remove_filter('get_previous_post_where', 'acrira_previous_post_where_name', 10);
	                    remove_filter('get_next_post_where', 'acrira_next_post_where_name', 10);

                    endwhile; // End of the loop.

                endif;
            ?>

        </main><!-- #main -->

	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
