<?php
/**
 * Single post template
 *
 * @package Bexley
 */

	get_header();

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content-single' );
			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template( '', true );
			}
		}
	}

	get_footer();
