<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <span aria-hidden="true" class="icon_quotations"></span>
                </div>
                <div class="mkdf-post-title">
                    <h5>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_quote_text_meta", true)); ?></a>
                    </h5>
                    <span class="quote_author">&mdash; <?php the_title(); ?></span>
                </div>
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