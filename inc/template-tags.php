<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Saka
 */

if ( ! function_exists( 'saka_entry_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function saka_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'saka' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'saka_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function saka_entry_meta() {
		$author_avatar_size = apply_filters( 'saka_author_avatar_size', 46 );

		printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			_x( 'Author', 'Used before post author name.', 'saka' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
endif;

if ( ! function_exists( 'saka_entry_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function saka_entry_categories() {
		// Hide category for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'saka' ) );
			if ( $categories_list && saka_categorized_blog() ) {
				printf( '<span class="cat-links"><span class="cat-names">%1$s </span>%2$s</span>',
					_x( 'Categories', 'Used before category names.', 'saka' ),
					$categories_list
				);
			}
		}
	}
endif;

if ( ! function_exists( 'saka_entry_tags' ) ) :
	/**
	 * Prints HTML with meta information for the tags.
	 */
	function saka_entry_tags() {
		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'saka' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links"><span class="tags-names">%1$s </span>%2$s</span>',
					_x( 'Tags', 'Used before tag names.', 'saka' ),
					$tags_list
				);
			}
		}
	}
endif;

if ( ! function_exists( 'saka_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the comments.
	 */
	function saka_entry_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'saka' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		saka_edit_link();
	}
endif;

if ( ! function_exists( 'saka_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function saka_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit <span class="screen-reader-text">"%s"</span>', 'saka' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/*
 * -------------------------------------------------------------------------
 *  Card style
 * -------------------------------------------------------------------------
 */

if ( ! function_exists( 'saka_card_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function saka_card_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Posted on', 'Used before publish date.', 'saka' ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'saka_card_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function saka_card_meta() {
		$author_avatar_size = apply_filters( 'saka_author_avatar_size', 46 );

		printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span></span>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			_x( 'Author', 'Used before post author name.', 'saka' ),
			get_the_author()
		);
	}
endif;

if ( ! function_exists( 'saka_card_category' ) ) :
	/**
	 * Prints HTML with meta information for the category.
	 */
	function saka_card_category() {
		// Hide category for pages.
		if ( 'post' === get_post_type() ) {
			if ( has_category() ) {
				/* translators: used between list items, there is a space after the comma */
				$post_category = get_the_category();
				printf( '<span class="meta-cat"><span class="screen-reader-text">%1$s</span>%2$s</span>',
					_x( 'Category', 'Used before category name.', 'saka' ),
					$post_category[0]->name
				);
			}
		}
	}
endif;

if ( ! function_exists( 'saka_card_footer' ) ) :
	/**
	 * Prints HTML with meta information for the comments.
	 */
	function saka_card_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_number( sprintf( wp_kses( __( '0 Comment<span class="screen-reader-text"> on %s</span>', 'saka' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ), sprintf( wp_kses( __( '1 Comment<span class="screen-reader-text"> on %s</span>', 'saka' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ), sprintf( wp_kses( __( '%1$s Comments<span class="screen-reader-text"> on %2$s</span>', 'saka' ), array( 'span' => array( 'class' => array() ) ) ), '%', get_the_title() ) );
			echo '</span>';
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function saka_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'saka_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'saka_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so saka_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so saka_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in saka_categorized_blog.
 */
function saka_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'saka_categories' );
}
add_action( 'edit_category', 'saka_category_transient_flusher' );
add_action( 'save_post',     'saka_category_transient_flusher' );
