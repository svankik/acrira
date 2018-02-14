<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ) :
?>

	<aside class="widget-area col-md-12" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'twentyseventeen' ); ?>">
		<div class="row">
			<?php
			if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
				<div class="widget-column footer-widget-1 col-md-6">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
				<div class="widget-column footer-widget-2 col-md-6">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php } ?>			
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
