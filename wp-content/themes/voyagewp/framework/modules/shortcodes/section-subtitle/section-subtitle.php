<?php
namespace Voyage\Modules\Shortcodes\SectionSubtitle;

use Voyage\Modules\Shortcodes\Lib;

class SectionSubtitle implements Lib\ShortcodeInterface {
	private $base;

	/**
	 * SectionSubtitle constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_section_subtitle';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Section Subtitle',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-section-subtitle extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'colorpicker',
					'heading'     => 'Color',
					'param_name'  => 'color',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Choose color of your subtitle'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Text Align',
					'param_name'  => 'text_align',
					'value'       => array(
						''       => '',
						'Center' => 'center',
						'Left'   => 'left',
						'Right'  => 'right'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Choose color of your subtitle'
				),
				array(
					'type'        => 'textarea',
					'heading'     => 'Text',
					'param_name'  => 'text',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Width (%)',
					'param_name'  => 'width',
					'description' => 'Adjust the width of section subtitle in percentages. Ommit the unit',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'text'       => '',
			'color'      => '',
			'text_align' => '',
			'width'      => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		if($params['text'] !== '') {

			$params['styles']  = array();
			$params['classes'] = array('mkdf-section-subtitle-holder');

			if($params['color'] !== '') {
				$params['styles'][] = 'color: '.$params['color'];
			}

			if($params['text_align'] !== '') {
				$params['styles'][] = 'text-align: '.$params['text_align'];

				$params['classes'][] = 'mkdf-section-subtitle-'.$params['text_align'];
			}

			$params['holder_styles'] = array();

			if($params['width'] !== '') {
				$params['holder_styles'][] = 'width: '.$params['width'].'%';
			}

			return voyage_mikado_get_shortcode_module_template_part('templates/section-subtitle-template', 'section-subtitle', '', $params);
		}
	}

}
