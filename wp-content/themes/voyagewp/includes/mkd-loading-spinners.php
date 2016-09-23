<?php

if(!function_exists('voyage_mikado_loading_spinners')) {
	function voyage_mikado_loading_spinners($return = false) {
		global $voyage_mikado_options;

		$spinner_html = '';
		$airplane_spinner_html = '';

		if(isset($voyage_mikado_options['smooth_pt_spinner_type'])) {

			switch($voyage_mikado_options['smooth_pt_spinner_type']) {
				case "airplane":
					$airplane_spinner_html = voyage_mikado_loading_spinner_airplane();
					break;
				case "pulse":
					$spinner_html = voyage_mikado_loading_spinner_pulse();
					break;
				case "double_pulse":
					$spinner_html = voyage_mikado_loading_spinner_double_pulse();
					break;
				case "cube":
					$spinner_html = voyage_mikado_loading_spinner_cube();
					break;
				case "rotating_cubes":
					$spinner_html = voyage_mikado_loading_spinner_rotating_cubes();
					break;
				case "stripes":
					$spinner_html = voyage_mikado_loading_spinner_stripes();
					break;
				case "wave":
					$spinner_html = voyage_mikado_loading_spinner_wave();
					break;
				case "two_rotating_circles":
					$spinner_html = voyage_mikado_loading_spinner_two_rotating_circles();
					break;
				case "five_rotating_circles":
					$spinner_html = voyage_mikado_loading_spinner_five_rotating_circles();
					break;
				case "atom":
					$spinner_html = voyage_mikado_loading_spinner_atom();
					break;
				case "clock":
					$spinner_html = voyage_mikado_loading_spinner_clock();
					break;
				case "mitosis":
					$spinner_html = voyage_mikado_loading_spinner_mitosis();
					break;
				case "lines":
					$spinner_html = voyage_mikado_loading_spinner_lines();
					break;
				case "fussion":
					$spinner_html = voyage_mikado_loading_spinner_fussion();
					break;
				case "wave_circles":
					$spinner_html = voyage_mikado_loading_spinner_wave_circles();
					break;
				case "pulse_circles":
					$spinner_html = voyage_mikado_loading_spinner_pulse_circles();
					break;
			}
		} else {
			$spinner_html = voyage_mikado_loading_spinner_airplane();
		}

		if($return === true) {
			return $spinner_html . $airplane_spinner_html ;
		}

		echo wp_kses($spinner_html, array(
			'div' => array(
				'class' => true,
				'style' => true,
				'id'    => true
			)
		));
	}
}
if(!function_exists('voyage_mikado_loading_spinner_airplane')) {
	function voyage_mikado_loading_spinner_airplane() {
		$html = '';
		$html .= '<div class="mkdf-plane-holder">';
		$html .= '<svg id="airplane" xmlns="http://www.w3.org/2000/svg" viewBox="-332 285.2 126.6 43.8"><path class="st0 path" stroke-dasharray="12" stroke-dashoffset="12" d="M-209.5,306v12"/><path class="st0 path" stroke-dasharray="12" stroke-dashoffset="12" d="M-209.5,305.9v-12"/><path class="st1" d="M-215.4 299.4c4.9 0 8.8 2.9 8.8 6.6 0 3.7-3.9 6.6-8.8 6.6"/><path class="st0" d="M-292.9 308.5h-2.4c-5.8 0-10.5-5.7-10.5-11.5v-4.1c0-3.6 3-6.6 6.6-6.6 3.4 0 6.2 2.8 6.2 6.2v16h.1z"/><path class="st1" d="M-292.9 292.6l7.8 6.6"/><path class="st0" d="M-224.7 318.3h-37.5s2.3-4.9 18.6-4.9 18.9 4.9 18.9 4.9zm0-26.6h-37.5s2.3-4.9 18.6-4.9 18.9 4.9 18.9 4.9z"/><path class="st0" d="M-256 314.4l-36.8-5.9.3-9.1h43.8v1.2c.3 3.7 3.5 6.7 7.3 6.7s6.9-2.8 7.3-6.5v-1.4h18.8v13.3l-14.3 2.5M-252.4 313.8v-22.1"/><path class="st0" d="M-234.6 313.8v-22.1l-17.6 22.2"/><circle class="st0" cx="-218.9" cy="323.8" r="4"/><line class="st0 smoke smoke1" x1="-320.1" y1="302.7" x2="-326.5" y2="302.7"/><path class="st0" d="M-215.8,313.4l-3.1,10.4l-3.6-9.4 M-292.6,299.4h-17.6 M-224.7,299.4v-7.7l-5.7,7.7"/><line class="st0 smoke smoke2" x1="-324.4" y1="297.4" x2="-330.8" y2="297.4"/><line class="st0 smoke smoke3" x1="-317.7" y1="292.2" x2="-324.1" y2="292.2"/><line class="st0 smoke smoke4" x1="-312.5" y1="295.9" x2="-318.9" y2="295.9" /></svg>';
		$html .='</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_pulse')) {
	function voyage_mikado_loading_spinner_pulse() {
		$html = '';
		$html .= '<div class="pulse"></div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_double_pulse')) {
	function voyage_mikado_loading_spinner_double_pulse() {
		$html = '';
		$html .= '<div class="double_pulse">';
		$html .= '<div class="double-bounce1"></div>';
		$html .= '<div class="double-bounce2"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_cube')) {
	function voyage_mikado_loading_spinner_cube() {
		$html = '';
		$html .= '<div class="cube"></div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_rotating_cubes')) {
	function voyage_mikado_loading_spinner_rotating_cubes() {
		$html = '';
		$html .= '<div class="rotating_cubes">';
		$html .= '<div class="cube1"></div>';
		$html .= '<div class="cube2"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_stripes')) {
	function voyage_mikado_loading_spinner_stripes() {
		$html = '';
		$html .= '<div class="stripes">';
		$html .= '<div class="rect1"></div>';
		$html .= '<div class="rect2"></div>';
		$html .= '<div class="rect3"></div>';
		$html .= '<div class="rect4"></div>';
		$html .= '<div class="rect5"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_wave')) {
	function voyage_mikado_loading_spinner_wave() {
		$html = '';
		$html .= '<div class="wave">';
		$html .= '<div class="bounce1"></div>';
		$html .= '<div class="bounce2"></div>';
		$html .= '<div class="bounce3"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_two_rotating_circles')) {
	function voyage_mikado_loading_spinner_two_rotating_circles() {
		$html = '';
		$html .= '<div class="two_rotating_circles">';
		$html .= '<div class="dot1"></div>';
		$html .= '<div class="dot2"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_five_rotating_circles')) {
	function voyage_mikado_loading_spinner_five_rotating_circles() {
		$html = '';
		$html .= '<div class="five_rotating_circles">';
		$html .= '<div class="spinner-container container1">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container2">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container3">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_atom')) {
	function voyage_mikado_loading_spinner_atom() {
		$html = '';
		$html .= '<div class="atom">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_clock')) {
	function voyage_mikado_loading_spinner_clock() {
		$html = '';
		$html .= '<div class="clock">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_mitosis')) {
	function voyage_mikado_loading_spinner_mitosis() {
		$html = '';
		$html .= '<div class="mitosis">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_lines')) {
	function voyage_mikado_loading_spinner_lines() {
		$html = '';
		$html .= '<div class="lines">';
		$html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_fussion')) {
	function voyage_mikado_loading_spinner_fussion() {
		$html = '';
		$html .= '<div class="fussion">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_wave_circles')) {
	function voyage_mikado_loading_spinner_wave_circles() {
		$html = '';
		$html .= '<div class="wave_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('voyage_mikado_loading_spinner_pulse_circles')) {
	function voyage_mikado_loading_spinner_pulse_circles() {
		$html = '';
		$html .= '<div class="pulse_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}
