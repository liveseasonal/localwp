<div class="mkdf-tours-list-holder <?php echo esc_attr($hover_class);?>">
	<?php if($query->have_posts()) : ?>
		<?php if($display_load_more_data) : ?>
			<div class="mkdf-tours-list-pagination-data">
				<input type="hidden" name="order_by" value="<?php echo esc_attr($order_by); ?>">
				<input type="hidden" name="order" value="<?php echo esc_attr($order); ?>">
				<input type="hidden" name="tour_category" value="<?php echo esc_attr($tour_category); ?>">
				<input type="hidden" name="number" value="<?php echo esc_attr($number); ?>">
				<input type="hidden" name="thumb_size" value="<?php echo esc_attr($thumb_size); ?>">
				<input type="hidden" name="next_page" value="2">
				<input type="hidden" name="tour_type" value="<?php echo esc_attr($tour_type); ?>">
				<input type="hidden" name="image_size" value="<?php echo esc_attr($image_size); ?>">
				<input type="hidden" name="text_length" value="<?php echo esc_attr($text_length); ?>">
			</div>
		<?php endif; ?>

		<?php if($params['filter'] == 'yes') : ?>
			<div class="mkdf-tours-list-filter-holder clearfix">
				<ul>
					<li class="mkdf-tour-list-current-filter mkdf-tour-list-filter-item">
						<a href="#"><?php esc_html_e('All', 'mikado-tours'); ?></a>
					</li>
					<?php foreach($filter_categories as $category) : ?>
						<li class="mkdf-tour-list-filter-item" data-type="tour-category-<?php echo esc_attr($category->slug); ?>">
							<a href="#">
								<?php echo esc_html($category->name); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="mkdf-tours-list-holder-inner <?php echo esc_attr($holder_classes) ?>">

			<?php $caller->getToursQueryTemplate($params); ?>

			<div class="mkdf-tours-list-grid-sizer"></div>
		</div>

		<?php if($enable_load_more) : ?>
			<div class="mkdf-tours-pagination-holder mkdf-tours-pagination-load-more">
				<?php if(mkdf_tours_theme_installed()) : ?>
					<?php echo voyage_mikado_execute_shortcode('mkdf_button', array(
						'text'         => esc_html($load_more_text),
						'link'         => '#',
						'custom_attrs' => array(
							'data-loading-label' => esc_attr__('Loading...', 'mikado-tours')
						),
						'custom_class' => 'mkdf-tours-load-more-button'
					)); ?>
				<?php else: ?>
					<a class="mkdf-tours-load-more-button" href="#" data-loading-label="<?php esc_attr_e('Loading...', 'mikado-tours'); ?>"><?php echo esc_html($load_more_text); ?></a>
				<?php endif; ?>
			</div>

		<?php endif; ?>


	<?php else: ?>
		<p><?php esc_html_e('No tours match your criteria', 'mikado-tours'); ?></p>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>