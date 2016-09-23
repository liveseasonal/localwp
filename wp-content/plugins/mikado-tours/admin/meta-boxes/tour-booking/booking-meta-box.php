<?php global $post; ?>

<div class="mkdf-meta-box mkdf-page">
	<?php wp_nonce_field('mkdf_tours_saving_tour_periods_'.$post->ID, 'mkdf_tours_saving_tour_periods_'.$post->ID); ?>
	<input type="hidden" id="tour_id" name="tour_id" value="<?php echo esc_attr($post->ID); ?>">

	<div class="mkdf-meta-box-holder">
		<div id="mkdf-tour-booking-content" class="mkdf-meta-box-content-holder">
			<?php if(is_array($rows) && count($rows)) :
				$i = 0;
			?>
				<?php foreach($rows as $rowObject) :
				?>
					<div class="mkdf-tour-booking-section" data-index="<?php echo esc_attr($i); ?>">
						<input type="hidden" name="tour_booking[<?php echo esc_attr($i); ?>][id]" value="<?php echo esc_attr($rowObject->id); ?>">
						<div class="row">
							<a href="#" class="mkdf-tour-booking-remove-item dashicons dashicons-no-alt" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Section', 'mikado-tours'); ?>"></a>
							<div class="col-sm-4">
								<div class="row">
									<div class="col-sm-12">
										<h4><?php esc_html_e('Tour Date and Days', 'mikado-tours'); ?></h4>
										<div class="form-group">
											<label for="tour_booking[<?php echo esc_attr($i); ?>][start_date]"><?php esc_html_e('Start Date:', 'mikado-tours'); ?></label>
											<input type="text" class="form-control mkdf-input mkdf-form-element datepicker" placeholder="" value="<?php echo esc_attr(date('M d, Y', strtotime($rowObject->start_date))); ?>" name="tour_booking[<?php echo esc_attr($i); ?>][start_date]">
										</div>
										<div class="form-group">
											<label for="tour_booking[<?php echo esc_attr($i); ?>][end_date]"><?php esc_html_e('End Date:', 'mikado-tours'); ?></label>
											<input type="text" class="form-control mkdf-input mkdf-form-element datepicker" placeholder="" value="<?php echo esc_attr(date('M d, Y', strtotime($rowObject->end_date))); ?>" name="tour_booking[<?php echo esc_attr($i); ?>][end_date]">
										</div>
										<div class="mkdf-tour-booking-days form-group">
											<div class="row">
												<div class="col-sm-6">
													<?php foreach($first_half_week as $day_key => $day_label) : ?>
														<?php 
														$checked = is_array($rowObject->days) && in_array($day_key, $rowObject->days);
														$checked_str = $checked ? 'checked' : '';
														?>
														
														<div class="checkbox">
															<label>
																<input <?php print $checked_str; ?> name="tour_booking[<?php echo esc_attr($i); ?>][days][]" type="checkbox" value="<?php echo esc_attr($day_key) ?>">
																<?php echo esc_html($day_label) ?>
															</label>
														</div>
													<?php endforeach; ?>
												</div>
												<div class="col-sm-6">
													<?php foreach($second_half_week as $day_key => $day_label) : ?>
														<?php
														$checked = is_array($rowObject->days) && in_array($day_key, $rowObject->days);
														$checked_str = $checked ? 'checked' : '';
														?>
														<div class="checkbox">
															<label>
																<input <?php print $checked_str; ?> name="tour_booking[<?php echo esc_attr($i); ?>][days][]" type="checkbox" value="<?php echo esc_attr($day_key); ?>">
																<?php echo esc_html($day_label) ?>
															</label>
														</div>
													<?php endforeach; ?>
												</div>
											</div>

										</div>

									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<h4><?php esc_html_e('Departure Times', 'mikado-tours'); ?></h4>
								<div id="mkdf-tour-booking-time-<?php echo esc_attr($i); ?>">
									<?php if(!empty($rowObject->times) && is_array($rowObject->times) && count($rowObject->times)) : ?>
										<?php $j = 0; ?>
										<?php foreach($rowObject->times as $time) : ?>
											<div class="mkdf-tour-booking-time" data-index="<?php echo esc_attr($j); ?>">
												<div class="form-group">
													<input type="text" placeholder="HH:ii" class="form-control mkdf-input mkdf-form-element" value="<?php echo esc_attr($time['time']); ?>" name="tour_booking[<?php echo esc_attr($i); ?>][tour_time][<?php echo esc_attr($j); ?>][time]">
													<input type="hidden" value="<?php echo esc_attr($time['id']); ?>" name="tour_booking[<?php echo esc_attr($i); ?>][tour_time][<?php echo esc_attr($j); ?>][id]">
												</div>
												<a href="#" title="<?php esc_html_e('Remove Time', 'mikado-tours'); ?>" class="mkdf-tour-booking-time-remove dashicons dashicons-no-alt form-control-feedback" aria-hidden="true"></a>
											</div>
											<?php $j++; ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<a href="#" class="btn btn-primary mkdf-tour-booking-time-add" id="mkdf-tour-booking-time-add-<?php echo esc_attr($i); ?>"><?php esc_html_e('Add New Time','mikado-tours'); ?></a>
							</div>
							<div class="col-sm-4">
								<h4><?php esc_html_e('Details', 'mikado-tours'); ?></h4>
								<div class="form-group">
									<label for="tour_booking[<?php echo esc_attr($i); ?>][number_of_tickets]"><?php esc_html_e('Tickets', 'mikado-tours'); ?></label>
									<input type="text" name="tour_booking[<?php echo esc_attr($i); ?>][number_of_tickets]" value="<?php echo esc_attr($rowObject->number_of_tickets); ?>" class="form-control mkdf-input mkdf-form-element">
								</div>
								<div class="form-group">
									<label for="tour_booking[<?php echo esc_attr($i); ?>][price_change]"><?php esc_html_e('Price change', 'mikado-tours'); ?></label>
									<input type="text" name="tour_booking[<?php echo esc_attr($i); ?>][price_change]" value="<?php echo esc_attr($rowObject->price_change); ?>" class="form-control mkdf-input mkdf-form-element">
									<p class="help-block"><?php esc_html_e('Use this field for defining special price for this period. Use "%" in front of the number to change the price in percentage.', 'mikado-tours'); ?></p>
								</div>
							</div>
						</div>
						<div class="mkdf-tour-booking-section-validation"></div>
					</div>
				<?php
					$i++;
					endforeach;
				?>
			<?php endif; ?>
		</div>

		<div id="mkdf-tour-booking-messages"></div>

		<div class="mkdf-tour-booking-controls">
			<a id="mkdf-tour-booking-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Period', 'mikado-tours'); ?></a>
			<a id="mkdf-tour-booking-save" href="#" class="btn btn-primary" data-loading-label="<?php esc_html_e('Saving...', 'mikado-tours'); ?>"><?php esc_html_e('Save', 'mikado-tours') ?></a>
		</div>

		<script type="text/html" id="tmpl-mkdf-tour-booking-time-template">
			<div class="mkdf-tour-booking-time" data-index="{{{ data.timeIndex }}}">
				<div class="form-group">
					<input type="text" placeholder="HH:ii" class="form-control mkdf-input mkdf-form-element" name="tour_booking[{{{ data.rowIndex }}}][tour_time][{{{ data.timeIndex }}}][time]">
				</div>
				<a href="#" title="<?php esc_html_e('Remove Time', 'mikado-tours'); ?>" class="mkdf-tour-booking-time-remove dashicons dashicons-no-alt form-control-feedback" aria-hidden="true"></a>
			</div>
		</script>

		<script type="text/html" id="tmpl-mkdf-tour-booking-validation">
			<div class="alert alert-danger" role="alert">
				<# if(data.errorMessages.length) { #>
					<ul>
						<# _.each(data.errorMessages, function(value) { #>
							<li>{{{ value }}}</li>
						<# }); #>
					</ul>
				<# } #>

			</div>
		</script>

		<script type="text/html" id="tmpl-mkdf-tour-booking-save-message">
			<div class="alert {{{ data.htmlClass }}}" role="alert">
				{{{ data.message }}}
			</div>
		</script>

		<script type="text/html" id="tmpl-mkdf-tour-booking-template">
			<div class="mkdf-tour-booking-section" data-index="{{{ data.rowIndex }}}">
				<div class="row">
					<a href="#" class="mkdf-tour-booking-remove-item dashicons dashicons-no-alt" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Section', 'mikado-tours'); ?>"></a>
					<div class="col-sm-4">
						<div class="row">
							<div class="col-sm-12">
								<h4><?php esc_html_e('Tour Date and Days', 'mikado-tours'); ?></h4>
								<div class="form-group">
									<label for="tour_booking[{{{ data.rowIndex }}}][start_date]"><?php esc_html_e('Start Date:', 'mikado-tours'); ?></label>
									<input type="text" class="form-control mkdf-input mkdf-form-element datepicker" placeholder="" name="tour_booking[{{{ data.rowIndex }}}][start_date]">
								</div>
								<div class="form-group">
									<label for="tour_booking[{{{ data.rowIndex }}}][end_date]"><?php esc_html_e('End Date:', 'mikado-tours'); ?></label>
									<input type="text" class="form-control mkdf-input mkdf-form-element datepicker" placeholder="" name="tour_booking[{{{ data.rowIndex }}}][end_date]">
								</div>
								<div class="mkdf-tour-booking-days form-group">
									<div class="row">
										<div class="col-sm-6">
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Mon">
													<?php esc_html_e('Monday', 'mikado-tours'); ?>
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Tue">
													<?php esc_html_e('Tuesday', 'mikado-tours'); ?>
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Wed">
													<?php esc_html_e('Wednesday', 'mikado-tours'); ?>
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Thu">
													<?php esc_html_e('Thursday', 'mikado-tours'); ?>
												</label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Fri">
													<?php esc_html_e('Friday', 'mikado-tours'); ?>
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Sat">
													<?php esc_html_e('Saturday', 'mikado-tours'); ?>
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input name="tour_booking[{{{ data.rowIndex }}}][days][]" type="checkbox" value="Sun">
													<?php esc_html_e('Sunday', 'mikado-tours'); ?>
												</label>
											</div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<h4><?php esc_html_e('Departure Times', 'mikado-tours'); ?></h4>
						<div id="mkdf-tour-booking-time-{{{ data.rowIndex }}}"></div>
						<a href="#" class="btn btn-primary mkdf-tour-booking-time-add" id="mkdf-tour-booking-time-add-{{{ data.rowIndex }}}"><?php esc_html_e('Add New Time'); ?></a>
					</div>
					<div class="col-sm-4">
						<h4><?php esc_html_e('Details', 'mikado-tours'); ?></h4>
						<div class="form-group">
							<label for="tour_booking[{{{ data.rowIndex }}}][number_of_tickets]"><?php esc_html_e('Tickets', 'mikado-tours'); ?></label>
							<input type="text" name="tour_booking[{{{ data.rowIndex }}}][number_of_tickets]" class="form-control mkdf-input mkdf-form-element">
						</div>
						<div class="form-group">
							<label for="tour_booking[{{{ data.rowIndex }}}][price_change]"><?php esc_html_e('Price change', 'mikado-tours'); ?></label>
							<input type="text" name="tour_booking[{{{ data.rowIndex }}}][price_change]" class="form-control mkdf-input mkdf-form-element">
							<p class="help-block"><?php esc_html_e('Use this field for defining special price for this period. Use "%" in front of the number to change the price in percentage.', 'mikado-tours'); ?></p>
						</div>
					</div>
				</div>
				<div class="mkdf-tour-booking-section-validation"></div>
			</div>
		</script>
	</div>
</div>