<?php
namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\CPT\Tours\Lib\ToursQuery;
use MikadofTours\Lib\ShortcodeInterface;

class ToursCarousel implements ShortcodeInterface {
	private $base;

	/**
	 * ToursCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_carousel';

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
			'name'                      => 'Tours Carousel',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-tours-carousel extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Tours List Type',
						'param_name'  => 'tour_type',
						'value'       => array(
							'Standard' => 'standard',
							'Gallery'  => 'gallery'
						),
						'admin_label' => true,
						'save_always' => true,
						'description' => 'Default value is Standard',
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
						'heading'     => 'Enable Hover',
						'param_name'  => 'enable_hover',
						'value'       => array(
							'Yes' => 'yes',
							'No'  => 'no',
						),
						'admin_label' => true,
						'save_always' => true,
						'dependency'  => array('element' => 'tour_type', 'value' => 'gallery')
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Title Size (px)',
						'param_name'  => 'title_size'
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Text length',
						'param_name'  => 'text_length',
						'description' => 'Number of words'
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
			'tour_type'               => '',
			'image_size'              => 'full',
			'custom_image_dimensions' => '',
			'enable_hover'            => 'yes',
			'title_size'              => '',
			'text_length'             => '90',
		);

		$args   = array_merge($args, mkdf_tours_query()->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);
		$query  = mkdf_tours_query()->buildQueryObject($params);

		$params['query']  = $query;
		$params['caller'] = $this;
		$params['hover_class'] = '';
		$params['title_style'] = '';

		$params['thumb_size'] = mkdf_tours_get_image_size_param($params);

		if ($params['enable_hover'] == 'yes'){
			$params['hover_class'] = 'mkdf-tours-gallery-with-hover';
		}
		
		if ($params['title_size'] !== ''){
			$params['title_style'] = 'font-size:'.voyage_mikado_filter_px($params['title_size']).'px';
		}

		return mkdf_tours_get_tour_module_template_part('templates/tours-carousel-holder', 'tours', 'shortcodes', '', $params);
	}

	public function getItemTemplate($tour_type = 'standard', $params = array()) {
		echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_type, 'tours', '', '', $params);
	}
}