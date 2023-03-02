<?php
/*
Class Name: Bootstrap Widget Styling
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
class BWS_Search_Widget {

  private static $instance ;
  private $markup ;

  private function __construct( $markup ) {
    $this->markup = $markup ;
  }
  
  public static function filter( $markup ) {
    self::$instance = new self( $markup ) ;
    return self::$instance->maybe_filter_markup() ;
  }

  private function maybe_filter_markup() {
    if ( ! $this->theme_has_a_search_template() ) {
      $this->filter_search_markup() ;
    }
    return $this->markup ; 
  }

  function theme_has_a_search_template() {  
    $template = locate_template( 'searchform.php' ) ;
    return ( '' != $template ) ; 
  }

  function filter_search_markup() {
    $this->add_input_group_class_to_opening_div() ;
    $this->remove_label() ;
    $this->add_form_control_class_to_text_input() ; 
    $this->add_class_to_submit_button() ; 
    $this->wrap_submit_button_in_div() ; 
  }

  function add_input_group_class_to_opening_div() {
    $this->markup = str_replace( '<div>' , '<div class="input-group">' , $this->markup ) ;
  }

  function remove_label() {
    $this->markup = preg_replace( '/<label.*?<\/label>/' , '' , $this->markup ) ;
  }

  function add_form_control_class_to_text_input() {
    $this->markup = str_replace( '<input type="text"' , '<input type="text" class="form-control"' , $this->markup ) ;
  }

  function add_class_to_submit_button() { 
    $this->markup = str_replace( '<input type="submit" class="search-submit"' , '<input type="submit" class="btn btn-default btn-med"' , $this->markup ) ;	# btn-primary
  }

  function wrap_submit_button_in_div() { 
/*    $this->markup = preg_replace( '/(<input type="submit".*?>)/' , '<div class="input-group-btn">$1</div>' , $this->markup ) ;*/
  }

}  /* End BWS_Search_Widget */

?>