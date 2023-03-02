<?php
/**
 * Times Square
 *
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

header('X-Robots-Tag: noindex');
header('Link: <'.get_home_url().'>; rel="canonical" ');

get_header();

?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'times-square' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php _e( 'Nothing found!', 'times-square' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php

get_footer();

?>