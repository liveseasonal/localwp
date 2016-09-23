<?php

if(!function_exists('voyage_mikado_team_options_map')) {
	/**
	 * Add Team options to elements page
	 */
	function voyage_mikado_team_options_map() {

		$panel_team = voyage_mikado_add_admin_panel(
			array(
				'page'  => '_elements_page',
				'name'  => 'panel_team',
				'title' => 'Team'
			)
		);

	}

	add_action('voyage_mikado_options_elements_map', 'voyage_mikado_team_options_map');

}