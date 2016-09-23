<div class="mkdf-vertical-progress-bar-holder">
	<div class="mkdf-vpb-bar" <?php echo voyage_mikado_get_inline_attrs($progress_bar_data); ?>>
		<div class="mkdf-vpb-inactive-bar" <?php voyage_mikado_inline_style($inactive_style); ?>></div>
		<div class="mkdf-vpb-active-bar" <?php voyage_mikado_inline_style($active_style); ?>></div>
	</div>

	<div class="mkdf-vpb-content">
		<?php if($title !== '') : ?>
			<div class="mkdf-vpb-title">
				<h6><?php echo esc_html($title); ?></h6>
			</div>
		<?php endif; ?>

		<?php if($percent !== '') : ?>
			<div class="mkdf-vpb-percent">
				<h6>
					<span class="mkdf-vpb-percent-number"><?php echo esc_html($percent); ?></span><!--
				<--><span class="mkdf-vpb-percent-mark">%</span>
				</h6>
			</div>
		<?php endif; ?>
	</div>
</div>