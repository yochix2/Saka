<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Saka
 */

get_header(); ?>

	<main id="primary" class="content-area saka-<?php echo esc_attr( saka_customize_archive_style() ) . '-layout'; ?>">
		<?php do_action( 'saka_main_top_contents' ); ?>

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'saka' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
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
