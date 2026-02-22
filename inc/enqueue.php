<?php

function theme_assets() {
	$uri = get_template_directory_uri();
	$ver = defined('_S_VERSION') ? _S_VERSION : filemtime(get_template_directory() . '/dist/css/global.css');

	// All
	wp_enqueue_style('theme-fonts',  $uri . '/dist/css/fonts.css',  [], $ver);
	wp_enqueue_style('theme-global', $uri . '/dist/css/global.css', [], $ver);
	wp_enqueue_style('theme-header', $uri . '/dist/css/header.css', ['theme-global'], $ver);
	wp_enqueue_style('theme-footer', $uri . '/dist/css/footer.css', ['theme-global'], $ver);

	// Page or Type specific
	if ( is_front_page() && file_exists(get_template_directory() . '/dist/css/pages/front-page.css') ) {
		wp_enqueue_style('theme-front-page', $uri . '/dist/css/pages/front-page.css', ['theme-global'], $ver);
	}

	if ( is_single() && file_exists(get_template_directory() . '/dist/css/pages/single.css') ) {
		wp_enqueue_style('theme-single', $uri . '/dist/css/pages/single.css', ['theme-global'], $ver);
	}

	if ( is_page() && file_exists(get_template_directory() . '/dist/css/pages/page.css') ) {
		wp_enqueue_style('theme-page', $uri . '/dist/css/pages/page.css', ['theme-global'], $ver);
	}

	if ( is_archive() && file_exists(get_template_directory() . '/dist/css/pages/archive.css') ) {
		wp_enqueue_style('theme-archive', $uri . '/dist/css/pages/archive.css', ['theme-global'], $ver);
	}

	// Подключаем jQuery
	wp_enqueue_script( 'jquery' );

	// Libs
	wp_register_script(
		'theme-fancybox',
		$uri . '/dist/js/libs/fancybox.min.js',
		['jquery'],
		$ver,
		true
	);

	wp_enqueue_script(
		'theme-header',
		$uri . '/dist/js/header.min.js',
		['jquery'],
		$ver,
		true
	);

}
add_action('wp_enqueue_scripts', 'theme_assets');

function theme_admin_assets() {
	$uri = get_template_directory_uri();
	$path = get_template_directory() . '/dist/css/admin-styles.css';

	if ( file_exists($path) ) {
		wp_enqueue_style('theme-admin', $uri . '/dist/css/admin-styles.css', [], filemtime($path));
	}
}
add_action('admin_enqueue_scripts', 'theme_admin_assets');

// Customizer JS
add_action( 'customize_preview_init', function() {
    wp_enqueue_script(
        'theme-customizer',
        get_template_directory_uri() . '/dist/js/customizer.min.js',
        ['jquery', 'customize-preview'],
        filemtime( get_template_directory() . '/dist/js/customizer.min.js' ),
        true
    );
});