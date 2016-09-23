<div class="mkdf-tours-my-bookings-holder">
	<?php if(is_array($user_bookings) && count($user_bookings)) : ?>
		<ul class="mkdf-tours-my-bookings-list">
			<?php foreach($user_bookings as $user_booking) : ?>
				<li class="mkdf-tours-my-booking-item">
					<div class="mkdf-tours-booking-item-image-holder">
						<a target="_blank" href="<?php echo esc_url(get_the_permalink($user_booking->ID)); ?>">
							<?php echo get_the_post_thumbnail($user_booking->ID); ?>
						</a>
					</div>
					<div class="mkdf-tours-info-items">
						<div class="mkdf-tours-booking-info-item">
							<p>
								<span><?php esc_html_e('Name:', 'mikado-tours'); ?></span>
								<?php echo esc_html(get_the_title($user_booking->ID)); ?>
							</p>
						</div>

						<div class="mkdf-tours-booking-info-item">
							<p>
								<span><?php esc_html_e('Booking ID:', 'mikado-tours'); ?></span>
								<?php echo esc_html($user_booking->id); ?>
							</p>
						</div>


						<div class="mkdf-tours-booking-info-item">
							<p>
								<span><?php esc_html_e('Departure Date:', 'mikado-tours'); ?></span>
								<?php echo esc_html(date(get_option('date_format'), strtotime($user_booking->booking_date))); ?>
							</p>
						</div>

						<?php if(!empty($user_booking->booking_time)) : ?>
							<div class="mkdf-tours-booking-info-item">
								<p>
									<span><?php esc_html_e('Departure Time:', 'mikado-tours'); ?></span>
									<?php echo esc_html('@ '.$user_booking->booking_time); ?>
								</p>
							</div>
						<?php endif; ?>

						<?php if(!empty($user_booking->amount)) : ?>
							<div class="mkdf-tours-booking-info-item">
								<p>
									<span><?php esc_html_e('Number of Tickets:', 'mikado-tours'); ?></span>
									<?php echo esc_html($user_booking->amount); ?>
								</p>
							</div>
						<?php endif; ?>

						<?php if(!empty($user_booking->payment_status)) : ?>
							<div class="mkdf-tours-booking-info-item">
								<p>
									<span><?php esc_html_e('Payment Status:', 'mikado-tours'); ?></span>
									<?php echo esc_html($user_booking->payment_status); ?>
								</p>
							</div>
						<?php endif; ?>

						<div class="mkdf-tours-booking-info-item">
							<p class="mkdf-membership-desc">
								<span><?php esc_html_e('Description:', 'mikado-tours'); ?></span>
								<?php echo get_the_excerpt($user_booking->ID); ?>
							</p>
						</div>

						<div class="mkdf-tours-booking-info-item">
							<p>
								<span><?php esc_html_e('Total Price:', 'mikado-tours'); ?></span>
								<span class="mkdf-tours-booking-price"><?php echo esc_html($user_booking->price); ?></span>
							</p>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p><?php esc_html_e("You still don't have any bookings.", 'mikado-tours'); ?></p>
	<?php endif; ?>
</div>

