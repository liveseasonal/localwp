<?php
/*
Plugin Name: Mikado Tours
Description: Plugin that adds tours post types needed by theme
Author: Mikado Themes
Version: 1.0
*/

require_once 'load.php';

define('MIKADOF_TOURS_MAIN_FILE_PATH', __FILE__);

use MikadofTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;
use MikadofTours\CPT;
use MikadofTours\CPT\Tours\Lib\BookingHandler;
use MikadofTours\CPT\Tours\Lib\PageTemplater;
use MikadofTours\CPT\Tours\Lib\TourSearch;
use MikadofTours\Lib;
use MikadofTours\DatabaseSetup\TablesSetup;

add_action('after_setup_theme', array(CPT\PostTypesRegister::getInstance(), 'register'));

Lib\ShortcodeLoader::getInstance()->load();
TablesSetup::getInstance()->initialize();
TourTimeStorage::getInstance()->initialize();
BookingHandler::getInstance()->initialize();
PageTemplater::getInstance()->initialize();
TourSearch::getInstance()->initialize();

if(!function_exists('mkdf_tours_activation')) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines voyage_mikado_core_on_activate action
	 */
	function mkdf_tours_activation() {
		do_action('voyage_mikado_core_on_activate');

		MikadofTours\CPT\PostTypesRegister::getInstance()->register();

		flush_rewrite_rules();
	}

	register_activation_hook(__FILE__, 'mkdf_tours_activation');
}

if(!function_exists('mkdf_tours_text_domain')) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function mkdf_tours_text_domain() {
		load_plugin_textdomain('mikado-tours', false, MIKADOF_TOURS_REL_PATH.'/languages');
	}

	add_action('plugins_loaded', 'mkdf_tours_text_domain');
}

if(!function_exists('mkdf_tours_scripts')) {
	/**
	 * Loads plugin scripts
	 */
	function mkdf_tours_scripts() {
		$array_deps = array(
			'underscore',
			'jquery-ui-tabs',
			'jquery-ui-datepicker'
		);

		if(mkdf_tours_theme_installed()) {
			$array_deps[] = 'voyage_mikado_modules';
		}

		wp_enqueue_script('mkdf_tours_script', plugins_url(MIKADOF_TOURS_REL_PATH.'/assets/js/script.js'), $array_deps, false, true);

		wp_enqueue_script('nouislider', plugins_url(MIKADOF_TOURS_REL_PATH).'/assets/js/nouislider.min.js', array(), false, true);
		wp_enqueue_style('nouislider', plugins_url(MIKADOF_TOURS_REL_PATH).'/assets/css/nouislider.min.css');
		wp_enqueue_script('typeahead', plugins_url(MIKADOF_TOURS_REL_PATH).'/assets/js/typeahead.bundle.min.js', array('jquery'), false, true);
		wp_enqueue_script('bloodhound', plugins_url(MIKADOF_TOURS_REL_PATH).'/assets/js/bloodhound.min.js', array('jquery'), false, true);
	}

	add_action('wp_enqueue_scripts', 'mkdf_tours_scripts');
}

if(!function_exists('mkdf_tours_localize_tours_list')) {
	/**
	 * Localizes tours list for tours keyword search
	 */
	function mkdf_tours_localize_tours_list() {
		if(mkdf_tours_is_search_tours_page() || is_post_type_archive('tour-item')) {
			$tours_list = get_posts(array(
				'post_type'      => 'tour-item',
				'posts_per_page' => -1
			));

			$tours_array = array();

			if(is_array($tours_list) && count($tours_list)) {
				foreach($tours_list as $item) {
					$tours_array[] = $item->post_title;
				}
			}

			$destination_list = get_posts(array(
				'post_type'      => 'destinations',
				'posts_per_page' => -1
			));

			$destination_array = array();

			if(is_array($destination_list) && count($destination_list)) {
				foreach($destination_list as $destination) {
					$destination_array[] = $destination->post_title;
				}
			}

			wp_localize_script('mkdf_tours_script', 'mkdfToursSearchData', array(
				'tours'       => $tours_array,
				'destinations' => $destination_array
			));
		}

		return false;
	}

	add_action('wp_enqueue_scripts', 'mkdf_tours_localize_tours_list', 11);
}