<?php
function acrira_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'acrira' );
}
add_action( 'after_setup_theme', 'acrira_setup' );

add_action( 'wp_enqueue_scripts', 'acrira_enqueue_styles' );
function acrira_enqueue_styles() {
	$parent_style = 'twentyseventeen-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}

add_action( 'init', 'codex_cinema_init' );
/**
 * Register a cinema post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_cinema_init() {
	$labels = array(
		'name'               => _x( 'Cinemas', 'post type general name', 'acrira' ),
		'singular_name'      => _x( 'Cinema', 'post type singular name', 'acrira' ),
		'menu_name'          => _x( 'Cinemas', 'admin menu', 'acrira' ),
		'name_admin_bar'     => _x( 'Cinema', 'add new on admin bar', 'acrira' ),
		'add_new'            => _x( 'Add New', 'cinema', 'acrira' ),
		'add_new_item'       => __( 'Add New Cinema', 'acrira' ),
		'new_item'           => __( 'New Cinema', 'acrira' ),
		'edit_item'          => __( 'Edit Cinema', 'acrira' ),
		'view_item'          => __( 'View Cinema', 'acrira' ),
		'all_items'          => __( 'All Cinemas', 'acrira' ),
		'search_items'       => __( 'Search Cinemas', 'acrira' ),
		'parent_item_colon'  => __( 'Parent Cinemas:', 'acrira' ),
		'not_found'          => __( 'No cinema found.', 'acrira' ),
		'not_found_in_trash' => __( 'No cinemas found in Trash.', 'acrira' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'acrira' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'cinema' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'cinema', $args );
}

add_action( 'init', 'codex_partner_init' );
/**
 * Register a partner post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_partner_init() {
	$labels = array(
		'name'               => _x( 'Partners', 'post type general name', 'acrira' ),
		'singular_name'      => _x( 'Partner', 'post type singular name', 'acrira' ),
		'menu_name'          => _x( 'Partners', 'admin menu', 'acrira' ),
		'name_admin_bar'     => _x( 'Partner', 'add new on admin bar', 'acrira' ),
		'add_new'            => _x( 'Add New', 'partner', 'acrira' ),
		'add_new_item'       => __( 'Add New Partner', 'acrira' ),
		'new_item'           => __( 'New Partner', 'acrira' ),
		'edit_item'          => __( 'Edit Partner', 'acrira' ),
		'view_item'          => __( 'View Partner', 'acrira' ),
		'all_items'          => __( 'All Partners', 'acrira' ),
		'search_items'       => __( 'Search Partners', 'acrira' ),
		'parent_item_colon'  => __( 'Parent Partners:', 'acrira' ),
		'not_found'          => __( 'No partner found.', 'acrira' ),
		'not_found_in_trash' => __( 'No partners found in Trash.', 'acrira' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'acrira' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'partner' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'partner', $args );
}

?>