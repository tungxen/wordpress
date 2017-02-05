<?php
/**
 * Customizer partials.
 *
 * @package Linten
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function linten_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function linten_customize_partial_blogdescription() {

	bloginfo( 'description' );

}
