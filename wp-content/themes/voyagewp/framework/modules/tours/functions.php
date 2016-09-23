<?php

if(!function_exists('voyage_mikado_load_tours_assets')) {
    /**
     * Loads all necessary assets for tours plugin
     */
    function voyage_mikado_load_tours_assets() {
        wp_enqueue_style('voyage_mikado_tours', MIKADO_ASSETS_ROOT.'/css/tours.min.css', array('voyage_mikado_modules'));

        if(voyage_mikado_is_responsive_on()) {
            wp_enqueue_style('voyage_mikado_tours_responsive', MIKADO_ASSETS_ROOT.'/css/tours-responsive.min.css', array('voyage_mikado_modules'));
        }

    }

    add_action('wp_enqueue_scripts', 'voyage_mikado_load_tours_assets');
}