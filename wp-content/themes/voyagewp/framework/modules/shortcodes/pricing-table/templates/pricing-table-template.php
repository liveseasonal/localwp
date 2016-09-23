<div <?php voyage_mikado_class_attribute($pricing_table_classes) ?>>
	<div class="mkdf-price-table-inner">
		<?php if(!empty($label)) : ?>
			<div class="mkdf-pt-label-holder">
				<div class="mkdf-pt-label-inner">
					<div class="mkdf-pt-label-content">
						<span><?php echo esc_html($label); ?></span>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<ul>
			<li class="mkdf-table-title">
				<h2 <?php voyage_mikado_inline_style($title_styles); ?> class="mkdf-title-content"><?php echo esc_html($title) ?></h2>
			</li>
			<li class="mkdf-table-prices">
				<div class="mkdf-price-in-table">
					<?php if(!empty($price)) : ?>
						<h2 class="mkdf-price">
							<?php echo esc_html($currency.$price); ?>
						</h2>
					<?php endif; ?>
				</div>
				<?php if(!empty($price_period)) : ?>
					<div class="mkdf-pt-price-period">
						<span class="mkdf-pt-price-period-content"><?php echo esc_html($price_period) ?></span>
					</div>
				<?php endif; ?>
			</li>
			<li class="mkdf-table-content">
				<?php echo do_shortcode($content) ?>
			</li>
			<?php
			if(is_array($button_params) && count($button_params)) { ?>
				<li class="mkdf-price-button">
					<?php echo voyage_mikado_get_button_html($button_params); ?>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
