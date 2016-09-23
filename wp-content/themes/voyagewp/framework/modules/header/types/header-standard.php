<?php
namespace Voyage\Modules\Header\Types;

use Voyage\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-standard';

		if(!is_admin()) {

			$menuAreaHeight       = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('menu_area_height_header_standard'));
			$this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 102;

			$mobileHeaderHeight       = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('mobile_header_height'));
			$this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? $mobileHeaderHeight : 100;

			add_action('wp', array($this, 'setHeaderHeightProps'));

			add_filter('voyage_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
			add_filter('voyage_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
			add_filter('voyage_mikado_add_page_custom_style', array($this, 'headerPerPageStyles'));
		}
	}

	public function headerPerPageStyles($style) {
		$id                     = voyage_mikado_get_page_id();
		$class_prefix           = voyage_mikado_get_unique_page_class();
		$main_menu_style        = array();
		$header_border_enabled = get_post_meta($id, 'mkdf_menu_area_bottom_border_enable_header_standard_meta', true) === 'yes';

		$main_menu_selector = array(
			$class_prefix.'.mkdf-header-standard .mkdf-menu-area'
		);

		if($header_border_enabled) {
			$header_border_color = get_post_meta($id, 'mkdf_menu_area_bottom_border_color_meta', true);

			if($header_border_color !== '') {
				$main_menu_style['border-color'] = $header_border_color;
			}
		}

		$menu_area_background_color        = get_post_meta($id, 'mkdf_menu_area_background_color_header_standard_meta', true);
		$menu_area_background_transparency = get_post_meta($id, 'mkdf_menu_area_background_transparency_header_standard_meta', true);

		if($menu_area_background_transparency === '') {
			$menu_area_background_transparency = 1;
		}

		$menu_area_background_color_rgba = voyage_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);

		if($menu_area_background_color_rgba !== null) {
			$main_menu_style['background-color'] = $menu_area_background_color_rgba;
		}

		$style[] = voyage_mikado_dynamic_css($main_menu_selector, $main_menu_style);

		return $style;
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate($parameters = array()) {

		$parameters['menu_area_in_grid'] = voyage_mikado_options()->getOptionValue('menu_area_in_grid_header_standard') == 'yes' ? true : false;

		$parameters = apply_filters('voyage_mikado_header_standard_parameters', $parameters);

		voyage_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = voyage_mikado_get_page_id();
		$transparencyHeight = 0;

		if(get_post_meta($id, 'mkdf_menu_area_background_color_header_standard_meta', true) !== '') {
			$menuAreaTransparent = get_post_meta($id, 'mkdf_menu_area_background_color_header_standard_meta', true) !== '' &&
			                       get_post_meta($id, 'mkdf_menu_area_background_transparency_header_standard_meta', true) !== '1';
		} elseif(voyage_mikado_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
			$menuAreaTransparent = voyage_mikado_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
			                       voyage_mikado_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') !== '1';
		} else {
			$menuAreaTransparent = voyage_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
			                       voyage_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') !== '1';
		}


		$sliderExists        = get_post_meta($id, 'mkdf_page_slider_meta', true) !== '';
		$contentBehindHeader = get_post_meta($id, 'mkdf_page_content_behind_header_meta', true) === 'yes';

		if($sliderExists || $contentBehindHeader) {
			$menuAreaTransparent = true;
		}

		if($menuAreaTransparent) {
			$transparencyHeight = $this->menuAreaHeight;

			if(($sliderExists && voyage_mikado_is_top_bar_enabled())
			   || voyage_mikado_is_top_bar_enabled() && voyage_mikado_is_top_bar_transparent()
			) {
				$transparencyHeight += voyage_mikado_get_top_bar_height();
			}
		}

		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$id                 = voyage_mikado_get_page_id();
		$transparencyHeight = 0;

		if(get_post_meta($id, 'mkdf_menu_area_background_color_header_standard_meta', true) !== '') {
			$menuAreaTransparent = get_post_meta($id, 'mkdf_menu_area_background_color_header_standard_meta', true) !== '' &&
			                       get_post_meta($id, 'mkdf_menu_area_background_transparency_header_standard_meta', true) === '0';
		} elseif(voyage_mikado_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
			$menuAreaTransparent = voyage_mikado_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
			                       voyage_mikado_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') === '0';
		} else {
			$menuAreaTransparent = voyage_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
			                       voyage_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') === '0';
		}

		if($menuAreaTransparent) {
			$transparencyHeight = $this->menuAreaHeight;
		}

		return $transparencyHeight;
	}


	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
		if(voyage_mikado_is_top_bar_enabled()) {
			$headerHeight += voyage_mikado_get_top_bar_height();
		}

		return $headerHeight;
	}

	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;

		return $mobileHeaderHeight;
	}

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables($globalVariables) {
		$globalVariables['mkdfLogoAreaHeight']     = 0;
		$globalVariables['mkdfMenuAreaHeight']     = $this->headerHeight;
		$globalVariables['mkdfMobileHeaderHeight'] = $this->mobileHeaderHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables($perPageVars) {
		//calculate transparency height only if header has no sticky behaviour
		if(!in_array(voyage_mikado_options()->getOptionValue('header_behaviour'), array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		))
		) {
			$perPageVars['mkdfHeaderTransparencyHeight'] = $this->headerHeight - (voyage_mikado_get_top_bar_height() + $this->heightOfCompleteTransparency);
		} else {
			$perPageVars['mkdfHeaderTransparencyHeight'] = 0;
		}

		return $perPageVars;
	}
}