<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package main-theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function main_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'main_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function main_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'main_pingback_header' );

/**
 * Returns asset version based on filemtime or theme version fallback.
 *
 * @param string $relative_path Path relative to theme root, e.g. '/dist/css/global.css'.
 * @return string
 */
function theme_get_asset_version( $relative_path ) {
	$path = get_template_directory() . $relative_path;

	if ( file_exists( $path ) ) {
		return (string) filemtime( $path );
	}

	return defined( '_S_VERSION' ) ? _S_VERSION : wp_get_theme()->get( 'Version' );
}

/**
 * Adds chevron toggle for submenu items in the primary menu.
 *
 * @param string   $item_output Nav menu item HTML.
 * @param WP_Post  $item        Menu item object.
 * @param int      $depth       Depth of menu item.
 * @param stdClass $args        Menu arguments.
 * @return string
 */
function main_nav_menu_add_chevron( $item_output, $item, $depth, $args ) {
	if (
		isset( $args->theme_location )
		&& 'primary' === $args->theme_location
		&& in_array( 'menu-item-has-children', $item->classes, true )
	) {
		$item_output .= '<span class="menu-chevron" role="button" tabindex="0" aria-label="' . esc_attr__( 'Toggle submenu', 'main' ) . '"><i aria-hidden="true">&#9662;</i></span>';
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'main_nav_menu_add_chevron', 10, 4 );

