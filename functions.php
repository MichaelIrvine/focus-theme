<?php
/**
 * Focus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Focus
 */

if ( ! function_exists( 'focus_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function focus_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Focus, use a find and replace
		 * to change 'focus' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'focus', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'focus' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'focus_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'focus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function focus_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'focus_content_width', 640 );
}
add_action( 'after_setup_theme', 'focus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


/**
 * Remove capabilities from editors.
 *
 * Call the function when your plugin/theme is activated.
 */
 function focus_set_capabilities() {

	// Get the role object.
	$editor = get_role( 'editor' );

// A list of capabilities to remove from editors.
	$caps = array(
			'publish_pages',
	);

	foreach ( $caps as $cap ) {
	
			// Remove the capability.
			$editor->remove_cap( $cap );
	}
}
add_action( 'init', 'focus_set_capabilities' );


/**
 *
 *  Remove WordPress Dashboard Widgets
 * 
 */
function focus_remove_dashboard_widgets() {

	remove_meta_box( 'dashboard_primary','dashboard','side' ); // WordPress.com Blog
	remove_meta_box( 'dashboard_plugins','dashboard','normal' ); // Plugins
	remove_meta_box( 'dashboard_right_now','dashboard', 'normal' ); // Right Now
	remove_action( 'welcome_panel','wp_welcome_panel' ); // Welcome Panel
	remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel'); // Try Gutenberg
	remove_meta_box('dashboard_quick_press','dashboard','side'); // Quick Press widget
	remove_meta_box('dashboard_recent_drafts','dashboard','side'); // Recent Drafts
	remove_meta_box('dashboard_secondary','dashboard','side'); // Other WordPress News
	remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
	remove_meta_box('rg_forms_dashboard','dashboard','normal'); // Gravity Forms
	remove_meta_box('dashboard_recent_comments','dashboard','normal'); // Recent Comments
	remove_meta_box('icl_dashboard_widget','dashboard','normal'); // Multi Language Plugin
	
}
add_action( 'wp_dashboard_setup', 'focus_remove_dashboard_widgets' );

/** Remove Posts and Comments from Dashboard */
function focus_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
	}
	
	function custom_dashboard_help() {
	
	// Content you want to show inside the widget
	echo '<p>Welcome to Focus Theme! Need help? Contact the developer <a href="mailto:michaelirvinedesign@gmail.com">here.</a></p>';
}
add_action('wp_dashboard_setup', 'focus_custom_dashboard_widgets');

/** Remove Posts and Comments from Dashboard */
function remove_menus() {
	if(!current_user_can( 'manage_options' )){
		remove_menu_page( 'edit.php' );//Posts
		remove_menu_page( 'edit-comments.php' );//Comments	
	}
}
add_action( 'admin_menu', 'remove_menus' );


function hide_new_page_button(){

	if ($current_screen->id && !current_user_can( 'manage_options' )){
		echo '<style>.add-new-h2{display: none;}</style>';
	}
}

add_action('admin_head', 'hide_new_page_button');



/**
 * Enqueue scripts and styles.
 */
function focus_scripts() {
	
	wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/main.css', array(), get_the_time(), false);

	wp_enqueue_script('focus-main', get_template_directory_uri() . '/dist/main.js', array(), get_the_time(), true);

	if( get_field('toggle_lightbox') ) {
		wp_enqueue_script('focus-lightbox', get_template_directory_uri() . '/src/js/lightbox.js', array(), get_the_time(), true);
	};

	wp_enqueue_script( 'focus-navigation', get_template_directory_uri() . '/src/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'focus-skip-link-focus-fix', get_template_directory_uri() . '/src/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'focus_scripts' );

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


