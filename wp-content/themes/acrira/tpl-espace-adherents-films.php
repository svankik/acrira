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

$user = wp_get_current_user();

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

				if ( $user->ID ) : ?>

                        <form name="films-filter" action="/espace-adherents-parlons-cinema" method="get">

                        <div class="orderby-area">

                            <h2>Trier les films par :</h2>

                            <select name="orderby">
                                <option value="title" <?php ( empty( $_GET['orderby'] || $_GET['orderby'] == 'title' ) ? print " selected" : "" ); ?>>Titre</option>
                                <option value="comment" <?php ( !empty( $_GET['orderby'] && $_GET['orderby'] == 'comment' ) ? print " selected" : "" ); ?>>Commentaires les plus récents</option>
                                <option value="sortie_nationale" <?php ( !empty( $_GET['orderby'] && $_GET['orderby'] == 'sortie_nationale' ) ? print " selected" : "" ); ?>>Date de sortie</option>
                            </select>

                            <input type="submit" value="Trier" />

                        </div>

                        <div class="filters-area">

                            <h2>Filtrer les films par :</h2>

                            <?php

                            $orderby = 'title';
                            $order = 'ASC';

                            if(!empty($_GET['orderby'])) {
                                switch ($_GET['orderby']) {
                                    case 'title':
                                        $orderby = 'title';
                                        $order = 'ASC';
                                        break;
                                    case 'comment':
                                        $post_in = array();

	                                    $comments_args = array(
		                                    'status' => 'approve',
		                                    'order' => 'DESC'
	                                    );

	                                    $comments = get_comments( $comments_args );

	                                    foreach ( $comments as $comment ) {
		                                    $post = get_post( $comment->comment_post_ID );
		                                    $post_in[] = $post->ID;
	                                    }

                                        $orderby = 'post__in';
	                                    $order = 'ASC';
                                        break;
                                    case 'sortie_nationale':
                                        $meta_key = 'sortie_nationale';
                                        $orderby = 'meta_value';
                                        $order = 'DESC';
                                        break;
                                }
                            }

                            $films = new WP_Query(
	                            array(
		                            'post_type'      => 'film',
		                            'posts_per_page' => -1,
	                            )
                            );

                            while ( $films->have_posts() ) : $films->the_post();

	                            foreach(get_field( 'realisateurs' ) as $key => $realisateur) {
		                            $realisateurs[] = $realisateur['realisateur'];
                                }
	                            foreach(get_field( 'genres' ) as $key => $genre) {
		                            $genres[] = $genre['genre'];
	                            }
	                            foreach(get_field( 'origines' ) as $key => $origine) {
		                            $origines[] = $origine['origine'];
	                            }

                            endwhile;

                            $realisateurs = array_unique($realisateurs);
                            sort($realisateurs);
                            $genres = array_unique($genres);
                            sort($genres);
                            $origines = array_unique($origines);
                            sort($origines);

                            ?>

                            <span>Réalisateur :</span>
                            <select name="realisateur">
                                <option value="">Tous</option>
                                <?php
                                foreach ($realisateurs as $realisateur) {
                                    print '<option value="' . $realisateur . '"' . ( !empty( $_GET['realisateur'] && $_GET['realisateur'] == $realisateur ) ? " selected" : "" ) . '>' . $realisateur . '</option>';
                                }
                                ?>
                            </select>

                            <span>Genre :</span>
                            <select name="genre">
                                <option value="">Tous</option>
		                        <?php
		                        foreach ($genres as $genre) {
			                        print '<option value="' . $genre . '"' . ( !empty( $_GET['genre'] && $_GET['genre'] == $genre ) ? " selected" : "" ) . '>' . $genre . '</option>';
		                        }
		                        ?>
                            </select>

                            <span>Origine :</span>
                            <select name="origine">
                                <option value="">Toutes</option>
		                        <?php
		                        foreach ($origines as $origine) {
			                        print '<option value="' . $origine . '"' . ( !empty( $_GET['origine'] && $_GET['origine'] == $origine ) ? " selected" : "" ) . '>' . $origine . '</option>';
		                        }
		                        ?>
                            </select>

                            <span>Jeune public :</span>
                            <input type="checkbox" name="type_public" value="1" <?php ( !empty( $_GET['type_public'] ) && $_GET['type_public'] == '1' ) ? print " checked" : ""; ?> />

                            <input type="submit" value="Filtrer" />
                        </div>

                        </form>

                        <?php

					    echo '<h2>' . $films->post_count . ' films correspondent à votre recherche.' . '</h2>';

					    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                        $args = array(
                            'post_type'      => 'film',
                            'orderby'        => $orderby,
                            'order'          => $order,
                            'posts_per_page' => 10,
                            'paged' => $paged
                        );

                        if(is_array($post_in)) {
                            $args['post__in'] = $post_in;
                        }

                        if(isset($meta_key)) {
                            $args['meta_key'] = $meta_key;
                        }

                        $args['meta_query'] = array(
                            'relation' => 'AND',
                            (!empty($_GET['realisateur'])) ? array(
                                'key'		=> 'realisateurs_%_realisateur',
                                'value'		=> $_GET['realisateur'],
                                'compare'	=> '='
                            ) : '',
                            (!empty($_GET['genre'])) ? array(
                                'key'		=> 'genres_%_genre',
                                'value'		=> $_GET['genre'],
                                'compare'	=> '='
                            ) : '',
                            (!empty($_GET['origine'])) ? array(
                                'key'		=> 'origines_%_origine',
                                'value'		=> $_GET['origine'],
                                'compare'	=> '='
                            ) : '',
                            (!empty($_GET['type_public'])) ? array(
                                'key'		=> 'type_public',
                                'value'		=> '',
                                'compare'	=> '!='
                            ) : '',
                        );

                        $films = new WP_Query( $args );

                        ?>

                        <div class="accordion col-md-12">

                            <?php
                            while ( $films->have_posts() ) : $films->the_post();

								get_template_part( 'template-parts/page/content', 'film' );

							endwhile; // End of the loop.

							?>

                            <div class="pagination">
								<?php
								echo paginate_links( array(
									'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
									'total'        => $films->max_num_pages,
									'current'      => max( 1, get_query_var( 'paged' ) ),
									'format'       => '?paged=%#%',
									'show_all'     => false,
									'type'         => 'plain',
									'end_size'     => 2,
									'mid_size'     => 1,
									'prev_next'    => true,
									'prev_text'    => 'Précédent',
									'next_text'    => 'Suivant',
									'add_args'     => false,
									'add_fragment' => '',
								) );
								?>
                            </div>

						</div>

					<?php 

				endif;

			?>

		</div><!-- #primary -->

	</div><!-- .wrap -->

<?php get_footer();
