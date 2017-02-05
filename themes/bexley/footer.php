<?php
/**
 * Single post content
 *
 * @package Bexley
 */

?>
	</div>
<?php
	// Sidebar widgets.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page_template( 'custom-templates/custom-page-fullwidth.php' ) ) {
?>
		<aside id="sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
<?php
	}

	// Footer widgets.
	if ( is_active_sidebar( 'sidebar-2' ) ) {
?>
		<aside id="footer-widgets">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside>
<?php
	}
?>
	</div>

	<footer role="contentinfo" id="footer">

		<section class="row">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bexley' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'bexley' ); ?>" rel="generator"><?php printf( esc_html__( 'Proudly powered by %s', 'bexley' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'bexley' ), 'Bexley', '<a href="https://prothemedesign.com/" rel="designer">Pro Theme Design</a>' ); ?>
		</section>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
