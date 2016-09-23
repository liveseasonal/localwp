<div class="mkdf-social-login-holder">
	<div class="mkdf-social-login-holder-inner">
	    <h5 class="mkdf-login-title"><?php echo esc_html_e('Please Sign In', 'mikado-membership'); ?></h5>

	    <form method="post" class="mkdf-login-form">
	        <?php
	        $redirect = '';
	        if(isset($_GET['redirect_uri'])) {
	            $redirect = $_GET['redirect_uri'];
	        } ?>
	        <fieldset>
	            <div>
	                <input type="text" name="user_login_name" id="user_login_name"
	                    placeholder="<?php esc_html_e('User Name', 'mikado-membership') ?>" value="" required
	                    pattern=".{3,}"
	                    title="<?php esc_html_e('Three or more characters', 'mikado-membership'); ?>"/>
	            </div>
	            <div>
	                <input type="password" name="user_login_password" id="user_login_password"
	                    placeholder="<?php esc_html_e('Password', 'mikado-membership') ?>" value="" required/>
	            </div>
	            <div class="mkdf-lost-pass-remember-holder clearfix">
				<span class="mkdf-login-remember">
					<input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
					<label for="rememberme"
	                    class="mkdf-checbox-label"><?php esc_html_e('Remember me', 'mikado-membership') ?></label>
				<a href="<?php echo wp_lostpassword_url(); ?>" class="mkdf-login-action-btn"
	                data-el="#mkdf-reset-pass-content"
	                data-title="<?php esc_html_e('Lost Password?', 'mikado-membership'); ?>"><?php esc_html_e('Lost Your Password?', 'mikado-membership'); ?></a>
				</span>
	            </div>
	            <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url($redirect); ?>">

	            <div class="mkdf-login-button-holder">
	                <?php
	                if(mkdf_membership_theme_installed()) {
	                    echo voyage_mikado_get_button_html(array(
	                        'html_type' => 'button',
	                        'text'      => esc_html__('Sign in', 'mikado-membership'),
	                        'type'      => 'solid'
	                    ));
	                } else {
	                    echo '<button type="submit">'.esc_html__('Sign in', 'mikado-membership').'</button>';
	                }
	                wp_nonce_field('mkdf-ajax-login-nonce', 'mkdf-login-security'); ?>
	            </div>
	        </fieldset>
	    </form>
	</div>
    <?php
    if(mkdf_membership_theme_installed()) {
        //if social login enabled add social networks login
        $social_login_enabled = voyage_mikado_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        if($social_login_enabled) { ?>
            <div class="mkdf-login-form-social-login">
                <div
                    class="mkdf-login-social-title"><?php esc_html_e('Connect with Social Networks', 'mikado-membership'); ?></div>
                <?php
                do_action('mkdf_membership_social_network_login');
                ?>
            </div>
        <?php }
    }
    do_action('mkdf_membership_action_login_ajax_response');
    ?>
</div>