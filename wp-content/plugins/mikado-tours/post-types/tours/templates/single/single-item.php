<?php
extract($tour_sections);
?>

<article class="mkdf-tour-item-wrapper mkdf-tabs mkdf-horizontal mkdf-tab-text">

    <ul class="mkdf-tabs-nav clearfix">
        <?php foreach($tour_sections as $section) {

            if($section['value'] === 'yes') { ?>

                <li class="mkdf-tour-nav-item">

                    <a href="<?php echo esc_attr($section['id']) ?>">

                        <i class="lnr <?php echo esc_attr($section['icon']) ?>"></i>

						<span class="mkdf-tour-nav-section-title">
							<?php echo esc_html($section['title']) ?>
						</span>

                    </a>
                </li>

            <?php }

        }; ?>
        <li class="mkdf-tab-line"></li>
    </ul>


    <?php if($show_info_section['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_info_section['id']) ?>">

            <?php mkdf_tours_get_tour_info_part('tour-info-parts/title'); ?>
            <?php mkdf_tours_get_tour_info_part('tour-info-parts/excerpt'); ?>
            <?php mkdf_tours_get_tour_info_part('tour-info-parts/content'); ?>

            <div class="mkdf-tour-item-short-info">
                <?php mkdf_tours_get_tour_info_part('tour-info-parts/years'); ?>
                <?php mkdf_tours_get_tour_info_part('tour-info-parts/categories'); ?>
            </div>

            <?php mkdf_tours_get_tour_info_part('tour-info-parts/main-info'); ?>
            <?php mkdf_tours_get_tour_info_part('tour-info-parts/gallery'); ?>

        </div>

    <?php } ?>

    <?php if($show_tour_plan_section['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_tour_plan_section['id']) ?>">
            <?php mkdf_tours_get_tour_info_part('tour-plan-parts/plan'); ?>
        </div>

    <?php } ?>

    <?php if($show_location_section['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_location_section['id']) ?>">
            <?php mkdf_tours_get_tour_info_part('tour-location-parts/location'); ?>
        </div>

    <?php } ?>

    <?php if($show_gallery_section['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_gallery_section['id']) ?>">
            <?php mkdf_tours_get_tour_info_part('tour-gallery-parts/gallery'); ?>
        </div>

    <?php } ?>

    <?php if($show_review_section['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_review_section['id']) ?>">
            <?php mkdf_tours_get_tour_info_part('tour-review-parts/reviews'); ?>
        </div>

    <?php } ?>

    <?php if($show_custom_section_1['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_custom_section_1['id']) ?>">
            <?php mkdf_tours_get_tour_info_part('tour-custom1-parts/custom'); ?>
        </div>

    <?php } ?>

    <?php if($show_custom_section_2['value'] === 'yes') { ?>

        <div class="mkdf-tour-item-section mkdf-tab-container" id="<?php echo esc_attr($show_custom_section_2['id']) ?>">
            <?php mkdf_tours_get_tour_info_part('tour-custom2-parts/custom'); ?>
        </div>

    <?php } ?>


</article>


