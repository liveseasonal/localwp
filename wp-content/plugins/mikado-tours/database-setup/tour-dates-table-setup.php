<?php

namespace MikadofTours\DatabaseSetup;

class TourDatesTableSetup implements DatabaseTableSetup {
	private $tableName;
	private $version;
	private $versionOptionName;
	private $storedVersion;

	/**
	 * TourDatesTableSetup constructor.
	 */
	public function __construct() {
		global $wpdb;

		$this->tableName         = $wpdb->prefix.'tour_dates';
		$this->version           = '0.2';
		$this->versionOptionName = 'mkdf_tour_dates_table_version';

		$this->storedVersion = get_option($this->versionOptionName);
	}

	public function setup() {
		global $wpdb;

		$charsetCollate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $this->tableName (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				tour_id bigint(20) NOT NULL,
				start_date date NOT NULL,
				end_date date NOT NULL,
				price_change varchar(55) DEFAULT '' NOT NULL,
				number_of_tickets int(11) NOT NULL,
				days longtext NOT NULL,
				UNIQUE KEY id (id)
			) $charsetCollate;";


		if(!function_exists('dbDelta')) {
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		}

		dbDelta($sql);

		add_option($this->versionOptionName, $this->version);
	}

	public function getVersion() {
		return $this->version;
	}

	public function getStoredVersion() {
		return $this->storedVersion;
	}

	public function setStoredVersion($version) {
		if(empty($version)) {
			return false;
		}

		return update_option($this->versionOptionName, $version);
	}

	public function hasNewVersion() {
		return !empty($this->storedVersion) && ($this->storedVersion !== $this->version);
	}

	public function upgrade() {
		//here comes upgrade SQL code
		//it should be in the same format as sql in setup method
		//if you need to drop column you must use $wp_query as dbDelta function can't remove columns
		//before you write upgrade code upgrade table version in constructor
	}
}