<?php

class VoyageMikadoLatestPosts extends VoyageMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkdf_latest_posts_widget', // Base ID
            'Mikado Latest Post', // Name
            array('description' => esc_html__('Display posts from your blog', 'voyage'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => 'Title'
            ),
            array(
                'name'    => 'type',
                'type'    => 'dropdown',
                'title'   => 'Type',
                'options' => array(
                    'minimal'      => 'Minimal',
                    'image-in-box' => 'Image in box'
                )
            ),
            array(
                'name'  => 'number_of_posts',
                'type'  => 'textfield',
                'title' => 'Number of posts'
            ),
            array(
                'name'    => 'order_by',
                'type'    => 'dropdown',
                'title'   => 'Order By',
                'options' => array(
                    'title' => 'Title',
                    'date'  => 'Date'
                )
            ),
            array(
                'name'    => 'order',
                'type'    => 'dropdown',
                'title'   => 'Order',
                'options' => array(
                    'ASC'  => 'ASC',
                    'DESC' => 'DESC'
                )
            ),
            array(
                'name'    => 'image_size',
                'type'    => 'dropdown',
                'title'   => 'Image Size',
                'options' => array(
                    'original'  => 'Original',
                    'landscape' => 'Landscape',
                    'square'    => 'Square',
                    'custom'    => 'Custom'
                )
            ),
            array(
                'name'  => 'custom_image_size',
                'type'  => 'textfield',
                'title' => 'Custom Image Size'
            ),
            array(
                'name'  => 'category',
                'type'  => 'textfield',
                'title' => 'Category Slug'
            ),
            array(
                'name'  => 'text_length',
                'type'  => 'textfield',
                'title' => 'Number of characters'
            ),
            array(
                'name'    => 'title_tag',
                'type'    => 'dropdown',
                'title'   => 'Title Tag',
                'options' => array(
                    ""   => "",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6"
                )
            ),
            array(
                'name'    => 'remove_category',
                'type'    => 'dropdown',
                'title'   => 'Remove Comments on Image In Box',
                'options' => array(
                    'yes' => 'Yes',
                    'no'  => 'No'
                ),
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $content        = '';
        $params         = array();
        $params['type'] = 'image_in_box';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        if(empty($params['title_tag'])) {
            $params['title_tag'] = 'h6';
        }
        echo '<div class="widget mkdf-latest-posts-widget">';

        if(!empty($instance['title'])) {
            print $args['before_title'].$instance['title'].$args['after_title'];
        }

        echo voyage_mikado_execute_shortcode('mkdf_blog_list', $params);

        echo '</div>'; //close mkdf-latest-posts-widget
    }
}
