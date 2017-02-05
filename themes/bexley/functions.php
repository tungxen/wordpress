<?php
/**
 * Reusable theme functions
 *
 * @package Bexley
 */

include( 'inc/custom-header.php' );
include( 'inc/jetpack.php' );
include( 'inc/class-customizer.php' );

// This is the max width - it's the same on all pages
// keep in mind the theme is responsive so the width is likely to be narrower.
if ( ! isset( $content_width ) ) {
	$content_width = 700;
}


/**
 * Enqueue all the styles.
 */
function bexley_enqueue() {

	global $wp_scripts;

	wp_enqueue_style( 'bexley-style', get_template_directory_uri().'/styles/css/styles.css', null, '1.1' );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/styles/genericons/genericons.css', array(), '3.0.3' );

	// Fonts.
	$fonts_url = bexley_fonts();

	if ( $fonts_url ) {
		wp_enqueue_style( 'bexley-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_script( 'bexley-script-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'bexley-script-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'masonry' ), '1.0.1', false );

	wp_localize_script(
		'bexley-script-main',
		'js_i18n',
		array(
			'menu' => esc_html__( 'Menu', 'bexley' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'bexley_enqueue' );


/**
 * Get url for embedding Google fonts.
 *
 * Output can be filtered with 'bexley_fonts' filter.
 *
 * @return string|boolean Font url or false if there are no fonts.
 */
function bexley_fonts() {

	$fonts = array();

	/* translators: If there are characters in your language that are not supported by Roboto Slab, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'bexley' ) ) {
		$fonts['roboto-slab'] = 'Roboto+Slab:700,300';
	}

	// Filter fonts. Allows them to be disabled/ added to.
	$fonts = apply_filters( 'bexley_fonts', $fonts );

	if ( $fonts ) {
		// Build font embed query string.
		$query_args = array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		return add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return false;

}


/**
 * Set up all the theme properties and extras
 */
function bexley_after_setup_theme() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	load_theme_textdomain( 'bexley', get_template_directory() . '/languages' );

	// Post thumbnails.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'bexley-content', 1100, 9999, false );
	add_image_size( 'bexley-archive', 120, 120, true );

	// Custom background.
	$args = array(
		'default-color' => 'f2f2f2',
	);
	add_theme_support( 'custom-background', $args );

	// HTML5 FTW.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form' ) );

	register_nav_menu( 'top_menu', __( 'Top Menu', 'bexley' ) );

}


/**
 * Initialise widgets
 */
function bexley_widgets_init() {

	// Sidebar.
	register_sidebar(
		array(
			'name' => __( 'Sidebar Widgets', 'bexley' ),
			'id' => 'sidebar-1',
			'description' => __( 'Widgets that display on the side of your website. Keep this empty to remove the sidebar.', 'bexley' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

	// Footer.
	register_sidebar(
		array(
			'name' => __( 'Footer Widgets', 'bexley' ),
			'id' => 'sidebar-2',
			'description' => __( 'Widgets that display at the bottom of the website.', 'bexley' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

}

add_action( 'widgets_init', 'bexley_widgets_init' );


/**
 * Change the excerpt more link
 *
 * @param type $more
 * @return type
 */
function bexley_excerptmore( $more ) {

	return '&hellip; <a href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read More', 'bexley' ) . '</a>';

}


/**
 * Custom excerpt length
 *
 * @param type $length
 * @return int
 */
function bexley_excerpt_length( $length ) {

	return 40;

}


/**
 * Add an id to menus so we can target them directly.
 *
 * @param type $ulclass
 * @return type
 */
function bexley_add_menu_class( $ulclass ) {

	return preg_replace( '/<ul>/', '<ul id="nav">', $ulclass, 1 );

}


/**
 * Add extra body classes
 *
 * @param array $classes List of classes to modify.
 * @return array
 */
function bexley_body_class( $classes ) {

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'themes-sidebar1-active';
	} else {
		$classes[] = 'themes-sidebar1-inactive';
	}

	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$classes[] = 'has-custom-header';
	}

	$classes[] = 'title-alignment-' . esc_attr( get_theme_mod( 'bexley_title_alignment', 0 ) );

	return $classes;

}

add_filter( 'body_class', 'bexley_body_class' );


/**
 * Display header image with link
 */
function bexley_header() {

	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="header-image">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
<?php
	}

}


/**
 * Get the posts custom read more text and, if available, display it instead of 'read more'
 */
function bexley_read_more_text() {

	// Default text value.
	$read_more = esc_html__( 'Read More &rarr;', 'bexley' );

	// Get post data.
	$post = get_post();
	$custom_readmore = get_extended( $post->post_content );

	if ( ! empty( $custom_readmore['more_text'] ) ) {
		$read_more = $custom_readmore['more_text'];
	}

	echo esc_html( $read_more );

}


/**
 * Custom post classes
 *
 * @param type $classes
 * @return type
 */
function bexley_post_class( $classes ) {

	// Add a light or dark class depending upon the image.
	if ( class_exists( 'Tonesque' ) ) {
		$image = bexley_archive_image( get_the_ID() );
		if ( $image[0] ) {
			$contrast = new Tonesque( $image[0] );
			$contrast->color();
			$black_or_white = $contrast->contrast();
			if ( '0,0,0' === $black_or_white ) {
				$classes[] = 'contrast-black';
			} else {
				$classes[] = 'contrast-white';
			}
		}
	}

	return $classes;

}

add_filter( 'post_class', 'bexley_post_class' );


/**
 * Theme customizer properties
 *
 * @param type $wp_customize
 */
function bexley_customizer_settings( $wp_customize ) {

	// Bexley theme options section.
	$wp_customize->add_section(
		'bexley_options',
		array(
			'title' => __( 'Theme', 'bexley' ),
			'description' => __( 'Options for the bexley theme.', 'bexley' ),
		)
	);

	// ---
	// setting to display the homepage and archive images in the correct proportions
	$wp_customize->add_setting( 'bexley_use_image_size', array(
		'default' => false,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'bexley_sanitize_checkboxes',
	) );

	$wp_customize->add_control( 'bexley_use_image_size', array(
		'label' => __( 'Use image ratio on homepage', 'bexley' ),
		'section' => 'bexley_options',
		'type' => 'checkbox',
	) );

	// ---
	// setting to select a category to set as featured in the main site content
	$wp_customize->add_setting( 'bexley_title_alignment', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'bexley_sanitize_alignment',
	) );

	// Control for hiding the category list under the header.
	$wp_customize->add_control(
		new bexley_Category_Dropdown_Custom_control(
			$wp_customize,
			'bexley_title_alignment',
			array(
				'label' => __( 'Homepage Title Alignment', 'bexley' ),
				'section' => 'bexley_options',
				'params' => array(
					0 => __( 'Left (default)', 'bexley' ),
					1 => __( 'Center', 'bexley' ),
					2 => __( 'Right', 'bexley' ),
				),
			)
		)
	);

	// ---
	// setting to display the featured images on single post pages
	$wp_customize->add_setting( 'bexley_display_image', array(
		'default' => true,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'bexley_sanitize_checkboxes',
	) );

	$wp_customize->add_control( 'bexley_display_image', array(
		'label' => __( 'Display featured image on blog posts', 'bexley' ),
		'section' => 'bexley_options',
		'type' => 'checkbox',
	) );

}


/**
 * Sanitize checkbox
 *
 * @param type $setting
 * @return int|string
 */
function bexley_sanitize_checkboxes( $setting ) {

	if ( 1 == $setting ) {
		return 1;
	} else {
		return '';
	}

}


/**
 * Sanitize alignment value
 * make sure it's an int
 *
 * @param type $setting
 * @return int
 */
function bexley_sanitize_alignment( $setting ) {

	return (int) $setting;

}


/**
 * Get the post thumbnail.
 *
 * @param int $post_id The id of the post.
 * @return type
 */
function bexley_archive_image( $post_id ) {

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'bexley-content' );

	// If there's no featured image then grab an attachment image and use that instead.
	if ( ! $image[0] ) {

		$values = get_attached_media( 'image', $post_id );

		if ( $values ) {
			foreach ( $values as $child_id => $attachment ) {
				$image = wp_get_attachment_image_src( $child_id, 'bexley-content' );
				break;
			}
		}
	}

	return $image;

}


add_action( 'customize_register', 'bexley_customizer_settings' );
add_action( 'after_setup_theme', 'bexley_after_setup_theme' );

add_filter( 'excerpt_length', 'bexley_excerpt_length', 999 );
add_filter( 'wp_page_menu','bexley_add_menu_class' );
add_filter( 'use_default_gallery_style', '__return_false' );

// Load theme helpers.
include( 'helpers/index.php' );
