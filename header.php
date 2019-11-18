<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saka
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'saka' ); ?></a>

	<header id="masthead" class="site-header">
		<?php do_action( 'saka_header_top_contents' ); ?>

		<div class="site-branding">
			<?php the_custom_logo(); ?>

			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<?php do_action( 'saka_header_bottom_contents' ); ?>
	</header><!-- #masthead -->

	<?php if ( has_nav_menu( 'drawer' ) ) : ?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo apply_filters( 'saka_drawer_button_text', '<span class="dashicons dashicons-menu"></span><span class="screen-reader-text">' . esc_html( 'Primary Menu', 'saka' ) . '</span>'); ?></button>

		<nav id="drawer" class="main-navigation" aria-hidden="true">
			<?php do_action( 'saka_drawer_top_contents' ); ?>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'drawer',
						'menu_id'        => 'primary-menu',
						'container'      => '',
				) ); ?>
			<?php do_action( 'saka_drawer_bottom_contents' ); ?>
		</nav><!-- #drawer -->
	<?php endif; ?>

	<?php if ( ( is_front_page() || is_home() ) && ( has_header_image() || has_header_video() ) ) : ?>
		<?php the_custom_header_markup(); ?>
	<?php endif; ?>
