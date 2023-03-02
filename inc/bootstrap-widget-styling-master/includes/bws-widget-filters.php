<?php
/*
=== Bootstrap Widget Styling ===
Contributors: ryankienstra
Donate link: http://jdrf.org/get-involved/ways-to-donate/
Tags: Bootstrap, widgets, mobile, responsive, default widgets
Requires at least: 3.9
Tested up to: 4.1
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Maybe filter 'Categories' , 'Pages' , and 'Archives' widgets
add_action( 'init' , 'bws_widget_filters' ) ;
function bws_widget_filters() { 
  bws_maybe_add_filters_of_types( array( 'categories' , 'pages' , 'archives' ) ) ;
}

function bws_maybe_add_filters_of_types( $types ) {
  foreach( $types as $type ) {
    bws_add_filter_if_options_allow( $type ) ;
  }
}

function bws_add_filter_if_options_allow( $type ) {
  if ( bws_do_options_allow_adding_filter_for_widget_type( $type ) ) {
    bws_add_filter_for_widget_type( $type ) ;
  }
}

function bws_do_options_allow_adding_filter_for_widget_type( $type_of_widget ) {
  $options = get_option( 'bws_plugin_options' ) ;
  $widget_key = 'disable_' . $type_of_widget . '_widget' ; 
  if ( ( isset( $options[ $widget_key ] ) ) && ( '1' === $options[ $widget_key ] ) ) {
    return false ; 
  }
  return true ;
}

function bws_add_filter_for_widget_type( $type ) {
  if ( 'archives' === $type ) {
    add_filter( 'get_archives_link' , array( 'BWS_Archives' , 'filter' ) ) ;
    add_filter( 'dynamic_sidebar_params' , 'bws_add_closing_div_to_archives_widget' ) ;
  }
  else {
    add_filter( 'wp_list_' . $type , array( 'BWS_' . $type , 'filter' ) ) ; 
  }
}

function bws_add_closing_div_to_archives_widget( $params ) {
  if ( isset( $params[ 0 ][ 'widget_name' ] ) && 'Archives' == $params[ 0 ][ 'widget_name' ] ) {
    $params[ 0 ][ 'after_widget' ] = '</div>' . $params[ 0 ][ 'after_widget' ] ; 
  }
  return $params ; 
} 

// Filter search form widget
add_action( 'init' , 'bws_add_search_form_filter_if_option_allows' ) ; 
function bws_add_search_form_filter_if_option_allows() {
  $options = get_option( 'bws_plugin_options' ) ;
  if ( ( isset( $options[ 'disable_search_widget' ] ) ) && ( '1' === $options[ 'disable_search_widget' ] ) ) {
    return ;
  } else {
    add_filter( 'get_search_form' , array( 'BWS_Search_Widget' , 'filter' ) , '1' ) ;
  }
}


// Filter tag cloud widget
add_filter( 'wp_tag_cloud' , 'bwp_filter_tag_cloud' ) ; 
function bwp_filter_tag_cloud( $markup ) {
  $regex = '/(<a[^>]+?>)([^<]+?)(<\/a>)/' ;
  $replace_with = "$1<span class='label label-default'>$2</span>$3" ;		# label-primary
  $markup = preg_replace( $regex , $replace_with , $markup ) ; 
  return $markup ;
}

// Filter menu widget
add_filter( 'widget_display_callback' , 'bws_search_for_menu_widget' , 4 , 10 ) ; 
function bws_search_for_menu_widget( $instance , $widget , $args ) {
  if ( ( isset( $widget->widget_options[ 'classname' ] ) ) && ( 'widget_nav_menu' == $widget->widget_options[ 'classname' ] ) ) {
    add_filter( 'wp_nav_menu_items' , 'bws_filter_widget_menu' , 2 , 10 ) ;
  }
  return $instance ;  
}

function bws_filter_widget_menu( $menu_markup , $args ) {
  if ( ( ! isset( $args->fallback_cb ) ) || ( "" == $args->fallback_cb ) ) {
    $menu_markup = BWS_Menu::filter( $menu_markup ) ;  
  }
  return $menu_markup ; 
}

?>