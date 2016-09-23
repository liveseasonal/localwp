<div class="mkdf-tours-slider-with-filter-holder">
	<div class="mkdf-tours-swf-slider-holder">
		<?php echo do_shortcode($content); ?>
	</div>

	<div <?php mkdf_tours_class_attribute($filter_class); ?> <?php voyage_mikado_inline_style($filter_style);?>>
		<?php if($display_grid_div) : ?>
		<div class="mkdf-grid">
			<?php endif; ?>

			<?php echo mkdf_tours_execute_shortcode('mkdf_tours_filter', $params); ?>

			<?php if($display_grid_div) : ?>
		</div>
	<?php endif; ?>
	</div>
</div>