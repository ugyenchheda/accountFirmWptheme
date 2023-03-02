<?php
/**
 * Times Square
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}
 
if ( ! function_exists( 'times_square_setup' ) ) :


$theme = wp_get_theme();

define('TIMES_SQUARE_THEME_VERSION', $theme->version);

function times_square_setup() {

	load_theme_textdomain( 'times-square', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'times-square-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'times-square' ),
		'secondary' => __( 'Secondary menu below the header', 'times-square' ),
		'left'   => __( 'Left Sidebar menu', 'times-square' ),
		'right'   => __( 'Right Sidebar menu', 'times-square' ),
	) );

	// html5 markup
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// custom backgroudn
	add_theme_support( 'custom-background', apply_filters( 'times_square_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// featured content support 
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'times_square_get_featured_posts',
		'max_posts' => 6,
	) );

}
endif; // times_square_setup
add_action( 'after_setup_theme', 'times_square_setup' );

// features post
function times_square_get_featured_posts() {
	return apply_filters( 'times_square_get_featured_posts', array() );
}

// return boolean value for feature post
function times_square_has_featured_posts() {
	return ! is_paged() && (bool) times_square_get_featured_posts();
}

// widgets
function times_square_widgets_init() {
	global $times_square_settings;
	register_sidebar( array(
		'name'          => __( 'Footer 1 column', 'times-square' ),
		'id'            => 'sidebar-left',
		'description'   => __( 'Appears in the footer section of the left.', 'times-square' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2 column', 'times-square' ),
		'id'            => 'sidebar-right',
		'description'   => __( 'Appears in the footer section of the right.', 'times-square' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="panel panel-'.esc_html($times_square_settings['theme-widget-header-bg']).' panel-heading"><h1 class="panel-title">',		# panel-primary
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3 column', 'times-square' ),
		'id'            => 'sidebar-header',
		'description'   => __( 'Main sidebar that appears on the top.', 'times-square' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Footer', 'times-square' ),
		'id'            => 'sidebar-footer',
		'description'   => __( 'Appears in the footer section of the left.', 'times-square' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4 column', 'times-square' ),
		'id'            => 'sidebar-content',
		'description'   => __( 'Additional sidebar that appears on the content.', 'times-square' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'times_square_widgets_init' );

// custom style and font for site
function times_square_scripts() {

	global $times_square_settings;
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap/dist/css/bootstrap.min.css', array(), TIMES_SQUARE_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css', array(), TIMES_SQUARE_THEME_VERSION );
	wp_enqueue_style( 'times-square-customize', get_template_directory_uri() . '/style.min.css', array(), TIMES_SQUARE_THEME_VERSION );

	if(isset($times_square_settings['no-responsive'])) {
		wp_enqueue_style( 'non-responsive', get_template_directory_uri() . '/inc/bootstrap/docs/examples/non-responsive/non-responsive.css', array(), TIMES_SQUARE_THEME_VERSION );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	# slider
	wp_enqueue_style( 'carousel', get_template_directory_uri() . '/css/carousel.css', array(), '1.0' );

	// header
#	wp_enqueue_script( 'jquery.min', get_template_directory_uri().'/js/jquery.min.js', '1', TIMES_SQUARE_THEME_VERSION);

	// footer
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/inc/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), '1', TIMES_SQUARE_THEME_VERSION, '1');
	wp_enqueue_script( 'jquery.blueimp-gallery', get_template_directory_uri().'/inc/gallery/js/jquery.blueimp-gallery.min.js', '1', TIMES_SQUARE_THEME_VERSION, '1');
	wp_enqueue_script( 'jquery.rwdImageMaps', get_template_directory_uri().'/inc/jquery-rwdimagemaps-master/jquery.rwdImageMaps.min.js', '1', TIMES_SQUARE_THEME_VERSION, '1');
	
}
add_action( 'wp_enqueue_scripts', 'times_square_scripts' );

function times_square_header_scripts () {
	echo '<!--[if lt IE 9]>'.chr(13).chr(10);
	echo '<script src="'.get_template_directory_uri().'/inc/html5/html5shiv.min.js"></script>'.chr(13).chr(10);
	echo '<script src="'.get_template_directory_uri().'/inc/respond/respond.min.js"></script>'.chr(13).chr(10);
	echo '<![endif]-->'.chr(13).chr(10);
}
add_action('wp_head', 'times_square_header_scripts'); 

function times_square_footer_scripts () {
	global $times_square_settings;
	if ( is_user_logged_in() ) { 
		if(isset($times_square_settings['menu-primary-position'])) {
			if($times_square_settings['menu-primary-position'] == 'fixed' || !isset($times_square_settings['menu-primary-position'])) { 
				echo "<style type=\"text/css\">.navbar-fixed-top { top: 20px; } @media screen and (min-width: 0px) { .navbar-fixed-top {top: 0px; border-top: 1px solid #555;} } @media screen and (min-width: 600px) { .navbar-fixed-top {top: 32px; border-top: 1px solid #555;} }</style>"; 
			} 
		}
	}
	
	
	if(isset($times_square_settings['slider-content'])) { 
		echo "<style type=\"text/css\">body{overflow-x: hidden;}.metaslider .flexslider {margin: 0px;}.flexslider {margin: 0px;}</style>"; 
	}
	echo "<script>jQuery(document).ready(function($) { $('img[usemap]').rwdImageMaps();} );</script>";
	if(isset($times_square_settings['remove-credits'])) {
		if($times_square_settings['remove-credits'] == '1') {
			echo '<div class="theme"><a href="http://www.studiofaca.com/#theme">Times Square</a></div>';
		}
	}

}
add_action('wp_footer', 'times_square_footer_scripts'); 


function times_square_admin_fonts() {
	wp_enqueue_style( 'times_square-lato', times_square_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'times_square_admin_fonts' );

// customer title
function times_square_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'times-square' ), max( $paged, $page ) );
	}

	return $title;

}
add_filter( 'wp_title', 'times_square_wp_title', 10, 2 );



if ( ! function_exists( 'times_square_the_attached_image' ) ) :
function times_square_the_attached_image() {
	$post                = get_post();

	$attachment_size     = apply_filters( 'times_square_attachment_size', array( 800, 800 ) );
	$next_attachment_url = wp_get_attachment_url();

	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

// custome read more except
function times_square_new_excerpt_more($more) {
	 global $post;
	 return '<div class="read_more"><a href="'. get_permalink($post->ID) . '">'.__( '<span class="btn btn-xl btn-primary">Read more &rarr;</span>', 'times-square' ).'</a></div>';
}
add_filter('excerpt_more', 'times_square_new_excerpt_more');
  
// custome read more content
function times_square_modify_read_more_link() {
	if(isset($post)) {
		return '<div class="read_more"><a href="'. get_permalink($post->ID) . '">'.__( '<span class="btn btn-sm btn-primary">Read more &rarr;</span>', 'times-square' ).'</a></div>';
	}
}
add_filter( 'the_content_more_link', 'times_square_modify_read_more_link' );

$times_square_copyright = 'http://www.studiofaca.si/';

function times_square_bootstrap3_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5 = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
	$fields = array(
		'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'times-square' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email' => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'times-square' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		'<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
		'url' => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'times-square' ) . '</label> ' .
		'<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
	);
	return $fields;
}
add_filter( 'comment_form_default_fields', 'times_square_bootstrap3_comment_form_fields' );

function times_square_bootstrap3_comment_form( $args ) {
	$args['comment_field'] = '<div class="form-group comment-form-comment">
	<label for="comment">' . __( 'Comment', 'times-square' ) . '</label>
	<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	</div>';
	return $args;
}
add_filter( 'comment_form_defaults', 'times_square_bootstrap3_comment_form' );

function times_square_bootstrap3_comment_button() {
	echo '<button class="btn btn-primary" type="submit">' . __( 'Submit', 'times-square' ) . '</button>';
}
add_action('comment_form', 'times_square_bootstrap3_comment_button' );


function times_square_main_menu($menu, $name) {
	return $menu;	
}
function times_square_sidebar_menu($menu, $name) {
	$menu_location = get_nav_menu_locations();
	$menu_name = '';
	if(isset($menu_location)) {
		$id = @$menu_location[$name];
		$nav_menu = wp_get_nav_menu_object($id);
		$menu_name = @$nav_menu->name;
	}
	return '<div class="list-group"><div class="list-group-item active">'.$menu_name.'</div>'.str_replace('<a ', '<a class="list-group-item" ', strip_tags($menu, '<a>' )).'</div>';
}

// register custom nav walker
require_once(get_template_directory().'/inc/wp-bootstrap-navwalker-master/wp_bootstrap_navwalker.php');

// custom tags
require get_template_directory() . '/inc/template-tags.php';

// widget
require get_template_directory() . '/inc/bootstrap-widget-styling-master/includes/bws-widget-filters.php';
require get_template_directory() . '/inc/bootstrap-widget-styling-master/includes/class-bws-filter.php';
require get_template_directory() . '/inc/bootstrap-widget-styling-master/includes/class-bws-search-widget.php';
require get_template_directory() . '/inc/bootstrap-widget-styling-master/includes/class-bws-settings-fields.php';
require get_template_directory() . '/inc/bootstrap-widget-styling-master/includes/class-bws-settings-page.php';

// theme settigns
include get_template_directory() . '/settings/settings.php';

$times_square_settings = get_option(THEME_SETTINGS);

function times_square_domain($url) {
	$domain = str_replace('https://', '', $url);
	$domain = str_replace('http://', '', $url);
	$x = stripos($domain, '/');
	if($x > 0) {
		$domain = substr($domain, 0, $x);	
	}
	return $domain;
}

if(!isset($times_square_settings['submit'])) {
	$times_square_settings = array('menu-primary-position' => 'fixed',
									'menu-primary-color' => 'inverse',
									'menu-primary-status' => '1',
									'menu-secondary-color' => 'inverse',
									'menu-secondary-status' => '1',
									'default-layout' => 'sidebar-right',
									'header' => '0',
									'header-display' => 'all-pages',
									'header-video' => '',
									'header-wysiwyg' => '0',
									'theme-widget-header-bg' => 'default'
									);
}

add_theme_support( 'title-tag' );

function times_square_add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/css/custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'times_square_add_editor_styles' ); 

$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/slider.jpg',
	'width'                  => 1664,
	'height'                 => 400,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
?>