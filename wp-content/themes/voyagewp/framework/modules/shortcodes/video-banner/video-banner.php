<?php
namespace Voyage\Modules\Shortcodes\VideoBanner;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class VideoBanner implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_video_banner';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Video Banner',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-video-banner extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Video Link',
					'param_name'  => 'video_link',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'attach_image',
					'heading'     => 'Video Banner',
					'param_name'  => 'video_banner',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'video_link'   => '',
			'video_banner' => ''
		);

		$params              = shortcode_atts($default_atts, $atts);
		$params['banner_id'] = rand();

		return voyage_mikado_get_shortcode_module_template_part('templates/video-banner', 'video-banner', '', $params);
	}

}