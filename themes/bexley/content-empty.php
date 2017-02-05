<?php
/**
 * No content
 *
 * @package Bexley
 */

?>
<article class="no-results not-found">
	<h1 class="title"><?php _e( 'Nothing Found', 'bexley' ); ?></h1>

	<section class="entry">
<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {
?>
		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bexley' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php
	} if ( is_search() ) {
?>
		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bexley' ); ?></p>
<?php
		get_search_form();
	} else {
?>
		<p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'bexley' ); ?></p>
<?php
		get_search_form();
	}
?>
	</section>
</article>
