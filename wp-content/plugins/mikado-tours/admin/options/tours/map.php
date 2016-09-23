<?php

if(!function_exists('voyage_mikado_tours_options_map')) {

	function voyage_mikado_tours_options_map() {

		voyage_mikado_add_admin_page(array(
			'slug'  => '_tours_page',
			'title' => 'Tours',
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_payment = voyage_mikado_add_admin_panel(array(
			'title' => 'Payment',
			'name'  => 'panel_payment',
			'page'  => '_tours_page'
		));

		voyage_mikado_add_admin_section_title(array(
			'parent' => $panel_payment,
			'name'   => 'paypal_section_title',
			'title'  => 'PayPal'
		));

		voyage_mikado_add_admin_field(
			array(
				'name'          => 'tours_enable_paypal',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => 'Enable Paypal',
				'description'   => 'This option will enable/disable Paypal payment',
				'parent'        => $panel_payment,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_show_paypal_container"
				)
			)
		);

		$show_paypal_container = voyage_mikado_add_admin_container(
			array(
				'parent'          => $panel_payment,
				'name'            => 'show_paypal_container',
				'hidden_property' => 'tours_enable_paypal',
				'hidden_value'    => 'no'
			)
		);

		voyage_mikado_add_admin_field(array(
			'name'          => 'paypal_facilitator_id',
			'type'          => 'text',
			'default_value' => '',
			'label'         => 'Account ID',
			'description'   => 'Insert Business Account ID (Email)',
			'parent'        => $show_paypal_container
		));

		voyage_mikado_add_admin_field(array(
			'name'          => 'paypal_currency',
			'type'          => 'select',
			'default_value' => 'USD',
			'label'         => 'Currency',
			'description'   => 'Payment Currency',
			'parent'        => $show_paypal_container,
			'options'       => array(
				'USD' => 'U.S. Dollar',
				'EUR' => 'Euro',
				'GBP' => 'Pound Sterling',
				'AUD' => 'Australian Dollar',
				'CHF' => 'Swiss Franc',
				'BRL' => 'Brazilian Real ',
				'CAD' => 'Canadian Dollar',
				'CZK' => 'Czech Koruna',
				'DKK' => 'Danish Krone',
				'HKD' => 'Hong Kong Dollar',
				'HUF' => 'Hungarian Forint ',
				'ILS' => 'Israeli New Sheqel',
				'JPY' => 'Japanese Yen',
				'MYR' => 'Malaysian Ringgit',
				'MXN' => 'Mexican Peso',
				'NOK' => 'Norwegian Krone',
				'NZD' => 'New Zealand Dollar',
				'PHP' => 'Philippine Peso',
				'PLN' => 'Polish Zloty',
				'SGD' => 'Singapore Dollar',
				'SEK' => 'Swedish Krona',
				'TWD' => 'Taiwan New Dollar',
				'THB' => 'Thai Baht',
				'TRY' => 'Turkish Lira'
			)
		));

		$checkout_pages = mkdf_tours_get_checkout_pages();

		$settings_panel = voyage_mikado_add_admin_panel(array(
			'title' => 'Settings',
			'name'  => 'panel_settings',
			'page'  => '_tours_page'
		));

		voyage_mikado_add_admin_field(array(
			'name'          => 'tours_checkout_page',
			'type'          => 'select',
			'default_value' => '',
			'label'         => 'Checkout Page',
			'description'   => 'Choose checkout page',
			'parent'        => $settings_panel,
			'options'       => $checkout_pages,
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'name'          => 'tours_currency_symbol',
			'type'          => 'text',
			'default_value' => '',
			'label'         => 'Price Currency',
			'description'   => 'Insert currency for tour prices',
			'parent'        => $settings_panel,
			'args'          => array(
				'col_width' => '3'
			)
		));

		voyage_mikado_add_admin_field(array(
			'name'          => 'tours_currency_symbol_position',
			'type'          => 'select',
			'default_value' => 'left',
			'label'         => 'Price Currency Position',
			'description'   => 'Choose position for your currency symbol',
			'parent'        => $settings_panel,
			'options'       => array(
				'left'  => 'Left',
				'right' => 'Right'
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		$search_pages = mkdf_tours_get_search_pages(true);

		$search_panel = voyage_mikado_add_admin_panel(array(
			'title' => 'Search page',
			'name'  => 'panel_search',
			'page'  => '_tours_page'
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_main_page',
			'default_value' => '',
			'label'         => 'Main Search Page',
			'description'   => 'Choose main search page. Defaults to tour item archive page',
			'options'       => $search_pages,
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_per_page',
			'default_value' => 12,
			'label'         => 'Items per Page',
			'description'   => 'Choose number of tour items per page',
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_default_view_type',
			'default_value' => 'list',
			'label'         => 'Default Tour View Type',
			'description'   => 'Choose default tour view type',
			'options'       => array(
				'list'     => 'List',
				'standard' => 'Standard',
				'gallery'  => 'Gallery'
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_default_ordering',
			'default_value' => 'date',
			'label'         => 'Default Tour Ordering',
			'description'   => 'Choose default tour ordering',
			'options'       => array(
				'date'       => 'Date',
				'price_low'  => 'Price Low to High',
				'price_high' => 'Price High to Low',
				'name'       => 'Name'
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_standard_text_length',
			'default_value' => 55,
			'label'         => 'Standard Item Text Length',
			'description'   => 'Choose number of words for standard tour item',
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_standard_thumb_size',
			'default_value' => 'full',
			'label'         => 'Standard Thumbnail Size',
			'description'   => 'Choose thumbnail size for standard tour item',
			'options'       => array(
				'full'                           => 'Full',
				'voyage_landscape' => 'Landscape',
				'voyage_portrait'  => 'Portrait',
				'voyage_square'    => 'Square'
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_gallery_text_length',
			'default_value' => 55,
			'label'         => 'Gallery Item Text Length',
			'description'   => 'Choose number of words for gallery tour item',
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_gallery_thumb_size',
			'default_value' => 'full',
			'options'       => array(
				'full'                           => 'Full',
				'voyage_landscape' => 'Landscape',
				'voyage_portrait'  => 'Portrait',
				'voyage_square'    => 'Square'
			),
			'label'         => 'Gallery Thumbnail Size',
			'description'   => 'Choose thumbnail size for gallery tour item',
			'args'          => array(
				'col_width' => 3
			)
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_list_text_length',
			'default_value' => 55,
			'label'         => 'List Item Text Length',
			'description'   => 'Choose number of words for list tour item',
			'args'          => array(
				'col_width' => 3
			)
		));

		$reviews_panel = voyage_mikado_add_admin_panel(array(
			'title' => 'Reviews',
			'name'  => 'panel_reviews',
			'page'  => '_tours_page'
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $reviews_panel,
			'type'          => 'text',
			'name'          => 'reviews_section_title',
			'default_value' => '',
			'label'         => 'Reviews Section Title',
			'description'   => 'Enter title that you want to show before average rating for each tour',
		));

		voyage_mikado_add_admin_field(array(
			'parent'        => $reviews_panel,
			'type'          => 'textarea',
			'name'          => 'reviews_section_subtitle',
			'default_value' => '',
			'label'         => 'Reviews Section Subtitle',
			'description'   => 'Enter subtitle that you want to show before average rating for each tour',
		));
	}

	add_action('voyage_mikado_options_map', 'voyage_mikado_tours_options_map', 11);
}