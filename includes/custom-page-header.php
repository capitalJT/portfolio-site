<?php

// Hook after header area
add_action( 'genesis_after_header', 'custom_header_w_img' );

function custom_header_w_img() {
	// If it is a page and has a featured thumbnail, but is not the front page do the following...

	$featured_class = 'custom-page-header';

	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

	add_action( 'ai_featured_title', 'genesis_entry_header_markup_open', 5 );
	add_action( 'ai_featured_title', 'genesis_entry_header_markup_close', 15 );
	add_action( 'ai_featured_title', 'genesis_do_post_title');

	if (has_post_thumbnail() ) {

		// Get featured image attachment and its different sizes
		$image_desktop = wp_get_attachment_image_src( get_post_thumbnail_id(  $post_id ), 'large' )[0];
		$image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id(  $post_id ), 'medium' )[0];

		$image_desktop_size = wp_get_attachment_image_src( get_post_thumbnail_id(  $post_id ), 'large' )[2];
		//$image_mobile_size = wp_get_attachment_image_src( get_post_thumbnail_id(  $post_id ), 'medium' )[2];

		?>

		<div class='container <?php echo $featured_class; ?>'>
			<div class="featured-title-wrapper">
				<?php do_action('ai_featured_title'); ?>

				<?php if( get_field('custom_subhead') ): ?>
					<div class="custom-subhead h2 white"><?php the_field('custom_subhead'); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<style>
			<?php echo ".$featured_class "; ?> {
				background-image:url( <?php echo $image_mobile; ?>);
			}

			@media only screen and (min-width : 768px) {
                <?php echo ".$featured_class "; ?> {
                    background-image:url(<?php echo $image_desktop;?>);
                    max-height:<?php echo $image_desktop_size . "px"; ?>;
                }
			}
		</style>

		<?php

	} else { ?>

		<?php // Provide default image if featured image attachment is not available ?>

		<div class='container <?php echo $featured_class; ?>'>
			<div class="featured-title-wrapper">
				<?php do_action('ai_featured_title'); ?>

				<?php if( get_field('custom_subhead') ): ?>
					<div class="custom-subhead h2 white"><?php the_field('custom_subhead'); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<style>
			<?php echo ".$featured_class "; ?> {
				background-image:url( "<?php echo get_stylesheet_directory_uri(); ?>/dist/images/default-image.png");
			}
		</style>

		<?php
	}
}