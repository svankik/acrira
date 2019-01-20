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

$user = wp_get_current_user();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php

			if( $user->ID ) :

				?>

					<h2 class="welcome">
						<?php printf( 'Bienvenue « %s »', $user->display_name ); ?>
					</h2>

				<?php

			endif;

		?>

	</header><!-- .entry-header -->
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php

		if( $user->ID ) :

			?>

				<div class="row">

					<div class="col-md-6">
						<div class="parlons-cinema block">
							<?php the_field( 'parlons_cinema' ); ?>
						</div>
						<div class="rapport-annuel-activites block">
							<?php the_field( 'rapport_annuel_activites' ); ?>
						</div>
                        <div class="parlons-cinema block">
							<?php the_field( 'divers' ); ?>
                        </div>
					</div>

					<div class="col-md-6">
						<div class="documents-ressources block">
							<?php the_field( 'documents_ressources' ); ?>
						</div>
						<div class="comptes-rendus block">
							<?php the_field( 'comptes_rendus' ); ?>
						</div>
					</div>
					
				</div>
			<?php

		endif;

	?>

</article><!-- #post-## -->
