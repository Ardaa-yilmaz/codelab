<?php
/**
 * codelab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package codelab
 */

if ( ! function_exists( 'codelab_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function codelab_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on codelab, use a find and replace
		 * to change 'codelab' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'codelab', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'codelab' ),
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
		add_theme_support( 'custom-background', apply_filters( 'codelab_custom_background_args', array(
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

		
		/**
		 * Do Elementor or Jet Theme Core location
		 *
		 * @param string $location
		 * @param string $fallback
		 *
		 * @return bool
		 */
		public function do_location( $location = null, $fallback = null ) {

			$handler = false;
			$done    = false;

			// Choose handler
			if ( function_exists( 'jet_theme_core' ) ) {
				$handler = array( jet_theme_core()->locations, 'do_location' );
			} elseif ( function_exists( 'elementor_theme_do_location' ) ) {
				$handler = 'elementor_theme_do_location';
			}

			// If handler is found - try to do passed location
			if ( false !== $handler ) {
				$done = call_user_func( $handler, $location );
			}

			if ( true === $done ) {
				// If location successfully done - return true
				return true;
			} elseif ( null !== $fallback ) {
				// If for some reasons location coludn't be done and passed fallback template name - include this template and return
				if ( is_array( $fallback ) ) {
					// fallback in name slug format
					get_template_part( $fallback[0], $fallback[1] );
				} else {
					// fallback with just a name
					get_template_part( $fallback );
				}
				return true;
			}

			// In other cases - return false
			return false;

		}


		
		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return Codelab_Theme_Setup
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}

	}
endif;


add_action( 'after_setup_theme', 'codelab_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codelab_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'codelab_content_width', 640 );
}
add_action( 'after_setup_theme', 'codelab_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function codelab_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'codelab' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'codelab' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'codelab_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function codelab_scripts() {
	wp_enqueue_style( 'codelab-style', get_stylesheet_uri() );

	wp_enqueue_script( 'codelab-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'codelab-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codelab_scripts' );

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
 * Returns instance of main theme configuration class.
 *
 * @since  1.0.0
 * @return Codelab_Theme_Setup
 */
function codelab_theme() {
	return Codelab_Theme_Setup::get_instance();
}

codelab_theme();