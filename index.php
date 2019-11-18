<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

get_header(); ?>

	<main id="primary" class="content-area saka-<?php echo esc_attr( saka_customize_archive_style() ) . '-layout'; ?>">
		<?php do_action( 'saka_main_top_contents' ); ?>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header class="screen-reader-text">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif; ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', esc_html( saka_customize_archive_style() ) );

			endwhile; ?>

			<?php
			get_template_part( 'template-parts/page', 'nav' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		<?php do_action( 'saka_main_bottom_contents' ); ?>
	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
