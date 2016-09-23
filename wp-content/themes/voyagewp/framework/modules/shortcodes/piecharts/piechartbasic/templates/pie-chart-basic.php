<?php
/**
 * Pie Chart Basic Shortcode Template
 */
?>
<div <?php mkd_core_class_attribute($holder_classes); ?> <?php echo mkd_core_get_inline_attrs($data_attr); ?>>

	<div class="mkdf-percentage" <?php echo voyage_mikado_get_inline_attrs($pie_chart_data); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } else { ?>
			<span class="mkdf-to-counter">
				<?php echo esc_html($percent); ?>
			</span>
		<?php } ?>
	</div>
	<div class="mkdf-pie-chart-text" <?php voyage_mikado_inline_style($pie_chart_style); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<span class="mkdf-to-counter">
				<?php echo esc_html($percent); ?>
			</span>
		<?php } else { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>