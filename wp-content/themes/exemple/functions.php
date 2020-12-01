<?php

namespace App;

use App\Classes\SponsoMetaBox;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use YoutubeWidget;

require_once('walker/CommentWalker.php');
require_once('options/apparence.php');
require_once('options/cron.php'); //à creuser


/* ------------------------------------------------- */
/* -------------- PLUGINS INTERESSANTS ------------- */
/* ------------------------------------------------- */
// W3 Total Cache
// Query Monitor
// WP Migrate DB – WordPress Migration Made Easy 
//Advanced Custom Fields : Elliot Condon



/* --------------------------------------------------- */
/* ---------------  CONFIGURATION -------------------- */
/* --------------------------------------------------- */

function my_supports()
{
    add_theme_support('title-tag');
    add_theme_support(
        'post-thumbnails'
    );
    add_theme_support('html5');

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

    if (!is_customize_preview()) {
        wp_deregister_script('jquery'); //permet de ne pas charger le Jquery généré par wordpress
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
    }
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


    //section ajouté comme plugin (wp-content/plugins)
    //AJOUTER DES TYPES DE POSTS
    /*     \register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true,
    ]); */
}

add_action('init', 'App\my_init');

/* ---------------------- FIN ------------------------ */
/* ------------------  TAXONOMIES -------------------- */
/* --------------------------------------------------- */




/* ---------------------------------------------------- */
/* ------------ Initialisation des terms -------------- */
/* -----------------------------------------------------*/
add_action('after_switch_theme', function () {
    flush_rewrite_rules(); //Permet de nettoyer les regles d'écritures
    wp_insert_term('Volleyball', 'sport');
    wp_insert_term('Watu', 'sport');
});
add_action('switch_theme', 'flush_rewrite_rules');
/* ---------------------- FIN ------------------------ */
/* ------------ Initialisation des terms ------------- */
/* ----------------------------------------------------*/




/* ------------------------------------------------- */
/* ------------------  OPTIONS --------------------- */
/* --------------------------------------------------*/
//add_options_page
require_once('classes/classes-agence.php');
Amp\AgenceMenuPage::register();
/* ---------------------- FIN ------------------------ */
/* ------------------  OPTIONS --------------------- */
/* --------------------------------------------------*/




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
/* ---------------------- FIN ---------------------- */
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
/* -------------------------------------------------- */
/* -----------------  PRE_GET_POSTS ----------------- */
/* ---------------------------------------------------*/
//Permet de faire passer des valeurs en GET
function my_pre_get_posts($query)
{
    if (is_admin() || !is_home() || !$query->is_main_query()) {
        return;
    }
    if (get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS'
        ];
        $query->set('meta_query', $meta_query);
    }
}


function my_query_vars($params)
{
    $params[] = 'sponso';
    return $params;
}

add_action('pre_get_posts', 'App\my_pre_get_posts');
add_filter('query_vars', 'App\my_query_vars');



/* -------------------------------------------- */
/* -----------------  SIDEBAR + WIDGETS----------------- */
/* ---------------------------------------------*/
require "widgets/YoutubeWidget.php";
function my_register_widget()
{
    //CREAT WIDGETS
    register_widget(YoutubeWidget::class);

    //SIDEBAR
    // plusieurs  = register_sidebars()
    register_sidebar([
        'id' => 'homepage',
        'name' => __('Sidebar Accueil', 'my'),
        'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="font-italic">',
        'after_title' => '</h4>'
    ]);
}

add_action('widgets_init', 'App\my_register_widget');



/* ---------------------------------------------------- */
/* ---------- Modifier affichage form COMMENTS -------- */
/* -----------------------------------------------------*/
add_filter('comment_form_default_fields', function ($fields) {
    $fields['email'] = <<<HTML
<div class="form-group"><label for="email">Email</label><input class="form-control" name="email" id="email" required /></div>
HTML;
    return $fields;
});



/* ---------------------------------- */
/* ---------- WPDB + PREPARE -------- */
/* ---------------------------------- */
/** @var wpdb $wpdb */
global $wpdb;
/* 
//$result = $wpdb->get_results("SELECT * FROM {$wpdb->terms} WHERE slug=\"skate\"", ARRAY_A);
//$result = $wpdb->get_row("SELECT * FROM {$wpdb->terms} WHERE slug=\"skate\"", ARRAY_A);
//$result = $wpdb->get_var("SELECT name FROM {$wpdb->terms} WHERE slug=\"skate\"");

A echapper
$tag = "skate";
$query = $wpdb->prepare("SELECT * FROM {$wpdb->terms} WHERE slug=%s", $tag);
$result = $wpdb->get_results($query); 
*/

/* ---------------------------------- */
/* ------------ REST - API ---------- */
/* ---------------------------------- */
// Api : https://developer.wordpress.org/rest-api
add_action('rest_api_init', function () {
    register_rest_route('my/v1', '/demo', [
        'methods' => 'GET',
        'callback' => function () {
            $response = new WP_REST_Response(['success' => 'Bonjour les gens ! ']);
            $response->set_status(201);
            return $response;
        },
        'permission_callback' => function () {
            return true;
        }
    ]);
    //exemple
    register_rest_route('my/v1', '/demo/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => function (WP_REST_Request $request) {
            $postID = (int)$request->get_param('id');
            $post = get_post($postID);
            if ($post === null) {
                return new WP_Error('Error', 'Déso ya pas ', ['status' => 404]);
            }
            return $post->post_title;
        }
    ]);
});

//autorise uniquement pour les routes my/v1 sans connexion
add_filter('rest_authentication_errors', function ($result) {
    if ($result === true || is_wp_error($result)) {
        return $result;
    }
    /** @var WP $wp */
    global $wp;
    if (strpos($wp->query_vars['rest_route'], 'my/v1') !== false) {
        return true;
    }
    return $result;
}, 9);




/* ---------------------------------- */
/* -------------- CACHE ------------- */
/* ---------------------------------- */
/**
 * Extensions : W3 Total Cache
 * Database Cache: enable
 */
function myreadData()
{
    $data = wp_cache_get('data', 'my');
    if ($data === false) {
        var_dump("on met en cache : ");
        $data = "on s'en fou juste du text";
        wp_cache_set('data', $data, 'my', 10);
    }
    return $data;
}

if (isset($_GET['cachetest'])) var_dump(myreadData());
