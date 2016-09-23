<?php

if(!function_exists('voyage_mikado_accordions_typography_styles')) {
	function voyage_mikado_accordions_typography_styles() {
		$selector = '.mkdf-accordion-holder .mkdf-title-holder';
		$styles   = array();

		$font_family = voyage_mikado_options()->getOptionValue('accordions_font_family');
		if(voyage_mikado_is_font_option_valid($font_family)) {
			$styles['font-family'] = voyage_mikado_get_font_option_val($font_family);
		}

		$text_transform = voyage_mikado_options()->getOptionValue('accordions_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = voyage_mikado_options()->getOptionValue('accordions_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = voyage_mikado_options()->getOptionValue('accordions_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = voyage_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = voyage_mikado_options()->getOptionValue('accordions_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_accordions_typography_styles');
}

if(!function_exists('voyage_mikado_accordions_inital_title_color_styles')) {
	function voyage_mikado_accordions_inital_title_color_styles() {
		$selector = '.mkdf-accordion-holder.mkdf-initial .mkdf-title-holder';
		$styles   = array();

		if(voyage_mikado_options()->getOptionValue('accordions_title_color')) {
			$styles['color'] = voyage_mikado_options()->getOptionValue('accordions_title_color');
		}
		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_accordions_inital_title_color_styles');
}

if(!function_exists('voyage_mikado_accordions_active_title_color_styles')) {

	function voyage_mikado_accordions_active_title_color_styles() {
		$selector = array(
			'.mkdf-accordion-holder.mkdf-initial .mkdf-title-holder.ui-state-active',
			'.mkdf-accordion-holder.mkdf-initial .mkdf-title-holder.ui-state-hover'
		);
		$styles   = array();

		if(voyage_mikado_options()->getOptionValue('accordions_title_color_active')) {
			$styles['color'] = voyage_mikado_options()->getOptionValue('accordions_title_color_active');
		}

		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_accordions_active_title_color_styles');
}
if(!function_exists('voyage_mikado_accordions_inital_icon_color_styles')) {

	function voyage_mikado_accordions_inital_icon_color_styles() {
		$selector = '.mkdf-accordion-holder.mkdf-initial .mkdf-title-holder .mkdf-accordion-mark';
		$styles   = array();

		if(voyage_mikado_options()->getOptionValue('accordions_icon_color')) {
			$styles['color'] = voyage_mikado_options()->getOptionValue('accordions_icon_color');
		}
		if(voyage_mikado_options()->getOptionValue('accordions_icon_back_color')) {
			$styles['background-color'] = voyage_mikado_options()->getOptionValue('accordions_icon_back_color');
		}
		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_accordions_inital_icon_color_styles');
}
if(!function_exists('voyage_mikado_accordions_active_icon_color_styles')) {

	function voyage_mikado_accordions_active_icon_color_styles() {
		$selector = array(
			'.mkdf-accordion-holder.mkdf-initial .mkdf-title-holder.ui-state-active  .mkdf-accordion-mark',
			'.mkdf-accordion-holder.mkdf-initial .mkdf-title-holder.ui-state-hover  .mkdf-accordion-mark'
		);
		$styles   = array();

		if(voyage_mikado_options()->getOptionValue('accordions_icon_color_active')) {
			$styles['color'] = voyage_mikado_options()->getOptionValue('accordions_icon_color_active');
		}
		if(voyage_mikado_options()->getOptionValue('accordions_icon_back_color_active')) {
			$styles['background-color'] = voyage_mikado_options()->getOptionValue('accordions_icon_back_color_active');
		}
		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_accordions_active_icon_color_styles');
}

if(!function_exists('voyage_mikado_boxed_accordions_inital_color_styles')) {
	function voyage_mikado_boxed_accordions_inital_color_styles() {
		$selector = '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder';
		$styles   = array();

		if(voyage_mikado_options()->getOptionValue('boxed_accordions_color')) {
			$styles['color'] = voyage_mikado_options()->getOptionValue('boxed_accordions_color');
			echo voyage_mikado_dynamic_css('.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder .mkdf-accordion-mark', array('color' => voyage_mikado_options()->getOptionValue('boxed_accordions_color')));
		}
		if(voyage_mikado_options()->getOptionValue('boxed_accordions_back_color')) {
			$styles['background-color'] = voyage_mikado_options()->getOptionValue('boxed_accordions_back_color');
		}
		if(voyage_mikado_options()->getOptionValue('boxed_accordions_border_color')) {
			$styles['border-color'] = voyage_mikado_options()->getOptionValue('boxed_accordions_border_color');
		}

		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_boxed_accordions_inital_color_styles');
}
if(!function_exists('voyage_mikado_boxed_accordions_active_color_styles')) {

	function voyage_mikado_boxed_accordions_active_color_styles() {
		$selector       = array(
			'.mkdf-accordion-holder.mkdf-boxed.ui-accordion .mkdf-title-holder.ui-state-active',
			'.mkdf-accordion-holder.mkdf-boxed.ui-accordion .mkdf-title-holder.ui-state-hover'
		);
		$selector_icons = array(
			'.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active .mkdf-accordion-mark',
			'.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover .mkdf-accordion-mark'
		);
		$styles         = array();

		if(voyage_mikado_options()->getOptionValue('boxed_accordions_color_active')) {
			$styles['color'] = voyage_mikado_options()->getOptionValue('boxed_accordions_color_active');
			echo voyage_mikado_dynamic_css($selector_icons, array('color' => voyage_mikado_options()->getOptionValue('boxed_accordions_color_active')));
		}
		if(voyage_mikado_options()->getOptionValue('boxed_accordions_back_color_active')) {
			$styles['background-color'] = voyage_mikado_options()->getOptionValue('boxed_accordions_back_color_active');
		}
		if(voyage_mikado_options()->getOptionValue('boxed_accordions_border_color_active')) {
			$styles['border-color'] = voyage_mikado_options()->getOptionValue('boxed_accordions_border_color_active');
		}

		echo voyage_mikado_dynamic_css($selector, $styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_boxed_accordions_active_color_styles');
}