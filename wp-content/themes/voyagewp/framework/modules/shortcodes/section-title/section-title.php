<?php
namespace Voyage\Modules\Shortcodes\SectionTitle;

use Voyage\Modules\Shortcodes\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;

	/**
	 * SectionTitle constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_section_title';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Section Title',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-section-title extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Enter title text'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => 'Color',
					'param_name'  => 'title_color',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Choose color of your title'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Text Transform',
					'param_name'  => 'title_text_transform',
					'value'       => array_flip(voyage_mikado_get_text_transform_array(true)),
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Choose text transform for title'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Text Align',
					'param_name'  => 'title_text_align',
					'value'       => array(
						''       => '',
						'Center' => 'center',
						'Left'   => 'left',
						'Right'  => 'right'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Choose text align for title'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Margin Bottom',
					'param_name'  => 'margin_bottom',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true,
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Size',
					'param_name'  => 'title_size',
					'value'       => array(
						'Default' => '',
						'Small'   => 'small',
						'Medium'  => 'medium',
						'Large'   => 'large'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => 'Choose one of predefined title sizes'
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'title'                => '',
			'title_color'          => '',
			'title_size'           => '',
			'title_text_transform' => '',
			'title_text_align'     => '',
			'margin_bottom'        => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		if($params['title'] !== '') {
			$params['section_title_classes'] = array('mkdf-section-title');

			if($params['title_size'] !== '') {
				$params['section_title_classes'][] = 'mkdf-section-title-'.$params['title_size'];
			}

			$params['section_title_styles'] = array();

			if($params['title_color'] !== '') {
				$params['section_title_styles'][] = 'color: '.$params['title_color'];
			}

			if($params['title_text_transform'] !== '') {
				$params['section_title_styles'][] = 'text-transform: '.$params['title_text_transform'];
			}

			if($params['title_text_align'] !== '') {
				$params['section_title_styles'][] = 'text-align: '.$params['title_text_align'];
			}

			if($params['margin_bottom'] !== '') {
				$params['section_title_styles'][] = 'margin-bottom: '.voyage_mikado_filter_px($params['margin_bottom']).'px';
			}

			$params['title_tag'] = $this->getTitleTag($params);

			return voyage_mikado_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);
		}
	}

	private function getTitleTag($params) {
		switch($params['title_size']) {
			default:
				$titleTag = 'h1';
		}

		return $titleTag;
	}
}