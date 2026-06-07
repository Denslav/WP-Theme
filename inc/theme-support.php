<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function main_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on main-theme, use a find and replace
		* to change 'main' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'main', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary Menu', 'main' ),
			'footer'  => esc_html__( 'Footer Menu', 'main' ),
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
			'main_custom_background_args',
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
add_action( 'after_setup_theme', 'main_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function main_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'main_content_width', 1200 );
}
add_action( 'after_setup_theme', 'main_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function main_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'main' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'main' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'main_widgets_init' );

// Allow SVG uploads
function allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');

// Width Container
function theme_dynamic_styles() {
    $container_width  = get_theme_mod( 'container_width', 1200 );
    $container_padding = get_theme_mod( 'container_padding', 14 );

    echo '<style>
        .container {
            max-width: ' . esc_attr( $container_width ) . 'px;
            padding-left: ' . esc_attr( $container_padding ) . 'px;
            padding-right: ' . esc_attr( $container_padding ) . 'px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>';
}
add_action( 'wp_head', 'theme_dynamic_styles' );


// Register ACF Blocks
if ( ! function_exists( 'register_acf_blocks' ) ) {
    add_action( 'init', 'register_acf_blocks' );

    function register_acf_blocks() {
        $blocks = [
            'main-hero',
            // Add your blocks here
        ];

        foreach ( $blocks as $block ) {
            register_block_type( get_stylesheet_directory() . '/parts/blocks/' . $block );
        }
    }
}

// Translate
if ( ! function_exists( 'theme_translate' ) ) {
    function theme_translate( $text ) {
        if ( function_exists( 'pll__' ) ) {
            return pll__( $text );
        }

        return $text;
    }
}

// Register strings
add_action( 'init', function() {
    if ( ! function_exists( 'pll_register_string' ) ) {
        return;
    }

    pll_register_string( 'search_results_title', 'Результаты поиска: %s', 'Theme' );
    pll_register_string( 'posts_not_found', 'Записей не найдено.', 'Theme' );
    pll_register_string( 'pagination_prev', 'Назад', 'Theme' );
    pll_register_string( 'pagination_next', 'Вперед', 'Theme' );
    pll_register_string( 'search_form_label', 'Search for:', 'Theme' );
    pll_register_string( 'search_form_placeholder', 'Search...', 'Theme' );
    pll_register_string( 'search_form_button', 'Search', 'Theme' );
    pll_register_string( 'search_results_for', 'Search results for:', 'Theme' );
    pll_register_string( 'search_pagination_prev', '← Previous', 'Theme' );
    pll_register_string( 'search_pagination_next', 'Next →', 'Theme' );
    pll_register_string( 'search_nothing_found', 'Nothing found', 'Theme' );
    pll_register_string( 'search_try_again', 'Try searching again with different keywords.', 'Theme' );
    pll_register_string( 'read_more', 'Read more', 'Theme' );
    pll_register_string( '404_title', '404: Page Not Found', 'Theme' );
    pll_register_string( '404_text', 'Sorry, we can\'t find that page. It might have been moved or deleted.', 'Theme' );
    pll_register_string( '404_home', 'Go to Homepage', 'Theme' );
    pll_register_string( '404_back', 'Go Back', 'Theme' );
} );