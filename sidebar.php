<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saka
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="container widget-area-inner">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- .container .widget-area-inner -->
</aside><!-- #secondary -->
