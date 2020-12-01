<div class="card">
    <div class="card-header">
        <?php the_title(); ?>
    </div>
    <div style="max-height:200px;" class="overflow-hidden"><?php the_post_thumbnail('post-medium', ['class' => 'card-img-top', 'alt' => 'Mon image', 'style' => 'height:auto;']) ?></div>
    <div class="card-body">
        <?php the_excerpt() ?>
        <ul><?php the_terms(get_the_ID(), 'sport', '<li>', '</li><li>', '</li>') ?></ul>
        <a href="<?php the_permalink() ?>" class="btn btn-primary py-1">Afficher</a>
    </div>
</div>