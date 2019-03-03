<?php
/**
 * Portfolio Site.
 *
 * This file adds functions to the Play 2 Win Theme.
 * Customized version of the Genesis Sample Theme
 *
 * @package Portfolio Site
 * @author  Jabal Torres
 * @license GPL-2.0+
 * @link    https://www.portfolio-site.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'portfolio_site_localization_setup' );
function portfolio_site_localization_setup(){
	load_child_theme_textdomain( 'portfolio-site', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Portfolio Site' );
define( 'CHILD_THEME_URL', 'https://github.com/capitalJT/xyz.git' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'portfolio_site_enqueue_scripts_styles' );
function portfolio_site_enqueue_scripts_styles() {

	wp_enqueue_style( 'portfolio-site-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'portfolio-site-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'portfolio-site-responsive-menu',
		'genesis_responsive_menu',
		portfolio_site_responsive_menu_settings()
	);

}


//* JT - Replace default style sheet
//add_filter( 'stylesheet_uri', 'custom_replace_default_style_sheet', 10, 2 );
//function custom_replace_default_style_sheet() {
//    return CHILD_URL . '/custom.css';
//}


//* JT - Add Font Awesome
add_action( 'wp_enqueue_scripts', 'add_font_awesome_icons' );
function add_font_awesome_icons() {
    wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.7.0/css/all.css' );
}


//* JT - Add Chronicle font
//add_action( 'wp_enqueue_scripts', 'add_chronicle_font' );
//function add_chronicle_font() {
//    wp_enqueue_style( 'chronicle-font', 'https://cloud.typography.com/6548476/6599012/css/fonts.css' );
//}


//* JT - Load custom style sheet
add_action( 'wp_enqueue_scripts', 'custom_style_sheets' );
function custom_style_sheets() {
    wp_enqueue_style( 'custom-stylesheet-1', CHILD_URL . '/dist/css/main.css', array(), PARENT_THEME_VERSION );
	wp_enqueue_style( 'custom-stylesheet-2', CHILD_URL . '/dist/css/jt-styles.css', array(), PARENT_THEME_VERSION );
}

//* JT - Load custom scripts
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
function custom_scripts() {
	wp_enqueue_script( 'bootstrap-scripts', get_bloginfo( 'stylesheet_directory' ) . '/dist/js/vendor/bootstrap.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'custom-script', CHILD_URL . '/dist/js/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}

// Define our responsive menu settings.
function portfolio_site_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'portfolio-site' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'portfolio-site' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'portfolio-site' ), 'secondary' => __( 'Footer Menu', 'portfolio-site' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'portfolio_site_secondary_menu_args' );
function portfolio_site_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'portfolio_site_author_box_gravatar' );
function portfolio_site_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'portfolio_site_comments_gravatar' );
function portfolio_site_comments_gravatar( $args ) {
	$args['avatar_size'] = 60;
	return $args;
}


//* JT -  Add custom class to header.
add_filter( 'genesis_attr_site-header', 'portfolio_site_add_class' );
function portfolio_site_add_class( $attributes ) {
    $attributes['id'] = 'site-header';
//    $attributes['class'] = $attributes['class'] . ' portfolio-site-header';
    $attributes['class'] .= ' portfolio-site-header';
    return $attributes;
}


//* JT -  Register widget areas.
genesis_register_sidebar( array(
    'id'          => 'front-page-1',
    'name'        => __( 'Front Page 1', 'portfolio-site' ),
    'description' => __( 'This is the 1st section on the front page.', 'portfolio-site' ),
    'before_title'  => '<h3 class="widget-title d-none">',
    'after_title'   => '</h3>',
) );
genesis_register_sidebar( array(
    'id'          => 'front-page-2',
    'name'        => __( 'Front Page 2', 'portfolio-site' ),
    'description' => __( 'This is the 2nd section on the front page.', 'portfolio-site' ),
    'before_title'  => '<h3 class="widget-title d-none">',
    'after_title'   => '</h3>',
) );
genesis_register_sidebar( array(
    'id'          => 'front-page-3',
    'name'        => __( 'Front Page 3', 'portfolio-site' ),
    'description' => __( 'This is the 3rd section on the front page.', 'portfolio-site' ),
    'before_title'  => '<h3 class="widget-title d-none">',
    'after_title'   => '</h3>',
) );
genesis_register_sidebar( array(
    'id'          => 'front-page-4',
    'name'        => __( 'Front Page 4', 'portfolio-site' ),
    'description' => __( 'This is the 4th section on the front page.', 'portfolio-site' ),
    'before_title'  => '<h3 class="widget-title d-none">',
    'after_title'   => '</h3>',

) );
genesis_register_sidebar( array(
    'id'          => 'front-page-5',
    'name'        => __( 'Front Page 5', 'portfolio-site' ),
    'description' => __( 'This is the 5th section on the front page.', 'portfolio-site' ),
    'before_title'  => '<h3 class="widget-title d-none">',
    'after_title'   => '</h3>',
) );


//* JT - Customize the entire footer
//remove_action( 'genesis_footer', 'genesis_do_footer' );
//add_action( 'genesis_footer', 'sp_custom_footer' );
//function sp_custom_footer() {
//    ?>
<!--    <p>&copy; --><?php //echo date("Y"); ?><!-- <a href="http://portfolio-site.com/">Portfolio Site</a> &middot; All Rights Reserved</p>-->
<!--    --><?php
//}


//* JT - Add widget before blog roll
genesis_register_sidebar( array(
    'id' => 'before-blog',
    'name' => __( 'Before Blog Widget', 'wpsites' ),
    'description' =>  __( 'This is the before post widget area on the blog page only.', 'wpsites' )
) );
add_action( 'genesis_before_loop', 'wpsites_before_blog_widget', 9 );
function wpsites_before_blog_widget() {
    $classes = get_body_class();
    if (in_array('blog',$classes)) {
        genesis_widget_area( 'before-blog', array(
            'before' => '<div class="before-blog widget-area">',
            'after'  => '</div>'
        ) );
    }
}


/* JT - Add next/previous post links on single posts
*  https://eugenoprea.com/code-snippets/genesis-how-to-add-previousnext-post-navigation/
*  This ignores menu order by Post Types Order plugin
----------------------------------------------------------------------------------------*/
//add_action( 'genesis_after_loop', 'jt_prev_next_post_nav' );
//function jt_prev_next_post_nav() {
//    if ( is_single() ) {
//        echo '<div class="pagination border border-light p-4 my-2 ">';
//            previous_post_link( '<div class="previous">Previous: %link</div>', '%title' );
//            next_post_link( '<div class="next ml-auto">Next: %link</div>', '%title' );
//        echo '</div><!-- .prev-next-navigation -->';
//    }
//}



/* JT- Make Archives.php Include Custom (XYZ) Post Types
* https://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
----------------------------------------------------------------------------------------*/
//function jt_add_custom_types( $query ) {
//    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
//        $query->set( 'post_type', array(
//            'post', 'nav_menu_item', 'xyz'
//        ));
//        return $query;
//    }
//}
//add_filter( 'pre_get_posts', 'jt_add_custom_types' );



/* JT - Adding custom post types to archive.php
/* https://wordpress.stackexchange.com/questions/179023/adding-custom-post-types-to-archive-php
----------------------------------------------------------------------------------------*/
add_action('pre_get_posts', 'query_post_type');
function query_post_type($query) {
    if($query->is_main_query()
        && ( is_category() || is_tag() )) {
        $query->set( 'post_type', array('post','xyz', 'abc') );
    }
}

/* JT -Code to Display Featured Image on top of the post */
//add_action( 'genesis_entry_content', 'featured_post_image', 8 );
//function featured_post_image() {
//	the_post_thumbnail('post-image');
//}


//function my_custom_posts_per_page( $query ) {
//    if (!is_admin() && post_type_exists('xyz') )
//        $query->set( 'posts_per_page', 3 );
//}
//add_filter('parse_query', 'my_custom_posts_per_page');