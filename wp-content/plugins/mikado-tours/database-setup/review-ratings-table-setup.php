<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/29/2016
 * Time: 10:14 AM
 */

namespace MikadofTours\DatabaseSetup;


class ReviewRatingsTableSetup implements DatabaseTableSetup {
	private $tableName;
	private $version;
	private $versionOptionName;
	private $storedVersion;

	/**
	 * ReviewCriteriaTableSetup constructor.
	 */
	public function __construct() {
		global $wpdb;

		$this->tableName         = $wpdb->prefix.'review_ratings';
		$this->version           = '0.1';
		$this->versionOptionName = 'mkdf_review_ratings_version';

		$this->storedVersion = get_option($this->versionOptionName);
	}


	/**
	 * Creates table
	 *
	 * @return mixed
	 */
	public function setup() {
		global $wpdb;

		$charsetCollate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $this->tableName (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				comment_id bigint(20) NOT NULL,
				criteria_id bigint(20) NOT NULL,
				rating int(3) NOT NULL,
				UNIQUE KEY id (id)
			) $charsetCollate;";

		if(!function_exists('dbDelta')) {
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		}

		dbDelta($sql);

		add_option($this->versionOptionName, $this->version);
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

	public function hasNewVersion() {
		return !empty($this->storedVersion) && ($this->storedVersion !== $this->version);
	}

	public function upgrade() {
		// TODO: Implement upgrade() method.
	}
}