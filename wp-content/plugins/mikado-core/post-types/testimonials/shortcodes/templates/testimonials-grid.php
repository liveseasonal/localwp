<div class="mkdf-testimonials-holder-inner">
	<div id="mkdf-testimonials<?php echo esc_attr($current_id) ?>" class="mkdf-testimonial-content <?php echo esc_attr($testimonial_type); ?><?php echo esc_attr($columns_number); ?>">
		<div class="mkdf-testimonial-text-inner <?php echo esc_attr($light_class); ?>">
			<?php if(has_post_thumbnail($current_id)) { ?>
				<div class="mkdf-testimonial-image-holder">
					<?php esc_html(the_post_thumbnail($current_id)) ?>
				</div>
			<?php } ?>

			<?php if($show_author == "yes") { ?>
				<div class="mkdf-testimonial-author">
					<h6 class="mkdf-testimonial-author-text <?php echo esc_attr($light_class); ?>"><?php echo esc_attr($author) ?></h6>
					<?php if($show_position == "yes" && $job !== '') { ?>
						<span class="mkdf-testimonials-job <?php echo esc_attr($light_class); ?>"><?php echo esc_attr($job) ?></span>
					<?php } ?>

				</div>
			<?php } ?>
		</div>
		<p class="mkdf-testimonial-text <?php echo esc_attr($light_class); ?>"><?php echo trim($text) ?></p>

	</div>
</div>
