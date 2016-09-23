<?php

if(!function_exists('voyage_mikado_title_area_typography_style')) {

	/**
	 *
	 */
	function voyage_mikado_title_area_typography_style() {

		$title_styles = array();

		if(voyage_mikado_options()->getOptionValue('page_title_color') !== '') {
			$title_styles['color'] = voyage_mikado_options()->getOptionValue('page_title_color');
		}
		if(voyage_mikado_options()->getOptionValue('page_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('page_title_google_fonts'));
		}
		if(voyage_mikado_options()->getOptionValue('page_title_fontsize') !== '') {
			$title_styles['font-size'] = voyage_mikado_options()->getOptionValue('page_title_fontsize').'px';
		}
		if(voyage_mikado_options()->getOptionValue('page_title_lineheight') !== '') {
			$title_styles['line-height'] = voyage_mikado_options()->getOptionValue('page_title_lineheight').'px';
		}
		if(voyage_mikado_options()->getOptionValue('page_title_texttransform') !== '') {
			$title_styles['text-transform'] = voyage_mikado_options()->getOptionValue('page_title_texttransform');
		}
		if(voyage_mikado_options()->getOptionValue('page_title_fontstyle') !== '') {
			$title_styles['font-style'] = voyage_mikado_options()->getOptionValue('page_title_fontstyle');
		}
		if(voyage_mikado_options()->getOptionValue('page_title_fontweight') !== '') {
			$title_styles['font-weight'] = voyage_mikado_options()->getOptionValue('page_title_fontweight');
		}
		if(voyage_mikado_options()->getOptionValue('page_title_letter_spacing') !== '') {
			$title_styles['letter-spacing'] = voyage_mikado_options()->getOptionValue('page_title_letter_spacing').'px';
		}

		$title_selector = array(
			'.mkdf-title .mkdf-title-holder h1'
		);

		echo voyage_mikado_dynamic_css($title_selector, $title_styles);


		$subtitle_styles = array();

		if(voyage_mikado_options()->getOptionValue('page_subtitle_color') !== '') {
			$subtitle_styles['color'] = voyage_mikado_options()->getOptionValue('page_subtitle_color');
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
			$subtitle_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('page_subtitle_google_fonts'));
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_fontsize') !== '') {
			$subtitle_styles['font-size'] = voyage_mikado_options()->getOptionValue('page_subtitle_fontsize').'px';
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_lineheight') !== '') {
			$subtitle_styles['line-height'] = voyage_mikado_options()->getOptionValue('page_subtitle_lineheight').'px';
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_texttransform') !== '') {
			$subtitle_styles['text-transform'] = voyage_mikado_options()->getOptionValue('page_subtitle_texttransform');
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
			$subtitle_styles['font-style'] = voyage_mikado_options()->getOptionValue('page_subtitle_fontstyle');
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_fontweight') !== '') {
			$subtitle_styles['font-weight'] = voyage_mikado_options()->getOptionValue('page_subtitle_fontweight');
		}
		if(voyage_mikado_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
			$subtitle_styles['letter-spacing'] = voyage_mikado_options()->getOptionValue('page_subtitle_letter_spacing').'px';
		}

		$subtitle_selector = array(
			'.mkdf-title .mkdf-title-holder .mkdf-subtitle'
		);

		echo voyage_mikado_dynamic_css($subtitle_selector, $subtitle_styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_title_area_typography_style');
}


