<?php

if(!function_exists('voyage_mikado_map_general_meta_box')) {
	/**
	 * Maps general meta box
	 */
	function voyage_mikado_map_general_meta_box() {
	    $general_meta_box = voyage_mikado_add_meta_box(
		    array(
			    'scope' => array('page', 'post'),
			    'title' => 'General',
			    'name'  => 'general_meta'
		    )
	    );


	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_background_color_meta',
			    'type'          => 'color',
			    'default_value' => '',
			    'label'         => 'Page Background Color',
			    'description'   => 'Choose background color for page content',
			    'parent'        => $general_meta_box
		    )
	    );

	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_padding_meta',
			    'type'          => 'text',
			    'default_value' => '',
			    'label'         => 'Page Padding',
			    'description'   => 'Insert padding in format 10px 10px 10px 10px',
			    'parent'        => $general_meta_box
		    )
	    );

	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_content_behind_header_meta',
			    'type'          => 'yesno',
			    'default_value' => 'no',
			    'label'         => 'Always put content behind header',
			    'description'   => 'Enabling this option will put page content behind page header',
			    'parent'        => $general_meta_box,
			    'args'          => array(
				    'suffix' => 'px'
			    )
		    )
	    );

	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_slider_meta',
			    'type'          => 'text',
			    'default_value' => '',
			    'label'         => 'Slider Shortcode',
			    'description'   => 'Paste your slider shortcode here',
			    'parent'        => $general_meta_box
		    )
	    );

	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_transition_type',
			    'type'          => 'selectblank',
			    'label'         => 'Page Transition',
			    'description'   => 'Choose the type of transition to this page',
			    'parent'        => $general_meta_box,
			    'default_value' => '',
			    'options'       => array(
				    'no-animation' => 'No animation',
				    'fade'         => 'Fade'
			    )
		    )
	    );

    }

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_general_meta_box');
}