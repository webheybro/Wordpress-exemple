<?= get_header() ?>
<h1>Un article</h1>
<?php if (have_posts()) : ?>
    <?php the_post(); ?>
    <div class="card">
        <div class="card-header">
            <?php the_title(); ?>

            <h4>Article lié à la catégorie :</h4>
            <ul><?php the_terms(get_the_ID(), 'sport', '<li>', '</li><li>', '</li>') ?></ul>
        </div>
        <div class="overflow-hidden">
            <img src="<?php the_post_thumbnail_url(); ?>" style="width:100%; height:auto;" />
        </div>
        <div class="card-body">
            <?php the_content() ?>
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
        </div>
    </div>







    <hr class="my-4" />
    <h4>Article lié à la catégorie :</h4>
    <div class="row">
        <?php
        $sports = array_map(function ($term) {
            return $term->term_id;
        }, get_the_terms(get_post(), 'sport'));

        $query = new WP_Query([
            'post__not_in' => [get_the_ID()],
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'tax_query' => [
                [
                    'taxonomy' => 'sport',
                    'terms' => $sports
                ]
            ],
            'meta_query' => [
                [
                    'key' => 'is_sponso',
                    'compare' => 'NOT EXISTS'
                ]
            ]

        ]);
        while ($query->have_posts()) : $query->the_post();
        ?>
            <div class="col-sm-4">
                <?php get_template_part('modules/post', 'post'); ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p>Pas d'articles</p>
<?php endif ?>




<?php get_footer(); ?>