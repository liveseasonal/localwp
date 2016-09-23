<?php

if(!function_exists('voyage_mikado_quote_post_meta_box')) {
	/**
	 * Maps quote post meta box
	 */
	function voyage_mikado_quote_post_meta_box() {
		$quote_post_format_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => 'Quote Post Format',
				'name'  => 'post_format_quote_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => 'Quote Text',
				'description' => 'Enter Quote text',
				'parent'      => $quote_post_format_meta_box,

			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_quote_post_meta_box');
}