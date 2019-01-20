<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
?>
<nav id="site-navigation-header" class="header-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Header Menu', 'twentyseventeen' ); ?>">
	<button class="menu-toggle" aria-controls="header-menu" aria-expanded="false">
		<?php
		echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) );
		echo twentyseventeen_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'twentyseventeen' );
		?>
	</button>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php wp_nav_menu( array(
					'theme_location' => 'social',
					'menu_id'        => 'header-menu',
				) ); ?>	
			</div>
		</div>	
	</div>

	<?php if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'twentyseventeen' ); ?></span></a>
	<?php endif; ?>
</nav><!-- #site-navigation-header -->
