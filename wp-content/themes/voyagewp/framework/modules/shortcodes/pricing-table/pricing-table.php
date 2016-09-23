<?php
namespace Voyage\Modules\PricingTable;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Pricing Table',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_pricing_tables'),
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
					'dependency'  => array('element' => 'title', 'not_empty' => true)
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
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Label',
					'param_name'  => 'label',
					'save_always' => ''
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
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => 'Active',
					'param_name'  => 'active',
					'value'       => array(
						'No'  => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Content',
					'param_name'  => 'content',
					'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {

		$args   = array(
			'title'        => 'Basic Plan',
			'title_size'   => '',
			'price'        => '100',
			'currency'     => '',
			'price_period' => '',
			'label'        => '',
			'active'       => 'no',
			'show_button'  => 'yes',
			'link'         => '',
			'button_text'  => 'button'
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html                  = '';
		$pricing_table_clasess = 'mkdf-price-table';

		if($active == 'yes') {
			$pricing_table_clasess .= ' mkdf-pt-active';
		}

		$params['pricing_table_classes'] = $pricing_table_clasess;
		$params['content']               = $content;
		$params['button_params']         = $this->getButtonParams($params);

		$params['title_styles'] = array();

		if(!empty($params['title_size'])) {
			$params['title_styles'][] = 'font-size: '.voyage_mikado_filter_px($params['title_size']).'px';
		}

		$html .= voyage_mikado_get_shortcode_module_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

		return $html;

	}

	private function getButtonParams($params) {
		$buttonParams = array();

		if($params['show_button'] === 'yes' && $params['button_text'] !== '') {
			$buttonParams = array(
				'link' => $params['link'],
				'text' => $params['button_text'],
				'size' => 'medium'
			);

			$buttonParams['type']       = $params['active'] === 'yes' ? 'white' : 'solid';
			$buttonParams['hover_type'] = $params['active'] === 'yes' ? 'white' : 'outline';
		}

		return $buttonParams;
	}

}
