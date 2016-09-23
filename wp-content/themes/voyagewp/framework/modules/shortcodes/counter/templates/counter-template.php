<?php
/**
 * Counter shortcode template
 */
?>
<div <?php voyage_mikado_class_attribute($counter_classes); ?> <?php echo voyage_mikado_get_inline_style($counter_holder_styles); ?>>

	<div class="mkdf-counter-icon"><?php echo voyage_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?></div>

	<span class="mkdf-counter <?php echo esc_attr($type) ?>" <?php echo voyage_mikado_get_inline_style($counter_styles); ?>>
		<?php echo esc_attr($digit); ?>
	</span>
	<<?php echo esc_html($title_tag); ?> class="mkdf-counter-title">
	<?php echo esc_attr($title); ?>
</<?php echo esc_html($title_tag);; ?>>
<?php if($text != "") { ?>
	<p class="mkdf-counter-text"><?php echo esc_html($text); ?></p>
<?php } ?>

</div>