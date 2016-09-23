<div class="mkdf-membership-dashboard-page">
	<h3 class="mkdf-membership-dashboard-page-title">
		<?php esc_html_e( 'Edit Profile', 'mikado-membership' ); ?>
	</h3>
	<div>
		<form method="post" id="mkdf-membership-update-profile-form">
			<div class="mkdf-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo $first_name; ?>" placeholder="<?php echo esc_attr( 'First Name', 'mikado-membership' ); ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo $last_name; ?>" placeholder="<?php echo esc_attr( 'Last Name', 'mikado-membership' ); ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="email" name="email" id="email"
				       value="<?php echo $email; ?>" placeholder="<?php echo esc_attr( 'Email', 'mikado-membership' ); ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="url" id="url" value="<?php echo $website; ?>"
						placeholder="<?php echo esc_attr( 'Website', 'mikado-membership' ); ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="description" id="description"
				       value="<?php echo $description; ?>" placeholder="<?php echo esc_attr( 'Description', 'mikado-membership' ); ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password" id="password" value=""
					 	placeholder="<?php echo esc_attr( 'Password', 'mikado-membership' ); ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'mikado-membership' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password2" id="password2" value=""
						placeholder="<?php echo esc_attr( 'Repeat Password', 'mikado-membership' ); ?>">
			</div>
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo voyage_mikado_get_button_html( array(
					'text'      => esc_html__( 'Update Profile', 'mikado-membership' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('Updating Profile', 'mikado-membership'),
						'data-updated-text' => esc_html__('Profile Updated', 'mikado-membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'Update Profile', 'mikado-membership' ) . '</button>';
			}
			wp_nonce_field( 'mkdf_validate_edit_profile', 'mkdf_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'mkdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>