<?php
/**
 * Generic search form template
 *
 * @package Bexley
 */

?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php echo get_search_query(); ?>" name="s" class="searchfield" placeholder="<?php echo esc_attr_x( 'Search...', 'search input placeholder text', 'bexley' ); ?>" />
	<button class="searchsubmit">&#62464;</button>
</form>
