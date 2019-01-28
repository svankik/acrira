<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="film-title">
            <h3 class="entry-title">
                <?php
                    the_title( );
                ?>
                 de
                <?php
                    $first = TRUE;
                    $realisateurs = get_field( 'realisateurs' );

                    foreach ($realisateurs as $realisateur) {

                        if( !$first ) {
                            echo ', ';
                        }

                        echo $realisateur['realisateur'];

                        $first = FALSE;
                    }
                ?>
            </h3>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php if (!empty(get_field('casting'))) : ?>
            <div class="film-casting">
                <span class="film-section-title">Casting :</span>
		        <?php
		        the_field( 'casting' );
		        ?>
            </div>
        <?php endif; ?>

		<?php if (!empty(get_field('origine'))) : ?>
            <div class="film-origine">
                <span class="film-section-title">Pays :</span>
				<?php
				the_field( 'origine' );
				?>
            </div>
		<?php endif; ?>

        <?php
            $dateformatstring = "j F Y";
            $unixtimestamp = strtotime( get_field( 'sortie_nationale', false, false ) );
        ?>
        <div class="film-date-sortie">
            <span class="film-section-title">Date de sortie :</span>
            <?php
                echo date_i18n( $dateformatstring, $unixtimestamp );
            ?>
        </div>
        <div class="film-duree">
            <span class="film-section-title">Durée :</span>
            <?php
                the_field( 'duree' );
            ?>
        </div>
        <div class="film-link">
            <?php
                $post_link = get_the_permalink( get_the_ID() );
            ?>
            <a href="<?php echo $post_link; ?>">Voir la fiche film complète</a>
        </div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
