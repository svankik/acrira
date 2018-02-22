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
				<?php the_custom_logo(); ?>
			</div>
		</div>

		<div class="site-branding-text col-md-9 col-sm-6 hidden-xs">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title sr-only"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title sr-only"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php
			$description = get_bloginfo( 'description', 'display' );

			if ( $description || is_customize_preview() ) :
			?>
				<!-- <p class="site-description"><?php echo $description; ?></p> -->
				<p class="site-description">

					<span>A</span>ssociation des <br />
					<span>C</span>inémas de <br />
					<span>R</span>echerche <br />
					<span>I</span>ndépendants de la <br />
					<span>R</span>égion <span>A</span>lpine

				</p>
			<?php endif; ?>
		</div><!-- .site-branding-text -->

		<?php if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'twentyseventeen' ); ?></span></a>
		<?php endif; ?>
	</div><!-- .row -->
</div><!-- .site-branding -->
