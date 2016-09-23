<?php

if(!function_exists('voyage_mikado_map_footer_meta_box')) {
	/**
	 * Map footer meta box
	 */
	function voyage_mikado_map_footer_meta_box() {
		$footer_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('page', 'post'),
				'title' => 'Footer',
				'name'  => 'footer_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => 'Disable Footer for this Page',
				'description'   => 'Enabling this option will hide footer on this page',
				'parent'        => $footer_meta_box,
			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_footer_meta_box');
}