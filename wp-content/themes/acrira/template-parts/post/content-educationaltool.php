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
		<div class="educationaltool-title">
			<?php
				the_title( '<h3 class="entry-title">', '</h3>' );
			?>
		</div>
		<div class="edcationaltool-subtitle">
			<?php
				the_field( 'sous-titre' );
			?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="educationaltool-public">
			<span class="educationaltool-section-title educationaltool-public">Public :</span>
			<?php
				the_field( 'public' );
			?>
		</div>

		<div class="educationaltool-duree">
			<span class="educationaltool-section-title educationaltool-duree">Durée :</span>
			<?php
				the_field( 'duree' );
			?>
		</div>

		<div class="educationaltool-separator" />

		<div class="educationaltool-objectifs">
			<span class="educationaltool-section-title educationaltool-objectifs">Objectifs :</span>
			<p>
				<?php
					the_field( 'objectifs' );
				?>
			</p>
		</div>

		<div class="educationaltool-materiel">
			<span class="educationaltool-section-title educationaltool-materiel">Matériel :</span>
			<p>
				<?php
					the_field( 'materiel' );
				?>
			</p>
		</div>

		<div class="educationaltool-separator" />
		
		<div class="educationaltool-content">
			<?php
				/* translators: %s: Name of current post */
				the_content();
			?>
		</div>
		
	</div><!-- .entry-content -->
</article><!-- #post-## -->
