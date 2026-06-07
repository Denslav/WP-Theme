<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-' . get_post_type() ); ?>>
    <div class="post-wrapper">
        <?php if ( has_post_thumbnail() ): ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif; ?>
        <div class="post-content">
            <h3 class="post-content__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="post-content__excerpt">
                <?php the_excerpt(); ?>
            </div>
            <a class="post-content__more" href="<?php the_permalink(); ?>">
                <?php echo esc_html( theme_translate( 'Read more' ) ); ?>
            </a>
        </div>
    </div>
</article>