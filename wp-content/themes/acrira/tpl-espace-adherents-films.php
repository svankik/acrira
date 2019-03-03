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
                                    print '<option value="' . $realisateur . '">' . $realisateur . '</option>';
                                }
                                ?>
                            </select>

                            <span>Genre :</span>
                            <select name="genre">
                                <option value="">Tous</option>
		                        <?php
		                        foreach ($genres as $genre) {
			                        print '<option value="' . $genre . '">' . $genre . '</option>';
		                        }
		                        ?>
                            </select>

                            <span>Origine :</span>
                            <select name="origine">
                                <option value="">Toutes</option>
		                        <?php
		                        foreach ($origines as $origine) {
			                        print '<option value="' . $origine . '">' . $origine . '</option>';
		                        }
		                        ?>
                            </select>

                            <span>Jeune public :</span>
                            <input type="checkbox" name="type_public" value="1" />

                            <input type="submit" value="Filtrer" />

                            </form>
                        </div>

                        <h2>Les films</h2>

						<div class="accordion col-md-12">

							<?php

							if(!empty($_GET['realisateur'])) {

							}

							if(!empty($_GET['genre'])) {

							}

							if(!empty($_GET['origine'])) {

							}

							$films = new WP_Query(
								array(
									'post_type'      => 'film',
									'orderby'        => 'title',
									'order'          => 'ASC',
									'posts_per_page' => -1,
								)
							);

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
