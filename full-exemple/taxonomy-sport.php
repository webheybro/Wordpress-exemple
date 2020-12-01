<?= get_header() ?>

<h1><?= esc_html(get_queried_object()->name) ?></h1>
<p><?= esc_html(get_queried_object()->description) ?></p>

<?php get_template_part('modules/sports-list'); ?>

<?php if (have_posts()) : ?>

    <div class="row">
        <?php
        while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="col-sm-4">
                <?php
                get_template_part('modules/post'); //Mieux
                //get_template_part('parts/post', 'card'); //Si il trouve un ficher post-card il l'affiche, sinon il affichera post
                ?>
            </div>
        <?php endwhile; ?>
    </div>

    <?php App\my_pagination(); ?>
<?php else : ?>
    <p>Pas d'articles</p>
<?php endif ?>
<?php get_footer(); ?>