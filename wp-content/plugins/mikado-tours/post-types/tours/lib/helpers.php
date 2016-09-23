<?php

use MikadofTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;
use MikadofTours\CPT\Tours\Lib\TourPriceHelper;
use MikadofTours\CPT\Tours\Lib\TourSearch;
use MikadofTours\CPT\Tours\Lib\ToursQuery;

if(!function_exists('mkdf_tours_add_title_meta_box_to_tours')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_title_meta_box_to_tours($scope) {
		$scope[] = 'tour-item';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_title_meta', 'mkdf_tours_add_title_meta_box_to_tours');
}

if(!function_exists('mkdf_tours_save_meta_box_for_tours')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_save_meta_box_for_tours($scope) {
		$scope[] = 'tour-item';

	    return $scope;
    }

	add_filter('voyage_mikado_meta_box_post_types_save', 'mkdf_tours_save_meta_box_for_tours');
}

if(!function_exists('mkdf_tours_add_header_meta_box_to_tours')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_header_meta_box_to_tours($scope) {
		$scope[] = 'tour-item';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_header_meta', 'mkdf_tours_add_header_meta_box_to_tours');
}

if(!function_exists('mkdf_tours_add_general_meta_box_to_tours')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_general_meta_box_to_tours($scope) {
		$scope[] = 'tour-item';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_general_meta', 'mkdf_tours_add_general_meta_box_to_tours');
}

if(!function_exists('mkdf_tours_add_footer_meta_box_to_tours')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_footer_meta_box_to_tours($scope) {
		$scope[] = 'tour-item';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_footer_meta', 'mkdf_tours_add_footer_meta_box_to_tours');
}

if(!function_exists('mkdf_tours_add_content_bottom_meta_box_to_tours')) {
	/**
	 * @param $scope
	 *
	 * @return array
	 */
	function mkdf_tours_add_content_bottom_meta_box_to_tours($scope) {
		$scope[] = 'tour-item';

		return $scope;
	}

	add_filter('voyage_mikado_meta_box_scope_content_bottom_meta', 'mkdf_tours_add_content_bottom_meta_box_to_tours');
}

if(!function_exists('mkdf_tours_query')) {
	/**
	 * @return ToursQuery
	 */
	function mkdf_tours_query() {
		return ToursQuery::getInstance();
	}
}

if(!function_exists('mkdf_tours_search')) {
	/**
	 * @return TourSearch
	 */
	function mkdf_tours_search() {
		return TourSearch::getInstance();
	}
}

if(!function_exists('mkdf_tours_price_helper')) {
	/**
	 * @return TourPriceHelper
	 */
	function mkdf_tours_price_helper() {
		return TourPriceHelper::getInstance();
	}
}

if(!function_exists('mkdf_tours_register_single_sidebar')) {
	/**
	 * Register sidebar that will be used for tour single page
	 */
	function mkdf_tours_register_single_sidebar() {
		register_sidebar(array(
			'name'          => 'Tour Single Sidebar',
			'id'            => 'tour-single-sidebar',
			'description'   => esc_html__('Sidebar that is displayed on tour single page', 'mikado-tours'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5><span class="mkdf-sidearea-title">',
			'after_title'   => '</span><span class="mkdf-sidearea-line"></span></h5>'
		));
	}

	add_action('widgets_init', 'mkdf_tours_register_single_sidebar');
}

if(!function_exists('mkdf_tours_register_search_sidebar')) {
	/**
	 *
	 */
	function mkdf_tours_register_search_sidebar() {
		register_sidebar(array(
			'name'          => 'Tour Search Sidebar',
			'id'            => 'tour-search-sidebar',
			'description'   => esc_html__('Sidebar that is displayed on tours search page', 'mikado-tours'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		));
	}

	add_action('widgets_init', 'mkdf_tours_register_search_sidebar');
}

if(!function_exists('mkdf_tours_get_current_user_name')) {
	/**
	 * @return string
	 */
	function mkdf_tours_get_current_user_name() {
		$current_user = wp_get_current_user();

		if(!$current_user instanceof WP_User) {
			return '';
		}

		return $current_user->display_name;
	}
}

if(!function_exists('mkdf_tours_get_current_user_email')) {
	/**
	 * @return string
	 */
	function mkdf_tours_get_current_user_email() {
		$current_user = wp_get_current_user();

		if(!$current_user instanceof WP_User) {
			return '';
		}

		return $current_user->user_email;
	}
}

if(!function_exists('mkdf_tours_string_starts_with')) {
	/**
	 * Checks if $haystack starts with $needle and returns proper bool value
	 *
	 * @param $haystack string to check
	 * @param $needle string with which $haystack needs to start
	 *
	 * @return bool
	 */
	function mkdf_tours_string_starts_with($haystack, $needle) {
		if($haystack !== '' && $needle !== '') {
			return (substr($haystack, 0, strlen($needle)) == $needle);
		}

		return true;
	}
}

if(!function_exists('mkdf_tours_string_ends_with')) {
	/**
	 * Checks if $haystack ends with $needle and returns proper bool value
	 *
	 * @param $haystack string to check
	 * @param $needle string with which $haystack needs to end
	 *
	 * @return bool
	 */
	function mkdf_tours_string_ends_with($haystack, $needle) {
		if($haystack !== '' && $needle !== '') {
			return (substr($haystack, -strlen($needle), strlen($needle)) == $needle);
		}

		return true;
	}
}

if(!function_exists('mkdf_tours_override_tour_type_url')) {
	/**
	 * Overrides default term link for terms that belong to tour-category taxonomy
	 *
	 * @param $termlink
	 * @param $term
	 *
	 * @return string
	 */
	function mkdf_tours_override_tour_type_url($termlink, $term) {
		if($term->taxonomy !== 'tour-category') {
			return $termlink;
		}

		return esc_url(add_query_arg('type[]', $term->slug, get_post_type_archive_link('tour-item')));
	}

	add_filter('term_link', 'mkdf_tours_override_tour_type_url', 10, 2);
}

if(!function_exists('mkdf_tours_is_search_tours_page')) {
	/**
	 * @return string
	 */
	function mkdf_tours_is_search_tours_page() {
        $template_name = get_page_template_slug();

	    return strstr($template_name, 'search-tour-item-template');
    }
}

if(!function_exists('mkdf_tours_search_page_title_text')) {
	/**
	 * @param $title
	 *
	 * @return string
	 */
	function mkdf_tours_search_page_title_text($title) {
	    if(is_post_type_archive('tour-item')) {
		    $title = esc_html__('Tours Search', 'mikado-tours');
	    }

		return $title;
    }

	add_filter('voyage_mikado_title_text', 'mkdf_tours_search_page_title_text');
}

if(!function_exists('mkdf_tours_is_tour_bookable')) {
	/**
	 * @param null $tour_id
	 *
	 * @return bool
	 */
	function mkdf_tours_is_tour_bookable($tour_id = null) {
		$tour_id = is_null($tour_id) ? get_the_ID() : $tour_id;

	    $tour_periods = TourTimeStorage::getInstance()->getTourDates($tour_id);

	    return is_array($tour_periods) && count($tour_periods);
    }
}