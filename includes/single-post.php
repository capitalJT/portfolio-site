<div class="single-post-pd border border-light p-4">
    <header class="entry-header">
        <h1 class="entry-title h3" itemprop="headline"><?php echo the_title();?></h1>
    </header>

    <?php while ( have_posts() ) : the_post(); ?>
        <article class="single-post-pd">

	        <?php if ( has_post_thumbnail() ) { ?>
		        <?php the_post_thumbnail(); ?>
                    <!-- HAVE THUMBNAIL DO SOMETHING  -->
		        <?php
	        }else{
		        ?>
                    <!-- DOESN'T HAVE THUMBNAIL : DO SOMETHING ELSE -->
		        <?php
	        }
	        ?>

            <div class="single">
                <?php the_content(); ?>
            </div>

	        <?php if(has_tag()): ?>
                <div class="tags border border-light mb-4 p-4">
			        <?php the_tags( '<div class="tags">Tagged With: ', ', ', '</div>' ); ?>
                </div>
	        <?php endif; ?>

            <?php echo edit_post_link('(Edit)', '<span class="btn btn-lg btn-warning my-2">', '</span>'); ?>
        </article>
    <?php endwhile; ?>
</div>