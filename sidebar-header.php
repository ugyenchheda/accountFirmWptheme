<?php
/**
 * Times Square
 *
 */

if ( ! is_active_sidebar( 'sidebar-header' ) ) {
	return;
}
?>
<div class="row" role="complementary">
	<?php dynamic_sidebar( 'sidebar-header' ); ?>
</div><!-- #content-sidebar -->