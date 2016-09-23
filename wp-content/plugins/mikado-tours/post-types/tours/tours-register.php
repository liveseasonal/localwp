<?php
namespace MikadofTours\CPT\Tours;

use MikadofTours\Lib;

/**
 * Class ToursRegister
 * @package MikadofTours\CPT\Tours
 */
class ToursRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base    = 'tour-item';
        $this->taxBase = 'tour-category';
        add_filter('single_template', array($this, 'registerSingleTemplate'));

        add_action('admin_menu', array($this, 'removeReviewCriteriaMetaBox'));
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
     * Registers listing-item single template if one does'nt exists in theme.
     * Hooked to single_template filter
     *
     * @param $single string current template
     *
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-tour-item.php')) {
                return MIKADOF_TOURS_CPT_PATH.'/tours/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $voyage_mikado_Framework;

        $menuPosition = 5;
        $menuIcon     = 'dashicons-before';
        if(mkdf_tours_theme_installed()) {
            $menuPosition = $voyage_mikado_Framework->getSkin()->getMenuItemPosition('tours');
            $menuIcon     = $voyage_mikado_Framework->getSkin()->getMenuIcon('tours');
        }
        $slug = $this->base;

        register_post_type($this->base,
            array(
                'labels'        => array(
                    'name'          => __('Mikado Tour', 'mikado-tours'),
                    'menu_name'     => __('Mikado Tour', 'mikado-tours'),
                    'all_items'     => __('Tour Items', 'mikado-tours'),
                    'add_new'       => __('Add New Tour Item', 'mikado-tours'),
                    'singular_name' => __('Tour Item', 'mikado-tours'),
                    'add_item'      => __('New Tour Item', 'mikado-tours'),
                    'add_new_item'  => __('Add New Tour Item', 'mikado-tours'),
                    'edit_item'     => __('Edit Tour Item', 'mikado-tours')
                ),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'show_in_menu'  => true,
                'supports'      => array(
                    'author',
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'page-attributes',
                    'comments'
                ),
                'menu_icon'     => $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'              => __('Tours Categories', 'mikado-tours'),
            'singular_name'     => __('Tour Category', 'mikado-tours'),
            'search_items'      => __('Search Tours Categories', 'mikado-tours'),
            'all_items'         => __('All Tours Categories', 'mikado-tours'),
            'parent_item'       => __('Parent Tour Category', 'mikado-tours'),
            'parent_item_colon' => __('Parent Tour Category:', 'mikado-tours'),
            'edit_item'         => __('Edit Tour Category', 'mikado-tours'),
            'update_item'       => __('Update Tour Category', 'mikado-tours'),
            'add_new_item'      => __('Add New Tour Category', 'mikado-tours'),
            'new_item_name'     => __('New Tour Category Name', 'mikado-tours'),
            'menu_name'         => __('Tours Categories', 'mikado-tours'),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'tour-category'),
        ));

        register_taxonomy('review-criteria', array($this->base), array(
            'hierarchical'      => true,
            'show_ui'           => true,
            'labels'            => array(
                'name'              => __('Review Criteria', 'mikado-tours'),
                'singular_name'     => __('Review Criterion', 'mikado-tours'),
                'search_items'      => __('Search Review Criteria', 'mikado-tours'),
                'all_items'         => __('All Review Criteria', 'mikado-tours'),
                'parent_item'       => __('Parent Review Criterion', 'mikado-tours'),
                'parent_item_colon' => __('Parent Review Criterion:', 'mikado-tours'),
                'edit_item'         => __('Edit Review Criterion', 'mikado-tours'),
                'update_item'       => __('Update Review Criterion', 'mikado-tours'),
                'add_new_item'      => __('Add New Review Criterion', 'mikado-tours'),
                'new_item_name'     => __('New Review Criterion Name', 'mikado-tours'),
                'menu_name'         => __('Review Criteria', 'mikado-tours'),
            ),
            'query_var'         => true,
            'show_admin_column' => false,
        ));
    }

    public function removeReviewCriteriaMetaBox() {
        //remove review criteria meta box from tour single page,
        //because we don't want user to check review criteria for each tour
        remove_meta_box('review-criteriadiv', $this->base, 'side');
    }
}