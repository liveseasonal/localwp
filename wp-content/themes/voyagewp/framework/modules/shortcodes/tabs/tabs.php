<?php
namespace Voyage\Modules\Tabs;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */
class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                    => 'Tabs',
			'base'                    => $this->getBase(),
			'as_parent'               => array('only' => 'mkdf_tab'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-tabs extended-custom-icon',
			'js_view'                 => 'VcColumnView',
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'admin-label' => true,
					'param_name'  => 'style',
					'value'       => array(
						'Horizontal With Text'           => 'horizontal_with_text',
						'Horizontal With Icons'          => 'horizontal_with_icons',
						'Horizontal With Text And Icons' => 'horizontal_with_text_and_icons',
						'Vertical With Text'             => 'vertical_with_text',
						'Vertical With Icons'            => 'vertical_with_icons',
						'Vertical With Text and Icons'   => 'vertical_with_text_and_icons'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'admin-label' => true,
					'param_name'  => 'navigation_width',
					'value'       => array(
						'Medium' => '',
						'Small'  => 'small'
					),
					'save_always' => true,
					'description' => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array(
							'vertical_with_text',
							'vertical_with_icons',
							'vertical_with_text_and_icons'
						)
					)
				)
			)
		));

	}

	public function render($atts, $content = null) {
		$args = array(
			'style'            => 'horizontal with_text',
			'navigation_width' => ''
		);

		$args   = array_merge($args, voyage_mikado_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		extract($params);

		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 *
		 */
		if(isset($matches[0])) {
			$tab_titles = $matches[0];
		}

		$tab_title_array = array();

		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}

		$params['tabs_titles'] = $tab_title_array;
		$params['tab_class']   = $this->getTabClass($params);
		$params['content']     = $content;
		$tabs_type             = $this->getTabType($params);

		$output = '';

		$output .= voyage_mikado_get_shortcode_module_template_part('templates/'.$tabs_type, 'tabs', '', $params);

		return $output;
	}

	/**
	 * Generates tabs type
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getTabType($params) {
		$tabStyle = $params['style'];
		$tabType  = 'with_text';
		if(strpos($tabStyle, 'with_text_and_icons') !== false) {
			$tabType = 'with_text_and_icons';
		} elseif(strpos($tabStyle, 'with_icons') !== false) {
			$tabType = 'with_icons';
		} elseif(strpos($tabStyle, 'with_text') !== false) {
			$tabType = 'with_text';
		}

		return $tabType;
	}

	/**
	 * Generates tabs class
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getTabClass($params) {
		$tabStyle = $params['style'];
		$tabClass = 'with_text';

		switch($tabStyle) {
			case 'horizontal_with_text':
				$tabClass = 'mkdf-horizontal mkdf-tab-text';
				break;
			case 'horizontal_with_icons':
				$tabClass = 'mkdf-horizontal mkdf-tab-icon';
				break;
			case 'horizontal_with_text_and_icons':
				$tabClass = 'mkdf-horizontal mkdf-tab-text-icon';
				break;
			case 'vertical_with_text':
				$tabClass = 'mkdf-vertical mkdf-tab-text';
				break;
			case 'vertical_with_icons':
				$tabClass = 'mkdf-vertical mkdf-tab-icon';
				break;
			case 'vertical_with_text_and_icons':
				$tabClass = 'mkdf-vertical mkdf-tab-text-icon';
				break;
		}

		if(in_array($tabStyle, array('vertical_with_text', 'vertical_with_icons', 'vertical_with_text_and_icons'))) {
			if($params['navigation_width'] !== '') {
				$tabClass .= ' mkdf-vertical-nav-width-'.$params['navigation_width'];
			}
		}

		return $tabClass;
	}
}