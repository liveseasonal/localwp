<?php

if(!function_exists('voyage_mikado_map_testimonial_meta_box')) {
	/**
	 * Maps testimonials meta box
	 */
	function voyage_mikado_map_testimonial_meta_box() {
		$testimonial_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('testimonials'),
				'title' => 'Testimonial',
				'name'  => 'testimonial_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => 'Title',
				'description' => 'Enter testimonial title',
				'parent'      => $testimonial_meta_box,
			)
		);


		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => 'Author',
				'description' => 'Enter author name',
				'parent'      => $testimonial_meta_box,
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => 'Job Position',
				'description' => 'Enter job position',
				'parent'      => $testimonial_meta_box,
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => 'Text',
				'description' => 'Enter testimonial text',
				'parent'      => $testimonial_meta_box,
			)
		);
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_testimonial_meta_box');
}