<?php

/**
 * Includes
 */
// Custom Post Types, Custom Fields and Taxonomies
require_once( 'inc/custom-post-types.php' );
require_once( 'inc/custom-fields.php' );
// require_once( 'inc/custom-taxonomies.php' );

/**
 * Theme setup
 *
 * @return  void
 */
function acrira_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'acrira', get_stylesheet_directory () . '/assets/lang' );

	// Add image sizes
	add_image_size ( 'aslider', 1200, 545, true );
	add_image_size ( 'hslider', 1200, 400, true );
	add_image_size ( 'partner', 300, 300 );
	add_image_size ( 'news', 200, 150, true );
	add_image_size ( 'educationaltool', 600, 600 );
}
add_action( 'after_setup_theme', 'acrira_setup' );

/**
 * Enqueue scripts and stylesheets
 *
 * @return  void
 */
function acrira_enqueue_styles() {
	$parent_style = 'twentyseventeen-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/assets/css/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);

	// JQuery UI Core
	wp_enqueue_script ( 'jquery-ui-core' );

	// JQuery UI Accordion
	wp_enqueue_script ( 'jquery-ui-accordion' );

	wp_enqueue_script ( 'bx-slider',
		get_stylesheet_directory_uri() . '/assets/js/jquery.bxslider.min.js',
		array( 'jquery' ),
		wp_get_theme()->get('Version')
	);

	wp_enqueue_script ( 'acrira',
		get_stylesheet_directory_uri() . '/assets/js/acrira.js',
		array( 'jquery-ui-accordion', 'bx-slider' ),
		wp_get_theme()->get('Version')
	);

	if( is_front_page() || is_home() ) {
		wp_enqueue_script ( 'aslider',
			get_stylesheet_directory_uri() . '/assets/js/aslider.js',
			array( 'jquery' ),
			wp_get_theme()->get('Version')
		);
	}
}
add_action( 'wp_enqueue_scripts', 'acrira_enqueue_styles' );

/**
 * Callback function to filter the MCE settings
 *
 * @param   array  $init_array
 *
 * @return  array
 */
function acrira_mce_before_init_insert_formats( $init_array ) {  
	
	$style_formats = array(  
		array(  
			'title'   => __ ( 'Sub Title (Educational tool)', 'acrira' ),  
			'inline'  => 'span',  
			'classes' => 'et-sub-title',
		),  
		array(  
			'title'   => __ ( 'Informations (Educational tool)', 'acrira' ),  
			'inline'  => 'span',  
			'classes' => 'et-infos',
		),  
		// array(  
		// 	'title'   => __ ( 'Justify', 'acrira' ),  
		// 	'block'   => 'p',  
		// 	'classes' => 'justify',
		// ),  
		// array(  
		// 	'title'   => __ ( 'Bold', 'acrira' ),  
		// 	'inline'  => 'span',  
		// 	'classes' => 'bold',
		// ),  
		// array(  
		// 	'title'   => __ ( 'Condensed', 'acrira' ),  
		// 	'inline'  => 'span',  
		// 	'classes' => 'condensed',
		// ),  
		// array(  
		// 	'title'   => __ ( 'Italic', 'acrira' ),  
		// 	'inline'  => 'span',  
		// 	'classes' => 'italic',
		// ),  
		// array(  
		// 	'title'   => __ ( 'Clearfix', 'acrira' ),  
		// 	'block'   => 'div',  
		// 	'classes' => 'clearfix',
		// ),  
		// array(  
		// 	'title'    => __ ( 'Document', 'acrira' ),  
		// 	'inline'   => 'a',  
		// 	'classes'  => 'document',
		// 	'selector' => 'a',
		// ),  
		// array(  
		// 	'title'    => __ ( 'Rounded Button', 'acrira' ),  
		// 	'inline'   => 'a',  
		// 	'classes'  => 'rounded-button',
		// 	'selector' => 'a',
		// ),  
	); 

	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
add_filter( 'tiny_mce_before_init', 'acrira_mce_before_init_insert_formats' ); 

/**
 * Registers an editor stylesheet for the theme.
 *
 * @return  void
 */
function acrira_add_editor_styles() {

	add_editor_style( get_stylesheet_directory_uri () . '/assets/css/editor.css' );

}
add_action( 'admin_init', 'acrira_add_editor_styles' );

/**
 * Add some custom them options
 *
 * @param   object  $wp_customize
 *
 * @return  void
 */
function acrira_theme_customizer( $wp_customize ) {

	// Admin for homepage slider images
	// $wp_customize->add_section( 'acrira_homepage_slider_section' , array(
	// 	'title'       => __( 'Homepage slider images', 'acrira' ),
	// 	'priority'    => 30,
	// 	'description' => __( 'Upload images for homepage slider.', 'acrira' ),
	// ) );

	// for( $i = 1; $i <= 10; $i++ ) {
	// 	$wp_customize->add_setting( 'acrira_homepage_slider_image_' . $i );
	// 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'acrira_homepage_slider_image_' . $i, array(
	// 		'label'    => sprintf(__( 'Image %d', 'acrira' ), $i),
	// 		'section'  => 'acrira_homepage_slider_section',
	// 		'settings' => 'acrira_homepage_slider_image_' . $i,
	// 	) ) );
	// }

	// Admin for header images of each sections

	// Admin for header images : Cinémas en réseau
	$wp_customize->add_section( 'acrira_header_images_section1' , array(
		'title'       => __( 'Header images Cinémas en réseau', 'acrira' ),
		'priority'    => 30,
		'description' => __( 'Upload images for header.', 'acrira' ),
	) );
	for( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( 'acrira_header_images_section1_image_' . $i );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '
			acrira_header_images_section1_image_' . $i, array(
			'label'    => sprintf(__( 'Image %d', 'acrira' ), $i),
			'section'  => 'acrira_header_images_section1',
			'settings' => 'acrira_header_images_section1_image_' . $i,
		) ) );
	}

	// Admin for header images : Lycéens et apprentis au cinéma
	$wp_customize->add_section( 'acrira_header_images_section2' , array(
		'title'       => __( 'Header images Lycéens et apprentis au cinéma', 'acrira' ),
		'priority'    => 30,
		'description' => __( 'Upload images for header.', 'acrira' ),
	) );
	for( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( 'acrira_header_images_section2_image_' . $i );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '
			acrira_header_images_section2_image_' . $i, array(
			'label'    => sprintf(__( 'Image %d', 'acrira' ), $i),
			'section'  => 'acrira_header_images_section2',
			'settings' => 'acrira_header_images_section2_image_' . $i,
		) ) );
	}

	// Admin for header images : Passeurs d'images
	$wp_customize->add_section( 'acrira_header_images_section3' , array(
		'title'       => __( 'Header images Passeurs d\'images', 'acrira' ),
		'priority'    => 30,
		'description' => __( 'Upload images for header.', 'acrira' ),
	) );
	for( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( 'acrira_header_images_section3_image_' . $i );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '
			acrira_header_images_section3_image_' . $i, array(
			'label'    => sprintf(__( 'Image %d', 'acrira' ), $i),
			'section'  => 'acrira_header_images_section3',
			'settings' => 'acrira_header_images_section3_image_' . $i,
		) ) );
	}

	// Admin for header images : Le cinéma à portée de main
	$wp_customize->add_section( 'acrira_header_images_section4' , array(
		'title'       => __( 'Header images Le cinéma à portée de main', 'acrira' ),
		'priority'    => 30,
		'description' => __( 'Upload images for header.', 'acrira' ),
	) );
	for( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( 'acrira_header_images_section4_image_' . $i );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '
			acrira_header_images_section4_image_' . $i, array(
			'label'    => sprintf(__( 'Le cinéma à portée de main - Image %d', 'acrira' ), $i),
			'section'  => 'acrira_header_images_section4',
			'settings' => 'acrira_header_images_section4_image_' . $i,
		) ) );
	}

	// Menu Entries : Les id des entrées de menu
	$wp_customize->add_section( 'acrira_menu_entries' , array(
		'title'       => __( 'Menu Entries', 'acrira' ),
		'priority'    => 30,
		'description' => __( 'Ids of menu entries.', 'acrira' ),
	) );
	for( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( 'acrira_menu_entry_' . $i );
		$wp_customize->add_control(
			'acrira_menu_entry_' . $i,
				array(
					'label'    => sprintf(__( 'Menu Entry %d', 'acrira' ), $i),
					'section'  => 'acrira_menu_entries',
					'settings' => 'acrira_menu_entry_' . $i,
					'type'     => 'number',
				)
			);
	}

	// Menu Entries : Les Couleurs des entrées de menu
	$wp_customize->add_section( 'acrira_menu_colors' , array(
		'title'       => __( 'Menu Colors', 'acrira' ),
		'priority'    => 30,
		'description' => __( 'Colors of menu entries.', 'acrira' ),
	) );
	for( $i = 1; $i <= 4; $i++ ) {
		$menu_id = get_theme_mod( 'acrira_menu_entry_' . $i, $i );
		$wp_customize->add_setting( 'acrira_menu_color_' . $menu_id );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '
			acrira_menu_color_' . $i, array(
			'label'    => sprintf(__( 'Colors of menu entry %d', 'acrira' ), $menu_id),
			'section'  => 'acrira_menu_colors',
			'settings' => 'acrira_menu_color_' . $menu_id,
		) ) );
	}

	// END Admin for header images of each sections
}
add_action( 'customize_register', 'acrira_theme_customizer' );

/**
 * Get slider image src
 *
 * @param   string  $option
 *
 * @return  string
 */
function acrira_get_slider_image_src( $option ) {

	$default_image_url = get_theme_mod( $option );
	$default_image     = attachment_url_to_postid( $default_image_url );

	if( empty( $default_image ) ) {
		return;
	}

	$image = wp_get_attachment_image_src( $default_image, 'hslider' );

	return $image[0];
}

# filter_hook function to react on start_in argument
function acrira_wp_nav_menu_objects_start_in( $sorted_menu_items, $args ) {
	if(isset($args->start_in)) {
		$menu_item_parents = array();
		foreach( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents
			if( $item->object_id == (int)$args->start_in ) $menu_item_parents[] = $item->ID;

			if( in_array($item->menu_item_parent, $menu_item_parents) ) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} 
			else {
				// not part of sub-tree: away with it!
				unset($sorted_menu_items[$key]);
			}
		}
		return $sorted_menu_items;
	} 
	else {
		return $sorted_menu_items;
	}
}
# in functions.php add hook & hook function
add_filter("wp_nav_menu_objects",'acrira_wp_nav_menu_objects_start_in',10,2);

/**
 * Get menu parent ID
 *
 * @param $menu_name
 *
 * @return menu parent ID
 */
function acrira_get_menu_parent_ID( $menu_name ) {
	if( !isset($menu_name) ){
		return "No menu name provided in arguments";
	}
	$menu_slug = $menu_name;
	$locations = get_nav_menu_locations();
	$menu_id   = $locations[$menu_slug];
	$post_id        = get_the_ID();
	$menu_items     = wp_get_nav_menu_items( $menu_id );
	$parent_item_id = wp_filter_object_list( $menu_items, array( 'object_id' => $post_id ), 'and', 'menu_item_parent');
	$parent_item_id = array_shift( $parent_item_id );
	if( !empty($parent_item_id) ) {
		return acrira_checkForParent( $parent_item_id, $menu_items );
	}
	else {
		return $post_id;
	}
}

function acrira_checkForParent( $parent_item_id, $menu_items ) {
	$parent_post_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'object_id' );
	$parent_item_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'menu_item_parent');
	$parent_item_id = array_shift( $parent_item_id );
	if( $parent_item_id == "0" ) {
		$parent_post_id = array_shift( $parent_post_id );
		return $parent_post_id;
	}
	else {
		return acrira_checkForParent( $parent_item_id, $menu_items );
	}
}