<?php if ( has_post_thumbnail() ) : ?>
    <div class="carousel-item">
        <img class="d-block w-100" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
    </div>
<?php endif; ?>