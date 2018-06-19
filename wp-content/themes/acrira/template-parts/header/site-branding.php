<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-branding container">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="logo-container">
				<?php the_custom_logo(); ?>
			</div>
		</div>

		<?php 

			if ( is_front_page() && have_rows('actualites') ) :

				get_template_part( 'template-parts/header/news', 'slider' );

			endif;

		?>
	</div><!-- .row -->
</div><!-- .site-branding -->
