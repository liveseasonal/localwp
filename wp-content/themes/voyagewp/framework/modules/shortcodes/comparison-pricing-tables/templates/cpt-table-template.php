<div class="mkdf-comparision-table-holder mkdf-cpt-table">
	<div class="mkdf-cpt-table-holder-inner">
		<?php if($display_border) : ?>
			<div class="mkdf-cpt-table-border-top" <?php voyage_mikado_inline_style($border_style); ?>></div>
		<?php endif; ?>

		<div class="mkdf-cpt-table-head-holder">
			<div class="mkdf-cpt-table-head-holder-inner">
				<?php if($title !== '') : ?>
					<h4 class="mkdf-cpt-table-title"><?php echo esc_html($title); ?></h4>
				<?php endif; ?>

				<?php if($price !== '') : ?>
					<div class="mkdf-cpt-table-price-holder">
						<?php if($currency !== '') : ?>
						<span class="mkdf-cpt-table-currency"><?php echo esc_html($currency); ?></span><!--
						<?php else: ?>
							<!--
						<?php endif; ?>

						 --><span class="mkdf-cpt-table-price"><?php echo esc_html($price); ?></span>

						<?php if($price_period !== '') : ?>
							<span class="mkdf-cpt-table-period">
								/ <?php echo esc_html($price_period); ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="mkdf-cpt-table-content">
			<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
		</div>

		<div class="mkdf-cpt-table-footer">
			<div class="mkdf-cpt-table-btn">
				<a <?php voyage_mikado_inline_style($btn_styles); ?> href="<?php echo esc_url($link); ?>">
					<span><?php echo esc_html($button_text); ?></span>
				</a>
			</div>
		</div>
	</div>
</div>