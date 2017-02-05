<?php
/**
 * Archive Template
 *
 * @package Bexley
 */


	get_header();

	if ( have_posts() ) {
?>
	<div class="title-container">
<?php
		the_archive_title( '<h1 class="title">', '</h1>' );
		the_archive_description( '<div class="category_description">', '</div>' );
?>
	</div>

	<div id="main-content">
<?php

		while ( have_posts() ) {
			the_post();
			get_template_part( 'content' );
		}

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'next_text' => esc_html__( 'Older &rsaquo;', 'bexley' ),
				'prev_text' => esc_html__( '&lsaquo; Newer', 'bexley' ),
			)
		);
?>
	</div>
<?php
	} else {
		get_template_part( 'content-empty' );
	}

	get_footer();
