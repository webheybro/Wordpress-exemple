<?php
//CUSTOM POST TYPE
/**
 * Créer une page bien avec le même url
 * Cela permettra de mettre le lien dans le menu
 * 
 */
?>
<?= get_header() ?>
<h1>LIST DES BIENS</h1>
<?php if (have_posts()) : ?>
    <div class="row">
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="col-sm-4">
                <?php get_template_part('modules/post'); ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php App\my_pagination(); ?>
<?php else : ?>
    <p>Pas d'articles</p>
<?php endif ?>
<?php get_footer(); ?>