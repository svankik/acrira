<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

$sector         = get_field( 'secteur' );
$menu_parent_id = ! empty( $sector ) ? get_theme_mod( 'acrira_menu_entry_' . $sector ) : acrira_get_menu_parent_ID( 'top' );
$color          = get_theme_mod( 'acrira_menu_color_' . $menu_parent_id, '#fff' );

?>
<style type="text/css">
	article h1 {
		color: <?php echo $color; ?> !important;
	}

	article .welcome {
		color: <?php echo $color; ?> !important;
	}

	.navigation-top,
	.navigation-top .sub-menu {
		background-color: <?php echo $color; ?>;
	}
</style>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentyseventeen' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
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
					'theme_location' => 'top',
					'menu_id'        => 'top-menu',
				) ); ?>	
			</div>
		</div>	
	</div>

	<?php if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'twentyseventeen' ); ?></span></a>
	<?php endif; ?>
</nav><!-- #site-navigation -->
