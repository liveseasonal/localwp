<?php

namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class TopReviewsCarousel implements ShortcodeInterface {
	private $base;

	/**
	 * TopReviewsCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_top_reviews_carousel';

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
		$criteria_ratings = mkdf_tours_reviews_get_criteria();

		$criteria_ratings_vc = array();

		if(is_array($criteria_ratings) && count($criteria_ratings)) {
			foreach($criteria_ratings as $criteria_rating) {
				$criteria_ratings_vc[$criteria_rating->name] = $criteria_rating->id;
			}
		}

		vc_map(array(
			'name'                      => 'Top Reviews Carousel',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-top-reviews-carousel extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => '',
					'admin_label' => true,
					'save_always' => true,
					'description' => 'Leave empty for all'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Number of Reviews',
					'param_name'  => 'number_of_reviews',
					'value'       => '',
					'admin_label' => true,
					'save_always' => true,
					'description' => 'Leave empty for all'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Order by Review Criteria',
					'param_name'  => 'review_criteria',
					'value'       => $criteria_ratings_vc,
					'admin_label' => true,
					'save_always' => true
				),
			)
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
			'title'             => '',
			'number_of_reviews' => '',
			'review_criteria'   => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['reviews'] = $this->getTopReviews($params);

		return mkdf_tours_get_tour_module_template_part('templates/top-reviews-carousel', 'tours', 'shortcodes', '', $params);
	}

	/**
	 * @param $params
	 *
	 * @return array|bool|null|object
	 */
	private function getTopReviews($params) {
		global $wpdb;

		if(empty($params['review_criteria'])) {
			return false;
		}

		$prepareArray = array();

		$sql = "SELECT {$wpdb->prefix}comments.*, {$wpdb->prefix}review_ratings.rating, {$wpdb->prefix}posts.post_title
				FROM {$wpdb->prefix}comments
				LEFT JOIN {$wpdb->prefix}review_ratings ON {$wpdb->prefix}comments.comment_ID = {$wpdb->prefix}review_ratings.comment_id
				LEFT JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}comments.comment_post_ID
				WHERE {$wpdb->prefix}review_ratings.criteria_id = %d
				AND wp_review_ratings.rating = 5";

		$prepareArray[] = $params['review_criteria'];

		if(!empty($params['number_of_reviews'])) {
			$sql .= " LIMIT %d";

			$prepareArray[] = $params['number_of_reviews'];
		}

		$results = $wpdb->get_results($wpdb->prepare($sql, $prepareArray));

		if(!(is_array($results) && count($results))) {
			return false;
		}

		return $results;
	}
}