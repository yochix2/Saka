<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
				/* translators: %s: post title */
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'saka' ), get_the_title() );
				} else {
					printf( /* translators: 1: number of comments, 2: post title */
						esc_html( _nx( '%1$s Reply to &ldquo;%2$s&rdquo;', '%1$s Replies to &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'saka' ) ),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
				wp_list_comments( apply_filters( 'saka_wp_list_comments_args', array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
				) ) );
			?>
		</ol><!-- .comment-list -->

		<?php

		the_comments_pagination( apply_filters( 'saka_the_comments_pagination_args', array(
			'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>' . __( 'Previous', 'saka' ),
			'next_text' => __( 'Next', 'saka' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span>',
		) ) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'saka' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
