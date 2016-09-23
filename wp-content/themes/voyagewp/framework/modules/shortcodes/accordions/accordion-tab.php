<?php

namespace Voyage\Modules\AccordionTab;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * class Accordions
 */
class AccordionTab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_accordion_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(array(
				"name"                    => esc_html__('Mikado Accordion Tab', 'voyage'),
				"base"                    => $this->base,
				"as_parent"               => array('except' => 'vc_row'),
				"as_child"                => array('only' => 'mkdf_accordion'),
				'is_container'            => true,
				"category"                => 'by MIKADO',
				"icon"                    => "icon-wpb-accordion-section extended-custom-icon",
				"show_settings_on_create" => true,
				"js_view"                 => 'VcColumnView',
				'params'                  => array_merge(
					voyage_mikado_icon_collections()->getVCParamsArray(array(), '', true),
					array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__('Title', 'voyage'),
							'param_name'  => 'title',
							'admin_label' => true,
							'value'       => esc_html__('Section', 'voyage'),
							'description' => esc_html__('Enter accordion section title.', 'voyage')
						),
						array(
							'type'        => 'el_id',
							'heading'     => esc_html__('Section ID', 'voyage'),
							'param_name'  => 'el_id',
							'description' => sprintf(esc_html__('Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'voyage'), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">'.esc_html__('link', 'voyage').'</a>'),
						),
					)
				)
			));
		}
	}


	public function render($atts, $content = null) {

		$default_atts = (array(
			'title' => 'Accordion Title',
			'el_id' => ''
		));

		$default_atts = array_merge($default_atts, voyage_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$iconPackName   = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $iconPackName ? $params[$iconPackName] : '';

		$params['link_params'] = $this->getLinkParams($params);

		extract($params);
		$params['content'] = $content;

		$output = '';

		$output .= voyage_mikado_get_shortcode_module_template_part('templates/accordion-template', 'accordions', '', $params);

		return $output;

	}

	private function getLinkParams($params) {
		$linkParams = array();

		if(!empty($params['link']) && !empty($params['link_text'])) {
			$linkParams['link']      = $params['link'];
			$linkParams['link_text'] = $params['link_text'];

			$linkParams['link_target'] = !empty($params['link_target']) ? $params['link_target'] : '_self';
		}

		return $linkParams;
	}

}