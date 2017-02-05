<?php
/**
 * Theme updater admin page and functions.
 *
 * @package bexley
 */

/**
 * Load Getting Started styles in the admin
 * @return [type] [description]
 */
function bexley_load_admin_scripts() {

	// Load styles only on our page.
	global $pagenow;

	if ( 'themes.php' !== $pagenow ) {
		return false;
	}

	// Getting Started styles.
	wp_enqueue_style( 'bexley-getting-started', get_stylesheet_directory_uri() . '/helpers/getting-started/getting-started.css', false, '1.0.0' );

}

add_action( 'admin_enqueue_scripts', 'bexley_load_admin_scripts' );


/**
 * Adds a menu item for the Getting Started page
 */
function bexley_getting_started_menu() {

	add_theme_page(
		esc_html__( 'Getting Started', 'bexley' ),
		esc_html__( 'Getting Started', 'bexley' ),
		'manage_options',
		'bexley-getting-started',
		'bexley_getting_started'
	);

}

add_action( 'admin_menu', 'bexley_getting_started_menu' );


/**
 * Outputs the getting started page.
 */
function bexley_getting_started() {

	// Include slimdown.
	include( get_stylesheet_directory() . '/helpers/inc/slimdown.php' );

	// Theme info.
	$theme = wp_get_theme();
	$theme_name = $theme->get( 'Name' );
	$theme_description = $theme->get( 'Description' );
	$theme_slug = basename( get_stylesheet_directory() );
	$theme_user = wp_get_current_user();

?>

		<div class="wrap getting-started about-wrap">

			<h1><?php printf( esc_html__( 'Getting started with %s', 'bexley' ), esc_html( $theme_name ) ); ?></h1>

			<div class="about-text"><?php printf( esc_html__( 'Hi %s, thank you for installing %s! %s', 'bexley' ), esc_html( $theme_user->display_name ), esc_html( $theme_name ), esc_html( $theme_description ) ); ?></div>

			<div class="panels">

<?php
	include( 'parts/help.php' );
	include( 'parts/plugins.php' );
	include( 'parts/theme-club.php' );
?>

			</div>

		</div>

<?php

}
