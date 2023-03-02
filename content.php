<?php
/**
 * Times Square
 *
 */
?>
<?php $sticky = ''; if(is_sticky()) { $sticky = 'well'; } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($sticky); ?>>
	<?php times_square_post_thumbnail(); ?>

	<header class="entry-header">
		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					times_square_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link btn btn-xs btn-default"><?php comments_popup_link( __( 'Leave a comment', 'times-square' ), __( 'Comment <span class="badge">1</span>', 'times-square' ), __( 'Comments %', 'times-square' ) ); ?></span>
			<?php
				endif;
				edit_post_link( __( 'Edit', 'times-square' ), ' <span class="edit-link btn btn-xs btn-default">', '</span>' );
			?>
		</div>
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>
	</header>

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php else : ?>
	<?php
		if ( 'attachment' == get_post_type() ) :
			echo '<div class="attachment">';
			times_square_the_attached_image();
			echo '</div>';

			echo '<div class="navigation">';
			previous_image_link( ' ', '<button type="button" class="btn btn-default"><< '.__( 'Previous', 'times-square' ).'.</button> ' );
			next_image_link( ' ', '<button type="button" class="btn btn-default">'.__( 'Next', 'times-square' ).' >></button>' );
			echo '</div>';

		else :
	?>
	<div class="entry-content">
	<?php
		the_content( __( '<span class="meta-nav btn btn-sm btn-primary">Read more &rarr;</span>', 'times-square' ) );
		wp_link_pages( array(
			'before'      => '<div class="navigation"><div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'times-square' ) . '</span>',
			'after'       => '</div></div>',
			'link_before' => '<button type="button" class="btn btn-default">',
			'link_after'  => '</button>',
		) );
	?>
	</div>
	<?php endif; ?>
	<?php endif; ?>
	<?php 
		$posttags = get_the_tags();
		if ($posttags) {
			echo '<footer class="entry-tags">';
			the_tags ('', ' ', '');
			echo '</footer>';
		}
	?>	
</article>
<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
?>