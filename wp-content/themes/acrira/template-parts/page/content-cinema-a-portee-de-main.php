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

			// check if the repeater field has rows of data
			if( have_rows('bloc') ):

				?>

				<div class="info-row">
					
					<?php

					// loop through the rows of data
					while ( have_rows('bloc') ) : the_row();

						$text  = get_sub_field( 'texte' );
						$color = get_sub_field( 'couleur' );

						?>
							<div class="info-bloc">
								<div style="background-color: <?php print $color; ?>">
									<?php echo $text ?>
								</div>
							</div>	
						<?php

					endwhile;

				endif;
			?>

		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
