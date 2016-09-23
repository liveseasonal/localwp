<?php

namespace MikadofTours\CPT\Tours\Lib;

class TourPagination {

	private $perPage;
	private $total;
	private $range;
	private $numberOfPages;
	private $currentPage;

	/**
	 * TourPagination constructor.
	 *
	 * @param $perPage
	 * @param $total
	 * @param int $range
	 * @param int $currentPage
	 */
	public function __construct($perPage, $total, $currentPage = 1, $range = 4) {
		$this->setPerPage($perPage);
		$this->setTotal($total);
		$this->setRange($range);
		$this->setNumberOfPages();
		$this->setCurrentPage($currentPage);
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPage() {
		return $this->currentPage;
	}

	/**
	 * @param mixed $currentPage
	 */
	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
	}

	/**
	 *
	 */
	public function setNumberOfPages() {
		$this->numberOfPages = ceil($this->total / $this->perPage);
	}

	/**
	 * @param mixed $range
	 */
	public function setRange($range) {
		$this->range = is_int($range) ? $range : 4;
	}

	/**
	 * @param mixed $perPage
	 */
	public function setPerPage($perPage) {
		$this->perPage = is_int((int) $perPage) ? (int) $perPage : get_option('posts_per_page');
	}

	/**
	 * @param mixed $total
	 */
	public function setTotal($total) {
		$this->total = $total;
	}

	/**
	 * @return mixed
	 */
	public function getPerPage() {
		return $this->perPage;
	}

	/**
	 * @return mixed
	 */
	public function getRange() {
		return $this->range;
	}

	/**
	 * @return mixed
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfPages() {
		return $this->numberOfPages;
	}

	public function hasPrev() {
		return $this->currentPage > 1;
	}

	public function hasNext() {
		return $this->currentPage < $this->numberOfPages;
	}

	public function paginate() {
		$params = array(
			'number_of_pages' => $this->numberOfPages,
			'total'           => $this->total,
			'range'           => $this->range,
			'has_prev'        => $this->hasPrev(),
			'has_next'        => $this->hasNext(),
			'current_page'    => $this->currentPage
		);

		return mkdf_tours_get_tour_module_template_part('templates/search/pagination', 'tours', '', '', $params);
	}
}