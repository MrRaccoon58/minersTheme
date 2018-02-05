<?php get_header(); ?>
<section class="section">
	<div class="container section__container">
		<div class="main-heading">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
		<div class="section__content">
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>