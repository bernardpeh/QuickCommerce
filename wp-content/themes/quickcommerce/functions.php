<?php
//Add logout link to naviagation menu
function add_logout_link_to_menu( $items, $args ){
	$link = '<a href="'.wp_logout_url(home_url()).'" title="'.__( 'Logout' ) .'">'.__( 'Logout' ).'</a>';
	return $items.= '<li id="log-out-link" class="menu-item">'. $link . '</li>';
}
if (is_user_logged_in()) {
	add_filter( 'wp_nav_menu_items', 'add_logout_link_to_menu', 10, 2 );
}
