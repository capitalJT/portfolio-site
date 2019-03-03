<?php
/**
 * @author    Jabal Torres
 * @example   https://jabaltorres.com
 * @copyright 2019 Jabal Torre LLC
 * https://wpsites.net/web-design/basic-genesis-archive-page-template-for-custom-post-type/
 */

//* Force full width content layout
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumb navigation
//remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post info function
//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Add custom body class to the head
add_filter( 'body_class', 'wpsites_add_games_body_class' );
function wpsites_add_games_body_class( $classes ) {
	$classes[] = 'custom-blog-template';
	return $classes;
}

//* Remove the post meta function
//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
genesis();