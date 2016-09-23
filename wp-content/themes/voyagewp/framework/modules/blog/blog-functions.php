<?php
if(!function_exists('voyage_mikado_get_blog')) {
    /**
     * Function which return holder for all blog lists
     *
     * @return holder.php template
     */
    function voyage_mikado_get_blog($type) {

        $sidebar = voyage_mikado_sidebar_layout();

        $params = array(
            "blog_type" => $type,
            "sidebar"   => $sidebar
        );
        voyage_mikado_get_module_template_part('templates/lists/holder', 'blog', '', $params);
    }

}

if(!function_exists('voyage_mikado_get_blog_type')) {

    /**
     * Function which create query for blog lists
     *
     * @return blog list template
     */

    function voyage_mikado_get_blog_type($type) {

        $blog_query = voyage_mikado_get_blog_query();

        $paged        = voyage_mikado_paged();
        $blog_classes = '';

        if(voyage_mikado_options()->getOptionValue('blog_page_range') != "") {
            $blog_page_range = esc_attr(voyage_mikado_options()->getOptionValue('blog_page_range'));
        } else {
            $blog_page_range = $blog_query->max_num_pages;
        }
        $show_load_more = voyage_mikado_enable_load_more();

        if($show_load_more) {
            $blog_classes .= ' mkdf-blog-load-more';
        }

        $params = array(
            'blog_query'      => $blog_query,
            'paged'           => $paged,
            'blog_page_range' => $blog_page_range,
            'blog_type'       => $type,
            'blog_classes'    => $blog_classes
        );

        voyage_mikado_get_module_template_part('templates/lists/'.$type, 'blog', '', $params);
    }

}

if(!function_exists('voyage_mikado_get_blog_query')) {
    /**
     * Function which create query for blog lists
     *
     * @return wp query object
     */
    function voyage_mikado_get_blog_query() {
        global $wp_query;

        $id       = voyage_mikado_get_page_id();
        $category = esc_attr(get_post_meta($id, "mkdf_blog_category_meta", true));
        if(esc_attr(get_post_meta($id, "mkdf_show_posts_per_page_meta", true)) != "") {
            $post_number = esc_attr(get_post_meta($id, "mkdf_show_posts_per_page_meta", true));
        } else {
            $post_number = esc_attr(get_option('posts_per_page'));
        }

        $paged       = voyage_mikado_paged();
        $query_array = array(
            'post_type'      => 'post',
            'paged'          => $paged,
            'cat'            => $category,
            'posts_per_page' => $post_number
        );
        if(is_archive()) {
            $blog_query = $wp_query;
        } else {
            $blog_query = new WP_Query($query_array);
        }

        return $blog_query;

    }
}

if(!function_exists('voyage_mikado_add_user_custom_fields')) {
    /**
     * Function creates custom social fields for users
     *
     * return $user_contact
     */
    function voyage_mikado_add_user_custom_fields($user_contact) {

        /**
         * Function that add custom user fields
         **/
        $user_contact['position']   = esc_html__('Position', 'voyage');
        $user_contact['instagram']  = esc_html__('Instagram', 'voyage');
        $user_contact['twitter']    = esc_html__('Twitter', 'voyage');
        $user_contact['pinterest']  = esc_html__('Pinterest', 'voyage');
        $user_contact['tumblr']     = esc_html__('Tumbrl', 'voyage');
        $user_contact['facebook']   = esc_html__('Facebook', 'voyage');
        $user_contact['googleplus'] = esc_html__('Google Plus', 'voyage');
        $user_contact['linkedin']   = esc_html__('Linkedin', 'voyage');

        return $user_contact;
    }

    add_filter('user_contactmethods', 'voyage_mikado_add_user_custom_fields');
}

if(!function_exists('voyage_mikado_get_user_custom_fields')) {
    /**
     * Function returns links and icons for author social networks
     *
     * return array
     */
    function voyage_mikado_get_user_custom_fields() {

        $user_social_array    = array();
        $social_network_array = array(
            'instagram',
            'twitter',
            'pinterest',
            'tumblr',
            'facebook',
            'googleplus',
            'linkedin'
        );

        foreach($social_network_array as $network) {
            if(get_the_author_meta($network) != '') {
                $$network                    = array(
                    'link'  => get_the_author_meta($network),
                    'class' => 'social_'.$network.' mkdf-author-social-'.$network.' mkdf-author-social-icon'
                );
                $user_social_array[$network] = $$network;
            }
        }

        return $user_social_array;
    }
}


if(!function_exists('voyage_mikado_get_post_format_html')) {

    /**
     * Function which return html for post formats
     *
     * @param $type
     *
     * @return post hormat template
     */

    function voyage_mikado_get_post_format_html($type = "", $ajax = '') {

        $post_format = get_post_format();

        $supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
        if(in_array($post_format, $supported_post_formats)) {
            $post_format = $post_format;
        } else {
            $post_format = 'standard';
        }

        $slug = '';
        if($type !== "") {
            $slug = $type;
        }

        if($slug === 'masonry-full-width') {
            $slug = 'masonry';
        }

        $params = array();

        $chars_array = voyage_mikado_blog_lists_number_of_chars();
        if(isset($chars_array[$type])) {
            $params['excerpt_length'] = $chars_array[$type];
        } else {
            $params['excerpt_length'] = '';
        }

		$params['time_j'] = 'j';
		$params['time_m'] = 'M';

        if($ajax == '') {
            voyage_mikado_get_module_template_part('templates/lists/post-formats/'.$post_format, 'blog', $slug, $params);
        }
        if($ajax == 'yes') {
            return voyage_mikado_get_blog_module_template_part('templates/lists/post-formats/'.$post_format, $slug, $params);
        }


    }

}

if(!function_exists('voyage_mikado_get_default_blog_list')) {
    /**
     * Function which return default blog list for archive post types
     *
     * @return post format template
     */

    function voyage_mikado_get_default_blog_list() {

        $blog_list = voyage_mikado_options()->getOptionValue('blog_list_type');

        return $blog_list;

    }

}

if(!function_exists('voyage_mikado_comment_form_submit_button')) {
    /**
     * Override comment form submit button
     *
     * @return mixed|string
     */
    function voyage_mikado_comment_form_submit_button() {

        $comment_form_button = voyage_mikado_get_button_html(array(
            'html_type'  => 'input',
            'type'       => 'solid',
            'text'       => 'Submit',
            'input_name' => 'submit'
        ));

        return $comment_form_button;

    }

    add_filter('comment_form_submit_button', 'voyage_mikado_comment_form_submit_button');

}

if(!function_exists('voyage_mikado_comments_title')) {
    /**
     * Print title for comments section
     */
    function voyage_mikado_comments_title() {
        ?>

        <div class="mkdf-comment-number">
            <div class="mkdf-comment-number-inner">
                <h3><?php comments_number(esc_html__('No Comments', 'voyage'), ''.esc_html__(' Comment ', 'voyage'), ' '.esc_html__(' Comments: ', 'voyage')); ?></h3>
            </div>
        </div>

        <?php
    }

    add_filter('voyage_mikado_comments_title', 'voyage_mikado_comments_title');

}


if(!function_exists('voyage_mikado_pagination')) {

    /**
     * Function which return pagination
     *
     * @return blog list pagination html
     */

    function voyage_mikado_pagination($pages = '', $range = 4, $paged = 1) {

        $showitems = $range + 1;

        if($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages) {
                $pages = 1;
            }
        }

        $show_load_more   = voyage_mikado_enable_load_more();
        $masonry_template = voyage_mikado_is_masonry_template();

        $search_template = 'no';
        if(is_search()) {
            $search_template = 'yes';
        }


        if($pages != 1) {
            if($show_load_more == 'yes' && $search_template !== 'yes' && !$masonry_template) {
                $params = array(
                    'text' => 'Load More'
                );
                echo '<div class="mkdf-load-more-ajax-pagination">';
                echo voyage_mikado_get_button_html($params);
                echo '</div>';
            } else {
                echo '<div class="mkdf-pagination">';
                echo '<ul>';
                if($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
                    echo '<li class="mkdf-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><<</a></li>';
                }
                echo "<li class='mkdf-pagination-prev";
                if($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
                    echo " mkdf-pagination prev-first";
                }
                echo "'><a href='".esc_url(get_pagenum_link($paged - 1))."'><span class='lnr lnr-chevron-left'></span></a></li>";

                for($i = 1; $i <= $pages; $i++) {
                    if(1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                        echo ($paged == $i) ? "<li class='active'><span>".$i."</span></li>" : "<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
                    }
                }

                echo '<li class="mkdf-pagination-next';
                if($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
                    echo ' mkdf-pagination-next-last';
                }
                echo '"><a href="';
                if($pages > $paged) {
                    echo esc_url(get_pagenum_link($paged + 1));
                } else {
                    echo esc_url(get_pagenum_link($paged));
                }
                echo '"><span class="lnr lnr-chevron-right"></span></a></li>';
                if($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
                    echo '<li class="mkdf-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'">></a></li>';
                }
                echo '</ul>';
                echo "</div>";

                echo '<div class="mkdf-pagination-helper">';
                previous_posts_link();
                next_posts_link();
                echo '</div>';
            }
        }
    }
}

if(!function_exists('voyage_mikado_post_info')) {
    /**
     * Function that loads parts of blog post info section
     * Possible options are:
     * 1. date
     * 2. category
     * 3. author
     * 4. comments
     * 5. like
     * 6. share
     *
     * @param $config array of sections to load
     */
    function voyage_mikado_post_info($config, $blog_type = '') {
        $default_config = array(
            'date'                => '',
            'category'            => '',
            'author'              => '',
            'comments'            => '',
            'like'                => '',
            'share'               => '',
            'show_comments_label' => false
        );

        extract(shortcode_atts($default_config, $config));
        $params['blog_type'] = $blog_type;

        if($date == 'yes') {
            voyage_mikado_get_module_template_part('templates/parts/post-info-date', 'blog');
        }

        if($like == 'yes') {
            voyage_mikado_get_module_template_part('templates/parts/post-info-like', 'blog');
        }

        if($comments == 'yes') {
            voyage_mikado_get_module_template_part('templates/parts/post-info-comments', 'blog', '', array('show_comments_label' => $show_comments_label));
        }

        if($category == 'yes') {
            voyage_mikado_get_module_template_part('templates/parts/post-info-category', 'blog');
        }
        if($author == 'yes') {
            voyage_mikado_get_module_template_part('templates/parts/post-info-author', 'blog');
        }

        if($share == 'yes') {
            voyage_mikado_get_module_template_part('templates/parts/post-info-share', 'blog');
        }
    }
}

if(!function_exists('voyage_mikado_excerpt')) {
    /**
     * Function that cuts post excerpt to the number of word based on previosly set global
     * variable $word_count, which is defined in mkd_set_blog_word_count function.
     *
     * It current post has read more tag set it will return content of the post, else it will return post excerpt
     *
     */
    function voyage_mikado_excerpt($excerpt_length = '') {
        global $post;

        if(post_password_required()) {
            echo get_the_password_form();
        } //does current post has read more tag set?
        elseif(voyage_mikado_post_has_read_more()) {
            global $more;

            //override global $more variable so this can be used in blog templates
            $more = 0;
            the_content(true);
        } //is word count set to something different that 0?
        elseif($excerpt_length != '0') {
            //if word count is set and different than empty take that value, else that general option from theme options
            $word_count = '45';
            if(isset($excerpt_length) && $excerpt_length != "") {
                $word_count = $excerpt_length;

            } elseif(voyage_mikado_options()->getOptionValue('number_of_chars') != '') {
                $word_count = esc_attr(voyage_mikado_options()->getOptionValue('number_of_chars'));
            }
            //if post excerpt field is filled take that as post excerpt, else that content of the post
            $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

            //remove leading dots if those exists
            $clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

            //if clean excerpt has text left
            if($clean_excerpt !== '') {
                //explode current excerpt to words
                $excerpt_word_array = explode(' ', $clean_excerpt);

                //cut down that array based on the number of the words option
                $excerpt_word_array = array_slice($excerpt_word_array, 0, $word_count);

                //add exerpt postfix
                $excert_postfix = apply_filters('voyage_mikado_excerpt_postfix', '...');

                //and finally implode words together
                $excerpt = implode(' ', $excerpt_word_array).$excert_postfix;

                //is excerpt different than empty string?
                if($excerpt !== '') {
                    echo '<p class="mkdf-post-excerpt">'.wp_kses_post($excerpt).'</p>';
                }
            }
        }
    }
}

if(!function_exists('voyage_mikado_get_blog_single')) {

    /**
     * Function which return holder for single posts
     *
     * @return single holder.php template
     */

    function voyage_mikado_get_blog_single() {
        $sidebar         = voyage_mikado_sidebar_layout();
        $single_template = voyage_mikado_options()->getOptionValue('blog_single_type');

        if ($single_template == ''){
        	$single_template = 'standard';
        }

        $params = array(
            "sidebar"         => $sidebar,
            "single_template" => 'mkdf-blog-'.$single_template
        );

        voyage_mikado_get_module_template_part('templates/single/holder', 'blog', '', $params);
    }
}

if(!function_exists('voyage_mikado_get_single_html')) {

    /**
     * Function return all parts on single.php page
     *
     *
     * @return single.php html
     */

    function voyage_mikado_get_single_html() {

        $post_format            = get_post_format();
        $supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
        if(in_array($post_format, $supported_post_formats)) {
            $post_format = $post_format;
        } else {
            $post_format = 'standard';
        }
		$params = array();
		$params['time_j'] = 'j';
		$params['time_m'] = 'M';

        //Related posts
        $related_posts_params = array();
        $show_related         = (voyage_mikado_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
        if($show_related) {
            $hasSidebar            = voyage_mikado_sidebar_layout();
            $post_id               = get_the_ID();
            $related_post_number   = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
            $related_posts_options = array(
                'posts_per_page' => $related_post_number
            );
            $related_posts_params  = array(
                'related_posts' => voyage_mikado_get_related_post_type($post_id, $related_posts_options)
            );
        }

        $single_options_template = voyage_mikado_options()->getOptionValue('blog_single_type');

        voyage_mikado_get_module_template_part('templates/single/post-formats/'.$post_format, 'blog', $single_options_template, $params);
        voyage_mikado_get_module_template_part('templates/single/parts/author-info', 'blog');
        voyage_mikado_get_single_post_navigation_template();
        if($show_related) {
            voyage_mikado_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
        }
        comments_template('', true);

    }

}
if(!function_exists('voyage_mikado_additional_post_items')) {

    /**
     * Function which return parts on single.php which are just below content
     *
     * @return single.php html
     */

    function voyage_mikado_additional_post_items() {

        if(has_tag() && voyage_mikado_options()->getOptionValue('blog_enable_single_tags') == 'yes') {
            voyage_mikado_get_module_template_part('templates/single/parts/tags', 'blog');
        }

        $args_pages = array(
            'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
            'after'       => '</div></div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '%'
        );

        wp_link_pages($args_pages);

    }

    add_action('voyage_mikado_before_blog_article_closed_tag', 'voyage_mikado_additional_post_items');
}


if(!function_exists('voyage_mikado_comment')) {

    /**
     * Function which modify default wordpress comments
     *
     * @return comments html
     */

    function voyage_mikado_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;

        global $post;

        $is_pingback_comment = $comment->comment_type == 'pingback';
        $is_author_comment   = $post->post_author == $comment->user_id;

        $comment_class = 'mkdf-comment clearfix';

        if($is_author_comment) {
            $comment_class .= ' mkdf-post-author-comment';
        }

        if($is_pingback_comment) {
            $comment_class .= ' mkdf-pingback-comment';
        }

        ?>

        <li>
        <div class="<?php echo esc_attr($comment_class); ?>">
            <?php if(!$is_pingback_comment) { ?>
                <div class="mkdf-comment-image"> <?php echo voyage_mikado_kses_img(get_avatar($comment, 75)); ?> </div>
            <?php } ?>
            <div class="mkdf-comment-text">
                <div class="mkdf-comment-info">
                    <h5 class="mkdf-comment-name">
                        <?php if($is_pingback_comment) {
                            esc_html_e('Pingback:', 'voyage');
                        } ?>
                        <?php echo wp_kses_post(get_comment_author_link()); ?>
                    </h5>
                    <span class="mkdf-comment-date"><?php comment_time(get_option('date_format')); ?><?php esc_html_e(' at ', 'voyage'); ?><?php comment_time(get_option('time_format')); ?></span>
                </div>

                <?php if(!$is_pingback_comment) { ?>
                    <div class="mkdf-text-holder" id="comment-<?php echo comment_ID(); ?>">
                        <?php comment_text(); ?>
                        <div class="mkdf-comment-reply-holder">
                            <?php
                            comment_reply_link(array_merge($args, array(
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth']
                            )));
                            edit_comment_link();
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php //li tag will be closed by WordPress after looping through child elements ?>

        <?php
    }
}

if(!function_exists('voyage_mikado_blog_archive_pages_classes')) {

    /**
     * Function which create classes for container in archive pages
     *
     * @return array
     */

    function voyage_mikado_blog_archive_pages_classes($blog_type) {

        $classes = array();
        if(in_array($blog_type, voyage_mikado_blog_full_width_types())) {
            $classes['holder'] = 'mkdf-full-width';
            $classes['inner']  = 'mkdf-full-width-inner';
        } elseif(in_array($blog_type, voyage_mikado_blog_grid_types())) {
            $classes['holder'] = 'mkdf-container';
            $classes['inner']  = 'mkdf-container-inner clearfix';
        }

        return $classes;

    }

}

if(!function_exists('voyage_mikado_blog_full_width_types')) {

    /**
     * Function which return all full width blog types
     *
     * @return array
     */

    function voyage_mikado_blog_full_width_types() {

        $types = array('masonry-full-width');

        return $types;

    }

}

if(!function_exists('voyage_mikado_blog_grid_types')) {

    /**
     * Function which return in grid blog types
     *
     * @return array
     */

    function voyage_mikado_blog_grid_types() {

        $types = array('standard', 'standard-date-on-side', 'masonry', 'split-column', 'standard-whole-post');

        return $types;

    }

}

if(!function_exists('voyage_mikado_blog_types')) {

    /**
     * Function which return all blog types
     *
     * @return array
     */

    function voyage_mikado_blog_types() {

        $types = array_merge(voyage_mikado_blog_grid_types(), voyage_mikado_blog_full_width_types());

        return $types;

    }

}

if(!function_exists('voyage_mikado_blog_templates')) {

    /**
     * Function which return all blog templates names
     *
     * @return array
     */

    function voyage_mikado_blog_templates() {

        $templates      = array();
        $grid_templates = voyage_mikado_blog_grid_types();
        $full_templates = voyage_mikado_blog_full_width_types();
        foreach($grid_templates as $grid_template) {
            array_push($templates, 'blog-'.$grid_template);
        }
        foreach($full_templates as $full_template) {
            array_push($templates, 'blog-'.$full_template);
        }

        return $templates;

    }

}

if(!function_exists('voyage_mikado_blog_lists_number_of_chars')) {

    /**
     * Function that return number of characters for different lists based on options
     *
     * @return int
     */

    function voyage_mikado_blog_lists_number_of_chars() {

        $number_of_chars = array();

        if(voyage_mikado_options()->getOptionValue('standard_number_of_chars')) {
            $number_of_chars['standard'] = voyage_mikado_options()->getOptionValue('standard_number_of_chars');
        }
        if(voyage_mikado_options()->getOptionValue('masonry_number_of_chars')) {
            $number_of_chars['masonry'] = voyage_mikado_options()->getOptionValue('masonry_number_of_chars');
        }
        if(voyage_mikado_options()->getOptionValue('masonry_number_of_chars')) {
            $number_of_chars['masonry-full-width'] = voyage_mikado_options()->getOptionValue('masonry_number_of_chars');
        }
        if(voyage_mikado_options()->getOptionValue('split_column_number_of_chars')) {
            $number_of_chars['split-column'] = voyage_mikado_options()->getOptionValue('split_column_number_of_chars');
        }

        return $number_of_chars;

    }

}

if(!function_exists('voyage_mikado_get_single_post_navigation_template')) {
    /**
     * Gets previous and next post and loads single post navigation
     */
    function voyage_mikado_get_single_post_navigation_template() {
        $params = array();

        $in_same_term = voyage_mikado_options()->getOptionValue('blog_navigation_through_same_category') === 'yes';

        $prev_post               = get_previous_post($in_same_term);
        $next_post               = get_next_post($in_same_term);
        $params['has_prev_post'] = false;
        $params['has_next_post'] = false;

        if($prev_post) {
            $params['prev_post_object'] = $prev_post;
            $params['has_prev_post']    = true;
            $params['prev_post']        = array(
                'title' => get_the_title($prev_post->ID),
                'link'  => get_the_permalink($prev_post->ID),
                'image' => get_the_post_thumbnail($prev_post->ID, 'thumbnail')
            );

            $params['prev_post_has_image'] = !empty($params['prev_post']['image']);
        }

        if($next_post) {
            $params['next_post_object'] = $next_post;
            $params['has_next_post']    = true;
            $params['next_post']        = array(
                'title' => get_the_title($next_post->ID),
                'link'  => get_the_permalink($next_post->ID),
                'image' => get_the_post_thumbnail($next_post->ID, 'thumbnail')
            );

            $params['next_post_has_image'] = !empty($params['next_post']['image']);
        }

        voyage_mikado_get_module_template_part('templates/single/parts/single-navigation', 'blog', '', $params);
    }
}

if(!function_exists('voyage_mikado_excerpt_length')) {
    /**
     * Function that changes excerpt length based on theme options
     *
     * @param $length int original value
     *
     * @return int changed value
     */
    function voyage_mikado_excerpt_length($length) {

        if(voyage_mikado_options()->getOptionValue('number_of_chars') !== '') {
            return esc_attr(voyage_mikado_options()->getOptionValue('number_of_chars'));
        } else {
            return 45;
        }
    }

    add_filter('excerpt_length', 'voyage_mikado_excerpt_length', 999);
}

if(!function_exists('voyage_mikado_excerpt_more')) {
    /**
     * Function that adds three dotes on the end excerpt
     *
     * @param $more
     *
     * @return string
     */
    function voyage_mikado_excerpt_more($more) {
        return '...';
    }

    add_filter('excerpt_more', 'voyage_mikado_excerpt_more');
}

if(!function_exists('voyage_mikado_post_has_read_more')) {
    /**
     * Function that checks if current post has read more tag set
     * @return int position of read more tag text. It will return false if read more tag isn't set
     */
    function voyage_mikado_post_has_read_more() {
        global $post;

        return strpos($post->post_content, '<!--more-->');
    }
}

if(!function_exists('voyage_mikado_post_has_title')) {
    /**
     * Function that checks if current post has title or not
     * @return bool
     */
    function voyage_mikado_post_has_title() {
        return get_the_title() !== '';
    }
}

if(!function_exists('voyage_mikado_modify_read_more_link')) {
    /**
     * Function that modifies read more link output.
     * Hooks to the_content_more_link
     * @return string modified output
     */
    function voyage_mikado_modify_read_more_link() {
        $link = '<div class="mkdf-more-link-container">';
        $link .= voyage_mikado_get_button_html(array(
            'link' => get_permalink().'#more-'.get_the_ID(),
            'text' => esc_html__('Continue reading', 'voyage'),
            'size' => 'small'
        ));

        $link .= '</div>';

        return $link;
    }

    add_filter('the_content_more_link', 'voyage_mikado_modify_read_more_link');
}


if(!function_exists('voyage_mikado_has_blog_widget')) {
    /**
     * Function that checks if latest posts widget is added to widget area
     * @return bool
     */
    function voyage_mikado_has_blog_widget() {
        $widgets_array = array(
            'mkd_latest_posts_widget'
        );

        foreach($widgets_array as $widget) {
            $active_widget = is_active_widget(false, false, $widget);

            if($active_widget) {
                return true;
            }
        }

        return false;
    }
}

if(!function_exists('voyage_mikado_has_blog_shortcode')) {
    /**
     * Function that checks if any of blog shortcodes exists on a page
     * @return bool
     */
    function voyage_mikado_has_blog_shortcode() {
        $blog_shortcodes = array(
            'mkdf_blog_list',
            'mkdf_blog_slider',
            'mkdf_blog_carousel'
        );

        $slider_field = get_post_meta(voyage_mikado_get_page_id(), 'mkdf_page_slider_meta', true); //TODO change

        foreach($blog_shortcodes as $blog_shortcode) {
            $has_shortcode = voyage_mikado_has_shortcode($blog_shortcode) || voyage_mikado_has_shortcode($blog_shortcode, $slider_field);

            if($has_shortcode) {
                return true;
            }
        }

        return false;
    }
}


if(!function_exists('voyage_mikado_load_blog_assets')) {
    /**
     * Function that checks if blog assets should be loaded
     *
     * @see voyage_mikado_is_ajax_enabled()
     * @see voyage_mikado_is_ajax_enabled_is_blog_template()
     * @see is_home()
     * @see is_single()
     * @see mkd_has_blog_shortcode()
     * @see is_archive()
     * @see is_search()
     * @see mkd_has_blog_widget()
     * @return bool
     */
    function voyage_mikado_load_blog_assets() {
        return voyage_mikado_is_ajax_enabled() || voyage_mikado_is_blog_template() || is_home() || is_single() || voyage_mikado_has_blog_shortcode() || is_archive() || is_search() || voyage_mikado_has_blog_widget();
    }
}

if(!function_exists('voyage_mikado_is_blog_template')) {
    /**
     * Checks if current template page is blog template page.
     *
     * @param string current page. Optional parameter.
     *
     * @return bool
     *
     * @see voyage_mikado_get_page_template_name()
     */
    function voyage_mikado_is_blog_template($current_page = '') {

        if($current_page == '') {
            $current_page = voyage_mikado_get_page_template_name();
        }

        $blog_templates = voyage_mikado_blog_templates();

        return in_array($current_page, $blog_templates);
    }
}

if(!function_exists('voyage_mikado_read_more_button')) {
    /**
     * Function that outputs read more button html if necessary.
     * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
     * and if post isn't password protected
     *
     * @param string $option name of option to check
     * @param string $class additional class to add to button
     *
     */
    function voyage_mikado_read_more_button($option = '', $class = '') {
        if($option != '') {
            $show_read_more_button = voyage_mikado_options()->getOptionValue($option) == 'yes';
        } else {
            $show_read_more_button = 'yes';
        }
        if($show_read_more_button && !voyage_mikado_post_has_read_more() && !post_password_required()) {
            echo voyage_mikado_get_button_html(array(
                'size'         => 'small',
                'link'         => get_the_permalink(),
                'text'         => esc_html__('Read More', 'voyage'),
                'custom_class' => $class
            ));
        }
    }
}

if(!function_exists('voyage_mikado_set_blog_holder_data_params')) {
    /**
     * Function which set data params on blog holder div
     */
    function voyage_mikado_set_blog_holder_data_params() {

        $show_load_more = voyage_mikado_enable_load_more();
        if($show_load_more) {
            $current_query = voyage_mikado_get_blog_query();

            $data_params        = array();
            $data_return_string = '';

            $paged = voyage_mikado_paged();

            $posts_number = '';
            if(get_post_meta(get_the_ID(), "mkdf_show_posts_per_page_meta", true) != "") {
                $posts_number = get_post_meta(get_the_ID(), "mkdf_show_posts_per_page_meta", true);
            } else {
                $posts_number = get_option('posts_per_page');
            }
            $category = get_post_meta(voyage_mikado_get_page_id(), 'mkdf_blog_category_meta', true);


            //set data params
            $data_params['data-next-page'] = $paged + 1;
            $data_params['data-max-pages'] = $current_query->max_num_pages;


            if($posts_number != '') {
                $data_params['data-post-number'] = $posts_number;
            }


            if($category != '') {
                $data_params['data-category'] = $category;
            }
            if(is_archive()) {
                if(is_category()) {
                    $cat_id                               = get_queried_object_id();
                    $data_params['data-archive-category'] = $cat_id;
                }
                if(is_author()) {
                    $author_id                          = get_queried_object_id();
                    $data_params['data-archive-author'] = $author_id;
                }
                if(is_tag()) {
                    $current_tag_id                  = get_queried_object_id();
                    $data_params['data-archive-tag'] = $current_tag_id;
                }
                if(is_date()) {
                    $day   = get_query_var('day');
                    $month = get_query_var('monthnum');
                    $year  = get_query_var('year');

                    $data_params['data-archive-day']   = $day;
                    $data_params['data-archive-month'] = $month;
                    $data_params['data-archive-year']  = $year;
                }
            }
            if(is_search()) {
                $search_query                              = get_search_query();
                $data_params['data-archive-search-string'] = $search_query; // to do, not finished
            }

            foreach($data_params as $key => $value) {
                if($key !== '') {
                    $data_return_string .= $key.'= '.esc_attr($value).' ';
                }
            }

            return $data_return_string;

        }
    }
}

if(!function_exists('voyage_mikado_enable_load_more')) {
    /**
     * Function that check if load more is enabled
     *
     * return boolean
     */
    function voyage_mikado_enable_load_more() {
        $enable_load_more = false;

        if(voyage_mikado_options()->getOptionValue('enable_load_more_pag') == 'yes') {
            $enable_load_more = true;
        }

        return $enable_load_more;
    }
}
if(!function_exists('voyage_mikado_is_masonry_template')) {
    /**
     * Check if is masonry template enabled
     * return boolean
     */
    function voyage_mikado_is_masonry_template() {

        $page_id               = voyage_mikado_get_page_id();
        $page_template         = get_page_template_slug($page_id);
        $page_options_template = voyage_mikado_options()->getOptionValue('blog_list_type');

        if(!is_archive()) {
            if($page_template == 'blog-masonry.php' || $page_template == 'blog-masonry-full-width.php') {
                return true;
            }
        } elseif(is_archive() || is_home()) {
            if($page_options_template == 'masonry' || $page_options_template == 'masonry-full-width') {
                return true;
            }
        } else {
            return false;
        }
    }


}

if(!function_exists('voyage_mikado_set_ajax_url')) {
    /**
     * load themes ajax functionality
     *
     */
    function voyage_mikado_set_ajax_url() {
        echo '<script type="application/javascript">var MikadofAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
    }

    add_action('wp_enqueue_scripts', 'voyage_mikado_set_ajax_url');

}

if(!function_exists('voyage_mikado_get_the_author_name')) {
    /**
     * Returns current author name. Must be called when in loop
     *
     * @return string
     */
    function voyage_mikado_get_the_author_name() {
        if(get_the_author_meta('first_name') !== '' || get_the_author_meta('last_name') !== '') {
            $name = get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
        } else {
            $name = get_the_author_meta('display_name');
        }

        return $name;
    }
}

if(!function_exists('voyage_mikado_get_author_posts_url')) {
    /**
     * Returns URL to author posts page
     *
     * @return string
     */
    function voyage_mikado_get_author_posts_url() {
        return get_author_posts_url(get_the_author_meta('ID'));
    }
}

/**
 * Loads more function for blog posts.
 *
 */
if(!function_exists('voyage_mikado_blog_load_more')) {

    function voyage_mikado_blog_load_more() {

        $return_obj       = array();
        $paged            = $post_number = $category = $blog_type = '';
        $archive_category = $archive_author = $archive_tag = $archive_day = $archive_month = $archive_year = '';

        if(!empty($_POST['nextPage'])) {
            $paged = $_POST['nextPage'];
        }
        if(!empty($_POST['number'])) {
            $post_number = $_POST['number'];
        }
        if(!empty($_POST['category'])) {
            $category = $_POST['category'];
        }
        if(!empty($_POST['blogType'])) {
            $blog_type = $_POST['blogType'];
        }
        if(!empty($_POST['archiveCategory'])) {
            $archive_category = $_POST['archiveCategory'];
        }
        if(!empty($_POST['archiveAuthor'])) {
            $archive_author = $_POST['archiveAuthor'];
        }
        if(!empty($_POST['archiveTag'])) {
            $archive_tag = $_POST['archiveTag'];
        }
        if(!empty($_POST['archiveDay'])) {
            $archive_day = $_POST['archiveDay'];
        }
        if(!empty($_POST['archiveMonth'])) {
            $archive_month = $_POST['archiveMonth'];
        }
        if(!empty($_POST['archiveYear'])) {
            $archive_year = $_POST['archiveYear'];
        }


        $html        = '';
        $query_array = array(
            'post_type'      => 'post',
            'paged'          => $paged,
            'posts_per_page' => $post_number
        );
        if($category != '') {
            $query_array['cat'] = $category;
        }
        if($archive_category != '') {
            $query_array['cat'] = $archive_category;
        }
        if($archive_author != '') {
            $query_array['author'] = $archive_author;
        }
        if($archive_tag != '') {
            $query_array['tag'] = $archive_tag;
        }
        if($archive_day != '' && $archive_month != '' && $archive_year != '') {
            $query_array['day']      = $archive_day;
            $query_array['monthnum'] = $archive_month;
            $query_array['year']     = $archive_year;
        }
        $query_results = new \WP_Query($query_array);

        if($query_results->have_posts()):
            while($query_results->have_posts()) : $query_results->the_post();
                $html .= voyage_mikado_get_post_format_html($blog_type, 'yes');
            endwhile;
        else:
            $html .= '<p>'.esc_html__('Sorry, no posts matched your criteria.', 'voyage').'</p>';
        endif;

        $return_obj = array(
            'html' => $html,
        );

        echo json_encode($return_obj);
        exit;
    }
}


add_action('wp_ajax_nopriv_voyage_mikado_blog_load_more', 'voyage_mikado_blog_load_more');
add_action('wp_ajax_voyage_mikado_blog_load_more', 'voyage_mikado_blog_load_more');

?>