<?php
/**
 * Times Square
 *
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header();

?>
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'times-square' ), get_search_query() ); ?></h1>
				<?php get_search_form(); ?>
			</header><!-- .page-header -->
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				echo '<div class="navigation">';
				posts_nav_link( ' ', '<button type="button" class="btn btn-default"><< '.__( 'Previous', 'times-square' ).'.</button>', '<button type="button" class="btn btn-default">'.__( 'Next', 'times-square' ).' >></button>' );
				echo '</div>';

			else :
			?>
 			<h2><?php _e( 'Not Found', 'times-square' ); ?></h2>
            <?php
			endif;
		?>
		</div><!-- #content -->
	</section><!-- #primary -->
<?php

get_footer();

?>