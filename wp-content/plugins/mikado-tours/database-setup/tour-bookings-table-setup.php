<?php

namespace MikadofTours\DatabaseSetup;

class TourBookingsTableSetup implements DatabaseTableSetup {
	private $tableName;
	private $version;
	private $versionOptionName;
	private $storedVersion;

	/**
	 * TourBookingsTableSetup constructor.
	 */
	public function __construct() {
		global $wpdb;

		$this->tableName         = $wpdb->prefix.'tour_bookings';
		$this->version           = '0.1';
		$this->versionOptionName = 'mkdf_tour_bookings_table_version';

		$this->storedVersion = get_option($this->versionOptionName);
	}


	public function setup() {
		global $wpdb;

		$charsetCollate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $this->tableName (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				unique_hash VARCHAR(255) NOT NULL,
				booking_number VARCHAR(255) NOT NULL, 
				user_id bigint(20),
				tour_id bigint(20) NOT NULL,
				user_name VARCHAR(255) NOT NULL,
				user_email VARCHAR(255) NOT NULL,
				user_phone VARCHAR(255),
				user_message TEXT,
				booking_date date NOT NULL,
				booking_time VARCHAR(5) NOT NULL,		
				amount INT(11) NOT NULL,
				price VARCHAR(255) NOT NULL, 
				raw_price VARCHAR(255) NOT NULL, 
				status VARCHAR(255) NOT NULL,
				payment_status VARCHAR(255),
				payment_date DATETIME,
				transaction_id VARCHAR(255),
				created_at DATETIME NOT NULL,
				UNIQUE KEY id (id)
			) $charsetCollate;";

		if(!function_exists('dbDelta')) {
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		}

		dbDelta($sql);

		add_option($this->versionOptionName, $this->version);
	}

	/**
	 * @return mixed
	 */
	public function upgrade() {
		//here comes upgrade SQL code
		//it should be in the same format as sql in setup method
		//if you need to drop column you must use $wp_query as dbDelta function can't remove columns
		//before you write upgrade code upgrade table version in constructor
	}

	/**
	 * Returns current table version
	 *
	 * @return mixed
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Returns table version that is stored in options
	 * It will be used to determine if we have new table version,
	 * and if we need to update table to the latest version
	 *
	 * @return mixed
	 */
	public function getStoredVersion() {
		return $this->storedVersion;
	}

	/**
	 * Stores table version to options
	 *
	 * @param $version
	 *
	 * @return mixed
	 */
	public function setStoredVersion($version) {
		if(empty($version)) {
			return false;
		}

		return update_option($this->versionOptionName, $version);
	}

	/**
	 * @return mixed
	 */
	public function hasNewVersion() {
		return !empty($this->storedVersion) && ($this->storedVersion !== $this->version);
	}
}