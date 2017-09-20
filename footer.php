<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saka
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container footer-inner">
			<div class="site-info">
			<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>

				<span class="copyright">&copy; <?php bloginfo( 'name' ); ?></span>
				<span class="sep"> | </span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'saka' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'saka' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</div><!-- .container / footer-inner -->
	</footer><!-- #colophon -->

	<div id="drawer-mask"></div><!-- #drawer-mask -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
