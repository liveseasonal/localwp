<?php

namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class SliderWithFilter implements ShortcodeInterface {
	private $base;

	/**
	 * SliderWithFilter constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_slider_with_filter';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'            => 'Slider With Filter',
			'base'            => $this->base,
			'category'        => 'by MIKADO',
			'icon'            => 'icon-wpb-slider-with-filter extended-custom-icon',
			'js_view'         => 'VcColumnView',
			'as_parent'       => array('only' => 'rev_slider_vc'),
			'content_element' => true,
			'params'          => array(
				array(
					'type'        => 'dropdown',
					'heading'     => 'Type',
					'param_name'  => 'filter_type',
					'value'       => array(
						'Vertical'   => 'vertical',
						'Horizontal' => 'horizontal'
					),
					'admin_label' => true,
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Filter Position',
					'param_name'  => 'horizontal_filter_position',
					'value'       => array(
						'Bottom'                 => 'bottom',
						'Offset From the Bottom' => 'bottom-offset'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Filter Position',
					'param_name'  => 'vertical_filter_position',
					'value'       => array(
						'Left'  => 'left',
						'Right' => 'right'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Skin',
					'param_name'  => 'vertical_filter_skin',
					'value'       => array(
						'Grey'  => 'grey',
						'White' => 'white'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Top Offset (px)',
					'param_name'  => 'top_offset',
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => 'Filter Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Skin',
					'param_name'  => 'horizontal_filter_skin',
					'value'       => array(
						'Light' => 'light',
						'Dark'  => 'dark'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Filter Full Width',
					'param_name'  => 'filter_full_width',
					'value'       => array(
						'Yes' => 'yes',
						'No'  => 'no'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Filter Semi-transparent',
					'param_name'  => 'filter_semitransparent',
					'value'       => array(
						'Yes' => 'yes',
						'No'  => 'no'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Show Tour Types Checkboxes',
					'param_name'  => 'show_tour_types',
					'value'       => array(
						'Yes' => 'yes',
						'No'  => 'no'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => 'Filter Options'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Number of Tour Types',
					'param_name'  => 'number_of_tour_types',
					'value'       => '',
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => 'Filter Options'
				)
			),
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'filter_type'                => 'vertical',
			'horizontal_filter_position' => 'bottom',
			'vertical_filter_position'   => 'left',
			'vertical_filter_skin'       => 'grey',
			'horizontal_filter_skin'     => 'light',
			'filter_full_width'          => 'yes',
			'filter_semitransparent'     => 'yes',
			'show_tour_types'            => 'yes',
			'number_of_tour_types'       => '',
			'top_offset'                 => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['filter_style'] = '';

		$filterClass = array('mkdf-tours-swf-filter-holder');

		switch($params['filter_type']) {
			case 'vertical':
				$filterClass[] = 'mkdf-tours-swf-filter-'.$params['vertical_filter_position'];
				$filterClass[] = 'mkdf-tours-swf-filter-vertical';
				$filterClass[] = 'mkdf-grid';
				break;
			case 'horizontal':
				$filterClass[] = 'mkdf-tours-swf-filter-'.$params['horizontal_filter_position'];
				$filterClass[] = 'mkdf-tours-swf-filter-horizontal';

				break;
		}

		$params['filter_class'] = $filterClass;

		if ($params['top_offset'] !== ''){
			$params['filter_style'] .= 'padding-top:'.voyage_mikado_filter_px($params['top_offset']).'px;';
		}

		$params['display_grid_div'] = $params['filter_full_width'] !== 'yes' && $params['filter_type'] === 'horizontal';

		return mkdf_tours_get_tour_module_template_part('templates/slider-with-filter', 'tours', 'shortcodes', '', $params);
	}
}