<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Linten
 */

	/**
	 * Hook - linten_action_after_content.
	 *
	 * @hooked linten_content_end - 10
	 */
	do_action( 'linten_action_after_content' );
	?>

	<?php
	/**
	 * Hook - linten_action_before_footer.
	 *
	 * @hooked linten_footer_start - 10
	 */
	do_action( 'linten_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - linten_action_footer.
	   *
	   * @hooked linten_footer_copyright - 10
	   */
	  do_action( 'linten_action_footer' );
	?>
	<?php
	/**
	 * Hook - linten_action_after_footer.
	 *
	 * @hooked linten_footer_end - 10
	 */
	do_action( 'linten_action_after_footer' );
	?>

<?php
	/**
	 * Hook - linten_action_after.
	 *
	 * @hooked linten_page_end - 10
	 * @hooked linten_footer_goto_top - 20
	 */
	do_action( 'linten_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
