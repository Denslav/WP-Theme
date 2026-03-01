<?php get_header(); ?>

    <main>
        <div class="container not-found">
            <div class="text-center">
                <h1><?php _e('404: Page Not Found', 'text-domain'); ?></h1>
                <p><?php _e('Sorry, we can\'t find that page. It might have been moved or deleted.', 'theme'); ?></p>
                <a href="<?php echo home_url(); ?>" class="btn btn-primary"><?php _e('Go to Homepage', 'theme'); ?></a>
                <a href="javascript:history.back()" class="btn btn-secondary"><?php _e('Go Back', 'theme'); ?></a>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
