<?php
/**
 * Call to action shortcode template
 */
?>

<?php if ($full_width == "no") { ?>
	<div class="mkdf-container-inner">
<?php } ?>

	<div class="mkdf-call-to-action <?php echo esc_attr($type) ?>" <?php voyage_mikado_inline_style($call_to_action_styles); ?>>

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		<div class="mkdf-container-inner">
		<?php }

		if ($grid_size == "75") { ?>
			<div class="mkdf-call-to-action-row-75-25 clearfix">
		<?php } elseif ($grid_size == "66") { ?>
			<div class="mkdf-call-to-action-row-66-33 clearfix">
		<?php } else { ?>
			<div class="mkdf-call-to-action-row-50-50 clearfix">
		<?php } ?>

				<div class="mkdf-text-wrapper <?php echo esc_attr($text_wrapper_classes) ?>">

				<?php if ($type == "with-icon") { ?>
					<div class="mkdf-call-to-action-icon-holder">
						<div class="mkdf-call-to-action-icon">
							<div class="mkdf-call-to-action-icon-inner">
								<?php print $icon; ?>
							</div>
						</div>
					</div>
				<?php } ?>

					<div class="mkdf-call-to-action-text" <?php echo voyage_mikado_get_inline_style($content_styles) ?>>
						<?php
						echo do_shortcode($content);
						?>
					</div>

				</div>

				<?php if ($show_button == 'yes') { ?>

					<div class="mkdf-button-wrapper mkdf-call-to-action-column2 mkdf-call-to-action-cell" style ="text-align: <?php echo esc_attr($button_position) ?> ;">

						<?php echo voyage_mikado_get_button_html($button_parameters); ?>

					</div>

				<?php } ?>

			</div>

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		</div>
		<?php } ?>

	</div>

<?php if ($full_width == 'no') { ?>
	</div>
<?php } ?>