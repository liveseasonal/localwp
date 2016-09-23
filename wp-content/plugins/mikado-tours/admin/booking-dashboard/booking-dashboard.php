<?php

namespace MikadofTours\Admin\BookingDashboard;

class BookingSubmenuPage {

	const APPROVED = 'Approved';
	const CANCELED = 'Canceled';

	/**
	 * @var private instance of current class
	 */
	private static $instance;

	/**
	 * @var string Page Title
	 */
	private $page_title;

	/**
	 * @var string Page Slug
	 */
	private $page_slug;

	/**
	 * @var string User Permissions to access page
	 */
	private $permissions;

	/**
	 * @var string menu where page will be registered
	 */
	private $menu;

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
		$this->page_title  = esc_html__( 'Booking', 'mikado-tours' );
		$this->menu        = 'edit.php?post_type=tour-item';
		$this->permissions = 'manage_options';
		$this->page_slug   = 'mkdf-tours-booking';

		add_action( 'admin_menu', array( $this, 'registerSubmenuPage' ) );
		add_action( 'wp_ajax_mkdfToursChangeBookingStatus', array( $this, 'mkdfToursChangeBookingStatus' ) );
	}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}

	/**
	 * Returns current instance of class
	 * @return BookingSubmenuPage
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Register Submenu Page
	 */
	public function registerSubmenuPage() {

		add_submenu_page(
			$this->menu,
			$this->page_title,
			$this->page_title,
			$this->permissions,
			$this->page_slug,
			array( $this, 'renderSubmenuPage' )
		);

	}

	/**
	 * Render Submenu Page
	 */
	public function renderSubmenuPage() {

		$bookings_table = new ToursBookingTable();

		if(!empty($_GET['booking-id'])) {
			echo 'here';
		} else {		?>
		<div class="wrap">
			<div class="mkdf-booking-dashboard">
				<h2>Mikadof Tours Bookings</h2>
				<div class="mkdf-booking-dash-notice"></div>
				<div class="mkdf-booking-form-holder">
					<form method="post">
						<?php
						$bookings_table->prepare_items();
						$bookings_table->display();
						?>
					</form>
				</div>
			</div>
		</div>
		<?php
		}
	}

	/**
	 * Approve Booking
	 *
	 * Ajax Callable
	 */
	public function mkdfToursChangeBookingStatus() {

		if ( ! isset( $_POST ) ) {
			return;
		}

		$to         = $_POST['newStatus'];
		$booking_id = $_POST['bookingId'];

		if ( $to == 'approve' ) {
			$new_status = self::APPROVED;
		} elseif ( $to == 'cancel' ) {
			$new_status = self::CANCELED;
		}

		global $wpdb;
		$table = $wpdb->prefix . 'tour_bookings';

		$update = $wpdb->update(
			$table,
			array(
				'status' => $new_status
			),
			array(
				'id' => $booking_id
			)
		);

		if ( $update ) {
			$response = array(
				'message' => esc_html__( 'Booking Status successfully changed!', 'mikado-tours' ),
				'status'  => 'success',
			);
		} else {
			$response = array(
				'message' => esc_html__( 'Booking Status cannot be changed!', 'mikado-tours' ),
				'status'  => 'error'
			);
		}

		$response = json_encode( $response );
		exit( $response );

	}

}