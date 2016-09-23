<div class="mkdf-social-register-holder">
	<div class="mkdf-social-register-holder-inner">

		<h5 class="mkdf-login-title"><?php echo esc_html_e('Please Sign Up', 'mikado-membership') ;?></h5>

		<form method="post" class="mkdf-register-form">
			<fieldset>
				<div>
					<input type="text" name="user_register_name" id="user_register_name"
					       placeholder="<?php esc_html_e( 'User Name', 'mikado-membership' ) ?>" value="" required
					       pattern=".{3,}"
					       title="<?php esc_html_e( 'Three or more characters', 'mikado-membership' ); ?>"/>
				</div>
				<div>
					<input type="email" name="user_register_email" id="user_register_email"
					       placeholder="<?php esc_html_e( 'Email', 'mikado-membership' ) ?>" value="" required/>
				</div>
				<div class="mkdf-register-button-holder">
					<?php
					if ( mkdf_membership_theme_installed() ) {
						echo voyage_mikado_get_button_html( array(
							'html_type' => 'button',
							'text'      => esc_html__( 'Register', 'mikado-membership' ),
							'type'      => 'solid'
						) );
					} else {
						echo '<button type="submit">' . esc_html__( 'Register', 'mikado-membership' ) . '</button>';
					}
					wp_nonce_field( 'mkdf-ajax-register-nonce', 'mkdf-register-security' ); ?>
				</div>
			</fieldset>
		</form>
	</div>
	<?php
	if ( mkdf_membership_theme_installed() ) {
		$social_login_enabled = voyage_mikado_options()->getOptionValue( 'enable_social_login' ) == 'yes' ? true : false;
		if ( $social_login_enabled ) { ?>
			<div class="mkdf-login-form-social-login">
				<div
					class="mkdf-login-social-title"><?php esc_html_e( 'Connect with Social Networks', 'mikado-membership' ); ?></div>
				<?php
				do_action( 'mkdf_membership_social_network_login' );
				?>
			</div>
		<?php }
	}
	do_action( 'mkdf_membership_action_login_ajax_response' );
	?>
</div>