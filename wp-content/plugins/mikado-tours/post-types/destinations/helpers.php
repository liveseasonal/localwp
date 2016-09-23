<?php

if(!function_exists('mkdf_tours_get_destinations')) {
	/**
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function mkdf_tours_get_destinations($first_empty = false) {
		$destinations = array();

		if($first_empty) {
			$destinations[''] = '';
		}

		$args = array(
			'post_type'      => 'destinations',
			'post_status'    => 'publish',
			'posts_per_page' => -1
		);

		$query_results = new WP_Query($args);

		if($query_results->have_posts()) {

			while($query_results->have_posts()) {

				$query_results->the_post();

				$destinations[get_the_ID()] = get_the_title();
			}
		}

		wp_reset_postdata();

		return $destinations;
	}
}

if(!function_exists('mkdf_tours_save_meta_box_for_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_save_meta_box_for_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_post_types_save', 'mkdf_tours_save_meta_box_for_destinations');
}

if(!function_exists('mkdf_tours_add_title_meta_box_to_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_title_meta_box_to_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_title_meta', 'mkdf_tours_add_title_meta_box_to_destinations');
}

if(!function_exists('mkdf_tours_add_header_meta_box_to_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_header_meta_box_to_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_header_meta', 'mkdf_tours_add_header_meta_box_to_destinations');
}

if(!function_exists('mkdf_tours_add_general_meta_box_to_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_general_meta_box_to_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_general_meta', 'mkdf_tours_add_general_meta_box_to_destinations');
}

if(!function_exists('mkdf_tours_add_footer_meta_box_to_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_footer_meta_box_to_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_footer_meta', 'mkdf_tours_add_footer_meta_box_to_destinations');
}

if(!function_exists('mkdf_tours_add_content_bottom_meta_box_to_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_content_bottom_meta_box_to_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_content_bottom_meta', 'mkdf_tours_add_content_bottom_meta_box_to_destinations');
}

if(!function_exists('mkdf_tours_add_sidebar_meta_box_to_destinations')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_sidebar_meta_box_to_destinations($scope) {
		$scope[] = 'destinations';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_sidebar_meta', 'mkdf_tours_add_sidebar_meta_box_to_destinations');
}