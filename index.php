<?php get_header(); ?>

<main>
    <div class="container">
        <div class="wrapper">

            <div class="heading">
                <?php if ( is_home() && ! is_front_page() ) : ?>

                    <h1><?php single_post_title(); ?></h1>

                <?php elseif ( is_search() ) : ?>

                    <h1>
                        <?php
                        printf(
                            esc_html( theme_translate( 'Search results: %s' ) ),
                            esc_html( get_search_query() )
                        );
                        ?>
                    </h1>

                <?php else : ?>

                    <h1><?php bloginfo( 'name' ); ?></h1>

                <?php endif; ?>
            </div>

            <?php if ( have_posts() ) : ?>

                <div class="content">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'parts/loops/loop', 'post' ); ?>
                    <?php endwhile; ?>
                </div>

                <div class="pagination">
                    <?php
                        the_posts_pagination( [
                            'prev_text' => esc_html( theme_translate( 'Previous' ) ),
                            'next_text' => esc_html( theme_translate( 'Next' ) ),
                        ] );
                    ?>
                </div>

            <?php else : ?>

            <p><?php echo esc_html( theme_translate( 'No posts found.' ) ); ?></p>

            <?php endif; ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>