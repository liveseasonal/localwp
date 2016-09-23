<?php
if(!function_exists('voyage_mikado_layerslider_overrides')) {
	/**
	 * Disables Layer Slider auto update box
	 */
	function voyage_mikado_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'voyage_mikado_layerslider_overrides');
}
?>