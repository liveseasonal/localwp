<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="mkdf-post-content clearfix">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <?php echo voyage_mikado_icon_collections()->renderIcon('icon_quotations', 'font_elegant'); ?>
                </div>
                <div class="mkdf-post-title-holder">
                    <a href="<?php the_permalink() ?>">
                        <h3 class="mkdf-post-title"><?php echo esc_html(get_post_meta(get_the_ID(), 'mkdf_post_quote_text_meta', true)); ?></h3>

                        <p class="mkdf-quote-author"><?php the_title(); ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mkdf-quote-content">
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
    <?php do_action('voyage_mikado_before_blog_article_closed_tag'); ?>
</article>