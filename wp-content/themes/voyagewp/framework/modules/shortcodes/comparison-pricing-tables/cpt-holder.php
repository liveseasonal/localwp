<?php

namespace Voyage\Modules\Shortcodes\ComparisonPricingTables;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComparisonPricingTablesHolder implements ShortcodeInterface {
	private $base;

	/**
	 * ComparisonPricingTablesHolder constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_comparison_pricing_tables_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => 'Comparison Pricing Tables',
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkdf_comparison_pricing_table'),
			'content_element'         => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-comparison-pricing-tables extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Columns',
					'param_name'  => 'columns',
					'value'       => array(
						'Two'   => 'mkdf-two-columns',
						'Three' => 'mkdf-three-columns',
						'Four'  => 'mkdf-four-columns',
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => '',
					'save_always' => true
				),
				array(
					'type'        => 'exploded_textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Features',
					'param_name'  => 'features',
					'value'       => '',
					'save_always' => true,
					'description' => 'Enter features. Separate each features with new line (enter).'
				),
				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Border Top Color',
					'param_name'  => 'border_top_color',
					'value'       => '',
					'save_always' => true
				)
			),
			'js_view'                 => 'VcColumnView'
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'          => 'mkdf-two-columns',
			'features'         => '',
			'title'            => '',
			'border_top_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['features']       = $this->getFeaturesArray($params);
		$params['content']        = $content;
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['border_style']   = $this->getBorderStyles($params);
		$params['display_border'] = is_array($params['border_style']) && count($params['border_style']);

		return voyage_mikado_get_shortcode_module_template_part('templates/cpt-holder-template', 'comparison-pricing-tables', '', $params);
	}

	private function getFeaturesArray($params) {
		$features = array();

		if(!empty($params['features'])) {
			$features = explode(',', $params['features']);
		}

		return $features;
	}

	private function getHolderClasses($params) {
		$classes = array('mkdf-comparision-pricing-tables-holder');

		if($params['columns'] !== '') {
			$classes[] = $params['columns'];
		}

		return $classes;
	}

	private function getBorderStyles($params) {
		$styles = array();

		if($params['border_top_color'] !== '') {
			$styles[] = 'background-color: '.$params['border_top_color'];
		}

		return $styles;
	}

}