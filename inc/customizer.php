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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
  
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title',
			'container_inclusive' => false,
			'render_callback'     => function() { bloginfo( 'name' ); },            
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => function() { bloginfo( 'description' ); },            
		) );
	}

	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'   => __( 'Header background color', 'saka' ),
		'section' => 'colors',
		'setting' => 'header_background_color',
	) ) );

	$wp_customize->add_setting( 'drawermenu_background_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'drawermenu_background_color', array(
		'label'   => __( 'Drawer menu background color', 'saka' ),
		'section' => 'colors',
		'setting' => 'drawermenu_background_color',
	) ) );

	$wp_customize->add_setting( 'link_color', array(
		'default'           => '#4169e1',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'   => __( 'Link color', 'saka' ),
		'section' => 'colors',
		'setting' => 'link_color',
	) ) );

	$wp_customize->add_setting( 'link_hover_color', array(
		'default'           => '#191970',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
		'label'   => __( 'Link hover color', 'saka' ),
		'section' => 'colors',
		'setting' => 'link_hover_color',
	) ) );
}
add_action( 'customize_register', 'saka_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function saka_customize_preview_js() {
	wp_enqueue_script( 'saka_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'saka_customize_preview_js' );

function saka_header_background_color_css() {
	$bg_color = esc_attr( get_theme_mod( 'header_background_color', '#fff' ) );

	$css = '
		/* Custom header background color */
		.site-header {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'saka-style', sprintf( $css, $bg_color ) );
}
add_action( 'wp_enqueue_scripts', 'saka_header_background_color_css', 11 );

function saka_drawermenu_background_color_css() {
	$bg_color = esc_attr( get_theme_mod( 'drawermenu_background_color', '#fff' ) );

	$css = '
		/* Custom drawer navigation menu background color */
		.drawer {
			background-color: %1$s;
		}
	';

  wp_add_inline_style( 'saka-style', sprintf( $css, $bg_color ) );
}
add_action( 'wp_enqueue_scripts', 'saka_drawermenu_background_color_css', 11 );

function saka_link_color_css() {
	$link_color = esc_attr( get_theme_mod( 'link_color', '#4169e1' ) );
	$link_hover_color = esc_attr( get_theme_mod( 'link_hover_color', '#191970' ) );

	$css = '
		/* Custom link color */
		a {
			color: %1$s;
		}

		a:hover,
		a:focus,
		a:active {
			color: %2$s;
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
			background-color: %2$s;
		}
	';

	wp_add_inline_style( 'saka-style', sprintf( $css, $link_color, $link_hover_color ) );
}
add_action( 'wp_enqueue_scripts', 'saka_link_color_css', 11 );