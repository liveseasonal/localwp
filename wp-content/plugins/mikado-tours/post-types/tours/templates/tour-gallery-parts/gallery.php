<?php
$gallery_excerpt   = get_post_meta(get_the_ID(), 'mkdf_tours_gallery_excerpt', true);
$image_gallery_val = get_post_meta(get_the_ID(), 'mkdf_tours_gallery_images', true);

if($image_gallery_val !== "") { ?>

    <div class="mkdf-tour-gallery-item-holder">

        <h2 class="mkdf-gallery-title">
            <?php esc_html_e('Our Gallery', 'mikado-tours'); ?>
        </h2>

        <p class="mkdf-tour-gallery-item-excerpt-field">
            <?php echo esc_html($gallery_excerpt); ?>
        </p>

        <div class="mkdf-tour-gallery clearfix">
            <?php
            if($image_gallery_val != '') {
                $image_gallery_array = explode(',', $image_gallery_val);
            }

            if(isset($image_gallery_array) && count($image_gallery_array) != 0) {

                foreach($image_gallery_array as $gimg_id) { ?>

                    <div class="mkdf-tour-gallery-item">
                        <div class="mkdf-icon-holder"><?php echo voyage_mikado_icon_collections()->renderIcon('icon_plus', 'font_elegant'); ?></div>

                        <a href="<?php echo wp_get_attachment_url($gimg_id) ?>" data-rel="prettyPhoto[single_pretty_photo]">
                            <?php echo wp_get_attachment_image($gimg_id, 'full'); ?>
                            <span class="mkdf-image-gallery-hover"></span>
                        </a>

                    </div>

                <?php }

            }

            ?>
        </div>

    </div>
<?php } ?>