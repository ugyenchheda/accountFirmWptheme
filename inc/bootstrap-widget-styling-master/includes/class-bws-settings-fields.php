<?php
/*
Class Name: Bootstrap Widget Styling
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
class BWS_Settings_Fields {
  private static $instance ; 
  static $input_type = 'checkbox' ;
  private $type ;

  private function __construct( $type ) {
    $this->type = $type ;
  }

  static function add_fields_for_widget_types( $types ) {
    foreach ( $types as $type ) {
      self::instantiate_and_add_setting( $type ) ;
    }
  }
  
  static function instantiate_and_add_setting( $type ) {
    self::$instance = new self( $type ) ;
    self::$instance->bws_add_settings_field() ;
  }

  function bws_add_settings_field() {
    $type = ucfirst( $this->type ) ;
    add_settings_field( "bws_plugin_disable_{$type}_widget" , _( '"' . $type . '" widget' ) , array( $this , 'output_callback_for_setting' ) , 'bws_options_page' , 'bws_plugin_primary' ) ;
  }

  function output_callback_for_setting() {
    $disable_widget_setting =  $this->is_filter_disabled_for_this_widget() ;
    $name = 'bws_plugin_options[disable_' . $this->type . '_widget]' ; 
    ?>
      <input type="<?php echo esc_attr(self::$input_type); ?>" name="<?php echo esc_attr($name); ?>" <?php esc_attr(checked( $disable_widget_setting , '1' , true )) ; ?> value="1"/>
    <?php
  }

  function is_filter_disabled_for_this_widget() {
    $options = get_option( 'bws_plugin_options' ) ; 
    $key = 'disable_' . $this->type . '_widget' ;
    $is_disabled = isset( $options[ $key ] ) ? $options[ $key ] : 0 ;
    return $is_disabled ; 
  }
}

?>