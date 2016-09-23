<?php
namespace MikadofTours\CPT\Tours\Lib;

/**
 * Class TourSearch
 * @package MikadofTours\CPT\Tours\Lib
 */
class TourSearch {
	/**
	 * @var private instance of current class
	 */
	private static $instance;

	/**
	 * Array of checked tour types
	 * @var
	 */
	private $tourTypes;

	/**
	 * Tour keyword string
	 * @var
	 */
	private $keyword;

	/**
	 * Destination keyword string
	 * @var
	 */
	private $destinationKeyword;

	/**
	 * Start or end month for tour period
	 * @var
	 */
	private $month;

	/**
	 * Number of tour tickets
	 * @var
	 */
	private $numberOfTickets;

	/**
	 * Minimal price for tour per person
	 * @var
	 */
	private $minPrice;

	/**
	 * Maximum price for tour per person
	 * @var
	 */
	private $maxPrice;

	/**
	 * For which property to sort results
	 * @var
	 */
	private $orderBy;

	/**
	 * Whether to sort them ascending or desdending
	 * @var
	 */
	private $orderType;

	/**
	 * HTML tour item type
	 * @var
	 */
	private $viewType;

	/**
	 * How much tours per page
	 * @var
	 */
	private $toursPerPage;

	/**
	 * Current page in pagination
	 * @var
	 */
	private $currentPage;

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
		$this->setPropertiesFromRequest();
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
	 * @return mixed
	 */
	public function getCurrentPage() {
		return $this->currentPage;
	}

	/**
	 * @return mixed
	 */
	public function getTourTypes() {
		return $this->tourTypes;
	}

	/**
	 * @return mixed
	 */
	public function getKeyword() {
		return $this->keyword;
	}

	/**
	 * @return mixed
	 */
	public function getDestinationKeyword() {
		return $this->destinationKeyword;
	}

	/**
	 * @return mixed
	 */
	public function getMonth() {
		return $this->month;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfTickets() {
		return $this->numberOfTickets;
	}

	/**
	 * @return mixed
	 */
	public function getMinPrice() {
		return $this->minPrice;
	}

	/**
	 * @return mixed
	 */
	public function getMaxPrice() {
		return $this->maxPrice;
	}

	/**
	 * @return mixed
	 */
	public function getOrderBy() {
		return $this->orderBy;
	}

	/**
	 * @return mixed
	 */
	public function getOrderType() {
		return $this->orderType;
	}

	/**
	 * @return mixed
	 */
	public function getViewType() {
		return $this->viewType;
	}

	/**
	 * @return mixed
	 */
	public function getToursPerPage() {
		return $this->toursPerPage;
	}

	/**
	 * Returns current instance of class
	 * @return TourSearch
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Hooks form handled method to WP ajax actions
	 */
	public function initialize() {
		add_action('wp_ajax_tours_search_handle_form_submission', array($this, 'handleFormSubmission'));
		add_action('wp_ajax_nopriv_tours_search_handle_form_submission', array($this, 'handleFormSubmission'));
	}

	/**
	 * Handles form submission. Calls method
	 * that returns result and returns response as json
	 */
	public function handleFormSubmission() {
		$request      = $this->getCurrentRequest();
		$results      = $this->search();
		$returnObject = new \stdClass();

		$returnObject->html           = mkdf_tours_get_search_page_items_loop_html($results, $request['view_type']);
		$returnObject->url            = $this->buildQueryString($request);
		$returnObject->paginationHTML = mkdf_tours_get_search_pagination();

		echo json_encode($returnObject);
		exit;
	}

	/**
	 * Returns checked tour types
	 * @return array
	 */
	public function getTourCheckedTypes() {
		$types = empty($_GET['type']) ? array() : $_GET['type'];

		return $types;
	}

	/**
	 * Method that returns result set
	 * as an array of WP_Post objects
	 *
	 * @return array
	 */
	public function search() {
		$this->setPropertiesFromRequest();

		$results    = $this->getResults();
		$postsArray = array();

		if(is_array($results) && count($results)) {
			foreach($results as $result) {
				$postsArray[] = $this->generatePostObject($result);
			}
		}

		return $postsArray;
	}

	/**
	 * Queries the database for tours
	 * based on current request.
	 *
	 * @param bool $count whether we are counting tours or we are returning result set
	 *
	 * @return array|null|object
	 */
	public function getResults($count = false) {
		global $wpdb;

		$join  = array();
		$where = array("WHERE {$wpdb->prefix}posts.post_type = 'tour-item' AND {$wpdb->prefix}posts.post_status = 'publish'");

		$from         = "FROM {$wpdb->prefix}posts";
		$prepareArray = array(); //it will be used for $wpdb->prepare method

		if(!$count) {
			$select   = array("SELECT {$wpdb->prefix}posts.*");
			$select[] = "{$wpdb->prefix}postmeta.meta_value as price";
			$select[] = "{$wpdb->prefix}tour_dates.start_date";
			$select[] = "{$wpdb->prefix}terms.slug AS term_slug";
		} else {
			$select = array("SELECT COUNT({$wpdb->prefix}posts.ID) AS count");
		}

		$join[] = "LEFT JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID";
		$join[] = "LEFT JOIN {$wpdb->prefix}postmeta AS destinationmeta ON {$wpdb->prefix}postmeta.post_id = destinationmeta.post_id";

		if(!empty($this->minPrice) && !empty($this->maxPrice)) {
			$where[] = "CAST({$wpdb->prefix}postmeta.meta_value AS UNSIGNED) >= %d AND CAST({$wpdb->prefix}postmeta.meta_value AS UNSIGNED) <= %d";

			$prepareArray[] = (int) $this->minPrice; //for min price
			$prepareArray[] = (int) $this->maxPrice; //for max price
		}

		$postMetaKeyIn = array();
		if($this->destinationKeyword !== '') {
			$subQuery = "SELECT destinationpost.ID
						 FROM {$wpdb->prefix}posts
						 LEFT JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
						 LEFT JOIN {$wpdb->prefix}posts as destinationpost ON destinationpost.ID = {$wpdb->prefix}postmeta.meta_value
						 WHERE destinationpost.post_type='destinations' 
						 AND wp_postmeta.meta_key = 'mkdf_tours_destination' 
						 AND destinationpost.post_title LIKE '%s'";

			$prepareArray[] = "%{$wpdb->esc_like($this->destinationKeyword)}%";
			$where[]        = "destinationmeta.meta_value IN ({$subQuery})";
		}

		$postMetaKeyIn['mkdf_tours_price'] = 'mkdf_tours_price';

		$where[]      = "{$wpdb->prefix}postmeta.meta_key IN (".implode(', ', array_fill(0, count($postMetaKeyIn), '%s')).")";
		$prepareArray = array_merge($prepareArray, $postMetaKeyIn);

		$join[] = "LEFT JOIN {$wpdb->prefix}tour_dates ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}tour_dates.tour_id";
		if(!empty($this->month)) {
			$where[] = "(MONTH({$wpdb->prefix}tour_dates.start_date) = %d OR MONTH({$wpdb->prefix}tour_dates.end_date) = %d)";

			$prepareArray[] = $this->month; //for start date
			$prepareArray[] = $this->month; // for end date
		}

		$join[] = "LEFT JOIN {$wpdb->prefix}term_relationships ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id";
		$join[] = "LEFT JOIN {$wpdb->prefix}term_taxonomy ON {$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id";
		$join[] = "LEFT JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id";
		if(is_array($this->tourTypes) && count($this->tourTypes)) {
			$where[] = "{$wpdb->prefix}terms.slug IN (".implode(', ', array_fill(0, count($this->tourTypes), '%s')).")";

			//we need to merge current prepare array and checked tour types
			//because $wpdb->prepare method accepts only one array
			$prepareArray = array_merge($prepareArray, $this->tourTypes);
		}

		if(!empty($this->keyword)) {
			$where[] = "{$wpdb->prefix}posts.post_title LIKE '%s'";

			//we are using esc_like because $wpdb->prepare assummes that
			//all '%' are placeholders
			$prepareArray[] = "%{$wpdb->esc_like($this->keyword)}%";
		}

		switch($this->orderBy) {
			case 'date':
				$orderTableField = "{$wpdb->prefix}tour_dates.start_date";
				break;
			case 'price':
				//we need to cast it to positive integer
				//because it needs to sorted as integer, not as a string
				$orderTableField = "CAST({$wpdb->prefix}postmeta.meta_value AS UNSIGNED)";
				break;
			case 'name':
				$orderTableField = "{$wpdb->prefix}posts.post_title";
				break;
		}

		$order = "ORDER BY {$orderTableField} {$this->orderType}";

		$sql = implode(', ', $select).' '.$from.' '.implode(' ', $join).' '.implode(' AND ', $where);
		$sql .= " GROUP BY {$wpdb->prefix}posts.ID";

		if(!$count) {
			$sql .= " ".$order;
			$sql .= " LIMIT {$this->toursPerPage}";
			$sql .= " OFFSET ".$this->toursPerPage * ($this->currentPage - 1);
		}

		//$wpdb->prepare can't be called
		//with an empty array so we must check
		//if prepare array has any members
		if(count($prepareArray)) {
			$results = $wpdb->get_results($wpdb->prepare($sql, $prepareArray));
		} else {
			$results = $wpdb->get_results($sql);
		}

		return $results;
	}

	/**
	 * Sets properties from parsed request.
	 * These properties are later used in other methods
	 * for accessing current current request data
	 */
	private function setPropertiesFromRequest() {
		$request = $this->getCurrentRequest();

		$defaultViewType  = 'list';
		$defaultOrderBy   = 'date';
		$defaultOrderType = 'desc';

		if(mkdf_tours_theme_installed()) {
			$defaultViewType = voyage_mikado_options()->getOptionValue('tours_search_default_view_type');

			$orderingOption = voyage_mikado_options()->getOptionValue('tours_search_default_ordering');

			switch($orderingOption) {
				case 'date':
					$defaultOrderBy   = 'date';
					$defaultOrderType = 'desc';
					break;
				case 'price_low':
					$defaultOrderBy   = 'price';
					$defaultOrderType = 'asc';
					break;
				case 'price_high':
					$defaultOrderBy   = 'price';
					$defaultOrderType = 'desc';
					break;
				case 'name':
					$defaultOrderBy   = 'name';
					$defaultOrderType = 'asc';
					break;
			}
		}

		//this is commented since every type will return int value for key and type search will not work
//		if(isset($request['type']) && is_array($request['type']) && count($request['type'])) {
//			foreach($request['type'] as $type_slug => $type) {
//				if(is_int($type_slug)) {
//					unset($request['type'][$type_slug]);
//				}
//			}
//		}

		$this->tourTypes          = isset($request['type']) && is_array($request['type']) && count($request['type']) ? $request['type'] : array() ;
		$this->keyword            = empty($request['keyword']) ? '' : $request['keyword'];
		$this->destinationKeyword = empty($request['destination']) ? '' : $request['destination'];
		$this->month              = empty($request['month']) ? '' : $request['month'];
		$this->numberOfTickets    = empty($request['number_of_tickets']) ? 1 : $request['number_of_tickets'];
		$this->minPrice           = empty($request['min_price']) ? '' : $request['min_price'];
		$this->maxPrice           = empty($request['max_price']) ? '' : $request['max_price'];
		$this->orderBy            = empty($request['order_by']) ? $defaultOrderBy : $request['order_by'];
		$this->orderType          = empty($request['order_type']) ? $defaultOrderType : $request['order_type'];
		$this->currentPage        = empty($request['page']) ? 1 : $request['page'];
		$this->viewType           = empty($request['view_type']) ? $defaultViewType : $request['view_type'];

		if(mkdf_tours_theme_installed()) {
			$this->toursPerPage = voyage_mikado_options()->getOptionValue('tours_per_page');

		} else {
			$this->toursPerPage = apply_filters('mkdf_tours_search_per_page', 12);
		}
	}

	/**
	 * Takes an object of stdClass and returns an object of WP_Post class
	 *
	 * @param \stdClass $result
	 *
	 * @return \WP_Post
	 */
	private function generatePostObject($result) {
		$post = new \WP_Post($result);

		return $post;
	}

	/**
	 * Builds 'get' http method query string from provided request
	 *
	 * @param array $request
	 *
	 * @return mixed
	 */
	private function buildQueryString($request) {
		return http_build_query($request);
	}

	/**
	 * Returns total number of results for current request
	 *
	 * @return mixed
	 */
	public function getTotal() {
		$results = $this->getResults(true);

		return count($results);
	}

	/**
	 * Parses current request and returns it as array.
	 * It first checks if $_GET has fields property.
	 * If it has than it is an AJAX request.
	 * If it does'nt has 'fields' property than it assumes
	 * that it is normal 'get' request and it returns
	 * $_GET super global
	 *
	 * @return array
	 */
	private function getCurrentRequest() {
		$request = array();

		if(empty($_GET['fields'])) {
			$request = $_GET;

			return $request;
		} else {
			parse_str($_GET['fields'], $request);

			return $request;
		}
	}
}