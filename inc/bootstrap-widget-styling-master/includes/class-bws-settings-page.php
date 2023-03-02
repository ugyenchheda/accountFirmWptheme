<?php
/*
Class Name: Bootstrap Widget Styling
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
class BWS_Settings_Page {

  private static $instance ; 
  private $widgets_to_add_to_settings_page ;


  private function  __construct( $widgets ) {
    $this->widgets_to_add_to_settings_page = $widgets ; 

  }
  
  public static function init( $widgets ) {
    self::$instance = new self( $widgets ) ;
  }
  
  public static function validate_options( $input ) {
    $validated = array() ;
    foreach( self::$instance->widgets_to_add_to_settings_page as $widget_name ) {
      $widget_key = 'disable_' . $widget_name .'_widget' ;
      $disable_setting = isset( $input[ $widget_key ] ) ? $input[ $widget_key ] : '0' ; 
      if ( self::$instance->is_one_or_zero( $disable_setting ) ) {
	$validated[ $widget_key ] = $disable_setting ;
      }
    }    
    return $validated ;
  }

  function is_one_or_zero( $value ) {
    return ( '1' == $value ) || ( '0' == $value ) ;
  }

  public static function plugin_section_text() {
    ?>
      <h3>
        <?php _e( 'This plugin does not work well when the top navbar has a "Categories" or "Pages" widget.' , 'times-square' ) ; ?>
      </h3>
      <h3>
	<em>
	  <?php _e( 'Disable' , 'times-square' ) ; ?>
	</em>
	<?php _e( 'plugin for: ' , 'times-square' ) ; ?>
      </h3>
    <?php
  }

}  /* end class BWS_Settings_Page */

?>