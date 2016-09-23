<?php
namespace MikadoCore\CPT\Carousels;

use MikadoCore\Lib;

/**
 * Class CarouselRegister
 * @package MikadoCore\CPT\Carousels
 */
class CarouselRegister implements Lib\PostTypeInterface {
	/**
	 * @var string
	 */
	private $base;
	/**
	 * @var string
	 */
	private $taxBase;

	public function __construct() {
		$this->base    = 'carousels';
		$this->taxBase = 'carousels_category';
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
		$this->registerTax();
	}

	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		global $voyage_mikado_Framework;

		$menuPosition = 5;
		$menuIcon     = 'dashicons-admin-post';
		if(mkd_core_theme_installed()) {
			$menuPosition = $voyage_mikado_Framework->getSkin()->getMenuItemPosition('carousel');
			$menuIcon     = $voyage_mikado_Framework->getSkin()->getMenuIcon('carousel');
		}

		register_post_type($this->base,
			array(
				'labels'        => array(
					'name'          => __('Mikado Carousel', 'mikado-core'),
					'menu_name'     => __('Mikado Carousel', 'mikado-core'),
					'all_items'     => __('Carousel Items', 'mikado-core'),
					'add_new'       => __('Add New Carousel Item', 'mikado-core'),
					'singular_name' => __('Carousel Item', 'mikado-core'),
					'add_item'      => __('New Carousel Item', 'mikado-core'),
					'add_new_item'  => __('Add New Carousel Item', 'mikado-core'),
					'edit_item'     => __('Edit Carousel Item', 'mikado-core')
				),
				'public'        => false,
				'show_in_menu'  => true,
				'rewrite'       => array('slug' => 'carousels'),
				'menu_position' => $menuPosition,
				'show_ui'       => true,
				'has_archive'   => false,
				'hierarchical'  => false,
				'supports'      => array('title'),
				'menu_icon'     => $menuIcon
			)
		);
	}

	/**
	 * Registers custom taxonomy with WordPress
	 */
	private function registerTax() {
		$labels = array(
			'name'              => __('Carousels', 'mikado-core'),
			'singular_name'     => __('Carousel', 'mikado-core'),
			'search_items'      => __('Search Carousels', 'mikado-core'),
			'all_items'         => __('All Carousels', 'mikado-core'),
			'parent_item'       => __('Parent Carousel', 'mikado-core'),
			'parent_item_colon' => __('Parent Carousel:', 'mikado-core'),
			'edit_item'         => __('Edit Carousel', 'mikado-core'),
			'update_item'       => __('Update Carousel', 'mikado-core'),
			'add_new_item'      => __('Add New Carousel', 'mikado-core'),
			'new_item_name'     => __('New Carousel Name', 'mikado-core'),
			'menu_name'         => __('Carousels', 'mikado-core'),
		);

		register_taxonomy($this->taxBase, array($this->base), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array('slug' => 'carousels-category'),
		));
	}

}