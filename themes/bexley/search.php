<?php
/**
 * Search results template
 *
 * @package Bexley
 */

	get_header();
?>
	<h1 class="title">
		<?php printf( __( 'Search results for &#8216;<em>%s</em>&#8217;', 'bexley' ), get_search_query() ); ?>
	</h1>
<?php
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			get_template_part( 'content' );
		}

	} else {
		get_template_part( 'content-empty' );
	}

	the_posts_pagination(
		array(
			'mid_size' => 3,
			'next_text' => esc_html__( 'Older &rsaquo;', 'bexley' ),
			'prev_text' => esc_html__( '&lsaquo; Newer', 'bexley' ),
		)
	);

	get_footer();
