<?php
/**
 * Times Square
 *
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
?>
<?php
	if(isset($settings['menu-siderbar-left-status'])) {
		$name = 'left';
		$menu = wp_nav_menu( array(
			'menu'            => $name,
			'container'       => 'div',
			'container_class' => 'list-group',
			'container_id'    => '',
			'theme_location'  => 'left',
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
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</div><!-- #content-sidebar -->
