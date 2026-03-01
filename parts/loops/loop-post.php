<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-' . get_post_type() ); ?>>
    <div class="post-wrapper">
        <?php if ( has_post_thumbnail() ): ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif; ?>
        <div class="post-content">
            <?php the_title( '<h3>', '</h3>' ); ?>
            <?php the_content(); ?>
            <a href="<?php ?>"><?php _e( 'Read More', 'theme' ) ?></a>
        </div>
    </div>
</article>