<?php
/**
 * Author post listing
 *
 * @package Bexley
 */

	get_header();
	$user_id = get_query_var( 'author' );
?>
	<h1 class="title">
		<?php _e( 'Author Archives','bexley' ); ?>
	</h1>
	<div class="writer">
		<?php echo get_avatar( get_the_author_meta( 'user_email', $user_id ), '80' ); ?>
		<h3><?php the_author_meta( 'display_name', $user_id ); ?></h3>
		<?php echo wpautop( get_the_author_meta( 'description', $user_id ) ); ?>
	</div>

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			get_template_part( 'content' );
		}

		the_posts_pagination(
			array(
				'mid_size' => 3,
				'next_text' => esc_html__( 'Older &rsaquo;', 'bexley' ),
				'prev_text' => esc_html__( '&lsaquo; Newer', 'bexley' ),
			)
		);

	} else {
		get_template_part( 'content-empty' );
	}

	get_footer();
