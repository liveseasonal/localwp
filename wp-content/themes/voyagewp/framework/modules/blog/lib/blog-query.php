<?php

namespace Voyage\Modules\Blog\Lib;


/**
 * Class BlogQuery
 * @package Voyage\Modules\Blog\Lib
 */
class BlogQuery {
    /**
     * @var array
     */
    private $queryParams;
    /**
     * @var
     */
    private $defaultQueryParams;
    /**
     * @var \WP_Query
     */
    private $object;

    /**
     * BlogQuery constructor.
     *
     * @param array $params
     */
    public function __construct($params) {
        $this->setDefaultQueryParams();
        $this->setQueryParams($params);

        $this->object = $this->buildQueryObject();
    }


    /**
     *
     */
    public function setDefaultQueryParams() {
        $this->defaultQueryParams = array(
            'posts_per_page' => '',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'category_name'  => ''
        );
    }

    /**
     * @return array
     */
    public function getQueryParams() {
        return $this->queryParams;
    }

    /**
     * @return \WP_Query
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @return \WP_Query
     */
    private function buildQueryObject() {
        return new \WP_Query($this->queryParams);
    }

    /**
     * @param $params
     */
    private function setQueryParams($params) {
        $this->queryParams = array();

        foreach($this->defaultQueryParams as $key => $defaultQueryParam) {
            if(!empty($params[$key])) {
                $this->queryParams[$key] = $params[$key];
            }
        }
    }
}