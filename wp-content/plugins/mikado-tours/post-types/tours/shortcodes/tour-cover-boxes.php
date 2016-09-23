<?php
namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\CPT\Tours\Lib\ToursQuery;
use MikadofTours\Lib\ShortcodeInterface;

/**
 * Class TourCoverBoxes
 * @package MikadofTours\CPT\Tours\Shortcodes
 */
class TourCoverBoxes implements ShortcodeInterface {
	private $base;

	/**
	 * ToursCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tour_cover-boxes';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => 'Tour Cover Boxes',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-tour-cover-boxes extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Text length',
						'param_name'  => 'text_length',
						'description' => 'Number of words'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Image Proportions',
						'param_name'  => 'image_size',
						'value'       => array(
							'Original'  => 'full',
							'Square'    => 'square',
							'Landscape' => 'landscape',
							'Portrait'  => 'portrait',
							'Custom'    => 'custom'
						),
						'save_always' => true,
						'admin_label' => true,
						'description' => '',
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Image Dimensions',
						'param_name'  => 'custom_image_dimensions',
						'value'       => '',
						'description' => 'Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height)',
						'dependency'  => array('element' => 'image_size', 'value' => 'custom')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Active Cover Box',
						'param_name'  => 'active_cover_box',
						'value'       => array(
							'First'  => '1',
							'Second' => '2',
							'Third'  => '3'
						),
						'save_always' => true,
						'admin_label' => true,
						'description' => '',
					),
				),
				mkdf_tours_query()->queryVCParams()
			) //close array_merge
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'text_length'             => '90',
			'image_size'              => 'full',
			'custom_image_dimensions' => '',
			'active_cover_box'        => '1'
		);

		$args   = array_merge($args, mkdf_tours_query()->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);
		$query  = mkdf_tours_query()->buildQueryObject($params);

		$params['query']  = $query;
		$params['caller'] = $this;

		$params['thumb_size'] = mkdf_tours_get_image_size_param($params);

		return mkdf_tours_get_tour_module_template_part('templates/tour-cover-boxes-holder', 'tours', 'shortcodes', '', $params);
	}

	/**
	 * @param array $params
	 */
	public function getItemTemplate($params = array()) {
		echo mkdf_tours_get_tour_module_template_part('templates/tour-item/cover-box-item', 'tours', '', '', $params);
	}
}