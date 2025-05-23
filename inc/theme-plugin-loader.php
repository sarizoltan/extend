<?php
/**
 * Customizer Export/Import plugin betöltése a témából
 */
function spfood_load_customizer_export_import() {
    // Plugin elérési útja a témában
    $plugin_path = get_template_directory() . '/inc/plugins/customizer-export-import/customizer-export-import.php';

    // Ellenőrizzük, hogy létezik-e a plugin fájl
    if (file_exists($plugin_path)) {
        // Betöltjük a plugin fájlt
        require_once $plugin_path;
    }
}
add_action('after_setup_theme', 'spfood_load_customizer_export_import');

/**
 * Recent Posts Widget Extended plugin betöltése a témából
 */
function spfood_load_recent_posts_widget_extended() {
    // Plugin elérési útja a témában
    $plugin_path = get_template_directory() . '/inc/plugins/recent-posts-widget-extended/rpwe.php';

    // Ellenőrizzük, hogy létezik-e a plugin fájl
    if (file_exists($plugin_path)) {
        // Betöltjük a plugin fájlt
        require_once $plugin_path;
    }
}
add_action('after_setup_theme', 'spfood_load_recent_posts_widget_extended');