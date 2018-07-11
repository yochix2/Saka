<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php do_action( 'saka_main_before_contents' ); ?>
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="content-wrap saka-<?php echo esc_attr( saka_customize_archive_style() ) . '-layout'; ?>">
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
			</div><!-- .content-wrap -->

			<?php
			get_template_part( 'template-parts/page', 'nav' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
		<?php do_action( 'saka_main_after_contents' ); ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
