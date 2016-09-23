<?php

use MikadofTours\CPT\Tours\Lib\BookingHandler;
use MikadofTours\CPT\Tours\Lib\TourPagination;

if(!function_exists('mkdf_tours_get_tour_duration')) {
	/**
	 * Returns duration for single tour
	 *
	 * @param int $tour_id
	 *
	 * @return string
	 */
	function mkdf_tours_get_tour_duration($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$duration = get_post_meta($tour_id, 'mkdf_tours_duration', true);

		if(!$duration) {
			return false;
		}

		return $duration;
	}
}

if(!function_exists('mkdf_tours_get_tour_min_age')) {
	/**
	 * @param int $tour_id
	 *
	 * @return bool|mixed
	 */
	function mkdf_tours_get_tour_min_age($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$tour_min_age   = get_post_meta($tour_id, 'mkdf_tours_info_min_years', true);
		$min_age_suffix = apply_filters('mkdf_tours_min_age_suffix', '+');

		return empty($tour_min_age) ? false : $tour_min_age.$min_age_suffix;
	}
}

if(!function_exists('mkdf_tours_get_tour_price')) {
	/**
	 * @param int $tour_id
	 *
	 * @return bool|string
	 */
	function mkdf_tours_get_tour_price($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		return mkdf_tours_price_helper()->getOriginalPrice($tour_id);
	}
}

if(!function_exists('mkdf_tours_get_tour_discount_price')) {
	/**
	 * @param int $tour_id
	 *
	 * @return bool|string
	 */
	function mkdf_tours_get_tour_discount_price($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		return mkdf_tours_price_helper()->getDiscountPrice($tour_id);
	}
}

if(!function_exists('mkdf_tours_get_tour_label')) {
	/**
	 * @param int $tour_id
	 *
	 * @return bool|mixed
	 */
	function mkdf_tours_get_tour_label($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$label = get_post_meta($tour_id, 'mkdf_tours_custom_label', true);

		if(empty($label)) {
			return false;
		}

		return $label;
	}
}

if(!function_exists('mkdf_tours_get_tour_label_skin')) {
	/**
	 * @param int $tour_id
	 *
	 * @return bool|mixed
	 */
	function mkdf_tours_get_tour_label_skin($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$labelSkin = get_post_meta($tour_id, 'mkdf_tours_custom_label_skin', true);

		if(empty($labelSkin)) {
			return false;
		}

		return $labelSkin;
	}
}

if(!function_exists('mkdf_tours_get_tour_label_html')) {
	/**
	 * @param int $tour_id
	 *
	 * @return string
	 */
	function mkdf_tours_get_tour_label_html($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$label = mkdf_tours_get_tour_label($tour_id);
		$skin  = mkdf_tours_get_tour_label_skin($tour_id);

		$holder_class = array('mkdf-tour-item-label');

		if($skin) {
			$holder_class[] = 'mkdf-tour-item-label-'.$skin;
		}

		ob_start(); ?>

		<span class="<?php echo esc_attr(implode(' ', $holder_class)); ?>">
			<span class="mkdf-tour-item-label-inner">
				<?php echo esc_html($label); ?>
			</span>
		</span>

		<?php

		return apply_filters('mkdf_tours_get_tour_label_html', ob_get_clean(), $label, $skin);
	}
}

if(!function_exists('mkdf_tours_get_tour_excerpt')) {
	/**
	 * @param string $excerpt_length
	 *
	 * @return string
	 */
	function mkdf_tours_get_tour_excerpt($excerpt_length = '') {
		$excerpt_length = $excerpt_length > 0 ? $excerpt_length : 55;

		return wp_trim_words(get_the_excerpt(), $excerpt_length);
	}
}

if(!function_exists('mkdf_tours_get_tour_rating')) {
	/**
	 * @param int $tour_id
	 *
	 * @return float
	 */
	function mkdf_tours_get_tour_rating($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$criteria_data_array = mkdf_tours_get_criteria_ratings($tour_id);
		$average_rating      = mkdf_tours_reviews_get_total_average($criteria_data_array);

		if(!$average_rating) {
			return false;
		}

		return $average_rating;
	}
}

if(!function_exists('mkdf_tours_get_tour_rating_html')) {
	/**
	 * @param int $tour_id
	 *
	 * @return mixed|void
	 */
	function mkdf_tours_get_tour_rating_html($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$rating = mkdf_tours_get_tour_rating($tour_id);
		$label  = mkdf_tours_reviews_get_description_for_rating($rating);
		$icon   = mkdf_tours_reviews_get_icon_for_rating($rating);

		ob_start(); ?>

		<?php if($rating) : ?>

			<div class="mkdf-tour-item-rating">
			    <span class="mkdf-tour-rating-icon">
				    <?php print $icon; ?>
			    </span>
			    <span class="mkdf-tour-rating-rate">
				    <?php echo esc_html(mkdf_tours_reviews_format_rating_output($rating)); ?>
			    </span>
			    <span class="mkdf-tour-rating-label">
				    <?php echo esc_html($label); ?>
			    </span>
			</div>

		<?php endif; ?>

		<?php

		return apply_filters('mkdf_tours_get_tour_rating_html', ob_get_clean(), $rating, $label, $icon);
	}
}

if(!function_exists('mkdf_tours_get_tour_rating_class')) {
	/**
	 * @param int $tour_id
	 *
	 * @return string
	 */
	function mkdf_tours_get_tour_rating_class($tour_id = null) {

		if (mkdf_tours_get_tour_rating($tour_id) ){
			$rating_class = 'mkdf-tour-item-has-rating';
		}else{
			$rating_class = 'mkdf-tour-item-no-rating';
		}

		return $rating_class;
	}
}

if(!function_exists('mkdf_tours_get_tour_price_html')) {
	/**
	 * Generates html part for tour price.
	 *
	 * @param int $tour_id
	 *
	 * @return string
	 */
	function mkdf_tours_get_tour_price_html($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$price          = mkdf_tours_get_tour_price($tour_id);
		$discount_price = mkdf_tours_get_tour_discount_price($tour_id);

		$holder_class = array('mkdf-tours-price-holder');

		if($discount_price) {
			$holder_class[] = 'mkdf-tours-price-with-discount';
		}

		ob_start(); ?>

		<span class="<?php echo esc_attr(implode(' ', $holder_class)); ?>">
			<?php if($price) : ?>
				<span class="mkdf-tours-item-price"><?php echo esc_html($price); ?></span>
			<?php endif; ?>
			<?php if($discount_price) : ?>
				<span class="mkdf-tours-item-discount-price mkdf-tours-item-price">
					<?php echo esc_html($discount_price); ?>
				</span>
			<?php endif; ?>
		</span>

		<?php

		return apply_filters('mkdf_tours_get_tour_price_html', ob_get_clean(), $price, $discount_price);
	}
}

if(!function_exists('mkdf_tours_get_tour_min_age_html')) {
	/**
	 * @param null $tour_id
	 *
	 * @param bool $age_label
	 *
	 * @return mixed|void
	 */
	function mkdf_tours_get_tour_min_age_html($tour_id = null, $age_label = false) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$min_age = mkdf_tours_get_tour_min_age($tour_id);

		ob_start(); ?>

		<?php if($min_age) : ?>

			<div class="mkdf-tour-min-age-holder">
			    <span class="mkdf-tour-min-age-icon mkdf-tour-info-icon">
				    <span class="lnr lnr-user"></span>
			    </span>

				<span class="mkdf-tour-info-label">
					<?php echo esc_html($min_age); ?>

					<?php if($age_label) : ?>
						<span class="mkdf-tour-min-age-label"><?php esc_html_e('Age', 'mikado-tours'); ?></span>
					<?php endif; ?>
				</span>
			</div>

		<?php endif; ?>

		<?php

		return apply_filters('mkdf_tours_get_tour_min_age_html', ob_get_clean(), $min_age);
	}
}

if(!function_exists('mkdf_tours_get_tour_duration_html')) {
	/**
	 * @param null $tour_id
	 *
	 * @return mixed|void
	 */
	function mkdf_tours_get_tour_duration_html($tour_id = null) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$duration = mkdf_tours_get_tour_duration($tour_id);

		ob_start(); ?>

		<?php if($duration) : ?>

			<div class="mkdf-tour-duration-holder">
			    <span class="mkdf-tour-duration-icon mkdf-tour-info-icon">
					<span class="lnr lnr-undo"></span>
			    </span>
				<span class="mkdf-tour-info-label">
					<?php echo esc_html($duration); ?>
				</span>
			</div>

		<?php endif; ?>

		<?php

		return apply_filters('mkdf_tours_get_tour_duration_html', ob_get_clean(), $duration);
	}
}

if(!function_exists('mkdf_tours_get_tour_info_table_data')) {
	/**
	 * @param int $tour_id
	 *
	 * @return array
	 */
	function mkdf_tours_get_tour_info_table_data($tour_id = null) {
		$data    = array();
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$departure_option = get_post_meta($tour_id, 'mkdf_tours_departure', true);

		if(!empty($departure_option)) {
			$departure_item = array(
				'text'  => esc_html__('Departure', 'mikado-tours'),
				'value' => $departure_option
			);

			$data[] = $departure_item;
		}

		$departure_time_option = get_post_meta($tour_id, 'mkdf_tours_departure_time', true);

		if(!empty($departure_time_option)) {
			$departure_time_item = array(
				'text'  => esc_html__('Departure Time', 'mikado-tours'),
				'value' => $departure_time_option
			);

			$data[] = $departure_time_item;
		}

		$return_time_option = get_post_meta($tour_id, 'mkdf_tours_return_time', true);

		if(!empty($return_time_option)) {
			$return_time_item = array(
				'text'  => esc_html__('Return Time', 'mikado-tours'),
				'value' => $return_time_option
			);

			$data[] = $return_time_item;
		}

		$dress_code_option = get_post_meta($tour_id, 'mkdf_tours_dress_code', true);

		if(!empty($dress_code_option)) {
			$dress_code_item = array(
				'text'  => esc_html__('Dress Code', 'mikado-tours'),
				'value' => $dress_code_option
			);

			$data[] = $dress_code_item;
		}

		$checked_attributes = get_post_meta($tour_id, 'mkdf_tours_attributes', true);

		if(is_array($checked_attributes) && count($checked_attributes)) {
			$checked_attributes_titles = array();

			foreach($checked_attributes as $attr) {
				$checked_attributes_titles[] = get_the_title($attr);
			}

			$checked_attributes_item = array(
				'text'       => esc_html__('Include', 'mikado-tours'),
				'html_class' => 'mkdf-tours-checked-attributes',
				'value'      => $checked_attributes_titles
			);

			$data[] = $checked_attributes_item;
		}

		$not_checked_attributes = array();
		$all_attributes         = mkdf_tours_get_tour_attributes();

		if(is_array($checked_attributes) && count($checked_attributes)) {
			foreach($all_attributes as $attribute_key => $attribute) {
				if(!in_array($attribute_key, $checked_attributes)) {
					$not_checked_attributes[$attribute_key] = $attribute;
				}
			}

			$not_checked_attributes_item = array(
				'text'       => esc_html__('Not Included', 'mikado-tours'),
				'html_class' => 'mkdf-tours-unchecked-attributes',
				'value'      => $not_checked_attributes
			);

			$data[] = $not_checked_attributes_item;
		}

		return $data;
	}
}

if(!function_exists('mkdf_tours_is_checkout_page')) {
	/**
	 * @return bool
	 */
	function mkdf_tours_is_checkout_page() {
		$page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);

		return $page_template === 'post-types/tours/templates/checkout/tour-checkout.php';
	}
}

if(!function_exists('mkdf_tours_get_checkout_page_content')) {
	/**
	 *
	 */
	function mkdf_tours_get_checkout_page_content() {
		$params['booking']               = mkdf_tours_get_checkout_data();
		$params['is_payment']            = mkdf_tours_is_returned_from_payment($params['booking']);
		$params['is_payment_sucessfull'] = mkdf_tours_is_payment_successfull($params['booking']);
		$params['style']                 = '';

		$id = $params['booking']->ID;
		$background_image = wp_get_attachment_image_src(get_post_thumbnail_id($id),'voyage_landscape');
		$params['style'] = 'background-image: url('.esc_url($background_image[0]).')';

		echo mkdf_tours_get_tour_module_template_part('checkout/checkout-content', 'tours', 'templates', '', $params);
	}
}

if(!function_exists('mkdf_tours_get_checkout_data')) {
	/**
	 *
	 */
	function mkdf_tours_get_checkout_data() {
		if(empty($_GET['booking'])) {
			return false;
		}

		$booking_hash = $_GET['booking'];

		$booking         = BookingHandler::getInstance()->getBookingByHash($booking_hash);
		$can_see_booking = BookingHandler::getInstance()->canSeeBookingData($booking);

		if(!$can_see_booking) {
			return false;
		}

		return $booking;
	}
}

if(!function_exists('mkdf_tours_is_returned_from_payment')) {
	/**
	 * @param $bookingObject
	 *
	 * @return bool
	 *
	 */
	function mkdf_tours_is_returned_from_payment($bookingObject) {
		if(!$bookingObject || empty($_GET['returned_from_payment']) || empty($_GET['booking'])) {
			return false;
		}

		$returned_from_payment = $_GET['returned_from_payment'];
		$hash_from_url         = $_GET['booking'];

		return $returned_from_payment && $hash_from_url === $bookingObject->unique_hash;
	}
}

if(!function_exists('mkdf_tours_is_payment_successfull')) {
	/**
	 * @param $booking
	 *
	 * @return bool
	 */
	function mkdf_tours_is_payment_successfull($booking) {
		if(!$booking) {
			return false;
		}

		return $booking->payment_status === 'completed';
	}
}

if(!function_exists('mkdf_tours_get_search_page_content_html')) {
	/**
	 * Returns search page content
	 *
	 * @return string
	 */
	function mkdf_tours_get_search_page_content_html() {
		$tours_list = mkdf_tours_search()->search();

		return mkdf_tours_get_tour_module_template_part('search/search-content', 'tours', 'templates', '', compact('tours_list'));
	}
}

if(!function_exists('mkdf_tours_get_search_page_items_loop_html')) {
	/**
	 * @param $tours_list
	 * @param string $type
	 * @param int $text_length
	 * @param string $thumb_size
	 *
	 * @return string
	 */
	function mkdf_tours_get_search_page_items_loop_html($tours_list, $type = '', $text_length = null, $thumb_size = null) {
		$type = empty($type) ? mkdf_tours_search()->getViewType() : $type;

		$col_class = $type === 'list' ? 'mkdf-grid-col-12' : 'mkdf-grid-col-4';

		$col_class .= ' mkdf-tours-search-'.$type.'-item';

		$default_text_length = 55;
		$default_thumb_size  = 'full';

		if(mkdf_tours_theme_installed()) {
			$default_text_length = voyage_mikado_options()->getOptionValue('tours_'.$type.'_text_length');

			if($type !== 'list') {
				$default_thumb_size = voyage_mikado_options()->getOptionValue('tours_'.$type.'_thumb_size');
			}
		}

		$text_length = is_null($text_length) ? $default_text_length : $text_length;
		$thumb_size  = is_null($thumb_size) ? $default_thumb_size : $thumb_size;

		return mkdf_tours_get_tour_module_template_part('search/search-items-content', 'tours', 'templates', '', array(
			'tours_list'  => $tours_list,
			'type'        => $type,
			'text_length' => $text_length,
			'thumb_size'  => $thumb_size,
			'col_class'   => $col_class
		));
	}
}

if(!function_exists('mkdf_tours_get_search_main_filters_html')) {
	/**
	 * Returns main filters html
	 *
	 * @param bool $show_tour_types
	 *
	 * @param int $number_of_tour_types
	 *
	 * @return string
	 */
	function mkdf_tours_get_search_main_filters_html($show_tour_types = true, $number_of_tour_types = 0) {
		$currency_symbol   = mkdf_tours_price_helper()->getCurrencySymbol();
		$currency_position = mkdf_tours_price_helper()->getCurrencyPosition();
		$edge_prices       = mkdf_tours_price_helper()->getEdgePrices();
		$min_price         = empty($edge_prices->min_price) ? 0 : $edge_prices->min_price;
		$max_price         = empty($edge_prices->max_price) ? 5000 : $edge_prices->max_price;

		$tour_types = get_terms('tour-category', array(
			'orderby' => 'count',
			'order'   => 'DESC',
			'number'  => $number_of_tour_types
		));

		$checked_types    = mkdf_tours_search()->getTourCheckedTypes();
		$keyword          = mkdf_tours_search()->getKeyword();
		$destination      = mkdf_tours_search()->getDestinationKeyword();
		$chosen_month     = mkdf_tours_search()->getMonth();
		$chosen_min_price = mkdf_tours_search()->getMinPrice();
		$chosen_max_price = mkdf_tours_search()->getMaxPrice();
		$current_page     = mkdf_tours_search()->getCurrentPage();

		if(!$chosen_min_price) {
			$chosen_min_price = $min_price;
		}

		if(!$chosen_max_price) {
			$chosen_max_price = $max_price;
		}

		$months = array(
			''   => esc_html__('Month', 'mikado-tours'),
			'1'  => esc_html__('January', 'mikado-tours'),
			'2'  => esc_html__('February', 'mikado-tours'),
			'3'  => esc_html__('March', 'mikado-tours'),
			'4'  => esc_html__('April', 'mikado-tours'),
			'5'  => esc_html__('May', 'mikado-tours'),
			'6'  => esc_html__('June', 'mikado-tours'),
			'7'  => esc_html__('July', 'mikado-tours'),
			'8'  => esc_html__('August', 'mikado-tours'),
			'9'  => esc_html__('September', 'mikado-tours'),
			'10' => esc_html__('October', 'mikado-tours'),
			'11' => esc_html__('November', 'mikado-tours'),
			'12' => esc_html__('December', 'mikado-tours')
		);

		return mkdf_tours_get_tour_module_template_part('search/main-filters', 'tours', 'templates', '', compact(
			'currency_symbol',
			'currency_position',
			'min_price',
			'max_price',
			'chosen_min_price',
			'chosen_max_price',
			'tour_types',
			'checked_types',
			'keyword',
			'destination',
			'chosen_month',
			'months',
			'current_page',
			'show_tour_types'
		));
	}
}

if(!function_exists('mkdf_tours_get_search_ordering_html')) {
	/**
	 * Returns search ordering html
	 *
	 * @return string
	 */
	function mkdf_tours_get_search_ordering_html() {
		$current_ordering   = mkdf_tours_search()->getOrderBy();
		$current_order_type = mkdf_tours_search()->getOrderType();
		$current_view_type  = mkdf_tours_search()->getViewType();

		$ordering = array(
			'date'       => array(
				'title'      => esc_html__('Date', 'mikado-tours'),
				'icon'       => 'lnr lnr-calendar-full',
				'order_by'   => 'date',
				'order_type' => 'desc'
			),
			'price_low'  => array(
				'title'      => esc_html__('Price Low to High', 'mikado-tours'),
				'icon'       => 'lnr lnr-exit-up',
				'order_by'   => 'price',
				'order_type' => 'asc'
			),
			'price_high' => array(
				'title'      => esc_html__('Price High to Low', 'mikado-tours'),
				'icon'       => 'lnr lnr-enter-down',
				'order_by'   => 'price',
				'order_type' => 'desc'
			),
			'name'       => array(
				'title'      => esc_html__('Name', 'mikado-tours'),
				'icon'       => 'lnr lnr-sort-alpha-asc',
				'order_by'   => 'name',
				'order_type' => 'asc'
			)
		);

		$view_types = array(
			'list'     => array(
				'type' => 'list',
				'icon' => 'icon_ul'
			),
			'standard' => array(
				'type' => 'standard',
				'icon' => 'icon_grid-2x2'
			),
			'gallery'  => array(
				'type' => 'gallery',
				'icon' => 'icon_grid-3x3'
			)
		);

		return mkdf_tours_get_tour_module_template_part('search/ordering', 'tours', 'templates', '', compact(
			'current_ordering',
			'current_order_type',
			'current_view_type',
			'ordering',
			'view_types'
		));
	}
}

if(!function_exists('mkdf_tours_get_search_pagination')) {
	/**
	 * Prints tours pagination template
	 */
	function mkdf_tours_get_search_pagination() {
		$perPage      = mkdf_tours_search()->getToursPerPage();
		$total        = mkdf_tours_search()->getTotal();
		$current_page = mkdf_tours_search()->getCurrentPage();

		$pagination = new TourPagination($perPage, $total, $current_page);

		return $pagination->paginate();
	}
}

if(!function_exists('mkdf_tours_get_tour_categories_html')) {
	/**
	 * @param null $tour_id
	 *
	 * @param bool $use_light_image
	 *
	 * @return mixed|void
	 */
	function mkdf_tours_get_tour_categories_html($tour_id = null, $use_light_image = false) {
		$tour_id = empty($tour_id) ? get_the_ID() : $tour_id;

		$categories = wp_get_post_terms($tour_id, 'tour-category');

		ob_start();

		?>

		<?php if(is_array($categories) && count($categories)) : ?>
			<div class="mkdf-tours-tour-categories-holder">
				<?php foreach($categories as $category) : ?>
					<div class="mkdf-tours-tour-categories-item">
						<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
							<?php
							$category_image = $use_light_image ? get_term_meta($category->term_id, 'light_term_custom_image', true) : get_term_meta($category->term_id, 'term_custom_image', true);
							?>

							<?php if(mkdf_tours_theme_installed() && empty($category_image)) : ?>
								<?php
								$category_icon_pack = get_term_meta($category->term_id, 'icon_pack', true);
								$icon_param_name    = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($category_icon_pack);
								$category_icon      = get_term_meta($category->term_id, $icon_param_name, true);
								?>

								<?php if(!empty($category_icon)) : ?>
									<span class="mkdf-tour-cat-item-icon">
										<?php echo voyage_mikado_icon_collections()->renderIcon($category_icon, $category_icon_pack); ?>
									</span>
								<?php endif; ?>

							<?php else: ?>
								<span class="mkdf-tour-cat-item-icon mkdf-tour-cat-item-custom-image <?php if($use_light_image) {
									echo 'mkdf-tour-light-cat-item-icon';
								} ?>">
									<img src="<?php echo esc_url($category_image) ?>" alt="term-custom-icon">
								</span>
							<?php endif; ?>

							<span class="mkdf-tour-cat-item-text">
								<?php echo esc_html($category->name); ?>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php

		return apply_filters('mkdf_tours_get_tour_categories_html', ob_get_clean(), $categories);
	}
}

if(!function_exists('mkdf_tours_get_tour_image_html')) {
	/**
	 * @param $image_size
	 *
	 * @return string
	 */
	function mkdf_tours_get_tour_image_html($image_size) {
		$image_size = trim($image_size);

		if(strstr($image_size, 'x')) {
			//Find digits
			preg_match_all('/\d+/', $image_size, $matches);

			if(!empty($matches[0])) {
				$width  = $matches[0][0];
				$height = $matches[0][1];

				$id = get_post_thumbnail_id(get_the_ID());

				return mkdf_tours_generate_thumbnail($id, null, $width, $height);
			}
		}

		return get_the_post_thumbnail(get_the_ID(), $image_size);
	}
}

if(!function_exists('mkdf_tours_get_image_size_param')) {
	/**
	 * @param $params
	 *
	 * @return string
	 */
	function mkdf_tours_get_image_size_param($params) {
		$use_custom_size = !empty($params['custom_image_dimensions']) && $params['image_size'];

		if(!$use_custom_size) {
			$thumb_size = 'full';

			if(!empty($params['image_size'])) {
				$image_size = $params['image_size'];

				switch($image_size) {
					case 'landscape':
						$thumb_size = 'voyage_landscape';
						break;
					case 'portrait':
						$thumb_size = 'voyage_portrait';
						break;
					case 'square':
						$thumb_size = 'voyage_square';
						break;
					case 'full':
						$thumb_size = 'full';
						break;
					default:
						$thumb_size = 'full';
						break;
				}
			}

			return $thumb_size;
		}

		return $params['custom_image_dimensions'];
	}
}

?>