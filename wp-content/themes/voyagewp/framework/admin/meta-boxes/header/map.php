<?php

if(!function_exists('voyage_mikado_map_header_meta_box')) {
	/**
	 * Maps header meta box
	 */
	function voyage_mikado_map_header_meta_box() {
		$header_meta_box = voyage_mikado_add_meta_box(
			array(
				'scope' => array('page', 'post'),
				'title' => 'Header',
				'name'  => 'header_meta'
			)
		);
		voyage_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => 'Header Skin',
				'description'   => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => '',
					'light-header' => 'Light',
					'dark-header'  => 'Dark'
				)
			)
		);

		voyage_mikado_add_meta_box_field(
			array(
				'parent'        => $header_meta_box,
				'type'          => 'select',
				'name'          => 'mkdf_enable_header_style_on_scroll_meta',
				'default_value' => '',
				'label'         => 'Enable Header Style on Scroll',
				'description'   => 'Enabling this option, header will change style depending on row settings for dark/light style',
				'options'       => array(
					''    => '',
					'no'  => 'No',
					'yes' => 'Yes'
				)
			)
		);

		switch(voyage_mikado_options()->getOptionValue('header_type')) {
			case 'header-standard':

				voyage_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_menu_area_background_color_header_standard_meta',
						'type'        => 'color',
						'label'       => 'Background Color',
						'description' => 'Choose a background color for header area',
						'parent'      => $header_meta_box
					)
				);

				voyage_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_menu_area_background_transparency_header_standard_meta',
						'type'        => 'text',
						'label'       => 'Transparency',
						'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
						'parent'      => $header_meta_box,
						'args'        => array(
							'col_width' => 2
						)
					)
				);

				voyage_mikado_add_meta_box_field(array(
					'name'          => 'mkdf_menu_area_bottom_border_enable_header_standard_meta',
					'type'          => 'yesno',
					'label'         => 'Enable Header Bottom Border',
					'description'   => 'Enabling this option will enable bottom border on header',
					'parent'        => $header_meta_box,
					'default_value' => 'no',
					'args'          => array(
						'dependence'             => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#mkdf_border_bottom_color_container',
					)
				));

				$border_bottom_color_container = voyage_mikado_add_admin_container(array(
					'type'            => 'container',
					'name'            => 'border_bottom_color_container',
					'parent'          => $header_meta_box,
					'hidden_property' => 'mkdf_menu_area_bottom_border_enable_header_standard_meta',
					'hidden_value'    => 'no'
				));

				voyage_mikado_add_meta_box_field(array(
					'name'        => 'mkdf_menu_area_bottom_border_color_meta',
					'type'        => 'color',
					'label'       => 'Header Bottom Border Color',
					'description' => 'Choose color of header bottom border',
					'parent'      => $border_bottom_color_container
				));

				break;
		}

			$sticky_amount_container = voyage_mikado_add_admin_container_no_style(array(
				'name'            => 'sticky_amount_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'header_behaviour',
				'hidden_values'   => array('sticky-header-on-scroll-up', 'fixed-on-scroll')
			));

			$sticky_amount_group = voyage_mikado_add_admin_group(array(
				'name'        => 'sticky_amount_group',
				'title'       => 'Scroll Amount for Sticky Header Appearance',
				'parent'      => $sticky_amount_container,
				'description' => 'Enter the amount of pixels for sticky header appearance, or set browser height to "Yes" for predefined sticky header appearance amount'
			));

			$sticky_amount_row = voyage_mikado_add_admin_row(array(
				'name'   => 'sticky_amount_group',
				'parent' => $sticky_amount_group
			));

			voyage_mikado_add_meta_box_field(
				array(
					'name'   => 'mkdf_scroll_amount_for_sticky_meta',
					'type'   => 'textsimple',
					'label'  => 'Amount in px',
					'parent' => $sticky_amount_row,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

			voyage_mikado_add_meta_box_field(
				array(
					'name'          => 'mkdf_scroll_amount_for_sticky_fullscreen_meta',
					'type'          => 'yesnosimple',
					'label'         => 'Browser Height',
					'default_value' => 'no',
					'parent'        => $sticky_amount_row
				)
			);

			voyage_mikado_add_admin_section_title(array(
				'name'   => 'top_bar_section_title',
				'parent' => $header_meta_box,
				'title'  => 'Top Bar'
			));

			$top_bar_global_option      = voyage_mikado_options()->getOptionValue('top_bar');
			$top_bar_default_dependency = array(
				'' => '#mkdf_top_bar_container_no_style'
			);

			$top_bar_show_array = array(
				'yes' => '#mkdf_top_bar_container_no_style'
			);

			$top_bar_hide_array = array(
				'no' => '#mkdf_top_bar_container_no_style'
			);

			if($top_bar_global_option === 'yes') {
				$top_bar_show_array = array_merge($top_bar_show_array, $top_bar_default_dependency);
			} else {
				$top_bar_hide_array = array_merge($top_bar_hide_array, $top_bar_default_dependency);
			}

			voyage_mikado_add_meta_box_field(array(
				'name'          => 'mkdf_top_bar_meta',
				'type'          => 'select',
				'label'         => 'Enable Top Bar on This Page',
				'description'   => 'Enabling this option will enable top bar on this page',
				'parent'        => $header_meta_box,
				'default_value' => '',
				'options'       => array(
					''    => 'Default',
					'yes' => 'Yes',
					'no'  => 'No'
				),
				'args'          => array(
					'dependence' => true,
					'show'       => $top_bar_show_array,
					'hide'       => $top_bar_hide_array
				)
			));

			$top_bar_container = voyage_mikado_add_admin_container_no_style(array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $header_meta_box,
				'hidden_property' => 'top_bar',
				'hidden_value'    => 'no'
			));

			voyage_mikado_add_meta_box_field(array(
				'name'    => 'mkdf_top_bar_skin_meta',
				'type'    => 'select',
				'label'   => 'Top Bar Skin',
				'options' => array(
					''      => 'Default',
					'light' => 'Light',
					'dark'  => 'Dark'
				),
				'parent'  => $top_bar_container
			));

			voyage_mikado_add_meta_box_field(array(
				'name'   => 'mkdf_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => 'Top Bar Background Color',
				'parent' => $top_bar_container
			));

			voyage_mikado_add_meta_box_field(array(
				'name'        => 'mkdf_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => 'Top Bar Background Color Transparency',
				'description' => 'Set top bar background color transparenct. Value should be between 0 and 1',
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			));
	}

	add_action('voyage_mikado_meta_boxes_map', 'voyage_mikado_map_header_meta_box');
}