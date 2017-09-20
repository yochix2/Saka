<?php
/**
 * Template part for displaying excerpts of posts
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
			<?php saka_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	if ( has_post_thumbnail() ) : 
	?>
		<div class="entry-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ) ?>">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
		</div><!-- .entry-thumbnail -->
	<?php
	endif; ?>

	<div class="entry-summary">
	<?php
		if ( preg_match( '/<!--more(.*?)?-->/', $post->post_content ) && ! has_excerpt() ) :
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rsaquo;</span>', 'saka' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		else :
			the_excerpt();
		endif;
	?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php saka_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
