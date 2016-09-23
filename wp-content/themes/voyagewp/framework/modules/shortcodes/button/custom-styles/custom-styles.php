<?php

if(!function_exists('voyage_mikado_button_typography_styles')) {
	/**
	 * Typography styles for all button types
	 */
	function voyage_mikado_button_typography_styles() {
		$selector = '.mkdf-btn';
		$styles   = array();

		$font_family = voyage_mikado_options()->getOptionValue('button_font_family');
		if(voyage_mikado_is_font_option_valid($font_family)) {
			$styles['font-family'] = voyage_mikado_get_font_option_val($font_family);
		}

		$text_transform = voyage_mikado_options()->getOptionValue('button_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = voyage_mikado_options()->getOptionValue('button_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = voyage_mikado_options()->getOptionValue('button_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = voyage_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = voyage_mikado_options()->getOptionValue('button_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_button_typography_styles');
}

if(!function_exists('voyage_mikado_button_outline_styles')) {
	/**
	 * Generate styles for outline button
	 */
	function voyage_mikado_button_outline_styles() {
		//outline styles
		$outline_styles   = array();
		$outline_selector = '.mkdf-btn.mkdf-btn-outline';

		if(voyage_mikado_options()->getOptionValue('btn_outline_text_color')) {
			$outline_styles['color'] = voyage_mikado_options()->getOptionValue('btn_outline_text_color');
		}

		if(voyage_mikado_options()->getOptionValue('btn_outline_border_color')) {
			$outline_styles['border-color'] = voyage_mikado_options()->getOptionValue('btn_outline_border_color');
		}

		echo voyage_mikado_dynamic_css($outline_selector, $outline_styles);

		//outline hover styles
		if(voyage_mikado_options()->getOptionValue('btn_outline_hover_text_color')) {
			echo voyage_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-color):hover',
				array('color' => voyage_mikado_options()->getOptionValue('btn_outline_hover_text_color').'!important')
			);
		}

		if(voyage_mikado_options()->getOptionValue('btn_outline_hover_bg_color')) {
			echo voyage_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-bg):hover',
				array('background-color' => voyage_mikado_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
			);
		}

		if(voyage_mikado_options()->getOptionValue('btn_outline_hover_border_color')) {
			echo voyage_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-border-hover):hover',
				array('border-color' => voyage_mikado_options()->getOptionValue('btn_outline_hover_border_color').'!important')
			);
		}
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_button_outline_styles');
}

if(!function_exists('voyage_mikado_button_solid_styles')) {
	/**
	 * Generate styles for solid type buttons
	 */
	function voyage_mikado_button_solid_styles() {
		//solid styles
		$solid_selector = '.mkdf-btn.mkdf-btn-solid';
		$solid_styles   = array();

		if(voyage_mikado_options()->getOptionValue('btn_solid_text_color')) {
			$solid_styles['color'] = voyage_mikado_options()->getOptionValue('btn_solid_text_color');
		}

		if(voyage_mikado_options()->getOptionValue('btn_solid_border_color')) {
			$solid_styles['border-color'] = voyage_mikado_options()->getOptionValue('btn_solid_border_color');
		}

		if(voyage_mikado_options()->getOptionValue('btn_solid_bg_color')) {
			$solid_styles['background-color'] = voyage_mikado_options()->getOptionValue('btn_solid_bg_color');
		}

		echo voyage_mikado_dynamic_css($solid_selector, $solid_styles);

		//solid hover styles
		if(voyage_mikado_options()->getOptionValue('btn_solid_hover_text_color')) {
			echo voyage_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-hover-color):hover',
				array('color' => voyage_mikado_options()->getOptionValue('btn_solid_hover_text_color').'!important')
			);
		}

		if(voyage_mikado_options()->getOptionValue('btn_solid_hover_bg_color')) {
			echo voyage_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
				array('background-color' => voyage_mikado_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
			);
		}

		if(voyage_mikado_options()->getOptionValue('btn_solid_hover_border_color')) {
			echo voyage_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-border-hover):hover',
				array('border-color' => voyage_mikado_options()->getOptionValue('btn_solid_hover_border_color').'!important')
			);
		}
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_button_solid_styles');
}