<?php

class MikadofMembershipLoginRegister extends WP_Widget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkdf_login_register_widget', // Base ID
            'Mikado Login',
            array('description' => esc_html__('Login and register, connect with social networks', 'mikado-membership'),)
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array();
    }

    public function getParams() {
        return $this->params;
    }

    public function widget($args, $instance) {

        echo '<div class="widget mkdf-login-register-widget">';
        if(!is_user_logged_in()) {
            if(mkdf_membership_theme_installed()) {
                echo '<div class="mkdf-login-holder">';
                echo '<a href="#" class="mkdf-login-opener">'.esc_html__('Sign In', 'mikado-membership').'</a>';
                echo '</div>';
            }
            add_action('wp_footer', array($this, 'mkdf_membership_render_login_form'));

        } else {
            echo mkdf_membership_get_widget_template_part('login-widget', 'login-widget-template');
        }
        echo '</div>';

    }

    public function mkdf_membership_render_login_form() {

        //Render modal with login and register forms
        echo mkdf_membership_get_widget_template_part('login-widget', 'login-modal-template');

    }
}

function mkdf_membership_login_widget_load() {
    register_widget('MikadofMembershipLoginRegister');
}

add_action('widgets_init', 'mkdf_membership_login_widget_load');