<?php
/**
 * Implementation of slider feature.
 *
 * @package Linten
 */

// Check slider status.
add_filter( 'linten_filter_slider_status', 'linten_check_slider_status' );

// Add slider to the theme.
add_action( 'linten_action_before_content', 'linten_add_featured_slider', 5 );

// Slider details.
add_filter( 'linten_filter_slider_details', 'linten_get_slider_details' );


if ( ! function_exists( 'linten_get_slider_details' ) ) :

	/**
	 * Slider details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Slider details.
	 */
	function linten_get_slider_details( $input ) {

		$featured_slider_type           = linten_get_option( 'featured_slider_type' );
		$featured_slider_number         = linten_get_option( 'featured_slider_number' );
		$featured_slider_read_more_text = linten_get_option( 'featured_slider_read_more_text' );

		switch ( $featured_slider_type ) {

			case 'featured-page':

				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number ; $i++ ) {
					$id = linten_get_option( 'featured_slider_page_' . $i );
					if ( ! empty( $id ) ) {
						$ids[] = absint( $id );
					}
				}
				// Bail if no valid pages are selected.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post_type'      => 'page',
					'post__in'       => $ids,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'linten-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = $post->post_title;
							$slides[ $cnt ]['url']     = get_permalink( $post->ID );
							$slides[ $cnt ]['excerpt'] = linten_the_excerpt( apply_filters( 'linten_filter_slider_caption_length', 30 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			default:
			break;
		}
		return $input;

	}
endif;

if ( ! function_exists( 'linten_add_featured_slider' ) ) :

	/**
	 * Add featured slider.
	 *
	 * @since 1.0.0
	 */
	function linten_add_featured_slider() {

		$flag_apply_slider = apply_filters( 'linten_filter_slider_status', false );
		if ( true !== $flag_apply_slider ) {
			return false;
		}

		$slider_details = array();
		$slider_details = apply_filters( 'linten_filter_slider_details', $slider_details );

		if ( empty( $slider_details ) ) {
			return;
		}

		// Render slider now.
		linten_render_featured_slider( $slider_details );

	}
endif;

if ( ! function_exists( 'linten_render_featured_slider' ) ) :

	/**
	 * Render featured slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $slider_details Details of slider content.
	 */
	function linten_render_featured_slider( $slider_details = array() ) {

		if ( empty( $slider_details ) ) {
			return;
		}

		$featured_slider_transition_effect   = linten_get_option( 'featured_slider_transition_effect' );
		$featured_slider_enable_caption      = linten_get_option( 'featured_slider_enable_caption' );
		$featured_slider_enable_arrow        = linten_get_option( 'featured_slider_enable_arrow' );
		$featured_slider_enable_pager        = linten_get_option( 'featured_slider_enable_pager' );
		$featured_slider_enable_autoplay     = linten_get_option( 'featured_slider_enable_autoplay' );
		$featured_slider_transition_duration = linten_get_option( 'featured_slider_transition_duration' );
		$featured_slider_transition_delay    = linten_get_option( 'featured_slider_transition_delay' );

		// Cycle data.
		$slide_data = array(
			'fx'             => esc_attr( $featured_slider_transition_effect ),
			'speed'          => esc_attr( $featured_slider_transition_duration ) * 1000,
			'pause-on-hover' => 'true',
			'loader'         => 'true',
			'log'            => 'false',
			'swipe'          => 'true',
			'auto-height'    => 'container',
		);
		if ( $featured_slider_enable_caption ) {
			$slide_data['caption-template'] = '<h3><a href="{{url}}" target="{{target}}">{{title}}</a></h3><p>{{excerpt}}</p>{{buttons}}';
		}

		if ( $featured_slider_enable_pager ) {
			$slide_data['pager-template'] = '<span class="pager-box"></span>';
		}
		if ( $featured_slider_enable_autoplay ) {
			$slide_data['timeout'] = absint( $featured_slider_transition_delay ) * 1000;
		} else {
			$slide_data['timeout'] = 0;
		}

		$slide_data['slides'] = 'article';

		$slide_attributes_text = '';
		foreach ( $slide_data as $key => $item ) {
			$slide_attributes_text .= ' ';
			$slide_attributes_text .= ' data-cycle-'.esc_attr( $key );
			$slide_attributes_text .= '="'.esc_attr( $item ).'"';
		}
	?>
    <div id="featured-slider">

        <div class="cycle-slideshow" id="main-slider" <?php echo $slide_attributes_text; ?>>

			<?php if ( $featured_slider_enable_arrow ) : ?>
	            <!-- prev/next links -->
	            <div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
	            <div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			<?php endif; ?>

			<?php if ( $featured_slider_enable_caption ) : ?>
	            <!-- empty element for caption -->
	            <div class="cycle-caption"></div>
			<?php endif; ?>

            <?php $cnt = 1; ?>
            <?php foreach ( $slider_details as $key => $slide ) : ?>

				<?php $class_text = ( 1 === $cnt ) ? 'first' : ''; ?>
				<?php
				$target = '_self';
				if ( isset( $slide['new_window'] ) && 1 === $slide['new_window'] && ! empty( $slide['url'] ) ) {
					$target = '_blank';
				}
				$url = 'javascript:void(0);';
				if ( ! empty( $slide['url'] ) ) {
					$url = esc_url( $slide['url'] );
				}

				// Buttons stuff.
				$buttons_markup = '';
				$primary_button_text = ! empty( $slide['primary_button_text'] ) ? $slide['primary_button_text'] : '' ;
				$primary_button_url = ! empty( $slide['primary_button_url'] ) ? $slide['primary_button_url'] : '' ;
				$secondary_button_text = ! empty( $slide['secondary_button_text'] ) ? $slide['secondary_button_text'] : '' ;
				$secondary_button_url = ! empty( $slide['secondary_button_url'] ) ? $slide['secondary_button_url'] : '' ;

				if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) {
					$buttons_markup .= '<div class="slider-buttons">';
					if ( ! empty( $primary_button_text ) ) {
						$buttons_markup .= '<a href="' . esc_url( $primary_button_url ) . '" class="custom-button slider-button button-primary">' . esc_html( $primary_button_text ) . '</a>';
					}
					if ( ! empty( $secondary_button_text ) ) {
						$buttons_markup .= '<a href="' . esc_url( $secondary_button_url ) . '" class="custom-button slider-button button-secondary">' . esc_html( $secondary_button_text ) . '</a>';
					}
					$buttons_markup .= '</div>';
				}

				?>
              <article class="<?php echo esc_attr( $class_text ); ?>" data-cycle-title="<?php echo esc_attr( $slide['title'] ); ?>"  data-cycle-url="<?php echo esc_url( $url ); ?>"  data-cycle-excerpt="<?php echo esc_attr( $slide['excerpt'] ); ?>" data-cycle-target="<?php echo esc_attr( $target ); ?>" data-cycle-buttons="<?php echo esc_attr( $buttons_markup ); ?>" >

                <?php if ( ! empty( $slide['url'] ) ) : ?>
                  <a href="<?php echo esc_url( $slide['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" >
                <?php endif; ?>

                  <img src="<?php echo esc_url( $slide['images'][0]); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>" />
                <?php if ( ! empty( $slide['url'] ) ) : ?>
                  </a>
                <?php endif; ?>

              </article>

				<?php $cnt++; ?>

            <?php endforeach; ?>


            <?php if ( $featured_slider_enable_pager ) : ?>
              <!-- pager -->
              <div class="cycle-pager"></div>
            <?php endif; ?>


        </div><!-- #main-slider -->

    </div><!-- #featured-slider -->

    <?php

	}

endif;

if( ! function_exists( 'linten_check_slider_status' ) ) :

	/**
	 * Check status of slider.
	 *
	 * @since 1.0.0
	 */
	function linten_check_slider_status( $input ) {

		// Slider status.
		$featured_slider_status = linten_get_option( 'featured_slider_status' );

		// Get Page ID outside Loop.
		$page_id = null;
		$queried_object = get_queried_object();
		if ( is_object( $queried_object ) && 'WP_Post' === get_class( $queried_object ) ) {
			$page_id = get_queried_object_id();
		}

		// Front page displays in Reading Settings.
		$page_on_front  = absint( get_option( 'page_on_front' ) );
		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		switch ( $featured_slider_status ) {

			case 'disabled':
				$input = false;
				break;

			case 'home-page':
			    if ( $page_on_front === $page_id && $page_on_front > 0 ) {
					$input = true;
			    }
				break;

			default:
				break;
		}
		return $input;

	}

endif;
