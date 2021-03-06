<?php 
namespace App;
/* --------------------------------------------------- */
/* ---------------  CONFIGURATION -------------------- */
/* --------------------------------------------------- */
function my_supports() {
    add_theme_support('title-tag');
    add_theme_support( 'post-thumbnails' );
    
    // --- menus
    register_nav_menu('header','Entête du menu');
    register_nav_menu('footer','Footer du site');

    // --- images
    //add_image_size( 'custom-size', 500, 500, true); //exemple
    //remove_image_size('medium'); //supprimer un format d'image
    add_image_size( 'post-thumbnail', 350, 215, true); //true = crop
}

function my_register_assets (){
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
    wp_enqueue_style( 'bootstrap' );

    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', ['popper','jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [], false, true); //true = in footer
    //wp_deregister_script('jquery'); //permet de ne pas charger le Jquery généré par wordpress
    //wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
    wp_enqueue_script( 'bootstrap' );
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
function myfilter_title($title){
    return "hp ".$title;
}

function myfilter_title_separator(){
    return ' - ';
}

function myfilter_document_title_part($title){
    return $title;
}
function myfilter_nav_menu_css_class(array $classes){
    //var_dump(\func_get_args()); die;
    $classes[] = 'nav-item';
    return $classes;
}
function myfilter_nav_menu_link_attributes($attrs){
    $attrs['class'] = 'nav-link';
    return $attrs;
}

add_filter('wp_title', 'App\myfilter_title');
add_filter('document_title_separator', 'App\myfilter_title_separator');
add_filter('document_title_parts', 'App\myfilter_document_title_part');
add_filter('nav_menu_css_class', 'App\myfilter_nav_menu_css_class');
add_filter('nav_menu_link_attributes', 'App\myfilter_nav_menu_link_attributes');

/* --------------------- FIN ------------------------- */
/* ------------------  FILTERS ----------------------- */
/* --------------------------------------------------- */