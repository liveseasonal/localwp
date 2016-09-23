<?php

if(!function_exists('voyage_mikado_sidearea_options_map')) {

	function voyage_mikado_sidearea_options_map() {

		voyage_mikado_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => 'Side Area',
				'icon'  => 'fa fa-search'
			)
		);

		$side_area_panel = voyage_mikado_add_admin_panel(
			array(
				'title' => 'Side Area',
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'select',
				'name'          => 'side_area_type',
				'default_value' => 'side-menu-slide-from-right',
				'label'         => 'Side Area Type',
				'description'   => 'Choose a type of Side Area',
				'options'       => array(
					'side-menu-slide-from-right'       => 'Slide from Right Over Content',
					'side-menu-slide-with-content'     => 'Slide from Right With Content',
					'side-area-uncovered-from-content' => 'Side Area Uncovered from Content'
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'side-menu-slide-from-right'       => '#mkdf_side_area_slide_with_content_container',
						'side-menu-slide-with-content'     => '#mkdf_side_area_width_container',
						'side-area-uncovered-from-content' => '#mkdf_side_area_width_container, #mkdf_side_area_slide_with_content_container'
					),
					'show'       => array(
						'side-menu-slide-from-right'       => '#mkdf_side_area_width_container',
						'side-menu-slide-with-content'     => '#mkdf_side_area_slide_with_content_container',
						'side-area-uncovered-from-content' => ''
					)
				)
			)
		);

		$side_area_width_container = voyage_mikado_add_admin_container(
			array(
				'parent'          => $side_area_panel,
				'name'            => 'side_area_width_container',
				'hidden_property' => 'side_area_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'side-menu-slide-with-content',
					'side-area-uncovered-from-content'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => 'Side Area Width',
				'description'   => 'Enter a width for Side Area (in percentages, enter more than 30)',
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'color',
				'name'          => 'side_area_content_overlay_color',
				'default_value' => '',
				'label'         => 'Content Overlay Background Color',
				'description'   => 'Choose a background color for a content overlay',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'text',
				'name'          => 'side_area_content_overlay_opacity',
				'default_value' => '',
				'label'         => 'Content Overlay Background Transparency',
				'description'   => 'Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)',
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		$side_area_slide_with_content_container = voyage_mikado_add_admin_container(
			array(
				'parent'          => $side_area_panel,
				'name'            => 'side_area_slide_with_content_container',
				'hidden_property' => 'side_area_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'side-menu-slide-from-right',
					'side-area-uncovered-from-content'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_slide_with_content_container,
				'type'          => 'select',
				'name'          => 'side_area_slide_with_content_width',
				'default_value' => 'width-470',
				'label'         => 'Side Area Width',
				'description'   => 'Choose width for Side Area',
				'options'       => array(
					'width-270' => '270px',
					'width-370' => '370px',
					'width-470' => '470px'
				)
			)
		);

		voyage_mikado_add_admin_field(array(
				'parent'      => $side_area_panel,
				'type'        => 'image',
				'name'        => 'side_area_bakground_image',
				'label'       => 'Side Area Background Image',
				'description' => 'Choose background image for Side Area'
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'yesno',
				'name'          => 'side_area_enable_default_opener',
				'default_value' => 'no',
				'label'         => 'Enable Default Side Area Opener Icon',
				'description'   => 'Enabling this option will enable default side area opener icon',
				'args'          => array(
					'dependence'             => true,
					'dependence_show_on_yes' => '',
					'dependence_hide_on_yes' => '#mkdf_side_area_opener_icon_container_no_style'
				)
			)
		);

//init icon pack hide and show array. It will be populated dinamically from collections array
		$side_area_icon_pack_hide_array = array();
		$side_area_icon_pack_show_array = array();

//do we have some collection added in collections array?
		if(is_array(voyage_mikado_icon_collections()->iconCollections) && count(voyage_mikado_icon_collections()->iconCollections)) {
			//get collections params array. It will contain values of 'param' property for each collection
			$side_area_icon_collections_params = voyage_mikado_icon_collections()->getIconCollectionsParams();

			//foreach collection generate hide and show array
			foreach(voyage_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
				$side_area_icon_pack_hide_array[$dep_collection_key] = '';

				//we need to include only current collection in show string as it is the only one that needs to show
				$side_area_icon_pack_show_array[$dep_collection_key] = '#mkdf_side_area_icon_'.$dep_collection_object->param.'_container';

				//for all collections param generate hide string
				foreach($side_area_icon_collections_params as $side_area_icon_collections_param) {
					//we don't need to include current one, because it needs to be shown, not hidden
					if($side_area_icon_collections_param !== $dep_collection_object->param) {
						$side_area_icon_pack_hide_array[$dep_collection_key] .= '#mkdf_side_area_icon_'.$side_area_icon_collections_param.'_container,';
					}
				}

				//remove remaining ',' character
				$side_area_icon_pack_hide_array[$dep_collection_key] = rtrim($side_area_icon_pack_hide_array[$dep_collection_key], ',');
			}

		}

		$side_area_opener_icon_container_no_style = voyage_mikado_add_admin_container_no_style(array(
			'name'            => 'side_area_opener_icon_container_no_style',
			'parent'          => $side_area_panel,
			'hidden_property' => 'side_area_enable_default_opener',
			'hidden_value'    => 'yes'
		));

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_opener_icon_container_no_style,
				'type'          => 'select',
				'name'          => 'side_area_button_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => 'Side Area Button Icon Pack',
				'description'   => 'Choose icon pack for side area button',
				'options'       => voyage_mikado_icon_collections()->getIconCollections(),
				'args'          => array(
					'dependence' => true,
					'hide'       => $side_area_icon_pack_hide_array,
					'show'       => $side_area_icon_pack_show_array
				)
			)
		);

		if(is_array(voyage_mikado_icon_collections()->iconCollections) && count(voyage_mikado_icon_collections()->iconCollections)) {
			//foreach icon collection we need to generate separate container that will have dependency set
			//it will have one field inside with icons dropdown
			foreach(voyage_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
				$icons_array = $collection_object->getIconsArray();

				//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
				$icon_collections_keys = voyage_mikado_icon_collections()->getIconCollectionsKeys();

				//unset current one, because it doesn't have to be included in dependency that hides icon container
				unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

				$side_area_icon_hide_values = $icon_collections_keys;

				$side_area_icon_container = voyage_mikado_add_admin_container(
					array(
						'parent'          => $side_area_opener_icon_container_no_style,
						'name'            => 'side_area_icon_'.$collection_object->param.'_container',
						'hidden_property' => 'side_area_button_icon_pack',
						'hidden_value'    => '',
						'hidden_values'   => $side_area_icon_hide_values
					)
				);

				voyage_mikado_add_admin_field(
					array(
						'parent'        => $side_area_icon_container,
						'type'          => 'select',
						'name'          => 'side_area_icon_'.$collection_object->param,
						'default_value' => 'icon_menu',
						'label'         => 'Side Area Icon',
						'description'   => 'Choose Side Area Icon',
						'options'       => $icons_array,
					)
				);

			}

		}

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_opener_icon_container_no_style,
				'type'          => 'text',
				'name'          => 'side_area_icon_font_size',
				'default_value' => '',
				'label'         => 'Side Area Icon Size',
				'description'   => 'Choose a size for Side Area (px)',
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				),
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_opener_icon_container_no_style,
				'type'          => 'select',
				'name'          => 'side_area_predefined_icon_size',
				'default_value' => 'medium',
				'label'         => 'Predefined Side Area Icon Size',
				'description'   => 'Choose predefined size for Side Area icons',
				'options'       => array(
					'normal' => 'Normal',
					'medium' => 'Medium',
					'large'  => 'Large'
				),
			)
		);

		$side_area_icon_style_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'side_area_icon_style_group',
				'title'       => 'Side Area Icon Style',
				'description' => 'Define styles for Side Area icon'
			)
		);

		$side_area_icon_style_row1 = voyage_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row1'
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_icon_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'side_area_icon_color',
				'default_value' => '',
				'label'         => 'Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_icon_style_row1,
				'type'          => 'colorsimple',
				'name'          => 'side_area_icon_hover_color',
				'default_value' => '',
				'label'         => 'Hover Color',
			)
		);

		$side_area_icon_style_row2 = voyage_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row2',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_icon_style_row2,
				'type'          => 'colorsimple',
				'name'          => 'side_area_light_icon_color',
				'default_value' => '',
				'label'         => 'Light Menu Icon Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_icon_style_row2,
				'type'          => 'colorsimple',
				'name'          => 'side_area_light_icon_hover_color',
				'default_value' => '',
				'label'         => 'Light Menu Icon Hover Color',
			)
		);

		$side_area_icon_style_row3 = voyage_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row3',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_icon_style_row3,
				'type'          => 'colorsimple',
				'name'          => 'side_area_dark_icon_color',
				'default_value' => '',
				'label'         => 'Dark Menu Icon Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_icon_style_row3,
				'type'          => 'colorsimple',
				'name'          => 'side_area_dark_icon_hover_color',
				'default_value' => '',
				'label'         => 'Dark Menu Icon Hover Color',
			)
		);

		$icon_spacing_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'icon_spacing_group',
				'title'       => 'Side Area Icon Spacing',
				'description' => 'Define padding and margin for side area icon'
			)
		);

		$icon_spacing_row = voyage_mikado_add_admin_row(
			array(
				'parent' => $icon_spacing_group,
				'name'   => 'icon_spancing_row',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_icon_padding_left',
				'default_value' => '',
				'label'         => 'Padding Left',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_icon_padding_right',
				'default_value' => '',
				'label'         => 'Padding Right',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_icon_margin_left',
				'default_value' => '',
				'label'         => 'Margin Left',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_icon_margin_right',
				'default_value' => '',
				'label'         => 'Margin Right',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'yesno',
				'name'          => 'side_area_icon_border_yesno',
				'default_value' => 'no',
				'label'         => 'Icon Border',
				'descritption'  => 'Enable border around icon',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_side_area_icon_border_container'
				)
			)
		);

		$side_area_icon_border_container = voyage_mikado_add_admin_container(
			array(
				'parent'          => $side_area_panel,
				'name'            => 'side_area_icon_border_container',
				'hidden_property' => 'side_area_icon_border_yesno',
				'hidden_value'    => 'no'
			)
		);

		$border_style_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_icon_border_container,
				'name'        => 'border_style_group',
				'title'       => 'Border Style',
				'description' => 'Define styling for border around icon'
			)
		);

		$border_style_row_1 = voyage_mikado_add_admin_row(
			array(
				'parent' => $border_style_group,
				'name'   => 'border_style_row_1',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $border_style_row_1,
				'type'          => 'colorsimple',
				'name'          => 'side_area_icon_border_color',
				'default_value' => '',
				'label'         => 'Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $border_style_row_1,
				'type'          => 'colorsimple',
				'name'          => 'side_area_icon_border_hover_color',
				'default_value' => '',
				'label'         => 'Hover Color',
			)
		);

		$border_style_row_2 = voyage_mikado_add_admin_row(
			array(
				'parent' => $border_style_group,
				'name'   => 'border_style_row_2',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $border_style_row_2,
				'type'          => 'textsimple',
				'name'          => 'side_area_icon_border_width',
				'default_value' => '',
				'label'         => 'Width',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $border_style_row_2,
				'type'          => 'textsimple',
				'name'          => 'side_area_icon_border_radius',
				'default_value' => '',
				'label'         => 'Radius',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $border_style_row_2,
				'type'          => 'selectsimple',
				'name'          => 'side_area_icon_border_style',
				'default_value' => '',
				'label'         => 'Style',
				'options'       => array(
					'solid'  => 'Solid',
					'dashed' => 'Dashed',
					'dotted' => 'Dotted'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'selectblank',
				'name'          => 'side_area_aligment',
				'default_value' => '',
				'label'         => 'Text Aligment',
				'description'   => 'Choose text aligment for side area',
				'options'       => array(
					'center' => 'Center',
					'left'   => 'Left',
					'right'  => 'Right'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_title',
				'default_value' => '',
				'label'         => 'Side Area Title',
				'description'   => 'Enter a title to appear in Side Area',
				'args'          => array(
					'col_width' => 3,
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'color',
				'name'          => 'side_area_background_color',
				'default_value' => '',
				'label'         => 'Background Color',
				'description'   => 'Choose a background color for Side Area',
			)
		);

		$padding_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'padding_group',
				'title'       => 'Padding',
				'description' => 'Define padding for Side Area'
			)
		);

		$padding_row = voyage_mikado_add_admin_row(
			array(
				'parent' => $padding_group,
				'name'   => 'padding_row',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $padding_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_padding_top',
				'default_value' => '',
				'label'         => 'Top Padding',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $padding_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_padding_right',
				'default_value' => '',
				'label'         => 'Right Padding',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $padding_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_padding_bottom',
				'default_value' => '',
				'label'         => 'Bottom Padding',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $padding_row,
				'type'          => 'textsimple',
				'name'          => 'side_area_padding_left',
				'default_value' => '',
				'label'         => 'Left Padding',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'select',
				'name'          => 'side_area_close_icon',
				'default_value' => 'light',
				'label'         => 'Close Icon Style',
				'description'   => 'Choose a type of close icon',
				'options'       => array(
					'light' => 'Light',
					'dark'  => 'Dark'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_close_icon_size',
				'default_value' => '',
				'label'         => 'Close Icon Size',
				'description'   => 'Define close icon size',
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$title_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'title_group',
				'title'       => 'Title',
				'description' => 'Define Style for Side Area title'
			)
		);

		$title_row_1 = voyage_mikado_add_admin_row(
			array(
				'parent' => $title_group,
				'name'   => 'title_row_1',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_1,
				'type'          => 'colorsimple',
				'name'          => 'side_area_title_color',
				'default_value' => '',
				'label'         => 'Text Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_1,
				'type'          => 'textsimple',
				'name'          => 'side_area_title_fontsize',
				'default_value' => '',
				'label'         => 'Font Size',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_1,
				'type'          => 'textsimple',
				'name'          => 'side_area_title_lineheight',
				'default_value' => '',
				'label'         => 'Line Height',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_1,
				'type'          => 'selectblanksimple',
				'name'          => 'side_area_title_texttransform',
				'default_value' => '',
				'label'         => 'Text Transform',
				'options'       => voyage_mikado_get_text_transform_array()
			)
		);

		$title_row_2 = voyage_mikado_add_admin_row(
			array(
				'parent' => $title_group,
				'name'   => 'title_row_2',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_2,
				'type'          => 'fontsimple',
				'name'          => 'side_area_title_google_fonts',
				'default_value' => '-1',
				'label'         => 'Font Family',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_2,
				'type'          => 'selectblanksimple',
				'name'          => 'side_area_title_fontstyle',
				'default_value' => '',
				'label'         => 'Font Style',
				'options'       => voyage_mikado_get_font_style_array()
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_2,
				'type'          => 'selectblanksimple',
				'name'          => 'side_area_title_fontweight',
				'default_value' => '',
				'label'         => 'Font Weight',
				'options'       => voyage_mikado_get_font_weight_array()
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $title_row_2,
				'type'          => 'textsimple',
				'name'          => 'side_area_title_letterspacing',
				'default_value' => '',
				'label'         => 'Letter Spacing',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);


		$text_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'text_group',
				'title'       => 'Text',
				'description' => 'Define Style for Side Area text'
			)
		);

		$text_row_1 = voyage_mikado_add_admin_row(
			array(
				'parent' => $text_group,
				'name'   => 'text_row_1',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_1,
				'type'          => 'colorsimple',
				'name'          => 'side_area_text_color',
				'default_value' => '',
				'label'         => 'Text Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_1,
				'type'          => 'textsimple',
				'name'          => 'side_area_text_fontsize',
				'default_value' => '',
				'label'         => 'Font Size',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_1,
				'type'          => 'textsimple',
				'name'          => 'side_area_text_lineheight',
				'default_value' => '',
				'label'         => 'Line Height',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_1,
				'type'          => 'selectblanksimple',
				'name'          => 'side_area_text_texttransform',
				'default_value' => '',
				'label'         => 'Text Transform',
				'options'       => voyage_mikado_get_text_transform_array()
			)
		);

		$text_row_2 = voyage_mikado_add_admin_row(
			array(
				'parent' => $text_group,
				'name'   => 'text_row_2',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_2,
				'type'          => 'fontsimple',
				'name'          => 'side_area_text_google_fonts',
				'default_value' => '-1',
				'label'         => 'Font Family',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_2,
				'type'          => 'fontsimple',
				'name'          => 'side_area_text_google_fonts',
				'default_value' => '-1',
				'label'         => 'Font Family',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_2,
				'type'          => 'selectblanksimple',
				'name'          => 'side_area_text_fontstyle',
				'default_value' => '',
				'label'         => 'Font Style',
				'options'       => voyage_mikado_get_font_style_array()
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_2,
				'type'          => 'selectblanksimple',
				'name'          => 'side_area_text_fontweight',
				'default_value' => '',
				'label'         => 'Font Weight',
				'options'       => voyage_mikado_get_font_weight_array()
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $text_row_2,
				'type'          => 'textsimple',
				'name'          => 'side_area_text_letterspacing',
				'default_value' => '',
				'label'         => 'Letter Spacing',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$widget_links_group = voyage_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'widget_links_group',
				'title'       => 'Link Style',
				'description' => 'Define styles for Side Area widget links'
			)
		);

		$widget_links_row_1 = voyage_mikado_add_admin_row(
			array(
				'parent' => $widget_links_group,
				'name'   => 'widget_links_row_1',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_1,
				'type'          => 'colorsimple',
				'name'          => 'sidearea_link_color',
				'default_value' => '',
				'label'         => 'Text Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_1,
				'type'          => 'textsimple',
				'name'          => 'sidearea_link_font_size',
				'default_value' => '',
				'label'         => 'Font Size',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_1,
				'type'          => 'textsimple',
				'name'          => 'sidearea_link_line_height',
				'default_value' => '',
				'label'         => 'Line Height',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_1,
				'type'          => 'selectblanksimple',
				'name'          => 'sidearea_link_text_transform',
				'default_value' => '',
				'label'         => 'Text Transform',
				'options'       => voyage_mikado_get_text_transform_array()
			)
		);

		$widget_links_row_2 = voyage_mikado_add_admin_row(
			array(
				'parent' => $widget_links_group,
				'name'   => 'widget_links_row_2',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_2,
				'type'          => 'fontsimple',
				'name'          => 'sidearea_link_font_family',
				'default_value' => '-1',
				'label'         => 'Font Family',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_2,
				'type'          => 'selectblanksimple',
				'name'          => 'sidearea_link_font_style',
				'default_value' => '',
				'label'         => 'Font Style',
				'options'       => voyage_mikado_get_font_style_array()
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_2,
				'type'          => 'selectblanksimple',
				'name'          => 'sidearea_link_font_weight',
				'default_value' => '',
				'label'         => 'Font Weight',
				'options'       => voyage_mikado_get_font_weight_array()
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_2,
				'type'          => 'textsimple',
				'name'          => 'sidearea_link_letter_spacing',
				'default_value' => '',
				'label'         => 'Letter Spacing',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$widget_links_row_3 = voyage_mikado_add_admin_row(
			array(
				'parent' => $widget_links_group,
				'name'   => 'widget_links_row_3',
				'next'   => true
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $widget_links_row_3,
				'type'          => 'colorsimple',
				'name'          => 'sidearea_link_hover_color',
				'default_value' => '',
				'label'         => 'Hover Color',
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'yesno',
				'name'          => 'side_area_enable_bottom_border',
				'default_value' => 'no',
				'label'         => 'Border Bottom on Elements',
				'description'   => 'Enable border bottom on elements in side area',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_side_area_bottom_border_container'
				)
			)
		);

		$side_area_bottom_border_container = voyage_mikado_add_admin_container(
			array(
				'parent'          => $side_area_panel,
				'name'            => 'side_area_bottom_border_container',
				'hidden_property' => 'side_area_enable_bottom_border',
				'hidden_value'    => 'no'
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $side_area_bottom_border_container,
				'type'          => 'color',
				'name'          => 'side_area_bottom_border_color',
				'default_value' => '',
				'label'         => 'Border Bottom Color',
				'description'   => 'Choose color for border bottom on elements in sidearea'
			)
		);

	}

	add_action('voyage_mikado_options_map', 'voyage_mikado_sidearea_options_map', 5);

}