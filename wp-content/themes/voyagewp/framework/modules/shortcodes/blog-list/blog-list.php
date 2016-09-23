<?php

namespace Voyage\Modules\BlogList;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogList
 */
class BlogList implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_blog_list';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => 'Blog List',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Type', 'voyage'),
					'param_name'  => 'type',
					'value'       => array(
						'Grid Type 1'  => 'grid-type-1',
						'Grid Type 2'  => 'grid-type-2',
						'Masonry'      => 'masonry',
						'Minimal'      => 'minimal',
						'Image in box' => 'image-in-box'
					),
					'description' => '',
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Number of Posts',
					'param_name'  => 'number_of_posts',
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Number of Columns',
					'param_name'  => 'number_of_columns',
					'value'       => array(
						'One'   => '1',
						'Two'   => '2',
						'Three' => '3',
						'Four'  => '4'
					),
					'description' => '',
					'dependency'  => Array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2')),
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Order By',
					'param_name'  => 'order_by',
					'value'       => array(
						'Title' => 'title',
						'Date'  => 'date'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Order',
					'param_name'  => 'order',
					'value'       => array(
						'ASC'  => 'ASC',
						'DESC' => 'DESC'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Category Slug',
					'param_name'  => 'category',
					'description' => 'Leave empty for all or use comma for list'
				),
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Hide Image?',
					'param_name'  => 'hide_image',
					'value'       => array(
						'Default' => '',
						'Yes'     => 'yes',
						'No'      => 'no'
					),
					'description' => '',
					'save_always' => true,
					'dependency'  => array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2'))
				),
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Image Size',
					'param_name'  => 'image_size',
					'value'       => array(
						'Original'  => 'original',
						'Landscape' => 'landscape',
						'Square'    => 'square',
						'Custom'    => 'custom'
					),
					'description' => '',
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Custom Image Size',
					'param_name'  => 'custom_image_size',
					'description' => 'Enter image size in pixels: 200x100 (Width x Height).',
					'dependency'  => array('element' => 'image_size', 'value' => 'custom')
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Text length',
					'param_name'  => 'text_length',
					'description' => 'Number of characters'
				),
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => 'Title Tag',
					'param_name'  => 'title_tag',
					'value'       => array(
						''   => '',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					),
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => 'Remove Comments on Image In Box?',
					'param_name'  => 'remove_category',
					'value'       => array(
						'Yes' => 'yes',
						'No'  => 'no'
					),
					'save_always' => true,
					'dependency'  => array('element' => 'type', 'value' => 'image-in-box')
				),
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => 'Style',
					'param_name'  => 'style',
					'value'       => array(
						''      => '',
						'Light' => 'light',
						'Dark'  => 'dark'
					),
					'description' => '',
					'dependency'  => array(
						'element' => 'type',
						'value'   => array('grid-type-1', 'grid-type-2')
					)
				)
			)
		));

	}

	public function render($atts, $content = null) {

		$default_atts = array(
			'type'              => 'grid-type-1',
			'number_of_posts'   => '',
			'number_of_columns' => '',
			'image_size'        => 'original',
			'custom_image_size' => '',
			'remove_category'   => 'no',
			'order_by'          => '',
			'order'             => '',
			'category'          => '',
			'title_tag'         => 'h3',
			'text_length'       => '90',
			'hide_image'        => '',
			'style'             => ''
		);

		$params                   = shortcode_atts($default_atts, $atts);
		$params['holder_classes'] = $this->getBlogHolderClasses($params);

		if(empty($atts['title_tag'])) {
			if(in_array($params['type'], array('image-in-box', 'minimal'))) {
				$params['title_tag'] = 'h5';
			}
		}

		$queryArray             = $this->generateBlogQueryArray($params);
		$query_result           = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$params['use_custom_image_size'] = $params['image_size'] === 'custom' && !empty($params['custom_image_size']);

		if($params['use_custom_image_size']) {
			$params['custom_image_dimensions'] = $this->splitCustomImageSize($params['custom_image_size']);
		} else {
			$thumbImageSize             = $this->generateImageSize($params);
			$params['thumb_image_size'] = $thumbImageSize;
		}

		$params['hide_image'] = !empty($params['hide_image']) && $params['hide_image'] === 'yes';

		$html = '';
		$html .= voyage_mikado_get_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);

		return $html;

	}

	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getBlogHolderClasses($params) {
		$holderClasses = array(
			'mkdf-blog-list-holder',
			$this->getColumnNumberClass($params),
			'mkdf-'.$params['type']
		);

		if($params['hide_image'] === 'yes' && in_array($params['type'], array('grid-type-1', 'grid-type-2'))) {
			$holderClasses[] = 'mkdf-blog-list-without-image';
		}

		if(in_array($params['type'], $this->getGridTypes())) {
			$holderClasses[] = 'mkdf-blog-list-grid';

			if($params['style'] !== '') {
				$holderClasses[] = 'mkdf-blog-list-'.$params['style'];
			}
		}

		return $holderClasses;

	}

	/**
	 * Generates column classes for boxes type
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getColumnNumberClass($params) {

		$columnsNumber = '';
		$type          = $params['type'];
		$columns       = $params['number_of_columns'];

		if(in_array($type, $this->getGridTypes())) {
			switch($columns) {
				case 1:
					$columnsNumber = 'mkdf-one-column';
					break;
				case 2:
					$columnsNumber = 'mkdf-two-columns';
					break;
				case 3:
					$columnsNumber = 'mkdf-three-columns';
					break;
				case 4:
					$columnsNumber = 'mkdf-four-columns';
					break;
				default:
					$columnsNumber = 'mkdf-one-column';
					break;
			}
		}

		return $columnsNumber;
	}

	private function getGridTypes() {
		return array(
			'grid-type-1',
			'grid-type-2'
		);
	}

	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateBlogQueryArray($params) {

		$queryArray = array(
			'orderby'        => $params['order_by'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'category_name'  => $params['category']
		);

		return $queryArray;
	}

	/**
	 * Generates image size option
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function generateImageSize($params) {
		$imageSize = $params['image_size'];

		switch($imageSize) {
			case 'landscape':
				$thumbImageSize = 'voyage_landscape';
				break;
			case 'square';
				$thumbImageSize = 'voyage_square';
				break;
			default:
				$thumbImageSize = 'full';
				break;
		}

		return $thumbImageSize;
	}

	private function splitCustomImageSize($customImageSize) {
		if(!empty($customImageSize)) {
			$imageSize = trim($customImageSize);
			//Find digits
			preg_match_all('/\d+/', $imageSize, $matches);
			if(!empty($matches[0])) {
				return array(
					$matches[0][0],
					$matches[0][1]
				);
			}
		}

		return false;
	}


}
