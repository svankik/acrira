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
    <div class="row">
        <header class="col-md-12">
            <h1 class="entry-title">Espace adhérents</h1>
            <p><a href="/espace-adherents-parlons-cinema"><< Retour à la liste des films</a></p>
            <h2 class="film-title">
                <?php the_title(); ?>
            </h2>
            <h3 class="realisateurs">
                <?php
                    $first = TRUE;
                    $realisateurs = get_field( 'realisateurs' );
                    $str_realisateurs = '';
                    
                    foreach ($realisateurs as $realisateur) {
                        
                        if( !$first ) {
                            $str_realisateurs .= ', ';
                        }
                        
                        $str_realisateurs .= $realisateur['realisateur'];
                        
                        $first = FALSE;
                    }
                    
                    printf( 'de %s', $str_realisateurs );
                    ?>
            </h3>
        </header><!-- .entry-header -->
        <div class="col-md-12">

            <?php the_post_thumbnail( 'educationaltool', array( 'class' => 'cover alignright' ) ); ?>
            
            <div class="entry-metas">  
                <?php
                
                    $public = get_field( 'type_public' );
                    
                    if( isset( $public[0] ) && $public[0] ) :
                        ?>
                            <span class="public">
                                <?php _e( 'Jeune public', 'acrira' ); ?>
                            </span>
                        <?php 
                    endif;
                    
                ?>
                <?php if (!empty(get_field('genres'))) : ?>
                    <span class="film-genres">
                        <?php
                            $genres = get_field( 'genres' );
                            $str_genres = '';
                            $first = true;
                            
                            foreach( $genres as $genre ) {
                                if( !$first ) {
                                    $str_genres .= ', ';
                                }
                                
                                $str_genres .= $genre['genre'];
                                
                                $first = false;
                            }
                            
                            print $str_genres;
                        ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty(get_field('origines'))) : ?>
                    <span class="film-origines">
                        <?php
                            $origines = get_field( 'origines' );
                            $str_origines = '';
                            $first = true;
                            
                            foreach( $origines as $origine ) {
                                if( !$first ) {
                                    $str_origines .= ', ';
                                }
                                
                                $str_origines .= $origine['origine'];
                                
                                $first = false;
                            }
                            
                            print $str_origines;
                            ?>
                    </span>
                    <?php endif; ?>
                    
                <?php if (!empty(get_field('distributeur'))) : ?>
                    <span class="film-distributeur">
                        <?php
                            the_field( 'distributeur' );
                        ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty(get_field('duree'))) : ?>
                    <span class="film-duree">
                        <?php
                            the_field( 'duree' );
                        ?>
                    </span>
                <?php endif; ?>

                <?php                    
                    if( !empty( get_field( 'sortie_nationale' ) ) ) :
                        $dateformatstring = "j F Y";
                        $unixtimestamp = strtotime( get_field( 'sortie_nationale', false, false ) );
                        
                        ?>
                            <span class="film-date-sortie">
                                <?php
                                    printf( '%s %s', __( 'Sortie le', 'acrira' ), date_i18n( $dateformatstring, $unixtimestamp ) );
                                    ?>
                            </span>
                        <?php 
                    endif; 
                ?>

                <?php if (!empty(get_field('soutiens'))) : ?>
                    <span class="film-soutiens">
                        <?php
                            $soutiens = get_field( 'soutiens' );
                            $str_soutiens = '';
                            $first = true;
                            
                            foreach( $soutiens as $soutien ) {
                                if( !$first ) {
                                    $str_soutiens .= ', ';
                                }
                                
                                $str_soutiens .= $soutien['soutien'];
                                
                                $first = false;
                            }
                            
                            printf( '%s %s', _n( 'Soutien', 'Soutiens', count( $soutiens ), 'acrira' ), $str_soutiens );
                        ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty(get_field('casting'))) : ?>
                    <br />
                    <span class="film-casting">
                        <?php
                            the_field( 'casting' );
                        ?>
                    </span>
                <?php endif; ?>
            </div>


            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
