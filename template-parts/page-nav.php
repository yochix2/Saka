<?php
/**
 * The template for displays paginate links
 *
 * @since 1.2.0
 * @package Saka
 */

the_posts_pagination( apply_filters( 'saka_the_posts_pagination_args', array(
	'prev_text' => '<span class="fas fa-chevron-circle-left"></span>' . __( 'Previous page', 'saka' ),
	'next_text' => __( 'Next page', 'saka' ) . '<span class="fas fa-chevron-circle-right"></span>',
	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'saka' ) . ' </span>',
) ) );
