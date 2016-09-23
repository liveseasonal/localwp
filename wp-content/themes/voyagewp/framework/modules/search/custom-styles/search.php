<?php

if(!function_exists('voyage_mikado_search_opener_icon_size')) {

	function voyage_mikado_search_opener_icon_size() {

		if(voyage_mikado_options()->getOptionValue('header_search_icon_size')) {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener', array(
				'font-size' => voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('header_search_icon_size')).'px'
			));
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_opener_icon_size');

}

if(!function_exists('voyage_mikado_search_opener_icon_colors')) {

	function voyage_mikado_search_opener_icon_colors() {

		if(voyage_mikado_options()->getOptionValue('header_search_icon_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener', array(
				'color' => voyage_mikado_options()->getOptionValue('header_search_icon_color')
			));
		}

		if(voyage_mikado_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'color' => voyage_mikado_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if(voyage_mikado_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => voyage_mikado_options()->getOptionValue('header_light_search_icon_color').' !important'
			));
		}

		if(voyage_mikado_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => voyage_mikado_options()->getOptionValue('header_light_search_icon_hover_color').' !important'
			));
		}

		if(voyage_mikado_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => voyage_mikado_options()->getOptionValue('header_dark_search_icon_color').' !important'
			));
		}
		if(voyage_mikado_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => voyage_mikado_options()->getOptionValue('header_dark_search_icon_hover_color').' !important'
			));
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_opener_icon_colors');

}

if(!function_exists('voyage_mikado_search_opener_icon_background_colors')) {

	function voyage_mikado_search_opener_icon_background_colors() {

		if(voyage_mikado_options()->getOptionValue('search_icon_background_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener', array(
				'background-color' => voyage_mikado_options()->getOptionValue('search_icon_background_color')
			));
		}

		if(voyage_mikado_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'background-color' => voyage_mikado_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_opener_icon_background_colors');
}

if(!function_exists('voyage_mikado_search_opener_text_styles')) {

	function voyage_mikado_search_opener_text_styles() {
		$text_styles = array();

		if(voyage_mikado_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = voyage_mikado_options()->getOptionValue('search_icon_text_color');
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_icon_text_fontsize')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_icon_text_lineheight')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = voyage_mikado_options()->getOptionValue('search_icon_text_texttransform');
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('search_icon_text_google_fonts')).', sans-serif';
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = voyage_mikado_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = voyage_mikado_options()->getOptionValue('search_icon_text_fontweight');
		}

		if(!empty($text_styles)) {
			echo voyage_mikado_dynamic_css('.mkdf-search-icon-text', $text_styles);
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener:hover .mkdf-search-icon-text', array(
				'color' => voyage_mikado_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_opener_text_styles');
}

if(!function_exists('voyage_mikado_search_opener_spacing')) {

	function voyage_mikado_search_opener_spacing() {
		$spacing_styles = array();

		if(voyage_mikado_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_padding_left')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_padding_right')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_margin_left')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_margin_right')).'px';
		}

		if(!empty($spacing_styles)) {
			echo voyage_mikado_dynamic_css('.mkdf-search-opener', $spacing_styles);
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_opener_spacing');
}

if(!function_exists('voyage_mikado_search_bar_background')) {

	function voyage_mikado_search_bar_background() {

		if(voyage_mikado_options()->getOptionValue('search_background_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-search-fade .mkdf-fullscreen-search-holder .mkdf-fullscreen-search-table, .mkdf-fullscreen-search-overlay', array(
				'background-color' => voyage_mikado_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_bar_background');
}

if(!function_exists('voyage_mikado_search_text_styles')) {

	function voyage_mikado_search_text_styles() {
		$text_styles = array();

		if(voyage_mikado_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = voyage_mikado_options()->getOptionValue('search_text_color');
		}
		if(voyage_mikado_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_text_fontsize')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = voyage_mikado_options()->getOptionValue('search_text_texttransform');
		}
		if(voyage_mikado_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('search_text_google_fonts')).', sans-serif';
		}
		if(voyage_mikado_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = voyage_mikado_options()->getOptionValue('search_text_fontstyle');
		}
		if(voyage_mikado_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = voyage_mikado_options()->getOptionValue('search_text_fontweight');
		}
		if(voyage_mikado_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo voyage_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-field', $text_styles);
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_text_styles');
}

if(!function_exists('voyage_mikado_search_label_styles')) {

	function voyage_mikado_search_label_styles() {
		$text_styles = array();

		if(voyage_mikado_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = voyage_mikado_options()->getOptionValue('search_label_text_color');
		}
		if(voyage_mikado_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_label_text_fontsize')).'px';
		}
		if(voyage_mikado_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = voyage_mikado_options()->getOptionValue('search_label_text_texttransform');
		}
		if(voyage_mikado_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('search_label_text_google_fonts')).', sans-serif';
		}
		if(voyage_mikado_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = voyage_mikado_options()->getOptionValue('search_label_text_fontstyle');
		}
		if(voyage_mikado_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = voyage_mikado_options()->getOptionValue('search_label_text_fontweight');
		}
		if(voyage_mikado_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_label_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo voyage_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-label', $text_styles);
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_label_styles');
}

if(!function_exists('voyage_mikado_search_icon_styles')) {

	function voyage_mikado_search_icon_styles() {

		if(voyage_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'color' => voyage_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-submit:hover', array(
				'color' => voyage_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if(voyage_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo voyage_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'font-size' => voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('search_icon_size')).'px'
			));
		}

	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_search_icon_styles');
}

if(!function_exists('voyage_mikado_fullscreen_search_styles')) {
	/**
	 * Outputs styles for full screen search
	 */
	function voyage_mikado_fullscreen_search_styles() {
		$bg_image = voyage_mikado_options()->getOptionValue('fullscreen_search_background_image');
		$selector = '.mkdf-fullscreen-search-holder';
		$styles   = array();

		if(!$bg_image) {
			return;
		}

		$styles['background-image'] = 'url('.$bg_image.')';

		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_fullscreen_search_styles');
}
