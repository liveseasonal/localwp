<div class="mkdf-login-register-holder">
    <div class="mkdf-login-register-content">
        <ul>
            <li><a href="#mkdf-login-content"><?php esc_html_e('Sign In', 'mikado-membership'); ?></a></li>
            <li><a href="#mkdf-register-content"><?php esc_html_e('Register', 'mikado-membership'); ?></a></li>
        </ul>
        <div class="mkdf-login-content-inner" id="mkdf-login-content">
            <div
                class="mkdf-wp-login-holder"><?php echo mkdf_membership_execute_shortcode('mkdf_user_login', array()); ?></div>
        </div>
        <div class="mkdf-register-content-inner" id="mkdf-register-content">
            <div
                class="mkdf-wp-register-holder"><?php echo mkdf_membership_execute_shortcode('mkdf_user_register', array()) ?></div>
        </div>
    </div>
</div>
