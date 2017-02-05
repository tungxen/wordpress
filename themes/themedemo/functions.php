<?php 
define('THEME_URL',get_stylesheet_directory());
define('CORE', THEME_URL . '/core');
require_once(CORE . '/init.php');
require_once(THEME_URL . '/wp_bootstrap_navwalker.php');

if(!isset($content_width)){
	$content_width = 620;	
}

if(!function_exists('tungxen_theme_setup')){
	function tungxen_theme_setup(){

	}
	add_action('init', 'tungxen_theme_setup');
}

$language_folder = THEME_URL . '/languages';
load_theme_textdomain('tungxen', $language_folder);
add_theme_support('automatic-feed-links');

/**
@ Thiết lập hàm hiển thị logo
@ tungxen_logo()
**/
if ( ! function_exists( 'tungxen_logo' ) ) {
  function tungxen_logo() {?>
  <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" title="<?php echo get_bloginfo( 'description' ) ?>" href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'sitename' ) ?></a>
    </div>
  <?php }
}

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-formats',
    array(
       'image',
       'video',
       'gallery',
       'quote',
       'link'
    )
 );
 $default_background = array(
   'default-color' => '#e8e8e8',
);
add_theme_support( 'custom-background', $default_background );
register_nav_menu ( 'primary-menu', __('menu chính', 'thachpham') );
register_nav_menu ( 'secondary-menu', __('menu phụ', 'thachpham') );

function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'main-sidebar', 'tungxen' ),
        'id' => 'main-sidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'tungxen' ),
        'before_widget' => '<div id="%1$s" class="panel panel-default widget %2$s">',
  'after_widget'  => '</div>',
  'before_title'  => '<div class="panel-heading lead">',
  'after_title'   => '</div>',
    ) );
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );
/////////////
/* ===================================================
    Sidebars
 * =================================================== */

// function wordit_register_sidebars() {

//     register_sidebar( array(
//         'name'          => __( 'Bottom 1 of 3 Sidebar', 'wordit' ),
//         'id'            => 'wordit-bottom-13-sidebar',
//         'description'   => __('Wordit bottom left sidebar widget area', 'wordit'),
//         'class'         => '',
//         'before_widget' => '<div id="%1$s" class="%2$s sidebar_widget">',
//         'after_widget'  => '</div>',
//         'before_title'  => '<h2 class="sidebar_widgettitle">',
//         'after_title'   => '</h2>' )
//     );

//     register_sidebar( array(
//         'name'          => __( 'Bottom 2 of 3 Sidebar', 'wordit' ),
//         'id'            => 'wordit-bottom-23-sidebar',
//         'description'   => __('Wordit bottom center sidebar widget area', 'wordit'),
//         'class'         => '',
//         'before_widget' => '<div id="%1$s" class="%2$s sidebar_widget">',
//         'after_widget'  => '</div>',
//         'before_title'  => '<h2 class="sidebar_widgettitle">',
//         'after_title'   => '</h2>' )
//     );

//     register_sidebar( array(
//         'name'          => __( 'Bottom 3 of 3 Sidebar', 'wordit' ),
//         'id'            => 'wordit-bottom-33-sidebar',
//         'description'   => __('Wordit bottom right sidebar widget area', 'wordit'),
//         'class'         => '',
//         'before_widget' => '<div id="%1$s" class="%2$s sidebar_widget">',
//         'after_widget'  => '</div>',
//         'before_title'  => '<h2 class="sidebar_widgettitle">',
//         'after_title'   => '</h2>' )
//     ); 

// } 
// add_action( 'widgets_init', 'wordit_register_sidebars' );


// // Disables hardcodes style.css in wp-inclues/media.php
// add_filter( 'use_default_gallery_style', '__return_false' ); 
/////////////////////

if ( ! function_exists( 'tungxen_menu' ) ) {
  function tungxen_menu( $slug ) {
    $menu = array(
      'theme_location' => $slug,
      'container' => '',
      //'container_class' => $slug,
      'menu_class' => 'nav navbar-nav',
      'walker' => new wp_bootstrap_navwalker,
    );
    wp_nav_menu( $menu );
  }
}

/**
@ Tạo hàm phân trang cho index, archive.
@ Hàm này sẽ hiển thị liên kết phân trang theo dạng chữ: Newer Posts & Older Posts
@ tungxen_pagination()
**/
if ( ! function_Exists( 'tungxen_pagination' ) ) {
  function tungxen_pagination() {
    /*
     * Không hiển thị phân trang nếu trang đó có ít hơn 2 trang
     */
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
      return '';
    }
  ?>
 
  <nav class="pagination" role="navigation">
    <?php if ( get_next_post_link() ) : ?>
      <div class="prev"><?php next_posts_link( __('Older Posts', 'thachpham') ); ?></div>
    <?php endif; ?>
 
    <?php if ( get_previous_post_link() ) : ?>
      <div class="next"><?php previous_posts_link( __('Newer Posts', 'thachpham') ); ?></div>
    <?php endif; ?>
 
  </nav><?php
  }
}
/**
@ Hàm hiển thị ảnh thumbnail của post.
@ Ảnh thumbnail sẽ không được hiển thị trong trang single
@ Nhưng sẽ hiển thị trong single nếu post đó có format là Image
@ tungxen_thumbnail( $size )
**/
if ( ! function_exists( 'tungxen_thumbnail' ) ) {
  function tungxen_thumbnail( $size ) {
 
    // Chỉ hiển thumbnail với post không có mật khẩu
    if ( ! is_single() &&  has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image' ) ) : ?>
      <figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure><?php
    endif;
  }
}
/**
@ Hàm hiển thị tiêu đề của post trong .entry-header
@ Tiêu đề của post sẽ là nằm trong thẻ <h1> ở trang single
@ Còn ở trang chủ và trang lưu trữ, nó sẽ là thẻ <h2>
@ tungxen_entry_header()
**/
if ( ! function_exists( 'tungxen_entry_header' ) ) {
  function tungxen_entry_header() {
    if ( is_single() ) : ?>
 
      <h1 class="entry-title" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h1>
    <?php else : ?>
      <h3 class="entry-title" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h3><?php
 
    endif;
  }
}
/**
@ Hàm hiển thị thông tin của post (Post Meta)
@ tungxen_entry_meta()
**/
if( ! function_exists( 'tungxen_entry_meta' ) ) {
  function tungxen_entry_meta() {
    if ( ! is_page() ) :
      echo '<div class="entry-meta">';
 
        // Hiển thị tên tác giả, tên category và ngày tháng đăng bài
        printf( __('<span class="author">tác giả: %1$s</span>', 'tungxen'),
          get_the_author() );
        echo '<br />';
        printf( __('<span class="date-published"> Ngày: %1$s</span>', 'tungxen'),
          get_the_date("d/m/Y") );
 
        // printf( __('<span class="category"> in %1$s</span>', 'tungxen'),
        //   get_the_category_list( ', ' ) );
 
        // Hiển thị số đếm lượt bình luận
        // if ( comments_open() ) :
        //   echo ' <span class="meta-reply">';
        //     comments_popup_link(
        //       __('Leave a comment', 'tungxen'),
        //       __('One comment', 'tungxen'),
        //       __('% comments', 'tungxen'),
        //       __('Read all comments', 'tungxen')
        //      );
        //   echo '</span>';
        // endif;
      echo '</div>';
    endif;
  }
}

add_filter('themify_loop_date', 'custom_themify_loop_date');
/*
 * Thêm chữ Read More vào excerpt
 */
function thachpham_readmore() {
  return '...<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'thachpham') . '</a>';
}
add_filter( 'excerpt_more', 'thachpham_readmore' );
 
/**
@ Hàm hiển thị nội dung của post type
@ Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
@ Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
@ tungxen_entry_content()
**/
if ( ! function_exists( 'tungxen_entry_content' ) ) {
  function tungxen_entry_content() {
 
    if ( ! is_single() ) :
      the_excerpt();
      echo "<hr />";
      printf( __('<span class="author">%1$s</span>', 'tungxen'),get_the_author() );
      echo "<a class='button' href='".get_permalink(get_the_ID())."'>đọc tiếp <span> &#x27F6;</span></a>";
    else :
      the_content();
 
      /*
       * Code hiển thị phân trang trong post type
       */
      $link_pages = array(
        'before' => __('<p>Page:', 'tungxen'),
        'after' => '</p>',
        'nextpagelink'     => __( 'Next page', 'tungxen' ),
        'previouspagelink' => __( 'Previous page', 'tungxen' )
      );
      wp_link_pages( $link_pages );
    endif;
 
  }
}
/**
@ Hàm hiển thị tag của post
@ tungxen_entry_tag()
**/
if ( ! function_exists( 'tungxen_entry_tag' ) ) {
  function tungxen_entry_tag() {
    if ( has_tag() ) :
      echo '<div class="entry-tag">';
      printf( __('Tagged in %1$s', 'tungxen'), get_the_tag_list( '', ', ' ) );
      echo '</div>';
    endif;
  }
}

/**
@ Chèn CSS và Javascript vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
**/
function tungxen_styles() {
  /*
   * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
   * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
   */
  wp_register_script( 'main-script1', get_template_directory_uri() . '/js/jquery.min.js');
  //wp_register_script( 'main-script2', get_template_directory_uri() . '/js/bootstrap.min.js');

  //wp_register_style( 'main-style1', get_template_directory_uri() . '/css/bootstrap.min.css', 'all' );
  wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', 'all' );

  wp_enqueue_style( 'main-style1' );
  wp_enqueue_style( 'main-style' );

  wp_enqueue_script('main-script1');
  wp_enqueue_script( 'main-script2' );

}
add_action( 'wp_enqueue_scripts', 'tungxen_styles' );


















