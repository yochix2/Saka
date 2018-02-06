<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'saka' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container header-inner">
			<div class="site-branding">
				<?php saka_the_custom_logo(); ?>

				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<?php if ( has_nav_menu( 'drawer' ) ) : ?>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="fa fa-bars" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'saka' ); ?></span></button>

				<nav id="site-navigation" class="main-navigation drawer" role="navigation" aria-hidden="true">
					<div class="main-navigation-inner drawer-inner">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'drawer',
								'menu_id'        => 'primary-menu',
								'container'      => '',
						) ); ?>
					</div><!-- .main-navigation-inner .drawer-inner -->
				</nav><!-- #site-navigation -->
			<?php endif; ?>

			<?php
			if ( get_header_image() ) : ?>
				<div class="header-image">
					<img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="">
				</div>
			<?php
			endif; ?>
		</div><!-- .container .header-inner -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
