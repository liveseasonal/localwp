<?php
namespace Voyage\Modules\Tab;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tab
 */
class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_tab';
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
			'name'                    => 'Tab',
			'base'                    => $this->getBase(),
			'as_parent'               => array('except' => 'vc_row'),
			'as_child'                => array('only' => 'mkdf_tabs'),
			'is_container'            => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-tab extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'                  => array_merge(
				\VoyageMikadoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Title',
						'param_name'  => 'title',
						'description' => ''
					)
				)
			)
		));

	}

	public function render($atts, $content = null) {

		$default_atts = array(
			'title'  => 'Tab',
			'tab_id' => ''
		);

		$default_atts = array_merge($default_atts, voyage_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$iconPackName   = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $params[$iconPackName];

		$rand_number     = rand(0, 1000);
		$params['title'] = $params['title'].'-'.$rand_number;

		$params['content'] = $content;

		$output = '';
		$output .= voyage_mikado_get_shortcode_module_template_part('templates/tab_content', 'tabs', '', $params);

		return $output;

	}
}