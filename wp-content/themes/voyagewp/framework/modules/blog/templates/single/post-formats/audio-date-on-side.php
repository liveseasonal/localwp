<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-audio-image-holder">
            <?php voyage_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>

            <?php if(has_post_thumbnail()) : ?>
                <div class="mkdf-audio-player-holder">
                    <?php voyage_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!has_post_thumbnail()) : ?>
            <?php voyage_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
        <?php endif; ?>
        <div class="mkdf-date-format">
            <?php if(!voyage_mikado_post_has_title()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php endif; ?>

                <span class="mkdf-day"><?php the_time($time_j) ?></span>
                <span class="mkdf-month"><?php the_time($time_m) ?></span>

                <?php if(!voyage_mikado_post_has_title()) : ?>
            </a>
        <?php endif; ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <?php voyage_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                <?php
                the_content();
                ?>
            </div>
        </div>
        <div class="mkdf-author-desc clearfix">
            <div class="mkdf-post-info">
                <?php voyage_mikado_post_info(array(
                    'category' => 'yes',
                    'comments' => 'yes',
                    'like'     => 'yes'
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
    </div>
</article>