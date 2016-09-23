<?php

if(!function_exists('voyage_mikado_blockquote_options_map')) {
	/**
	 * Add Blockquote options to elements page
	 */
	function voyage_mikado_blockquote_options_map() {

		$panel_blockquote = voyage_mikado_add_admin_panel(
			array(
				'page'  => '_elements_page',
				'name'  => 'panel_blockquote',
				'title' => 'Blockquote'
			)
		);

	}

	add_action('voyage_mikado_options_elements_map', 'voyage_mikado_blockquote_options_map');

}