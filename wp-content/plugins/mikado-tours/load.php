<?php

require_once 'const.php';
require_once 'helpers.php';

//load database setup
require_once 'database-setup/database-table-setup.php';
require_once 'database-setup/tour-dates-table-setup.php';
require_once 'database-setup/tour-times-table-setup.php';
require_once 'database-setup/tour-bookings-table-setup.php';
require_once 'database-setup/review-ratings-table-setup.php';
require_once 'database-setup/tables-setup.php';

//load lib
require_once 'lib/post-type-interface.php';
require_once 'lib/shortcode-interface.php';

//load payments
require_once 'payment/load.php';

//load user dashboar
require_once 'user-dashboard/dashboard-functions.php';

//load reviews
require_once 'reviews/load.php';

require_once 'post-types/tours/lib/tours-query.php';
require_once 'post-types/tours/lib/tour-search.php';
require_once 'post-types/tours/lib/tour-pagination.php';
require_once 'post-types/tours/lib/booking-handler.php';
require_once 'post-types/tours/lib/tour-price-helper.php';
require_once 'post-types/tours/lib/helpers.php';
require_once 'post-types/tours/lib/template-helpers.php';
require_once 'post-types/tours/lib/page-templater.php';

require_once 'post-types/destinations/helpers.php';

//load post-post-types
require_once 'post-types/tours/tours-register.php';
require_once 'post-types/destinations/destinations-register.php';
require_once 'post-types/tour-attributes/tour-attributes-register.php';
require_once 'post-types/taxonomy-meta-fields.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last

//load shortcodes inteface
require_once 'lib/shortcode-loader.php';

//load shortcodes
require_once 'post-types/tours/shortcodes/tours-carousel.php';
require_once 'post-types/tours/shortcodes/tours-list.php';
require_once 'post-types/tours/shortcodes/tour-cover-boxes.php';
require_once 'post-types/tours/shortcodes/tours-filter.php';
require_once 'post-types/tours/shortcodes/slider-with-filter.php';
require_once 'post-types/tours/shortcodes/tour-type-list.php';
require_once 'post-types/tours/shortcodes/top-reviews-carousel.php';
require_once 'post-types/destinations/shortcodes/destination-grid.php';

require_once 'admin/meta-boxes/tour-booking/tour-time-storage.php';

require_once 'visual-composer-config.php';

//load admin
if(!function_exists('mkdf_tours_load_admin')) {
    function mkdf_tours_load_admin() {
        require_once 'admin/meta-boxes/tours/map.php';
        require_once 'admin/meta-boxes/tour-booking/booking-meta-box-functions.php';
        require_once 'admin/options/tours/map.php';
    }

    add_action('voyage_mikado_before_options_map', 'mkdf_tours_load_admin');
}

require_once 'admin/functions.php';
require_once 'admin/booking-dashboard/booking-table.php';
require_once 'admin/booking-dashboard/booking-dashboard.php';