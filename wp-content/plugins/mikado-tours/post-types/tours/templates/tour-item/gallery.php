<div <?php post_class(array('mkdf-tours-gallery-item',mkdf_tours_get_tour_rating_class())); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-gallery-item-image-holder">
			<div class="mkdf-overlay-gradient"></div>

			<div class="mkdf-tours-gallery-item-image">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
			</div>
			<div class="mkdf-tours-gallery-item-blur-image">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
				<div class="mkdf-tours-gallery-item-image-overlay"></div>
			</div>

			<?php if(mkdf_tours_get_tour_label_html()) : ?>
				<span class="mkdf-tours-gallery-item-label-holder">
					<?php echo mkdf_tours_get_tour_label_html(); ?>
				</span>
			<?php endif; ?>

			<div class="mkdf-tours-gallery-hover-holder">
				<div class="mkdf-tours-gallery-hover-table">
					<div class="mkdf-tours-gallery-item-content-table">
						<div class="mkdf-tours-gallery-item-left">
							<?php echo mkdf_tours_get_tour_rating_html(); ?>
							<h5 class="mkdf-tour-title" <?php voyage_mikado_inline_style($title_style);?>>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h5>
						</div>

						<div class="mkdf-tours-gallery-item-right">

								<span class="mkdf-tours-gallery-item-price-holder">
								<?php echo mkdf_tours_get_tour_price_html(); ?>
							</span>
						</div>
					</div>

					<?php if(mkdf_tours_get_tour_excerpt()) : ?>
						<div class="mkdf-tours-standard-item-excerpt">
							<?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
						</div>
					<?php endif; ?>

					<?php echo mkdf_tours_get_tour_categories_html(get_the_ID(), true); ?>
				</div>
			</div>


			<div class="mkdf-tours-gallery-item-content-holder">
				<a class="mkdf-tours-gallery-item-image-holder-link" href="<?php the_permalink(); ?>">
					<div class="mkdf-tours-gallery-item-content-inner">
						<div class="mkdf-tours-gallery-item-content-table">
							<div class="mkdf-tours-gallery-item-left">
								<?php echo mkdf_tours_get_tour_rating_html(); ?>
								<h5 class="mkdf-tour-title" <?php voyage_mikado_inline_style($title_style);?>>
									<?php the_title(); ?>
								</h5>
							</div>

							<div class="mkdf-tours-gallery-item-right">

									<span class="mkdf-tours-gallery-item-price-holder">
									<?php echo mkdf_tours_get_tour_price_html(); ?>
								</span>
							</div>
						</div>
					</div>
				</a>

			</div>

		</div>

	<?php endif; ?>

</div>