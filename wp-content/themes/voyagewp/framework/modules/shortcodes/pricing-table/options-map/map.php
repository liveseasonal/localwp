<?php

if(!function_exists('voyage_mikado_pricing_table_options_map')) {
	/**
	 * Add Pricing Table options to elements page
	 */
	function voyage_mikado_pricing_table_options_map() {

		$panel_pricing_table = voyage_mikado_add_admin_panel(
			array(
				'page'  => '_elements_page',
				'name'  => 'panel_pricing_table',
				'title' => 'Pricing Table'
			)
		);

	}

	add_action('voyage_mikado_options_elements_map', 'voyage_mikado_pricing_table_options_map');

}