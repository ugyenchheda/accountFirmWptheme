<?php
/**
 * Template Name: Sidebar Left
 *
 * Times Square
 *
 */

?>
<?php

get_header();

?>
<div class="row row-offcanvas row-offcanvas-right">

    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
        <?php get_sidebar( 'left' ); ?>
    </div><!--/span-->

    <div class="col-xs-12 col-sm-9">
        <?php
			// feature content
			if ( is_front_page() && times_square_has_featured_posts() ) {
				get_template_part( 'featured-content' );
			}
        ?>
        
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content', get_post_format() );
                        endwhile;
                        echo '<div class="navigation">';
                        posts_nav_link( ' ', '<button type="button" class="btn btn-default"><< '.__( 'Previous', 'times-square' ).'.</button>', '<button type="button" class="btn btn-default">'.__( 'Next', 'times-square' ).' >></button>' );
                        echo '</div>';
                        
                    else :
                        get_template_part( 'content', 'none' );
                endif;
            ?>
            </div><!-- #content -->
        </div><!-- #primary -->
        
    </div><!--/span-->
        
</div><!--/row-->
<?php

get_footer();

?>