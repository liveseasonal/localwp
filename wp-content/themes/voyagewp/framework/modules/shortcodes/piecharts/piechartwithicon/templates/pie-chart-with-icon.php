<div class="mkdf-pie-chart-with-icon-holder" <?php echo mkd_core_get_inline_attrs($data_attr); ?>>
	<div class="mkdf-percentage-with-icon" <?php echo voyage_mikado_get_inline_attrs($pie_chart_data); ?>>
		<?php print $icon; ?>
	</div>
	<div class="mkdf-pie-chart-text" <?php voyage_mikado_inline_style($pie_chart_style)?>>
		<<?php echo esc_html($title_tag)?> class="mkdf-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>