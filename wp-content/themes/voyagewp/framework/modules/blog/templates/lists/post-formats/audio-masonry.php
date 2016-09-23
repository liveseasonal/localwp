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

        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <?php voyage_mikado_get_module_template_part('templates/lists/parts/title', 'blog', '', array('title_tag' => 'h5')); ?>
                <?php
                voyage_mikado_excerpt($excerpt_length);
                $args_pages = array(
                    'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
                    'after'       => '</div></div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '%'
                );

                wp_link_pages($args_pages);
                ?>
            </div>
            <div class="mkdf-author-desc clearfix">
                <div class="mkdf-post-info">
                    <?php voyage_mikado_post_info(array(
                        'date'                => 'yes',
                        'comments'            => 'yes',
                        'show_comments_label' => true
                    )) ?>
                </div>
            </div>
        </div>
    </div>
</article>