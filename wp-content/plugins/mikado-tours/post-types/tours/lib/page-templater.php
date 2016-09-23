<?php
namespace MikadofTours\CPT\Tours\Lib;

class PageTemplater {

	/**
	 * A Unique Identifier
	 */
	protected $plugin_slug;

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;


	/**
	 * Returns an instance of this class.
	 */
	public static function getInstance() {

		if(null == self::$instance) {
			self::$instance = new PageTemplater();
		}

		return self::$instance;

	}

	private function __construct() {
	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	public function registerFilters() {
		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		add_filter(
			'page_attributes_dropdown_pages_args',
			array($this, 'registerTemplates')
		);


		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array($this, 'registerTemplates')
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array($this, 'viewTemplate')
		);

		add_filter('archive_template', array($this, 'registerArchivePage'));


		// Add your templates to this array.
		$this->templates = array(
			'post-types/tours/templates/checkout/tour-checkout.php'    => 'Tour Checkout',
			'post-types/tours/templates/search-tour-item-template.php' => 'Tours Search'
		);
	}

	public function initialize() {
		add_action('plugins_loaded', array($this, 'registerFilters'));
	}


	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 */

	public function registerTemplates($atts) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-'.md5(get_theme_root().'/'.get_stylesheet());

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if(empty($templates)) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete($cache_key, 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge($templates, $this->templates);

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add($cache_key, $templates, 'themes', 1800);

		return $atts;

	}

	public function registerArchivePage($template) {
		if(!is_post_type_archive('tour-item')) {
			return $template;
		}

		if(file_exists(get_stylesheet_directory().'/tour-templates/search-tour-item-template.php')) {
			return get_stylesheet_directory().'/tour-templates/search-tour-item-template.php';
		}

		if(file_exists(get_template_directory().'/tour-templates/search-tour-item-template.php')) {
			return get_template_directory().'/tour-templates/search-tour-item-template.php';
		}

		return plugin_dir_path(MIKADOF_TOURS_MAIN_FILE_PATH).'/post-types/tours/templates/search-tour-item-template.php';
	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function viewTemplate($template) {

		global $post;

		if(is_page()) {
			if(!isset($this->templates[get_post_meta(
					$post->ID, '_wp_page_template', true
				)])
			) {
				return $template;

			}

			$file = plugin_dir_path(MIKADOF_TOURS_MAIN_FILE_PATH).get_post_meta(
					$post->ID, '_wp_page_template', true
				);

			$explodedFile = explode('/', $file);

			$fileName = array_pop($explodedFile);

			if(file_exists(get_stylesheet_directory().'/tour-templates/'.$fileName)) {
				return get_stylesheet_directory().'/tour-templates/'.$fileName;
			}

			// Just to be safe, we check if the file exist first
			if(file_exists($file)) {
				return $file;
			} else {
				echo $file;
			}
		}

		return $template;
	}
}