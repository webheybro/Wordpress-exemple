<?= get_header() ?>
<h1>All pages BIEN</h1>

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

  <?php
  /**
   * EXEMPLE WP_QUERY
   $query = new WP_Query([
  'post__not_in' => 1,
  'post_type' => 'post',
  'posts_per_page' => 3,
  'orderby' => 'rand',
  'tax_query' => [
    [
      'taxonomy' => 'sport',
      'terms' => [1, 10, 3]
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
    <?php get_template_part('parts/card', 'post'); ?>
  </div>
<?php endwhile; wp_reset_postdata(); 

   */
  ?>


<?php else : ?>
  <p>Pas d'articles</p>
<?php endif ?>




<?php get_footer(); ?>