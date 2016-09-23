<div class="mkdf-tours-search-main-filters-holder mkdf-boxed-widget">
	<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
		<div class="mkdf-tours-search-main-filters-title">
			<h5><?php esc_html_e('Find Your Destination', 'mikado-tours'); ?></h5>
			<p><?php esc_html_e('Discover the world', 'mikado-tours') ?></p>
		</div>

		<input type="hidden" name="order_by" value="<?php echo esc_attr(mkdf_tours_search()->getOrderBy()); ?>">
		<input type="hidden" name="order_type" value="<?php echo esc_attr(mkdf_tours_search()->getOrderType()); ?>">
		<input type="hidden" name="view_type" value="<?php echo esc_attr(mkdf_tours_search()->getViewType()); ?>">
		<input type="hidden" name="page" value="<?php echo esc_attr($current_page); ?>">

		<div class="mkdf-tours-search-main-filters-fields">
			<div class="mkdf-tours-input-with-icon">
				<input class="mkdf-tours-keyword-search" value="<?php echo esc_attr($keyword); ?>" type="text" name="keyword" placeholder="<?php esc_attr_e('Search Tour', 'mikado-tours'); ?>">

				<span class="mkdf-tours-input-icon">
					<i class="lnr lnr-magnifier"></i>
				</span>
			</div>
			<div class="mkdf-tours-input-with-icon">
				<input type="text" value="<?php echo esc_attr($destination); ?>" class="mkdf-tours-destination-search" name="destination" placeholder="<?php esc_attr_e('Destination', 'mikado-tours'); ?>">

				<span class="mkdf-tours-input-icon">
					<i class="lnr lnr-earth"></i>
				</span>
			</div>
			<div class="mkdf-tours-input-with-icon">
				<select name="month" class="mkdf-tours-select-placeholder">
					<?php foreach($months as $month_value => $month_label) : ?>
						<?php $selected = $month_value === (int) $chosen_month ? 'selected' : ''; ?>

						<option <?php echo esc_attr($selected); ?> value="<?php echo esc_attr($month_value); ?>"><?php echo esc_html($month_label); ?></option>
					<?php endforeach; ?>
				</select>

				<span class="mkdf-tours-input-icon">
					<i class="lnr lnr-calendar-full"></i>
				</span>
			</div>

			<div class="mkdf-tours-range-input"></div>

			<div class="mkdf-tours-input-with-icon">
				<input type="text" class="mkdf-tours-price-range-field"
					data-currency-symbol-position="<?php echo esc_attr($currency_position); ?>"
					data-currency-symbol="<?php echo esc_attr($currency_symbol); ?>"
					data-min-price="<?php echo esc_attr($min_price); ?>"
					data-max-price="<?php echo esc_attr($max_price); ?>"
					data-chosen-min-price="<?php echo esc_attr($chosen_min_price); ?>"
					data-chosen-max-price="<?php echo esc_attr($chosen_max_price); ?>"
					placeholder="<?php esc_attr_e('Price range', 'mikado-tours'); ?>">
				<input type="hidden" name="min_price">
				<input type="hidden" name="max_price">
			</div>


			<?php if(is_array($tour_types) && count($tour_types) && $show_tour_types) : ?>
				<?php foreach($tour_types as $type) : ?>
					<?php
					$checked = in_array($type->slug, $checked_types);
					$checked_attr = $checked ? 'checked' : '';
					?>

					<div class="mkdf-tours-type-filter-item">
						<input <?php echo esc_attr($checked_attr); ?> type="checkbox" id="mkdf-tour-type-filter-<?php echo esc_attr($type->slug); ?>" name="type[]" value="<?php echo esc_attr($type->slug); ?>">
						<label for="mkdf-tour-type-filter-<?php echo esc_attr($type->slug); ?>">
						<span>
							<?php echo esc_html($type->name); ?>
						</span>
						</label>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if(mkdf_tours_theme_installed()) : ?>
				<?php echo voyage_mikado_execute_shortcode('mkdf_button', array(
					'html_type'    => 'input',
					'input_name'   => 'mkdf_tours_search_submit',
					'text'         => esc_attr__('Search', 'mikado-tours'),
					'custom_attrs' => array(
						'data-searching-label' => esc_attr__('Searching...', 'mikado-tours')
					)
				)); ?>
			<?php else: ?>
				<input type="submit" data-searching-label="<?php esc_attr_e('Searching...', 'mikado-tours'); ?>" name="mkdf_tours_search_submit" value="<?php esc_attr_e('Search', 'mikado-tours') ?>">
			<?php endif; ?>

		</div>
	</form>
</div>