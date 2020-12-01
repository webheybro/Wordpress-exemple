<?php

/** 
 * Plugin Name: Customs Type Biens
 */
defined('ABSPATH') or die('rien à voir');

register_activation_hook(__FILE__, function () {
    // Je suis activé
    touch(__DIR__ . '/demo.txt');
});

register_deactivation_hook(__FILE__, function () {
    // Je suis désactivé
    unlink(__DIR__ . '/demo.txt');
});

//AJOUTER DES TYPES DE POSTS
add_action('init', function () {
    \register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => false,
        'has_archive' => true,
    ]);
});
/**
 * 
Lorsque l'on crée un thème pour un site il peut être intéressant de séparer certaines fonctionnalités dans un plugin 
afin de pouvoir les conserver en cas de changement de thème ou pour les rendre réutilisable de projet en projet. 
Un plugin fonctionne comme un thème et peut utiliser toutes les fonctionnalités que l'on a vu jusqu'à maintenant. 
 */

//si pas connecté, on désactive l'accès à l'api REST
add_filter('rest_authentication_errors', function ($result) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if (true === $result || is_wp_error($result)) {
        return $result;
    }
    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    if (!is_user_logged_in()) {
        return new WP_Error(
            'rest_not_logged_in',
            __('You are not currently logged in.'),
            array('status' => 401)
        );
    }
    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});
