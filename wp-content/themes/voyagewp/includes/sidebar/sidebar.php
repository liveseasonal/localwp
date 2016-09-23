<?php

if(!function_exists('voyage_mikado_register_sidebars')) {
	/**
	 * Function that registers theme's sidebars
	 */
	function voyage_mikado_register_sidebars() {

		register_sidebar(array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar',
			'description'   => 'Default Sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5><span class="mkdf-sidearea-title">',
			'after_title'   => '</span></h5>'
		));

	}

	add_action('widgets_init', 'voyage_mikado_register_sidebars');
}

if(!function_exists('voyage_mikado_add_support_custom_sidebar')) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates VoyageMikadoSidebar object
	 */
	function voyage_mikado_add_support_custom_sidebar() {
		add_theme_support('VoyageMikadoSidebar');
		if(get_theme_support('VoyageMikadoSidebar')) {
			new VoyageMikadoSidebar();
		}
	}

	add_action('after_setup_theme', 'voyage_mikado_add_support_custom_sidebar');
}
