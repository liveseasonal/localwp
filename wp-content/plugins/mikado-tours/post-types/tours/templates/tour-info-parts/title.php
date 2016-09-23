<?php
$title = get_the_title();
?>

<div class="mkdf-info-section-part mkdf-tour-item-title-holder">
	<?php if($title !== '') : ?>
		<h2 class="mkdf-tour-item-title">
			<?php echo esc_html($title) ?>
		</h2>
	<?php endif; ?>

	<div class="mkdf-tour-item-price-holder">
		<h3 class="mkdf-tour-item-price">
			<?php echo mkdf_tours_get_tour_price_html(get_the_ID()); ?>
		</h3>

		<span class="mkdf-tour-item-price-text">
			<?php esc_html_e('per person', 'mikado-tours'); ?>
		</span>
	</div>
</div>
