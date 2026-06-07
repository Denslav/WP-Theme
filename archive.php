<?php get_header(); ?>
	<main>
		<div class="container">
			<div class="wrapper">
				<h1 class="headline"><?php echo get_the_archive_title(); ?></h1>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'parts/loops/loop', 'post' ); ?>
					<?php endwhile; ?>
					<div class="pagination">
						<?php
						the_posts_pagination(
							[
								'prev_text' => esc_html( theme_translate( 'Назад' ) ),
								'next_text' => esc_html( theme_translate( 'Вперед' ) ),
							]
						);
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main>
<?php get_footer(); ?>