<?php
/**
 * Times Square
 *
 */

if ( ! is_active_sidebar( 'sidebar-content' ) ) {
	return;
}
?>
<div class="row" role="complementary">
	<?php dynamic_sidebar( 'sidebar-content' ); ?>
</div><!-- #content-sidebar -->