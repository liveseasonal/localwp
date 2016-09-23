<div class="mkdf-tour-cover-box-item">
    <?php if(has_post_thumbnail()) : ?>
        <div class="mkdf-tour-cover-box-item-image-holder">
            <a href="<?php the_permalink(); ?>">
                <?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>

                <?php if(mkdf_tours_get_tour_label_html()) : ?>
                    <span class="mkdf-tour-cover-box-item-label-holder">
						<?php echo mkdf_tours_get_tour_label_html(); ?>
					</span>
                <?php endif; ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="mkdf-tour-cover-box-item-content-holder">
        <div class="mkdf-tour-cover-box-item-title-price-holder">
            <h5 class="mkdf-tour-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h5>
        </div>

        <div class="mkdf-tour-cover-box-item-rating">
            <?php echo mkdf_tours_get_tour_rating_html(); ?>
        </div>

        <?php if(mkdf_tours_get_tour_excerpt()) : ?>
            <div class="mkdf-tour-cover-box-item-excerpt">
                <?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
            </div>
        <?php endif; ?>

        <span class="mkdf-tour-cover-box-item-price-holder">
            <?php echo mkdf_tours_get_tour_price_html(); ?>
		</span>

    </div>
</div>