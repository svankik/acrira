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
		<div class="title">
			<?php
				the_title( '<h3 class="entry-title">', '</h3>' );
			?>
		</div>
		<div class="subtitle">
			<?php
				printf( '%s (%s)', get_field( 'ville' ), get_field( 'departement' ) );
			?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="content">
			<?php
				/* translators: %s: Name of current post */
				the_content();
			?>
		</div>
		<div class="public-contact">
			<?php
				the_field( 'contact_public' );
			?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
