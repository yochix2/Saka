<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Saka
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="container content-area-inner">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

				the_post_navigation( array (
					'prev_text' => '<span class="fa fa-chevron-circle-left" aria-hidden="true"></span><span class="screen-reader-text">' . __( 'Previous Post', 'saka' ) . '</span>%title',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'saka' ) . '</span>%title<span class="fa fa-chevron-circle-right" aria-hidden="true"></span>'
				) );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- .container .content-area-inner -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
