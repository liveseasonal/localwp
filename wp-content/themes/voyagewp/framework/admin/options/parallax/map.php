<?php

if(!function_exists('voyage_mikado_parallax_options_map')) {
    /**
     * Parallax options page
     */
    function voyage_mikado_parallax_options_map() {

        $panel_parallax = voyage_mikado_add_admin_panel(
            array(
                'page'  => '_elements_page',
                'name'  => 'panel_parallax',
                'title' => 'Parallax'
            )
        );

        voyage_mikado_add_admin_field(array(
            'type'          => 'onoff',
            'name'          => 'parallax_on_off',
            'default_value' => 'off',
            'label'         => 'Parallax on touch devices',
            'description'   => 'Enabling this option will allow parallax on touch devices',
            'parent'        => $panel_parallax
        ));

        voyage_mikado_add_admin_field(array(
            'type'          => 'text',
            'name'          => 'parallax_min_height',
            'default_value' => '300',
            'label'         => 'Parallax Min Height',
            'description'   => 'Set a minimum height for parallax images on small displays (phones, tablets, etc.)',
            'args'          => array(
                'col_width' => 3,
                'suffix'    => 'px'
            ),
            'parent'        => $panel_parallax
        ));

    }

    add_action('voyage_mikado_options_elements_map', 'voyage_mikado_parallax_options_map');

}