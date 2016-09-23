<?php
if(!function_exists('mkdf_tours_info_section_map')) {

	function mkdf_tours_info_section_map() {
		$destinations = mkdf_tours_get_destinations(true);

		$info_section_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Info Section',
				'name'  => 'tours_info_section_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_info_section',
				'type'          => 'yesno',
				'label'         => 'Show Info Section',
				'description'   => '',
				'parent'        => $info_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_info_section_container',
				)
			)
		);

		$info_section_container = voyage_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'info_section_container',
			'parent'          => $info_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_info_section',
			'hidden_value'    => 'no'
		));

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_price',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Price',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_discount_price',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Discount Price',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_duration',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Duration',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_destination',
				'type'          => 'select',
				'default_value' => '',
				'label'         => 'Destination',
				'options'       => $destinations,
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_label',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Custom Label',
				'description'   => 'Define custom label which will show on tour lists and tour single pages',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_label_skin',
				'type'          => 'select',
				'default_value' => '',
				'label'         => 'Custom Label Skin',
				'options'       => array(
					''      => '',
					'skin1' => 'Skin 1',
					'skin2' => 'Skin 2',
				),
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_info_min_years',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Minimum Years Required',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_departure',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Departure/Return Location',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_departure_time',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Departure Time',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_return_time',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Return Time/Test123',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_dress_code',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Dress Code',
				'description'   => '',
				'parent'        => $info_section_container
			)
		);

		$tour_attributes = mkdf_tours_get_tour_attributes();

		if(is_array($tour_attributes) && count($tour_attributes)) {
			voyage_mikado_add_meta_box_field(array(
				'name'          => 'mkdf_tours_attributes',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => 'Attributes',
				'description'   => 'Define tour attributes',
				'parent'        => $info_section_container,
				'options'       => $tour_attributes
			));
		}
	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_info_section_map');
}

if(!function_exists('mkdf_tours_tour_plan_section_map')) {

	function mkdf_tours_tour_plan_section_map() {

		$tour_plan_section_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Accommodation',
				'name'  => 'tours_plan_section_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_tour_plan_section',
				'type'          => 'yesno',
				'label'         => 'Show Accommodation Section',
				'description'   => '',
				'parent'        => $tour_plan_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_tour_plan_section_container',
				)
			)
		);

		$tour_plan_section_container = voyage_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'tour_plan_section_container',
			'parent'          => $tour_plan_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_tour_plan_section',
			'hidden_value'    => 'no'
		));

		voyage_mikado_add_repeater_field(array(
				'name'        => 'mkdf_tour_plan_repeater',
				'parent'      => $tour_plan_section_container,
				'button_text' => 'Add new Accommodation Section',
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'mkdf_tour_plan_section_title',
						'label'       => 'Accommodation Section Title',
						'description' => 'Description',
					),
					array(
						'type'        => 'textareahtml',
						'name'        => 'mkdf_tour_plan_section_description',
						'label'       => 'Accommodation Section Description',
						'description' => 'Description field'
					)
				)
			)
		);

	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_tour_plan_section_map');
}

if(!function_exists('mkdf_tours_location_section_map')) {

	function mkdf_tours_location_section_map() {

		$location_section_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Location Section',
				'name'  => 'location_section_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_location_section',
				'type'          => 'yesno',
				'label'         => 'Show Location Section',
				'description'   => '',
				'parent'        => $location_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_location_section_container',
				)
			)
		);

		$location_section_container = voyage_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'location_section_container',
			'parent'          => $location_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_location_section',
			'hidden_value'    => 'no'
		));

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_excerpt',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Location Excerpt',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address1',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Address 1',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address2',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Address 2',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address3',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Address 3',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address4',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Address 4',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address5',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Address 5',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => 'Location Content',
				'description'   => '',
				'parent'        => $location_section_container
			)
		);

	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_location_section_map');
}

if(!function_exists('mkdf_tours_gallery_section_map')) {

	function mkdf_tours_gallery_section_map() {

		$gallery_section_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Gallery Section',
				'name'  => 'gallery_section_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_gallery_section',
				'type'          => 'yesno',
				'label'         => 'Show Gallery Section',
				'description'   => '',
				'parent'        => $gallery_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_gallery_section_container',
				)
			)
		);

		$gallery_section_container = voyage_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'gallery_section_container',
			'parent'          => $gallery_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_gallery_section',
			'hidden_value'    => 'no'
		));

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_gallery_excerpt',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Excerpt',
				'description'   => '',
				'parent'        => $gallery_section_container
			)
		);

		voyage_mikado_add_multiple_images_field(
			array(
				'parent'      => $gallery_section_container,
				'name'        => 'mkdf_tours_gallery_images',
				'label'       => 'Gallery Images',
				'description' => 'Choose your gallery images'
			)
		);

	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_gallery_section_map');
}

if(!function_exists('mkdf_tours_review_section_map')) {

	function mkdf_tours_review_section_map() {

		$review_section_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Review Section',
				'name'  => 'review_section_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_review_section',
				'type'          => 'yesno',
				'label'         => 'Show Review Section',
				'description'   => '',
				'parent'        => $review_section_meta_box,
				'default_value' => 'yes'
			)
		);

	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_review_section_map');
}

if(!function_exists('mkdf_tours_custom_section_1_map')) {

	function mkdf_tours_custom_section_1_map() {

		$custom_section_1_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Custom Section 1',
				'name'  => 'custom_section_1_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_custom_section_1',
				'type'          => 'yesno',
				'label'         => 'Show Custom Section 1',
				'description'   => '',
				'parent'        => $custom_section_1_meta_box,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_custom_section_1_container',
				)
			)
		);

		$custom_section_1_container = voyage_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'custom_section_1_container',
			'parent'          => $custom_section_1_meta_box,
			'hidden_property' => 'mkdf_tours_show_custom_section_1',
			'hidden_value'    => 'no'
		));

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section1_title',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Title',
				'description'   => '',
				'parent'        => $custom_section_1_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section1_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => 'Content',
				'description'   => '',
				'parent'        => $custom_section_1_container
			)
		);

	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_custom_section_1_map');
}

if(!function_exists('mkdf_tours_custom_section_2_map')) {

	function mkdf_tours_custom_section_2_map() {

		$custom_section_2_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => 'Custom Section 2',
				'name'  => 'custom_section_2_meta'
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_custom_section_2',
				'type'          => 'yesno',
				'label'         => 'Show Custom Section 2',
				'description'   => '',
				'parent'        => $custom_section_2_meta_box,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_custom_section_2_container',
				)
			)
		);

		$custom_section_2_container = voyage_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'custom_section_2_container',
			'parent'          => $custom_section_2_meta_box,
			'hidden_property' => 'mkdf_tours_show_custom_section_2',
			'hidden_value'    => 'no'
		));

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section2_title',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Title',
				'description'   => '',
				'parent'        => $custom_section_2_container
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section2_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => 'Content',
				'description'   => '',
				'parent'        => $custom_section_2_container
			)
		);

	}

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_tours_custom_section_2_map');
}