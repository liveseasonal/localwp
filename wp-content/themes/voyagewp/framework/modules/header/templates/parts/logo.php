<?php do_action('voyage_mikado_before_site_logo'); ?>

	<div class="mkdf-logo-wrapper">
		<a href="<?php echo esc_url(home_url('/')); ?>" <?php voyage_mikado_inline_style($logo_styles); ?>>
			<img <?php echo voyage_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="logo"/>
			<?php if(!empty($logo_image_dark)) { ?>
				<img <?php echo voyage_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="dark logo"/><?php } ?>
			<?php if(!empty($logo_image_light)) { ?>
				<img <?php echo voyage_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="light logo"/><?php } ?>
		</a>
	</div>

<?php do_action('voyage_mikado_after_site_logo'); ?>