<?php
/**
 * Header Template
 *
 * @package Bexley
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="masthead-wrapper">
		<header class="masthead" role="banner">
			<div class="branding">
				<h1 class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'bexley' ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2 class="description">
					<?php bloginfo( 'description' ); ?>
				</h2>
				<?php bexley_social_links(); ?>
			</div>
			<?php bexley_header(); ?>
			<nav class="menu">
<?php
	wp_nav_menu(
		array(
			'theme_location' => 'top_menu',
			'menu_id' => 'nav',
			'menu_class' => 'menu-wrap clearfix',
		)
	);

	get_search_form();
?>
			</nav>
		</header>
	</div>

	<div class="container">
		<div id="main" class="main">
