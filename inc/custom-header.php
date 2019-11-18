<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Saka
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses saka_header_style()
 */
function saka_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'saka_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '333333',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'video'                  => true,
		'wp-head-callback'       => 'saka_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'saka_custom_header_setup' );

if ( ! function_exists( 'saka_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see saka_custom_header_setup().
 */
function saka_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
	// Has the text been hidden?
	if ( ! display_header_text() ) :
		?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
	// If the user has set a custom color for the text use that.
	else :
		?>
		.site-title a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

function saka_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . __( 'Play background video', 'saka' ) . '</span><span class="dashicons dashicons-controls-play"></span>';
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . __( 'Pause background video', 'saka' ) . '</span><span class="dashicons dashicons-controls-pause"></span>';
	return $settings;
}
add_filter( 'header_video_settings', 'saka_video_controls' );
