<?php

if ( file_exists( '../../../../../wp-load.php' ) ) {
	require_once( '../../../../../wp-load.php' );
}

$sandbox = true;

// Build the required acknowledgement message out of the notification just received
$validate_ipn = array( 'cmd' => '_notify-validate' );

$post_data = wp_unslash( $_POST );
$validate_ipn += $post_data;

// Send back post vars to paypal
$params = array(
	'body'        => $validate_ipn,
	'timeout'     => 60,
	'httpversion' => '1.1',
	'compress'    => false,
	'decompress'  => false,
	'user-agent'  => 'MikadofTours/' . MIKADOF_TOURS_VERSION
);

// Post back to get a response.
$response = wp_safe_remote_post( $sandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr', $params );

if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 && strstr( $response['body'], 'VERIFIED' ) ) {

	$payment_status = strtolower( $post_data['payment_status'] );
	$receiver_email = $post_data['receiver_email'];

	if ( mkdf_tours_theme_installed() && voyage_mikado_options()->getOptionValue( 'paypal_facilitator_id' ) == $receiver_email ) {

		if ( $payment_status == 'completed' && $post_data['test_ipn'] == 1 ) {
			//Payment Completed, save to database

			//Payment data - status and date
			$payment_data = array(
				'payment_status' => 'completed',
				'payment_date' => $post_data['payment_date'],
				'transaction_id' => $post_data['txn_id']
			);
			//Booking data - user_id and tour_id
			$booking_data = json_decode( $post_data['custom'], true );

			mkdf_tours_paypal_payment_update_booking( $booking_data, $payment_data );

		}

	}


}