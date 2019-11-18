<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'saka-blocks' ); ?>>
	<?php do_action( 'saka_entry_top_contents' ); ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumbnail">
			<?php the_post_thumbnail( 'large' ); ?>
		</figure><!-- .entry-thumbnail -->
	<?php endif; ?>

	<?php do_action( 'saka_entry_content_before_contents' ); ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saka' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php do_action( 'saka_entry_content_after_contents' ); ?>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php saka_edit_link( get_the_ID() ); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	<?php do_action( 'saka_entry_bottom_contents' ); ?>
</article><!-- #post-## -->
