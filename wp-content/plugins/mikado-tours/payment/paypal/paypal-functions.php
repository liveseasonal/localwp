<?php

if(!function_exists('mkdf_tours_paypal_payment_update_booking')) {
	/**
	 * Save completed payment to database
	 *
	 * @param $booking_data array
	 * @param $payment_data array
	 */
	function mkdf_tours_paypal_payment_update_booking($booking_data, $payment_data) {
		global $wpdb;

		$table          = $wpdb->prefix.'tour_bookings';
		$unique_hash    = $booking_data['booking_hash'];
		$tour_id        = $booking_data['tour_id'];
		$payment_status = $payment_data['payment_status'];
		$transaction_id = $payment_data['transaction_id'];

		//Convert date
		$date = new DateTime($payment_data['payment_date']);
		$date->setTimezone(new DateTimezone('UTC'));
		$payment_date = $date->format('Y-m-d\TH:i:s\Z');

		$wpdb->update(
			$table,
			array(
				'payment_date'   => $payment_date,
				'payment_status' => $payment_status,
				'transaction_id' => $transaction_id,
			),
			array(
				'unique_hash' => $unique_hash,
				'tour_id'     => $tour_id
			)
		);

	}

}