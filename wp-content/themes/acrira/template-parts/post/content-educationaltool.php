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
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>
		<h2>
			<?php
				the_field( 'sous-titre' );
			?>
		</h2>

		<div>
			<span>Public : </span>
			<?php
				the_field( 'public' );
			?>
		</div>

		<div>
			<span>Public : </span>
			<?php
				the_field( 'duree' );
			?>
		</div>
	</header><!-- .entry-header -->

	<div class="infos">

		<?php 
			the_post_thumbnail( 'educationaltool', array(
				'class' => 'alignright',
			) ); 
		?>
		
		<h3>Objectifs :</h3><br />
		<p>
			<?php
				the_field( 'objectifs' );
			?>
		</p><br />
		
		<h3>Matériel :</h3><br />
		<p>
			<?php
				the_field( 'materiel' );
			?>
		
		</p>
	</div>
	
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
