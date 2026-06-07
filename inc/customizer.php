<?php
/**
 * Main Theme Customizer
 *
 * @package main
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function main_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		//Container settings
	$wp_customize->add_section( 'container_settings_section', array(
		'title'    => __( 'Container settings', 'main' ),
		'priority' => 30, 
	) );

	$wp_customize->add_setting( 'container_width', array(
		'default'           => 1200,
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );
	
	$wp_customize->add_control( 'container_width', array(
		'label'       => __( 'Container width (px) Max-1920px', 'main' ),
		'section'     => 'container_settings_section',
		'type'        => 'number', 
		'input_attrs' => array(
			'min'  => 800,
			'max'  => 1920,
			'step' => 10,
		),
	) );

	$wp_customize->add_setting( 'container_padding', array(
		'default'           => 14,
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'container_padding', array(
		'label'       => __( 'Container padding (px)', 'main' ),
		'section'     => 'container_settings_section',
		'type'        => 'number', // <-- type = number
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	) );

	// Header background
	$wp_customize->add_setting( 'header_bg_color', [
		'default'           => '#ffffff',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	] );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'header_bg_color',
		[
			'label'   => 'Header background',
			'section' => 'colors', // ВАЖНО: стандартная вкладка Colors
		]
	) );

	// Footer background
	$wp_customize->add_setting( 'footer_bg_color', [
		'default'           => '#0f172a',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	] );

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'footer_bg_color',
		[
			'label'   => 'Footer background',
			'section' => 'colors',
		]
	) );

	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'main_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'main_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'main_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function main_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function main_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Output customizer CSS in the head
 */
add_action( 'wp_head', function() {
	$header_bg = get_theme_mod( 'header_bg_color', '#ffffff' );
	$footer_bg = get_theme_mod( 'footer_bg_color', '#0f172a' );

	echo '<style>
		.header { background-color: ' . esc_attr( $header_bg ) . '; }
		.footer { background-color: ' . esc_attr( $footer_bg ) . '; }
	</style>';
} );