<?php do_action('voyage_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>

	<div class="mkdf-title <?php echo voyage_mikado_title_classes(); ?>" <?php voyage_mikado_inline_style($title_styles); ?> data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
		<div class="mkdf-title-image"><?php if($title_background_image_src != "") { ?>
				<img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;"/> <?php } ?></div>
		<div class="mkdf-title-holder" <?php voyage_mikado_inline_style($title_holder_height); ?>>
			<div class="mkdf-container clearfix">
				<div class="mkdf-container-inner">
					<div class="mkdf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
						<div class="mkdf-title-subtitle-holder-inner">
							<?php if (!$hide_title_text){ ?>
								<h1 <?php voyage_mikado_inline_style($title_color); ?>>
									<span><?php voyage_mikado_title_text(); ?></span>
								</h1>
							<?php } ?>
							<?php if($has_subtitle) { ?>
								<span class="mkdf-subtitle" <?php voyage_mikado_inline_style($subtitle_color); ?>><span><?php voyage_mikado_subtitle_text(); ?></span></span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
<?php do_action('voyage_mikado_after_page_title'); ?>