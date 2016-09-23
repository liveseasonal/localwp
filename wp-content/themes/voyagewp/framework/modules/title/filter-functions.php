<?php

if(!function_exists('voyage_mikado_title_classes')) {
	/**
	 * Function that adds classes to title div.
	 * All other functions are tied to it with add_filter function
	 *
	 * @param array $classes array of classes
	 */
	function voyage_mikado_title_classes($classes = array()) {
		$classes = array();
		$classes = apply_filters('voyage_mikado_title_classes', $classes);

		if(is_array($classes) && count($classes)) {
			echo implode(' ', $classes);
		}
	}
}

if(!function_exists('voyage_mikado_title_background_image_classes')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function voyage_mikado_title_background_image_classes($classes) {
		//init variables
		$id                      = voyage_mikado_get_page_id();
		$is_img_responsive       = '';
		$is_image_parallax       = '';
		$is_image_parallax_array = array('yes', 'yes_zoom');
		$show_title_img          = true;
		$title_img               = '';

		//is responsive image is set for current page?
		if(($meta_temp = get_post_meta($id, "mkdf_title_area_background_image_responsive_meta", true)) != "") {
			$is_img_responsive = $meta_temp;
		} else {
			//take value from theme options
			$is_img_responsive = voyage_mikado_options()->getOptionValue('title_area_background_image_responsive');
		}

		//is title image chosen for current page?
		if(($meta_temp = get_post_meta($id, "mkdf_title_area_background_image_meta", true)) != "") {
			$title_img = $meta_temp;
		} else {
			//take image that is set in theme options
			$title_img = voyage_mikado_options()->getOptionValue('title_area_background_image');
		}

		//is image set to be fixed for current page?
		if(($meta_temp = get_post_meta($id, "mkdf_title_area_background_image_parallax_meta", true)) != "") {
			$is_image_parallax = $meta_temp;
		} else {
			//take setting from theme options
			$is_image_parallax = voyage_mikado_options()->getOptionValue('title_area_background_image_parallax');
		}

		//is title image hidden for current page?
		if(get_post_meta($id, "mkdf_hide_background_image_meta", true) == "yes") {
			$show_title_img = false;
		}

		//is title image set and visible?
		if($title_img !== '' && $show_title_img == true) {
			//is image not responsive and parallax title is set?
			$classes[] = 'mkdf-preload-background';
			$classes[] = 'mkdf-has-background';

			if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
				$classes[] = 'mkdf-has-parallax-background';

				if($is_image_parallax == 'yes_zoom') {
					$classes[] = 'mkdf-zoom-out';
				}
			} //is image not responsive
			elseif($is_img_responsive == 'yes') {
				$classes[] = 'mkdf-has-responsive-background';
			}
		}

		return $classes;
	}

	add_filter('voyage_mikado_title_classes', 'voyage_mikado_title_background_image_classes');
}

if(!function_exists('voyage_mikado_title_content_alignment_class')) {
	/**
	 * Function that adds class on title based on title content alignmnt option
	 * Could be left, centered or right
	 *
	 * @param $classes original array of classes
	 *
	 * @return array changed array of classes
	 */
	function voyage_mikado_title_content_alignment_class($classes) {

		//init variables
		$id                      = voyage_mikado_get_page_id();
		$title_content_alignment = 'left';

		if(($meta_temp = get_post_meta($id, "mkdf_title_area_content_alignment_meta", true)) != "") {
			$title_content_alignment = $meta_temp;

		} else {
			$title_content_alignment = voyage_mikado_options()->getOptionValue('title_area_content_alignment');
		}

		$classes[] = 'mkdf-content-'.$title_content_alignment.'-alignment';

		return $classes;

	}

	add_filter('voyage_mikado_title_classes', 'voyage_mikado_title_content_alignment_class');
}

if(!function_exists('voyage_mikado_title_animation_class')) {
	/**
	 * Function that adds class on title based on title animation option
	 *
	 * @param $classes original array of classes
	 *
	 * @return array changed array of classes
	 */
	function voyage_mikado_title_animation_class($classes) {

		//init variables
		$id              = voyage_mikado_get_page_id();
		$title_animation = 'no';

		if(($meta_temp = get_post_meta($id, "mkdf_title_area_animation_meta", true)) !== "") {
			$title_animation = $meta_temp;

		} else {
			$title_animation = voyage_mikado_options()->getOptionValue('title_area_animation');
		}

		$classes[] = 'mkdf-animation-'.$title_animation;

		return $classes;

	}

	add_filter('voyage_mikado_title_classes', 'voyage_mikado_title_animation_class');
}

if(!function_exists('voyage_mikado_title_background_image_div_classes')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function voyage_mikado_title_background_image_div_classes($classes) {

		//init variables
		$id                = voyage_mikado_get_page_id();
		$is_img_responsive = '';
		$show_title_img    = true;
		$title_img         = '';

		//is responsive image is set for current page?
		if(($meta_temp = get_post_meta($id, "mkdf_title_area_background_image_responsive_meta", true)) != "") {
			$is_img_responsive = $meta_temp;
		} else {
			//take value from theme options
			$is_img_responsive = voyage_mikado_options()->getOptionValue('title_area_background_image_responsive');
		}

		//is title image chosen for current page?
		if(($meta_temp = get_post_meta($id, "mkdf_title_area_background_image_meta", true)) != "") {
			$title_img = $meta_temp;
		} else {
			//take image that is set in theme options
			$title_img = voyage_mikado_options()->getOptionValue('title_area_background_image');
		}

		//is title image hidden for current page?
		if(get_post_meta($id, "mkdf_hide_background_image_meta", true) == "yes") {
			$show_title_img = false;
		}

		//is title image set, visible and responsive?
		if($title_img !== '' && $show_title_img == true) {

			//is image responsive?
			if($is_img_responsive == 'yes') {
				$classes[] = 'mkdf-title-image-responsive';
			} //is image not responsive?
			elseif($is_img_responsive == 'no') {
				$classes[] = 'mkdf-title-image-not-responsive';
			}
		}

		return $classes;
	}

	add_filter('voyage_mikado_title_classes', 'voyage_mikado_title_background_image_div_classes');
}

if(!function_exists('voyage_mikado_title_size_body_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function voyage_mikado_title_size_body_class($classes) {
		$id                  = voyage_mikado_get_page_id();
		$per_page_title_size = voyage_mikado_get_meta_field_intersect('title_text_size', $id);

		if($per_page_title_size !== '') {
			$classes[] = 'mkdf-'.$per_page_title_size.'-title-text';
		}

		return $classes;
	}

	add_action('body_class', 'voyage_mikado_title_size_body_class');
}

if(!function_exists('voyage_mikado_has_subtitle_body_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function voyage_mikado_has_subtitle_body_class($classes) {
		$id                    = voyage_mikado_get_page_id();
		$per_page_has_subtitle = get_post_meta($id, 'mkdf_title_area_subtitle_meta', true);

		if($per_page_has_subtitle !== '') {
			$classes[] = 'mkdf-title-with-subtitle';
		}

		return $classes;
	}

	add_action('body_class', 'voyage_mikado_has_subtitle_body_class');
}