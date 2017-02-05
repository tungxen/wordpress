<?php
/**
 * Generic content
 *
 * @package Bexley
 */

	$image = bexley_archive_image( get_the_ID() );

	$styles = array();
	$class = array();
	$style = '';

	if ( $image[0] ) {

		if ( get_theme_mod( 'bexley_use_image_size', false ) ) {
			$width = 900;
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				$width = 600;
			}
			$height = floor( $width * ( $image[2] / $image[1] ) );
			$styles[] = 'min-height:' . $height . 'px';
		}

		$class[] = 'has-featured-image';
		$styles[] = 'background-image:url(' . esc_attr( esc_url( $image[0] ) ) . ')';

		$style = 'style="' . implode( '; ', $styles ) . ';"';
	}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<div class="showcase" <?php echo $style; ?>>
		<section class="entry">
			<?php get_template_part( 'inc/postmetadata' ); ?>
			<h2 class="posttitle">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
			<a href="<?php the_permalink(); ?>" class="read-more"><?php bexley_read_more_text(); ?></a>
		</section>
	</div>
</article>
