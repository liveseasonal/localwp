<?php
/**
 * Video Button shortcode template
 */
?>

<div class="mkdf-video-button <?php echo esc_attr($button_light);?>">
	<a class="mkdf-video-button-play" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto" <?php echo voyage_mikado_inline_style($button_style);?>>
		<span class="mkdf-video-button-wrapper <?php echo esc_attr($button_light);?>">
			<span class="arrow_triangle-right_alt"></span>
		</span>
	</a>
	<?php if ($title !== ''){?>
		<<?php echo esc_attr($title_tag);?> class="mkdf-video-button-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_attr($title_tag);?>>
	<?php } ?>
</div>