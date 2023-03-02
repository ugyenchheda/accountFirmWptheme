<?php
/**
 * Times Square
 *
 */
if ( ! function_exists( 'times_square_paging_nav' ) ) :
function times_square_paging_nav() {
	global $wp_query, $wp_rewrite;

	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'times-square' ),
		'next_text' => __( 'Next &rarr;', 'times-square' ),
	) );

	if ( $links ) :

	?>

<button type="button" class="btn btn-lg btn-default">Default</button>


	<nav class="navigation paging-navigation" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'times_square_post_nav' ) ) :

function times_square_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'times-square' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'times-square' ) );
			else :
				previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', 'times-square' ) );
				next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', 'times-square' ) );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'times_square_posted_on' ) ) :

function times_square_posted_on() {
	printf('<span class="entry-date btn btn-xs btn-default"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> ',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
#	printf('<span class="comments-link btn btn-xs btn-default">'.get_the_category_list( _x( ', ', '', 'times-square' ) ).'</span> ');
	printf('<span class="byline btn btn-xs btn-default"><span class="author vcard"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span></span> ',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;

function times_square_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'times_square_category_count' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'times_square_category_count', $all_the_cool_cats );
	}

	if ( 1 !== (int) $all_the_cool_cats ) {
		return true;
	} else {
		return false;
	}
}

function times_square_category_transient_flusher() {
	delete_transient( 'times_square_category_count' );
}
add_action( 'edit_category', 'times_square_category_transient_flusher' );
add_action( 'save_post',     'times_square_category_transient_flusher' );

function times_square_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'featurette-image img-responsive' );
		} else {
			the_post_thumbnail();
		}
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'featurette-image img-responsive' );
		} else {
			the_post_thumbnail();
		}
	?>
	</a>

	<?php endif;
}

?>