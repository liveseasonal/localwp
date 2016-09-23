<?php do_action('voyage_mikado_before_sticky_header'); ?>

	<div class="mkdf-sticky-header">
		<?php do_action('voyage_mikado_after_sticky_menu_html_open'); ?>
		<div class="mkdf-sticky-holder">
			<?php if($sticky_header_in_grid) : ?>
			<div class="mkdf-grid">
				<?php endif; ?>
				<div class=" mkdf-vertical-align-containers">
					<div class="mkdf-position-left">
						<div class="mkdf-position-left-inner">
							<?php if(!$hide_logo) {
								voyage_mikado_get_logo('sticky');
							} ?>
						</div>
					</div>
					<div class="mkdf-position-right">
						<div class="mkdf-position-right-inner">
							<?php voyage_mikado_get_sticky_menu('mkdf-sticky-nav'); ?>
							<?php if(is_active_sidebar('mkdf-sticky-right')) : ?>
								<div class="mkdf-sticky-right-widget-area">
									<?php dynamic_sidebar('mkdf-sticky-right'); ?>
								</div>

							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if($sticky_header_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

<?php do_action('voyage_mikado_after_sticky_header'); ?>