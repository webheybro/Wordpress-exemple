<?php
// LIST DES CATEGORIES PLUS PERSONNALISE
$sports = get_terms(['taxonomy' => 'sport']);
if (is_array($sports)) {
?>
    <ul class="nav nav-pills mt-3">
        <?php foreach ($sports as $sport) : ?>
            <li class="nav-item"><a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php } ?>