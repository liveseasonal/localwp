<?php
$gallery_excerpt   = get_post_meta(get_the_ID(), 'mkdf_tours_gallery_excerpt', true);
$image_gallery_val = get_post_meta(get_the_ID(), 'mkdf_tours_gallery_images', true);

if($image_gallery_val !== '') : ?>

    <div class="mkdf-tour-gallery-item-holder">

        <h3 class="mkdf-gallery-title">
            <?php esc_html_e('From Our Gallery', 'mikado-tours'); ?>
        </h3>

        <p class="mkdf-tour-gallery-item-excerpt">
            <?php echo wp_kses_post($gallery_excerpt); ?>
        </p>

        <div class="mkdf-tour-gallery clearfix">
            <?php
            $image_gallery_array = explode(',', $image_gallery_val);
            if(isset($image_gallery_array) && count($image_gallery_array)) : ?>

                <?php for($i = 0; $i < 3; $i++) : ?>

                    <?php if(isset($image_gallery_array[$i])) : ?>
                        <div class="mkdf-tour-gallery-item">
                            <div class="mkdf-icon-holder"><?php echo voyage_mikado_icon_collections()->renderIcon('icon_plus', 'font_elegant'); ?></div>
                            <a href="<?php echo wp_get_attachment_url($image_gallery_array[$i], 'full') ?>" data-rel="prettyPhoto[single_pretty_photo]">
                                <?php echo wp_get_attachment_image($image_gallery_array[$i], 'full'); ?>
                                <span class="mkdf-image-gallery-hover"></span>
                            </a>
                        </div>
                    <?php endif; ?>

                <?php endfor; ?>

            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>