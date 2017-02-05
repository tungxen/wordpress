<?php
/**
 * Custom header codes
 *
 * @package Bexley
 */

/**
 * Custom header image
 */
function bexley_custom_header_support() {

	// custom header image
	$args = array(
		'default-image' => '',
		'default-text-color' => apply_filters( 'bexley_header_textcolor', '333333'),
		'random-default' => false,
		'width' => 1100,
		'height' => 150,
		'flex-height' => true,
		'header-text' => true,
		'uploads' => true,
		'wp-head-callback' => 'bexley_colour_styles',
		'admin-head-callback' => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $args );

}

add_action( 'after_setup_theme', 'bexley_custom_header_support' );


/**
 * Do custom colours using theme customiser to select options
 *
 * @return array
 */
function bexley_colour_styles() {

?>
<style>
<?php
	if ( 'blank' == get_header_textcolor() ) {
?>
	.masthead .branding {
		display:none;
	}
	a#header-image {
		padding-top:10px;
	}
<?php
	} else {
?>
	.masthead .branding h1.logo a,
	.masthead .branding h1.logo a:hover,
	.masthead .branding h2.description {
		color:#<?php echo esc_attr( get_header_textcolor() ); ?>;
	}
<?php
	}
?>
</style>
<?php

	return true;

}
