<?php get_header(); ?>

    <main>
        <div class="container not-found">
            <div class="text-center">
                <h1><?php echo esc_html( theme_translate( '404: Page Not Found' ) ); ?></h1>
                <p><?php echo esc_html( theme_translate( 'Sorry, we can\'t find that page. It might have been moved or deleted.' ) ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php echo esc_html( theme_translate( 'Go to Homepage' ) ); ?></a>
                <a href="javascript:history.back()" class="btn btn-secondary"><?php echo esc_html( theme_translate( 'Go Back' ) ); ?></a>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
