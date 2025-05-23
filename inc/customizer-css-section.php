<?php
/**
 * Egyedi CSS hozzáadása a WordPress Customizer-hez
 */
function spfood_customizer_custom_css($wp_customize) {
    // Új szekció hozzáadása a Customizer-hez
    $wp_customize->add_section('custom_css_section', array(
        'title'      => __('Egyedi CSS', 'spfood'),
        'priority'   => 200,
        'description' => __('Itt adhatod meg az egyedi CSS kódokat, amelyek a weboldaladon jelennek meg.', 'spfood'),
    ));

    // CSS beállítás hozzáadása
    $wp_customize->add_setting('custom_css_setting', array(
        'default'           => '.selected-item {
    border: 1px solid #0556f2;
    border-radius: 8px;
    background: yellow;
    padding: 15px;
    box-shadow: 10px 10px 20px;
    margin-bottom: 25px;
    animation: light-up 0.4s ease-out;
}

@keyframes light-up {
    0% { 
        background-color: transparent;
        box-shadow: inset 0 0 0 0 #fff; 
    }
    100% { 
        background-color: #ffe404;
        box-shadow: inset 0 0 0 7px #fff; 
    }
}',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_strip_all_tags',
    ));

    // Kontrol hozzáadása
    $wp_customize->add_control('custom_css_control', array(
        'label'    => __('Egyedi CSS kód', 'spfood'),
        'section'  => 'custom_css_section',
        'settings' => 'custom_css_setting',
        'type'     => 'textarea',
        'description' => __('Add meg az egyedi CSS kódot. Például a kiválasztott elemek formázásához:', 'spfood'),
    ));
}
add_action('customize_register', 'spfood_customizer_custom_css');

/**
 * Egyedi CSS kód hozzáadása a frontend-hez
 */
function spfood_output_custom_css() {
    $custom_css = get_theme_mod('custom_css_setting');
    if (!empty($custom_css)) {
        echo '<style type="text/css">' . wp_strip_all_tags($custom_css) . '</style>';
    }
}
add_action('wp_head', 'spfood_output_custom_css', 999);