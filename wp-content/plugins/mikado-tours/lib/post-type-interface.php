<?php
namespace MikadofTours\Lib;

/**
 * interface PostTypeInterface
 * @package MikadofTours\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();

	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}