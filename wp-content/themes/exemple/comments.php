<?php

use My\CommentWalker;

if (post_password_required()) {
    return;
}

$count = absint(get_comments_number());
if ($count > 0) :
?>
    <h2><?= $count ?> Commentaire<?= $count > 1 ? "s" : "" ?> </h2>


<?php else : ?>
    <h2>Laissez un commentaire</h2>
<?php endif; ?>

<div>
    <?php if (comments_open()) : ?>
        <?php comment_form(['title_replay' => '']); ?>
    <?php endif ?>
    <?php wp_list_comments(['style' => 'div', 'reverse_top_level' => true, 'walker' => new CommentWalker()]); ?>
    <?php paginate_comments_links(); ?>

</div><!-- #comments -->