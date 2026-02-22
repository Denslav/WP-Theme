<?php get_header(); ?>
<main>
	<div class="container">
		<div class="wrapper">
            <h1 class="headline"><?php echo get_the_archive_title(); ?></h1>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'parts/loops/loop', 'post' ); ?>
				<?php endwhile;
				thm_pagination();
				?>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>