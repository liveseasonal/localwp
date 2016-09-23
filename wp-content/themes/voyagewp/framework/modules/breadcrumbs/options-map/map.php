<?php

if(!function_exists('mkdf_themename_breadcrumbs_map')) {
	function mkdf_themename_breadcrumbs_map() {
		voyage_mikado_add_admin_page(array(
			'slug'  => '_breadcrumbs_page',
			'title' => 'Breadcrumbs',
			'icon'  => 'fa fa-angle-right'
		));

		$panel_breadcrumbs = voyage_mikado_add_admin_panel(array(
			'page'  => '_breadcrumbs_page',
			'name'  => 'panel_breadcrumbs',
			'title' => 'Breadcrumbs Settings'
		));

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'show_breadcrumbs_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => 'Show Breadcrumbs Area',
				'description'   => 'This option will enable/disable Breadcrumbs Area',
				'parent'        => $panel_breadcrumbs,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_breadcrumbs_area_container'
				)
			)
		);

		$show_breadcrumbs_area_container = voyage_mikado_add_admin_container(
			array(
				'parent'          => $panel_breadcrumbs,
				'name'            => 'show_breadcrumbs_area_container',
				'hidden_property' => 'show_breadcrumbs_area',
				'hidden_value'    => 'no'
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_area_height',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Breadcrumbs Area Height',
				'description'   => 'Choose height for breadcrumbs area',
				'parent'        => $show_breadcrumbs_area_container,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_area_background_color',
				'type'          => 'color',
				'default_value' => '',
				'label'         => 'Breadcrumbs Area Background Color',
				'description'   => 'Choose background color for breadcrumbs area',
				'parent'        => $show_breadcrumbs_area_container
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_text_size',
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

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_text_color',
				'type'          => 'color',
				'default_value' => '',
				'label'         => 'Breadcrumbs Area Text Color',
				'description'   => 'Choose breadcrumbs area text color',
				'parent'        => $show_breadcrumbs_area_container
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_enable_share',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => 'Enable Social Share in Breadcrumbs?',
				'description'   => 'Enable / disable social share links in breadcrumbs area',
				'parent'        => $show_breadcrumbs_area_container
			)
		);
	}

	add_action('voyage_mikado_options_map', 'mkdf_themename_breadcrumbs_map', 8);
}