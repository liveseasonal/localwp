<?php

namespace Voyage\Modules\Shortcodes\ComparisonPricingTables;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComparisonPricingTable implements ShortcodeInterface {
	private $base;

	/**
	 * ComparisonPricingTable constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_comparison_pricing_table';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Comparison Pricing Table',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-comparison-pricing-table extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_comparison_pricing_tables_holder'),
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => 'Basic Plan',
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Title Size (px)',
					'param_name'  => 'title_size',
					'value'       => '',
					'description' => '',
					'dependency'  => array('element' => 'title', 'not_empty' => true),
					'group'       => 'Design Options'
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Price',
					'param_name'  => 'price',
					'description' => 'Default value is 100'
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Currency',
					'param_name'  => 'currency',
					'description' => 'Default mark is $'
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Price Period',
					'param_name'  => 'price_period',
					'description' => 'Default label is monthly'
				),
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => 'Show Button',
					'param_name'  => 'show_button',
					'value'       => array(
						'Default' => '',
						'Yes'     => 'yes',
						'No'      => 'no'
					),
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Button Text',
					'param_name'  => 'button_text',
					'dependency'  => array('element' => 'show_button', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Button Link',
					'param_name'  => 'link',
					'dependency'  => array('element' => 'show_button', 'value' => 'yes')
				),
				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Content',
					'param_name'  => 'content',
					'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
					'description' => '',
					'admin_label' => false
				),
				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Border Top Color',
					'param_name'  => 'border_top_color',
					'value'       => '',
					'save_always' => true,
					'group'       => 'Design Options'
				),
				array(
					'type'        => 'colorpicker',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Button Background Color',
					'param_name'  => 'btn_background_color',
					'value'       => '',
					'save_always' => true,
					'group'       => 'Design Options'
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'title'                => 'Basic Plan',
			'title_size'           => '',
			'price'                => '100',
			'currency'             => '',
			'price_period'         => '',
			'show_button'          => 'yes',
			'link'                 => '',
			'button_text'          => 'button',
			'border_top_color'     => '',
			'btn_background_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content']        = $content;
		$params['border_style']   = $this->getBorderStyles($params);
		$params['display_border'] = is_array($params['border_style']) && count($params['border_style']);
		$params['btn_styles']     = $this->getBtnStyles($params);

		return voyage_mikado_get_shortcode_module_template_part('templates/cpt-table-template', 'comparison-pricing-tables', '', $params);
	}

	private function getBorderStyles($params) {
		$styles = array();

		if($params['border_top_color'] !== '') {
			$styles[] = 'background-color: '.$params['border_top_color'];
		}

		return $styles;
	}

	private function getBtnStyles($params) {
		$styles = array();

		if($params['btn_background_color'] !== '') {
			$styles[] = 'background-color: '.$params['btn_background_color'];
		}

		return $styles;
	}

}