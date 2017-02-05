<?php
/**
 * Comments template.
 *
 * @package Bexley
 */

	if ( post_password_required() ) {
		return;
	}
?>
<section class="content-comments">
<?php
	if ( have_comments() ) {
?>
	<h3 id="comments">
<?php
		printf( _n( '1 reply', '%1$s replies', get_comments_number(), 'bexley' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
?>
		<a href="#respond" title="<?php esc_attr_e( 'Leave a comment', 'bexley' ); ?>">&raquo;</a>
	</h3>

	<ol class="commentlist" id="singlecomments">
<?php
	wp_list_comments(
		array(
			'avatar_size' => 48,
			'format' => 'html5',
			'short_ping' => true,
		)
	);
?>
	</ol>

	<div id="pagination">
		<div class="older">
			<?php previous_comments_link( __( '&lsaquo; Older Comments', 'bexley' ) ); ?>
		</div>
		<div class="newer">
			<?php next_comments_link( __( 'Newer Comments &rsaquo;', 'bexley' ) ); ?>
		</div>
	</div>
<?php
	}

	comment_form();
?>
</section>
