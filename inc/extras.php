<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Saka
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function saka_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class if there is a custom header image.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add a class if there is a custom header video.
	if ( has_header_video() ) {
		$classes[] = 'has-header-video';
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'saka-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'saka_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function saka_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'saka_pingback_header' );

if ( ! function_exists( 'saka_widget_cat_count' ) ) {
	/**
	 * Change output of category widgets.
	 *
	 * @param  string $output Return the count with brackets.
	 * @return string the category widget with output span tag.
	 * @since  1.2.0
	 */
	function saka_widget_cat_count( $output ) {
		$output = preg_replace( '/<\/a> \((\d+)\)/', ' <span class="cat-link-count">$1</span></a>', $output );
		return $output;
	}
}
add_filter( 'wp_list_categories', 'saka_widget_cat_count' );

if ( ! function_exists( 'saka_widget_archive_count' ) ) {
	/**
	 * Change output of Archive widgets.
	 *
	 * @param  string $output Arguments for category widget.
	 * @return string the archive widget with output span tag.
	 * @since  1.2.0
	 */
	function saka_widget_archive_count( $output ) {
		$output = preg_replace('/<\/a>&nbsp;\((\d+)\)/',' <span class="archive-link-count">$1</span></a>', $output );
  		return $output;
	}
}
add_filter( 'get_archives_link', 'saka_widget_archive_count' );

if ( ! function_exists( 'saka_widget_tag_cloud_count' ) ) {
	/**
	 * Remove parentheses of tag cloud widgets.
	 *
	 * @param  string $output Arguments for tag_cloud widget.
	 * @return string the tag_cloud widget with output span tag.
	 * @since  1.2.0
	 */
	function saka_widget_tag_cloud_count( $output ) {
		$output = str_replace( ' (', '',  $output );
		$output = str_replace( ')', '',  $output );
		return $output;
	}
}
add_filter( 'wp_tag_cloud', 'saka_widget_tag_cloud_count');

if ( ! function_exists( 'saka_thumbnail_url' ) ) {
	/**
	 * If the featured image is not set, placefoler image is displayed.
	 *
	 * @param  string $size Arguments for post thumbnail size.
	 * @return string $url  the url to set as post thumbnail.
	 * @since  1.2.0
	 */
	function saka_thumbnail_url( $size ) {
		if ( has_post_thumbnail() ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), esc_html( $size ) );
			$url       = esc_url( $thumbnail[0] );
		} else {
			$url = esc_url( saka_customize_archive_placefolder_image() );
		}

		return $url;
	}
}
