<?php

if(!function_exists('voyage_mikado_load_elements_map')) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function voyage_mikado_load_elements_map() {

		voyage_mikado_add_admin_page(
			array(
				'slug'  => '_elements_page',
				'title' => 'Elements',
				'icon'  => 'fa fa-header'
			)
		);

		do_action('voyage_mikado_options_elements_map');

	}

	add_action('voyage_mikado_options_map', 'voyage_mikado_load_elements_map', 13);

}