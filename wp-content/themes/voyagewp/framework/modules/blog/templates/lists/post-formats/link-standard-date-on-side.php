<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
        <div class="mkdf-post-content clearfix">
            <div class="mkdf-post-text">
                <div class="mkdf-post-text-inner">
                    <div class="mkdf-post-mark">
                        <?php echo voyage_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
                    </div>
                    <h5 class="mkdf-post-title"><?php the_title(); ?></h5>
                </div>
                <div class="mkdf-post-info">
                    <?php voyage_mikado_post_info(array(
                        'category' => 'yes',
                        'comments' => 'yes',
                        'like'     => 'yes',
                        'date'     => 'yes'
                    )) ?>
                </div>
            </div>
        </div>
    </a>
</article>