<?php

if(!function_exists('mkdf_themename_hook_breadcrumbs_template')) {
	/**
	 * Hooks to after page title hook and outputs breadcrumbs template
	 */
	function mkdf_themename_hook_breadcrumbs_template() {
		$enable_breadcrumbs_area = mkdf_themename_breadcrumbs_area_enabled();
		$enable_social_share     = mkdf_themename_social_share_enabled_in_breadcrumbs();
		$breadcrumbs_class       = $enable_social_share ? 'mkdf-grid-col-6' : 'mkdf-grid-col-6';

		$params = array(
			'enable_breadcrumbs_area' => $enable_breadcrumbs_area,
			'enable_social_share'     => $enable_social_share,
			'breadcrumbs_class'       => $breadcrumbs_class
		);

		echo voyage_mikado_get_module_template_part('templates/breadcrumbs', 'breadcrumbs', '', $params);
	}

	add_action('voyage_mikado_after_page_title', 'mkdf_themename_hook_breadcrumbs_template');
}

if(!function_exists('mkdf_themename_breadcrumbs_area_body_class')) {
	/**
	 * Adds utility classes for breadcrumbs area to body class
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function mkdf_themename_breadcrumbs_area_body_class($classes) {
		$breadcrumbs_area_enabled = mkdf_themename_breadcrumbs_area_enabled();

		if(!$breadcrumbs_area_enabled) {
			return $classes;
		}

		$id = voyage_mikado_get_page_id();
		$breadcrumbs_text_size = voyage_mikado_get_meta_field_intersect('breadcrumbs_text_size', $id);

		$classes[] = 'mkdf-breadcrumbs-area-enabled';

		if($breadcrumbs_text_size !== '') {
			$classes[] = 'mkdf-breadcrumbs-area-text-size-'.$breadcrumbs_text_size;
		}

		return $classes;
	}

	add_filter('body_class', 'mkdf_themename_breadcrumbs_area_body_class');
}

if(!function_exists('mkdf_themename_breadcrumbs_area_enabled')) {
	/**
	 * @return bool
	 */
	function mkdf_themename_breadcrumbs_area_enabled() {
		$id = voyage_mikado_get_page_id();

		return voyage_mikado_get_meta_field_intersect('show_breadcrumbs_area', $id) === 'yes';
	}
}

if(!function_exists('mkdf_themename_social_share_enabled_in_breadcrumbs')) {
	/**
	 * @return bool|mixed|void
	 */
	function mkdf_themename_social_share_enabled_in_breadcrumbs() {
		return voyage_mikado_options()->getOptionValue('breadcrumbs_enable_share') === 'yes';
	}
}