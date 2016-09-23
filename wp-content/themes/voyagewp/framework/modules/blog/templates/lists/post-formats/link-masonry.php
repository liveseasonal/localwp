<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <span aria-hidden="true" class="icon_link"></span>
                </div>
                <?php voyage_mikado_get_module_template_part('templates/lists/parts/title', 'blog', '', array('title_tag' => 'h5')); ?>
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