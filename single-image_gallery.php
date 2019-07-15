<?php

// Include custom header
// include ('includes/custom-page-header.php');

remove_action('genesis_loop', 'genesis_do_loop');

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_action('genesis_loop', 'single_gallery_loop');

function single_gallery_loop() {

    $gallery_args = array(
		'post_type'  => 'image_gallery',
		'orderby'=> 'menu_order',
		'order', 'ASC',
	);

	$gallery = new WP_Query($gallery_args);

	if ($gallery -> have_posts()) {
		get_template_part( '/includes/single-gallery' );
	}

	// remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

}

genesis();