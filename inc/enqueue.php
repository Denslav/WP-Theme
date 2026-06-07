<?php

function theme_assets() {
	$uri = get_template_directory_uri();
	$dir = get_template_directory();
	$ver = theme_get_asset_version( '/dist/css/global.css' );

	$styles = [
		'theme-fonts'  => '/dist/css/fonts.css',
		'theme-global' => '/dist/css/global.css',
		'theme-header' => '/dist/css/header.css',
		'theme-footer' => '/dist/css/footer.css',
	];

	foreach ( $styles as $handle => $relative_path ) {
		if ( file_exists( $dir . $relative_path ) ) {
			$deps = 'theme-global' === $handle ? [] : [ 'theme-global' ];
			wp_enqueue_style( $handle, $uri . $relative_path, $deps, theme_get_asset_version( $relative_path ) );
		}
	}

	// Page or Type specific
	if ( is_front_page() && file_exists( $dir . '/dist/css/pages/front-page.css' ) ) {
		wp_enqueue_style( 'theme-front-page', $uri . '/dist/css/pages/front-page.css', [ 'theme-global' ], theme_get_asset_version( '/dist/css/pages/front-page.css' ) );
	}

	if ( is_single() && file_exists( $dir . '/dist/css/pages/single.css' ) ) {
		wp_enqueue_style( 'theme-single', $uri . '/dist/css/pages/single.css', [ 'theme-global' ], theme_get_asset_version( '/dist/css/pages/single.css' ) );
	}

	if ( is_page() && file_exists( $dir . '/dist/css/pages/page.css' ) ) {
		wp_enqueue_style( 'theme-page', $uri . '/dist/css/pages/page.css', [ 'theme-global' ], theme_get_asset_version( '/dist/css/pages/page.css' ) );
	}

	if ( is_archive() && file_exists( $dir . '/dist/css/pages/archive.css' ) ) {
		wp_enqueue_style( 'theme-archive', $uri . '/dist/css/pages/archive.css', [ 'theme-global' ], theme_get_asset_version( '/dist/css/pages/archive.css' ) );
	}

	wp_enqueue_script( 'jquery' );

	$header_js = $dir . '/dist/js/header.min.js';
	if ( file_exists( $header_js ) ) {
		wp_enqueue_script(
			'theme-header',
			$uri . '/dist/js/header.min.js',
			[ 'jquery' ],
			theme_get_asset_version( '/dist/js/header.min.js' ),
			true
		);
	}

	$fancybox_js = $dir . '/dist/js/libs/fancybox.min.js';
	if ( file_exists( $fancybox_js ) ) {
		wp_enqueue_script(
			'theme-fancybox',
			$uri . '/dist/js/libs/fancybox.min.js',
			[ 'jquery' ],
			theme_get_asset_version( '/dist/js/libs/fancybox.min.js' ),
			true
		);

		wp_localize_script(
			'theme-fancybox',
			'thmLocalize',
			[
				'themeUrl' => $uri,
			]
		);

		$gallery_js = $dir . '/dist/js/blocks/fancy-box-gallery.min.js';
		if ( file_exists( $gallery_js ) ) {
			wp_enqueue_script(
				'theme-fancybox-gallery',
				$uri . '/dist/js/blocks/fancy-box-gallery.min.js',
				[ 'theme-fancybox' ],
				theme_get_asset_version( '/dist/js/blocks/fancy-box-gallery.min.js' ),
				true
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'theme_assets' );

function theme_admin_assets() {
	$uri  = get_template_directory_uri();
	$path = get_template_directory() . '/dist/css/admin-styles.css';

	if ( file_exists( $path ) ) {
		wp_enqueue_style( 'theme-admin', $uri . '/dist/css/admin-styles.css', [], filemtime( $path ) );
	}
}
add_action( 'admin_enqueue_scripts', 'theme_admin_assets' );

add_action( 'customize_preview_init', function() {
	$script_path = get_template_directory() . '/dist/js/customizer.min.js';

	if ( ! file_exists( $script_path ) ) {
		return;
	}

	wp_enqueue_script(
		'theme-customizer',
		get_template_directory_uri() . '/dist/js/customizer.min.js',
		[ 'jquery', 'customize-preview' ],
		theme_get_asset_version( '/dist/js/customizer.min.js' ),
		true
	);
} );
