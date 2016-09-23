<?php

//top header bar
add_action('voyage_mikado_before_page_header', 'voyage_mikado_get_header_top');

//mobile header
add_action('voyage_mikado_after_page_header', 'voyage_mikado_get_mobile_header');