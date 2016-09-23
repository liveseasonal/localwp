<?php
/**
 * Custom styles for Counter shortcode
 * Hooks to voyage_mikado_style_dynamic hook
 */

//if (!function_exists('voyage_mikado_counter_style')) {
//
//	function voyage_mikado_counter_style()
//	{
//
//		if (voyage_mikado_options()->getOptionValue('option_value') !== '') {
//			echo voyage_mikado_dynamic_css('.css-class', array(
//				//Css rules, etc
//				'height' => voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('option_value')) . 'px'
//			));
//		}
//
//	}
//
//	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_counter_style');
//
//}

if(!function_exists('voyage_mikado_woo_single_style')) {

	function voyage_mikado_woo_single_style() {

		$styles = array();

		if(voyage_mikado_options()->getOptionValue('hide_product_info') === 'yes') {
			$styles['display'] = 'none';
		}

		$selector = array(
			'.single.single-product .product_meta'
		);

		echo voyage_mikado_dynamic_css($selector, $styles);

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_woo_single_style');

}

?>