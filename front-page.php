 <?php
/**
 * Portfolio Site.
 *
 * This file adds the front page to the Atmosphere Pro Theme.
 *
 * Template Name: Front Page
 *
 * @package portfolio_site
 * @author  Jabal Torres
 * @license GPL-2.0+
 * @link    https://github.com/capitalJT/xyz.git
 */

add_action( 'genesis_meta', 'portfolio_site_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function portfolio_site_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' ) ) {

		// Add Custom body class
		add_filter( 'body_class', 'portfolio_site_body_class' );

		// Remove breadcrumbs.
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Remove the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add homepage widgets.
		add_action( 'genesis_loop', 'portfolio_site_front_page_widgets' );

	}

}


// Define front-page body class.
function portfolio_site_body_class( $classes ) {
	$classes[] = 'portfolio-site-front-page';
	return $classes;
}


// Add markup for front page widgets.
function portfolio_site_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', 'portfolio-site' ) . '</h2>';

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1 front-page-widget"><div class="widget-area"><div class="bg-white">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2 front-page-widget"><div class="widget-area"><div class="bg-primary">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3 front-page-widget"><div class="widget-area"><div class="bg-white">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4 front-page-widget mb-4"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

    genesis_widget_area( 'front-page-5', array(
        'before' => '<div id="front-page-5" class="front-page-5 front-page-widget"><div class="widget-area"><div class="bg-primary">',
        'after'  => '</div></div></div>',
    ) );

}


// Custom loop for homepage carousel
add_action('genesis_before_content', 'homepage_carousel_loop');

function homepage_carousel_loop(){
 /* START - Homepage Carousel Loop */
 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 $homepage_imgs_args = array(
	 'post_type'  => 'home_carousel_imgs',
	 'posts_per_page' => 5,
	 'paged' => $paged,
	 'page' => $paged,
	 'orderby'=> 'date',
	 'order', 'DESC',
 );

	$homepage_carousel_imgs = new WP_Query($homepage_imgs_args);

	// get_template_part( '/includes/xyz_header' );

	if ($homepage_carousel_imgs -> have_posts()) {

	 echo '<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">';

	    echo '<div class="carousel-inner">';
			 while($homepage_carousel_imgs -> have_posts()): $homepage_carousel_imgs ->the_post();
				 get_template_part( '/includes/homepage-carousel-imgs' );
			 endwhile;
	    echo '</div>';

		 echo '<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">';
		    echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span';
		    echo '<span class="sr-only">Previous</span>';
		 echo '</a>';

		 echo '<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">';
		    echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
		    echo '<span class="sr-only">Next</span>';
		 echo '</a>';

	 echo '</div><!-- end #carouselExampleFade -->';

	}
 /* END - Homepage Carousel Loop */
}

// Run the Genesis loop.
genesis();


