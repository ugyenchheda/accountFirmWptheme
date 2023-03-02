<?php
/**
 * Times Square
 *
 */

global $times_square_settings;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { function theme_slug_render_title() { ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php } add_action( 'wp_head', 'theme_slug_render_title' ); } ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <!-- top navbar -->
	<?php 
		if(isset($times_square_settings['menu-primary-status'])) {

			$navbar_class = '';
			if(!isset($times_square_settings['menu-primary-color'])) {
				$navbar_class .= ' navbar-inverse';	
			}else if($times_square_settings['menu-primary-color'] == 'default') {
				$navbar_class .= ' navbar-default';	
			} else {
				$navbar_class .= ' navbar-inverse';	
			}
			
			if(!isset($times_square_settings['menu-primary-position'])) {
				$navbar_class .= ' navbar-fixed-top'; 
			} else if($times_square_settings['menu-primary-position'] == 'default') { 
				$navbar_class .= ' navbar-default';
			} else if($times_square_settings['menu-primary-position'] == 'static') {
				$navbar_class .= ' navbar-static-top';
			} else { 
				$navbar_class .= ' navbar-fixed-top'; 
			} 
			$name = 'primary';
			$menu = wp_nav_menu( array(
				'menu'              => $name,
				'depth'             => 3,
				'container'         => 'div',
				'container_class'   => 'navbar-collapse collapse',
				'container_id'      => 'primary-navbar',
				'theme_location'	=> 'primary',
				'echo'				=> false,
				'menu_class'        => 'nav navbar-nav navbar-right',
				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				'walker'            => new wp_bootstrap_navwalker())
			);
	?>
<div class="navbar<?php echo $navbar_class; ?>" role="navigation">
<div class="tophead">
<div class="container">
<div class="col-md-4 col-md-pull-1 text-center">
<p class="topTxt"><i class="fa fa-phone" aria-hidden="true" style="padding-right: 7px;"></i>(xxx) xxx xxxx </p></div>
<div class="col-md-4 col-md-pull-3 text-center"><p class="topTxt"> <i class="fa fa-envelope" aria-hidden="true" style="padding-right: 7px;"></i>abcfirm@abc.com</p>
</div>
<div class="col-md-3 col-md-push-1 text-center">
<a href="#" class="appointMent"><i class="fa fa-pencil fa-lg" aria-hidden="true" style="padding-right: 17px;"></i>Get An Appointment</a>
</div>
</div>
</div>
      <div class="container">

        <div class="navbar-header">
		  <?php if($menu) { ?>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?php __('Toggle navigation', 'times-square'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php } ?>
        </div>
		<div class="col-md-2 logos">
<a class="navbar-brand logo text-center" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?> logo"></a>
<div style="clear: both; width: 100%; display: block;"></div>
</div>
		<div class="col-md-10">
<div class="col-md-1 col-md-push-1 hidden-sm hidden-xs"></div>
		<div class="col-md-4 col-md-push-1 hidden-sm hidden-xs">
<ul class="globe">
<li><i class="fa fa-globe iconsStyle"></i><h3>Improved Efficiency</h3>
<p>Efficient with money usage</p>
</li>
</ul>
</div>
		<div class="col-md-4 col-md-push-1 hidden-sm hidden-xs">
<ul class="certificate">
<li><i class="fa fa-certificate iconsStyle"></i><h3>Transparent finances</h3>
<p>Every transaction is crystal clear</p>
</li>
</ul>
</div>
		<div class="col-md-3 col-md-push-1 hidden-sm hidden-xs">
<ul class="award">
<li><i class="fa fa-trophy iconsStyle"></i><h3>Tax Center</h3>
<p>Get solutions</p>
</li>
</ul>
</div>
            <?php
				echo times_square_main_menu($menu, $name);
        ?><!--/.nav-collapse -->
		</div>
      </div>
    </div>
	<?php
		}
	?>
	<?php if(($times_square_settings['header-display'] == 'home-page' && is_front_page ()) || $times_square_settings['header-display'] == 'all-pages') { ?>
	<?php if($times_square_settings['header'] == 'image') { ?>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>" />
        </div>
	<?php } else if($times_square_settings['header'] == 'metaslider') { ?>
  	<?php echo do_shortcode("[metaslider id=".$times_square_settings['header-metaslider']."]"); ?>
	<?php } else if($times_square_settings['header'] == 'wysiwyg') { ?>
	<?php } else if($times_square_settings['header'] == 'video') { ?>
    <div class="video carousel slide carousel slide">
        <?php echo ent2ncr($times_square_settings['header-video']); ?>
	</div>
	<?php } else { ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php echo get_template_directory_uri(); ?>/images/slider1.jpg" alt="<?php bloginfo( 'name' ); ?> Slider">
        </div>
        <div class="item">
          <img src="<?php echo get_template_directory_uri(); ?>/images/slider2.jpg" alt="<?php bloginfo( 'name' ); ?> Slider 2">
        </div>
        <div class="item">
          <img src="<?php echo get_template_directory_uri(); ?>/images/slider3.jpg" alt="<?php bloginfo( 'name' ); ?> Slider 3">
        </div>
      </div>
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="background: rgba(58, 82, 106, 0); color: #18ba60;"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only"><?php echo __('Previous', 'times-square'); ?></span></a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="background: rgba(58, 82, 106, 0); color: #18ba60;"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only"><?php echo __('Next', 'times-square'); ?></span></a>
    </div><!-- /.carousel -->
	<?php } ?>
    <?php } ?>
	