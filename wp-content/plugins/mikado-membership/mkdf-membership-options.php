<?php
/**
 * Options map file
 */

if ( ! function_exists( 'mkdf_membership_add_options' ) ) {
	/**
	 * Map plugin options
	 */
	function mkdf_membership_add_options() {

		if ( mkdf_membership_theme_installed() ) {

			$panel_social_login = voyage_mikado_add_admin_panel( array(
				'page'  => '_social_page',
				'name'  => 'panel_social_login',
				'title' => 'Enable Social Login'
			) );

			voyage_mikado_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_social_login',
				'default_value' => 'no',
				'label'         => 'Enable Social Login',
				'description'   => 'Enabling this option will allow login from social networks of your choice',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_panel_enable_social_login'
				),
				'parent'        => $panel_social_login
			) );

			$panel_enable_social_login = voyage_mikado_add_admin_panel( array(
				'page'            => '_social_page',
				'name'            => 'panel_enable_social_login',
				'title'           => 'Enable Login via',
				'hidden_property' => 'enable_social_login',
				'hidden_value'    => 'no'
			) );

			voyage_mikado_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_social_login',
				'default_value' => 'no',
				'label'         => 'Facebook',
				'description'   => 'Enabling this option will allow login via Facebook',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_facebook_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_facebook_social_login_container = voyage_mikado_add_admin_container( array(
				'name'            => 'enable_facebook_social_login_container',
				'hidden_property' => 'enable_facebook_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			voyage_mikado_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_facebook_login_fbapp_id',
				'default_value' => '',
				'label'         => 'Facebook App ID',
				'description'   => 'Copy your application ID form created Facebook Application',
				'parent'        => $enable_facebook_social_login_container
			) );

			voyage_mikado_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_google_social_login',
				'default_value' => 'no',
				'label'         => 'Google+',
				'description'   => 'Enabling this option will allow login via Google+',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_google_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_google_social_login_container = voyage_mikado_add_admin_container( array(
				'name'            => 'enable_google_social_login_container',
				'hidden_property' => 'enable_google_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			voyage_mikado_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_google_login_client_id',
				'default_value' => '',
				'label'         => 'Client ID',
				'description'   => 'Copy your Client ID form created Google Application',
				'parent'        => $enable_google_social_login_container
			) );

		}

	}

	add_action( 'voyage_mikado_options_map', 'mkdf_membership_add_options', 18 );

}
