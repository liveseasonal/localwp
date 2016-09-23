<div class="mkdf-blog-slider-holder">
	<?php if($query->have_posts()) : ?>
		<?php while($query->have_posts()) : $query->the_post(); ?>
			<div class="mkdf-blog-slider-item">
				<div class="mkdf-bs-item-image-holder">
					<?php if(has_post_thumbnail()) : ?>
						<div class="mkdf-bs-item-image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('full'); ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="mkdf-bs-item-content">
						<div class="mkdf-bs-item-date">
							<span><?php the_time(get_option('date_format')); ?></span>
						</div>
						<div class="mkdf-bs-item-text">
							<h2 class="mkdf-bs-item-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php if($text_length != '0') {
								$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
								<p class="mkdf-bs-item-excerpt"><?php echo esc_html($excerpt) ?></p>
							<?php } ?>
						</div>
						<div class="mkdf-bs-item-bottom-section">
							<div class="mkdf-bs-item-author">
								<a href="<?php echo esc_url(voyage_mikado_get_author_posts_url()); ?>">
									<span class="mkdf-post-item-author-avatar-holder">
										<?php echo voyage_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 30)); ?>
									</span>
									<span class="mkdf-post-item-author-name">
										<?php echo voyage_mikado_get_the_author_name(); ?>
									</span>
								</a>
							</div>
							<div class="mkdf-bs-item-categories">
								<?php echo voyage_mikado_icon_collections()->renderIcon('icon_tags', 'font_elegant'); ?>
								<?php the_category(', '); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else: ?>
		<p><?php esc_html_e('No posts were found.', 'voyage'); ?></p>
	<?php endif; ?>
</div>