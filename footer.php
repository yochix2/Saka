<?php
/**
 * The template for displaying the footer
 *
 * This is the template that displays of footer section and drawer mask.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saka
 */

?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
		<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>

			<small class="site-credit">
				<span class="copyright">&copy; <?php bloginfo( 'name' ); ?></span>
				<span class="sep"> | </span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'saka' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'saka' ), 'WordPress' ); ?></a>	
			</small>	
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<div id="drawer-mask"></div><!-- #drawer-mask -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
