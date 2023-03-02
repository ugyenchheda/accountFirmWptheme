<?php
/*
 * Times Square
 *
*/

define('THEME_SETTINGS', 'times_square_theme_settings');

function times_square_settings_admin_init_action(){
	do_action('times_square_settings_init');
}
add_action('admin_init', 'times_square_settings_admin_init_action');

function times_square_settings_init( $theme_name = null ) {

	// set theme name
	if ( empty( $theme_name ) ) {
		$theme_name = basename( get_template_directory() );
	}

	// Register all the actions for the settings page
	add_action( 'admin_menu', 'times_square_settings_admin_menu' );
	add_action( 'admin_init', 'times_square_settings_admin_init', 8 );
	add_action( 'admin_enqueue_scripts', 'times_square_settings_enqueue_scripts' );
}
add_action('after_setup_theme', 'times_square_settings_init', 5);

// register all settings
function times_square_settings_admin_init() {
	register_setting( THEME_SETTINGS, THEME_SETTINGS );
}

// add settings
function times_square_settings_admin_menu() {
	$theme = wp_get_theme();
	$page = add_theme_page(
		sprintf(__( 'Theme Settings', 'times-square' ), $theme ),
		sprintf(__( 'Theme Settings', 'times-square' ), $theme ),
		'edit_theme_options',
		'theme_settings_page',
		'times_square_settings_render'
	);
}

// check version
function times_square_settings_render() {
	if( version_compare( get_bloginfo('version'), '3.4', '<' ) ) {
		?><div class="wrap"><div id="setting-error-settings_updated" class="updated settings-error"><p><strong><?php _e('Please update to the latest version of WordPress to use theme settings.', 'times-square') ?></strong></p></div></div><?php
		return;
	}
	locate_template( '/settings/page.php', true, false );
}

function times_square_settings_enqueue_scripts( $prefix ) {
	if ( $prefix != 'appearance_page_theme_settings_page' ) return;

	// colorpicker
	if( wp_script_is( 'wp-color-picker', 'registered' ) ){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}
	else{
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
	}

	// upload
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
	wp_enqueue_style('thickbox');

	// editor
	wp_enqueue_media();
	
	// media uploaded
	if ( function_exists( 'wp_enqueue_media' ) ) wp_enqueue_media();
}

function times_square_settings_add_slider_options($times_square_settings){
	// Add all Meta Sliders
	if( class_exists('MetaSliderPlugin') ){
		$sliders = get_posts(array(
			'post_type' => 'ml-slider',
			'numberposts' => 100,

		));

		foreach($sliders as $slider) {
			$times_square_settings['[metaslider id="'.$slider->ID.'"]'] = __('Meta Slider: ', 'times-square').$slider->post_title;
		}
	}

	// Add all the Revolution sliders
	if( function_exists('rev_slider_shortcode') ) {
		global $wpdb;
		$sliders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}revslider_sliders ORDER BY title");

		foreach($sliders as $slider) {
			$times_square_settings['[rev_slider '.$slider->alias.']'] = __('Revolution Slider: ', 'times-square').$slider->title;
		}
	}

	// Add any LayerSlider Sliders
	if( function_exists('layerslider') ) {
		global $wpdb;
		$sliders = $wpdb->get_results("SELECT id,name FROM {$wpdb->prefix}layerslider ORDER BY name");

		foreach($sliders as $slider) {
			$times_square_settings['[layerslider id="'.$slider->id.'"]'] = __('LayerSlider: ', 'times-square').$slider->name;
		}
	}

	return $times_square_settings;
}

?>