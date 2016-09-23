<?php

if(!function_exists('voyage_mikado_link_post_meta_box')) {
	/**
	 * Maps link post meta box
	 */
	function voyage_mikado_link_post_meta_box() {
		$link_post_format_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => 'Link Post Format',
				'name'  => 'post_format_link_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => 'Link',
				'description' => 'Enter link',
				'parent'      => $link_post_format_meta_box,

			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_link_post_meta_box');
}