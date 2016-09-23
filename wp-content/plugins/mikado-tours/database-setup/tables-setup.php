<?php

namespace MikadofTours\DatabaseSetup;

/**
 * Class TablesSetup
 * @package MikadofTours\DatabaseSetup
 */
class TablesSetup {
	/**
	 * @var private instance of current class
	 */
	private static $instance;

	/**
	 * @var
	 */
	private $tables;

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
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
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * @return bool
	 */
	public function hasTables() {
		return is_array($this->tables) && count($this->tables);
	}

	public function initialize() {
		$this->addTables();

		register_activation_hook(MIKADOF_TOURS_MAIN_FILE_PATH, array($this, 'onActivate'));
		register_deactivation_hook(MIKADOF_TOURS_MAIN_FILE_PATH, array($this, 'onDeactivate'));

		add_action('plugins_loaded', array($this, 'upgrade'));
	}

	/**
	 * Goes through all tables and initializes them
	 *
	 * @return bool
	 */
	public function onActivate() {
		if(!$this->hasTables()) {
			return false;
		}

		foreach($this->tables as $table) {
			$this->setupTable($table);
		}
	}

	public function upgrade() {
		if(!$this->hasTables()) {
			return false;
		}

		foreach($this->tables as $table) {
			if(!$table->hasNewVersion()) {
				return false;
			}

			$table->upgrade();
		}
	}

	public function onDeactivate() {
		//doesn't have an implementation yet
	}

	/**
	 * Add all table objects to tables array
	 */
	private function addTables() {
		$this->addTable(new TourDatesTableSetup());
		$this->addTable(new TourTimesTableSetup());
		$this->addTable(new TourBookingsTableSetup());
		$this->addTable(new ReviewRatingsTableSetup());
	}

	/**
	 * @param $table
	 */
	private function addTable(DatabaseTableSetup $table) {
		$this->tables[] = $table;
	}

	/**
	 * @param $table
	 *
	 * @return bool
	 */
	private function setupTable(DatabaseTableSetup $table) {
		return $table->setup();
	}
}