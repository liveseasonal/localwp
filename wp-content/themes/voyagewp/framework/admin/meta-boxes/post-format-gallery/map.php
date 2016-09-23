<?php

if(!function_exists('voyage_mikado_map_gallery_post_meta_box')) {
	/**
	 * Maps gallery post meta box
	 */
	function voyage_mikado_map_gallery_post_meta_box() {
		$gallery_post_format_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => 'Gallery Post Format',
				'name'  => 'post_format_gallery_meta'
			)
		);

		voyage_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => 'Gallery Images',
				'description' => 'Choose your gallery images',
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_gallery_post_meta_box');
}