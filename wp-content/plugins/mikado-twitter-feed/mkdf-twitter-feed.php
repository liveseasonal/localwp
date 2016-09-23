<?php
/*
Plugin Name: Mikadof Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Mikado Themes
Version: 1.0
*/

include_once 'load.php';


if(!function_exists('mkdf_twitter_text_domain')) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function mkdf_twitter_text_domain() {
		load_plugin_textdomain('mikado-twitter-feed', false, MIKADOF_TWITTER_FEED_REL_PATH.'/languages');
	}

	add_action('plugins_loaded', 'mkdf_twitter_text_domain');
}