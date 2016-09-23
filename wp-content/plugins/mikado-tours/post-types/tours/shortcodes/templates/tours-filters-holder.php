<div <?php mkdf_tours_class_attribute($filter_class); ?>>
	<?php if($filter_type === 'vertical') : ?>
		<?php echo mkdf_tours_get_search_main_filters_html($show_tour_types, $number_of_tour_types); ?>
	<?php else: ?>
		<?php
		$tour_types = get_terms(array(
			'taxomony' => 'tour-category'
		));

		?>

		<?php if($display_container_inner) : ?>
			<div class="mkdf-grid">
		<?php endif; ?>
		
		<div class="mkdf-tours-search-horizontal-filters-holder">
			<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
				<div class="mkdf-tours-search-main-filters-title">
					<h6><?php esc_html_e('Find Your', 'mikado-tours'); ?></h6>
					<h5><?php esc_html_e('Destination', 'mikado-tours') ?></h5>
				</div>

				<div class="mkdf-tours-filters-fields-holder">
					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<label class="mkdf-tours-filter-label"><?php esc_html_e('When', 'mikado-tours'); ?></label>
						<div class="mkdf-tours-input-with-icon">

							<select class="mkdf-tours-select-placeholder" name="month">
								<option value=""><?php esc_html_e('Month', 'mikado-tours'); ?></option>
								<option value="1"><?php esc_html_e('January', 'mikado-tours'); ?></option>
								<option value="2"><?php esc_html_e('February', 'mikado-tours'); ?></option>
								<option value="3"><?php esc_html_e('March', 'mikado-tours'); ?></option>
								<option value="4"><?php esc_html_e('April', 'mikado-tours'); ?></option>
								<option value="5"><?php esc_html_e('May', 'mikado-tours'); ?></option>
								<option value="6"><?php esc_html_e('June', 'mikado-tours'); ?></option>
								<option value="7"><?php esc_html_e('July', 'mikado-tours'); ?></option>
								<option value="8"><?php esc_html_e('August', 'mikado-tours'); ?></option>
								<option value="9"><?php esc_html_e('September', 'mikado-tours'); ?></option>
								<option value="10"><?php esc_html_e('November', 'mikado-tours'); ?></option>
							</select>

							<span class="mkdf-tours-input-icon">
								<i class="lnr lnr-calendar-full"></i>
							</span>
						</div>
					</div>

					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<label class="mkdf-tours-filter-label"><?php esc_html_e('Where', 'mikado-tours'); ?></label>
						<div class="mkdf-tours-input-with-icon">
							<input type="text" value="" class="mkdf-tours-destination-search" name="destination" placeholder="<?php esc_attr_e('Destination', 'mikado-tours'); ?>">

						<span class="mkdf-tours-input-icon">
							<i class="lnr lnr-earth"></i>
						</span>
						</div>
					</div>

					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<label class="mkdf-tours-filter-label"><?php esc_html_e('What', 'mikado-tours'); ?></label>
						<div class="mkdf-tours-input-with-icon">
							<select class="mkdf-tours-select-placeholder" name="type[]">
								<option value=""><?php esc_html_e('Type','mikado-tours'); ?></option>

								<?php if(is_array($tour_types) && count($tour_types)) : ?>
									<?php foreach($tour_types as $tour_type) : ?>
										<option value="<?php echo esc_attr($tour_type->slug); ?>"><?php echo esc_html($tour_type->name); ?></option>
									<?php endforeach; ?>

								<?php endif; ?>
							</select>

							<span class="mkdf-tours-input-icon">
								<i class="lnr lnr-rocket"></i>
							</span>
						</div>
					</div>

					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-submit-field-holder mkdf-tours-filter-col">
						<?php if(mkdf_tours_theme_installed()) : ?>
							<?php echo voyage_mikado_execute_shortcode('mkdf_button', array(
								'html_type'  => 'input',
								'input_name' => 'mkdf_tours_search_submit',
								'text'       => esc_attr__('Search', 'mikado-tours'),
								'size'       => 'small',
								'custom_attrs' => array(
								'data-searching-label' => esc_attr__('Searching...', 'mikado-tours')
							)
							)); ?>
						<?php else: ?>
							<input type="submit" data-searching-label="<?php esc_attr_e('Searching...', 'mikado-tours'); ?>" name="mkdf_tours_search_submit" value="<?php esc_attr_e('Search', 'mikado-tours') ?>">
						<?php endif; ?>
					</div>
				</div>
			</form>
		</div>

		<?php if($display_container_inner) : ?>
			</div>
		<?php endif; ?>

	<?php endif; ?>
</div>