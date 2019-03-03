<?php

//* Add custom body class to the head
add_filter( 'body_class', 'single_posts_body_class' );
function single_posts_body_class( $classes ) {
    $classes[] = 'custom-single-post';
    return $classes;

}

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'custom_single_loop');

function custom_single_loop() {

    // I think this is an incorrect loop
    $args = array(
        'post_type'  => 'post',
        'orderby'=> 'menu_order',
        'order', 'ASC',
    );

    $post = new WP_Query($args);

    if ($post -> have_posts()) {
        get_template_part( '/includes/single-post' );
    }
}



genesis();