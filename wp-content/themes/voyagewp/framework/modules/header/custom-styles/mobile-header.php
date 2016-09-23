<?php

if(!function_exists('voyage_mikado_mobile_header_general_styles')) {
	/**
	 * Generates general custom styles for mobile header
	 */
	function voyage_mikado_mobile_header_general_styles() {
		$mobile_header_styles = array();
		if(voyage_mikado_options()->getOptionValue('mobile_header_height') !== '') {
			$mobile_header_styles['height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_header_height')).'px';
		}

		if(voyage_mikado_options()->getOptionValue('mobile_header_background_color')) {
			$mobile_header_styles['background-color'] = voyage_mikado_options()->getOptionValue('mobile_header_background_color');
		}

		echo voyage_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-header-inner', $mobile_header_styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_mobile_header_general_styles');
}

if(!function_exists('voyage_mikado_mobile_navigation_styles')) {
	/**
	 * Generates styles for mobile navigation
	 */
	function voyage_mikado_mobile_navigation_styles() {
		$mobile_nav_styles = array();
		if(voyage_mikado_options()->getOptionValue('mobile_menu_background_color')) {
			$mobile_nav_styles['background-color'] = voyage_mikado_options()->getOptionValue('mobile_menu_background_color');
		}

		echo voyage_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-nav', $mobile_nav_styles);

		$mobile_nav_item_styles = array();
		if(voyage_mikado_options()->getOptionValue('mobile_menu_separator_color') !== '') {
			$mobile_nav_item_styles['border-bottom-color'] = voyage_mikado_options()->getOptionValue('mobile_menu_separator_color');
		}

		if(voyage_mikado_options()->getOptionValue('mobile_text_color') !== '') {
			$mobile_nav_item_styles['color'] = voyage_mikado_options()->getOptionValue('mobile_text_color');
		}

		if(voyage_mikado_is_font_option_valid(voyage_mikado_options()->getOptionValue('mobile_font_family'))) {
			$mobile_nav_item_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('mobile_font_family'));
		}

		if(voyage_mikado_options()->getOptionValue('mobile_font_size') !== '') {
			$mobile_nav_item_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_font_size')).'px';
		}

		if(voyage_mikado_options()->getOptionValue('mobile_line_height') !== '') {
			$mobile_nav_item_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_line_height')).'px';
		}

		if(voyage_mikado_options()->getOptionValue('mobile_text_transform') !== '') {
			$mobile_nav_item_styles['text-transform'] = voyage_mikado_options()->getOptionValue('mobile_text_transform');
		}

		if(voyage_mikado_options()->getOptionValue('mobile_font_style') !== '') {
			$mobile_nav_item_styles['font-style'] = voyage_mikado_options()->getOptionValue('mobile_font_style');
		}

		if(voyage_mikado_options()->getOptionValue('mobile_font_weight') !== '') {
			$mobile_nav_item_styles['font-weight'] = voyage_mikado_options()->getOptionValue('mobile_font_weight');
		}

		$mobile_nav_item_selector = array(
			'.mkdf-mobile-header .mkdf-mobile-nav a',
			'.mkdf-mobile-header .mkdf-mobile-nav h4'
		);

		echo voyage_mikado_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

		$mobile_nav_item_hover_styles = array();
		if(voyage_mikado_options()->getOptionValue('mobile_text_hover_color') !== '') {
			$mobile_nav_item_hover_styles['color'] = voyage_mikado_options()->getOptionValue('mobile_text_hover_color');
		}

		$mobile_nav_item_selector_hover = array(
			'.mkdf-mobile-header .mkdf-mobile-nav a:hover',
			'.mkdf-mobile-header .mkdf-mobile-nav h4:hover'
		);

		echo voyage_mikado_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_mobile_navigation_styles');
}

if(!function_exists('voyage_mikado_mobile_logo_styles')) {
	/**
	 * Generates styles for mobile logo
	 */
	function voyage_mikado_mobile_logo_styles() {
		if(voyage_mikado_options()->getOptionValue('mobile_logo_height') !== '') { ?>
			@media only screen and (max-width: 1000px) {
			<?php echo voyage_mikado_dynamic_css(
				'.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
				array('height' => voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_logo_height')).'px !important')
			); ?>
			}
		<?php }

		if(voyage_mikado_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
			@media only screen and (max-width: 480px) {
			<?php echo voyage_mikado_dynamic_css(
				'.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
				array('height' => voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
			); ?>
			}
		<?php }

		if(voyage_mikado_options()->getOptionValue('mobile_header_height') !== '') {
			$max_height = intval(voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
			echo voyage_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-logo-wrapper a', array('max-height' => $max_height));
		}
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_mobile_logo_styles');
}

if(!function_exists('voyage_mikado_mobile_icon_styles')) {
	/**
	 * Generates styles for mobile icon opener
	 */
	function voyage_mikado_mobile_icon_styles() {
		$mobile_icon_styles = array();
		if(voyage_mikado_options()->getOptionValue('mobile_icon_color') !== '') {
			$mobile_icon_styles['color'] = voyage_mikado_options()->getOptionValue('mobile_icon_color');
		}

		if(voyage_mikado_options()->getOptionValue('mobile_icon_size') !== '') {
			$mobile_icon_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_icon_size')).'px';
		}

		echo voyage_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-menu-opener a', $mobile_icon_styles);

		if(voyage_mikado_options()->getOptionValue('mobile_icon_hover_color') !== '') {
			echo voyage_mikado_dynamic_css(
				'.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
				array('color' => voyage_mikado_options()->getOptionValue('mobile_icon_hover_color')));
		}
	}

	add_action('voyage_mikado_style_dynamic', 'voyage_mikado_mobile_icon_styles');
}