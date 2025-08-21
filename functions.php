<?php
/**
 * Lading_page functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lading_page
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lading_page_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Lading_page, use a find and replace
		* to change 'lading_page' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'lading_page', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'lading_page' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lading_page_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'lading_page_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lading_page_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lading_page_content_width', 640 );
}
add_action( 'after_setup_theme', 'lading_page_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lading_page_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lading_page' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lading_page' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lading_page_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lading_page_scripts() {
	wp_enqueue_style( 'lading_page-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'lading_page-style', 'rtl', 'replace' );
	wp_enqueue_style( 'lading_page-theme-style', get_template_directory_uri() . '/css/main_style.css',  _S_VERSION, true );
	wp_enqueue_style( 'lading_page-foundation', 'https://cdn.jsdelivr.net/npm/foundation-sites@6.9.0/dist/css/foundation.min.css',  _S_VERSION, true );
	wp_enqueue_style( 'lading_page-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css', array(), '20120206', false );

	wp_enqueue_script( 'lading_page-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lading_page_scripts' );

add_action('admin_print_scripts', 'wp_admin_scripts');
function wp_admin_scripts(){
    //wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script('media-upload');
    //wp_enqueue_script('thickbox');
    //wp_enqueue_script('common');
    wp_enqueue_script('jquery');
	wp_enqueue_script( 'lading_page', get_template_directory_uri() . '/js/uploader.js', array(), '20120206', true );
    wp_enqueue_style( 'lading_page-adminstyle', get_template_directory_uri() . '/css/admin_style.css', array(), '20120206', false );
}

function fullcolumn_shortcode_func($atts, $content = null){
    
    return '<div class="cell small-12 medium-12 large-12 block">
            '.$content.'
        </div>';
}

add_shortcode('full', 'fullcolumn_shortcode_func');


function middlecolumn_shortcode_func($atts, $content = null){
    
    return '<div class="cell small-12 medium-12 large-6 block">
            '.$content.'
        </div>';
}

add_shortcode('column', 'middlecolumn_shortcode_func');

function threecolumn_shortcode_func($atts, $content = null){
    
    return '<div class="cell small-12 medium-12 large-4 block">
            '.$content.'
        </div>';
}

add_shortcode('columnthree', 'threecolumn_shortcode_func');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


require get_template_directory() . '/inc/postypes.php';


require get_template_directory() . '/inc/metaboxes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

