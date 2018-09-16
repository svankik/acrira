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
				printf( '%s (%s)', get_field( 'ville' ), get_field( 'departement' ) );
			?>
		</div>
		<div class="subtitle">
			<?php
				the_title( '<h2 class="entry-title">', '</h2>' );
			?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="locales-coordinations">
			<?php
				the_field( 'coordinations_locales' );
			?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
