<?php

namespace App;
/* --------------------------------------------------- */
/* ---------------  CONFIGURATION -------------------- */
/* --------------------------------------------------- */

function my_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // --- menus
    register_nav_menu('header', 'Entête du menu');
    register_nav_menu('footer', 'Footer du site');

    // --- images
    //add_image_size( 'custom-size', 500, 500, true); //exemple
    //remove_image_size('medium'); //supprimer un format d'image
    add_image_size('post-thumbnail', 350, 215, true); //true = crop
}

function my_register_assets()
{
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap');

    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [], false, true); //true = in footer
    //wp_deregister_script('jquery'); //permet de ne pas charger le Jquery généré par wordpress
    //wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
    wp_enqueue_script('bootstrap');
}

/* CALL FUNCTIONS */
add_action('after_setup_theme', 'App\my_supports'); //appel la fonction my_supports()
add_action('wp_enqueue_scripts', 'App\my_register_assets');

/* ---------------------- FIN ------------------------ */
/* ---------------  CONFIGURATION -------------------- */
/* --------------------------------------------------- */



/* --------------------------------------------------- */
/* ------------------  FILTERS ----------------------- */
/* --------------------------------------------------- */
function myfilter_title($title)
{
    return $title;
    //return "Titre" . $title;
}

function myfilter_title_separator()
{
    return ' - ';
}

function myfilter_document_title_part($title)
{
    //unset($title['tagline']); //supprime la tagline du titre
    return $title;
}

function myfilter_nav_menu_css_class(array $classes)
{
    //var_dump(\func_get_args()); die;
    $classes[] = 'nav-item';
    return $classes;
}

function myfilter_nav_menu_link_attributes($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

add_filter('wp_title', 'App\myfilter_title');
add_filter('document_title_separator', 'App\myfilter_title_separator');
add_filter('document_title_parts', 'App\myfilter_document_title_part');
add_filter('nav_menu_css_class', 'App\myfilter_nav_menu_css_class');
add_filter('nav_menu_link_attributes', 'App\myfilter_nav_menu_link_attributes');

/* ---------------------- FIN ------------------------ */
/* ------------------  FILTERS ----------------------- */
/* --------------------------------------------------- */



/* --------------------------------------------------- */
/* ------------------  TAXONOMIES -------------------- */
/* --------------------------------------------------- */
//EXEMPLE DE TAXONOMIE
function my_init()
{
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true, //Affichage dans l'éditeur de bloc
        'hierarchical' => true, //checkbox
        'show_admin_column' => true, //Affiche une nouvelle colonne dans la list des posts
    ]);

    //AJOUTER DES TYPES DE POSTS
    \register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true,
    ]);
}

add_action('init', 'App\my_init');

/* ---------------------- FIN ------------------------ */
/* ------------------  TAXONOMIES -------------------- */
/* --------------------------------------------------- */

require_once('classes/classes-agence.php');
Amp\AgenceMenuPage::register(); //Attention avec les namespaces

/* ------------------------------------------------- */
/* ------------------  META BOX -------------------- */
/* --------------------------------------------------*/
require_once('classes/classes-sponso-exemple.php');
Classes\SponsoMetaBox::register();

// AFFICHAGE DANS LA LISTE - CREATOPN DE LA COLONNE
add_filter('manage_post_posts_columns', function ($columns) { //POST pourrait-être remplacé par bien ou autre type de post
    $newColumns = [];
    foreach ($columns as $k => $v) {
        if ($k === 'date') {
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
});

add_filter(
    'manage_post_posts_custom_column',
    function ($column, $postId) {
        if ($column === 'sponso') {
            if (!empty(get_post_meta($postId, Classes\SponsoMetaBox::META_KEY, true))) {
                $class = 'yes';
            } else {
                $class = 'no';
            }
            echo '<center><div class="bullet text-center ">' . $class . '</div></center>';
        }
    },
    10,
    2
);

/* ------------------------------------------------- */
/* ------------------  META BOX -------------------- */
/* --------------------------------------------------*/


/* ------------------------------------------------- */
/* ------------------  AUTRES ---------------------- */
/* --------------------------------------------------*/
function my_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages == null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="mt-4">';
    echo '<ul class="pagination">';

    foreach ($pages as $page) :
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    endforeach;

    echo '</ul>';
    echo '</nav>';
}
