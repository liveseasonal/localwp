<?php

use MikadofTours\CPT\Tours\Lib\BookingHandler;

if(!function_exists('mkdf_tours_add_my_bookings_nav_item')) {
	/**
	 * @param $items
	 * @param $dashboard_url
	 *
	 * @return array
	 */
	function mkdf_tours_add_my_bookings_nav_item($items, $dashboard_url) {
		$items['my-bookings'] = array(
			'url'  => esc_url(add_query_arg(array('user-action' => 'my-bookings'), $dashboard_url)),
			'text' => esc_html__('My Bookings', 'mikado-tours')
		);

		return $items;
    }

	add_filter('mkdf_membership_dashboard_navigation_pages', 'mkdf_tours_add_my_bookings_nav_item', 10, 2);
}

if(!function_exists('mkdf_tours_add_my_bookings_page_content')) {
    function mkdf_tours_add_my_bookings_page_content($pages) {
	    $user = wp_get_current_user();

	    if(!$user) {
		    return $pages;
	    }

	    $user_bookings = BookingHandler::getInstance()->getUserBookings($user->user_email);

	    $pages['my-bookings'] = mkdf_tours_get_tour_module_template_part('templates/user-dashboard/my-bookings', 'tours', '', '', compact('user_bookings'));

		return $pages;
    }

	add_filter('mkdf_membership_dashboard_pages', 'mkdf_tours_add_my_bookings_page_content');
}