<?php get_header(); ?>

<main id="page-<?php echo esc_attr( get_the_ID() ); ?>" class="page page-<?php echo esc_attr( get_post_field( 'post_name', get_queried_object_id() ) ); ?>">
    <div class="container">

        <div class="page-header">
            <h1 class="page-header__title"><?php the_title(); ?></h1>
        </div>

        <div class="page__content">
            <?php the_content(); ?>
        </div>
		
    </div>
</main>

<?php get_footer(); ?>