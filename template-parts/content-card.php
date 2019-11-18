<?php
/**
 * Template part for displaying excerpts of posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'saka-card' ); ?>>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><span class="dashicons dashicons-sticky"></span><?php _e( 'Featured', 'saka' ); ?></span>
	<?php endif; ?>
	<a class="card-link" href="<?php the_permalink(); ?>">
		<figure class="card-thumbnail">
			<img src="<?php echo esc_url( saka_thumbnail_url( 'large' ) ); ?>" class="card-thumbnail-image">
		</figure>

		<div class="card-details">
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="card-meta">
					<?php
					saka_card_date();
					saka_card_meta(); ?>
				</div><!-- .card-meta -->
			<?php endif; ?>

			<div class="card-text">
				<?php the_title( '<h2 class="card-title">', '</h2>' ); ?>
			</div><!-- .card-text -->

			<footer class="card-footer">
				<?php
				saka_card_category();
				saka_card_footer(); ?>
			</footer><!-- .card-footer -->
		</div>
	</a>
	<?php saka_edit_link(); ?>
</article><!-- #post-## -->
