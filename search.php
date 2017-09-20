<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Saka
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div class="container content-area-inner">
			<main id="main" class="site-main" role="main">

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
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => '<span class="fa fa-chevron-circle-left" aria-hidden="true"></span>' . __( 'Previous page', 'saka' ),
					'next_text' => __( 'Next page', 'saka' ) . '<span class="fa fa-chevron-circle-right" aria-hidden="true"></span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'saka' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- .container .content-area-inner -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
