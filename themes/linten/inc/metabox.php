<?php
/**
 * Implement theme metabox.
 *
 * @package Linten
 */

if ( ! function_exists( 'linten_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box
	 *
	 * @since 1.0.0
	 */
	function linten_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'theme-settings',
				esc_html__( 'Theme Settings', 'linten' ),
				'linten_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'linten_add_theme_meta_box' );

if ( ! function_exists( 'linten_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $post    The current post.
	 * @param array   $metabox Metabox arguments.
	 */
	function linten_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'linten_theme_settings_meta_box_nonce' );

		// Fetch values of current post meta.
		$values = get_post_meta( $post_id, 'linten_theme_settings', true );
		$linten_theme_settings_post_layout = isset( $values['post_layout'] ) ? esc_attr( $values['post_layout'] ) : '';
		$linten_theme_settings_disable_banner_area = isset( $values['disable_banner_area'] ) ? esc_attr( $values['disable_banner_area'] ) : '';
		$linten_theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
	?>
	<div id="linten-settings-metabox-container" class="linten-settings-metabox-container">
	  <ul>
	    <li><a href="#linten-settings-metabox-tab-layout"><?php echo __( 'Layout', 'linten' ); ?></a></li>
	    <li><a href="#linten-settings-metabox-tab-header"><?php echo __( 'Header', 'linten' ); ?></a></li>
	    <li><a href="#linten-settings-metabox-tab-image"><?php echo __( 'Image', 'linten' ); ?></a></li>
	  </ul>
	  <div id="linten-settings-metabox-tab-layout">
	    <h4><?php echo __( 'Layout Settings', 'linten' ); ?></h4>
	    <div class="linten-row-content">
	    	<label for="linten_theme_settings_post_layout"><?php echo esc_html__( 'Single Layout', 'linten' ); ?></label>
	    	<?php
	    	$dropdown_args = array(
				'id'          => 'linten_theme_settings_post_layout',
				'name'        => 'linten_theme_settings[post_layout]',
				'selected'    => $linten_theme_settings_post_layout,
				'add_default' => true,
	    		);
	    	linten_render_select_dropdown( $dropdown_args, 'linten_get_global_layout_options' );
	    	?>

	    </div><!-- .linten-row-content -->

	  </div><!-- #linten-settings-metabox-tab-layout -->

	  <div id="linten-settings-metabox-tab-header">
	    <h4><?php echo __( 'Header Settings', 'linten' ); ?></h4>
	    <div class="linten-row-content">
	    	<label for="linten_theme_settings_disable_banner_area"><?php echo esc_html__( 'Header Banner', 'linten' ); ?></label>
	    	<input type="checkbox" name="linten_theme_settings[disable_banner_area]" id="linten_theme_settings_disable_banner_area" value="1" <?php checked( $linten_theme_settings_disable_banner_area, '1' ); ?> />&nbsp;<span class="field-description"><?php _e( 'Check to Disable Header Banner', 'linten' )?></span>
	    </div><!-- .linten-row-content -->

	  </div><!-- #linten-settings-metabox-tab-header -->

	  <div id="linten-settings-metabox-tab-image">
		    <h4><?php echo __( 'Image Settings', 'linten' ); ?></h4>
		    <div class="linten-row-content">
			    <label for="linten_theme_settings_single_image"><?php echo esc_html__( 'Image in Single Post/Page', 'linten' ); ?></label>
	        	<?php
	        	$dropdown_args = array(
	    			'id'          => 'linten_theme_settings_single_image',
	    			'name'        => 'linten_theme_settings[single_image]',
	    			'selected'    => $linten_theme_settings_single_image,
	    			'add_default' => true,
	        		);
	        	$callback_args = array(
					'add_disable'    => true,
					'allowed'        => array( 'disable', 'large' ),
					'show_dimension' => false,
	        		);
	        	linten_render_select_dropdown( $dropdown_args, 'linten_get_image_sizes_options', $callback_args );
	        	?>
		    </div><!-- .linten-row-content -->

	  </div><!-- #linten-settings-metabox-tab-image -->

	</div><!-- #linten-settings-metabox-container -->

    <?php
	}

endif;



if ( ! function_exists( 'linten_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function linten_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if ( ! isset( $_POST['linten_theme_settings_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['linten_theme_settings_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! array_filter( $_POST['linten_theme_settings'] ) ) {
			// No value.
			delete_post_meta( $post_id, 'linten_theme_settings' );
		} else {
			$meta_fields = array(
				'post_layout' => array(
					'type' => 'select',
					),
				'disable_banner_area' => array(
					'type' => 'checkbox',
					),
				'single_image' => array(
					'type' => 'select',
					),
				);

			$sanitized_values = array();
			foreach ( $_POST['linten_theme_settings'] as $mk => $mv ) {

				if ( isset( $meta_fields[ $mk ]['type'] ) ) {
					switch ( $meta_fields[ $mk ]['type'] ) {
						case 'select':
							$sanitized_values[ $mk ] = esc_attr( $mv );
							break;
						case 'checkbox':
							$sanitized_values[ $mk ] = absint( $mv ) > 0 ? 1 : 0;
							break;
						default:
							$sanitized_values[ $mk ] = esc_attr( $mv );
							break;
					}
				} // End if.

			}
			update_post_meta( $post_id, 'linten_theme_settings', $sanitized_values );
		}

	}

endif;

add_action( 'save_post', 'linten_save_theme_settings_meta', 10, 3 );
