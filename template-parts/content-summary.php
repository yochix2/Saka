<?php
/**
 * Template part for displaying excerpts of posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'saka-summary' ); ?>>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><span class="dashicons dashicons-sticky"></span><?php _e( 'Featured', 'saka' ); ?></span>
	<?php endif; ?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			saka_entry_date();
			saka_entry_meta(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ) ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</figure><!-- .entry-thumbnail -->
	<?php endif; ?>

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
