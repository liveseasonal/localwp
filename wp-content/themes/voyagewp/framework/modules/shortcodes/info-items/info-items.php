<?php
namespace Voyage\Modules\InfoItems;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */
class InfoItems implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_info_items';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                    => 'Info Items',
            'base'                    => $this->getBase(),
            'as_parent'               => array('only' => 'mkdf_info_item'),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-info-items extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
        );

        $args   = array_merge($args, voyage_mikado_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        extract($params);
        $params['content'] = $content;

        $output = '';

        $output .= voyage_mikado_get_shortcode_module_template_part('templates/info-item-holder', 'info-items', '', $params);

        return $output;
    }

}