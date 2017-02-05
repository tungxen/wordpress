<?php
/**
 * Callback functions for active_callback.
 *
 * @package Linten
 */

if ( ! function_exists( 'linten_is_featured_slider_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function linten_is_featured_slider_active( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'featured_slider_status' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'linten_is_featured_slider_active_non_demo' ) ) :

	/**
	 * Check if featured slider is active and non demo.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function linten_is_featured_slider_active_non_demo( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'featured_slider_status' )->value() && 'demo-slider' !== $control->manager->get_setting( 'featured_slider_type' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'linten_is_featured_slider_active_non_demo_non_image' ) ) :

	/**
	 * Check if featured slider is active and non demo and also non image
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function linten_is_featured_slider_active_non_demo_non_image( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'featured_slider_status' )->value() && 'demo-slider' !== $control->manager->get_setting( 'featured_slider_type' )->value() && 'featured-image' !== $control->manager->get_setting( 'featured_slider_type' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'linten_is_featured_page_slider_active' ) ) :

	/**
	 * Check if featured page slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function linten_is_featured_page_slider_active( $control ) {

		if (
		'featured-page' === $control->manager->get_setting( 'featured_slider_type' )->value()
		&& 'disabled' !== $control->manager->get_setting( 'featured_slider_status' )->value()
		) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'linten_is_image_in_archive_active' ) ) :

	/**
	 * Check if image in archive is active.
	 *
	 * @since 1.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function linten_is_image_in_archive_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'archive_image' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
