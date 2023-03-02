<?php

add_action( 'admin_menu' , 'bws_plugin_page' ) ;
function bws_plugin_page() {
  add_theme_page(
    __( 'Bootstrap Widget Styling Settings' , 'times-square' ) ,
    __( 'Widget Styling' , 'times-square' ) ,	      
    'manage_options' ,
    'bws_options_page' ,
    'bws_plugin_options_page' ) ;
}

function bws_plugin_options_page() {
  ?>
  <div class="wrap">
    <h2><?php _e( 'Bootstrap Widget Styling' , 'times-square' ) ; ?></h2>
    <form action="options.php" method="post">
      <?php settings_fields( 'bws_plugin_options' ) ; ?>
      <?php do_settings_sections( 'bws_options_page' ) ; ?>
      <input name="Submit" type="submit" value="Save Changes" class="button-primary" />
    </form>
  </div>
  <?php
}

add_action( 'admin_init' , 'bws_settings_setup' ) ;
function bws_settings_setup() {
  $widgets_to_add_to_settings_page = array( 'categories' , 'pages' , 'search' ,  'archives' ) ;
  
  BWS_Settings_Page::init( $widgets_to_add_to_settings_page ) ;
  register_setting( 'bws_plugin_options' , 'bws_plugin_options' , array( 'BWS_Settings_Page' , 'validate_options' ) ) ;
  add_settings_section( 'bws_plugin_primary' , __( 'Settings' , 'times-square' ) ,
			  array( 'BWS_Settings_Page' , 'plugin_section_text' ), 'bws_options_page' ) ;   
  BWS_Settings_Fields::add_fields_for_widget_types( $widgets_to_add_to_settings_page ) ;
}

// Add settings link on the main plugin page
add_filter( 'plugin_action_links' , 'bws_add_settings_link' , 2 , 2 ) ;
function bws_add_settings_link( $actions, $file ) {
  if ( false !== strpos( $file, BWS_PLUGIN_SLUG ) ) {
      $options_url = admin_url( 'options-general.php?page=bws_options_page' )  ;
      $actions[ 'settings' ] = "<a href='{$options_url}'>Settings</a>" ;
  }
  return $actions ;
}