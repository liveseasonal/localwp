<?php

namespace MikadofTours\DatabaseSetup;

class TourTimesTableSetup implements DatabaseTableSetup {
	private $tableName;
	private $version;
	private $versionOptionName;
	private $storedVersion;

	/**
	 * TourTimesTableSetup constructor.
	 */
	public function __construct() {
		global $wpdb;

		$this->tableName         = $wpdb->prefix.'tour_times';
		$this->version           = '0.1';
		$this->versionOptionName = 'mkdf_tour_times_table_version';

		$this->storedVersion = get_option($this->versionOptionName);
	}


	public function setup() {
		global $wpdb;

		$charsetCollate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $this->tableName (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				tour_date_id bigint(20) NOT NULL,
				time VARCHAR(5) NOT NULL,
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