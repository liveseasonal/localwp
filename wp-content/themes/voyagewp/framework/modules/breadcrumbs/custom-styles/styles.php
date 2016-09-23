<?php

if(!function_exists('mkdf_themename_breadcrumbs_area_custom_styles')) {
	function mkdf_themename_breadcrumbs_area_custom_styles() {
		$styles              = array();
		$typography_styles   = array();
		$typography_selector = array(
			'.mkdf-breadcrumbs-area-holder .mkdf-breacrumbs-holder a',
			'.mkdf-breadcrumbs-area-holder .mkdf-breacrumbs-holder .mkdf-current',
			'.mkdf-breadcrumbs-area-holder .mkdf-breacrumbs-holder .mkdf-delimiter',
			'.mkdf-breadcrumbs-area-holder .mkdf-social-share-holder .mkdf-icon-name'
		);

		$background_color = voyage_mikado_options()->getOptionValue('breadcrumbs_area_background_color');

		if($background_color !== '') {
			$styles['background-color'] = $background_color;
		}

		$height = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('breadcrumbs_area_height'));

		if($height !== '') {
			$styles['height'] = $height.'px';
		}

		echo voyage_mikado_dynamic_css('.mkdf-breadcrumbs-area-holder', $styles);

		$breadcrumbs_text_color = voyage_mikado_options()->getOptionValue('breadcrumbs_text_color');

		if($breadcrumbs_text_color !== '') {
			$typography_styles['color'] = $breadcrumbs_text_color;

			echo voyage_mikado_dynamic_css($typography_selector, $typography_styles);
		}
	}

	add_action('voyage_mikado_style_dynamic', 'mkdf_themename_breadcrumbs_area_custom_styles');
}