<?php
namespace Voyage\Modules\Shortcodes\AnimationsHolder;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class AnimationsHolder implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_animations_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(
			array(
				'name'                    => 'Animations Holder',
				'base'                    => $this->base,
				'as_parent'               => array('except' => 'vc_row, vc_accordion, vc_tabs, mkdf_elements_holder, mkdf_pricing_tables, mkdf_text_slider_holder, mkdf_info_card_slider, mkdf_icon_slider'),
				'content_element'         => true,
				'category'                => 'by MIKADO',
				'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
				'show_settings_on_create' => true,
				'js_view'                 => 'VcColumnView',
				'params'                  => array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Animation',
						'param_name'  => 'css_animation',
						'value'       => array(
							'No animation'                    => '',
							'Elements Shows From Left Side'   => 'mkdf-element-from-left',
							'Elements Shows From Right Side'  => 'mkdf-element-from-right',
							'Elements Shows From Top Side'    => 'mkdf-element-from-top',
							'Elements Shows From Bottom Side' => 'mkdf-element-from-bottom',
							'Elements Shows From Fade'        => 'mkdf-element-from-fade'
						),
						'save_always' => true,
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'class'       => '',
						'heading'     => 'Animation Delay (ms)',
						'param_name'  => 'animation_delay',
						'value'       => '',
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'class'       => '',
						'heading'     => 'Animation Speed (ms)',
						'param_name'  => 'animation_speed',
						'value'       => '',
						'description' => ''
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'css_animation'   => '',
			'animation_delay' => '',
			'animation_speed' => '500'
		);

		$params            = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;
		$params['class']   = array(
			'mkdf-animations-holder',
			$params['css_animation']
		);

		$params['style'] = $this->getHolderStyles($params);
		$params['data']  = array(
			'data-animation' => $params['css_animation']
		);

		return voyage_mikado_get_shortcode_module_template_part('templates/animations-holder-template', 'animations-holder', '', $params);
	}

	private function getHolderStyles($params) {
		$styles = array();

		if($params['animation_delay'] !== '') {
			$styles[] = 'transition-delay: '.$params['animation_delay'].'ms';
			$styles[] = '-webkit-animation-delay: '.$params['animation_delay'].'ms';
			$styles[] = 'animation-delay: '.$params['animation_delay'].'ms';
		}

		if($params['animation_speed'] !== '') {
			$styles[] = 'animation-duration: '.$params['animation_speed'].'ms';
			$styles[] = '-webkit-animation-duration: '.$params['animation_speed'].'ms';
			$styles[] = '-moz-animation-duration: '.$params['animation_speed'].'ms';
		}

		return $styles;
	}
}