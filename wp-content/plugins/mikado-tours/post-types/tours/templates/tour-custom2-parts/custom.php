<?php
$custom_2_excerpt = get_post_meta(get_the_ID(), 'mkdf_tours_custom_section2_excerpt', true);
$custom_2_content = get_post_meta(get_the_ID(), 'mkdf_tours_custom_section2_content', true);
?>
<div class="mkdf-info-section-part">

    <?php if($custom_2_excerpt !== '' && $custom_2_excerpt) { ?>
        <p class="mkdf-tour-item-custom-section-excerpt">
            <?php echo esc_html($custom_2_excerpt); ?>
        </p>
    <?php }

    if($custom_2_content !== '' && $custom_2_content) { ?>

        <p class="mkdf-tour-item-custom-section-content">
            <?php echo do_shortcode($custom_2_content); ?>
        </p>

    <?php } ?>

</div>
