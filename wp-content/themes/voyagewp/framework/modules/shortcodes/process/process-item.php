<?php
namespace Voyage\Modules\Shortcodes\Process;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_process_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => 'Process Item',
			'base'                    => $this->getBase(),
			'as_child'                => array('only' => 'mkdf_process_holder'),
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-process-item extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'       => 'attach_image',
					'heading'    => 'Image',
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => 'Text',
					'param_name'  => 'text',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Highlight Item?',
					'param_name'  => 'highlighted',
					'value'       => array(
						'No'  => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'image'       => '',
			'title'       => '',
			'text'        => '',
			'highlighted' => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['item_classes'] = array(
			'mkdf-process-item-holder'
		);

		if($params['highlighted'] === 'yes') {
			$params['item_classes'][] = 'mkdf-pi-highlighted';
		}

		return voyage_mikado_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
	}

}