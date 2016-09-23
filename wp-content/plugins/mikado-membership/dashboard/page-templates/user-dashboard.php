<?php
get_header();
if ( mkdf_membership_theme_installed() ) {
	voyage_mikado_get_title();
} else { ?>
	<div class="mkdf-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="mkdf-container">
		<?php do_action( 'voyage_mikado_after_container_open' ); ?>
		<div class="mkdf-container-inner clearfix">
			<?php if ( is_user_logged_in() ) { ?>
				<div class="mkdf-membership-dashboard-nav-holder clearfix">
					<?php
					//Include dashboard navigation
					echo mkdf_membership_get_dashboard_template_part( 'navigation' );
					?>
				</div>
				<div class="mkdf-membership-dashboard-content-holder">
					<?php echo mkdf_membership_get_dashboard_pages(); ?>
				</div>
			<?php } else { ?>
				<div class="mkdf-login-register-content">
					<ul>
						<li>
							<a href="#mkdf-login-content"><?php esc_html_e( 'Login', 'mikado-membership' ); ?></a>
						</li>
						<li>
							<a href="#mkdf-register-content"><?php esc_html_e( 'Register', 'mikado-membership' ); ?></a>
						</li>
						<li class="mkdf-tab-line"></li>
					</ul>
					<div class="mkdf-login-content-inner" id="mkdf-login-content">
						<div
							class="mkdf-wp-login-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_login', array() ); ?>
						</div>
					</div>
					<div class="mkdf-register-content-inner" id="mkdf-register-content">
						<div
							class="mkdf-wp-register-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_register', array() ) ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php do_action( 'voyage_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>