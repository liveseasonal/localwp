<?php

namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class TourTypeList implements ShortcodeInterface {
    private $base;

    /**
     * TourTypeList constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_tour_type_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => 'Tour Type List',
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-tour-type-list extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Number of Tour Types',
                    'param_name'  => 'number',
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Order By',
                    'param_name'  => 'orderby',
                    'value'       => array(
                        'Name'  => 'name',
                        'Count' => 'count'
                    ),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Order Type',
                    'param_name'  => 'order',
                    'value'       => array(
                        'Ascending'  => 'ASC',
                        'Descending' => 'DESC'
                    ),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Choose Hover Color',
                    'param_name'  => 'hover_color',
                    'value'       => array(
                        'White' => 'white',
                        'Gray'  => 'gray'
                    ),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Split in Two Columns',
                    'param_name'  => 'split_two_cols',
                    'value'       => array(
                        'No'  => 'no',
                        'Yes' => 'yes'
                    ),
                    'admin_label' => true
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'number'         => '',
            'orderby'        => 'name',
            'order'          => 'ASC',
            'hover_color'    => '',
            'split_two_cols' => ''
        );

        $params = shortcode_atts($args, $atts);

        $hover_holder = '';
        if($params['hover_color'] == 'gray') {
            $hover_holder = 'mkdf-gray-hover';
        }

        $params['li_hover_color'] = $hover_holder;

        $tour_types = $this->getTourTypes($params);

        $params['tour_types'] = $tour_types;
        $params['caller']     = $this;

        $params['split_two_cols'] = $params['split_two_cols'] === 'yes';
        $params['list_class']     = $params['split_two_cols'] ? 'mkdf-grid-col-6' : 'mkdf-grid-col-12';

        $divider = $params['split_two_cols'] ? ceil(count($tour_types) / 2) : count($tour_types);

        $tour_types_arrays = array_chunk($tour_types, $divider);

        $params['tour_types_arrays'] = $tour_types_arrays;

        return mkdf_tours_get_tour_module_template_part('templates/tour-type-list', 'tours', 'shortcodes', '', $params);
    }

    private function getTourTypes($params) {
        $defaults = array(
            'number'  => '',
            'orderby' => 'name',
            'order'   => 'ASC'
        );

        $query_args = wp_parse_args($params, $defaults);

        return get_terms('tour-category', $query_args);
    }

    public function getTypeIcon($tour_type) {
        $type_image = get_term_meta($tour_type->term_id, 'term_custom_image', true);

        if(!empty($type_image)) {
            return '<img src="'.esc_url($type_image).'" alt="term-custom-icon">';
        }

        if(!mkdf_tours_theme_installed()) {
            return false;
        }

        $category_icon_pack = get_term_meta($tour_type->term_id, 'icon_pack', true);
        $icon_param_name    = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($category_icon_pack);
        $category_icon      = get_term_meta($tour_type->term_id, $icon_param_name, true);

        if(empty($category_icon)) {
            return '';
        }

        return voyage_mikado_icon_collections()->renderIcon($category_icon, $category_icon_pack);
    }

    public function getTypeMinPrice($tour_type) {
        global $wpdb;

        $sql = "SELECT MIN(CAST({$wpdb->prefix}postmeta.meta_value AS UNSIGNED)) AS min_price
				FROM {$wpdb->prefix}postmeta
				LEFT JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
				LEFT JOIN {$wpdb->prefix}term_relationships ON {$wpdb->prefix}term_relationships.object_id = {$wpdb->prefix}posts.ID
				WHERE {$wpdb->prefix}postmeta.meta_key = 'mkdf_tours_price'
				AND {$wpdb->prefix}term_relationships.term_taxonomy_id = %d";

        $results = $wpdb->get_results($wpdb->prepare($sql, $tour_type->term_id));

        if(!(is_array($results) && count($results))) {
            return false;
        }

        $result_instance = array_shift($results);

        return $result_instance->min_price;
    }
}