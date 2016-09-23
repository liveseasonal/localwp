<div class="mkdf-membership-dashboard-page">
	<div class="mkdf-membership-dashboard-image-holder">
		<?php echo mkdf_membership_kses_img( $profile_image ); ?>
	</div>
	<div class="mkdf-membership-dashboard-page-content">
		<h2 class="mkdf-membership-dashboard-page-title">
			<?php esc_html_e( 'Profile', 'mikado-membership' ); ?>
		</h2>
		<?php if ($first_name !== ''){ ?>
			<p>
				<span><?php esc_html_e( 'First Name', 'mikado-membership' ); ?>:</span>
				<?php echo $first_name; ?>
			</p>
		<?php } ?>
		<?php if ($last_name !== ''){ ?>
			<p>
				<span><?php esc_html_e( 'Last Name', 'mikado-membership' ); ?>:</span>
				<?php echo $last_name; ?>
			</p>
		<?php } ?>
		<?php if ($email !== ''){ ?>
			<p>
				<span><?php esc_html_e( 'Email', 'mikado-membership' ); ?>:</span>
				<?php echo $email; ?>
			</p>
		<?php } ?>
		<?php if ($website !== ''){ ?>
			<p>
				<span><?php esc_html_e( 'Website', 'mikado-membership' ); ?>:</span>
				<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo $website; ?></a>
			</p>
		<?php } ?>
		<?php if ($description !== ''){ ?>
			<p class="mkdf-membership-desc">
				<span><?php esc_html_e( 'Desription', 'mikado-membership' ); ?>:</span>
				<?php echo $description; ?>
			</p>
		<?php } ?>
	</div>
</div>
