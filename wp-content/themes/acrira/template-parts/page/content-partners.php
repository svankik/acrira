<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twentyseventeen_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->
	
	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->

	<?php if( get_field( 'filtres' ) ) : ?>

		<div class="entry-partners-filters">
			
			Filtrer par : <a href="#" data-key="all">Tous</a> |	<a href="#" data-key="cultural">Partenaires culturels</a> | <a href="#" data-key="financial">Partenaires financiers</a>

		</div>

	<?php endif; ?>

	<div class="entry-partners row">
		
		<?php

			// loop through the rows of data
			while ( have_rows('partenaires') ) : the_row();

				$name  = get_sub_field( 'nom' );
				$link  = get_sub_field( 'lien' );
				$type  = implode( ' ', get_sub_field( 'type' ) );
				$image = get_sub_field( 'image' );

				?>
					<div class="partner col-sm-3 col-xs-4 <?php echo $type; ?>">
						
						<a href="<?php echo $link; ?>" target="_blank">
							<img src="<?php echo $image['sizes']['partner']; ?>" alt="<?php echo $name; ?>" />
						</a>

					</div>	
				<?php

			endwhile;

		?>

	</div>

</article><!-- #post-## -->
