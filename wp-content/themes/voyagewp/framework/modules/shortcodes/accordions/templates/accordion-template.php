<h6 class="clearfix mkdf-title-holder">
<span class="mkdf-accordion-mark mkdf-left-mark">
		<span class="mkdf-accordion-mark-icon">
			<span class="lnr lnr-chevron-down"></span>
			<span class="lnr lnr-chevron-down"></span>
		</span>
</span>
<span class="mkdf-tab-title">
		<span class="mkdf-tab-title-inner">
			<?php if($params['icon']) : ?>
				<span class="mkdf-icon-accordion-holder">
				 <?php echo voyage_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?>
			 </span>
			<?php endif; ?>
			<?php echo esc_attr($title) ?>
		</span>
</span>
</h6>
<div class="mkdf-accordion-content">
	<div class="mkdf-accordion-content-inner">
		<?php echo do_shortcode($content) ?>

		<?php if(is_array($link_params) && count($link_params)) : ?>
			<a class="mkdf-arrow-link" target="<?php echo esc_attr($link_params['link_target']); ?>" href="<?php echo esc_url($link_params['link']); ?>">
				<span class="mkdf-al-icon">
					<span class="icon-arrow-right-circle"></span>
				</span>
				<span class="mkdf-al-text"><?php echo esc_html($link_params['link_text']); ?></span>
			</a>
		<?php endif; ?>
	</div>
</div>
