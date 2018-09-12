<?php
/**
 * Functions and definitions
 *
 * @package dream
 */

if (!function_exists('dream_setup')) {
	function dream_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
		load_theme_textdomain('dream', get_template_directory().'/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
      'menu-1' => esc_html__('Main menu', 'dream'),
      'menu-2' => esc_html__('Footer menu', 'dream')
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
    add_theme_support('html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

    // Enable support for Post Formats.
    add_theme_support('post-formats', array(
      'image', 'gallery', 'video', 'audio', 'aside', 'link', 'quote', 'status', 'chat'
    ));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('dream_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => get_template_directory_uri().'/assets/images/bg.png',
      'default-repeat' => 'repeat-x',
      'default-position-x' => 'center',
      'default-position-y' => 'top',
      'default-size' => '100%',
		)) );

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
      'height' => 60,
      'width' => 60,
      'flex-width' => true,
    ));
	}
}
add_action('after_setup_theme', 'dream_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dream_content_width() {
	$GLOBALS['content_width'] = apply_filters('dream_content_width', 730);
}
add_action('after_setup_theme', 'dream_content_width', 0);

/**
 * Enqueue styles.
 */
if (!function_exists('dream_styles')) {
  function dream_styles() { 

    // google fonts
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic', array(), '1.0.22');

    // bootstrap
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/bootstrap/css/bootstrap.min.css', array(), '3.3.7');
    wp_enqueue_style('bootstrap-theme', get_template_directory_uri().'/assets/bootstrap/css/bootstrap-theme.min.css', array(), '3.3.7');

    // ie10 viewport bug workaround
    wp_enqueue_style('ie10-viewport-bug-workaround', get_template_directory_uri().'/assets/css/ie10-viewport-bug-workaround.css', array(), '1.0.22');

    // font awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css', array(), '4.7.0');

    // owl carousel
    wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/owl-carousel/owl.carousel.css', array(), '1.3.3');
    wp_enqueue_style('owl-theme', get_template_directory_uri().'/assets/owl-carousel/owl.theme.css', array(), '1.3.3');
    
    // main stylesheet
    wp_enqueue_style('dream-style', get_stylesheet_directory_uri().'/style.css', array(), '1.0.22');
  }
}
add_action('wp_enqueue_scripts', 'dream_styles');

/**
 * Enqueue scripts.
 */
if (!function_exists('dream_scripts')) {
  function dream_scripts() {

    // html5shiv.js (for IE)
    wp_enqueue_script('html5shiv', get_template_directory_uri().'/assets/js/html5shiv.min.js', array(), '3.7.3', false);
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

    // respond.js (for IE)
    wp_enqueue_script('respond', get_template_directory_uri().'/assets/js/respond.min.js', array(), '1.4.2', false);
    wp_script_add_data('respond', 'conditional', 'lt IE 9');

    // bootstrap
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true);

    // owl carousel
    wp_enqueue_script('owl-carousel', get_template_directory_uri().'/assets/owl-carousel/owl.carousel.min.js', array('jquery'), '1.3.3', true);

    // IE10 viewport hack for Surface/desktop Windows 8 bug
    wp_enqueue_script('ie10-viewport-bug-workaround', get_template_directory_uri().'/assets/js/ie10-viewport-bug-workaround.js', array(), '1.0.22', true);
    
    // theme js
    wp_enqueue_script('dream-theme', get_template_directory_uri().'/assets/js/theme.js', array('jquery'), '1.0.22', true);

    // comments
    if ( is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }
  }
}
add_action('wp_enqueue_scripts', 'dream_scripts');

/**
 * Custom template widgets for this theme.
 */
require_once get_template_directory().'/inc/template-widgets.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory().'/inc/template-comments.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory().'/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory().'/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory().'/inc/customizer.php';
require_once get_template_directory().'/inc/sanitize.php';
require_once get_template_directory().'/inc/inline-styles.php';
