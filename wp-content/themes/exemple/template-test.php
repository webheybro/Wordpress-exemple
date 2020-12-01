<?php

/**
 * Template Name: List Biens
 * Template Post Type: page, post
 */

//CUSTOM POST TYPE
/**
 * Créer une page bien avec le même url
 * Cela permettra de mettre le lien dans le menu
 * 
 */
get_header();
?>
poute
<?php
$query = new WP_Query([
    'post_not_in' => 1,
    'post_type' => 'biens',
    'posts_per_page' => 3,
    'orderby' => 'rand',
]);
while ($query->have_posts()) : $query->the_post();
?>
    <div class="col-sm-4">
        <?php get_template_part('modules/post'); ?>
    </div>
<?php endwhile; ?>


<?php get_footer(); ?>