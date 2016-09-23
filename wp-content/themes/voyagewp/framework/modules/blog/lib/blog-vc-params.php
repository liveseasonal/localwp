<?php

namespace Voyage\Modules\Blog\Lib;

/**
 * Class BlogVCParams
 * @package Voyage\Modules\Blog\Lib
 */
class BlogVCParams {
    /**
     * @var string
     */
    private $group;

    /**
     * BlogVCParams constructor.
     *
     * @param string $group
     */
    public function __construct($group = 'Query Options') {
        $this->group = $group;
    }

    /**
     * @return array
     */
    public function queryVCParams() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => 'Number of Posts',
                'param_name'  => 'posts_per_page',
                'description' => '',
                'group'       => $this->group
            ),
            array(
                'type'        => 'dropdown',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => 'Order By',
                'param_name'  => 'orderby',
                'value'       => array(
                    'Date'  => 'date',
                    'Title' => 'title'
                ),
                'save_always' => true,
                'description' => '',
                'group'       => $this->group
            ),
            array(
                'type'        => 'dropdown',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => 'Order',
                'param_name'  => 'order',
                'value'       => array(
                    'DESC' => 'DESC',
                    'ASC'  => 'ASC'
                ),
                'save_always' => true,
                'description' => '',
                'group'       => $this->group
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => 'Category Slug',
                'param_name'  => 'category_name',
                'description' => 'Leave empty for all or use comma for list',
                'group'       => $this->group
            )
        );
    }

    /**
     * @return array
     */
    public function getShortcodeAtts() {
        return array(
            'posts_per_page' => '',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'category_name'  => ''
        );
    }
}