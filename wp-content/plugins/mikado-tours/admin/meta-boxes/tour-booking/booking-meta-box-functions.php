<?php

use MikadofTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;

if(!function_exists('mkdf_tours_register_booking_meta_box')) {
    function mkdf_tours_register_booking_meta_box() {
        add_meta_box(
            'mkdf-tours-booking-meta-box',
            'Mikado Tour Booking',
            'mkdf_tours_register_booking_meta_box_callback',
            'tour-item',
            'advanced',
            'high'
        );
    }

    add_action('add_meta_boxes', 'mkdf_tours_register_booking_meta_box');
}

if(!function_exists('mkdf_tours_register_booking_meta_box_callback')) {
    function mkdf_tours_register_booking_meta_box_callback() {
        global $post;

        $rows = empty($post->ID) ? array() : TourTimeStorage::getInstance()->getTourDates($post->ID);

        $first_half_week = array(
            'Mon' => __('Monday', 'mikado-tours'),
            'Tue' => __('Tuesday', 'mikado-tours'),
            'Wed' => __('Wednesday', 'mikado-tours'),
            'Thu' => __('Thursday', 'mikado-tours')
        );

        $second_half_week = array(
            'Fri' => __('Friday', 'mikado-tours'),
            'Sat' => __('Saturday', 'mikado-tours'),
            'Sun' => __('Sunday', 'mikado-tours')
        );
        
        include 'booking-meta-box.php';
    }
}