<?php
/**
 * Page content
 *
 * @package Bexley
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="post-entry">
<?php
	the_title( '<h1 class="title">', '</h1>' );

	the_content();

	wp_link_pages(
		array(
			'before' => '<div class="archive-pagination">' . esc_html__( 'Pages: ', 'bexley' ),
			'after'  => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		)
	);
?>
	</section>
</article>
