<?php get_header(); ?>
<main>
    <div class="container">
        <div class="wrapper">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-' . get_post_type() ); ?>>
                <div class="heading">
				    <?php the_title('<h1>', '</h1>'); ?>
                </div>
			    <?php if ( has_post_thumbnail() ): ?>
                    <div class="thumbnail">
					    <?php the_post_thumbnail(); ?>
                    </div>
			    <?php endif; ?>
                <div class="content">
				    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </div>
</main>
<?php get_footer(); ?>
