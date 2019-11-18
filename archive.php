<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

get_header(); ?>

	<main id="primary" class="content-area saka-<?php echo esc_attr( saka_customize_archive_style() ) . '-layout'; ?>">
		<?php do_action( 'saka_main_top_contents' ); ?>

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

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
