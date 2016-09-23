<?php if(is_array($tour_types) && count($tour_types)) : ?>
	<div class="mkdf-tours-type-filters">
		<h5><?php esc_html_e('Tour Type', 'mikado-tours'); ?></h5>

		<div class="mkdf-tours-type-filters-inputs">
			<?php foreach($tour_types as $type) : ?>
				<?php
				$checked = in_array($type->slug, $checked_types);
				$checked_attr = $checked ? 'checked' : '';
				?>

				<div class="mkdf-tours-type-filter-item">
					<input <?php echo esc_attr($checked_attr); ?> type="checkbox" id="mkdf-tour-type-filter-<?php echo esc_attr($type->slug); ?>" name="type[]" value="<?php echo esc_attr($type->slug); ?>">
					<label for="mkdf-tour-type-filter-<?php echo esc_attr($type->slug); ?>">
						<span>
							<?php echo esc_html($type->name); ?>
						</span>
					</label>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
