<?php

if(!function_exists('voyage_mikado_blog_options_map')) {

	function voyage_mikado_blog_options_map() {

		voyage_mikado_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => 'Blog',
				'icon'  => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */

		$custom_sidebars = voyage_mikado_get_custom_sidebars();

		$panel_blog_lists = voyage_mikado_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => 'Blog Lists'
			)
		);

		voyage_mikado_add_admin_field(array(
			'name'          => 'blog_list_type',
			'type'          => 'select',
			'label'         => 'Blog Layout for Archive Pages',
			'description'   => 'Choose a default blog layout',
			'default_value' => 'standard-date-on-side',
			'parent'        => $panel_blog_lists,
			'options'       => array(
				'standard'              => 'Blog: Standard',
				'split-column'          => 'Blog: Split Column',
				'masonry'               => 'Blog: Masonry',
				'masonry-full-width'    => 'Blog: Masonry Full Width',
				'standard-whole-post'   => 'Blog: Standard Whole Post',
				'standard-date-on-side' => 'Blog: Standard Date On Side'
			)
		));

		voyage_mikado_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Archive and Category Sidebar',
			'description' => 'Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'          => 'No Sidebar',
				'sidebar-33-right' => 'Sidebar 1/3 Right',
				'sidebar-25-right' => 'Sidebar 1/4 Right',
				'sidebar-33-left'  => 'Sidebar 1/3 Left',
				'sidebar-25-left'  => 'Sidebar 1/4 Left',
			)
		));


		if(count($custom_sidebars) > 0) {
			voyage_mikado_add_admin_field(array(
				'name'        => 'blog_custom_sidebar',
				'type'        => 'selectblank',
				'label'       => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"',
				'parent'      => $panel_blog_lists,
				'options'     => voyage_mikado_get_custom_sidebars()
			));
		}

		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'pagination',
				'default_value' => 'yes',
				'label'         => 'Pagination',
				'parent'        => $panel_blog_lists,
				'description'   => 'Enabling this option will display pagination links on bottom of Blog Post List',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_pagination_container'
				)
			)
		);

		$pagination_container = voyage_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_lists,
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'parent'        => $pagination_container,
				'type'          => 'text',
				'name'          => 'blog_page_range',
				'default_value' => '',
				'label'         => 'Pagination Range limit',
				'description'   => 'Enter a number that will limit pagination to a certain range of links',
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		voyage_mikado_add_admin_field(array(
			'name'        => 'masonry_pagination',
			'type'        => 'select',
			'label'       => 'Pagination on Masonry',
			'description' => 'Choose a pagination style for Masonry Blog List',
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'        => 'Standard',
				'load-more'       => 'Load More',
				'infinite-scroll' => 'Infinite Scroll'
			),

		));
		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_load_more_pag',
				'default_value' => 'no',
				'label'         => 'Load More Pagination on Other Lists',
				'parent'        => $pagination_container,
				'description'   => 'Enable Load More Pagination on other lists',
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'masonry_filter',
				'default_value' => 'no',
				'label'         => 'Masonry Filter',
				'parent'        => $panel_blog_lists,
				'description'   => 'Enabling this option will display category filter on Masonry and Masonry Full Width Templates',
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		voyage_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '',
				'label'         => 'Number of Words in Excerpt',
				'parent'        => $panel_blog_lists,
				'description'   => 'Enter a number of words in excerpt (article summary)',
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		voyage_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'standard_number_of_chars',
				'default_value' => '45',
				'label'         => 'Standard Type Number of Words in Excerpt',
				'parent'        => $panel_blog_lists,
				'description'   => 'Enter a number of words in excerpt (article summary)',
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		voyage_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'masonry_number_of_chars',
				'default_value' => '45',
				'label'         => 'Masonry Type Number of Words in Excerpt',
				'parent'        => $panel_blog_lists,
				'description'   => 'Enter a number of words in excerpt (article summary)',
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		voyage_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'split_column_number_of_chars',
				'default_value' => '45',
				'label'         => 'Split Column Type Number of Words in Excerpt',
				'parent'        => $panel_blog_lists,
				'description'   => 'Enter a number of words in excerpt (article summary)',
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = voyage_mikado_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => 'Blog Single'
			)
		);

		voyage_mikado_add_admin_field(array(
			'name'        => 'blog_single_type',
			'type'        => 'select',
			'label'       => 'Blog Single Type',
			'description' => 'Choose a layout type for Blog Single pages',
			'parent'      => $panel_blog_single,
			'options'     => array(
				'standard'     => 'Standard',
				'date-on-side' => 'Date On Side',
			),
		));

		voyage_mikado_add_admin_field(array(
			'name'          => 'blog_single_sidebar_layout',
			'type'          => 'select',
			'label'         => 'Sidebar Layout',
			'description'   => 'Choose a sidebar layout for Blog Single pages',
			'parent'        => $panel_blog_single,
			'options'       => array(
				'default'          => 'No Sidebar',
				'sidebar-33-right' => 'Sidebar 1/3 Right',
				'sidebar-25-right' => 'Sidebar 1/4 Right',
				'sidebar-33-left'  => 'Sidebar 1/3 Left',
				'sidebar-25-left'  => 'Sidebar 1/4 Left',
			),
			'default_value' => 'default'
		));


		if(count($custom_sidebars) > 0) {
			voyage_mikado_add_admin_field(array(
				'name'        => 'blog_single_custom_sidebar',
				'type'        => 'selectblank',
				'label'       => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"',
				'parent'      => $panel_blog_single,
				'options'     => voyage_mikado_get_custom_sidebars()
			));
		}
//		voyage_mikado_add_admin_field(array(
//			'name'          => 'blog_single_comments',
//			'type'          => 'yesno',
//			'label'         => 'Show Comments',
//			'description'   => 'Enabling this option will show comments on your page.',
//			'parent'        => $panel_blog_single,
//			'default_value' => 'yes'
//		));

		voyage_mikado_add_admin_field(array(
			'name'          => 'blog_single_related_posts',
			'type'          => 'yesno',
			'label'         => 'Show Related Posts',
			'description'   => 'Enabling this option will show related posts on your single post.',
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => 'Enable Prev/Next Single Post Navigation Links',
				'parent'        => $panel_blog_single,
				'description'   => 'Enable navigation links through the blog posts (left and right arrows will appear)',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = voyage_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_single,
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => 'Enable Navigation Only in Current Category',
				'description'   => 'Limit your navigation only through current category',
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		voyage_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'blog_enable_single_tags',
			'default_value' => 'yes',
			'label'         => 'Enable Tags on Single Post',
			'description'   => 'Enabling this option will display posts\s tags on single post page',
			'parent'        => $panel_blog_single
		));

		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'no',
				'label'         => 'Show Author Info Box',
				'parent'        => $panel_blog_single,
				'description'   => 'Enabling this option will display author name and descriptions on Blog Single pages',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = voyage_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_single,
			)
		);

		voyage_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => 'Show Author Email',
				'description'   => 'Enabling this option will show author email',
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

	}

	add_action('voyage_mikado_options_map', 'voyage_mikado_blog_options_map', 14);

}











