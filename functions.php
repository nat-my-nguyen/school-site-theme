<?php
/**
 * School Site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Site
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
function school_site_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Site, use a find and replace
		* to change 'school-site' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-site', get_template_directory() . '/languages' );

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

	//Custom feature image size
	add_image_size( 'custom-size', 200, 300, true ); // true for cropping, false for scaling

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'school-site' ),
			'footer-right' => esc_html__( 'Footer - Right Side', 'school-site' ),
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
			'school_site_custom_background_args',
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
			//'header-text' => array( 'site-title', 'site-description' ),
		)
	);
	
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'school_site_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_site_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_site_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_site_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_site_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-site' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-site' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_site_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_site_scripts() {
	wp_enqueue_style(
		'school-googlefonts', //unique handle
		'https://fonts.googleapis.com/css2?family=Belgrano&family=Inter:wght@100..900&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'school-site-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-site-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school-site-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//AOS feature by https://github.com/michalsnik/aos
	//Enqueue style and script for AOS, checks if it's the Blog page
	if ( is_home() ) {
		wp_enqueue_style( 'AOS_animate', 'https://unpkg.com/aos@next/dist/aos.css', false, null );
		wp_enqueue_script( 'AOS', 'https://unpkg.com/aos@next/dist/aos.js', array(), null, true );
		wp_add_inline_script( 'AOS', 'AOS.init();' );
	}
}
add_action( 'wp_enqueue_scripts', 'school_site_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Register CPTS and Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Remove Block Editor from "school-staff" post type
 */ 
function school_post_filter( $use_block_editor, $post ) {
    if ( $post->post_type === 'school-staff' ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'school_post_filter', 10, 2 );

/**
 * Remove the default editor from "school-staff" post type
 */ 
function remove_editor_for_school_staff() {
    remove_post_type_support( 'school-staff', 'editor' );
}
add_action( 'init', 'remove_editor_for_school_staff' );

/**
 * Change placeholder title
 */ 
function wpb_change_title_text( $title ){
	$screen = get_current_screen();
  
	if  ( 'school-staff' == $screen->post_type ) {
		 $title = 'Enter Staff Name';
	}
	
	if  ( 'school-student' == $screen->post_type ) {
		 $title = 'Enter Student Name';
	}

	return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );

//remove prefix for entire School-site
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

