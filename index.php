<?php get_header(); ?>
<main>
    <div class="container">
        <div class="wrapper">
            <div class="heading">
			    <?php the_title('<h1>', '</h1>'); ?>
            </div>
		    <?php if ( have_posts() ): ?>
                <div class="content">
				    <?php while ( have_posts() ):
					    the_post(); ?>
					    <?php get_template_part( 'parts/loops/loop', 'post' );?>
				    <?php endwhile; ?>
                </div>
		    <?php endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
