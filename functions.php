<?php

/**
 * Theme functions and definitions
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */

// Exit if accessed directly.
if (!defined("ABSPATH")) {
	exit;
}

// Core constants 
define("THEME_DIR", get_template_directory());
define("THEME_URI", get_template_directory_uri());
define("THEME_CLASS", "GDI_Theme");

/**
 * GDI Theme class
 */
final class GDI_Theme
{

	/**
	 * Add hooks and load theme functions 
	 * 
	 * @since 1.0
	 */
	public function __construct()
	{
		// Define theme constants
		$this->theme_constants();
		
		// Import theme files
		$this->theme_imports();

		// Setup theme support, nav menus, etc.
        add_action("after_setup_theme", array(THEME_CLASS, "theme_setup"));

		if(is_admin())
		{
			// Enqueue admin scripts
            add_action("admin_enqueue_scripts", array(THEME_CLASS, "theme_admin_css"));
            add_action("admin_enqueue_scripts", array(THEME_CLASS, "theme_admin_js"));
		}
		else 
		{
			// Hook to customize theme login style
			// add_action( "login_enqueue_scripts", array( THEME_CLASS, "theme_login_style" ) );
			
			// Enqueue theme scripts
			add_action("wp_enqueue_scripts", array(THEME_CLASS, "theme_css"));
			add_action("wp_enqueue_scripts", array(THEME_CLASS, "theme_js"), 1);
		}
            
		// Enqueue theme fonts
		add_action("wp_enqueue_scripts", array(THEME_CLASS, "theme_fonts"));
		add_action("admin_enqueue_scripts", array(THEME_CLASS, "theme_fonts"));
		
        // Add action to make custom query before loading posts
        add_action("pre_get_posts", array(THEME_CLASS, "set_query_params"));
        
		// Add action to define custom excerpt length
        add_filter("excerpt_length", array(THEME_CLASS, "custom_excerpt_len"), 999);
	}

	/**
	 * Define theme constants
	 *
	 * @since 1.0
	 */
	public static function theme_constants()
	{
		$version = self::get_theme_version();

		define("THEME_VERSION", $version);

		// JS and CSS files URIs
		define("THEME_JS_URI", THEME_URI . "/assets/js/");
		define("THEME_CSS_URI", THEME_URI . "/assets/css/");
		
		// Images URI
		define("THEME_IMG_URI", THEME_URI . "/assets/img/");
		
		// Fonts URI
		define("THEME_FONT_URI", THEME_URI . "/assets/fonts/");
		
		// Includes URI
		define("THEME_INC_DIR", THEME_DIR . "/inc/");
		define("THEME_INC_URI", THEME_URI . "/inc/");
	}

	/**
	 * Include theme classes and files
	 *
	 * @since 1.0
	 */
	public static function theme_imports()
	{
		// Directory of files to be included
		$dir = THEME_INC_DIR;

		require_once($dir . 'walker/bs_menu_walker.php');
		require_once($dir . 'customizer/customizer.php');
		require_once($dir . 'kirki/kirki-installer-section.php');
		require_once($dir . 'shortcodes/shortcodes.php');
		require_once($dir . 'cpt/cpt-empre.php');
		require_once($dir . 'helpers/helpers.php');
	}

	/**
	 * Setup theme support, nav menus, etc.
	 *
	 * @since 1.0
	 */
	public static function theme_setup() 
	{
		// Register nav menus
		register_nav_menus(
			array(
				"main_menu"   => esc_html__( "Main", "emertech" )
			)
		);

		// Enable support for site logo
		add_theme_support(
			"custom-logo",
			apply_filters(
				"custom_logo_args",
				array(
					// "height"      => 90,
					// "width"       => 209,
					"flex-height" => true,
					"flex-width"  => true,
				)
			)
		);

		add_filter('nav_menu_css_class', function($classes, $item, $args) {
			if(isset($args->li_class)) {
				$classes[] = $args->li_class;
			}
			return $classes;
		}, 1, 3);

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );

        // Let WordPress handle Title Tag in all pages
        add_theme_support( "title-tag");

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		
		// Enable support for excerpt text on posts and pages.
        add_post_type_support( 'page', 'excerpt' );

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			)
		);
	}

	/**
	 * Enqueue theme CSS
	 *
	 * @since 1.0
	 */
	public static function theme_css() 
	{
		$dir = THEME_CSS_URI;
		
		$version = THEME_VERSION;

		wp_enqueue_style('theme-css', $dir . 'main.min.css', [], $version, false);
		
		wp_deregister_style( "bootstrap" );
		wp_enqueue_style('bootstrap', $dir . 'bootstrap.min.css', [], $version, false);
	}

	/**
	 * Enqueue theme JS
	 *
	 * @since 1.0
	 */
	public static function theme_js() 
	{	
		$dir = THEME_JS_URI;
		
		$version = THEME_VERSION;

		wp_enqueue_script('theme-js', $dir . 'main.min.js', ["jquery"], $version, false);
	}

	/**
	 * Enqueue theme CSS for admin
	 *
	 * @since 1.0
	 */
	public static function theme_admin_css() 
	{
		$dir = THEME_CSS_URI;
		
		$version = THEME_VERSION;

		wp_enqueue_style('theme-admin-css', $dir . 'admin.min.css', [], $version, false);

	}

	/**
	 * Enqueue theme JS for admin
	 *
	 * @since 1.0
	 */
	public static function theme_admin_js() 
	{
		$dir = THEME_JS_URI;
		
		$version = THEME_VERSION;
	}

	/**
	 * Enqueue theme fonts
	 *
	 * @since 1.0
	 */
	public static function theme_fonts() 
	{	
		$dir = THEME_FONT_URI;
		
		$version = THEME_VERSION;

		wp_enqueue_style('inter', $dir . 'Inter/font.css', [], $version, false);
		wp_enqueue_style('buffalo', $dir . 'Buffalo/font.css', [], $version, false);
		wp_enqueue_style('bootstrap-icons', $dir . 'bootstrap-icons/bootstrap-icons.css', [], "1.5.0", false);
	}

	/**
	 * Get theme version
	 *
	 * @return string Theme Version
	 * @since 1.0
	 */
	public static function get_theme_version() 
	{
		$theme = wp_get_theme();	
		return $theme->get("Version");
	}
	
	/**
     * Set query params for blog page by using the GET params
     *
     * @param [array] $query
	 * @since 2.0
     */
    public static function set_query_params( $query ) {
	
        if( $query->is_main_query() 
        && !$query->is_feed() ) {
        
            if(isset($_GET['category'])) {
                $category = $_GET['category'];
                $query->set( 'category_name', $category );
            }
        }
    }

	/**
     * Set custom excerpt length
     *
     * @param int $length
	 * @since 2.0
     */
	public static function custom_excerpt_len( $length ) {
		return 20;
	}

}

new GDI_Theme();