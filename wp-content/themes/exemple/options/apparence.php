<?php
add_action('customize_register', function (WP_Customize_Manager $manager) {
    $manager->add_section('my_apparence', [
        'title' => "Personnalisation de l'apparence"
    ]);

    $manager->add_setting('header_background', [
        'default' => "#FF0000",
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color', //permet de vérifier les données
    ]);

    /*     $manager->add_control('header_background', [
        'section' => "my_apparence",
        'setting' => 'header_background',
        'label' => 'Couleur de l\'entête'
    ]); */

    $manager->add_control(new WP_Customize_Color_Control($manager, 'header_background', [
        'section' => "my_apparence",
        'label' => 'Couleur de l\'entête'
    ]));
});


add_action('customize_preview_init', function () {
    wp_enqueue_script('my_apparence', get_template_directory_uri() . '/assets/apparence.js', ['jquery', 'customize-preview'], '', true);
});
