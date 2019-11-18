<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'saka-blocks' ); ?>>
	<?php do_action( 'saka_entry_top_contents' ); ?>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><span class="dashicons dashicons-sticky"></span><?php _e( 'Featured', 'saka' ); ?></span>
	<?php endif; ?>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				saka_entry_date();
				saka_entry_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( ! has_block( 'image' ) ): ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure><!-- .entry-thumbnail -->
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'saka_entry_content_before_contents' ); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saka' ),
			'after'  => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php do_action( 'saka_entry_content_after_contents' ); ?>

	<footer class="entry-footer">
		<?php
		saka_entry_categories();
		saka_entry_tags();
		saka_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php do_action( 'saka_entry_bottom_contents' ); ?>
</article><!-- #post-## -->
