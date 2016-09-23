<?php

if(!function_exists('voyage_mikado_register_widgets')) {

    function voyage_mikado_register_widgets() {

        $widgets = array(
            'VoyageMikadoLatestPosts',
            'VoyageMikadoSearchOpener',
            'VoyageMikadoSideAreaOpener',
            'VoyageMikadoSocialIconWidget',
            'VoyageMikadoSeparatorWidget',
            'VoyageMikadoCallToActionButton',
            'VoyageMikadoWeatherWidget'
        );

        if(voyage_mikado_tours_plugin_installed()) {
            $widgets[] = 'VoyageMikadoTourItems';
            $widgets[] = 'VoyageMikadoDestinationTours';
        }

        foreach($widgets as $widget) {
            register_widget($widget);
        }
    }
}

add_action('widgets_init', 'voyage_mikado_register_widgets');