<div class="mkdf-tour-type-list-holder <?php echo esc_attr($li_hover_color);?>">
	<?php if(is_array($tour_types_arrays) && count($tour_types_arrays)) : ?>
		<div class="mkdf-grid-row">
			<?php foreach($tour_types_arrays as $tour_types) : ?>
				<div class="<?php echo esc_attr($list_class); ?>">
					<ul class="mkdf-tour-type-list">
						<?php foreach($tour_types as $tour_type) : ?>
							<?php
							$type_icon = $caller->getTypeIcon($tour_type);
							$type_min_price = $caller->getTypeMinPrice($tour_type);
							?>

							<li>
								<a href="<?php echo esc_url(get_term_link($tour_type)); ?>">
									<?php if($type_icon) : ?>
										<span class="mkdf-tour-type-icon">
										<?php print $type_icon; ?>
									</span>
									<?php endif; ?>

									<span class="mkdf-tour-type-name">
									<?php echo esc_html($tour_type->name); ?>
								</span>

									<?php if(!empty($type_min_price)) : ?>
										<span class="mkdf-tour-type-min-price-holder">
										<span class="mkdf-tour-type-min-price-label">
											<?php esc_html_e('From', 'mikado-tours'); ?>
										</span>
										<span class="mkdf-tour-type-min-price">
											<?php echo mkdf_tours_price_helper()->formatPrice($type_min_price); ?>
										</span>
									</span>
									<?php endif; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>