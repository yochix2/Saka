<?php
/**
 * Saka functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Saka
 */

if ( ! function_exists( 'saka_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function saka_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Saka, use a find and replace
	 * to change 'saka' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'saka', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'drawer' => esc_html__( 'Primary', 'saka' ),
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

	// Enable support for custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'saka_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Enable support editor-style on WordPress dashboard.
	add_editor_style( 'assets/css/editor-style.css' );
	add_editor_style( 'assets/font-awesome/css/font-awesome.min.css' );
}
endif;
add_action( 'after_setup_theme', 'saka_setup' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 *
 * @return string an ellipsis.
 */
if ( ! function_exists( 'saka_excerpt_more' ) && ! is_admin() ) :
	function saka_excerpt_more() {
		return '&hellip;';
	}
	add_filter( 'excerpt_more', 'saka_excerpt_more' );
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function saka_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'saka_content_width', 800 );
}
add_action( 'after_setup_theme', 'saka_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function saka_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'saka' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'saka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'saka_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function saka_scripts() {
	// Add Font Awesome, used in the main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	// Theme stylesheet.
	wp_enqueue_style( 'saka-style', get_stylesheet_uri() );

	wp_enqueue_script( 'saka-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), false, true );

	wp_enqueue_script( 'saka-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'saka_scripts' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function saka_widget_tag_cloud_args( $args ) {
	$args['largest']  = 0.875;
	$args['smallest'] = 0.875;
	$args['unit']     = 'rem';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'saka_widget_tag_cloud_args' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
