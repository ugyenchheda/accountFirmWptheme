<?php
/**
 * Times Square
 *
 */

if ( ! is_active_sidebar( 'sidebar-content-home' ) ) {
	return;
}
?>
<div class="row" role="complementary">
	<?php dynamic_sidebar( 'sidebar-content-home' ); ?>
</div><!-- #content-sidebar -->