<?php
/**
 * Template for displaying search results
 */

get_header();
?>

<main id="primary" class="site-main search">

    <div class="container">

        <?php if ( have_posts() ) : ?>

            <header class="search__header">
                <h1 class="search__title">
                    <?php
                    printf(
                        esc_html__( 'Search results for: %s', 'main' ),
                        '<span>' . esc_html( get_search_query() ) . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <div class="search__results">

                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'search__item' ); ?>>

                        <h2 class="search__item-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="search__item-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                    </article>

                <?php endwhile; ?>

            </div>

            <div class="search__pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__( '← Previous', 'main' ),
                    'next_text' => esc_html__( 'Next →', 'main' ),
                ) );
                ?>
            </div>

        <?php else : ?>

            <div class="search__empty">
                <h2><?php esc_html_e( 'Nothing found', 'main' ); ?></h2>
                <p><?php esc_html_e( 'Try searching again with different keywords.', 'main' ); ?></p>

                <?php get_search_form(); ?>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php
get_footer();