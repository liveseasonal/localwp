<?php
$custom_1_excerpt = get_post_meta(get_the_ID(), 'mkdf_tours_custom_section1_excerpt', true);
$custom_1_content = get_post_meta(get_the_ID(), 'mkdf_tours_custom_section1_content', true);
?>
<div class="mkdf-info-section-part">

    <?php if($custom_1_excerpt !== '' && $custom_1_excerpt) { ?>
        <p class="mkdf-tour-item-custom-section-excerpt">
            <?php echo esc_html($custom_1_excerpt); ?>
        </p>
    <?php }

    if($custom_1_content !== '' && $custom_1_content) { ?>

        <p class="mkdf-tour-item-custom-section-content">
            <?php echo do_shortcode($custom_1_content); ?>
        </p>

    <?php } ?>

</div>
