<?php
/**
 * Single post content
 *
 * @package Bexley
 */

	$image = '';

	if ( get_theme_mod( 'bexley_display_image', true ) ) {
		$image = get_the_post_thumbnail( get_the_ID(), 'bexley-content' );
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	if ( $image ) {
?>
	<div class="showcase-image">
		<?php echo $image; ?>
	</div>
<?php
	}
?>
	<section class="post-entry">
<?php
	get_template_part( 'inc/postmetadata' );

	the_title( '<h1 class="posttitle">', '</h1>' );

	the_content();

	wp_link_pages(
		array(
			'before' => '<div class="archive-pagination">' . __( 'Pages: ', 'bexley' ),
			'after'  => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		)
	);

	// Display categories.
?>
		<p class="tax-categories taxonomy"><?php
		esc_html_e( 'Categories: ', 'bexley' );
		the_category( ', ' );
?>
		</p>
<?php
		// Display tags (if there are any.
		if ( get_the_tags() ) {
			the_tags( '<p class="tax-tags taxonomy">' . __( 'Tagged as: ', 'bexley' ), _x( ', ', 'Tag list seperator', 'bexley' ), '</p>' );
		}
?>
	</section>

	<nav class="postnav">
		<div class="prev">
			<?php previous_post_link( '%link', __( '&lsaquo;', 'bexley' ) ); ?>
		</div>
		<div class="next">
			<?php next_post_link( '%link', __( '&rsaquo;', 'bexley' ) ); ?>
		</div>
	</nav>
</article>
