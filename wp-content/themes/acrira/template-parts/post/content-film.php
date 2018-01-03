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
			<?php
				the_title( '<h3 class="entry-title">', '</h3>' );
			?>
		</div>
		<div class="film-realisateur">
			<span class="film-section-title">Réalisateur :</span>
			<?php
				the_field( 'realisateur' );
			?>
		</div>
		<div class="film-casting">
			<span class="film-section-title">Casting :</span>
			<?php
				the_field( 'casting' );
			?>
		</div>
		<div class="film-origine">
			<span class="film-section-title">Pays :</span>
			<?php
				the_field( 'origine' );
			?>
		</div>
		<?php
			$dateformatstring = "j F Y";
			$unixtimestamp = strtotime( get_field( 'sortie_nationale' ) );
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
