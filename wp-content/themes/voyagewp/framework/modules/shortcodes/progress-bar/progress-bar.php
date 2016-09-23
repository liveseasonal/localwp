<?php
namespace Voyage\Modules\ProgressBar;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProgressBar implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => 'Progress Bar',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-progress-bar extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Title',
					'param_name'  => 'title',
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => 'Percentage',
					'param_name'  => 'percent',
					'description' => ''
				),
				array(
					'type'        => 'colorpicker',
					'admin_label' => true,
					'heading'     => 'Bar Color',
					'param_name'  => 'bar_color',
					'description' => ''
				),
				array(
					'type'        => 'colorpicker',
					'admin_label' => true,
					'heading'     => 'Inactive Bar Color',
					'param_name'  => 'inactive_bar_color',
					'description' => ''
				),
			)
		));

	}

	public function render($atts, $content = null) {
		$args   = array(
			'title'              => '',
			'percent'            => '100',
			'bar_color'          => '',
			'inactive_bar_color' => ''
		);
		$params = shortcode_atts($args, $atts);

		//Extract params for use in method
		extract($params);

		$params['percentage_classes'] = $this->getPercentageClasses($params);

		$params['bar_styles']         = $this->getBarStyles($params);
		$params['inactive_bar_style'] = $this->getInactiveBarStyle($params);

		//init variables
		$html = voyage_mikado_get_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);

		return $html;

	}

	/**
	 * Generates css classes for progress bar
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getPercentageClasses($params) {

		$percentClassesArray = array();

		if(!empty($params['percentage_type']) != '') {

			if($params['percentage_type'] == 'floating') {

				$percentClassesArray[] = 'mkdf-floating';

				if($params['floating_type'] == 'floating_outside') {

					$percentClassesArray[] = 'mkdf-floating-outside';

				} elseif($params['floating_type'] == 'floating_inside') {

					$percentClassesArray[] = 'mkdf-floating-inside';
				}

			} elseif($params['percentage_type'] == 'static') {

				$percentClassesArray[] = 'mkdf-static';

			}
		}

		return implode(' ', $percentClassesArray);
	}

	private function getBarStyles($params) {
		$styles = array();

		if($params['bar_color'] !== '') {
			$styles[] = 'background-color: '.$params['bar_color'];
		}

		return $styles;
	}

	private function getInactiveBarStyle($params) {
		$style = array();

		if($params['inactive_bar_color'] !== '') {
			$style[] = 'background-color: '.$params['inactive_bar_color'];
		}

		return $style;
	}

}