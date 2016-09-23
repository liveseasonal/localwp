<?php

if ( ! function_exists('voyage_mikado_call_to_action_options_map') ) {
	/**
	 * Add Call to Action options to elements page
	 */
	function voyage_mikado_call_to_action_options_map() {

		$panel_call_to_action = voyage_mikado_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_call_to_action',
				'title' => 'Call To Action'
			)
		);

	}

	add_action( 'voyage_mikado_options_elements_map', 'voyage_mikado_call_to_action_options_map');

}