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

                        <div class="filters-area">

                            <h2>Filtrer les films</h2>

                            <?php

                            $films = new WP_Query(
	                            array(
		                            'post_type'      => 'film',
		                            'orderby'        => 'title',
		                            'order'          => 'ASC',
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

                            <form name="films-filter" action="/espace-adherents-parlons-cinema" method="get">

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

                            </form>
                        </div>

                        <h2>Les films</h2>

						<div class="accordion col-md-12">

							<?php

							$args = array(
								'post_type'      => 'film',
								'orderby'        => 'title',
								'order'          => 'ASC',
								'posts_per_page' => -1
							);

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

							while ( $films->have_posts() ) : $films->the_post();

								get_template_part( 'template-parts/page/content', 'film' );

							endwhile; // End of the loop.

							?>

						</div>

					<?php 

				endif;

			?>

		</div><!-- #primary -->

	</div><!-- .wrap -->

<?php get_footer();
