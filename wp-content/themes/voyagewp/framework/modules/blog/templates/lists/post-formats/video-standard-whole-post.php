<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-image">
            <?php voyage_mikado_get_module_template_part('templates/parts/video', 'blog'); ?>
        </div>
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
                <?php the_content(); ?>
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
                    'type'      => 'list',
                    'icon_type' => 'normal'
                )); ?>
            </div>
        </div>
    </div>
</article>