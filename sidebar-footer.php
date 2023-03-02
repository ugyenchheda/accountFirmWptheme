<?php
/**
 * Times Square
 *
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>
<div class="row" role="complementary">
	<?php $name = 'sidebar-footer'; if ( is_active_sidebar( $name ) ) : dynamic_sidebar( $name ); endif; ?>
</div><!-- #content-sidebar -->

