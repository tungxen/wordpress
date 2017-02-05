<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]> <html <?php language_attributes(); ?>> <![endif]-->
 <?php saaa ?>
<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <link rel="profile" href="http://gmgp.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
 
        <?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?> > <!--Thêm class tượng trưng cho mỗi trang lên <body> để tùy biến-->
	<nav class="navbar navbar-default" role="navigation">
		<?php tungxen_logo(); ?>
		<div class="navbar-collapse collapse" id="mynavbar" aria-expanded="false" style="height: 1px;">
					<?php tungxen_menu('primary-menu'); ?>
			      <form class="navbar-form navbar-left" role="search" id="searchform" method="get" action="http://localhost/wordpress/">
			        <div class="form-group">
			          <input type="text" class="form-control" name="s" placeholder="Search">
			          <input type="hidden" class="form-control" name="trang" id="s" value="1">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm</button>
			      </form>
		</div>
	</nav>
	<div class="container-fluid" id="container">
		     
