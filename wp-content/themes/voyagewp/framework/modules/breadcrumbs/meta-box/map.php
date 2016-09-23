<?php

if(!function_exists('mkdf_themename_breadcrumbs_meta_box_map')) {
	/**
	 * Maps breadcrumbs meta box
	 */
	function mkdf_themename_breadcrumbs_meta_box_map() {
	    $breadcrumbs_meta_box = voyage_mikado_add_meta_box(
		    array(
			    'scope' => array('page', 'post'),
			    'title' => 'Breadcrumbs',
			    'name'  => 'breadcrumbs_meta'
		    )
	    );

	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_show_breadcrumbs_area_meta',
			    'type'          => 'yesno',
			    'default_value' => voyage_mikado_options()->getOptionValue('show_breadcrumbs_area'),
			    'label'         => 'Show Breadcrumbs Area',
			    'description'   => 'This option will enable/disable Breadcrumbs Area',
			    'parent'        => $breadcrumbs_meta_box,
			    'args'          => array(
				    'dependence'             => true,
				    'dependence_hide_on_yes' => '',
				    'dependence_show_on_yes' => '#mkdf_mkdf_show_breadcrumbs_area_container_meta'
			    )
		    )
	    );

	    $show_breadcrumbs_area_container = voyage_mikado_add_admin_container(
		    array(
			    'parent'          => $breadcrumbs_meta_box,
			    'name'            => 'mkdf_show_breadcrumbs_area_container_meta',
			    'hidden_property' => 'mkdf_show_breadcrumbs_area_meta',
			    'hidden_value'    => 'no'
		    )
	    );

	    voyage_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_breadcrumbs_text_size_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => 'Breadcrumbs Text Size',
			    'description'   => 'Choose breadcrumbs text size',
			    'options'       => array(
				    ''       => 'Default',
				    'medium' => 'Medium'
			    ),
			    'parent'        => $show_breadcrumbs_area_container
		    )
	    );
    }

	add_action('voyage_mikado_meta_boxes_map', 'mkdf_themename_breadcrumbs_meta_box_map');
}