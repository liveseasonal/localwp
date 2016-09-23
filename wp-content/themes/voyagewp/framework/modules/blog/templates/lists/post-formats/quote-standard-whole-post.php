<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <span aria-hidden="true" class="icon_quotations"></span>
                </div>
                <div class="mkdf-post-title">
                    <h3>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_quote_text_meta", true)); ?></a>
                    </h3>
                </div>
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
                'type' => 'list'
            )); ?>
        </div>
    </div>
</article>