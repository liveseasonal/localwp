<?php
if(!function_exists('voyage_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function voyage_mikado_design_styles() {

        $preload_background_styles = array();

        if(voyage_mikado_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url('.voyage_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        } else {
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo voyage_mikado_dynamic_css('.mkdf-preload-background', $preload_background_styles);

        if(voyage_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = voyage_mikado_options()->getOptionValue('google_fonts');
            if(voyage_mikado_is_font_option_valid($font_family)) {
                echo voyage_mikado_dynamic_css('body', array('font-family' => voyage_mikado_get_font_option_val($font_family)));
            }
        }

        if(voyage_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
				'a',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'p a',
				'.mkdf-pagination li.active span',
				'.mkdf-like.liked',
				'aside.mkdf-sidebar .widget .mkdf-blog-list-holder.mkdf-image-in-box h6.mkdf-item-title a:hover',
				'aside.mkdf-sidebar .widget ul li a:hover',
				'aside.mkdf-sidebar .widget.widget_categories li:hover a',
				'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu li a:hover',
				'aside.mkdf-sidebar .widget.widget_nav_menu .current-menu-item>a',
				'#ui-datepicker-div .ui-datepicker-title',
				'.mkdf-main-menu ul .mkdf-menu-featured-icon',
				'.mkdf-drop-down .wide .second .inner>ul>li>a:hover',
				'.mkdf-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
				'.mkdf-drop-down .wide .second ul li .flexslider ul li a:hover',
				'.mkdf-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
				'.mkdf-mobile-header .mkdf-mobile-nav a:hover',
				'.mkdf-mobile-header .mkdf-mobile-nav h4:hover',
				'.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
				'.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu>ul>li.mkdf-active-item>a:hover',
				'.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu>ul>li:hover>a',
				'.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu>ul>li>a:hover',
				'.mkdf-page-header .mkdf-sticky-header .mkdf-search-opener:hover',
				'.mkdf-page-header .mkdf-sticky-header .mkdf-side-menu-button-opener:hover',
				'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-page-header .mkdf-sticky-header .mkdf-main-menu>ul>li:hover>a',
				'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-page-header .mkdf-sticky-header .mkdf-main-menu>ul>li>a:hover',
				'.mkdf-page-header .mkdf-search-opener:hover',
				'.mkdf-side-menu-button-opener:hover',
				'.mkdf-counter-holder .mkdf-counter-icon',
				'.mkdf-message .mkdf-message-inner a.mkdf-close i:hover',
				'.mkdf-ordered-list ol>li:before',
				'.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner .font_elegant',
				'.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner i',
				'.mkdf-blog-slider-holder .mkdf-bs-item-date',
				'.mkdf-blog-slider-holder .mkdf-bs-item-bottom-section .mkdf-bs-item-author a:hover',
				'.mkdf-blog-slider-holder .mkdf-bs-item-bottom-section .mkdf-bs-item-categories a:hover',
				'.mkdf-blog-slider-holder .owl-next:hover',
				'.mkdf-blog-slider-holder .owl-prev:hover',
				'.mkdf-accordion-holder .mkdf-title-holder.ui-state-active',
				'.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover',
				'.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active',
				'.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover',
				'.mkdf-blog-list-holder .mkdf-item-info-section>div>a:hover',
				'.mkdf-blog-list-holder.mkdf-grid-type-2 .mkdf-post-item-author-holder a:hover',
				'.mkdf-blog-list-holder.mkdf-masonry .mkdf-post-item-author-holder a:hover',
				'.mkdf-blog-list-holder.mkdf-image-in-box h5.mkdf-item-title a:hover',
				'.mkdf-btn.mkdf-btn-outline',
				'.post-password-form input.mkdf-btn-outline[type=submit]',
				'.woocommerce .mkdf-btn-outline.button',
				'input.mkdf-btn-outline.wpcf7-form-control.wpcf7-submit',
				'.mkdf-dropcaps',
				'.mkdf-iwt.mkdf-iwt-left-from-title .mkdf-iwt-icon-title-holder',
				'.mkdf-social-share-holder.mkdf-list li a:hover',
				'.mkdf-info-item-inner:hover h6',
				'.mkdf-icon-progress-bar .mkdf-ipb-active',
				'.mkdf-blog-holder.mkdf-blog-type-masonry .format-quote .mkdf-post-content .mkdf-post-title a:hover',
				'.mkdf-blog-holder.mkdf-blog-type-masonry .format-quote .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-type-masonry .format-link .mkdf-post-content .mkdf-post-title a:hover',
				'.mkdf-blog-holder.mkdf-blog-type-masonry .format-link .mkdf-post-mark',
				'.mkdf-blog-date-on-side .format-link .mkdf-post-mark',
				'.mkdf-blog-date-on-side .format-quote .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-type-split-column article.format-link h3.mkdf-post-title a:hover',
				'.mkdf-blog-holder.mkdf-blog-type-split-column article.format-link .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-type-split-column article.format-quote .mkdf-post-title h3 a:hover',
				'.mkdf-blog-holder.mkdf-blog-type-standard .format-quote .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-type-standard .format-link .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-type-split-column article.format-quote .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-single.mkdf-blog-standard .format-quote .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-single.mkdf-blog-standard .format-link .mkdf-post-mark',
				'.mkdf-blog-holder.mkdf-blog-single.mkdf-blog-standard article.format-link .mkdf-category a:hover',
				'.mkdf-blog-holder.mkdf-blog-single.mkdf-blog-standard article.format-quote .mkdf-category a:hover',
				'.mkdf-blog-holder article.sticky .mkdf-post-title a',
				'.mkdf-filter-blog-holder li.mkdf-active',
				'article .mkdf-category',
				'article .mkdf-category span.icon_tags',
				'.mejs-controls .mejs-button button:hover',
				'.woocommerce-pagination .page-numbers li a:hover',
				'.woocommerce-pagination .page-numbers li span.current',
				'.woocommerce-pagination .page-numbers li span.current:hover',
				'.woocommerce-pagination .page-numbers li span:hover',
				'.mkdf-woocommerce-page .select2-results .select2-highlighted',
				'.mkdf-woocommerce-page ul.products .product .added_to_cart',
				'.woocommerce ul.products .product .added_to_cart',
				'.mkdf-woocommerce-page ul.products .product .added_to_cart:hover',
				'.woocommerce ul.products .product .added_to_cart:hover',
				'.mkdf-woocommerce-page ul.products .add_to_cart_button',
				'.woocommerce ul.products .add_to_cart_button',
				'.mkdf-woocommerce-page .star-rating:before',
				'.woocommerce .star-rating:before',
				'.mkdf-woocommerce-page .star-rating span:before',
				'.woocommerce .star-rating span:before',
				'.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_product_categories ul.product-categories li:hover a',
				'.mkdf-shopping-cart-dropdown ul li a:hover',
				'.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-left a:hover',
				'.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-right .remove:hover',
				'.mkdf-shopping-cart-dropdown span.mkdf-total span',
				'.mkdf-shopping-cart-dropdown span.mkdf-quantity',
				'.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
				'.woocommerce-cart .woocommerce .cart-collaterals .mkdf-shipping-calculator .woocommerce-shipping-calculator>p a:hover',
				'.mkdf-tour-item-label.mkdf-tour-item-label-skin2',
				'.mkdf-tours-standard-item .mkdf-tours-price-with-discount .mkdf-tours-item-price',
				'.mkdf-tours-list-item .mkdf-tours-price-with-discount .mkdf-tours-item-price',
				'.mkdf-tour-cover-boxes-holder span.mkdf-tours-item-discount-price.mkdf-tours-item-price',
				'.mkdf-tour-type-list-holder li a:hover',
				'.mkdf-tours-top-reviews-carousel-holder .mkdf-tours-top-reviews-item-title a:hover',
				'.mkdf-tours-top-reviews-carousel-holder .mkdf-tour-reviews-criteria-holder .mkdf-tour-reviews-rating-holder',
				'.mkdf-tour-item-single-holder article .mkdf-tour-item-price-holder .mkdf-tours-price-with-discount .mkdf-tours-item-price',
				'.mkdf-tour-item-single-holder article .mkdf-tour-main-info-holder li:hover .col6.mkdf-info',
				'.mkdf-tour-item-single-holder article .mkdf-tour-main-info-holder li.mkdf-tours-unchecked-attributes .mkdf-tour-main-info-attr:before',
				'.mkdf-tours-booking-form-holder .mkdf-tour-message-danger'
            );

            $color_important_selector = array(
				'.mkdf-icon-list-item a:hover .mkdf-icon-list-text',
				'.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-hover-color):hover',
				'.post-password-form input[type=submit]:not(.mkdf-btn-custom-hover-color):hover',
				'.woocommerce .button:not(.mkdf-btn-custom-hover-color):hover',
				'input.mkdf-btn-hover-outline.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover',
				'.mkdf-btn.mkdf-btn-hover-white:not(.mkdf-btn-custom-hover-color):hover',
				'.post-password-form input.mkdf-btn-hover-white[type=submit]:not(.mkdf-btn-custom-hover-color):hover',
				'.woocommerce .mkdf-btn-hover-white.button:not(.mkdf-btn-custom-hover-color):hover',
				'input.mkdf-btn-hover-white.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover',
				'.mkdf-tours-list-holder .mkdf-tour-list-filter-item.mkdf-tour-list-current-filter a'
            );

            $background_color_selector = array(
				'.mkdf-st-loader .pulse',
				'.mkdf-st-loader .double_pulse .double-bounce1',
				'.mkdf-st-loader .double_pulse .double-bounce2',
				'.mkdf-st-loader .cube',
				'.mkdf-st-loader .rotating_cubes .cube1',
				'.mkdf-st-loader .rotating_cubes .cube2',
				'.mkdf-st-loader .stripes>div',
				'.mkdf-st-loader .wave>div',
				'.mkdf-st-loader .two_rotating_circles .dot1',
				'.mkdf-st-loader .two_rotating_circles .dot2',
				'.mkdf-st-loader .five_rotating_circles .container1>div',
				'.mkdf-st-loader .five_rotating_circles .container2>div',
				'.mkdf-st-loader .five_rotating_circles .container3>div',
				'.mkdf-st-loader .atom .ball-1:before',
				'.mkdf-st-loader .atom .ball-2:before',
				'.mkdf-st-loader .atom .ball-3:before',
				'.mkdf-st-loader .atom .ball-4:before',
				'.mkdf-st-loader .clock .ball:before',
				'.mkdf-st-loader .mitosis .ball',
				'.mkdf-st-loader .lines .line1',
				'.mkdf-st-loader .lines .line2',
				'.mkdf-st-loader .lines .line3',
				'.mkdf-st-loader .lines .line4',
				'.mkdf-st-loader .fussion .ball',
				'.mkdf-st-loader .fussion .ball-1',
				'.mkdf-st-loader .fussion .ball-2',
				'.mkdf-st-loader .fussion .ball-3',
				'.mkdf-st-loader .fussion .ball-4',
				'.mkdf-st-loader .wave_circles .ball',
				'.mkdf-st-loader .pulse_circles .ball',
				'.mkdf-carousel-pagination .owl-page.active span',
				'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a',
				'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a',
				'#ui-datepicker-div table.ui-datepicker-calendar thead',
				'footer .mkdf-footer-top-holder .widget.widget_product_tag_cloud .tagcloud a',
				'footer .mkdf-footer-top-holder .widget.widget_tag_cloud .tagcloud a',
				'.mkdf-team.main-info-below-image .mkdf-icon-element',
				'.mkdf-icon-shortcode.circle',
				'.mkdf-icon-shortcode.square',
				'.mkdf-testimonials.owl-carousel .owl-dots .owl-dot.active span',
				'.mkdf-price-table .mkdf-price-table-inner .mkdf-pt-label-holder .mkdf-pt-label-inner',
				'.mkdf-price-table.mkdf-pt-active .mkdf-price-table-inner',
				'.mkdf-pie-chart-doughnut-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
				'.mkdf-pie-chart-pie-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
				'.mkdf-tabs .mkdf-tabs-nav .mkdf-tab-line',
				'.mkdf-btn.mkdf-btn-solid',
				'.post-password-form input[type=submit]',
				'.woocommerce .button',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkdf-dropcaps.mkdf-circle',
				'.mkdf-dropcaps.mkdf-square',
				'.mkdf-comparision-pricing-tables-holder .mkdf-cpt-table .mkdf-cpt-table-btn a',
				'.mkdf-vertical-progress-bar-holder .mkdf-vpb-active-bar',
				'.mkdf-weather-widget-holder .mkdf-date-format',
				'.widget_mkdf_call_to_action_button .mkdf-call-to-action-button',
				'.mkdf-blog-date-on-side .mkdf-date-format',
				'.single .mkdf-single-tags-holder .mkdf-tags a',
				'.mejs-controls .mejs-time-rail .mejs-time-current:after',
				'.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.mejs-controls .mejs-time-rail .mejs-time-current',
				'.mkdf-woocommerce-page .woocommerce-info',
				'.mkdf-woocommerce-page .mkdf-onsale',
				'.mkdf-woocommerce-page .mkdf-out-of-stock',
				'.woocommerce .mkdf-onsale',
				'.woocommerce .mkdf-out-of-stock',
				'.single-product .mkdf-tabs.mkdf-horizontal .mkdf-tab-line',
				'.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_price_filter .ui-slider .ui-slider-handle',
				'.mkdf-shopping-cart-outer .mkdf-shopping-cart-header .mkdf-header-cart .mkdf-cart-count',
				'.mkdf-tour-item-label.mkdf-tour-item-label-skin1',
				'.mkdf-search-ordering-holder .mkdf-search-ordering-list .mkdf-tab-line',
				'.mkdf-membership-dashboard-nav .mkdf-tab-line',
				'.mkdf-content-inner>.mkdf-container .mkdf-login-register-content .mkdf-tab-line'
            );

            $background_color_important_selector = array(
            	'.mkdf-woocommerce-page .price_slider_amount button.button',
				'.woocommerce .price_slider_amount button.button',
				'.mkdf-tours-booking-form-holder input[type=submit]:disabled:hover'
            );

            $border_color_selector = array(
				'.mkdf-st-loader .pulse_circles .ball',
				'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a',
				'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a',
				'footer .mkdf-footer-top-holder .widget.widget_product_tag_cloud .tagcloud a',
				'footer .mkdf-footer-top-holder .widget.widget_tag_cloud .tagcloud a',
				'.mkdf-team.main-info-below-image .mkdf-icon-element',
				'.mkdf-btn.mkdf-btn-solid',
				'.post-password-form input[type=submit]',
				'.woocommerce .button',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkdf-btn.mkdf-btn-outline',
				'.post-password-form input.mkdf-btn-outline[type=submit]',
				'.woocommerce .mkdf-btn-outline.button',
				'input.mkdf-btn-outline.wpcf7-form-control.wpcf7-submit',
				'.single .mkdf-single-tags-holder .mkdf-tags a',
				'.mkdf-woocommerce-page .price_slider_amount button.button',
				'.woocommerce .price_slider_amount button.button',
				'.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus'
            );

            $border_top_color_selector = array(
                '.mkdf-progress-bar .mkdf-progress-number-wrapper.mkdf-floating .mkdf-down-arrow'
            );

            $border_bottom_color_selector = array(
            );

            $border_left_color_selector   = array(
            );

            $border_color_important_selector = array(
				'.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-border-hover):hover',
				'.post-password-form input[type=submit]:not(.mkdf-btn-custom-border-hover):hover',
				'.woocommerce .button:not(.mkdf-btn-custom-border-hover):hover',
				'input.mkdf-btn-hover-outline.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-border-hover):hover'
            );

            $stroke_selector = array(
            	'.mkdf-plane-holder .st0',
            	'.mkdf-plane-holder .st1'
        	);

			$first_color = voyage_mikado_options()->getOptionValue('first_color');

            echo voyage_mikado_dynamic_css($color_selector, array('color' => $first_color));
            echo voyage_mikado_dynamic_css($color_important_selector, array('color' => $first_color.'!important'));
            echo voyage_mikado_dynamic_css('::selection', array('background' => $first_color));
            echo voyage_mikado_dynamic_css('::-moz-selection', array('background' => $first_color));
            echo voyage_mikado_dynamic_css($background_color_selector, array('background-color' => $first_color));
            echo voyage_mikado_dynamic_css($background_color_important_selector, array('background-color' => $first_color.'!important'));
            echo voyage_mikado_dynamic_css($border_color_selector, array('border-color' => $first_color));
            echo voyage_mikado_dynamic_css($border_color_important_selector, array('border-color' => $first_color.'!important'));
            echo voyage_mikado_dynamic_css($border_top_color_selector, array('border-top-color' => $first_color));
            echo voyage_mikado_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => $first_color));
            echo voyage_mikado_dynamic_css($border_left_color_selector, array('border-left-color' => $first_color));
            echo voyage_mikado_dynamic_css($stroke_selector, array('stroke' => $first_color));
        }

        if(voyage_mikado_options()->getOptionValue('second_color') !== "") {
            $color_selector = array(
				'#ui-datepicker-div a',
				'.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner',
				'.mkdf-image-gallery .mkdf-image-gallery-grid .mkdf-image-gallery-hover a.mkdf-gallery-link',
				'.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder .add_to_cart_button',
				'.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder .product_type_simple',
				'.woocommerce ul.products .product .mkdf-woo-product-image-holder .add_to_cart_button',
				'.woocommerce ul.products .product .mkdf-woo-product-image-holder .product_type_simple',
				'.mkdf-woocommerce-page .price',
				'.woocommerce .price',
				'.mkdf-woocommerce-page .price ins',
				'.woocommerce .price ins',
				'.single-product .mkdf-single-product-summary .price',
				'.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product_list_widget li .mkdf-woo-product-widget-content .amount',
				'.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product_list_widget li .mkdf-woo-product-widget-content ins',
				'.mkdf-tours-price-holder',
				'.mkdf-tours-list-item .mkdf-tours-price-with-discount .mkdf-tours-item-discount-price.mkdf-tours-item-price',
				'.mkdf-tour-item-single-holder article .mkdf-tour-item-price-holder .mkdf-tours-item-discount-price.mkdf-tours-item-price',
				'.mkdf-tour-item-single-holder article .mkdf-tour-item-price-holder .mkdf-tour-item-price',
				'.mkdf-tour-item-single-holder article .mkdf-tour-main-info-holder li.mkdf-tours-checked-attributes .mkdf-tour-main-info-attr:before',
				'.mkdf-tour-reviews-display-wrapper .mkdf-tour-reviews-average-rating',
				'.mkdf-tours-booking-form-holder .mkdf-tour-message-success',
				'.mkdf-tours-my-booking-item .mkdf-tours-info-items .mkdf-tours-booking-price',
				'.mkdf-tours-search-main-filters-holder label:before',
				'.mkdf-tours-checkout-content-inner .mkdf-tours-info-holder .mkdf-tours-booking-price',
				'.mkdf-tours-checkout-content-inner h6'
            );

            $color_important_selector = array(
            	'.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder a:hover',
            	'.woocommerce ul.products .product .mkdf-woo-product-image-holder a:hover',
            	'.mkdf-tours-standard-item .mkdf-tours-item-discount-price.mkdf-tours-item-price'
            );

            $background_color_selector = array(
				'.mkdf-membership-response-holder .mkdf-membership-response.mkdf-membership-message-succes',
				'aside.mkdf-sidebar .widget .searchform input[type=submit]',
				'.mkdf-login-register-content ul li.ui-state-active',
				'.mkdf-top-bar .mkdf-top-bar-widget-inner .mkdf-search-opener',
				'.mkdf-progress-bar .mkdf-progress-content-outer .mkdf-progress-content',
				'.mkdf-tour-item-single-holder .mkdf-tour-item-section .mkdf-route-id',
				'.mkdf-tour-item-single-holder .mkdf-tour-item-section span.mkdf-line-between-icons-inner',
				'.mkdf-tour-reviews-display-wrapper .mkdf-tour-reviews-display-right .mkdf-tour-reviews-bar-holder .mkdf-tour-reviews-bar-progress',
				'.tt-suggestion.tt-cursor',
				'.tt-suggestion:hover',
				'.mkdf-search-ordering-holder .mkdf-tours-search-view-list li.mkdf-tours-search-view-item-active>a',
				'.mkdf-search-ordering-holder .mkdf-tours-search-view-list li>a:hover'
            );

            $background_color_important_selector = array(
            	'#ui-datepicker-div .ui-datepicker-today',
            	'.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-btns-holder .mkdf-btn.mkdf-btn-small.view-cart'
            );

            $border_color_selector = array(
            );

            $border_color_important_selector = array(
            	'.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-btns-holder .mkdf-btn.mkdf-btn-small.view-cart'
            );

			$second_color = voyage_mikado_options()->getOptionValue('second_color');

            echo voyage_mikado_dynamic_css($color_selector, array('color' => $second_color));
            echo voyage_mikado_dynamic_css($color_important_selector, array('color' => $second_color.'!important'));
            echo voyage_mikado_dynamic_css('::selection', array('background' => $second_color));
            echo voyage_mikado_dynamic_css('::-moz-selection', array('background' => $second_color));
            echo voyage_mikado_dynamic_css($background_color_selector, array('background-color' => $second_color));
            echo voyage_mikado_dynamic_css($background_color_important_selector, array('background-color' => $second_color.'!important'));
            echo voyage_mikado_dynamic_css($border_color_selector, array('border-color' => $second_color));
            echo voyage_mikado_dynamic_css($border_color_important_selector, array('border-color' => $second_color.'!important'));
        }

        if(voyage_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkdf-wrapper-inner',
                '.mkdf-content',
                '.mkdf-content-inner > .mkdf-container'
            );
            echo voyage_mikado_dynamic_css($background_color_selector, array('background-color' => voyage_mikado_options()->getOptionValue('page_background_color')));
        }

        if(voyage_mikado_options()->getOptionValue('selection_color')) {
            echo voyage_mikado_dynamic_css('::selection', array('background' => voyage_mikado_options()->getOptionValue('selection_color')));
            echo voyage_mikado_dynamic_css('::-moz-selection', array('background' => voyage_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if(voyage_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = voyage_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if(voyage_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(voyage_mikado_options()->getOptionValue('boxed_background_image')).')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat']   = 'no-repeat';
        }

        if(voyage_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(voyage_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat']   = 'repeat';
        }

        if(voyage_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (voyage_mikado_options()->getOptionValue('boxed_background_image_attachment'));
        }

        echo voyage_mikado_dynamic_css('.mkdf-boxed .mkdf-wrapper', $boxed_background_style);
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_design_styles');
}

if(!function_exists('voyage_mikado_h1_styles')) {

    function voyage_mikado_h1_styles() {

        $h1_styles = array();

        if(voyage_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = voyage_mikado_options()->getOptionValue('h1_color');
        }
        if(voyage_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = voyage_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = voyage_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = voyage_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if(!empty($h1_styles)) {
            echo voyage_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_h1_styles');
}

if(!function_exists('voyage_mikado_h2_styles')) {

    function voyage_mikado_h2_styles() {

        $h2_styles = array();

        if(voyage_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = voyage_mikado_options()->getOptionValue('h2_color');
        }
        if(voyage_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = voyage_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = voyage_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = voyage_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if(!empty($h2_styles)) {
            echo voyage_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_h2_styles');
}

if(!function_exists('voyage_mikado_h3_styles')) {

    function voyage_mikado_h3_styles() {

        $h3_styles = array();

        if(voyage_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = voyage_mikado_options()->getOptionValue('h3_color');
        }
        if(voyage_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = voyage_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = voyage_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = voyage_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if(!empty($h3_styles)) {
            echo voyage_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_h3_styles');
}

if(!function_exists('voyage_mikado_h4_styles')) {

    function voyage_mikado_h4_styles() {

        $h4_styles = array();

        if(voyage_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = voyage_mikado_options()->getOptionValue('h4_color');
        }
        if(voyage_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = voyage_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = voyage_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = voyage_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if(!empty($h4_styles)) {
            echo voyage_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_h4_styles');
}

if(!function_exists('voyage_mikado_h5_styles')) {

    function voyage_mikado_h5_styles() {

        $h5_styles = array();

        if(voyage_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = voyage_mikado_options()->getOptionValue('h5_color');
        }
        if(voyage_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = voyage_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = voyage_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = voyage_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if(!empty($h5_styles)) {
            echo voyage_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_h5_styles');
}

if(!function_exists('voyage_mikado_h6_styles')) {

    function voyage_mikado_h6_styles() {

        $h6_styles = array();

        if(voyage_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = voyage_mikado_options()->getOptionValue('h6_color');
        }
        if(voyage_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = voyage_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = voyage_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = voyage_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if(!empty($h6_styles)) {
            echo voyage_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_h6_styles');
}

if(!function_exists('voyage_mikado_text_styles')) {

    function voyage_mikado_text_styles() {

        $text_styles = array();

        if(voyage_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = voyage_mikado_options()->getOptionValue('text_color');
        }
        if(voyage_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = voyage_mikado_get_formatted_font_family(voyage_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(voyage_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(voyage_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = voyage_mikado_options()->getOptionValue('text_texttransform');
        }
        if(voyage_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = voyage_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = voyage_mikado_options()->getOptionValue('text_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = voyage_mikado_filter_px(voyage_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if(!empty($text_styles)) {
            echo voyage_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_text_styles');
}

if(!function_exists('voyage_mikado_link_styles')) {

    function voyage_mikado_link_styles() {

        $link_styles = array();

        if(voyage_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = voyage_mikado_options()->getOptionValue('link_color');
        }
        if(voyage_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = voyage_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(voyage_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = voyage_mikado_options()->getOptionValue('link_fontweight');
        }
        if(voyage_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = voyage_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if(!empty($link_styles)) {
            echo voyage_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_link_styles');
}

if(!function_exists('voyage_mikado_link_hover_styles')) {

    function voyage_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(voyage_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = voyage_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(voyage_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = voyage_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if(!empty($link_hover_styles)) {
            echo voyage_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(voyage_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = voyage_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if(!empty($link_heading_hover_styles)) {
            echo voyage_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_link_hover_styles');
}

if(!function_exists('voyage_mikado_smooth_page_transition_styles')) {

    function voyage_mikado_smooth_page_transition_styles() {

        $loader_style = array();

        if(voyage_mikado_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = voyage_mikado_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.mkdf-smooth-transition-loader');

        if(!empty($loader_style)) {
            echo voyage_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(voyage_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = voyage_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.mkdf-st-loader .pulse',
            '.mkdf-st-loader .double_pulse .double-bounce1',
            '.mkdf-st-loader .double_pulse .double-bounce2',
            '.mkdf-st-loader .cube',
            '.mkdf-st-loader .rotating_cubes .cube1',
            '.mkdf-st-loader .rotating_cubes .cube2',
            '.mkdf-st-loader .stripes > div',
            '.mkdf-st-loader .wave > div',
            '.mkdf-st-loader .two_rotating_circles .dot1',
            '.mkdf-st-loader .two_rotating_circles .dot2',
            '.mkdf-st-loader .five_rotating_circles .container1 > div',
            '.mkdf-st-loader .five_rotating_circles .container2 > div',
            '.mkdf-st-loader .five_rotating_circles .container3 > div',
            '.mkdf-st-loader .atom .ball-1:before',
            '.mkdf-st-loader .atom .ball-2:before',
            '.mkdf-st-loader .atom .ball-3:before',
            '.mkdf-st-loader .atom .ball-4:before',
            '.mkdf-st-loader .clock .ball:before',
            '.mkdf-st-loader .mitosis .ball',
            '.mkdf-st-loader .lines .line1',
            '.mkdf-st-loader .lines .line2',
            '.mkdf-st-loader .lines .line3',
            '.mkdf-st-loader .lines .line4',
            '.mkdf-st-loader .fussion .ball',
            '.mkdf-st-loader .fussion .ball-1',
            '.mkdf-st-loader .fussion .ball-2',
            '.mkdf-st-loader .fussion .ball-3',
            '.mkdf-st-loader .fussion .ball-4',
            '.mkdf-st-loader .wave_circles .ball',
            '.mkdf-st-loader .pulse_circles .ball'
        );

        if(!empty($spinner_style)) {
            echo voyage_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }

        $airplane_spinner_style = array();

        if(voyage_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $airplane_spinner_style['stroke'] = voyage_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $airplane_spinner_selectors = array(
            '.mkdf-st-loader .mkdf-plane-holder .st0',
            '.mkdf-st-loader .mkdf-plane-holder .st1'
        );

        if(!empty($airplane_spinner_style)) {
            echo voyage_mikado_dynamic_css($airplane_spinner_selectors, $airplane_spinner_style);
        }
    }

    add_action('voyage_mikado_style_dynamic', 'voyage_mikado_smooth_page_transition_styles');
}