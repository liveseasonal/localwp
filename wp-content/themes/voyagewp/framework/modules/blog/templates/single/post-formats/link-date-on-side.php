<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="mkdf-post-content clearfix">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <?php echo voyage_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
                </div>
                <h4 class="mkdf-post-title">
                    <a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h4>
            </div>
        </div>
    </div>


    <div class="mkdf-link-content">
        <?php the_content(); ?>
    </div>
    <div class="mkdf-author-desc clearfix">
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
                'type' => 'list'
            )); ?>
        </div>
    </div>
</article>