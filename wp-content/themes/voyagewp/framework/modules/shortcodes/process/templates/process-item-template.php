<div <?php voyage_mikado_class_attribute($item_classes); ?>>
	<div class="mkdf-pi-holder-inner">
		<?php if(!empty($image)) : ?>
			<div class="mkdf-pi-image-holder">
				<?php echo wp_get_attachment_image($image, 'full'); ?>
			</div>
		<?php endif; ?>
		<div class="mkdf-pi-content-holder">
			<?php if(!empty($title)) : ?>
				<div class="mkdf-pi-title-holder">
					<h6 class="mkdf-pi-title"><?php echo esc_html($title); ?></h6>
				</div>
			<?php endif; ?>

			<?php if(!empty($text)) : ?>
				<div class="mkdf-pi-text-holder">
					<p><?php echo esc_html($text); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>