<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'saka' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<div class="content-wrap saka-<?php echo esc_attr( saka_customize_archive_style() ) . '-layout'; ?>">
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
