<?php

if(!function_exists('voyage_mikado_is_responsive_on')) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function voyage_mikado_is_responsive_on() {
		return voyage_mikado_options()->getOptionValue('responsiveness') !== 'no';
	}
}