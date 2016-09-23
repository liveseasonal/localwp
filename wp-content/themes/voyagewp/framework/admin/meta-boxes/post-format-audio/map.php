<?php

if(!function_exists('voyage_mikado_map_audio_post_meta_box')) {
	/**
	 * Maps audio meta box
	 */
	function voyage_mikado_map_audio_post_meta_box() {
		$audio_post_format_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => 'Audio Post Format',
				'name'  => 'post_format_audio_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => 'Link',
				'description' => 'Enter audion link',
				'parent'      => $audio_post_format_meta_box,

			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_audio_post_meta_box');
}