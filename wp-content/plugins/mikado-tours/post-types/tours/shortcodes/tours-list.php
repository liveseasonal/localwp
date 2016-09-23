<?php
namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\CPT\Tours\Lib\ToursQuery;
use MikadofTours\Lib\ShortcodeInterface;

class ToursList implements ShortcodeInterface {
	private $base;

	/**
	 * ToursCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_list';

		add_action('vc_before_init', array($this, 'vcMap'));

		add_action('wp_ajax_nopriv_mkdf_tours_list_ajax_pagination', array($this, 'handleLoadMore'));
		add_action('wp_ajax_mkdf_tours_list_ajax_pagination', array($this, 'handleLoadMore'));
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
			'name'                      => 'Tours List',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-tours-list extended-custom-icon',
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
						'heading'     => 'Gallery Fonts',
						'param_name'  => 'gallery_fonts',
						'value'       => array(
							'Standard' => 'standard',
							'Small'  => 'small'
						),
						'admin_label' => true,
						'description' => 'Default value is Standard',
						'dependency'  => array('element' => 'tour_type', 'value' => 'gallery')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Enable Category Filter',
						'param_name'  => 'filter',
						'value'       => array(
							'No'  => 'no',
							'Yes' => 'yes'
						),
						'admin_label' => true,
						'save_always' => true,
						'description' => 'Default value is No',
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
						'heading'     => 'Number of Columns',
						'param_name'  => 'tour_item',
						'value'       => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4'
						),
						'admin_label' => true,
						'save_always' => true,
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
						'type'        => 'dropdown',
						'heading'     => 'Enable Load More',
						'param_name'  => 'enable_load_more',
						'value'       => array(
							'No'  => 'no',
							'Yes' => 'yes'
						),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Load More Button Text',
						'param_name'  => 'load_more_text',
						'dependency'  => array('element' => 'enable_load_more', 'value' => 'yes'),
						'description' => 'Default text is "Load More"'
					)
				),
				mkdf_tours_query()->queryVCParams()
			) //close array_merge
		));
	}

	public function handleLoadMore() {
		$fields = $this->parseRequest();

		$returnObject = new \stdClass();

		$query = mkdf_tours_query()->buildQueryObject($fields);

		if($query->have_posts()) {
			ob_start();

			$this->getToursQueryTemplate(array(
				'query'     => $query,
				'tour_type' => $fields['tour_type'],
				'caller'    => $this,
				'params'    => $fields
			));

			$returnObject->html      = ob_get_clean();
			$returnObject->havePosts = true;
			$returnObject->message   = 'Success';
			$returnObject->nextPage  = $fields['next_page'] + 1;
		} else {
			$returnObject->havePosts = false;
			$returnObject->message   = esc_html__('No more tours.', 'mikado-tours');
		}

		echo json_encode($returnObject);
		exit;
	}

	private function parseRequest() {
		if(empty($_POST['fields'])) {
			return false;
		}

		parse_str($_POST['fields'], $fields);

		if(!(is_array($fields) && count($fields))) {
			return false;
		}

		return $fields;
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
			'filter'                  => 'no',
			'tour_type'               => '',
			'gallery_fonts'           => 'standard',
			'tour_item'               => '',
			'image_size'              => 'full',
			'title_size'              => '',
			'text_length'             => '90',
			'enable_hover'            => 'yes',
			'enable_load_more'        => '',
			'load_more_text'          => '',
			'custom_image_dimensions' => ''
		);

		$args   = array_merge($args, mkdf_tours_query()->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);
		$query  = mkdf_tours_query()->buildQueryObject($params);

		$params['query']  = $query;
		$params['caller'] = $this;
		$params['hover_class'] = '';
		$params['title_style'] = '';

		$params['thumb_size'] = mkdf_tours_get_image_size_param($params);

		if($params['filter'] == 'yes') {
			$params['filter_categories'] = $this->getFilterCategories($params);
		}


		if ($params['enable_hover'] == 'yes'){
			$params['hover_class'] = 'mkdf-tours-gallery-with-hover';
		}

		if ($params['title_size'] !== ''){
			$params['title_style'] = 'font-size:'.voyage_mikado_filter_px($params['title_size']).'px';
		}

		$params['holder_classes'] = $this->getHolderInnerClasses($params);
		$params['enable_load_more']        = $params['enable_load_more'] === 'yes';
		$params['load_more_text']          = empty($params['load_more_text']) ? esc_html__('Load More', 'mikado-tours') : $params['load_more_text'];
		$params['display_load_more_data']  = (int) $params['number'] == $params['number'] && $params['number'] > 0;

		return mkdf_tours_get_tour_module_template_part('templates/tours-list-holder', 'tours', 'shortcodes', '', $params);
	}

	public function getItemTemplate($tour_type = 'standard', $params = array()) {
		echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_type, 'tours', '', '', $params);
	}

	public function getFilterCategories($params) {

		$cat_id       = 0;
		$top_category = '';

		if(!empty($params['tour_category'])) {

			$top_category = get_term_by('slug', $params['tour_category'], 'tour-category');
			if(isset($top_category->term_id)) {
				$cat_id = $top_category->term_id;
			}

		}

		$args = array(
			'child_of' => $cat_id,
		);

		$filter_categories = get_terms('tour-category', $args);

		return $filter_categories;

	}

	public function getToursQueryTemplate($params) {
		echo mkdf_tours_get_tour_module_template_part('templates/tours-list-loop', 'tours', 'shortcodes', '', $params);
	}

	private function getHolderInnerClasses($params) {
		$holder_classes = array();

		switch($params['tour_item']) {
			case '1':
				$number_of_columns_class = 'mkdf-one-item';
				break;
			case '2':
				$number_of_columns_class = 'mkdf-two-items';
				break;
			case '3':
				$number_of_columns_class = 'mkdf-three-items';
				break;
			case '4':
				$number_of_columns_class = 'mkdf-four-items';
				break;
			default:
				$number_of_columns_class = 'mkdf-three-items';
		}
		$holder_classes[] = $number_of_columns_class;


		switch($params['gallery_fonts']) {
			case 'standard':
				$gallery_fonts_class = '';
				break;
			case 'small':
				$gallery_fonts_class = 'mkdf-tours-item-with-smaller-spacing';
				break;
			default:
				$gallery_fonts_class = '';
		}

		if ($gallery_fonts_class !== ''){
			$holder_classes[] = $gallery_fonts_class;
		}

		return implode(' ', $holder_classes);
	}

}