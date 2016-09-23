<?php
namespace Voyage\Modules\Shortcodes\Process;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessHolder implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_process_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => 'Process',
			'base'                    => $this->getBase(),
			'as_parent'               => array('only' => 'mkdf_process_item'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-process extended-custom-icon',
			'js_view'                 => 'VcColumnView',
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'number_of_items',
					'heading'     => 'Number of Process Items',
					'value'       => array(
						'Three' => 'three',
						'Four'  => 'four'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number_of_items' => ''
		);

		$params            = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;

		$params['holder_classes'] = array(
			'mkdf-process-holder',
			'mkdf-process-holder-items-'.$params['number_of_items']
		);

		return voyage_mikado_get_shortcode_module_template_part('templates/process-holder-template', 'process', '', $params);
	}
}