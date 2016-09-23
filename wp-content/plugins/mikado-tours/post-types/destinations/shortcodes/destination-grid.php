<?php
namespace MikadofTours\CPT\Destination\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class DestinationGrid implements ShortcodeInterface {
	private $base;

	/**
	 * DestinationGrid constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_destination_grid';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Destinations Grid',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-destinations-grid extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => 'Order By',
					'param_name'  => 'order_by',
					'value'       => array(
						'Menu Order' => 'menu_order',
						'Title'      => 'title',
						'Date'       => 'date'
					),
					'admin_label' => true,
					'save_always' => true,
					'description' => '',
					'group'       => 'Query Options'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Order',
					'param_name'  => 'order',
					'value'       => array(
						'ASC'  => 'ASC',
						'DESC' => 'DESC',
					),
					'admin_label' => true,
					'save_always' => true,
					'description' => '',
					'group'       => 'Query Options'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Number of Destinations Per Page',
					'param_name'  => 'number',
					'value'       => '-1',
					'admin_label' => true,
					'description' => '(enter -1 to show all)',
					'group'       => 'Query Options'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Show Only Destinations with Listed IDs',
					'param_name'  => 'selected_destinations',
					'value'       => '',
					'admin_label' => true,
					'description' => 'Delimit ID numbers by comma (leave empty for all)',
					'group'       => 'Query Options'
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'order_by'              => 'date',
			'order'                 => 'DESC',
			'number'                => '-1',
			'selected_destinations' => ''
		);

		$params = shortcode_atts($args, $atts);

		$query = $this->buildQueryObject($params);

		$params['query']  = $query;
		$params['caller'] = $this;

		return mkdf_tours_get_tour_module_template_part('templates/destination-grid-template', 'destinations', 'shortcodes', '', $params);
	}

	private function buildQueryObject($params) {
		$queryArray['post_type'] = 'destinations';

		if(!empty($params['order_by'])) {
			$queryArray['orderby'] = $params['order_by'];
		}

		if(!empty($params['order'])) {
			$queryArray['order'] = $params['order'];
		}

		if(!empty($params['number'])) {
			$queryArray['posts_per_page'] = $params['number'];
		}

		$toursIds = null;
		if(!empty($params['selected_destinations'])) {
			$toursIds               = explode(',', $params['selected_destinations']);
			$queryArray['post__in'] = $toursIds;
		}

		return new \WP_Query($queryArray);
	}
}