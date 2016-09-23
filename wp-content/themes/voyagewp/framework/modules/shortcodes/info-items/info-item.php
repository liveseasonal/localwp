<?php
namespace Voyage\Modules\InfoItem;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */
class InfoItem implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_info_item';
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
            'name'                    => 'Info Item',
            'base'                    => $this->getBase(),
            'as_parent'               => array('except' => 'vc_row'),
            'as_child'                => array('only' => 'mkdf_info_item'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-info-item extended-custom-icon',
            'params'                  => array(

                array(
                    'type'        => 'textfield',
                    'admin-label' => true,
                    'param_name'  => 'dest_title',
                    'save_always' => true,
                    'description' => 'Title',
                ),
                array(
                    'type'        => 'textfield',
                    'admin-label' => true,
                    'param_name'  => 'description',
                    'save_always' => true,
                    'description' => 'Description',
                ),

            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'dest_title'  => '',
            'description' => ''
        );

        $args   = array_merge($args, voyage_mikado_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        extract($params);
        $params['content'] = $content;

        $output = '';

        $output .= voyage_mikado_get_shortcode_module_template_part('templates/info-item-inner', 'info-items', '', $params);

        return $output;
    }


}