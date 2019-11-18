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
			'selector'            => '.site-title a',
			'render_callback'     => 'saka_customize_partial_blogname',            
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'render_callback'     => 'saka_customize_partial_blogdescription',            
		) );
	}

	/**
	 * Define the sanitization function for checkboxes.
	 *
	 * @since 1.2.0
	 * @param bool $checked The strings that will be checked.
	 * @return bool
	 */
	function saka_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	/**
	 * Define the sanitization function for radio button / select boxes.
	 *
	 * @since 1.2.0
	 * @param string $input The strings that will be checked.
	 * @param string $setting The possible choices.
	 * @return string
	 */

	function saka_sanitize_select( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Define the sanitization function for image file input.
	 *
	 * @since 1.2.0
	 */
	function saka_sanitize_image( $file, $setting ) {
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png'
		);
		$file_ext = wp_check_filetype( $file, $mimes );
		return ( $file_ext['ext'] ? $file : $setting->default );
	}

	/*
	 * -------------------------------------------------------------------------
	 *  Color
	 * -------------------------------------------------------------------------
	 */

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

	/*
	 * -------------------------------------------------------------------------
	 *  Theme options
	 * -------------------------------------------------------------------------
	 */

	$wp_customize->add_section( 'theme_options', array(
		'title'    => __( 'Theme Options', 'saka' ),
		'priority' => 130,
	) );
	
	// Font size
	$wp_customize->add_setting( 'site_font_size' , array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_font_size', array(
		'label'	   =>  __( 'Site font size', 'saka' ),
		'section'  => 'title_tagline',
		'type'     => 'number',
		'priority' => 50,
		'input_attrs' => array(
			'step' => '1',
			'min'  => '11',
			'max'  => '21',
		),
	) ) );

	// Site description.
	$wp_customize->add_setting( 'site_description', array(
		'default'           => true,
		'sanitize_callback' => 'saka_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_description', array(
		'label'   => __( 'Show site description', 'saka' ),
		'section' => 'theme_options',
		'type'    => 'checkbox',
	) )	);

	// Single post navigation.
	$wp_customize->add_setting( 'single_post_nav', array(
		'default'           => true,
		'sanitize_callback' => 'saka_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'single_post_nav', array(
		'label'   => __( 'Show post navigation', 'saka' ),
		'section' => 'theme_options',
		'type'    => 'checkbox',
	) );

	// Footer site credit.
	$wp_customize->add_setting( 'footer_credit_text', array(
		'default'           => '<a href="' . esc_url( __( 'https://wordpress.org/', 'saka' ) ) . '">' . esc_html__( 'Proudly powered by WordPress', 'saka' ) . '</a>',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'footer_credit_text', array(
		'label'       => __( 'Edit the site credit', 'saka' ),
		'description' => __( 'Edit the copyright text show in the footer.', 'saka' ),
		'section'     => 'theme_options',
		'type'        => 'textarea',
	) );

	// Archive page style select.
	$wp_customize->add_setting( 'archive_style', array(
		'default'           => 'full',
		'sanitize_callback' => 'saka_sanitize_select',
	) );

	$wp_customize->add_control( 'archive_style', array(
		'label'   => __( 'Archive page show settings', 'saka' ),
		'description' => __( 'Select how you want to show the archive page.', 'saka' ),
		'section' => 'theme_options',
		'type'    => 'select',
		'choices' => array(
			'full'    => __( 'Full text', 'saka' ),
			'summary' => __( 'Summary', 'saka' ),
			'card'    => __( 'Card', 'saka' ),
		),
	) );

	// Placefoler image setting.
	$wp_customize->add_setting( 'archive_placefolder_image', array(
		'default'           => esc_url( get_template_directory_uri() . '/assets/img/no-image.png' ),
		'sanitize_callback' => 'saka_sanitize_image',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'archive_placefolder_image', array(
		'label'   => __( 'Sets the default image if there is no featured image. (Card style selected only)', 'saka' ),
		'section' => 'theme_options',
	) )	);
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
 * Get whether dispyaing the site description or not.
 *
 * @since 1.2.0
 */
function saka_customize_site_description() {
	return ( get_theme_mod( 'site_description', true ) );
}

/**
 * Get the contents of the theme credit text.
 *
 * @since 1.2.0
 */
function saka_customize_footer_credit_text() {
	return get_theme_mod( 'footer_credit_text', '<a href="' . esc_url( __( 'https://wordpress.org/', 'saka' ) ) . '">' . esc_html__( 'Proudly powered by WordPress', 'saka' ) . '</a>' );
}

/**
 * Get page style for archive pages.
 *
 * @since 1.2.0
 */
function saka_customize_archive_style() {
	return ( get_theme_mod( 'archive_style', '' ) );
}

/**
 * Get the placefolder image for set no featured image.
 *
 * @since 1.2.0
 */
function saka_customize_archive_placefolder_image() {
	return ( get_theme_mod( 'archive_placefolder_image', esc_url( get_template_directory_uri() . '/assets/img/no-image.png' ) ) );
}

/**
 * Get whether display the post navigation on single page.
 *
 * @since 1.2.0
 */
function saka_customize_post_nav_checkbox() {
	return ( get_theme_mod( 'single_post_nav', true ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function saka_customize_preview_js() {
	wp_enqueue_script( 'saka_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'saka_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function saka_customize_controls_js() {
	wp_enqueue_script( 'saka-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array(), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'saka_customize_controls_js' );

function saka_customize_color_css() {

	$style_css = '';

	// Header background color.
	if ( get_theme_mod( 'header_background_color', '#fff' ) !== '#fff' ) {
		$header_bg_color = esc_attr( get_theme_mod( 'header_background_color', '#fff' ) );
		$style_css    .= ".site-header { background-color: $header_bg_color; } ";
	}

	// Font size.
	if ( get_theme_mod( 'site_font_size', '16' ) !== '16' ) {
		$font_size  = absint( get_theme_mod( 'site_font_size' ) );
		$style_css .= "html,body { font-size: ${font_size}px; } ";
	}

	wp_add_inline_style( 'saka-style', $style_css );
}
add_action( 'wp_enqueue_scripts', 'saka_customize_color_css', 11 );
