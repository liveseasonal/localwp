<div class="mkdf-tours-destination-grid">
	<?php if($query->have_posts()) : ?>
		<div class="mkdf-grid-row">
			<?php while($query->have_posts()) : ?>
				<?php $query->the_post(); ?>

				<?php if(has_post_thumbnail()) : ?>
					<div <?php post_class('mkdf-grid-col-3 mkdf-grid-col-ipad-landscape-6 mkdf-grid-col-phone-landscape-12 mkdf-tours-destination-grid-item'); ?>>
						<div class="mkdf-tours-destination-item-holder">
							<a href="<?php the_permalink() ?>">
								<div class="mkdf-tours-destination-item-image">
									<?php the_post_thumbnail('full'); ?>
									<div class="mkdf-destination-overlay"></div>
								</div>

								<div class="mkdf-tours-destination-item-content">
									<div class="mkdf-tours-destination-item-content-inner">
										<h3><?php the_title(); ?></h3>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php else: ?>
		<p><?php esc_html_e('No destinations matched your criteria.', 'mikado-tours'); ?></p>
	<?php endif; ?>
</div>