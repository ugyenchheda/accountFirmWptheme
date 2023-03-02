<?php
/**
 * Times Square
 *
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header();

if(isset($times_square_settings['default-layout'])) {
	if($times_square_settings['default-layout'] == 'full-width') {
		get_template_part( 'template-fullwidth', 'none' );
	} else if($times_square_settings['default-layout'] == 'sidebar-left') {
		get_template_part( 'template-sidebar-left', 'none' );
	} else if($times_square_settings['default-layout'] == 'sidebar-both') {
		get_template_part( 'template-sidebar-sides', 'none' );
	} else {
		get_template_part( 'template-sidebar-right', 'none' );
	}
} else {
	get_template_part( 'template-sidebar-right', 'none' );
}

get_footer();

?>