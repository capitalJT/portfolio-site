<?php
/**
 * Template Name: Galleries Template
 */

// Include custom header
include ('includes/custom-page-header.php');


add_action('genesis_loop', 'gallery_loop');
function gallery_loop(){
    $args = array(
        'post_type' => 'galleries',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    $galleries = new WP_Query( $args );
    echo '<div id="galleries" class="container p-0">';
		echo '<div class="gallery row">';
		    while ( $galleries->have_posts() ) : $galleries->the_post();
		            echo '<div class="gallery-thumb col-12 col-md-4 mb-5">';
//		                the_post_thumbnail('medium');
			            echo '<a class="card" href="' . get_permalink() . '">';
			                the_post_thumbnail('large');
			                echo '<div class="overlay"><h1 class="entry-title">' . get_the_title() . '</h1></div>';
			            echo'</a>';
		            echo '</div>';
//		            echo '<div class="entry-content">';
//		                 the_content();
//		            echo '</div>';
		    endwhile;
		echo '</div><!-- end .gallery.row -->';
    echo '</div><!-- end .galleries -->';
}


// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );

function add_body_class( $classes ) {
	$classes[] = 'custom-page-template';
	return $classes;
}


genesis();