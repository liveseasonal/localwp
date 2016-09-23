<?php

if ( ! function_exists('voyage_mikado_like') ) {
	/**
	 * Returns VoyageMikadoLike instance
	 *
	 * @return VoyageMikadoLike
	 */
	function voyage_mikado_like() {
		return VoyageMikadoLike::get_instance();
	}

}

function voyage_mikado_get_like() {

	echo wp_kses(voyage_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('voyage_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function voyage_mikado_like_latest_posts() {
		return voyage_mikado_like()->add_like();
	}

}