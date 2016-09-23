<div <?php post_class('mkdf-tours-standard-item'); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-standard-item-image-holder">
			<a href="<?php the_permalink(); ?>">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>

				<?php if(mkdf_tours_get_tour_label_html()) : ?>
					<span class="mkdf-tours-standard-item-label-holder">
						<?php echo mkdf_tours_get_tour_label_html(); ?>
					</span>
				<?php endif; ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="mkdf-tours-standard-item-content-holder">
		<div class="mkdf-tours-standard-item-title-price-holder">
			<h5 class="mkdf-tour-title" <?php voyage_mikado_inline_style($title_style);?>>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

				<span class="mkdf-tours-standard-item-price-holder">
					<?php echo mkdf_tours_get_tour_price_html(); ?>
				</span>

			</h5>
		</div>

		<div class="mkdf-tours-standard-item-rating">
			<?php echo mkdf_tours_get_tour_rating_html(); ?>
		</div>

		<?php if(mkdf_tours_get_tour_excerpt()) : ?>
			<div class="mkdf-tours-standard-item-excerpt">
				<?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
			</div>
		<?php endif; ?>

		<div class="mkdf-tours-standard-item-bottom-content">
			<?php if(mkdf_tours_get_tour_duration()) : ?>
				<div class="mkdf-tours-standard-item-bottom-item">
					<?php echo mkdf_tours_get_tour_duration_html(); ?>
				</div>
			<?php endif; ?>

			<?php if(mkdf_tours_get_tour_min_age()) : ?>
				<div class="mkdf-tours-standard-item-bottom-item">
					<?php echo mkdf_tours_get_tour_min_age_html(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>