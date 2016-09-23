<?php

/**
 * Widget that adds weather type
 *
 * Class Weather_Widget
 */
class VoyageMikadoWeatherWidget extends VoyageMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkdf_weather_widget', // Base ID
            'Mikado Weather Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $app_link     = 'http://openweathermap.org/appid#get';
        $app_location = 'http://openweathermap.org/find';

        $this->params = array(
            array(
                'type'  => 'textfield',
                'title' => 'Widget Title',
                'name'  => 'widget_title'
            ),
            array(
                'type'        => 'textfield_html',
                'title'       => 'API Key',
                'name'        => 'api_key',
                'description' => '<a href="'.esc_url($app_link).'" target="_blank">How to get API key</a>'
            ),
            array(
                'type'        => 'textfield_html',
                'title'       => 'Location',
                'name'        => 'location',
                'description' => '<a href="'.esc_url($app_location).'" target="_blank">Find Your Location (i.e: London,UK or New York City,NY)</a>'
            ),
            array(
                'type'    => 'dropdown',
                'title'   => 'Temperature Unit',
                'name'    => 'units',
                'options' => array(
                    'metric'   => 'Metric',
                    'imperial' => 'Imperial',
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => 'Time zone',
                'name'    => 'time_zone',
                'options' => array(
                    '0' => 'UTC',
                    '1' => 'GMT',
                )
            ),
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        $api_key = '';
        if(!empty($instance['api_key']) && $instance['api_key'] !== '') {
            $api_key = $instance['api_key'];
        }

        $location = '';
        if(!empty($instance['location']) && $instance['location'] !== '') {
            $location = $instance['location'];
        }

        $units = '';
        if(!empty($instance['units']) && $instance['units'] !== '') {
            $units = $instance['units'];
        }

        $time_zone = '';
        if(!empty($instance['time_zone']) && $instance['time_zone'] !== '') {
            $time_zone = $instance['time_zone'];
        }

        print $args['before_widget'];
        if(!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            print $args['before_title'].$instance['widget_title'].$args['after_title'];
        }
        echo voyage_mikado_weather_widget_logic(
            array(
                'api_key'   => $api_key,
                'location'  => $location,
                'units'     => $units,
                'time_zone' => $time_zone,
            )
        );
        print $args['after_widget'];
    }
}

// the logic
function voyage_mikado_weather_widget_logic($atts) {

    $html         = "";
    $weather_data = array();
    $api_key      = isset($atts['api_key']) ? $atts['api_key'] : false;
    $location     = isset($atts['location']) ? $atts['location'] : false;
    $units        = isset($atts['units']) ? $atts['units'] : false;
    $time_zone    = isset($atts['time_zone']) ? $atts['time_zone'] : false;
    $days_to_show = 5;
    $locale       = 'en';

    $sytem_locale      = get_locale();
    $available_locales = array(
        'en',
        'es',
        'sp',
        'fr',
        'it',
        'de',
        'pt',
        'ro',
        'pl',
        'ru',
        'uk',
        'ua',
        'fi',
        'nl',
        'bg',
        'sv',
        'se',
        'ca',
        'tr',
        'hr',
        'zh',
        'zh_tw',
        'zh_cn',
        'hu'
    );

    // check for locale
    if(in_array($sytem_locale, $available_locales)) {
        $locale = $sytem_locale;
    }

    // check for locale by first two digits, used as language in returned data
    if(in_array(substr($sytem_locale, 0, 2), $available_locales)) {
        $locale = substr($sytem_locale, 0, 2);
    }

    // if location is empty abort
    if(!$location) {
        return voyage_mikado_weather_widget_error();
    }

    // find and cache city id
    if(is_numeric($location)) {
        $city_name_slug = sanitize_title($location);;
        $api_query = "id=".$location;
    } else {
        $city_name_slug = sanitize_title($location);
        $api_query      = "q=".$location;
    }

    // set transient name
    $weather_transient_name = 'mkdf_'.$city_name_slug."_".$days_to_show."_".$units.'_'.$locale;

    // get weather data
    if(get_transient($weather_transient_name)) {
        $weather_data = get_transient($weather_transient_name);
    } else {
        $weather_data['now']      = array();
        $weather_data['forecast'] = array();

        // ping weather now api
        $now_ping     = "http://api.openweathermap.org/data/2.5/weather?".$api_query."&lang=".$locale."&units=".$units."&APPID=".$api_key;
        $now_ping     = str_replace(" ", "", $now_ping);
        $now_ping_get = wp_remote_get($now_ping);

        // ping url error
        if(is_wp_error($now_ping_get)) {
            return chillnews_mikado_weather_widget_error($now_ping_get->get_error_message());
        }

        // get body of request
        $city_data = json_decode($now_ping_get['body']);

        if(isset($city_data->cod) AND $city_data->cod == 404) {
            return voyage_mikado_weather_widget_error($city_data->message);
        } else {
            $weather_data['now'] = $city_data;
        }

        // ping weather forecast api
        $forecast_ping = "http://api.openweathermap.org/data/2.5/forecast/daily?".$api_query."&lang=".$locale."&units=".$units."&cnt=7&APPID=".$api_key;

        $forecast_ping     = str_replace(" ", "", $forecast_ping);
        $forecast_ping_get = wp_remote_get($forecast_ping);

        if(is_wp_error($forecast_ping_get)) {
            return voyage_mikado_weather_widget_error($forecast_ping_get->get_error_message());
        }

        $forecast_data = json_decode($forecast_ping_get['body']);

        if(isset($forecast_data->cod) AND $forecast_data->cod == 404) {
            return voyage_mikado_weather_widget_error($forecast_data->message);
        } else {
            $weather_data['forecast'] = $forecast_data;
        }

        if($weather_data['now'] OR $weather_data['forecast']) {
            // set the transient, cache for three hours
            set_transient($weather_transient_name, $weather_data, apply_filters('voyage_mikado_weather_cache', 1800));
        }
    }

    // no weather
    if(!$weather_data OR !isset($weather_data['now'])) {
        return voyage_mikado_weather_widget_error();
    }

    // todays temps
    $today = $weather_data['now'];

    $today_temp = round($today->main->temp);

    // data

    $wind_label = array(
        esc_html__('N', 'voyage'),
        esc_html__('NNE', 'voyage'),
        esc_html__('NE', 'voyage'),
        esc_html__('ENE', 'voyage'),
        esc_html__('E', 'voyage'),
        esc_html__('ESE', 'voyage'),
        esc_html__('SE', 'voyage'),
        esc_html__('SSE', 'voyage'),
        esc_html__('S', 'voyage'),
        esc_html__('SSW', 'voyage'),
        esc_html__('SW', 'voyage'),
        esc_html__('WSW', 'voyage'),
        esc_html__('W', 'voyage'),
        esc_html__('WNW', 'voyage'),
        esc_html__('NW', 'voyage'),
        esc_html__('NNW', 'voyage')
    );


    $holder_class = '';
    if(!empty($today->weather[0]->description) && $today->weather[0]->description !== '') {
        $holder_class = 'mkdf-desc-'.sanitize_title($today->weather[0]->description);
    }

    if($units == 'metric' ? $units_display_temperature = esc_html__('C', 'voyage') : $units_display_temperature = esc_html__('F', 'voyage')) {
        ;
    }
    if($units == 'metric' ? $units_display_wind = esc_html__('m/s', 'voyage') : $units_display_wind = esc_html__('fps', 'voyage')) {
        ;
    }

	$time_m = 'M';
	$time_j = 'j';

    // display widget ?>

    <div class="mkdf-weather-widget-holder clearfix <?php echo esc_html($holder_class); ?>">
        <div class="mkdf-weather-information">

            <div class="mkdf-date-format">
            <span class="mkdf-month">
                <?php the_time($time_m); ?>
            </span>

             <span class="mkdf-day">
                <?php the_time($time_j); ?>
            </span>
            </div>

            <div class="mkdf-weather-today-temp">
                <div class="mkdf-weather-today-temp-inner"><span><?php echo esc_html($today_temp); ?>
                        <sup><?php echo esc_html($units_display_temperature); ?></sup></span></div>
            </div>
            <div class="mkdf-weather-todays-stats">
                <div class="mkdf-weather-todays-description"><?php echo esc_html($today->weather[0]->description); ?></div>
                <div class="mkdf-weather-todays-location"><?php echo esc_html($today->name); ?></div>
            </div>
        </div>
    </div>

    <?php


    $c            = 1;
    $dt_today     = date('Ymd', current_time('timestamp', $time_zone));
    $forecast     = $weather_data['forecast'];
    $days_to_show = 5;

    foreach((array) $forecast->list as $forecast) {
        if($dt_today >= date('Ymd', $forecast->dt)) {
            continue;
        }

        $forecast->temp = (int) $forecast->temp->day;

        if($c == $days_to_show) {
            break;
        }
        $c++;
    }

    return $html;
}

// handle error
function voyage_mikado_weather_widget_error($msg = false) {

    if(!$msg) {
        $msg = esc_html__('No weather information available', 'voyage');
    }

    return $msg;
}