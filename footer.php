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

	<footer id="colophon" class="site-footer">
		<div class="footer-inner">
			<?php do_action( 'saka_footer_top_contents' ); ?>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav id="footer-navigation" class="sub-navigation">
					<div class="footer-navigation-inner">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
							'container'      => '',
							'depth'          => 1,
					) ); ?>
					</div><!-- .header-navigation-inner -->
				</nav><!-- .footer-navigation -->
			<?php endif; ?>

			<div class="site-info">
			<?php
				if ( saka_customize_site_description() ) :
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif;
				endif; ?>

				<?php
				if( saka_customize_footer_credit_text() ) : ?>
					<small class="site-credit">
						<?php
						$allowed_html = array(
											'a' => array( 'href' => array (), 'title' => array () ),
											'br' => array(),
											'strong' => array(),
											'b' => array(),
											'span' => array(),
										);

						echo wp_kses( saka_customize_footer_credit_text(), $allowed_html ); ?>
					</small>
				<?php
				endif; ?>

			</div><!-- .site-info -->
			<?php do_action( 'saka_footer_bottom_contents' ); ?>
		</div><!-- .footer-inner -->
	</footer><!-- #colophon -->

	<div id="drawer-mask"></div><!-- #drawer-mask -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
