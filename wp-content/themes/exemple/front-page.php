<?= get_header() ?>

<div class="d-flex">
    <div class="p-3">
        <h1>Front page</h1>
        <p class="text-muted">J'ai juste repris la card post qui ne convient donc pas</p>
        <?php if (have_posts()) : ?>
            <?php
            //Liste les articles
            while (have_posts()) : ?>
                <?php the_post(); ?>
                <?php get_template_part('modules/post'); //Mieux 
                ?>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Page front</p>
        <?php endif ?>
    </div>
    <div class="">
        <?php get_sidebar('homepage'); ?>
    </div>
</div>


<?php get_footer(); ?>