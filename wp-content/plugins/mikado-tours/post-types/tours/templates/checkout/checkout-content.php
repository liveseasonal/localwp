<?php if($booking) : ?>

	<div class="mkdf-tours-checkout-content">
		<?php if($is_payment && $is_payment_sucessfull) : ?>
			<div class="mkdf-tours-success-payment-content">
				<p><?php esc_html_e('You have succcessfully completed payment process. Enjoy your tour!','mikado-tours'); ?></p>

				<div class="mkdf-tours-success-payment-button-holder">
					<?php if(mkdf_tours_theme_installed()) : ?>
						<?php echo voyage_mikado_get_button_html(array(
							'link' => home_url('/'),
							'text' => esc_html__('Return to home', 'mikado-tours')
						)); ?>
					<?php else: ?>
						<a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Pay with paypal', 'mikado-tours') ?></a>
					<?php endif; ?>
				</div>

			</div>
		<?php else : ?>
			<div class="mkdf-tours-checkout-content-inner">
				<div class="mkdf-tours-image-holder">
					<?php echo get_the_post_thumbnail($booking->ID,'voyage_landscape'); ?>					
					<div class="mkdf-tours-image-bckg" <?php voyage_mikado_inline_style($style);?>></div>
				</div>
				<div class="mkdf-tours-info-holder">
					<h2><?php echo get_the_title($booking->ID); ?></h2>

					<h6>
						<?php esc_html_e('You have successfully booked ','mikado-tours'); echo $booking->amount; esc_html_e(' ticket(s) for ','mikado-tours'); echo get_the_title($booking->ID); ?>
					</h6>
					<p class="mkdf-tours-info-description">
						<span><?php esc_html_e('Tour Description:','mikado-tours');?></span>
						<?php echo get_the_excerpt($booking->ID); ?>
					<p>
						<span><?php esc_html_e('Departure Date:', 'mikado-tours'); ?></span>
						<?php echo esc_html(date(get_option('date_format'), strtotime($booking->booking_date))); ?>
					</p>
					<p>
						<span><?php esc_html_e('Total Price:', 'mikado-tours'); ?></span>
						<span class="mkdf-tours-booking-price"><?php echo esc_html($booking->price); ?></span>
					</p>
					<?php if(mkdf_tours_paypal_enabled()) : ?>

						<?php

						$facilitator = mkdf_tours_get_paypal_facilitator_id();
						$currency    = mkdf_tours_get_paypal_currency();
						//Data for later use after completing payment
						$form_custom_data = array(
							'booking_hash' => $booking->unique_hash,
							'tour_id'      => $booking->ID
						);

						$form_data_string = json_encode($form_custom_data);
						?>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="first_name" value="<?php echo esc_attr($booking->user_name); ?>">
							<input type="hidden" name="email" value="<?php echo esc_attr($booking->user_email); ?>">
							<input type="hidden" name="quantity" value="1">
							<input type="hidden" name="item_name" value="<?php echo esc_attr(get_the_title($booking->ID)); ?>">
							<input type="hidden" name="amount" value="<?php echo esc_attr($booking->raw_price); ?>">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="charset" value="<?php bloginfo('charset'); ?>">
							<?php if($facilitator) { ?>
								<input type="hidden" name="business" value="<?php echo esc_attr($facilitator); ?>">
							<?php } ?>
							<input type="hidden" name="currency_code" value="<?php echo esc_html($currency); ?>">
							<input type="hidden" name="custom" value="<?php echo esc_attr($form_data_string); ?>">
							<input type="hidden" name="notify_url" value="<?php echo plugins_url().'/mkdf-tours/payment/paypal/ipn_listener.php'; ?>"/>
							<input type="hidden" name="return" value="<?php echo esc_url(add_query_arg(array('returned_from_payment' => 'true'), $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])); ?>">

							<?php if(mkdf_tours_theme_installed()) : ?>
								<?php echo voyage_mikado_get_button_html(array(
									'html_type' => 'button',
									'text'      => esc_html__('Pay with paypal', 'mikado-tours')
								)); ?>
							<?php else: ?>
								<button><?php esc_html_e('Pay with paypal', 'mikado-tours') ?></button>
							<?php endif; ?>
						</form>
					</div>
				</div>

			<?php endif; ?>

		<?php endif; ?>
	</div>
<?php endif; ?>