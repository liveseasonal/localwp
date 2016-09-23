<?php

if(!function_exists('voyage_mikado_search_body_class')) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function voyage_mikado_search_body_class($classes) {

		if(is_active_widget(false, false, 'mkd_search_opener')) {

			$classes[] = 'mkdf-'.voyage_mikado_options()->getOptionValue('search_type');

			if(voyage_mikado_options()->getOptionValue('search_type') == 'fullscreen-search') {

				$is_fullscreen_bg_image_set = voyage_mikado_options()->getOptionValue('fullscreen_search_background_image') !== '';

				if($is_fullscreen_bg_image_set) {
					$classes[] = 'mkdf-fullscreen-search-with-bg-image';
				}

				$classes[] = 'mkdf-search-fade';

			}

		}

		return $classes;

	}

	add_filter('body_class', 'voyage_mikado_search_body_class');
}

if(!function_exists('voyage_mikado_get_search')) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function voyage_mikado_get_search() {

		if(voyage_mikado_active_widget(false, false, 'mkd_search_opener')) {

			$search_type = voyage_mikado_options()->getOptionValue('search_type');

			voyage_mikado_load_search_template();

		}
	}

}

if(!function_exists('voyage_mikado_load_search_template')) {
	/**
	 * Loads HTML template with parameters
	 */
	function voyage_mikado_load_search_template() {
		global $voyage_mikado_IconCollections;

		$search_type = voyage_mikado_options()->getOptionValue('search_type');

		$search_icon       = '';
		if(voyage_mikado_options()->getOptionValue('search_icon_pack') !== '') {
			$search_icon       = $voyage_mikado_IconCollections->getSearchIcon(voyage_mikado_options()->getOptionValue('search_icon_pack'), true);
		}

		$parameters = array(
			'search_in_grid'    => voyage_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'       => $search_icon,
		);

		voyage_mikado_get_module_template_part('templates/types/'.$search_type, 'search', '', $parameters);

	}

}