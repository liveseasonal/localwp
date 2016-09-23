<?php

if(!function_exists('voyage_mikado_map_carousel_meta_box')) {
	/**
	 * Maps carousel meta box
	 */
	function voyage_mikado_map_carousel_meta_box() {
		$carousel_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('carousels'),
				'title' => 'Carousel',
				'name'  => 'carousel_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_image',
				'type'        => 'image',
				'label'       => 'Carousel Image',
				'description' => 'Choose carousel image (min width needs to be 215px)',
				'parent'      => $carousel_meta_box
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_hover_image',
				'type'        => 'image',
				'label'       => 'Carousel Hover Image',
				'description' => 'Choose carousel hover image (min width needs to be 215px)',
				'parent'      => $carousel_meta_box
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_title',
				'type'        => 'text',
				'label'       => 'Title',
				'description' => 'Enter the title for your carousel',
				'parent'      => $carousel_meta_box
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_text',
				'type'        => 'text',
				'label'       => 'Text',
				'description' => 'Enter the text for your carousel',
				'parent'      => $carousel_meta_box
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_link',
				'type'        => 'text',
				'label'       => 'Link',
				'description' => 'Enter the URL to which you want the image to link to (e.g. http://www.example.com)',
				'parent'      => $carousel_meta_box
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_target',
				'type'        => 'selectblank',
				'label'       => 'Target',
				'description' => 'Specify where to open the linked document',
				'parent'      => $carousel_meta_box,
				'options'     => array(
					'_self'  => 'Self',
					'_blank' => 'Blank'
				)
			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_carousel_meta_box');
}