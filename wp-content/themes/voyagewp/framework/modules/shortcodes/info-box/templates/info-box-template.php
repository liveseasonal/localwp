<div <?php voyage_mikado_class_attribute($holder_classes); ?>>

	<div class="mkdf-info-box-inner">
		<div class="mkdf-ib-front-holder">
			<div class="mkdf-ib-front-holder-inner">
				<div class="mkdf-ib-top-holder">
					<?php if($show_icon) : ?>
						<div class="mkdf-ib-icon-holder">
							<?php echo voyage_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
								'icon_attributes' => array(
									'style' => $icon_styles
								)
							)); ?>
						</div>
					<?php endif; ?>

					<?php if(!empty($title)) : ?>
						<div class="mkdf-ib-title-holder">
							<h3 class="mkdf-ib-title"><?php echo esc_html($title); ?></h3>
						</div>
					<?php endif; ?>
				</div>

				<div class="mkdf-ib-bottom-holder">
					<?php if(!empty($text)) : ?>
						<div class="mkdf-ib-text-holder">
							<p><?php echo esc_html($text); ?></p>
						</div>
					<?php endif; ?>

					<?php if(is_array($button_params) && count($button_params)) : ?>
						<div class="mkdf-ib-button-holder">
							<?php echo voyage_mikado_get_button_html($button_params); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>


		<div class="mkdf-ib-overlay" <?php voyage_mikado_inline_style($holder_styles); ?>></div>
	</div>
</div>