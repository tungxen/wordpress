<?php
/**
 * Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Linten
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @since 1.0.0
 */
function linten_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'linten_custom_header_args', array(
			'default-image' => '',
			'width'         => 1920,
			'height'        => 500,
			'flex-height'   => true,
			'header-text'   => false,
	) ) );

	// Register default headers.
	register_default_headers( array(
		'vintage-sports-car' => array(
			'url'           => '%s/images/header-banner.jpg',
			'thumbnail_url' => '%s/images/header-banner.jpg',
			'description'   => _x( 'Vintage Sports Car', 'header image description', 'linten' ),
		),
	) );
}

add_action( 'after_setup_theme', 'linten_custom_header_setup' );
