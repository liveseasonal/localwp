<?php if(voyage_mikado_options()->getOptionValue('blog_single_navigation') == 'yes') { ?>
    <?php $navigation_blog_through_category = voyage_mikado_options()->getOptionValue('blog_navigation_through_same_category') ?>
    <div class="mkdf-blog-single-navigation clearfix">
        <div class="mkdf-blog-single-navigation-inner clearfix">
            <?php if($has_prev_post) : ?>
                <div class="mkdf-blog-single-prev clearfix <?php if($prev_post_has_image) {
                    echo esc_attr('mkdf-single-nav-with-image');
                } ?>">
                    <?php if($prev_post_has_image) : ?>
                        <div class="mkdf-single-nav-image-holder">
                            <a href="<?php echo esc_url($prev_post['link']); ?>">
                                <?php echo voyage_mikado_kses_img($prev_post['image']); ?>
                                <div class="mkdf-single-image-overlay">
                                    <?php echo voyage_mikado_icon_collections()->renderIcon('arrow_carrot-left', 'font_elegant') ?>
                                </div>
                            </a>

                        </div>
                    <?php endif; ?>

                    <div class="mkdf-single-nav-content-holder">
                        <h6>
                            <a href="<?php echo esc_url($prev_post['link']); ?>">
                                <?php echo esc_html($prev_post['title']); ?>
                            </a>
                        </h6>
                    </div>
                </div> <!-- close div.blog_prev -->
            <?php endif; ?>
            <?php if($has_next_post) : ?>
                <div class="mkdf-blog-single-next clearfix <?php if($next_post_has_image) {
                    echo esc_attr('mkdf-single-nav-with-image');
                } ?>">
                    <?php if($next_post_has_image) : ?>
                        <div class="mkdf-single-nav-image-holder">
                            <a href="<?php echo esc_url($next_post['link']); ?>">
                                <?php echo voyage_mikado_kses_img($next_post['image']); ?>
                                <div class="mkdf-single-image-overlay">
                                    <?php echo voyage_mikado_icon_collections()->renderIcon('arrow_carrot-right', 'font_elegant') ?>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="mkdf-single-nav-content-holder">
                        <h6>
                            <a href="<?php echo esc_url($next_post['link']); ?>">
                                <?php echo esc_html($next_post['title']); ?>
                            </a>
                        </h6>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>