<?php

/**
Template Name: Custom
Description: Custom page template that adds featured img as title bg img
 */

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );

function add_body_class( $classes ) {
	$classes[] = 'custom-page-template';
	return $classes;
}

// Include custom header
include ('includes/custom-page-header.php');


genesis();