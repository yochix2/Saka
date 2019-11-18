<?php
/**
 * The template for displays paginate links
 *
 * @since 1.2.0
 * @package Saka
 */

the_posts_pagination( apply_filters( 'saka_the_posts_pagination_args', array(
	'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>' . __( 'Previous page', 'saka' ),
	'next_text' => __( 'Next page', 'saka' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span>',
	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'saka' ) . ' </span>',
) ) );
