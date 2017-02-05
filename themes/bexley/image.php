<?php
/**
 * Attachment template
 *
 * @package Bexley
 */

	get_header();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<section class="post-entry">
<?php
	if ( $post->post_parent ) {
		$metadata = wp_get_attachment_metadata();
		printf( __( '<div class="postmetadata">Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a></div>', 'bexley' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( wp_get_attachment_url() ),
			(int) $metadata['width'],
			(int) $metadata['height'],
			esc_url( get_permalink( $post->post_parent ) ),
			get_the_title( $post->post_parent )
		);
	}

	the_title( '<h1 class="posttitle">&#8216;', '&#8217;</h1>' );

?>
	<div class="attachment-image"><?php echo wp_get_attachment_link( $post->ID, array( 700, 500 ) ); ?></div>
<?php

	if ( ! has_excerpt() ) {
?>
		<div class="entry-caption">
			<?php the_excerpt(); ?>
		</div>
<?php
	}

	if ( $post->post_parent ) {
?>
			<p><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" class="read-more" rev="attachment"><?php _e( '&lsaquo; Back', 'bexley' ); ?></a></p>
<?php
	}

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '', true );
	}
?>
		</section>
	</article>
<?php
	get_footer();
