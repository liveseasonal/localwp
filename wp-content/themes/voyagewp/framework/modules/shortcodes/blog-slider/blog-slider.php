<?php
namespace Voyage\Modules\Shortcodes\BlogSlider;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

class BlogSlider implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_blog_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => 'Blog Slider',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-slider extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
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
					'type'        => 'textfield',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => 'Text length',
					'param_name'  => 'text_length',
					'description' => 'Number of characters'
				)
			)
		));

	}

	public function render($atts, $content = null) {

		$default_atts = array(
			'number_of_posts' => '',
			'order_by'        => '',
			'order'           => '',
			'category'        => '',
			'text_length'     => '90',
		);

		$params = shortcode_atts($default_atts, $atts);

		$queryParams = $this->generateBlogQueryArray($params);

		$query = new \WP_Query($queryParams);

		$params['query'] = $query;

		return voyage_mikado_get_shortcode_module_template_part('templates/blog-slider-template', 'blog-slider', '', $params);
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
}