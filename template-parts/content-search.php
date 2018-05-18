<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			saka_entry_date();
			saka_entry_meta(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php saka_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
		saka_entry_categories();
		saka_entry_tags();
		saka_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
