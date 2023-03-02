<?php
/**
 * Times Square
 *
 */

#if ( ! is_active_sidebar( 'sidebar-right' ) ) {
#	return;
#}
?>
<?php
	if(isset($times_square_settings['menu-sidebar-right-status'])) {
		$name = 'right';
		$menu = wp_nav_menu( array(
			'menu'            => $name,
			'container'       => 'div',
			'container_class' => 'list-group',
			'container_id'    => '',
			'theme_location'  => 'right',
			'menu_class'      => 'list-group-item',
			'menu_id'         => '',
			'echo'            => false,
			'fallback_cb'     => 'wp_page_menu',
			'items_wrap'      => '%3$s',
			'depth'           => 0,
			'walker'          => ''
		));
		echo times_square_sidebar_menu($menu, $name);
	}
?><!--/.nav-collapse -->
<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php if(!dynamic_sidebar( 'sidebar-right' )){  ?>
	<?php  the_widget('WP_Widget_Categories'); ?> 
    <?php } ?>
</div><!-- #content-sidebar -->