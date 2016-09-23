<?php

namespace MikadofTours\CPT\Tours\Lib;

use MikadofTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;

class ToursQuery {
	/**
	 * @var private instance of current class
	 */
	private static $instance;

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}

	/**
	 * Returns current instance of class
	 * @return ToursQuery
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	public function queryVCParams() {
		return array(
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
				'heading'     => 'Tour Category',
				'param_name'  => 'tour_category',
				'value'       => '',
				'admin_label' => true,
				'description' => 'Enter one tour category slug (leave empty for showing all categories)',
				'group'       => 'Query Options'
			),
			array(
				'type'        => 'textfield',
				'heading'     => 'Number of Tours Per Page',
				'param_name'  => 'number',
				'value'       => '-1',
				'admin_label' => true,
				'description' => '(enter -1 to show all)',
				'group'       => 'Query Options'
			),
			array(
				'type'        => 'textfield',
				'heading'     => 'Show Only Tours with Listed IDs',
				'param_name'  => 'selected_tours',
				'value'       => '',
				'admin_label' => true,
				'description' => 'Delimit ID numbers by comma (leave empty for all)',
				'group'       => 'Query Options'
			)
		);
	}

	public function getShortcodeAtts() {
		return array(
			'order_by'       => 'date',
			'order'          => 'ASC',
			'number'         => '-1',
			'tour_category'  => '',
			'selected_tours' => '',
			'paged'          => ''
		);
	}

	public function buildQueryObject($params, $meta_query_array = null) {
		$queryArray = array(
			'post_type'      => 'tour-item',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => '-1'
		);

		if(!empty($params['order_by'])) {
			$queryArray['orderby'] = $params['order_by'];
		}

		if(!empty($params['order'])) {
			$queryArray['order'] = $params['order'];
		}

		if(!empty($params['number'])) {
			$queryArray['posts_per_page'] = $params['number'];
		}

		if(!empty($params['tour_category'])) {
			$queryArray['tour-category'] = $params['tour_category'];
		}

		$toursIds = null;
		if(!empty($params['selected_tours'])) {
			$toursIds             = explode(',', $params['selected_tours']);
			$queryArray['post__in'] = $toursIds;
		}

		if(!empty($params['next_page'])) {
			$queryArray['paged'] = $params['next_page'];

		} else {
			$queryArray['paged'] = 1;
		}

		if(is_array($meta_query_array) && count($meta_query_array)) {
			$queryArray = array_merge($queryArray, $meta_query_array);
		}

		return new \WP_Query($queryArray);
	}
}