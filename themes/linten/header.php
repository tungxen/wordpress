<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Linten
 */

?><?php
	/**
	 * Hook - linten_action_doctype.
	 *
	 * @hooked linten_doctype -  10
	 */
	do_action( 'linten_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - linten_action_head.
	 *
	 * @hooked linten_head -  10
	 */
	do_action( 'linten_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - linten_action_before.
	 *
	 * @hooked linten_page_start - 10
	 * @hooked linten_skip_to_content - 15
	 */
	do_action( 'linten_action_before' );
	?>

    <?php
	  /**
	   * Hook - linten_action_before_header.
	   *
	   * @hooked linten_header_start - 10
	   */
	  do_action( 'linten_action_before_header' );
	?>
		<?php
		/**
		 * Hook - linten_action_header.
		 *
		 * @hooked linten_site_branding - 10
		 */
		do_action( 'linten_action_header' );
		?>
    <?php
	  /**
	   * Hook - linten_action_after_header.
	   *
	   * @hooked linten_header_end - 10
	   */
	  do_action( 'linten_action_after_header' );
	?>

	<?php
	/**
	 * Hook - linten_action_before_content.
	 *
	 * @hooked linten_add_breadcrumb - 7
	 * @hooked linten_content_start - 10
	 */
	do_action( 'linten_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - linten_action_content.
	   */
	  do_action( 'linten_action_content' );
	?>
