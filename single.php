<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Saka
 */

get_header(); ?>

	<main id="primary" class="content-area">
		<?php do_action( 'saka_main_top_contents' ); ?>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if ( saka_customize_post_nav_checkbox() ) :
				the_post_navigation( apply_filters( 'saka_the_post_navigation_args', array(
					'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span><span class="screen-reader-text">' . __( 'Previous Post', 'saka' ) . '</span>%title',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'saka' ) . '</span>%title<span class="dashicons dashicons-arrow-right-alt2"></span>',
				) ) );
			endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<?php do_action( 'saka_main_bottom_contents' ); ?>
	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
