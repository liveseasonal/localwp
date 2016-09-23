<?php do_action('voyage_mikado_before_mobile_header'); ?>

	<header class="mkdf-mobile-header">
		<div class="mkdf-mobile-header-inner">
			<?php do_action('voyage_mikado_after_mobile_header_html_open') ?>
			<div class="mkdf-mobile-header-holder">
				<div class="mkdf-grid">
					<div class="mkdf-vertical-align-containers">
						<?php if($show_navigation_opener) : ?>
							<div class="mkdf-mobile-menu-opener">
								<a href="javascript:void(0)">
                    <span class="mkdf-mobile-opener-icon-holder">
                        <?php print $menu_opener_icon; ?>
                    </span>
								</a>
							</div>
						<?php endif; ?>
						<?php if($show_logo) : ?>
							<div class="mkdf-position-center">
								<div class="mkdf-position-center-inner">
									<?php voyage_mikado_get_mobile_logo(); ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="mkdf-position-right">
							<div class="mkdf-position-right-inner">
								<?php if(is_active_sidebar('mkdf-right-from-mobile-logo')) {
									dynamic_sidebar('mkdf-right-from-mobile-logo');
								} ?>
							</div>
						</div>
					</div>
					<!-- close .mkdf-vertical-align-containers -->
				</div>
			</div>
			<?php voyage_mikado_get_mobile_nav(); ?>
		</div>
	</header> <!-- close .mkdf-mobile-header -->

<?php do_action('voyage_mikado_after_mobile_header'); ?>