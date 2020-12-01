<?= get_header() ?>
<h1>All pages</h1>
<?php if (have_posts()) : ?>
    <?php the_post(); ?>
    <div class="card">
        <div class="card-header">
            <?php the_title(); ?>
        </div>
        <div class="overflow-hidden">
            <img src="<?php the_post_thumbnail_url(); ?>" style="width:100%; height:auto;" />
        </div>
        <div class="card-body">
            <?php the_content() ?>
            <ul><?php the_terms(get_the_ID(), 'sport', '<li>', '</li><li>', '</li>') ?></ul>
            <a href="<?php the_permalink() ?>" class="btn btn-primary">Link</a>
        </div>
    </div>
<?php else : ?>
    <p>Pas d'articles</p>
<?php endif ?>




<?php get_footer(); ?>