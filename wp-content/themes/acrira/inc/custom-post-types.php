<?php 

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
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
		'taxonomies'         => array( 'category' ), 
	);

	register_post_type( 'cinema', $args );
}
add_action( 'init', 'codex_cinema_init' );

/**
 * Register a highschool post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_highschool_init() {
	$labels = array(
		'name'               => _x( 'High schools', 'post type general name', 'acrira' ),
		'singular_name'      => _x( 'High school', 'post type singular name', 'acrira' ),
		'menu_name'          => _x( 'High schools', 'admin menu', 'acrira' ),
		'name_admin_bar'     => _x( 'High school', 'add new on admin bar', 'acrira' ),
		'add_new'            => _x( 'Add New', 'High school', 'acrira' ),
		'add_new_item'       => __( 'Add New High school', 'acrira' ),
		'new_item'           => __( 'New High school', 'acrira' ),
		'edit_item'          => __( 'Edit High school', 'acrira' ),
		'view_item'          => __( 'View High school', 'acrira' ),
		'all_items'          => __( 'All High schools', 'acrira' ),
		'search_items'       => __( 'Search High schools', 'acrira' ),
		'parent_item_colon'  => __( 'Parent High schools:', 'acrira' ),
		'not_found'          => __( 'No High school found.', 'acrira' ),
		'not_found_in_trash' => __( 'No High schools found in Trash.', 'acrira' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'acrira' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'lycee' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
		'taxonomies'         => array( 'category' ),
	);

	register_post_type( 'High school', $args );
}
add_action( 'init', 'codex_highschool_init' );

/**
 * Register a Educational tool post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_educationaltool_init() {
	$labels = array(
		'name'               => _x( 'Educational tools', 'post type general name', 'acrira' ),
		'singular_name'      => _x( 'Educational tool', 'post type singular name', 'acrira' ),
		'menu_name'          => _x( 'Educational tools', 'admin menu', 'acrira' ),
		'name_admin_bar'     => _x( 'Educational tool', 'add new on admin bar', 'acrira' ),
		'add_new'            => _x( 'Add New', 'Educational tool', 'acrira' ),
		'add_new_item'       => __( 'Add New Educational tool', 'acrira' ),
		'new_item'           => __( 'New Educational tool', 'acrira' ),
		'edit_item'          => __( 'Edit Educational tool', 'acrira' ),
		'view_item'          => __( 'View Educational tool', 'acrira' ),
		'all_items'          => __( 'All Educational tools', 'acrira' ),
		'search_items'       => __( 'Search Educational tools', 'acrira' ),
		'parent_item_colon'  => __( 'Parent Educational tools:', 'acrira' ),
		'not_found'          => __( 'No Educational tool found.', 'acrira' ),
		'not_found_in_trash' => __( 'No Educational tools found in Trash.', 'acrira' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'acrira' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'outil-pedagogique' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'Educational tool', $args );
}
add_action( 'init', 'codex_educationaltool_init' );

/**
 * Register a Film post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_film_init() {
	$labels = array(
		'name'               => _x( 'Films', 'post type general name', 'acrira' ),
		'singular_name'      => _x( 'Film', 'post type singular name', 'acrira' ),
		'menu_name'          => _x( 'Films', 'admin menu', 'acrira' ),
		'name_admin_bar'     => _x( 'Film', 'add new on admin bar', 'acrira' ),
		'add_new'            => _x( 'Add New', 'Film', 'acrira' ),
		'add_new_item'       => __( 'Add New Film', 'acrira' ),
		'new_item'           => __( 'New Film', 'acrira' ),
		'edit_item'          => __( 'Edit Film', 'acrira' ),
		'view_item'          => __( 'View Film', 'acrira' ),
		'all_items'          => __( 'All Films', 'acrira' ),
		'search_items'       => __( 'Search Films', 'acrira' ),
		'parent_item_colon'  => __( 'Parent Films:', 'acrira' ),
		'not_found'          => __( 'No Film found.', 'acrira' ),
		'not_found_in_trash' => __( 'No Films found in Trash.', 'acrira' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'acrira' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'film' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'Film', $args );
}
add_action( 'init', 'codex_film_init' );
