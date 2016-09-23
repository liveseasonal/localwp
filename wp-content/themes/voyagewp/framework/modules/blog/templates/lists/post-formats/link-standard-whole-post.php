<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <span aria-hidden="true" class="icon_link"></span>
                </div>
                <?php voyage_mikado_get_module_template_part('templates/lists/parts/title', 'blog', '', array('title_tag' => 'h3')); ?>
            </div>
        </div>
    </div>
    <?php the_content(); ?>
    <div class="mkdf-like-share clearfix">
        <div class="mkdf-post-info">
            <?php voyage_mikado_post_info(array(
                'date'     => 'yes',
                'comments' => 'yes',
                'like'     => 'yes',
                'category' => 'yes'
            )) ?>
        </div>
        <div class="mkdf-share-icons">
            <?php $post_info_array['share'] = voyage_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
            <?php echo voyage_mikado_get_social_share_html(array(
                'type'       => 'list'
            )); ?>
        </div>
    </div>
</article>