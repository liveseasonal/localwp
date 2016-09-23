<?php

namespace MikadofTours\DatabaseSetup;

/**
 * Interface DatabaseTableSetup
 * @package MikadofTours\DatabaseTables
 */
interface DatabaseTableSetup {
	/**
	 * Creates table
	 *
	 * @return mixed
	 */
	public function setup();

	/**
	 * Returns current table version
	 *
	 * @return mixed
	 */
	public function getVersion();

	/**
	 * Returns table version that is stored in options
	 * It will be used to determine if we have new table version,
	 * and if we need to update table to the latest version
	 *
	 * @return mixed
	 */
	public function getStoredVersion();

	/**
	 * Stores table version to options
	 *
	 * @param $version
	 *
	 * @return mixed
	 */
	public function setStoredVersion($version);

	public function hasNewVersion();

	public function upgrade();
}