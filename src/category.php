<?php get_header(); ?>
<div class="section">
    <div class="container section__container section__category">
        <?php  if (is_category()) { ?>

        <div class="category__title">
            <!--название категории-->
            <h1><?php single_cat_title(''); ?></h1>
        </div>
        <?php } ?>
        <div class="category__list">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="category__post" id="category__post-<?php the_ID(); ?>">
                <div class="category__header">
                <?php the_title(); ?>
                </div>
                <div class="category__data">
                    <div class="category__image">
                        <img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" class="category__image-pic">
                    </div>
                    <div class="category__text-and-button">
                        <div class="category__text">
                            <?php the_excerpt();?>
                        </div>
                        <div class="category__button">
                            <a class="category__link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>

            <div class="post" id="post-<?php the_ID(); ?>">
                <h2>Ничего не найдено</h2>
                <p>Вы можете воспользоваться формой поиска
                    <a href="#bottom_box">ниже</a>.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>