<?php
/**
 * Back to Front Wordpress functions and definitions
 *
 * @package Back to Front Wordpress
 */

/**
 * ACF Options page
 */

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page('Theme Settings');

}

/**
 * CPT - Projects
 */

function cpt_projects() {

	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'backtofront' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'backtofront' ),
		'menu_name'             => __( 'Projects', 'backtofront' ),
		'name_admin_bar'        => __( 'Projects', 'backtofront' ),
		'archives'              => __( 'Project Archives', 'backtofront' ),
		'parent_item_colon'     => __( 'Parent Project:', 'backtofront' ),
		'all_items'             => __( 'All Projects', 'backtofront' ),
		'add_new_item'          => __( 'Add New Project', 'backtofront' ),
		'add_new'               => __( 'Add New', 'backtofront' ),
		'new_item'              => __( 'New Project', 'backtofront' ),
		'edit_item'             => __( 'Edit Project', 'backtofront' ),
		'update_item'           => __( 'Update Project', 'backtofront' ),
		'view_item'             => __( 'View Project', 'backtofront' ),
		'search_items'          => __( 'Search Project', 'backtofront' ),
		'not_found'             => __( 'Not found', 'backtofront' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'backtofront' ),
		'featured_image'        => __( 'Featured Image', 'backtofront' ),
		'set_featured_image'    => __( 'Set featured image', 'backtofront' ),
		'remove_featured_image' => __( 'Remove featured image', 'backtofront' ),
		'use_featured_image'    => __( 'Use as featured image', 'backtofront' ),
		'insert_into_item'      => __( 'Insert into item', 'backtofront' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'backtofront' ),
		'items_list'            => __( 'Items list', 'backtofront' ),
		'items_list_navigation' => __( 'Items list navigation', 'backtofront' ),
		'filter_items_list'     => __( 'Filter items list', 'backtofront' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'backtofront' ),
		'description'           => __( 'Back to Front projects', 'backtofront' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'projects', $args );

}
add_action( 'init', 'cpt_projects', 0 );


/**
 * Set up
 */

if ( ! function_exists( 'backtofront_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function backtofront_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'backtofront', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	//add_image_size( 'custom-thumb', 540, 540, array( 'center', 'top' ) );
	//add_image_size( 'custom-large', 1045, 325, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'backtofront' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}

endif; // backtofront_setup

add_action( 'after_setup_theme', 'backtofront_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function backtofront_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'backtofront_content_width', 640 );
}
add_action( 'after_setup_theme', 'backtofront_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function backtofront_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'backtofront' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'backtofront_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function backtofront_scripts() {

	// Primary styles
  wp_register_style( 'backtofront-style', get_template_directory_uri() . '/assets/css/global.css', array(),'20120208','all' );
  wp_enqueue_style( 'backtofront-style' );

  // Modernizer
  wp_enqueue_script( 'backtofront-modernizer-js', get_template_directory_uri() . '/bower_components/modernizer/modernizr.js', array('jquery'), '20120200', true );

	// Global javascript 
  wp_enqueue_script( 'backtofront-global-js', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), '20120200', true );  

  // Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'backtofront_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom');