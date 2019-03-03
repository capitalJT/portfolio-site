<div class="single-gallery-cpt border border-light p-4">

    <div class="entry-content">

        <?php while ( have_posts() ) : the_post(); ?>
            <header class="entry-header">
                <h1 class="entry-title h3" itemprop="headline"><?php echo the_title();?></h1>
            </header>

            <article class="single-gallery">
                <div class="gallery-content">
                    <?php the_content(); ?>
                </div>

                <?php if(has_tag()): ?>
                    <div class="tags border border-light mb-4 p-4">
		                <?php the_tags( '<div class="tags">Tagged With: ', ', ', '</div>' ); ?>
                    </div>
                <?php endif; ?>


                <?php echo edit_post_link('(Edit)', '<span class="btn btn-lg btn-warning my-2">', '</span>'); ?>
            </article><!-- end .single-gallery -->

        <?php endwhile; ?>

    </div> <!--  end  -->

</div><!-- end .single-gallery-cpt -->

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<script>
    jQuery(function($) {
        // https://masonry.desandro.com/layout.html
        // https://masonry.desandro.com/extras.html#bootstrap
        $(document).ready(function() {
            var $grid = $('.wp-block-gallery').masonry({
                itemSelector: '.blocks-gallery-item',
                // columnWidth: 200,
                percentPosition: true,
                transitionDuration: 750,
                isAnimated: true,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });

            $grid.imagesLoaded().progress( function() {
                $grid.masonry('layout');
            });
        });

        console.log("live from the gallery page");
    });

</script>





