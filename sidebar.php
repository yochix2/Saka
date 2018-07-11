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

<aside id="secondary" class="widget-area">
	<?php do_action( 'saka_sidebar_top_contents' ); ?>
	<div class="widget-area-inner">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- .widget-area-inner -->
	<?php do_action( 'saka_sidebar_bottom_contents' ); ?>
</aside><!-- #secondary -->
