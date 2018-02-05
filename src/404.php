<?php get_header(); ?>
<section class="section">
	<div class="container section__container">
		<div class="main-heading">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
		<div class="section__content">
            <h3>Нет такой страницы! Ж(</h3>
            <h4><a href="<?php echo home_url();  ?>">Вернуться на главную</a></h4>
		</div>
	</div>
</section>
<?php get_footer(); ?>