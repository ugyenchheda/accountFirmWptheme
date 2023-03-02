<?php
/**
 * Times Square
 *
 */

if ( ! is_active_sidebar( 'sidebar-header-home' ) ) {
	return;
}
?>
<div class="row" role="complementary">
	<?php dynamic_sidebar( 'sidebar-header-home' ); ?>
</div><!-- #content-sidebar -->