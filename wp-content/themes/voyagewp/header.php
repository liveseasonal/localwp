<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * @see voyage_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php if (!voyage_mikado_is_ajax_request()) do_action('voyage_mikado_header_meta'); ?>

	<?php if (!voyage_mikado_is_ajax_request()) wp_head(); ?>
</head>

<body <?php body_class();?>>
<?php if (!voyage_mikado_is_ajax_request()) voyage_mikado_get_side_area(); ?>


<?php
if((!voyage_mikado_is_ajax_request()) && voyage_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") {
	$ajax_class = 'mkdf-mimic-ajax';
?>
<div class="mkdf-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
    <div class="mkdf-st-loader">
        <div class="mkdf-st-loader1">
            <?php echo voyage_mikado_loading_spinners(true); ?>
        </div>
    </div>
</div>
<?php } ?>

<div class="mkdf-wrapper">
    <div class="mkdf-wrapper-inner">
	    <?php if (!voyage_mikado_is_ajax_request()) voyage_mikado_get_header(); ?>

	    <?php if ((!voyage_mikado_is_ajax_request()) && voyage_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkdf-back-to-top'  href='#'>
                <span class="mkdf-icon-stack">
                     <?php echo voyage_mikado_icon_collections()->renderIcon('lnr-chevron-up', 'linear_icons'); ?>
                </span>
                  <span class="mkdf-back-to-top-inner">
                    <span class="mkdf-back-to-top-text"><?php esc_html_e('Top', 'voyage'); ?></span>
                </span>
            </a>
        <?php } ?>

        <div class="mkdf-content" <?php voyage_mikado_content_elem_style_attr(); ?>>
            <?php if(voyage_mikado_is_ajax_enabled()) { ?>
            <div class="mkdf-meta">
                <?php do_action('voyage_mikado_ajax_meta'); ?>
                <span id="mkdf-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="mkdf-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
            <div class="mkdf-content-inner">