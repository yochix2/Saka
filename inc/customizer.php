<?php
/**
 * Saka Theme Customizer
 *
 * @package Saka
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function saka_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'render_callback'     => 'saka_customize_partial_blogname',            
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'render_callback'     => 'saka_customize_partial_blogdescription',            
		) );
	}

	// Header background color.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'   => __( 'Header background color', 'saka' ),
		'section' => 'colors',
		'setting' => 'header_background_color',
	) ) );

	// Drawer navigation menu background color.
	$wp_customize->add_setting( 'drawermenu_background_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'drawermenu_background_color', array(
		'label'   => __( 'Drawer menu background color', 'saka' ),
		'section' => 'colors',
		'setting' => 'drawermenu_background_color',
	) ) );

	// Drawer navigation menu background color.
	$wp_customize->add_setting( 'drawermenu_link_color', array(
		'default'           => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'drawermenu_link_color', array(
		'label'   => __( 'Drawer menu link color', 'saka' ),
		'section' => 'colors',
		'setting' => 'drawermenu_link_color',
	) ) );

	// Main text color.
	$wp_customize->add_setting( 'text_color', array(
		'default'           => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'   => __( 'Main text color', 'saka' ),
		'section' => 'colors',
		'setting' => 'text_color',
	) ) );

	// Link text color.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => '#4169e1',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'   => __( 'Link color', 'saka' ),
		'section' => 'colors',
		'setting' => 'link_color',
	) ) );

	// Link text hover color.
	$wp_customize->add_setting( 'link_hover_color', array(
		'default'           => '#191970',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
		'label'   => __( 'Link hover color', 'saka' ),
		'section' => 'colors',
		'setting' => 'link_hover_color',
	) ) );

	// Disable color change function of theme customizer.
	$wp_customize->add_setting( 'checkbox_color_setting', array(
		'default'           => 'false',
		'sanitize_callback' => 'saka_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'checkbox_color_setting', array(
		'label'   => __( 'Disable color function of theme customizer', 'saka' ),
		'section' => 'colors',
		'type'    => 'checkbox',
		'setting' => 'checkbox_color_setting',
	) ) );
}
add_action( 'customize_register', 'saka_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function saka_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function saka_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function saka_customize_preview_js() {
	wp_enqueue_script( 'saka_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'saka_customize_preview_js' );


/**
 * Define the sanitization function for checkboxes.
 *
 * @return bool
 */
function saka_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

function saka_customize_color_css() {
	if ( get_theme_mod( 'checkbox_color_setting', true ) ) {
		return;
	}

	$head_bg_color = esc_attr( get_theme_mod( 'header_background_color', '#fff' ) );
	$drawer_bg_color = esc_attr( get_theme_mod( 'drawermenu_background_color', '#fff' ) );
	$drawer_link_color = esc_attr( get_theme_mod( 'drawermenu_link_color', '#333' ) );
	$text_color = esc_attr( get_theme_mod( 'text_color', '#333' ) );
	$link_color = esc_attr( get_theme_mod( 'link_color', '#4169e1' ) );
	$link_hover_color = esc_attr( get_theme_mod( 'link_hover_color', '#191970' ) );

	$css = '
		/* Custom header background color */
		.site-header {
			background-color: %1$s;
		}

		/* Custom drawer navigation menu background color */
		.drawer {
			background-color: %2$s;
		}

		/* Custom drawer navigation menu link color */
		.main-navigation a {
			color: %3$s;
		}

		/* Custom main text color */
		body,
		button,
		input,
		select,
		textarea {
			color: %4$s;
		}

		/* Custom link color */
		a {
			color: %5$s;
		}

		a:hover,
		a:focus,
		a:active {
			color: %6$s;
		}

		button:hover,
		button:focus,
		button:active,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="button"]:active,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="reset"]:active,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		input[type="submit"]:active,
		.menu-toggle:hover,
		.menu-toggle:focus {
			background-color: %6$s;
		}
	';

	wp_add_inline_style( 'saka-style', sprintf( $css, $head_bg_color, $drawer_bg_color, $drawer_link_color, $text_color, $link_color, $link_hover_color ) );
}
add_action( 'wp_enqueue_scripts', 'saka_customize_color_css', 11 );
