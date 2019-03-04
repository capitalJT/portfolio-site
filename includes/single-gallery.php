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






