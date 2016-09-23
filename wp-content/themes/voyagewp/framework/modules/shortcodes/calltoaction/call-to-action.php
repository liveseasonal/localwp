<?php
namespace Voyage\Modules\CallToAction;

use Voyage\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CallToAction
 */
class CallToAction implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkdf_call_to_action';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        $call_to_action_button_icons_array     = array();
        $call_to_action_button_IconCollections = voyage_mikado_icon_collections()->iconCollections;
        foreach($call_to_action_button_IconCollections as $collection_key => $collection) {

            $call_to_action_button_icons_array[] = array(
                'type'        => 'dropdown',
                'heading'     => 'Button Icon',
                'param_name'  => 'button_'.$collection->param,
                'value'       => $collection->getIconsArray(),
                'save_always' => true,
                'dependency'  => Array('element' => 'button_icon_pack', 'value' => array($collection_key))
            );

        }

        vc_map(array(
            'name'                      => 'Call to Action',
            'base'                      => $this->getBase(),
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-call-to-action extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Full Width',
                        'param_name'  => 'full_width',
                        'admin_label' => true,
                        'value'       => array(
                            'Yes' => 'yes',
                            'No'  => 'no'
                        ),
                        'save_always' => true,
                        'description' => '',
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Content in grid',
                        'param_name'  => 'content_in_grid',
                        'value'       => array(
                            'Yes' => 'yes',
                            'No'  => 'no'
                        ),
                        'save_always' => true,
                        'description' => '',
                        'dependency'  => array('element' => 'full_width', 'value' => 'yes')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Grid size',
                        'param_name'  => 'grid_size',
                        'value'       => array(
                            '75/25' => '75',
                            '50/50' => '50',
                            '66/33' => '66'
                        ),
                        'save_always' => true,
                        'description' => '',
                        'dependency'  => array('element' => 'content_in_grid', 'value' => 'yes')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Type',
                        'param_name'  => 'type',
                        'admin_label' => true,
                        'value'       => array(
                            'Normal'    => 'normal',
                            'With Icon' => 'with-icon',
                        ),
                        'save_always' => true,
                        'description' => ''
                    )
                ),
                voyage_mikado_icon_collections()->getVCParamsArray(array(
                    'element' => 'type',
                    'value'   => array('with-icon')
                )),
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Icon Size (px)',
                        'param_name'  => 'icon_size',
                        'description' => '',
                        'dependency'  => array('element' => 'type', 'value' => array('with-icon')),
                        'group'       => 'Design Options',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Box Padding (top right bottom left) px',
                        'param_name'  => 'box_padding',
                        'admin_label' => true,
                        'description' => 'Default padding is 20px on all sides',
                        'group'       => 'Design Options'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Box Background Color',
                        'param_name'  => 'box_background_color',
                        'admin_label' => true,
                        'group'       => 'Design Options'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Box Border Color',
                        'param_name'  => 'box_border_color',
                        'admin_label' => true,
                        'group'       => 'Design Options'
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Box Border Width (px)',
                        'param_name'  => 'box_border_width',
                        'admin_label' => true,
                        'group'       => 'Design Options'
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Default Text Font Size (px)',
                        'param_name'  => 'text_size',
                        'description' => 'Font size for p tag',
                        'group'       => 'Design Options',
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Show Button',
                        'param_name'  => 'show_button',
                        'value'       => array(
                            'Yes' => 'yes',
                            'No'  => 'no'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Type',
                        'param_name'  => 'button_type',
                        'value'       => array_flip(voyage_mikado_get_btn_types(true)),
                        'save_always' => true,
                        'admin_label' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => 'Design Options',
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Hover Button Type',
                        'param_name'  => 'button_hover_type',
                        'value'       => array_flip(voyage_mikado_get_btn_types(true)),
                        'save_always' => true,
                        'admin_label' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => 'Design Options',
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Hover Animation',
                        'param_name'  => 'button_hover_animation',
                        'value'       => array_flip(voyage_mikado_get_btn_hover_animation_types(true)),
                        'save_always' => true,
                        'admin_label' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => 'Design Options',
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Position',
                        'param_name'  => 'button_position',
                        'value'       => array(
                            'Default/right' => '',
                            'Center'        => 'center',
                            'Left'          => 'left'
                        ),
                        'description' => '',
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Size',
                        'param_name'  => 'button_size',
                        'value'       => array(
                            'Default'     => '',
                            'Small'       => 'small',
                            'Medium'      => 'medium',
                            'Large'       => 'large',
                            'Extra Large' => 'big_large'
                        ),
                        'description' => '',
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => 'Design Options',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Button Text',
                        'param_name'  => 'button_text',
                        'admin_label' => true,
                        'description' => 'Default text is "button"',
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Button Link',
                        'param_name'  => 'button_link',
                        'description' => '',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Target',
                        'param_name'  => 'button_target',
                        'value'       => array(
                            ''      => '',
                            'Self'  => '_self',
                            'Blank' => '_blank'
                        ),
                        'description' => '',
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Icon Pack',
                        'param_name'  => 'button_icon_pack',
                        'value'       => array_merge(array('No Icon' => ''), voyage_mikado_icon_collections()->getIconCollectionsVC()),
                        'save_always' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    )
                ),
                $call_to_action_button_icons_array,
                array(
                    array(
                        'type'        => 'textarea_html',
                        'admin_label' => true,
                        'heading'     => 'Content',
                        'param_name'  => 'content',
                        'value'       => '<p>'.'I am test text for Call to action.'.'</p>',
                        'description' => ''
                    )
                )
            )
        ));

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'type'                   => 'normal',
            'button_type'            => '',
            'button_hover_type'      => '',
            'full_width'             => 'yes',
            'content_in_grid'        => 'yes',
            'grid_size'              => '75',
            'icon_size'              => '',
            'box_padding'            => '20px',
            'box_background_color'   => '',
            'box_border_color'       => '',
            'box_border_width'       => '',
            'text_size'              => '',
            'show_button'            => 'yes',
            'button_position'        => 'right',
            'button_size'                   => '',
            'button_link'            => '',
            'button_text'            => 'button',
            'button_target'          => '',
            'button_icon_pack'       => '',
            'button_hover_animation' => ''
        );

        $call_to_action_icons_form_fields = array();

        foreach(voyage_mikado_icon_collections()->iconCollections as $collection_key => $collection) {

            $call_to_action_icons_form_fields['button_'.$collection->param] = '';

        }

        $args = array_merge($args, voyage_mikado_icon_collections()->getShortcodeParams(), $call_to_action_icons_form_fields);

        $params = shortcode_atts($args, $atts);

		$params['content']					= preg_replace('#^<\/p>|<p>$#', '', $content);
        $params['text_wrapper_classes']		= $this->getTextWrapperClasses($params);
        $params['content_styles']			= $this->getContentStyles($params);
        $params['call_to_action_styles']	= $this->getCallToActionStyles($params);
        $params['icon']						= $this->getCallToActionIcon($params);
        $params['button_parameters']		= $this->getButtonParameters($params);

        $params['button_type'] = !empty($params['button_type']) ? $params['button_type'] : 'solid';


        //Get HTML from template
        $html = voyage_mikado_get_shortcode_module_template_part('templates/call-to-action-template', 'calltoaction', '', $params);

        return $html;

    }

    /**
     * Return Classes for Call To Action text wrapper
     *
     * @param $params
     *
     * @return string
     */
    private function getTextWrapperClasses($params) {
        return ($params['show_button'] == 'yes') ? 'mkdf-call-to-action-column1 mkdf-call-to-action-cell' : '';
    }

    /**
     * Return CSS styles for Call To Action Icon
     *
     * @param $params
     *
     * @return string
     */
    private function getIconStyles($params) {
        $icon_style = array();

        if($params['icon_size'] !== '') {
            $icon_style[] = 'font-size: '.$params['icon_size'].'px';
        }

        return implode(';', $icon_style);
    }

    /**
     * Return CSS styles for Call To Action Content
     *
     * @param $params
     *
     * @return string
     */
    private function getContentStyles($params) {
        $content_styles = array();

        if($params['text_size'] !== '') {
            $content_styles[] = 'font-size: '.$params['text_size'].'px';
        }

        return implode(';', $content_styles);
    }

    /**
     * Return CSS styles for Call To Action shortcode
     *
     * @param $params
     *
     * @return string
     */
    private function getCallToActionStyles($params) {
        $call_to_action_styles = array();

        if($params['box_padding'] != '') {
            $call_to_action_styles[] = 'padding: '.$params['box_padding'].';';
        }

        if($params['box_background_color'] != '') {
            $call_to_action_styles[] = 'background-color: '.$params['box_background_color'].';';
        }

        if($params['box_border_color'] != '') {
            $call_to_action_styles[] = 'border-color: '.$params['box_border_color'].';';
            $call_to_action_styles[] = 'border-style: solid';

            $border_width = 2;

            if($params['box_border_width'] !== '') {
                $border_width = voyage_mikado_filter_px($params['box_border_width']);
            }

            $call_to_action_styles[] = 'border-width: '.$border_width.'px';
        }

        return $call_to_action_styles;
    }

    /**
     * Return Icon for Call To Action Shortcode
     *
     * @param $params
     *
     * @return mixed
     */
    private function getCallToActionIcon($params) {

        $icon                                   = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $iconStyles                             = array();
        $iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);
        $call_to_action_icon                    = '';
        if(!empty($params[$icon])) {
            $call_to_action_icon = voyage_mikado_icon_collections()->renderIcon($params[$icon], $params['icon_pack'], $iconStyles);
        }

        return $call_to_action_icon;

    }

    private function getButtonParameters($params) {
        $button_params_array = array();

        if(!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        if(!empty($params['button_size'])) {
            $button_params_array['size'] = $params['button_size'];
        }

        if(!empty($params['button_type'])) {
            $button_params_array['type'] = $params['button_type'];
        }

        if(!empty($params['button_icon_pack'])) {
            $button_params_array['icon_pack']   = $params['button_icon_pack'];
            $iconPackName                       = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($params['button_icon_pack']);
            $button_params_array[$iconPackName] = $params['button_'.$iconPackName];
        }

        if(!empty($params['button_target'])) {
            $button_params_array['target'] = $params['button_target'];
        }

        if(!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        $button_params_array['hover_type']      = $params['button_hover_type'];
        $button_params_array['hover_animation'] = $params['button_hover_animation'];

        return $button_params_array;
    }
}