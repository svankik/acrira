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
	global $content_width;
	
	$content_width = 1200;

	if( is_page_template( 'tpl-2cols.php' ) ) {
		$content_width = 600;
	}

	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'acrira', get_stylesheet_directory () . '/assets/lang' );

	// Add image sizes
	add_image_size ( 'aslider', 1200, 545, true );
	add_image_size ( 'hslider', 1200, 400, true );
	add_image_size ( 'partner', 300, 200, false );
	add_image_size ( 'news', 200, 150, true );
	add_image_size ( 'educationaltool', 600, 600 );
	add_image_size ( 'half_size', 600, 9999 );

	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
add_action( 'after_setup_theme', 'acrira_setup', 11 );

/**
 * add custom size to editor image size options
 *
 * @param [type] $sizes
 * @return void
 */
function acrira_image_sizes( $sizes ) {
    $sizes = array_merge( $sizes, array(
      'half_size' => __( 'Image moitié/moitié', 'acrira' )
    ));
    return $sizes;
}
add_filter( 'image_size_names_choose', 'acrira_image_sizes' );
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

	$dependencies = array( 'jquery-ui-accordion', 'bx-slider' );

	if( is_front_page() || is_home() ) {
		wp_enqueue_script ( 'iscroll',
			get_stylesheet_directory_uri() . '/assets/js/iscroll.js',
			array(),
			wp_get_theme()->get('Version')
		);

		$dependencies[] = 'iscroll';
	}

	wp_enqueue_script ( 'acrira',
		get_stylesheet_directory_uri() . '/assets/js/acrira.js',
		$dependencies,
		wp_get_theme()->get('Version')
	);

	if( is_front_page() || is_home() ) {
		wp_enqueue_script ( 'aslider',
			get_stylesheet_directory_uri() . '/assets/js/aslider.js',
			array( 'jquery' ),
			wp_get_theme()->get('Version')
		);
	}

	// Gmap API KEY
	$googleapis_map_url = 'https://maps.googleapis.com/maps/api/js';
	$googleapis_map_url .= defined ( 'GOOGLE_MAP_API_KEY' ) ? '?key=' . GOOGLE_MAP_API_KEY : '';

	wp_enqueue_script ( 'googleapis-map',
		$googleapis_map_url,
		array(),
		wp_get_theme ()->get ('Version')
	);

	wp_enqueue_script ( 'markerclusterer',
		get_stylesheet_directory_uri () . '/assets/js/markerclusterer.js',
		array( 'googleapis-map' ),
		wp_get_theme ()->get ('Version')
	);

	wp_enqueue_script ( 'acf-gmap',
		get_stylesheet_directory_uri () . '/assets/js/gmap.js',
		array( 'jquery', 'markerclusterer' ),
		wp_get_theme ()->get ('Version')
	);

	wp_localize_script ( 'acf-gmap',
		'acfgmapParams',
		array (
			'themeUrl' => get_stylesheet_directory_uri (),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'acrira_enqueue_styles' );

/**
 * ACF Google Map API Key
 *
 * @param   [type]  $api  [description]
 *
 * @return  [type]        [description]
 */
function acrira_acf_google_map_api( $api ){

	$api['key'] = defined ( 'GOOGLE_MAP_API_KEY' ) ? GOOGLE_MAP_API_KEY : '';

	return $api;

}
add_filter('acf/fields/google_map/api', 'acrira_acf_google_map_api');

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
			'title'   => __ ( 'Bloc Link', 'acrira' ),  
			'inline'  => 'a',  
			'classes' => 'bloc-link',
		),  
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
 * Get slider image
 *
 * @param   string  $option
 *
 * @return  string
 */
function acrira_get_slider_image( $option ) {

	$default_image_url = get_theme_mod( $option );
	$default_image     = attachment_url_to_postid( $default_image_url );

	if( empty( $default_image ) ) {
		return;
	}

	$image = wp_get_attachment_image_src( $default_image, 'hslider' );

	return array( 
		'url'       => $image[0],
		'copyright' => wp_get_attachment_caption( $default_image ),
	);
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

	$menu_slug      = $menu_name;
	$locations      = get_nav_menu_locations();
	$menu_id        = $locations[$menu_slug];
	$post_id        = get_the_ID();
	$menu_items     = wp_get_nav_menu_items( $menu_id );
	$parent_item_id = wp_filter_object_list( $menu_items, array( 'object_id' => $post_id ), 'and', 'menu_item_parent');
	$parent_item_id = array_shift( $parent_item_id );
	
	if( !empty($parent_item_id) ) {
		return acrira_checkForParent( $parent_item_id, $menu_items );
	}
	else if( ! is_front_page() ) {
		$secteur = get_field( 'secteur', $post_id );

		if( ! empty ( $secteur ) ) {
			return get_theme_mod( sprintf( 'acrira_menu_entry_%d', $secteur ) );
		}

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

/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * 
 * @param 	str 	$hex Colour as hexadecimal (with or without hash);
 * @param 	float 	@percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * 				
 * @return 	str 	Lightened/Darkend colour as hexadecimal (with hash);
 */
function acrira_color_luminance( $hex, $percent ) {
	
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';
	
	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}
	
	// convert to decimal and change luminosity
	for ($i = 0; $i < 3; $i++) {
		$dec     = hexdec( substr( $hex, $i*2, 2 ) );
		$dec     = min( max( 0, $dec + $dec * $percent ), 255 ); 
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}		
	
	return $new_hex;
}

// Function to change email address
function acrira_sender_email( $original_email_address ) {
    return 'no-reply@acrira.org';
}

// Function to change sender name
function acrira_sender_name( $original_email_from ) {
    return 'Acrira.org - No-Reply';
}

// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'acrira_sender_email' );
add_filter( 'wp_mail_from_name', 'acrira_sender_name' );

add_filter('wp_calculate_image_srcset', function() {
	return false;
} );

function acrira_previous_post_orderby_name($orderby){
	return "ORDER BY p.post_title DESC LIMIT 1";
}
function acrira_previous_post_where_name(){
	global $post, $wpdb;
	return $wpdb->prepare( "WHERE p.post_title < %s AND p.post_type = %s AND ( p.post_status = 'publish' OR p.post_status = 'private' )", $post->post_title, $post->post_type );
}
function acrira_next_post_orderby_name($orderby){
	return "ORDER BY p.post_title ASC LIMIT 1";
}
function acrira_next_post_where_name(){
	global $post, $wpdb;
	return $wpdb->prepare( "WHERE p.post_title > %s AND p.post_type = %s AND ( p.post_status = 'publish' OR p.post_status = 'private' )", $post->post_title, $post->post_type );
}

add_filter('posts_where', 'acrira_posts_where');
function acrira_posts_where( $where ) {
	$where = str_replace("meta_key = 'realisateurs", "meta_key LIKE 'realisateurs", $where);
	$where = str_replace("meta_key = 'genres", "meta_key LIKE 'genres", $where);
	$where = str_replace("meta_key = 'origines", "meta_key LIKE 'origines", $where);

	return $where;
}