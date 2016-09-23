<div <?php voyage_mikado_class_attribute($holder_classes); ?> <?php echo voyage_mikado_get_inline_attrs($data); ?>>
	<?php if($icon !== '' && $number_of_icons) : ?>
		<?php for($i = 0; $i < $number_of_icons; $i++) : ?>
			<span class="mkdf-ipb-icon">
				<?php echo voyage_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
					'icon_attributes' => array(
						'style' => $icon_styles,
						'class' => 'mkdf-ipb-icon-elem'
					)
				)); ?>
			</span>
		<?php endfor; ?>
	<?php endif; ?>
</div>