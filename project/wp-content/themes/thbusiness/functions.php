<?php
/**
 * thbusiness functions and definitions
 *
 * @package thbusiness
 */


if ( ! function_exists( 'thbusiness_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function thbusiness_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on thbusiness, use a find and replace
	 * to change 'thbusiness' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'thbusiness', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// ThBusiness Image Sizes
	add_image_size( 'featured', 345, 259, true ); 	
	add_image_size( 'featured-large', 677, 400, true ); 
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'thbusiness' ),
	) );

	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'thbusiness_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 677; /* pixels */
	}
}
endif; // thbusiness_setup
add_action( 'after_setup_theme', 'thbusiness_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function thbusiness_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'thbusiness' ),
		'id'            => 'thbusiness-main-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Business Template Top Area', 'thbusiness' ),
		'id'            => 'thbusiness-business-top-sidebar',
		'description'   => 'Shows the widgets on the top area of the business page.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="business-page-widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Business Template Left Area', 'thbusiness' ),
		'id'            => 'thbusiness-business-left-sidebar',
		'description'   => 'Shows the widgets on the left area of the business page.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="business-page-widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Business Template Right Area', 'thbusiness' ),
		'id'            => 'thbusiness-business-right-sidebar',
		'description'   => 'Shows the widgets on the right area of the business page.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="business-page-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Business Template Bottom Area', 'thbusiness' ),
		'id'            => 'thbusiness-business-bottom-sidebar',
		'description'   => 'Shows the widgets on the bottom area of the business page.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="business-page-widget-title">',
		'after_title'   => '</h1>',
	) );				
	register_sidebar( array(
		'name'          => __( 'Footer Left Sidebar', 'thbusiness' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Mid Sidebar', 'thbusiness' ),
		'id'            => 'footer-mid',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Right Sidebar', 'thbusiness' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );			
}
add_action( 'widgets_init', 'thbusiness_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thbusiness_scripts() {
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );

	wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'all' );
	
	wp_enqueue_style( 'thbusiness-style', get_stylesheet_uri() );

	wp_enqueue_script( 'thbusiness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js',array( 'jquery' ),'', true );

	wp_enqueue_script( 'thbusiness-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );

    wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js');
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.min.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'thbusiness-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thbusiness_scripts' );

/**
* Admin Scripts
*/
function thbusiness_admin_scripts() {
	wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/css/admin.css', false );
	wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
    wp_enqueue_media();
	wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/js/custom-admin.js', array('jquery'), '', true );
}
add_action( 'admin_enqueue_scripts', 'thbusiness_admin_scripts' );

/**
 * This function contains all the custom styles that will be loaded in the Theme Header.
 */
function thbusiness_initialize_header() {
	
	$style = get_theme_mod( 'custom_css', '' ); 
	if ( ! empty( $style ) ) {
		echo '<style type="text/css">';
			echo $style;
		echo '</style>';
	} 
		
}
add_action('wp_head', 'thbusiness_initialize_header');

/**
* Enqueue thbusiness options panel custom css.
*/
function thbusiness_option_panel_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/inc/admin/admin.css', false );
}
add_action( 'admin_enqueue_scripts', 'thbusiness_option_panel_style' );


/**
 * Load Google Fonts
 */
function thbusiness_load_fonts() {
	wp_register_style('googleWebFonts', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic');
	wp_enqueue_style('googleWebFonts');
}
add_action('wp_print_styles', 'thbusiness_load_fonts');

/**
* Add flex slider.
*/
function thbusiness_flex_scripts() {
    
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), false, true );
    wp_register_script( 'add-thbusiness-flex-js', get_template_directory_uri() . '/js/thbusiness.flexslider.js', array(), '', true );
	wp_enqueue_script( 'add-thbusiness-flex-js' );    
    wp_register_style( 'add-flex-css', get_template_directory_uri() . '/css/flexslider.css','','', 'screen' );
    wp_enqueue_style( 'add-flex-css' );

}

add_action( 'wp_enqueue_scripts', 'thbusiness_flex_scripts' );


/**
 * Activate a favicon for the website.
 */
function thbusiness_favicon() {

	if ( get_theme_mod( 'display_site_favicon', false ) ) {
		$favicon = get_theme_mod( 'site_favicon', '' );
		$thbusiness_favicon_output = '';
		if ( !empty( $favicon ) ) {
			$thbusiness_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $favicon ).'" type="image/x-icon" />';
		}
		echo $thbusiness_favicon_output;
	}
}
add_action( 'admin_head', 'thbusiness_favicon' );
add_action( 'wp_head', 'thbusiness_favicon' );

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
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Theme info page.
 */
require get_template_directory() . '/inc/theme-info.php';

/**
 * Add excerpts for pages.
 */
add_action('init', 'thbusiness_excerpt_support');
function thbusiness_excerpt_support() {
	add_post_type_support( 'page', 'excerpt' );
}