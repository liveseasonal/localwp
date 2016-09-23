<?php
use MikadofTours\Admin\BookingDashboard\BookingSubmenuPage;

if(!function_exists('mkdf_tours_load_admin_assets')) {
	function mkdf_tours_load_admin_assets() {
		global $post_type;

		if($post_type === 'tour-item') {
			wp_enqueue_script('mkdf-tour-booking', plugins_url('/assets/js/tour-booking.js', __FILE__), array('jquery'), '', true);
			wp_enqueue_script('jquery-ui-datepicker');

			wp_enqueue_style('mkdf-tour-booking', plugins_url('/assets/css/tour-booking.css', __FILE__));
			wp_enqueue_style('mkdf-tour-jquery-ui', plugins_url('assets/css/jquery-ui/jquery-ui.css', __FILE__));
		}

		wp_enqueue_script('mkdf-booking-dashboard', plugins_url('/assets/js/booking-dashboard.js', __FILE__), array(), '', true);
		wp_enqueue_style('mkdf-booking-dashboard', plugins_url('/assets/css/booking-dashboard.css', __FILE__), array(), '', 'all');
	}

	add_action('admin_enqueue_scripts', 'mkdf_tours_load_admin_assets');
}

if(!function_exists('mkdf_tours_init_booking_dashboard')) {

	function mkdf_tours_init_booking_dashboard() {
		BookingSubmenuPage::getInstance();
	}

	add_action('plugins_loaded', 'mkdf_tours_init_booking_dashboard');
}

if(!function_exists('mkdf_tours_add_ajax_url')) {

	function mkdf_tours_add_ajax_url() {
		wp_localize_script('mkdf-booking-dashboard', 'MikadofToursAjaxUrl', array(
			'url' => admin_url('admin-ajax.php')
		));
	}

	add_action('admin_enqueue_scripts', 'mkdf_tours_add_ajax_url');
}

if(!function_exists('mkdf_tours_testing')) {
    function mkdf_tours_testing() {
	    parse_str($_POST['periods'], $periods);
		echo json_encode($periods); exit;
    }

	//add_action('wp_ajax_save_tour_booking', 'mkdf_tours_testing');
}

