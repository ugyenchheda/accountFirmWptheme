<?php
/*
 * Times Square
 *
*/

	$GET = $_GET;
	$POST = $_POST;
	$SERVER = $_SERVER;
	$COOKIE = $_COOKIE;
		
	$theme = wp_get_theme();
	
	$menu = array('' => 'General',
				  'layout' => 'Layout',
				  'header' => 'Header',
				  'navigation' => 'Navigation',
				  'theme' => 'Theme'
				  );

	global $premium;
	
	$action = '';
	if(isset($GET['action'])) {
		$action = $GET['action'];	
	}

	function field($name, $type = 'text', $value = '', $premium_check = 0, $default = '', $option = '') {
		global $premium;
		$name = THEME_SETTINGS."[".$name."]";
		if($value) {
			$value = str_replace('"', '\'', $value);	
		}
		
		$field = '';
		if($premium_check && !$premium) {
			return '<input type="button" name="" value="'.__( "Only available in Times Square Premium - Upgrade Now", "times-square" ).'" onClick="location.href=\'/wp-admin/themes.php?page=theme_settings_page&action=premium\';" class="button button-primary" />';	
		} else  if($type == 'text') {
			$field = '<input type="text" id="'.$name.'" name="'.$name.'" value="'.$value.'" class="reqular-text" />';
		} else if ($type == 'file') {
			$field = '';
			if($value != '') {
				$field .= '<img id="'.$name.'_img" src="'.$value.'" style="width: 100%; height: 100%;" /><br />';
			}
			$field .= '<input type="text" name="'.$name.'" value="'.$value.'" class="regular-text" />';
			$field .= '<input type="button" id="'.$name.'" value="'.__( "Select Media", "times-square" ).'" class="upload" />';
		} else if ($type == 'color') {
			$field = '<input type="text" id="'.$name.'" name="'.$name.'" value="'.__( "Select Media", "times-square" ).'" class="color" />';
		} else if ($type == 'textarea') {
			$field = '<textarea id="'.$name.'" name="'.$name.'" class="large-text" />'.$value.'</textarea>';
		} else if ($type == 'checkbox') {
			if($value) {
				$field = '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" checked="checked" class="reqular-text" />';
			} else {
				$field = '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" class="reqular-text" />';
			}
		} else if ($type == 'radio') { 
			$field = '<input type="radio" id="'.$name.'" name="'.$name.'" value="'.$value.'" class="reqular-text" />';
		} else if ($type == 'button') {
			$field = '<input type="button" id="'.$name.'" name="'.$name.'" value="'.$value.'" class="reqular-text" />';
		} else if ($type == 'select') {
			$options = explode('|', $option);
			$selected = '';
			if($value) {
				$default = $value;	
			}
			$field = '<select id="'.$name.'" name="'.$name.'">';
			foreach($options as $option) {
				list($key, $value) = explode(';', $option);
				if($key == $default) {
					$field .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
				} else {
					$field .= '<option value="'.$key.'">'.$value.'</option>';
				}
			}
			$field .= '</select>';
		} else if ($type == 'submit') {
			$field = '<input type="submit" id="'.$name.'" name="'.$name.'" value="'.$value.'" class="button button-primary" />';
		}
		return $field;
	}

	function row($title, $name, $type = 'text', $class = '', $value = '', $description = '', $premium = 0, $default = '', $option = '') {
		$row = '';
		$row .= '<tr class="'.$class.'">';
		$row .= '	<th scope="row"><label for="'.$name.'">'.$title.'</label></th>';
		$row .= '	<td>'.field($name, $type , $value, $premium, $default, $option).'<p class="description">'.$description.'</p></td>';
		$row .= '</tr>';
		return $row;
	}

	$metaslider_list = '';
	$metaslider_text = __( 'Select which slider do you like to display. You need to install free plugin <a rel="nofollow" href="https://wordpress.org/plugins/ml-slider/" target="_blank">Meta Slider</a>. Then you need to insert at least one slider and select it.', 'times-square' );
	if( class_exists('MetaSliderPlugin') ){
		$metasliders = get_posts(array(
			'post_type' => 'ml-slider',
			'numberposts' => -1,
		));
		foreach($metasliders as $metaslider) {
			$metaslider_list .= '|'.$metaslider->ID.';Meta Slider > '.$metaslider->post_title;
		}

		if($metaslider_list) {
			$metaslider_text = __( 'Select which slider do you like to display.', 'times-square' );
		} else {
			$metaslider_text = __( 'You need to insert at least one slider, Menu > Meta Slider.', 'times-square' );
		}
	} else {
		$metaslider_text = __( 'You need to install free plugin <a rel="nofollow" href="https://wordpress.org/plugins/ml-slider/" target="_blank">Meta Slider</a>.', 'times-square' );
	}

	$wysiwyg_list = '';
	$wysiwyg_text = __( 'Select which WYSIWYG Widget do you like to display. You need to install free plugin <a rel="nofollow" href="https://wordpress.org/plugins/wysiwyg-widgets/" target="_blank">WYSIWYG Widgets / Widget Blocks</a>. Then you need to insert at least one wysiwyg and select it.', 'times-square' );
	if( class_exists('WYSIWYG_Widgets_Admin') ){
		$wysiwygs = get_posts(array(
			'post_type' => 'wysiwyg-widget',
			'numberposts' => -1,
		));
		foreach($wysiwygs as $wysiwyg) {
			$wysiwyg_list .= '|'.$wysiwyg->ID.';WYSIWYG Widget > '.$wysiwyg->post_title;
		}

		if($wysiwyg_list) {
			$wysiwyg_text = __( 'Select which wysiwyg do you like to display.', 'times-square' );
		} else {
			$wysiwyg_text = __( 'You need to insert at least one wysiwyg, Menu > Meta wysiwyg.', 'times-square' );
		}
	} else {
		$wysiwyg_text = __( 'You need to install free plugin <a rel="nofollow" href="https://wordpress.org/plugins/wysiwyg-widgets/" target="_blank">WYSIWYG Widgets / Widget Blocks</a>.', 'times-square' );
	}

	$field_list = array(
					'logo' => array(
									'title' => __( 'Logo Image', 'times-square' ), 
									'type' => 'file', 
									'description' => __( 'Replace Site Text with Logo Image.', 'times-square' ), 
									'premium' => '0', 
									'tab' => ''
							),
					'site-information' => array(
									'title' => __( 'Site information', 'times-square' ), 
									'type' => 'text', 
									'description' => __( 'Text displayed on left side in footer.', 'times-square' ), 
									'premium' => '0', 
									'tab' => ''
							),
					'copyright-information' => array(
									'title' => __( 'CopyRight information', 'times-square' ), 
									'type' => 'text', 
									'description' => __( 'Text displayed on right side in footer.', 'times-square' ), 
									'premium' => '0', 
									'tab' => ''
							),
					'remove-credits' => array(
									'title' => __( 'Remove Credits', 'times-square' ), 
									'type' => 'checkbox', 
									'default' => '0',
									'option' => '',
									'description' => __( 'Remove Text Credits from footer.', 'times-square' ), 
									'premium' => '0', 
									'tab' => ''
							),
					'menu-primary-position' => array(
									'title' => __( 'Primary Menu Position', 'times-square' ), 
									'type' => 'select', 
									'option' => 'default;'.__( 'Default', 'times-square' ).'|fixed;'.__( 'Fixed', 'times-square' ).'|static;'.__( 'Static', 'times-square' ),
									'default' => 'fixed',
									'description' => __( 'Select position of navigation bar.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'menu-primary-color' => array(
									'title' => __( 'Primary Menu Color', 'times-square' ), 
									'type' => 'select', 
									'option' => 'default;Default|inverse;Inverse',
									'default' => 'inverse',
									'description' => __( 'Select color of navigation bar.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'menu-primary-status' => array(
									'title' => __( 'Primary Menu', 'times-square' ), 
									'type' => 'checkbox', 
									'default' => '1',
									'description' => __( 'Enable primary menu', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'menu-secondary-color' => array(
									'title' => __( 'Secondary Menu Color', 'times-square' ), 
									'type' => 'select', 
									'option' => 'default;Default|inverse;Inverse',
									'default' => 'inverse',
									'description' => __( 'Select color of navigation bar.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'menu-secondary-status' => array(
									'title' => __( 'Secondary Menu', 'times-square' ), 
									'type' => 'checkbox', 
									'default' => '1',
									'description' => __( 'Enable secondary menu', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'menu-sidebar-left-status' => array(
									'title' => __( 'Sidebar Left Menu', 'times-square' ), 
									'type' => 'checkbox', 
									'default' => '1',
									'description' => __( 'Enable sidebar left menu', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'menu-sidebar-right-status' => array(
									'title' => __( 'SidebarRight Menu', 'times-square' ), 
									'type' => 'checkbox', 
									'default' => '1',
									'description' => __( 'Enable sidebar right menu', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'navigation'
							),
					'no-responsive' => array(
									'title' => __( 'No Responsive Layout', 'times-square' ), 
									'type' => 'checkbox', 
									'default' => '1',
									'description' => __( 'Do not scale your layout for small screen devices.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'layout'
							),
					'default-layout' => array(
									'title' => __( 'Default Layout', 'times-square' ), 
									'type' => 'select', 
									'option' => 'full-width;'.__( 'Full width', 'times-square' ).'|sidebar-left;'.__( 'Left Sidebar', 'times-square' ).'|sidebar-right;'.__( 'Right Sidebar', 'times-square' ).'|sidebar-both;'.__( 'Sidebar on both side', 'times-square' ).'',
									'default' => 'sidebar-right',
									'description' => __( 'Select default layout for your site.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'layout'
							),
					'header' => array(
									'title' => __( 'Header Layout', 'times-square' ), 
									'type' => 'select', 
									'option' => '0;'.__( 'DEMO', 'times-square' ).'|image;'.__( 'Image', 'times-square' ).'|metaslider;'.__( 'Meta Slider', 'times-square' ).'|video;'.__( 'Video (Emblem iframe)', 'times-square' ).'|wysiwyg;'.__( '', 'times-square' ).'WYSIWYG (Text, Image, Video, Emblem...)',
									'default' => '0',
									'description' => __( 'Change which header area layout you are using.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'header'
							),
					'header-display' => array(
									'title' => __( 'Display Header', 'times-square' ), 
									'type' => 'select', 
									'option' => 'all-pages;'.__( 'All Pages', 'times-square' ).'|home-page;'.__( 'Only Home Page', 'times-square' ),
									'default' => 'all-pages',
									'description' => __( 'Select where do you like to display header.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'header'
							),
					'header-image' => array(
									'title' => __( 'Image', 'times-square' ), 
									'type' => 'info', 
									'description' => __( 'Select an image for header, Appearance > Header', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'header'
							),
					'header-metaslider' => array(
									'title' => __( 'Meta Slider', 'times-square' ), 
									'type' => 'select', 
									'option' => '0;'.__( '--- Please select ---', 'times-square' ).$metaslider_list.'',
									'default' => '0',
									'description' => $metaslider_text, 
									'premium' => '0', 
									'tab' => 'header'
							),
					'header-video' => array(
									'title' => __( 'Video', 'times-square' ), 
									'type' => 'textarea', 
									'default' => '',
									'description' => __( 'Copy/Paste emblem code as iframe.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'header'
							),
					'header-wysiwyg' => array(
									'title' => __( 'WYSIWYG Widget', 'times-square' ), 
									'type' => 'select', 
									'option' => '0;'.__( '--- Please select ---', 'times-square' ).$wysiwyg_list,
									'default' => '',
									'description' => $wysiwyg_text, 
									'premium' => '0', 
									'tab' => 'header'
							),
					'theme-widget-header-bg' => array(
									'title' => __( 'Widget Header BG Color', 'times-square' ), 
									'type' => 'select', 
									'option' => 'default;'. __( 'Silver', 'times-square' ).'|primary;'. __( 'Blue', 'times-square' ).'|success;'. __( 'Green', 'times-square' ).'|info;'. __( 'Light Blue', 'times-square' ).'|warning;'. __( 'Orange', 'times-square' ).'|danger;'. __( 'Red', 'times-square' ).'|none;'. __( 'None', 'times-square' ),
									'default' => 'default',
									'description' => __( 'Please select widget header background color.', 'times-square' ), 
									'premium' => '0', 
									'tab' => 'theme'
							),

					);

	if($premium) {
		unset($field_list['upgrade']);	
	}
?>
<script language="JavaScript">

// upload 
jQuery(document).ready(function() {
jQuery('.upload').click(function() {
formfield = jQuery(this).attr('id');
tb_show('', 'media-upload.php?type=image&TB_iframe=true');
return false;
});

window.send_to_editor = function(html) {
imgurl = jQuery('img',html).attr('src');
imgurl = imgurl.replace('http://<?php echo $SERVER['HTTP_HOST']; ?>', '');
jQuery('[name="'+formfield+'"]').val(imgurl);
jQuery('#'+formfield+'_img').attr('src', imgurl);
tb_remove();
}
});

// color picker
jQuery(document).ready(function($){
    $('.color').wpColorPicker();
});

</script>
<div class="wrap">
	<h2><?php echo $theme; ?><?php if($premium) { echo ' Premium'; } echo ' '.__( 'Theme Settings', 'times-square' ); ?></h2>
    <form method="post" action="options.php">
	<?php settings_fields( THEME_SETTINGS ); ?>
    <?php $times_square_settings = get_option( THEME_SETTINGS); ?>
	<?php do_settings_sections( THEME_SETTINGS ); ?>
	<h2 class="nav-tab-wrapper">
		<?php foreach($menu as $key => $value) { ?>
		<a href="themes.php?page=theme_settings_page&action=<?php echo $key; ?>" class="nav-tab<?php if($action == $key) { echo ' nav-tab-active'; } ?>"><?php echo $value; ?></a>
		<?php } ?>
    </h2>
    <table class="form-table">
        <?php 
            foreach($field_list as $key => $value) {
				$class = '';
				if($value['premium']) {
					continue;	
				}
                if($action <> $value['tab']) {
					$class = 'hidden';
                }
				$times_square_settings_value = '';
				if(isset($times_square_settings[$key])) {
					$times_square_settings_value = $times_square_settings[$key];
				}
				$default_value = '';
				if(isset($value['default'])) {
					$default_value = $value['default'];	
				}
				$option_value = '';
				if(isset($value['option'])) {
					$option_value = $value['option'];	
				}
				print_r(row(esc_attr($value['title']), $key, esc_attr($value['type']), $class, $times_square_settings_value, esc_attr($value['description']), esc_attr($value['premium']), $default_value, $option_value));
            }
        ?>
    </table>
	<p class="submit">
    	<?php print_r(field('submit', 'submit', 'Save Changes')); ?>
	</p>
	</form>
	<style>
		.hidden {
			display: none;	
		}
	</style>
</div>