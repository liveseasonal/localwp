<?php

namespace MikadofTours\Admin\BookingDashboard;

if(!class_exists('WP_List_Table')) {
	require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}

use WP_List_Table;

class ToursBookingTable extends WP_List_Table {

	public function __construct() {
		parent::__construct(
			array(
				'plural'   => esc_html__('Bookings', 'mikado-tours'),
				'singular' => esc_html__('Booking', 'mikado-tours'),
				'ajax'     => false
			)
		);
	}

	/**
	 * Return All Bookings. Query Database.
	 *
	 * @return array|null|object
	 */
	public function getBookings() {
		global $wpdb;

		$table_name = $wpdb->prefix.'tour_bookings';

		$sql = "SELECT * FROM ".$table_name." ORDER BY id DESC";

		$result = $wpdb->get_results($sql, 'ARRAY_A');

		return $result;

	}

	/**
	 * Delete a Booking
	 *
	 * @param int $id customer ID
	 */
	public function deleteBooking($id) {
		global $wpdb;

		$wpdb->delete(
			$wpdb->prefix.'tour_bookings',
			array(
				'id' => $id
			)
		);
	}

	/**
	 * This method is called when the parent class can't find a method
	 * specifically build for a given column. Generally, it's recommended to include
	 * one method for each column you want to render, keeping your package class
	 * neat and organized. For example, if the class needs to process a column
	 * named 'title', it would first see if a method named $this->column_title()
	 * exists - if it does, that method will be used.
	 *
	 * WP_List_Table::single_row_columns()
	 *
	 * @param object $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default($item, $column_name) {
		switch($column_name) {
			case 'booking_info':
				$name = $item['user_name'];
				$email = $item['user_email'];
				$phone = $item['user_phone'];

				?>
				<p>#<?php echo esc_html($item['id']); ?> <?php esc_html_e('by','mikado-tours'); ?> <?php echo esc_html($name); ?></p>
				<a href="mailto: <?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>

				<?php if($phone) : ?>
				<a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
			<?php endif; ?>
				<?php
				break;
			case 'tour_id':
				$tour_id = $item[$column_name];

				return '<a href="'.get_permalink($tour_id).'">'.get_the_title($tour_id).'</a>';
			case 'booking_date':
				$database_date = $item[$column_name];
				$time          = strtotime($database_date);
				$date          = date(get_option('date_format'), $time);

				$databaseTime = $item['booking_time'];

				if($databaseTime !== '') {
					$date .= ' @ '.$databaseTime;
				}

				return $date;
			case 'amount':
				$amount = (int) $item['amount'];

				$amountLabel = $amount === 1 ? esc_html__('ticket', 'mikado-tours') : esc_html__('tickets', 'mikado-tours');

				return $amount.' '.$amountLabel;
			case 'price':
				return $item['price'];
			case 'status':
				$status = strtolower($item[$column_name]);
				$html   = '<span class="status '.$status.'">'.$item[$column_name].'</span>';

				return $html;
			case 'payment_status':
				return $item[$column_name];
			case 'user_message':
				?>
				<p><?php echo wp_kses_post($item['user_message']); ?></p>
				<?php
				break;
			case 'actions':
				$status  = strtolower($item['status']);
				$item_id = $item['id'];

				$buttons = array(
					'approved' => '<a href="#" class="mkdf-booking-table-action-btn approve-booking" data-booking-id="'.$item_id.'" title="'.esc_html__('Approve', 'mikado-tours').'"><i class="dashicons dashicons-yes"></i></a>',
					'canceled' => '<a href="#" class="mkdf-booking-table-action-btn cancel-booking" data-booking-id="'.$item_id.'" title="'.esc_html__('Cancel', 'mikado-tours').'"><i class="dashicons dashicons-no-alt"></i></a>'
				);
				if(array_key_exists($status, $buttons)) {
					$buttons[$status] = '';
				}

				$html = '';
				foreach($buttons as $button) {
					$html .= $button;
				}

				return $html;
			default:
				return print_r($item, true); //Show the whole array for troubleshooting purposes
		}
	}

	/**
	 * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
	 * is given special treatment when columns are processed. It ALWAYS needs to
	 * have it's own method.
	 *
	 * @see WP_List_Table::::single_row_columns()
	 *
	 * @param object $item
	 *
	 * @return mixed
	 */
	function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			$this->_args['singular'],
			$item['id']
		);
	}

	/**
	 * Required method. Dictates table's columns and titles.
	 *
	 * If we include a checkbox column in table we must create column_cb() method
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = array(
			'cb'             => '<input type="checkbox" />', //Render a checkbox instead of text
			'booking_info'   => esc_html__('Booking Info', 'mikado-tours'),
			'tour_id'        => esc_html__('Tour Name', 'mikado-tours'),
			'booking_date'   => esc_html__('Date', 'mikado-tours'),
			'amount'         => esc_html__('Amount', 'mikado-tours'),
			'price'          => esc_html__('Price', 'mikado-tours'),
			'status'         => esc_html__('Booking Status', 'mikado-tours'),
			'payment_status' => esc_html__('Payment Status', 'mikado-tours'),
			'user_message'   => esc_html__('User Message', 'mikado-tours'),
			'actions'        => esc_html__('Actions', 'mikado-tours'),
		);

		return $columns;
	}

	/**
	 * Define sortable columns
	 *
	 * @return array
	 */
	function get_sortable_columns() {
		$sortable_columns = array(
			'date'           => array('date', false),
			'status'         => array('status', false),
			'payment_status' => array('payment_status', false)
		);

		return $sortable_columns;
	}

	/**
	 * Include Bulk Actions
	 *
	 * @return array
	 */
	function get_bulk_actions() {
		$actions = array(
			'mkdf-booking-delete' => 'Delete'
		);

		return $actions;
	}

	/**
	 * Process Bulk Actions
	 */
	function process_bulk_action() {

		if('mkdf-booking-delete' === $this->current_action()) {
			if(isset($_POST['booking'])) {

				//Delete bookings
				$bookings = $_POST['booking'];
				foreach($bookings as $booking) {
					$this->deleteBooking($booking);
				}

			}


		}

	}

	/**
	 * Required function for displaying data. Sort and filter data.
	 */
	function prepare_items() {

		/**
		 * Records per page to show
		 */
		$per_page = 5;

		/**
		 * Column headers
		 */
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);

		/**
		 * Handle Bulk Actions
		 */
		$this->process_bulk_action();


		/**
		 * Get Data from Database
		 */
		$data = $this->getBookings();

		/**
		 * Required for pagination
		 */
		$current_page = $this->get_pagenum();
		$total_items  = count($data);

		/**
		 * Pagination
		 */
		$data = array_slice($data, (($current_page - 1) * $per_page), $per_page);


		/**
		 * Add sorted data to items property, so rest of class can use it
		 */
		$this->items = $data;


		/**
		 * REQUIRED. We also have to register our pagination options & calculations.
		 */
		$this->set_pagination_args(array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil($total_items / $per_page)
		));
	}

}