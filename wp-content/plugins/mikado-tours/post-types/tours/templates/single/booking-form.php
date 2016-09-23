<?php  ?>

<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">
	<h5 class="mkdf-tour-booking-title"><?php esc_html_e('Book this tour', 'mikado-tours'); ?></h5>
	<form id="mkdf-tour-booking-form" method="POST">
		<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" placeholder="<?php esc_attr_e('Name *', 'mikado-tours'); ?>" value="<?php echo esc_attr(mkdf_tours_get_current_user_name()); ?>" name="user_name">

			<span class="mkdf-tours-input-icon">
				<i class="lnr lnr-pencil"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" value="<?php echo esc_attr(mkdf_tours_get_current_user_email()); ?>" placeholder="<?php esc_attr_e('Email *', 'mikado-tours'); ?>" name="user_email">

			<span class="mkdf-tours-input-icon">
				<i class="lnr lnr-envelope"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" autocomplete="off"  value="" placeholder="<?php esc_attr_e('Confirm Email *', 'mikado-tours'); ?>" name="user_confirm_email">

			<span class="mkdf-tours-input-icon">
				<i class="lnr lnr-envelope"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" placeholder="<?php esc_attr_e('Phone', 'mikado-tours'); ?>" name="user_phone">

			<span class="mkdf-tours-input-icon">
				<i class="lnr lnr-phone-handset"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" class="mkdf-tour-period-picker" placeholder="<?php echo esc_attr('MM dd, yy *'); ?>" name="date">

			<span class="mkdf-tours-input-icon">
				<i class="lnr lnr-calendar-full"></i>
			</span>
		</div>

		<div id="mkdf-tour-booking-time-picker"></div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="number" name="number_of_tickets" min="1" placeholder="<?php esc_attr_e('Number of tickets *', 'mikado-tours'); ?>">

			<span class="mkdf-tours-input-icon">
				<i class="lnr lnr-user"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<textarea name="message" placeholder="<?php esc_attr_e('Message', 'mikado-tours'); ?>"></textarea>
		</div>

		<input type="hidden" name="tour_id" value="<?php echo esc_attr(get_the_ID()); ?>">

		<div id="booking-validation-messages-holder"></div>

		<script type="text/html" id="booking-validation-messages">
			<% if(typeof messages !== 'undefined' && messages.length) { %>
				<ul class="mkdf-tour-booking-validation-list mkdf-tour-message-<%= type %>">
					<% _.each(messages, function(message) { %>
						<li><%= message %></li>
					<% }) %>
				</ul>
			<% } %>
		</script>

		<script type="text/html" id="booking-time-template">
			<% if(typeof times !== 'undefined' && times.length) { %>
				<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
					<select name="time">
						<% _.each(times, function(time) { %>
							<option value="<%= time.time %>"><%= time.time %></option>
						<% }) %>
					</select>

					<span class="mkdf-tours-input-icon">
						<i class="lnr lnr-clock"></i>
					</span>
				</div>
			<% } %>
		</script>

		<?php if(mkdf_tours_theme_installed()) : ?>
			<?php echo voyage_mikado_execute_shortcode('mkdf_button', array(
				'text' => esc_html__('Check Availability', 'mikado-tours'),
				'size' => 'medium',
				'type' => 'grey',
				'custom_attrs' => array(
					'data-loading-label' => esc_attr__('Checking...', 'mikado-tours')
				),
				'custom_class' => 'mkdf-tours-check-availability'
			)); ?>
		<?php else: ?>
			<a href="#" class="mkdf-tours-check-availability"><?php esc_html_e('Check Availability', 'mikado-tours'); ?></a>
		<?php endif; ?>

		<?php if(mkdf_tours_theme_installed()) : ?>
			<?php echo voyage_mikado_execute_shortcode('mkdf_button', array(
				'html_type' => 'input',
				'input_name' => 'submit',
				'text' => esc_html__('Book now', 'mikado-tours'),
				'size' => 'medium',
				'custom_attrs' => array(
					'data-loading-label' => esc_attr__('Working...', 'mikado-tours'),
					'data-redirecting-label' => esc_attr__('Redirecting...', 'mikado-tours'),
					'disabled' => 'disabled'
				)
			)) ?>
		<?php else : ?>
			<input disabled data-redirecting-label="<?php esc_attr_e('Redirecting...', 'mikado-tours') ?>" data-loading-label="<?php esc_attr_e('Working...', 'mikado-tours'); ?>" type="submit" value="<?php echo esc_attr('Book now', 'mikado-tours'); ?>">
		<?php endif; ?>
	</form>
</div>
